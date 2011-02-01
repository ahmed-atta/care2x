<?php


if(isset($newstitle)&&!empty($newstitle))
{
    $titlebuf=str_replace(' ','',strtolower($newstitle));
    $titlebuf=strtr($titlebuf,"/%&!?.*'#[]{}`´§()_-;:+²³@|<>^°ßµ,=äöüáéíóúàèìòùêôûîâçãõ³±¶¼æ¿¹","~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~aouaeiouaeioueouiacaolaszczs");
    $titlebuf=str_replace('~','',$titlebuf);
    $titlebuf=str_replace("\"","",$titlebuf);
    $titlebuf=str_replace('\\','',$titlebuf);
    $titlebuf=str_replace('\$','',$titlebuf);

?>
