<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.08 - 2003-10-05
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','intramail.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php'); // load color preferences
require_once($root_path.'include/inc_intramail_domains.php');

$thisfile=basename(__FILE__);
$forwardfile='intra-email.php'.URL_REDIRECT_APPEND.'&mode=listmail';
$breakfile=$root_path.'main/startframe.php'.URL_APPEND;

// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

$dbtable='care_mail_private_users';

$linecount=0;
$onError='';
if(!isset($mode)) $mode='';
if(!isset($password)) $password='';
if(!isset($dept)) $dept='';
if(!isset($username)) $username='';

if($mode!='')
{
	if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
    if($dblink_ok) {	
		if(($mode=='access')&&($password!='')&&($username!='')&&($dept!='')) 
			{
				$sql='SELECT * FROM '.$dbtable.' WHERE email="'.$username.'@'.$dept.'"';
				if($ergebnis=$db->Execute($sql))
				{ 
					if($ergebnis->RecordCount())
					{
						$content=$ergebnis->FetchRow();
						if(crypt($password,substr($content[pw],0,2))==$content['pw'])
						{
						    /**
						    * Init crypt to use 2nd level key and encrypt the sid.
						    * Store to cookie the "$ck_2level_sid.$sid"
							* There is no need to call another include of the inc_init_crypt.php since it is already included at the start 
							* of the script that called this script.
							*/
                            //include("../include/inc_init_crypt.php"); // initialize crypt 
    						$enc_2level = new Crypt_HCEMD5($key_2level, makeRand());
							$ciphersid=$enc_2level->encodeMimeSelfRand($sid);
							setcookie(ck_2level_sid.$sid,$ciphersid);
							setcookie('ck_intra_email_user'.$sid,$content[email]);
							header("location:$forwardfile"); 
							exit;
						} else $onError=$LDErrorLogin;
					}
					else
					{
						// if last check data not available 
						$newuser=1;
					}
				}else { echo "$LDDbNoSave<br>$sql"; } 
			}// end of if password...
			
		if($mode=='register')
		{
            /**
			* Check if the username is already used
			*/
			if(!isset($addr)) $addr='';
			if(!isset($pw1)) $pw1='';
			if(!isset($pw2)) $pw2='';
			if(!isset($name)) $name='';
			
			$sql='SELECT * FROM '.$dbtable.' WHERE email="'.$addr.'@'.$dept.'"';
			if($ergebnis=$db->Execute($sql))
			{ 
				if($ergebnis->RecordCount())
				{
					$addr='';
				}
				   else $nameError='';
			}
		
			if($nameError=='')
			{
			  //check the input data
			  if(($name=='')||($addr=='')||($pw1==''))
			   {
			        $regError=$LDErrorForm;
			   }
				else{
						if($pw1==$pw2)
						{
							$sql="INSERT INTO $dbtable 
										( 	user_name,
											email,
											alias,
											pw 
										)
										VALUES
										(	'$name',
											'$addr@$dept',
											'$alias',
											'".crypt($pw1)."'
										)";			
							
							$db->BeginTrans();
							$ok=$db->Execute($sql);
							if($ok&&$db->CommitTrans())
							{
								setcookie('ck_intra_email_user'.$sid,$addr.'@'.$dept);
								header("location:intra-email.php".URL_REDIRECT_APPEND."&usr=$name");
								exit;
							} 
							else	 
							 { 
							     $db->RollbackTrans();
							      echo "$LDDbNoSave<br>$sql"; 
							  } 				
						}else 
							{ 
							   $regError=$LDErrorPassword;
							}
					  }
		   } // end of if($regError)
		   $newuser=1;
		}
	}
  		else { echo "$LDDbNoLink<br>"; } 
} // end of if mode!=""

if(($mode=='access')&&(($username=='')||($password=='')))  $onError=$LDErrorIncomplete;
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <script language="javascript" >
<!-- 

function pruf(d)
{
	pw=d.password;
	usr=d.username;
	var p=pw.value; 
	var u=usr.value;
	if((u=="")||(u==" "))
	{
		usr.value="";
		usr.focus();
		return false;
	}
	if((p=="")||(p==" "))
	{
		pw.value="";
		pw.focus();
		return false;
	}
	return true;
}
// -->
</script> 

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if($onError) echo ' onLoad="document.loginform.username.focus();document.loginform.username.select();"';
	else if(!$newuser) echo ' onLoad="document.loginform.username.focus()"';
	
if($regError) echo ' onLoad="document.regform.pw1.focus()"';
 elseif($nameError) echo ' onLoad="document.regform.addr.focus()"';
  elseif ($mode='register') echo ' onLoad="document.regform.name.focus()"';
  
