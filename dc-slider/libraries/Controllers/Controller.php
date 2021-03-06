<?php
class Controller{
	
	const DS = DIRECTORY_SEPARATOR;
	
	private $_mode;
	
	public function __construct($mode = 'admin'){
		$this->setMode($mode);
	}
	
	public function loadView($name, $vars = array(), $return = false){
		//processing variables and creating them for view to use
		foreach($vars as $var => $value){
			$$var = $value;
		}
		
		include dirname(__FILE__). self::DS. '..'. self::DS. 'Views'. self::DS. $this->_mode. self::DS. $name.'.php';
	}
	
	public function getRequest(){
		if(isset($_GET['action']))
			return $this->_mode == 'admin' ? $this->_mode . '_' . $_GET['action'] : $_GET['action'];
		else
			return null;
	}
	
	protected function redirect($action){
		 wp_redirect(admin_url('admin.php?page='. $action. '&noheader=true'));
	}
	
	protected function setMode($mode = 'admin'){
		if($mode == 'admin' || $mode = 'frontend')
			$this->_mode = $mode;
		else
			$this->_mode = 'admin';
	}
	
	public function getMode(){
		return $this->_mode;
	}
}