<?
/*
클래스 : Page
작성일 : 2014.02.25
작성자 : 민유성
설명   : 페이지를 설정하는 함수
주의사항 :
ModAddOne 함수가 있어야함

 

*/

class Page{
	var $totalCnt;				//전체 게시물 갯수
	var $nowPage = 1;				//현제페이지
	var $totalPage;				//전체페이지수
	var $totalPageGroup;			//전체페이지 그룹수
	var $nowPageGroup;			//현제페이지 그룹
	var $limitPage = 10;			//한페이지에 보여질 페이지수
	var $limitPageGroup = 4;		//한페이지에 보여질 페이지 그룹
	var $startPage;				//시작 게시물
	var $endPage;					//끝 게시물
	var $startPageGroup;			//시작 페이지그룹
	var $endPageGroup;			//끝 페이지그룹
	var $href;
	var $endPageLink;
	var $startPageLink;
	var $nextPageLink;
	var $prevPageLink;
	var $flag;
	var $varName;

	function Setting(){
		if($this->totalCnt <= 0){
			return false;
		}
		$this->varName = ($this->varName) ? $this->varName."=" : "page=";
		if($this->nowPage <= 0){
			$this->nowPage = 1;
		}
		$this->totalPage	  = ModAddOne($this->totalCnt, $this->limitPage);
		$this->totalPageGroup = ModAddOne($this->totalPage, $this->limitPageGroup);
		$this->nowPageGroup   = ModAddOne($this->nowPage, $this->limitPageGroup);
		
		$this->startPage = ($this->nowPage-1) * $this->limitPage;
		if($this->totalPage == $this->nowPage){
			$this->endPage = $this->startPage + ($this->totalPage-$this->startPage);
		}else{
			$this->endPage = $this->startPage + $this->limitPage;	
		}
		
		$this->startPageGroup = ($this->nowPageGroup-1) * $this->limitPageGroup + 1;
		if($this->nowPageGroup == $this->totalPageGroup){
			$this->endPageGroup = $this->startPageGroup + ($this->totalPage-$this->startPageGroup);
		}else{
			$this->endPageGroup = $this->startPageGroup + $this->limitPageGroup - 1;
		}
		if(strpos($this->href,"?") > 0){
			$this->flag = "&";
		}else{
			$this->flag = "?";
		}
		$nextPage = ($this->totalPage >= ($this->endPageGroup+1)) ? ($this->endPageGroup+1) : $this->endPageGroup;
		$prevPage = (1 <= ($this->startPageGroup-1)) ? ($this->startPageGroup-1) : "1";
		
		$this->endPageLink = $this->href.$this->flag.$this->varName.$this->totalPage;
		$this->startPageLink = $this->href.$this->flag.$this->varName."1";
		$this->nextPageLink = $this->href.$this->flag.$this->varName.$nextPage;
		$this->prevPageLink = $this->href.$this->flag.$this->varName.$prevPage;
	}
	function NextPage(){
			
	}
	function PrevPage(){
	
	}
	function Output(){
		
		echo "<ul>";
		for($i=$this->startPageGroup; $i<=$this->endPageGroup; $i++){
			if($i==$this->nowPage){
				echo "<li class='on'><a href='".$this->href.$this->flag.$this->varName.$i."' title='페이지".$i."'>".$i."</a></li>";
			}else{
				echo "<li><a href='".$this->href.$this->flag.$this->varName.$i."' title='페이지".$i."'>".$i."</a></li>";
			}
		}		
		echo "</ul>";
	}


}
?>
