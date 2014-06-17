<?php
/*
 * 玩家映射类
 */
class UserMapper{
	protected $redis=null;
	protected $user=null;
	protected $request=null;
	private $keyBox=null;
	protected $his=null;
	
	public function __construct(){
		$this->redis=MyRedis::getIns();
		$this->user=new UserModel();
		$this->request=new RequestMapper();
		$this->keyBox=new KeyBoxTool();
		$this->his=new HistoryMapper();
	}
	
	public function getUserDetail($acc){
		$param=array('steamids'=>$acc+76561197960265728);
		$this->request->setUrl($this->keyBox->api_getPlayerSummaries,$this->keyBox->getKey(),$param);
		$rs=simplexml_load_string($this->request->send());
		$rsArr=ConvertTool::xml2arr($rs);
		$userData=$rsArr['players']['player'];
		return $userData;
	}
	
	/*
	 * 新玩家加入函数
	 * 新玩家不进入update_user池 为了保证新玩家得到更早的更新
	 */
	public function addUser($acc){
		$this->user->save2db($acc);
		$this->updateUser($acc);
	}
	
	/*
	 * 更新玩家基本数据-其他数据放在其他东西里面更新
	 * 输入： int acc 玩家ID
	 */
	public function updateUser($acc){
		$userData=$this->getUserDetail($acc);
		$param=array();
		foreach ($userData as $key=>$value){
			if($key=='steamid' || $key=='personaname' || $key=='avatar')
				$param[$key]=$value;
		}
		$nowTime=time();
		$param['update_time']=$nowTime;
		//更新数据 并且获得最新比赛ID
		$firstID=$this->his->getMatchHistory($acc);
		$param['last_match_id']=$firstID;
		$where='where account_id='.$acc;
		$this->user->setUpdate($param,$where);
		
	}
	
	/*
	 *得到那些需要更新数据的玩家 并push入update_user池 
	 */
	public function needUpdate(){
		$users=$this->user->getUpdate();
		foreach ($users as $key=>$value){
			$this->redis->lpush('update_user', $value['account_id']);
		}
	}
}
?>