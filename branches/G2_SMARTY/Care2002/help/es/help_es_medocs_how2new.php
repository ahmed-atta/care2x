<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>�C�mo documentar un paciente en medocs?</b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if($src=="?") : ?>
<b>Paso 1</b>

<ul> Halle los datos b�sicos del paciente.<br>
		Escriba en el campo "Documentar este paciente:" cualquiera de los siguientes datos:<br>
		<Ul type="disc">
			<li>n�mero del paciente o<br>
			<li>apellido o<br>
			<li>nombre del paciente<br>
		<font size=1 color="#000099" face="verdana,arial">
		<b>Tip:</b> Si su sistema est� equipado con un esc�ner de c�digos de barras, d� clic en el campo "Documentar este paciente:" para enfocarlo
		y escanear el c�digo de barras en la tarjeta del paciente con el esc�ner.  S�ltese el paso 2.
		</font>
		</ul>
		
</ul>
<b>Paso 2</b>

<ul> D� clic en el bot�n <input type="button" value="Buscar"> para iniciar la b�squeda.
		
</ul>
<b>Alternativa al paso 2</b>
<ul> Usted puede hacer cualquiera de lo siguiente:<br>
		<Ul type="disc">		
		<li>escribir el apellido del paciente en el campo "Apellido:" <br>
		<li>o escribir el nombre del paciente en el campo "Nombre:" <br>
		</ul>
		 luego d� clic en la tecla "Enter" del teclado.
		
</ul>
<b>Paso 3</b>
<ul> Si la b�squeda halla un solo resultado, aparecer� un nuevo formulario con los datos b�sicos del paciente.
		Por el contrario, si la b�squeda halla varios resultados, aparecer� una lista con los resultados.
<?php endif ?>

<?php if(($src=="?")||($x1>1)) : ?>

 <br>Para documentar un paciente de la lista,
		d� clic ya sea en el bot�n <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> correspondiente a �l, o
		el apellido, nombre o el n�mero de identificaci�n del paciente, o la fecha de admisi�n.
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
    	<li>escribir informaci�n adicional en el asegurador o seguro en el campo "Informaci�n adicional",<br>
		<li>d� clic en "<span style="background-color:yellow" ><input type="radio" name="n" value="a">S�</span>" en los botones de "Consejo m�dico" si el paciente recibi� el consejo m�dico obligatorio,<br>
		<li>d� clic en "<span style="background-color:yellow" ><input type="radio" name="n" value="a">No</span>" en los botones de "Consejo m�dico" si el paciente no recibi� el consejo m�dico obligatorio,<br>
		<li>escriba el reporte diagn�stico en el campo "Diagn�stico:" ,<br>
		<li>escriba el reporte terap�utico en el campo "Terapia:" ,<br>
		<li>de ser necesario, cambie la fecha en el campo "Documentado el d�a:" ,<br>
		<li>de ser necesario, cambie el nombre en el campo "Documentado por:" ,<br>
		<li>de ser necesario, escriba un n�mero clave en el campo "n�mero clave:" ,<br>
		</ul>
</ul>
<b>Nota</b>
<ul> Si usted decide borrar lo que haya escrito, d� clic en el bot�n <input type="button" value="Resetear">.
</ul>

<b>Paso <?php if($src!="?") print "2"; else print "5"; ?></b>
<ul> D� clic en el bot�n <input type="button" value="Guardar"> para guardar el documento.
</ul>
<?php endif ?>
<b>Nota</b>
<ul> Si usted decide cerrar el documento sin guardar los cambios, d� clic en el bot�n <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
		
</ul>


</form>

