<?php
class Model{
	protected $_table = null;
	
	private $_wpdb = stdClass;
	private $_dbPrefix = null;
	
	public function __construct($tableName){
		global $wpdb;
		$this->_wpdb = $wpdb;
		$this->dbPrefix = $this->_wpdb->prefix;
		$this->_table = $this->dbPrefix . $tableName;
	}
	
	public function add($data = array(), $table_name = null){
		
		if(empty($table_name))
			$table_name = $this->_table;
		
		if(!$this->_wpdb->insert($table_name, $data)){
			throw new Exception('Error in inserting records');
		}else{
			return $this->_wpdb->insert_id;
		}
	}
	
	public function from($table_name){
		$this->_table = $this->dbPrefix . $table_name; 
	}
	
	/* method to list all records based on the optional parameters
	@access public
	@param array fields
	@param string
	@throws Exception
	@return var array
	*/
	public function listData(
		$fields = array(),
		$where_clause = null, 
		$order_by = null, 
		$order = 'ASC', 
		$limit = null, 
		$offset = 0
	){
		if(empty($this->_table))
			throw new Exception('The operation table is missing!');
		
		$fields = implode(',', $fields); 
		
		$results = $this->_wpdb->get_results("SELECT {$fields} FROM {$this->_table}");
		
		//print '<pre>'; print_r($results); print '</pre>';exit;
		
		return $results;
	
	}
}