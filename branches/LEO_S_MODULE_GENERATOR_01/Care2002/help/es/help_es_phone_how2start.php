<font face="Verdana, Arial" size=3 color="#0000cc">
<b>�C�mo 
<?php
switch($x1)
{
 	case "search": print 'buscar un n�mero telef�nico?'; break;
	case "dir": print 'abro todo el directorio telef�nico?';break;
	case "newphone": print 'escribo la informaci�n para un tel�fono nuevo?';break;
 }
 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if($x1=="search") : ?>
	<?php if($src=="newphone") : ?>
	<b>Paso 1</b>
	<ul> D� clic en el bot�n <img <?php echo createLDImgSrc('../','such-gray.gif','0') ?>>.
	</ul>
	<?php endif ?>
<b>Paso <?php if($src=="newphone") print "2"; else print "1"; ?></b>

<ul> Escriba en el campo "<span style="background-color:yellow" >Escriba su palabra de b�squeda.</span>" ya sea informaci�n completa o unas pocas letras, como por ejemplo, el c�digo del pabell�n o departamento, un apellido o un nombre,
		o un n�mero de habitaci�n.
		<br>Ejemplo 1: escriba "m9a" o "M9A" o "M9".
		<br>Ejemplo 2: escriba "Guerero" o "gue".
		<br>Ejemplo 3: escriba "Alfredo" o "Alf".
		<br>Ejemplo 4: escriba "op11" o "OP11" o "op".
		
</ul>
<b>Paso <?php if($src=="newphone") print "3"; else print "2"; ?></b>
<ul> d� clic al bot�n <input type="button" value="BUSCAR"> para iniciar la b�squeda.<p>
</ul>
<b>Paso <?php if($src=="newphone") print "4"; else print "3"; ?></b>
<ul> Si la b�squeda halla resultado(s), aparecer� una lista.<p>
</ul>
<?php endif ?>
<?php if($x1=="dir") : ?>
<b>Paso 1</b>
<ul> d� clic al bot�n <img <?php echo createLDImgSrc('../','phonedir-gray.gif','0') ?>>.
</ul>
<?php endif ?>
<?php if($x1=="newphone") : ?>
	<?php if($src=="search") : ?>
<b>Paso 1</b>
<ul> d� clic al bot�n <img <?php echo createLDImgSrc('../','newdata-gray.gif','0') ?>>.
</ul>
<b>Paso 2</b>
<ul> Si usted ingres� su nombre y contrase�a y tiene permiso para ver esta informaci�n, el formulario de ingreso para la nueva informaci�n telef�nica 
		aparecer� en el marco principal.<br>
		De otro modo, si usted no ha ingresado, se le pedir� que escriba su nombre y contrase�a. <p>
	<?php endif ?>
		Escriba su nombre y contrase�a y d� clic en el bot�n <img <?php echo createLDImgSrc('../','continue.gif','0') ?>>.<p>
		
</ul><?php endif ?>

<b>Nota</b>
<ul> Si usted desea cerrar esta ventana
<?php
switch($x1)
{
 	case "search": print 'de b�squeda, d� clic en el bot�n<img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.'; break;
	case "dir": print ' del directorio, d� clic en el bot�n <input type="button" value="Cancelar">.';break;
	case "newphone": print ' d� clic en el bot�n <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.';break;
 }
 ?>
</ul>


</form>

