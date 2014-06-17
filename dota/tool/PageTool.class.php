<?php
class PageTool{
	protected $total=0;
	protected $perpage=10;
	protected $page=1;
	protected $showPage=5;
	public function __construct($total ,$perpage=false,$page=false,$showPage=false){
		$this->total=$total;
		if($perpage){
			$this->perpage=$perpage;
		}

		if($page){
			$this->page=$page;
		}

		if($showPage){
			$this->showPage=$showPage;
		}
	}

	//创建分页导航
	public function show(){
		$cnt=ceil($this->total/$this->perpage); //总页数
		$uri=$_SERVER['REQUEST_URI'];
		$parse=parse_url($uri);
		$param=array();
		if(isset($parse['query'])){
			parse_str($parse['query'],$param);
		}

		if(isset($param['page'])){
			$this->page=$param['page'];
			unset($param['page']);//page是算出来的 不留着
		}else{
			$this->page=1;
		}
		
		$url=$parse['path'].'?';
		
		if(!empty($param)){
			$param=http_build_query($param);
			$url=$url.$param.'&';
		}
		 

		$nav=array(); //从中间向两边找
		$nav[] = "<span class='page_now'>".$this->page."</span>";
		$left=$this->page-1;
		$right=$this->page+1;
		for(;count($nav)<$this->showPage;){
			if($left>=1){
				array_unshift($nav, "<a href='".$url.'page='.$left."'>".$left."</a>"); //从前面加
			}
			if($right<=$cnt){
				array_push($nav,"<a href='".$url.'page='.$right."'>".$right."</a>");//从后面加
			}
			$left-=1;
			$right+=1;
		}
		
		return implode('&nbsp&nbsp&nbsp&nbsp', $nav);
	}
}

$p=new PageTool(100,1,2);
$p->show();
?>