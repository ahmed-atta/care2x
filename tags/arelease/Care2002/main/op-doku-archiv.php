<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_opdoku_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_or.php");
require("../req/config-color.php"); // load color preferences

$thisfile="op-doku-archiv.php";
//foreach($arg as $v) print "$v<br>"; //init db parameters

if(!$dept)
	if($ck_thispc_dept) $dept=$ck_thispc_dept;
		else $dept="plop"; // default department is plop

$linecount=0;

function clean_it(&$d)
{
	$d=strtr($d,"°!§$%&/()=?`´*+'#{}[]\^","~~~~~~~~~~~~~~~~~~~~~~~");
	$d=str_replace("\"","~",$d);
	$d=str_replace("~","",$d);
	return trim($d);
}

require("../req/db-makelink.php");
if($link&&$DBLink_OK) 
	{	
		switch($mode)
		{
			case "search":
							$dbtable="op_med_doc";
							$sql="SELECT * FROM $dbtable WHERE ";
							$s2="";
							if (clean_it(&$lname)) $s2.=" lastname=\"$lname\"";
							if (clean_it(&$fname))
								if($s2) $s2.=" AND firstname=\"$fname\""; else $s2.=" firstname=\"$fname\"";
							if(clean_it(&$bdate))
								if($s2) $s2.=" AND birthdate=\"$bdate\""; else $s2.=" birthdate=\"$bdate\"";
							if(clean_it(&$opdate))
								if($s2) $s2.=" AND op_date=\"$opdate\""; else $s2.=" op_date=\"$opdate\"";
							if (clean_it(&$patnr))
							{
								if(is_numeric($patnr)) $patnr=(int)$patnr; else $patnr='"'.$patnr.'"';
								if($s2) $s2.=" AND patient_no=$patnr"; else $s2.=" patient_no=$patnr";
							}
							if(clean_it(&$operator))
								if($s2) $s2.=" AND operator=\"$operator\""; else $s2.=" operator=\"$operator\"";
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
								if($s2) $s2.=" AND scrub_nurse=\"$inst\""; else $s2.=" scrub_nurse=\"$inst\"";
							if(clean_it(&$opsaal))
								if($s2) $s2.=" AND op_room=\"$opsaal\""; else $s2.=" op_room=\"$opsaal\"";

							$s2=trim($s2);
							if($s2=="")
								{
									header("location:$thisfile?sid=$ck_sid&mode=?");
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
							}else print "$db_sqlquery_fail<p> $sql <p>";
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
							}else print "$db_sqlquery_fail<p> $sql <p>";
							//print $sql;
							break;
			default:
					if($ck_login_logged) $mode="dummy";
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
  cat.src="../imgcreator/catcom.php?<?print "lang=$lang&person=$ck_opdoku_user";?>";
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
	window.location.replace("op-doku-start.php?sid=<?="$ck_sid&lang=$lang" ?>&mode=match&matchcode="+m);
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
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
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
<? 
require("../req/css-a-hilitebu.php");
?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor=#dde1ec onLoad="if(window.focus) window.focus();loadcat();
<? if(!$mode||!$rows) print "document.opdoc.patnr.select();"; ?>">


<table width=100% border=0 cellspacing="0">
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?="$LDOrDocument - $LDArchive ($dept)" ?></STRONG></FONT>
</td>
<td bgcolor="navy" align="right">
<a href="javascript:gethelp('opdoc.php','arch','<?=$mode ?>','<?=$rows ?>')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a>
<a href="javascript:window.opener.focus();window.close();"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  alt="<?=$LDClose ?>" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a>
</td>
</tr>
<tr>
<td colspan=2 bgcolor=#dde1ec><p><br>

<div class="cats"><a href="javascript:hidecat()">
<?
if($mode!="") print'
<img src="../img/pixel.gif" align=right name=catcom border=0>';
else print '
<img src="../imgcreator/catcom.php?lang='.$lang.'&person='.strtr($ck_opdoku_user," ","+").'" align=right name=catcom border=0 alt="'.$LDHideCat.'">';
?>
</a>
</div>

<ul>
<? if($mode=="search")print "<FONT  SIZE=2 FACE='verdana,Arial'>$LDSrcCondition: $s2"; ?>
<? if($rows>1) : ?>
<table border=0>
  <tr>
    <td><img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle"></td>
    <td><FONT  SIZE=3 FACE="verdana,Arial" color=#800000>
<b><?="$LDPatientsFound<br>$LDPlsClk1" ?></b></font></td>
  </tr>
</table>

<table border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor=#0000aa>
 <? 
   		for($i=0;$i<sizeof($LDSrcListElements);$i++)
		print '
		   <td><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>&nbsp; &nbsp;'.$LDSrcListElements[$i].'&nbsp;</b></td>';
	?>  </tr>
 <? 
 $toggle=0;
 while($result=mysql_fetch_array($ergebnis))
 {
 	if($result[dept]=="lastdocnumber") continue;
 	print'
  <tr ';
  if($toggle){ print "bgcolor=#efefef"; $toggle=0;} else {print "bgcolor=#ffffff"; $toggle=1;}
  $buf='op-doku-archiv.php?sid='.$ck_sid.'&mode=select&de='.$result[dept].'&dn='.$result[doc_no].'&dt='.$result[op_date].'&n='.$result[patient_no].'&ln='.strtr($result[lastname]," ","+").'&fn='.strtr($result[firstname]," ","+").'&bd='.$result[birthdate].'&ts='.$result[tstamp];
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
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="mode" value="dummy">
<input type="submit" value="<?=$LDNewArchiveSearch ?>" >
                             </form>
<? else :?>



<FONT  SIZE=-1  FACE="Arial">
<table border="0"  bgcolor="#ffffff">

<form method="post" name="opdoc" <? if($mode=="select") print 'action="op-doku-start.php"'; else print 'action="op-doku-archiv.php"  onSubmit="return chkForm(this)"'; ?>>
<tr <?if($mode=="select") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDOpDate ?>:<br>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<? if($mode=="select") print '<font color="#800000">'.$result[op_date]; 
	else print '
 <input name="opdate" type="text" size="14"  onClick="hidecat()">';
?>
<font color="#000000">&nbsp; &nbsp;<?=$LDOperator ?>:
<? if($mode=="select") print '<font color="#800000">'.$result[operator]; 
	else print '
	<input name="operator" type="text" size="14" onClick="hidecat()">';
 ?>
</td>
</tr>
<tr <?if($mode=="select") print "bgcolor=#ffffff"; ?>>
<td>
<p>
<FONT SIZE=-1  FACE="Arial"><?=$LDPatientNr ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<? if($mode=="select") print '<font color="#800000">'.$result[patient_no]; 
	else print '
	<input name="patnr" type="text" size="14"  onClick="hidecat()">';
?>
</td>
</tr>
<tr <?if($mode=="select") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDLastName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<? if($mode=="select") print '<font color="#800000"><b>'.$result[lastname].'</b>'; 
	else print '
	<input name="lname" type="text" size="14"  onClick="hidecat()">';
?>
</td>
</tr>
<tr <?if($mode=="select") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<? if($mode=="select") print '<font color="#800000"><b>'.$result[firstname].'</b>'; 
	else print '
	<input name="fname" type="text" size="14" onClick="hidecat()">';
?>
</td>
</tr>
<tr <?if($mode=="select") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDBday ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<? if($mode=="select") print '<font color="#800000">'.$result[birthdate]; 
	else print '
	<input name="bdate" type="text" size="14" onClick="hidecat()">';
?>
</td>
</tr>
<tr <?if($mode=="select") print "bgcolor=#ffffff"; ?>>
<td>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<? if($mode=="select") : ?>
<font color="#800000">
<? switch($result[status])
	{
		case "stat": print $LDStationary;break;
		case "amb": print $LDAmbulant; break;
	}
	print "<br>";
	print ucfirst($result[finanz]);
?>
<? else : ?>
<input name="stat_amb" type="radio" value="amb" <? if (($result[status]=="amb")||($stat_amb=="amb"))print "checked" ?> onClick=hidecat()><?=$LDAmbulant ?>  <input name="stat_amb" type="radio" value="stat"  <? if(($result[status]=="stat")||($stat_amb=="stat")) print "checked" ?> onClick=hidecat()><?=$LDStationary ?><br>
</font>
<FONT SIZE=-1  FACE="Arial" <? if($err_finanz) print 'color=#cc0000'; ?>><input name="finanz" type="radio" value="kasse" <? if (($result[kasse]=="kasse")||($result[finanz]=="kasse")||($finanz=="kasse")) print "checked" ?> onClick=hidecat()><?=$LDInsurance ?>  <input name="finanz" type="radio" value="privat"  <? if (($result[kasse]=="privat")||($result[finanz]=="privat")||($finanz=="privat")) print "checked" ?> onClick=hidecat()><?=$LDPrivate ?> <input name="finanz" type="radio" value="x"  <? if (($result[kasse]=="x")||($result[finanz]=="x")||($finanz=="x")) print "checked" ?> onClick=hidecat()><?=$LDSelfPay ?>
<? endif ?>
</td>
</tr>
<tr <?if($mode=="select") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDDiagnosis ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<? if($mode=="select") print '<font color="#800000">'.$result[diagnosis]; 
	else print '
	<input name="diagnosis" type="text" size="60" onClick="hidecat()">';
?>
</td>
</tr>
<tr <?if($mode=="select") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDLocalization ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<? if($mode=="select") print '<font color="#800000">'.$result[localize]; 
	else print '
	<input name="localize" type="text" size="60" onClick="hidecat()">';
?>
</td>
</tr>
<tr <?if($mode=="select") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDTherapy ?>:
</td>
<td>
<FONT SIZE=-1  FACE="Arial">
<? if($mode=="select") print '<font color="#800000">'.$result[therapy]; 
	else print '
	<input name="therapy" type="text" size="60" onClick="hidecat()">';
?>
</td>
</tr >
<tr <?if($mode=="select") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDSpecials ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<? if($mode=="select") print '<font color="#800000">'.$result[special]; 
	else print '
	<input name="special" type="text" size="60" onClick="hidecat()">';
?>
</td>
</tr>
<tr <?if($mode=="select") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDClassification ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<? if($mode=="select") : ?>
<font color="#800000">
<?
   	if($result[class_s]) print "$result[class_s] $LDMinor  &nbsp; ";
   	if($result[class_m]) print "$result[class_m] $LDMiddle &nbsp; ";
   	if($result[class_l]) print "$result[class_l] $LDMajor";
	print " $LDOperation";
?>
<? else : ?>
 <input name="klas_s" type="text" size="2" value="<?=$result[class_s].$klas_s ?>" onClick="hidecat()"><?=$LDMinor ?>&nbsp;
<input name="klas_m" type="text" size="2" value="<?=$result[class_m].$klas_m ?>" onClick="hidecat()"><?=$LDMiddle ?>&nbsp;
<input name="klas_l" type="text" size="2" value="<?=$result[class_l].$klas_l ?>" onClick="hidecat()"><?="$LDMajor $LDOperation" ?>
<? endif ?>
</td>
</tr>
</table>
<p>
 <FONT SIZE=-1  FACE="Arial">
<font color="#0"> &nbsp; <?=$LDScrubNurse ?>: 
<? if($mode=="select") print '<font color="#800000">'.$result[scrub_nurse].' &nbsp;'; 
	else print '
	<input name="inst" type="text" size="14" onClick="hidecat()">';
?>
<font color="#0"> &nbsp; <?=$LDOpRoom ?>: <font color="#0">
<? if($mode=="select") print '<font color="#800000">'.$result[op_room]; 
	else print '
	<input name="opsaal" type="text" size="3" onClick="hidecat()">';
?>
<p>
<? if($mode=="select") : ?>
<input type="hidden" name="de" value="<?=$result[dept] ?>">
<input type="hidden" name="dn" value="<?=$result[doc_no] ?>">
<input type="hidden" name="dt" value="<?=$result[op_date] ?>">
<input type="hidden" name="n" value="<?=$result[patient_no] ?>">
<input type="hidden" name="ln" value="<?=$result[lastname] ?>">
<input type="hidden" name="fn" value="<?=$result[firstname] ?>">
<input type="hidden" name="bd" value="<?=$result[birthdate] ?>">
<input type="hidden" name="ts" value="<?=$result[tstamp] ?>">
<input type="hidden" name="mode" value="update">
<input type="submit" value="<?=$LDUpdateData ?>">
<p>
<input type="button" value="<?=$LDNewArchiveSearch ?>" onClick="window.location.href='op-doku-archiv.php?sid=<?="$ck_sid&lang=$lang" ?>&mode=?'">

<? else : ?>
<input  type="image" src="../img/<?="$lang/$lang" ?>_searchlamp.gif" border=0 onClick="hidecat()" alt="<?=$LDSearch ?>">
<input type="hidden" name="mode" value="search">
<a href="javascript:document.opdocument.reset()"><img src="../img/<?="$lang/$lang" ?>_reset.gif" border="0" alt="<?=$LDResetAll ?>" onClick="hidecat()"></a>
<? endif ?>
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
</form>
<? endif ?>
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
<img src="../img/varrow.gif" width="20" height="15"> <a href="op-doku-start.php?sid=<?="$ck_sid&lang=$lang" ?>&mode=dummy"><?=$LDStartNewDocu ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="op-doku-search.php?sid=<?="$ck_sid&lang=$lang" ?>&mode=dummy"><?=$LDSearchDocu ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="javascript:showcat()"><?=$LDShowCat ?></a><br>

<p>

<a href="javascript:window.opener.focus();window.close();"><img border=0 src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  alt="<?=$LDClose ?>"></a>
</ul><p>
<hr>
<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>

</FONT>


</BODY>
</HTML>
