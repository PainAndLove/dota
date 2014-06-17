<?php
/*
 * Redis操作类
 * 作为消息队列的承载
 */
class MyRedis{
	protected $redis;
	protected static $ins=NULL;
	
	//单例模式
	public static function getIns(){
		if(!(self::$ins instanceof self)) {
			self::$ins = new self();
		}
	
		return self::$ins;
	}
	
	public function __construct(){
		$this->redis=new Redis();
		$this->redis->connect('127.0.0.1',6379);
	}
	
	//普通键值对
	public function read($id){
		$value=$this->redis->get($id);
		if($value){
			return $value;
		}else{
			return '';
		}
	}
	
	public function set($id,$data){
		if($this->redis->set($id,$data)){
			return true;
		}
		return false;
	}
	
	//队列键值对
	public function lpush($id,$data){
		if($this->redis->lpush($id, $data)){
			return true;
		}
		return false;
	}
	
	public function lpop($id){
		$value=$this->redis->rPop($id);
		if($value){
			return $value;
		}else{
			return '';
		}
	}
	
	public function lsize($id){
		if($this->redis->lSize($id)===false || $this->redis->lSize($id)==0){
			return 0;
		}
		return $this->redis->lSize($id);
	}
	
	public function destory($id){
		if($this->redis->delete($id)){
			return true;
		}
		return false;
	}
}