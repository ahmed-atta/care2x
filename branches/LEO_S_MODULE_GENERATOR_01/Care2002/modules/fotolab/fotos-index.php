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
define('LANG_FILE','nursing.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');

$breakfile=$root_path."modules/nursing/nursing-station-patientdaten.php".URL_REDIRECT_APPEND."&edit=$edit&station=$station&pn=$pn";

require($root_path.'global_conf/inc_remoteservers_conf.php');

if($disc_pix_mode){
	$final_path="$root_path$fotoserver_localpath$pn/"; 
}else{
	$final_path="$fotoserver_http$pn/";
}
/* Load date formatter */
include_once($root_path.'include/inc_date_format_functions.php');

/* Create encounter object */
require_once($root_path.'include/care_api_classes/class_encounter.php');
$encounter= new Encounter;
$encounter->loadEncounterData($pn);
/* Create image object */
require_once($root_path.'include/care_api_classes/class_image.php');
$img=new Image();
$all_image=$img->getAllImageData($pn);

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<style type="text/css">
	.a12_w {font-family: arial; color: navy; font-size:12; background-color:#ffffff}
	.a12_gry {font-family: arial; color: navy; font-size:12; background-color:#000000}
</style>

<script language="javascript">

var x=-1;

function showfoto(srcimg)
{
	if (document.images) document.images.foto.src=srcimg;
	x=-2;
}

function preview(n)
{
	window.parent.FOTOS_PREVIEW.location.href="fotos-preview.php<?php echo URL_REDIRECT_APPEND; ?>&pn=<?php echo $pn ?>&nr="+n;
}
</script>
<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor="silver" alink="navy" vlink="navy" onLoad="if (window.focus) window.focus(); window.resizeTo(1000,740);">


<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" >
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo "$LDPhotos"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp('encounter_photos.php','fotos','','<?php echo $station ?>','<?php echo "$LDPhotos"; ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:window.parent.location.replace('<?php echo $breakfile ?>');" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>

<tr>
<td bgcolor=#cde1ec valign=top colspan=2><p><br>
<ul>
<?php
echo "<font face=arial font size=3 color=maroon><font size=5 >";

echo $pn;

if(is_object($encounter)){
	$fn=$encounter->PhotoFilename();
	if(file_exists($root_path.'fotos/registration/'.$fn)){
		# If main photo ID exists, show it
		echo '<br><a href="'.$root_path.'main/pop_reg_pic.php'.URL_APPEND.'&fn='.$fn.'" target="FOTOS_PREVIEW" title="'.$LDClk2Preview.'">
	 		<img src="';
		echo  $root_path.'main/imgcreator/thumbnail.php?mx=80&my=100&imgfile=fotos/registration/'.$fn;
		echo '" border=0></a>';

	}
	echo "<br></font>".ucfirst($encounter->LastName()).", ".ucfirst($encounter->FirstName())." (";
	echo formatDate2Local($encounter->BirthDate(),$date_format).')<br>';
	echo "</font>";
}
?>

<table border=0>
<tr>
<td>
<nobr>
<FONT    SIZE=-1  FACE="Arial">

<?php 

echo "<b>$LDPhotos";
if(is_object($all_image)) echo " ".$all_image->RecordCount()." $LDPicShots";
echo '</b><br>
	<table border=0>';

if(is_object($all_image)){
	while($image=$all_image->FetchRow()){

		if(file_exists($final_path.$image['nr'].'.'.$image['mime_type'])){
	
			echo '<tr>
     		<td class="a12_w">'.formatDate2Local($image['shot_date'],$date_format);
			echo ' <font color=red size="1">Bild '.$image['shot_nr'].'</font>';
 
     		echo '</td>
	 		<td class="a12_gry"><a href="javascript:preview(\''.$image['nr'].'\')" title="'.$LDClk2Preview.'">
	 		<img src="';
			if(stristr($image['mime_type'],'gif')){
				echo $final_path.$image['nr'].'.'.$image['mime_type'].'" border=0  width=80></a> </td>
   				</tr>';
			}else{
				echo  $root_path.'main/imgcreator/thumbnail.php?mx=80&my=100&imgfile=/'.$fotoserver_localpath.$pn.'/'.$image['nr'].'.'.$image['mime_type'].'" border=0></a> </td>
   				</tr>';
			}
   		}
	}
}

 ?>
 </table>
<p>
<a href="javascript:window.parent.location.replace('<?php echo $breakfile ?>');"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>

</nobr>
</td>
<td>
<img src="<?php echo $root_path ?>gui/img/common/default/pixel.gif" width=50 border="0">

</td>
<td>
<img src="<?php echo $root_path ?>gui/img/common/default/pixel.gif" border="0" name="foto">

</td>
</tr>
</table>

<p>
</ul>




<p>
</td>
</tr>

<tr>
<td bgcolor=silver height=70 colspan=2>
<?php
//require($root_path.'include/inc_load_copyrite.php');
?>
</td>
</tr>
</table>        
&nbsp;

</FONT>


</BODY>
</HTML>
