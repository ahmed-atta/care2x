<?
require("../chklang.php");
$notable=1;
require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK) 
	{
		$sql="select * from mahopass";
		if( $ergebnis=mysql_query($sql,$link)) 
		{
			if(mysql_num_rows($ergebnis)) $notable=0;
		}
	}
if (!$notable)
	{
		 header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); 
		 exit;
	}
	else 
	{
		 $usid=uniqid("");
		 include("../include/inc_init_crypt.php"); // initialize crypt
         $ciphersid=$enc_hcemd5->encodeMimeSelfRand($usid);
    }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Initialization</title>
</head>

<body bgcolor=white>
<script>
var r= Math.random() *10;
if(r>5) document.write('<img src="../img/nedr.gif" border=0 width=100 height=138 align="left">');
else document.write('<img src="../img/catr.gif" border=0  align="left">');
</script>
<font size=3 color=maroon>Please click the "Start phpMyAdmin" button to start...</font>
<p>

<p><br>
<form action="../phpmyadmin/index.php3" method=post>
<input type="submit" value="Start phpMyAdmin">
      <input type="hidden" name="s1" value="<?php echo $usid ?>">
      <input type="hidden" name="s2" value="<?php echo $ciphersid ?>">
      <input type="hidden" name="mode" value="FORCE_ENABLE_PHP">
      <input type="hidden" name="lang" value="<?php echo $lang ?>">
      
<input type="button" value="Cancel" onClick="window.location.replace('../blank.htm');">
</form>
</body>
</html>

