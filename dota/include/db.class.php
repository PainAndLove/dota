<?php
defined('ACC')||exit('ACC Denied');
	abstract class db{
		public abstract function connect($host,$port,$user,$pwd);

		//sql语句
		public abstract function query($sql);

		
		public abstract function getAll($sql);

		public abstract function getRow($sql);

		public abstract function getOne($sql);
	
		public abstract function autoExecute($table,$data,$act,$where);
	}
?>