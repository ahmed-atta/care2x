<? 
if(($sid==NULL)||($sid!=$ck_sid)) { header("location:invalid-access-warning.php"); exit;}

if($ck_language!="") $lang="../language/".$ck_language."-lang.php";
	else $lang="../language/english-lang.php"; // if no language cookie, set lang to english
require($lang);

require("../req/config-color.php");

srand(time()*1000);
$r=rand(1,1000);
$dbname="maho";
$allowedarea="System_Admin";
$fileforward="products-bestellung.php";
$thisfile="apotheke-bestellung-pass.php";
$breakfile="apotheke.php";


//setcookie(ck_edvzugang_user,"");

require("../req/pass-f2f.php"); // loads the validarea and logentry functions

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
										setcookie(ck_pharma_order_user,$zeile[mahopass_name]);	
										setcookie(ck_pharma_order_src,"orderpass");	
										logentry($zeile[mahopass_name],"*","IP:".$REMOTE_ADDR."Apotheke Bestellung Access OK'd",$thisfile,$fileforward);
										header("Location: $fileforward?sid=$ck_sid&cat=pharma");
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
				{ print "$db_noconnect<br>"; $passtag=5;}
}


?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE>Apotheke Bestellung</TITLE>
 
 <? 
 require("../req/css-a-hilitebu.php");
?>
 
</HEAD>

<BODY  <? if (!$nofocus) print 'onLoad="document.passwindow.userid.focus()"'; print  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>

<p>
<FONT    SIZE=-1  FACE="Arial">

<P>
<FONT  COLOR=#cc6600  SIZE=5  FACE="verdana"> <b>Apotheke Bestellung</b></font>
<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<!-- <tr>
<td colspan=3><a href="edv-accessplan-pass.php?sid=<?print $ck_sid;?>"><img src=../img/ein-gray.gif border=0  width=130 height=25 <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><img src="../img/such-b.gif" border=0 width=130 height=25 ><a href="edv-accessplan-list-pass.php?sid=<?print $ck_sid;?>"><img src="../img/lista-gray.gif" border=0 width=130 height=25 <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr> -->
<tr>
<td  colspan=3>
<FONT   SIZE=2  FACE="verdana,Arial"><STRONG>&nbsp;Bestellliste Erstellen</STRONG></FONT>
</td>
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


<? if ((($userid!=NULL)||($keyword!=NULL))&&($passtag!=NULL)) 
{
print '<FONT  COLOR="red"  SIZE=+2  FACE="Arial"><STRONG>';

$errbuf="Apotheke Bestellung ";

switch($passtag)
{
case 1:$errbuf=$errbuf."Falsche Eingabe"; print '<img src=../img/cat-fe.gif >';break;
case 2:$errbuf=$errbuf."Keine Berechtigung"; print '<img src=../img/cat-noacc.gif >';break;
default:$errbuf=$errbuf."Zugang gesperrt"; print '<img src=../img/cat-sperr.gif >'; 
}


logentry($userid,$keyword,$errbuf,$thisfile,$fileforward);


print '</STRONG></FONT><P>';

}
?>

<table  border=0 cellpadding=0 cellspacing=0>
<tr>
<? if(!$passtag) print'
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
<FORM action="<? print $thisfile; ?>" method="post" name="passwindow">

<font color=maroon size=3>
<b>Passwort ist erforderlich!</b></font><p>
<font face="Arial,Verdana"  color="#000000" size=-1>
Benutzername eingeben:<br></font>
<INPUT type="text" name="userid" size="14" maxlength="25"> <p>
<font face="Arial,Verdana"  color="#000000" size=-1>Passwort eingeben:</font><br>
<INPUT type="password" name="keyword" size="14" maxlength="25"> 
<input type="hidden" name="versand" value="Abschicken">
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="image" src="../img/abschic.gif" border=0 width=110 height=24>
</font>
</FORM>

<FORM action="<? print $breakfile;?>"  name=cancelbut>
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
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
<img src="../img/small_help.gif" border=0 width=20 height=20> <a href="ucons.php">Einführung in die Apothekenbestellung.</a><br>
<img src="../img/small_help.gif" border=0 width=20 height=20> <a href="ucons.php">Wie mache ich was hier?</a><br>
<HR>
<p>

<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>


</FONT>


</BODY>
</HTML>
