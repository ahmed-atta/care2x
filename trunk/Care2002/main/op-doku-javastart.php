<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define("LANG_FILE","stdpass.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
 ?>


<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="javascript">
<!-- 

function startwindow(){
	w=window.parent.screen.width;
	h=window.parent.screen.height;
	opdokuwin=window.open("<?php switch($target)
											{
												case "entry": print "op-doku-start.php"; break;
												case "search": print "op-doku-search.php";break;
												case "archiv": print "op-doku-archiv.php";
											}
										?>?sid=<?php echo "$sid&lang=$lang&user=$opdoku_user"; ?>","opdokuwin","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60) );
	window.opdokuwin.moveTo(0,0);
	window.location.replace("op-doku.php?sid=<?php echo "$sid&lang=$lang" ?>");
	}
-->
</script>


</HEAD>
<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LINK="#0000FF" VLINK="#800080" onLoad="startwindow()">


</BODY>
</HTML>

