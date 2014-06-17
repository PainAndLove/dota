<?php
//文件上传类
//工具类也不能直接访问
defined('ACC')||exit('ACC denied');

class UpTool{

	protected $allowExt='jpg,jpeg,gif,bmp,png';
	protected $maxSize=1; //1M为单位
	protected $file=NULL; //存储上传文件的信息类

	protected $errno=0; //错误代码
	protected $error =array(
		0=>'无错误',
		1=>'上传文件大小超出系统限制',
		2=>'上传文件大小超出网页表单限制',
		3=>'文件只有部分被上传',
		4=>'没有文件被上传',
		6=>'找不到临时文件夹',
		7=>'文件写入失败',
		8=>'不允许的文件后缀',
		9=>'文件大小超出类允许',
	   10=>'创建目录失败',
	   11=>'移动文件失败'
	);

	public function up($key){
		
		if(!isset($_FILES[$key])){
			return false;
		}
		$f=$_FILES[$key];

		if($f['error']){
			$this->errno=$f['error'];
			return false;
		}

		$ext=$this->getExt($f['name']);
		if(!$this->isAllowExt($ext)){
			$this->errno=8;
			return false;
		}
		if(!$this->isAllowSize($f['size'])){
			$this->errno=9;
			return false;
		}
		
		//创建目录
		$dir=$this->mk_dir();
		if($dir==false){
			$this->errno=10;
			return false;
		}
		//生成随机名字
		$newName=$this->randName().'.'.$ext;
		$dir.='/'.$newName;

		//移动文件
		if(!move_uploaded_file($f['tmp_name'], $dir.'/'.$newName)){
			$this->errno=11;
			return false;
		}

		//相对路径
		return str_replace(ROOT, '', $dir);
	}

	public function getError(){
		return $this->error[$this->errno];
	}

	protected function getExt($file){
		$temp=explode('.', $file);
		return end($temp);
	}

	protected function isAllowExt($ext){
		return in_array(strtolower($ext),explode(',',strtolower($this->allowExt)));
	}

	protected function isAllowSize($size){
		return $size<=$this->maxSize*1024*1024;
	}

	//按日期创建目录的方法
	protected function mk_dir(){
		$dir=ROOT.'data/images/'.date('Ym/d');
		if(is_dir($dir)||mkdir($dir,0777,true)){
			return $dir;
		}else{
			return false;
		}
	}

	//生成随机文件名
	protected function randName($length=6){
		$str='abcdefg0123456789';
		return substr(str_shuffle($str), 0,$length);
	}

	//允许的后缀字符串
	public function setExt($exts){
		$this->allowExt=$exts;
	}

	public function setSize($num){
		$this->maxSize=$num;
	}

}
?>