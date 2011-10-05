<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
define('MODULE','or_logbook');
define('LANG_FILE_MODULAR','or_logbook.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['op_room'];

if($retpath=='calendar_opt'){
	$append=URL_APPEND."&dept_nr=$dept_nr&retpath=$retpath&pday=$pday&pmonth=$pmonth&pyear=$pyear"; 
	$breakfile=$root_path."modules/calendar/calendar-options.php".URL_APPEND."&dept_nr=$dept_nr&retpath=$retpath&day=$pday&month=$pmonth&year=$pyear";
}else{
	$append=URL_APPEND; 
 	$breakfile=$root_path."main/op-docu.php".URL_APPEND;
}

if(!isset($dept_nr)) $dept_nr='';

switch($target)
{
	case 'search':$fileforward="op-care-log-search-javastart.php".URL_REDIRECT_APPEND."&dept_nr=$dept_nr";
						$title=$LDSearch;
						break;
	case 'archiv':$fileforward="op-care-log-arch-javastart.php".URL_REDIRECT_APPEND."&dept_nr=$dept_nr";
						$title=$LDArchive;
						break;
	default:$fileforward="op-care-log-javastart.php".URL_REDIRECT_APPEND."&dept_nr=$dept_nr";
				$target="entry";
				$title=$LDNewData;
}

$thisfile=basename(__FILE__);

$lognote="OP Logs $title ok";

$userck='ck_op_pflegelogbuch_user';
//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require($root_path.'include/helpers/inc_2level_reset.php'); 
setcookie(ck_2level_sid.$sid,'');

require($root_path.'include/helpers/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/helpers/inc_passcheck.php');

$errbuf="OP Logs $title";

require($root_path.'include/helpers/inc_passcheck_head.php');
?>
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
<img <?php echo createComIcon($root_path,'people.gif','0','absmiddle') ?>>
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana" > <b><?php echo "$LDOrLogBook $title" ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><?php if($target=="entry") echo '<img '.createLDImgSrc($root_path,'newdata-b.gif','0').' alt="'.$LDAdmit.'">';
								else{ echo'<a href="'.$thisfile.$append.'&target=entry"><img '.createLDImgSrc($root_path,'newdata-gray.gif','0').'  alt="'.$LDAdmit.'" ';if($cfg['dhtml'])echo'class="fadeOut" '; echo '></a>';}
							if($target=="search") echo '<img '.createLDImgSrc($root_path,'such-b.gif','0').' alt="'.$LDSearch.'">';
								else{ echo '<a href="'.$thisfile.$append.'&target=search"><img '.createLDImgSrc($root_path,'such-gray.gif','0').' alt="'.$LDSearch.'"  ';if($cfg['dhtml'])echo'class="fadeOut" '; echo '></a>';}
							if($target=="archiv") echo '<img '.createLDImgSrc($root_path,'arch-blu.gif','0').' alt="'.$LDArchive.'">';
								else{ echo '<a href="'.$thisfile.$append.'&target=archiv"><img '.createLDImgSrc($root_path,'arch-gray.gif','0').' alt="'.$LDArchive.'"  ';if($cfg['dhtml'])echo'class="fadeOut" '; echo '></a>';}
						?></td>
</tr>
<?php require($root_path.'include/helpers/inc_passcheck_mask.php') ?>  
</FONT>
</BODY>
</HTML>
