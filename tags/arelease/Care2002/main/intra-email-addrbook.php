<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_intra_email_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_intramail.php");
// check the info params for completeness
$addr=trim($addr);
if(($mode=="saveadd")&&($addr=="")) { header("location:intra-email-addrbook.php?sid=$ck_sid&lang=$lang"); exit;}

require("../req/config-color.php"); // load color preferences

$thisfile="intra-email-addrbook.php";
$breakfile="intra-email.php.?sid=$ck_sid&lang=$lang&mode=listmail";
$dbtable="mail_private_users";

$linecount=0;
$modetypes=array("sendmail","listmail");

require("../req/db-makelink.php");
if($link&&$DBLink_OK) 
	{	
	
				$sql='SELECT addr_book, lastcheck FROM '.$dbtable.' WHERE  email="'.$ck_intra_email_user.'"';
				if($ergebnis=mysql_query($sql,$link))
				{ 
					$rows=0;
					while($content=mysql_fetch_array($ergebnis)) $rows++;	
					if($rows)
					{
						mysql_data_seek($ergebnis,0);
						$content=mysql_fetch_array($ergebnis);
						switch($task)
						{
						
						// if new address save new address
							case "saveadd":
							{
								$buf="n=$name&a=$alias&e=$addr@$dept\r\n";
						//		$content[addr_book]=trim($content[addr_book]);
								if($content[addr_book]=="") $content[addr_book]=$buf;
									else  $content[addr_book].="_".$buf;
								$sql="UPDATE $dbtable SET addr_book=\"$content[addr_book]\" , lastcheck=\"$content[lastcheck]\" 
																	WHERE email=\"$ck_intra_email_user\"";	
								if(mysql_query($sql,$link))
								 { 
								 	mysql_close($link);
									header("location:intra-email-addrbook.php?sid=$ck_sid&lang=$lang&l2h=$l2h&folder=$folder"); exit;
								 }
								 else { print "$LDDbNoUpdate<br>$sql"; } 
								 break;
							}
							// if mode is delete entry
							case "delete": 
							{		//$content[addr_book]=strtolower($content[addr_book]);
									$inb=explode("_",trim($content[addr_book]));
									for($i=0;$i<sizeof($inb);$i++)
									{
										for($n=0;$n<$maxrow;$n++)
										{
											$delbuf="del$n";
											if(!$$delbuf) continue;
											$delbuf2=trim(strtr($$delbuf,"+"," "));
											//print "$delbuf2<br>$inb[$i]<br>"; 
												//print "vor comp $delbuf2<br>$inb[$i]<br>";
											if(!strcmp($delbuf2,strtolower(trim($inb[$i]))))
											{
												//print "nach comp $delbuf2<br>$inb[$i]<br>";
												$trash=array_splice($inb,$i,1);//print "trash <br>";
												$i--;
												break;
											}
										}
									}
									$content[addr_book]=implode("_",$inb);
									$sql="UPDATE $dbtable SET addr_book=\"$content[addr_book]\", lastcheck=\"$content[lastcheck]\"  
																		WHERE email=\"$ck_intra_email_user\"";	
									if(mysql_query($sql,$link))
									{
								 	mysql_close($link);
									header("location:intra-email-addrbook.php?sid=$ck_sid&lang=$lang&l2h=$l2h&folder=$folder"); exit;
								 	}
								 	else  { print "$LDDbNoUpdate<br>$sql"; } 
								 	break;
							}
						} // end of switch mode
						
					} //end of if rows
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
	
function newAddr()
{
	document.addrlist.task.value="newadd";
	document.addrlist.submit();
}

function chkAddress(d)
{
	if(d.addr.value=="") 
	{
		alert("Die Email Addresse fehlt! Geben Sie mindestens die Email Addresse ein.");
		d.addr.focus();
		return false;
	}
	return true;
}

function chkDelete(d,m)
{
 	for (i=0;i<m;i++){
							if(eval("d.del"+i+".checked"))
								if(confirm("<?=$LDConfirmDeleteAddr ?>")) return true;
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
	d=document.addrlist;
	for(i=0;i<m;i++) eval("d.del"+i+".checked="+v);
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
<? 
if($mode=="newadd") print ' onLoad="document.newform.name.focus()"';
 if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?=$test ?>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="30"><FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?="$LDIntraEmail - $LDAddrBook" ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" align=right><a href="javascript:history.back();"><img 
src="../img/<?="$lang/$lang" ?>_back2.gif" border=0 width=110 height=24 align="absmiddle" 
style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a 
href="javascript:gethelp('intramail.php','address','<?=$mode ?>','<?=$folder ?>')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?=$breakfile ?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2>

<FONT face="Verdana,Helvetica,Arial" size=2>
<?
 print '
<FONT face="Verdana,Helvetica,Arial" size=2>
  &nbsp; <b><a href="intra-email.php?sid='.$ck_sid.'&lang='.$lang.'&mode=listmail">'.$LDInbox.'</a> | <a href="intra-email.php?sid='.$ck_sid.'&lang='.$lang.'&mode=compose">'.$LDNewEmail.'</a> | '.$LDAddrBook.' | <a href="intra-email-options.php?sid='.$ck_sid.'&lang='.$lang.'">'.$LDOptions.'</a> | <a href="javascript:gethelp(\'intramail.php\',\'address\',\''.$mode.'\',\''.$folder.'\')">'.$LDHelp.'</a></b>
  <hr color=#000080>
   &nbsp; <FONT  color="#800000">'.$ck_intra_email_user.'</font>';

?>

<? if($task=="newadd") : ?>
<p><ul>
<form name=newform action="<?=$thisfile ?>" method=post onSubmit="return chkAddress(this)">
<FONT face="Verdana,Helvetica,Arial" size=2 color="#000080"><b><?=$LDSaveNewAddr ?></b></font>
<table border=0>
  <tr bgcolor=#f9f9f9>
    <td><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;<?="$LDName, $LDFirstName" ?>:</td>
    <td colspan=2><FONT face="Verdana,Helvetica,Arial" size=2><input type="text" name="name" size=25 maxlength=40 value="<?=$name ?>">
                                                              </td>
  </tr>
  <tr bgcolor=#f9f9f9>
    <td><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;<?="$LDAlias/$LDShortName" ?>:</td>
    <td colspan=2><FONT face="Verdana,Helvetica,Arial" size=2><input type="text" name="alias" size=25 maxlength=40 value="<?=$alias ?>" ></td>
  </tr>
  <tr bgcolor=#f9f9f9>
    <td><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;<?=$LDEmailAddr ?>:<br></td>
    <td><FONT face="Verdana,Helvetica,Arial" size=2><input type="text" name="addr" size=25 maxlength=40 value="<?=$addr ?>"></td>
    <td><FONT face="Verdana,Helvetica,Arial" size=2 color="#800000"><b>@</b>
	 <select name="dept" size=1>
                                                                            	
	<? require("../req/email_domains_options.php"); 
		for ($j=0;$j<sizeof($email_domains);$j++)
	{
		 print '
		<option value="'.$email_domains[$j].'"';
		if ($dept==$email_domains[$j]) print "selected"; 
		print '>'.$email_domains[$j].'</option>';
	}
	?>
     </select>
   </td>
  </tr>
  <tr >
    <td><input type="submit" value="<?=$LDSave ?>"></td>
    <td colspan=2><input type="reset" value="<?=$LDJustReset ?>">
	<input type="button" value="<?=$LDCancel ?>"  onClick="window.location.replace('intra-email-addrbook.php?sid=<?="$ck_sid&lang=$lang&mode=$mode&l2h=$l2h&folder=$folder" ?>')"></td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="task" value="saveadd">
<input type="hidden" name="l2h" value="<?=$l2h ?>">
<input type="hidden" name="folder" value="<?=$folder ?>">
<input type="hidden" name="mode" value="<?=$mode ?>">

</form>
</ul>
<hr color=#000080>
<? endif ?>

 <?
// ******************************** show address book***************************************

 	$arrlist=explode("_",strtolower($content[addr_book]));
	if($l2h) rsort($arrlist); else sort($arrlist); 
	reset($arrlist);
	$maxrow=sizeof($arrlist);
	if(($maxrow==1)&&($arrlist[0]=="")) $maxrow=0;
	
 	print '</b></font>
		<form name="addrlist" action="intra-email-addrbook.php" method="post"  onSubmit="return chkDelete(this,'.sizeof($arrlist).')">
	';
	if ($maxrow>6) print '
  	<input type="submit" value="'.$LDDelete.'"> &nbsp;  &nbsp; <input type="button" value="'.$LDNewAddr.'" onClick="newAddr()">
	<br>';
	print '	<table border=0 cellspacing=0 width=100% cellpadding=0>
	<tr ><td  colspan=6 height=1><img src="../img/pixel.gif" border=0 height=3 width=1></td></tr>
     <tr bgcolor="#0060ae">
       <td>&nbsp;</td>
       <td>	<input type="checkbox" name="sel_all" value="1" onClick="selectAll(this,'.$maxrow.')"><br>
           </td>
       <td><FONT face="Verdana,Helvetica,Arial" size=2 >';
	   if($l2h) print '<a href="'.$thisfile.'?sid='.$ck_sid.'&lang='.$lang.'&l2h=0&mode='.$mode.'&folder='.$folder.'" title="'.$LDSortName.'"><img src="../img/arw_down.gif" '; else print '<a href="'.$thisfile.'?sid='.$ck_sid.'&lang='.$lang.'&l2h=1&mode='.$mode.'&folder='.$folder.'" title="'.$LDSortName.'"><img src="../img/arw_up.gif" ';
	   print '
	   width=12 height=20 border=0 align=absmiddle alt="'.$LDSortName.'"><font color="#ffffff"> &nbsp;<b>'.$LDName.','.$LDFirstName.':</b></td>
       <td><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff">&nbsp;&nbsp;<b>'.$LDAlias.'/'.$LDShortName.':
		</b></td>
		<td><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff"> <b>'.$LDEmailAddr.':</b></font></a></td>
	        </tr>';
	for($i=0;$i<sizeof($arrlist);$i++)
	   {
	    parse_str(trim($arrlist[$i]),$minfo);
		//$buf="intra-email-read.php?sid=$ck_sid&ua=$ck_intra_email_user&s_stamp=$minfo[t]&read=$minfo[r]&from=$minfo[f]&subj=".strtr($minfo[s]," ","+")."&date=".strtr($minfo[d]," ","+")."&size=$minfo[z]&l2h=$l2h&folder=$folder";
 		$delbuf="n=$minfo[n]&a=$minfo[a]&e=$minfo[e]";
     	print ' <tr bgcolor="#ffffff">
       		<td>&nbsp;</td>
			<td>	<input type="checkbox" name="del'.$i.'" value="'.strtr($delbuf," ","+").'"><br>
           	</td>
       		<td><FONT face="Verdana,Helvetica,Arial" size=1>&nbsp; &nbsp; &nbsp; <a href="#" title="'.$LDMoreInfo.'">'.ucwords($minfo[n]).'</a></td>
       		<td><FONT face="Verdana,Helvetica,Arial" size=1>&nbsp;&nbsp;'.$minfo[a].'</td>
       		<td><FONT face="Verdana,Helvetica,Arial" size=1>&nbsp;&nbsp;'.$minfo[e].'</td>
	    	</tr>
			<tr ><td bgcolor="#66aace" colspan=6 height=1><img src="../img/pixel.gif" border=0 height=1 width=1></td></tr>';
		}
	print '
	<tr ><td  colspan=6 height=1><img src="../img/pixel.gif" border=0 height=3 width=1></td></tr>
	</table>';
	if($maxrow) print '
		<input type="submit" value="'.$LDDelete.'"> ';
	print '&nbsp;  &nbsp; <input type="button" value="'.$LDAddNewAddr.'" onClick=newAddr()>
		<br><input type="hidden" name="task" value="delete">
	<input type="hidden" name="maxrow" value="'.$maxrow.'">
	<input type="hidden" name="sid" value="'.$ck_sid.'">
 	<input type="hidden" name="lang" value="'.$lang.'">
 	<input type="hidden" name="l2h" value="'.$l2h.'">
 	<input type="hidden" name="folder" value="'.$folder.'">
	<input type="hidden" name="mode" value="'.$mode.'">
 </form>	
	';
print ' &nbsp; &nbsp;
   <font size=1><a href="intra-email.php?sid='.$ck_sid.'&lang='.$lang.'&mode='.$mode.'&l2h='.$l2h.'&folder='.$folder.'">
   <img src="../img/l_arrowGrnSm.gif" width=12 height=12 border=0 align=middle> '.$LDBack2.' ';
if($mode=="compose") print $LDWriteEmail;
	else
		switch($folder)
		{
		case "inbox": print $LDInbox; break;
		case "sent": print $LDSent; break;
		case "drafts": print $LDDrafts; break;
		case "trash": print $LDRecycle; break;
		}
print '</a></font>';
 
?>
  
  
  
</FONT>
<p>
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
