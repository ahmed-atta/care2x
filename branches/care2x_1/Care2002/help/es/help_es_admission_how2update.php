
<p><font size=2 face="verdana,arial" >
<form action="#" >
<b>Para actualizar o cambiar datos</b>
<ul> Si usted desea hacer cambios en la informaci�n, d� clic en el bot�n <input type="button" value="Actualice los datos">.
</ul>
<?php if($src=="search") : ?>
<b>B�squeda nueva</b>
<ul> Si usted desea hacer una nueva b�squeda, d� clic en el bot�n <input type="button" value="Volver a la b�squeda">.
</ul>
<?php else : ?>
<b>Para registrar la informaci�n de un paciente nuevo</b>
<ul> Si usted desea empezar un registro nuevo, d� clic en el bot�n <input type="button" value="Volver a la admisi�n">.
</ul>
<?php endif ?>
<b>Nota</b>
<ul> Si usted desea volver una ventana atr�s, d� clic en el bot�n <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
		
</ul>


</form>

