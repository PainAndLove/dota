<?php
defined('ACC')||exit('ACC Denied');
class log{

	const LOGFILE= 'curr.log'; //代表日志文件的名称
	//写日志
	public static function write($context){
		$context=$context."\r\n";
		$log=self::isBak(); //计算地址
		$fh=fopen($log,'ab');
		fwrite($fh,$context);
		fclose($fh);
	}

	//备份日志
	public static function bak(){
		$log=ROOT .'data/log/'.self::LOGFILE;
		$bak=ROOT. 'data/log/'.date('ymd').mt_rand(10000,99999).'.bak';
		return rename($log,$bak);
	}

	//判断日志大小
	public static function isBak(){
		$log=ROOT . 'data/log/'.self::LOGFILE;

		if(file_exists($log))
		{
			touch($log);
			return $log;
		}
		clearstatcache(true,$log); //刷新缓存
		$size=filesize($log);
		if($size<1024*1024) //1M
		{
			return $log;
		}
		
		if(!self::bak()){
			return $log;
		}else{
			touch($log);
			return $log;
		}


	}
}
?>