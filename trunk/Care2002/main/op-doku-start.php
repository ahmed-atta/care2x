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

if ((substr($matchcode,0,1)=="%")||(substr($matchcode,0,1)=="&")) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../include/inc_config_color.php"); // load color preferences

$thisfile="op-doku-start.php";
//foreach($arg as $v) print "$v<br>"; //init db parameters

if(!isset($dept)||empty($dept))
	if($HTTP_COOKIE_VARS['ck_thispc_dept']) $dept=$HTTP_COOKIE_VARS['ck_thispc_dept'];
		else $dept="plop"; // default department is plop

$modtypes=array("match","select","update","save","saveok");

$linecount=0;
// check date for completeness

if($mode=="save")
{
	$err_data=0;
	if(!$opdate) {$err_opdate=1; $err_data=1;}
	if(!$operator) {$err_operator=1;$err_data=1;}
	if(!$patnr) {$err_patnr=1;$err_data=1;}
	if(!$lname) {$err_lname=1;$err_data=1;}
	if(!$fname) {$err_fname=1;$err_data=1;}
	if(!$bdate) {$err_bdate=1;$err_data=1;}
	if(!(($stat_amb[0])||($stat_amb[1]))) {$err_sb=1;$err_data=1;}
	if(!$finanz) {$err_finanz=1;$err_data=1;}
	if(!$diagnosis) {$err_diagnosis=1;$err_data=1;}
	if(!$localize) {$err_localize=1;$err_data=1;}
	if(!$therapy) {$err_therapy=1;$err_data=1;}
	if(!$special) {$err_special=1;$err_data=1;}
	if(!(($klas_s)||($klas_m)||($klas_l))) {$err_klas=1;$err_data=1;}
	if(!$opbeginn) {$err_opbeginn=1;$err_data=1;}
	if(!$opende) {$err_opende=1;$err_data=1;}
	if(!$inst) {$err_inst=1;$err_data=1;}
	if(!$opsaal) {$err_opsaal=1;$err_data=1;}
	
	if($err_data) $mode="?";
	
}
	

