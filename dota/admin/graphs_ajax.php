<?php
define('ACC', true);
include('../include/init.php');
$id=$_POST['id'];
$doc=$_POST["doc"];
$hero=new HeroModel();
$hero->addDocument($id, $doc);