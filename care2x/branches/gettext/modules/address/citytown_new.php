<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('../../include/helpers/inc_environment_global.php');

define('LANG_FILE','place.php');
$local_user='aufnahme_user';
require_once(CARE_BASE.'/include/helpers/inc_front_chain_lang.php');

// Load the address object
require_once(CARE_BASE.'/modules/address/model/class_address.php');
$address_obj=new Address;

switch($retpath) {
	case 'list': $breakfile='citytown_list.php'.URL_APPEND; break;
	case 'search': $breakfile='citytown_search.php'.URL_APPEND; break;
	default: $breakfile='address_manage.php'.URL_APPEND;
}

if(!isset($mode)){
	$mode = '';
	$edit = true;
}else{
	$_POST['name'] = trim($_POST['name']);
	if(!empty($_POST['name'])){
		if($address_obj->CityTownExists($_POST['name'],$_POST['iso_country_id'])){
			$mode = 'citytown_exists';
		}else{
			if($address_obj->saveCityTownInfoFromArray($_POST)){
				$insid = $db->Insert_ID();
				$nr = $address_obj->LastInsertPK('nr',$insid);

				header("location:citytown_info.php?sid=$sid&lang=$lang&nr=$nr&mode=show&save_ok=1&retpath=$retpath");
				exit;
			}else{ echo "$sql<br>$LDDbNoSave"; }
		}
	}else{
		$mode = 'bad_data';
	}
}

/**
 * LOAD Smarty
 */

require_once(CARE_BASE.'gui/smarty_template/smarty_care.class.php');
$smarty = new smarty_care('system_admin');

# Title in toolbar
$smarty->assign('sToolbarTitle',"$LDAddress :: $LDNewCityTown");
$smarty->assign('LDBack', $LDBack);
$smarty->assign('LDHelp', $LDHelp);
$smarty->assign('LDClose', $LDClose);
# href for help button
$smarty->assign('pbHelp',"javascript:gethelp('address_new.php')");

# href for close button
$smarty->assign('breakfile',$breakfile);

# Window bar title
$smarty->assign('sWindowTitle',"$LDAddress :: $LDNewCityTown");

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
$smarty->assign('message',$LDEnterAllFields);

$inputFields = array (
	array (
		'fieldDescription' => $LDCityTownName,
		'fieldValue' => $name,
		'fieldName' => 'name',
		'notEmpty' => true
	),
	array (
		'fieldDescription' => $LDZipCode,
		'fieldValue' => $zip_code,
		'fieldName' => 'zip_code',
		'notEmpty' => true
	),
	array (
		'fieldDescription' => $LDISOCountryCode,
		'fieldValue' => $iso_country_id,
		'fieldName' => 'iso_country_id',
		'notEmpty' => false
	),
	array (
		'fieldDescription' => $LDUNECELocalCode,
		'fieldValue' => $unece_locode,
		'fieldName' => 'unece_locode',	
		'notEmpty' => false
	),
	array (
		'fieldDescription' => $LDUNECEModifier,
		'fieldValue' => $unece_modifier,
		'fieldName' => 'unece_modifier',	
		'notEmpty' => false
	),
	array (
		'fieldDescription' => $LDUNECELocalCodeType,
		'fieldValue' => $unece_locode_type,
		'fieldName' => 'unece_locode_type',	
		'notEmpty' => false
	),
	array (
		'fieldDescription' => $LDUNECECoordinates,
		'fieldValue' => $unece_coordinates,
		'fieldName' => 'unece_coordinates',		
		'notEmpty' => false
	),
	array (
		'fieldDescription' => $LDWebsiteURL,
		'fieldValue' => $info_url,
		'fieldName' => 'info_url',	
		'notEmpty' => false
	),
);

$smarty->assign('inputFields',$inputFields);
echo $thisfile;
$smarty->assign('breakfile',$breakfile);
$smarty->assign('imageSave',createComIcon(CARE_BASE,'accept.png','0'));
$smarty->assign('imageCancel',createComIcon(CARE_BASE,'cross.png','0'));
$smarty->assign('Save',$LDSave);
$smarty->assign('Cancel',$LDCancel);

$smarty->assign('sid',$sid);
$smarty->assign('lang',$lang);
$smarty->assign('retpath',$retpath);

// Assign page output to the mainframe template
$smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/citytown_new.tpl');

//$smarty->compile_check = true; $smarty->debugging = true; $smarty->display('debug.tpl');

$smarty->display('common/mainframe.tpl');
?>