<?php
/**
*  These functions do several routines for editing
*/

/**
* deactivateHotHtml disables the <script> <input> <form> tags by inserting a dot
*/
function deactivateHotHtml($str)
{
    $str=eregi_replace('script','script.',$str);    
	$str=eregi_replace('form','form.',$str);	
	$str=eregi_replace('input','input.',$str);
	
	return $str;
}

?>
