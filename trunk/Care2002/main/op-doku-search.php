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

if ((substr($matchcode,0,1)=="%")||(substr($matchcode,0,1)=="&")) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require_once('../include/inc_config_color.php'); // load color preferences

$thisfile='op-doku-search.php';
$breakfile='op-doku.php?sid='.$sid.'&lang='.$lang;
//foreach($arg as $v) echo "$v<br>"; //init db parameters

if(!$dept)
	if(isset($HTTP_COOKIE_VARS['ck_thispc_dept'])&&!empty($HTTP_COOKIE_VARS['ck_thispc_dept'])) $dept=$HTTP_COOKIE_VARS['ck_thispc_dept'];
		else $dept='plop'; // default department is plop

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
			case 'match':
			
							$dbtable='care_op_med_doc';
							if(is_numeric($matchcode)&&$matchcode)
							{
								$matchcode=(int)$matchcode;
								$sql='SELECT * FROM '.$dbtable.' WHERE  patnum='.$matchcode;
							}
							else 
								$sql='SELECT * FROM '.$dbtable.' WHERE  name="'.addslashes($matchcode).'"';
							if($ergebnis=mysql_query($sql,$link)) 
							{			
								if(!$rows=mysql_num_rows($ergebnis))
								{ 
								    // if not found find similar
								    $sql='SELECT * FROM '.$dbtable.' WHERE ( name LIKE "'.trim($matchcode).'%" 
											OR vorname LIKE "'.trim($matchcode).'%" ) AND patnum<>"" ORDER BY doc_nr';
											
									if($ergebnis=mysql_query($sql,$link)) 
									{			
										$rows=mysql_num_rows($ergebnis);
									}
									
								}
							}else echo "$LDDbNoRead<p> $sql <p>";
							
							//echo $sql;
							if($rows==1) 	$medoc=mysql_fetch_array($ergebnis);
							
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
							//echo $sql;
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
 <TITLE><?php echo $LDOrDocument ?></TITLE>


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
  cat.src="../imgcreator/catcom.php?sid=<?php echo $sid; ?>&lang=<?php echo $lang; ?>&person=<?php echo $HTTP_COOKIE_VARS[$local_user.$sid];?>";
  pix=new Image();
  pix.src="../gui/img/common/default/pixel.gif";
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
	window.location.replace("op-doku-search.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=match&matchcode="+m);
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

<style type="text/css" name="cat">

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

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if(window.focus) window.focus();loadcat(); document.matchform.matchcode.focus();">


<table width=100% border=0 cellspacing="0">
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>" SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo "$LDOrDocument - $LDSearch ($dept)" ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('opdoc.php','search','<?php echo $mode ?>','<?php echo $rows ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?> style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?>  alt="<?php echo $LDClose ?>" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a>
</td>
</tr>
<tr>
<td colspan=2 bgcolor=<?php echo $cfg['body_bgcolor']; ?>><p><br>

<div class="cats"><a href="javascript:hidecat()">
<?php if($mode!="") echo'
<img src="../gui/img/common/default/pixel.gif" align=right name=catcom border=0>';
else echo '
<img src="../imgcreator/catcom.php?sid='.$sid.'&lang='.$lang.'&person='.strtr($HTTP_COOKIE_VARS[$local_user.$sid]," ","+").'" align=right name=catcom border=0 alt="'.$LDHideCat.'">';
?>
</a></div>

<ul>
<form method="post"  name="matchform" onSubmit="return lookmatch(this)">
<FONT  SIZE=-1  FACE="Arial"><?php echo $LDSearchKeyword ?>: <input name="matchcode" type="text" size="14" onClick=hidecat()>&nbsp;
<input type="image" <?php echo createLDImgSrc('../','searchlamp.gif','0','absmiddle') ?> alt="<?php echo $LDSearch ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
</form>
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
	?>

  </tr>
 <?php 
 $toggle=0;
 while($medoc=mysql_fetch_array($ergebnis))
 {
 	if($medoc[dept]=="lastdocnumber") continue;
 	echo'
  <tr ';
  if($toggle){ echo "bgcolor=#efefef"; $toggle=0;} else {echo "bgcolor=#ffffff"; $toggle=1;}
  $buf="op-doku-search.php?sid=$sid&lang=$lang&mode=select&doc_nr=".$medoc['doc_nr'];
  echo '>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'"><img '.createComIcon('../','r_arrowgrnsm.gif','0').'></a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$medoc['name'].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$medoc['vorname'].'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.formatDate2Local($medoc['gebdatum'],$date_format).'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$medoc['patnum'].'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.formatDate2Local($medoc['op_date'],$date_format).'</a></td>
    <td align="center"><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$medoc['dept'].'</td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$medoc['doc_nr'].'</a>&nbsp; &nbsp;</td>
  </tr>
  <tr bgcolor=#0000ff>
  <td colspan=8 height=1><img src="../gui/img/common/default/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
  </tr>';
  }
 ?>
