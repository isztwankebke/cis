<?php
class DashboardModel extends Model {
	
	private $alertId;
	private $productId;
	private $isHalfPeriod;
	private $afterPeriodInfo1;
	private $weekBeforeInfo;
	private $isLastInstallment;
	private $afterPeriod1NextInstallment;
	private $hasProduct;
	private $afterPeriodInfo2;
	private $alertData;
	private $comments;
	private $checked;
	private $transactionID;
	
	public function __construct() {
		
		parent::__construct();
	}
	
	
	
	/**
	 * 
	 */
	public function admin_read() {
		$sql = "SELECT 
				alerts.*, products.product_name 
				FROM 
				alerts 
				JOIN 
				products 
				ON 
				alerts.product_id = products.id ";
		
		$result = parent::query($sql);
		
		return $result;
		
		
	}
	
	public function getAlert($parameters) {
		
		$sql = "SELECT
				* 
				FROM 
				alerts 
				WHERE 
				alerts.id = '{$parameters[0]}'";
		//var_dump($sql);
		$result = parent::query($sql);
		//var_dump($result);
		if (!$result) {
			return false;
		}
		return $result;
	}
	
	
	
	/**
	 * 
	 * @throws Exception
	 */
	public function index($parameters = null) {
		
		//check is any alerts set
		$sqlListAlerts = "SELECT * 
						FROM alerts 
						WHERE 1";
		$result = parent::query($sqlListAlerts);
		if (!$result) {
			throw new Exception("no defined alerts found");
		}
		//using offset parameters - needs to create reports. In normal case is equal 0 
		if (!isset($parameters['offset'])) {
			
			$offset = 0;
			
		}
		else {
			
			$offset = $parameters['offset'];
		}
		//var_dump($offset);
		if ($offset == 1 || $offset == 0) {
			//check alerts for next week
			
			$isHalfPeriodAlert = "(
				alerts.is_half_period = 1
				AND
				YEARWEEK(NOW() + INTERVAL alerts.week_before_info WEEK + INTERVAL '{$offset}' WEEK) =
				YEARWEEK(t1.half_period)
				)
				OR
				(
				alerts.after_period1_next_installment != 0
				AND
				alerts.is_half_period = 1
				AND
				YEARWEEK(NOW() + INTERVAL '$offset' WEEK) =
				YEARWEEK(t1.half_period + INTERVAL alerts.after_period1_next_installment MONTH )
				)";
			
			$afterPeriod1Info = "(
				alerts.after_period_info1 != 0
				AND
				YEARWEEK(NOW() + INTERVAL alerts.week_before_info WEEK + INTERVAL '{$offset}' WEEK) =
				YEARWEEK(t1.init_date + INTERVAL alerts.after_period_info1 MONTH)
				)
				OR
				(
				alerts.after_period_info1 !=0
				AND
				alerts.after_period1_next_installment != 0
				AND
				YEARWEEK(NOW() + INTERVAL '{$offset}' WEEK) =
				YEARWEEK(t1.init_date + INTERVAL alerts.after_period_info1 MONTH +
				INTERVAL alerts.after_period1_next_installment MONTH)
				)";
			
