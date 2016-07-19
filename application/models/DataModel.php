<?php
class DataModel {
	
	public function __construct() {
		
		
	}
	
	
	
	/**
	 * method to check data expected and given
	 * @param unknown $arrayExpect
	 * @param unknown $arrayGiven
	 * @return boolean|NULL
	 */
	public function checkExpectedData ($arrayExpect, $arrayGiven) {
	
		/*replace value with keys in expect array*/
		$arrayExpect = array_flip($arrayExpect);
	
		/*compare keys in array expect and given*/
		$keysGiven = array_intersect_key($arrayExpect, $arrayGiven);
	
		if (count($keysGiven) === count($arrayExpect) ) {
				
			return true;
		}
		else {
				
			return null;
		}
	}
	
	
}