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
define('PREVIEW_SIZE',400); // define here the width of the preview image

$lang_tables=array('images.php');
define('LANG_FILE','nursing.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require($root_path.'global_conf/inc_remoteservers_conf.php');
/* Load date formatter */
include_once($root_path.'include/inc_date_format_functions.php');

if($disc_pix_mode){
	$final_path="$root_path$fotoserver_localpath$pn/"; 
}else{
	$final_path="$fotoserver_http$pn/";
}

if(isset($pn)&&$pn){
	/* Create image object */
	include_once($root_path.'include/care_api_classes/class_image.php');
	$img_obj=new Image();

	if(isset($mode)&&$mode=='save'){
		$HTTP_POST_VARS['history']="CONCAT(history,'Notes ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n')";
		$HTTP_POST_VARS['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
		//$img_obj->setDataArray($HTTP_POST_VARS);
		if($img_obj->updateImageNotes($HTTP_POST_VARS)){
			header('Location:'.basename(__FILE__).URL_REDIRECT_APPEND.'&pn='.$pn.'&nr='.$nr);
			exit;
		}
	}
	
	if($img_data=$img_obj->getImageData($nr)){
		$image=$img_data->FetchRow();
		$picsource=$final_path.$image['nr'].'.'.$image['mime_type'];
	}
}

?>
<?php html_rtl($lang); ?>
<head>
<script language="javascript">
<!-- 

function check(d) {
	if(d.notes.value=="") return false;
		else return true;
}

</script>
<?php echo setCharSet(); ?>
</head>
<body topmargin=0 marginheight=0><font size=5 face=arial color=maroon>
<form name="picnotes" method="post" onSubmit="return check(this)">
<?php //echo $LDPreview ?>
<?php 
	if(file_exists($picsource)){
?>
<table border=0 cellspacing=0 cellpadding=0>
  <tr>
    <td><font size=2 face=arial color=maroon><?php echo $LDShotDate ?>:
</td>
    <td><font size=2 face=arial><?php echo formatDate2Local($image['shot_date'],$date_format); ?></td>
  </tr>
  <tr>
    <td><font size=2 face=arial color=maroon><?php echo $LDShotNr ?>:</td>
    <td><font size=2 face=arial><?php echo $image['shot_nr'] ?></td>
  </tr>
</table>
<?php
if(!isset($preview_size)) $preview_size=0;

list($w,$h,$t,$wh)=getImageSize($picsource); // get the size of the image

if(PREVIEW_SIZE<$w){
	$toggle_pic=true;
	if($preview_size) $preview_size=0;
		else $preview_size=PREVIEW_SIZE;
}else{
	$toggle_pic=false;
	$preview_size=$w;
}

	
if($toggle_pic) echo '<a href="'.basename(__FILE__).URL_APPEND.'&pn='.$pn.'&nr='.$nr.'&preview_size='.$preview_size.'">';

if($t==1){

?>

<img src="<?php	echo $picsource; ?>" <?php if($preview_size) echo 'width="'.$preview_size.'"'; else echo $wh; ?> border=0  name="preview"
<?php 

}elseif(($toggle_pic&&!$preview_size)||(!$toggle_pic&&$preview_size)){
?>
<img src="<?php	echo $picsource; ?>" <?php if($preview_size) echo 'width="'.$preview_size.'"'; else echo $wh; ?> border=0  name="preview"
<?php
}else{
?>
<img src="<?php	echo $root_path.'main/imgcreator/thumbnail.php?mx='.$preview_size.'&my='.$preview_size.'&imgfile=/'.$fotoserver_localpath.$pn.'/'.$image['nr'].'.'.$image['mime_type'] ?>" border=0  name="preview"
<?php
}

if($toggle_pic){
?>
 alt="<?php if($preview_size) echo $LDTogglePreviewOrig; else echo $LDToggleOrigPreview; ?>" 
  title="<?php  if($preview_size) echo $LDTogglePreviewOrig; else echo $LDToggleOrigPreview; ?>"
<?php
}
?>>
<?php
	if($toggle_pic) echo '</a>';
?>
<br>
<?php
if(!empty($image['notes'])){
	$notes=str_replace('[[','<font size=1 color="#abcdef">',htmlspecialchars($image['notes']));
	$notes=str_replace(']]','</font>',$notes);
?>
<table border=0 width="100%" cellspacing=0 cellpadding=1 bgcolor="#abcdef">
  <tr>
    <td>
		<table border=0 width="100%" cellspacing=0 cellpadding=5 bgcolor="#ffffff">
		  <tr>
		    <td><font size=2 face="arial,verdana,helvetica">
			<?php echo nl2br($notes); ?>
			</td>
		  </tr>
		</table>
	</td>
  </tr>
</table>
<?php
}
?>
<textarea name="notes" cols=40 rows=4 wrap="physical"></textarea><br>
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="nr" value="<?php echo $nr ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="preview_size" value="<?php if(isset($preview_size)) echo $preview_size ?>">
<input type="hidden" name="mode" value="save">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>
<?php
}
?>
</form>
</body>
</html>
