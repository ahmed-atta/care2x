<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.06 - 2003-08-06
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

$fileforward='login-pc-config.php'.URL_REDIRECT_APPEND;
$thisfile='login.php';
$breakfile='startframe.php'.URL_APPEND;

if(!isset($pass)) $pass='';
if(!isset($keyword)) $keyword='';
if(!isset($userid)) $userid='';

if(!session_is_registered('sess_login_userid')) session_register('sess_login_userid');
if(!session_is_registered('sess_login_username')) session_register('sess_login_username');
if(!session_is_registered('sess_login_pw')) session_register('sess_login_pw');

function logentry(&$userid,$key,$report)
{
			$logpath='logs/access/'.date('Y').'/';
			if (file_exists($logpath))
			{
				$logpath=$logpath.date('Y_m_d').'.log';
				$file=fopen($logpath,'a');
				if ($file)
				{	if ($userid=='') $userid='blank'; 
					$line=date('Y-m-d H:i:s').' '.'Main Login: '.$report.'  Username='.$userid.'  UserID='.$key;
					fputs($file,$line);fputs($file,"\r\n");
					fclose($file);
				}
			}
}

if ((($pass=='check')&&($keyword!=''))&&($userid!=''))
{
    if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
    if($dblink_ok) {	
	    $sql='SELECT * FROM care_users WHERE login_id="'.addslashes($userid).'"';
							
		if($ergebnis=$db->Execute($sql))
		{
		    $zeile=$ergebnis->FetchRow();
			
			if (($zeile['password']==$keyword)&&($zeile['login_id']==$userid))
			{	
				if (!($zeile['lockflag']))
				{								
					//setcookie('ck_login_userid'.$sid,$zeile['login_id'],0,'/');
					//setcookie('ck_login_username'.$sid,$zeile['name'],0,'/');
					$HTTP_SESSION_VARS['sess_login_userid']=$zeile['login_id'];		
					$HTTP_SESSION_VARS['sess_login_username']=$zeile['name'];		
					/** Init the crypt object, encrypt the password, and store in cookie
					*/
    				$enc_login = new Crypt_HCEMD5($key_login,makeRand());
										
					$cipherpw=$enc_login->encodeMimeSelfRand($zeile['password']);
										
                    //setcookie('ck_login_pw'.$sid,$cipherpw,0,'/');
					$HTTP_SESSION_VARS['sess_login_pw']=$cipherpw;		
										
					/**
					* Set the login flag
					*/
					setcookie('ck_login_logged'.$sid,'true',0,'/');
										
					logentry($zeile['name'],$zeile['id'],$REMOTE_ADDR.' OK\'d','','');			
										
					header("Location: $fileforward");		
					exit;
										
				}else { $passtag=3;}
			}else {$passtag=1;};
		}
		else {$passtag=1;};
	}
    else { echo "$LDDbNoLink<br>"; } 
}

$errbuf='Log in';
$minimal=1;
require_once($root_path.'include/inc_config_color.php');
require($root_path.'include/inc_passcheck_head.php');
?>

<?php echo setCharSet(); ?>
<BODY onLoad="document.passwindow.userid.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><img <?php echo createLDImgSrc($root_path,'login-b.gif') ?>></td>
</tr>

<?php require($root_path.'include/inc_passcheck_mask.php') ?>  

<p><!-- 
<img src="../img/small_help.gif" > <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>">Was ist login?</a><br>
<img src="../img/small_help.gif" > <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>">Wieso soll ich mich einloggen?</a><br>
<img src="../img/small_help.gif" > <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>">Was bewirkt das einloggen?</a><br>
 -->
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
