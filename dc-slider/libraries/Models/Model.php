<?php
class Model{
	protected $_table = null;
	
	private $_wpdb,
		$_dbPrefix = null;
	
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
	@return array
	*/
	public function listData(
		$fields = array(),
		$where_clause = 1, 
		$order_by = 'id', 
		$order = 'DESC', 
		$limit = null, 
		$offset = 0
	){
		if(empty($this->_table))
			throw new Exception('The operation table is missing!');
		
		$fields = implode(',', $fields); 
		
		$results = $this->_wpdb->get_results("SELECT {$fields} FROM {$this->_table} WHERE {$where_clause} ORDER BY `{$order_by}` {$order}");
		
		//print '<pre>'; print_r($results); print '</pre>';exit;
		
		return $results;
	
	}
	/* method to retrieve one row based on the conditional clause
	@access public
	@param string where
	@return array
	*/
	public function getData($where){
		return $this->_wpdb->get_row("SELECT * FROM {$this->_table} WHERE {$where}");
	}
	
	/* method to count row based on the conditional clause
	@access public
	@param string where
	@return array
	*/
	public function countData($where = null){
		$query = is_null($where) ? "SELECT COUNT(id) FROM {$this->_table}" : 
			"SELECT COUNT(id) FROM {$this->_table} WHERE {$where}";
		
		return $this->_wpdb->get_var($query);
	}
	
	/* method to update fields based on the conditions
	@access public
	@param array data
	@param array where
	@throws Exception
	@return bool 
	*/
	public function update(array $data, array $where){
		if(!$this->_wpdb->update(
			$this->_table,
			$data,
			$where
		))
			throw new Exception('Error updating records');
		else
			return true;
	}
	
	/* method to delete row(s) on the conditions
	@access public
	@param array where
	@return bool 
	*/
	public function delete(array $where){
		return $this->_wpdb->delete($this->_table, $where);
	}
}