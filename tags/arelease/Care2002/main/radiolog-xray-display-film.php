<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_radio.php");
require("../global_conf/remoteservers_conf.php");
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">


</HEAD>

<BODY bgcolor=black onLoad="if (window.focus) window.focus()" marginwidth=0 leftmargin=0 topmargin=0 marginheight=0>

<center >
<? if($mode=="preview") : ?>
<img src="<? if($disc_pix_mode) print $xray_film_localpath; else print $xray_film_server_http; ?>thorax.jpg" width=150">
<? else : ?>

<script language="javascript">
<!-- Script Begin
document.write('<img src="<? if($disc_pix_mode) print $xray_film_localpath; else print $xray_film_server_http; ?>thorax.jpg" width="'+(screen.availWidth*0.83)+'">');
//  Script End -->
</script>

<?endif ?>
<br>

<p>
<form>
<? if($mode!="preview") : ?>
<input type="button" value="<?=$LDClose ?>" onClick="window.top.location.replace('radiolog-xray-javastart.php?sid=<?="$ck_sid&lang=$lang" ?>')">
<? endif ?>
</form>
</center>
<p>






</BODY>
</HTML>
