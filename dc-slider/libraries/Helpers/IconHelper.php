<?php
class IconHelper{
	
	const DS = DIRECTORY_SEPARATOR;
	protected $_assetDir;

	
	public function __construct(){
		$this->_assetDir = plugins_url('images/wordpress.png', dirname(__FILE__) . self::DS . '..'. self::DS);
	}
	
	public function drawIcon($icon){
		var_dump($this->_assetDir);
	}
}