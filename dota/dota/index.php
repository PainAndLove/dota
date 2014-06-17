<?php
	require_once 'class.matchhistory.php';
	
	$id=$_GET['account_id'];
	$match=new MatchHistory;
	$match->addAccountID($id);
?>