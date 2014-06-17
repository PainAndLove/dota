<?php
define('ACC', true);
include('../include/init.php');

$usr=new UserMapper();
$usr->needUpdate();