<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/*** CARE 2002 Integrated Hospital Information System beta 1.0.06 - 2003-08-06
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file 'copy_notice.txt' for the licence notice
*/
define('LANG_FILE','radio.php');
//define('NO_2LEVEL_CHK',1);
$local_user='ck_radio_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);

$breakfile='radiolog.php'.URL_APPEND;

if($mode=='search'&&!empty($searchkey)){
	# Convert other wildcards
	$searchkey=strtr($searchkey,'*?','%_');

	if(is_numeric($searchkey)) $searchkey=(int)$searchkey;

	# Load date formatter
	include_once($root_path.'include/inc_date_format_functions.php');
	
	include_once($root_path.'include/care_api_classes/class_image.php');
	$img_obj=new Image;
	$result=$img_obj->DicomImages($searchkey);
	//	echo $img_obj->getLastQuery();

	//echo $img_obj->LastRecordCount();
	$rows=$img_obj->LastRecordCount();
}
# Prepare some parameters based on selected dicom viewer module

$pop_only=false;

switch($HTTP_SESSION_VARS['sess_dicom_viewer']){
	case 'raimjava':
			$pop_only=true;
			break;
	default:
				# Default viewer
}

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <style type="text/css" name="s2">
.indx{ font-family:verdana,arial; color:#ffffff; font-size:12; background-color:#6666ff}
.v12{ font-family:verdana,arial; color:#000000; font-size:12;}
</style>

<script language="javascript">
<!-- 
var urlholder;

function popDicom(nr){
<?php
	if($cfg['dhtml'])
	{
	echo 'w=window.parent.screen.width;
			h=window.parent.screen.height;
			';
	}
	else echo 'w=800;
					h=600;
					';
?>
dicomwin<?php echo $sid ?>=window.open("dicom_launch.php<?php echo URL_REDIRECT_APPEND ?>&pop_only=1&img_nr="+nr,"dicomwin<?php echo $sid ?>","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60) );
<?php if($cfg['dhtml']) echo '
	window.dicomwin'.$sid.'.moveTo(0,0);'; ?>
}

function chkform(d){
	if(d.searchkey.value=='') return false;
		else return true;
}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>

// -->
</script>
<script language="javascript" src="<?php echo $root_path; ?>js/dicom.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?></HEAD>

<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 bgcolor=<?php echo $cfg['body_bgcolor']; ?> onLoad="document.srcform.searchkey.select();" onFocus="document.srcform.searchkey.select();" 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 cellspacing=0 >

<tr valign=top height=15>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="15" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo "$LDDicomImages - $LDSearchPat" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="15" align=right><nobr><a href="javascript:popSelectDicomViewer('<?php echo $sid ?>','<?php echo $lang ?>')" ><img <?php echo createLDImgSrc($root_path,'select_viewer.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)';?>></a>
<a href="javascript:window.history.back()"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('radio.php','search','','0')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</nobr>
</td>
</tr>
<tr valign=top >

<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
<form action="<?php echo $thisfile ?>" method="get" onSubmit="return chkform(this)" name="srcform">
<table border=0>
  <tr>
    <td class="indx">&nbsp;<?php echo $LDSearchWordPrompt ?></td>
  </tr>
  <tr>
    <td><input type="text" name="searchkey" size=60 maxlength=60 value="<?php echo $searchkey ?>"  onFocus="this.select();">
        </td>
  </tr>
</table>
<input type="hidden" name="mode" value="search">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="image" <?php echo createLDImgSrc($root_path,'searchlamp.gif','0','absmiddle') ?> alt="<?php echo $LDSearchPat ?>">                                                                                                   
</form>

<p>
<table border=0 cellpadding=0 cellspacing=0 width="100%">
  <tr>
    <td class="v12"><b>&nbsp;<?php echo $LDCaseNr ?></b></td>
    <td class="v12"><b>&nbsp;<?php echo $LDLastName ?></b></td>
    <td class="v12"><b>&nbsp;<?php echo $LDName ?></b></td>
    <td class="v12"><b>&nbsp;<?php echo $LDBday ?></b></td>
    <td class="v12">&nbsp;</td>
    <td class="v12"><b>&nbsp;<?php echo $LDUploadDate ?></b></td>
     <td class="v12" align=center><b>&nbsp;<?php echo $LDNrImages ?></b></td>
<?php
if(!$pop_only){
?>
   <td class="v12" align=center><b>&nbsp;<?php echo $LDViewImage ?></b></td>
<?php
}
?>
    <td class="v12" align=center><b>&nbsp;<?php echo $LDViewInWindow ?></b></td>
 </tr>
  <tr>
    <td colspan=9 bgcolor="#0000ff"><img <?php echo $img_pix ?> width=1 height=1></td>
  </tr>
   <tr>
    <td colspan=9 bgcolor="#0000ff"></td>
  </tr>
<?php 
if($mode=='search'&&$rows)
{
	$i=1;
	$img_arrow=createComIcon($root_path,'bul_arrowblusm.gif','0','absmiddle'); // Load the torse icon image
	$img_torso=createComIcon($root_path,'torso.gif','0'); // Load the torse icon image
	$img_torsowin=createComIcon($root_path,'torso_win.gif','0'); // Load the torso icon image
	$img_pix=createComIcon($root_path,'pixel.gif','0'); // Load the torso icon image
	$img_rd=createComIcon($root_path,'rd_bl.gif','0'); // Load the right-down
	$img_dr=createComIcon($root_path,'dr_bl.gif','0'); // Load the down-right
	$img_x=createComIcon($root_path,'x_bl.gif','0'); // Load the right T
	$img_s=createComIcon($root_path,'s_bl.gif','0'); // Load straight
	$img_t=createComIcon($root_path,'t_bl.gif','0'); // Load T
	$img_info=createComIcon($root_path,'info2.gif','0','absmiddle'); // Load the info
	
	# Load the data in array
	$pdata=array();
	$z=0;
	while($pdata[$z]=$result->Fetchrow()){
		$z++;
	}
	

	for($i=0;$i<$z;$i++)
	{
		if($pdata[$i]['pid']!=$pdata[($i-1)]['pid']){
		echo'
 	<tr>
    <td class="v12">&nbsp;</td>
    <td class="v12">&nbsp;'.$pdata[$i]['name_last'].'&nbsp;</td>
    <td class="v12">&nbsp;'.$pdata[$i]['name_first'].'&nbsp;</td>
    <td class="v12">&nbsp;'.formatDate2Local($pdata[$i]['date_birth'],$date_format).'&nbsp;</td>
    <td class="v12"><img ';
	if($rows==1){
		echo $img_s;
	}else{
		if($pdata[($i+1)]&&($pdata[$i]['pid']==$pdata[($i+1)]['pid'])) echo $img_t;
			else echo $img_s;
	}
	echo '></td>
    <td class="v12">&nbsp;'.formatDate2Local($pdata[$i]['upload_date'],$date_format).'&nbsp;';
	if($pdata[$i]['note_len']) echo '<a href="javascript:popImgNotes(\''.$pdata[$i]['nr'].'\',\''.$sid.'\',\''.$lang.'\')"><img '.$img_info.'></a>';
	echo '</td>
    <td class="v12" align=center>&nbsp;'.$pdata[$i]['max_nr'].'&nbsp;</td>';
	if(!$pop_only) echo '
    <td class="v12" align=center><a href="dicom_launch.php'.URL_APPEND.'&img_nr='.$pdata[$i]['nr'].'&searchkey='.strtr($searchkey,' ','+').'" title="'.$LDViewInFrame.'"><img '.$img_torso.'></a></td>';
	echo '
    <td class="v12" align=center><a href="javascript:popDicom('.$pdata[$i]['nr'].')" title="'.$LDFullScreen.'"><img '.$img_torsowin.'></a></td>
  </tr>
  <tr>
    <td colspan=9 bgcolor="#0000ff"><img '.$img_pix.' width=1 height=1></td>
  </tr>';
		continue;
		
		}
		echo'
 <tr>
    <td class="v12">&nbsp;';
	if($pdata[$i]['encounter_nr']) echo $pdata[$i]['encounter_nr'];
	echo '&nbsp;</td>
    <td class="v12">&nbsp;</td>
    <td class="v12">&nbsp;</td>
    <td class="v12">&nbsp;</td>
    <td class="v12"><img ';
	if($i==$rows){
		if($pdata[$i]['pid']==$pdata[($i-1)]['pid']) echo $img_dr;
			else echo $img_s;
	}else{
		if($pdata[$i]['pid']==$pdata[($i+1)]['pid']) echo $img_x;
			else echo $img_dr;
	}
	echo '></td>
    <td class="v12">&nbsp;'.formatDate2Local($pdata[$i]['upload_date'],$date_format).'&nbsp;';
	if($pdata[$i]['note_len']) echo '<a href="javascript:popImgNotes(\''.$pdata[$i]['nr'].'\',\''.$sid.'\',\''.$lang.'\')"><img '.$img_info.'></a>';
	echo '</td>
    <td class="v12" align=center>&nbsp;'.$pdata[$i]['max_nr'].'&nbsp;</td>';
	if(!$pop_only) echo '
    <td class="v12" align=center><a href="dicom_launch.php'.URL_APPEND.'&img_nr='.$pdata[$i]['nr'].'&searchkey='.strtr($searchkey,' ','+').'" title="'.$LDViewInFrame.'"><img '.$img_torso.'></a></td>';
	echo '
    <td class="v12" align=center><a href="javascript:popDicom('.$pdata[$i]['nr'].')" title="'.$LDFullScreen.'"><img '.$img_torsowin.'></a></td>
  </tr>
  <tr>
    <td colspan=9 bgcolor="#0000ff"><img '.$img_pix.' width=1 height=1></td>
  </tr>';
  }	
}
?>
  </table>


</FONT>

</td>
</tr>


</table>        

</BODY>
</HTML>
