<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/*
CARE 2002 Integrated Information System beta 1.0.03 - 2002-10-26 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require_once('../include/inc_front_chain_lang.php');

require_once('../include/inc_config_color.php');

$thisfile="aufnahme_daten_zeigen.php";
$breakfile="aufnahme_pass.php?sid=".$sid."&lang=".$lang;
$updatefile="aufnahme_start.php";


$dbtable='care_admission_patient';

/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
 	{ 

		$sql='SELECT * FROM '.$dbtable.' WHERE item="'.addslashes($itemname).'"';
       	$ergebnis=mysql_query($sql,$link);
		$zeile=mysql_fetch_array($ergebnis);

        include_once('../include/inc_date_format_functions.php');
        

	}
  	 else { echo "$LDDbNoLink<br>"; } 

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE></TITLE>
 
 <?php 
require('../include/inc_css_a_hilitebu.php');
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
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 cellspacing=0>

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp;<?php echo $LDPatientData ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('admission_how2update.php','<?php echo $from ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
if($HTTP_COOKIE_VARS["ck_login_logged".$sid]) echo "startframe.php?sid=".$sid."&lang=".$lang; 
	else echo "aufnahme_pass.php?sid=$sid&target=entry&lang=$lang"; ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
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
<td bgcolor=#ffffee>&nbsp;<?php echo "<font face=arial size=2>".formatDate2Local($zeile[pdate],$date_format); ?> 
</td>
<td align="right"><FONT  SIZE=2  FACE="Arial"><?php echo $LDAdmitBy ?>:
</td>
<td bgcolor=#ffffee>&nbsp;<?php echo "<font face=arial size=2>".$zeile[encoder]; ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDAdmitTime ?>:
</td>
<td bgcolor=#ffffee>&nbsp;<?php echo "<font face=arial size=2>".$zeile[ptime]; ?> 
</td>
</tr>
<tr>
<td colspan=4><FONT SIZE=-1  FACE="Arial">&nbsp;
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><b><?php echo $LDCaseNr ?>:</b>
</td>
<td colspan=2 bgcolor=#ffffee>&nbsp;<b><?php echo "<font face=arial size=2>".$zeile[patnum]; ?></b>
</td>
<td rowspan=2 bgcolor=#ffffee>
<?php if(file_exists("../cache/barcodes/pn_".$zeile[patnum].".png")) echo '<img src="../cache/barcodes/pn_'.$zeile[patnum].'.png" border=0 height=40>';
else echo "<img src='../classes/barcode/image.php?code=$zeile[patnum]&style=68&type=I25&width=145&height=40&xres=2&font=5' border=0>";
?></b>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDTitle ?>:
</td>
<td colspan=2 bgcolor=#ffffee>&nbsp;<?php echo "<font face=arial size=2>".$zeile[title]; ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><b><?php echo $LDLastName ?>:</b>
</td>
<td bgcolor=#ffffee>&nbsp;<b><?php echo "<font face=arial size=2>".$zeile[name]; ?></b> 
</td>
<td align=right><FONT SIZE=-1  FACE="Arial"> &nbsp;<?php echo $LDAddress ?>:
</td>
<td rowspan=4 bgcolor=#ffffee valign=top><?php echo "<font face=arial size=2>".nl2br($zeile[address]); ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><b><?php echo $LDFirstName ?>:</b>
</td>
<td colspan=2 bgcolor=#ffffee>&nbsp;<b><?php echo "<font face=arial size=2>".$zeile[vorname]; ?></b>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDBday ?>:
</td>
<td  colspan=2 bgcolor=#ffffee>&nbsp;<?php echo "<font face=arial size=2>".formatDate2Local($zeile[gebdatum],$date_format); ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDPhone ?>:
</td>
<td colspan=2 bgcolor=#ffffee>&nbsp;<?php echo "<font face=arial size=2>".$zeile[phone1]; ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDAdmission ?>:
</td>
<td  colspan=3 bgcolor=#ffffee ><FONT SIZE=-1  FACE="Arial">&nbsp;<?php if($zeile[status]!="") if ($zeile[status]=="amb") echo $LDAmbulant; else echo $LDStationary; ?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial">Kasse:
</td>
<td colspan=2 bgcolor=#ffffee ><FONT SIZE=-1  FACE="Arial">&nbsp;<?php switch($zeile[kasse])
   {
     case "x": echo $LDSelfPay;break;
	 case "privat": echo $LDPrivate; break;
	 case "kasse": echo $LDInsurance; break;
	 default: echo "";
	}
?>
</td>
<td
<?php  echo "bgcolor=#ffffee><font face=arial size=2>&nbsp;".$zeile[kassename];?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDDiagnosis ?>:
</td>
<td colspan=3 bgcolor=#ffffee>&nbsp;<?php echo "<font face=arial size=2>".$zeile[diagnose]; ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDRecBy ?>:
</td>
<td colspan=3 bgcolor=#ffffee>&nbsp;<?php echo "<font face=arial size=2>".$zeile[referrer]; ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDTherapy ?>:
</td>
<td colspan=3 bgcolor=#ffffee>&nbsp;<?php echo "<font face=arial size=2>".$zeile[therapie]; ?> 
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDSpecials ?>:
</td>
<td colspan=3 bgcolor=#ffffee>&nbsp;<?php echo "<font face=arial size=2>".$zeile[besonder]; ?> 
</td>
</tr>
<tr>
<td colspan=2><p><br>

<?php if($from=="entry") echo '
<form method="post" action="aufnahme_start.php">
<input type=hidden name=sid value='.$sid.'>
<input type="hidden" name="mode" value="?">
<input type=hidden name=patnum value="">
<img '.createComIcon('../','arrow_prev_gray.gif').'> <input  type="submit" value="'.$LDBack2Admit.'"> 
</form>
'; 
else 
{
	echo'<form><img '.createComIcon('../','arrow_prev_gray.gif').'> ';
	echo '<input type="button" value="';
	if ($from=="such") 
	{
		echo $LDBack2Search.'"';
		echo ' onClick="location.replace(\'aufnahme_daten_such.php?sid='.$sid.'&lang='.$lang.'\');">'; 
	}
	 else
	{
		echo $LDBack2Archive.'"';
		echo ' onClick="location.replace(\'aufnahme_list.php?sid='.$sid.'&lang='.$lang.'\');">'; 
	}
	echo '</form>';
}
?>
</td>
<td colspan=3><p><br>
<form method="post" action="<?php echo $updatefile; ?>">
<input type=hidden name=sid value=<?php echo $sid ?>>
<input type=hidden name=itemname value=<?php echo $itemname; ?>>
<input type=hidden name=update value=1>
<input type="hidden" name="mode" value="?">
<input type="hidden" name="from" value="<?php echo $from ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<img <?php echo createComIcon('../','update.gif') ?>> <input  type="submit" value="<?php echo $LDUpdateData ?>"> 
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
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="aufnahme_start.php?sid=<?php echo "$sid&lang=$lang"; ?>&mode=?"><?php echo $LDAdmWantEntry ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="aufnahme_daten_such.php?sid=<?php echo "$sid&lang=$lang"; ?>"><?php echo $LDAdmWantSearch ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="aufnahme_list.php?sid=<?php echo "$sid&lang=$lang"; ?>&newdata=1"><?php echo $LDAdmWantArchive ?></a><br>
<p>
&nbsp;
<?php if ($from=="such") echo '
		<a href="aufnahme_daten_such.php?sid='.$sid.'">';
	if($from=="entry") echo '
		<a href="aufnahme_start.php?sid='.$sid.'">';
?>
<img <?php echo createLDImgSrc('../','cancel.gif','0') ?>></a>
<p>
<hr>
<?php
require("../language/$lang/".$lang."_copyrite.php");

 ?>

</FONT>


</BODY>
</HTML>
