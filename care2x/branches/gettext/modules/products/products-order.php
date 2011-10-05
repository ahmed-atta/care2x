<?php
error_reporting ( E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR );
require ('./roots.php');
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
$local_user = 'ck_prod_order_user';
require_once ($root_path . 'include/helpers/inc_front_chain_lang.php');
include($root_path.'include/helpers/inc_passcheck.php');
if (isset ( $_SESSION ['department_nr'] ) && $_SESSION ['department_nr'] != '') {
	$dept_nr = $_SESSION ['department_nr'] [0];

}else{
    echo '<FONT SIZE="+4" color="navy">' . $LDNoDepartmentAssociation . '</font>';
    exit ();
}


//$db->debug=1;


/**
 * LOAD Smarty
 */

// Note: it is advisable to load this after the inc_front_chain_lang.php so
// that the smarty script can use the user configured template theme

require_once ($root_path . 'gui/smarty_template/smarty_care.class.php');
$smarty = new smarty_care ( 'common', TRUE, FALSE, FALSE );

// Window bar title
$smarty->assign ( 'sWindowTitle', '' );

// Assign frameset source file

$smarty->assign ( 'sHeaderSource', "src=\"products-order-header.php?sid=$sid&lang=$lang&cat=$cat&userck=$userck\"" );
$smarty->assign ( 'sBasketSource', "src=\"products-basket.php?sid=$sid&lang=$lang&dept_nr=$dept_nr&order_nr=$order_nr&itwassent=$itwassent&cat=$cat&userck=$userck\"" );
$smarty->assign ( 'sCatalogSource', "src=\"products-ordercatalog.php?sid=$sid&lang=$lang&dept_nr=$dept_nr&order_nr=$order_nr&cat=$cat&userck=$userck\"" );

$smarty->assign ( 'sBaseFramesetTemplate','products/ordering_frameset.tpl' );

$smarty->display(CARE_BASE . 'main/view/baseframe.tpl' );
?>
