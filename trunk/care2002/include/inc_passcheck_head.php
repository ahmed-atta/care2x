<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_passcheck_head.php",$PHP_SELF)) 
	die("<meta http-equiv='refresh' content='0; url=../'>");
/*------end------*/
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE></TITLE>
 
<script language="javascript">
<!-- 
function pruf(d)
{
	if((d.userid.value=="")&&(d.keyword.value=="")) return false;
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
include("../include/inc_css_a_hilitebu.php");
?>
 
</HEAD>

