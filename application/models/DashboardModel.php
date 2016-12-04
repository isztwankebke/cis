<?php
class DashboardModel extends Model {
	
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
	public function index() {
		
		
		$sqlListAlerts = "SELECT * 
						FROM alerts 
						WHERE 1";
		$result = parent::query($sqlListAlerts);
		if (!$result) {
			throw new Exception("no defined alerts found");
		}
		$nrAlerts = count($result) - 1;
		if (debug) {
			var_dump($nrAlerts);
			var_dump($result);
		}
		$found = [];
		foreach ($result as $alert) {
			
			$this->productId = $alert['product_id'];
			$this->halfPeriod = $alert['half_period'];
			$this->periodInfo1 = $alert['period_info1'];
			$this->weekInfo = $alert['week_info'];
			$this->last = $alert['last'];
			$this->periodNext = $alert['period_next'];
			$this->hasProduct = $alert['has_product'];
			$this->periodInfo2 = $alert['period_info2'];
			
			//beginDate - date when start informing DateInitial+periodInfo1+weekInfo
			//end Date - date when stop informing DateInitial+periodInfo1
			//nr of installment = offset in month
			//dayOffset - 1 day
			//weekOffset - nr of weeks from alerts
			
			$start = new DateTime();
			$end = new DateTime();
			$now = new DateTime();
			$today = $now->format('Y-m-d');
			
			$offsetperiodInfo1 = $this->periodInfo1;
			$weekOffset = $this->weekInfo;
			
			if (!debug) {
				echo "offset period and week are:";
				var_dump($offsetperiodInfo1);
				var_dump($weekOffset);
				
			}
			
			$endDate = $end->sub(new DateInterval('P'.$offsetperiodInfo1.'M'));
			$beginDate = $start->sub(new DateInterval('P'.$offsetperiodInfo1.'M'.$weekOffset.'W'));
			
			$finishDate = $end->format('Y-m-d');
			$beginDate = $start->format('Y-m-d');
			
			if (debug) {
				var_dump($finishDate, $beginDate);
				var_dump($this->periodInfo1);
				var_dump($this->productId);
			}
			
			$sql = "SELECT 
				clients_products.id, clients_products.checked, clients_products.comments,
				clients.name, clients.surname, clients.phone_nr, 
				products.product_name, alerts.is_half_period, alerts.after_period_info1, alerts.is_last_installment
				FROM 
				clients_products 
				JOIN
				alerts
				ON
				alerts.product_id = clients_products.product_id
				JOIN 
				clients 
				ON 
				clients_products.client_id = clients.id 
				JOIN 
				products 
				ON 
				products.id = clients_products.product_id 
				WHERE 
				clients_products.init_date = '{$beginDate}'
				AND 
				clients_products.product_id = '{$this->productId}'
				OR
				(alerts.is_half_period = '1'
				AND
				clients_products.half_period = '{$today}'
				AND
				clients_products.product_id = '{$this->productId}')
				OR
				(clients_products.product_id = '{$this->productId}'
				AND
				clients_products.end_date = '{$today}'
				AND
				alerts.is_last_installment = '1')
				"; 
			
			$result = parent::query($sql);
			if (debug) {
				var_dump($result);
			}
			
			if ($result) {
				foreach ($result as $find) {
					array_push($found, $find);
				}	
			}
			
			
			
		}
		if (debug) {
			var_dump($found);
		}
		return $found;
		
		
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
		
		var_dump($sql);
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




}

