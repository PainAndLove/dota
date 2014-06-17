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
$video=new VideoModel();

$videoArr=$video->show();


include(ROOT.'view/admin/forms.html');