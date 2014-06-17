<?php
require('./ConvertTool.class.php');
require('./KeyBoxTool.class.php');
$arr=array(
	'cd'=>'abc',
	'arr'=>array(
		's'=>'sw',
		'd'=>'dw'
		)
	);
/*
header('Content-type:text/xml');
print_r(ConvertTool::arr2xml($arr));*/

$Key=new KeyBoxTool;
for ($i=0; $i < 7; $i++) { 
	echo $Key->getKey().'<br />';
}

?>