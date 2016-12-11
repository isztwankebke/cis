<?php
class TransactionModel extends Model {
	
	private $transactionData;
	private $clientID;
	private $productID;
	private $initialDate;
	private $endDate;
	private $period;
	private $transactionID;
	private $clientName;
	private $clientSurname;
	private $clientPhone;
	private $clientExtraInfo;
	private $clientDataDifference = FALSE;
	private $halfPeriod;
	private $creditValue;
	private $deleyedPayment;
	
	
	
	/**
	 * 
	 */
	public function __construct() {
		parent::__construct();
		
	}
	
	
	
	/**
	 * OK
	 * @param unknown $searchData
	 */
	public function search($searchData) {
		if (debug) {
			var_dump($searchData);
		}
		//check is recived data is set
		if (empty($searchData['clientData'])) {
			return $a = 'nie wpisano danych';
		}
		//$client = new ClientModel();
		//check is client exist via pesel and phone numner
		if (is_numeric($searchData['clientData'])) {
			//setting new client model and check is pesel or phone number
			$sql ="SELECT 
						clients.id 
					FROM 
						clients 
					WHERE 
						clients.pesel LIKE '%{$searchData['clientData']}%' 
					OR 
						clients.phone_nr LIKE '%{$searchData['clientData']}%'";
			
			$result = parent::query($sql);
			
		}
		//check is client exist via surname
		elseif (is_string($searchData['clientData']) && !is_numeric($searchData['clientData'])) {
			
			$sql ="SELECT
					clients.id
				FROM
					clients
				WHERE
					clients.surname LIKE '%{$searchData['clientData']}%'";
			
			$result = parent::query($sql);
		}
		//if number of rows > 1 thats meen, is more than 1 client with this phone number or this surname
		
		if (debug) {
			var_dump($result);
			var_dump(count($result));
		}
		if ($result) {
			foreach ($result as $row) {
				$clientsId[] = $row['id'];
			}
			
			$clientsId = implode(',', $clientsId);
			
			//var_dump($clientsId);
		}
		else {
			return false;
		}
		
		$sql = "SELECT
					clients_products.id,
					clients.name, 
					clients.surname, 
					clients.pesel, 
					clients.phone_nr, 
					products.product_name, 
					clients_products.init_date, 
					clients_products.period,
					clients_products.credit_value,
					clients.extra_info						
				FROM 
					clients_products
				JOIN
					clients
				ON 
					clients_products.client_id = clients.id
				JOIN
					products
				ON
					products.id = clients_products.product_id
				WHERE 
					clients.id IN ({$clientsId})";
			//AND 
			//clients.id IN 
		//var_dump($sql);
		//`{$key}` LIKE '%{$value}%'";
		$result = parent::query($sql);
		
		return $result;
	}
	
	
	
	
	
	
	/**
	 * 
	 * @return TransactionModel
	 */
	private function setTransactionData() {
		$this->transactionData = array(
				"id" 			=> $this->getTransactionID(),
				"client_id" 	=> $this->getClientID(),
				"product_id" 	=> $this->getProductID(),
				"init_date" 	=> $this->getInitialDate(),
				"period" 		=> $this->getPeriod(),
				"credit_value"  => $this->creditValue,
				"end_date" 		=> $this->getEndDate()
		);
		
		return $this;
	}
	
	
	
	/**
	 * 
	 */
	public function getTransactionData() {
		
		return $this->transactionData;
	}
	
	
	
