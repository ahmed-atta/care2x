<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_stdpass.php");

require("../req/config-color.php");

require("../global_conf/areas_allow.php");

$allowedarea=&$allow_area['op_room'];

if($retpath=="calendar_opt") 
 {
	$append="?sid=$ck_sid&lang=$lang&dept=$dept&retpath=$retpath&pday=$pday&pmonth=$pmonth&pyear=$pyear"; 
	$breakfile="calendar-options.php?sid=$ck_sid&lang=$lang&dept=$dept&retpath=$retpath&day=$pday&month=$pmonth&year=$pyear";
 }
 	 else 
	 {
		$append="?sid=$ck_sid&lang=$lang"; 
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
setcookie($userck,"");

if($ck_login_logged&&$ck_login_userid&&!$nointern)
{
$userid=$ck_login_userid;
$checkintern=1;
$lognote="Direct access ".$lognote;
$pass="check";
}

if ($pass=="check") 	
	include("../req/passcheck.php");

$errbuf="OP Logs $title";

require("../req/passcheck_head.php");
?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<BODY <? if (!$nofocus)
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
<FONT  COLOR="<?=$cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana" > <b><?="$LDOrLogBook $title" ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><?if($target=="entry") print '<img src=../img/'.$lang.'/'.$lang.'_newdata-b.gif border=0 width=130 height=25 alt="'.$LDAdmit.'">';
								else{ print'<a href="'.$thisfile.$append.'&target=entry"><img src="../img/'.$lang.'/'.$lang.'_newdata-gray.gif"  alt="'.$LDAdmit.'" width=130 height=25 border=0 ';if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; print '></a>';}
							if($target=="search") print '<img src="../img/'.$lang.'/'.$lang.'_such-b.gif" width=130 height=25 border=0 alt="'.$LDSearch.'">';
								else{ print '<a href="'.$thisfile.$append.'&target=search"><img src="../img/'.$lang.'/'.$lang.'_such-gray.gif" alt="'.$LDSearch.'" width=130 height=25 border=0 ';if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; print '></a>';}
							if($target=="archiv") print '<img src="../img/'.$lang.'/'.$lang.'_arch-blu.gif" width=130 height=25 border=0 alt="'.$LDArchive.'">';
								else{ print '<a href="'.$thisfile.$append.'&target=archiv"><img src="../img/'.$lang.'/'.$lang.'_arch-gray.gif" alt="'.$LDArchive.'" width=130 height=25 border=0 ';if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; print '></a>';}
						?></td>

</tr>


<? require("../req/passcheck_mask.php") ?>  

<p>
<!-- <img src="../img/small_help.gif"> <a href="ucons.php"><?="$LDIntro2 $LDOrLogBook" ?></a><br>
<img src="../img/small_help.gif"> <a href="ucons.php"><?="$LDWhat2Do $LDOrLogBook" ?></a><br>
 --><HR>
<p>

<?php
require("../language/".$lang."/".$lang."_copyrite.htm");
 ?>


</FONT>


</BODY>
</HTML>
