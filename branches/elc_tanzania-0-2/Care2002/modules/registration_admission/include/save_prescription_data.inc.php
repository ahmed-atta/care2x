<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('save_admission_data.inc.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');	
	
$obj->setDataArray($HTTP_POST_VARS);

switch($mode){	
		case 'create': 
								if($obj->insertDataFromInternalArray()) {
								  //echo "inserted item number:".$item_number."<br>";
								  //echo "Elements in array:".count($item_array)."<br>";
								  unset ($item_array[$item_number]);
								  $item_array=array_values($item_array);
								  //echo "Elemets now in array:".count($item_array)."<br>";
								  //echo "Index im Array:".$item_number."<br>";
								  $_SESSION['item_array']=$item_array;
								  if (count($item_array)==0) unset($item_array);
								  
								  if (count($item_array)>0)
								    $no_redirect =1;
								  else
								    $no_redirect =0;
								    
									if(!$no_redirect){
									  if (isset($externalcall))
										  header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&externalcall=".$externalcall."&pid=".$HTTP_SESSION_VARS['sess_pid']);
										else
										  header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&pid=".$HTTP_SESSION_VARS['sess_pid']);
										//echo "$obj->getLastQuery<br>$LDDbNoSave";
										exit;
									}
								} else{
                                   echo "$obj->getLastQuery<br>$LDDbNoSave";
                                   $error=TRUE;
                                }
								break;
		case 'update': 
								$obj->where=' nr='.$nr;
								if($obj->updateDataFromInternalArray($nr)) {
									if(!$no_redirect){
										header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&pid=".$HTTP_SESSION_VARS['sess_pid']);
										//echo "$obj->sql<br>$LDDbNoUpdate";
										exit;
									}
								} else{
                                  echo "$obj->getLastQuery<br>$LDDbNoUpdate";
                                  $error=TRUE;
                                }
								break;
}// end of switch

?>