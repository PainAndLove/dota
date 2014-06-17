<?php
/*
 * 单场记录额外表对应的Model类
 */
	class AdditionalUnitsModel extends ObjectModel
	{

		protected $db=null;
		protected $table='additional_units';
		protected $dbName='dota2';

		public function __construct(){
			$this->db=Mysql::getIns();
		}

		public function save2db(){

		}
		
		public function count(){
			$sql='select count(slot_id) from '.$this->table;
			return $this->db->getOne($sql);
		}
	}
?>