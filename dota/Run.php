#!/usr/bin/php
<?php
define('ACC',true);
require('./include/init.php');
set_time_limit(0);
$pid = pcntl_fork();
if ($pid == -1) {
	die('could not fork');
} else if ($pid) {
	$redis=MyRedis::getIns();
	$user=new UserMapper();
	while(1){
		while ($redis->lsize('new_user')!=0 && $redis->lsize('new_user')!==false){
			$user_id=$redis->lpop('new_user');
			$user->addUser($user_id);
		}
		while($redis->lsize('update_user')!=0 && $redis->lsize('update_user')!==false){
			$user_id=$redis->lpop('update_user');
			$user->updateUser($user_id);
		}
		sleep(10);
		$user->needUpdate();
	}
} else {
	$redis=MyRedis::getIns();
	$detail=new DetailMapper();
	while (1){
		while($redis->lsize('update_match')!=0 && $redis->lsize('update_match')!==false){
			$match_id=$redis->lpop('update_match');
			$detail->getDetail($match_id);
		}
		sleep(15);
	}
}




