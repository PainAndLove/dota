<?php
define('ACC',true);
require('./include/init.php');

$db=Mysql::getIns();
$sql='select * from users';
echo 'i am here';
print_r($db->getAll($sql));
?>