	/**
	 * 
	 * @param $transactionData
	 * 
	 * 	 
	 * 
	 * */
	public function addTransaction($transactionData) {
		//1.check is post data is consistent = have request data to add
		//2.check is request data is valid
		//3.check is client data is valid = pesel
		//4.if pesel is valid check is client exist
		//4a. if client exist check, is in database the same entry (date, credit value, product name, period).
		//if entry exist - ask -> continue or cancel.
		//5.if client exist check the name, surname and phone number is the same if not use old value, and give notification
		//that need to change data in database
		//5a. get extra_info and add new one on the end of old value
		//6. if client not exist check name and surname, phone number and extra info
		//7.if everything is ok, prepare data to begin transaction
		//7a. check the deleyaed initial_date (>0) if true add deleyed offset in month
		//to initial date.
		//7b.prepare halfperiod date
		//
		//8.check product name - if is ok prepare to transaction
		
		//9.check initial_date and period - if is ok - prepare to transaction
		
		//9a.check credit value - mast be >0 and numeric
		//10.begin transaction:
		//11.add client or read parameters to get client.id
		//12.get product.id
		
		//13.add transaction: client.id, product.id, initial_date and period.
		
		//14.if clietn exist and clietn data was not consistent return true and notification else
		//return true
		
		//15.if something wrong rollback and return false
		
		
		
		//try {
			//.1 check is post data is consistent = have request data to add to db
			//var_dump($transactionData);
			
			if (!isset($transactionData['pesel'],
					$transactionData['name'],
					$transactionData['surname'],
					$transactionData['phone_nr'],
					$transactionData['product_name'],
					$transactionData['init_date'],
					$transactionData['credit_value'],
					$transactionData['period'])) {
						
						throw new Exception("Recived data not consistent - fill properly data in input");
						return false;
					}
			//.2 check is request data is valid
			if (!preg_match('/[A-ZŹŻŁa-zęółśążźćń ]$/',$transactionData['name'])) {
				
				throw new Exception("Name is not valid");
				return false;
			}
			//change first letter to uppercase, rest to lower of name
			$name = parent::setFirstLetterUppercase($transactionData['name']);
			
			if (!preg_match('/[A-ZŹŻŁa-zęółśążźćń ]$/',$transactionData['surname'])) {
				
				throw new Exception("Surname is not valid");
				return false;
			}
			
			$surname = parent::setFirstLetterUppercase($transactionData['surname']);
			
			if (!is_numeric(str_replace(' ','',$transactionData['phone_nr']))) {
				
				throw new Exception("Phone nr is not valid");
				return false;
			}
			
			if (!$this->checkDate($transactionData['init_date'])) {
				
				throw new Exception("Date initialization not valid");
				return false;
			}
			if (!is_numeric($transactionData['period'])) {
				
				throw new Exception("Period time is not valid");
				return false;
			}
			if (!is_numeric($transactionData['credit_value'])) {
			
				throw new Exception("Credit value is not valid");
				return false;
			}
			
			//deleyed field colud be empty (default = 0 or value)
			
			$this->deleyedPayment = 0;
			
			if (!empty($transactionData['deleyedPayment'])) {
				if (!is_numeric($transactionData['deleyedPayment'])) {
						
					throw new Exception("Credit value is not valid");
					return false;
				}
				else {
					//set deleyedPayment
					$this->deleyedPayment = $transactionData['deleyedPayment'];
				}
				
			}
			
			
		$client = new ClientModel();
		
		//.4 check is client data is valid = pesel
		if (!$client->validatePesel($transactionData['pesel'])) {
		
			throw new Exception("pesel not valid");
			return false;
		}
		
		
		$sql = "SELECT *
		FROM clients
		WHERE clients.pesel = '{$transactionData['pesel']}'";
		
		$result = parent::query($sql);
		//var_dump($result);
		if (debug) {
			
			var_dump($result);
		}
		
		if ($result) { //client exist
			
			$this->clientID = $result[0]['id'];
			$this->clientName = $result[0]['name'];
			$this->clientSurname = $result[0]['surname'];
			$this->clientPhone = $result[0]['phone_nr'];
			$this->clientExtraInfo = $result[0]['extra_info'];
			
			//.4a if client exist check, is in database the same entry (date, credit value, product name, period).
			//var_dump($transactionData);
			
			if ($transaction = $this->validateExistTransaction($transactionData)) {
				return ['transaction exist',$transaction];
			}
				
				
			
			
			//.5 if client exist check the name, surname and phone number is the same if not use old value, and give notification
		//that need to change data in database
			if (!$this->checkDifference($transactionData)) {
				
				throw new Exception("Client data in db not the same as in form - check data, edit client data first, then add client and transaction");
				return false;
			}
			
			//.5a client exist - add string to end of value in db next extra if extra_info from form is set
			if (isset($transactionData['extra_info'])) {
				
				//$date = new DateTime();
				$today = date("Y-m-d H:i");
				$extra_info = "".$today.": ".$transactionData['extra_info'];
				//var_dump($extra_info);
				
				$sql = "UPDATE 
						clients 
						SET 
						clients.extra_info = CONCAT(clients.extra_info, ' ;{$extra_info}') 
						WHERE 
						clients.id = '{$this->clientID}'";
				
				$result = parent::query($sql);
				
				if (!$result) {
					throw new Exception("failure during update db - extra info problem");
					return false;
				}
			}
			
			
		} 
		
		//var_dump($this->clientID);
		//.7 if everything is ok, prepare data to begin transaction
		if (!$this->clientID) { //client not exist - prepare sql to add client
			
			
			$sqlClient = "INSERT 
					INTO clients 
					(`pesel`, `name`, `surname`, `phone_nr`, `extra_info`) 
					VALUES 
					('{$transactionData['pesel']}', '{$name}', '{$surname}', 
					'{$transactionData['phone_nr']}', '{$transactionData['extra_info']}')";
			//var_dump($sqlClient);
			$result = parent::query($sqlClient);
			
			if (debug) {
				
				var_dump($result);
			}
			
			$this->clientID = $result;
			
		}
		
		//.8 check product name - if is ok prepare to transaction
		$sqlProduct = "SELECT products.id 
						FROM products 
						WHERE products.product_name = '{$transactionData['product_name']}'";
		$result = parent::query($sqlProduct);
		
		if (!$result) {
			throw new Exception("product data not valid");
			return false;
		}
		
		if (debug) {
			
			var_dump($result);
		}
		
		$this->productID = $result[0]['id'];
		
		//.7a
		
		//check init date, then add offset and check date after offset
		if (!$this->checkDate($transactionData['init_date'])) {
			
			throw new Exception("init data not valid");
			return false;
		}
		$this->period = $transactionData['period'];
		//add offset (deleyaedPayment)
		$this->initialDate = date('Y-m-d', strtotime("+".$this->deleyedPayment." months", strtotime($transactionData['init_date'])));
		//var_dump($this->initialDate);
		//second check init date with deleyed payment
		
		
		//seting halfPeriodDate
		if (!$this->halfPeriodDate($this->period, $this->initialDate)) {
				
			throw new Exception("half period date abnormal");
			return false;
		}
		
		
		//.9 check initial_date and period - if is ok - prepare to transaction
		if (!$this->checkDate($this->initialDate) ||
				!$this->checkDate($this->halfPeriod)) {
					
					throw new Exception("init date or half period date not valid");
					return false;
			
		}
		//.9a check credit value - mast be >0 and numeric
		if ($transactionData['credit_value'] <= 0 || 
				!is_numeric($transactionData['credit_value']) ) {
			
					throw new Exception("credit value must be >0");
					return false;
		}
		
		
		
		$this->creditValue = $transactionData['credit_value'];
		$this->endDate($this->initialDate, $this->period);
		
		if (debug) {
			
			var_dump($this->clientID, $this->productID, $this->initialDate, $this->period, $this->endDate);
			var_dump($this->halfPeriod);
			var_dump($this->creditValue);
		}
		
		$sql = "INSERT 
				INTO clients_products
				(
				`client_id`, 
				`product_id`, 
				`init_date`, 
				`period`, 
				`end_date`, 
				`half_period`, 
				`credit_value`, 
				`user_id`,
				`deleyed_payment`
				) 
				VALUES 
				(
				'{$this->clientID}', 
				'{$this->productID}', 
				'{$this->initialDate}',
				'{$this->period}', 
				'{$this->endDate}', 
				'{$this->halfPeriod}', 
				'{$this->creditValue}', 
				'{$_SESSION['user_id']}',
				'{$this->deleyedPayment}'
				)";
		
		//.13
		
		//var_dump($sql);
		$result = parent::query($sql);
		
		if (debug) {
			
			var_dump($result);
		}
		if ($result) {
			return true;
		}
		throw new Exception("error during update db");
		
	}
	
	
	
	
	/**
	 * 
	 * @param $transactionData
	 * return true if data is difference in form and db
	 * or false is data is the same
	 */
	private function checkDifference($transactionData) {
		
		//check recived data is the same than db
		
		if (strtolower($this->clientName) != strtolower($transactionData['name']) ||
			strtolower($this->clientSurname) != strtolower($transactionData['surname']) ||
			$this->clientPhone != $transactionData['phone_nr']) {
				
				return false;
			}
			return true;
	}
	
	
	
