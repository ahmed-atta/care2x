<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','registration_admission');
define('LANG_FILE_MODULAR','registration_admission.php');
$local_user='aufnahme_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);
$breakfile='patient.php';
$admissionfile='admission_start.php'.URL_APPEND;

if((!isset($pid)||!$pid)&&$HTPP_SESSION_VARS['sess_pid']) $pid=$HTPP_SESSION_VARS['sess_pid'];

$_SESSION['sess_path_referer']=$top_dir.$thisfile;
$_SESSION['sess_file_return']=$thisfile;
$_SESSION['sess_pid']=$pid;
//$_SESSION['sess_full_pid']=$pid+$GLOBAL_CONFIG['person_id_nr_adder'];
$_SESSION['sess_parent_mod']='registration';
$_SESSION['sess_user_origin']='registration';
# Reset the encounter number
$_SESSION['sess_en']=0;

# Load the standard tags functions
require('./gui_bridge/default/gui_std_tags.php');

######## here starts the GUI ############

echo StdHeader();

?>
 <TITLE><?php echo $LDPatientRegister ?></TITLE>

<?php

require($root_path.'include/helpers/include_header_css_js.php');
?>
</HEAD>

<BODY bgcolor="<?php echo $cfg['bot_bgcolor'];?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if (window.focus) window.focus();"
>

<table width=100% border=0 cellspacing="0"  cellpadding=0 >
<tr>
<td >
<FONT    SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo $LDPatientRegister ?></STRONG> <font size=+2>(<?php echo ($pid) ?>)</font></FONT>
</td>

<td  align="right">
<a href="javascript:gethelp('person_details.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  </a><a
href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   </a>
</td>
</tr>

<tr>
<td colspan=3   bgcolor="<?php echo $cfg['body_bgcolor']; ?>">
<ul>

<?php

	# Display the data

	require_once($root_path.'modules/registration_admission/model/class_gui_person_show.php');
	$person = & new GuiPersonShow;
	$person->setPID($pid);
	$person->display();

?>
</ul>

</FONT>
<p>
</td>
</tr>
</table>

<p>
<ul>

<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"></a>
</ul>
</FONT>
<?php
StdFooter();
?>
