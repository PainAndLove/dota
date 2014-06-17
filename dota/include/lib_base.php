<?php
defined('ACC')||exit('ACC Denied');

/*@param array 需要处理的数组
**@return 返回数组
*/
function _addslashes($arr)
{
	foreach($arr as $k=>$v)
	{
		if(is_string($v))
			$arr[$k]=addslashes($v);
		else if(is_array($v))
			$arr[$k]=_addslashes($v);
	}
	return $arr;
}

function setSession(){
	if(!isset($_SESSION['id_array']))
		$_SESSION['id_array']=array();
}

function historyFilter($arr){
	$matches=$arr['matches']['match'];
	foreach ($matches as $key => $match) {
		if($match['lobby_type']!=0 && $match['lobby_type']!=7){
			unset($matches[$key]);
		}
	}
	$arr['matches']['match']=$matches;
	return $arr;
}
?>