<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
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
define('LANG_FILE','lab.php');
$local_user='ck_lab_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);
$breakfile='labor.php'.URL_APPEND;

if(!isset($mode)) $mode='';
$keyword=trim($keyword);
$toggle=0;

if(($search)&&!empty($keyword)){

	# Load the date formatter 
	include_once($root_path.'include/inc_date_format_functions.php');
    
	include_once($root_path.'include/care_api_classes/class_lab.php');
	
	$lab_obj=new Lab();
	# Get the existing lab reports
	if($mode=='edit'){
		$encounter=&$lab_obj->searchEncounterBasicInfo($keyword);  
	}else{
		$encounter=&$lab_obj->searchEncounterLabResults($keyword);
	}  
	# Get the number of results found
	$linecount=$lab_obj->LastRecordCount();      
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<?php 
require($root_path.'include/inc_js_gethelp.php'); 
require($root_path.'include/inc_css_a_hilitebu.php');
?>

<script language="JavaScript">
<!-- Script Begin
function checkForm(v) {
	if((v.value=="")||(v.value==" ")){
		v.value="";
		v.focus();
		return false;
	}else{
		return true;
	}
}
//  Script End -->
</script>
</HEAD>

<BODY onLoad="document.sform.keyword.select()">

<img <?php echo createComIcon($root_path,'micros.gif','0','absmiddle') ?>><FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b><?php echo "$LDMedLab - "; if($mode=="edit") echo "$LDNewData"; else echo "$LDSeeData"; ?></b></font>
<table width=100% border=0 cellpadding="0" cellspacing="0">
<tr>
<td colspan=3><img <?php echo createLDImgSrc($root_path,'such-b.gif') ?>></td>
</tr>
<tr >
<td bgcolor=#333399 colspan=3>
<FONT  SIZE=1  FACE="Arial"><STRONG> &nbsp; </STRONG></FONT>
</td>
</tr>
<tr bgcolor="#DDE1EC" >
<td bgcolor=#333399>&nbsp;</td>
<td valign=top><p><br>
<ul>
<FONT    SIZE=-1  FACE="Arial">

<!-- This is the search entry mask -->

<FORM action="<?php echo $thisfile; ?>" method="post" name="sform" onSubmit="return checkForm(sform.keyword)">
<font face="Arial,Verdana"  color="#000000" size=-1>
<B><?php echo $LDSearchWordPrompt ?></B></font><p>
<font size=3><INPUT type="text" name="keyword" size="20" maxlength="40" value="<?php echo $keyword ?>"></font> 
<input type=hidden name="search" value=1>
<input type=hidden name="sid" value=<?php echo $sid ?>>
<input type=hidden name="lang" value=<?php echo $lang ?>>
<input type=hidden name="mode" value=<?php echo $mode ?>>
<INPUT type="image" <?php echo createLDImgSrc($root_path,'searchlamp.gif','0','absmiddle') ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:gethelp('lab.php','search','<?php echo $mode ?>','<?php echo $linecount ?>','<?php echo $datafound ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0','absmiddle') ?>></a>
</FORM>
<p>
<?php 

$prev_nr=0;

if($linecount){
	$dcount=0;
	# Print the search result message 
	if($mode=='edit')	echo str_replace('~nr~',$linecount,$LDFoundPatient).'<p>';
			
	# Create the column descriptors 
	echo "<table border=0 cellpadding=3 cellspacing=1> <tr bgcolor=#9f9f9f>";

	for($i=0;$i<sizeof($LDfieldname);$i++) {
		echo"<td><font face=arial size=2 color=#ffffff><b>".$LDfieldname[$i]."</b></td>";
	}
	
	echo"<td>&nbsp;</td></tr>";
           
	# List all the stored lab result documents of the patient 
	while($zeile=$encounter->FetchRow()){

		if($zeile['encounter_nr']!=$prev_nr){

			$prev_nr=$zeile['encounter_nr'];
			$dcount++;

			echo '
			<tr bgcolor=';
			if($toggle) { echo '#efefef>';} else {echo '#ffffff>';}
			$toggle=!$toggle;
			echo '<td><font face=arial size=2>';
			echo '&nbsp;'.$zeile['encounter_nr'];
			if($zeile['encounter_class_nr']==2) echo ' <img '.createComIcon($root_path,'redflag.gif').'> <font size=1 color="red">'.$LDAmbulant.'</font>';
        	echo '</td>
					<td><font face=arial size=2>';
			echo '&nbsp;'.ucfirst($zeile['name_last']);
			echo '</td>
					<td><font face=arial size=2>';
			echo '&nbsp;'.ucfirst($zeile['name_first']);
			echo '</td>
					<td><font face=arial size=2>';
			echo '&nbsp;'.formatDate2Local($zeile['date_birth'],$date_format);
			echo '</td>';	
						
						
			#  if mode is edit, create the button linked to labor_data_check_arch.php 
			#  if mode is not edit, create button linked to labor_datalist_noedit.php (read only list)

			echo'
				<td><font face=arial size=2>&nbsp';
						
			if($mode=='edit'){ 
				echo'<a href="labor_data_check_arch.php'.URL_APPEND.'&mode='.$mode.'&encounter_nr='.$zeile['encounter_nr'].'&update=1"  title="'.$LDEnterData.'">
					<button onClick="javascript:window.location.href=\'labor_data_check_arch.php'.URL_REDIRECT_APPEND.'&mode='.$mode.'&encounter_nr='.$zeile['encounter_nr'].'&update=1\'"><img '.createComIcon($root_path,'update2.gif','0','absmiddle').' alt="'.$LDEnterData.'"><font size=1> '.$LDNewData;
			}else{
				echo'
					<a href="labor_datalist_noedit.php'.URL_APPEND.'&encounter_nr='.$zeile['encounter_nr'].'&noexpand=1&nostat=1&user_origin=lab"  title="'.$LDClk2See.'">
					<button onClick="javascript:window.location.href=\'labor_datalist_noedit.php'.URL_REDIRECT_APPEND.'&encounter_nr='.$zeile['encounter_nr'].'&noexpand=1&nostat=1&user_origin=lab\'"><img '.createComIcon($root_path,'update2.gif','0','absmiddle').' alt="'.$LDClk2See.'"><font size=1> '.$LDLabReport;
			}
						
			echo '</font></button></a>&nbsp;
				</td></tr>';

		}
	}
	
	echo '</table>';
					
	# If result is more than 15 items, create an additional search entry mask below the list
	if($dcount>15){
		echo '
				<p><font color=red><B>'.$LDNewSearch.':</font>
				<FORM action="'.$thisfile.'" method="post" name="form2" onSubmit="return checkForm(form2.keyword)">
				<font face="Arial,Verdana"  color="#000000" size=-1>
				'.$LDSearchWordPrompt.'</B><p>
				<INPUT type="text" name="keyword" size="20" maxlength="40" value="'.$keyword.'"> 
				<input type=hidden name="search" value=1>
				<input type=hidden name="sid" value="'.$sid.'">
				<input type=hidden name="lang" value="'.$lang.'">
				<input type=hidden name="mode" value="'.$mode.'">
				<INPUT type="image"  '.createLDImgSrc($root_path,'searchlamp.gif','0','absmiddle').'></font></FORM>
				<p>';
	}
}

?>
<p>
<br>&nbsp;
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>

<p>

</ul>
&nbsp;
</FONT>
<p>
</td>
<td bgcolor=#333399>&nbsp;</td>
</tr>
<tr >
<td bgcolor="#333399" colspan=3><font size=1>
&nbsp; 
</td>
</tr>

</table>        
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
