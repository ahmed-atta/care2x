<?php 
if(($sid==NULL)||($sid!=$$ck_sid_buffer)) { header("location:invalid-access-warning.php"); exit;}

require("../include/inc_config_color.php");



srand(time()*1000);
$r=rand(1,1000);
$dbname="maho";

$allowedarea="System_Admin";

$fileforward="edv-datenbank.php";
$thisfile="edv-datenbank-pass.php";
$breakfile="edv.php";

if($HTTP_COOKIE_VARS['ck_login_logged'.$sid]&&$HTTP_COOKIE_VARS['ck_login_userid'.$sid])
{
 header("location: passcheck-intern.php?sid=$sid&lang=$lang&allowedarea=$allowedarea&fileforward=$fileforward&retfilepath=$thisfile");
 exit;
}
//setcookie(ck_edv_db_user,"");

function validarea($area,$zeile2,$range)
{
   for ($i=0;$i<$range;$i++)
      if(($zeile2[$i]==$area)or($zeile2[$i]=="alle")) return 1;
  return 0;
}

function logentry($userid,$key,$report,$remark1,$remark2)
{
			$logpath="logs/access/".date(Y)."/";
			if (file_exists($logpath))
			{
				$logpath=$logpath.date("Y_m_d").".log";
				$file=fopen($logpath,"a");
				if ($file)
				{	if ($userid=="") $userid="blank"; 
					$line=date("d.m.Y").'  '.date("H.i").'  '.$report.'  Username='.$userid.'  Password='.$key.'  Fileaccess='.$remark1.'  Fileforward='.$remark2;
					fputs($file,$line);fputs($file,"\r\n");
					fclose($file);
				}
			}
}


if ($versand=="Abschicken")
{

				$link=mysql_connect("localhost","httpd","");
				if ($link)
 				{ if(mysql_select_db($dbname,$link)) 
					{	$sql='SELECT * FROM mahopass WHERE mahopass_id="'.$userid.'"';
						$ergebnis=mysql_query($sql,$link);
						if($ergebnis)
							{$zeile=mysql_fetch_array($ergebnis);
								if (($zeile[mahopass_password]==$keyword)&&($zeile[mahopass_id]==$userid))
								{	
									if (!($zeile[mahopass_lockflag]))
									{
										if (validarea($allowedarea,$zeile,mysql_num_fields($ergebnis)))
										{				
										setcookie(ck_edv_db_user,$zeile[mahopass_name]);	
										logentry($zeile[mahopass_name],"*","IP:".$REMOTE_ADDR."EDV DB verwalten Access OK'd",$thisfile,$fileforward);
										header("Location: $fileforward?sid=$$ck_sid_buffer");
										exit;
										}else {$passtag=2;};
									}else $passtag=3;
								}else {$passtag=1;};
							}
							else {$passtag=1;};
	
					};
				mysql_close($link);
				}
				 else 
				{ print "Verbindung zur Datenbank konnte nicht hergestellt werden.<br>"; $passtag=5;}
}


?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE>EDV - Datenbank Verwalten</TITLE>
 
 <?php if($cfg['dhtml'])
{ print'
	<script language="javascript" src="../js/hilitebu.js">
	</script>
	
	 <STYLE TYPE="text/css">
	A:link  {text-decoration: none; color: '.$cfg['body_txtcolor'].';}
	A:hover {text-decoration: underline; color: '.$cfg['body_hover'].';}
	A:active {text-decoration: none; color: '.$cfg['body_alink'].';}
	A:visited {text-decoration: none; color: '.$cfg['body_txtcolor'].';}
	A:visited:active {text-decoration: none; color: '.$cfg['body_alink'].';}
	A:visited:hover {text-decoration: underline; color: '.$cfg['body_hover'].';}
	</style>';
}
?>
 
</HEAD>

<BODY  <?php if (!$nofocus) print 'onLoad="document.passwindow.userid.focus()"'; print  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>

