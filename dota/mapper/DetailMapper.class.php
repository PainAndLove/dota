<?php
class DetailMapper{
	private $request=null;
	private $keyBox=null;
	protected $db=null;
	protected $match=null;
	protected $slot=null;
	protected $abil=null;

	public function __construct(){
		$this->request=new RequestMapper();
		$this->keyBox=new KeyBoxTool();
		$this->db=Mysql::getIns();
		$this->match=new MatchModel();
		$this->slot=new SlotsModel();
		$this->abil=new AbilityUpgradesModel();
	}

	/*
	 * 获取单场比赛数据并保存到数据库
	 * 输入 历史记录ID
	 */
	public function getDetail($id){
		if($this->match->inDB($id))return;
		if($id==0 || $id==-1) return;
		$detail=$this->singleGet($id);
		$this->match->save2db($detail);
		$slots_id=$this->slot->save2db($detail);
		$this->abil->save2db($detail, $slots_id);
	}

	/*
	 * 获取单场比赛记录的详细数据
	 * 输入：单场比赛ID
	 * 输出：数组 单场比赛数据
	 */
	protected function singleGet($id){
		$param=array();
		$param['match_id']=$id;
		$this->request->setUrl($this->keyBox->api_getMatchDetails,$this->keyBox->getKey(),$param);
		$rs=simplexml_load_string($this->request->send());
		$rsArr=ConvertTool::xml2arr($rs);
		return $rsArr;
	}

}
?>