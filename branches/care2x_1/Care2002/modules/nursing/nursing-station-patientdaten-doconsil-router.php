<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.09 - 2003-11-25
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');
if($edit&&!$HTTP_COOKIE_VARS[$local_user.$sid]) {header('Location:'.$root_path.'language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php'); exit;}; 
require_once($root_path.'include/inc_config_color.php'); // load color preferences
$target='';
switch($dept_nr)
{
	case 8: $target='patho';
				break;
	case 19: $target='radio';
				break;
	case 22: $target='chemlabor';
				break;
	case 23: $target='chemlabor';
				break;
	case 24: $target='chemlabor';
				break;
	case 25: $target='baclabor';
				break;
	case 43: $target='blood';
				break;
	default: $target='generic';
}

header('Location:'.$root_path.'modules/nursing/nursing-station-patientdaten-doconsil-'.$target.'.php'.URL_REDIRECT_APPEND."&edit=$edit&station=$station&pn=$pn&konsil=$type&dept_nr=$dept_nr&target=$target");
exit;
?>
