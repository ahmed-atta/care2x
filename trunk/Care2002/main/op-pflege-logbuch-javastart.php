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
define("LANG_FILE","or.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");

if (!$internok&&!$HTTP_COOKIE_VARS["ck_op_pflegelogbuch_user".$sid]) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../include/inc_config_color.php"); // load color preferences


?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><TITLE></TITLE>

<script language="javascript">

function makelogbuch()
{
<?php if($cfg['dhtml'])
	print '
			w=window.parent.screen.width;
			h=window.parent.screen.height;';
	else
	print '
			w=800;
			h=650;';
?>
	logbuchwin=window.open("op-pflege-logbuch-start.php?sid=<?php print "$sid&lang=$lang&internok=$internok"; ?>","logbuchwin<?php echo uniqid("") ?>","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60));
	window.logbuchwin.moveTo(0,0);
	window.location.replace('<?php if($retpath=="calendar_opt") print "calendar-options.php?sid=$sid&lang=$lang&day=$pday&month=$pmonth&year=$pyear"; else print "op-doku.php?sid=$sid&lang=$lang";?>&forcestation=1&nofocus=1&nointern=1');
}
</script>

</HEAD>


<BODY BACKGROUND="#ffffff" onLoad="makelogbuch()">


</BODY>
</HTML>
