<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
define('LANG_FILE','nursing.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<META http-equiv='Cache-Control' content='no-cache, must-revalidate'>
<META http-equiv='Pragma: no-cache'>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo ucfirst($result[name_last]).",".ucfirst($result[name_first])." ".$result[date_birth]." ".$LDPatDataFolder ?></TITLE>

<style type="text/css">
	A:link  {text-decoration: none; }
	A:hover { color: red }
	A:active {text-decoration: none;}
	A:visited {text-decoration: none;}
</style>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY bgcolor=#cde1ec  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 link="#800080" vlink="#800080" >

<table width=100% border=0 cellpadding="5" cellspacing=0>
<tr>
<td bgcolor="navy" >
<FONT  COLOR="white"  SIZE=+2  FACE="Arial"><STRONG><?php echo "$LDPatDataFolder $station"; ?></STRONG></FONT>
</td>
<td bgcolor="navy" height="10" align=right></a><a href="javascript:gethelp('patient_folder.php','<?php echo $nodoc ?>','','<?php echo $station ?>','Main folder')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?> alt="<?php echo $LDHelp ?>"></a><a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"></a></td></tr>

</tr>
<tr>
<td colspan=2>
 <ul><p><br>
 <?php
 echo '
	<center><FONT  COLOR="maroon"  SIZE=4  FACE="Arial"><p><br>
	<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'> &nbsp;
	<b>'.$LDNoLabReport.'</b><p>
		<form method="post" action="'.$root_path.'modules/nursing/nursing-station-patientdaten.php">
	<input type="hidden" name="sid" value="'.$sid.'">
 	<input type="hidden" name="lang" value="'.$lang.'">
<input type="hidden" name="pn" value="'.$pn.'">
<input type="hidden" name="edit" value="'.$edit.'">
 <input type="hidden" name="station" value="'.$station.'">  
 <input type="hidden" name="nodoc" value="">  
 <input type="submit" value=" OK ">
     </form>
	</center>';
 ?>
<p>
</FONT>
</ul>
<p>
</td>
</tr>
</table>        
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</BODY>
</HTML>
