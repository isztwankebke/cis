<?php
class Model extends mysqli {

	private static $queryLogs = [];
	
	public function __construct() {

		parent::__construct('localhost', 'alojzy', 'blabla', 'cis_db');

		if (mysqli_connect_error()) {
			throw new Exception('Connect Error ('.mysqli_connect_errno().')'.mysqli_connect_errno());
		}
	}


	/**
	 *
	 * @param unknown $sql
	 */
	public function query($sql) {

		self::$queryLogs[] = $sql;
		
		$result = parent::query($sql);

		if (empty($result)) {
			
			var_dump($result);
			return false;
		}
	
		
		
		//$this->lastQueryResult = $result;
		return $result->fetch_all(MYSQLI_ASSOC);

	}
	
	
	
	
}
