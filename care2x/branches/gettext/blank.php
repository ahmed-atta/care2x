<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('include/helpers/inc_environment_global.php');
if(!isset($lang)||!$lang)
{
	if(!$_SESSION['sess_lang']) include('chklang.php');
}

if(file_exists('language/'.$lang.'/lang_'.$lang.'_indexframe.php')) include('language/'.$lang.'/lang_'.$lang.'_indexframe.php');
    else include('language/en/lang_en_indexframe.php')


?>
<?php html_rtl($lang) ?>
<?php 

include_once('include/helpers/inc_charset_fx.php');

echo setCharSet(); 

?>
<head>
 <title>Init Page</title>
</head>
<body>
<font color="990000">
<b><?php echo $LDPlsWaitInit ?></b>
</font>
</body>
</html>
