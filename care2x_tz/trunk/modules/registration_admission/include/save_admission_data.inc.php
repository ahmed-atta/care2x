<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('save_admission_data.inc.php',$PHP_SELF))
	die('<meta http-equiv="refresh" content="0; url=../">');

	include_once($root_path.'include/care_api_classes/class_multi.php');
 	$multi= new multi;

	$multi->doctorSTAT($_SESSION['sess_login_userid'],$encounter_nr);

	$obj->setDataArray($HTTP_POST_VARS);

	switch($mode){
		case 'create':
				if($obj->insertDataFromInternalArray()) {
					if(!$no_redirect){
						header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&pid=".$_SESSION['sess_pid']);
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
						header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&pid=".$_SESSION['sess_pid']);
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