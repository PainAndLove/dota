<?php
	require_once 'class.request.php';
	require_once 'class.match.php';
	require_once 'class.mysql.php';

	class MatchDetail
	{
		private $queue_id;
		private $con;
		private $re;
		private $mysql;

		function __construct()
		{
			$this->con=new Config;
			$this->re=new Request;
			$this->queue_id=array();
			$this->mysql =new Mysql;
		}

		function __destruct()
		{
			$this->mysql->close();
		}



		public function addHistoryID($arr)
		{
			array_push($this->queue_id, $arr);
			$this->getDetail();
		}

		private function getDetail()
		{
			//处理完一个人再下一个
			while(count($this->queue_id)!=0)
			{
				$list_id=array_pop($this->queue_id);
				foreach ($list_id as $key => $value) 
				{
					$param=array('match_id'=>$value);

					//echo $value.'========';

					$this->re->setUrl($this->con->api_getMatchDetails,$param);
					$r=$this->re->send();
					$arr=json_decode($r,true);

					$str_key='';
					$str_value='';

					//构造insert语句的表()和values部分
					foreach ($arr as $keys => $values) {
						foreach ($values as $key => $value) {
							if($key!='players' &&$key!='picks_bans')	//去除数组数据，在其余地方获取
							{
								$str_key.=$key.',';
								if($value===false)$value=0;
								$str_value.="'".$value."'".',';
							}
						}
					}
					
					$str_key=rtrim($str_key,',');
					$str_value=rtrim($str_value,',');
					
					//echo $match->duration;
					//print_r($str_key);
					//连接数据库下面
					$sql="insert into matches($str_key) values($str_value)";
					echo $sql;
					$this->mysql->query($sql);
				}
			}
		}
	}
?>