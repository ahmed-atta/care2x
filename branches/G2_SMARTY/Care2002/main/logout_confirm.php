<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
?>

<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE></TITLE>
<script language="javascript">

</script>

</head>


<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LINK="#0000FF" VLINK="#800080">
<center>
<FONT  FACE="Arial" SIZE=+4 ><b><?php echo $LDLogoutConfirm ?></b></FONT>
<p>
<br><FONT  FACE="Arial" SIZE=5 color=navy>
<?php echo $nm.'<br>'; ?>

<form name="okbut" action="logout.php">

<input type="hidden"  name="sid" value="<?php echo $sid ?>" >
<input type="hidden"  name="lang" value="<?php echo $lang ?>" >
<input type="hidden"  name="logout" value="1" >
<input type="submit" value=" <?php echo $LDYes ?> " >
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value="<?php echo $LDNotReally ?>" onClick="javascript:window.history.back()">
</form>



</center>

</BODY>
</HTML>
