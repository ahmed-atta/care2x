<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','radiology');
define('LANG_FILE_MODULAR','radiology.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['admit'];
$append=URL_REDIRECT_APPEND.'&from=pass'; 

if(!isset($_SESSION['sess_user_origin'])) $_SESSION['sess_user_origin'] = "";

switch($target){
	case 'upload': $fileforward='upload_person_search.php'.$append; 
						$lognote='Dicom upload ok';
						$buf=$LDUploadDicom; 
						$errbuf=$LDUploadDicom;
						break;
	case 'view': $fileforward='view_person_search.php'.$append; 
					$lognote='Dicom view ok';
						$buf=$LDViewDicom; 
						$errbuf=$LDViewDicom;
						break;
}


$thisfile=basename(__FILE__);
//$breakfile='startframe.php'.URL_APPEND;

$breakfile=$root_path.'main/startframe.php';

$userck='radio_user';

setcookie($userck.$sid,'');
require($root_path.'include/helpers/inc_2level_reset.php'); 
setcookie(ck_2level_sid.$sid,'');

# reset the user origin
$_SESSION['sess_user_origin']='';

require($root_path.'include/helpers/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/helpers/inc_passcheck.php');


require($root_path.'include/helpers/inc_passcheck_head.php');
?>

<BODY  onLoad="document.passwindow.userid.focus();" >

<FONT    SIZE=-1  FACE="Arial">

<P>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 


<?php require($root_path.'include/helpers/inc_passcheck_mask.php') ?>  
</FONT>
</BODY>
</HTML>
