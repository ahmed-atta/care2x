<? 

if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if(($sid==NULL)||($sid!=$ck_sid)) { header("location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}

require("../language/".$lang."/lang_".$lang."_stdpass.php");

require("../req/config-color.php");

require("../global_conf/areas_allow.php");

$allowedarea=&$allow_area['news'];

$default_forward="editor-4plus1-select-art.php?sid=$ck_sid&lang=$lang&target=$target&title=".strtr($title," ","+");

switch($target)
{
	case "headline": $allowedarea[]="headline";
							$fileforward="headline-edit-select-art.php?sid=$ck_sid&lang=$lang&target=$target&title=".strtr($title," ","+");
							//$title="Schlagzeile Bearbeiten";
							//$userck="ck_headline_user";
							$breakfile="startframe.php?sid=$ck_sid&lang=$lang";
							$lognote="$title+editor";
							break;
	case "cafenews": $allowedarea[]="cafenews";
							$fileforward="cafenews-edit-select.php?sid=$ck_sid&lang=$lang&target=$target&title=".strtr($title," ","+");
							//$title="Cafenews Bearbeiten";
							$userck="ck_cafenews_user";
							$breakfile="cafenews.php?sid=$ck_sid&lang=$lang";
							$lognote="$title+editor";
							break;
	case "management": $allowedarea[]="management";
							$fileforward=$default_forward;
							//$title="Cafenews Bearbeiten";
							//$userck="ck_cafenews_user";
							$breakfile="startframe.php?sid=$ck_sid&lang=$lang&title=".strtr($title," ","+");
							$lognote="$title+editor";
							break;
	case "healthtips": $allowedarea[]="healthtip";
							$fileforward=$default_forward;
							//$title="Gesundheitstips Verfassen";
							//$userck="ck_healthtips_user";
							$breakfile="newscolumns.php?sid=$ck_sid&target=healthtips&lang=$lang&title=".strtr($title," ","+");
							$lognote="$title+editor";
							break;
	case "physiotherapy": $allowedarea[]="physiotherapy";
							$fileforward=$default_forward;
							//$title="Physiotherapie - Artikel Verfassen";
							//$userck="ck_healthtips_user";
							$breakfile="newscolumns.php?sid=$ck_sid&target=physiotherapy&lang=$lang&title=".strtr($title," ","+");
							$lognote="$title+editor";
							break;
	case "adv_studies": $allowedarea[]="advstudies";
							$fileforward=$default_forward;
							//$title="Fortbildung - Artikel Verfassen";
							//$userck="ck_healthtips_user";
							$breakfile="newscolumns.php?sid=$ck_sid&target=adv_studies&lang=$lang&title=".strtr($title," ","+");
							$lognote="$title+editor";
							break;
	case "prof_training": $allowedarea[]="proftraining";
							$fileforward=$default_forward;
							//$title="Ausbildung - Artikel Verfassen";
							//$userck="ck_healthtips_user";
							$breakfile="newscolumns.php?sid=$ck_sid&target=prof_training&lang=$lang&title=".strtr($title," ","+");
							$lognote="$title+editor";
							break;
	case "events": $allowedarea[]="events";
							$fileforward=$default_forward;
							//$title="Veranstaltungen";
							//$userck="ck_healthtips_user";
							$breakfile="newscolumns.php?sid=$ck_sid&target=events&lang=$lang&title=".strtr($title," ","+");
							$lognote="$title+editor";
							break;
	case "patient_admission": $allowedarea[]="events";
							$fileforward=$default_forward;
							//$title="Veranstaltungen";
							//$userck="ck_healthtips_user";
							$breakfile="newscolumns.php?sid=$ck_sid&target=patient_admission&lang=$lang&title=".strtr($title," ","+");
							$lognote="$title+editor";
							break;
	default:
				if(strpos($target,"ept_")) 
				{
							//$allowedarea[]="alle";
							$fileforward=$default_forward;
							//$fileforward="headline-edit-select-art.php?sid=$ck_sid&lang=$lang&target=$target&title=".strtr($title," ","+");
							//$title="Veranstaltungen";
							//$userck="ck_healthtips_user";
							$breakfile="newscolumns.php?sid=$ck_sid&target=$target&lang=$lang&title=".strtr($title," ","+");
							$lognote="$title+editor";
				}
				else
				{
							//$allowedarea[]="alle";
							$fileforward=$default_forward;
							//$fileforward="headline-edit-select-art.php?sid=$ck_sid&lang=$lang&target=$target&title=".strtr($title," ","+");
							//$title="Veranstaltungen";
							//$userck="ck_healthtips_user";
							$breakfile="newscolumns.php?sid=$ck_sid&target=$target&lang=$lang&title=".strtr($title," ","+");
							$lognote="$title+editor";
				}
}
							
$userck="ck_editor_user";

$thisfile="editor-pass.php";							
//$thisfile="doctors-dienstplan-pass.php?sid=$ck_sid~dept=$dept~retpath=$retpath~pmonth=$pmonth~pyear=$pyear";
$passtag=0;

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

$errbuf=strtr($lognote,"+"," ");

require("../req/passcheck_head.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<? print $cfg['body_bgcolor']; ?>
<? if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<P>

<FONT  COLOR=<?=$cfg[top_txtcolor] ?>  SIZE=6  FACE="verdana"> <b><?=$title ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<? require("../req/passcheck_mask.php") ?>  

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
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php"><?=$LDIntroTo." ".$title ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php"><?=$LDWhatTo." ".$title ?>?</a><br>
<HR>
<?php
 // get a  page into an array and print it out
require("../language/".$lang."/".$lang."_copyrite.htm");
 ?>

</FONT>


</BODY>
</HTML>
