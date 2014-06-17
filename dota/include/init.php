<?php
defined('ACC')||exit('ACC Denied');
define('ROOT',str_replace('\\', '/', dirname(dirname(__FILE__))).'/');
define('DEBUG', true);

require(ROOT.'include/lib_base.php');
/*
require(ROOT.'include/db.class.php');
require(ROOT.'include/config.class.php');
require(ROOT.'include/log.class.php');
require(ROOT.'include/mysql.class.php');
require(ROOT.'model/model.class.php');
*/

//自动加载class
function __autoload($class){
	if(strtolower(substr($class, -5))=='model'){
		//echo ROOT.'model/'.$class.'.class.php';
		require(ROOT.'model/'.$class.'.class.php');
	}else if(strtolower(substr($class, -4))=='tool'){
		require(ROOT.'tool/'.$class.'.class.php');
	}
	else if(strtolower(substr($class, -6))=='mapper'){
		require(ROOT.'mapper/'.$class.'.class.php');
	}else{
		require(ROOT.'include/'.$class.'.class.php');
	}
}

$_GET=_addslashes($_GET);
$_POST=_addslashes($_POST);
$_COOKIE=_addslashes($_COOKIE);

if(defined("DEBUG"))
	error_reporting(E_ALL);
else
	error_reporting(0);
?>