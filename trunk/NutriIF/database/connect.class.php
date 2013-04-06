<?php
require_once ('database/db.class.php');

class connect_class {
	   
	var $db = null;	
	
	function connect_class() {
   
   		$this->db = new db_class;
   
		if (!$this->db->connect('127.0.0.1', 'rhavy', '12345', 'pegadaecologica', false)){
			$this->db->print_last_error(false);
		}
	}
   
	public function database(){
   		if($this->db != null){
   			return $this->db;
   		}
	}
   
}

?>