<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define("LANG_FILE","specials.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
$breakfile="spediens.php?sid=$sid&lang=$lang";
require("../global_conf/inc_remoteservers_conf.php");

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="javascript">
var cam=new Image();
function show()
{
	cam.src="<?php echo $cam_http_1 ?>cam_001.jpg";
	document.images.pic.src=cam.src;
	cam.src="<?php echo $cam_http_2 ?>cam_002.jpg";
	document.images.pic2.src=cam.src;
	cam.src="<?php echo $cam_http_3 ?>cam_003.jpg";
	document.images.pic3.src=cam.src;
	cam.src="<?php echo $cam_http_4 ?>cam_004.jpg";
	document.images.pic4.src=cam.src;	
	//setTimeout("show()",5000);
}
</script>
</HEAD>
<BODY bgcolor="#000000" marginwidth="0" marginheight="0" topmargin="0" leftmargin="0" onLoad="setInterval('show()',3000)">
	
<form>
<table border=0>
  <tr>
    <td><img src="<?php echo $cam_http_1 ?>cam_001.jpg" border=0 width=320 height=240 name="pic"><br>

<select name="Cam1">
 	<option value="Camera 1"> Camera 1</option>
 	<option value="Camera 2"> Camera 2</option>
 	<option value="Camera 3"> Camera 3</option>
 	<option value="Camera 4"> Camera 4</option>
 </select>
 

</td>
    <td><img src="<?php echo $cam_http_2 ?>cam_002.jpg" border=0 width=320 height=240 name="pic2"><br>
<select name="Cam2">
 	<option value="Camera 1"> Camera 1</option>
 	<option value="Camera 2"> Camera 2</option>
 	<option value="Camera 3"> Camera 3</option>
 	<option value="Camera 4"> Camera 4</option>
 </select>
</td>
  </tr>
  <tr>
    <td><img src="<?php echo $cam_http_3 ?>cam_003.jpg" border=0 width=320 height=240 name="pic3"><br>
<select name="Cam3">
 	<option value="Camera 1"> Camera 1</option>
 	<option value="Camera 2"> Camera 2</option>
 	<option value="Camera 3"> Camera 3</option>
 	<option value="Camera 4"> Camera 4</option>
 </select>
</td>
    <td><img src="<?php echo $cam_http_4 ?>cam_004.jpg" border=0 width=320 height=240 name="pic4"><br>
<select name="Cam4">
 	<option value="Camera 1"> Camera 1</option>
 	<option value="Camera 2"> Camera 2</option>
 	<option value="Camera 3"> Camera 3</option>
 	<option value="Camera 4"> Camera 4</option>
 </select>
</td>
  </tr>
</table>
</form>

<p>
<a href="<?php echo $breakfile ?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0  alt="<?php echo $LDClose ?>" align="middle"></a>


</BODY>
</HTML>