if(in_array($mode,$modtypes))
{
	include("../include/inc_db_makelink.php");
	if($link&&$DBLink_OK) 
	{	
		switch($mode)
		{
			case "match":
							$dbtable="mahopatient";
							if(is_numeric($matchcode))
							{
								$matchcode=(int)$matchcode;
								$sql='SELECT patnum, name, vorname, gebdatum, status, kasse FROM '.$dbtable.' WHERE  patnum='.$matchcode;
							}
							else 
								$sql='SELECT patnum, name, vorname, gebdatum, status, kasse FROM '.$dbtable.' WHERE  name="'.addslashes($matchcode).'"';
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
								$sql='SELECT patnum, name, vorname, gebdatum FROM '.$dbtable.' 
										WHERE  name LIKE "'.trim($matchcode).'%" 
											OR vorname LIKE "'.trim($matchcode).'%"';
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
							}else print "$sql<br>$LDDbNoRead"; 
							//print $sql;
							if($rows==1) 	$result=mysql_fetch_array($ergebnis);
							break;
			case "select":
							$dbtable="mahopatient";
							$sql='SELECT patnum, name, vorname, gebdatum, status, kasse FROM '.$dbtable.' WHERE  patnum="'.$n.'" 
																			AND	name="'.$ln.'"
																			AND	vorname="'.$fn.'"
																			AND	gebdatum="'.$bd.'"';
							if($ergebnis=mysql_query($sql,$link)) 
							{			
						  		$rows=0;
								while($result=mysql_fetch_array($ergebnis)) $rows++;	
								if($rows)
								{
									mysql_data_seek($ergebnis,0);
									$result=mysql_fetch_array($ergebnis);
								}
							}else print "$sql<br>$LDDbNoRead"; 
							//print $sql;
							break;
			case "update":
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
							}else print "$sql<br>$LDDbNoRead"; 
							//print $sql;
							break;
			case "save":
					$dbtable="op_med_doc";
					if($update)
					{
						$sql="UPDATE $dbtable SET
									op_date=\"$opdate\",
									operator=\"$operator\",
									patient_no=\"$patnr\",
									lastname=\"$lname\",
									firstname=\"$fname\",
									birthdate=\"$bdate\",
									status=\"$stat_amb\",
									finanz=\"$finanz\",
									diagnosis=\"$diagnosis\",
									localize=\"$localize\",
									therapy=\"$therapy\",
									special=\"$special\",
									class_s=\"$klas_s\",
									class_m=\"$klas_m\",
									class_l=\"$klas_l\",
									op_start=\"$opbeginn\",
									op_end=\"$opende\",
									scrub_nurse=\"$inst\",
									op_room=\"$opsaal\",
									editor=\"".$HTTP_COOKIE_VARS[$local_user.$sid]."\",
									edit_dt=\"".date("Y.m.d H.i.s")."\",
									tstamp=\"$ts\"
									WHERE dept=\"$de\"
										AND doc_no=\"$dn\"
										AND op_date=\"$dt\"
										AND patient_no=\"$n\" 
										AND	lastname=\"$ln\"
										AND	firstname=\"$fn\"
										AND	birthdate=\"$bd\"
										AND tstamp=\"$ts\"";
									
						if($ergebnis=mysql_query($sql,$link))
						{
							  	mysql_close($link);
								header("location:op-doku-start.php?sid=$sid&lang=$lang&mode=saveok&dept=$de&docn=$dn&tstamp=$ts");
								exit;
						}else print "$sql<br>$LDDbNoUpdate"; 
					}
					else
					{
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
								$dn=$result[doc_no]+1;
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
									'$dn',
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
									'".$HTTP_COOKIE_VARS[$local_user.$sid]."',
									'".date("Y.m.d H.i.s")."',
									'',
									'',
									'$ts'
								)";
								//print $sql;
								if($ergebnis=mysql_query($sql,$link)) 
								{			
									// update last doc number
									$sql="UPDATE $dbtable SET doc_no='$dn' WHERE dept='lastdocnumber'";
									if($ergebnis=mysql_query($sql,$link)) 
									{			
							  			mysql_close($link);
										header("location:op-doku-start.php?sid=$sid&lang=$lang&mode=saveok&dept=$dept&docn=$dn&tstamp=$ts");
										exit;
									}else print "$sql<br>$LDDbNoUpdate"; 
								}else print "$sql<br>$LDDbNoSave"; 
							}
						}else print "$sql<br>$LDDbNoRead"; 
					} // end of if(update) else
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
						}else print "$sql<br>$LDDbNoRead"; 
					break;
			default:
					if($HTTP_COOKIE_VARS["ck_login_logged".$sid]) $mode="dummy";
					break;
		} // end of switch
	}
	else { print "$LDDbNoLink<br>"; }
}
?>


<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE><?php echo $LDOrDocument ?></TITLE>


<script  language="javascript">
<!-- 
var iscat=true;
var cat=new Image();
var pix=new Image();

function hidecat()
{
	if(!iscat) return;
	if(document.images) document.catcom.src=pix.src;
	iscat=false;
	document.match.matchcode.select();
}

function loadcat()
{
  cat.src="../imgcreator/catcom.php?lang=<?php echo $lang ?>&person=<?php echo strtr($HTTP_COOKIE_VARS[$local_user.$sid]," ","+");?>";
  pix.src="../img/pixel.gif";
}

function showcat()
{

	if(document.images) document.catcom.src=cat.src;
	iscat=true;
	document.match.matchcode.select();
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
	if((m.substr(0,1)=="%")||(m.substr(0,1)=="&"))
	{
		d.matchcode.value="";
		d.matchcode.focus();
		return false;
	}
	window.location.replace("op-doku-start.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=match&matchcode="+m);
	return false;
}

