<?php
/*个人在单场比赛记录对应的slot表
 * 
 */
	class SlotsModel extends ObjectModel
	{

		protected $db=null;
		protected $table='slots';
		protected $dbName='dota2';

		public function __construct(){
			$this->db=Mysql::getIns();
		}


		/*
		 * 将数据存入数据库slot表
		 * 输入：单场记录详细数据
		 * 输出：array 自动增长的slot值 作为ability表外键
		 */
		public function save2db($arr){
			$match_id=$arr['match_id'];
			$slot=$arr['players']['player'];
			$slot_id=array();
			foreach ($slot as $key => $player) {
				$slotArr=array('match_id'=>$match_id);
				foreach ($player as $key => $value) {
					if(is_array($value)){
						continue;
					}
					$slotArr[$key]=$value;
				}
				$this->db->autoExecute($this->table,'insert',$slotArr);
				array_push($slot_id, $this->db->insertID());
			}
			return $slot_id;
		}


		/*input acc account_id
		** 		param 需要查询的字段数组
		**return slotArray 多行数据
		*/
		public function getSlot($acc,$param){
			$sql='select '.implode(',', $param).' from '.$this->table.' where account_id="'.$acc.'"';
			return $this->db->getAll($sql);
		}
		
		public function count(){
			$sql='select count(*) from '.$this->table;
			return $this->db->getOne($sql);
		}
		
	}
?>