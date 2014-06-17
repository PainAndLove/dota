<?php
/*
 * 技能成长对应的Model类
 */
	class AbilityUpgradesModel extends ObjectModel
	{		
		protected $db=null;
		protected $table='ability_upgrades';
		protected $dbName='dota2';

		public function __construct(){
			$this->db=Mysql::getIns();
		}


		/*
		 * 将数组存入表内
		 * 输入：原始数据  +  slot_id外键
		 */
		public function save2db($arr,$slot_id_arr){
			
				$slot=$arr['players']['player'];
				foreach ($slot as $key => $player) {
					$slot_id=array_shift($slot_id_arr);
					//构造表的第一行。重复利用
					$abilityData=array('slot_id'=>$slot_id);
					$ability=$player['ability_upgrades']['ability'];

					//slot_id需要重复使用多次 因此需要保留abiliData
					foreach ($ability as $key => $value) {
						$data=array_merge($abilityData,$value);
						$this->db->autoExecute($this->table,'insert',$data);
					}
				}
		}

		/*input slot_id
		**		param 需要查询的字段数组
		**return 
		*/
		public function getAbility($slot_id,$param){
			$sql='select '.implode(',', $param).' from '.$this->table.' where slot_id="'.$slot_id.'"';
			return $this->db->getAll($sql);
		}
		
		public function count(){
			$sql='select count(*) from '.$this->table;
			return $this->db->getOne($sql);
		}

	}
?>