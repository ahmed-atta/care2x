<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
if(!lang)
{
 	$ck_lang_buffer="ck_lang$sid";
	if(!$HTTP_COOKIE_VARS[$ck_lang_buffer]) include("chklang.php");
	else $lang=$HTTP_COOKIE_VARS[$ck_lang_buffer];
}

if(file_exists("language/".$lang."/lang_".$lang."_indexframe.php")) include("language/".$lang."/lang_".$lang."_indexframe.php");
    else include("language/en/lang_en_indexframe.php")
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Init Page</title>
</head>
<body>
<font color="990000">
<b><?php echo $LDPlsWaitInit ?></b>
</font>
</body>
</html>
