<?php
require_once "Controllers/Controller.php";
require_once "Models/Model.php";
require_once "Helpers/IconHelper.php";
require_once "Helpers/HtmlHelper.php";

Class Slider extends Controller{
	
	const pluginSlug = 'dc-slider';
	
	protected $_data = array();
	private $_model = stdClass;
	private $_baseDir;
	private $_allowedMIME = array('image/jpeg', 'image/png', 'image/gif'); 
	
	
	public function __construct($baseDir, $baseUrl = null){
		parent::__construct();
		
		//assigning base path
		$this->_baseDir = $baseDir;
		
		//loading model
		$this->_model = new Model('dc_slider');
		
		
		
		//assigning current basic resources dir
		$this_plugin_dir =  'dc-slider';
		$this->_data['this_plugin_dir'] = $this_plugin_dir;
		$this->_data['slug'] = self::pluginSlug;
		$this->_data['flash'] = '';
		$this->_data['IconHelper'] = new IconHelper($this->_baseDir);
		
		//executing correct method as per request. default to index of the admin
		$action = $this->getRequest();
		if(!empty($action)){
			$this->$action();
		}else
			$this->admin_index();
			
	}
	
	public function admin_index(){
		$sliders = $this->_model->listData(array('*'));
		$this->loadView('index', array_merge($this->_data, array('slug' => self::pluginSlug, 'sliders' => $sliders)));
	}
	
	public function admin_add(){
		if(isset($_POST['name']) && !empty($_POST['name'])){
			try{
				$filename = $this->_uploadImage();
				$this->_model->add(array(
							'name' => $_POST['name'] ,
							'title' => isset($_POST['title']) ? $_POST['title'] : null,
							'sub_title' => isset($_POST['sub_title']) ? $_POST['sub_title'] : null,
							'img' => $filename,
							'created_on' => date('Y-m-d H:i:s'),
						)
				);
				$this->_data['flash'] = "Slider added successfully";
			}catch(Exception $e){
				$this->_data['flash'] = $e->getMessage(); 
			}
		}
		$this->loadView('add', $this->_data);
	}
	
	public function admin_edit(){
		$item_id = (isset($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : 0;
		
		if(isset($_POST['updateslider']) && isset($_POST['id']) && !empty($_POST['id'])){
			$data = array(
				'name' => $_POST['name'] ,
				'title' => isset($_POST['title']) ? $_POST['title'] : null,
				'sub_title' => isset($_POST['sub_title']) ? $_POST['sub_title'] : null,
				'modified_on' => date('Y-m-d H:i:s'),
			);
			$this->_data['flash'] = '';
			
			if(isset($_FILES['img']['name']) && !empty($_FILES['img']['name'])){
				try{
					$data['img'] = $this->_uploadImage();
					
					//removing old image
					if(isset($_POST['oldimg']))
						$this->_removeImage($_POST['oldimg']);
					
				}catch(Exception $e){
					$this->_data['flash'] = $e->getMessage();
				}
			}
			if($this->_model->update(
				$data,
				array('id' => $item_id)
			))
				$this->_data['flash'] .= "Slide updated successfully!";
			else
				$this->_data['flash'] .= "Slide update failure!";
			
		}
		
		if($this->_model->countData("id = '{$item_id}'")){
			$this->_data['row'] = $this->_model->getData("id = '{$item_id}'");
		}else
			$this->_data['flash'] = "The requested item could not be found!";	
		
		$this->loadView('edit', $this->_data);
	}
	
	public function admin_active(){
		$item_id = (isset($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : 0;
		
		$status = isset($_GET['status']) ? $_GET['status'] : 0;
		
		if($this->_model->countData("id = '{$item_id}'")){
			try{
				$this->_model->update(
					array('active' => $status),
					array('id' => $item_id)
				);
			
				$this->_data['flash'] = $status ? "Item activated successfully" : "Item deactivated successfully";
				//$this->redirect('index');
			}catch(Exception $e){
				$this->_data['flash'] = $e->getMessage();
			}
		}else
			$this->_data['flash'] = "The requested item could not be found!";
		
		$this->admin_index();
	}
	
	public function admin_delete(){
		$item_id = (isset($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : 0;
		
		if($this->_model->countData("id = '{$item_id}'")){
			$filename = $this->_model->getData("id = '{$item_id}'")->img;
			if($this->_removeImage($filename) && $this->_model->delete(array('id' => $item_id))){
				$this->_data['flash'] = "The slide deleted successfully!";
			}else
				$this->_data['flash'] = "The slide not deleted successfully!";
			
			$this->admin_index();
		}
	}
	
	private function _uploadImage(){
		if(isset($_FILES['img']['name']) && $_FILES['img']['error'] == UPLOAD_ERROR_OK){
				if(in_array($_FILES['img']['type'], $this->_allowedMIME)){
					$filename = time(). '_'. $_FILES['img']['name'];
					if(move_uploaded_file(
						$_FILES['img']['tmp_name'], 
						$this->_baseDir. parent::DS. 'assets'. parent::DS. 'uploads'. parent::DS. $filename
					))
						return $filename;
					else
						throw new Exception('Moving file to the asset directory was failed');
				}else
					throw new Exception('The file uploaded was not supported. Please consider uploading .jpg, .png');
		}else
			throw new Exception('Uploading file got error.');
						
	}
	
	private function _removeImage($filename){
		$image = $this->_baseDir. parent::DS. 'assets'. parent::DS. 'uploads'. parent::DS. $filename;
		
		if(file_exists($image) && !is_dir($image)){
			unlink($image);
			return true;
		}else
			return false;
	}
}