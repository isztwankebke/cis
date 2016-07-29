<?php

include_once 'DataModel.php';

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
	 * @param unknown $pesel
	 */
	private  function setPesel ($pesel) {
		$this->pesel = $pesel;
		return $this;
	}
	
	
	
	/**
	 * 
	 * @param unknown $name
	 */
	private function setName ($name) {
		$this->name = $name;
		return $this;
	}
	
	
	
	/**
	 * 
	 * @param unknown $surname
	 */
	private function setSurname ($surname) {
		$this->surname = $surname;
		return $this;
	}
	
	
	
	/**
	 * 
	 * @param unknown $phoneNumber
	 */
	private function setPhoneNumber ($phoneNumber) {
		$this->phoneNumber = $phoneNumber;
		return $this;
	}
	
	
	
	/**
	 * 
	 * @param unknown $extraInfo
	 */
	private function setExtraInfo ($extraInfo) {
		$this->extraInfo = $extraInfo;
		return $this;
	}
	
	
	
	/**
	 * 
	 * @param unknown $clientID
	 */
	private function setClientID ($clientID) {
		$this->clientID = $clientID;
	}
	
	
	
	/**
	 * 
	 * @return ClientModel
	 */
	private function setClientData () {
		$this->clientData = array(
				"id"		 => $this->getClientId(),
				"pesel"		 => $this->getPesel(),
				"name"		 => $this->getName(),
				"surname"	 => $this->getSurname(),
				"phone_nr"	 => $this->getPhoneNumber(),
				"extra_info" => $this->getExtraInfo()
				
		);
		return $this;
		
	}
	
	
	
	/**
	 * 
	 * @return unknown
	 */
	private function getPesel() {
		return $this->pesel;
	}
	
	
	
	/**
	 * 
	 * @return unknown
	 */
	private function getName() {
		return $this->name;
	}
	
	
	
	/**
	 * 
	 * @return unknown
	 */
	private function getSurname() {
		return $this->surname;
	}
	
	
	
	/**
	 * 
	 * @return unknown
	 */
	private function getPhoneNumber() {
		return $this->phoneNumber;
	}
	
	
	
	/**
	 * 
	 * @return unknown
	 */
	private function getExtraInfo() {
		return $this->extraInfo;
	}
	
	
	
	/**
	 * 
	 * @return unknown|boolean
	 */
	private function getClientId() {
		return $this->clientID;
	}
	
	
	
	/**
	 * 
	 */
	public function getClientData() {
		return $this->clientData;
	}
	
	
	
	/**
	 * 
	 * @param unknown $parameters
	 * @throws Exception
	 */
	public function getClient ($parameters) {
		
		/*validate recived data*/
		$dataToCheck = [
				'name',
				'surname',
				'phoneNumber',
				'pesel'
		];
		
		$checkData = new DataModel();
		
		$dataValidate = $checkData->validateRecivedData($dataToCheck, $parameters);
		
		/*validate name, surname, phone number, pesel, and extra info*/
		if ($dataValidate) {
			
			$name = $parameters['name'];
			$surname = $parameters['surname'];
			$phoneNumber = $parameters['phoneNumber'];
			$pesel = $parameters['pesel'];
			
			if (array_key_exists('extraInfo', $parameters)) {
				$extraInfo = $parameters['extraInfo'];
			}
			
			if ($this->validateName($name) &&
				$this->validateSurname($surname) &&
				$this->validatePhoneNumber($phoneNumber) &&
				$this->validatePesel($pesel) &&
				$this->validateExtraInfo($extraInfo)) {
					
					/*if validate is ok set client parameters*/
					$this->setName($name);
					$this->setSurname($surname);
					$this->setPhoneNumber($phoneNumber);
					$this->setPesel($pesel);
					$this->setExtraInfo($extraInfo);
					
					/*check if client exist in db*/
					
					if (!$this->checkClientExist()) {
						
						return $this->addClient();
						
					}
					else {
						return $this->getClientData();
					}
					
				}
			
		}
		else {
			throw new Exception("excepted client data not valid");
			return false;
		}
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
		WHERE `pesel` = '{$this->getPesel()}'";
		
		$result = parent::query($sql);
		
		if (empty($result)) {
			return false;
		}
		
		//setting client id, pesel, name, surname, phoneNr, extra info
		$clientID = $result[0]['id'];
		$pesel = $result[0]['pesel'];
		$name = $result[0]['name'];
		$surname = $result[0]['surname'];
		$phoneNumber = $result[0]['phone_nr'];
		$extraInfo = $result[0]['extra_info'];
		
		$this->setClientID($clientID);
		$this->setPesel($pesel);
		$this->setName($name);
		$this->setSurname($surname);
		$this->setPhoneNumber($phoneNumber);
		$this->setExtraInfo($extraInfo);
		
		//setting clientData
		
		$this->setClientData();
		
		
		return true;
	}
	
	
	
	/**
	 * 
	 * @param unknown $parameters
	 * @throws Exception
	 */
	public function addClient () {
		
		$sql = "INSERT 
		INTO 
		`clients`
		(`pesel`, `name`, `surname`, `phone_nr`, `extra_info`) 
		VALUES 
		('{$this->getPesel()}', '{$this->getName()}', '{$this->getSurname()}', '{$this->getPhoneNumber()}', '{$this->getExtraInfo()}')";
				
		$result = parent::query($sql);
		
		if (empty($result)) {
			
			throw new Exception("Error during add client", 400);
			
		}
		
		$clientID = $this->insert_id;
		$this->setClientID($clientID);
		//setting client data
		$this->setClientData();
		return true;
		
	}
	
	
	
	public function editClient ($parameters) {
		/*validate recived data*/
		$dataToCheck = [
				'name',
				'surname',
				'phoneNumber',
				'pesel',
				'extraInfo'
		];
		
		$checkData = new DataModel();
		
		$dataValidate = $checkData->validateRecivedData($dataToCheck, $parameters);
		
		if ($dataValidate) {
			
			$name = $parameters['name'];
			$surname = $parameters['surname'];
			$phoneNumber = $parameters['phoneNumber'];
			$pesel = $parameters['pesel'];
			$extraInfo = $parameters['extraInfo'];
			
		
			//recived data is valid
			//validate data as pesel, name, surname, phone nr, extra info
			
			if ($this->validateName($name) &&
					$this->validateSurname($surname) &&
					$this->validatePhoneNumber($phoneNumber) &&
					$this->validatePesel($pesel) &&
					$this->validateExtraInfo($extraInfo)) {
						$this->setName($name);
						$this->setSurname($surname);
						$this->setPhoneNumber($phoneNumber);
						$this->setPesel($pesel);
						$this->setExtraInfo($extraInfo);
						//check is client exist
						if (!$this->checkClientExist()) {
							throw new Exception("client does not exist in Db");
							return false;
						}
						
						//check if data is different
						if ($name != $this->getName() ||
							$surname != $this->getSurname() ||
							$phoneNumber != $this->getPhoneNumber() ||
							$extraInfo != $this->getExtraInfo()) {
								
								$sql = "UPDATE 
										`clients` 
										SET 
										`name` = '{$name}', `surname` = '{$surname}', `phone_nr` = '{$phoneNumber}', `extra_info` = '{$extraInfo}' 
										WHERE `pesel` = '{$pesel}'";
								
								$result = parent::query($sql);
								
								if (!$this->affected_rows) {
									throw new Exception("error during update db");
									return false;
								}
								
								$this->setName($name);
								$this->setSurname($surname);
								$this->setPhoneNumber($phoneNumber);
								$this->setExtraInfo($extraInfo);
								$this->setClientData();
								
								return true;
							}
						//klient jest w bazie
						//dane obiektu to dane z bazy, dane do zmiany to zmienne
						//porównamy, ktore dane sie zmieniły i je zupdatujemy, 
						//po czym zwrócimy client data z updatewanymi zmianami
					}
		}
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
			return null;
		}
		elseif (count($arrayPesel) != 11) {
			throw new Exception("Error in Pesel - wrong length - Pesel must be 11 digit lenght");
			return null;
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
			return null;
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
			return null;
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
			return null;
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
		return null;
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
			return null;
		}
		
	}
	
	
}