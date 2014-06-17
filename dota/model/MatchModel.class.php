<?php
/*
 * 比赛表对应的Model类
 */
	class MatchModel extends ObjectModel
	{

		protected $db=null;
		protected $table='matches';
		protected $dbName='dota2';

		public function __construct(){
			$this->db=Mysql::getIns();
		}

		/*
		 * 单场比赛详细数据存储
		 */
		public function save2db($arr){
			$matchArr=array();
			foreach ($arr as $key => $value) {
				if(is_array($value)){
					continue;
				}
				
				if($key=='dire_guild_id' || $key=='dire_guild_name' || $key=='dire_guild_logo')
					continue;
				
				if($key=='radiant_guild_id' || $key=='radiant_guild_name' || $key=='radiant_guild_logo')
					continue;
			
				if($key=='radiant_win'){
					if($value=='true'){
						$value='1';
					}else{
						$value='0';
					}
				}
			
				$matchArr[$key]=$value;
			}
			$this->db->autoExecute($this->table,'insert',$matchArr);
		}


		/*input match_id
		** 		param 需要查询的字段数组
		**return array 一行数据
		*/
		public function getMatch($match_id,$param){
			$sql='select '.implode(',', $param).' from '.$this->table.' where match_id="'.$match_id.'"';
			return $this->db->getRow($sql);
		}

		public function inDB($match_id){
			$sql='select count(*) from '.$this->table.' where match_id="'.$match_id.'"';
			return $this->db->getOne($sql);
		}
		
		public function count(){
			$sql='select count(*) from '.$this->table;
			return $this->db->getOne($sql);	
		}
	}
?>