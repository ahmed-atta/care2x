<?
if(($sid==NULL)||($sid!=$ck_sid)) { header("location:invalid-access-warning.php"); exit;}
require("../req/config-color.php");

$thisfile="medlager-datenbank-info.php";
$breakfile="medlager-datenbank-functions.php";

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE> Medicallager Datenbank - Information </TITLE>

 <script language="javascript" >
<!-- 
function closewin()
{
	location.href='apotheke.php?sid=<?print $ck_sid.'&uid='.$r;?>';
}

function pruf(d)
{
	if(d.keyword.value=="")
	{
		d.keyword.focus();
		 return false;
	}
	return true;
}

// -->
</script> 

<? 
require("../req/css-a-hilitebu.php");
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="document.suchform.keyword.focus()"
<? if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<a name="pagetop"></a>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="45">
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; Medicallager Datenbank - Information</STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<!-- <a href="#" onClick=history.back(1)><img src="../img/zuruck.gif" border=0 <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a> -->
<a href="#"><img src="../img/hilfe.gif" border=0 width=93 height=41  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="apotheke.php?sid=<?print $ck_sid;?>"><img src="../img/fenszu.gif" border=0 width=93 height=41  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>
<FONT face="Verdana,Helvetica,Arial" size=2>
<p><br>
  <form action="<?=$thisfile?>" method="get" name="suchform" onSubmit="return pruf(this)">
  <table border=0 cellspacing=2 cellpadding=3>
    <tr bgcolor=#ffffdd>
      <td colspan=2><FONT face="Verdana,Helvetica,Arial" size=2 color="#800000">Geben Sie den Suchbegriff ein.</font>
	  </td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2>Suchbegriff:</td>
      <td><input type="text" name="keyword" size=40 maxlength=40>
          </td>
    </tr>
   

    <tr >
      <td ><input type="submit" value="Suchen" >
           </td>
      <td align=right><input type="reset" value="L�schen" onClick="document.suchform.keyword.focus()">
                      </td>
    </tr>
  </table>
  <input type="hidden" name="sid" value="<?=$ck_sid?>">
  <input type="hidden" name="mode" value="search">
  </form>
<hr>

<b>Anforderung f�r Reparatur<br>
Anmeldung eines Schaden<br>
Heizung<br>
Entsorgung<br>
EDV<br></b>
<ul>
	IP Addresse von Rechner<br>
	Drucker
</ul>
<b>Klimaanlage<br>
Reinigung<br>
Strom, Elektrizit�t<br>
Telefon<br>
Wasser, Versorgung</b>


<form action="<?=$breakfile?>" method="post" >
<input type="hidden" name="sid" value="<?=$ck_sid?>">
<input  type="image" src="../img/abbrech.gif" border=0 width=103 height=24 alt="Zur�ck zu Datenbank Menuauswahl">
</form>
<?
if ($from=="multiple")
print '
<form name=backbut onSubmit="<?=$breakfile ?>">
<input type="hidden" name="sid" value="<?=$ck_sid?>">
<input type="submit" value="Zur�ck" onClick="history.back()">
</form>
';
?>
</ul>

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
