<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_opdoku_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
if ((substr($matchcode,0,1)=="%")||(substr($matchcode,0,1)=="&")) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../language/".$lang."/lang_".$lang."_or.php");

require("../req/config-color.php"); // load color preferences

$thisfile="op-doku-search.php";
//foreach($arg as $v) print "$v<br>"; //init db parameters

if(!$dept)
	if($ck_thispc_dept) $dept=$ck_thispc_dept;
		else $dept="plop"; // default department is plop

$linecount=0;

 include("../req/db-makelink.php");
 if($link&&$DBLink_OK)  
	{	
		switch($mode)
		{
			case "match":
							$dbtable="op_med_doc";
							if(is_numeric($matchcode)&&$matchcode)
							{
								$matchcode=(int)$matchcode;
								$sql='SELECT * FROM '.$dbtable.' WHERE  patient_no='.$matchcode;
							}
							else 
								$sql='SELECT * FROM '.$dbtable.' WHERE  lastname="'.$matchcode.'"';
							if($ergebnis=mysql_query($sql,$link)) 
							{			
						  		$rows=0;
								while($result=mysql_fetch_array($ergebnis)) $rows++;	
								if($rows)
								{
									mysql_data_seek($ergebnis,0);
								}
								else
								{ // if not found find similar
								$sql='SELECT * FROM '.$dbtable.' 
										WHERE ( lastname LIKE "'.trim($matchcode).'%" 
											OR firstname LIKE "'.trim($matchcode).'%" )
												AND patient_no<>""
												ORDER BY doc_no';
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
							if($rows==1) 	$result=mysql_fetch_array($ergebnis);
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
			case "save":
					$dbtable="op_med_doc";
					// get the last doc number
					$sql="SELECT doc_no FROM $dbtable WHERE  dept='lastdocnumber'";
					if($ergebnis=mysql_query($sql,$link)) 
					{			
					  	$rows=0;
						while($result=mysql_fetch_array($ergebnis)) $rows++;	
						if($rows)
						{
							mysql_data_seek($ergebnis,0);
							$result=mysql_fetch_array($ergebnis);
							$ln=$result[doc_no]+1;
							$ts=date(YmdHis);
							$sql="INSERT INTO $dbtable
							(	dept,
								doc_no,
								op_date,
								op_time,
								operator,
								patient_no,
								lastname,
								firstname,
								birthdate,
								status,
								finanz,
								diagnosis,
								localize,
								therapy,
								special,
								class_s,
								class_m,
								class_l,
								op_start,
								op_end,
								scrub_nurse,
								op_room,
								encoder,
								encode_dt,
								editor,
								edit_dt,
								tstamp
								 ) 
							VALUES (
								'$dept',
								'$ln',
								'$opdate',
								'".date("H.i")."', 
								'$operator', 
								'$patnr',
								'$lname',
								'$fname',
								'$bdate', 
								'$stat_amb', 
								'$finanz', 
								'$diagnosis', 
								'$localize', 
								'$therapy', 
								'$special', 
								'$klas_s', 
								'$klas_m', 
								'$klas_l', 
								'$opbeginn',
								'$opende',
								'$inst',
								'$opsaal',
								'$opdoku_user',
								'".date("Y.m.d H.i.s")."',
								'',
								'',
								'$ts'
							)";
							//print $sql;
							if($ergebnis=mysql_query($sql,$link)) 
							{			
								// update last doc number
								$sql="UPDATE $dbtable SET doc_no='$ln' WHERE dept='lastdocnumber'";
								if($ergebnis=mysql_query($sql,$link)) 
								{			
						  			mysql_close($link);
									header("location:op-doku-start.php?sid=$ck_sid&mode=saveok&dept=$dept&docn=$ln&tstamp=$ts");
									exit;
								}else print "$db_sqlquery_fail<p> $sql <p>";
							}else print "$db_sqlquery_fail<p> $sql <p>";
						}
					}else print "$db_sqlquery_fail<p> $sql <p>";
							//$sdate=date(YmdHis); // time stamp
					break;
			case "saveok":
					$dbtable="op_med_doc";
					$sql="SELECT * FROM $dbtable WHERE  dept='$dept' AND doc_no='$docn' AND tstamp='$tstamp'";
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
 <TITLE><?=$LDOrDocument ?></TITLE>


<script  language="javascript">
<!-- 
var iscat=true;

function hidecat()
{
	if(!iscat) return;
	if(document.images) document.catcom.src=pix.src;
	iscat=false;
	document.matchform.matchcode.focus();
}

function loadcat()
{
  cat=new Image();
  cat.src="../imgcreator/catcom.php?person=<?print $ck_opdoku_user;?>";
  pix=new Image();
  pix.src="../img/pixel.gif";
}

function showcat()
{

	if(document.images) document.catcom.src=cat.src;
	iscat=true;
}
	
function lookmatch(d)
{
	m=d.matchcode.value;
	if(m=="") return false;
	if((m.substr(0,1)=="%")||(m.substr(0,1)=="&"))
	{
		d.matchcode.value="";
		d.matchcode.focus();
		return false;
	}
	window.location.replace("op-doku-search.php?sid=<?=$ck_sid ?>&mode=match&matchcode="+m);
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

<style type="text/css" name="cat">

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

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor=#dde1ec onLoad="if(window.focus) window.focus();loadcat(); document.matchform.matchcode.focus();">


<table width=100% border=0 cellspacing="0">
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?="$LDOrDocument - $LDSearch ($dept)" ?></STRONG></FONT>
</td>
<td bgcolor="navy" align="right">
<a href="javascript:gethelp('opdoc.php','search','<?=$mode ?>','<?=$rows ?>')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a>
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
</a></div>

<ul>
<form method="post"  name="matchform" onSubmit="return lookmatch(this)">
<FONT  SIZE=-1  FACE="Arial"><?=$LDSearchKeyword ?>: <input name="matchcode" type="text" size="14" onClick=hidecat()>&nbsp;<input type="image" src="../img/<?="$lang/$lang" ?>_searchlamp.gif" border=0 width=108 height=24 align="absmiddle" alt="<?=$LDSearch ?>">
</form>
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
	?>

  </tr>
 <? 
 $toggle=0;
 while($result=mysql_fetch_array($ergebnis))
 {
 	if($result[dept]=="lastdocnumber") continue;
 	print'
  <tr ';
  if($toggle){ print "bgcolor=#efefef"; $toggle=0;} else {print "bgcolor=#ffffff"; $toggle=1;}
  $buf="op-doku-search.php?sid=$ck_sid&lang=$lang&mode=select&de=".strtr($result[dept]," ","+")."&dn=".$result[doc_no]."&dt=".$result[op_date]."&n=".$result[patient_no]."&ln=".strtr($result[lastname]," ","+")."&fn=".strtr($result[firstname]," ","+")."&bd=".$result[birthdate ]."&ts=".$result[tstamp];
  print '>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'"><img src="../img/R_arrowGrnSm.gif" width=12 height=12 border=0></a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[lastname].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result[firstname].'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result[birthdate].'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result[patient_no].'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[op_date].'</a></td>
    <td align="center"><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result[dept].'</td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[doc_no].'</a>&nbsp; &nbsp;</td>
  </tr>
  <tr bgcolor=#0000ff>
  <td colspan=8 height=1><img src="../img/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
  </tr>';
  }
 ?>
</table>
<p>

<? elseif($rows) :?>



<FONT  SIZE=-1  FACE="Arial">
<table border="0">

<form method="post" action="op-doku-start.php?rt=vrt" name="opdoc">
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDSrcListElements[7] ?>:<br>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000">'.$result[doc_no]; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDSrcListElements[6] ?>:<br>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000">'.$result[dept]; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDOpDate ?>:<br>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000">'.$result[op_date]; 
?>
<font color=#0>&nbsp; &nbsp;<?=$LDOperator ?>:
<?  print '<font color="#800000">'.$result[operator]; 
 ?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td>

<FONT SIZE=-1  FACE="Arial"><?=$LDPatientNr ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000">'.$result[patient_no]; 
?>
</td>
</tr>
<tr>
<td>

&nbsp;
</td>
<td>
&nbsp;
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDLastName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000"><b>'.$result[lastname].'</b>'; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000"><b>'.$result[firstname].'</b>'; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDBday ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000">'.$result[birthdate]; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<font color=#800000>
<? switch($result[status])
	{
		case "stat": print $LDStationary;break;
		case "amb": print $LDAmbulant; break;
	}
	print "<br>";
	print ucfirst($result[finanz]);
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDDiagnosis ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000">'.$result[diagnosis]; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDLocalization ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000">'.$result[localize]; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDTherapy ?>:
</td>
<td>
<FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000">'.$result[therapy]; 
?>
</td>
</tr >
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDSpecials ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000">'.$result[special]; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDClassification ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<font color="#800000">
<?
   	if($result[class_s]) print "$result[class_s] $LDMinor  &nbsp; ";
   	if($result[class_m]) print "$result[class_m] $LDMiddle &nbsp; ";
   	if($result[class_l]) print "$result[class_l] $LDMajor";
	print " $LDOperation";
?>
</td>
</tr>
</table>
<p>
 <FONT SIZE=-1  FACE="Arial">
<?=$LDOpStart ?>:<font color="#0">
<?  print '<font color="#800000">'.$result[op_start].' &nbsp;'; 
	
?>
<font color="#0"><?=$LDOpEnd ?>:
<?print '<font color="#800000">'.$result[op_end].' &nbsp;'; 
	
?>
<font color="#0"><?=$LDScrubNurse ?>: 
<?  print '<font color="#800000">'.$result[scrub_nurse].' &nbsp;'; 
	
?>
<font color="#0"><?=$LDOpRoom ?>: <font color="#0">
<?  print '<font color="#800000">'.$result[op_room]; 
?>
<?
  $buf="op-doku-start.php?sid=$ck_sid&lang=$lang&mode=update&update=1&de=".strtr($result[dept]," ","+")."&dn=".$result[doc_no]."&dt=".$result[op_date]."&n=".$result[patient_no]."&ln=".strtr($result[lastname]," ","+")."&fn=".strtr($result[firstname]," ","+")."&bd=".$result[birthdate ]."&ts=".$result[tstamp];
?>
<p><input type="button" value="<?=$LDUpdateData ?>" onClick="window.location.href='<?=$buf ?>'"> &nbsp;
<input type="hidden" name="mode" value="save">
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="update" value="<?=$update ?>">
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
<img src="../img/varrow.gif" width="20" height="15"> <a href="op-doku-archiv.php?sid=<?="$ck_sid&lang=$lang" ?>&mode=dummy"><?=$LDResearchArchive ?></a><br>
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
