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
define("LANG_FILE","stdpass.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php");

$fileforward="login-pc-config.php?sid=$sid&lang=$lang";
$thisfile="login.php";
$breakfile="startframe.php?sid=$sid";

// reset all 2nd level lock cookies
require("../include/inc_2level_reset.php");


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
	include("../include/inc_db_makelink.php");
		if($link&&$DBLink_OK) 
					{	$sql='SELECT * FROM mahopass WHERE mahopass_id="'.addslashes($userid).'"';
						$ergebnis=mysql_query($sql,$link);
						if($ergebnis)
							{$zeile=mysql_fetch_array($ergebnis);
								if (($zeile[mahopass_password]==$keyword)&&($zeile[mahopass_id]==$userid))
								{	
									if (!($zeile[mahopass_lockflag]))
									{								
										setcookie("ck_login_userid".$sid,$zeile[mahopass_id]);
										setcookie("ck_login_username".$sid,$zeile[mahopass_name]);
										
										/** Init the crypt object, encrypt the password, and store in cookie
										*/
    									$enc_login = new Crypt_HCEMD5($key_login,makeRand());
										$cipherpw=$enc_login->encodeMimeSelfRand($zeile[mahopass_password]);
                                        setcookie("ck_login_pw".$sid,$cipherpw);
										
										/**
										* Set the login flag
										*/
										setcookie("ck_login_logged".$sid,"true");
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
require("../include/inc_passcheck_head.php");
?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<BODY onLoad="document.passwindow.userid.focus();" bgcolor=<?php print $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><img src=../img/login-b.gif border=0></td>
</tr>

<?php require("../include/inc_passcheck_mask.php") ?>  

<p><!-- 
<img src="../img/small_help.gif" > <a href="ucons.php<?php echo "?lang=$lang" ?>">Was ist login?</a><br>
<img src="../img/small_help.gif" > <a href="ucons.php<?php echo "?lang=$lang" ?>">Wieso soll ich mich einloggen?</a><br>
<img src="../img/small_help.gif" > <a href="ucons.php<?php echo "?lang=$lang" ?>">Was bewirkt das einloggen?</a><br>
 -->
<HR>
<p>
<?php
require("../language/".$lang."/".$lang."_copyrite.php");
 ?>
</FONT>
</BODY>
</HTML>
