<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_rightcolumn_menu.php",$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

/* Get the main info data */
$config_type='main_info_%';
require($root_path.'include/inc_get_global_config.php');

#Workaround
$main_info_address=nl2br($main_info_address);

/* Prepare the url links variables */
$url_open="open-time.php".URL_APPEND;
$url_mgmt="newscolumns.php".URL_APPEND."&dept_nr=28&user_origin=dept";
$url_dept="".$root_path.'modules/news/'."departments.php".URL_APPEND;
$url_cafe="http://www.paginesanitarie.com/skfarmaci/farmacialfaba.htm".URL_APPEND;
$url_adm="http://www.paginesanitarie.com/glossarioa.htm".URL_APPEND;
$url_exh="http://www.paginesanitarie.com/homeinformazione.htm".URL_APPEND;
$url_tips="http://www.paginesanitarie.com/ticket.htm".URL_APPEND;
$url_calendar=$root_path."modules/calendar/calendar.php".URL_APPEND."&retpath=home";
$url_jshelp="javascript:gethelp()";



$TP_com_img_path=$root_path.'gui/img/common';

# Load the template
$tp=&$TP_obj->load('tp_rightcolumn_menu.htm');
# Output display
eval ("echo $tp;");
?>
