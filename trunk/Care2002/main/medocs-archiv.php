<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/*
CARE 2002 Integrated Information System beta 1.0.02 - 30.07.2002 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
define("LANG_FILE","aufnahme.php");
$local_user="medocs_user";
require("../include/inc_front_chain_lang.php");

require("../include/inc_config_color.php"); // load color preferences

$thisfile="medocs-archiv.php";

$breakfile="medopass.php?sid=$sid&lang=$lang";

$dbtable="medocs";

//if($dept=="") $dept="plop";

$linecount=0;

include("../include/inc_db_makelink.php");
if($link&&$DBLink_OK) 
	{	
		switch($mode)
		{
			case "search":
							//$dbtable="medocs";
							$sql="SELECT * FROM $dbtable WHERE ";
							$s2="";
							if($lastname) $s2.=" lastname LIKE \"$lastname%\"";
							if($dept)
								if($s2) $s2.=" AND dept=\"".addslashes($dept)."\""; else $s2.=" dept=\"".addslashes($dept)."\"";
							if($patient_no)
							{
								if(is_numeric($patient_no)) $patient_no=(int)$patient_no;
								if($s2) $s2.=" AND patient_no=\"".addslashes($patient_no)."\""; else $s2.=" patient_no=\"".addslashes($patient_no)."\"";
							}
							if($firstname)
								if($s2) $s2.=" AND firstname LIKE \"$firstname%\""; else $s2.=" firstname LIKE \"$firstname%\"";
							if($birthdate)
								if($s2) $s2.=" AND birthdate=\"".addslashes($birthdate)."\""; else $s2.=" birthdate=\"".addslashes($birthdate)."\"";
							if($address)
								if($s2) $s2.=" AND address LIKE \"%$address%\""; else $s2.=" address LIKE \"%$address%\"";
							if($insurance)
								if($s2) $s2.=" AND insurance LIKE \"%$insurance%\""; else $s2.=" insurance LIKE \"%$insurance%\"";
							if($insurance_xtra)
							{	
								$insurance_xtra=trim($insurance_xtra);
								if(strlen($insurance_xtra)>4) $insurance_xtra="%".$insurance_xtra;
								if($s2) $s2.=" AND insurance_xtra LIKE \"$insurance_xtra%\""; else $s2.=" insurance_xtra LIKE \"$insurance_xtra%\"";
							}
							if($sex)
								if($s2) $s2.=" AND sex=\"$sex\""; else $s2.=" sex=\"$sex\"";
							if($informed!=NULL)
								if($s2) $s2.=" AND informed=\"$informed\""; else $s2.=" informed=\"$informed\"";
							if($diagnosis_1)
								if($s2) $s2.=" AND diagnosis_1 LIKE \"%$diagnosis_1%\""; else $s2.=" diagnosis_1 LIKE \"%$diagnosis_1%\"";
							if($therapy_1)
								if($s2) $s2.=" AND therapy_1 LIKE \"%$therapy_1%\""; else $s2.=" therapy_1 LIKE \"%$therapy_1%\"";
							if($enc_date)
								if($s2) $s2.=" AND enc_date=\"$enc_date\""; else $s2.=" enc_date=\"$enc_date\"";
							if($encoder)
								if($s2) $s2.=" AND encoder	LIKE \"%$encoder%\""; else $s2.=" encoder LIKE \"%$encoder%\"";
							if($keynumber)
								if($s2) $s2.=" AND keynumber=\"".addslashes($keynumber)."\""; else $s2.=" keynumber=\"".addslashes($keynumber)."\"";
								
							$sql=$sql.$s2." AND patient_no<>''";
							
							if($ergebnis=mysql_query($sql,$link)) 
							{			
						  		$rows=0;
								while($result=mysql_fetch_array($ergebnis)) $rows++;	
								if($rows)
								{
									mysql_data_seek($ergebnis,0);
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
							$sql='SELECT * FROM '.$dbtable.' WHERE  dept="'.$de.'" 
																			AND doc_no="'.$dn.'" 
																			AND enc_date="'.$dt.'"
																			AND patient_no="'.$n.'" 
																			AND	lastname="'.$ln.'"
																			AND	firstname="'.$fn.'"
																			AND	birthdate="'.$bd.'"';
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
		} // end of switch
	}
  	 else { print "$LDDbNoLink<br>"; } 
?>


<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE></TITLE>
<script language="javascript" src="../js/setdatetime.js">
</script>

<script  language="javascript">
<!-- 
var iscat=<?php if($mode) print 'false'; else print 'true'; ?>;

function hidecat()
{
	if(!iscat) return;
	if(document.images) document.catcom.src=pix.src;
	iscat=false;
}

function loadcat()
{
  cat=new Image();
  cat.src="../imgcreator/catcom.php?sid=<?php echo $sid; ?>&lang=<?php echo $lang; ?>&person=<?php echo $HTTP_COOKIE_VARS[$local_user.$sid];?>";
  pix=new Image();
  pix.src="../img/pixel.gif";
}

function showcat()
{
	if(iscat)
	{
		hidecat();
		return;
	}
	else
	{
	if(document.images) document.catcom.src=cat.src;
	iscat=true;
	}
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
	position: absolute;
	right: 10;
	top: 80;
}
</style>
<?php 
require("../include/inc_css_a_hilitebu.php");
?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  onLoad="if(window.focus) window.focus();loadcat();
<?php if(!$mode||($mode=="?")||(($mode=="search")&&(!$rows))) print 'document.archivform.patient_no.select();'; 

?>"
<?php
if (!$cfg['dhtml']) print ' bgcolor="'.$cfg['body_bgcolor'].'" link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor'];
 ?>
>
<table width=100% border=0 cellspacing="0">
<tr>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=5  FACE="Arial">
<STRONG>&nbsp;<?php echo "$LDMedocs - $LDArchive" ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('medocs_how2arch.php','<?php echo $mode ?>','<?php echo $rows ?>')"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
</tr>
<tr>
<td colspan=2><p><br>

<div class="cats"><a href="javascript:hidecat()">
<?php if($mode!="") print'<img src="../img/pixel.gif" ';
	else print '<img src="../imgcreator/catcom.php?sid=<?php echo $sid; ?>&lang=<?php echo $lang; ?>&person='.$HTTP_COOKIE_VARS[$local_user.$sid].'" ';
print 'align="right" name="catcom" border=0 alt="'.$LDHideCat.'">';
?></a>
</div>

<ul>
<?php if($mode=="search")print '<FONT  SIZE=2 FACE="verdana,Arial">'.$LDSearchKeyword.': '.$s2; ?>

<?php if($rows>1) : ?>
<table border=0>
  <tr>
    <td><img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle"></td>
    <td><FONT  SIZE=3 FACE="verdana,Arial" color=#800000>
<b><?php print str_replace("~nr~",$rows,$LDFoundData); ?></b></font></td>
  </tr>
</table>

<table border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor=#0000aa>
      <?php
for($j=0;$j<sizeof($LDMedocsElements);$j++)
		print '
			<td><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>&nbsp;&nbsp;'.$LDMedocsElements[$j].'</b></td>';
	?>
  </tr>
 <?php 
 $toggle=0;
 while($result=mysql_fetch_array($ergebnis))
 {
 	print'
  <tr ';
  if($toggle){ print "bgcolor=#efefef"; $toggle=0;} else {print "bgcolor=#ffffff"; $toggle=1;}
  $buf='medocs-archiv.php?sid='.$sid.'&lang='.$lang.'&mode=select&de='.$result[dept].'&dn='.$result[doc_no].'&dt='.$result[enc_date].'&n='.$result[patient_no].'&ln='.$result[lastname].'&fn='.$result[firstname].'&bd='.$result[birthdate ];
  print '>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'"><img src="../img/R_arrowGrnSm.gif" width=12 height=12 border=0></a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[lastname].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[firstname].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result[birthdate].'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result[patient_no].'</td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[doc_no].'</a>&nbsp;&nbsp;</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result[dept].'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[enc_date].'</a></td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp; '.$result[enc_time].'&nbsp;&nbsp;</td>
  </tr>
  <tr bgcolor=#0000ff>
  <td colspan=9 height=1><img src="../img/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
  </tr>';
  }
 ?>
</table>
<p>
<form method="post"  action="medocs-archiv.php">
<FONT  SIZE=-1  FACE="Arial">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="mode" value="?">
<input type="submit" value="<?php echo $LDNewArchive ?>" >
 </form>
<?php else :?>



<FORM METHOD="post" ACTION="<?php if($mode=="select") print "medostart.php"; else print "medocs-archiv.php"; ?>" name="archivform">
<TABLE  CELLPADDING=2 CELLSPACING=1 border=0>
<TR VALIGN="baseline" <?php if($mode=="select") print" bgcolor=#fcfcfc"; ?>>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDMedocsElements[6] ?>:</TD>
	<TD><?php if($mode=="select") print '<FONT    SIZE=2  FACE="Arial" color="#80000"><b>'.$result[dept].'</b>'; else print '<INPUT NAME="dept" TYPE="text" VALUE="'.$result[dept].'" SIZE="30" onClick=hidecat()>';?><BR></TD>
	</TR>
<TR VALIGN="baseline" <?php if($mode=="select") print" bgcolor=#fcfcfc"; ?>>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDLastName ?>:</TD>
	<TD><?php if($mode=="select") print '<FONT    SIZE=2  FACE="Arial" color="#80000"><b>'.ucfirst($result[lastname]).'</b>'; else print '<INPUT NAME="lastname" TYPE="text" VALUE="'.$result[name].$result[lastname].'" SIZE="30" onClick=hidecat()>';?><BR></TD>
	<TD>&nbsp;<FONT    SIZE=2  FACE="Arial"><?php echo $LDCaseNr ?>:</TD>
	<TD>
	<?php if($mode=="select")
	{ print '<FONT    SIZE=2  FACE="Arial" color="#80000">'.$result[patient_no].$result[patnum];
		print '<input type="hidden" name="patient_no" value="'.$result[patnum].'">';
	}   
	 else print '<INPUT NAME="patient_no" TYPE="text" VALUE="'.$result[patnum].'" SIZE="30" onClick=hidecat()>';
	 ?>
	 <BR></TD>
	</TR>

<TR VALIGN="baseline" <?php if($mode=="select") print" bgcolor=#fcfcfc"; ?>>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDFirstName ?>:</TD>
	<TD> <?php if($mode=="select") print '<FONT    SIZE=2  FACE="Arial" color="#80000"><b>'.ucfirst($result[firstname]).'</b>'; else print '<INPUT NAME="firstname" TYPE="text" VALUE="'.$result[vorname].$result[firstname].'" SIZE="30" onClick=hidecat()>';?><BR></TD>
	</TR>
	
<TR VALIGN="baseline" <?php if($mode=="select") print" bgcolor=#fcfcfc"; ?>>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDBday ?></TD>
	<TD><?php if($mode=="select") print '<FONT    SIZE=2  FACE="Arial" color="#80000">'.$result[birthdate]; else print '<FONT    SIZE=2  FACE="Arial" ><INPUT NAME="birthdate" TYPE="text" VALUE="'.$result[gebdatum].$result[birthdate].'" SIZE="20" onClick=hidecat()> (tt.mm.jjjj)';?><BR></TD>
	<TD>&nbsp;<FONT    SIZE=2  FACE="Arial"><?php echo $LDInsurance ?>:</TD>
	<TD><?php if($mode=="select") print '<FONT    SIZE=2  FACE="Arial" color="#80000">'.$result[insurance]; else print '<INPUT NAME="insurance" TYPE="text" VALUE="'.$result[kassename].$result[insurance].'" SIZE="30" onClick=hidecat()>';?><BR></TD></TR>
<TR VALIGN="baseline" <?php if($mode=="select") print" bgcolor=#fcfcfc"; ?>>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDAddress ?>:</TD>
	<TD ><?php if($mode=="select") print '<FONT    SIZE=2  FACE="Arial" color="#80000">'.nl2br($result[address]); else print '<TEXTAREA NAME="address" Content-Type="text/html"
	COLS="28" ROWS="3" onClick=hidecat()>'.$result[address].'</TEXTAREA>';?></TD>
	<TD>&nbsp;<FONT    SIZE=2  FACE="Arial"><?php echo $LDExtraInfo ?>:</TD>
	<TD ><?php if($mode=="select") print '<FONT    SIZE=2  FACE="Arial" color="#80000">'.nl2br($result[insurance_xtra]); else print '<TEXTAREA NAME="insurance_xtra" Content-Type="text/html"
	COLS="28" ROWS="3" onClick=hidecat()>'.$result[insurance_xtra].'</TEXTAREA>';?></TD></TR>

<TR VALIGN="baseline" <?php if($mode=="select") print" bgcolor=#fcfcfc"; ?>>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDSex ?></TD>
	<TD>
	<?php if($mode=="select")
	{  print '<FONT    SIZE=2  FACE="Arial" color="#800000">';
		if($result[sex]=="m") print $LDMale; else print $LDFemale;
	}
	else
	{ print '<FONT    SIZE=2  FACE="Arial">
	<INPUT NAME="sex" TYPE="radio" VALUE="m" ';
	if ($result[sex]=="m") print "checked";
	print ' onClick=hidecat()> '.$LDMale.'&nbsp;
	<INPUT NAME="sex" TYPE="radio" VALUE="f" ';
	 if ($result[sex]=="f") print "checked";
	print ' onClick=hidecat()>'.$LDFemale.'<BR>
	';
	}
	?>
</TD></TR>
<TR VALIGN="baseline" <?php if($mode=="select") print" bgcolor=#fcfcfc"; ?>>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDMedAdvice ?>:</TD>
	<TD>
	<?php if($mode=="select")
	{  print '<FONT    SIZE=2  FACE="Arial" color="#800000">';
		if($result[informed]!=NULL){ if($result[informed]) print $LDYes; else print $LDNo;}
	}
	else
	{ print '
	<FONT    SIZE=2  FACE="Arial"><INPUT NAME="informed" TYPE="radio" VALUE="1" ';
	if(($result!=NULL)&&($result[informed])) print "checked" ;
	print ' onClick=hidecat()> '.$LDYes.'
	<INPUT NAME="informed" TYPE="radio" VALUE="0" ';
	if(($result!=NULL)&&($result[informed])) print "checked"; 
	print ' onClick=hidecat()>'.$LDNo.'<BR>
	</TD></TR>';
	}
	?>

<TR VALIGN="top" <?php if($mode=="select") print" bgcolor=#fcfcfc"; ?>>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDDiagnosis ?></TD>
	<TD colspan=3><?php if($mode=="select") print '<FONT    SIZE=2  FACE="Arial" color="#80000">'.nl2br($result[diagnosis_1]); else print '<input type=text NAME="diagnosis_1" 
	size="50" value="'.$result[diagnosis_1].'" onClick=hidecat()>';?></TD></TR>

<TR <?php if($mode=="select") print" bgcolor=#fcfcfc"; ?>>
	<TD valign=top <?php if($mode=="select") print" bgcolor=#fcfcfc"; ?>><FONT    SIZE=2  FACE="Arial"><?php echo $LDTherapy ?></TD>
	<TD colspan=3><?php if($mode=="select") print '<FONT    SIZE=2  FACE="Arial" color="#80000">'.nl2br($result[therapy_1]); else print '<input type=text NAME="therapy_1" 
	size="50" value="'.$result[therapy_1].'" onClick=hidecat()>';?></TD></TR>
<TR VALIGN="baseline" <?php if($mode=="select") print" bgcolor=#fcfcfc"; ?>>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDEditOn ?>:</TD>
	<TD><FONT    SIZE=2  FACE="Arial" color="#80000">
	<?php if($mode=="select") print $result[enc_date].'<font color="#0"> um: </font>'.$result[enc_time]; 
	else 
	print '<INPUT NAME="enc_date" TYPE="text" VALUE="" SIZE="20" onClick=hidecat() onKeyUp="setDate(this)"> (tt.mm.jjjj)';
	?>
	<BR></TD>
	</TR>
<TR VALIGN="baseline" <?php if($mode=="select") print" bgcolor=#fcfcfc"; ?>>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDEditBy ?>:</TD>
	<TD><FONT    SIZE=2  FACE="Arial" color="#80000">
	<?php if($mode=="select")print $result[encoder]; 
	else
	 print '<INPUT NAME="encoder" TYPE="text" VALUE="" SIZE="30" onClick=hidecat()>';

	?>
	<BR></TD>
	<TD>&nbsp;<FONT    SIZE=2  FACE="Arial"><?php echo $LDKeyNr ?>:</TD>
	<TD><FONT    SIZE=2  FACE="Arial" color="#80000">
	<?php if(($mode=="select")||($mode=="update")) print $result[keynumber]; 
	else print '<INPUT NAME="keynumber" TYPE="text" VALUE="'.$result[keynumber].'" SIZE="30" onClick=hidecat()>';?><BR></TD>
	</TR>
<?php if ($mode=="select") : ?>
</TABLE>
</TD></TR>
</TABLE><p>
<input type="submit" value="<?php echo $LDUpdateData ?>">
<input type="hidden" name="mode" value="update">
<input type="hidden" name="dept" value="<?php echo $result[dept] ?>">
<input type="hidden" name="doc_no" value="<?php echo $result[doc_no] ?>">
<input type="hidden" name="enc_date" value="<?php echo $result[enc_date] ?>">
<input type="hidden" name="lastname" value="<?php echo $result[lastname] ?>">
<input type="hidden" name="firstname" value="<?php echo $result[firstname] ?>">
<input type="hidden" name="birthdate" value="<?php echo $result[birthdate] ?>">
<input type="hidden" name="keynumber" value="<?php echo $result[keynumber] ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
</FORM>
<p>
<form method="post"  action="medocs-archiv.php">
<FONT  SIZE=-1  FACE="Arial">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="mode" value="?">
<input type="submit" value="<?php echo $LDNewArchive ?>" >
                             </form>
<?php else : ?>
</TABLE>
<p><INPUT TYPE="submit" VALUE="<?php echo $LDSearch ?>">&nbsp;&nbsp;<INPUT TYPE="reset" VALUE="<?php echo $LDReset ?>">
<input type="hidden" name="mode" value="search">
<input type="hidden" name="doc_no" value="<?php echo $result[doc_no] ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
</FORM>
 
<?php endif ?>

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
<img src="../img/varrow.gif" width="20" height="15"> <a href="medostart.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=?"><?php echo $LDStartNewDoc ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="medocs-search.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=?"><?php echo $LDDocSearch ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="javascript:showcat()"><?php echo $LDCatPls ?></a><br>

<p>

<a href="<?php echo $breakfile ?>"><img border=0 src="../img/<?php echo "$lang/$lang" ?>_close2.gif" alt="<?php echo $LDCancelClose ?>"></a>
</ul><p>
<hr>
<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>
</FONT>
</BODY>
</HTML>
