<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>¿Cómo documentar un paciente en medocs?</b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if($src=="?") : ?>
<b>Paso 1</b>

<ul> Halle los datos básicos del paciente.<br>
		Escriba en el campo "Documentar este paciente:" cualquiera de los siguientes datos:<br>
		<Ul type="disc">
			<li>número del paciente o<br>
			<li>apellido o<br>
			<li>nombre del paciente<br>
		<font size=1 color="#000099" face="verdana,arial">
		<b>Tip:</b> Si su sistema está equipado con un escáner de códigos de barras, dé clic en el campo "Documentar este paciente:" para enfocarlo
		y escanear el código de barras en la tarjeta del paciente con el escáner.  Sáltese el paso 2.
		</font>
		</ul>
		
</ul>
<b>Paso 2</b>

<ul> Dé clic en el botón <input type="button" value="Buscar"> para iniciar la búsqueda.
		
</ul>
<b>Alternativa al paso 2</b>
<ul> Usted puede hacer cualquiera de lo siguiente:<br>
		<Ul type="disc">		
		<li>escribir el apellido del paciente en el campo "Apellido:" <br>
		<li>o escribir el nombre del paciente en el campo "Nombre:" <br>
		</ul>
		 luego dé clic en la tecla "Enter" del teclado.
		
</ul>
<b>Paso 3</b>
<ul> Si la búsqueda halla un solo resultado, aparecerá un nuevo formulario con los datos básicos del paciente.
		Por el contrario, si la búsqueda halla varios resultados, aparecerá una lista con los resultados.
<?php endif ?>

<?php if(($src=="?")||($x1>1)) : ?>

 <br>Para documentar un paciente de la lista,
		dé clic ya sea en el botón <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> correspondiente a él, o
		el apellido, nombre o el número de identificación del paciente, o la fecha de admisión.
</ul>
<?php endif ?>

<?php if($src=="?") : ?>
<b>Paso 4</b>
<?php endif ?>

<?php if(($src!="?")&&($x1==1)) : ?>
<b>Paso 1</b>
<?php endif ?>
<?php if(($x1=="1")||($src=="?")) : ?>
<ul> Una vez abierto el formulario con los datos del paciente, usted puede: 
		<Ul type="disc">		
    	<li>escribir información adicional en el asegurador o seguro en el campo "Información adicional",<br>
		<li>dé clic en "<span style="background-color:yellow" ><input type="radio" name="n" value="a">Sí</span>" en los botones de "Consejo médico" si el paciente recibió el consejo médico obligatorio,<br>
		<li>dé clic en "<span style="background-color:yellow" ><input type="radio" name="n" value="a">No</span>" en los botones de "Consejo médico" si el paciente no recibió el consejo médico obligatorio,<br>
		<li>escriba el reporte diagnóstico en el campo "Diagnóstico:" ,<br>
		<li>escriba el reporte terapéutico en el campo "Terapia:" ,<br>
		<li>de ser necesario, cambie la fecha en el campo "Documentado el día:" ,<br>
		<li>de ser necesario, cambie el nombre en el campo "Documentado por:" ,<br>
		<li>de ser necesario, escriba un número clave en el campo "número clave:" ,<br>
		</ul>
</ul>
<b>Nota</b>
<ul> Si usted decide borrar lo que haya escrito, dé clic en el botón <input type="button" value="Resetear">.
</ul>

<b>Paso <?php if($src!="?") print "2"; else print "5"; ?></b>
<ul> Dé clic en el botón <input type="button" value="Guardar"> para guardar el documento.
</ul>
<?php endif ?>
<b>Nota</b>
<ul> Si usted decide cerrar el documento sin guardar los cambios, dé clic en el botón <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
		
</ul>


</form>

