<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.09 - 2003-11-25
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
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
					
					if($rows=$ergebnis->RecordCount())
					{
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
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY bgcolor="#ffffff" onLoad="if (window.focus) window.focus()">
<table border=0 cellpadding=1 cellspacing=1>
  <tr>
    <td><pre><?php echo $LDFrom; ?></td>
    <td><pre><b><?php echo $content['sender']; ?></b></td>
  </tr>
  <tr>
    <td><pre><?php echo $LDReply2; ?></td>
    <td><pre><b><?php echo $content['reply2']; ?></b></td>
  </tr>
  <tr>
    <td><pre><?php echo $LDTo; ?></td>
    <td><pre><b><?php echo $content['recipient']; ?></b></td>
  </tr>
  <tr>
    <td><pre>CC</td>
    <td><pre><b><?php echo $content['cc']; ?></b></td>
  </tr>
  <tr>
    <td><pre>BCC</td>
    <td><pre><b><?php echo $content['bcc']; ?></b></td>
  </tr>
  <tr>
    <td><pre><?php echo $LDSubject; ?></td>
    <td><pre><b><?php echo $content['subject']; ?></b></td>
  </tr>
<!--   <tr>
    <td><pre><?php echo $LDAttach; ?></td>
    <td><pre></td>
  </tr>
 -->  <tr>
    <td><pre><?php echo $LDDate.':'.$LDTime; ?></td>
    <td><pre><?php echo '<b>'.formatDate2Local($content['send_dt'],$date_format).' '.convertTimeToLocal(formatDate2Local($content['send_dt'],$date_format,0,1)).'</b>'; ?></td>
  </tr>
</table>

<pre>
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
