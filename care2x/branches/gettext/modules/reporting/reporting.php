<?php  

ini_set('display_errors', 1);

//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
error_reporting (E_ALL );

require('./roots.php'); 
require_once('./models/class_reporting.php');
require_once($root_path.'include/helpers/inc_environment_global.php'); 
$thisfile=basename(__FILE__);



$CReport=new Report();
$VReport = $CReport -> GetView('OPD Summary');
$VReport->Display();

// Other directives to the controller could be here:
// To install the module:
//$VReport->Install();
// To updatel the module:
//$VReport->Update();

// By install and update the table structure will be checked and either CREATE or ALTER statements executed... 

?>