<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
 ?>


<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="javascript">
<!-- 

function startwindow(){
	w=window.parent.screen.width;
	h=window.parent.screen.height;
	opdokuwin=window.open("<? switch($target)
											{
												case "entry": print "op-doku-start.php"; break;
												case "search": print "op-doku-search.php";break;
												case "archiv": print "op-doku-archiv.php";
											}
										?>?sid=<?="$ck_sid&lang=$lang&user=$opdoku_user"; ?>","opdokuwin","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60) );
	window.opdokuwin.moveTo(0,0);
	window.location.replace("op-doku.php?sid=<?="$ck_sid&lang=$lang" ?>");
	}
-->
</script>


</HEAD>
<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LINK="#0000FF" VLINK="#800080" onLoad="startwindow()">


</BODY>
</HTML>

