<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.0 - 2004-05-16
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.org, elpidio@care2x.net
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='departments.php';
$lang_tables[]='phone.php';
$lang_tables[]='doctors.php';
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_department.php');

$breakfile='dept_manage.php'.URL_APPEND;

if($pday=='') $pday=date('d');
if($pmonth=='') $pmonth=date('m');
if($pyear=='') $pyear=date('Y');
$t_date=$pday.'.'.$pmonth.'.'.$pyear;

# Get department infos
$dept_obj=new Department;

$deptarray=$dept_obj->getAll();
$depttypes=$dept_obj->getTypes();

$dept=$dept_obj->getDeptAllInfo($dept_nr);

$dept_info=$dept_obj->getTypeInfo($dept['type']);
# Get department phone infos
$phone=$dept_obj->getPhoneInfo($dept_nr);
?>


<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
<style type="text/css" name="formstyle">
td.pblock{ font-family: verdana,arial; font-size: 12}

div.box { border: solid; border-width: thin; width: 100% }

div.pcont{ margin-left: 3; }

</style>

</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> onLoad="if (window.focus) window.focus()" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; 
<?php 
	echo $LDDepartment.' :: ';
	if(isset($$dept['LD_var'])&&!empty($$dept['LD_var'])) echo $$dept['LD_var'];
		else echo $dept['name_formal'];
?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('dept_info.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul>
<?php if($rows) : ?>

<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"><font face="Verdana, Arial" size=3 color="#880000">
<b><?php echo str_replace("~station~",strtoupper($station),$LDStationExists) ?></b></font><p>
<?php endif ?>
<font face="Verdana, Arial" size=-1><?php echo $LDEnterAllFields ?>

<form action="dept_new.php" method="post" name="newstat">

<table border=0 cellpadding=4>
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"></font><?php echo $LDFormalName ?>: </td>
    <td class=pblock>
	<?php 	
		if(isset($$dept['LD_var'])&&!empty($$dept['LD_var'])) echo $$dept['LD_var'];
				else echo $dept['name_formal'];
 	?>
</td>
  </tr> 
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"></font><?php echo $LDInternalID ?>: </td>
    <td class=pblock><?php echo $dept['id'] ?>
</td>
  </tr> 

<tr>
    <td class=pblock align=right bgColor="#eeeeee"></font><?php echo $LDTypeDept ?>: </td>
    <td class=pblock><?php 
								if(isset($$dept_info['LD_var'])&&!empty($$dept_info['LD_var'])) echo $$dept_info['LD_var'];
									else echo $dept_info['name'];
							?>
</td>
  </tr>
  
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDDescription ?>: </td>
    <td class=pblock><?php echo htmlspecialchars(nl2br($dept['description'])) ?>
</td>
  </tr>
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"></font><?php echo $LDIsSubDept ?>: </td>
    <td class=pblock><?php 
								if($dept['is_sub_dept']) echo $LDYes;
									else echo $LDNo;
							?>
</td>
  </tr> 
<tr>
    <td class=pblock align=right bgColor="#eeeeee"></font><?php echo $LDParentDept ?>: </td>
    <td class=pblock><?php 
								if($dept['is_sub_dept']){
									$info=$dept_obj->getDeptAllInfo($dept['parent_dept_nr']);
									if(isset($$info['LD_var'])&&!empty($$info['LD_var'])) echo $$info['LD_var'];
										else echo $info['name_formal'];
								}
							?>
</td>
  </tr>
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"></font><?php echo $LDLangVariable ?>: </td>
    <td class=pblock><?php echo $dept['LD_var'] ?>
</td>
  </tr> 
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDShortName ?>: </td>
    <td class=pblock><?php echo $dept['name_short'] ?>
</td>
  </tr> 
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDAlternateName ?>: </td>
    <td class=pblock><?php echo $dept['name_alternate'] ?>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"></font><?php echo $LDDoesSurgeryOp ?>: </td>
    <td class=pblock><?php 
								if($dept['does_surgery']) echo $LDYes;
									else echo $LDNo;
							?>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"></font><?php echo $LDAdmitsInpatients ?>: </td>
    <td class=pblock><?php 
								if($dept['admit_inpatient']) echo $LDYes;
									else echo $LDNo;
							?>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"></font><?php echo $LDAdmitsOutpatients; ?>: </td>
    <td class=pblock><?php 
								if($dept['admit_outpatient']) echo $LDYes;
									else echo $LDNo;
							?>
</td>
  </tr> 

    <tr>
    <td class=pblock align=right bgColor="#eeeeee"></font><?php echo $LDBelongsToInst ?>: </td>
    <td class=pblock><?php 
								if($dept['this_institution']) echo $LDYes;
									else echo $LDNo;
							?>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDWorkHrs ?>: </td>
    <td class=pblock><?php echo $dept['work_hours'] ?>
</td>
  </tr> 

  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDConsultationHrs ?>: </td>
    <td class=pblock><?php echo $dept['consult_hours'] ?>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDTelephone ?> 1: </td>
    <td class=pblock><?php echo $phone['inphone1'] ?>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDTelephone ?> 2: </td>
    <td class=pblock><?php echo $phone['inphone2'] ?>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDTelephone ?> 3: </td>
    <td class=pblock><?php echo $phone['inphone3'] ?>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo "$LDBeeper ($LDOnCall)" ?> 1: </td>
    <td class=pblock><?php echo $phone['funk1'] ?>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo "$LDBeeper ($LDOnCall)" ?> 2: </td>
    <td class=pblock><?php echo $phone['funk2'] ?>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDSigLine ?>: </td>
    <td class=pblock><?php echo $dept['sig_line'] ?>
</td>
  </tr> 
 
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDSigStampTxt ?>: </td>
    <td class=pblock><?php echo nl2br($dept['sig_stamp']); ?>
</td>
  </tr>
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDDeptLogo ?>: </td>
    <td class=pblock><?php
									if(file_exists($root_path.'gui/img/logos_dept/dept_'.$dept_nr.'.'.$dept['logo_mime_type'])) echo '<img src="'.$root_path.'gui/img/logos_dept/dept_'.$dept_nr.'.'.$dept['logo_mime_type'].'">'; 
							?>
</td>
  </tr> 

 
</table>
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept['nr']; ?>">
<input type="hidden" name="mode" value="select">
<input type="submit" value="<?php echo $LDUpdateData; ?>">
</form>
<p>

<a href="javascript:history.back()"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border="0"></a>
</FONT>

</ul>

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
