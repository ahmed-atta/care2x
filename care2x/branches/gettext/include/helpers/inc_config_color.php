<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr("inc_config_color.php",$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');

/*------end------*/

/* Load user config API. Get the user config data from db */

if(!empty($_COOKIE['ck_config'])){
	$ck_userid=$_COOKIE['ck_config'];
}else {
	$ck_userid='';
}
$cfg=array();
include_once(CARE_BASE . '/include/core/class_userconfig.php');
$cfg_obj=new UserConfig;

if(is_object($cfg_obj)) {
	$cfg_obj->getConfig($ck_userid);
	$cfg=&$cfg_obj->buffer;
}
?>
