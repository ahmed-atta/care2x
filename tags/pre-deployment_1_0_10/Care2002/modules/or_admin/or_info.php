<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.09 - 2003-11-25
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='departments.php';
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_oproom.php');
require_once($root_path.'include/inc_date_format_functions.php');

$breakfile=$root_path.'modules/system_admin/edv-system-admi-welcome.php'.URL_APPEND	;

# Create the OR object
$OR_obj=& new OPRoom;

# Get the OR info
$OR_info=$OR_obj->ORRecordInfo($nr);
if(is_object($OR_info)){
	$ORoom=$OR_info->FetchRow();
	//echo $OR_obj->getLastQuery();
}else{
	$ORoom=array();
}
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
	echo $LDOR.' :: '.$ORoom['room_nr'];
?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('or_info.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul>
<?php if($rows) : ?>

<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"><font face="Verdana, Arial" size=3 color="#880000">
<b><?php echo str_replace("~station~",strtoupper($station),$LDStationExists) ?></b></font><p>
<?php endif ?>
<font face="Verdana, Arial" size=-1><?php echo $LDEnterAllFields ?>

<form action="or_new.php" method="post" name="newstat">

<table border=0 cellpadding=4>
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"></font><?php echo $LDORNr ?>: </td>
    <td class=pblock bgColor="#f9f9f9">
	<?php 	
		echo $ORoom['room_nr'];
 	?>
</td>
  </tr> 
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"></font><?php echo $LDOPTableNr ?>: </td>
    <td class=pblock bgColor="#f9f9f9"><?php echo $ORoom['nr_of_beds'] ?>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDDateCreation ?>: </td>
    <td class=pblock bgColor="#f9f9f9"><?php echo formatDate2Local($ORoom['date_create'],$date_format) ?>
</td>
  </tr>
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDORName ?>: </td>
    <td class=pblock bgColor="#f9f9f9"><?php echo $ORoom['info'] ?>
</td>
  </tr>
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDOwnerWard ?>: </td>
    <td class=pblock bgColor="#f9f9f9">
<?php
if(!empty($ORoom['ward_id'])){
	if(defined('SHOW_COMBINE_WARDIDNAME')&&SHOW_COMBINE_WARDIDNAME){
		$buffer= '[ '.$ORoom['ward_id'].' ] '.$ORoom['wardname'];
	}else{
		if(defined('SHOW_FULL_WARDNAME')&&SHOW_FULL_WARDNAME) $buffer= $ORoom['wardname'];
			else $buffer= $ORoom['ward_id'];
	}
	echo $buffer;
}else{
	echo '&nbsp;';
}
 ?>
</td>
  </tr>

<tr>
    <td class=pblock align=right bgColor="#eeeeee"></font><?php echo $LDOwnerDept ?>: </td>
    <td class=pblock bgColor="#f9f9f9"><?php 
								if(isset($$ORoom['LD_var'])&&!empty($$ORoom['LD_var'])) echo $$ORoom['LD_var'];
									else echo $ORoom['deptname'];
							?>
</td>
  </tr>
   
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"></font><?php echo $LDTempClosed ?>: </td>
    <td class=pblock bgColor="#f9f9f9"><?php 
								if($ORoom['is_temp_closed']) echo $LDYes;
									else echo $LDNo;
							?>
</td>
  </tr> 
 
</table>
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="OR_nr" value="<?php echo $ORoom['room_nr']; ?>">
<input type="hidden" name="nr" value="<?php echo $ORoom['nr']; ?>">
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
