<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.06 - 2003-08-06
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/

define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');

/*if(empty($date_format))
{
   $date_format=getDateFormat($link,$DBLink_OK);
}
*/


$thisfile=basename(__FILE__);
$breakfile='patient.php';

$newdata=1;

$dbtable='care_person';

$target='archiv';

$error=0;

require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('person%');
	
if (isset($mode) && ($mode=='search'))
{
    if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
    if($dblink_ok) {

	  //* Get the global config for patient's registration form*/
       //include_once($root_path.'include/inc_get_global_config.php');



							$sql="SELECT * FROM $dbtable WHERE ";
							$s2='';
							
							if(isset($pid)&&$pid)
							{
						         if($pid < $GLOBAL_CONFIG['person_id_nr_adder'])
								 {
								 		$s2.=" pid LIKE \"%$pid\"";
								 }
								 else
								 {
								       $s2.=" pid = ".($GLOBAL_CONFIG['person_id_nr_adder']);
								}
							}
						
							
							if(isset($name_last)&&$name_last)
							{
							     if($s2) $s2.=" AND name_last LIKE \"$name_last%\""; else $s2.=" name_last LIKE \"$name_last%\"";
							}
							
							if(!isset($date_start)) $date_start='';
							if(!isset($date_end)) $date_end='';
							
							if($date_start)
								{
								    $date_start=@formatDate2STD($date_start,$date_format);
  								}
							if($date_end)
								{
								    $date_end=@formatDate2STD($date_end,$date_format);
							   }
							   
							$buffer='';
							if(($date_start)&&($date_end))
								{
									$buffer=" ((date_reg > \"$date_start\" OR date_reg LIKE \"$date_start %\") AND (date_reg <  \"$date_end\" OR date_reg LIKE \"$date_end %\"))";
									//if($s2) $s2.=" AND ((date_reg > \"$date_start\" OR date_reg LIKE \"$date_start %\") AND (date_reg <  \"$date_end\" OR date_reg LIKE \"$date_end %\"))"; else $s2.=" ((date_reg > \"$date_start\" OR date_reg LIKE \"$date_start %\") AND (date_reg <  \"$date_end\" OR date_reg LIKE \"$date_end %\"))";
								}
								elseif($date_start)
								{
									$buffer=" date_reg LIKE \"$date_start %\"";
									//if($s2) $s2.=" AND date_reg LIKE \"$date_start %\""; else $s2.=" date_reg LIKE \"$date_start %\"";
								}
								elseif($date_end)
								{
									$buffer=" (date_reg < \"$date_end\" OR date_reg LIKE \"$date_end %\")";
									//if($s2) $s2.=" AND (date_reg LIKE \"$date_end %\" OR date_reg LIKE \"$date_end %\")"; else $s2.=" date_reg LIKE \"$date_end %\"";
								}
								if($buffer){
									if($s2) $s2.=" AND $buffer";
										else $s2=$buffer;
								}
									
							if(isset($user_id)&&$user_id)
								if($s2) $s2.=" AND modify_id LIKE \"$user_id%\""; else $s2.=" modify_id LIKE \"$user_id%\"";
								
								
							if(isset($name_first)&&$name_first)
								if($s2) $s2.=" AND name_first LIKE \"$name_first%\""; else $s2.=" name_first LIKE \"$name_first%\"";
							if(isset($name_2)&&$name_2)
								if($s2) $s2.=" AND name_2 LIKE \"$name_2%\""; else $s2.=" name_2 LIKE \"$name_2%\"";
								
							if(isset($name_3)&&$name_3)
								if($s2) $s2.=" AND name_3 LIKE \"$name_3%\""; else $s2.=" name_3 LIKE \"$name_3%\"";
							if(isset($name_middle)&&$name_middle)
								if($s2) $s2.=" AND name_middle LIKE \"$name_middle%\""; else $s2.=" name_middle LIKE \"$name_middle%\"";
							if(isset($name_maiden)&&$name_maiden)
								if($s2) $s2.=" AND name_maiden LIKE \"$name_maiden%\""; else $s2.=" name_maiden LIKE \"$name_maiden%\"";
							if(isset($name_others)&&$name_others)
								if($s2) $s2.=" AND name_others LIKE \"$name_others%\""; else $s2.=" name_others LIKE \"$name_others%\"";

							if(isset($date_birth)&&$date_birth)
							  {
							    $date_birth=@formatDate2STD($date_birth,$date_format);
								
								if($s2) $s2.=" AND date_birth=\"$date_birth\""; else $s2.=" date_birth=\"$date_birth\"";
							  }
							  
							if(isset($addr_str)&&$addr_str)
								if($s2) $s2.=" AND addr_str LIKE \"%$addr_str%\""; else $s2.=" addr_str LIKE \"%$addr_str%\"";

							if(isset($addr_str_nr)&&$addr_str_nr)
								if($s2) $s2.=" AND addr_str_nr LIKE \"%$addr_str_nr%\""; else $s2.=" addr_str_nr LIKE \"%$addr_str_nr%\"";
							if(isset($addr_citytown_nr)&&$addr_citytown_nr)
								if($s2) $s2.=" AND addr_citytown_nr LIKE \"$addr_citytown_nr\""; else $s2.=" addr_citytown_nr LIKE \"$addr_citytown_nr\"";
							if(isset($addr_zip)&&$addr_zip)
								if($s2) $s2.=" AND addr_zip LIKE \"%$addr_zip%\""; else $s2.=" addr_zip LIKE \"%$addr_zip%\"";
								
							if(isset($sex)&&$sex)
								if($s2) $s2.=" AND sex LIKE \"$sex\""; else $s2.=" sex LIKE \"$sex\"";
							if(isset($civil_status)&&$civil_status)
								if($s2) $s2.=" AND civil_status LIKE \"$civil_status%\""; else $s2.=" civil_status LIKE \"$civil_status%\"";
							if(isset($phone_1)&&$phone_1)
								if($s2) $s2.=" AND phone_1_nr LIKE \"$phone_1%\""; else $s2.=" phone_1_nr LIKE \"$phone_1%\"";
							if(isset($phone_2)&&$phone_2)
								if($s2) $s2.=" AND phone_2_nr LIKE \"$phone_2%\""; else $s2.=" phone_2_nr LIKE \"$phone_2%\"";
							if(isset($cellphone_1)&&$cellphone_1)
								if($s2) $s2.=" AND cellphone_1_nr LIKE \"$cellphone_1%\""; else $s2.=" cellphone_1_nr LIKE \"$cellphone_1%\"";
							if(isset($cellphone_2)&&$cellphone_2)
								if($s2) $s2.=" AND cellphone_2_nr LIKE \"$cellphone_2%\""; else $s2.=" cellphone_2_nr LIKE \"$cellphone_2%\"";
								
							if(isset($fax)&&$fax)
								if($s2) $s2.=" AND fax LIKE \"$fax%\""; else $s2.=" fax LIKE \"$fax%\"";
							if(isset($email)&&$email)
								if($s2) $s2.=" AND email LIKE \"%$email%\""; else $s2.=" email LIKE \"%$email%\"";
							if(isset($sss_nr)&&$sss_nr)
								if($s2) $s2.=" AND sss_nr LIKE \"$sss_nr%\""; else $s2.=" sss_nr LIKE \"$sss_nr%\"";
							if(isset($nat_id_nr)&&$nat_id_nr)
								if($s2) $s2.=" AND nat_id_nr LIKE \"$nat_id_nr%\""; else $s2.=" nat_id_nr LIKE \"$nat_id_nr%\"";
							if(isset($religion)&&$religion)
								if($s2) $s2.=" AND religion LIKE \"$religion%\""; else $s2.=" religion LIKE \"$religion%\"";
							if(isset($ethnic_orig)&&$ethnic_orig)
								if($s2) $s2.=" AND ethnic_orig LIKE \"$ethnic_orig%\""; else $s2.=" ethnic_orig LIKE \"$ethnic_orig%\"";
								
							$sql=$sql.$s2." ORDER BY name_last";
							//echo $sql;
							
							if($s2!="")
							{
								if($ergebnis=$db->Execute($sql)) 
								{			
						  			$rows=$ergebnis->RecordCount();
									
							        if($rows==1)
							       {
								       //* If result is single item, display the data immediately */
									   $result=$ergebnis->FetchRow();
									   header("Location:patient_register_show.php".URL_REDIRECT_APPEND."&target=archiv&origin=archiv&pid=".$result['pid']);
									   exit;
							        }
								}else echo "$LDDbNoRead<p> $sql <p>";
								
                            }
					
  }
  else 
  { echo "$LDDbNoLink<br>"; }

}

/* Load GUI page */
require('./gui_bridge/default/gui_person_reg_archive.php');

?>
