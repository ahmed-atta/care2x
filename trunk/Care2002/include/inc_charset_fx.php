<?php
/**
* setCharSet returns the meta code to set the charset of the page based on the 
* language variable $lang.
* param $param_lang = the language currently used by the script
* global $lang = in case the parameter is not used
* return = the meta code with the appropriate charset
*/

function setCharSet($param_lang='')
{
   global $lang;
   
   if(!$param_lang && $lang) $param_lang=$lang;
   
   switch ($param_lang)
   {
       case 'pl'     : $iso='iso-8859-2'; break;
       case 'cs-iso' : $iso='iso-8859-2'; break;
       case 'fr'     : $iso='iso-8859-1'; break;
	   
	   default : $iso='iso-8859-1';
   }
   
   return '<meta http-equiv="Content-Type" content="text/html; charset='.$iso.'">';
}

	
?>
