<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.net, elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='departments.php';
define('LANG_FILE','doctors.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

setcookie(username,"");
setcookie(ck_plan,"1");
if($dept=="") $dept="plast";
if($pmonth=="") $pmonth=date('n');
if($pyear=="") $pyear=date('Y');
$thisfile=basename(__FILE__);

require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$dept_obj->preloadDept($dept_nr);

require_once($root_path.'include/care_api_classes/class_personell.php');
$pers_obj=new Personell;
$dutyplan=&$pers_obj->getDOCDutyplan($dept_nr,$pyear,$pmonth);


$firstday=date("w",mktime(0,0,0,$pmonth,1,$pyear));

$maxdays=date("t",mktime(0,0,0,$pmonth,1,$pyear));

switch($retpath)
{
	case "menu": $rettarget='doctors.php'.URL_APPEND; break;
	case "qview": $rettarget='doctors-dienst-schnellsicht.php'.URL_APPEND.'&hilitedept='.$dept_nr; break;
	default: $rettarget="javascript:window.history.back()";
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE></TITLE>

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

function popinfo(l)
{
	w=window.screen.width;
	h=window.screen.height;
	ww=400;
	wh=400;
	urlholder="doctors-dienstplan-popinfo.php<?php echo URL_REDIRECT_APPEND ?>&nr="+l+"&dept_nr=<?php echo $dept_nr ?>&route=validroute&user=<?php echo $aufnahme_user.'"' ?>;
	
	infowin<?php echo $sid ?>=window.open(urlholder,"infowin<?php echo $sid ?>","width=" + ww + ",height=" + wh +",menubar=no,resizable=yes,scrollbars=yes");
	window.infowin<?php echo $sid ?>.moveTo((w/2)+20,(h/2)-(wh/2));

}
</script>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor="silver" alink="navy" vlink="navy"  >


<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" >
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" ><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+1  FACE="Arial">
<STRONG><font color="<?php echo $cfg['top_txtcolor']; ?>"> &nbsp; <?php echo "$LDDoctors::$LDDutyPlan::" ?></font> 
<?php 
$LDvar=$dept_obj->LDvar();
if(isset($$LDvar)&&$$LDvar) echo $$LDvar;
else echo $dept_obj->FormalName();
?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right"><a href="javascript:history.back();"><img <?php echo createLDImgSrc($root_path,'back2.gif','0','absmiddle') ?>
 alt="<?php echo $LDBack ?>"></a><a href="javascript:gethelp('docs_dutyplan.php','<?php echo $mode ?>','<?php echo $rows ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0','absmiddle') ?>
  alt="<?php echo $LDHelp ?>"></a><a href="<?php echo $rettarget ?>")><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?> alt="<?php echo $LDClosePlan ?>"></a></td></tr>

<tr>
<td bgcolor="<?php echo $cfg['body_bgcolor']; ?>" valign=top colspan=2><p>
<ul>


<FONT    SIZE=-1  FACE="Arial">

<table border=0>
<tr><td align=left><a href="<?php echo $thisfile.'?sid='.$sid.'&lang='.$lang.'&retpath='.$retpath.'&dept='.$dept.'&pmonth=';
if ($pmonth==1) echo '12'.'&pyear='.($pyear-1); 
else echo ($pmonth-1).'&pyear='.$pyear; ?>">
<font size=2 face=arial color=gray><b><?php if ($pmonth==1) echo $monat[12]; else echo $monat[$pmonth-1]; ?></b></a></td>
<td align=center><font size=4 face=arial color=navy>
<?php echo ucfirst($monat[$pmonth]).'&nbsp;&nbsp;'.$pyear; ?>
</font></td>

<td align=right><a href="<?php echo $thisfile.'?sid='.$sid.'&lang='.$lang.'&retpath='.$retpath.'&dept='.$dept.'&pmonth=';
if ($pmonth==12) echo '1'.'&pyear='.($pyear+1); 
else echo ($pmonth+1).'&pyear='.$pyear; ?>">
<font size=2 face=arial color=gray><b><?php if ($pmonth==12) echo $monat[1];else echo $monat[$pmonth+1]; ?></b></td>
<td>&nbsp;</td></tr>


<tr>
<td colspan=3>

<table border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="#6f6f6f">

<table border=0 cellpadding=0 cellspacing=1>
<tr><td></td><td></td>
<td><div class=a3><font face=arial size=3 color=white><b><?php echo $LDDoc1 ?></b></div></td>
<td><div class=a3><font face=arial size=3 color=white><b><?php echo $LDDoc2 ?></b></div></td>
</tr>
<?php

for ($i=1,$n=0,$wd=$firstday;$i<=$maxdays;$i++,$n++,$wd++){
	//$wd=weekday($i,$pmonth,$pyear);
	switch ($wd){
		case 6: $backcolor="bgcolor=#ffffcc";break;
		case 0: $backcolor="bgcolor=#ffff00";break;
		default: $backcolor="bgcolor=white";
		}
	
	$aelems=unserialize($dutyplan['duty_1_txt']);
	$relems=unserialize($dutyplan['duty_2_txt']);
	$a_pnr=unserialize($dutyplan['duty_1_pnr']);
	$r_pnr=unserialize($dutyplan['duty_2_pnr']);

	echo '
	<tr >
	<td  height=5 '.$backcolor.'><div class="a3"><font face="arial" size=2>'.$i.'</div>
	</td>
	<td height=5 '.$backcolor.'><div class=a3><font face=arial size=2>';
	if (!$wd) echo '<font color=red>';
	echo $LDShortDay[$wd].'</div>
	</td>
	<td height=5 '.$backcolor.'><div class="a3"><font face="arial" size=2>';
	echo '&nbsp;<a href="javascript:popinfo(\''.$a_pnr['ha'.$n].'\')">'.$aelems['a'.$n].'</a></div>
	</td>
	<td height=5 '.$backcolor.'><div class=a3><font face=arial size=2>';
	echo '&nbsp;<a href="javascript:popinfo(\''.$r_pnr['hr'.$n].'\')">'.$relems['r'.$n].'</a></div>
	</td>
	</tr>';
	if ($wd==6)  $wd=-1;
	}
?>

</table>

</td>
</tr>
</table>

	
</td>


<td valign="top">
<a href="doctors-main-pass.php<?php echo URL_APPEND ?>&target=dutyplan&dept_nr=<?php echo $dept_nr.'&pmonth='.$pmonth.'&pyear='.$pyear.'&retpath='.$retpath; ?>"><img <?php echo createLDImgSrc($root_path,'newplan.gif','0') ?> alt="<?php echo $LDNewPlan ?>"></a>
<br>
<a href="<?php echo $rettarget ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  alt="<?php echo $LDClosePlan ?>"></a>
</td>
</tr>
</table>

<p>
<a href="doctors-main-pass.php<?php echo URL_APPEND ?>&target=dutyplan&dept_nr=<?php echo $dept_nr.'&pmonth='.$pmonth.'&pyear='.$pyear.'&retpath='.$retpath; ?>"><img <?php echo createLDImgSrc($root_path,'newplan.gif','0') ?> alt="<?php echo $LDNewPlan ?>"></a>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $rettarget ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClosePlan ?>"></a>
<p>
</ul>

</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor="<?php echo $cfg[bot_bgcolor] ?>" height=70 colspan=2>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td>
</tr>
</table>        
&nbsp;

</FONT>

</BODY>
</HTML>
