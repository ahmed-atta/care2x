<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');

define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['news'];

$append="?sid=$sid&lang=$lang";

$default_forward=$root_path.'modules/news/editor-4plus1-select-art.php';

$default_breakfile='newscolumns.php'.URL_APPEND;

/* Filter probable errors in navigation */
if(!isset($HTTP_SESSION_VARS['sess_file_editor']) || empty($HTTP_SESSION_VARS['sess_file_editor'])) $fileforward=$default_forward.URL_REDIRECT_APPEND;
   else $fileforward=$HTTP_SESSION_VARS['sess_file_editor'].URL_REDIRECT_APPEND;

if(!isset($HTTP_SESSION_VARS['sess_file_break']) || empty($HTTP_SESSION_VARS['sess_file_break'])) $breakfile=$default_breakfile.URL_APPEND;
   else $breakfile=$root_path.$HTTP_SESSION_VARS['sess_file_break'].URL_APPEND;

   
$title= (!empty($title)) ? $title : $HTTP_SESSION_VARS['sess_title']; 
   
$lognote="$title+editor";
$userck="ck_editor_user";					

//$fileforward=$HTTP_SESSION_VARS['sess_file_editor'].URL_REDIRECT_APPEND;
//$breakfile=$HTTP_SESSION_VARS['sess_file_break'].$URL_APPEND;

$thisfile=basename(__FILE__);							

$passtag=0;

//reset cookie;
// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php'); 
setcookie('ck_2level_sid'.$sid,"");

require($root_path.'include/inc_passcheck_internchk.php');
if (isset($pass) &&  ($pass=='check')) 	
	include($root_path.'include/inc_passcheck.php');

$errbuf=strtr($lognote,"+"," ");

require($root_path.'include/inc_passcheck_head.php');
?>
<?php echo setCharSet(); ?>
<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<P>

<FONT  COLOR=<?php echo $cfg['top_txtcolor'] ?>  SIZE=6  FACE="verdana"> <b><?php echo $title; ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require($root_path.'include/inc_passcheck_mask.php'); ?>  

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
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDIntroTo." ".$title ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDWhatTo." ".$title ?>?</a><br>
<HR>
<?php
if(file_exists($root_path.'language/'.$lang.'/'.$lang.'_copyrite.php'))
include($root_path.'language/'.$lang.'/'.$lang.'_copyrite.php');
  else include($root_path.'language/en/en_copyrite.php');?>

</FONT>


</BODY>
</HTML>
