<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.0 - 2004-05-16
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
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
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE></TITLE>

<?php 
require($root_path.'include/inc_js_gethelp.php'); 
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  onLoad="document.searchform.searchkey.select()" bgcolor=<?php echo $cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<table width=100% border=0 cellspacing="0" cellpadding=0>

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+1  FACE="Arial"><STRONG> &nbsp;<?php echo $LDPatientSearch ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('admission_how2search.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
if($HTTP_COOKIE_VARS["ck_login_logged".$sid]) echo $root_path."main/startframe.php?sid=".$sid."&lang=".$lang; 
	else echo "aufnahme_pass.php?sid=$sid&target=entry&lang=$lang"; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>

<!-- Load tabs -->
<?php

$target='search';
 include('./gui_bridge/default/gui_tabs_patadmit.php') 

?>

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
	$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/'.$bgimg.'"';

	echo '
			<table border=0 cellpadding=2 cellspacing=1> <tr bgcolor="#abcdef" background="'.createBgSkin($root_path,'tableHeaderbg.gif').'">';
			
?>

      <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>
	  <?php 
	  	if($oitem=='encounter_nr') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDCaseNr,'encounter_nr',$odir,$flag); 
			 ?></b></td>
      <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>
	  <?php 
	  	if($oitem=='sex') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDSex,'sex',$odir,$flag); 
			 ?></b></td>
      <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>
	  <?php 
	  	if($oitem=='name_last') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDLastName,'name_last',$odir,$flag); 
			 ?></b></td>
      <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>
	  <?php 
	  	if($oitem=='name_first') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDFirstName,'name_first',$odir,$flag); 
			 ?></b></td>
      <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>
	  <?php 
	  	if($oitem=='date_birth') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDBday,'date_birth',$odir,$flag); 
			 ?></b></td>
      <td <?php echo $tbg; ?> align='center'><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>
	  <?php 
	  	if($oitem=='addr_zip') $flag=TRUE;
			else $flag=FALSE;
		 echo $pagen->SortLink($LDZipCode,'addr_zip',$odir,$flag); 
		 	
		?></b></td>
    <td background="<?php echo createBgSkin($root_path,'tableHeaderbg.gif'); ?>"><font face=arial size=2 color="#ffffff"><b><?php echo $LDOptions; ?></td>

<?php
/*				for($i=0;$i<sizeof($fieldname);$i++) {
						echo'
						<td><font face=arial size=2 color="#ffffff"><b>'.$fieldname[$i].'</b></td>';
		
					}*/					
					echo"</tr>";

					while($zeile=$ergebnis->FetchRow())
					{
/*						switch ($zeile['encounter_class_nr'])
						{
						    case '1': $full_en = ($zeile['encounter_nr'] + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
							            break;
							case '2': $full_en = ($zeile['encounter_nr'] + $GLOBAL_CONFIG['patient_outpatient_nr_adder']);
										break;
						    default: $full_en = ($zeile['encounter_nr'] + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
						}						
*/						
						$full_en=$zeile['encounter_nr'];
						echo "
							<tr bgcolor=";
						if($toggle) { echo "#efefef>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
						echo '<td><font face=arial size=2>';
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

						echo '<td><font face=arial size=2>';
						echo '&nbsp;'.ucfirst($zeile['name_last']);
                        echo '</td>';	
						echo '<td><font face=arial size=2>';
						echo '&nbsp;'.ucfirst($zeile['name_first']);
                        echo '</td>';	
						echo '<td><font face=arial size=2>';
						echo '&nbsp;'.formatDate2Local($zeile['date_birth'],$date_format);
                        echo '</td>';	
                        echo '</td>
					    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$zeile['addr_zip'].'</td>';	

					    if($HTTP_COOKIE_VARS[$local_user.$sid]) echo '
						<td><font face=arial size=2>&nbsp;
							<a href=aufnahme_daten_zeigen.php'.URL_APPEND.'&from=such&encounter_nr='.$zeile['encounter_nr'].'&target=search>
							<img '.$img_options.' alt="'.$LDShowData.'"></a>&nbsp;';
							
                       if(!file_exists($root_path.'cache/barcodes/en_'.$full_en.'.png'))
	      		       {
			               echo "<img src='".$root_path."classes/barcode/image.php?code=".$full_en."&style=68&type=I25&width=180&height=50&xres=2&font=5&label=2&form_file=en' border=0 width=0 height=0>";
		               }
						echo '</td></tr>';

					}
					echo '
						<tr><td colspan=6><font face=arial size=2>'.$pagen->makePrevLink($LDPrevious).'</td>
						<td align=right><font face=arial size=2>'.$pagen->makeNextLink($LDNext).'</td>
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
</ul>
&nbsp;
</FONT>
<p>

</ul>
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>

</FONT>


</BODY>
</HTML>
