<?php
#------begin------ This protection code was suggested by Luki R. luki@karet.org
if (stristr($PHP_SELF,'inc_mozillapatch_redirect_supplier.php')) die('<meta http-equiv="refresh" content="0; url=../">');
#------end-----
?>
<html>
<head>

<title></title>
</head>
<body>

<table border=0>
  <tr>
    

	<td colspan=4><center>
	<font face=arial color="#990000" size=4>
	<?php 
		echo "<a href=\"select-supplier.php".URL_REDIRECT_APPEND."&cat=$cat&target=supply&retpath=$retpath\">$LDClickSelectSupplier</a>";
	?>
	</center>
</td>

  </tr>
</table>
</body>
</html>