function setDay(d)
{
	var h="<?php print date("d.m.Y"); ?>";
	switch(d.value)
	{
		case "h": d.value=h; break;
		case "H": d.value=h; break;
		case "g": d.value=g; break;
		case "G": d.value=g; break;
		default: d.value="";
	}
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
//-->
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

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor=#dde1ec onLoad="if(window.focus) window.focus();document.match.matchcode.focus();loadcat();">


<table width=100% border=0 cellspacing="0">
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo "$LDOrDocument - ($dept)" ?></STRONG></FONT>
</td>
<td bgcolor="navy" align="right">
<a href="javascript:gethelp('opdoc.php','create','<?php echo $mode ?>')"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="javascript:window.opener.focus();window.close();"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  alt="<?php echo $LDClose ?>" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a>
</td>
</tr>
<tr>
<td colspan=2 bgcolor=#dde1ec><p>

<div class="cats"><a href="javascript:hidecat()">
<?php if($mode!="")
{ if($err_data) print '<img src="../img/'.$lang.'/'.$lang.'_inc-data.gif" align=right name="catcom" border=0 alt="'.$LDHideCat.'">';
	else print'<img src="../img/pixel.gif" align=right name="catcom" border=0 alt="'.$LDHideCat.'">';
 }else print '<img src="../imgcreator/catcom.php?lang='.$lang.'&person='.strtr($HTTP_COOKIE_VARS[$local_user.$sid]," ","+").'" align=right name="catcom" border=0 alt="'.$LDHideCat.'">';
?></a>

</div>

<ul>
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
    <td><FONT  SIZE=-1  FACE="Arial" color=#ffffff><b>&nbsp;</b></td>
    <td><FONT  SIZE=-1  FACE="Arial" color=#ffffff><b>&nbsp; <?php echo $LDLastName ?></b></td>
    <td><FONT  SIZE=-1  FACE="Arial" color=#ffffff><b>&nbsp; &nbsp;<?php echo $LDName ?></b></td>
    <td><FONT  SIZE=-1  FACE="Arial" color=#ffffff><b>&nbsp; &nbsp;<?php echo $LDBday ?></b></td>
    <td><FONT  SIZE=-1  FACE="Arial" color=#ffffff><b>&nbsp; &nbsp;<?php echo $LDPatientNr ?>&nbsp; &nbsp;</b></td>
  </tr>
 <?php 
 $toggle=0;
 while($result=mysql_fetch_array($ergebnis))
 {
 	print'
  <tr ';
  if($toggle){ print "bgcolor=#efefef"; $toggle=0;} else {print "bgcolor=#ffffff"; $toggle=1;}
  print '>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="op-doku-start.php?sid='.$sid.'&lang='.$lang.'&mode=select&n='.$result[patnum].'&ln='.$result[name].'&fn='.$result[vorname].'&bd='.$result[gebdatum ].'"><img src="../img/R_arrowGrnSm.gif" width=12 height=12 border=0></a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; <a href="op-doku-start.php?sid='.$sid.'&lang='.$lang.'&mode=select&n='.$result[patnum].'&ln='.$result[name].'&fn='.$result[vorname].'&bd='.$result[gebdatum ].'">'.$result[name].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result[vorname].'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result[gebdatum].'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result[patnum].'&nbsp; &nbsp;</td>
  </tr>
  <tr bgcolor=#0000ff>
  <td colspan=5 height=1><img src="../img/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
  </tr>';
  }
 ?>
</table>
<p>
<form method="post"  name="match" onSubmit="return lookmatch(this)">
<FONT  SIZE=-1  FACE="Arial"><?php echo $LDMatchCode ?>: <input name="matchcode" type="text" size="14" onClick=hidecat()>&nbsp;<input type="image" src="../img/<?php echo "$lang/$lang" ?>_searchlamp.gif" border=0 width=108 height=24 align="absmiddle" alt="<?php echo $LDSearch ?>">
</form>
<?php else :?>

<FONT  SIZE=-1  FACE="Arial">
<form method="post"  name="match" onSubmit="return lookmatch(this)">
<table border="0">
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDMatchCode ?>:<p>
</td>
<td> <input name="matchcode" type="text" size="14" onClick=hidecat()>&nbsp;<input type="image" src="../img/<?php echo "$lang/$lang" ?>_searchlamp.gif" border=0 width=108 height=24 align="absmiddle" alt="<?php echo $LDSearch ?>"><p>
                                                                           
</td>
</tr>
</form>

<form method="post" action="op-doku-start.php" name="opdoc">
<tr <?php if($mode=="saveok") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial" <?php if($err_opdate) print 'color=#cc0000'; ?>><?php echo $LDOpDate ?>:<br>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="saveok") print '<font color="#800000">'.$result[op_date].'</font>'; 
	else
	{ print '
 		<input name="opdate" type="text" size="14" value="';
	if($mode=="update") print $result[op_date]; elseif ($mode=="?") print $opdate; else print date("d.m.Y");
	print '" onClick=hidecat() onKeyUp=setDay(this)>';
 }
?>
<font size=2 face="arial"<?php if($err_operator) print 'color=#cc0000'; ?>>&nbsp; &nbsp;<?php echo $LDOperator ?>:
<?php if($mode=="saveok") print '<font color="#800000">'.$result[operator]; 
	else
	{
	 print '
	<input name="operator" type="text" size="25" ';
	if($mode=="update")
    {
	  print 'value="'.$result['operator'].'"'; 
	 }
	 else
	    {
			if(!isset($operator)||empty($operator)) $operator=$HTTP_COOKIE_VARS[$local_user.$sid];
		     print 'value="'.$operator.'"';
	    }
	print ' onClick=hidecat()>';
	}
 ?>
</td>
</tr>
<tr <?php if($mode=="saveok") print "bgcolor=#ffffff"; ?>>
<td>
<p>
<FONT SIZE=-1  FACE="Arial" <?php if($err_patnr) print 'color=#cc0000'; ?>><?php echo $LDPatientNr ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="saveok") print '<font color="#800000">'.$result[patient_no]; 
	else
	{
	 print '
	<input name="patnr" type="text" size="14" value="';
	if($mode=="update") print $result[patient_no]; else print $result[patnum].$patnr;
	print '" onClick=hidecat()>';
	}
