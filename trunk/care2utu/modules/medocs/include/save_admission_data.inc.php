<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('save_admission_data.inc.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');	

	
$obj->setDataArray($HTTP_POST_VARS);
	
switch($mode)
{	
	case 'create': 
								if($obj->insertDataFromInternalArray()) {
									if(isset($redirect)&&$redirect){
										header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&mode=details&encounter_nr=".$_SESSION['sess_en']."&nr=".$HTTP_POST_VARS['ref_notes_nr']);
										exit;
									}
								} else echo "$obj->sql<br>$LDDbNoSave";
								break;
	case 'update': 
								$obj->where=' nr='.$nr;
								if($obj->updateDataFromInternalArray($nr)) {
									if($redirect){
										header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&encounter_nr=".$_SESSION['sess_en']);
										echo "$obj->sql<br>$LDDbNoUpdate";
										exit;
									}
								} else echo "$obj->sql<br>$LDDbNoUpdate";
								break;
}// end of switch

?>
