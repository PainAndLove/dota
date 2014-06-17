<?php
/*玩家表对应的Model
 * 
 */
	class UserModel extends ObjectModel{
		
		protected $db=null;
		protected $table='users';
		protected $dbName='dota2';
		protected $per_update=7200;
		
		public function __construct(){
			$this->db=Mysql::getIns();
		}
		/*
		 * 保存用户
		 * 仅仅记录用户名
		 */
		public function save2db($acc){
			$sql='insert into '.$this->table.'(account_id) values("'.$acc.'")';
			$this->db->query($sql);
		}

		/*input account_id
		**return true or false
		*/
		public function inDB($account_id){
			$sql='select count(account_id) from users where account_id='.$account_id;
			return $this->db->getOne($sql);
		}
		
		public function count(){
			$sql='select count(account_id) from '.$this->table;
			return $this->db->getOne($sql);
		}
		
		/*
		 * 获取所有玩家中需要更新的玩家
		 * 每隔2小时更新一次
		 * unix_timestamp(now())
		 */
		public function getUpdate(){			
			$sql='select account_id from '.$this->table.' where unix_timestamp(now())-update_time>'.$this->per_update;
			return $this->db->getAll($sql);
		}
		
		/*
		 * 更新玩家数据 包括昵称和更新时间
		 * 输入：array param 放入需要更新的键值对
		 */
		public function setUpdate($param,$where){
			return $this->db->autoExecute($this->table, 'update', $param,$where);
		}
		/*
		 * 获取字段信息
		 * 输入：array  param 想要获取的字段信息
		 */
		public function get($acc,$param){
			if(!$this->inDB($acc)){
				return 0;
			}
			$sql='';
			if(is_array($param)){
				$sql='select '.implode(',', $param).' from '.$this->table.' where account_id='.$acc;
				return $this->db->getRow($sql);
			}else{
				$sql='select '.$param.' from '.$this->table.' where account_id='.$acc;
				return $this->db->getOne($sql);
			}
			return -1;
		}
		
	}
	
?>