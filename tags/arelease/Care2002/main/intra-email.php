<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_intra_email_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_intramail.php");
require("../req/config-color.php"); // load color preferences

$thisfile="intra-email.php";
if(!$folder) $folder="inbox";
//init db parameters
$dbtable="mail_private";
$breakfile="intra-email-pass.php?sid=$ck_sid&lang=$lang";

$linecount=0;
$modetypes=array("sendmail","listmail","compose");

if(in_array($mode,$modetypes)) 
{
	include("../req/db-makelink.php");
	if($link&&$DBLink_OK)  
	{	
					// sendmail (save to db) module
		switch($mode)
		{
			case "sendmail";
			{
						$uid=uniqid("");
						$sdate=date(YmdHis);
						$sql="INSERT INTO $dbtable
						(	recipient,
							sender,
							sender_ip,
							cc,
							bcc,
							subject,
							body,
							sign,
							ask4ack,
							reply2,
							attachment,
							attach_type,
							read_flag,
							mailgroup,
							maildir,
							exec_level,
							exclude_addr,
							send_dt,
							send_stamp,
							uid
							 ) 
						VALUES (
							'$recipient',
							'$ck_intra_email_user',
							'$REMOTE_ADDR',
							'$cc', 
							'$bcc', 
							'$subject',
							'$body_txt',
							'',
							'$ack', 
							'$ck_intra_email_user', 
							'', 
							'', 
							'0', 
							'', 
							'', 
							'1', 
							'',
							'".strftime("%d.%m.%Y %H.%M")."',
							'$sdate',
							'$uid'
							)";
					  /// the send_stamp is left out to force its auto update
						if(mysql_query($sql,$link))
						{ 
							$saveok=true;
							$sendok=1;
						//	if($folder=="inbox") $folder="sent";
							//print "q ok ".$sql;
							$dbtable="mail_private_users";
							$sql="SELECT $folder, lastcheck FROM $dbtable WHERE email=\"$ck_intra_email_user\"";
							if($ergebnis=mysql_query($sql,$link))
							{
								$content=mysql_fetch_array($ergebnis);
								if(strlen($subject)>30) $sub=substr($subject,0,30)."...";
									else $sub=$subject;
								$buf="t=$sdate&r=1&f=$recipient&s=$sub&d=".strftime("%d.%m.%Y %H.%M")."&z=".strlen($body_txt)."&u=$uid\r\n";
								if($content[$folder]=="") $content[$folder]=$buf;
									else  $content[$folder].="_".$buf;
									
								$sql="UPDATE $dbtable SET $folder=\"$content[$folder]\" , lastcheck=\"$content[lastcheck]\" 
																WHERE email=\"$ck_intra_email_user\"";	
								if(!mysql_query($sql,$link)) { print "$LDDbNoUpdate<br>$sql"; } 

							}else { print "$LDDbNoRead<br>$sql"; } 
						}else { print "$LDDbNoSave<br>$sql"; } 
						break;
			}// end of sendmail module
			case "listmail":
			{
				// set dbtable to users
				$dbtable="mail_private_users";
				// get the last check timestamp
				$sql='SELECT '.$folder.', lastcheck FROM '.$dbtable.' WHERE email="'.$ck_intra_email_user.'"';
				if($ergebnis=mysql_query($sql,$link))
				{ 
					$rows=0;
					while($content=mysql_fetch_array($ergebnis)) $rows++;	
					if($rows==1)
					{
					  mysql_data_seek($ergebnis,0);
					  $content=mysql_fetch_array($ergebnis);
					  if($folder=="inbox")
					  {	
						// if last check time stamp found check for  new mails
						$dbtable="mail_private";
						$sql="SELECT * FROM $dbtable WHERE ( recipient LIKE \"%$ck_intra_email_user%\" 
																	OR cc LIKE \"%$ck_intra_email_user%\" 
																	OR bcc LIKE \"%$ck_intra_email_user%\")
																	AND send_stamp>$content[lastcheck]";
						//print $sql;
						if($ergebnis=mysql_query($sql,$link))
							{ 
								$rows=0;
								while($mails=mysql_fetch_array($ergebnis)) $rows++;		
								if($rows)
								{
									$newmail=1;		
									mysql_data_seek($ergebnis,0);
									while ($mails=mysql_fetch_array($ergebnis))
									{
										if(strlen($mails[subject])>30) $sub=substr($mails[subject],0,30)."...";
										 	else $sub=$mails[subject];
										$buf="t=$mails[send_stamp]&r=0&f=$mails[sender]&s=$sub&d=$mails[send_dt]&z=".strlen($mails[body])."\r\n";
										if($content[inbox]=="") $content[inbox]=$buf;
											else  $content[inbox].="_".$buf;
									}
									$dbtable="mail_private_users";
									$sql="UPDATE $dbtable SET inbox=\"$content[inbox]\" 
																		WHERE email=\"$ck_intra_email_user\"";	
									if(!mysql_query($sql,$link)) { print "$LDDbNoUpdate<br>$sql"; } 
									//print $sql;
								}
							}else { print "$LDDbNoRead<br>$sql"; } 
				  		 } // end of if folder == inbox
					}
					else
					{
						// if last check data not available 
						$userok=0;
					}
				}else {print "$db_sqlquery_fail<p> $sql <p>Das Speichern der Daten is gescheitert.";};
				
				// get the number of filed mails in every folder
				$dbtable="mail_private_users";
				if($folder!="inbox") 
				 {$sql="SELECT inbox FROM $dbtable WHERE  email=\"$ck_intra_email_user\"";
					if($ergebnis=mysql_query($sql,$link)) 
					{
						$folnum=0;
						while ($cont=mysql_fetch_array($ergebnis)) $folnum++;
						if($folnum)
						{
							mysql_data_seek($ergebnis,0);
							$cont=mysql_fetch_array($ergebnis);
							$bufa=explode("_",$cont[inbox]);
							if((sizeof($bufa)==1)&&($bufa[0]=="")) $inbnum=0; else $inbnum=sizeof($bufa);
						}
					}
				}
				else 
				{ $newmails=0; $newmails=substr_count($content[inbox],"r=0");}
				
				if($folder!="sent") 
				 {$sql="SELECT sent FROM $dbtable WHERE  email=\"$ck_intra_email_user\"";
					if($ergebnis=mysql_query($sql,$link)) 
					{
						$folnum=0;
						while ($cont=mysql_fetch_array($ergebnis)) $folnum++;
						if($folnum)
						{
							mysql_data_seek($ergebnis,0);
							$cont=mysql_fetch_array($ergebnis);
							$bufa=explode("_",$cont[sent]);
							if((sizeof($bufa)==1)&&($bufa[0]=="")) $sentnum=0; else $sentnum=sizeof($bufa);
						}
					}
				}
				if($folder!="drafts") 
				 {$sql="SELECT drafts FROM $dbtable WHERE  email=\"$ck_intra_email_user\"";
					if($ergebnis=mysql_query($sql,$link)) 
					{
						$folnum=0;
						while ($cont=mysql_fetch_array($ergebnis)) $folnum++;
						if($folnum)
						{
							mysql_data_seek($ergebnis,0);
							$cont=mysql_fetch_array($ergebnis);
							$bufa=explode("_",$cont[drafts]);
							if((sizeof($bufa)==1)&&($bufa[0]=="")) $drafnum=0; else $drafnum=sizeof($bufa);
						}
					}
				}
				if($folder!="trash") 
				 {$sql="SELECT trash FROM $dbtable WHERE  email=\"$ck_intra_email_user\"";
					if($ergebnis=mysql_query($sql,$link)) 
					{
						$folnum=0;
						while ($cont=mysql_fetch_array($ergebnis)) $folnum++;
						if($folnum)
						{
							mysql_data_seek($ergebnis,0);
							$cont=mysql_fetch_array($ergebnis);
							$bufa=explode("_",$cont[trash]);
							if((sizeof($bufa)==1)&&($bufa[0]=="")) $trasnum=0; else $trasnum=sizeof($bufa);
						}
					}
				}
				break;
			}// end of case listmail
			
		} // end of switch mode

	if(($mode=="sendmail")||($mode=="compose"))
			{
				// set dbtable to users
				$dbtable="mail_private_users";
				$sql="SELECT addr_quick FROM $dbtable WHERE  email=\"$ck_intra_email_user\"";
					if($ergebnis=mysql_query($sql,$link)) 
					{
						$rows=0;
						while ($content=mysql_fetch_array($ergebnis)) $rows++;
						if($rows)
						{
							mysql_data_seek($ergebnis,0);
							$content=mysql_fetch_array($ergebnis);
							$qa=explode("; ",trim($content[addr_quick]));
							//foreach($qa as $v) print $v;
						}
					}else { print "$LDDbNoRead<br>$sql"; } 
			} // end of if mode sendmail or compose
	 if($reply)
	 {
	 	$dbtable="mail_private";
		if($reply<2)   $sql='SELECT subject, body '; else $sql='SELECT * ';
		$sql.='FROM '.$dbtable.' WHERE  recipient="'.$recipient.'" 
																AND sender="'.$sender.'" 
																AND reply2="'.$reply2.'" 
																AND send_dt="'.$send_dt.'" 
																AND send_stamp="'.$send_stamp.'"'; 
				if($ergebnis=mysql_query($sql,$link))
				{ 
					$rows=0;
					while($content=mysql_fetch_array($ergebnis)) $rows++;	
					if($rows)
					{
						mysql_data_seek($ergebnis,0);
						$content=mysql_fetch_array($ergebnis);
						$subject=$content[subject];
						switch($reply)
						{
							case 1:	if($reply2) $recipient=$reply2; else $recipient=$sender;
										$body_txt="\r\n\r\n\r\n\r\n\r\n\r\n$sender schrieb: am: $send_dt Uhr\r\n****\r\n".$content[body];
										break;
    						case 2: $recipient=$content[recipient];
										$ack=$content[ask4ack];
										$cc=$content[cc];
										$bcc=$content[bcc];
										$subject=$content[subject];
										$body_txt=$content[body];
										break;
							case 3:	$recipient=""; $subject=$content[subject]; 
$body_txt="Forward>>
Original Nachricht:
An: $content[recipient]
Von: $content[sender]";
if($content[cc]) $body_txt.="
CC: $content[cc]";
if($content[bcc]) $body_txt.="
BCC: $content[bcc]";

$body_txt.="

$content[body]";
										break;
														
						}
					}
				}else { print "$LDDbNoRead<br>$sql"; } 
				//print $sql;
	  } // end of if reply
	}
  		else { print "$LDDbNoLink<br>$sql"; } 
} // end of if mode!=""


