<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_intra_email_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_intramail.php");
require("../req/config-color.php"); // load color preferences

$thisfile="intra-email-read.php";

$dbtable="mail_private";

$linecount=0;
$modetypes=array("sendmail","listmail");
$breakfile="intra-email.php.?sid=$ck_sid&lang=$lang&mode=listmail";


require("../req/db-makelink.php");
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
						if(!$read)
						{
							$dbtable="mail_private_users";
							$sql='SELECT '.$folder.', lastcheck FROM '.$dbtable.' WHERE  email="'.$ck_intra_email_user.'"';
							if($ergebnis=mysql_query($sql,$link)) 
							{			
						  		$rows=0;
								while($result=mysql_fetch_array($ergebnis)) $rows++;	
								if($rows)
								{
									mysql_data_seek($ergebnis,0);
									$result=mysql_fetch_array($ergebnis);
									$inb=explode("_",trim($result[$folder]));
									for($i=0;$i<sizeof($inb);$i++)
									{
										$buf="t=$s_stamp&r=$read&f=$from&s=$subj&d=$date&z=$size";
										//print "$buf<br>$inb[$i]<br>";
										if(!strcmp($buf,trim($inb[$i])))
											{	
												$inb[$i]=str_replace("r=0","r=1",$inb[$i]);
												$result[$folder]=implode("_",$inb);
									
												$sql="UPDATE $dbtable SET $folder=\"$result[$folder]\", lastcheck=\"$result[lastcheck]\"  
																		WHERE email=\"$ck_intra_email_user\"";	
												if(!mysql_query($sql,$link))  { print "$LDDbNoUpdate<br>$sql"; } 
											}
									}
								}
							}else { print "$LDDbNoRead<br>$sql"; } 

						}// end of if !read
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

function submitForm(r)
{
	d=document.mailform;
	d.reply.value=r;
	d.submit();
}

function printer_v()
{
<?		$buf="&s_stamp=$content[send_stamp]&from=$content[sender]&date=".strtr($content[send_dt]," ","+")."&folder=$folder";
?>
	urlholder="intra-email-printer.php?sid=<? print "$ck_sid&lang=$lang$buf"; ?>";
	printwin=window.open(urlholder,"printwin","width=700,height=600,menubar=no,resizable=yes,scrollbars=yes");
	//window.location.href=urlholder
	}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script> 

<? 
require("../req/css-a-hilitebu.php");
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?=$test ?>
<? //foreach($argv as $v) print "$v "; ?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="30"><FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?="$LDIntraEmail - $LDRead" ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" align=right><a href="javascript:history.back();"><img 
src="../img/<?="$lang/$lang" ?>_back2.gif" border=0 width=110 height=24 align="absmiddle" 
style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a 
href="javascript:gethelp('intramail.php','read','<?=$mode ?>','<?=$folder ?>')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?=$breakfile ?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2>

<FONT face="Verdana,Helvetica,Arial" size=2>
<?

 print '
<FONT face="Verdana,Helvetica,Arial" size=2>
  &nbsp; <b><a href="intra-email.php?sid='.$ck_sid.'&lang='.$lang.'&mode=listmail">'.$LDInbox.'</a> | <a href="intra-email.php?sid='.$ck_sid.'&lang='.$lang.'&mode=compose">'.$LDNewEmail.'</a> | <a href="intra-email-addrbook.php?sid='.$ck_sid.'&lang='.$lang.'&mode='.$mode.'&folder='.$folder.'">'.$LDAddrBook.'</a> | <a href="intra-email-options.php?sid='.$ck_sid.'&lang='.$lang.'">'.$LDOptions.'</a> | <a href="javascript:gethelp(\'intramail.php\',\'read\',\''.$mode.'\',\''.$folder.'\')">'.$LDHelp.'</a></b>
  <hr color=#000080>
   &nbsp; <FONT  color="#800000">'.$ck_intra_email_user.'</font> &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
   <font size=1><a href="intra-email.php?sid='.$ck_sid.'&lang='.$lang.'&mode=listmail&l2h='.$l2h.'&folder='.$folder.'">
   <img src="../img/l_arrowGrnSm.gif" width=12 height=12 border=0 align=middle> '.$LDBack2.' ';
