<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_currency_set.php",$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

require("../include/inc_db_makelink.php");
if ($link&&$DBLink_OK)
{

 if(($mode=="save")&&$old_main_item&&$new_main_item&&($old_main_item!=$new_main_item))
 {
  	$new_main_currency=0;
    $sql="UPDATE care_currency SET status='' WHERE item_no=".$old_main_item;
	$date_result=mysql_query($sql,$link);
	if(mysql_affected_rows($link))
	{
       $sql="UPDATE care_currency SET status='main', modify_id='".$HTTP_COOKIE_VARS['ck_cafenews_user'.$sid]."' WHERE item_no=".$new_main_item;
	   $date_result=mysql_query($sql,$link);
	   if(mysql_affected_rows($link))
	  {
  	      $new_main_currency=1;
      }
	  else
       $sql="UPDATE care_currency SETstatus='main' WHERE item_no=".$old_main_item;
	   $date_result=mysql_query($sql,$link);  
    }

 }  

  $sql="SELECT * FROM care_currency WHERE status<>'hidden'";
  if($ergebnis=mysql_query($sql,$link))
  {
     $rows=mysql_num_rows($ergebnis);
  } // else get default from ini file
  
} else { echo "$LDDbNoLink<br> $sql<br>"; }

?>
