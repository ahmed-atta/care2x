<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr("inc_rightcolumn_menu.php",$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

/* Get the main info data */
$GLOBAL_CONFIG=array();
include_once(CARE_BASE.'include/core/class_globalconfig.php');
$gc= new GlobalConfig($GLOBAL_CONFIG);
$data_result = $gc->getConfig('main_info_%');

#Workaround
$main_info_address=nl2br($main_info_address);

/* Prepare the url links variables */
$url_open="open-time.php".URL_APPEND;
$url_mgmt="newscolumns.php".URL_APPEND."&dept_nr=28&user_origin=dept";
$url_dept="../modules/news/departments.php".URL_APPEND;
$url_cafe="../cafeteria/cafenews.php".URL_APPEND;
$url_adm="newscolumns.php".URL_APPEND."&dept_nr=33&user_origin=dept";
$url_exh="newscolumns.php".URL_APPEND."&dept_nr=29&user_origin=dept";
$url_edu="newscolumns.php".URL_APPEND."&dept_nr=30&user_origin=dept";
$url_stud="newscolumns.php".URL_APPEND."&dept_nr=31&user_origin=dept";
$url_phys="newscolumns.php".URL_APPEND."&dept_nr=10&user_origin=dept";
$url_tips="newscolumns.php".URL_APPEND."&dept_nr=32&user_origin=dept";
$url_calendar="../modules/calendar/calendar.php".URL_APPEND."&retpath=home";
$url_jshelp="javascript:gethelp()";
$url_news="../news/editor-pass.php".URL_APPEND;
$url_jscredits="javascript:openCreditsWindow()";

$TP_com_img_path=CARE_BASE .'gui/img/common';

# Load the template
$tp=$TP_obj->load('tp_rightcolumn_menu.htm');
# Output display
eval ("echo $tp;");
?>