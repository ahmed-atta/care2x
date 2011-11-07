<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','laboratory');
define('LANG_FILE_MODULAR','laboratory.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

$breakfile=$root_path.'modules/news/start_page.php'.URL_APPEND;
// reset all 2nd level lock cookies
require($root_path.'include/helpers/inc_2level_reset.php');

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<html>
<HEAD>


<script language="javascript" >
<!-- 
function closewin()
{
	location.href='startframe.php?sid=<?php echo "$sid&lang=$lang";?>';
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
?><SCRIPT language="JavaScript" src="../js/sublinker-nd.js">
</SCRIPT>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  
>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" >
<tr valign=top>
<td  height="10">
<FONT    SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo $LDLab ?></STRONG></FONT></td>
<td  height="10" align=right><a href="startframe.php?sid=<?php echo "$sid&lang=$lang" ?>" class="button icon arrowleft">Back</a>
<a href="javascript:gethelp('submenu1.php','<?php echo $LDLab ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  </a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  </a></td>
</tr>
<tr valign=top >
<td  valign=top colspan=2><p><br>

<ul>


<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  alt="<?php echo $LDCloseAlt ?>" align="middle"></a>

<p>
</ul>
</FONT>
<p>
</td>
</tr>

<tr>
<td  height=70 colspan=2>
</td>
</tr>
</table>        
&nbsp;
</FONT>			
</BODY>
</HTML>
