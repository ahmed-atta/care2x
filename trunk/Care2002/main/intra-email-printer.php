<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","intramail.php");
$local_user="ck_intra_email_user";
require("../include/inc_front_chain_lang.php");

$thisfile="intra-email-printer.php";

$dbtable="mail_private";

require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK) 
	{	
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
				if($ergebnis=mysql_query($sql,$link))
				{ 
					$rows=0;
					while($content=mysql_fetch_array($ergebnis)) $rows++;	
					if($rows)
					{
						mysql_data_seek($ergebnis,0);
						$content=mysql_fetch_array($ergebnis);
						// update user to tag the file as read
					} //end of if rows
					else
					{
						$mailok=0;
					}
				}else { print "$LDDbNoRead<br>$sql"; } 
	}
  		else { print "$LDDbNoLink<br>$sql"; } 

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
require("../include/inc_css_a_hilitebu.php");
?>


</HEAD>

<BODY bgcolor="#ffffff" onLoad="if (window.focus) window.focus()">
<pre><?php
print '
'.$LDFrom.': <b>'.$content[sender].'</b>
'.$LDReply2.': <b>'.$content[reply2].'</b>
'.$LDTo.': <b>'.$content[recipient].'</b>
CC: <b>'.$content[cc].'</b>
BCC: <b>'.$content[bcc].'</b>
'.$LDSubject.': <b>'.$content[subject].'</b>
'.$LDAttach.':
'.$LDDate.':'.$LDTime.': <b>'.$content[send_dt].'</b>';

?>
<hr>
<?php
//$content[body]=chunk_split($content[body],100);
print nl2br($content[body]);
?>
<hr>
</pre><p><FONT face="verdana,Arial" size=2 >
<b>< <a href="javascript:window.print()"><?php echo $LDPrint ?></a> ></b><p>
<b>< <a href="javascript:window.close()"><?php echo $LDClose ?></a> ></b>
</FONT>


</BODY>
</HTML>
