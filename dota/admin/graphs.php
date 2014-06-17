<?php
define('ACC', true);
include('../include/init.php');

$hero=new HeroModel();
$param=array('hero_localized_name','hero_id');
$heroData=$hero->show($param);

$page='';
if(isset($_GET['page'])){
	$page=$_GET['page'];
}else{
	$page=1;
}

$param2=array('hero_id','hero_localized_name','document');
$heroData2=$hero->show($param2,$page,10);
$p=new PageTool(107,10,1,11);

include(ROOT.'view/admin/graphs.html');