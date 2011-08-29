<?php 
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('../helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','help.php');
define('NO_CHAIN',1);
require_once('../helpers/inc_front_chain_lang.php');
?>
<?php html_rtl($lang); ?>

<head>
<?php echo setCharSet(); ?>
<title></title>

</head>
<body onLoad="if (window.focus) window.focus()">

<?php 
# Resolve the help file to include
if($helpidx=='') {
	if(file_exists('../help/'.$lang.'/help_'.$lang.'_main.php')){
		include('../help/'.$lang.'/help_'.$lang.'_main.php');
	}else{
		include('../help/en/help_en_main.php');
	}  
}else{
	if(file_exists('../help/'.$lang.'/help_'.$lang.'_'.$helpidx)){
		include('../help/'.$lang.'/help_'.$lang.'_'.$helpidx);
	}else{
	     if(file_exists('../help/en/help_en_'.$helpidx)) include('../help/en/help_en_'.$helpidx);
             else include('../help/en/help_en_main.php');  
	}
}
?>
<hr>
<div class="buttons" style="float: right;">
<a href="javascript:window.parent.close()" class="btn"><img <?php echo createComIcon(CARE_GUI ,'cross.png','0') ?> alt="<?php echo $LDCloseHelpWin ?>"></a>
</div>
</body>
</html>
