<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('include/helpers/inc_environment_global.php');
if(!isset($lang)||!$lang) {
	if(!$_SESSION['sess_lang']) include('/include/helpers/chklang.php');
}

if(file_exists('language/'.$lang.'/lang_'.$lang.'_indexframe.php')) 
	include('language/'.$lang.'/lang_'.$lang.'_indexframe.php');
else 
	include('language/en/lang_en_indexframe.php')


?>
<html>

<head>
 <title>Init Page</title>
</head>
<body>
<font color="990000">
<b><?php echo $LDPlsWaitInit ?></b>
</font>
</body>
</html>