<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.08 - 2003-10-05
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/

# Default maximum values for the time out time
$def_max_hours=0; 
$def_max_mins=15; # 15 minutes
$def_max_secs=59; # 59 seconds

$lang_tables[]='startframe.php';
$lang_tables[]='date_time.php';
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$breakfile='edv-system-admi-welcome.php'.URL_APPEND.'&target=currency_admin';
$thisfile=basename(__FILE__);

$GLOBAL_CONFIG=array();
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
# Create object linking our global config array to the object
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);

# Save data if save mode
if(isset($mode)&&$mode=='save'){

	# Validate time values
	if(!is_numeric($HTTP_POST_VARS['thours'])||$HTTP_POST_VARS['thours']>24) $HTTP_POST_VARS['thours']=0;
	if(!is_numeric($HTTP_POST_VARS['tmins'])||$HTTP_POST_VARS['tmins']>59||$HTTP_POST_VARS['tmins']<1) $HTTP_POST_VARS['tmins']=$def_max_mins;
	if(!is_numeric($HTTP_POST_VARS['tsecs'])||$HTTP_POST_VARS['tsecs']>59) $HTTP_POST_VARS['tsecs']=$def_max_tsecs;
	
	# combine the values to final format HoursMinsSecs
	//$HTTP_POST_VARS['timeout_time']=$HTTP_POST_VARS['thours'].$HTTP_POST_VARS['tmins'].$HTTP_POST_VARS['tsecs'];
	$HTTP_POST_VARS['timeout_time']=date('His',mktime($HTTP_POST_VARS['thours'],$HTTP_POST_VARS['tmins'],$HTTP_POST_VARS['tsecs'],1,1,1971));
	
	$filter='timeout_'; # The index filter
	$numeric=FALSE; # Values are not strictly numeric
	$addslash=FALSE; # Slashes should be added to the stored values
	# Save the configuration
	$glob_obj->saveConfigArray($HTTP_POST_VARS,$filter,$numeric,'',$addslash);
	# Loop back to self to get the newly stored values
	header("location:$thisfile".URL_REDIRECT_APPEND."&save_ok=1");
	exit;
# Else get current global data
}else{ 
	$glob_obj->getConfig('timeout_%');
	# Parse the time value to hours mins and secs
	$buffer='000000'.$GLOBAL_CONFIG['timeout_time'];
	$thours=substr($buffer,-6,2);
	$tmins=substr($buffer,-4,2);
	$tsecs=substr($buffer,-2);
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php 
echo setCharSet(); 
?>
<?php 
require($root_path.'include/inc_js_gethelp.php'); 
require($root_path.'include/inc_css_a_hilitebu.php');
?> 

 
</HEAD>

<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<?php echo $cfg['body_bgcolor'];?>>


<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?php echo $LDTimeOut ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('timeout.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor'];?> colspan=2>
<br>
<ul>
<FONT    SIZE=2  FACE="verdana,Arial">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
</FONT><FONT    SIZE=3 color=#000000 FACE="Arial"><p>
<?php
if(isset($save_ok)&&$save_ok) echo '<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'><FONT    SIZE=3 color=#800000 FACE="Arial">'.$LDDataSaved.'<p></font>';

echo $LDEnterInfo;
?></font><p>
<FONT    SIZE=-1  FACE="Arial">
<form action="<?php echo $thisfile ?>" method="post" name="quickinfo">
<table border=0 cellspacing=1 cellpadding=5>  
<tr valign=top>
	<td bgcolor="#e9e9e9" align="right"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><nobr><?php echo $LDTimeOutActive ?></nobr></b> </FONT></td>
	<td bgcolor="#f9f9f9"><FONT  color="#000000" FACE="verdana,arial" size=2>
		<input type="radio" name="timeout_inactive" value="0" <?php if(!$GLOBAL_CONFIG['timeout_inactive']) echo 'checked' ?>> <nobr><?php echo $LDYes ?>&nbsp;&nbsp;&nbsp;
		<input type="radio" name="timeout_inactive" value="1" <?php if($GLOBAL_CONFIG['timeout_inactive']) echo 'checked' ?>> <?php echo $LDNo ?></nobr>
	</td>  
	<td bgcolor="#e9e9e9" ><FONT  FACE="verdana,arial" size=2><?php echo $LDTimeOutTxt ?></FONT></td>
	</tr>
<tr valign=top>
	<td bgcolor="#e9e9e9" align="right"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><nobr><?php echo $LDTimeOutTime ?></nobr></b> </FONT></td>
	<td bgcolor="#f9f9f9"><FONT  FACE="verdana,arial" size=2><nobr>
	<input type="text" name="thours" size=2 maxlength=2 value=<?php echo $thours ?>> <?php echo $LDHours ?>&nbsp;
 	<input type="text" name="tmins" size=2 maxlength=2 value=<?php echo $tmins ?>> <?php echo $LDMinutes ?>&nbsp;
	<input type="text" name="tsecs" size=2 maxlength=2 value=<?php echo $tsecs ?>> <?php echo $LDSeconds ?></nobr>

	</td>  
	<td bgcolor="#e9e9e9"><FONT   FACE="verdana,arial" size=2><?php echo $LDTimeOutTimeTxt ?></FONT></td>
	</tr>
</table>
<p>
<?php if($item_no) $save_button='update.gif'; else $save_button='savedisc.gif'; ?>
<input type="image" <?php echo createLDImgSrc($root_path,$save_button,'0') ?>>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
<?php if($item_no) : ?>
<a href="<?php echo $thisfile.''.URL_APPEND.'&from='.$from ?>"><img <?php echo createLDImgSrc($root_path,'newcurrency.gif','0') ?>></a>
<?php endif ?>
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="save">
</form>
<p>
</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