?>
</td>
</tr>
<tr <?php if($mode=="saveok") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial" <?php if($err_lname) print 'color=#cc0000'; ?>><?php echo $LDLastName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="saveok") print '<font color="#800000"><b>'.$result[lastname].'</b>'; 
	else
	{ print '
	<input name="lname" type="text" size="14" value="';
	if($mode=="update") print $result[lastname]; else print $result[name].$lname;
	print '" onClick=hidecat()>';
	}
?>
</td>
</tr>
<tr <?php if($mode=="saveok") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial" <?php if($err_fname) print 'color=#cc0000'; ?>><?php echo $LDName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="saveok") print '<font color="#800000"><b>'.$result[firstname].'</b>'; 
	else
	{ print '
	<input name="fname" type="text" size="14" value="';
	if($mode=="update") print $result[firstname]; else print $result[vorname].$fname;
	print '" onClick=hidecat()>';
	}
?>
</td>
</tr>
<tr <?php if($mode=="saveok") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial" <?php if($err_bdate) print 'color=#cc0000'; ?>><?php echo $LDBday ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="saveok") print '<font color="#800000">'.$result[birthdate]; 
	else
	{
	 print '
	<input name="bdate" type="text" size="14" value="';
	if($mode=="update") print $result[birthdate]; else print $result[gebdatum].$bdate;
	print '" onClick=hidecat()>';
	}
?>
</td>
</tr>
<tr <?php if($mode=="saveok") print "bgcolor=#ffffff"; ?>>
<td>
</td>
<td><FONT SIZE=-1  FACE="Arial" <?php if($err_sb) print 'color=#cc0000'; ?>>
<?php if($mode=="saveok") : ?>
<font color=#800000>
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
<tr <?php if($mode=="saveok") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"  <?php if($err_diagnosis) print 'color=#cc0000'; ?>><?php echo $LDDiagnosis ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="saveok") print '<font color="#800000">'.$result[diagnosis]; 
	else print '
	<input name="diagnosis" type="text" size="60" value="'.$result[diagnosis].$diagnosis.'" onClick=hidecat()>';
?>
</td>
</tr>
<tr <?php if($mode=="saveok") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial" <?php if($err_localize) print 'color=#cc0000'; ?>><?php echo $LDLocalization ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="saveok") print '<font color="#800000">'.$result[localize]; 
	else print '
	<input name="localize" type="text" size="60" value="'.$result[localize].$localize.'" onClick=hidecat()>';
?>
</td>
</tr>
<tr <?php if($mode=="saveok") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial" <?php if($err_therapy) print 'color=#cc0000'; ?>><?php echo $LDTherapy ?>:
</td>
<td>
<FONT SIZE=-1  FACE="Arial">
<?php if($mode=="saveok") print '<font color="#800000">'.$result[therapy]; 
	else print '
	<input name="therapy" type="text" size="60" value="'.$result[therapy].$therapy.'" onClick=hidecat()>';
