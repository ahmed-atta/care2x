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
define('LANG_FILE','doctors.php');
if($HTTP_SESSION_VARS['sess_user_origin']=='personell_admin'){
	$local_user='aufnahme_user';
	$breakfile=$root_path.'modules/personell_admin/personell_register_show.php'.URL_APPEND.'&target=personell_reg&personell_nr='.$nr;
}else{
	$local_user='ck_doctors_dienstplan_user';
	if (!empty($HTTP_SESSION_VARS['sess_path_referer'])){
		$breakfile=$root_path.$HTTP_SESSION_VARS['sess_path_referer'];
	} else {
		/* default startpage */
		$breakfile = $root_path.'doctors.php'.URL_APPEND;
	}
}
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php'); // load color preferences

/*
switch($retpath)
{
	case "docs": $breakfile='doctors.php'.URL_APPEND; break;
	case "op": $breakfile='op-doku.php'.URL_APPEND; break;
}
*/

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

switch($target){
	case 'plist': $title=$LDCreateDoctorsList;
					  $fileforward='doctors-dienst-personalliste.php'.URL_APPEND.'&retpath='.$retpath;
					  break;
	default: $title=$LDMakeDutyPlan;
					  $fileforward='doctors-dienstplan-planen.php'.URL_APPEND.'&retpath='.$retpath;
					  break;
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
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo $title ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('docs_duty_quickview.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor="<?php echo $cfg['body_bgcolor']; ?>" colspan=2>

<ul>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"></td>

	<td colspan=4><center>
	<font face=arial color="#990000" size=4>
	<?php echo $LDPlsSelectDept; ?>
	</center>
</td>

  </tr>
</table>

	<table  cellpadding="2" cellspacing=0 border="0">
<?php

$toggler=0;


while(list($x,$v)=each($dept_DOC)){
		
	$bold='';
	$boldx='';
	if($hilitedept==$v['nr']) 	{ echo '<tr bgcolor="yellow">'; $bold="<font color=\"red\" size=2><b>";$boldx="</b></font>"; } 
	else
		if ($toggler==0) 
			{ echo '<tr bgcolor="#cfcfcf">'; $toggler=1;} 
				else { echo '<tr bgcolor="#f6f6f6">'; $toggler=0;}
	echo '<td ><font face="verdana,arial" size="2" >&nbsp;'.$bold.$v['name_formal'].$boldx.'&nbsp;</td>';
	echo '<td >&nbsp; <a href="'.$fileforward.'&dept_nr='.$v['nr'].'&nr='.$nr.'">
	<img '.createLDImgSrc($root_path,'ok_small.gif','0','absmiddle').' alt="'.$LDShowActualPlan.'" ></a> </td></tr>';
	echo "\n";

	}
echo '</table>';
?>
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCloseAlt ?>">
</a></FONT>
<p>
</td>
</tr>
</table>        
</ul>
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</BODY>
</HTML>
