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
define("LANG_FILE","or.php");
$local_user="ck_opdoku_user";
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php"); // load color preferences

$thisfile="op-doku-archiv.php";
//foreach($arg as $v) print "$v<br>"; //init db parameters

if(!$dept)
	if($HTTP_COOKIE_VARS[ck_thispc_dept]) $dept=$HTTP_COOKIE_VARS[ck_thispc_dept];
		else $dept="plop"; // default department is plop

$linecount=0;

function clean_it(&$d)
{
	$d=strtr($d,"°!§$%&/()=?`´*+'#{}[]\^","~~~~~~~~~~~~~~~~~~~~~~~");
	$d=str_replace("\"","~",$d);
	$d=str_replace("~","",$d);
	return trim($d);
}

require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK) 
	{	
		switch($mode)
		{
			case "search":
							$dbtable="op_med_doc";
							$sql="SELECT * FROM $dbtable WHERE ";
							$s2="";
							if (clean_it(&$lname)) $s2.=" lastname=\"".addslashes($lname)."\"";
							if (clean_it(&$fname))
								if($s2) $s2.=" AND firstname=\"".addslashes($fname)."\""; else $s2.=" firstname=\"".addslashes($fname)."\"";
							if(clean_it(&$bdate))
								if($s2) $s2.=" AND birthdate=\"".addslashes($bdate)."\""; else $s2.=" birthdate=\"".addslashes($bdate)."\"";
							if(clean_it(&$opdate))
								if($s2) $s2.=" AND op_date=\"".addslashes($opdate)."\""; else $s2.=" op_date=\"".addslashes($opdate)."\"";
							if (clean_it(&$patnr))
							{
								if(is_numeric($patnr)) $patnr=(int)$patnr; else $patnr='"'.addslashes($patnr).'"';
								if($s2) $s2.=" AND patient_no=$patnr"; else $s2.=" patient_no=$patnr";
							}
							if(clean_it(&$operator))
								if($s2) $s2.=" AND operator=\"".addslashes($operator)."\""; else $s2.=" operator=\"".addslashes($operator)."\"";
							if ($stat_amb)
								if($s2) $s2.=" AND status=\"$stat_amb\""; else $s2.=" status=\"$stat_amb\"";
							if ($finanz)
								if($s2) $s2.=" AND finanz=\"$finanz\""; else $s2.=" finanz=\"$finanz\"";
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
						  		$rows=0;
								while($result=mysql_fetch_array($ergebnis)) $rows++;	
								if($rows)
								{
									mysql_data_seek($ergebnis,0);
								}
								else // check for similar entries
								{
									//print $sql;
									$sql=str_replace("=\""," LIKE ~",$sql);
									$sql=str_replace("\"","%\"",$sql);
									$sql=str_replace("~","\"",$sql);
									//print $sql;
									if($ergebnis=mysql_query($sql,$link)) 
									{			
						  				$rows=0;
										while($result=mysql_fetch_array($ergebnis)) $rows++;	
										if($rows)
										{
											mysql_data_seek($ergebnis,0);
										}
									}
								}
							}else print "$LDDbNoRead<p> $sql <p>";
							//print $sql;
							if($rows==1)
							 {
								$result=mysql_fetch_array($ergebnis);
								$mode="select";
							}
							break;
			case "select":
							$dbtable="op_med_doc";
							$sql='SELECT * FROM '.$dbtable.' WHERE  dept="'.$de.'" 
																			AND doc_no="'.$dn.'" 
																			AND op_date="'.$dt.'"
																			AND patient_no="'.$n.'" 
																			AND	lastname="'.$ln.'"
																			AND	firstname="'.$fn.'"
																			AND	birthdate="'.$bd.'" 
																			AND tstamp="'.$ts.'"';
							if($ergebnis=mysql_query($sql,$link)) 
							{			
						  		$rows=0;
								while($result=mysql_fetch_array($ergebnis)) $rows++;	
								if($rows)
								{
									mysql_data_seek($ergebnis,0);
									$result=mysql_fetch_array($ergebnis);
								}
							}else print "$LDDbNoRead<p> $sql <p>";
							//print $sql;
							break;
			default:
					if($HTTP_COOKIE_VARS["ck_login_logged".$sid]) $mode="dummy";
					break;
		} // end of switch
	}
	else { print "$LDDbNoLink<br>"; }

