<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define("LANG_FILE","stdpass.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");

require("../include/inc_config_color.php");

require("../global_conf/areas_allow.php");

$allowedarea=&$allow_area['news'];

$default_forward="editor-4plus1-select-art.php?sid=$sid&lang=$lang&target=$target&title=".strtr($title," ","+");

switch($target)
{
	case "headline": $allowedarea[]="headline";
							$fileforward="headline-edit-select-art.php?sid=$sid&lang=$lang&target=$target&title=".strtr($title," ","+");
							//$title="Schlagzeile Bearbeiten";
							//$userck="ck_headline_user";
							$breakfile="startframe.php?sid=$sid&lang=$lang";
							$lognote="$title+editor";
							break;
	case "cafenews": $allowedarea[]="cafenews";
							$fileforward="cafenews-edit-select.php?sid=$sid&lang=$lang&target=$target&title=".strtr($title," ","+");
							//$title="Cafenews Bearbeiten";
							$userck="ck_cafenews_user";
							$breakfile="cafenews.php?sid=$sid&lang=$lang";
							$lognote="$title+editor";
							break;
	case "management": $allowedarea[]="management";
							$fileforward=$default_forward;
							//$title="Cafenews Bearbeiten";
							//$userck="ck_cafenews_user";
							$breakfile="startframe.php?sid=$sid&lang=$lang&title=".strtr($title," ","+");
							$lognote="$title+editor";
							break;
	case "healthtips": $allowedarea[]="healthtip";
							$fileforward=$default_forward;
							//$title="Gesundheitstips Verfassen";
							//$userck="ck_healthtips_user";
							$breakfile="newscolumns.php?sid=$sid&target=healthtips&lang=$lang&title=".strtr($title," ","+");
							$lognote="$title+editor";
							break;
	case "physiotherapy": $allowedarea[]="physiotherapy";
							$fileforward=$default_forward;
							//$title="Physiotherapie - Artikel Verfassen";
							//$userck="ck_healthtips_user";
							$breakfile="newscolumns.php?sid=$sid&target=physiotherapy&lang=$lang&title=".strtr($title," ","+");
							$lognote="$title+editor";
							break;
	case "adv_studies": $allowedarea[]="advstudies";
							$fileforward=$default_forward;
							//$title="Fortbildung - Artikel Verfassen";
							//$userck="ck_healthtips_user";
							$breakfile="newscolumns.php?sid=$sid&target=adv_studies&lang=$lang&title=".strtr($title," ","+");
							$lognote="$title+editor";
							break;
	case "prof_training": $allowedarea[]="proftraining";
							$fileforward=$default_forward;
							//$title="Ausbildung - Artikel Verfassen";
							//$userck="ck_healthtips_user";
							$breakfile="newscolumns.php?sid=$sid&target=prof_training&lang=$lang&title=".strtr($title," ","+");
							$lognote="$title+editor";
							break;
	case "events": $allowedarea[]="events";
							$fileforward=$default_forward;
							//$title="Veranstaltungen";
							//$userck="ck_healthtips_user";
							$breakfile="newscolumns.php?sid=$sid&target=events&lang=$lang&title=".strtr($title," ","+");
							$lognote="$title+editor";
							break;
	case "patient_admission": $allowedarea[]="events";
							$fileforward=$default_forward;
							//$title="Veranstaltungen";
							//$userck="ck_healthtips_user";
							$breakfile="newscolumns.php?sid=$sid&target=patient_admission&lang=$lang&title=".strtr($title," ","+");
							$lognote="$title+editor";
							break;
	default:
				if(strpos($target,"ept_")) 
				{
							//$allowedarea[]="alle";
							$fileforward=$default_forward;
							//$fileforward="headline-edit-select-art.php?sid=$sid&lang=$lang&target=$target&title=".strtr($title," ","+");
							//$title="Veranstaltungen";
							//$userck="ck_healthtips_user";
							$breakfile="newscolumns.php?sid=$sid&target=$target&lang=$lang&title=".strtr($title," ","+");
							$lognote="$title+editor";
				}
				else
				{
							//$allowedarea[]="alle";
							$fileforward=$default_forward;
							//$fileforward="headline-edit-select-art.php?sid=$sid&lang=$lang&target=$target&title=".strtr($title," ","+");
							//$title="Veranstaltungen";
							//$userck="ck_healthtips_user";
							$breakfile="newscolumns.php?sid=$sid&target=$target&lang=$lang&title=".strtr($title," ","+");
							$lognote="$title+editor";
				}
}
							
$userck="ck_editor_user";

$thisfile="editor-pass.php";							
//$thisfile="doctors-dienstplan-pass.php?sid=$$ck_sid_buffer~dept=$dept~retpath=$retpath~pmonth=$pmonth~pyear=$pyear";
$passtag=0;

//reset cookie;
// reset all 2nd level lock cookies
require("../include/inc_2level_reset.php"); 
setcookie(ck_2level_sid.$sid,"");

require("../include/inc_passcheck_internchk.php");
if ($pass=="check") 	
	include("../include/inc_passcheck.php");

$errbuf=strtr($lognote,"+"," ");

require("../include/inc_passcheck_head.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php print $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<P>

<FONT  COLOR=<?php echo $cfg[top_txtcolor] ?>  SIZE=6  FACE="verdana"> <b><?php echo $title ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require("../include/inc_passcheck_mask.php") ?>  

<p><br>

</center>

</td>
<td bgcolor=#333399><font size=1>&nbsp;</td>
</tr>

<tr >
<td bgcolor="#333399" colspan=3><font size=1>
&nbsp; 
</td>
</tr>
</table>        
<FONT    SIZE=2  FACE="Arial">

<p>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo $LDIntroTo." ".$title ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo $LDWhatTo." ".$title ?>?</a><br>
<HR>
<?php
 // get a  page into an array and print it out
require("../language/".$lang."/".$lang."_copyrite.php");
 ?>

</FONT>


</BODY>
</HTML>
