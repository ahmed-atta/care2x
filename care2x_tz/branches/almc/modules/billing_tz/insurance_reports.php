<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
define('LANG_FILE','billing.php');
require($root_path.'include/inc_front_chain_lang.php');
require_once('gui/gui_insurance_reports.php');
?>