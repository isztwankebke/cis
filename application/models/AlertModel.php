<?php

class AlertModel extends Model {
	
	private $alertId;
	private $productId;
	private $halfPeriod;
	private $periodInfo1;
	private $weekInfo;
	private $last;
	private $periodNext;
	private $hasProduct;
	private $periodInfo2;
	private $alertData;
	
	public function __construct() {
		
		parent::__construct();
	}
	
	private function setAlertId($alertId) {
		$this->alertId = $alertId;
		return $this;
	}
	
	private function setProductId($productId) {
		$this->productId = $productId;
		return $this;
	}
	
	private function setHalfPeriod($halfPeriod) {
		$this->halfPeriod = $halfPeriod;
		return $this;
	}
	
	private function setPeriodInfo1($periodInfo1) {
		$this->periodInfo1 = $periodInfo1;
		return $this;
	}
	
	private function setWeekInfo ($weekInfo) {
		$this->weekInfo = $weekInfo;
		return $this;
	}
	
	private function setLast($last) {
		$this->last = $last;
		return $this;
	}
	
	private function setPeriodNext($periodNext) {
		$this->periodNext = $periodNext;
		return $this;
	}
	
	private function setHasProduct($hasProduct) {
		$this->hasProduct = $hasProduct;
		return $this;
	}
	
	private function setPeriodInfo2($periodInfo2) {
		$this->periodInfo2 = $periodInfo2;
		return $this;
	}
	
	private function getAlertId() {
		return $this->alertId;
	}
	
	private function getProductId() {
		return $this->productId;
	}
	
	private function getHalfPeriod() {
		return $this->halfPeriod;
	}
	
	private function getPeriodInfo1() {
		return $this->periodInfo1;
	}
	
	private function getWeekInfo() {
		return $this->weekInfo;
		
	}
	
	private function getLast() {
		return $this->last;
	}
	
	private function getPeriodNext() {
		return $this->periodNext;
	}
	
	private function getHasProduct() {
		return $this->hasProduct;
		
	}
	
	private function getPeriodInfo2() {
		return $this->periodInfo2;
	}
	
	
	private function setAlertData() {
		$this->alertData = array(
				'id' => $this
		);
	}




//validate recived data
//check is alert exist
//get alert

//add alert

	
	//edit alert
	
	
	
	//remove alert





}

