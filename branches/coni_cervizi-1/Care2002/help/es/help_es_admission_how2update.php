
<p><font size=2 face="verdana,arial" >
<form action="#" >
<b>Para actualizar o cambiar datos</b>
<ul> Si usted desea hacer cambios en la información, dé clic en el botón <input type="button" value="Actualice los datos">.
</ul>
<?php if($src=="search") : ?>
<b>Búsqueda nueva</b>
<ul> Si usted desea hacer una nueva búsqueda, dé clic en el botón <input type="button" value="Volver a la búsqueda">.
</ul>
<?php else : ?>
<b>Para registrar la información de un paciente nuevo</b>
<ul> Si usted desea empezar un registro nuevo, dé clic en el botón <input type="button" value="Volver a la admisión">.
</ul>
<?php endif ?>
<b>Nota</b>
<ul> Si usted desea volver una ventana atrás, dé clic en el botón <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
		
</ul>


</form>

