<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php');

/*if ($pdaten=="ja") setcookie(pdatencookie,"ja");*/

require_once('../global_conf/areas_allow.php');

/* Set the allowed area basing on the target */
if($target=='admin') $allowedarea=&$allow_area['test_receive'];
 else $allowedarea=&$allow_area['test_order'];

if(!isset($target)||!$target) $target='chemlabor';

/* Set the default file forward */
$fileforward="pflege-station-patientdaten-doconsil-".$target.".php?sid=".$sid."&lang=".$lang."&noresize=1&user_origin=".$user_origin."&target=".$target;

$thisfile='labor_test_request_pass.php';
$breakfile="labor.php?sid=".$sid."&lang=".$lang;
$test_pass_logo='micros.gif';

$userck='ck_lab_user';

switch($target)
{

  case 'blood':  $title=$LDBloodOrder;
                      break;
					  
  case 'radio':  $title=$LDTestRequest." - ".$LDTestType[$target];
		              $breakfile="radiolog.php?sid=".$sid."&lang=".$lang;
					   $test_pass_logo='thorax_sm.jpg';
                      break;
					  
  case 'admin':  $title=$LDPendingRequest." - ".$LDTestType[$subtarget];
                       if($subtarget=='radio') 
					   {  $breakfile="radiolog.php?sid=".$sid."&lang=".$lang;
					       $test_pass_logo="thorax_sm.jpg";
					   }
                       $fileforward="labor_test_request_admin_".$subtarget.".php?sid=".$sid."&lang=".$lang."&target=".$target."&subtarget=".$subtarget."&noresize=1&&user_origin=".$user_origin;                      
					   break;
					   
  case 'generic': $title=$LDPendingRequest." - ".$LDTestType[$subtarget];
                        $fileforward="labor_test_request_admin_".$target.".php?sid=".$sid."&lang=".$lang."&target=".$target."&subtarget=".$subtarget."&noresize=1&&user_origin=".$user_origin;     
						if($user_origin=='amb')
						{
						   $userck='ck_amb_user';
						   $breakfile='ambulatory.php?sid='.$sid.'&lang='.$lang;
						}
						else
						{                 
					       $breakfile="aerzte.php?sid=".$sid."&lang=".$lang;
					     }
					    break;
						
        default : $title=$LDTestRequest." - ".$LDTestType[$target];
}
					  
$lognote="$title ok";


//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require('../include/inc_2level_reset.php'); setcookie('ck_2level_sid'.$sid,'');
require('../include/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include('../include/inc_passcheck.php');

$errbuf=$title;
$minimal=1;
require('../include/inc_passcheck_head.php');
?>

<?php echo setCharSet(); ?>
<BODY onLoad="if (window.focus) window.focus(); document.passwindow.userid.focus();">


<FONT    SIZE=-1  FACE="Arial">

<P>

<img <?php echo createComIcon('../',$test_pass_logo,'0','absmiddle') ?>><FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  size=5 FACE="verdana"> <b><?php echo $title;  ?></b></font>
<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require('../include/inc_passcheck_mask.php') ?>  

<p>

<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</FONT>


</BODY>
</HTML>
