<?php
/*
 * 管理员表对应的Model类
 */
class AdminModel extends ObjectModel{
	protected $db=null;
	protected $table='admin';
	protected $dbName='dota';

	public function __construct(){
		$this->db=Mysql::getIns();
	}

	public function isAdmin($user,$pwd){
		$sql='select count(pwd) from '.$this->table.' where username="'.$user.'" and pwd="'.$pwd.'"';
		return $this->db->getOne($sql);
	}
}