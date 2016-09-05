<?php
class ClientModel extends Model {
	
	protected $clientData;
	protected $pesel;
	protected $name;
	protected $surname;
	protected $phoneNumber;
	protected $extraInfo;
	protected $clientID;
	
	public function __construct($id = null) {
		
		parent::__construct($id);
		
	}
	
	/**
	 * 
	 * @return ClientModel
	 */
	private function setClientData () {
		$this->clientData = array(
				"id"		 => $this->clientID,
				"pesel"		 => $this->pesel,
				"name"		 => $this->name,
				"surname"	 => $this->surname,
				"phone_nr"	 => $this->phoneNumber,
				"extra_info" => $this->extraInfo
				
		);
		return $this;
		
	}
	
	
	/**
	 * 
	 */
	public function getClientData() {
		return $this->clientData;
	}
	
	public function readClient($parameters) {
		if (debug) {
			var_dump($parameters);
		}
		$sql = "SELECT *
				FROM
				clients
				WHERE 
				clients.id = '{$parameters[0]}'";
		
		$result = parent::query($sql);
		
		if (!$result) {
			return false;
		}
		
		return $result;
				
	}
	
	
	
	/**
	 * 
	 */
	public function admin_read() {
		
		$sql = "SELECT *
		FROM
		`clients`
		WHERE 1";
		
		$result = parent::query($sql);
		
		return $result;
		
		
	}
	
	
	
	/**
	 * 
	 * @param unknown $parameters
	 * @throws Exception
	 * @return boolean
	 */
	public function editClient($parameters) {
		//check recived data is consistent
		if (!$this->checkClientData($parameters)) {
			throw new Exception("New client data not consistent");
			return false;
		}
		
		$name = parent::setFirstLetterUppercase($parameters['name']);
		$surname = parent::setFirstLetterUppercase($parameters['surname']);
		
		$sql = "UPDATE
				clients 
				SET 
				`name`='{$name}',`surname`='{$surname}',
				`phone_nr`='{$parameters['phoneNumber']}',`extra_info`='{$parameters['extraInfo']}' 
				WHERE clients.id = '{$parameters['id']}'";
		
		$result = parent::query($sql);
		
		if (!$result) {
			throw new Exception("Failure during edit client data");
			return false;
		}
		
		return $result;
	}
	
	
	
	
	public function deleteClient($parameters) {
		//get client data
		$clientData = $this->readClient($parameters);
		//get client transactions
		$transaction = new TransactionModel();
		$transactionData = $transaction->search($clientData['pesel']);
		
		if ($transactionData) {
			return $transactionData;
		}
		
		
		//check if client has a transactions
		//show transactions first
		//delete user 
	}
	
	
	/**
	 * 
	 * @param unknown $searchData
	 */
	public function search($searchData) {
		
		$key = key($searchData);
		$value = trim($searchData[$key]);
		
		
		$sql = "SELECT *
		FROM
		`clients`
		WHERE 
		`{$key}` LIKE '%{$value}%'";
		
		$result = parent::query($sql);
		
		return $result;
		
	}
	
	
	/**
	 * 
	 * @param unknown $parameters
	 * @throws Exception
	 */
	private function checkClientData ($clientData) {
		
		if (!isset($clientData['pesel'])) {
			throw new Exception("Pesel value is empty");
			return false;
		}
		if (!isset($clientData['name'])) {
			throw new Exception("Name value is empty");
			return false;
		}
		if (!isset($clientData['surname'])) {
			throw new Exception("Surname value is empty");
			return false;
		}
		if (!isset($clientData['phoneNumber'])) {
			throw new Exception("Phone number is empty");
			return false;
		}
		
		$name = $clientData['name'];
		$surname = $clientData['surname'];
		$phoneNumber = $clientData['phoneNumber'];
		$pesel = $clientData['pesel'];
		$extraInfo = $clientData['extraInfo'];
		
		//validate client data
		if ($this->validateName($name) &&
			$this->validateSurname($surname) &&
			$this->validatePhoneNumber($phoneNumber) &&
			$this->validatePesel($pesel) &&
			$this->validateExtraInfo($extraInfo)) {
				/*if validate is ok set client parameters*/
				$this->name = $name;
				$this->surname = $surname;
				$this->phoneNumber = $phoneNumber;
				$this->pesel = $pesel;
				$this->extraInfo = $extraInfo;
				return true;
		}
		else {
			throw new Exception("Client Data not Valid");
			return false;
		}
		
		return false;
		
	}
	
	
	
	
	
	
	/**
	 * @return true if client exist
	 * @return false if client not exist
	 * @param unknown $clientData
	 */
	public function checkClientExist () {
		
		$sql = "SELECT * 
		FROM 
		`clients` 
		WHERE `pesel` = '{$this->pesel}'";
		
		$result = parent::query($sql);
		
		if (empty($result)) {
			return false;
		}
		
		//setting client id, pesel, name, surname, phoneNr, extra info
		$this->clientID 	= $result[0]['id'];
		$this->pesel 		= $result[0]['pesel'];
		$this->name 		= $result[0]['name'];
		$this->surname 		= $result[0]['surname'];
		$this->phoneNumber 	= $result[0]['phone_nr'];
		$this->extraInfo 	= $result[0]['extra_info'];
		
		$this->setClientData();
		
		
		return true;
	}
	
	
	
