<?php
class ReportsController extends Controller {

	/**
	 *
	 * @param Request $request
	 */
	function __construct(Request $request) {

		parent::__construct($request);
		parent::sessionTimeout();
		parent::isLogged();
		
	}
	
	
	
	/**
	 * 
	 */
	public function index() {
		try {
			
			$layout = parent::isSupervisor();
			$view = new View();
			$report = new DashboardModel();
			
			if ($this->request->isGet()) {
				
				$view->set('Reports/index', null, $layout);
					
			}
			elseif ($this->request->isPost()) {
				
				$parameters = $this->request->getPostData();
				//var_dump($parameters);
				
				if (isset($parameters['generateReport'])) {
				
					$reports = $report->index($parameters);
					//var_dump($reports);					
				}
				elseif (isset($parameters['createCSV'])) {
					
					$reports = $report->createCSV($parameters);
					
				}
				elseif (isset($parameters['exportPhoneNr'])) {
					
					$reports = $report->exportPhoneNr($parameters);
					
				}
				
				
				$view->set('Reports/index', $reports, $layout);
					
			}
			
			$view->render();
		}
		catch (Exception $e) {
			echo "Exception: ", $e->getMessage();
		}
		
	}
	
	
	
	public function exportReport() {
		
		$layout = parent::isSupervisor();
		$view = new View();
		$export = new ReportModel();
		
		
		if ($this->request->isPost()) {
			
			$reportData = $this->request->getPostData();
			$exportData = $export->exportToFile($reportData);
			$view->set('Reports/index', null, $layout);
		}
		
		$view->render();
	}
	
	
	
}