<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>¿Cómo busco dentro de un documento Medocs?</b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if(($src=="?")||($x1=="0")) : ?>
<b>Paso 1</b>

<ul> Escriba en el campo "<span style="background-color:yellow" >Documento Medocs de:</span>" ya sea la información completa o unas pocas letras de información del paciente, como por ejemplo el número del paciente, el apellido o el nombre.
		<p>Ejemplo 1: escriba "21000012" o "12".
		<br>Ejemplo 2: escriba "Guerero" o "gue".
		<br>Ejemplo 3: escriba "Alfredo" o "Alf".
		
</ul>
<b>Paso 2</b>
<ul> Dé clic en el botón <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  para empezar la búsqueda.<p>
</ul>
<b>Paso 3</b>
<ul> Si la búsqueda halla un único resultado, aparecerá el documento Medocs por completo.
		Si, por el contrario, la búsqueda halla varios resultados, se mostrará un listado.<p>
		Para ver el documento medocs del paciente que busca, dé clic en el botón <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> correspondiente a él, o
		el apellido, el número de documento, la hora, etc.
</ul>
<?php endif ?>
<?php if($x1>1) : ?>
		Para ver el documento medocs del paciente que busca, dé clic en el botón <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> correspondiente a él, o
		el apellido, el número de documento, la hora, etc.<p>
<?php endif ?>
<?php if(($src!="?")&&($x1=="1")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Deseo actualizar el documento</b></font>
<ul> Si usted desea actualizar el documento mostrado, dé clic en el botón <input type="button" value="Actualice los datos">.
</ul>
<?php endif ?>
<b>Nota</b>
<ul> Si usted decide cancelar la búsqueda, dé clic en el botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>


</form>

