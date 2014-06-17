<?php
define('ACC', true);
include('../include/init.php');

$sql=$_POST["user_sql"];
$db=Mysql::getIns();
print_r($db->getAll($sql));