?>


<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
  pix.src="../img/pixel.gif";
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
	if((d.opdate.value!="")||(d.operator.value!="")||(d.patnr.value!="")||(d.lname.value!="")||(d.fname.value!="")||(d.bdate.value!=""))return true;
	if((d.stat_amb[0].checked)||(d.stat_amb[1].checked)||(d.finanz[0].checked)||(d.finanz[1].checked)||(d.finanz[2].checked))return true;
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
// -->
</script>

<style type="text/css" name=cat>

div.cats{
	position: relative;
	right: 10;
	top: 80;
}
</style>
<?php 
require("../include/inc_css_a_hilitebu.php");
?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor=#dde1ec onLoad="if(window.focus) window.focus();loadcat();
<?php if(!$mode||!$rows) print "document.opdoc.patnr.select();"; ?>">


<table width=100% border=0 cellspacing="0">
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo "$LDOrDocument - $LDArchive ($dept)" ?></STRONG></FONT>
</td>
<td bgcolor="navy" align="right">
<a href="javascript:gethelp('opdoc.php','arch','<?php echo $mode ?>','<?php echo $rows ?>')"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="javascript:window.opener.focus();window.close();"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  alt="<?php echo $LDClose ?>" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a>
</td>
</tr>
<tr>
<td colspan=2 bgcolor=#dde1ec><p><br>

<div class="cats"><a href="javascript:hidecat()">
<?php if($mode!="") print'
<img src="../img/pixel.gif" align=right name=catcom border=0>';
else print '
<img src="../imgcreator/catcom.php?lang='.$lang.'&person='.strtr($HTTP_COOKIE_VARS[$local_user.$sid]," ","+").'" align=right name=catcom border=0 alt="'.$LDHideCat.'">';
?>
</a>
</div>

<ul>
<?php if($mode=="search")print "<FONT  SIZE=2 FACE='verdana,Arial'>$LDSrcCondition: $s2"; ?>
<?php if($rows>1) : ?>
<table border=0>
  <tr>
    <td><img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle"></td>
    <td><FONT  SIZE=3 FACE="verdana,Arial" color=#800000>
<b><?php echo "$LDPatientsFound<br>$LDPlsClk1" ?></b></font></td>
  </tr>
</table>