?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <script language="javascript" >
<!-- 
var feld="recipient";
<?
if($mode=="listmail")
print '
function chkDelete(d,m)
{
 	for (i=0;i<m;i++){
							if(eval("d.del"+i+".checked"))
								if(confirm("'.$LDConfirmDelete.'")) return true;
								else {
											for (i=0;i<m;i++) if(eval("d.del"+i+".checked")) eval("d.del"+i+".checked=false");
											d.sel_all.checked=false;
											break;
										}
							}
	return false;		
}

function selectAll(s,m)
{
	if(s.checked) v="true"; else v="false";
	d=document.listform;
	for(i=0;i<m;i++) eval("d.del"+i+".checked="+v);
}
';
?>
<? if(($mode=="compose")||($mode=="sendmail")) : ?>

function save2draft()
{
	d=document.mailform;
	d.folder.value="drafts";
	if(d.subject.value=="") d.subject.value="<?=$LDSubject ?>:";
	d.submit();
}

function chkCompose(d)
{
	if((d.recipient.value=="")&&(d.folder.value!="drafts"))
	{
		alert("<?=$LDAlertNoRecipient ?>");
		d.recipient.focus();
		return false;
	}
	if((d.subject.value=="")||(d.subject.value=="Betreff:"))
	{
		if(confirm("<?=$LDAlertNoSubject ?>")) return true;
		d.subject.focus();
		return false;
	}
	if((d.body_txt.value==""))
	{
		alert("<?=$LDAlertNoText ?>");
		d.body_txt.focus();
		return false;
	}

}
	function useadd(a)
	{
		if (feld=="subject") 
		{	document.mailform.subject.focus();
			return;
		}
		if(eval("document.mailform."+feld+".value==''")) eval("document.mailform."+feld+".value=a");
			else eval("document.mailform."+feld+".value=document.mailform."+feld+".value + '; '+a");
		eval("document.mailform."+feld+".focus()");
	}
	
