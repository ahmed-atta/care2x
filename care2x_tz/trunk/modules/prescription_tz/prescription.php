<?php
error_reporting(E_ALL);
require_once('./roots.php');

require_once($root_path.'include/inc_environment_global.php');
require($root_path.'include/inc_front_chain_lang.php');

$thisfile=basename($_SERVER['PHP_SELF']);

require_once('./model/class_prescription_module.php');

// for testing case -> point encounter number to an example : 
$encounter_nr = '2010581926';
/*

if (!empty($_GET['encounter_nr']) || !empty($_POST['encounter_nr'])) {
	// encounter number was transmitted by POST or GET value - assigning it now
	if (!empty($_GET['encounter_nr']))
		$encounter_nr = $_GET['encounter_nr']
	else
		$encounter_nr = $_POST['encounter_nr']
} elseif (!empty($_SESSION['sess_en'])) {
	// encounter number is set by session - assigning it now
	$_SESSION['sess_en'] = $encounter_nr;
} else {
	// TODO: search for an patient
	echo "no encounter given"; die();
}

*/

$debug=FALSE;
($debug)?$db->debug=TRUE:$db->debug=FALSE;

if(!$prescription_date) $prescription_date = date("Y-m-d");
define('NO_2LEVEL_CHK',1);

// create the prescription object 
$patient_prescription_obj = new PatientPrescription($encounter_nr);

// assign the current encunter number 
//$patient_prescription_obj->encounter_nr = $encounter_nr;
// assign the path where this module is located
$patient_prescription_obj->root_path=$root_path;
$patient_prescription_obj->top_dir=$top_dir;


switch ($model) {
	case 'show':
					if ($debug) echo "mode is set to show<br>";
					
					// Show all prescriptions for this patient
					
					$patient_prescription_obj->ShowPrescriptions();
					
					break;
	case 'create':
					if ($debug) echo "mode is set to create<br>";

					// The creation of one or more prescriptions will be done in two steps:
					// Step 1: Make a collection of items what will be prescribed
					// Step 2: Add attributes (amount etc.) to each prescribed item
					
					if ($_POST['task']=='preselection') {
						
						// Current task: preselection: Open the view where user can design 
						// the combination of prescription elements
						
						$patient_prescription_obj->CreatePrescription('preselection');
					
					} elseif ($_POST['task']=='parameterisation') {
						
						// Define here the value for how many days a prescruption should be taken, 
						// e.g. Tablets can be prescribed for x days:
						$patient_prescription_obj->tpd=10;
						
						// Current task: parametrisation: Open the view where user can give 
						// attributes on the already given combination of prescription elements

						$patient_prescription_obj->CreatePrescription('parameterisation',$_POST['ListBoxPrescriptionArrangements']);
					
					} else {
						// if no task given to that model, then open the preselection view
						$patient_prescription_obj->CreatePrescription('preselection');
					}
					
					break;
	case 'update':
					if ($debug) echo "mode is set to update<br>";
					
					// Update the array if items for this patient (just for this encounter and just prescribed - but not for billed or handed out items)
					
					$patient_prescription_obj->UpdatePrescription($_POST['ListBoxPrescriptionArrangements']);
					
					break;
	case 'delete':
					if ($debug) echo "mode is set to delete";
					
					// Delete the array of items for this patient (just for this encounter and just prescribed - but not for billed or handed out items)
					
					$patient_prescription_obj->DeletePrescription();
					
					break;
	default:
					if ($debug) echo "mode is set to default setting<br>";
					$append = "?model=show";
					$fileforward='prescription.php'.$append;
					header ( "Location: ".$fileforward);
					break;
}
	


?>