<?php
	require_once 'class.request.php';
	require_once 'class.match.php';
	require_once 'class.mysql.php';

	$re=new Request;
	$con=new Config();
	$param=array('account_id'=>'113561116');
	$re->setUrl($con->api_getMatchHistory,$param);
	$r=$re->send();
	$arr=json_decode($r,true);
	$matchs=array($arr['result']['matches']);
	$list_id=array();
	foreach ($matchs as $key => $value) {
		foreach ($value as $key => $values) {
			$list_id[]= $values['match_id'];
		}
	}
	//print_r($list_id);
	unset($re);
	
	foreach ($list_id as $key => $value) {
		$re=new Request;
		$param=array('match_id'=>$value);

		//echo $value.'========';

		$re->setUrl($con->api_getMatchDetails,$param);
		$r=$re->send();
		$arr=json_decode($r,true);

		$str_key='';
		$str_value='';

		foreach ($arr as $keys => $values) {
			foreach ($values as $key => $value) {
				if($key!='players')
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
		$mysql =new Mysql;
		echo $sql;
		$mysql->query($sql);
		$mysql->close();
		
	}
?>