<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/*
CARE 2002 Integrated Information System beta 1.0.03 - 2002-10-26 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
define('LANG_FILE','aufnahme.php');
$local_user='medocs_user';
require_once('../include/inc_front_chain_lang.php');

require_once('../include/inc_config_color.php'); // load color preferences

$thisfile='medocs-archiv.php';

$breakfile="medopass.php?sid=".$sid."&lang=".$lang;

$dbtable='care_medocs';

//if($dept=="") $dept='plop';

$linecount=0;

include('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
{	
    /* Load date formatter */
    include_once('../include/inc_date_format_functions.php');
    	

	/* Load editor functions */
	//include_once('../include/inc_editor_fx.php');
	
		switch($mode)
		{
			case 'search':
							//$dbtable='care_medocs';
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
							{
							    $birthdate=formatDate2STD($birthdate,$date_format);
								if($s2) $s2.=" AND birthdate=\"".addslashes($birthdate)."\""; else $s2.=" birthdate=\"".addslashes($birthdate)."\"";
							}
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
							{
							    $enc_date=formatDate2STD($enc_date,$date_format);
								if($s2) $s2.=" AND enc_date=\"$enc_date\""; else $s2.=" enc_date=\"$enc_date\"";
							}	
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
							}else echo "$LDDbNoRead<p> $sql <p>";
							//echo $sql;
							if($rows==1)
							 {
								$result=mysql_fetch_array($ergebnis);
								$mode="select";
							}
							break;
			case 'select':
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
							}else echo "$LDDbNoRead<p> $sql <p>";
							//echo $sql;
							break;
		} // end of switch
		
        include_once('../include/inc_date_format_functions.php');
        
		
	}
  	 else { echo "$LDDbNoLink<br>"; } 
?>


<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE></TITLE>

<script  language="javascript">
<!-- 
var iscat=<?php if($mode) echo 'false'; else echo 'true'; ?>;

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
  pix.src="../gui/img/common/default/pixel.gif";
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

<?php require('../include/inc_checkdate_lang.php'); ?>

// -->
</script>

<script language="javascript" src="../js/checkdate.js" type="text/javascript"></script>

<script language="javascript" src="../js/setdatetime.js"></script>

<style type="text/css" name=cat>

