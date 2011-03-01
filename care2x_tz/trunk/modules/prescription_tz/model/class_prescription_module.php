<?php
ini_set('date.timezone', 'UTC');

require_once($root_path.'/include/inc_init_xmlrpc.php');
require_once($root_path.'include/care_api_classes/class_core.php');
require_once($root_path.'/include/care_api_classes/class_person.php');
// for view-methods
require_once($root_path.'gui/smarty_template/smarty_care.class.php');

// will be done with interfaces for this class:
// require_once($root_path.'/include/care_api_classes/class_weberp_c2x.php');


/***************************
 * Add to the interface the methods what are been used in class PatientPrescription and class PatientPrescriptionWebERP
 */
interface StockMethod {
	public function GetItemDetailsByID($item_array);
}


/**************************
 * Core class of all prescription work - what is been different handled will be overwritten by interface methods
 */
class PatientPrescription extends person implements StockMethod  {
	
	/*
	 * Current encounter number what should be handled
	 */
	private $my_druglist_table='care_tz_drugsandservices';
	
	public $encounter_nr;
	
	public $pid;
	
	public $root_path='';
	
	public $top_dir;
	
	private $debug;
	
	private $lang_tables=array('aufnahme.php','pharmacy.php');
	
	public $weberp_obj;
	
	// Set here the filter what kind of purchasing classes of the druglist *will not be shown* in the preseleciton of prescription
	// This can simply be overloaded - it is classified as public. 
	// Example: 
	// $patient_prescription_obj = new PatientPrescription($encounter_nr);
	// $patient_prescription_obj->$arr_purchasing_class_filter = array ('supplies');
	public $arr_purchasing_class_filter=array('supplies','supplies_laboratory');
	
	// Times Per Day: Set here the amount for prescriptions how many days a doctor can prescribe a drug
	public $tpd=10;
	
	// Days: How many days should this item been prescribed 
	public $d=120;


	
	/*
	 * @name: PatientPrescription
	 * @description: CONSTRUCTOR (to have compatibilty to php < 5 the name of the class is the function name of the constructor
	 * @parameter: encounter number (mandatory)
	 * @internal setting of private encounter number and patient ID
	 * @returns: TRUE/FALSE
	 * @Author: Robert Meggle, 2011
	 * @example: 
	 * [...]
	 * 	$pobj = new PatientPrescription($encounter_nr);
	 * [...]
	 */
	public function PatientPrescription($encounter_nr=NULL) {
		if ($encounter_nr==NULL) {
			return false;
		} else {
			$this->debug=false;
			$this->encounter_nr = $encounter_nr;
			$this->pid = $this->GetPidFromEncounter($encounter_nr);
			
			//***********************************
			// Possible place for helper class webERP 
			//***********************************
				
			
			return true;
		}
	}

	/*
	 * @name: gui_init
	 * @description: initialisation of GUI output - place here required individual css and js files
	 * @parameter: -
	 * @returns: TRUE
	 * @Author: Robert Meggle, 2011
	 */
	private function gui_init() {
		// TODO Open discussion point if that kind of methods could be outsorced in helper class...
		$root_path=$this->root_path;
		$top_dir=$this->top_dir;
		echo $root_path;
		// clean the header
		ob_clean();
		require($root_path.'include/inc_css_a_hilitebu.php');
		// embed the required advanced stylesheets
		echo '<link rel="stylesheet" type="text/css" href="'.$root_path.$top_dir.'includes/css/module_template.css"/>	';
		include($root_path.$top_dir.'./includes/css/tabs_css.php');
		// embed the jQuery scripts needed for that module
		echo '
		<script language="javascript" src="'.$root_path.'js/jQuery/jquery-1.5.js"></script>
		<script language="javascript" src="'.$root_path.'js/jQuery/jquery.tools.min.js"></script>
		<script language="javascript" src="'.$root_path.'js/jQuery/jquery.searchabledropdown-1.0.7.src.js"></script>
		';
		return true;
	}
	
	
	/*
	 *  PUBIC CLASSES 
	 */
	
	/*
	 * @name: GetArrayOfAllPurchasingClasses
	 * @description: Get all prurchasing classes (->Classification of items in table care2x_tz_drugsandservices
	 * @parameter: -
	 * @returns: array
	 * @Author: Robert Meggle
	 * @example:
	 * 	[...]
	 * $purchasing_class_array = $this->GetArrayOfAllPurchasingClasses();
	 * foreach($purchasing_class_array as $article_category) {
	 *							echo $article_category;
	 *						}
	 *	[...]
	 */
	public function GetArrayOfAllPurchasingClasses() {
		global $db;
		$ArrayOfPurchasingClasses=array();
		$v='';
		if ($this->debug) echo 'PatientPrescription::GetArrayOfAllPurchasingClasses()<br>';

		// TODO Discussion point if that section of GetArrayOfAllPurchasingClasses() can be outsorced in private class
		// There could be some elements in purchasing class what should be not been shown in that list
		if (is_array($this->arr_purchasing_class_filter) && !empty($this->arr_purchasing_class_filter)) {
			//$SQLfilter = " WHERE ";
			foreach ($this->arr_purchasing_class_filter as $filter) {
				$SQLfilter .= 'purchasing_class<>"'.$filter.'" AND ';
			}
		}
		// filling up last AND with any valid expression (more easy to read the code here later)
		$SQLfilter .= '1=1';
		
		$this->sql="SELECT purchasing_class FROM ".$this->my_druglist_table." where purchasing_class<>'' AND ".$SQLfilter." GROUP BY purchasing_class";
		if ($res=$db->execute($this->sql)) {
			$arr=$res->GetArray();
			// First tab should show the "my often used prescription" what can be set manually - or automatically
			array_push ($ArrayOfPurchasingClasses,'often used');
			foreach ($arr as $v) {
				array_push($ArrayOfPurchasingClasses,$v[0]);
			}
			return $ArrayOfPurchasingClasses;
		} else {	
			return FALSE;
		}
	}
	

