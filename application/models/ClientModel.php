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
	
	
	
	public function read($tableName) {
		
		$sql = "SELECT *
		FROM
		`{$tableName}`
		WHERE 1";
		
		$result = parent::query($sql);
		
		if (empty($result)) {
			return false;
		}
		
		return $result;
		
		
	}
	
	public function search($parameters) {
		$this->pesel = $parameters[1];
		
		if (!$this->validatePesel($this->pesel)) {
			throw new Exception("pesel not valid");
		}
		
		$sql = "SELECT *
		FROM
		`clients`
		WHERE 
		`pesel` = '{$this->pesel}'";
		
		$result = parent::query($sql);
		
		if (empty($result)) {
			return false;
		}
		
		return $result;
		
	}
	
	
	/**
	 * 
	 * @param unknown $parameters
	 * @throws Exception
	 */
	private function checkClientData ($clientData) {
		echo "sprawdzam dane klienta";
		if (
			isset( //check is data in post exist
				$clientData['pesel'], 
				$clientData['name'], 
				$clientData['surname'],
				$clientData['phoneNumber'],
				$clientData['extraInfo'])) {
					
					echo "dane sa isset";
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
									
							echo "dane validate";
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
		echo "jestem w add client";
		if (!$this->checkClientData($clientData)) {
			throw new Exception("unable to add client - client data is missing");
		}
		echo "client data - ok";
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
		var_dump($result);
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
			echo "pesel ok";
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