<table border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor=#0000aa>
 <?php 
   		for($i=0;$i<sizeof($LDSrcListElements);$i++)
		print '
		   <td><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>&nbsp; &nbsp;'.$LDSrcListElements[$i].'&nbsp;</b></td>';
	?>  </tr>
 <?php 
 $toggle=0;
 while($result=mysql_fetch_array($ergebnis))
 {
 	if($result[dept]=="lastdocnumber") continue;
 	print'
  <tr ';
  if($toggle){ print "bgcolor=#efefef"; $toggle=0;} else {print "bgcolor=#ffffff"; $toggle=1;}
  
  $buf='op-doku-archiv.php?sid='.$sid.'&lang='.$lang.'&mode=select&de='.$result[dept].'&dn='.$result[doc_no].'&dt='.$result[op_date].'&n='.$result[patient_no].'&ln='.strtr($result[lastname]," ","+").'&fn='.strtr($result[firstname]," ","+").'&bd='.$result[birthdate].'&ts='.$result[tstamp];
  
  print '>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'"><img src="../img/R_arrowGrnSm.gif" width=12 height=12 border=0></a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[lastname].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[firstname].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result[birthdate].'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result[patient_no].'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[op_date].'</a></td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result[dept].'</td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[doc_no].'</a>&nbsp; &nbsp;</td>
  </tr>
  <tr bgcolor=#0000ff>
  <td colspan=8 height=1><img src="../img/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
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

<form method="post" name="opdoc" <?php if($mode=="select") print 'action="op-doku-start.php"'; else print 'action="op-doku-archiv.php"  onSubmit="return chkForm(this)"'; ?>>
<tr <?php if($mode=="select") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDOpDate ?>:<br>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") print '<font color="#800000">'.$result[op_date]; 
	else print '
 <input name="opdate" type="text" size="14"  onClick="hidecat()">';
?>
<font color="#000000">&nbsp; &nbsp;<?php echo $LDOperator ?>:
<?php if($mode=="select") print '<font color="#800000">'.$result[operator]; 
	else print '
	<input name="operator" type="text" size="14" onClick="hidecat()">';
 ?>
</td>
</tr>
<tr <?php if($mode=="select") print "bgcolor=#ffffff"; ?>>
<td>
<p>
<FONT SIZE=-1  FACE="Arial"><?php echo $LDPatientNr ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") print '<font color="#800000">'.$result[patient_no]; 
	else print '
	<input name="patnr" type="text" size="14"  onClick="hidecat()">';
?>
</td>
</tr>
<tr <?php if($mode=="select") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDLastName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") print '<font color="#800000"><b>'.$result[lastname].'</b>'; 
	else print '
	<input name="lname" type="text" size="14"  onClick="hidecat()">';
?>
</td>
</tr>
<tr <?php if($mode=="select") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") print '<font color="#800000"><b>'.$result[firstname].'</b>'; 
	else print '
	<input name="fname" type="text" size="14" onClick="hidecat()">';
?>
</td>
</tr>
<tr <?php if($mode=="select") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDBday ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") print '<font color="#800000">'.$result[birthdate]; 
	else print '
	<input name="bdate" type="text" size="14" onClick="hidecat()">';
?>
</td>
</tr>
<tr <?php if($mode=="select") print "bgcolor=#ffffff"; ?>>
<td>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") : ?>
<font color="#800000">
<?php switch($result[status])
	{
		case "stat": print $LDStationary;break;
		case "amb": print $LDAmbulant; break;
	}
	print "<br>";
	print ucfirst($result[finanz]);
?>
<?php else : ?>
<input name="stat_amb" type="radio" value="amb" <?php if (($result[status]=="amb")||($stat_amb=="amb"))print "checked" ?> onClick=hidecat()><?php echo $LDAmbulant ?>  <input name="stat_amb" type="radio" value="stat"  <?php if(($result[status]=="stat")||($stat_amb=="stat")) print "checked" ?> onClick=hidecat()><?php echo $LDStationary ?><br>
</font>
<FONT SIZE=-1  FACE="Arial" <?php if($err_finanz) print 'color=#cc0000'; ?>><input name="finanz" type="radio" value="kasse" <?php if (($result[kasse]=="kasse")||($result[finanz]=="kasse")||($finanz=="kasse")) print "checked" ?> onClick=hidecat()><?php echo $LDInsurance ?>  <input name="finanz" type="radio" value="privat"  <?php if (($result[kasse]=="privat")||($result[finanz]=="privat")||($finanz=="privat")) print "checked" ?> onClick=hidecat()><?php echo $LDPrivate ?> <input name="finanz" type="radio" value="x"  <?php if (($result[kasse]=="x")||($result[finanz]=="x")||($finanz=="x")) print "checked" ?> onClick=hidecat()><?php echo $LDSelfPay ?>
<?php endif ?>
</td>
</tr>
<tr <?php if($mode=="select") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDDiagnosis ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") print '<font color="#800000">'.$result[diagnosis]; 
	else print '
	<input name="diagnosis" type="text" size="60" onClick="hidecat()">';
?>
</td>
</tr>
<tr <?php if($mode=="select") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDLocalization ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") print '<font color="#800000">'.$result[localize]; 
	else print '
	<input name="localize" type="text" size="60" onClick="hidecat()">';
?>
</td>
</tr>
<tr <?php if($mode=="select") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDTherapy ?>:
</td>
<td>
<FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") print '<font color="#800000">'.$result[therapy]; 
	else print '
	<input name="therapy" type="text" size="60" onClick="hidecat()">';
?>
</td>
</tr >
<tr <?php if($mode=="select") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDSpecials ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") print '<font color="#800000">'.$result[special]; 
	else print '
	<input name="special" type="text" size="60" onClick="hidecat()">';
?>
</td>
</tr>
<tr <?php if($mode=="select") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDClassification ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="select") : ?>
<font color="#800000">
<?php
if($result[class_s]) print "$result[class_s] $LDMinor  &nbsp; ";
   	if($result[class_m]) print "$result[class_m] $LDMiddle &nbsp; ";
   	if($result[class_l]) print "$result[class_l] $LDMajor";
	print " $LDOperation";
