<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

define('MODULE','menu');

require_once('model/class_menu.php');

$menu = new Menu();

require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
$smarty = new smarty_care('system_admin');

$topmenurow = $menu->getMenuListing();
$smarty->assign('menu',$topmenurow);

$smarty->assign('care_gui', CARE_GUI);
$smarty->display(__DIR__ . '/view/menu.tpl');