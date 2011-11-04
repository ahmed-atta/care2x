<?php 
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
define('MODULE','registration_admission');
define('LANG_FILE_MODULAR','registration_admission.php');
$local_user='aufnahme_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');
require_once($root_path.'include/helpers/inc_date_format_functions.php');
# Create the notes object
require_once($root_path.'modules/nursing/model/class_notes.php');
$obj=new Notes;
# Load the notes
if($n_obj=&$obj->getEncounterNotes($nr)) $notes=$n_obj->FetchRow();

# Prepare variables for template
$bd=@formatDate2Local($bd,$date_format);

$TP_DATE=@formatDate2Local($notes['date'],$date_format);
$TP_TIME=@convertTimeToLocal($notes['time']);
$TP_DOC=$notes['staff_name'];
$TP_USR=$notes['modify_id']; 
$TP_NOTES=nl2br($notes['notes']);
$TP_CLOSE='<a href="javascript:window.close()"><img '.createLDImgSrc($root_path,'close2.gif','0').'></a>';

# Load the template
$smarty->assign('title',$title);
$smarty->assign('ln',$ln);
$smarty->assign('fn',$fn);
$smarty->assign('bd',$bd);
$smarty->assign('title',$title);
$smarty->assign('TP_NOTES',$TP_NOTES);
$smarty->assign('TP_DATE',$TP_DATE);
$smarty->assign('TP_TIME',$TP_TIME);
$smarty->assign('TP_DOC',$TP_DOC);
$smarty->assign('TP_USR',$TP_USR);
$smarty->assign('TP_CLOSE',$TP_CLOSE);
$smarty->display('/view/tp_show_notes_details.tpl');
?>