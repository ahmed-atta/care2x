<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('../../include/helpers/inc_environment_global.php');

define('MODULE','address');
define('LANG_FILE_MODULAR','place.php');
$local_user = 'aufnahme_user';
require_once(CARE_BASE.'/include/helpers/inc_front_chain_lang.php');

require_once('model/class_address.php');
$address_obj = new Address;

switch( $retpath ) {
	case 'list': 
		$breakfile = 'citytown_list.php'.URL_APPEND; 
		break;
	case 'search': 
		$breakfile = 'citytown_search.php'.URL_APPEND; 
		break;
	default: 
		$breakfile = 'address_manage.php'.URL_APPEND;
}

if( isset( $nr ) && 
	( $nr != '' ) && 
	( $row = $address_obj->getCityTownInfo( $nr ) ) ) {
		
	$address = $row->FetchRow();
	$edit = true;
} 


# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
$smarty = new smarty_care('system_admin');

# Title in toolbar
$smarty->assign('sToolbarTitle',"$LDCityTown :: $LDData");
$smarty->assign('LDBack', $LDBack);
$smarty->assign('LDHelp', $LDHelp);
$smarty->assign('LDClose', $LDClose);
# href for help button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/address_info.html");

# href for close button
$smarty->assign('breakfile',$breakfile);

# Window bar title
$smarty->assign('sWindowTitle',"$LDCityTown :: $LDData");

if( isset( $save_ok ) && $save_ok ){ 
	$smarty->assign('message',$ErrorMessage);
} 

$inputFields = array (
	array (
		'fieldDescription' => $LDCityTownName,
		'fieldValue' => $address['name']
	),
	array (
		'fieldDescription' => $LDZipCode,
		'fieldValue' => $address['zip_code']
	),
	array (
		'fieldDescription' => $LDISOCountryCode,
		'fieldValue' => $address['iso_country_id']
	),
	array (
		'fieldDescription' => $LDWebsiteURL,
		'fieldValue' => nl2br($address['info_url'])
	),
	array (
		'fieldDescription' => $LDUNECELocalCode,
		'fieldValue' => nl2br($address['unece_locode'])
	),
	array (
		'fieldDescription' => $LDUNECEModifier,
		'fieldValue' => nl2br($address['unece_modifier'])
	),
	array (
		'fieldDescription' => $LDUNECELocalCodeType,
		'fieldValue' => nl2br($address['unece_locode_type'])
	),
	array (
		'fieldDescription' => $LDUNECECoordinates,
		'fieldValue' => nl2br($address['unece_coordinates'])
	),
);

$smarty->assign('inputFields',$inputFields);

$smarty->assign('imageUpdate',createComIcon(CARE_GUI,'pencil.png','0'));
$smarty->assign('imageCancel',createComIcon(CARE_GUI,'cross.png','0'));
$smarty->assign('imageListAll',createComIcon(CARE_GUI,'monitor.png','0'));

$smarty->assign('updateLink','citytown_update.php' . URL_APPEND.'&retpath='.$retpath.'&nr='.$address['nr'] );
$smarty->assign('listLink','citytown_list.php'  . URL_APPEND );

$smarty->assign('Update',$LDUpdateData);
$smarty->assign('Cancel',$LDCancel);
$smarty->assign('ListAll',$LDListAll);

$smarty->assign('NeedEmptyFormPls',$LDNeedEmptyFormPls);

$smarty->assign('formAction','citytown_new.php');
$smarty->assign('sid',$sid);
$smarty->assign('lang',$lang);
$smarty->assign('retpath',$retpath);

// Assign page output to the mainframe template
$smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/citytown_info.tpl');

//$smarty->compile_check = true; $smarty->debugging = true; $smarty->display('debug.tpl');
$smarty->display(CARE_BASE . 'main/view/mainframe.tpl');