<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
require_once($root_path.'include/core/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
 <TITLE>Varování neplatného pøístupu</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Neautorizovaný pøístup ke stránce</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>Nemáte platná èi dostateèná pøístupová práva na otevøení tohoto dokumentu!</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
Pravdìpodobné pøíèiny tohoto problému:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Pravdìpodobì jste pou¾il(a) tlaèítka "Zpìt / Back" nebo  "Vpøed / Forward"  Va¹eho prohlí¾eèe. Prosím vyvarujte se jejich pou¾ívání.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Vá¹ prohlí¾eè neakceptuje "cookie", které jsou nezbytné pro správnou funkci programu. Prosím zmìòte nastavení Va¹eho prohlí¾eèe.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Máte zakázán pøíjem "cookie". Prosím zmìòte nastavení V¹eho prohlí¾eèe.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Vá¹ prohlí¾eè není schopen spou¹tìt javascripty nebo je jejich spou¹tìní zakázáno. Prosím povolte spou¹tìní javascriptù.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Obèas se mù¾e jednat o chybu pøenosu dat ze serveru. Jednodu¹e stisknìte tlaèítko  "Obnovit / Reload".
<p>
</FONT>
<p>
</ul>
</td>
</tr>
</table>
<p>

<?php
$root_path='../../';
require('cs-iso_copyrite.php');
?>
</FONT>


</BODY>
</HTML>
