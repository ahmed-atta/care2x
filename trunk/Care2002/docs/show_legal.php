<?php
if(file_exists('../language/'.$HTTP_GET_VARS['lang'].'/'.$HTTP_GET_VARS['lang'].'_legal.htm')) {
    $page = '../language/'.$HTTP_GET_VARS['lang'].'/'.$HTTP_GET_VARS['lang'].'_legal.htm';
} else {
	$page = '../language/en/en_legal.htm';
}

header("Location: $page");
exit;
	
?>
