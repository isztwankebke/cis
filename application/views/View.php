<?php

class View extends Controller {
	private   $layout =  null;
	private   $path = null;
	private   $data = null;
	public    $contentForLayout = null;
	
	public function __construct(){
		
		
	}
	
	
	public function set($dataToPath, $dataToDisplay = null, $layout = 'default') {
		
		if (isset($layout)) {
			$this->layout = $layout.'.php';
		}
		$this->path = '../application/views/Layouts/'. $this->layout;
		$this->data = $dataToDisplay;
		$this->contentForLayout = '../application/views/'. $dataToPath. '.php';
		var_dump($this->layout);
		var_dump($this->path);
		//var_dump($this->data);
		var_dump($this->contentForLayout);
		//$path = preg_split('/Controller::/', __METHOD__);
		//var_dump($path1 = preg_split('/Controller/', __CLASS__));
		//var_dump($pat2 = __FUNCTION__);
		//$this->view = '../application/views/'. $path[0] . '/' . $path[1]. '.php';
		//var_dump($this->view);
	}
	
	public function getPath() {
		return $this->path;
	}
	
	public function render() {
		include $this->getPath();
		$contentForLayout = $this->contentForLayout;
		$data = $this->data;
	}
}