</table>
<p>

<?php elseif($rows) :?>



<FONT  SIZE=-1  FACE="Arial">
<table border="0">

<form method="post" action="op-doku-start.php" name="opdoc">
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDSrcListElements[7] ?>:<br>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  echo '<font color="#800000">'.$medoc[doc_nr]; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDSrcListElements[6] ?>:<br>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  echo '<font color="#800000">'.$medoc['dept']; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDOpDate ?>:<br>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  echo '<font color="#800000">'.formatDate2Local($medoc['op_date'],$date_format); 
?>
<font color=#0>&nbsp; &nbsp;<?php echo $LDOperator ?>:
<?php  echo '<font color="#800000">'.$medoc['operator']; 
 ?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td>

<FONT SIZE=-1  FACE="Arial"><?php echo $LDPatientNr ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  echo '<font color="#000099">'.$medoc['patnum']; 
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
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDLastName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  echo '<font color="#000099"><b>'.$medoc['name'].'</b>'; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  echo '<font color="#000099"><b>'.$medoc['vorname'].'</b>'; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDBday ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  echo '<font color="#000099">'.formatDate2Local($medoc['gebdatum'],$date_format); 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<font color=#000099>
<?php switch($medoc['status'])
	{
		case "stat": echo $LDStationary;break;
		case "amb": echo $LDAmbulant; break;
	}
	echo "<br>";
	echo ucfirst($medoc['kasse']);
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDDiagnosis ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  echo '<font color="#800000">'.$medoc['diagnosis']; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDLocalization ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  echo '<font color="#800000">'.$medoc['localize']; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDTherapy ?>:
</td>
<td>
<FONT SIZE=-1  FACE="Arial">
<?php  echo '<font color="#800000">'.$medoc['therapy']; 
?>
</td>
</tr >
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDSpecials ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  echo '<font color="#800000">'.$medoc['special']; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDClassification ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<font color="#800000">
<?php
if($medoc['class_s']) echo $medoc['class_s']." $LDMinor  &nbsp; ";
   	if($medoc['class_m']) echo $medoc['class_m']." $LDMiddle &nbsp; ";
   	if($medoc['class_l']) echo $medoc['class_l']." $LDMajor";
	echo " $LDOperation";
?>
</td>
</tr>
</table>
<p>
 <FONT SIZE=-1  FACE="Arial">
<?php echo $LDOpStart ?>:<font color="#0">
<?php  echo '<font color="#800000">'.convertTimeToLocal($medoc['op_start']).' &nbsp;'; 
	
?>
<font color="#0"><?php echo $LDOpEnd ?>:
<?php echo '<font color="#800000">'.convertTimeToLocal($medoc['op_end']).' &nbsp;'; 
	
?>
<font color="#0"><?php echo $LDScrubNurse ?>: 
<?php  echo '<font color="#800000">'.$medoc['scrub_nurse'].' &nbsp;'; 
	
?>
<font color="#0"><?php echo $LDOpRoom ?>: <font color="#0">
<?php  echo '<font color="#800000">'.$medoc['op_room']; 
?>
<?php
$buf="op-doku-start.php?sid=$sid&lang=$lang&mode=update&update=1&doc_nr=".$medoc['doc_nr']."&patnum=".$medoc['patnum'];
?>
<!-- <p><input type="button" value="<?php echo $LDUpdateData ?>" onClick="window.location.href='<?php echo $buf ?>'"> &nbsp;
 -->
 <p><input type="image" <?php echo createLDImgSrc('../','update_data.gif') ?>>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="doc_nr" value="<?php echo $medoc['doc_nr'] ?>">
<input type="hidden" name="patnum" value="<?php echo $medoc['patnum'] ?>">
<input type="hidden" name="mode" value="update">
<input type="hidden" name="update" value="1">
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
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="op-doku-archiv.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=dummy"><?php echo $LDResearchArchive ?></a><br>
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
