<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','lab.php');
$local_user='ck_lab_user';
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/inc_config_color.php');
$keyword=strtr($keyword,"%"," ");
$keyword=trim($keyword);

$dbtable='care_admission_patient';

$toggle=0;
$append=URL_APPEND."&target=$target&noresize=1&user_origin=$user_origin";

switch($target)
{
  case 'chemlabor': $entry_block_bgcolor="#fff3f3";
                          $entry_border_bgcolor="#ee6666";
						  $entry_body_bgcolor="#ffffff";
						  $breakfile="nursing-station-patientdaten-doconsil-chemlabor.php$append";
						  break;
  case 'baclabor': $entry_block_bgcolor="#fff3f3";
                          $entry_border_bgcolor="#ee6666";
						  $entry_body_bgcolor="#ffffff";
						  $breakfile="nursing-station-patientdaten-doconsil-baclabor.php$append";
						  break;
  case 'patho': $entry_block_bgcolor="#cde1ec";
                          $entry_border_bgcolor="#cde1ec";
						  $entry_body_bgcolor="#ffffff";
						  $breakfile="nursing-station-patientdaten-doconsil-patho.php$append";
						  break;
  case 'blood': $entry_block_bgcolor="#99ffcc";
                          $entry_border_bgcolor="#99ffcc";
						  $entry_body_bgcolor="#ffffff";
						  $breakfile="nursing-station-patientdaten-doconsil-blood.php$append";
						  break;
  case 'radio': $entry_block_bgcolor="#efefef";
                          $entry_border_bgcolor="#fcfcfc";
						  $entry_body_bgcolor="#ffffff";
						  $breakfile="nursing-station-patientdaten-doconsil-radio.php$append";
						  break;
  default            : $entry_block_bgcolor="#fff3f3";
                          $entry_border_bgcolor="#ee6666";
						  $entry_body_bgcolor="#ffffff";
						  $breakfile="nursing-station-patientdaten-doconsil-baclabor.php$append";
}

$breakfile=$root_path.'modules/nursing/'.$breakfile;

if(($mode=='search')&&!empty($searchkey)){

	include_once($root_path.'include/inc_date_format_functions.php');
	include_once($root_path.'include/care_api_classes/class_encounter.php');
	$enc_obj=new Encounter;
	$encounter=&$enc_obj->searchEncounterBasicInfo($searchkey);
	$linecount=$enc_obj->record_count;
	if($linecount==1){
		$row=$encounter->FetchRow();
		header("location:".$root_path."modules/nursing/nursing-station-patientdaten-doconsil-".$target.".php".URL_REDIRECT_APPEND."&pn=".$row['encounter_nr']."&edit=1&status=".$status."&target=".$target."&user_origin=".$user_origin."&noresize=1&mode=");
		exit;
	}
/*
	include_once($root_path.'include/care_api_classes/class_globalconfig.php');
	$GLOBAL_CONFIG=array();
	$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
	$glob_obj->getConfig('patient_%');	
*/	
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
<table width=100% border=0 cellspacing="0">
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo $LDTestRequest." - ".$LDSearchPatient ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('admission_how2search.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
if($HTTP_COOKIE_VARS["ck_login_logged".$sid]) echo "startframe.php?sid=".$sid."&lang=".$lang; 
	else echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>
</table>
<ul>
<FONT    SIZE=3  FACE="Arial" color="#990000"><?php echo $LDTestRequestFor.$LDTestType[$target] ?></font>
<table width=90% border=0 cellpadding="0" cellspacing="0">
<tr bgcolor="<?php echo $entry_block_bgcolor ?>" >
<td ><p><br>
<ul>
<FONT    SIZE=-1  FACE="Arial">

		 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php
	   
	        $searchmask_bgcolor="#f3f3f3";
            include($root_path.'include/inc_test_request_searchmask.php');
       
	   ?>
</td>
     </tr>
   </table>

<p>
<a href="<?php	echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
<p>

<?php
//echo $mode;
echo '<hr width=80% align=left><p>'.str_replace("~nr~",$linecount,$LDSearchFound).'<p>';
if ($enc_obj->record_count) 
	{ 

					echo '
						<table border=0 cellpadding=2 cellspacing=1> <tr bgcolor="#0000aa">';
					for($i=0;$i<sizeof($fieldname);$i++) 
					{
						echo'
						<td><font face=arial size=2 color="#ffffff"><b>'.$fieldname[$i].'</b></td>';
		
					}
					echo"</tr>";

					while($row=$encounter->FetchRow())
					{
/*						switch ($row['encounter_class_nr'])
						{
						    case '1': $full_en = ($row['encounter_nr'] + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
							                   break;
							case '2': $full_en = ($row['encounter_nr'] + $GLOBAL_CONFIG['patient_outpatient_nr_adder']);
											break;
						    default: $full_en = ($row['encounter_nr'] + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
						}						
*/
						$full_en=$row['encounter_nr'];
						echo "
							<tr bgcolor=";
						if($toggle) { echo "#efefef>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".$full_en;
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".ucfirst($row['name_last']);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".ucfirst($row['name_first']);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".formatDate2Local($row['date_birth'],$date_format);
                        echo "</td>";	

					    if($HTTP_COOKIE_VARS[$local_user.$sid]) echo '
						<td><font face=arial size=2>&nbsp;';
						echo "
							<a href=\"".$root_path."modules/nursing/nursing-station-patientdaten-doconsil-".$target.".php".URL_APPEND."&pn=".$row['encounter_nr']."&edit=1&status=".$status."&target=".$target."&user_origin=".$user_origin."&noresize=1&mode=\">";
						echo '	
							<img '.createLDImgSrc($root_path,'ok_small.gif','0').' alt="'.$LDTestThisPatient.'"></a>&nbsp;';
							
                       if(!file_exists($root_path."cache/barcodes/pn_".$full_en.".png"))
	      		       {
			               echo "<img src='".$root_path."classes/barcode/image.php?code=".$full_en."&style=68&type=I25&width=180&height=50&xres=2&font=5&label=2' border=0 width=0 height=0>";
		               }
						echo '</td></tr>';

					}
					echo "
						</table>";
					if($linecount>15)
					{
?>
		 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php
	   
	        $searchform_count=2;
            include($root_path.'include/inc_test_request_searchmask.php');
       
	   ?>
</td>
     </tr>
   </table>
<?php
					}
				}
?>
</ul>
&nbsp;
</FONT>
<p>
</td>
</tr>
</table>        
</ul>
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
