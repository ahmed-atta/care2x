<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr($_SERVER['SCRIPT_NAME'],'save_admission_data.inc.php'))
	die('<meta http-equiv="refresh" content="0; url=../">');


$debug=false;
($debug)?$db->debug=TRUE:$db->debug=FALSE;
if ($debug) {
    if (!isset($externalcall))
      echo "internal call<br>";
    else
      echo "external call<br>";

    echo "mode=".$mode."<br>";

		echo "show=".$show."<br>";

    echo "nr=".$nr."<br>";

    echo "breakfile: ".$breakfile."<br>";

    echo "backpath: ".$backpath."<br>";

    echo "pid:".$pid."<br>";

    echo "encounter_nr:".$encounter_nr;
}
$i=0;
if($mode=='delete') $arr_item_number[0] = $nr;
foreach ($arr_item_number AS $item_number) {

  $single_dosage        = $arr_single_dosage[$i];
  $times_per_day        = $arr_timesperday[$i];
  $days        			= $arr_days[$i];
  $dosage               = $arr_dosage[$i];
  $notes                = $arr_notes[$i];
  $article_item_number  = $arr_article_item_number[$i];
  $price                = $arr_price[$i];
  $article              = $arr_article[$i];

  $i++;

  //$obj->setDataArray($_POST);

  switch($mode){
  		case 'create':
  		            $sql="INSERT INTO care_encounter_prescription (
  		                          `encounter_nr`,
  		                          `prescription_type_nr`,
  		                          `article`,
  		                          `article_item_number`,
  		                          `price`,
  		                          `drug_class`,
								  `single_dosage`,
								  `times_per_day`,
								  `days`,
								  `dosage`,
  		                          `application_type_nr`,
  		                          `notes`,
  		                          `prescribe_date`,
  		                          `prescriber`,
  		                          `is_outpatient_prescription`,
  		                          `history`,
  		                          `modify_id`)
  		                          VALUES (
  		                          '".$encounter_nr."',
  		                          0,
  		                          '".$article."',
  		                          '".$article_item_number."',
  		                          '".$price."',
  		                          '',
								  '".$single_dosage."',
								  '".$times_per_day."',
								  '".$days."',
  		                          '".$dosage."',
  		                          0,
  		                          '".$notes."',
  		                          '".date('Y-m-d',time())."',
  		                          '".$prescriber."',
  		                          1,
  		                          '".$history."',
  		                          ''
  		                          )";
                  $db->Execute($sql);

				  //*******
 								  	// Load the visual signalling functions
									include_once($root_path.'include/inc_visual_signalling_fx.php');
									// Set the visual signal
									setEventSignalColor($encounter_nr,SIGNAL_COLOR_DOCTOR_INFO);
									//********
  								break;

								  //if (isset($externalcall))
									//  header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&externalcall=".$externalcall."&pid=".$_SESSION['sess_pid']);
 								  //exit;
  								//break;
  		case 'update':
  		            $sql="UPDATE care_encounter_prescription SET
  		                          `single_dosage`='$single_dosage',
								  `times_per_day`='$times_per_day',
								  `days`='$days',
								  `dosage`='$dosage',
  		                          `notes`='$notes',
  		                          `prescriber`='$prescriber',
  		                          `history`='$history'
  		                  WHERE nr=$nr";
                  $db->Execute($sql);
  								break;
  		case 'delete':
  		            $sql="DELETE FROM care_encounter_prescription WHERE nr=$nr";
                  $db->Execute($sql);

								  //if (isset($externalcall))
									//  header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&externalcall=".$externalcall."&pid=".$_SESSION['sess_pid']);
 								  //exit;
  								break;
  }// end of switch
} // end of foreach

if (isset($externalcall)){
	if ($backpath=='billing' || $backpath=='billing')
  		header("location: $root_path/modules/billing_tz/billing_tz_quotation.php");
  	else
  		header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&externalcall=".$externalcall."&backpath=".urlencode($backpath)."&pid=".$_SESSION['sess_pid']);
} else
  header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&backpath=".urlencode($backpath)."&pid=".$_SESSION['sess_pid']);

exit();
?>