	/**
	 * 
	 * @param unknown $date
	 * @throws Exception
	 */
	public function checkDate($date) {
		
		list($y, $m, $d) = array_pad(explode('-', $date, 3), 3, 0);
		return ctype_digit("$y$m$d") && checkdate($m, $d, $y);
	}
	
	
	
	/**
	 * 
	 * @param unknown $period
	 * @throws Exception
	 */
	public function vaidatePeriod($period) {
		
		if (is_numeric($period)) {
			return true;
		}
		
		else {
			throw new Exception("not valid period value");
			return false;
		}
		
	}
	
	
	
	/**
	 * 
	 * @param unknown $initialDate
	 * @param unknown $period
	 */
	public function endDate($initialDate, $period) {
	
		
		$endDate = date('Y-m-d', strtotime($initialDate. " + $period month"));
		$this->endDate = $endDate;
		return true;
	
	}
	
	
	
	/**
	 * 
	 * @param unknown $period
	 * @param unknown $initDate
	 */
	public function halfPeriodDate($period, $initDate) {
		$halfPeriod = intval($period / 2);
		
		if (debug) {
			
			var_dump($period);
			var_dump($halfPeriod);
		}
		$halfPeriodDate = date('Y-m-d', strtotime($initDate."+ $halfPeriod month"));
		$this->halfPeriod = $halfPeriodDate;
		return true;
		
	}
	
	
	
