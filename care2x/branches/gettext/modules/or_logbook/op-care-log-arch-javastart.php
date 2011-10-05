<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','or_logbook');
define('LANG_FILE_MODULAR','or_logbook.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/helpers/inc_front_chain_lang.php');
if(!isset($dept_nr)||!$dept_nr){
	header('Location:op-nursing-select-dept.php'.URL_REDIRECT_APPEND.'&target=archiv&retpath='.$retpath);
	exit;
}

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<html>
<HEAD>
<TITLE></TITLE>

<script language="javascript">

function makelogbuch()
{
			w=800;
			h=650;
	logbuchwin=window.open("op-care-log-arch-start.php?sid=<?php echo "$sid&lang=$lang&dept_nr=$dept_nr";?>","archlogbuchwin","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60));
	window.logbuchwin.moveTo(0,0);
	window.location.replace('<?php if($retpath=="calendar_opt") echo $root_path."calendar/calendar-options.php?sid=$sid&lang=$lang&day=$pday&month=$pmonth&year=$pyear"; else echo $root_path."main/op-docu.php?sid=".$sid."&lang=".$lang;?>&forcestation=1&nofocus=1');
	
}
</script>

</HEAD>


<BODY BACKGROUND="#ffffff" onLoad=makelogbuch()>


</BODY>
</HTML>