function showAll()
{
	url="intra-email-showaddr.php?sid=<? print "$ck_sid&lang=$lang&mode=$mode&folder=$folder&l2h=$l2h" ?>";
	//window.location.href=url;
	addrwin=window.open(url,"addrwin","width=600,height=500,menubar=no,resizable=yes,scrollbars=yes");
}
function chgQuickAddr()
{
	url="intra-email-chgQaddr.php?sid=<?="$ck_sid&lang=$lang&eadd=$ck_intra_email_user" ?>";
	addrwin=window.open(url,"addrwin","width=600,height=500,menubar=no,resizable=yes,scrollbars=yes");
}
<? endif ?>
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
<?
if($mode=="compose") print ' onLoad="document.mailform.recipient.focus()"';
 if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?=$test ?>
<? //foreach($argv as $v) print "$v "; ?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="30">
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?=$LDIntraEmail ?> - 
<?
if($mode=="compose") print $LDComposeMail;	
 else switch($folder)
	{
		case "inbox": print $LDInbox; break;
		case "sent": print $LDSent; break;
		case "drafts": print $LDDrafts; break;
		case "trash": print $LDRecycle; break;
		default: 
	}				
?>
</STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" align=right><a href="javascript:history.back();"><img 
src="../img/<?="$lang/$lang" ?>_back2.gif" border=0 width=110 height=24 align="absmiddle" 
style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a 
href="javascript:gethelp('intramail.php','mail','<?=$mode ?>','<?=$folder ?>','<?=$sendok ?>')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?=$breakfile ?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2>

