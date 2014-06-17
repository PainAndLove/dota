<?php
define('ACC',true);
include('../include/init.php');

$video=new VideoModel();

if(isset($_GET['id'])){
	$id=$_GET['id'];
	$video->delete($id);
	header("Location:forms.php"); 
}else{
$address=$_POST['address'];
$author=$_POST['author'];
$title=$_POST['title'];

$video->addVideo($address, $author, $title);
}