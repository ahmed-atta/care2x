<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','or.php');
$local_user='ck_opdoku_user';
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php'); // load color preferences

$thisfile='op-doku-archiv.php';
$breakfile='op-doku.php?sid='.$sid.'&lang='.$lang;

if(!$dept)
	if($HTTP_COOKIE_VARS[ck_thispc_dept]) $dept=$HTTP_COOKIE_VARS[ck_thispc_dept];
		else $dept='plop'; // default department is plop

$linecount=0;

function clean_it(&$d)
{
	$d=strtr($d,"°!§$%&/()=?`´*+'#{}[]\^","~~~~~~~~~~~~~~~~~~~~~~~");
	$d=str_replace("\"","~",$d);
	$d=str_replace("~","",$d);
	return trim($d);
}

/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
{	

    /* Load date formatter */
    include_once('../include/inc_date_format_functions.php');
    

		switch($mode)
		{
			case 'search':
			
							$dbtable='care_op_med_doc';
							
							$sql="SELECT * FROM $dbtable WHERE ";
							$s2="";
							if (clean_it(&$name)) $s2.=" name=\"".addslashes($name)."\"";
							if (clean_it(&$vorname))
								if($s2) $s2.=" AND vorname=\"".addslashes($vorname)."\""; else $s2.=" vorname=\"".addslashes($vorname)."\"";
							if($gebdatum)
							{
							    $gebdatum=formatDate2STD($gebdatum,$date_format);
								if($s2) $s2.=" AND gebdatum=\"".addslashes($gebdatum)."\""; else $s2.=" gebdatum=\"".addslashes($gebdatum)."\"";
							}
							if($op_date)
							{
							    $op_date=formatDate2STD($op_date,$date_format);
								if($s2) $s2.=" AND op_date=\"".addslashes($op_date)."\""; else $s2.=" op_date=\"".addslashes($op_date)."\"";
							}
							if (clean_it(&$patnum))
							{
								if(is_numeric($patnum)) $patnum=(int)$patnum; else $patnum='"'.addslashes($patnum).'"';
								if($s2) $s2.=" AND patnum=$patnum"; else $s2.=" patnum=$patnum";
							}
							if(clean_it(&$operator))
								if($s2) $s2.=" AND operator=\"".addslashes($operator)."\""; else $s2.=" operator=\"".addslashes($operator)."\"";
							if ($status)
								if($s2) $s2.=" AND status=\"$status\""; else $s2.=" status=\"$status\"";
							if ($kasse)
								if($s2) $s2.=" AND kasse=\"$kasse\""; else $s2.=" kasse=\"$kasse\"";
							if(clean_it(&$diagnosis))
								if($s2) $s2.=" AND diagnosis LIKE \"%$diagnosis%\""; else $s2.=" diagnosis LIKE \"%$diagnosis%\"";
							if(clean_it(&$localize))
								if($s2) $s2.=" AND localize LIKE \"%$localize%\""; else $s2.=" localize LIKE \"%$localize%\"";
							if(clean_it(&$therapy))
								if($s2) $s2.=" AND therapy LIKE \"%$therapy%\""; else $s2.=" therapy LIKE \"%$therapy%\"";
							if(clean_it(&$special))
								if($s2) $s2.=" AND special LIKE \"%$special%\""; else $s2.=" special LIKE \"%$special%\"";
							if(clean_it(&$klas_s))
								if($s2) $s2.=" AND class_s=\"$klas_s\""; else $s2.=" class_s=\"$klas_s\"";
							if(clean_it(&$klas_m))
								if($s2) $s2.=" AND class_m=\"$klas_m\""; else $s2.=" class_m=\"$klas_m\"";
							if(clean_it(&$klas_l))
								if($s2) $s2.=" AND class_l=\"$klas_l\""; else $s2.=" class_l=\"$klas_l\"";
							if(clean_it(&$inst))
								if($s2) $s2.=" AND scrub_nurse=\"".addslashes($inst)."\""; else $s2.=" scrub_nurse=\"".addslashes($inst)."\"";
							if(clean_it(&$opsaal))
								if($s2) $s2.=" AND op_room=\"".addslashes($opsaal)."\""; else $s2.=" op_room=\"".addslashes($opsaal)."\"";

							$s2=trim($s2);
							if($s2=="")
								{
									header("location:$thisfile?sid=$sid&lang=$lang&mode=?");
									exit;
								}
							$sql.=$s2;
							if($ergebnis=mysql_query($sql,$link)) 
							{			
								if(!$rows=mysql_num_rows($ergebnis))
								{
									//echo $sql;
									$sql=str_replace("=\""," LIKE ~",$sql);
									$sql=str_replace("\"","%\"",$sql);
									$sql=str_replace("~","\"",$sql);
									//echo $sql;
									if($ergebnis=mysql_query($sql,$link)) 
									{			
										$rows=mysql_num_rows($ergebnis);
									}
								}
							}else echo "$LDDbNoRead<p> $sql <p>";
							
							//echo $sql;
							
							if($rows==1)
							 {
								$medoc=mysql_fetch_array($ergebnis);
								$mode='select';
							}
							break;
							
			case 'select':
			
							$dbtable='care_op_med_doc';
							
							$sql='SELECT * FROM '.$dbtable.' WHERE doc_nr="'.$doc_nr.'"';
							
							if($ergebnis=mysql_query($sql,$link)) 
							{			

								if($rows=mysql_num_rows($ergebnis))
								{
									$medoc=mysql_fetch_array($ergebnis);
								}
							}else echo "$LDDbNoRead<p> $sql <p>";

							break;
							
			default:
					if($HTTP_COOKIE_VARS['ck_login_logged'.$sid]) $mode='dummy';
					break;
		} // end of switch
	}
	else { echo "$LDDbNoLink<br>"; }

