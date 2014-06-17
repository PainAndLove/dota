<?php
define('ACC',true);
include('../include/init.php');

$db=Mysql::getIns();


$heroData=simplexml_load_file(ROOT.'data/file/herolist.xml');
$arrHero=ConvertTool::xml2arr($heroData);
$heroes=$arrHero['heroes']['hero'];
$data=array();
foreach ($heroes as $key=>$hero){
	$data=array();
	$data['hero_name']=$hero['name'];
	$data['hero_id']=$hero['id'];
	$data['hero_localized_name']=$hero['localized_name'];
	$db->autoExecute('hero', 'insert', $data);
}