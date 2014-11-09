<?php
class IconHelper{
	
	const DS = DIRECTORY_SEPARATOR;
	const ASSET_DIR = 'assets/';
	
	protected $_baseDir;
	
	public function __construct($baseDir){
		$this->_baseDir = $baseDir;
	}
	
	public function drawIcon($icon){
		return HtmlHelper::image($this->_getIcon($icon));
	}
	
	private function _getIcon($name){
		switch($name){
			case 'active':
				$icon = 'img/active.png';
				break;
			case 'inactive':
				$icon = 'img/inactive.png';
				break;
			case 'edit':
				$icon = 'img/edit.png';
				break;
			case 'delete':
				$icon = 'img/delete.png';
				break;
			case 'view':
				$icon = 'img/view.png';
				break;
			default:
				$icon = 'img/unknown.png';
		}
		
		return plugins_url($this->_getAssetPath(). $icon, $this->_baseDir);
	}
	
	private function _getAssetPath(){
		return Slider::pluginSlug . '/' . self:: ASSET_DIR;
	}
}