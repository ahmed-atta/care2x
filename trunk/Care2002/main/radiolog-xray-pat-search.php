<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","radio.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php");

$thisfile="radiolog-xray-pat-search.php";

if(!empty($patnum)) if(is_numeric($patnum)) $patnum=(int)$patnum; else $patnum="";
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <style type="text/css" name="s2">
.indx{ font-family:verdana,arial; color:#ffffff; font-size:12; background-color:#6666ff}
</style>
 
<script language="javascript">
<!-- 

function startsrc(f)
{
	window.parent.FILELISTFRAME.location.replace('radiolog-xray-pat-list.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=search&patnum='+f.patnum.value+'&lastname='+f.lastname.value+'&firstname='+f.firstname.value+'&bday='+f.bday.value);
	window.parent.PREVIEWFRAME.location.replace('blank.htm');
	window.parent.DIAGNOSISFRAME.location.replace('blank.htm');
	
	return false;
}

function chkform(d)
{
if(d.patnum.value) startsrc(d);
else if (d.firstname.value) startsrc(d);
else if (d.lastname.value) startsrc(d);
else if (d.bday.value) startsrc(d);
else if (d.category.selectedIndex) startsrc(d);
else return false;
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
require("../include/inc_css_a_hilitebu.php");
?>

</HEAD>

<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 bgcolor=silver onLoad="document.srcform.patnum.select();" onFocus="document.srcform.patnum.select();" 
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG>&nbsp; &nbsp; <?php echo "$LDRadio $LDSearchXray - $LDSearchPat" ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right><nobr>
<a href="javascript:window.history.back()"><img src="../img/<?php echo "$lang/$lang" ?>_back2.gif" width=110 height=24 border=0  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('radio.php','search','','0')"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:window.top.opener.focus();window.top.close()" ><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</nobr>
</td></tr>
<tr valign=top >
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top colspan=2>
<form action="<?php echo $thisfile ?>" method="get" onSubmit="return chkform(this)" name="srcform">
<table border=0>
  <tr>
    <td class="indx">&nbsp;<?php echo $LDCaseNr ?></td>
    <td class="indx">&nbsp;<?php echo $LDLastName ?></td>
    <td class="indx">&nbsp;<?php echo $LDName ?></td>
    <td class="indx">&nbsp;<?php echo $LDBday ?></td>
    <td class="indx">&nbsp;<?php echo $LDCategory ?></td>
  </tr>
  <tr>
    <td><input type="text" name="patnum" size=10 maxlength=12 value="<?php echo $patnum ?>"  onFocus="this.select();">
        </td>
    <td><input type="text" name="lastname" size=18 maxlength=12 value="<?php echo $lastname ?>"></td>
    <td><input type="text" name="firstname" size=18 maxlength=12 value="<?php echo $firstname ?>"></td>
    <td><input type="text" name="bday" size=12 maxlength=12 value="<?php echo $bday ?>"></td>
    <td><select name="category" size=1>
        	<option value=""></option>
        	<option value="l3d" <?php if($category=="l3d") print "selected"; ?>> <?php echo $LDPast3Days ?></option>
        	<option value="l3m" <?php if($category=="l3m") print "selected"; ?>> <?php echo $LDPast3Months ?></option>
        	<option value="all" <?php if($category=="all") print "selected"; ?>> <?php echo $LDPastAll ?></option>
        </select>
        </td>
  </tr>
</table>
<input type="hidden" name="mode" value="search">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="image" src="../img/<?php echo "$lang/$lang" ?>_searchlamp.gif" border=0 width=108 height=24 alt="<?php echo $LDSearchPat ?>" align="absmiddle">
                                                                                                     
</form>




</FONT>

</td>
</tr>


</table>        
&nbsp;

</BODY>
</HTML>
