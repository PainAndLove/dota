<?php
/*
 * 用于使用Redis代替Session文件存储方式
 * 具体在于session_set_save_handler中
 */
class SessionManager{
	private $redis;
	private $sessionSavePath;
	private $sessionName;
	private $sessionExpireTime=300;
	
	public function __construct(){
		$this->redis=new Redis();
		$this->redis->connect('127.0.0.1',6379);
		
		$retval=session_set_save_handler(
			array($this,"open"),
			array($this,"close"),
			array($this,"read"),
			array($this,"write"),
			array($this,"destory"),
			array($this,"gc")
		);
		session_start();
	}
	
	public function open($path,$name){
		return true;
	}
	
	public function close(){
		return true;
	}
	
	public function read($id){
		$value=$this->redis->get($id);
		if($value){
			return $value;
		}else{
			return '';
		}
	}
	
	public function write($id,$data){
		if($this->redis->set($id,$data)){
			$this->redis->expire($id,$this->sessionExpireTime);
			return true;
		}
		return false;
	}
	
	public function destory($id){
		if($this->redis->delete($id)){
			return true;
		}
		return false;
	}
	
	public function gc($maxlifetime){
		return true;
	}
	
	public function __destruct(){
		session_write_close();
	}
}