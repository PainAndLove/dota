<?php
class OutputMapper{
	protected $db=null;
	protected $user=null;
	protected $match=null;
	protected $slot=null;
	protected $redis=null;
	
	public function __construct(){
		$this->db=Mysql::getIns();
		$this->user=new UserModel();
		$this->match=new MatchModel();
		$this->slot=new SlotsModel();
		$this->redis=MyRedis::getIns();
	}
	/*
	 * 总输出出口
	 * 判断玩家ID是否入库 并在作出相应选择
	 */
	public function output($acc){
		if($this->user->inDB($acc)){
			return $this->getSummarize($acc);
		}else{
			$this->redis->lpush('new_user', $acc);
		}
		return file_get_contents(ROOT.'data/file/first.xml');
	}
	/*
	 * 获取个人概况
	 */
	public function getSummarize($acc){

		$sparam=array('match_id','hero_id');
		$mparam=array('radiant_win,game_mode');
		$rs=array();
		$slotArr=$this->slot->getSlot($acc,$sparam);
		foreach ($slotArr as $key => $value) {
			$rs=$this->match->getMatch($value['match_id'],$mparam);
			$value=array_merge($value,$rs);
			$slotArr[$key]=$value;
		}

		return ConvertTool::arr2xml($slotArr);
	}
}
?>