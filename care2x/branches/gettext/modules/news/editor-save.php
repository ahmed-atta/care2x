<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
$root_path='../../';
require('../../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 1.0.08 - 2003-10-05
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','news');
define('LANG_FILE_MODULAR','news.php');
$local_user='ck_editor_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

$fileforward='headline-read.php';

$dept_nr=$_SESSION['sess_dept_nr'];

if(($artnum)&&($mode=='save'))
{
    include('includes/inc_news_save.php');
}

?>