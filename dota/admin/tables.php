<?php
define('ACC', true);
include('../include/init.php');
$user=new UserModel();
$match=new MatchModel();
$abil=new AbilityUpgradesModel();
$add=new AdditionalUnitsModel();
$pick=new PicksBanModel();
$slot=new SlotsModel();
$redis=MyRedis::getIns();
$db=Mysql::getIns();

include(ROOT.'view/admin/tables.html');