<?php
defined('ACC')||exit('ACC Denied');
	class Conf{
		protected static $ins=NULL;
		protected $data=array();

		final public function __construct(){
			include(ROOT.'include/config.inc.php');
			$this->data=$_CFG;
		}

		final protected function __clone(){

		}
		public static function getIns(){
			if(self::$ins instanceof self)
				return self::$ins;
			else{
				self::$ins=new self();
				return self::$ins;
			}
		}

		public function __get($key){
			if(array_key_exists($key, $this->data))
				return $this->data[$key];
			else
				return NULL;
		}

		public function __set($key,$value){
			$this->data[$key]=$value;
		}
	}

?>