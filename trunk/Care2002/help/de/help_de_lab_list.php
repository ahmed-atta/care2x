<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "Labor - $x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie lasse ich die graphische Kurvendarstellung der Labortestwerte zeigen?</b>
</font>
<ul>      
 	<b>Schritt 1: </b>Klickt den Checkbox <input type="checkbox" name="s" value="s" checked> des Testparameters.<br>
		<b>Schritt 2: </b>Wenn Sie mehrere Testparameter gleichzeitig darstellen lassen m�chten, klickt ihre entsprechende Checkboxen an<br>
		<b>Schritt 3: </b>Klickt das Symbol <img src="../img/chart.gif" width=16 height=17 border=0> um die graphische Kurvendarstellung zu zeigen.<br>
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Ich m�chte alle Parameter f�r die graphische Darstellung ausw�hlen. Gibt es daf�r eine schnelle Methode?</b>
</font>
<ul>      
		<b>Ja!</b><br>
		<b>Schritt 1: </b>Klickt den <img src="../img/dwnArrowGrnLrg.gif" width=16 height=16 border=0 border=0> Knopf an um alle Parameter gleichzeitig auszuw�hlen.<br>
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie kann ich die Auswahl r�cksetzen?</b>
</font>
<ul>      
		<b>Schritt 1: </b>Klickt den <img src="../img/dwnArrowGrnLrg.gif" width=16 height=16 border=0 border=0> Knopf noch einmal.<br>
</ul>
<?php endif ?>
<?php if($src=="graph") : ?>
<img src="../img/frage.gif" border=0 align="absmiddle">
 <font color="#990000"><b>Wie komme ich zur Liste von Labortestwerte ohne graphische Darstellung zur�ck? </b></font>
<ul>Klickt den <img src="../img/de/de_back2.gif" border=0 align="absmiddle"> Knopf an.</ul>
<?php endif ?>

<img src="../img/frage.gif" border=0 align="absmiddle">
 <font color="#990000"><b>Wie schliesse ich den <?php echo $x3 ?>? </b></font>
<ul> Klict den <img src="../img/de/de_close2.gif" border=0 align="absmiddle"> Knopf an.</ul>


</form>

