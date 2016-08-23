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
		//6. if client not exist check name and surname, phone number and extra info
		//7.if everything is ok, prepare data to begin transaction
		
		//8.check product name - if is ok prepare to transaction
		
		//9.check initial_date and period - if is ok - prepare to transaction
		
		//10.begin transaction:
		//11.add client or read parameters to get client.id
		//12.get product.id
		
		//13.add transaction: client.id, product.id, initial_date and period.
		
		//14.if clietn exist and clietn data was not consistent return true and notification else
		//return true
		
		//15.if something wrong rollback and return false
		
		
		//.3
		try {
			
		
		$client = new ClientModel();
		
		if (!$client->validatePesel($transactionData['pesel'])) {
			//.4
			throw new Exception("pesel not valid");
			return false;
			
		}
		$sql = "SELECT *
		FROM clients
		WHERE clients.pesel = '{$transactionData['pesel']}'";
		
		$result = parent::query($sql);
		var_dump($result);
		if ($result) { //client exist
			
			$this->clientID = $result[0]['id'];
			$this->clientName = $result[0]['name'];
			$this->clientSurname = $result[0]['surname'];
			$this->clientPhone = $result[0]['phone_nr'];
			$this->clientExtraInfo = $result[0]['extra_info'];
			
			//.5
			$this->checkDifference($transactionData);
			
		} //.6
		elseif (!$client->validateName($transactionData['name']) ||
				!$client->validateSurname($transactionData['surname']) ||
				!$client->validatePhoneNumber($transactionData['phone_nr']) ||
				!$client->validateExtraInfo($transactionData['extra_info'])) {
					
					throw new Exception("client data not valid");
					return false;
				}
		
		//.7
		if (!$this->clientID) { //client not exist - prepare sql to add client
			
			
			$sqlClient = "INSERT 
					INTO clients 
					(`pesel`, `name`, `surname`, `phone_nr`, `extra_info`) 
					VALUES 
					('{$transactionData['pesel']}', '{$transactionData['name']}', '{$transactionData['surname']}', 
					'{$transactionData['phone_nr']}', '{$transactionData['extra_info']}')";
			$result = parent::query($sqlClient);
			$this->clientID = $result;
			
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
		var_dump($result);
		$this->productID = $result[0]['id'];
		
		//.9
		if (!$this->validateDate($transactionData['init_date']) ||
				!$this->vaidatePeriod($transactionData['period'])) {
					
					throw new Exception("data not valid");
					return false;
			
		}
		$this->initialDate = $transactionData['init_date'];
		$this->period = $transactionData['period'];
		$this->endDate($transactionData['init_date'], $transactionData['period']);
		
		$sql = "INSERT 
				INTO transactions
				(`client_id`, `product_id`, `init_date`, `period`, `end_date`) 
				VALUES 
				('{$this->clientID}', '{$this->productID}', '{$this->initialDate}',
				'{$this->period}', '{$this->endDate}')";
		
		//.13
		$result = parent::query($sql);
		
		if ($result) {
			return true;
		}
		throw new Exception("error during update db");
		}
		catch (Exception $e) {
			echo "Caught exception: ", $e->getMessage();
		}
		
			
		
		
		
		
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
		
		if ($this->clientName != $transactionData['name'] ||
			$this->clientSurname != $transactionData['surname'] ||
			$this->clientPhone != $transactionData['phone_number'] ||
			$this->clientExtraInfo != $transactionData['extra_info']) {
				
				$this->clientDataDifference = true;
			}
			
	}
	
	
	
	/**
	 * 
	 * @param unknown $date
	 * @throws Exception
	 */
	public function validateDate ($date) {
		
		
		$today = date('Y-m-d', time());
		
		if (preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $date)) {
			
			if (strtotime($today) >= strtotime($date)) {
				return true;
			}
			else {
				throw new Exception("initial date can not be in future");
				return false;
			}
			
		}
		throw new Exception("recived date format is incorrect");
		return false;
		
	}
	
	
	
	/**
	 * 
	 * @param unknown $period
	 * @throws Exception
	 */
	public function vaidatePeriod ($period) {
		
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
	public function endDate ($initialDate, $period) {
	
		
		$endDate = date('Y-m-d', strtotime($initialDate. " + $period month"));
		$this->endDate = $endDate;
		return true;
	
	}
	
	
}