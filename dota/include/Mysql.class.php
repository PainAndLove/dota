<?php
defined('ACC')||exit('ACC Denied');
require 'db.class.php';

//写成单例模式
class Mysql extends db{

	protected $link=NULL;
	protected static $ins=NULL;
	protected $conf=NULL;

	//单例模式获取对象
	public static function getIns()
	{
		if(!(self::$ins instanceof self)) {
            self::$ins = new self();
        }

        return self::$ins;
	} 
	public function __construct(){
		$this->conf=Conf::getIns();
		$this->connect($this->conf->host,$this->conf->port,$this->conf->user,$this->conf->pwd);
		$this->select_db($this->conf->db);
		mysql_set_charset('utf8');
	}
	//连接数据库
	public  function connect($host,$port,$user,$pwd)
	{
		$link = @mysql_connect("{$host}:{$port}",$user,$pwd,true);
		if(!$link) {
		    die("Connect Server Failed: " . mysql_error());
		}else{
			$this->link=$link;
		}		
	}

	//选择数据库
	public function select_db($db)
	{
		if(!mysql_select_db($db,$this->link)) {
		    die("Select Database Failed: " . mysql_error($this->link));
		}
	}

	//查询 删除
	public function query($sql)
	{	
		$ret = mysql_query($sql, $this->link);
		if ($ret === false) {
			die("Create Table Failed: " . mysql_error($this->link));
		} 
		return $ret;
	}

	//获取全部数据
	public function getAll($sql)
	{
		$rs=$this->query($sql);
		$list=array();
		while(($row=mysql_fetch_assoc($rs))!=false)
		{
			$list[]=$row;
		}
		return $list;
	}

	//获取一行数据
	public function getRow($sql)
	{
		$rs=$this->query($sql);
		$list=mysql_fetch_assoc($rs);
		return $list;
	}

	//获取一个数据
	public function getOne($sql)
	{
		$rs=$this->query($sql);
		$list=mysql_fetch_row($rs);
		return $list[0];
	}	

	/*自动执行insert update
	**table 表名
	**mode 操作方式 insert或者update
	**data 必须为数组
	**where 条件语句
	*/
	public function autoExecute($table,$mode,$data,$where='')
	{
		if(!is_array($data))
			return false;
		if($mode=='insert')
		{
			$sql='insert into '.$table.'('.implode(',',array_keys($data)).') ';
			$sql.='values (\'';
			$sql.=implode('\',\'', array_values($data));
			$sql.='\')';
		}

		if($mode=='update')
		{
			$sql='update '.$table.' set ';
			foreach($data as $k => $v) {
				$sql.=$k.'=\''.$v.'\',';
			}
			$sql=rtrim($sql,',');
			$sql.=' '.$where;
		}
		log::write($sql);
		return $this->query($sql);
		
	}

	public function affected_rows(){
		return mysql_affected_rows();
	}
	//关闭数据库
	public function close()
	{
		mysql_close($this->link);
	}

	//返回上次自动增长的ID值
	public function insertID(){
		return mysql_insert_id();
	}
}

?>