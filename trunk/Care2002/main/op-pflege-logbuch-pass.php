<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define("LANG_FILE","stdpass.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php");

require("../global_conf/areas_allow.php");

$allowedarea=&$allow_area['op_room'];

if($retpath=="calendar_opt") 
 {
	$append="?sid=$sid&lang=$lang&dept=$dept&retpath=$retpath&pday=$pday&pmonth=$pmonth&pyear=$pyear"; 
	$breakfile="calendar-options.php?sid=$sid&lang=$lang&dept=$dept&retpath=$retpath&day=$pday&month=$pmonth&year=$pyear";
 }
 	 else 
	 {
		$append="?sid=$sid&lang=$lang"; 
	 	$breakfile="op-doku.php".$append;
	}


switch($target)
{
	case "search":$fileforward="op-pflege-logbuch-such-javastart.php".$append;
						$title=$LDSearch;
						break;
	case "archiv":$fileforward="op-pflege-logbuch-arch-javastart.php".$append;
						$title=$LDArchive;
						break;
	default:$fileforward="op-pflege-logbuch-javastart.php".$append;
				$target="entry";
				$title=$LDNewData;
}

$thisfile="op-pflege-logbuch-pass.php";

$lognote="OP Logs $title ok";

$userck="ck_op_pflegelogbuch_user";
//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,"");
require("../include/inc_2level_reset.php"); setcookie(ck_2level_sid.$sid,"");

require("../include/inc_passcheck_internchk.php");
if ($pass=="check") 	
	include("../include/inc_passcheck.php");

$errbuf="OP Logs $title";

require("../include/inc_passcheck_head.php");
?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<BODY <?php if (!$nofocus)
				{ print 'onLoad="document.passwindow.userid.focus();';
					if($retpath=="calendar_opt") print "window.resizeTo(800,600);window.moveTo(20,20);";
					print '"';
				}
				print  ' bgcolor='.$cfg['body_bgcolor']; 
 				if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>
<p>
<FONT    SIZE=-1  FACE="Arial">

<P>
<img src="../img/people.gif" align="absmiddle">
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana" > <b><?php echo "$LDOrLogBook $title" ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><?php if($target=="entry") print '<img src=../img/'.$lang.'/'.$lang.'_newdata-b.gif border=0 width=130 height=25 alt="'.$LDAdmit.'">';
								else{ print'<a href="'.$thisfile.$append.'&target=entry"><img src="../img/'.$lang.'/'.$lang.'_newdata-gray.gif"  alt="'.$LDAdmit.'" width=130 height=25 border=0 ';if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; print '></a>';}
							if($target=="search") print '<img src="../img/'.$lang.'/'.$lang.'_such-b.gif" width=130 height=25 border=0 alt="'.$LDSearch.'">';
								else{ print '<a href="'.$thisfile.$append.'&target=search"><img src="../img/'.$lang.'/'.$lang.'_such-gray.gif" alt="'.$LDSearch.'" width=130 height=25 border=0 ';if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; print '></a>';}
							if($target=="archiv") print '<img src="../img/'.$lang.'/'.$lang.'_arch-blu.gif" width=130 height=25 border=0 alt="'.$LDArchive.'">';
								else{ print '<a href="'.$thisfile.$append.'&target=archiv"><img src="../img/'.$lang.'/'.$lang.'_arch-gray.gif" alt="'.$LDArchive.'" width=130 height=25 border=0 ';if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; print '></a>';}
						?></td>

</tr>


<?php require("../include/inc_passcheck_mask.php") ?>  

<p>
<!-- <img src="../img/small_help.gif"> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo "$LDIntro2 $LDOrLogBook" ?></a><br>
<img src="../img/small_help.gif"> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo "$LDWhat2Do $LDOrLogBook" ?></a><br>
 --><HR>
<p>

<?php
require("../language/".$lang."/".$lang."_copyrite.php");
 ?>


</FONT>


</BODY>
</HTML>