<FONT face="Verdana,Helvetica,Arial" size=2>
<?
//********************************************** login ***************************************
 print '
<FONT face="Verdana,Helvetica,Arial" size=2>
  &nbsp; <b>';
  if($mode!="listmail") print '<a href="intra-email.php?sid='.$ck_sid.'&lang='.$lang.'&mode=listmail">'.$LDInbox.'</a> | ';
  	else print $LDInbox.' | ';
  if($mode!="compose") print '<a href="intra-email.php?sid='.$ck_sid.'&lang='.$lang.'&mode=compose">'.$LDNewEmail.'</a> | ';
  	else print $LDNewEmail.' | ';
	print '<a href="intra-email-addrbook.php?sid='.$ck_sid.'&lang='.$lang.'&mode='.$mode.'&folder='.$folder.'">'.$LDAddrBook.'</a> | <a href="intra-email-options.php?sid='.$ck_sid.'&lang='.$lang.'">'.$LDOptions.'</a> | <a href="javascript:gethelp(\'intramail.php\',\'mail\',\''.$mode.'\',\''.$folder.'\',\''.$sendok.'\')">'.$LDHelp.'</a></b>
  <hr color=#000080>
   &nbsp; <FONT  color="#800000">'.$ck_intra_email_user.'</font><br>