	/*
	 * @name: GetItemDetailsByID
	 * @description: Getting the details for this item of the druglist
	 * @parameter: the id (PK) of the main item row
	 * @returns array or false
	 * @author: Robert Meggle, 2011
	 *
	 */
	public function GetItemDetailsByID($item_array) {
		global $db;
		$arrayOfItemDetails = array();
		if ($this->debug) echo "GetItemDetailsByID()";
		if (!is_array($item_array)) return false;
		// Query each item for its details:
		while (list($x,$v)=each($item_array)) {
			// Init the 2D assoc. array, key is the item number
			$arrayOfItemDetails[$v]['item_number']=$v;
			$this->sql="SELECT `item_id`, `item_number`,`partcode`, `item_description`, `purchasing_class`, `not_in_use`, `sub_class` FROM care_tz_drugsandservices where item_id=".$v;
			if ($res=$db->execute($this->sql)) {
				$arr=$res->GetArray();
				foreach ($arr as $value) {
					//TODO: Put here the query about this item from webERP interface about availability & stuff - and add it to this array
					$arrayOfItemDetails[$v]['item_id']=$value['item_id'];
					$arrayOfItemDetails[$v]['item_number']=$value['item_number'];
					$arrayOfItemDetails[$v]['partcode']=$value['partcode'];
					$arrayOfItemDetails[$v]['item_description']=$value['item_description'];
					$arrayOfItemDetails[$v]['purchasing_class']=$value['purchasing_class'];
					$arrayOfItemDetails[$v]['not_in_use']=$value['not_in_use'];
					$arrayOfItemDetails[$v]['sub_class']=$value['sub_class'];	
				}
			}
		}
		if (is_array($arrayOfItemDetails)===TRUE) {
			// if there is an array at this point of the code, then we found something
			return $arrayOfItemDetails;
		} else {
			// there is no array, so we had an issue at all
			return false;
		}
	}

	/*
	 * @name: GetArticleArray
	 * @description: Get an array of all items of one category. If no dategory is given, it will return all items of care2x_tz_drugsandservices
	 * @parameter: Name of the category (optional)
	 * @returns: array
	 * @example:
	 * [...]
	 *	$ArticleAttributes=$this->GetArticleArray('drugs');
	*	}
	* [...]
	* returns:
	* [id]->[value]...
	*/
	public function GetArticleArray($cat='') {
		if ($this->debug) echo "PatientPrescription::GetElements($cat)<br>";
		global $db;
		$a=array();

		// if no category (so called "purchasing_class" given, make a query to all articles without filtering the category
		$category = (empty($cat)) ? "  " : " WHERE item_description<>'' AND purchasing_class='".$cat."'";
		$this->sql="SELECT item_id, item_description FROM ".$this->my_druglist_table." ".$category;

		$first_element=TRUE;
		if ($res=$db->execute($this->sql)) {
			$item_array = $res->GetArray();
			while (list($x,$v)=each($item_array)) {
					$key=$v[0];
					$value=$v[1];
					$a[$key]=$value;
				}
			}
			return $a;
	}
	


	public function ShowPrescriptions() {
		global $db;
		if ($this->debug) echo 'PatientPrescription::ShowPrescriptions(); we look for encounter nuber: '.$this->encounter_nr.'<br>';
		return true;
	}
	