?>


<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE>OP Dokumentation</TITLE>


<script  language="javascript">
<!-- 
var iscat=true;

function hidecat()
{
	if(!iscat) return;
	if(document.images) document.catcom.src=pix.src;
	iscat=false;
}

function loadcat()
{
  cat=new Image();
  cat.src="../imgcreator/catcom.php?<?php echo "lang=$lang&person=".$HTTP_COOKIE_VARS[$local_user.$sid];?>";
  pix=new Image();
  pix.src="../gui/img/common/default/pixel.gif";
}

function showcat()
{

	if(document.images) document.catcom.src=cat.src;
	iscat=true;
}

function hilite(idx,mode) 
	{
	if(mode==1) idx.filters.alpha.opacity=100
	else idx.filters.alpha.opacity=70;
	}	
function lookmatch(d)
{
	m=d.matchcode.value;
	if(m=="") return false;
	window.location.replace("op-doku-start.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=match&matchcode="+m);
	return false;
}

function chkForm(d)
{
	if((d.op_date.value!="")||(d.operator.value!="")||(d.patnum.value!="")||(d.name.value!="")||(d.vorname.value!="")||(d.gebdatum.value!=""))return true;
	if((d.status[0].checked)||(d.status[1].checked)||(d.kasse[0].checked)||(d.kasse[1].checked)||(d.kasse[2].checked))return true;
	if((d.diagnosis.value!="")||(d.localize.value!="")||(d.special.value!="")||(d.therapy.value!="")||(d.klas_s.value!="")||(d.klas_m.value!=""))return true;
	if((d.klas_l.value!="")||(d.inst.value!="")||(d.opsaal.value!=""))return true;
	return false;
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

<?php require('../include/inc_checkdate_lang.php'); ?>

// -->
</script>

<script language="javascript" src="../js/checkdate.js" type="text/javascript"></script>
<script language="javascript" src="../js/setdatetime.js"></script>


<style type="text/css" name=cat>

div.cats{
	position: relative;
	right: 10;
	top: 80;
}
</style>
<?php 
require('../include/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if(window.focus) window.focus();loadcat();">


<table width=100% border=0 cellspacing="0">
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo "$LDOrDocument - $LDArchive ($dept)" ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('opdoc.php','arch','<?php echo $mode ?>','<?php echo $rows ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?> style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?>  alt="<?php echo $LDClose ?>" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a>
</td>
</tr>
<tr>
<td colspan=2 bgcolor="<?php echo $cfg['body_bgcolor']; ?>"><p><br>

<div class="cats"><a href="javascript:hidecat()">
<?php 

if($mode!="") echo'
<img src="../gui/img/common/default/pixel.gif" align=right name=catcom border=0>';
else echo '
<img src="../imgcreator/catcom.php?lang='.$lang.'&person='.strtr($HTTP_COOKIE_VARS[$local_user.$sid]," ","+").'" align=right name=catcom border=0 alt="'.$LDHideCat.'">';

?>
</a>
</div>

<ul>
<?php if($mode=='search')echo "<FONT  SIZE=2 FACE='verdana,Arial'>$LDSrcCondition: $s2"; ?>

<?php if($rows>1) : ?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot('../','mascot1_r.gif','0','bottom') ?> align="absmiddle"></td>
    <td><FONT  SIZE=3 FACE="verdana,Arial" color=#800000>
<b><?php echo "$LDPatientsFound<br>$LDPlsClk1" ?></b></font></td>
  </tr>
</table>

<table border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor=#0000aa>
 <?php 
   		for($i=0;$i<sizeof($LDSrcListElements);$i++)
		echo '
		   <td><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>&nbsp; &nbsp;'.$LDSrcListElements[$i].'&nbsp;</b></td>';
	?>  </tr>
 <?php 
 $toggle=0;
 while($medoc=mysql_fetch_array($ergebnis))
 {
 	echo'
  <tr ';
  if($toggle){ echo "bgcolor=#efefef"; $toggle=0;} else {echo "bgcolor=#ffffff"; $toggle=1;}
  
  $buf='op-doku-archiv.php?sid='.$sid.'&lang='.$lang.'&mode=select&doc_nr='.$medoc[doc_nr];
  
  echo '>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'"><img '.createComIcon('../','r_arrowgrnsm.gif','0').'></a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$medoc['name'].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$medoc['vorname'].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.formatDate2Local($medoc['gebdatum'],$date_format).'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$medoc['patnum'].'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.formatDate2Local($medoc['op_date'],$date_format).'</a></td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$medoc['dept'].'</td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$medoc['doc_nr'].'</a>&nbsp; &nbsp;</td>
  </tr>
  <tr bgcolor=#0000ff>
  <td colspan=8 height=1><img src="../gui/img/common/default/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
  </tr>';
  }
 ?>
</table>
<p>
<form method="post"  action="op-doku-archiv.php">
<FONT  SIZE=-1  FACE="Arial">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="mode" value="dummy">
<input type="submit" value="<?php echo $LDNewArchiveSearch ?>" >
                             </form>
<?php else :?>



<FONT  SIZE=-1  FACE="Arial">
<table border="0"  bgcolor="#ffffff">

<form method="post" name="opdoc" <?php if($mode=="select") echo 'action="op-doku-start.php"'; else echo 'action="op-doku-archiv.php"  onSubmit="return chkForm(this)"'; ?>>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDOpDate ?>:<br>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php

if($mode=="select")
{
    echo '<font color="#800000">'.formatDate2Local($medoc['op_date'],$date_format); 
}
else 
{
    echo '
 <input name="op_date" type="text" size="14" onBlur="IsValidDate(this,\''.$date_format.'\')" onKeyUp="setDate(this,\''.$date_format.'\',\''. $lang.'\')"> [';
 
 $dfbuffer="LD_".strtr($date_format,".-/","phs");
  echo $$dfbuffer.' ]';
}
?>
 
<font color="#000000">&nbsp; &nbsp;<?php echo $LDOperator ?>:
<?php if($mode=="select") echo '<font color="#800000">'.$medoc[operator]; 
	else echo '
	<input name="operator" type="text" size="14" >';
 ?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td>
<p>
<FONT SIZE=-1  FACE="Arial"><?php echo $LDPatientNr ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") echo '<font color="#000099">'.$medoc['patnum']; 
	else echo '
	<input name="patnum" type="text" size="14">';
?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDLastName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") echo '<font color="#000099"><b>'.$medoc['name'].'</b>'; 
	else echo '
	<input name="name" type="text" size="14">';
?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") echo '<font color="#000099"><b>'.$medoc['vorname'].'</b>'; 
	else echo '
	<input name="vorname" type="text" size="14" >';
?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDBday ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php 

if($mode=="select") 
{
    echo '<font color="#000099">'.formatDate2Local($medoc['gebdatum'],$date_format); 
}
else
{
   echo '<input name="gebdatum" type="text" size="14" onBlur="IsValidDate(this,\''.$date_format.'\')"  onKeyUp="setDate(this,\''.$date_format.'\',\''. $lang.'\')"> [ ';

   $dfbuffer="LD_".strtr($date_format,".-/","phs");
   echo $$dfbuffer.' ]';
}
?> 

</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") : ?>
<font color="#000099">
<?php switch($medoc[status])
	{
		case "stat": echo $LDStationary;break;
		case "amb": echo $LDAmbulant; break;
	}
	echo "<br>";
	echo ucfirst($medoc[kasse]);
?>
<?php else : ?>
<input name="status" type="radio" value="amb" <?php if (($medoc[status]=="amb")||($status=="amb"))echo "checked" ?> onClick=hidecat()><?php echo $LDAmbulant ?>  <input name="status" type="radio" value="stat"  <?php if(($medoc[status]=="stat")||($status=="stat")) echo "checked" ?> onClick=hidecat()><?php echo $LDStationary ?><br>
</font>
<FONT SIZE=-1  FACE="Arial" <?php if($err_kasse) echo 'color=#cc0000'; ?>><input name="kasse" type="radio" value="kasse" <?php if (($medoc[kasse]=="kasse")||($medoc[kasse]=="kasse")||($kasse=="kasse")) echo "checked" ?> onClick=hidecat()><?php echo $LDInsurance ?>  <input name="kasse" type="radio" value="privat"  <?php if (($medoc[kasse]=="privat")||($medoc[kasse]=="privat")||($kasse=="privat")) echo "checked" ?> onClick=hidecat()><?php echo $LDPrivate ?> <input name="kasse" type="radio" value="x"  <?php if (($medoc[kasse]=="x")||($medoc[kasse]=="x")||($kasse=="x")) echo "checked" ?> onClick=hidecat()><?php echo $LDSelfPay ?>
<?php endif ?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDDiagnosis ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") echo '<font color="#800000">'.$medoc[diagnosis]; 
	else echo '
	<input name="diagnosis" type="text" size="60" >';
?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDLocalization ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") echo '<font color="#800000">'.$medoc[localize]; 
	else echo '
	<input name="localize" type="text" size="60" >';
?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDTherapy ?>:
</td>
<td>
<FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") echo '<font color="#800000">'.$medoc[therapy]; 
	else echo '
	<input name="therapy" type="text" size="60" >';
?>
</td>
</tr >
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDSpecials ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") echo '<font color="#800000">'.$medoc[special]; 
	else echo '
	<input name="special" type="text" size="60" >';
?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDClassification ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") : ?>
<font color="#800000">
<?php
if($medoc[class_s]) echo "$medoc[class_s] $LDMinor  &nbsp; ";
   	if($medoc[class_m]) echo "$medoc[class_m] $LDMiddle &nbsp; ";
   	if($medoc[class_l]) echo "$medoc[class_l] $LDMajor";
	echo " $LDOperation";
?>
<?php else : ?>
 <input name="klas_s" type="text" size="2" value="<?php echo $medoc[class_s].$klas_s ?>" ><?php echo $LDMinor ?>&nbsp;
<input name="klas_m" type="text" size="2" value="<?php echo $medoc[class_m].$klas_m ?>" ><?php echo $LDMiddle ?>&nbsp;
<input name="klas_l" type="text" size="2" value="<?php echo $medoc[class_l].$klas_l ?>" ><?php echo "$LDMajor $LDOperation" ?>
<?php endif ?>
</td>
</tr>
</table>
<p>
 <FONT SIZE=-1  FACE="Arial">
<font color="#0"> &nbsp; <?php echo $LDScrubNurse ?>: 
<?php if($mode=="select") echo '<font color="#800000">'.$medoc[scrub_nurse].' &nbsp;'; 
	else echo '
	<input name="inst" type="text" size="14" >';
?>
<font color="#0"> &nbsp; <?php echo $LDOpRoom ?>: <font color="#0">
<?php if($mode=="select") echo '<font color="#800000">'.$medoc[op_room]; 
	else echo '
	<input name="opsaal" type="text" size="3" >';
?>
<p>
<?php if($mode=="select") : ?>
<input type="hidden" name="doc_nr" value="<?php echo $medoc[doc_nr] ?>">
<input type="hidden" name="patnum" value="<?php echo $medoc[patnum] ?>">
<input type="hidden" name="mode" value="update">
<!-- <input type="submit" value="<?php echo $LDUpdateData ?>">
 -->
 <input type="image"<?php echo createLDImgSrc('../','update_data.gif') ?>>
<p>
<input type="button" value="<?php echo $LDNewArchiveSearch ?>" onClick="window.location.href='op-doku-archiv.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=?'">

<?php else : ?>
<input  type="image" <?php echo createLDImgSrc('../','searchlamp.gif','0') ?> border=0  alt="<?php echo $LDSearch ?>">
<input type="hidden" name="mode" value="search">
<a href="javascript:document.opdocument.reset()"><img <?php echo createLDImgSrc('../','reset.gif','0') ?> alt="<?php echo $LDResetAll ?>" ></a>
<?php endif ?>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
</form>
<?php endif ?>
<p>
</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<hr>
<ul>
<FONT    SIZE=2  FACE="Arial">
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="op-doku-start.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=dummy"><?php echo $LDStartNewDocu ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="op-doku-search.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=dummy"><?php echo $LDSearchDocu ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="javascript:showcat()"><?php echo $LDShowCat ?></a><br>

<p>

<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?>  alt="<?php echo $LDClose ?>"></a>
</ul><p>
<hr>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>

</FONT>


</BODY>
</HTML>
