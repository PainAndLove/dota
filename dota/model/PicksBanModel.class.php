<?php
/*
 * 职业比赛中的BanPick表
 */
	class PicksBanModel extends ObjectModel{
		protected $db=null;
		protected $table='picks_bans';
		protected $dbName='dota';
		
		public function __construct(){
			$this->db=Mysql::getIns();
		}
		
		public function count(){
			$sql='select count(id) from '.$this->table;
			return $this->db->getOne($sql);
		}
	}
?>