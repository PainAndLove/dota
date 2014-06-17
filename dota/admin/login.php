<?php
define('ACC', true);
include_once('../include/init.php');
$name=$_POST["username"];
$pwd=$_POST["password"];
$admin=new AdminModel();
echo $admin->isAdmin($name,$pwd);