div.cats{
	position: absolute;
	right: 10;
	top: 80;
}
</style>
<?php 
require('../include/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  onLoad="if(window.focus) window.focus();loadcat();
<?php if(!$mode||($mode=="?")||(($mode=='search')&&(!$rows))) echo 'document.archivform.patient_no.select();'; 
?>"
<?php
echo "bgcolor=\"".$cfg['bot_bgcolor']."\"";
if (!$cfg['dhtml']) echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor'];
 ?>
>
<table width=100% border=0 cellspacing="0">
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=5  FACE="Arial">
<STRONG>&nbsp;<?php echo "$LDMedocs - $LDArchive" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('medocs_how2arch.php','<?php echo $mode ?>','<?php echo $rows ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
</tr>
<tr>
<td colspan=2  bgcolor="<?php echo $cfg['body_bgcolor'] ?>"><p><br>

<div class="cats"><a href="javascript:hidecat()">
<?php if($mode!="") echo'<img src="../gui/img/common/default/pixel.gif" ';
	else echo '<img src="../imgcreator/catcom.php?sid=<?php echo $sid; ?>&lang=<?php echo $lang; ?>&person='.$HTTP_COOKIE_VARS[$local_user.$sid].'" ';
echo 'align="right" name="catcom" border=0 alt="'.$LDHideCat.'">';
?></a>
</div>

<ul>
<?php if($mode=='search')echo '<FONT  SIZE=2 FACE="verdana,Arial">'.$LDSearchKeyword.': '.$s2; ?>

<?php if($rows>1) : ?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot('../','mascot1_r.gif','0','bottom') ?> align="absmiddle"></td>
    <td><FONT  SIZE=3 FACE="verdana,Arial" color=#800000>
<b><?php echo str_replace("~nr~",$rows,$LDFoundData); ?></b></font></td>
  </tr>
</table>

<table border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor=#0000aa>
      <?php
         for($j=0;$j<sizeof($LDMedocsElements);$j++)
		 echo '
			<td><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>&nbsp;&nbsp;'.$LDMedocsElements[$j].'</b></td>';
	   ?>
  </tr>
 <?php 
 $toggle=0;
 while($result=mysql_fetch_array($ergebnis))
 {
 	echo'
  <tr ';
  if($toggle){ echo "bgcolor=#efefef"; $toggle=0;} else {echo "bgcolor=#ffffff"; $toggle=1;}
  $buf='medocs-archiv.php?sid='.$sid.'&lang='.$lang.'&mode=select&de='.$result['dept'].'&dn='.$result['doc_no'].'&dt='.$result['enc_date'].'&n='.$result['patient_no'].'&ln='.$result['lastname'].'&fn='.$result['firstname'].'&bd='.$result['birthdate'];
  echo '>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'"><img '.createComIcon('../','r_arrowgrnsm.gif','0').'></a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result['lastname'].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result['firstname'].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.formatDate2Local($result[birthdate],$date_format).'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result['patient_no'].'</td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result['doc_no'].'</a>&nbsp;&nbsp;</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result['dept'].'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.formatDate2Local($result['enc_date'],$date_format).'</a></td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp; '.convertTimeToLocal(formatDate2Local($result['enc_date'],$date_format,0,1)).'&nbsp;&nbsp;</td>
  </tr>
  <tr bgcolor=#0000ff>
  <td colspan=9 height=1><img src="../gui/img/common/default/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
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



<FORM METHOD="post" ACTION="<?php if($mode=='select') echo "medostart.php"; else echo "medocs-archiv.php"; ?>" name="archivform">
<TABLE  CELLPADDING=2 CELLSPACING=1 border=0>
<TR VALIGN="baseline" <?php if($mode=='select') echo" bgcolor=#fcfcfc"; ?>>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDMedocsElements[6] ?>:</TD>
	<TD><?php if($mode=='select') echo '<FONT    SIZE=2  FACE="Arial" color="#80000"><b>'.$result['dept'].'</b>'; else echo '<INPUT NAME="dept" TYPE="text" VALUE="'.$result[dept].'" SIZE="30" onClick=hidecat()>';?><BR></TD>
	</TR>
<TR VALIGN="baseline" <?php if($mode=='select') echo" bgcolor=#fcfcfc"; ?>>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDLastName ?>:</TD>
	<TD><?php if($mode=='select') echo '<FONT    SIZE=2  FACE="Arial" color="#80000"><b>'.ucfirst($result['lastname']).'</b>'; else echo '<INPUT NAME="lastname" TYPE="text" VALUE="'.$result[name].$result[lastname].'" SIZE="30" onClick=hidecat()>';?><BR></TD>
	<TD>&nbsp;<FONT    SIZE=2  FACE="Arial"><?php echo $LDCaseNr ?>:</TD>
	<TD>
	<?php if($mode=='select')
	{ echo '<FONT    SIZE=2  FACE="Arial" color="#80000">'.$result['patient_no'].$result['patnum'];
		echo '<input type="hidden" name="patient_no" value="'.$result['patnum'].'">';
	}   
	 else echo '<INPUT NAME="patient_no" TYPE="text" VALUE="'.$result['patnum'].'" SIZE="30" onClick=hidecat()>';
	 ?>
	 <BR></TD>
	</TR>

<TR VALIGN="baseline" <?php if($mode=='select') echo" bgcolor=#fcfcfc"; ?>>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDFirstName ?>:</TD>
	<TD> <?php if($mode=='select') echo '<FONT    SIZE=2  FACE="Arial" color="#80000"><b>'.ucfirst($result['firstname']).'</b>'; else echo '<INPUT NAME="firstname" TYPE="text" VALUE="'.$result[vorname].$result[firstname].'" SIZE="30" onClick=hidecat()>';?><BR></TD>
	</TR>
	
<TR VALIGN="baseline" <?php if($mode=='select') echo" bgcolor=#fcfcfc"; ?>>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDBday ?></TD>
	<TD>
	<?php 
	   if($mode=='select') echo '<FONT    SIZE=2  FACE="Arial" color="#80000">'.formatDate2Local($result['birthdate'],$date_format); 
	   else echo '<FONT    SIZE=2  FACE="Arial" ><INPUT NAME="birthdate" TYPE="text" VALUE="'.$result['gebdatum'].$result['birthdate'].'" SIZE="20" onClick=hidecat() onBlur="IsValidDate(this,\''.$date_format.'\')"  onKeyUp="setDate(this,\''.$date_format.'\',\''. $lang.'\')"> [';
            $dfbuffer="LD_".strtr($date_format,".-/","phs");
       echo $$dfbuffer;
       echo ']';?><BR></TD>
	<TD>&nbsp;<FONT    SIZE=2  FACE="Arial"><?php echo $LDInsurance ?>:</TD>
	<TD><?php if($mode=='select') echo '<FONT    SIZE=2  FACE="Arial" color="#80000">'.$result['insurance']; else echo '<INPUT NAME="insurance" TYPE="text" VALUE="'.$result['kassename'].$result['insurance'].'" SIZE="30" onClick=hidecat()>';?><BR></TD></TR>
<TR VALIGN="baseline" <?php if($mode=='select') echo" bgcolor=#fcfcfc"; ?>>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDAddress ?>:</TD>
	<TD ><?php if($mode=='select') echo '<FONT    SIZE=2  FACE="Arial" color="#80000">'.nl2br($result['address']); else echo '<TEXTAREA NAME="address" Content-Type="text/html"
	COLS="28" ROWS="3" onClick=hidecat()>'.$result['address'].'</TEXTAREA>';?></TD>
	<TD>&nbsp;<FONT    SIZE=2  FACE="Arial"><?php echo $LDExtraInfo ?>:</TD>
	<TD ><?php if($mode=='select') echo '<FONT    SIZE=2  FACE="Arial" color="#80000">'.nl2br($result['insurance_xtra']); else echo '<TEXTAREA NAME="insurance_xtra" Content-Type="text/html"
	COLS="28" ROWS="3" onClick=hidecat()>'.$result['insurance_xtra'].'</TEXTAREA>';?></TD></TR>

<TR VALIGN="baseline" <?php if($mode=='select') echo" bgcolor=#fcfcfc"; ?>>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDSex ?></TD>
	<TD>
<?php 
if($mode=='select')
{  echo '<FONT    SIZE=2  FACE="Arial" color="#800000">';
		if($result['sex']=='m') echo $LDMale; else echo $LDFemale;
}
else
{ echo '<FONT    SIZE=2  FACE="Arial">
	<INPUT NAME="sex" TYPE="radio" VALUE="m" ';
	if ($result['sex']=='m') echo 'checked';
	echo ' onClick=hidecat()> '.$LDMale.'&nbsp;
	<INPUT NAME="sex" TYPE="radio" VALUE="f" ';
	 if ($result['sex']=='f') echo 'checked';
	echo ' onClick=hidecat()>'.$LDFemale.'<BR>
	';
}
	?>
</TD></TR>
<TR VALIGN="baseline" <?php if($mode=='select') echo" bgcolor=#fcfcfc"; ?>>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDMedAdvice ?>:</TD>
	<TD>
	<?php if($mode=='select')
	{  echo '<FONT    SIZE=2  FACE="Arial" color="#800000">';
		if($result['informed']!=NULL){ if($result['informed']) echo $LDYes; else echo $LDNo;}
	}
	else
	{ echo '
	<FONT    SIZE=2  FACE="Arial"><INPUT NAME="informed" TYPE="radio" VALUE="1" ';
	if(($result!=NULL)&&($result['informed'])) echo 'checked' ;
	echo ' onClick=hidecat()> '.$LDYes.'
	<INPUT NAME="informed" TYPE="radio" VALUE="0" ';
	if(($result!=NULL)&&($result['informed'])) echo 'checked'; 
	echo ' onClick=hidecat()>'.$LDNo.'<BR>
	</TD></TR>';
	}
	?>

<TR VALIGN="top" <?php if($mode=='select') echo" bgcolor=#fcfcfc"; ?>>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDDiagnosis ?></TD>
	<TD colspan=3><?php if($mode=='select') echo '<FONT    SIZE=2  FACE="Arial" color="#80000">'.nl2br($result['diagnosis_1']); else echo '<input type=text NAME="diagnosis_1" 
	size="50" value="'.$result['diagnosis_1'].'" onClick=hidecat()>';?></TD></TR>

<TR <?php if($mode=='select') echo" bgcolor=#fcfcfc"; ?>>
	<TD valign=top <?php if($mode=='select') echo" bgcolor=#fcfcfc"; ?>><FONT    SIZE=2  FACE="Arial"><?php echo $LDTherapy ?></TD>
	<TD colspan=3><?php if($mode=='select') echo '<FONT    SIZE=2  FACE="Arial" color="#80000">'.nl2br($result['therapy_1']); else echo '<input type=text NAME="therapy_1" 
	size="50" value="'.$result['therapy_1'].'" onClick=hidecat()>';?></TD></TR>
<TR VALIGN="baseline" <?php if($mode=='select') echo" bgcolor=#fcfcfc"; ?>>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDEditOn ?>:</TD>
	<TD><FONT    SIZE=2  FACE="Arial">
	<?php if($mode=='select') echo '<FONT color="#80000">'.formatDate2Local($result['enc_date'],$date_format).'<font color="#0"> '.$LDAt.': </font>'.convertTimeToLocal(formatDate2Local($result['enc_date'],$date_format,0,1)).'</font>'; 
	else
	{ 
	     echo '<INPUT NAME="enc_date" TYPE="text" VALUE="" SIZE="20" onClick=hidecat() onBlur="IsValidDate(this,\''.$date_format.'\')"  onKeyUp="setDate(this,\''.$date_format.'\',\''. $lang.'\')">';
	   
         $dfbuffer='LD_'.strtr($date_format,'.-/','phs');
         
		 echo ' [ '.$$dfbuffer.' ]';
	}
	?>
	<BR></TD>
	</TR>
<TR VALIGN="baseline" <?php if($mode=='select') echo" bgcolor=#fcfcfc"; ?>>
	<TD><FONT    SIZE=2  FACE="Arial"><?php echo $LDEditBy ?>:</TD>
	<TD><FONT    SIZE=2  FACE="Arial" color="#80000">
	<?php if($mode=='select')echo $result['create_id']; 
	else
	 echo '<INPUT NAME="encoder" TYPE="text" VALUE="" SIZE="30" onClick=hidecat()>';

	?>
	<BR></TD>
	<TD>&nbsp;<FONT    SIZE=2  FACE="Arial"><?php echo $LDKeyNr ?>:</TD>
	<TD><FONT    SIZE=2  FACE="Arial" color="#80000">
	<?php if(($mode=='select')||($mode=="update")) echo $result['keynumber']; 
	else echo '<INPUT NAME="keynumber" TYPE="text" VALUE="'.$result['keynumber'].'" SIZE="30" onClick=hidecat()>';?><BR></TD>
	</TR>
<?php if ($mode=='select') : ?>
</TABLE>
<p>
<input type="image" <?php echo createLDImgSrc('../','update_data.gif') ?>>
<input type="hidden" name="mode" value="update">
<input type="hidden" name="dept" value="<?php echo $result['dept'] ?>">
<input type="hidden" name="doc_no" value="<?php echo $result['doc_no'] ?>">
<input type="hidden" name="enc_date" value="<?php echo $result['enc_date'] ?>">
<input type="hidden" name="lastname" value="<?php echo $result['lastname'] ?>">
<input type="hidden" name="firstname" value="<?php echo $result['firstname'] ?>">
<input type="hidden" name="birthdate" value="<?php echo $result['birthdate'] ?>">
<input type="hidden" name="keynumber" value="<?php echo $result['keynumber'] ?>">
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
<!-- <p><INPUT TYPE="submit" VALUE="<?php echo $LDSearch ?>">&nbsp;&nbsp;<INPUT TYPE="reset" VALUE="<?php echo $LDReset ?>"> -->
<p><INPUT TYPE="image" <?php echo createLDImgSrc('../','searchlamp.gif','0','absmiddle') ?>>&nbsp;&nbsp;<INPUT TYPE="reset" VALUE="<?php echo $LDReset ?>">
<input type="hidden" name="mode" value="search">
<input type="hidden" name="doc_no" value="<?php echo $result['doc_no'] ?>">
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
<tr>
<td bgcolor="<?php echo $cfg['body_bgcolor'] ?>" colspan=2>
<hr>
<ul>
<FONT    SIZE=2  FACE="Arial">
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="medostart.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=?"><?php echo $LDStartNewDoc ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="medocs-search.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=?"><?php echo $LDDocSearch ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="javascript:showcat()"><?php echo $LDCatPls ?></a><br>
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','cancel.gif','0') ?> alt="<?php echo $LDCancelClose ?>"></a>
</ul><p>
</td>
</tr></table>
 <hr>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</FONT>
  
</BODY>
</HTML>
