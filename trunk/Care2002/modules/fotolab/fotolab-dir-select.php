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
define('LANG_FILE','specials.php');
$local_user='ck_fotolab_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');

/* Load date formatter */
require_once($root_path.'include/inc_date_format_functions.php');
				


$thisfile='fotolab-dir-select.php';
$breakfile="javascript:window.parent.location.replace('spediens.php?sid=$sid&lang=$lang')";
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
	var flag=1;
	for(i=0;i<maxpix;i++)
	{
		//if((eval("d.sdate"+i+".value==''"))||!chkNumber(i)||(eval("d.picfile"+i+".value==''"))) 
		if((eval("d.sdate"+i+".value==''"))||(eval("d.picfile"+i+".value==''"))) 
		{
			alert("<?php echo $LDAlertPhotoInfo ?>" + (i+1) + " <?php echo $LDAlertNoPhotoInfo ?>");
			flag=0;
			return false;
		}
	}
	if(flag)
	{
		m=window.parent.MAINDATAFRAME.document.maindata;
		if((m.patnum.value=="")||(m.lastname.value=="")||(m.firstname.value=="")||(m.bday.value==""))
		{
			alert("rrr<?php echo $LDAlertNoPatientData ?>");
			flag=0;
			return false;
		}
		else
		{
			d.patnum.value=m.patnum.value;
			d.lastname.value=m.lastname.value;
			d.firstname.value=m.firstname.value;
			d.bday.value=m.bday.value;
			return true;
		}
	}
}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>


// -->
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>

<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?></HEAD>

<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 bgcolor=silver <?php if(!$same_pat) echo ' onLoad="window.parent.MAINDATAFRAME.location.replace(\'fotolab-maindata.php?sid='.$sid.'&lang='.$lang.'&maxpic='.$maxpic.'\');window.parent.PREVIEWFRAME.location.replace(\'fotolab-preview.php?sid='.$sid.'&lang='.$lang.'\');" ';
else echo ' onLoad="window.parent.PREVIEWFRAME.location.replace(\'fotolab-preview.php?sid='.$sid.'&lang='.$lang.'\');window.parent.MAINDATAFRAME.document.maindata.maxpic.value='.$maxpic.'" '; ?> 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG>&nbsp;<?php echo $LDFotoLab ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right><a href="javascript:history.back();"><img 
<?php echo createLDImgSrc($root_path,'back2.gif','0','absmiddle') ?> 
style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a 
href="javascript:gethelp('fotolab.php','input','')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0','absmiddle') ?> style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?> style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
<p><font face=verdana,arial size=1 color="#cc0000">
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
<input type="text" name="sdate'.$i.'" size=12 maxlength=12 onFocus="this.select();previewpic(document.srcform.picfile'.$i.'.value)"  onBlur="IsValidDate(this,\''.$date_format.'\')"   onKeyUp="setDate(this,\''.$date_format.'\',\''. $lang.'\')">
 '.$LDNr.' 
 <input type="text" name="nr'.$i.'" size=4 maxlength=4 onFocus="previewpic(document.srcform.picfile'.$i.'.value)" value="'.($i+1+$lastnr).'" >
<input type="file" name="picfile'.$i.'" size="30" onFocus="previewpic(this.value)" >  
<a href="javascript:previewpic(document.srcform.picfile'.$i.'.value)" title="'.$LDPreview.'">
<img '.$img_cam.'></a>     
<hr>
';
}

?>
<input type="hidden" name="patnum" value="">
<input type="hidden" name="lastname" value="">
<input type="hidden" name="firstname" value="">
<input type="hidden" name="bday" value="">
<input type="hidden" name="maxpic" value="<?php echo $maxpic ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="submit" value="<?php echo $LDSave ?>">

</form>
</FONT>
</td>
</tr>
</table>        
&nbsp;
</BODY>
</HTML>
