<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require_once($root_path.'include/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE>Waarschuwing voor ongeldige toegangspoging</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Onbevoegde toegangspoging tot pagina</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>U heeft geen toegansrechten tot dit document!</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
Mogelijke oorzaken van dit probleem:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
U heeft mogelijk de "Vorige pagina" en "Volgende pagine" functie van uw browser gebruikt. Vermijdt het gebruik van deze buttons.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
U heeft mogelijk een cookie geweigerd. Het goed functioneren van het programma  is afhankelijk van cookies . Accepteer daarom a.u.b. de cookies.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
U browser accepteert mogelijk geen cookies. Configureer uw browser zo dat cookies van deze website automatisch geaccepteerd worden.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Uw browser kan mogelijk geen javascript uitvoeren of javascript is uitgeschakeld. Sta a.u.b. het uitvoeren van javascript  door uw browser toe.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Soms is er sprake van een fout in het datatransport. U kunt dit,  door te klikken op de "Opnieuw laden" button van uw browser, corrigeren.
<p>
</FONT>
<p>
</ul>
</td>
</tr>
</table>        
<p>

<?php
require($root_path.'include/inc_load_copyrite.php'); 
?>
</FONT>


</BODY>
</HTML>
