<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('departments.php');
define('LANG_FILE','doctors.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');


/*
switch($retpath)
{
	case "docs": $breakfile='doctors.php'.URL_APPEND; break;
	case "op": $breakfile='op-doku.php'.URL_APPEND; break;
}
*/
if (!empty($HTTP_SESSION_VARS['sess_path_referer'])){
	$breakfile=$HTTP_SESSION_VARS['sess_path_referer'];
} else {
	/* default startpage */
	$breakfile = 'doctors.php';
}
$breakfile=$root_path.$breakfile.URL_APPEND;

$pday=date(j);
$pmonth=date(n);
$pyear=date(Y);
$abtarr=array();
$abtname=array();
$datum=date("d.m.Y");

if(!$hilitedept)
{
	if($dept_nr) $hilitedept=$dept_nr;
	else
	{
		include($root_path.'include/inc_resolve_dept_dept.php');
		if($deptOK) $hilitedept=$dept_nr;
	}
}
/* Load the department list with oncall doctors */
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$dept_DOC=$dept_obj->getAllActiveWithDOC();

require_once($root_path.'include/care_api_classes/class_personell.php');
$pers_obj=new Personell;
$quicklist=&$pers_obj->getDOCQuicklist($dept_DOC,$pyear,$pmonth);

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<style type="text/css">
	A:link  {text-decoration: none; }
	A:hover {text-decoration: none; }
	A:active {text-decoration: none;}
	A:visited {text-decoration: none;}
</style>

<script language="javascript">
<!-- 
  var urlholder;
function popinfo(l,d)
{
	urlholder="doctors-dienstplan-popinfo.php<?php echo URL_REDIRECT_APPEND ?>&nr="+l+"&dept_nr="+d+"&user=<?php echo $aufnahme_user.'"' ?>;
	
	infowin=window.open(urlholder,"dienstinfo","width=400,height=300,menubar=no,resizable=yes,scrollbars=yes");

}

-->
</script>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</HEAD>
<BODY  bgcolor="silver" alink="navy" vlink="navy" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>
<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo $LDDocsOnDuty ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('docs_duty_quickview.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor="<?php echo $cfg['body_bgcolor']; ?>" colspan=2>
	<table  cellpadding="2" cellspacing=0 border="0" >
	<tr bgcolor="aqua" align=center>
<?php

for($j=0;$j<sizeof($LDTabElements);$j++)
	echo '<td><font face="verdana,arial" size="2" ><b>&nbsp; '.$LDTabElements[$j].' &nbsp;&nbsp;</b></td>';
echo '
	</tr>';

$toggler=0;


while(list($x,$v)=each($dept_DOC)){
	
	if(in_array($v['nr'],$quicklist)){
		if($dutyplan=$pers_obj->getDOCDutyplan($v['nr'],$pyear,$pmonth)){
	
			$a=unserialize($dutyplan['duty_1_txt']);	
			$r=unserialize($dutyplan['duty_2_txt']);	
			$ha=unserialize($dutyplan['duty_1_pnr']);	
			$hr=unserialize($dutyplan['duty_2_pnr']);	
			$DOC_1=$pers_obj->getPersonellInfo($ha['ha'.(date('d')-1)]);
			$DOC_2=$pers_obj->getPersonellInfo($hr['hr'.(date('d')-1)]);
		}
	
	}else{
		if(isset($a)) unset($a);
		if(isset($r)) unset($r);
		if(isset($ha)) unset($ha);
		if(isset($hr)) unset($hr);
		if(isset($DOC_1)) unset($DOC_1);
		if(isset($DOC_2)) unset($DOC_2);
	}

	
	$bold='';
	$boldx='';
	if($hilitedept==$v['nr']) 	{ echo '<tr bgcolor="yellow">'; $bold="<font color=\"red\" size=2><b>";$boldx="</b></font>"; } 
	else
		if ($toggler==0) 
			{ echo '<tr bgcolor="#cfcfcf">'; $toggler=1;} 
				else { echo '<tr bgcolor="#f6f6f6">'; $toggler=0;}
	echo '<td ><font face="verdana,arial" size="1" >&nbsp;'.$bold;
	if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) echo $$v['LD_var'];
	 	else echo $v['name_formal'];
	echo $boldx.'&nbsp;</td><td >&nbsp;<font face="verdana,arial" size="2" >
	<img '.createComIcon($root_path,'mans-gr.gif','0').'>&nbsp;<a href="javascript:popinfo(\''.$ha['ha'.(date('d')-1)].'\',\''.$v['nr'].'\')" title="Click für mehr Info."><b>';
	//if ($aelems[l]!="") echo $aelems[l].', ';
	//echo $aelems[f].'</b></a></td>';
	if(in_array($v['nr'],$quicklist)){echo $DOC_1['name_last'].', '.$DOC_1['name_first']; }
	echo '</b></a></td>';
	echo '<td><font face="verdana,arial" size="2" >';
	if ($a['a'.(date('d')-1)]!='') 
	{
		echo ' <font color=red> '.$DOC_1['funk1'].'</font> / '.$DOC_1['inphone1'];
	}
	echo '&nbsp;';
	echo '</td><td ><font face="verdana,arial" size="2" >
	<img '.createComIcon($root_path,'mans-red.gif','0').'>&nbsp;<a href="javascript:popinfo(\''.$hr['hr'.(date('d')-1)].'\',\''.$v['nr'].'\')" title="Click für mehr Info."><b>';
	if(in_array($v['nr'],$quicklist)){echo $DOC_2['name_last'].', '.$DOC_2['name_first'];}
	echo '</b></a></td>';
	echo '<td><font face="verdana,arial" size="2" >';
	if ($r['r'.(date('d')-1)]!='') 
	{
		echo ' <font color=red> '.$DOC_2['funk1'].'</font> / '.$DOC_2['inphone1'];
	}
	echo '&nbsp;';
	echo '</td><td >&nbsp; <a href="doctors-dienstplan.php'.URL_APPEND.'&dept_nr='.$v['nr'].'&retpath=qview">
	<button onClick="javascript:window.location.href=\'doctors-dienstplan.php'.URL_REDIRECT_APPEND.'&dept_nr='.$v['nr'].'&retpath=qview\'"><img '.createComIcon($root_path,'new_address.gif','0','absmiddle').' alt="'.$LDShowActualPlan.'" ><font size=1> '.$LDShow.'</font></button></a> </td></tr>';
	echo "\n";

	}
echo '</table>';
?>
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>">
</a></FONT>
<p>
</td>
</tr>
</table>        
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</BODY>
</HTML>