';
// ******************************** Compose*****************************************
if(($mode=="compose")||($mode=="sendmail"))
{
print '<ul><form name="mailform" action="'.$thisfile.'" method="post" onSubmit="return chkCompose(this)">';
	if(($mode=="sendmail")&&($sendok)) 
	{

		print '<img src="../img/catr.gif" border=0 width=88 height=80 align=middle><font color="#0000ff" size=3> <b>';
		if($folder=="drafts") print $LDEmail2Drafts;
		 else print $LDEmailSent;
		 print '</b></font>';
	}
print '
  
<table border=0 cellspacing=1 cellpadding=3>
    <tr>
      <td bgcolor="#f3f3f3" align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDRecipient.':</td>
      <td   bgcolor="#f3f3f3"><FONT face="Verdana,Helvetica,Arial" size=2 >';
	  if($sendok) print $recipient; else print '<input type="text" name="recipient" size=40 maxlength=40 value="'.$recipient.'" onFocus="feld=\'recipient\'">';
	  print '
          </td>
      <td   rowspan=6 bgcolor="#f3f3f3" valign=top>';
	  if(!$sendok) 
	  {
	  	print '
	  			<FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">
	  							'.$LDQuickAddr.':</font><FONT face="Verdana,Helvetica,Arial" size=2><p>';
						for($i=0;$i<sizeof($qa);$i++)
						{	
								print '
	  							 <a href="javascript:useadd(\''.$qa[$i].'\')" title="'.$LDInsertAddr.'" ><img src="../img/arrow-blu.gif" width=12 height=12 border=0 align=middle> '.$qa[$i].'</a><br>';
						}
		print '
                        <p><input type="button" value="'.$LDShowAll.'" onClick="showAll()">
                            <input type="button" value="'.$LDChange.'" onClick="chgQuickAddr()">
                            <br>';
		}
	print '
          </td>
    </tr>
    <tr>
      <td bgcolor="#f3f3f3""&nbsp;</td>
      <td   bgcolor="#f3f3f3">';
	  if(!$sendok)
	  {
	  	print '
	  	<input type="checkbox" name="ack" value="1" ';
 		if($ack) print "checked"; 
 		print '><FONT face="Verdana,Helvetica,Arial" size=1>'.$LDAskAck;
 		}
	print '
          </td>
    </tr>
    <tr>
      <td bgcolor="#f3f3f3" align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDCC.' (CC)</td>
      <td  bgcolor="#f3f3f3">';
	  if($sendok) print '<FONT face="Verdana,Helvetica,Arial" size=2 >'.$cc;
	  	else print '<input type="text" name="cc" size=40 maxlength=40 value="'.$cc.'" onFocus="feld=\'cc\'">';
	print '
	</td>
    </tr>
    <tr>
      <td bgcolor="#f3f3f3" align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDBCC.' <a href="#" title="'.$LDBCCTxt.'"><font color="#0000ff"><u>(BCC)</u></font></a></td>
      <td  bgcolor="#f3f3f3">';
	   if($sendok) print '<FONT face="Verdana,Helvetica,Arial" size=2 >'.$bcc;
	  	else print '<input type="text" name="bcc" size=40 maxlength=40 value="'.$bcc.'" onFocus="feld=\'bcc\'">';
	print '
	</td>
    </tr>
    <tr>
      <td bgcolor="#f3f3f3" align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDSubject.':</td>
      <td  bgcolor="#f3f3f3">';
	  if($sendok) print '<FONT face="Verdana,Helvetica,Arial" size=2 >'.$subject;
	  	else print '<input type="text" name="subject" size=40 maxlength=150 value="'.$subject.'"  onFocus="feld=\'subject\'">';
	print '
	</td>
    </tr>';
 /*   <tr>
      <td bgcolor="#f3f3f3" align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">Anhang:</td>
      <td  bgcolor="#f3f3f3"><input type="button" name="attach"  value="Einfügen/Aktualisieren" ></td>
    </tr>
*/
 		print'
 	   <tr>
      <td colspan=3 bgcolor="#f3f3f3">';
	  if(!$sendok)
	  {
			print '
	       <input type="submit" value="'.$LDSend.'">';
			if($folder!="drafts") print '
 			<input type="button" value="'.$LDSave2Draft.'"  onClick=save2draft()>';
 			print '
 	 			<input type="reset" value="'.$LDReset.'" align=right onClick=document.mailform.recipient.focus()>      
			   <br><textarea name="body_txt" cols=77 rows=14 wrap="physical">'.$body_txt.'</textarea><br>
         		<input type="submit" value="'.$LDSend.'">
			 ';
			if($folder!="drafts") print '
 			<input type="button" value="'.$LDSave2Draft.'"  onClick=save2draft()>';
			print ' 
		     <input type="reset" value="'.$LDReset.'"  onClick=document.mailform.recipient.focus()>';
	}
	else print '<FONT face="Verdana,Helvetica,Arial" size=2 >'.nl2br($body_txt);
	print '
	    </td>
    </tr>
    <tr>
      <td bgcolor="#f3f3f3"></td>
      <td bgcolor="#f3f3f3" colspan=2  align=right>
                                    </td>
    </tr>
  </table>
 	 <input type="hidden" name="sid" value="'.$ck_sid.'">
 	 <input type="hidden" name="lang" value="'.$lang.'">
    <input type="hidden" name="mode" value="sendmail">
	<input type="hidden" name="folder" value="sent">
   </form>
  </ul>
  ';
}
//******************************************* list mail *******************************
 if($mode=="listmail")
 { 	// prepare inbox for display
	$arrlist=explode("_",$content[$folder]);
	if(!$l2h) rsort($arrlist); else sort($arrlist); 
	reset($arrlist);
	$maxrow=sizeof($arrlist);
	if(($maxrow==1)&&($arrlist[0]=="")) $maxrow=0;
	
	print'
  <table border=0>
    <tr>
      <td valign=top><FONT face="Verdana,Helvetica,Arial" size=2 color="#0000f0"><nobr>
	  		';
	if($folder=="inbox") 
	print '<img src="../img/of.gif" border=0 width=17 height=14> <b>'.$LDInbox.' </b>';
		else print '<a href="'.$thisfile.'?sid='.$ck_sid.'&lang='.$lang.'&mode=listmail&l2h='.$l2h.'"><img src="../img/cf.gif" border=0 width=17 height=14> '.$LDInbox.'</a>';
	print '<font size=1 face=verdana,arial color="#0"> (';
	if($folder=="inbox") print $maxrow; else print $inbnum; 
		print ')</font>';
		
	print '<br>';
	if($folder=="sent") 
	print '<img src="../img/of.gif" border=0 width=17 height=14> <b>'.$LDSent.'</b>';
		else print '<a href="'.$thisfile.'?sid='.$ck_sid.'&lang='.$lang.'&mode=listmail&l2h='.$l2h.'&folder=sent"><img src="../img/cf.gif" border=0 width=17 height=14> '.$LDSent.'</a>';
	print '<font size=1 face=verdana,arial color="#0"> (';
	if($folder=="sent") print $maxrow; else print $sentnum; 
		print ')</font>';
		
	print '<br>';
	if($folder=="drafts") print '<img src="../img/of.gif" border=0 width=17 height=14> <b>'.$LDDrafts.'</b>';
		else print '<a href="'.$thisfile.'?sid='.$ck_sid.'&lang='.$lang.'&mode=listmail&l2h='.$l2h.'&folder=drafts"><img src="../img/cf.gif" border=0 width=17 height=14> '.$LDDrafts.'</a>';
	print '<font size=1 face=verdana,arial color="#0"> (';
	if($folder=="drafts") print $maxrow; else print $drafnum; 
		print ')</font>';
		
	print '<br>';
	if($folder=="trash") print '<img src="../img/of.gif" border=0 width=17 height=14> <b>'.$LDRecycle.'</b>';
		else print '<a href="'.$thisfile.'?sid='.$ck_sid.'&lang='.$lang.'&mode=listmail&l2h='.$l2h.'&folder=trash"><img src="../img/cf.gif" border=0 width=17 height=14> '.$LDRecycle.'</a>';
	print '<font size=1 face=verdana,arial color="#0"> (';
	if($folder=="trash") print $maxrow; else print $trasnum; 
		print ')</font>';
		
	print '<br>
	</td>
      <td valign=top><img src="../img/pixel.gif" border=0 width=10 height=1>			
	</td>
      <td valign=top><FONT face="Verdana,Helvetica,Arial" size=2>		';
if($maxrow)
{
	print '<FONT face="Verdana,Helvetica,Arial" size=5 color="#0000f0"><b>';
	switch($folder)
	{
		case "inbox": print "$LDInbox</b><br><img src='../img/c-mail.gif' border=0 width=14 height=11><font size=1 color=#0> ".str_replace("~nr~",$newmails,$LDEmailCount)."</font>"; break;
		case "sent": print $LDSent; break;
		case "drafts": print $LDDrafts; break;
		case "trash": print $LDRecycle; break;
	}
	print '</font>
		<form name="listform" action="intra-email-delete.php" method="post" onSubmit="return chkDelete(this,'.sizeof($arrlist).')">
		<input type="submit" value="'.$LDDelete.'"> &nbsp;  &nbsp; 
		<br>	<table border=0 cellspacing=0 cellpadding=0>
    <tr ><td colspan=6 height=1><img src="../img/pixel.gif" border=0 height=4 width=1></td></tr>
	 <tr bgcolor="#0060ae">
       <td>&nbsp;</td>
       <td>	<input type="checkbox" name="sel_all" value="1" onClick="selectAll(this,'.$maxrow.')"><br>
           </td>
       <td><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff">&nbsp;&nbsp;<b>';
	if($folder=="inbox") print "$LDFrom:"; else print "$LDTo:/$LDFrom:";
	print '
		</b></td>
       <td><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff">&nbsp;&nbsp;<b>'.$LDSubject.':</b></td>
       <td><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff">&nbsp;';
	   if($l2h) print '<a href="'.$thisfile.'?sid='.$ck_sid.'&lang='.$lang.'&l2h=0&mode=listmail&folder='.$folder.'" title="'.$LDSortDate.'"><img src="../img/arw_up.gif" '; else print '<a href="'.$thisfile.'?sid='.$ck_sid.'&lang='.$lang.'&l2h=1&mode=listmail&folder='.$folder.'" title="'.$LDSortDate.'"><img src="../img/arw_down.gif" ';
	   print '
	   width=12 height=20 border=0 align=absmiddle alt="'.$LDSortDate.'"> <font color="#ffffff"><b>'.$LDDate.' '.$LDTime.':</b></font></a></td>
       <td><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff">&nbsp;&nbsp;<b>'.$LDSize.':</b>&nbsp;</td>
	        </tr>';
	for($i=0;$i<sizeof($arrlist);$i++)
	   {
	    parse_str(trim($arrlist[$i]),$minfo);
		$buf="intra-email-read.php?sid=$ck_sid&lang=$lang&ua=$ck_intra_email_user&s_stamp=$minfo[t]&read=$minfo[r]&from=$minfo[f]&subj=".strtr($minfo[s]," ","+")."&date=".strtr($minfo[d]," ","+")."&size=$minfo[z]&l2h=$l2h&folder=$folder";
     	if($minfo[r]) {print '<tr bgcolor="#ffffff">';} else {print ' <tr bgcolor="#ffeeee">';}
		print '<td>&nbsp;';
		if($minfo[r]) print '<a href="'.$buf.'"><img src="../img/o-mail.gif" border=0 width=13 height=12 alt="'.$LDReadEmail.'"><br></a>';
       		else print '<img src="../img/c-mail.gif" border=0 width=14 height=11 alt="'.$LDReadEmail.'"><br>';
		$delbuf="t=$minfo[t]&r=$minfo[r]&f=$minfo[f]&s=$minfo[s]&d=$minfo[d]&z=$minfo[z]";
     	print '
       		</td>
			<td>	<input type="checkbox" name="del'.$i.'" value="'.strtr($delbuf," ","+").'"><br>
           	</td>
       		<td><FONT face="Verdana,Helvetica,Arial" size=1>&nbsp;&nbsp;<a href="'.$buf.'" title="'.$LDReadEmail.'">'.$minfo[f].'</a></td>
       		<td><FONT face="Verdana,Helvetica,Arial" size=1>&nbsp;&nbsp;<a href="'.$buf.'" title="'.$LDReadEmail.'">'.$minfo[s].'</a></td>
       		<td><FONT face="Verdana,Helvetica,Arial" size=1>&nbsp;&nbsp;<a href="'.$buf.'" title="'.$LDReadEmail.'">'.$minfo[d].'</a></td>
       		<td align=right><FONT face="Verdana,Helvetica,Arial" size=1>&nbsp;&nbsp;<a href="'.$buf.'" title="'.$LDReadEmail.'">'.$minfo[z].'&nbsp;</a></td>
	    	</tr>
			<tr ><td bgcolor="#66aace" colspan=6 height=1><img src="../img/pixel.gif" border=0 height=1 width=1></td></tr>';
		}
	print '
	<tr ><td colspan=6 height=1><img src="../img/pixel.gif" border=0 height=4 width=1></td></tr>
	</table>
	<input type="hidden" name="mode" value="listmail">
	<input type="hidden" name="maxrow" value="'.$maxrow.'">
	<input type="hidden" name="sid" value="'.$ck_sid.'">
 	<input type="hidden" name="lang" value="'.$lang.'">
 	<input type="hidden" name="l2h" value="'.$l2h.'">
 	<input type="hidden" name="folder" value="'.$folder.'">
  <input type="submit" value="'.$LDDelete.'">
	</form>	
	';
} // end of if maxrow
else 
{
	print '<img src="../img/catr.gif" width=88 height=80 border=0 align=middle>
			<FONT face="Verdana,Helvetica,Arial" size=3 color="#800000">';
	switch($folder)
	{
		case "inbox": $fbuf=$LDInbox; break;
		case "sent": $fbuf=$LDSent; break;
		case "drafts": $fbuf=$LDDrafts; break;
		case "trash": $fbuf=$LDRecycle; break;
	}
	print str_replace("~tagword~",$fbuf,$LDFolderEmpty).'</font>';
}
   print '  </td>
    </tr>
  </table>
  
  ';
}
else if($mode=="")
{
	print'<center>
	<img src="../img/catr.gif" width=88 height=80 border=0 align=middle> 
	<FONT face="Verdana,Helvetica,Arial" size=3 color="#800000">
	'.$LDWelcome.' '.$usr.'</font><p>
	<FONT face="Verdana,Helvetica,Arial" size=2 > 
	<a href="'.$thisfile.'?sid='.$ck_sid.'&lang='.$lang.'&mode=listmail">'.$LDNoteIntra.'</a>
	</center>';
}
?>
  
  
	



</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=<? print $cfg['bot_bgcolor']; ?> height=70 colspan=2>

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
