<?php
/* API class for managing the display of large block of data
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
//require_once($root_path.'include/care_api_classes/class_core.php');

class Paginator {

	var $max_nr=20; # The maximum nr of items displayed. User configurable.
	var $csx=0; # Current data block start index
	var $tcount=0; # Total available data count
	var $blkcount=0; # number of rows of resulting block
	var $page=''; # This page name
	var $skey=''; # Internal searchkey
	var $sort_item=''; # db table field to be sorted
	var $sort_dir; # sort direction, default is ascending
	var $rootpath; # Root path of the module calling this object

	/**
	* Constructor
	*/
	function Paginator($x=0,$fwdfile,&$sk,$rootpath,$oitem,$odir) {	
		if(empty($x)) $this->csx=0;
			else $this->csx=$x;
		$this->page=$fwdfile;
		$this->skey=strtr($sk,' ','+');
		$this->rootpath=$rootpath;
		$this->sort_item=$oitem;
		$this->sort_dir=$odir;
	}	
	/**
	* Sets the total number of rows of resulting data block
	*/
	function setTotalBlockCount($c=0){
		$this->blkcount=$c;
	}
	/**
	* Sets the total number  of available data
	*/
	function setTotalDataCount($c=0){
		$this->tcount=$c;
	}
	
	/**
	* Creates the "previous" block link
	* public
	* @param $txt (str) the link text in local language
	*/
	function makePrevLink($txt='',$append=''){
		if (!$this->csx){
			return '';
		}else{
			$x=$this->prevIndex();
			if(empty($txt)) $txt='Previous';
			//return '<a href="'.$this->page.URL_APPEND.'&mode=paginate&searchkey='.$this->skey.'&pgx='.$x.'&totalcount='.$this->tcount.'"><< '.$txt.'</a>';
			return '<a href="'.$this->page.URL_APPEND.'&mode=paginate&pgx='.$x.'&totalcount='.$this->tcount.'&oitem='.$this->sort_item.'&odir='.$this->sort_dir.$append.'"><< '.$txt.'</a>';
		}
	}
	/**
	* Creates the "next" block link
	* public
	* @param $txt (str) the link text in local language
	*/
	function makeNextLink($txt='',$append=''){
		$x=$this->nextIndex();
		if ($x){
			if(empty($txt)) $txt='Next';
			//return '<a href="'.$this->page.URL_APPEND.'&mode=paginate&searchkey='.$this->skey.'&pgx='.$x.'&totalcount='.$this->tcount.'">'.$txt.' >></a>';
			return '<a href="'.$this->page.URL_APPEND.'&mode=paginate&pgx='.$x.'&totalcount='.$this->tcount.'&oitem='.$this->sort_item.'&odir='.$this->sort_dir.$append.'">'.$txt.' >></a>';
		}else{
			return '';
		}
	}
	/**
	* returns the start index of the  previous block
	* private
	*/
	function prevIndex(){
		$b=$this->csx-$this->max_nr;
		if($b>0) return $b;
			else return 0;
	}
	/**
	* returns the start index of the  next block
	* private
	*/
	function nextIndex(){
		$b=$this->csx+$this->max_nr;
		if($b<$this->tcount) return $b;
			else return 0;
	}
	/**
	* returns the maximal number of rows allowed for a block
	*/
	function MaxCount(){
		return $this->max_nr;
	}
	/**
	* sets the maximal number of rows allowed for a block
	*/
	function setMaxCount($max){
		if($max) {
			$this->max_nr=$max;
			return TRUE;
		}else{
			return FALSE;
		}
	}
	/**
	* returns the start offset/index of the block
	*/
	function BlockStartIndex(){
		return $this->csx;
	}
	/**
	* returns the real block start number
	*/
	function BlockStartNr(){
		return $this->csx+1;
	}
	/**
	* returns the real block end number
	*/
	function BlockEndNr(){
		if($this->nextIndex()){
			return $this->csx+$this->max_nr;
		}else{
			if($this->blkcount==1) return $this->csx+1;
				else return $this->csx+$this->blkcount;
		}
	}
	/**
	* Creates a link for sorting
	*/
	function SortLink($txt,$item,$dir,$flag=0,$append=''){
		if(empty($txt)) $txt='Sort';
		
		if(empty($dir)){
			if($this->sort_dir=='ASC') $dir='DESC';
				else $dir='ASC';
		}else{
			if($dir=='ASC') $dir='DESC';
				else $dir='ASC';
		}
		if($flag){
			if($dir=='ASC'){
				$img = '<img '.createComIcon($this->rootpath,'arrow_red_dwn_sm.gif','0').'>';
			}else{
				$img ='<img '.createComIcon($this->rootpath,'arrow_red_up_sm.gif','0').'>';
			}
		}else{
			$img='&nbsp;';
		}
			return '<a href="'.$this->page.URL_APPEND.'&mode=paginate&pgx='.$this->csx.'&totalcount='.$this->tcount.'&oitem='.$item.'&odir='.$dir.$append.'">'.$img.$txt.'</a>';
	}
	/**
	* Creates a link for sorting, improved version of SortLink
	*/
	function makeSortLink($txt,$item,$oitem,$odir,$append){
		if($item==$oitem) $flag=TRUE;
			else $flag=FALSE;
		return $this->SortLink($txt,$item,$odir,$flag,$append);
	}

	/**
	* sets the order item
	*/
	function setSortItem($item){
		$this->sort_item=$item;
	}
	/**
	* sets the order direction
	*/
	function setSortDirection($dir){
		$this->sort_dir=$dir;
	}
}
?>
