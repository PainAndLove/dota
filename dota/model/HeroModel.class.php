<?php
/*
 * 英雄对应类
 */
class HeroModel extends ObjectModel{
	protected $db=null;
	protected $table='hero';
	protected $dbName='dota';

	public function __construct(){
		$this->db=Mysql::getIns();
	}

	public function addDocument($hero_id,$document){
		$sql='update '.$this->table.' set document="'.$document.'" where hero_id="'.$hero_id.'"';
		log::write($sql.' my sql');
		return $this->db->query($sql);
	}
	
	/*
	 * 获取需要的英雄字段信息
	 * 输入：array param 需要的字段
	 * 输出：array 英雄信息
	 */
	public function show($param,$page=NULL,$perpage=NULL){
		$sql='';
		if($page==NULL){
			$sql='select '. implode(',', array_values($param)).' from '.$this->table;
		}else{
			$start=($page-1)*$perpage;
			$sql='select '. implode(',', array_values($param)).' from '.$this->table.' limit '.$start.','.$perpage;
		}
		log::write($sql);
		return $this->db->getAll($sql);
	}

	/*
	 * 删除英雄字段
	 * 输入：int id 英雄ID
	 */
	public function delete($id){
		$sql='delete from '.$this->table.' where hero_id="'.$id.'"';
		return $this->db->query($sql);
	}
}
