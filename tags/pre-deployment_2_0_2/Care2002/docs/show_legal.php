<?php
if(file_exists('../language/'.$HTTP_GET_VARS['lang'].'/'.$HTTP_GET_VARS['lang'].'_legal.htm')) include('../language/'.$HTTP_GET_VARS['lang'].'/'.$HTTP_GET_VARS['lang'].'_legal.htm');
	else include('../language/en/en_legal.htm');
?>
