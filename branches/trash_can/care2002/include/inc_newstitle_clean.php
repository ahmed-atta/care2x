<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_drg_entry_save.php",$PHP_SELF)) 
	die("<meta http-equiv='refresh' content='0; url=../'>");
/*------end------*/

if(isset($newstitle)&&!empty($newstitle))
{
    $titlebuf=str_replace(" ","",strtolower($newstitle));
    $titlebuf=strtr($titlebuf,"/%&!?.*'#[]{}`´§()_-;:+²³@|<>^°ßµ,=äöüáéíóúàèìòù","~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~aouaeiouaeiou");
    $titlebuf=str_replace("~","",$titlebuf);
    $titlebuf=str_replace("\"","",$titlebuf);
    //$titlebuf=str_replace("(","",$titlebuf);
    //$titlebuf=str_replace(")","",$titlebuf);
   // $titlebuf=str_replace('\,','',$titlebuf);
    $titlebuf=str_replace('\\','',$titlebuf);
    $titlebuf=str_replace('\$','',$titlebuf);
}
?>
