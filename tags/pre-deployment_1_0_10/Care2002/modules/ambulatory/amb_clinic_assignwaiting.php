<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.09 - 2003-11-25
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('aufnahme.php','prompt.php','departments.php');
define('LANG_FILE','nursing.php');
//define('NO_2LEVEL_CHK',1);
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');

if(empty($HTTP_COOKIE_VARS[$local_user.$sid])){
    $edit=0;
	include($root_path."language/".$lang."/lang_".$lang."_".LANG_FILE);
}
/**
* Set default values if not available from url
*/

if(!isset($mode)) $mode='';


require_once($root_path.'include/care_api_classes/class_encounter.php');
#Create encounter object and load encounter info
$enc_obj=new Encounter($pn);

# Load date formatter 
require_once($root_path.'include/inc_date_format_functions.php');
  
if(($mode=='')||($mode=='fresh')){
		
		# Load global person photo source path
		require_once($root_path.'include/care_api_classes/class_globalconfig.php');
		$GLOBAL_CONFIG=array();
		$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
		$glob_obj->getConfig('person_foto_path');
		$photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_foto_path'])) ? $GLOBAL_CONFIG['person_foto_path'] : $default_photo_path;

		@$enc_obj->loadEncounterData();
		if($enc_obj->is_loaded) {
			$encounter=&$enc_obj->encounter;
		}else{
			$encounter=array();
		}
		
		if($encounter['current_dept_nr']!=$dept_nr){
			if(!isset($$pdept)||empty($$pdept)){
				require_once($root_path.'include/care_api_classes/class_department.php');
				$dept_obj=new Department;
				$dept=$dept_obj->FormalName($encounter['current_dept_nr']);
			}else{
				$dept=$$pdept;
			}
		}

		# Set the foto filename
		$photo_filename=$encounter['photo_filename'];
		/* Prepare the photo filename */
		require_once($root_path.'include/inc_photo_filename_resolve.php');

		# Get billing type
		$billing_type=&$enc_obj->getInsuranceClassInfo($encounter['insurance_class_nr']);
		$breakfile='javascript:window.close()'; # Set default breakfile
		
}elseif($mode=='save'){

	# Save data
	if($enc_obj->assignInDept($pn,$dept_nr,$dept_nr)){
		//@$enc_obj->setInDept($pn);
		include($root_path.'js/reloadparent_closewin.js');
		exit;
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<title><?php echo $TP_TITLE; ?></title>
<?php echo setCharSet(); ?>

<script language="javascript">
<!-- 
  var urlholder;


function admitOutpatient(){
	var g=true;
	if(<?php echo $encounter['current_dept_nr']; ?>!=<?php echo $dept_nr; ?>){
		if(!confirm("<?php echo $LDSureTakeOverPatient; ?>")){
			g=false;
		}
	}
	if(g){
		document.admitform.submit();
	}
}
// -->
</script>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

<style type="text/css" name="s2">
td.vn { font-family:verdana,arial; color:#000088; font-size:10}

</style>
</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if (window.focus) window.focus()"
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=3  FACE="Arial"><STRONG> &nbsp;&nbsp; <?php echo $LDAmbulant ?> </STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr>
<a href="javascript:gethelp('nursing_station.php','<?php echo $mode ?>','<?php echo $occup ?>','<?php echo $station ?>','<?php echo "$LDStation" ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</nobr>
</td></tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>

<!-- Patients basic admission info -->
<table border=0 cellspacing=1 cellpadding=0 width=100%>

<tr bgcolor="#ffffff">
<td  valign="top">

<table border=0 width=100% cellspacing=1>
<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial">
<?php 
echo $LDAdmitNr;
?>
</td>
<td width="30%"  bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#800000">
<?php 
echo $pn ;
?>
</td>

<td valign="top" rowspan=5 align="center" bgcolor="#ffffee" ><FONT SIZE=-1  FACE="Arial"><img <?php echo $img_source; ?>>
</td>
</tr>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo "$LDTitle $LDLastName, $LDFirstName" ?>:
</td>
<td  bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial">
<?php echo $encounter['title'].' '.$encounter['name_last'].', '.$encounter['name_first'] ?>
</td>

</tr>
<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php  echo $LDBday ?>:
</td>
<td  bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial">
<?php if($encounter['date_birth']) echo @formatDate2Local($encounter['date_birth'],$date_format);  ?>
</td>
</tr>
<tr>
<td bgColor="#eeeeee" ><FONT SIZE=-1  FACE="Arial"><?php  echo $LDSex ?>: 
</td>
<td bgcolor="#ffffee" ><FONT SIZE=-1  FACE="Arial"><?php if($encounter['sex']=="m") echo  $LDMale; elseif($encounter['sex']=="f") echo $LDFemale ?>
</td>
</tr>
<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDBillType ?>:
</td>
<td  bgcolor="#ffffee" ><FONT SIZE=-1  FACE="Arial"  color="#990000">
<b>
<?php if (isset($$billing_type['LD_var'])&&!empty($$billing_type['LD_var'])) echo $$billing_type['LD_var']; 
    else echo  $billing_type['name']; 
?>
</b>
</td>
</tr>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDDiagnosis ?>:
</td>
<td  bgcolor="#ffffee" colspan=2 ><FONT SIZE=-1  FACE="Arial">
<?php
	echo nl2br($encounter['referrer_diagnosis']);
?>
</td>
</tr>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDTherapy ?>:
</td>
<td  bgcolor="#ffffee" colspan=2 ><FONT SIZE=-1  FACE="Arial">
<?php
	echo nl2br($encounter['referrer_recom_therapy']);
?>
</td>
</tr>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDSpecials ?>:
</td>
<td  bgcolor="#ffffee"  colspan=2><FONT SIZE=-1  FACE="Arial">
<?php
	echo nl2br($encounter['referrer_notes']);
?>
</td>
</tr>

</table>


</td>
</tr>
</table>
<!-- End of Patients basic admission info -->

<!--  Show stop sign and warn if the initial ward assignment is different from this ward -->
<?php
if($encounter['current_dept_nr']!=$dept_nr){
	$ack_but='takeover.gif';
?>

<table border=0>
  <tr>
    <td><img <?php 	echo createLDImgSrc($root_path,'stop.png','0'); ?>></td>
    <td><FONT SIZE=2  FACE="Arial"><?php 	echo str_replace('~dept_id~',$dept,$LDChkClinicConflict); ?></a>
	</td>
  </tr>
</table>

<?php
}else{
	$ack_but='admit.gif';
}
?>
<p>
<table border=0 width=100%>
  <tr>
    <td align=left><a href="javascript:admitOutpatient()"><img <?php echo createLDImgSrc($root_path,$ack_but,'0'); ?>></a></td>
    <td align=right><a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a></td>
  </tr>
</table>

<form name="admitform" method="post">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr ?>">
<input type="hidden" name="mode" value="save">
</form>


</FONT>
<p>
</td>
</tr>
</table>        
<p>

</BODY>
</HTML>
