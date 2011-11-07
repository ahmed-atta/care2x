<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/*** CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file 'copy_notice.txt' for the licence notice
*/
define('MODULE','radiology');
define('LANG_FILE_MODULAR','radiology.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);

if(!empty($searchkey)) if(is_numeric($searchkey)) $searchkey=(int)$searchkey;

/* Load date formatter */
include_once($root_path.'include/helpers/inc_date_format_functions.php');

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<html>
<HEAD>

 <style type="text/css" name="s2">
.indx{ font-family:verdana,arial; color:#ffffff; font-size:12; background-color:#6666ff}
</style>
 
<script language="javascript">
<!-- 

function startsrc(f)
{
	window.parent.FILELISTFRAME.location.replace('radiolog-xray-pat-list.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=search&sk='+f.searchkey.value);
	window.parent.PREVIEWFRAME.location.replace('blank.htm');
	window.parent.DIAGNOSISFRAME.location.replace('blank.htm');
	
	return false;
}

function chkform(d)
{
if(d.searchkey.value) startsrc(d);
	else return false;
}

<?php require($root_path.'include/helpers/inc_checkdate_lang.php'); ?>
// -->
</script>
<?php 

require($root_path.'include/helpers/include_header_css_js.php');
?></HEAD>

<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 bgcolor=silver onLoad="document.srcform.searchkey.select();" onFocus="document.srcform.searchkey.select();" 
>

<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td  height="10" >
<FONT    SIZE=+2  FACE="Arial"><STRONG>&nbsp; &nbsp; <?php echo "$LDRadio $LDSearchXray - $LDSearchPat" ?></STRONG></FONT></td>
<td  height="10" align=right><nobr>
<a href="javascript:window.history.back()" class="button icon arrowleft">Back</a><a href="javascript:gethelp('radio.php','search','','0')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  </a><a href="javascript:window.top.opener.focus();window.top.close()" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  </a>
</nobr>
</td></tr>
<tr valign=top >
<td  valign=top colspan=2>
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
<button type="submit" class="button icon search"/>Search</button>
                                                                                                     
</form>




</FONT>

</td>
</tr>


</table>        
&nbsp;

</BODY>
</HTML>
