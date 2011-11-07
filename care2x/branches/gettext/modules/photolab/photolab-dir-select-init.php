<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/helpers/inc_environment_global.php');
/**
 * CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
 * GNU General Public License
 * Copyright 2002,2003,2004,2005 Elpidio Latorilla
 * elpidio@care2x.org,
 *
 * See the file "copy_notice.txt" for the licence notice
 */
define('MODULE','photolab');
define('LANG_FILE_MODULAR','photolab.php');
$local_user='ck_photolab_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');
$breakfile="javascript:window.parent.location.replace('plugin.php?sid=$sid&lang=$lang')";
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<html>
<HEAD>

<script language="javascript">
<!-- 

function chkform(d)
{
	if((d.maxpic.value)&&(!(isNaN(d.maxpic.value)))) return true;
	else
	{
		d.maxpic.value="";
		d.maxpic.focus();
	 	return false;
	}

}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>

<?php

require($root_path.'include/helpers/include_header_css_js.php');
?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0
	bgcolor=silver onFocus="document.srcform.maxpic.select()"
	onFocus="document.srcform.maxpic.select()"
	>

<table width=100% border=0 cellspacing=0 height=100%>

	<tr valign=top height=10>
		<td  height="10"><FONT
			 SIZE=+2 FACE="Arial"><STRONG>&nbsp;<?php echo $LDFotoLab ?></STRONG></FONT></td>
		<td  align=right>
			<a href="javascript:history.back();" class="button icon arrowleft">Back</a>
			<a href="javascript:gethelp('photolab.php','init','')">
			<img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0','absmiddle') ?> class="fadeOut" /></a>
			<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?> class="fadeOut" /></a>
		</td>
	</tr>
	<tr valign=top>
		<td  valign=top colspan=2>
		<center>
		<p><font face=verdana,arial size=3 color="#cc0000">
		<form action="photolab-dir-select.php" method="get"
			onSubmit="return chkform(this)" name="srcform"><br>
			<?php echo $LDHowManyPics ?>
		<p><input type="text" name="maxpic" size=2 maxlength=2>
		<p><input type="hidden" name="sid" value="<?php echo $sid ?>"> <input
			type="hidden" name="lang" value="<?php echo $lang ?>"> <input
			type="submit" value="<?php echo "$LDOK $LDContinue" ?>...">
		
		</form>
		
		</center>
		</FONT></td>
	</tr>
</table>
&nbsp;
</BODY>
</HTML>
