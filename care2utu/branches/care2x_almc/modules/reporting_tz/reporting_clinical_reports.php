<?php
/*
CARE 2X Integrated Information System for Hospitals and Health Care Organizations and Services
Care 2002, Care2x, Copyright (C) 2002,2003,2004,2005,2006  Elpidio Latorilla

2009,2010 Modified for ALMC clinic Arusha/Tanzania by Moye Masenga (mmoyejm@yahoo.com)
*/
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

define('LANG_FILE','reporting.php');
require($root_path.'include/inc_front_chain_lang.php');
require_once('gui/gui_reporting_clinical_reports.php');

?>