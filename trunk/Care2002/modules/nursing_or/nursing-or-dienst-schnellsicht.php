<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.06 - 2003-08-06
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/

# To deactivate the cache, set $force_no_cache to true
$force_no_cache=true;

$lang_tables[]='departments.php';
$lang_tables[]='prompt.php';
define('LANG_FILE','or.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

if (!empty($HTTP_SESSION_VARS['sess_path_referer'])){
	$breakfile=$HTTP_SESSION_VARS['sess_path_referer'];
} else {
	/* default startpage */
	$breakfile = $root_path.'main/op-doku.php';
}

$breakfile=$root_path.$breakfile.URL_APPEND;
$thisfile=basename(__FILE__);

switch($retpath)
{
	case "docs": $breakfile='doctors.php'.URL_APPEND; break;
	case "op": $breakfile='op-doku.php'.URL_APPEND; break;
}


$pday=date(j);
$pmonth=date(n);
$pyear=date(Y);
$abtarr=array();
$abtname=array();
$datum=date("d.m.Y");

# Prepare the date. We need to consider the early morning hours or until the DOC_CHANGE_TIME value has passed
if(date('H.i')<NOC_CHANGE_TIME){
	$plan_date=date('Y-m-d',mktime(0,0,0,date('m'),date('d')-1,date('Y')));
	$plan_day=date('d',mktime(0,0,0,date('m'),date('d')-1,date('Y')));
}else{
	$plan_date=date('Y-m-d');
	$plan_day=date('d');
}


# Get the cached plan
if(!$force_no_cache){
	include_once($root_path.'include/care_api_classes/class_core.php');
	$core=new Core;
	$cached_plan='';
	if(!$is_cached=$core->getDBCache('NOCS_'.$plan_date,$cached_plan)) $force_no_cache=true;
}	

if($force_no_cache){
	if(!$hilitedept){
		if($dept_nr) $hilitedept=$dept_nr;
	}
	# Load the department list with oncall doctors 
	include_once($root_path.'include/care_api_classes/class_department.php');
	$dept_obj=new Department;
	$dept_OC=$dept_obj->getAllActiveWithNOC();
	include_once($root_path.'include/care_api_classes/class_personell.php');
	$pers_obj=new Personell;
	$quicklist=&$pers_obj->getNOCQuicklist($dept_OC,$pyear,$pmonth);
}

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
	urlholder="nursing-or-dienstplan-popinfo.php<?php echo URL_REDIRECT_APPEND ?>&nr="+l+"&dept_nr="+d+"&user=<?php echo $aufnahme_user.'"' ?>;
	
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
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+1  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDORNOC :: $LDQuickView"; ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('op_duty.php','quick')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
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

if(!$force_no_cache&&$is_cached){

/*	echo '<tr>
	<td colspan=6><font face="verdana,arial" size=2> <img '.createComIcon($root_path,'warn.gif','0').'> <font color=red>'.$LDCachedInfo.'</font> <a href="'.$thisfile.URL_APPEND.'&force_no_cache=1&retpath='.$retpath.'">'.$LDClkNoCache.'</a>
	</td>
	</tr>';
*/
	$cached_plan=str_replace('URLAPPEND',URL_APPEND,$cached_plan);
	$cached_plan=str_replace('IMGALT',$LDShowActualPlan,$cached_plan);
	$cached_plan=str_replace('SHOWBUTTON',$LDShow,$cached_plan);
	echo str_replace('URLREDIRECTAPPEND',URL_REDIRECT_APPEND,$cached_plan);
}else{

	$toggler=0;

	# Start generating the NOC list
	$temp_out='';

	while(list($x,$v)=each($dept_OC)){
	
	if(in_array($v['nr'],$quicklist)){
		if($dutyplan=$pers_obj->getNOCDutyplan($v['nr'],$pyear,$pmonth)){
	
			$a=unserialize($dutyplan['duty_1_txt']);	
			$r=unserialize($dutyplan['duty_2_txt']);	
			$ha=unserialize($dutyplan['duty_1_pnr']);	
			$hr=unserialize($dutyplan['duty_2_pnr']);	
			$OC_1=$pers_obj->getPersonellInfo($ha['ha'.($plan_day-1)]);
			$OC_2=$pers_obj->getPersonellInfo($hr['hr'.($plan_day-1)]);
		}
	
	}else{
		if(isset($a)) unset($a);
		if(isset($r)) unset($r);
		if(isset($ha)) unset($ha);
		if(isset($hr)) unset($hr);
		if(isset($OC_1)) unset($OC_1);
		if(isset($OC_2)) unset($OC_2);
	}

	
	$bold='';
	$boldx='';
	if($hilitedept==$v['nr']) 	{ $temp_out.='<tr bgcolor="yellow">'; $bold="<font color=\"red\" size=2><b>";$boldx="</b></font>"; } 
	else
		if ($toggler==0) 
			{ $temp_out.='<tr bgcolor="#cfcfcf">'; $toggler=1;} 
				else { $temp_out.='<tr bgcolor="#f6f6f6">'; $toggler=0;}
	$temp_out.='<td ><font face="verdana,arial" size="1" >&nbsp;'.$bold;
				
	//echo '<td ><font face="verdana,arial" size="1" >&nbsp;'.$bold.$v['name_formal'].$boldx.'&nbsp;</td><td >&nbsp;<font face="verdana,arial" size="2" >
	
	if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) $temp_out.=$$v['LD_var'];
	 	else $temp_out.=$v['name_formal'];
	$temp_out.=$boldx.'&nbsp;</td><td >&nbsp;<font face="verdana,arial" size="2" >
	<img '.createComIcon($root_path,'mans-gr.gif','0').'>&nbsp;';
	
	//if ($aelems[l]!="") echo $aelems[l].', ';
	//echo $aelems[f].'</b></a></td>';
	if(in_array($v['nr'],$quicklist)&&$OC_1['name_last']){$temp_out.='<a href="javascript:popinfo(\''.$ha['ha'.(date('d')-1)].'\',\''.$v['nr'].'\')" title="Click für mehr Info."><b>'.$OC_1['name_last'].', '.$OC_1['name_first'].'</b></a>'; }
	$temp_out.='</td>
	<td><font face="verdana,arial" size="2" >';
	if ($a['a'.(date('d')-1)]!='') 
	{
		$temp_out.=' <font color=red> '.$OC_1['funk1'].'</font>';
		if($OC_1['inphone1']) $temp_out.=' / '.$OC_1['inphone1'];
	}
	$temp_out.='&nbsp;
	</td><td ><font face="verdana,arial" size="2" >
	<img '.createComIcon($root_path,'mans-red.gif','0').'>&nbsp;';
	if(in_array($v['nr'],$quicklist)&&$OC_2['name_last']){$temp_out.='<a href="javascript:popinfo(\''.$hr['hr'.(date('d')-1)].'\',\''.$v['nr'].'\')" title="Click für mehr Info."><b>'.$OC_2['name_last'].', '.$OC_2['name_first'].'</b></a>';}
	$temp_out.='</td>
	<td><font face="verdana,arial" size="2" >';
	if ($r['r'.(date('d')-1)]!='') 
	{
		$temp_out.=' <font color=red> '.$OC_2['funk1'].'</font>';
		if($OC_2['inphone1']) $temp_out.=' / '.$OC_2['inphone1'];
	}

	$temp_out.='&nbsp;
	</td><td >&nbsp; <a href="nursing-or-dienstplan.phpURLAPPEND&dept_nr='.$v['nr'].'&retpath=qview">
	<button onClick="javascript:window.location.href=\'nursing-or-dienstplan.phpURLREDIRECTAPPEND&dept_nr='.$v['nr'].'&retpath=qview\'"><img '.createComIcon($root_path,'new_address.gif','0','absmiddle').' alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr>';
}
# Save in cache 
$dept_obj->saveDBCache('NOCS_'.date('Y-m-d'),addslashes($temp_out));
# Display list
$temp_out=str_replace('URLAPPEND',URL_APPEND,$temp_out);
$temp_out=str_replace('IMGALT',$LDShowActualPlan,$temp_out);
$temp_out=str_replace('SHOWBUTTON',$LDShow,$temp_out);
echo str_replace('URLREDIRECTAPPEND',URL_REDIRECT_APPEND,$temp_out);
}
?>
</table>
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
