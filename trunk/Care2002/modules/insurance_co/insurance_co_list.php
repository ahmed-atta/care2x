<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','finance.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php'); // load color preferences
/* Load the insurance object */
require_once($root_path.'include/care_api_classes/class_insurance.php');
$ins_obj=new Insurance;

$breakfile='insurance_co_manage.php'.URL_APPEND;

/* Get all the active firms info */
$firms=$ins_obj->getAllActiveFirmsInfo();
	
$bgc=$root_path.'gui/img/skin/default/tableHeaderbg3.gif';
$bgc2='#eeeeee';

?>


<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript">
<!-- 
// -->
</script>

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
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDInsuranceCo :: $LDListAll" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('nursing_ward_mng.php','new')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul>
<?php 
if(is_object($firms)){
?>
<table border=0 cellpadding=2 cellspacing=1>
  <tr>
    <td class=pblock background="<?php echo $bgc ?>"><b><?php echo $LDFirmID ?></b></td>
    <td class=pblock background="<?php echo $bgc ?>"><b><?php echo $LDInsuranceCoName ?></b></td>
    <td class=pblock background="<?php echo $bgc ?>"><b><?php echo $LDMainPhoneNr ?></b></td>
    <td class=pblock background="<?php echo $bgc ?>"><b><?php echo $LDMainFaxNr ?></b></td>
    <td class=pblock background="<?php echo $bgc ?>"><b><?php echo $LDEmailAddress ?></b></td>
</td>
  </tr> 
<?php
	$toggle=0;
	while($firm=$firms->FetchRow()){
		if($toggle) $bgc='#dddddd';
			else $bgc='#efefef';
		$toggle=!$toggle;
?>
  <tr  bgcolor="<?php echo $bgc ?>">
    <td class=pblock><a href="insurance_co_info.php<?php echo URL_APPEND.'&retpath=list&firm_id='.$firm['firm_id']; ?>"><?php echo $firm['firm_id']; ?></a></td>
    <td class=pblock><a href="insurance_co_info.php<?php echo URL_APPEND.'&retpath=list&firm_id='.$firm['firm_id']; ?>"><?php echo $firm['name']; ?></a></td>
    <td class=pblock><?php echo $firm['phone_main']; ?></td>
    <td class=pblock><?php echo $firm['fax_main']; ?></td>
    <td class=pblock><?php if($firm['addr_email']){ echo '<img '.createComIcon($root_path,'email.gif','0').'>'; ?> <a href="mailto:<?php echo $firm['addr_email']; ?>"><?php echo $firm['addr_email']; ?></a><?php } ?></td>
</td>
  </tr> 
<?php
	}
?>
  </table>
<?php
}
?>
<p>
</FONT>
<form action="insurance_co_new.php" method="post">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="submit" value="<?php echo $LDNeedEmptyFormPls ?>">
</form>
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
