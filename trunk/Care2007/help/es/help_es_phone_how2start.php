<font face="Verdana, Arial" size=3 color="#0000cc">
<b>緾贸mo 
<?php
switch($x1)
{
 	case "search": print 'buscar un n煤mero telef贸nico?'; break;
	case "dir": print 'abro todo el directorio telef贸nico?';break;
	case "newphone": print 'escribo la informaci贸n para un tel茅fono nuevo?';break;
 }
 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
  <?php if($x1=="search") : ?>
  <?php if($src=="newphone") : ?>
  <b><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Paso 1</font></b> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> D茅 clic en el bot贸n <img <?php echo createLDImgSrc('../','such-gray.gif','0') ?>>. 
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php endif ?>
  <b>Paso 
  <?php if($src=="newphone") print "2"; else print "1"; ?>
  </b> 
  </font><font face="Verdana, Arial, Helvetica, sans-serif"><ul><font size="2">
    Escriba en el campo "<span style="background-color:yellow" >Escriba su palabra 
    de b煤squeda.</span>" ya sea informaci贸n completa o unas pocas letras, como 
    por ejemplo, el c贸digo del pabell贸n o departamento, un apellido o un nombre, 
    o un n煤mero de habitaci贸n. <br>
    <font color="#000066">Ejemplo 1: escriba "m9a" o "M9A" o "M9". <br>
    Ejemplo 2: escriba "Guerero" o "gue". <br>
    Ejemplo 3: escriba "Alfredo" o "Alf". <br>
    Ejemplo 4: escriba "op11" o "OP11" o "op"</font>. </font>
  </ul>
  <font size="2"><b>Paso 
  <?php if($src=="newphone") print "3"; else print "2"; ?>
  </b> </font></font>
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> d茅 clic al bot贸n 
    <input type="button" value="BUSCAR">
    para iniciar la b煤squeda.</font>
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 
  <?php if($src=="newphone") print "4"; else print "3"; ?>
  </b> </font>
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si la b煤squeda halla resultado(s), 
    aparecer谩 una lista.</font>
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php endif ?>
  <?php if($x1=="dir") : ?>
  <b>Paso 1</b> 
  </font><font face="Verdana, Arial, Helvetica, sans-serif"><ul><font size="2">
    d茅 clic al bot贸n <img <?php echo createLDImgSrc('../','phonedir-gray.gif','0') ?>>. 
  </font></ul>
  <font size="2"><?php endif ?>
  <?php if($x1=="newphone") : ?>
  <?php if($src=="search") : ?>
  <b>Paso 1</b> 
  <ul>
    d茅 clic al bot贸n <img <?php echo createLDImgSrc('../','newdata-gray.gif','0') ?>>. 
  </ul>
  <b>Paso 2</b> </font></font>
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted ingres贸 su nombre 
    y contrase帽a y tiene permiso para ver esta informaci贸n, el formulario de ingreso 
    para la nueva informaci贸n telef贸nica aparecer谩 en el marco principal.<br>
    De otro modo, si usted no ha ingresado, se le pedir谩 que escriba su nombre 
    y contrase帽a. </font>
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
      <?php endif ?>
      Escriba su nombre y contrase帽a y d茅 clic en el bot贸n <img <?php echo createLDImgSrc('../','continue.gif','0') ?>>.</font>
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php endif ?>
  <b>Nota</b> </font>
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted desea cerrar 
    esta ventana del directorio, d茅 clic en el bot贸n 
    <input type="button" value="Cancelar">
    </font> 
  </ul>


</form>

