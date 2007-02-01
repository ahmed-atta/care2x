<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
#error_reporting(E_ALL);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_arv_case.php');
require($root_path.'include/inc_date_format_functions.php');
$breakfile="modules/arv/arv_menu.php";
$add_breakfile="&pid=".$_GET['pid'];
$o_arv_case=&new ARV_case($_GET['pid']);

require ("gui/gui_arv_overview.php");
?>
