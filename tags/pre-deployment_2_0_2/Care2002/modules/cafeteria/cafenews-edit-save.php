<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, elpidio@care2x.net
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','editor.php');
$local_user='ck_cafenews_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$fileforward='cafenews-read.php';

$dept_nr=2; /* 2  = cafeteria */

if(($artnum)&&($mode=='save'))
{
    include($root_path.'include/inc_news_save.php');
}
?>
