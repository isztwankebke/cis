<?php
class Model extends mysqli {

	private static $queryLogs = [];
	
	
	
	protected $id = null;
	
	public function __construct() {

		parent::__construct('localhost', 'alojzy', 'blabla1@', 'cis_db');
		parent::set_charset('utf8');
		
		if (mysqli_connect_error()) {
			throw new Exception('Connect Error ('.mysqli_connect_errno().')'.mysqli_connect_errno());
		}
		
		//$this->id = $id;
	}


	/**
	 *
	 * @param unknown $sql
	 */
	public function query($sql) {

		self::$queryLogs[] = $sql;
		
		$result = parent::query($sql);
		
		if (empty($result)) {
			
			return false;
		}
	    //while add something to db return id
		if (preg_match('/INSERT/', $sql)) {
			
			return $this->insert_id;
		}
		
		if (preg_match('/UPDATE/', $sql)) {
			
			return $this->affected_rows;
		}
		
		if (preg_match('/DELETE/', $sql)) {
				
			return $this->affected_rows;
		}
		
		return  $result->fetch_all(MYSQLI_ASSOC);
		

	}
	
	
	
	/**
	 * 
	 * @param unknown $string
	 * @return string
	 * function change first letter to Capital, rest lowercase, after space set Capital letter
	 */
	public function setFirstLetterUppercase($string) {
		
		$FirstLetterCapital = ucwords(strtolower($string));
		
		return $FirstLetterCapital;
	}
	
	
		
	public function getQueryLog() {
		
		return self::$queryLogs;
		
	}
	
	
	
	
}
