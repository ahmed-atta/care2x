<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_intramail.php");

require("../req/config-color.php"); // load color preferences

$thisfile="intra-email-pass.php";
$forwardfile="intra-email.php";
$breakfile="startframe.php?sid=$ck_sid&lang=$lang";
// erase the cookie
setcookie(ck_intra_email_user,"");

$dbtable="mail_private_users";


$linecount=0;
$onError="";

if($mode!="")
{
	include("../req/db-makelink.php");
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
							mysql_close($link);
							setcookie(ck_intra_email_user,$content[email]);
							header("location:$forwardfile?sid=$ck_sid&lang=$lang&mode=listmail"); 
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
			//check the input data
			if(($name=="")||($addr=="")||($pw1=="")) $regError=$LDErrorForm;
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
								setcookie(ck_intra_email_user,$addr."@".$dept);
								header("location:intra-email.php?sid=$ck_sid&lang=$lang&usr=$name");
								exit;
							} else	 { print "$LDDbNoSave<br>$sql"; } 				
						}else 
							{ $regError=$LDErrorPassword;
							}
					  }
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
if($onError) print ' onLoad="document.loginform.username.focus();document.loginform.username.select();"';
	else if(!$newuser) print ' onLoad="document.loginform.username.focus()"';
if($regError) print ' onLoad="document.regform.pw1.focus()"';
 else if ($mode="register") print ' onLoad="document.regform.name.focus()"';
if (!$cfg['dhtml']){ print ' ink='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>
<? //foreach($argv as $v) print "$v "; ?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="30"><FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?="$LDIntraEmail" ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" align=right><a href="javascript:history.back();"><img 
src="../img/<?="$lang/$lang" ?>_back2.gif" border=0 width=110 height=24 align="absmiddle" 
style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a 
href="javascript:gethelp('intramail.php','pass','<?=$newuser ?>')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?=$breakfile ?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2>

<FONT face="Verdana,Helvetica,Arial" size=2>

<p><br><ul>
<?
if($onError!="") print '
	<img src="../img/catr.gif" border=0 width=88 height=80 align=middle><FONT face="Verdana,Helvetica,Arial" size=2 color="#800000"> '.$onError.'</font>';
?>
  <form action="<?=$thisfile ?>" method="get" name="loginform" onSubmit="return pruf(this)">
  <table border=0 cellspacing=2 cellpadding=3>
    <tr bgcolor=#ffffdd>
      <td align=center colspan=2><FONT face="Verdana,Helvetica,Arial" size=3 color="#800000"><b><?=$LDLogin ?>:</b></td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2><b><?=$LDUrEmailAddr ?>:</b></td>
      <td><input type="text" name="username" size=20 maxlength=40 value="<?= $username ?>"><FONT face="Verdana,Helvetica,Arial" size=2 color=#0000ff>@<select name="dept" size=1>
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
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2><b><?=$LDPassword ?>:</b></td>
      <td><input type="password" name="password" size=20 maxlength=40>
          </td>
    </tr>

    <tr >
      <td ><input type="submit" value="<?=$LDLogin ?>">
           </td>
      <td align=right><input type="reset" value="<?=$LDReset ?>" onClick="document.loginform.username.focus()">
                      </td>
    </tr>
  </table>
  <input type="hidden" name="sid" value="<?=$ck_sid ?>">
  <input type="hidden" name="lang" value="<?=$lang ?>">
  <input type="hidden" name="mode" value="access">
  </form> 
  
<? if($newuser) : ?>
<table border=0>
  <tr>
    <td><img src="../img/catr.gif" border=0 width=88 height=80></td>
    <td><FONT face="Verdana,Helvetica,Arial" size=2 color="#990000">
<? if (!$regError) print $LDNotRegUser; else print $regError;
?></td>
  </tr>
</table>
<form name=regform action="<?=$thisfile ?>" method=post>
<table border=0>
  <tr bgcolor=#f9f9f9>
    <td><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;<?="$LDName, $LDFirstName" ?>:</td>
    <td colspan=2><FONT face="Verdana,Helvetica,Arial" size=2><input type="text" name="name" size=25 maxlength=40 value="<?=$name ?>">
                                                              </td>
  </tr>
  <tr bgcolor=#f9f9f9>
    <td><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;<?=$LDChoiceAddr ?>:<br></td>
    <td><FONT face="Verdana,Helvetica,Arial" size=2><input type="text" name="addr" size=25 maxlength=40 value="<?=$addr ?>"></td>
    <td><FONT face="Verdana,Helvetica,Arial" size=2 color="#800000"><b>@</b>
		<select name="dept" size=1>
	<? //require("../req/email_domains_options.php"); 
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
  <tr bgcolor=#f9f9f9>
    <td><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;<?=$LDAlias ?>:</td>
    <td colspan=2><FONT face="Verdana,Helvetica,Arial" size=2><input type="text" name="alias" size=25 maxlength=40 value="<?=$alias ?>" ></td>
  </tr>
  <tr bgcolor=#f9f9f9>
    <td><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;<?=$LDChoicePassword ?>:</td>
    <td colspan=2><FONT face="Verdana,Helvetica,Arial" size=2><input type="text" name="pw1" size=25 maxlength=40 ></td>
  </tr>
  <tr bgcolor=#f9f9f9>
    <td><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;<?=$LDPassword2x ?>:</td>
    <td colspan=2><input type="text" name="pw2" size=25 maxlength=40></td>
  </tr>
  <tr >
    <td><input type="submit" value="<?=$LDRegister ?>"></td>
    <td colspan=2 align=right><input type="reset" value="<?=$LDReset ?>"></td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="mode" value="register">
</form>
 

<? endif ?>
<? if (!$newuser)print '
<p><br>
<a href="'.$thisfile.'?sid='.$ck_sid.'&lang='.$lang.'&newuser=1">'.$LDNewReg.' <img src="../img/bul_arrowGrnSm.gif" width=12 height=12 border=0 align=bottom></a>
';
?>
  </ul>


  
  
</table>

		
	



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
