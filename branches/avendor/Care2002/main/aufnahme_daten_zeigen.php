<?
/*
CARE 2002 Integrated Information System for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	
Beta version 1.0    2002-05-10
GNU GPL. For details read file "copy_notice.txt".
*/
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$aufnahme_user||!$sid||($sid!=$ck_sid))  {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../language/".$lang."/lang_".$lang."_aufnahme.php");

require("../req/config-color.php");

$thisfile="aufnahme_daten_zeigen.php";
$breakfile="aufnahme_pass.php?sid=$ck_sid&lang=$lang";
$updatefile="aufnahme_start.php";


$dbtable="mahopatient";

require("../req/db-makelink.php");
if($link&&$DBLink_OK) 
 	{ 

			$sql='SELECT * FROM '.$dbtable.' WHERE item="'.$itemname.'"';
        	$ergebnis=mysql_query($sql,$link);
			$zeile=mysql_fetch_array($ergebnis);

	}
  	 else { print "$LDDbNoLink<br>"; } 
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE></TITLE>
 
 <? 
require("../req/css-a-hilitebu.php");
?>
<script  language="javascript">
<!-- 
function makeBarcodeLabel(p)
{

	urlholder="barcode-labels.php?sid=<?="$ck_sid&lang=$lang" ?>&pn="+p;
	bclabel=window.open(urlholder,"bclabel","menubar=no,resizable=yes,scrollbars=yes");
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
-->
</script>
 
</HEAD>

<BODY bgcolor="<?print $cfg['bot_bgcolor'];?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 cellspacing=0>

<tr>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp;<?=$LDPatientData ?></STRONG></FONT>
</td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('admission_how2update.php','<?=$from ?>')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<? 
if($ck_login_logged) print "startframe.php?sid=$ck_sid&lang=$lang"; 
	else print "aufnahme_pass.php?sid=$ck_sid&target=entry&lang=$lang"; ?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDCloseWin ?>" width=93 height=41  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>
<tr>
<td colspan=3  bgcolor=#dde1ec><p><br>
<ul>
<FONT    SIZE=-1  FACE="Arial">




<table border="0">


<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDAdmitDate ?>: 
</td>
<td bgcolor=#ffffee>&nbsp;<? print "<font face=arial size=2>".$zeile[pdate]; ?> 
</td>
<td ><FONT  SIZE=2  FACE="Arial"><?=$LDAdmitBy ?>:
</td>
<td bgcolor=#ffffee>&nbsp;<? print "<font face=arial size=2>".$zeile[encoder]; ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDAdmitTime ?>:
</td>
<td bgcolor=#ffffee>&nbsp;<? print "<font face=arial size=2>".$zeile[ptime]; ?> 
</td>
</tr>
<tr>
<td colspan=4><FONT SIZE=-1  FACE="Arial">&nbsp;
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><b><?=$LDCaseNr ?>:</b>
</td>
<td colspan=3 bgcolor=#ffffee>&nbsp;<b><? print "<font face=arial size=2>".$zeile[patnum]; ?></b>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDTitle ?>:
</td>
<td colspan=3 bgcolor=#ffffee>&nbsp;<? print "<font face=arial size=2>".$zeile[title]; ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><b><?=$LDLastName ?>:</b>
</td>
<td bgcolor=#ffffee>&nbsp;<b><? print "<font face=arial size=2>".$zeile[name]; ?></b> 
</td>
<td align=right><FONT SIZE=-1  FACE="Arial"> &nbsp;<?=$LDAddress ?>:
</td>
<td rowspan=4 bgcolor=#ffffee valign=top><? print "<font face=arial size=2>".nl2br($zeile[address]); ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><b><?=$LDFirstName ?>:</b>
</td>
<td colspan=2 bgcolor=#ffffee>&nbsp;<b><? print "<font face=arial size=2>".$zeile[vorname]; ?></b>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDBday ?>:
</td>
<td  colspan=2 bgcolor=#ffffee>&nbsp;<? print "<font face=arial size=2>".$zeile[gebdatum]; ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDPhone ?>:
</td>
<td colspan=2 bgcolor=#ffffee>&nbsp;<? print "<font face=arial size=2>".$zeile[phone1]; ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDAdmission ?>:
</td>
<td  colspan=3 bgcolor=#ffffee ><FONT SIZE=-1  FACE="Arial">&nbsp;<? if($zeile[status]!="") if ($zeile[status]=="amb") print $LDAmbulant; else print $LDStationary; ?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial">Kasse:
</td>
<td colspan=2 bgcolor=#ffffee ><FONT SIZE=-1  FACE="Arial">&nbsp;<? switch($zeile[kasse])
   {
     case "x": print $LDSelfPay;break;
	 case "privat": print $LDPrivate; break;
	 case "kasse": print $LDInsurance; break;
	 default: print "";
	}
?>
</td>
<td
<?  print "bgcolor=#ffffee><font face=arial size=2>&nbsp;".$zeile[kassename];?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDDiagnosis ?>:
</td>
<td colspan=3 bgcolor=#ffffee>&nbsp;<? print "<font face=arial size=2>".$zeile[diagnose]; ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDRecBy ?>:
</td>
<td colspan=3 bgcolor=#ffffee>&nbsp;<? print "<font face=arial size=2>".$zeile[referrer]; ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDTherapy ?>:
</td>
<td colspan=3 bgcolor=#ffffee>&nbsp;<? print "<font face=arial size=2>".$zeile[therapie]; ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDSpecials ?>:
</td>
<td colspan=3 bgcolor=#ffffee>&nbsp;<? print "<font face=arial size=2>".$zeile[besonder]; ?> 
</td>
</tr>
<tr>
<td colspan=2><p><br>

<? if($from=="entry") print '
<form method="post" action="aufnahme_start.php">
<input type=hidden name=sid value='.$ck_sid.'>
<input type="hidden" name="mode" value="?">
<input type=hidden name=patnum value="">
<img src="../img/arrow_prev_gray.gif"> <input  type="submit" value="'.$LDBack2Admit.'"> 
</form>
'; else 
{
	print'<form><img src="../img/arrow_prev_gray.gif"> ';
	print '<input type="button" value="';
	if ($from=="such") 
	{
		print $LDBack2Search.'"';
		print ' onClick="location.replace(\'aufnahme_daten_such.php?sid='.$ck_sid.'&lang='.$lang.'\');">'; 
	}
	 else
	{
		print $LDBack2Archive.'"';
		print ' onClick="location.replace(\'aufnahme_list.php?sid='.$ck_sid.'&lang='.$lang.'\');">'; 
	}
	print '</form>';
}
?>
</td>
<td colspan=3><p><br>
<form method="post" action="<? print $updatefile; ?>">
<input type=hidden name=sid value=<?=$ck_sid ?>>
<input type=hidden name=itemname value=<? print $itemname; ?>>
<input type=hidden name=update value=1>
<input type="hidden" name="mode" value="?">
<input type="hidden" name="from" value="<?=$from ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<img src="../img/update.gif"> <input  type="submit" value="<?=$LDUpdateData ?>"> 
<input type="button" value="Make barcode labels" onClick="makeBarcodeLabel('<?=$zeile[patnum] ?>')">
</form>

</td>
</tr>

</table>
<p>



<p>
</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<p>
<FONT    SIZE=2  FACE="Arial">
<img src="../img/varrow.gif" width="20" height="15"> <a href="aufnahme_start.php?sid=<? print "$ck_sid&lang=$lang"; ?>&mode=?"><?=$LDAdmWantEntry ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="aufnahme_daten_such.php?sid=<? print "$ck_sid&lang=$lang"; ?>"><?=$LDAdmWantSearch ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="aufnahme_list.php?sid=<? print "$ck_sid&lang=$lang"; ?>&newdata=1"><?=$LDAdmWantArchive ?></a><br>
<p>
&nbsp;
<? if ($from=="such") print '
		<a href="aufnahme_daten_such.php?sid='.$ck_sid.'">';
	if($from=="entry") print '
		<a href="aufnahme_start.php?sid='.$ck_sid.'">';
?>
<img src="../img/<?="$lang/$lang" ?>_cancel.gif" width=103 height=24 border=0></a>
<p>
<hr>
<?php
require("../language/$lang/".$lang."_copyrite.htm");

 ?>

</FONT>


</BODY>
</HTML>
