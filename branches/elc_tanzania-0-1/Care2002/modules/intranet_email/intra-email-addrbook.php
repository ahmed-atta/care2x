<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.net, elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','intramail.php');
$local_user='ck_intra_email_user';
require_once($root_path.'include/inc_front_chain_lang.php');

/**
* check the info params for completeness
*/
if(!isset($addr)) $addr='';
if(!isset($mode)) $mode='';
if(!isset($task)) $task='';

$addr=trim($addr);
if(($mode=='saveadd')&&($addr=='')) { header('location:intra-email-addrbook.php'.URL_REDIRECT_APPEND); exit;}

require_once($root_path.'include/inc_config_color.php'); // load color preferences

$thisfile=basename(__FILE__);
$breakfile='intra-email.php'.URL_APPEND.'&mode=listmail';
$dbtable='care_mail_private_users';

$linecount=0;
$modetypes=array('sendmail','listmail');

/* Establish db connection */
if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
if($dblink_ok) {	
	
				$sql='SELECT addr_book, lastcheck FROM '.$dbtable.' WHERE  email="'.$HTTP_COOKIE_VARS[$local_user.$sid].'"';
				if($ergebnis=$db->Execute($sql))
				{ 
					if($rows=$ergebnis->RecordCount())
					{
						$content=$ergebnis->FetchRow();
						switch($task)
						{
						
						// if new address save new address
							case 'saveadd':
							{
								$buf="n=$name&a=$alias&e=$addr@$dept\r\n";
						//		$content[addr_book]=trim($content[addr_book]);
								if($content['addr_book']=="") $content['addr_book']=$buf;
									else  $content[addr_book].="_".$buf;
								$sql="UPDATE $dbtable SET addr_book=\"".$content['addr_book']."\" , lastcheck=\"".$content['lastcheck']."\" 
																	WHERE email=\"".$HTTP_COOKIE_VARS[$local_user.$sid]."\"";	
								$db->BeginTrans();
								$ok=$db->Execute($sql);
								if($ok&&$db->CommitTrans())
								 { 
									header("location:intra-email-addrbook.php".URL_REDIRECT_APPEND."&l2h=$l2h&folder=$folder"); 
									exit;
								 } else { 
								     $db->RollbackTrans();
									 echo "$LDDbNoUpdate<br>$sql"; 
								 } 
								 break;
							}
							// if mode is delete entry
							case 'delete': 
							{		//$content[addr_book]=strtolower($content[addr_book]);
									$inb=explode("_",trim($content[addr_book]));
									for($i=0;$i<sizeof($inb);$i++)
									{
										for($n=0;$n<$maxrow;$n++)
										{
											$delbuf="del$n";
											if(!$$delbuf) continue;
											$delbuf2=trim(strtr($$delbuf,"+"," "));
											//echo "$delbuf2<br>$inb[$i]<br>"; 
												//echo "vor comp $delbuf2<br>$inb[$i]<br>";
											if(!strcmp($delbuf2,strtolower(trim($inb[$i]))))
											{
												//echo "nach comp $delbuf2<br>$inb[$i]<br>";
												$trash=array_splice($inb,$i,1);//echo "trash <br>";
												$i--;
												break;
											}
										}
									}
									$content['addr_book']=implode('_',$inb);
									$sql="UPDATE $dbtable SET addr_book=\"".$content['addr_book']."\", lastcheck=\"".$content['lastcheck']."\"  
																		WHERE email=\"".$HTTP_COOKIE_VARS[$local_user.$sid]."\"";	
								    $db->BeginTrans();
								    $ok=$db->Execute($sql);
								    if($ok&&$db->CommitTrans()) { 
									    header("location:intra-email-addrbook.php".URL_REDIRECT_APPEND."&l2h=$l2h&folder=$folder"); 
										exit;
								    } else { 
								        $db->RollbackTrans();
									    echo "$LDDbNoUpdate<br>$sql"; 
								    } 
								 	break;
							}
						} // end of switch mode
						
					} //end of if rows
				}else { echo "$LDDbNoRead<br>$sql"; } 
	}
  		else { echo "$LDDbNoLink<br>$sql"; } 
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

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
		alert("<?php $LDNoEmailAddress; ?>");
		d.addr.focus();
		return false;
	}
	return true;
}

