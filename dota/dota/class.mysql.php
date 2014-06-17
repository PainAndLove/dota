<?php
	require_once 'config.php';
	class Mysql
	{
		private $conn;

		//连接和选择数据库
		public function __construct()
		{
			$config=new Config;
			$this->conn=mysql_connect($config->host,$config->user,$config->pwd);
			mysql_select_db($config->database,$this->conn);

		}

		//注意字符串不应以分号结束
		public function query($sql)
		{
			return mysql_query($sql,$this->conn);
		}

		//获取多行数据
		public function getAll($sql)
		{
			$list=array();
			$rs=$this->query($sql);
			if(!$rs)
				return false;
			while($row=mysql_fetch_assoc($rs))
			{
				$list[]=$row;
			}
			return $list;
		}

		//查询一行
		public function getRow($sql)
		{
			$rs=$this->query($sql);
			if(!$rs)
				return false;
			return mysql_fetch_assoc($rs);
		}

		//查询一个数字
		public function getOne($sql)
		{
			$rs=$this->query($sql);
			if(!$rs)
				return false;
			$row=mysql_fetch_row($rs);
			return $row[0];
		}

		//执行一条插入语句
		public function insert($sql)
		{
			return $this->query($sql,$this->conn);
		}

		//关闭数据库
		public function close()
		{
			mysql_close($this->conn);
		}
		
	}
?>