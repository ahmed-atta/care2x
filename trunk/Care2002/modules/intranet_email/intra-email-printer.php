<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','intramail.php');
$local_user='ck_intra_email_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);

$dbtable='care_mail_private';

/* Establish db connection */
if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
if($dblink_ok) {
    /* Load the date formatter */
    include_once($root_path.'include/inc_date_format_functions.php');
    

		switch($folder)
		{
			case "inbox":$sql='SELECT * FROM '.$dbtable.' WHERE  sender="'.$from.'" 
																AND send_dt="'.$date.'" 
																AND send_stamp="'.$s_stamp.'"'; break;
		 	case "sent": $sql='SELECT * FROM '.$dbtable.' WHERE  recipient="'.$from.'" 
																AND send_dt="'.$date.'" 
																AND send_stamp="'.$s_stamp.'"'; break;
			default: $sql='SELECT * FROM '.$dbtable.' WHERE  ( sender="'.$from.'" OR recipient="'.$from.'" )
																AND send_dt="'.$date.'" 
																AND send_stamp="'.$s_stamp.'"'; break;
		}
				if($ergebnis=$db->Execute($sql))
				{ 
					$rows=0;
					while($content=$ergebnis->FetchRow()) $rows++;	
					if($rows)
					{
						mysql_data_seek($ergebnis,0);
						$content=$ergebnis->FetchRow();
						// update user to tag the file as read
					} //end of if rows
					else
					{
						$mailok=0;
					}
				}else { echo "$LDDbNoRead<br>$sql"; } 
}
  		else { echo "$LDDbNoLink<br>$sql"; } 

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <script language="javascript" >
<!-- 
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script> 

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY bgcolor="#ffffff" onLoad="if (window.focus) window.focus()">
<pre><?php
echo '
'.$LDFrom.': <b>'.$content['sender'].'</b>
'.$LDReply2.': <b>'.$content['reply2'].'</b>
'.$LDTo.': <b>'.$content['recipient'].'</b>
CC: <b>'.$content['cc'].'</b>
BCC: <b>'.$content['bcc'].'</b>
'.$LDSubject.': <b>'.$content['subject'].'</b>
'.$LDAttach.':
'.$LDDate.':'.$LDTime.': <b>'.formatDate2Local($content['send_dt'],$date_format).' '.convertTimeToLocal(formatDate2Local($content['send_dt'],$date_format,0,1)).'</b>';

?>
<hr>
<?php
//$content[body]=chunk_split($content[body],100);
echo nl2br($content['body']);
?>
<hr>
</pre><p><FONT face="verdana,Arial" size=2 >
<b>< <a href="javascript:window.print()"><?php echo $LDPrint ?></a> ></b><p>
<b>< <a href="javascript:window.close()"><?php echo $LDClose ?></a> ></b>
</FONT>


</BODY>
</HTML>
