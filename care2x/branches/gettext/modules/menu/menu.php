<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
//require('../../include/helpers/inc_environment_global.php');
//require_once(CARE_BASE.'/include/helpers/inc_front_chain_lang.php');
define('MODULE','menu');

require_once('model/class_menu.php');

$menu = new Menu();

require_once(CARE_BASE.'/gui/smarty_template/smarty_care.class.php');
$smarty = new smarty_care('system_admin');

$topmenurow = $menu->getMenuListing();
$submenurow = $menu->getSubMenuListing();

$smarty->assign('menuFields',$topmenurow->GetRows());
$smarty->assign('submenuFields',$submenurow->GetRows());

$smarty->assign('care_gui', CARE_GUI);
$smarty->display(__DIR__ . '/view/menu.tpl');