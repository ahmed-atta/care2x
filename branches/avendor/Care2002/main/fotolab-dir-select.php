<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../language/".$lang."/lang_".$lang."_specials.php");
require("../req/config-color.php");

$thisfile="fotolab-dir-select.php";
$breakfile="javascript:window.parent.location.replace('spediens.php?sid=$ck_sid&lang=$lang')";
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <style type="text/css" name="s2">
.indx{ font-family:verdana,arial; color:#ffffff; font-size:12; background-color:#6666ff}
</style>

 <script language="javascript" src="../js/setdatetime.js">
</script>

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
			alert('<?=$LDAlertNumberOnly ?>');
	 		return false;
		}
	}

}

function previewpic(fn) {
if(fn=="") return;
else parent.PREVIEWFRAME.document.previewpic.src=fn;

}

function chkform(d)
{
	var maxpix=<?=$maxpic ?>;
	var flag=1;
	for(i=0;i<maxpix;i++)
	{
		if((eval("d.sdate"+i+".value==''"))||!chkNumber(i)||(eval("d.picfile"+i+".value==''"))) 
		{
			alert("<?=$LDAlertPhotoInfo ?>" + (i+1) + " <?=$LDAlertNoPhotoInfo ?>");
			flag=0;
			return false;
		}
	}
	if(flag)
	{
		m=window.parent.MAINDATAFRAME.document.maindata;
		if((m.patnum.value=="")||(m.lastname.value=="")||(m.firstname.value=="")||(m.bday.value==""))
		{
			alert("<?=$LDAlertNoPatientData ?>");
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
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

// -->
</script>

<? 
require("../req/css-a-hilitebu.php");
?>

</HEAD>

<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 bgcolor=silver <? if(!$same_pat) print ' onLoad="window.parent.MAINDATAFRAME.location.replace(\'fotolab-maindata.php?sid='.$ck_sid.'&lang='.$lang.'&maxpic='.$maxpic.'\');window.parent.PREVIEWFRAME.location.replace(\'fotolab-preview.php?sid='.$ck_sid.'&lang='.$lang.'\');" ';
else print ' onLoad="window.parent.PREVIEWFRAME.location.replace(\'fotolab-preview.php?sid='.$ck_sid.'&lang='.$lang.'\');window.parent.MAINDATAFRAME.document.maindata.maxpic.value='.$maxpic.'" '; ?> 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG>&nbsp;<?=$LDFotoLab ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" align=right><a href="javascript:history.back();"><img 
src="../img/<?="$lang/$lang" ?>_back2.gif" border=0 width=110 height=24 align="absmiddle" 
style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a 
href="javascript:gethelp('fotolab.php','input','')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?=$breakfile ?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2>
<p><font face=verdana,arial size=1 color="#cc0000">
<? if($nopatdata) print '
	<img src="../img/catr.gif" border=0 width=88 height=80> <font size=2>'.$LDAlertNoPatientData.'<br></font>';
?>
<form ENCTYPE="multipart/form-data"  action="fotolab-pic-save.php" method="post"  name="srcform" onSubmit="return chkform(this)">
<INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="2000000">
<? for ($i=0;$i<$maxpic;$i++)
{
 print $LDShotDate.'
<input type="text" name="sdate'.$i.'" size=12 maxlength=12 onFocus="this.select();previewpic(document.srcform.picfile'.$i.'.value)"  onKeyUp=setDate(this)>
 '.$LDNr.' 
 <input type="text" name="nr'.$i.'" size=4 maxlength=4 onFocus="previewpic(document.srcform.picfile'.$i.'.value)" value="'.($i+1+$lastnr).'" >
<input type="file" name="picfile'.$i.'" size="30" onFocus="previewpic(this.value)" >  
<a href="javascript:previewpic(document.srcform.picfile'.$i.'.value)" title="'.$LDPreview.'">
<img src="../img/lilcamera.gif" width=23 height=16 border=0></a>     
<hr>
';
}

?>
<input type="hidden" name="patnum" value="">
<input type="hidden" name="lastname" value="">
<input type="hidden" name="firstname" value="">
<input type="hidden" name="bday" value="">
<input type="hidden" name="maxpic" value="<?=$maxpic ?>">
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="submit" value="<?=$LDSave ?>">

</form>




</FONT>

</td>
</tr>


</table>        
&nbsp;

</BODY>
</HTML>
