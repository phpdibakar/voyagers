<?php
require_once "Controllers/Controller.php";
require_once "Models/Model.php";
require_once "Helpers/IconHelper.php";

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
		$this->_data['IconHelper'] = new IconHelper();
		
		//executing correct method as per request. default to index of the admin
		$action = $this->getRequest();
		if(!empty($action)){
			$this->$action();
		}else
			$this->admin_index();
			
	}
	
	public function admin_index(){
		//echo '<pre>'. print_r($_REQUEST); echo '</pre>';
		//echo '<pre>'. print_r( plugins_url('images/add.png', __FILE__)); echo '</pre>';
		$sliders = $this->_model->listData(array('*'));
		$this->loadView('index', array_merge($this->_data, array('slug' => self::pluginSlug, 'sliders' => $sliders)));
	}
	
	public function admin_add(){
		if(isset($_POST['name']) && !empty($_POST['name'])){
			//var_dump($this->_baseDir);
			if(isset($_FILES['img']['name']) && $_FILES['img']['error'] == UPLOAD_ERROR_OK){
				if(in_array($_FILES['img']['type'], $this->_allowedMIME)){
					$filename = time(). '_'. $_FILES['img']['name'];
					if(move_uploaded_file($_FILES['img']['tmp_name'], 
						$this->_baseDir. parent::DS. 'assets'. parent::DS. 'uploads'. parent::DS. $filename)
					){
						//echo "<pre>"; print_r($_POST);
						//echo "<pre>"; print_r($_FILES);
						try{
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
				}else{
					$this->_data['flash'] .= "The uploaded file types are not supported";
				}
			}
			
		}
		$this->loadView('add', $this->_data);
	}
}