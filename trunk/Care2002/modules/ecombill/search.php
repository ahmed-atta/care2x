<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

define('LANG_FILE','aufnahme.php');

$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');

require_once($root_path.'include/inc_config_color.php');

$keyword=strtr($keyword,'%',' ');
$keyword=trim($keyword);

$toggle=0;

 /* Set color values for the search mask */
$searchmask_bgcolor='#f3f3f3';
$searchprompt=$LDEntryPrompt;
$entry_block_bgcolor='#fff3f3';
$entry_border_bgcolor='#6666ee';
$entry_body_bgcolor='#ffffff';

if(!isset($searchkey)) $searchkey='';
if(!isset($mode)) $mode='';


if(($mode=='search')&&($searchkey)){

	include_once($root_path.'include/care_api_classes/class_globalconfig.php');
	$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
	$glob_obj->getConfig('patient_%');

	$suchwort=trim($searchkey);
	if(is_numeric($suchwort)){
	
		$suchwort=(int) $suchwort;
		$numeric=1;
		//if($suchwort < $patient_inpatient_nr_adder) $suchbuffer=$suchwort+$patient_inpatient_nr_adder; else $suchbuffer=$suchwort;
		$suchbuffer=$suchwort;
	}
			
	$sql="SELECT enc.encounter_nr, reg.name_last, reg.name_first, reg.date_birth, enc.encounter_class_nr, enc.is_discharged
			FROM care_encounter as enc,care_person as reg 
			WHERE
						(
			            	reg.name_last LIKE '".addslashes($suchwort)."%' 
							OR reg.name_first LIKE '".addslashes($suchwort)."%'
							OR reg.date_birth LIKE '".@formatDate2Std($suchwort,$date_format)."%'
							OR enc.encounter_nr LIKE '".addslashes($suchbuffer)."'
						)
						AND enc.pid=reg.pid  
						AND NOT enc.is_discharged
						AND enc.status NOT IN ('deleted','inactive','closed','hidden','void')
			ORDER BY enc.encounter_nr ";
					  
	if($ergebnis=$db->Execute($sql)){
				
		if ($linecount=$ergebnis->RecordCount()){ 
			if(($linecount==1)&&$numeric){
				$zeile=$ergebnis->FetchRow();
				switch ($zeile['encounter_class_nr'])
				{
				    case '1': $full_en = ($zeile['encounter_nr'] + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
					            break;
					case '2': $full_en = ($zeile['encounter_nr'] + $GLOBAL_CONFIG['patient_outpatient_nr_adder']);
								break;
				    default: $full_en = ($zeile['encounter_nr'] + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
				}						
				header('location:patientbill.php'.URL_REDIRECT_APPEND.'&patnum='.$zeile['encounter_nr'].'&update=1&mode='.$mode.'&full_en='.$full_en);
				exit;
			}
		}
	}else{echo "<p>".$sql."<p>$LDDbNoRead";};
}else{
	$mode='';
}
?>


<html>

<head>
<title>Patient Name</title>
</head>

<body topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  onLoad="document.searchform.searchkey.select()" >
<table border="0" width="101%" bgcolor=#99ccff>
      <tr>
        <td width="101%"><font color="#330066" size="+2" face="Arial"><strong>eComBill - Search</strong></font></td>
      </tr>
    </table>

<ul>

<FONT    SIZE=-1  FACE="Arial">


		 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php

            include($root_path.'include/inc_patient_searchmask.php');
       
	   ?>
</td>
     </tr>
   </table>


<p>
<a href=<?php  	echo '"billingmenu.php'.URL_APPEND.'&target=search">'; ?><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
<p>

<?php
if($mode=='search'){
	if(!$linecount) $linecount=0;
	echo '<p>'.str_replace("~nr~",$linecount,$LDSearchFound).'<p>';
		  
	if ($linecount) { 

	/* Load the common icons */
	$img_options=createComIcon($root_path,'dollarsign.gif','0');

	echo '
			<table border=0 cellpadding=2 cellspacing=1> 
			<tr bgcolor="#0000aa" background="'.createBgSkin($root_path,'tableHeaderbg.gif').'">';
			
?>

    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDCaseNr; ?></b></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDLastName; ?></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDFirstName; ?></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDBday; ?></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDOptions; ?></td>
	</tr>
<?php
/*				for($i=0;$i<sizeof($fieldname);$i++) {
						echo'
						<td><font face=arial size=2 color="#ffffff"><b>'.$fieldname[$i].'</b></td>';
		
					}*/					

					while($zeile=$ergebnis->FetchRow())
					{
						switch ($zeile['encounter_class_nr'])
						{
						    case '1': $full_en = ($zeile['encounter_nr'] + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
							            break;
							case '2': $full_en = ($zeile['encounter_nr'] + $GLOBAL_CONFIG['patient_outpatient_nr_adder']);
										break;
						    default: $full_en = ($zeile['encounter_nr'] + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
						}						
						
						echo "
							<tr bgcolor=";
						if($toggle) { echo "#efefef>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
						echo"<td><font face=arial size=2>";
                        echo '&nbsp;'.$full_en;
						if($zeile['encounter_class_nr']=='2') echo ' <img '.createComIcon($root_path,'redflag.gif').'> <font size=1 color="red">'.$LDAmbulant.'</font>';
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".ucfirst($zeile['name_last']);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".ucfirst($zeile['name_first']);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".formatDate2Local($zeile['date_birth'],$date_format);
                        echo "</td>";	
						
						// Temporarily set to edit-for-all-user mode
					    //if($HTTP_COOKIE_VARS[$local_user.$sid]) echo '
					   echo '
						<td><font face=arial size=2>&nbsp;
							<a href="patientbill.php'.URL_APPEND.'&patnum='.$zeile['encounter_nr'].'&update=1&mode='.$mode.'&full_en='.$full_en.'">
							<img '.$img_options.' alt="Bill this patient"></a>&nbsp;';
							
                       if(!file_exists($root_path.'cache/barcodes/en_'.$full_en.'.png'))
	      		       {
			               echo "<img src='".$root_path."classes/barcode/image.php?code=".$full_en."&style=68&type=I25&width=145&height=50&xres=2&font=5&label=2&form_file=en' border=0 width=0 height=0>";
		               }
						
						echo '</td></tr>';

					}
					echo "
						</table>";
					if($linecount>15)
					{
					    /* Set the appending nr for the searchform */
					    $searchform_count=2;
					?>
			<p>
		 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php
            include($root_path.'include/inc_patient_searchmask.php');
	   ?>
</td>
     </tr>
   </table>
					<?php
					}
	}
	echo '</td>
			</tr>
		</table>';
}
?>
</ul>
<p>&nbsp;<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>

</body></html>
