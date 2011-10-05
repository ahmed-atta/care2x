<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('../../include/helpers/inc_environment_global.php');

define('MODULE','address');
define('LANG_FILE_MODULAR','place.php');
$local_user='aufnahme_user';
require_once(CARE_BASE.'/include/helpers/inc_front_chain_lang.php');

// Load the address object
require_once('model/class_address.php');
$address_obj = new Address;

switch($retpath) {
	case 'list': $breakfile='citytown_list.php'.URL_APPEND; break;
	case 'search': $breakfile='citytown_search.php'.URL_APPEND; break;
	default: $breakfile='citytown_manage.php'.URL_APPEND; 
}

if( isset( $nr ) && $nr ) {
	if( isset( $mode ) && $mode == 'update' ) {
		if($address_obj->updateCityTownInfoFromArray($nr,$_POST)){
    		header("location:citytown_info.php?sid=$sid&lang=$lang&nr=$nr&mode=show&save_ok=1&retpath=$retpath");
			exit;
		} else {
			echo $address_obj->getLastQuery();
			$mode='bad_data';
		}	
	} elseif( $row = $address_obj->getCityTownInfo( $nr ) ) {
		if( is_object( $row ) ) {
			$address = $row->FetchRow();
		}
	}
} else {
	// Redirect to search function
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
# Note: it is advisable to load this after the inc_front_chain_lang.php so
# that the smarty script can use the user configured template theme

require_once(CARE_BASE.'gui/smarty_template/smarty_care.class.php');
$smarty = new smarty_care('system_admin');

# Title in toolbar
$smarty->assign('sToolbarTitle',"$LDAddress :: $LDUpdateData");
$smarty->assign('LDBack', $LDBack);
$smarty->assign('LDHelp', $LDHelp);
$smarty->assign('LDClose', $LDClose);

# href for help button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/address_update.html");

# href for close button
$smarty->assign('breakfile',$breakfile);

# Window bar title
$smarty->assign('sWindowTitle',"$LDAddress :: $LDUpdateData");


switch($mode) {
	case 'bad_data': 
		$smarty->assign('ErrorMessage', $LDAlertNoCityTownName);
		break;
	case 'citytown_exists': 
		$smarty->assign('ErrorMessage', $LDDataNoSave);
		break;
	default:
		$smarty->assign('ErrorMessage', '');
		break;
}

$smarty->assign('formAction',$PHP_SELF);
$smarty->assign('message',$ErrorMessage);

$inputFields = array (
	array (
		'fieldDescription' => $LDCityTownName,
		'fieldValue' => $address['name'],
		'fieldName' => 'name',
		'notEmpty' => true
	),
	array (
		'fieldDescription' => $LDZipCode,
		'fieldValue' => $address['zip_code'],
		'fieldName' => 'zip_code',
		'notEmpty' => true
	),
	array (
		'fieldDescription' => $LDISOCountryCode,
		'fieldValue' => $address['iso_country_id'],
		'fieldName' => 'iso_country_id',
		'notEmpty' => false
	),
	array (
		'fieldDescription' => $LDUNECELocalCode,
		'fieldValue' => $address['unece_locode'],
		'fieldName' => 'unece_locode',	
		'notEmpty' => false
	),
	array (
		'fieldDescription' => $LDUNECEModifier,
		'fieldValue' => $address['unece_modifier'],
		'fieldName' => 'unece_modifier',	
		'notEmpty' => false
	),
	array (
		'fieldDescription' => $LDUNECELocalCodeType,
		'fieldValue' => $address['unece_locode_type'],
		'fieldName' => 'unece_locode_type',	
		'notEmpty' => false
	),
	array (
		'fieldDescription' => $LDUNECECoordinates,
		'fieldValue' => $address['unece_coordinates'],
		'fieldName' => 'unece_coordinates',		
		'notEmpty' => false
	),
	array (
		'fieldDescription' => $LDWebsiteURL,
		'fieldValue' => $address['info_url'],
		'fieldName' => 'info_url',	
		'notEmpty' => false
	),
);

$smarty->assign('inputFields',$inputFields);

$smarty->assign('imageSave',createComIcon(CARE_GUI,'pencil.png','0'));
$smarty->assign('imageCancel',createComIcon(CARE_GUI,'cross.png','0'));
$smarty->assign('Save',$LDSave);
$smarty->assign('Cancel',$LDCancel);

$smarty->assign('sid',$sid);
$smarty->assign('lang',$lang);
$smarty->assign('retpath',$retpath);
$smarty->assign('mode','update');
$smarty->assign('nr',$nr);

//js error checking
$smarty->assign('LDAlertNoCityTownName',$LDAlertNoCityTownName);
$smarty->assign('LDPlsEnterInfo',$LDPlsEnterInfo);
$smarty->assign('LDEnterISOCountryCode',$LDPlsEnterInfo);
$smarty->assign('LDEnterQMark',$LDEnterQMark);
$smarty->assign('LDWrongUneceLocCode',$LDWrongUneceLocCode);
$smarty->assign('LDEnterZero',$LDEnterZero);

// Assign page output to the mainframe template
$smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/citytown_new.tpl');

//$smarty->compile_check = true; $smarty->debugging = true; $smarty->display('debug.tpl');
$smarty->display(CARE_BASE . 'main/view/mainframe.tpl');