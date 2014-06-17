<?php
/*
 * 历史游戏数据获取游戏场次ID类
 */
class HistoryMapper{
	
	private $keyBox=null;
	private $request=null;
	protected $redis=null;
	protected $match=null;
	protected $user=null;
	//private $config=null;

	public function __construct(){
		$this->keyBox=new KeyBoxTool();
		$this->request=new RequestMapper();
		$this->redis=MyRedis::getIns();
		$this->match=new MatchModel();
		$this->user=new UserModel();
	}


/*
 * 获取玩家历史游戏数据ID -并将结果Push入Redis内
 * 输入：string $acc 玩家游戏ID
 * 		array $parameter 附加信息
 * 		
 * 因为Value APi限制现在只能返回500局以内
 * 返回：最新的比赛ID号
 * 		当返回为0时 说明玩家帐号存在问题
 */
	public function getMatchHistory($acc,$parameter=array()){
		//int last_match_id 上次更新时获得的最后一场比赛数据
		//因为每隔两小时更新一次，所以不需要考虑性能消耗，不会超过100场数据更新
		$last_match_id=$this->user->get($acc,'last_match_id');
		//控制update玩家时是否停止 当到达最后一个last_match_id时终止
		$stop=0;
		$param=array();
		$param['account_id']=$acc;
		$param=array_merge($param,$parameter);
		$this->request->setUrl($this->keyBox->api_getMatchHistory,$this->keyBox->getKey(),$param);
		$rs=simplexml_load_string($this->request->send());
		$rsArr=ConvertTool::xml2arr($rs);
		//过滤非公开匹配玩家的比赛
		$rsArr=historyFilter($rsArr);
		//print_r($rsArr);
		$matchs=$rsArr['matches']['match'];
		$idArr=array();
		foreach ($matchs as $num => $match) {
			if($match['match_id']==$last_match_id){
				$stop=1;
				break;
			}
			$idArr[]=$match['match_id'];
		}
		
		//没有数据需要更新 直接结束
		if(empty($idArr)){
			return $last_match_id;
		}
		//$lastID是为了获取更多数据 $firstID是为了记录最新的数据
		$firstID=0;
		$firstID=array_shift($idArr);
		$lastID=0;
		
		//else里面当只更新了一场比赛的时候 也是直接返回
		if(!empty($idArr)){
			$lastID=array_pop($idArr);
		}else{
			$this->redis->lpush('update_match', $firstID);
			return $firstID;
		}
		
		if(!empty($idArr)){
			foreach ($idArr as $id){
				if(!$this->match->inDB($id))
				$this->redis->lpush('update_match', $id);
			}
		}
		//获取未完全数据
		if($stop==0){
			if($rsArr['results_remaining']!='0'){
				$param=array();
				$param['start_at_match_id']=$lastID;
				$this->getMatchHistory($acc,$param);
			}else if(!$this->match->inDB($id)){
				$this->redis->lpush('update_match', $lastID);
			}
		}else{
			//更新2场以上数据的话肯定是来这里的 因为不可能超过100场 所以肯定会stop=1
			$this->redis->lpush('update_match', $lastID);
		}
		$this->redis->lpush('update_match', $firstID);
		return $firstID;	
	}
}
?>