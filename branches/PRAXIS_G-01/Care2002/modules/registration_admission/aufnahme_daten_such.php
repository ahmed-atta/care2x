<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, elpidio@care2x.net
*
* See the file "copy_notice.txt" for the licence notice
*/

# Default value for the maximum nr of rows per block displayed, define this to the value you wish
# In normal cases this value is derived from the db table "care_config_global" using the "pagin_insurance_list_max_block_rows" element.
define('MAX_BLOCK_ROWS',30); 

define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');

$thisfile=basename(__FILE__);
$toggle=0;

if($HTTP_COOKIE_VARS['ck_login_logged'.$sid]) $breakfile=$root_path.'main/startframe.php'.URL_APPEND;
	else $breakfile='aufnahme_pass.php'.URL_APPEND.'&target=entry';

# Set color values for the search mask 
$searchmask_bgcolor='#f3f3f3';
$searchprompt=$LDEntryPrompt;
$entry_block_bgcolor='#fff3f3';
$entry_border_bgcolor='#6666ee';
$entry_body_bgcolor='#ffffff';

# Special case for direct access from patient listings
# If forward nr ok, use it as searchkey
if(isset($fwd_nr)&&$fwd_nr&&is_numeric($fwd_nr)){
	$searchkey=$fwd_nr;
	$mode='search';
}else{
	if(!isset($searchkey)) $searchkey='';
}

if(!isset($mode)) $mode='';

# Initialize page´s control variables
if($mode=='paginate'){
	$searchkey=$HTTP_SESSION_VARS['sess_searchkey'];
}else{
	# Reset paginator variables
	$pgx=0;
	$totalcount=0;
	$odir='';
	$oitem='';
}
#Load and create paginator object
require_once($root_path.'include/care_api_classes/class_paginator.php');
$pagen=new Paginator($pgx,$thisfile,$HTTP_SESSION_VARS['sess_searchkey'],$root_path);

