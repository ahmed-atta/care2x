<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.net, elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/
# Default value for the maximum nr of rows per block displayed, define this to the value you wish
# In normal cases this value is derived from the db table "care_config_global" using the "pagin_insurance_list_max_block_rows" element.
define('MAX_BLOCK_ROWS',30); 

$lang_tables[]='search.php';
define('LANG_FILE','lab.php');
$local_user='ck_lab_user';
require_once($root_path.'include/inc_front_chain_lang.php');

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
$thisfile=basename(__FILE__);
# Data to append to url
$append='&status='.$status.'&target='.$target.'&user_origin='.$user_origin;

# Initialize page's control variables
if($mode=='paginate'){
	$searchkey=$HTTP_SESSION_VARS['sess_searchkey'];
	//$searchkey='USE_SESSION_SEARCHKEY';
	//$mode='search';
}else{
	# Reset paginator variables
	$pgx=0;
	$totalcount=0;
	$odir='ASC';
	$oitem='name_last';
}
# Paginator object
require_once($root_path.'include/care_api_classes/class_paginator.php');
$pagen=new Paginator($pgx,$thisfile,$HTTP_SESSION_VARS['sess_searchkey'],$root_path);

require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);

# Get the max nr of rows from global config
$glob_obj->getConfig('pagin_patient_search_max_block_rows');
if(empty($GLOBAL_CONFIG['pagin_patient_search_max_block_rows'])) $pagen->setMaxCount(MAX_BLOCK_ROWS); # Last resort, use the default defined at the start of this page
	else $pagen->setMaxCount($GLOBAL_CONFIG['pagin_patient_search_max_block_rows']);


if(($mode=='search'||$mode=='paginate')&&!empty($searchkey)){
	# Convert other wildcards
	$searchkey=strtr($searchkey,'*?','%_');
	# Save the search keyword for eventual pagination routines
	if($mode=='search') $HTTP_SESSION_VARS['sess_searchkey']=$searchkey;

	include_once($root_path.'include/inc_date_format_functions.php');
	include_once($root_path.'include/care_api_classes/class_encounter.php');
	$enc_obj=new Encounter;

	$encounter=& $enc_obj->searchLimitEncounterBasicInfo($searchkey,$pagen->MaxCount(),$pgx,$oitem,$odir);
	//echo $enc_obj->getLastQuery();
	# Get the resulting record count
	$linecount=$enc_obj->LastRecordCount();
	if($linecount==1&&$mode=='search'){
		$row=$encounter->FetchRow();
		header("location:".$root_path."modules/nursing/nursing-station-patientdaten-doconsil-".$target.".php".URL_REDIRECT_APPEND."&pn=".$row['encounter_nr']."&edit=1&status=".$status."&target=".$target."&user_origin=".$user_origin."&noresize=1&mode=");
		exit;
	}
	//$linecount=$address_obj->LastRecordCount();
	$pagen->setTotalBlockCount($linecount);
	# Count total available data
	if(isset($totalcount)&&$totalcount){
		$pagen->setTotalDataCount($totalcount);
	}else{
		@$enc_obj->searchEncounterBasicInfo($searchkey);
		$totalcount=$enc_obj->LastRecordCount();
		$pagen->setTotalDataCount($totalcount);
	}
	$pagen->setSortItem($oitem);
	$pagen->setSortDirection($odir);

}
//echo $target;
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
<table width=100% border=0 cellspacing="0">
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo $LDTestRequest." - ".$LDSearchPatient ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('request_search.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
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
if ($linecount) echo '<hr width=80% align=left>'.str_replace("~nr~",$totalcount,$LDSearchFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.';
		else echo str_replace('~nr~','0',$LDSearchFound); 
if ($enc_obj->record_count) { 
	# Preload  common icon images
	$img_male=createComIcon($root_path,'spm.gif','0');
	$img_female=createComIcon($root_path,'spf.gif','0');
	$bgimg='tableHeaderbg3.gif';
	$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/'.$bgimg.'"';

?>
				<table border=0 cellpadding=2 cellspacing=1> 
				<tr bgcolor="#abcdef">				

     <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>
	  <?php echo $pagen->makeSortLink($LDCaseNr,'encounter_nr',$oitem,$odir,$append);  ?></b></td>
      <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>
	  <?php echo $pagen->makeSortLink($LDSex,'sex',$oitem,$odir,$append);  ?></b></td>
      <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>
	  <?php echo $pagen->makeSortLink($LDLastName,'name_last',$oitem,$odir,$append);  ?></b></td>
      <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>
	  <?php echo $pagen->makeSortLink($LDName,'name_first',$oitem,$odir,$append);  ?></b></td>
      <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>
	  <?php echo $pagen->makeSortLink($LDBday,'date_birth',$oitem,$odir,$append);  ?></b></td>
      <td <?php echo $tbg; ?> align='center'><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>
	  <?php echo $pagen->makeSortLink($LDZipCode,'addr_zip',$oitem,$odir,$append); ?></b></td>
    <td background="<?php echo createBgSkin($root_path,'tableHeaderbg.gif'); ?>" align=center><font face=arial size=2 color="#ffffff"><b><?php echo $LDSelect; ?></td>
					</tr>
<?php

					while($row=$encounter->FetchRow())
					{
						$full_en=$row['encounter_nr'];
						echo "
							<tr bgcolor=";
						if($toggle) { echo "#efefef>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".$full_en;
                        echo '&nbsp;</td><td>';	

						switch($row['sex']){
							case 'f': echo '<img '.$img_female.'>'; break;
							case 'm': echo '<img '.$img_male.'>'; break;
							default: echo '&nbsp;'; break;
						}	
						
						echo'</td><td><font face=arial size=2>';
						echo "&nbsp;".ucfirst($row['name_last']);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".ucfirst($row['name_first']);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".formatDate2Local($row['date_birth'],$date_format);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".$row['addr_zip'];
                        echo "</td>";	

					    if($HTTP_COOKIE_VARS[$local_user.$sid]) echo '
						<td><font face=arial size=2>&nbsp;';
						echo "
							<a href=\"".$root_path."modules/nursing/nursing-station-patientdaten-doconsil-".$target.".php".URL_APPEND."&pn=".$row['encounter_nr']."&edit=1&status=".$status."&target=".$target."&user_origin=".$user_origin."&noresize=1&mode=\">";
						echo '	
							<img '.createLDImgSrc($root_path,'ok_small.gif','0').' alt="'.$LDTestThisPatient.'"></a>&nbsp;';
							
                       if(!file_exists($root_path."cache/barcodes/en_".$full_en.".png"))
	      		       {
			               echo "<img src='".$root_path."classes/barcode/image.php?code=".$full_en."&style=68&type=I25&width=180&height=50&xres=2&font=5&label=2&form_file=en' border=0 width=0 height=0>";
		               }
						echo '</td></tr>';

					}
					
					echo '
						<tr><td colspan=6><font face=arial size=2>'.$pagen->makePrevLink($LDPrevious,$append).'</td>
						<td align=right><font face=arial size=2>'.$pagen->makeNextLink($LDNext,$append).'</td>
						</tr>
						</table>';
					if($linecount>$pagen->MaxCount())
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
