<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/

define('MODULE','nursing_or');
define('LANG_FILE_MODULAR','nursing_or.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

require_once($root_path.'include/helpers/inc_date_format_functions.php');

if($pmonth=='') $pmonth=date('n');
if($pyear=='') $pyear=date('Y');
if($pday=='') $pday=date('d');
//$thisfile=basename(__FILE__);

$offset_day=$pday-1;

switch($retpath)
{
	case "menu": $rettarget=$root_path.'modules/main/op-docu.php'.URL_APPEND; break;
	case "qview": $rettarget=$root_path.'modules/nursing_or/nursing-or-roster-quickview.php'.URL_APPEND; break;
	case "calendar_opt": $rettarget=$root_path."modules/calendar/calendar-options.php".URL_APPEND."&dept_nr=$dept_nr&forcestation=1&day=$pday&month=$pmonth&year=$pyear";break;
	default: $rettarget="javascript:window.history.back()";
}

$dbtable='care_dutyplan_oncall';

// test dept nr
//$dept_nr=4;

$sql="SELECT duty_1_pnr,duty_2_pnr FROM $dbtable 
			WHERE dept_nr='$dept_nr'
							AND year='$pyear'
							AND month='".(int)$pmonth."'";
			
if($ergebnis=$db->Execute($sql)){
	if($rows=$ergebnis->RecordCount()){
		$result=$ergebnis->FetchRow();
		$duty1=unserialize($result['duty_1_pnr']);
		$duty2=unserialize($result['duty_2_pnr']);
					//echo $sql."<br>";
	}
}

//echo $sql;

require_once($root_path.'modules/staff_admin/model/class_staff.php');
$pers_obj=new staff;

if($pnr=$duty1['ha'.$offset_day]){
	$person1=&$pers_obj->getstaffInfo($pnr);
}
if($pnr=$duty2['hr'.$offset_day]){
	$person2=&$pers_obj->getstaffInfo($pnr);
}

require_once($root_path.'modules/dept_admin/model/class_department.php');
$dept_obj=new Department;
$dept=&$dept_obj->getPhoneInfo($dept_nr);
/* Resolve the departments name "language dependent" */
$dept_ldvar=$dept_obj->LDvar($dept_nr);
if(isset($$dept_ldvar)&&!empty($$dept_ldvar)) $dept_name=$$dept_ldvar;
	else $dept_name=$dept_obj->FormalName($dept_nr);

require_once($root_path.'include/core/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('person_%');
/* Check whether config photo path exists, else use default path */			
$default_photo_path='uploads/photos/registration';
$photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_photo_path'])) ? $GLOBAL_CONFIG['person_photo_path'] : $default_photo_path;

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<html>
<HEAD>

 <TITLE><?php echo "$LDOR $LDNursing $LDOnCallDuty" ?></TITLE>

<style type="text/css">
	A:link  {text-decoration: none; }
	A:hover {text-decoration: underline; color: red; }

	A:visited {text-decoration: none;}

div.a3 {font-family: arial; font-size: 14; margin-left: 3; margin-right:3; }

.infolayer {
	position:absolute;
	visibility: hide;
	left: 100;
	top: 10;

}

</style>

<script language="javascript">

  var urlholder;
  var infowinflag=0;

function popinfo(l,f,b)
{
	w=window.screen.width;
	h=window.screen.height;
	ww=400;
	wh=400;
	urlholder="op-care-dienstplan-popinfo.php?ln="+l+"&fn="+f+"&bd="+b+"&dept=<?php echo "$dept&sid=$sid&lang=$lang" ?>&route=validroute&user=<?php echo $aufnahme_user.'"' ?>;
	
	infowin=window.open(urlholder,"infowin","width=" + ww + ",height=" + wh +",menubar=no,resizable=yes,scrollbars=yes");
	window.infowin.moveTo((w/2)+20,(h/2)-(wh/2));

}

</script>

</HEAD>

<BODY  bgcolor="#ffffff" alink="navy" vlink="navy"  onLoad="window.resizeTo(600,600)">
<font face="Verdana, Arial" size=2>

<b> <?php echo "$LDOnCallDuty ($dept_name) $LDOn ".formatDate2Local("$pyear-$pmonth-$pday",$date_format); ?></b>
<p>
<?php if($person1) { 

	$photo_filename=$person1['photo_filename'];
	include($root_path.'include/helpers/inc_photo_filename_resolve.php');
?>
<font face=verdana,arial size=+1 color=maroon>
<b>
<?php
echo ucfirst($person1['name_last']).', '.ucfirst($person1['name_first']);
?>
</b>
<img <?php echo $img_source; ?> align="right">
</font>
<p>

<table border=0>
<tr>
<td bgcolor=#ffffcc><img <?php echo createComIcon($root_path,'authors.gif') ?>>&nbsp;<font face=verdana,arial size=2 ><b><?php echo $LDContactInfo ?></b><br></font>
</td>
</tr>
<tr>
<td><font face=verdana,arial size=2 >&nbsp;&nbsp;<b><?php echo $LDBeeper ?>:</b><font color=red> <?php echo $person1['funk1']; ?><br>
<font color=navy>&nbsp;&nbsp;<b><?php echo $LDPhone ?>:</b> <?php echo $person1['inphone1']; ?></font>
</td>
</tr>
<tr>
<td bgcolor=#ffffcc><img <?php echo createComIcon($root_path,'listen-sm-legend.gif') ?>>&nbsp;<font face=verdana,arial size=2 ><b><?php echo $LDOnCallContactInfo ?></b><br></font>
</td>
</tr>
<tr>
<td><font face=verdana,arial size=2 >&nbsp;&nbsp;<b><?php echo $LDBeeper ?>:</b><font color=red> <?php echo $dept['funk1']; ?>
<br>
<font color=navy>&nbsp;&nbsp;<b><?php echo $LDPhone ?>:</b> <?php echo $dept['inphone1']; ?></font>
</td>
</tr>

<!-- <tr>
<td bgcolor=#ffffcc><img <?php echo createComIcon($root_path,'warn.gif') ?>>&nbsp;<font face=verdana,arial size=2 ><b><?php echo $LDMoreInfo ?></b><br></font>
</td>
</tr>
<tr>
<td><font face=verdana,arial size=2 ><?php echo $pinfo["info"]; ?></font>
</td>
</tr>
 --></table>
<p>

<?php } ?>
<?php if($person2) { 

	$photo_filename=$person2['photo_filename'];
	include($root_path.'include/helpers/inc_photo_filename_resolve.php');
?>
<hr>


<font face=verdana,arial size=+1 color=maroon>
<b>
<?php
echo ucfirst($person2['name_last']).', '.ucfirst($person2['name_first']);
?>
</b>
<img <?php echo $img_source; ?> align="right">
</font>
<p>

<table border=0 >
<tr>
<td bgcolor=#ffffcc>

<img <?php echo createComIcon($root_path,'authors.gif') ?>>&nbsp;<font face=verdana,arial size=2 ><b><?php echo $LDContactInfo ?></b><br></font>
</td>
</tr>
<tr>
<td><font face=verdana,arial size=2 ><b><?php echo $LDBeeper ?>:</b><font color=red> <?php echo $person2['funk1']; ?><br>
<font color=navy><b><?php echo $LDPhone ?>:</b> <?php echo $person2['inphone1']; ?><br></font>
</td>
</tr>
<tr>
<td bgcolor=#ffffcc><img <?php echo createComIcon($root_path,'listen-sm-legend.gif') ?>>&nbsp;<font face=verdana,arial size=2 ><b><?php echo $LDOnCallContactInfo ?></b><br></font>
</td>
</tr>
<tr>
<td><font face=verdana,arial size=2 >&nbsp;&nbsp;<b><?php echo $LDBeeper ?>:</b><font color=red> <?php echo $dept['funk1']; ?>
<br>
<font color=navy>&nbsp;&nbsp;<b><?php echo $LDPhone ?>:</b> <?php echo $dept['inphone1']; ?><br></font>
</td>
</tr>

<!-- <tr>
<td bgcolor=#ffffcc><img <?php echo createComIcon($root_path,'warn.gif') ?>>&nbsp;<font face=verdana,arial size=2 ><b><?php echo $LDMoreInfo ?></b><br></font>
</td>
</tr>
<tr>
<td><font face=verdana,arial size=2 ><?php echo $pinfo["info"]; ?></font>
</td>
</tr>
 --></table>
 

<p>

<?php } ?>
 <?php
 if(!($person1||$person2)){
 ?>
<table border=0>
  <tr>
    
    <td><font face="Verdana, Arial" size=3 color="#cc0000"><b><?php echo $LDNoEntryFound ?></b></font></td>
  </tr>
</table>

<?php } ?>
<p>
<a href="<?php echo $rettarget ?>" class="button icon arrowleft">Back</a>
</FONT>
</BODY>
</HTML>
