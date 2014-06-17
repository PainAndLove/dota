<?php
/*
 * 服务对外接口
 */
define('ACC',true);
require('../include/init.php');
$account_id=null;
if(isset($_GET['account_id'])){
	$account_id=$_GET['account_id'];
}else{
	echo '用户帐号未设置';
	exit();
}

$out=new OutputMapper();

header('Content-type:text/xml');
echo $out->output($account_id);

/*
$user=new UserModel();
if($user->inDB($account_id)){
	//转到输出
	
	include('./summarize.php?account_id='.$account_id);
	
}else if(in_array($account_id, $_SESSION['id_array'])){
	//正在获取数据中
	header('Content-type:text/xml');
	echo file_get_contents(ROOT.'data/file/inarray.xml');
	
}else{
	//第一次登录到系统
	$arr=$_SESSION['id_array'];
	array_push($arr, $account_id);
	$_SESSION['id_array']=$arr;
	require('./addUser.php');

}
*/
?>