<p>
<FONT    SIZE=-1  FACE="Arial">

<P>
<FONT  COLOR=#cc6600  SIZE=5  FACE="verdana"> <b>Datenbank Verwalten</b></font>
<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><img src=../img/einga-b.gif border=0  width=130 height=25><!-- <a href="op-pflege-logbuch-such-pass.php?sid=<?php echo $$ck_sid_buffer;?>"><img src="../img/such-gray.gif" border=0 width=130 height=25 <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="op-pflege-logbuch-arch-pass.php?sid=<?php echo $$ck_sid_buffer;?>"><img src="../img/arch-gray.gif" border=0 width=130 height=25 <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a> --></td>
</tr>

<tr>
<td bgcolor=#333399 colspan=3>
<FONT   SIZE=1  FACE="Arial"><STRONG>&nbsp;</STRONG></FONT>
</td>
</tr>

<tr bgcolor="#DDE1EC">
<td bgcolor=#333399><font size=1>&nbsp;</td>

<td>

<p><br>
<center>


<?php if ((($userid!=NULL)||($keyword!=NULL))&&($passtag!=NULL)) 
{
print '<FONT  COLOR="red"  SIZE=+2  FACE="Arial"><STRONG>';

$errbuf="EDV - DB verwalten ";

switch($passtag)
{
case 1:$errbuf=$errbuf."Falsche Eingabe"; print '<img src=../img/cat-fe.gif align=left>';break;
case 2:$errbuf=$errbuf."Keine Berechtigung"; print '<img src=../img/cat-noacc.gif align=left>';break;
default:$errbuf=$errbuf."Zugang gesperrt"; print '<img src=../img/warn.gif align=left>'; 
}


logentry($userid,$keyword,$errbuf,$thisfile,$fileforward);


print '</STRONG></FONT><P>';

}
?>

<table  border=0 cellpadding=0 cellspacing=0>
<tr>
<?php if(!$passtag) print'
<td>

<img src="../img/ned2r.gif" border=0 width=100 height=138 >
</td>
';
?>
<td bgcolor="#999999" valign=top>

<table cellpadding=1 bgcolor=#999999 cellspacing=0>
<tr>
<td>
<table cellpadding=20 bgcolor=#eeeeee >
<tr>
<td>

<p>
<FORM action="<?php print $thisfile; ?>" method="post" name="passwindow">

<font color=maroon size=3>
<b>Passwort ist erforderlich!</b></font><p>
<font face="Arial,Verdana"  color="#000000" size=-1>
Benutzername eingeben:<br></font>
<INPUT type="text" name="userid" size="14" maxlength="25"> <p>
<font face="Arial,Verdana"  color="#000000" size=-1>Passwort eingeben:</font><br>
<INPUT type="password" name="keyword" size="14" maxlength="25"> 
<input type="hidden" name="versand" value="Abschicken">
<input type="hidden" name="sid" value="<?php print $sid; ?>">
<input type="image" src="../img/abschic.gif" border=0 width=110 height=24>
</font>
</FORM>

<FORM action="<?php print $breakfile;?>"  name=cancelbut>
<input type="hidden" name="sid" value="<?php print $sid; ?>">
<input type="image" src="../img/abbrech.gif" border=0 width=103 height=24>
                                                       </font></FORM>

</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>        

<p><br>

</center>

</td>
<td bgcolor=#333399><font size=1>&nbsp;</td>
</tr>

<tr >
<td bgcolor="#333399" colspan=3><font size=1>
&nbsp; 
</td>
</tr>


</table>        

<p>
<img src="../img/small_help.gif"> <a href="ucons.php<?php echo "?lang=$lang" ?>">Einführung in die SQL Datenbank.</a><br>
<img src="../img/small_help.gif"> <a href="ucons.php<?php echo "?lang=$lang" ?>">Wie mache ich was hier?</a><br>
<HR>
<p>

<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>


</FONT>


</BODY>
</HTML>
