<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
$HTTP_SESSION_VARS['sess_path_referer']=str_replace($doc_root.'/','',__FILE__);
//echo __FILE__;

header("Location:".$root_path."modules/news/start_page.php?sid=$sid&lang=$lang");
exit;
?>
