<?php

function cleanString($dirty_str)
{

    if(!empty($dirty_str))
    {
        $clean_str=str_replace(' ','',strtolower($dirty_str));
        $clean_str=strtr($clean_str,"/%&!?.*'#[]{}`��()_-;:+��@|<>^�ߵ,=����������������������濹","~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~aouaeiouaeioueouiacaolaszczs");
        $clean_str=str_replace('~','',$clean_str);
        $clean_str=str_replace("\"","",$clean_str);
        $clean_str=str_replace('\\','',$clean_str);
        $clean_str=str_replace('\$','',$clean_str);
	
	    return $clean_str;
    }
}
?>
