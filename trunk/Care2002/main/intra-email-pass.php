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
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php"); // load color preferences

$thisfile="intra-email-pass.php";
$forwardfile="intra-email.php?sid=$sid&lang=$lang&mode=listmail";
$breakfile="startframe.php?sid=$sid&lang=$lang";

// reset all 2nd level lock cookies
require("../include/inc_2level_reset.php");

$dbtable="mail_private_users";

$linecount=0;
$onError="";

if($mode!="")
{
	include("../include/inc_db_makelink.php");
	if($link&&$DBLink_OK)  
	{	
		if(($mode=="access")&&($password!="")&&($username!="")&&($dept!="")) 
			{
				$sql='SELECT * FROM '.$dbtable.' WHERE email="'.$username.'@'.$dept.'"';
				if($ergebnis=mysql_query($sql,$link))
				{ 
					$rows=0;
					while($content=mysql_fetch_array($ergebnis)) $rows++;	
					if($rows==1)
					{
						mysql_data_seek($ergebnis,0);
						$content=mysql_fetch_array($ergebnis);
						//print "$content[email]<br>";print "$content[pw]<br>";
						//print crypt($password,substr($content[pw],0,2));// if last check time stamp found check for  new mails
						if(crypt($password,substr($content[pw],0,2))==$content[pw])
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
							setcookie("ck_intra_email_user".$sid,$content[email]);
							mysql_close($link);
							header("location:$forwardfile"); 
							exit;
						} else $onError=$LDErrorLogin;
					}
					else
					{
						// if last check data not available 
						$newuser=1;
					}
				}else { print "$LDDbNoSave<br>$sql"; } 
			}// end of if password...
			
		if($mode=="register")
		{
            /**
			* Check if the username is already used
			*/
			$sql='SELECT * FROM '.$dbtable.' WHERE email="'.$addr.'@'.$dept.'"';
			if($ergebnis=mysql_query($sql,$link))
			{ 
				$rows=0;
				while($content=mysql_fetch_array($ergebnis)) $rows++;	
				if($rows>0)
				{
				    $nameError=$LDNameIsUsed;
					$addr="";
				}
				   else $nameError="";
			}
		
			if($nameError=="")
			{
			  //check the input data
			  if(($name=="")||($addr=="")||($pw1==""))
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
							if(mysql_query($sql,$link))
							{
								mysql_close($link);
								setcookie("ck_intra_email_user".$sid,$addr."@".$dept);
								header("location:intra-email.php?sid=$sid&lang=$lang&usr=$name");
								exit;
							} 
							else	 
							 { 
							      print "$LDDbNoSave<br>$sql"; 
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
  		else { print "$LDDbNoLink<br>"; } 
} // end of if mode!=""

if(($mode=="access")&&(($username=="")||($password=="")))  $onError=$LDErrorIncomplete;
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if($onError) print ' onLoad="document.loginform.username.focus();document.loginform.username.select();"';
	else if(!$newuser) print ' onLoad="document.loginform.username.focus()"';
if($regError) print ' onLoad="document.regform.pw1.focus()"';
 elseif($nameError) print ' onLoad="document.regform.addr.focus()"';
  elseif ($mode="register") print ' onLoad="document.regform.name.focus()"';
if (!$cfg['dhtml']){ print ' ink='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>
<?php //foreach($argv as $v) print "$v "; ?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="30"><FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?php echo "$LDIntraEmail" ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" align=right><a href="javascript:history.back();"><img 
src="../img/<?php echo "$lang/$lang" ?>_back2.gif" border=0 width=110 height=24 align="absmiddle" 
style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a 
href="javascript:gethelp('intramail.php','pass','<?php echo $newuser ?>')"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?php echo $breakfile ?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top colspan=2>

<FONT face="Verdana,Helvetica,Arial" size=2>

<p><br><ul>
<?php if($onError!="") print '
	<img src="../img/catr.gif" border=0 width=88 height=80 align=middle><FONT face="Verdana,Helvetica,Arial" size=2 color="#800000"> '.$onError.'</font>';
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
		 print '
		<option value="'.$v.'"';
		if (eregi($dept,$x)) print "selected"; 
		print '>'.$v.'</option>';
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
  <td><input type="reset" value="<?php echo $LDReset ?>" onClick="document.loginform.username.focus()">
                      </td>     
	 <td align=right><input type="submit" value="<?php echo $LDLogin ?>">
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
    <td><img src="../img/catr.gif" border=0 width=88 height=80></td>
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
		 print '
		<option value="'.$v.'"';
		if (eregi($dept,$x)) print "selected"; 
		print '>'.$v.'</option>';
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
    <td colspan=2 align=right><input type="submit" value="<?php echo $LDRegister ?>"></td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="mode" value="register">
</form>
 

<?php endif ?>
<?php if (!$newuser)print '
<p><br>
<a href="'.$thisfile.'?sid='.$sid.'&lang='.$lang.'&newuser=1">'.$LDNewReg.' <img src="../img/bul_arrowgrnsm.gif" width=12 height=12 border=0 align=bottom></a>
';
?>
  </ul>
 </table>
</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=<?php print $cfg['bot_bgcolor']; ?> height=70 colspan=2>

<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>

</td>
</tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
