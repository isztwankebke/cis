<?php
class DataModel {
	
	public function __construct() {
		
		
	}
	
	
	
	/**
	 * 
	 * @param unknown $parametersToCheck
	 * @param unknown $recivedData
	 * @throws Exception
	 */
	public function validateRecivedData ($parametersToCheck, $recivedData) {
		
		$j = 0;
		
		for ($i = 0; $i < count($parametersToCheck); $i++) {
			if (isset($recivedData[$parametersToCheck[$i]])) {
				$j++;
			}
			
		}
		
		if ($j != 0) {
			
			return true;
		}
		else {
			throw new Exception("recived data not consistent");
		}
		
	}
	
	
	
	
	
	
}