?>
<?php else : ?>
 <input name="klas_s" type="text" size="2" value="<?php echo $result[class_s].$klas_s ?>" onClick="hidecat()"><?php echo $LDMinor ?>&nbsp;
<input name="klas_m" type="text" size="2" value="<?php echo $result[class_m].$klas_m ?>" onClick="hidecat()"><?php echo $LDMiddle ?>&nbsp;
<input name="klas_l" type="text" size="2" value="<?php echo $result[class_l].$klas_l ?>" onClick="hidecat()"><?php echo "$LDMajor $LDOperation" ?>
<?php endif ?>
</td>
</tr>
</table>
<p>
 <FONT SIZE=-1  FACE="Arial">
<font color="#0"> &nbsp; <?php echo $LDScrubNurse ?>: 
<?php if($mode=="select") print '<font color="#800000">'.$result[scrub_nurse].' &nbsp;'; 
	else print '
	<input name="inst" type="text" size="14" onClick="hidecat()">';
?>
<font color="#0"> &nbsp; <?php echo $LDOpRoom ?>: <font color="#0">
<?php if($mode=="select") print '<font color="#800000">'.$result[op_room]; 
	else print '
	<input name="opsaal" type="text" size="3" onClick="hidecat()">';
?>
<p>
<?php if($mode=="select") : ?>
<input type="hidden" name="de" value="<?php echo $result[dept] ?>">
<input type="hidden" name="dn" value="<?php echo $result[doc_no] ?>">
<input type="hidden" name="dt" value="<?php echo $result[op_date] ?>">
<input type="hidden" name="n" value="<?php echo $result[patient_no] ?>">
<input type="hidden" name="ln" value="<?php echo $result[lastname] ?>">
<input type="hidden" name="fn" value="<?php echo $result[firstname] ?>">
<input type="hidden" name="bd" value="<?php echo $result[birthdate] ?>">
<input type="hidden" name="ts" value="<?php echo $result[tstamp] ?>">
<input type="hidden" name="mode" value="update">
<input type="submit" value="<?php echo $LDUpdateData ?>">
<p>
<input type="button" value="<?php echo $LDNewArchiveSearch ?>" onClick="window.location.href='op-doku-archiv.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=?'">

<?php else : ?>
<input  type="image" src="../img/<?php echo "$lang/$lang" ?>_searchlamp.gif" border=0 onClick="hidecat()" alt="<?php echo $LDSearch ?>">
<input type="hidden" name="mode" value="search">
<a href="javascript:document.opdocument.reset()"><img src="../img/<?php echo "$lang/$lang" ?>_reset.gif" border="0" alt="<?php echo $LDResetAll ?>" onClick="hidecat()"></a>
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
<img src="../img/varrow.gif" width="20" height="15"> <a href="op-doku-start.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=dummy"><?php echo $LDStartNewDocu ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="op-doku-search.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=dummy"><?php echo $LDSearchDocu ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="javascript:showcat()"><?php echo $LDShowCat ?></a><br>

<p>

<a href="javascript:window.opener.focus();window.close();"><img border=0 src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  alt="<?php echo $LDClose ?>"></a>
</ul><p>
<hr>
<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>

</FONT>


</BODY>
</HTML>
