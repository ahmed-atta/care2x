<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_news_get.php",$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

if(defined('LANG_DEPENDENT') && (LANG_DEPENDENT==1))
{
		$str_sql="SELECT head_file,main_file,pic_file FROM ".$dbtable." 
					WHERE category='".$news_category."' 
					    AND lang = '".$lang."'";
}
else
{
		$str_sql="SELECT head_file,main_file,pic_file FROM ".$dbtable." 
					WHERE category='".$news_category."'";
}
						
		$stat_pending=" AND status<>'pending'";
		$order_by_desc=" ORDER BY create_time DESC";

		for($i=1;$i<=$news_num_stop;$i++) 
		{
		  $sql=$str_sql." AND art_num='".$i."'";
		  $publish_when=" AND publish_date='".$today."'";
          if(defined('MODERATE_NEWS') && (MODERATE_NEWS==1))
		  {
		 	 $sql.=$publish_when.$stat_pending;
          }
		  else
		  {
		     $sql.=$publish_when;
		  }
		  
		  $sql.=$order_by_desc;
			
			if($ergebnis=mysql_query($sql,$link))
       		{
				if($rows=mysql_num_rows($ergebnis))
				{
					$art[$i]=mysql_fetch_array($ergebnis);
				}
				else // if no file found get the last entry
				{
		          
				  $sql=$str_sql." AND art_num='".$i."'";
				  $publish_when=" AND publish_date<'".$today."'";
                  
				  if(defined('MODERATE_NEWS') && (MODERATE_NEWS==1))
		          {
					$sql.=$publish_when.$stat_pending;
                  }
		          else
		          {
					$sql.=$publish_when;
				  }									
				
				  $sql.=$order_by_desc;
				  			
				   if($ergebnis=mysql_query($sql,$link))
       			   {
					  if($rows=mysql_num_rows($ergebnis))
					  {
						$art[$i]=mysql_fetch_array($ergebnis);
					  }
				   }
				}
			}
		}
?>
