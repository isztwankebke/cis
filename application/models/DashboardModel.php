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
		//pobrac dane nt jednego alerta
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
				transactions.id, transactions.checked, transactions.comments,
				clients.name, clients.surname, clients.phone_nr, 
				products.product_name, alerts.half_period, alerts.period_info1, alerts.last
				FROM 
				transactions 
				JOIN
				alerts
				ON
				alerts.product_id = transactions.product_id
				JOIN 
				clients 
				ON 
				transactions.client_id = clients.id 
				JOIN 
				products 
				ON 
				products.id = transactions.product_id 
				WHERE 
				transactions.init_date = '{$beginDate}'
				AND 
				transactions.product_id = '{$this->productId}'
				OR
				(alerts.half_period = 'tak'
				AND
				transactions.half_period = '{$today}'
				AND
				transactions.product_id = '{$this->productId}')
				OR
				(transactions.product_id = '{$this->productId}'
				AND
				transactions.end_date = '{$today}'
				AND
				alerts.last = 'tak')
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
		if (!isset($alertData['period_info1'])) {
			
			throw new Exception("Period Info is necessary");
			return false;
		}
		if (isset($alertData['half_period'])) {
			
			$halfPeriod = 'tak';
		}
		
		else {
			
			$halfPeriod = 'nie';
		}
		
		if (isset($alertData['last'])) {
			
			$last = 'tak';
		}
		
		else {
			$last = 'nie';
		}
		
		if (isset($alertData['has_product'])) {
			
			$hasProduct = 'tak';
		}
		
		else {
			
			$hasProduct = 'nie';
		}
		
		$sql = "INSERT 
				INTO 
				alerts 
				(`product_id`, `half_period`, `period_info1`, `week_info`, `last`, `period_next`, `has_product`, `period_info2`) 
				VALUES 
				('{$alertData['product_name']}', '{$halfPeriod}', '{$alertData['period_info1']}',
				'{$alertData['week_info']}', '{$last}', '{$alertData['period_next']}', 
				'{$hasProduct}', '{$alertData['period_info2']}')";
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




}