?>
</td>
</tr >
<tr <?php if($mode=="saveok") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial" <?php if($err_special) print 'color=#cc0000'; ?>><?php echo $LDSpecials ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="saveok") print '<font color="#800000">'.$result[special]; 
	else print '
	<input name="special" type="text" size="60" value="'.$result[special].$special.'" onClick=hidecat()>';
?>
</td>
</tr>
<tr <?php if($mode=="saveok") print "bgcolor=#ffffff"; ?>>
<td><FONT SIZE=-1  FACE="Arial"  <?php if($err_klas) print 'color=#cc0000'; ?>><?php echo $LDClassification ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php if($mode=="saveok") : ?>
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
 <FONT SIZE=-1  FACE="Arial" <?php if($err_opbeginn) print 'color="#cc0000"'; ?>>
<?php echo $LDOpStart ?>:
<?php if($mode=="saveok") print '<font color="#800000">'.$result[op_start].' &nbsp;</font>'; 
	else print '
	<input name="opbeginn" type="text" size="7" value="'.$result[op_start].$opbeginn.'" onClick=hidecat()>';
?>
  <?php if($err_opende) print '<font color="#cc0000">';else print '<font color="#0">'; ?> &nbsp; <?php echo $LDOpEnd ?>:
<?php if($mode=="saveok") print '<font color="#800000">'.$result[op_end].' &nbsp;</font>'; 
	else print '
	<input name="opende" type="text" size="7" value="'.$result[op_end].$opende.'" onClick=hidecat()>';
?>
  <?php if($err_inst) print '<font color="#cc0000">';else print '<font color="#0">'; ?> &nbsp; <?php echo $LDScrubNurse ?>: 
<?php if($mode=="saveok") print '<font color="#800000">'.$result[scrub_nurse].' &nbsp;</font>'; 
	else print '
	<input name="inst" type="text" size="14" value="'.$result[scrub_nurse].$inst.'" onClick=hidecat()>';
?>
<?php if($err_opsaal) print '<font color="#cc0000">';else print '<font color="#0">'; ?>  &nbsp; <?php echo $LDOpRoom ?>: 
<?php if($mode=="saveok") print '<font color="#800000">'.$result[op_room]; 
	else print '
	<input name="opsaal" type="text" size="3" value="'.$result[op_room].$opsaal.'" onClick=hidecat()><p>';
?>


<?php if($mode=="saveok") : ?>
<p><input type="button" value="<?php echo $LDUpdateData ?>" onClick="window.location.replace('op-doku-start.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=update<?php echo "&de=".$result[dept]."&dn=".$result[doc_no]."&dt=".$result[op_date]."&n=".$result[patient_no]."&ln=".$result[lastname]."&fn=".$result[firstname]."&bd=".$result[birthdate]."&ts=".$result[tstamp] ?>')"> &nbsp;
<input type="button" value="<?php echo $LDStartNewDocu ?>" onclick="window.location.replace('op-doku-start.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=dummy')">
<?php else : ?>
<input  type="image" src="../img/<?php echo "$lang/$lang" ?>_savedisc.gif" border="0" onClick="hidecat()" alt="<?php echo $LDSave ?>">
<a href="javascript:document.opdoc.reset()"><img src="../img/<?php echo "$lang/$lang" ?>_reset.gif" border="0" alt="<?php echo $LDResetAll ?>" onClick=hidecat()></a>
<?php endif ?>
<input type="hidden" name="mode" value="save">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="update" value="<?php echo $update ?>">
<?php if($mode=="update")
 	print '
	<input type="hidden" name="de" value="'.$result[dept].'">
 	<input type="hidden" name="dt" value="'.$result[op_date].'">
	<input type="hidden" name="n" value="'.$result[patient_no].'">
  	<input type="hidden" name="ln" value="'.$result[lastname].'">
   <input type="hidden" name="fn" value="'.$result[firstname].'">
   <input type="hidden" name="bd" value="'.$result[birthdate].'">
   <input type="hidden" name="dn" value="'.$result[doc_no].'">
   <input type="hidden" name="ts" value="'.$result[tstamp].'">
  	';
?>
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
<img src="../img/varrow.gif" width="20" height="15"> <a href="op-doku-search.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=dummy"><?php echo $LDSearchDocu ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="op-doku-archiv.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=dummy"><?php echo $LDResearchArchive ?></a><br>
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
