<?php
/* API class for news article
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_core.php');

class News extends Core {

	var $tb='care_news_article'; // table name
	var $result;
	var $row;
	var $buffer;
	var $headnrs=array();
	
	function getItem($nr=0,$item='')  {
	    global $db;
	
	    if(!$nr||empty($item)) return false;

	    if ($this->result=$db->Execute("SELECT $item FROM $this->tb WHERE nr='$nr'")) {
		    if ($this->result->RecordCount()) {
		        $this->row=$this->result->FetchRow();
			    return $this->row[$item];
			} else {
			    return false;
			}
		} else {
		    return false;
		}
	}
	
	function getTitle($nr=0) {

	    if ($this->buffer=$this->getItem($nr,'title')) return $this->buffer;
			return false;
	}
	
	function getPreface($nr=0) {

	    if ($this->buffer=$this->getItem($nr,'preface')) return $this->buffer;
			return false;
	}
	
	function getBody($nr) {

	    if ($this->buffer=$this->getItem($nr,'body')) return $this->buffer;
			return false;
	}

	function getAuthor($nr) {

	    if ($this->buffer=$this->getItem($nr,'author')) return $this->buffer;
			return false;
	}

	function getPublishDate($nr) {

	    if ($this->buffer=$this->getItem($nr,'publish_date')) return $this->buffer;
			return false;
	}
	
	function getSubmitDate($nr) {

	    if ($this->buffer=$this->getItem($nr,'submit_date')) return $this->buffer;
			return false;
	}
	
	function getPicMime($nr) {

	    if ($this->buffer=$this->getItem($nr,'pic_mime')) return $this->buffer;
			return false;
	}

	
	function getNews($nr) {
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT nr,title,preface,body,pic_mime,art_num,author,publish_date,submit_date FROM $this->tb WHERE nr='$nr'")) {
		    if ($this->result->RecordCount()) {
		        return $this->result->FetchRow();
			} else {
			    return false;
			}
		} else {
		    return false;
		}
	}
	
	function getHeadlinesPreview($dept_nr=0,$count) {
	    global $db;
		
		$i=1;
		$today=date('Y-m-d');
	
		$str_sql="SELECT nr,title,preface,body,pic_mime FROM ".$this->tb." WHERE dept_nr=".$dept_nr;
						
		$stat_pending=" AND status<>'pending'";
		$order_by_desc=" ORDER BY create_time DESC";

		for($i=1;$i<=$count;$i++) 
		{
		    $sql=$str_sql." AND art_num='".$i."'";
		    $publish_when=" AND publish_date='".$today."'";
            if(defined('MODERATE_NEWS') && (MODERATE_NEWS==1)) {
		 	    $sql.=$publish_when.$stat_pending;
            } else {
		        $sql.=$publish_when;
		    }
		  
		    $sql.=$order_by_desc;
					
			if($this->result=$db->Execute($sql)) {
			    if($this->result->RecordCount()) {
				    $this->buffer[$i]=$this->result->FetchRow();
					$this->headnrs[$i]=$this->buffer[$i]['nr'];
				} else {
				 
				    // if no file found get the last entry
				    $sql=$str_sql." AND art_num='".$i."'";
				    $publish_when=" AND publish_date<'".$today."'";
                  
				    if(defined('MODERATE_NEWS') && (MODERATE_NEWS==1)) {
					    $sql.=$publish_when.$stat_pending;
                    } else {
					    $sql.=$publish_when;
				    }									
				
				    $sql.=$order_by_desc;
				  			
				    if($this->result=$db->Execute($sql)) {
					    if($this->result->RecordCount()) {
						    $this->buffer[$i]=$this->result->FetchRow();
							$this->headnrs[$i]=$this->buffer[$i]['nr'];
					    }
				   }
			    }
			}
		}
		
		if(!empty($this->buffer)) return $this->buffer;
		    else return false;
	}
	
	function getArchiveList($dept_nr=0,&$heads) {
	    global $db;
	    
		if(!$dept_nr) return false;
		
		/* Now set the sql query for article # 5 or the achived news */
        $this->sql="SELECT nr,title,preface,author,publish_date,submit_date FROM $this->tb WHERE dept_nr=".$dept_nr;
       
	   while(list($x,$v)=each($this->headnrs)) {
            $this->sql.=' AND nr<>'.$v;
        }
		
		$this->sql.=" OR (dept_nr=$dept_nr AND art_num=5)";

        if(defined('MODERATE_NEWS') && (MODERATE_NEWS==1)) {
           $this->sql.=" AND status<>'pending'";
        }
		 
        $this->sql.=" ORDER BY create_time DESC";
		 
		//echo $sql_archive;
	    if($this->res['gal']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['gal']->RecordCount())  return $this->res['gal'];
			    else return false;
	    }
	}
	
	function getList($dept_nr=0) {
	    global $db;
	    
		if(!$dept_nr) return false;
		
		/* Now set the sql query for article # 5 or the achived news */
        $sql_archive="SELECT nr,title,author,publish_date,submit_date FROM $this->tb WHERE dept_nr=".$dept_nr;
					
        if(defined('MODERATE_NEWS') && (MODERATE_NEWS==1)) {
           $sql_archive.=" AND status<>'pending'";
        }
		 
        $sql_archive.=" ORDER BY create_time DESC";
		  							
	    if($this->result=$db->Execute($sql_archive)) {
            if($this->result->RecordCount())  return $this->result;
			    else return false;
	    }
	}
	
	function getShortPreviewList($dept_nr=0) {
	    global $db;
	    
		if(!$dept_nr) return false;
		
		/* Now set the sql query for article # 5 or the achived news */
        $sql_archive="SELECT nr,title,preface,pic_mime,author,publish_date,submit_date FROM $this->tb WHERE dept_nr=".$dept_nr;
					
        if(defined('MODERATE_NEWS') && (MODERATE_NEWS==1)) {
           $sql_archive.=" AND status<>'pending'";
        }
		 
        $sql_archive.=" ORDER BY create_time DESC";
		  							
	    if($this->result=$db->Execute($sql_archive)) {
            if($this->result->RecordCount())  return $this->result;
			    else return false;
	    }
	}
	
	function saveNews($dept_nr=0, &$news) {
	    global $db, $lang, $HTTP_SESSION_VARS;
	    
		if(!$dept_nr) return false;
				
		$sql="INSERT INTO $this->tb
						(	
						    lang,
							dept_nr,
							category,
							title,
							preface,
							body,
							pic_mime,
							art_num,
							author,
							submit_date,
							publish_date,
							modify_id,
							create_id,
							create_time
							) VALUES 
						(	
							'".$lang."',
							'".$dept_nr."',
							'".addslashes($news['category'])."',
							'".addslashes($news['title'])."',
							'".addslashes($news['preface'])."',
							'".addslashes($news['body'])."',
							'".$news['pic_mime']."',
							'".$news['art_num']."',
							'".$news['author']."',
							'".date('Y-m-d H:i:s')."',
							'".$news['publish_date']."',
							'".$HTTP_SESSION_VARS['sess_user_name']."',
							'".$HTTP_SESSION_VARS['sess_user_name']."',
							NULL
							)";
		  							
	    if($this->result=$db->Execute($sql)) {
            return $db->Insert_ID();
		} else return false;
	}
	
}
?>