switch($folder)
{
		case "inbox": print $LDInbox; break;
		case "sent": print $LDSent; break;
		case "drafts": print $LDDrafts; break;
		case "trash": print $LDRecycle; break;
}
print '</a></font>';
// ******************************** Read email ***************************************
if(1)
{
print '<ul><form name="mailform" action="intra-email.php" method="post">  
	<table border=0 cellspacing=1 cellpadding=3>
    <tr>
      <td bgcolor="#f9f9f9" align=right><FONT face="Verdana,Helvetica,Arial" size=1 color="#000080">'.$LDFrom.':</td>
      <td   bgcolor="#f9f9f9"><FONT face="Verdana,Helvetica,Arial" size=1 >'.$content[sender].'
          </td>
    </tr>
    <tr>
      <td bgcolor="#f9f9f9" align=right><FONT face="Verdana,Helvetica,Arial" size=1 color="#000080">'.$LDReply2.':</td>
      <td   bgcolor="#f9f9f9"><FONT face="Verdana,Helvetica,Arial" size=1 >'.$content[reply2].'
          </td>
    </tr>
    <tr>
      <td bgcolor="#f9f9f9" align=right><FONT face="Verdana,Helvetica,Arial" size=1 color="#000080">'.$LDTo.':</td>
      <td   bgcolor="#f9f9f9"><FONT face="Verdana,Helvetica,Arial" size=1 >'.$content[recipient].'
          </td>
    </tr>
      <td bgcolor="#f9f9f9" align=right><FONT face="Verdana,Helvetica,Arial" size=1 color="#000080">'.$LDCC.' (CC)</td>
      <td  bgcolor="#f9f9f9"><FONT face="Verdana,Helvetica,Arial" size=1 >'.$content[cc].'</td>
    </tr>
    <tr>
      <td bgcolor="#f9f9f9" align=right><FONT face="Verdana,Helvetica,Arial" size=1 color="#000080">'.$LDBCC.' <a href="#" title="'.$LDBCCTxt.'"><font color=#0000ff><u>(BCC)</u></font></a></td>
      <td  bgcolor="#f9f9f9"><FONT face="Verdana,Helvetica,Arial" size=1 >'.$content[bcc].'</td>
    </tr>
    <tr>
      <td bgcolor="#f9f9f9" align=right><FONT face="Verdana,Helvetica,Arial" size=1 color="#000080">'.$LDSubject.':</td>
      <td  bgcolor="#f9f9f9"><FONT face="Verdana,Helvetica,Arial" size=1 >'.$content[subject].'</td>
    </tr>';
	/*
    <tr>
      <td bgcolor="#f9f9f9" align=right><FONT face="Verdana,Helvetica,Arial" size=1 color="#000080">Anhang:</td>
      <td  bgcolor="#f9f9f9"><FONT face="Verdana,Helvetica,Arial" size=1 color="#000080"><a href="#">Zeigen <img src="../img/bul_arrowGrnSm.gif" width=12 height=12 border=0 align=absmiddle></a></td>
    </tr>
	*/
print '
  </table>
 	 <input type="hidden" name="sid" value="'.$ck_sid.'">
    <input type="hidden" name="lang" value="'.$lang.'">
    <input type="hidden" name="mode" value="compose">
  <input type="hidden" name="recipient" value="'.$content[recipient].'">
  <input type="hidden" name="sender" value="'.$content[sender].'">
  <input type="hidden" name="reply2" value="'.$content[reply2].'">
  <input type="hidden" name="send_dt" value="'.$content[send_dt].'">
  <input type="hidden" name="send_stamp" value="'.$content[send_stamp].'">
  <input type="hidden" name="folder" value="'.$folder.'">
  <input type="hidden" name="reply" value="0">';

  switch($folder)
  {
  	case "inbox": if($ck_intra_email_user!=$content[sender]) 
							{ $inp=0; print '<input type="button" value="'.$LDReply.'" onClick="submitForm(1)"> '; break; }
								else print '<input type="button" value="'.$LDBack.'" onClick="window.location.href=\'intra-email.php?sid='.$ck_sid.'&lang='.$lang.'&mode=listmail&folder=inbox&l2h='.$l2h.'\'"> '; break;
  	case "sent": if($ck_intra_email_user!=$content[recipient])
							{ $inp=1; print '<input type="button" value="'.$LDResend.'" onClick="submitForm(2)"> ';break; }
								else  print '<input type="button" value="'.$LDBack.'" onClick="window.location.href=\'intra-email.php?sid='.$ck_sid.'&lang='.$lang.'&mode=listmail&folder=sent&l2h='.$l2h.'\'"> '; break;
  	case "drafts":$inp=1; print '
 								 <input type="button" value="'.$LDNewEmail.'" onClick="submitForm(2)"> '; break;
  	case "trash":if($ck_intra_email_user!=$content[recipient])
						{	$inp=1; print ' <input type="button" value="'.$LDResend.'" onClick="submitForm(2)"> '; 	break;}
									else { $inp=0; print '  <input type="button" value="'.$LDReplyAgain.'" onClick="submitForm(1)"> ';} break;
   }
 $buf="&t=$s_stamp&r=$read&f=$from&s=".strtr($subj," ","+")."&d=".strtr($date," ","+")."&z=$size";
 if($folder!="drafts") print '
    <input type="button" value="'.$LDForward.'" onClick="submitForm(3)"> ';
		$buf="&t=$s_stamp&r=$read&f=$from&s=".strtr($subj," ","+")."&d=".strtr($date," ","+")."&z=$size";
 print '
	<input type="button" value="'.$LDDelete.'" onClick="if(confirm(\''.$LDAskDeleteMail.'\')) window.location.href=\'intra-email-delete.php?sid='.$ck_sid.'&lang='.$lang.'&maxrow=1&create=1&folder='.$folder.'&l2h='.$l2h.$buf.'\';">';
 print '
	 &nbsp; &nbsp; &nbsp; <a href="javascript:printer_v()" title="'.$LDClk4Printer.'">'.$LDPrinterVersion.' <img src="../img/bul_arrowGrnSm.gif" width=12 height=12 border=0 align=bottom></a>	
	
  </form>
  </ul>
  ';
}
 
?>
  
</FONT>
<p>
</td>
</tr>
<tr>
<td bgcolor="#ffffee"  colspan=2 height=50% valign=top>
<UL><p><br><pre>
<?
//$content[body]=chunk_split($content[body],100);
print nl2br($content[body]);
?>
</pre>
</ul>
</td>
</tr>
<tr>
<td bgcolor=<? print $cfg['bot_bgcolor']; ?>  colspan=2>

<?php
require("../language/$lang/".$lang."_copyrite.htm");

 ?>

</td>
</tr>
</table>        
&nbsp;




</FONT>


</BODY>
</HTML>
