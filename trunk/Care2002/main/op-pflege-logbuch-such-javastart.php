<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','or.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php'); // this is important for determining to expand the window
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?><TITLE></TITLE>

<script language="javascript">

function makelogbuch()
{
<?php if($cfg['dhtml'])
	echo '
			w=window.parent.screen.width;
			h=window.parent.screen.height;';
	else
	echo '
			w=800;
			h=650;';
?>
	logbuchwin=window.open("op-pflege-logbuch-xtsuch-start.php?sid=<?php echo "$sid&lang=$lang";?>&user=<?php echo str_replace(" ","+",$op_pflegelogbuch_user);?>","suchlogbuchwin","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60));
	window.logbuchwin.moveTo(0,0);
	window.location.replace('<?php if($retpath=="calendar_opt") echo "calendar-options.php?sid=$sid&lang=$lang&day=$pday&month=$pmonth&year=$pyear"; else echo "op-doku.php?sid=".$sid."&lang=".$lang;?>&forcestation=1&nofocus=1');
	
}
</script>

</HEAD>


<BODY BACKGROUND="#ffffff" onLoad="makelogbuch()">


</BODY>
</HTML>
