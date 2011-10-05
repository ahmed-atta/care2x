<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('../include/helpers/inc_environment_global.php');
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once(CARE_BASE .'include/helpers/inc_front_chain_lang.php');
?>

<html>
<HEAD>

<TITLE></TITLE>
<?php require(CARE_BASE .'include/helpers/include_header_css_js.php'); ?>
</head>
<BODY>
	<center>
		<FONT  SIZE=+4 ><b><?php echo $LDLogoutConfirm ?></b></FONT>
		<p>
		<br>
		<FONT  SIZE=5 color=navy>
		<?php echo $nm.'<br>'; ?>
		</FONT>
		<form name="okbut" action="logout.php">
			<div class="buttons" style="width:220px;align:center">
				<input type="hidden"  name="sid" value="<?php echo $sid ?>" >
				<input type="hidden"  name="lang" value="<?php echo $lang ?>" >
				<input type="hidden"  name="logout" value="1" >
				<button type="submit" value="<?php echo $LDYes ?>" class="btn primary"><?php echo $LDYes ?></button>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button type="button" class="btn" value="<?php echo $LDNotReally ?>" onClick="javascript:window.history.back()"><?php echo $LDNotReally ?></button>
			</div>
		</form>
	</center>
</BODY>
</HTML>
