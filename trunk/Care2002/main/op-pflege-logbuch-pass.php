<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php');

require_once('../global_conf/areas_allow.php');

$allowedarea=&$allow_area['op_room'];

if($retpath=="calendar_opt") 
 {
	$append="?sid=$sid&lang=$lang&dept=$dept&retpath=$retpath&pday=$pday&pmonth=$pmonth&pyear=$pyear"; 
	$breakfile="calendar-options.php?sid=$sid&lang=$lang&dept=$dept&retpath=$retpath&day=$pday&month=$pmonth&year=$pyear";
 }
 	 else 
	 {
		$append="?sid=".$sid."&lang=".$lang; 
	 	$breakfile="op-doku.php".$append;
	}


switch($target)
{
	case 'search':$fileforward="op-pflege-logbuch-such-javastart.php".$append;
						$title=$LDSearch;
						break;
	case 'archiv':$fileforward="op-pflege-logbuch-arch-javastart.php".$append;
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
setcookie($userck.$sid,'');
require('../include/inc_2level_reset.php'); setcookie(ck_2level_sid.$sid,"");

require('../include/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include('../include/inc_passcheck.php');

$errbuf="OP Logs $title";

require('../include/inc_passcheck_head.php');
?>

<?php echo setCharSet(); ?>
<BODY <?php if (!$nofocus)
				{ echo 'onLoad="document.passwindow.userid.focus();';
					if($retpath=="calendar_opt") echo "window.resizeTo(800,600);window.moveTo(20,20);";
					echo '"';
				}
				echo  ' bgcolor='.$cfg['body_bgcolor']; 
 				if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>
<p>
<FONT    SIZE=-1  FACE="Arial">

<P>
<img <?php echo createComIcon('../','people.gif','0','absmiddle') ?>>
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana" > <b><?php echo "$LDOrLogBook $title" ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><?php if($target=="entry") echo '<img '.createLDImgSrc('../','newdata-b.gif','0').' alt="'.$LDAdmit.'">';
								else{ echo'<a href="'.$thisfile.$append.'&target=entry"><img '.createLDImgSrc('../','newdata-gray.gif','0').'  alt="'.$LDAdmit.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
							if($target=="search") echo '<img '.createLDImgSrc('../','such-b.gif','0').' alt="'.$LDSearch.'">';
								else{ echo '<a href="'.$thisfile.$append.'&target=search"><img '.createLDImgSrc('../','such-gray.gif','0').' alt="'.$LDSearch.'"  ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
							if($target=="archiv") echo '<img '.createLDImgSrc('../','arch-blu.gif','0').' alt="'.$LDArchive.'">';
								else{ echo '<a href="'.$thisfile.$append.'&target=archiv"><img '.createLDImgSrc('../','arch-gray.gif','0').' alt="'.$LDArchive.'"  ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
						?></td>

</tr>


<?php require('../include/inc_passcheck_mask.php') ?>  

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