	/**
	 * 
	 * @param unknown $clientID
	 */
	public function getClientTransaction($clientID) {
		//var_dump($clientID);
		$sql = "SELECT
			clients_products.id,
			clients.name,
			clients.surname,
			clients.pesel,
			products.product_name,
			clients_products.init_date,
			clients_products.period,
			clients_products.credit_value
		FROM
			clients_products
		JOIN
			clients
		ON
			clients_products.client_id = clients.id
		JOIN
			products
		ON
			products.id = clients_products.product_id
		WHERE
		clients.id = '{$clientID}'";
		//AND
		//clients.id IN
		//var_dump($sql);
		//`{$key}` LIKE '%{$value}%'";
		$result = parent::query($sql);
		//var_dump($result);
		return $result;
			
	}
	
	
	
	
	/**
	 * 
	 * @param unknown $transactionID
	 */
	public function getTransaction($transactionID) {
		$sql = "SELECT
        	clients_products.id,
			clients.name,
			clients.surname,
			clients.pesel,
			products.product_name,
			clients_products.init_date,
			clients_products.period,
			clients_products.credit_value
		FROM
			clients_products
		JOIN
			clients
		ON
			clients_products.client_id = clients.id
		JOIN
			products
		ON
			products.id = clients_products.product_id
		WHERE
		clients_products.id = '{$transactionID}'";
		
		$result = parent::query($sql);
		//var_dump($result);
		return $result;
		
	}
	
	
	
