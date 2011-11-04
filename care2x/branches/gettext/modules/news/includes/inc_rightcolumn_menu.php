<?php
error_reporting(E_ALL);

/* Get the main info data */
$GLOBAL_CONFIG=array();
include_once(CARE_BASE.'include/core/class_globalconfig.php');
$gc= new GlobalConfig($GLOBAL_CONFIG);
$data_result = $gc->getConfig('main_info_%');

#Workaround
$main_info_address=nl2br($main_info_address);

/* Prepare the url links variables */
$smarty->assign('url_open',"open-time.php".URL_APPEND);
$smarty->assign('url_mgmt',"newscolumns.php".URL_APPEND."&dept_nr=28&user_origin=dept");
$smarty->assign('url_dept',"../modules/news/departments.php".URL_APPEND);
$smarty->assign('url_cafe',"../cafeteria/cafenews.php".URL_APPEND);
$smarty->assign('url_adm',"newscolumns.php".URL_APPEND."&dept_nr=33&user_origin=dept");
$smarty->assign('url_exh',"newscolumns.php".URL_APPEND."&dept_nr=29&user_origin=dept");
$smarty->assign('url_edu',"newscolumns.php".URL_APPEND."&dept_nr=30&user_origin=dept");
$smarty->assign('url_stud',"newscolumns.php".URL_APPEND."&dept_nr=31&user_origin=dept");
$smarty->assign('url_phys',"newscolumns.php".URL_APPEND."&dept_nr=10&user_origin=dept");
$smarty->assign('url_tips',"newscolumns.php".URL_APPEND."&dept_nr=32&user_origin=dept");
$smarty->assign('url_calendar',"../modules/calendar/calendar.php".URL_APPEND."&retpath=home");
$smarty->assign('url_jshelp',"javascript:gethelp()");
$smarty->assign('url_news',"../news/editor-pass.php".URL_APPEND);
$smarty->assign('url_jscredits',"javascript:openCreditsWindow()");

$TP_com_img_path=CARE_BASE .'gui/img/common';

$smarty->assign('LDQuickInfo', $LDQuickInfo);

$smarty->assign('LDPhonePolice', $LDPhonePolice);
$smarty->assign('LDPhoneFire', $LDPhoneFire);
$smarty->assign('LDAmbulance', $LDAmbulance);
$smarty->assign('LDPhone', $LDPhone);
$smarty->assign('LDFax', $LDFax);
$smarty->assign('LDAddress', $LDAddress);
$smarty->assign('LDEmail', $LDEmail);

$smarty->assign('main_info_police_nr', $main_info_police_nr);
$smarty->assign('main_info_fire_dept_nr', $main_info_fire_dept_nr);
$smarty->assign('main_info_emgcy_nr', $main_info_emgcy_nr);
$smarty->assign('main_info_phone', $main_info_phone);
$smarty->assign('main_info_fax', $main_info_fax);
$smarty->assign('main_info_address', $main_info_address);
$smarty->assign('main_info_email', $main_info_email);

$smarty->assign('LDOpenTimes', $LDOpenTimesl);
$smarty->assign('LDManagement', $LDManagement);
$smarty->assign('LDDept', $LDDept);
$smarty->assign('LDCafenews', $LDCafenews);
$smarty->assign('LDCafenews', $LDCafenews);
$smarty->assign('LDExhibition', $LDExhibition);
$smarty->assign('LDEducation', $LDEducation);
$smarty->assign('LDAdvStudies', $LDAdvStudies);
$smarty->assign('LDPhyTherapy', $LDPhyTherapy);
$smarty->assign('LDHealthTips', $LDHealthTips);
$smarty->assign('LDCalendar', $LDCalendar);
$smarty->assign('LDHelp', $LDHelp);
$smarty->assign('LDSubmitNews', $LDSubmitNews);
$smarty->assign('LDCredits', $LDCredits);

$smarty->display(__DIR__ .  '/../view/rightcolumn_menu.tpl');

?>