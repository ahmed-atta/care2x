<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.09 - 2003-11-25
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
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
