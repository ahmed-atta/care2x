<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('save_admission_data.inc.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');	


$debug=FALSE;
($debug)?$db->debug=TRUE:$db->debug=FALSE;
$i=0;
if($mode=='delete') $arr_item_number[0] = $nr;
foreach ($arr_item_number AS $item_number) {	
  
  $dosage               = $arr_dosage[$i];
  $notes                = $arr_notes[$i];
  $article_item_number  = $arr_article_item_number[$i];
  $price                = $arr_price[$i];
  $article              = $arr_article[$i];
  
  $i++;
  
  //$obj->setDataArray($HTTP_POST_VARS);
  
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
  		                          
								  //if (isset($externalcall))
									//  header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&externalcall=".$externalcall."&pid=".$HTTP_SESSION_VARS['sess_pid']);
 								  //exit;
  								break;
  		case 'update': 
  		            $sql="UPDATE care_encounter_prescription SET
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
									//  header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&externalcall=".$externalcall."&pid=".$HTTP_SESSION_VARS['sess_pid']);
 								  //exit;
  								break;
  }// end of switch
} // end of foreach  

if (isset($externalcall))
  header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&externalcall=".$externalcall."&pid=".$HTTP_SESSION_VARS['sess_pid']);
else
  header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&pid=".$HTTP_SESSION_VARS['sess_pid']);

exit();
?>