<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_stdpass.php");

require("../req/config-color.php");


//$fileforward="js_allrestart.htm";
$fileforward="login-pc-config.php?sid=$ck_sid&lang=$lang";
$thisfile="login.php";
$breakfile="startframe.php?sid=".$ck_sid;

function logentry(&$userid,$key,$report)
{
			$logpath="logs/access/".date(Y)."/";
			if (file_exists($logpath))
			{
				$logpath=$logpath.date("Y_m_d").".log";
				$file=fopen($logpath,"a");
				if ($file)
				{	if ($userid=="") $userid="blank"; 
					$line=date("d.m.Y").'  '.date("H.i").' '.'Main Login: '.$report.'  Username='.$userid.'  UserID='.$key;
					fputs($file,$line);fputs($file,"\r\n");
					fclose($file);
				}
			}
}

if ((($pass=="check")&&($keyword!=""))&&($userid!=""))
{
	include("../req/db-makelink.php");
		if($link&&$DBLink_OK) 
					{	$sql='SELECT * FROM mahopass WHERE mahopass_id="'.$userid.'"';
						$ergebnis=mysql_query($sql,$link);
						if($ergebnis)
							{$zeile=mysql_fetch_array($ergebnis);
								if (($zeile[mahopass_password]==$keyword)&&($zeile[mahopass_id]==$userid))
								{	
									if (!($zeile[mahopass_lockflag]))
									{								
									//	setcookie(aufnahme_user,$zeile[mahopass_name]);	
										setcookie(ck_login_userid,$zeile[mahopass_id]);
										setcookie(ck_login_username,$zeile[mahopass_name]);
										setcookie(ck_login_logged,"true");
										logentry($zeile[mahopass_name],$zeile[mahopass_id],$REMOTE_ADDR." OK'd","","");			
										mysql_close($link);
										header("Location: $fileforward");		
										exit;
									}else $passtag=3;
								}else {$passtag=1;};
							}
							else {$passtag=1;};
		}
  		 else { print "$LDDbNoLink<br>"; } 
}

$errbuf="Log in";
$minimal=1;
require("../req/passcheck_head.php");

?>

<BODY onLoad="document.passwindow.userid.focus();" bgcolor=<? print $cfg['body_bgcolor']; ?>
<? if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><img src=../img/login-b.gif border=0></td>
</tr>

<? require("../req/passcheck_mask.php") ?>  


<p><!-- 
<img src="../img/small_help.gif" > <a href="ucons.php">Was ist login?</a><br>
<img src="../img/small_help.gif" > <a href="ucons.php">Wieso soll ich mich einloggen?</a><br>
<img src="../img/small_help.gif" > <a href="ucons.php">Was bewirkt das einloggen?</a><br>
 -->


<HR>
<p>

<?php
require("../language/".$lang."/".$lang."_copyrite.htm");
 ?>

</FONT>


</BODY>
</HTML>
