<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Radiolog�a Rayos X - 
<?php

if($src=="search")
{
	print "Buscar un paciente";	
}

 ?>
 </b>
 </font>
<p><font size=2 face="verdana,arial" >
<form action="#" >

<?php if($src=="search") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
C�mo buscar un paciente?</b>
</font>
	
	<ul>       	
 	<b>Paso 1: </b>Ingrese la palabra completa o las primeras letras del apellido del paciente o el n�mero del paciente, 
	o el nombre del paciente en el campo. <br>
 	<b>Paso 2: </b>D� clic en el bot�n <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> para que el computador inicie la b�squeda del paciente.<p> 
<ul>       	
 	<b>Nota: </b>Si la b�squeda entrega un resultado, se mostrar� una lista. <p>
	</ul>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
C�mo puedo previsualizar una radiograf�a del paciente y su diagn�stico?</b>
</font>
	
	<ul>       	
 	<b>Paso 1: </b>D� clic en el hiperv�nculo o en el bot�n "<span style="background-color:yellow" > <font color="#0000cc">Previsualizar/Diagn�stico</font> <input type="radio" name="d" value="a"> </span>".<br>
	Aparecer� una miniatura de la radiograf�a en el marco inferior izquierda.<br> 
	El diagn�stico aparecer� en el marco inferior derecho.<br> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
C�mo puedo ver toda la radiograf�a del paciente?</b>
</font>
	<ul>       	
 	<b>Paso 1: </b>D� clic en el bot�n <img <?php echo createComIcon('../','torso.gif','0') ?>> del paciente respectivo para pasar a la modalidad de pantalla completa.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Si desea pasar a la ventana anterior, d� clic en el bot�n <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif ?>


</form>

