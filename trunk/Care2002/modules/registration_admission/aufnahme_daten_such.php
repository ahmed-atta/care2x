<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
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

require_once($root_path.'include/inc_config_color.php');

$toggle=0;

 /* Set color values for the search mask */
$searchmask_bgcolor='#f3f3f3';
$searchprompt=$LDEntryPrompt;
$entry_block_bgcolor='#fff3f3';
$entry_border_bgcolor='#6666ee';
$entry_body_bgcolor='#ffffff';

if(!isset($searchkey)) $searchkey='';
if(!isset($mode)) $mode='';


if(($mode=='search')and($searchkey))
{
    if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
    if($dblink_ok) {
				
		/* Load global config */
		include_once($root_path.'include/care_api_classes/class_globalconfig.php');
        $glob_obj=new GlobalConfig($GLOBAL_CONFIG);
        $glob_obj->getConfig('patient_%');

			$suchwort=trim($searchkey);
			if(is_numeric($suchwort))
			{
				$suchwort=(int) $suchwort;
				$numeric=1;
				if($suchwort < $GLOBAL_CONFIG['patient_inpatient_nr_adder']) $suchbuffer= $suchwort; 
					else $suchbuffer=($suchwort - $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
			}else{
				$suchbuffer=$suchwort;
			}
			
			$sql='SELECT enc.encounter_nr, reg.name_last, reg.name_first, reg.date_birth, enc.encounter_class_nr, enc.is_discharged
			          FROM care_encounter as enc,care_person as reg 
			          WHERE
					  (
			               reg.name_last LIKE "'.addslashes($suchwort).'%" 
			              OR reg.name_first LIKE "'.addslashes($suchwort).'%"
			              OR reg.date_birth LIKE "'.@formatDate2Std($suchwort,$date_format).'%"
			              OR enc.encounter_nr LIKE "'.(int)$suchbuffer.'"
					  )
					  AND enc.pid=reg.pid  
					  AND NOT enc.is_discharged
			          ORDER BY enc.encounter_nr ';
					  
			if($ergebnis=$db->Execute($sql))
       		{
				
				if ($linecount=$ergebnis->RecordCount())
				{ 
					if(($linecount==1)&&$numeric)
					{
						$zeile=$ergebnis->FetchRow();
						header("location:aufnahme_daten_zeigen.php".URL_REDIRECT_APPEND."&from=such&target=search&encounter_nr=".$zeile['encounter_nr']."&sem=".(!$zeile['is_discharged']));
						exit;
					}
				}
			}else{echo "<p>".$sql."<p>$LDDbNoRead";};
	}else{ echo "$LDDbNoLink<br>"; }
}else{
	$mode='';
}
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
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
if($HTTP_COOKIE_VARS["ck_login_logged".$sid]) echo "startframe.php?sid=".$sid."&lang=".$lang; 
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
if($mode=='search'){
	if(!$linecount) $linecount=0;
	echo '<hr width=80% align=left><p>'.str_replace("~nr~",$linecount,$LDSearchFound).'<p>';
		  
	if ($linecount) { 

	/* Load the common icons */
	$img_options=createComIcon($root_path,'pdata.gif','0');

	echo '
			<table border=0 cellpadding=2 cellspacing=1> <tr bgcolor="#0000aa" background="'.createBgSkin($root_path,'tableHeaderbg.gif').'">';
			
?>

    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDCaseNr; ?></b></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDLastName; ?></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDFirstName; ?></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDBday; ?></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDOptions; ?></td>

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
						echo"<td><font face=arial size=2>";
                        echo '&nbsp;'.$full_en;
						if($zeile['encounter_class_nr']==2) echo ' <img '.createComIcon($root_path,'redflag.gif').'> <font size=1 color="red">'.$LDAmbulant.'</font>';
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