	/**
	 * 
	 * @param unknown $parameters
	 * @throws Exception
	 */
	public function addClient ($clientData) {
		
		if (!$this->checkClientData($clientData)) {
			throw new Exception("unable to add client - client data is missing");
			return false;
		}
		
		if ($this->checkClientExist()) {
			throw new Exception("client already exist");	
		}
		
		$sql = "INSERT 
		INTO 
		`clients`
		(`pesel`, `name`, `surname`, `phone_nr`, `extra_info`) 
		VALUES 
		('{$this->pesel}', '{$this->name}', '{$this->surname}', '{$this->phoneNumber}', '{$this->extraInfo}')";
				
		$result = parent::query($sql);
		
		if (empty($result)) {
			
			throw new Exception("Error during add client", 400);
			
		}
		
		$this->clientID = $this->insert_id;
		//setting client data
		
		$this->setClientData();
		return true;
		
	}
	
	
	
	public function edit($dataToChange, $parameters) {
		/*validate recived data*/
		
		if (!isset($dataToChange['pesel'], 
				$dataToChange['name'], 
				$dataToChange['surname'],
				$dataToChange['phoneNumber'],
				$dataToChange['extraInfo'])) {
				
					throw new Exception("Recived data not set");
					return false;
				}
					
		$newPesel = $dataToChange['pesel'];
		$newName = $dataToChange['name'];
		$newSurname = $dataToChange['surname'];
		$newPhoneNumber = $dataToChange['phoneNumber'];
		$newExtraInfo = $dataToChange['extraInfo'];
		
		if (!$this->validatePesel($newPesel) ||
			!$this->validateName($newName) ||
			!$this->validateSurname($newSurname) ||
			!$this->validatePhoneNumber($newPhoneNumber) ||
			!$this->validateExtraInfo($newExtraInfo)) {
								
				throw new Exception("new data not Valid");
				return false;
								
			}
			
		$this->pesel = $newPesel;
		$this->name = parent::setFirstLetterUppercase($newName);
		$this->surname = parent::setFirstLetterUppercase($newSurname);
		$this->phoneNumber = $newPhoneNumber;
		$this->extraInfo = $newExtraInfo;
		
		//$key = key($parameters);
		$this->clientID = $parameters[1];
		
		
		$sql = "UPDATE `clients` 
		SET 
		`pesel` = '{$this->pesel}', `name` = '{$this->name}', `surname` = '{$this->surname}', 
		`phone_nr` = '{$this->phoneNumber}', `extra_info` = '{$this->extraInfo}' 
		WHERE `id` = '{$this->clientID}'";
								
		$result = parent::query($sql);
		
		if (!$result) {
			throw new Exception("Error during update database");
			return false;
		}
		
		return $this->getClientData();
		
	}
	
	
	
	/**
	 * 
	 * @param unknown $pesel
	 * @throws Exception
	 */
	public function validatePesel ($pesel) {
		//convert string int array
		//check is month and day is legal
		//check checksum
		//return true or false
		
		$arrayPesel = str_split($pesel);
		
		//check month and year mistake and length of pesel (must be 11)
		if (intval(substr($pesel, 4, 2)) > 31) {
			throw new Exception("Error in Pesel - Year is changed with day!");
			return false;
		}
		elseif (count($arrayPesel) != 11) {
			throw new Exception("Error in Pesel - wrong length - Pesel must be 11 digit lenght");
			return false;
		}
		
		
		//checksum
		$arrayWeigh = [9, 7, 3, 1];
		
		$checksum = null;
		
		for ($i = 0; $i <= 9; $i++) {
			
			$checksum = $checksum + $arrayPesel[$i] * $arrayWeigh[$i % 4];
			
		}
		$checksum = $checksum % 10;
		
		//validate checksum and control digit
		
		if ($arrayPesel[10] == $checksum) {
			
			return true;
		}
		else {
			throw new Exception("Pesel is not valid");
			return false;
		}
	}
	
	
	
	/**
	 * 
	 * @param unknown $name
	 * @throws Exception
	 * @return boolean|NULL
	 */
	public function validateName ($name) {
		
		if (preg_match('/^([A-ZĘŻÓŁŚŹĆŃa-ząęółśżźćń ])+/', $name)) {
			
			return true;
		}
		else {
			throw new Exception("Name incorrect");
			return false;
		}
	}
	
	
	
	/**
	 * 
	 * @param unknown $surname
	 * @throws Exception
	 */
	public function validateSurname ($surname) {
		
		if (preg_match('/^([A-ZĘŻÓŁŚŹĆŃa-ząęółśżźćń -])+/', $surname)) {
				
			return true;
		}
		else {
			throw new Exception("Surname incorrect");
			return false;
		}
	}
	
	
	
	/**
	 * 
	 * @param unknown $phoneNumber
	 * @throws Exception
	 */
	public function validatePhoneNumber ($phoneNumber) {
		
		if (preg_match('/^([0-9\+ ]){9,15}/', $phoneNumber)) {
			
			return true;
		}
		else throw new Exception("Phone number incorrect");
		return false;
	}
	
	
	
	/**
	 * 
	 * @param unknown $extraInfo
	 * @throws Exception
	 */
	public function validateExtraInfo ($extraInfo) {
		
		if (preg_match('/.?+/', $extraInfo)) {
			
			return true;
		}
		else {
			throw new Exception("Bad data at Extra Info form");
			return false;
		}
		
	}
	
	
}