if(isset($mode)&&($mode=='search'||$mode=='paginate')&&isset($searchkey)&&($searchkey)){
	
	include_once($root_path.'include/inc_date_format_functions.php');
	
	//$db->debug=true;

	if($mode!='paginate'){
		$HTTP_SESSION_VARS['sess_searchkey']=$searchkey;
	}	
		# convert * and ? to % and &
		$searchkey=strtr($searchkey,'*?','%_');
		
		$GLOBAL_CONFIG=array();
		include_once($root_path.'include/care_api_classes/class_globalconfig.php');
		$glob_obj=new GlobalConfig($GLOBAL_CONFIG);

		# Get the max nr of rows from global config
		$glob_obj->getConfig('pagin_patient_search_max_block_rows');
		if(empty($GLOBAL_CONFIG['pagin_patient_search_max_block_rows'])) $pagen->setMaxCount(MAX_BLOCK_ROWS); # Last resort, use the default defined at the start of this page
			else $pagen->setMaxCount($GLOBAL_CONFIG['pagin_patient_search_max_block_rows']);
		
	   	$searchkey=trim($searchkey);
		$suchwort=$searchkey;
		
		if(is_numeric($suchwort)) {

            $suchwort=(int) $suchwort;
			$numeric=1;
			
			if(empty($oitem)) $oitem='encounter_nr';			
			if(empty($odir)) $odir='DESC'; # default, latest pid at top
			
			$sql2=" WHERE ( enc.encounter_nr='$suchwort'  OR enc.encounter_nr $sql_LIKE '%.$suchwort' )";
	    } else {
			# Try to detect if searchkey is composite of first name + last name
			if(stristr($searchkey,',')){
				$lastnamefirst=TRUE;
			}else{
				$lastnamefirst=FALSE;
			}
			
			$searchkey=strtr($searchkey,',',' ');
			$cbuffer=explode(' ',$searchkey);

			# Remove empty variables
			for($x=0;$x<sizeof($cbuffer);$x++){
				$cbuffer[$x]=trim($cbuffer[$x]);
				if($cbuffer[$x]!='') $comp[]=$cbuffer[$x];
			}
			
			# Arrange the values, ln= lastname, fn=first name, bd = birthday
			if($lastnamefirst){
				$fn=$comp[1];
				$ln=$comp[0];
				$bd=$comp[2];
			}else{
				$fn=$comp[0];
				$ln=$comp[1];
				$bd=$comp[2];
			}
			
			if(empty($oitem)) $oitem='name_last';			
			
			# Check the size of the comp
			if(sizeof($comp)>1){
				$sql2=" WHERE ( reg.name_last $sql_LIKE '".strtr($ln,'+',' ')."%'
			                		AND reg.name_first $sql_LIKE '".strtr($fn,'+',' ')."%')";
				if($bd){ 
					$stddate=formatDate2STD($bd,$date_format);
					if(!empty($stddate)){
						$sql2.=" AND (reg.date_birth = '$stddate' OR reg.date_birth $sql_LIKE '%$bd%')";
					}
				}
					
				if(empty($odir)) $odir='DESC'; # default, latest birth at top
		
			}else{
			
				$sql2=" WHERE (reg.name_last $sql_LIKE '".strtr($suchwort,'+',' ')."%'
			                		OR reg.name_first $sql_LIKE '".strtr($suchwort,'+',' ')."%'";
				$bufdate=formatDate2STD($suchwort,$date_format);
				if(!empty($bufdate)){
					$sql2.= " OR reg.date_birth $sql_LIKE '$bufdate'";
				}
				$sql2.=")";
				if(empty($odir)) $odir='ASC'; # default, ascending alphabetic
			}
		}

			$sql2.=" AND enc.pid=reg.pid
					  AND enc.encounter_status <> 'cancelled'
					  AND (enc.is_discharged = '' OR enc.is_discharged=0)
					  AND enc.status NOT IN ('void','hidden','inactive','deleted')  ORDER BY ";

			# Filter if it is personnel nr
			if($oitem=='encounter_nr') $sql2.='enc.'.$oitem.' '.$odir;
				else $sql2.='reg.'.$oitem.' '.$odir;

			$dbtable='FROM care_encounter as enc,care_person as reg ';

			$sql='SELECT enc.encounter_nr, enc.encounter_class_nr, enc.is_discharged,
								reg.name_last, reg.name_first, reg.date_birth, reg.addr_zip,reg.sex '.$dbtable.$sql2;
			//echo $sql;

			if($ergebnis=$db->SelectLimit($sql,$pagen->MaxCount(),$pagen->BlockStartIndex()))
       		{
				if ($linecount=$ergebnis->RecordCount()) 
				{
					if(($linecount==1)&&$numeric&&$mode=='search')
					{
						$zeile=$ergebnis->FetchRow();
						header('Location:aufnahme_daten_zeigen.php'.URL_REDIRECT_APPEND.'&from=such&encounter_nr='.$zeile['encounter_nr'].'&target=search');
						exit;
					}
					
					$pagen->setTotalBlockCount($linecount);
					
					# If more than one count all available
					if(isset($totalcount)&&$totalcount){
						$pagen->setTotalDataCount($totalcount);
					}else{
						# Count total available data
						if($dbtype=='mysql'){
							$sql='SELECT COUNT(enc.encounter_nr) AS "count" '.$dbtable.$sql2;
						}else{
							$sql='SELECT * '.$dbtable.$sql2;
						}

						if($result=$db->Execute($sql)){
							if ($totalcount=$result->RecordCount()) {
								if($dbtype=='mysql'){
									$rescount=$result->FetchRow();
    									$totalcount=$rescount['count'];
								}
    							}
						}
						$pagen->setTotalDataCount($totalcount);
					}
					# Set the sort parameters
					$pagen->setSortItem($oitem);
					$pagen->setSortDirection($odir);
				}
				
			}
			 else {echo "<p>".$sql."<p>$LDDbNoRead";};
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in the toolbar
 //$smarty->assign('sToolbarTitle',$LDPatientSearch);
 $smarty->assign('sToolbarTitle',"$LDAdmission :: $LDSearch");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDPatientSearch);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('admission_how2search.php','$from')");

  # Onload Javascript code
 $smarty->assign('sOnLoadJs','onLoad="document.searchform.searchkey.select()"');

 # Hide the return button
 $smarty->assign('pbBack',FALSE);

// Load tabs

$target='search';
$parent_admit = TRUE;

include('./gui_bridge/default/gui_tabs_patadmit.php');

 # Start buffering

 ob_start();
?>

&nbsp;
<br>

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
<a href=<?php  	echo '"patient.php'.URL_APPEND.'&target=search">'; ?><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
<p>

