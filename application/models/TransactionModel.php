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
					transactions.id,
					clients.name, 
					clients.surname, 
					clients.pesel, 
					clients.phone_nr, 
					products.product_name, 
					transactions.init_date, 
					transactions.period,
					transactions.credit_value,
					clients.extra_info						
				FROM 
					transactions
				JOIN
					clients
				ON 
					transactions.client_id = clients.id
				JOIN
					products
				ON
					products.id = transactions.product_id
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
		//5.if client exist check the name, surname and phone number is the same if not use old value, and give notification
		//that need to change data in database
		//5a. get extra_info and add new one on the end of old value
		//6. if client not exist check name and surname, phone number and extra info
		//7.if everything is ok, prepare data to begin transaction
		//7a.prepare halfperiod date
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
			//.1 check is post data is consistent
			
			
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
			
		$client = new ClientModel();
		
		//.4 check pesel is valid
		if (!$client->validatePesel($transactionData['pesel'])) {
		
			throw new Exception("pesel not valid");
			return false;
		}
		
		
		$sql = "SELECT *
		FROM clients
		WHERE clients.pesel = '{$transactionData['pesel']}'";
		
		$result = parent::query($sql);
		
		if (debug) {
			
			var_dump($result);
		}
		
		if ($result) { //client exist
			
			$this->clientID = $result[0]['id'];
			$this->clientName = $result[0]['name'];
			$this->clientSurname = $result[0]['surname'];
			$this->clientPhone = $result[0]['phone_nr'];
			$this->clientExtraInfo = $result[0]['extra_info'];
			
			//.5
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
		
		
		//.7
		if (!$this->clientID) { //client not exist - prepare sql to add client
			
			
			$sqlClient = "INSERT 
					INTO clients 
					(`pesel`, `name`, `surname`, `phone_nr`, `extra_info`) 
					VALUES 
					('{$transactionData['pesel']}', '{$name}', '{$surname}', 
					'{$transactionData['phone_nr']}', '{$transactionData['extra_info']}')";
			$result = parent::query($sqlClient);
			
			if (debug) {
				
				var_dump($result);
			}
			
			$this->clientID = $result;
			
		}
		//.7a
		if (!$this->halfPeriodDate($transactionData['period'], $transactionData['init_date'])) {
			
			throw new Exception("half period date abnormal");
			return false;
		}
		//.8
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
		
		//.9
		if (!$this->checkDate($transactionData['init_date']) ||
				!$this->vaidatePeriod($transactionData['period'])) {
					
					throw new Exception("data not valid");
					return false;
			
		}
		//.9a
		if ($transactionData['credit_value'] <= 0 || 
				!is_numeric($transactionData['credit_value']) ) {
			
					throw new Exception("credit value must be >0");
					return false;
		}
		
		$this->initialDate = $transactionData['init_date'];
		$this->period = $transactionData['period'];
		$this->creditValue = $transactionData['credit_value'];
		$this->endDate($transactionData['init_date'], $transactionData['period']);
		
		if (debug) {
			
			var_dump($this->clientID, $this->productID, $this->initialDate, $this->period, $this->endDate);
			var_dump($this->halfPeriod);
			var_dump($this->creditValue);
		}
		
		$sql = "INSERT 
				INTO transactions
				(`client_id`, `product_id`, `init_date`, `period`, `end_date`, `half_period`, `credit_value`) 
				VALUES 
				('{$this->clientID}', '{$this->productID}', '{$this->initialDate}',
				'{$this->period}', '{$this->endDate}', '{$this->halfPeriod}', '{$this->creditValue}')";
		
		//.13
		$result = parent::query($sql);
		
		if (debug) {
			
			var_dump($result);
		}
		if ($result) {
			return true;
		}
		throw new Exception("error during update db");
		/*}
		catch (Exception $e) {
			echo "Caught exception: ", $e->getMessage();
		}
		*/
			
		
		
		
		
/*		
		$transactionParameters = $this->getTransactionParameters($parameters);
		
		if (!$transactionParameters) {
			throw new Exception("wrong parameters");
			return false;
		}
		
		$clientID = $clientData['id'];
		$productID = $productData['id'];
		
		$this->setClientID($clientID);
		$this->setProductID($productID);
		
		$sql = "INSERT 
		INTO `transactions`
		(`client_id`, `product_id`, `init_date`, `period`, `end_date`) 
		VALUES 
		('{$this->getClientID()}', '{$this->getProductID()}', '{$this->getInitialDate()}', '{$this->getPeriod()}', '{$this->getEndDate()}')";
		
		$result = parent::query($sql);
		
		if (empty($result)) {
			throw new Exception("can not add transaction to db");
			return false;
			
		}
		$transactionID = $this->insert_id;
		$this->setTranasactionID($transactionID);
		$this->setTransactionData();
		
		return true;
			*/
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
			transactions.id,
			clients.name,
			clients.surname,
			clients.pesel,
			products.product_name,
			transactions.init_date,
			transactions.period,
			transactions.credit_value
		FROM
			transactions
		JOIN
			clients
		ON
			transactions.client_id = clients.id
		JOIN
			products
		ON
			products.id = transactions.product_id
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
        	transactions.id,
			clients.name,
			clients.surname,
			clients.pesel,
			products.product_name,
			transactions.init_date,
			transactions.period,
			transactions.credit_value
		FROM
			transactions
		JOIN
			clients
		ON
			transactions.client_id = clients.id
		JOIN
			products
		ON
			products.id = transactions.product_id
		WHERE
		transactions.id = '{$transactionID}'";
		
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
					transactions
				SET
				  transactions.product_id = '{$transactionData['product_name']}',
				  transactions.init_date = '{$transactionData['init_date']}',
				  transactions.credit_value = '{$transactionData['credit_value']}',
				  transactions.period = '{$transactionData['period']}',
				  transactions.end_date = '{$this->endDate}',
				  transactions.half_period = '{$this->halfPeriod}'
				WHERE
					transactions.id = '{$transactionData['id']}'
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
				transactions WHERE 
				transactions.id = '{$transactionId}'";
		
		$result = parent::query($sql);
		
		if (!$result) {
			
			throw new Exception("Error during delete transaction from database");
			return false;
		}
		
		return $result;
		
	}
	
	
	
}