<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
define('MODULE','nursing');
define('LANG_FILE_MODULAR','nursing.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Title in toolbar
 $smarty->assign('sToolbarTitle',"$LDPatDataFolder $station");
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 
 # hide return button
 $smarty->assign('pbBack',FALSE);

 # href for help button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/patient_folder.html"); 
 # href for close button
 $smarty->assign('breakfile','javascript:document.retform.submit()');

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDPatDataFolder $station");
 
$sTemp= '<ul><p><br>
	<center><FONT class="warnprompt"><p><br>
	 &nbsp;
	<b>'.$LDNoLabReport.'</b><p>
		<form method="post" action="'.$root_path.'modules/nursing/nursing-ward-patientdata.php" name="retform">
	<input type="hidden" name="sid" value="'.$sid.'">
 	<input type="hidden" name="lang" value="'.$lang.'">
<input type="hidden" name="pn" value="'.$pn.'">
<input type="hidden" name="edit" value="'.$edit.'">
 <input type="hidden" name="station" value="'.$station.'">  
 <input type="hidden" name="nodoc" value="">  
 <input type="submit" value=" OK ">
     </form>
	</center>
	<p>
</ul>';

# Assign page output to the mainframe template

$smarty->assign('sMainFrameBlockData',$sTemp);
 /**
 * show Template
 */
 $smarty->display(CARE_BASE . 'main/view/mainframe.tpl');

?>