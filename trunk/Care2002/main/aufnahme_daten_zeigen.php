<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/*
CARE 2002 Integrated Information System beta 1.0.02 - 30.07.2002 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
define("LANG_FILE","aufnahme.php");
$local_user="aufnahme_user";
require("../include/inc_front_chain_lang.php");

require("../include/inc_config_color.php");

$thisfile="aufnahme_daten_zeigen.php";
$breakfile="aufnahme_pass.php?sid=$sid&lang=$lang";
$updatefile="aufnahme_start.php";


$dbtable="mahopatient";

require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK) 
 	{ 
			$sql='SELECT * FROM '.$dbtable.' WHERE item="'.addslashes($itemname).'"';
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
 
 <?php 
require("../include/inc_css_a_hilitebu.php");
?>
<script  language="javascript">
<!-- 
function makeBarcodeLabel(p)
{

	urlholder="barcode-labels.php?sid=<?php echo "$sid&lang=$lang" ?>&pn="+p;
	bclabel=window.open(urlholder,"bclabel","menubar=no,resizable=yes,scrollbars=yes");
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
-->
</script>
 
</HEAD>

<BODY bgcolor="<?php echo $cfg['bot_bgcolor'];?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 cellspacing=0>

<tr>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp;<?php echo $LDPatientData ?></STRONG></FONT>
</td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('admission_how2update.php','<?php echo $from ?>')"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
if($HTTP_COOKIE_VARS["ck_login_logged".$sid]) print "startframe.php?sid=$sid&lang=$lang"; 
	else print "aufnahme_pass.php?sid=$sid&target=entry&lang=$lang"; ?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?php echo $LDCloseWin ?>" width=93 height=41  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>
<tr>
<td colspan=3  bgcolor=#dde1ec><p><br>
<ul>
<FONT    SIZE=-1  FACE="Arial">




<table border="0">


<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDAdmitDate ?>: 
</td>
<td bgcolor=#ffffee>&nbsp;<?php print "<font face=arial size=2>".$zeile[pdate]; ?> 
</td>
<td ><FONT  SIZE=2  FACE="Arial"><?php echo $LDAdmitBy ?>:
</td>
<td bgcolor=#ffffee>&nbsp;<?php print "<font face=arial size=2>".$zeile[encoder]; ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDAdmitTime ?>:
</td>
<td bgcolor=#ffffee>&nbsp;<?php print "<font face=arial size=2>".$zeile[ptime]; ?> 
</td>
</tr>
<tr>
<td colspan=4><FONT SIZE=-1  FACE="Arial">&nbsp;
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><b><?php echo $LDCaseNr ?>:</b>
</td>
<td colspan=3 bgcolor=#ffffee>&nbsp;<b><?php print "<font face=arial size=2>".$zeile[patnum]; ?></b>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDTitle ?>:
</td>
<td colspan=3 bgcolor=#ffffee>&nbsp;<?php print "<font face=arial size=2>".$zeile[title]; ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><b><?php echo $LDLastName ?>:</b>
</td>
<td bgcolor=#ffffee>&nbsp;<b><?php print "<font face=arial size=2>".$zeile[name]; ?></b> 
</td>
<td align=right><FONT SIZE=-1  FACE="Arial"> &nbsp;<?php echo $LDAddress ?>:
</td>
<td rowspan=4 bgcolor=#ffffee valign=top><?php print "<font face=arial size=2>".nl2br($zeile[address]); ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><b><?php echo $LDFirstName ?>:</b>
</td>
<td colspan=2 bgcolor=#ffffee>&nbsp;<b><?php print "<font face=arial size=2>".$zeile[vorname]; ?></b>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDBday ?>:
</td>
<td  colspan=2 bgcolor=#ffffee>&nbsp;<?php print "<font face=arial size=2>".$zeile[gebdatum]; ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDPhone ?>:
</td>
<td colspan=2 bgcolor=#ffffee>&nbsp;<?php print "<font face=arial size=2>".$zeile[phone1]; ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDAdmission ?>:
</td>
<td  colspan=3 bgcolor=#ffffee ><FONT SIZE=-1  FACE="Arial">&nbsp;<?php if($zeile[status]!="") if ($zeile[status]=="amb") print $LDAmbulant; else print $LDStationary; ?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial">Kasse:
</td>
<td colspan=2 bgcolor=#ffffee ><FONT SIZE=-1  FACE="Arial">&nbsp;<?php switch($zeile[kasse])
   {
     case "x": print $LDSelfPay;break;
	 case "privat": print $LDPrivate; break;
	 case "kasse": print $LDInsurance; break;
	 default: print "";
	}
?>
</td>
<td
<?php  print "bgcolor=#ffffee><font face=arial size=2>&nbsp;".$zeile[kassename];?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDDiagnosis ?>:
</td>
<td colspan=3 bgcolor=#ffffee>&nbsp;<?php print "<font face=arial size=2>".$zeile[diagnose]; ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDRecBy ?>:
</td>
<td colspan=3 bgcolor=#ffffee>&nbsp;<?php print "<font face=arial size=2>".$zeile[referrer]; ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDTherapy ?>:
</td>
<td colspan=3 bgcolor=#ffffee>&nbsp;<?php print "<font face=arial size=2>".$zeile[therapie]; ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDSpecials ?>:
</td>
<td colspan=3 bgcolor=#ffffee>&nbsp;<?php print "<font face=arial size=2>".$zeile[besonder]; ?> 
</td>
</tr>
<tr>
<td colspan=2><p><br>

<?php if($from=="entry") print '
<form method="post" action="aufnahme_start.php">
<input type=hidden name=sid value='.$sid.'>
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
		print ' onClick="location.replace(\'aufnahme_daten_such.php?sid='.$sid.'&lang='.$lang.'\');">'; 
	}
	 else
	{
		print $LDBack2Archive.'"';
		print ' onClick="location.replace(\'aufnahme_list.php?sid='.$sid.'&lang='.$lang.'\');">'; 
	}
	print '</form>';
}
?>
</td>
<td colspan=3><p><br>
<form method="post" action="<?php print $updatefile; ?>">
<input type=hidden name=sid value=<?php echo $sid ?>>
<input type=hidden name=itemname value=<?php print $itemname; ?>>
<input type=hidden name=update value=1>
<input type="hidden" name="mode" value="?">
<input type="hidden" name="from" value="<?php echo $from ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<img src="../img/update.gif"> <input  type="submit" value="<?php echo $LDUpdateData ?>"> 
<input type="button" value="<?php echo $LDMakeBarcodeLabels ?>" onClick="makeBarcodeLabel('<?php echo $zeile[patnum] ?>')">
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
<img src="../img/varrow.gif" width="20" height="15"> <a href="aufnahme_start.php?sid=<?php print "$sid&lang=$lang"; ?>&mode=?"><?php echo $LDAdmWantEntry ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="aufnahme_daten_such.php?sid=<?php print "$sid&lang=$lang"; ?>"><?php echo $LDAdmWantSearch ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="aufnahme_list.php?sid=<?php print "$sid&lang=$lang"; ?>&newdata=1"><?php echo $LDAdmWantArchive ?></a><br>
<p>
&nbsp;
<?php if ($from=="such") print '
		<a href="aufnahme_daten_such.php?sid='.$sid.'">';
	if($from=="entry") print '
		<a href="aufnahme_start.php?sid='.$sid.'">';
?>
<img src="../img/<?php echo "$lang/$lang" ?>_cancel.gif" width=103 height=24 border=0></a>
<p>
<hr>
<?php
require("../language/$lang/".$lang."_copyrite.php");

 ?>

</FONT>


</BODY>
</HTML>
