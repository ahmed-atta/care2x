<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_config_color.php",$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

$usedefault=0;

if(isset($HTTP_COOKIE_VARS["ck_config"])&&(!empty($HTTP_COOKIE_VARS["ck_config"])))
{
$path="../userconfig/".$HTTP_COOKIE_VARS["ck_config"];
if(file_exists($path)) $cfg=get_meta_tags($path);
else $usedefault=1;
}
else $usedefault=1;

if($usedefault)
{
	$path="../userconfig/default/default.cfg";
	$cfg=get_meta_tags($path);
}
?>
