<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, elpidio@care2x.net
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');

switch($dbtype){
	case 'mysql':
		$sPrompt = $LDMySQLManage;
		$sAction = $root_path.'modules/phpmyadmin/index.php';
		break;
	case 'postgre':
	case 'postgres7':
		$sPrompt = eregi_replace('mysql','Pg',$LDMySQLManage);
		$sAction = $root_path.'modules/phppgadmin/index.php';
		break;
}
?>
<?php html_rtl($lang); ?>
	<head>
		<?php echo setCharSet(); ?>
		<title></title>
		<?php require($root_path.'include/inc_css_a_hilitebu.php'); ?>
	</head>
	<body>
	   &nbsp;      
	   <p></p>
		<font class="prompt">
		<center>
		<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"><b><?php echo $sPrompt ?></b><p>
		<form action="<?php echo $sAction; ?>" method="post">
			<input type="hidden" name="lang" value="<?php echo $lang ?>">
			<input type="hidden" name="sid" value="<?php echo $sid; ?>">
			<input type="submit" value="<?php echo $LDContinue ?>">
		</form><p> 
		<form action="edv.php" method="post">
			<input type="hidden" name="lang" value="<?php echo $lang ?>">
			<input type="hidden" name="sid" value="<?php echo $sid; ?>">
			<input type="hidden" name="target" value="sqldb">
			<input type="submit" value="<?php echo $LDCancel ?>">
		</form>
		</font>
	</body>
</html>
