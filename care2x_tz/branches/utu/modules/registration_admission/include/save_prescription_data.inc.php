<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr('save_admission_data.inc.php',$_SERVER['PHP_SELF']))
	die('<meta http-equiv="refresh" content="0; url=../">');

$debug=FALSE;
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

	echo "prescrServ: ".$_GET['prescrServ'];
}
$i=0;
if($mode=='delete') $arr_item_number[0] = $nr;
foreach ($arr_item_number AS $item_number) {

  $dosage               = $arr_dosage[$i];
  $notes                = $arr_notes[$i];
  $article_item_number  = $arr_article_item_number[$i];
  $price                = $arr_price[$i];
  $article              = $arr_article[$i];
  $timesperday			= $arr_timesperday[$i];
  $days					= $arr_days[$i];
  $history				= $arr_history[$i];

  $i++;

  //$obj->setDataArray($_POST);
$searchsql="SELECT item_id, item_full_description FROM care_tz_drugsandservices WHERE partcode='".$article_item_number."'";

$searchresult=$db->Execute($searchsql);
$row=$searchresult->FetchRow();

  switch($mode){
  		case 'create':
  		            $sql="INSERT INTO care_encounter_prescription (
  		                          `encounter_nr`,
  		                          `prescription_type_nr`,
  		                          `article`,
  		                          `article_item_number`,
  		                          `price`,
  		                          `drug_class`,
  		                          `dosage`,
 		                          `application_type_nr`,
  		                          `notes`,
  		                          `times_per_day`,
  		                          `days`,
  		                          `prescribe_date`,
  		                          `prescriber`,
  		                          `is_outpatient_prescription`,
  		                          `history`,
  		                          `create_time`,
  		                          `modify_id`)
  		                          VALUES (
  		                          '".$encounter_nr."',
  		                          0,
  		                          '".$row[1]."',
  		                          '".$row[0]."',
  		                          '".$price."',
  		                          'drug_list',
  		                          '".$dosage."',
  		                          0,
  		                          '".$notes."',
  		                          '".$timesperday."',
  		                          '".$days."',
  		                          '".date('Y-m-d',time())."',
  		                          '".$prescriber."',
  		                          '1',
  		                          '".$history."',
  		                          '".date('Y-m-d',time())."',
  		                          '".$_SESSION['create_id']."'
  		                          )";
                  $db->Execute($sql);
//echo $sql;
		if($is_transmit_to_weberp_enable)
		{
			$sql='select partcode from care_tz_drugsandservices where item_id="'.$row[0].'"';
			$result=$db->Execute($sql);
			$itemrow = $result->FetchRow();
			$itemNumber=$itemrow[0];
			$quantity=$dosage*$timesperday*$days*-1;
			$weberp_obj = new_weberp();
			$weberp_obj->stock_adjustment_in_webERP($itemNumber, $weberp_obj->defaultLocation,(double)$quantity,date('Y-m-d',time()));
		}

								  //if (isset($externalcall))
									//  header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&externalcall=".$externalcall."&pid=".$_SESSION['sess_pid']);
 								  //exit;

 								  //dosage ausgeben:
 								  //echo 'Dosage: '.$dosage;

 								    //*******
 								  	// Load the visual signalling functions
									include_once($root_path.'include/inc_visual_signalling_fx.php');
									// Set the visual signal
									setEventSignalColor($encounter_nr,SIGNAL_COLOR_DOCTOR_INFO);
									//********
  								break;
  		case 'update':

  					$sqlOld = "SELECT * from care_encounter_prescription WHERE nr=$nr";
  					$result = $db->Execute($sqlOld);
  					$row = $result->FetchRow();

  					$historyEntry = '';
  					$core = new Core;

  					if ($row['dosage']!=$dosage){

  						$historyEntry .= 'history ='.$core->ConcatFieldString('history', "Update dosage from ".$row['dosage']." to ".$dosage." / ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']." \n").', ';
						//echo $historyEntry;

  					}



  					if ($row['times_per_day']!=$timesperday){

  						$historyEntry .= "history =".$core->ConcatFieldString('history', "Update times_per_day from ".$row['times_per_day']." to ".$timesperday." / ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']." \n").", ";
						//echo $historyEntry;
  					}

  					if ($row['days']!=$days){

  						$historyEntry .= "history =".$core->ConcatFieldString('history', "Update days from ".$row['days']." to ".$days." / ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']." \n").", ";
						//echo $historyEntry;
  					}

  					if ($row['notes']!=$notes){

  						$historyEntry .= "history =".$core->ConcatFieldString('history', "Update notes from".$row['notes']." to ".$notes." / ".date('Y-m-d H:i:s')." ".$_SESSION['notes']." \n").", ";

  					}

  					if ($historyEntry != '')
  					{
						$historyEntry = substr($historyEntry, 0, -2);
						$sqlHist = 'UPDATE care_encounter_prescription SET '.$historyEntry.' WHERE nr = '.$nr;
						//echo $sqlHist;
						$db->execute($sqlHist);
  					}

  					//echo 'UPDATE care_encounter_prescription SET '.$historyEntry.' WHERE nr = '.$nr;




  		            $sql="UPDATE care_encounter_prescription SET
  		                          `dosage`='$dosage',
  		                          `times_per_day`='$timesperday',
  		                          `days`='$days',
  		                          `notes`='$notes',
  		                          `prescriber`='$prescriber'
  		                  WHERE nr=$nr";

  		                  //echo $sql;

                  $db->Execute($sql);

                  					//*******
 								  	// Load the visual signalling functions
									include_once($root_path.'include/inc_visual_signalling_fx.php');
									// Set the visual signal
									setEventSignalColor($encounter_nr,SIGNAL_COLOR_DOCTOR_INFO);
									//********
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
  		header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&externalcall=".$externalcall."&backpath=".urlencode($backpath)."&prescrServ=".$_GET['prescrServ']."&pid=".$_SESSION['sess_pid']);
} else
  header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&backpath=".urlencode($backpath)."&prescrServ=".$_GET['prescrServ']."&pid=".$_SESSION['sess_pid']);

exit();
?>