if (!$cfg['dhtml']){ echo ' ink='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 

?>>
<?php //foreach($argv as $v) echo "$v "; ?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="30"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?php echo "$LDIntraEmail" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right><a href="javascript:history.back();"><img 
<?php echo createLDImgSrc($root_path,'back2.gif','0','absmiddle') ?> 
style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a 
href="javascript:gethelp('intramail.php','pass','<?php echo $newuser ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0','absmiddle') ?> style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?> style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>

<FONT face="Verdana,Helvetica,Arial" size=2>

<p><br><ul>
<?php if($onError!="") echo '
	<img '.createMascot($root_path,'mascot1_r.gif','0','bottom').'><FONT face="Verdana,Helvetica,Arial" size=2 color="#800000"> '.$onError.'</font>';
?>
  <form action="<?php echo $thisfile ?>" method="get" name="loginform" onSubmit="return pruf(this)">
  <table border=0 cellspacing=2 cellpadding=3>
    <tr bgcolor=#ffffdd>
      <td align=center colspan=2><FONT face="Verdana,Helvetica,Arial" size=3 color="#800000"><b><?php echo $LDLogin ?>:</b></td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2><b><?php echo $LDUrEmailAddr ?>:</b></td>
      <td><input type="text" name="username" size=20 maxlength=40 value="<?php echo  $username ?>"><FONT face="Verdana,Helvetica,Arial" size=2 color=#0000ff>@<select name="dept" size=1>
<?php 
   
     while(list($x,$v)=each($LDEmailDomains))
	 {
		 echo '
		<option value="'.$v.'"';
		if (eregi($dept,$x)) echo 'selected'; 
		echo '>'.$v.'</option>';
	}
	reset($LDEmailDomains);
?>                                                   
         </select>
		  </td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2><b><?php echo $LDPassword ?>:</b></td>
      <td><input type="password" name="password" size=20 maxlength=40>
          </td>
    </tr>

    <tr >
   
	 <td align="right" colspan=2><input type="image" <?php echo createLDImgSrc($root_path,'login.gif','0'); ?>>
    </td>
    
    </tr>
  </table>
  <input type="hidden" name="sid" value="<?php echo $sid ?>">
  <input type="hidden" name="lang" value="<?php echo $lang ?>">
  <input type="hidden" name="mode" value="access">
  </form> 
  
<?php if($newuser) : ?>
<HR>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?>></td>
    <td><FONT face="Verdana,Helvetica,Arial" size=2 color="#990000">
<?php 
if ($regError) echo $regError;
    elseif($nameError) echo $nameError;
	  else echo $LDNotRegUser; 
?>
  </td>
  </tr>
</table>
<form name=regform action="<?php echo $thisfile ?>" method=post>
<table border=0>
  <tr bgcolor=#f9f9f9>
    <td><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;<?php echo "$LDName, $LDFirstName" ?>:</td>
    <td colspan=2><FONT face="Verdana,Helvetica,Arial" size=2><input type="text" name="name" size=25 maxlength=40 value="<?php echo $name ?>">
                                                              </td>
  </tr>
  <tr bgcolor=#f9f9f9>
    <td><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;<?php echo $LDChoiceAddr ?>:<br></td>
    <td><FONT face="Verdana,Helvetica,Arial" size=2><input type="text" name="addr" size=25 maxlength=40 value="<?php echo $addr ?>"></td>
    <td><FONT face="Verdana,Helvetica,Arial" size=2 color="#800000"><b>@</b>
		<select name="dept" size=1>
<?php 
     while(list($x,$v)=each($LDEmailDomains))
	 {
		 echo '
		<option value="'.$v.'"';
		if (eregi($dept,$x)) echo "selected"; 
		echo '>'.$v.'</option>';
	}
?>
         </select>
    </td>
  </tr>
  <tr bgcolor=#f9f9f9>
    <td><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;<?php echo $LDAlias ?>:</td>
    <td colspan=2><FONT face="Verdana,Helvetica,Arial" size=2><input type="text" name="alias" size=25 maxlength=40 value="<?php echo $alias ?>" ></td>
  </tr>
  <tr bgcolor=#f9f9f9>
    <td><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;<?php echo $LDChoicePassword ?>:</td>
    <td colspan=2><FONT face="Verdana,Helvetica,Arial" size=2><input type="password" name="pw1" size=25 maxlength=40 ></td>
  </tr>
  <tr bgcolor=#f9f9f9>
    <td><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;<?php echo $LDPassword2x ?>:</td>
    <td colspan=2><input type="password" name="pw2" size=25 maxlength=40></td>
  </tr>
  <tr >
    <td>&nbsp;<!-- <input type="reset" value="<?php echo $LDReset ?>"> --></td>
    <td colspan=2 align=right><input type="image" <?php echo createLDImgSrc($root_path,'register.gif','0'); ?>></td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="mode" value="register">
</form>
 

<?php endif ?>
<?php if (!$newuser)echo '
<p><br>
<a href="'.$thisfile.''.URL_APPEND.'&newuser=1">'.$LDNewReg.' <img '.createComIcon($root_path,'bul_arrowgrnsm.gif','0','bottom').'></a>
';
?>
  </ul>
 </table>
</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>

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