	public function CreatePrescription($task='preselection', $item_array=array()) {
		global $db;
		if ($this->debug) echo 'PatientPrescription::CreatePrescription(); we look for encounter nuber: '.$this->encounter_nr.'<br>';
		
		// Load the languae tables 
		
		$lang_tables =$this->lang_tables;
		$root_path = $this->root_path;
		include($this->root_path.'include/inc_load_lang_tables.php');
		$this->gui_init();

		// Declare values for standard headline
		$smarty = new smarty_care('common');
		$smarty->assign('sToolbarTitle',$this->pid);
		$smarty->assign('LDCaseNr',$LDFileNr);
		$smarty->assign('LDLastName',$LDLastName);
		$smarty->assign('LDFirstName',$LDFirstName);
		$smarty->assign('LDBday',$LDBday);
		$smarty->assign('sPatientNumber',$this->getValue('selian_pid',$patient_prescription_obj->pid));
		$smarty->assign('sNameLast',$this->getValue('name_last',$patient_prescription_obj->pid));
		$smarty->assign('sNameFirst',$this->getValue('name_first',$patient_prescription_obj->pid));
		$smarty->assign('sBirthDay',$this->getValue('date_birth',$patient_prescription_obj->pid));
		
		switch ($task) {
			case 'preselection':
							if ($this->debug) echo 'PatientPrescription::CreatePrescription() -> task: preselection <br>';
							
							// using getValue method from class_persin to get patient details for this PID

							// using smarty array to show the tabs:
							$purchasing_class_array = $this->GetArrayOfAllPurchasingClasses();
							$smarty->assign('tabs', $purchasing_class_array);
							//For every tab there are several selectable elemenets:
							foreach($purchasing_class_array as $article_category) {
								$ArticleAttributes=$this->GetArticleArray($article_category);
								$CatArray[$article_category]=$ArticleAttributes;
								$smarty->assign('items',$CatArray);
							}
							
							$smarty->display('pharmacy/prescription_preselection.tpl');
							break;
			case 'parameterisation':
				
							if ($this->debug) echo 'PatientPrescription::CreatePrescription() -> task: parameterisation <br>';
							if ($this->debug) print_r($item_array);
							// For each selected items getting the details and serve the template with it
							$item_details_arr = $this->GetItemDetailsByID($item_array);
							
							$smarty->assign('ItemDetails', $item_details_arr);
							$smarty->assign('Notes',$LDNotes);
							$smarty->assign('PresAmount',$LDPresAmount);
							$smarty->assign('PresFrequency',$LDPresFrequency);
							$smarty->assign('PresFrequency1',$LDPresFrequency1);
							$smarty->assign('PresFrequency2',$LDPresFrequency2);

							$smarty->assign('tpd',$this->tpd);
							$smarty->assign('d',$this->d);
							
							// Load common icons
							$img_arrow=createComIcon($root_path,'r_arrowgrnsm.gif','0');
							$smarty->assign('pres_send_img',$img_arrow);
							
							// Define the form
							
							$smarty->assign('SingleDoseValue','');
							
							//TODO css definition for this template not be done so far
							$smarty->display('pharmacy/module_prescription_parameterisation.tpl');
							
							break;
			case 'default':
							return false;
							break;
		}

		
		return true;
	}
	
	public function UpdatePrescription() {
		global $db;

		if ($this->debug) echo 'PatientPrescription::UpdatePrescription(); we look for encounter nuber: '.$this->encounter_nr.'<br>';
		return true;
	}
	
	public function DeletePrescription() {
		global $db;

		if ($this->debug) echo 'PatientPrescription::DeletePrescription(); we look for encounter nuber: '.$this->encounter_nr.'';
		return true;
	}
}

/*********************
 * 
 *  Place here the methods what are different to handle when webERP is enabled and add the method declaration to the interface section at the top of this file
 *  
*/

class PatientPrescriptionWebERP extends PatientPrescription implements StockMethod {
		/*
	 * @name: GetItemDetailsByID
	 * @description: Getting the details for this item of the druglist
	 * @parameter: the id (PK) of the main item row
	 * @returns array or false
	 * @author: Robert Meggle, 2011
	 *
	 */
	public function GetItemDetailsByID($item_array) {
		global $db;
		$arrayOfItemDetails = array();
		if ($this->debug) echo "GetItemDetailsByID()";
		if (!is_array($item_array)) return false;
		// Query each item for its details:
		while (list($x,$v)=each($item_array)) {
			// Init the 2D assoc. array, key is the item number
			$arrayOfItemDetails[$v]['item_number']=$v;
			$this->sql="SELECT `item_id`, `item_number`,`partcode`, `item_description`, `purchasing_class`, `not_in_use`, `sub_class` FROM care_tz_drugsandservices where item_id=".$v;
			if ($res=$db->execute($this->sql)) {
				$arr=$res->GetArray();
				foreach ($arr as $value) {
					//TODO: Put here the query about this item from webERP interface about availability & stuff - and add it to this array
					$arrayOfItemDetails[$v]['item_id']=$value['item_id'];
					$arrayOfItemDetails[$v]['item_number']=$value['item_number'];
					$arrayOfItemDetails[$v]['partcode']=$value['partcode'];
					$arrayOfItemDetails[$v]['item_description']=$value['item_description'];
					$arrayOfItemDetails[$v]['purchasing_class']=$value['purchasing_class'];
					$arrayOfItemDetails[$v]['not_in_use']=$value['not_in_use'];
					$arrayOfItemDetails[$v]['sub_class']=$value['sub_class'];	
				}
			}
		}
		if (is_array($arrayOfItemDetails)===TRUE) {
			// if there is an array at this point of the code, then we found something
			return $arrayOfItemDetails;
		} else {
			// there is no array, so we had an issue at all
			return false;
		}
	}
	
}

?>