			$isLastInstallment = "(
				alerts.is_last_installment != 0
				AND
				YEARWEEK(NOW() + INTERVAL alerts.week_before_info WEEK + INTERVAL '{$offset}' WEEK) =
				YEARWEEK(t1.end_date)
				)
				OR
				(
				alerts.is_last_installment !=0
				AND
				alerts.after_period1_next_installment != 0
				AND
				YEARWEEK(NOW() + INTERVAL '$offset' WEEK) =
				YEARWEEK(t1.end_date + INTERVAL alerts.after_period1_next_installment MONTH)
				)";
			
			$duplicate = "
					(
					alerts.after_period_info2 != 0 
					AND 
					t1.product_id = t2.product_id 
					AND 
					t1.client_id = t2.client_id 
					AND 
					YEARWEEK(t1.init_date + INTERVAL alerts.after_period_info2 MONTH) = 
					YEARWEEK(NOW() + INTERVAL alerts.week_before_info WEEK + INTERVAL '{$offset}' WEEK) 
					AND 
					t2.half_period < NOW()
					)
				OR
					(
					alerts.after_period_info2 != 0
					AND
					alerts.after_period1_next_installment != 0
					AND
					t1.product_id = t2.product_id 
					AND 
					t1.client_id = t2.client_id 
					AND 
					YEARWEEK(t1.init_date + INTERVAL alerts.after_period_info2 MONTH +
					INTERVAL alerts.after_period1_next_installment MONTH) = 
					YEARWEEK(NOW() + INTERVAL '{$offset}' WEEK) 
					AND 
					t2.half_period < NOW()
					)";
		}
		elseif ($offset == 2) {
			//check start and end date is set
			if (empty($parameters['dateFrom']) || empty($parameters['dateTo'])) {
				
				throw new Exception("date not set. Cannot check date range!");
				return false;
			}
			//check start date is older then end date
			elseif (strtotime($parameters['dateFrom']) > strtotime($parameters['dateTo'])) {
				
				throw new Exception("start date must be older than end time");
				return false;
			}
			//settting start and end date for date range
			
			$startDate = $parameters['dateFrom'];
			$endDate = $parameters['dateTo'];
			
			$dateRange = "BETWEEN
				YEARWEEK('{$startDate}')
				AND
				YEARWEEK('{$endDate}')";
			
			//check alerts from date range
			$isHalfPeriodAlert = "(
				alerts.is_half_period = 1
				AND
				(YEARWEEK(t1.half_period - INTERVAL alerts.week_before_info WEEK) 
				{$dateRange})
				)
				OR
				(
				alerts.after_period1_next_installment != 0
				AND
				alerts.is_half_period = 1
				AND
				(YEARWEEK(t1.half_period + INTERVAL alerts.after_period1_next_installment MONTH )
				{$dateRange})
				)";
			
			$afterPeriod1Info = "(
				alerts.after_period_info1 != 0
				AND
				(YEARWEEK(t1.init_date + INTERVAL alerts.after_period_info1 MONTH - INTERVAL alerts.week_before_info WEEK)
				{$dateRange})
				)
				OR
				(
				alerts.after_period_info1 !=0
				AND
				alerts.after_period1_next_installment != 0
				AND
				(
				YEARWEEK(t1.init_date + INTERVAL alerts.after_period_info1 MONTH +
				INTERVAL alerts.after_period1_next_installment MONTH)
				{$dateRange})
				)";
				
			$isLastInstallment = "(
				alerts.is_last_installment != 0
				AND
				(
				YEARWEEK(t1.end_date - INTERVAL alerts.week_before_info WEEK)
				{$dateRange})
				)
				OR
				(
				alerts.is_last_installment !=0
				AND
				alerts.after_period1_next_installment != 0
				AND
				(
				YEARWEEK(t1.end_date + INTERVAL alerts.after_period1_next_installment MONTH)
				{$dateRange})
				)";
					
			$duplicate = "
				(
				alerts.after_period_info2 != 0
				AND
				t1.product_id = t2.product_id
				AND
				t1.client_id = t2.client_id
				AND
				(YEARWEEK(t1.init_date + INTERVAL alerts.after_period_info2 MONTH - INTERVAL alerts.week_before_info WEEK)
				{$dateRange})
				AND
				t2.half_period < '{$endDate}'
				)
				OR
				(
				alerts.after_period_info2 != 0
				AND
				alerts.after_period1_next_installment != 0
				AND
				t1.product_id = t2.product_id
				AND
				t1.client_id = t2.client_id
				AND
				(YEARWEEK(t1.init_date + INTERVAL alerts.after_period_info2 MONTH +
				INTERVAL alerts.after_period1_next_installment MONTH)
				{$dateRange})
				AND
				t2.half_period < '{$endDate}'
				)";
				
			
		}
		
		$columns = "alerts.alert_name,
				  CONCAT(clients.name, ' ', clients.surname) AS clientName,
				  clients.phone_nr,
				  clients.pesel,
				  t1.*";
		//var_dump($duplicate);
		//var_dump($isHalfPeriodAlert);
		$sql = "(#for isHalfPeriod, afterPeriod1, isLastInstallment
				SELECT 
				  {$columns}
				FROM
				  clients_products t1
				JOIN
				  clients
				ON
				  clients.id = t1.client_id
				JOIN
				  alerts
				ON
				  alerts.product_id = t1.product_id
				WHERE
				{$isHalfPeriodAlert}
				OR
				{$afterPeriod1Info}
				OR
				{$isLastInstallment}
				)
				
				UNION ALL
				
				(#for duplicate entry
				
				SELECT
					{$columns}
				FROM
					clients_products t1
				JOIN
					clients
				ON
					clients.id = t1.client_id
				LEFT JOIN
					clients_products t3
				ON
					t1.id = t3.id
				LEFT JOIN
					alerts
				ON
					t3.product_id = alerts.product_id
				LEFT JOIN
					clients_products t2
				ON
					(#for duplicate
					t1.id != t2.id)
				WHERE
					{$duplicate}	
				)";
							
			
					
					
			$result = parent::query($sql);
			
			if (debug) {
				var_dump($result);
			}
			
			if (!$result) {
				return false;
			}
			return $result;
				
	}
	
	
	
	/**
	 * 
	 * @param unknown $alertData
	 * @throws Exception
	 * @return boolean
	 */
	public function addAlert($alertData) {
		//check is data is consistent
		//check is alert exist
		//add alert
		
		
		//check alert name is set
		if (!isset($alertData['alert_name'])) {
			
			throw new Exception("Alert name is necessary");
			return false;
		}
		
		//check after_period_info1 is filed, set default 0
		if (empty($alertData['after_period_info1'])) {
			
			$afterPeriodInfo1= 0;
		}
			
		else {
			
			$afterPeriodInfo1 = $alertData['after_period_info1'];
		}
		
		//check is_half_period is set
		if (isset($alertData['is_half_period'])) {
			
			$isHalfPeriod = 1;
		}
		
		else {
			
			$isHalfPeriod = 0;
		}
		
		//check is_last_installment is set
		if (isset($alertData['is_last_installment'])) {
			
			$isLastInstallment = 1;
		}
		
		else {
			$isLastInstallment = 0;
		}
		
		//check has_product is set
		if (isset($alertData['has_product'])) {
			
			$hasProduct = 1;
		}
		
		else {
			
			$hasProduct = 0;
		}
		
		//check week_befor_info is filled, set default 0
		if (empty($alertData['week_before_info'])) {
				
			$weekBeforeInfo = 0;
		}
			
		else {
				
			$weekBeforeInfo = $alertData['week_before_info'];
		}
		
		//check after_period1_next_installment is filled, set default 0
		if (empty($alertData['after_period1_next_installment'])) {
				
			$afterPeriod1NextInstallment = 0;
		}
			
		else {
				
			$afterPeriod1NextInstallment = $alertData['after_period1_next_installment'];
		}
		
		if (empty($alertData['after_period_info2'])) {
				
			$afterPeriodInfo2 = 0;
		}
			
		else {
				
			$afterPeriodInfo2 = $alertData['after_period_info2'];
		}
		
		$sql = "INSERT 
				INTO 
				alerts 
				(`alert_name`, 
				`product_id`, 
				`is_half_period`, 
				`after_period_info1`, 
				`week_before_info`, 
				`is_last_installment`, 
				`after_period1_next_installment`, 
				`has_product`, 
				`after_period_info2`) 
				VALUES 
				('{$alertData['alert_name']}', 
				'{$alertData['product_name']}', 
				'{$isHalfPeriod}', 
				'{$afterPeriodInfo1}',
				'{$weekBeforeInfo}', 
				'{$isLastInstallment}', 
				'{$afterPeriod1NextInstallment}', 
				'{$hasProduct}', 
				'{$afterPeriodInfo2}')";
		
		//var_dump($sql);
		$result = parent::query($sql);
		
		if (!$result) {
			
			return false;
		}
		
		return $result;
		
	}

	
	public function deleteAlert($parameters) {
		
		$sql = "DELETE 
				FROM 
				`alerts` 
				WHERE 
				alerts.id = '{$parameters['id']}' ";
		$result = parent::query($sql);
		
		if (!$result) {
			
			return false;
		}
		return $result;
	}
	
	
	/**
	 * 
	 * @param unknown $day
	 * @throws Exception
	 * return entry transactions on selected day
	 */
	public function todayEntry($day = null) {
		//var_dump($day);
		if (!$day) {
			
			$date = new DateTime();
			$today = $date->format('Y-m-d');
			
		}
		else {
			$today = $day;
		}
		//var_dump($today);
		$sql = "SELECT
				  clients.name AS clientName,
				  clients.surname AS clientSurname,
				  clients.phone_nr,
				  products.product_name,
				  clients_products.init_date,
				  clients_products.period,
				  clients_products.credit_value,
				  clients_products.deleyed_payment,
				  CONCAT(users.name, ' ', users.surname) AS user
				FROM
					clients_products
				JOIN
				    clients
				ON
				    clients_products.client_id = clients.id
				JOIN
				    products
				ON
				    clients_products.product_id = products.id
				JOIN
					users
				ON
					clients_products.user_id = users.id
				WHERE
				    (DATE(clients_products.entry_date) = '{$today}')";
		
		$result = parent::query($sql);
		//var_dump($result);
		if (!$result && !empty($result)) {
			
			throw new Exception("error during reading entry from selected day");
			return false;
		}
		return [$today,$result];
	}

	public function setChecked($postData) {
		
		if (empty($postData['setChecked'])) {
			
			throw new Exception("error during update checked in Dashboard");
			return false;
		}
		
		if (empty($postData['checked'.$postData['setChecked']])) {
			
			throw new Exception("can not set to checked - checkbox not set");
			return false;
		}
		
		if (!empty($postData['comments'])) {
			
			$this->comments = $postData['comments'];
		}
		else {
			
			$this->comments = null;
		}
		$this->checked = 1;
		$this->transactionID = $postData['setChecked'];
		
		$sql = "UPDATE
				  clients_products
				SET
				  clients_products.checked = '{$this->checked}',
				  clients_products.comments = '{$this->comments}'
				WHERE
				  clients_products.id = '{$this->transactionID}'";
		
		$request = parent::query($sql);
		
		if (!$request) {
			
			throw new Exception("error during update db while set to check a transaction");
			return false;
		}
		
		return $request;
		
	}


}

