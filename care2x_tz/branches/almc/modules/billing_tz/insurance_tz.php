<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');

require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2005 Robert Meggle based on the development of Elpidio Latorilla (2002,2003,2004,2005)
* elpidio@care2x.org, meggle@merotech.de
*
* See the file "copy_notice.txt" for the licence notice
*/

//define('NO_2LEVEL_CHK',1);
define('LANG_FILE','billing.php');
require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
require_once($root_path.'include/care_api_classes/class_tz_billing.php');
$insurance_tz = New Insurance_tz();
$bill_obj = new Bill;
require ("gui/gui_insurance_tz.php");

?>