function chkDelete(d,m)
{
 	for (i=0;i<m;i++){
							if(eval("d.del"+i+".checked"))
								if(confirm("<?php echo $LDConfirmDeleteAddr ?>")) return true;
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

// -->
</script> 

<?php 
require_once($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php 
if($mode=="newadd") echo ' onLoad="document.newform.name.focus()"';
 if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?php echo $test ?>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="30"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?php echo "$LDIntraEmail - $LDAddrBook" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right><a href="javascript:history.back();"><img 
<?php echo createLDImgSrc($root_path,'back2.gif','0','absmiddle') ?> 
style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a 
href="javascript:gethelp('intramail.php','address','<?php echo $mode ?>','<?php echo $folder ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0','absmiddle') ?> style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?> style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>

<FONT face="Verdana,Helvetica,Arial" size=2>
<?php
 echo '
<FONT face="Verdana,Helvetica,Arial" size=2>
  &nbsp; <b><a href="intra-email.php'.URL_APPEND.'&mode=listmail">'.$LDInbox.'</a> | 
  <a href="intra-email.php'.URL_APPEND.'&mode=compose">'.$LDNewEmail.'</a> | '.$LDAddrBook.' |
   <a href="javascript:gethelp(\'intramail.php\',\'address\',\''.$mode.'\',\''.$folder.'\')">'.$LDHelp.'</a>| 
	<a href="intra-email-pass.php'.URL_APPEND.'">'.$LDLogout.'</a></b>
  <hr color=#000080>
   &nbsp; <FONT  color="#800000">'.$HTTP_COOKIE_VARS[$local_user.$sid].'</font>';
/* echo '
<FONT face="Verdana,Helvetica,Arial" size=2>
  &nbsp; <b><a href="intra-email.php'.URL_APPEND.'&mode=listmail">'.$LDInbox.'</a> | 
  <a href="intra-email.php'.URL_APPEND.'&mode=compose">'.$LDNewEmail.'</a> | '.$LDAddrBook.' |
   <a href="intra-email-options.php'.URL_APPEND.'">'.$LDOptions.'</a> | 
   <a href="javascript:gethelp(\'intramail.php\',\'address\',\''.$mode.'\',\''.$folder.'\')">'.$LDHelp.'</a>| 
	<a href="intra-email-pass.php'.URL_APPEND.'">'.$LDLogout.'</a></b>
  <hr color=#000080>
   &nbsp; <FONT  color="#800000">'.$HTTP_COOKIE_VARS[$local_user.$sid].'</font>';
*/
?>

<?php if($task=="newadd") : ?>
<p><ul>
<form name=newform action="<?php echo $thisfile ?>" method=post onSubmit="return chkAddress(this)">
<FONT face="Verdana,Helvetica,Arial" size=2 color="#000080"><b><?php echo $LDSaveNewAddr ?></b></font>
<table border=0>
  <tr bgcolor=#f9f9f9>
    <td><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;<?php echo "$LDName, $LDFirstName" ?>:</td>
    <td colspan=2><FONT face="Verdana,Helvetica,Arial" size=2><input type="text" name="name" size=25 maxlength=40 value="<?php echo $name ?>">
                                                              </td>
  </tr>
  <tr bgcolor=#f9f9f9>
    <td><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;<?php echo "$LDAlias/$LDShortName" ?>:</td>
    <td colspan=2><FONT face="Verdana,Helvetica,Arial" size=2><input type="text" name="alias" size=25 maxlength=40 value="<?php echo $alias ?>" ></td>
  </tr>
  <tr bgcolor=#f9f9f9>
    <td><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;<?php echo $LDEmailAddr ?>:<br></td>
    <td><FONT face="Verdana,Helvetica,Arial" size=2><input type="text" name="addr" size=25 maxlength=40 value="<?php echo $addr ?>"></td>
    <td><FONT face="Verdana,Helvetica,Arial" size=2 color="#800000"><b>@</b>
	 <select name="dept" size=1>
                                                                            	
	<?php require("/include/inc_email_domains_options.php"); 
		for ($j=0;$j<sizeof($email_domains);$j++)
	{
		 echo '
		<option value="'.$email_domains[$j].'"';
		if ($dept==$email_domains[$j]) echo "selected"; 
		echo '>'.$email_domains[$j].'</option>';
	}
	?>
     </select>
   </td>
  </tr>
  <tr >
    <td><input type="submit" value="<?php echo $LDSave ?>"></td>
    <td colspan=2><input type="reset" value="<?php echo $LDJustReset ?>">
	<input type="button" value="<?php echo $LDCancel ?>"  onClick="window.location.replace('intra-email-addrbook.php?sid=<?php echo "$sid&lang=$lang&mode=$mode&l2h=$l2h&folder=$folder" ?>')"></td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="task" value="saveadd">
<input type="hidden" name="l2h" value="<?php echo $l2h ?>">
<input type="hidden" name="folder" value="<?php echo $folder ?>">
<input type="hidden" name="mode" value="<?php echo $mode ?>">

</form>
</ul>
<hr color=#000080>
<?php endif ?>

 <?php
// ******************************** show address book***************************************

 	$arrlist=explode("_",strtolower($content[addr_book]));
	if($l2h) rsort($arrlist); else sort($arrlist); 
	reset($arrlist);
	$maxrow=sizeof($arrlist);
	if(($maxrow==1)&&($arrlist[0]=="")) $maxrow=0;
	
 	echo '</b></font>
		<form name="addrlist" action="intra-email-addrbook.php" method="post"  onSubmit="return chkDelete(this,'.sizeof($arrlist).')">
	';
	if ($maxrow>6) echo '
  	<input type="submit" value="'.$LDDelete.'"> &nbsp;  &nbsp; <input type="button" value="'.$LDNewAddr.'" onClick="newAddr()">
	<br>';
	echo '	<table border=0 cellspacing=0 width=100% cellpadding=0>
	<tr ><td  colspan=6 height=1><img src="'.$root_path.'gui/img/common/default/pixel.gif" border=0 height=3 width=1></td></tr>
     <tr bgcolor="#0060ae">
       <td>&nbsp;</td>
       <td>	<input type="checkbox" name="sel_all" value="1" onClick="selectAll(this,'.$maxrow.')"><br>
           </td>
       <td><FONT face="Verdana,Helvetica,Arial" size=2 >';
	   if($l2h) echo '<a href="'.$thisfile.''.URL_APPEND.'&l2h=0&mode='.$mode.'&folder='.$folder.'" title="'.$LDSortName.'"><img src="'.$root_path.'gui/img/common/default/arw_down.gif" '; else echo '<a href="'.$thisfile.''.URL_APPEND.'&l2h=1&mode='.$mode.'&folder='.$folder.'" title="'.$LDSortName.'"><img src="'.$root_path.'gui/img/common/default/arw_up.gif" ';
	   echo '
	   width=12 height=20 border=0 align=absmiddle alt="'.$LDSortName.'"><font color="#ffffff"> &nbsp;<b>'.$LDName.','.$LDFirstName.':</b></td>
       <td><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff">&nbsp;&nbsp;<b>'.$LDAlias.'/'.$LDShortName.':
		</b></td>
		<td><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff"> <b>'.$LDEmailAddr.':</b></font></a></td>
	        </tr>';
	for($i=0;$i<sizeof($arrlist);$i++)
	   {
	    parse_str(trim($arrlist[$i]),$minfo);
		//$buf="intra-email-read.php?sid=$sid&ua=$ck_intra_email_user&s_stamp=$minfo[t]&read=$minfo[r]&from=$minfo[f]&subj=".strtr($minfo[s]," ","+")."&date=".strtr($minfo[d]," ","+")."&size=$minfo[z]&l2h=$l2h&folder=$folder";
 		$delbuf="n=$minfo[n]&a=$minfo[a]&e=$minfo[e]";
     	echo ' <tr bgcolor="#ffffff">
       		<td>&nbsp;</td>
			<td>	<input type="checkbox" name="del'.$i.'" value="'.strtr($delbuf," ","+").'"><br>
           	</td>
       		<td><FONT face="Verdana,Helvetica,Arial" size=1>&nbsp; &nbsp; &nbsp; <a href="#" title="'.$LDMoreInfo.'">'.ucwords($minfo[n]).'</a></td>
       		<td><FONT face="Verdana,Helvetica,Arial" size=1>&nbsp;&nbsp;'.$minfo[a].'</td>
       		<td><FONT face="Verdana,Helvetica,Arial" size=1>&nbsp;&nbsp;'.$minfo[e].'</td>
	    	</tr>
			<tr ><td bgcolor="#66aace" colspan=6 height=1><img src="'.$root_path.'gui/img/common/default/pixel.gif" border=0 height=1 width=1></td></tr>';
		}
	echo '
	<tr ><td  colspan=6 height=1><img src="'.$root_path.'gui/img/common/default/pixel.gif" border=0 height=3 width=1></td></tr>
	</table>';
	if($maxrow) echo '
		<input type="submit" value="'.$LDDelete.'"> ';
	echo '&nbsp;  &nbsp; <input type="button" value="'.$LDAddNewAddr.'" onClick=newAddr()>
		<br><input type="hidden" name="task" value="delete">
	<input type="hidden" name="maxrow" value="'.$maxrow.'">
	<input type="hidden" name="sid" value="'.$sid.'">
 	<input type="hidden" name="lang" value="'.$lang.'">
 	<input type="hidden" name="l2h" value="'.$l2h.'">
 	<input type="hidden" name="folder" value="'.$folder.'">
	<input type="hidden" name="mode" value="'.$mode.'">
 </form>	
	';
echo ' &nbsp; &nbsp;
   <font size=1><a href="intra-email.php'.URL_APPEND.'&mode='.$mode.'&l2h='.$l2h.'&folder='.$folder.'">
   <img '.createComIcon($root_path,'l_arrowgrnsm.gif','0','middle').'> '.$LDBack2.' ';
if($mode=="compose") echo $LDWriteEmail;
	else
		switch($folder)
		{
		case "inbox": echo $LDInbox; break;
		case "sent": echo $LDSent; break;
		case "drafts": echo $LDDrafts; break;
		case "trash": echo $LDRecycle; break;
		}
echo '</a></font>';
 
?>
 </FONT>
<p>
</td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?>  colspan=2>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td>
</tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
