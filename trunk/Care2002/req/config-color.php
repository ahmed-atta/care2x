<?
if($ck_config)
{
$path="../userconfig/".$ck_config;
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
