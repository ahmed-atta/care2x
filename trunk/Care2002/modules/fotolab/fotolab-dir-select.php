<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.08 - 2003-10-05
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','specials.php');
$local_user='ck_fotolab_user';
require_once($root_path.'include/inc_front_chain_lang.php');

/* Load date formatter */
require_once($root_path.'include/inc_date_format_functions.php');
				
if(!isset($maxpic)||!$maxpic) $maxpic=4;

$thisfile=basename(__FILE__);
$breakfile="javascript:window.parent.location.replace('".$root_path."main/spediens.php?sid=$sid&lang=$lang')";
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <style type="text/css" name="s2">
.indx{ font-family:verdana,arial; color:#ffffff; font-size:12; background-color:#6666ff}
</style>



<script language="javascript">
<!-- 
function chkNumber(n)
{
	var d;
	eval("d=document.srcform.nr"+n);
	if((d.value)&&(!(isNaN(d.value)))) return true;
	else
	{
		x=d.value.toLowerCase();
		if(x=="main")
		{
			d.value=x;
		 	return true;
		}
		else
		{
			d.value="";
			d.focus();
			alert('<?php echo $LDAlertNumberOnly ?>');
	 		return false;
		}
	}

}

function previewpic(fn) {
if(fn=="") return;
//else parent.PREVIEWFRAME.document.location.href="fotolab-preview.php<?php echo URL_REDIRECT_APPEND ?>&picsource="+fn;
else parent.PREVIEWFRAME.document.previewpic.src=fn;

}

function chkform(d)
{
	var maxpix=<?php echo $maxpic ?>;
	var flag=false;
	for(i=0;i<maxpix;i++)
	{
		if((eval("d.sdate"+i+".value!=''"))&&(eval("d.picfile"+i+".value!=''"))) 
		{
			flag=true;
			break;
		}
	}
	if(flag){
		 return true;
	}else{
		alert("<?php echo "$LDAlertPhotoInfo  $LDAlertNoPhotoInfo" ?>");
		return false;
	}
}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>


// -->
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/dtpick_care2x.js"></script>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?></HEAD>

<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 bgcolor=<?php echo $cfg['body_bgcolor'] ?> <?php if(!$same_pat) echo ' onLoad="window.parent.PREVIEWFRAME.location.replace(\'fotolab-preview.php?sid='.$sid.'&lang='.$lang.'\');" ';
else echo ' onLoad="window.parent.PREVIEWFRAME.location.replace(\'fotolab-preview.php?sid='.$sid.'&lang='.$lang.'\');" '; ?> 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 cellspacing=0 >

<tr valign=top height=10>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG>&nbsp;<?php echo $LDFotoLab ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right><a href="javascript:history.back();"><img 
<?php echo createLDImgSrc($root_path,'back2.gif','0','absmiddle') ?> 
style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a 
href="javascript:gethelp('fotolab.php','input','')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0','absmiddle') ?> style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?> style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>

<!-- Tabs  -->
<tr  bgcolor="<?php echo $cfg['top_bgcolor']; ?>" valign=top >
<td colspan=2>
<?php 
	if($target=="search") $img='such-b.gif'; //echo '<img '.createLDImgSrc($root_path,'such-b.gif','0').' alt="'.$LDSearch.'">';
		else{ $img='such-gray.gif'; }
	echo '<a href="upload_search_patient.php'.URL_APPEND.'&target=search"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDSearch.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';
?><br>
</td>
</tr>


<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
<font face="verdana,arial" size=2 >
<?php 	echo "[$patnum] $lastname, $firstname (".formatDate2Local($bday,$date_format).")<p>"; ?>

<p>
<font face=verdana,arial size=1 color="#cc0000">
<?php if($nopatdata) echo '
	<img '.createMascot($root_path,'mascot1_r.gif','0','bottom').'> <font size=2>'.$LDAlertNoPatientData.'<br></font>';
?>
<form ENCTYPE="multipart/form-data"  action="fotolab-pic-save.php" method="post"  name="srcform" onSubmit="return chkform(this)">
<INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="2000000">
<?php 
/* Load the common icons*/
$img_cam=createComIcon($root_path,'lilcamera.gif','0');

for ($i=0;$i<$maxpic;$i++)
{
/* echo $LDShotDate.'
<input type="text" name="sdate'.$i.'" size=12 maxlength=12 onFocus="this.select();previewpic(document.srcform.picfile'.$i.'.value)"  onKeyUp=setDate(this)>
 '.$LDNr.' 
 <input type="text" name="nr'.$i.'" size=4 maxlength=4 onFocus="previewpic(document.srcform.picfile'.$i.'.value)" value="'.($i+1+$lastnr).'" >
<input type="file" name="picfile'.$i.'" size="30" onFocus="previewpic(this.value)" >  
<a href="javascript:previewpic(document.srcform.picfile'.$i.'.value)" title="'.$LDPreview.'">
<img '.$img_cam.'></a>     
<hr>
';*/
 echo $LDShotDate.'
<input type="text" name="sdate'.$i.'" size=12 maxlength=12 onFocus="this.select();previewpic(document.srcform.picfile'.$i.'.value)"  onBlur="IsValidDate(this,\''.$date_format.'\')"   onKeyUp="setDate(this,\''.$date_format.'\',\''. $lang.'\')">';
 
echo '&nbsp;<a href="javascript:show_calendar(\'srcform.sdate'.$i.'\',\''.$date_format.'\')"><img '.createComIcon($root_path,'show-calendar.gif','0','absmiddle').'></a>';

echo '&nbsp;&nbsp;'.$LDNr.' 
 <input type="text" name="nr'.$i.'" size=4 maxlength=4 onFocus="previewpic(document.srcform.picfile'.$i.'.value)" value="'.($i+1+$lastnr).'" >
<input type="file" name="picfile'.$i.'" size="30" onFocus="previewpic(this.value)" >  
<a href="javascript:previewpic(document.srcform.picfile'.$i.'.value)" title="'.$LDPreview.'">
<img '.$img_cam.'></a>     
<hr>
';
}

?>
<input type="hidden" name="patnum" value="<?php echo $patnum ?>">
<input type="hidden" name="lastname" value="<?php echo $lastname ?>">
<input type="hidden" name="firstname" value="<?php echo $firstname ?>">
<input type="hidden" name="bday" value="<?php echo $bday ?>">
<input type="hidden" name="maxpic" value="<?php echo $maxpic ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="submit" value="<?php echo $LDSave ?>">

</form>


<p>
</FONT>
<FONT size=2 face="verdana,arial">
<form action="<?php echo $thisfile ?>" method="post" name="setmaxpic">
<?php echo $LDWantUpload ?> <input type="text" name="maxpic" size=1 maxlength=2 value="<?php echo $maxpic ?>"> <?php echo $LDImage ?> <input type="submit" value="<?php echo $LDGO ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="patnum" value="<?php echo $patnum ?>">
<input type="hidden" name="lastname" value="<?php echo $lastname ?>">
<input type="hidden" name="firstname" value="<?php echo $firstname ?>">
<input type="hidden" name="bday" value="<?php echo $bday ?>">
<input type="hidden" name="lastnr" value="<?php $lastnr='nr'.($maxpic-1); echo $$lastnr; ?>">
<input type="hidden" name="same_pat" value="1">
</form>

</FONT>
</td>
</tr>
</table>        
</BODY>
</HTML>
