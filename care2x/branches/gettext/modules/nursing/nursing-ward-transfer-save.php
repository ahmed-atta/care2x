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

define('MODULE','nursing');
define('LANG_FILE_MODULAR','nursing.php');
define('NO_2LEVEL_CHK',1);
$local_user='ck_pflege_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

if(empty($_COOKIE[$local_user.$sid])){
    $edit=0;
	include($root_path."language/".$lang."/lang_".$lang."_".LANG_FILE);
}
/**
* Set default values if not available from url
*/
if (!isset($station)||empty($station)) { $station=$_SESSION['sess_nursing_station'];} # Default station must be set here !!
if(!isset($pday)||empty($pday)) $pday=date('d');
if(!isset($pmonth)||empty($pmonth)) $pmonth=date('m');
if(!isset($pyear)||empty($pyear)) $pyear=date('Y');
$s_date=$pyear.'-'.$pmonth.'-'.$pday;
if($s_date==date('Y-m-d')) $is_today=true;
	else $is_today=false;

$fileappend="&edit=1&mode=&pday=$pday&pmonth=$pmonth&pyear=$pyear&station=$station&ward_nr=$ward_nr";
$breakfile="location:nursing-ward.php".URL_APPEND.$fileappend;
$forwardfile="location:nursing-ward.php".URL_REDIRECT_APPEND.$fileappend;
# Create ward object
require_once($root_path.'include/core/class_ward.php');
$ward_obj= new Ward;

if(isset($mode)&&($mode=='transferbed'||$mode=='transferward')){	
	
	$date=date('Y-m-d');
	$time=date('H:i:s');
	
	# Determine the reason for temporary discharge
	if($mode=='transferward'){
		$dis_type=4; # transfer of ward
	}else{
		$dis_type=6; # transfer of bed
	}
	
	# First, discharge the patient from the current assignment
	if($ward_obj->DischargeFromWard($pn,$dis_type,$date,$time)){ 
	
		switch($mode){
  			case 'transferbed' : 
			{
				# Assign to ward,room and bed
				if($ward_obj->AdmitInWard($pn,$ward_nr,$rm,$bd)){
					//echo "ok";
					$ward_obj->setAdmittedInWard($pn,$ward_nr,$rm,$bd);
					header($forwardfile);
					exit;
				}	
				break;
			}
			case 'transferward': 
			{
				if($ward_obj->ReplaceWard($pn,$trwd)){
					header($forwardfile);
					exit;
				}
				break;
			}
		}
	}
}else{
	header($forwardfile);
	exit;
}

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<html>
<HEAD>
<?php




require($root_path.'include/helpers/include_header_css_js.php');
?>
<style type="text/css" name="s2">
td.vn { font-family:verdana,arial; color:#000088; font-size:10}

</style>
</HEAD>

<BODY  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<table border=0>
  <tr>
    
    <td><FONT SIZE=3  FACE="Arial" color="maroon"><?php 	echo $LDErrorOccured.'<br>'.$LDTryOrNotifyEDP; ?></td>
  </tr>
</table>

<p>
</BODY>
</HTML>