	/**
	 * 
	 * @param unknown $transactionData
	 * @throws Exception
	 */
	public function updateTransaction($transactionData) {
		
		//check is given data is ok
		if (!isset(
				$transactionData['product_name'],
				$transactionData['init_date'],
				$transactionData['credit_value'],
				$transactionData['period'])) {
		
					throw new Exception("Recived data not consistent - fill properly data in input");
					return false;
				}
		
		//check init_date, period and credit is ok
		if (!$this->checkDate($transactionData['init_date'])) {
				
			throw new Exception("Date initialization not valid");
			return false;
			}
		if (!is_numeric($transactionData['period'])) {
				
			throw new Exception("Period time is not valid");
			return false;
			}
		if (!is_numeric($transactionData['credit_value'])) {
						
			throw new Exception("Credit value is not valid");
			return false;
			}
		
		//set end_date and half_period
		
		$this->endDate($transactionData['init_date'], $transactionData['period']);
		$this->halfPeriodDate($transactionData['period'], $transactionData['init_date']);
		
		//prepare sql update set
		
		$sql = "UPDATE
					clients_products
				SET
				  clients_products.product_id = '{$transactionData['product_name']}',
				  clients_products.init_date = '{$transactionData['init_date']}',
				  clients_products.credit_value = '{$transactionData['credit_value']}',
				  clients_products.period = '{$transactionData['period']}',
				  clients_products.end_date = '{$this->endDate}',
				  clients_products.half_period = '{$this->halfPeriod}'
				WHERE
					clients_products.id = '{$transactionData['id']}'
				";
		
		$result = parent::query($sql);
		
		if (empty($result)) {
			throw new Exception("Failure during edit transaction data.");
			return false;
		}
		
		return $result;
	}
	
	
	
	/**
	 * 
	 * @param unknown $transactionId
	 * @throws Exception
	 */
	public function deleteTransaction($transactionId) {
		
		$sql = "DELETE 
				FROM 
				clients_products WHERE 
				clients_products.id = '{$transactionId}'";
		
		$result = parent::query($sql);
		
		if (!$result) {
			
			throw new Exception("Error during delete transaction from database");
			return false;
		}
		
		return $result;
		
	}
	
	
	/**
	 * 
	 * @param unknown $transactionData
	 */
	public function validateExistTransaction ($transactionData) {
		
		$sql = "SELECT * 
				FROM 
				clients_products 
				JOIN 
				clients 
				ON 
				clients_products.client_id = clients.id 
				JOIN 
				products 
				ON 
				clients_products.product_id = products.id 
				WHERE 
				clients.pesel='{$transactionData['pesel']}' 
				AND 
				clients_products.credit_value = '{$transactionData['credit_value']}'
				AND
				clients_products.period = '{$transactionData['period']}'
				AND
				products.product_name = '{$transactionData['product_name']}'
				AND
				clients_products.init_date = '{$transactionData['init_date']}'
				";
		
		$result = parent::query($sql);
		
		//transactions with this parameters do not exist
		if (!$result) {
			
			return false;
		}
		
		//transactions with this parametes exist:
		
		return $result;
		
	}
	
	
	
	public function addDuplicateTransaction($insertValue) {
		
		$sql = "INSERT 
				INTO `clients_products`
				(`client_id`, `product_id`, `init_date`, `credit_value`, `period`, `end_date`, `half_period`) 
				VALUES 
				('{$insertValue['client_id']}',
				'{$insertValue['product_id']}',
				'{$insertValue['init_date']}',
				'{$insertValue['credit_value']}',
				'{$insertValue['period']}',
				'{$insertValue['end_date']}',
				'{$insertValue['half_period']}')";
		
		$result = parent::query($sql);
		
		if (!$result) {
			throw new Exception("error during add duplicate entry to database");
			return false;
		}
		return true;
	}
	
	
	
}