<?php
if($mode=='search'||$mode=='paginate'){
	if ($linecount) echo '<hr width=80% align=left>'.str_replace("~nr~",$totalcount,$LDSearchFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.';
		else echo str_replace('~nr~','0',$LDSearchFound); 
		  
	if ($linecount) {

		# Load the common icons and images
		$img_options=createComIcon($root_path,'pdata.gif','0');
		$img_male=createComIcon($root_path,'spm.gif','0');
		$img_female=createComIcon($root_path,'spf.gif','0');

		$bgimg='tableHeaderbg3.gif';
		//$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/'.$bgimg.'"';

		echo '
			<table border=0 cellpadding=2 cellspacing=1>
			<tr class="wardlisttitlerow">';
			
?>

      <td><b>
	  <?php 
	  	if($oitem=='encounter_nr') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDCaseNr,'encounter_nr',$odir,$flag); 
			 ?></b></td>
      <td><b>
	  <?php 
	  	if($oitem=='sex') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDSex,'sex',$odir,$flag); 
			 ?></b></td>
      <td><b>
	  <?php 
	  	if($oitem=='name_last') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDLastName,'name_last',$odir,$flag); 
			 ?></b></td>
      <td><b>
	  <?php 
	  	if($oitem=='name_first') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDFirstName,'name_first',$odir,$flag); 
			 ?></b></td>
      <td><b>
	  <?php 
	  	if($oitem=='date_birth') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDBday,'date_birth',$odir,$flag); 
			 ?></b></td>
      <td align='center'><b>
	  <?php 
	  	if($oitem=='addr_zip') $flag=TRUE;
			else $flag=FALSE;
		 echo $pagen->SortLink($LDZipCode,'addr_zip',$odir,$flag); 
		 	
		?></b></td>
		<td background="<?php echo createBgSkin($root_path,'tableHeaderbg.gif'); ?>"><font color="#ffffff"><b><?php echo $LDOptions; ?></td>

<?php

					echo"</tr>";

					while($zeile=$ergebnis->FetchRow())
					{
						$full_en=$zeile['encounter_nr'];
						echo "
							<tr class=";
						if($toggle) { echo "wardlistrow2>"; $toggle=0;} else {echo "wardlistrow1>"; $toggle=1;};
						echo '<td>';
                        echo '&nbsp;'.$full_en;
						if($zeile['encounter_class_nr']==2) echo ' <img '.createComIcon($root_path,'redflag.gif').'> <font size=1 color="red">'.$LDAmbulant.'</font>';
                        echo '&nbsp;</td>';	

						echo '<td>';
						switch($zeile['sex']){
							case 'f': echo '<img '.$img_female.'>'; break;
							case 'm': echo '<img '.$img_male.'>'; break;
							default: echo '&nbsp;'; break;
						}				
                        echo '</td>
						';

						echo '<td>';
						echo '&nbsp;'.ucfirst($zeile['name_last']);
                        echo '</td>';	
						echo '<td>';
						echo '&nbsp;'.ucfirst($zeile['name_first']);
                        echo '</td>';	
						echo '<td>';
						echo '&nbsp;'.formatDate2Local($zeile['date_birth'],$date_format);
                        echo '</td>';	
                        echo '</td>
					    <td align=right>&nbsp; &nbsp;'.$zeile['addr_zip'].'</td>';

					    if($HTTP_COOKIE_VARS[$local_user.$sid]) echo '
						<td>&nbsp;
							<a href=aufnahme_daten_zeigen.php'.URL_APPEND.'&from=such&encounter_nr='.$zeile['encounter_nr'].'&target=search>
							<img '.$img_options.' alt="'.$LDShowData.'"></a>&nbsp;';
							
                       if(!file_exists($root_path.'cache/barcodes/en_'.$full_en.'.png'))
	      		       {
			               echo "<img src='".$root_path."classes/barcode/image.php?code=".$full_en."&style=68&type=I25&width=180&height=50&xres=2&font=5&label=2&form_file=en' border=0 width=0 height=0>";
		               }
						echo '</td></tr>';

					}
					echo '
						<tr><td colspan=6>'.$pagen->makePrevLink($LDPrevious).'</td>
						<td align=right>'.$pagen->makeNextLink($LDNext).'</td>
						</tr>
						</table>';
					if($linecount>$pagen->MaxCount())
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
}
?>
<p>
<hr width=80% align=left><p>
<a href="aufnahme_start.php<?php echo URL_APPEND; ?>&mode=?"><?php echo $LDAdmWantEntry ?></a><br>
<a href="aufnahme_list.php<?php echo URL_APPEND; ?>"><?php echo $LDAdmWantArchive ?></a>
<p>

<?php

# Stop buffering, assign contents and display template

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->assign('sMainDataBlock',$sTemp);

$smarty->assign('sMainBlockIncludeFile','registration_admission/admit_plain.tpl');

$smarty->display('common/mainframe.tpl');

?>

