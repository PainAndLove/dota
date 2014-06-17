<?php
/*传入account_id
**获取玩家历史游戏记录
*/
	require_once 'class.request.php';
	require_once 'class.match.php';
	require_once 'class.matchdetail.php';
	require_once 'class.mysql.php';

	class MatchHistory
	{
		private $queue_id;
		private $con;
		private $re;
		private $detail;

		function __construct()
		{
			$this->re=new Request;
			$this->con=new Config();
			$this->queue_id=array();
			$this->detail=new MatchDetail;
		}

		public function addAccountID($account_id)
		{
			array_push($this->queue_id, $account_id);
			$this->getHistory();
		}

		private function getHistory()
		{
			while(count($this->queue_id)!=0)
			{
				$account_id=array_pop($this->queue_id);
				$param=array('account_id'=>$account_id);
				$this->re->setUrl($this->con->api_getMatchHistory,$param);
				$r=$this->re->send();
				$arr=json_decode($r,true);
				$matchs=array($arr['result']['matches']);
				$list_id=array();	//match_id list
				foreach ($matchs as $key => $value) {
					foreach ($value as $key => $values) {
						$list_id[]= $values['match_id'];
					}
				}
				//var_dump($list_id);
				$this->detail->addHistoryID($list_id);
			}
	
		}

		
	}
?>