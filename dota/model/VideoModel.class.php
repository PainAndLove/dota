<?php
/*
 * 视频表对应类
 */
class VideoModel extends ObjectModel{
	protected $db=null;
	protected $table='video';
	protected $dbName='dota';

	public function __construct(){
		$this->db=Mysql::getIns();
	}

	public function addVideo($address,$author,$title){
		$sql='insert into '.$this->table.'(address,author,title) values("'.$address.'","'.$author.'","'.$title.'")';
		return $this->db->query($sql);
	}
	
	public function show(){
		$sql='select id,address,author,title from '.$this->table;
		return $this->db->getAll($sql);
	}
	
	public function delete($id){
		$sql='delete from '.$this->table.' where id="'.$id.'"';
		return $this->db->query($sql);
	}
}

