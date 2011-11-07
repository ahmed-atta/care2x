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
define('MODULE','products');
define('LANG_FILE_MODULAR','products.php');
$local_user='ck_prod_db_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

require_once($root_path.'include/core/class_core.php');
$core = & new Core;

$thisfile=basename(__FILE__);

switch($cat){

	case "pharma":
							$title=$LDPharmacy;
							$dbtable="care_pharma_products_main";
							$imgpath=$root_path."uplodas/pharma/img/";
							$breakfile=$root_path."modules/pharmacy/pharmacy-database-functions.php?sid=$sid&lang=$lang&userck=$userck";
							break;
	case "medstock":
							$title=$LDMedDepot;
							$dbtable="care_med_products_main";
							$imgpath=$root_path."uplodas/medstock/img/";
							$breakfile=$root_path."modules/medstock/medstock-database-functions.php?sid=$sid&lang=$lang&userck=$userck";
							break;
	
	default:  {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;};

}

if(($mode=='delete')&&($sure)&&($keyword!='')&&($keytype!='')) {
	
	$deleteok=false;

    $sql="DELETE  FROM $dbtable WHERE  $keytype='$keyword'";

	if($ergebnis=$core->Transact($sql)){
		header ("location:products-database-functions-manage.php".URL_REDIRECT_APPEND."&from=deleteok&cat=$cat&userck=$userck");
		$deleteok=true;
	}
	//echo $sql;
}

//simulate update to search the keyword
$update=true;

# Load search routine
require("includes/inc_products_search_mod_database.php");

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('common');

 # Title in the title bar
 $smarty->assign('sToolbarTitle',"$title $LDPharmaDb $LDManage");
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 
 # href for the back button
// $smarty->assign('pbBack',$returnfile);

 # href for the help button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/products_db.html"); 
 # href for the close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$title $LDPharmaDb $LDManage");


 # Buffer page output
 ob_start()

?>
<a name="pagetop"></a>

<ul>
<p>
<br>

<?php 
if(!$sure)
{
	 echo '
	 	<table border=0>
     <tr>
       <td></td>
       <td><FONT face="Verdana,Helvetica,Arial" size=3  color="#800000">
		'.$LDConfirmDelete.'</font><br>
		<font size=2>'.$LDAlertDelete.'</font><p>
		<a href="products-database-functions-manage.php'.URL_APPEND.'&keyword='.$keyword.'&userck='.$userck.'&cat='.$cat.'&mode=search"><b><font color="#ff0000"><< '.$LDNoBack.'</font></b></a></td>
     </tr>
   </table>	';
}
else
{
	if(!$deleteok) echo'
			<FONT face="Verdana,Helvetica,Arial" size=3  color="#800000">
		'.$LDNoDelete.'</font><p>';
}

//simulate saved condition to force the static display of data
$saveok=true;

# Workaround to force display of form template
$bShowThisForm = TRUE;

# Load search results display routine
require("includes/inc_products_search_result_mod.php");

?>
<p>
<a href="<?php echo $breakfile ?>" class="button icon remove danger">Cancel</a>

<?php 

if(!$sure) echo'
	<form action="'.$thisfile.'" method="get" name=delform>
 <input type="hidden" name="sure" value="1">
 <input type="hidden" name="sid" value="'.$sid.'">
 <input type="hidden" name="lang" value="'.$lang.'">
 <input type="hidden" name="mode" value="delete">
 <input type="hidden" name="cat" value="'.$cat.'">
 <input type="hidden" name="userck" value="'.$userck.'">
 <input type="hidden" name="keyword" value="'.$keyword.'">
 <input type="hidden" name="keytype" value="'.$keytype.'">
  <input type="submit" value="'.$LDYesDelete.'">
 </form>
';
?>
</ul>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign the form template to mainframe

 $smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display(CARE_BASE . 'main/view/mainframe.tpl');
?>