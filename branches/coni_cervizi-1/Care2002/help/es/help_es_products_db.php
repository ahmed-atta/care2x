<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
if($x2=="pharma") print "Farmacia - "; else print "Insumos médicos - ";
	switch($src)
	{
	case "input": if($x1=="update") print "Editando la información de un producto";
                          else print "Ingresando un producto nuevo en la base de datos";
					break;
	case "search": print "Buscar un producto";
					break;
	case "mng": print "Administrar productos en la base de datos";
					break;
	case "delete": print "Retirando un producto de la base de datos";
					break;
	}


 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >

	

<?php if($src=="input") : ?>
	<?php if($x1=="") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Cómo ingresar un producto nuevo en el catálogo de pedidos?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>Ingrese toda la información acerca del producto en el campo respectivo.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Deseo seleccionar una fotografía del producto. Cómo lo hago?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>Dé clic en el botón <input type="button" value="Seleccionar..."> en el campo "<span style="background-color:yellow" > archivo de imágenes</span>".<br>
 	<b>Paso 2: </b>Una pequeña ventana aparecerá para seleccionar el archivo. Seleccione el archivo de imágenes de su elección y luego dé clic en "OK".<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Terminé de ingresar toda la información del producto.  Cómo lo guardo?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>Dé clic en el botón <input type="button" value="Salvar">.<br>
</ul>
	<?php endif ?>	
	<?php if($x1=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Cómo ingreso un producto nuevo en la base de datos?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>Dé clic en el botón <input type="button" value="Producto nuevo">.<br>
 	<b>Paso 2: </b>Aparecerá el formulario de pedidos.<br>
 	<b>Paso 3: </b>Escriba la información disponible acerca del producto nuevo.<br>
 	<b>Paso 4: </b>Dé clic en el botón <input type="button" value="Guardar"> para guardar la información.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Deseo hacer cambios al producto que al momento estoy viendo.  Cómo lo hago?</b>
</font>
<ul>       	
 	<b>Paso 1: </b> dé clic al botón <input type="button" value="Actualizar o editar">.<br>
 	<b>Paso 2: </b>La información de producto ingresará automáticamente al formulario de edición.<br>
 	<b>Paso 3: </b>Edite la información.<br>
 	<b>Paso 4: </b> dé clic al botón <input type="button" value="Guardar"> para guardar la información.<br>
</ul>
	
	<?php endif ?>	
	<?php if($x1=="update") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Deseo hacer cambios al producto que al momento estoy viendo.  Cómo lo hago?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>De ser necesario, primero deberá borrar los datos que ya están ingresados.<p>
 	<b>Paso 2: </b>Escriba la nueva información en el campo apropiado.<p>
 	<b>Paso 3: </b>Dé clic en el botón <input type="button" value="Guardar"> para guardar la información nueva.<br>
</ul>
	<?php endif ?>	
<?php endif ?>	

<?php if($src=="search") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Cómo busco un producto?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>Escriba la palabra completa o las primeras letras de la marca del artículo, o el nombre genérico, o el número de pedido, etc. en el campo
				<nobr><span style="background-color:yellow" >" Busque la palabra...: <input type="text" name="s" size=10 maxlength=10> "</span></nobr>.<br>
 	<b>Paso 2: </b> dé clic al botón <input type="button" value="Buscar"> para hallar el artículo.<br>
 	<b>Paso 3: </b>Si la búsqueda halla el artículo que concuerda de manera exacta con la palabra de búsqueda, aparecerá información detallada acerca del artículo.<br>
 	<b>Paso 4: </b>Si la búsqueda halla varios artículos que se parecen a la palabra que busca, aparecerá una lista con los artículos posibles.<br>
</ul>
	<?php if($x1!="multiple") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hay una lista con muchos artículos.  Cómo veo la información de un artículo en particular?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>Dé clic en el botón <img <?php echo createComIcon('../','info3.gif','0') ?>> o en el nombre del artículo.<br>
</ul>
	<?php endif ?>
	<?php if($x1=="multiple") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Deseo ver la lista previa de artículos hallados.  Qué debo hacer?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>Dé clic en el botón <input type="button" value="Ir atrás">.<br>
</ul>
	<?php endif ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Si usted ya no desea ver esa información, dé clic en <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>

<?php endif ?>

<?php if($src=="mng") : ?>
	<?php if(($x3=="1")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Cómo hacer cambios a la información del producto?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>Cambie la información acerca del producto nuevo.<br>
 	<b>Paso 2: </b>Dé clic en el botón <input type="button" value="Guardar"> para guardar la información nueva.<br>
</ul>
	<?php endif ?>

	<?php if($x1=="multiple") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Cómo hago cambios al producto que estoy viendo en este momento?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>Dé clic en el botón <input type="button" value="Actualizar o editar">.<br>
 	<b>Paso 2: </b>La información del producto aparecerá en el formulario para que le pueda hacer los cambios.<br>
 	<b>Paso 3: </b>Edite la información.<br>
 	<b>Paso 4: </b>Dé clic en el botón <input type="button" value="Guardar"> para guardar la información nueva.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Cómo elimino totalmente el producto que estoy viendo?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>Dé clic en el botón <input type="button" value="Eliminar de la base de datos">.<br>
 	<b>Paso 2: </b>Se le preguntará si realmente desea eliminar la información de la base de datos<br>
 	<b>Paso 3: </b>Si usted realmente desea eliminar la información del producto, dé clic en el botón <input type="button" value="Sí, estoy absolutamente seguro. Elimine el producto."><p>
 	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> Este paso no se puede deshacer una vez que eliminó los datos.<br>
</ul>	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
No deseo eliminar el producto. Qué debo hacer?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>Dé clic en "<span style="background-color:yellow" > << No, no deseo eliminar este producto. Lléveme a la ventana anterior </span>".<br>
</ul>	
<?php endif ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Cómo administro un producto en la base de datos?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>Find the product article first. Escriba ya sea la información completa or the first few letters of the article's brand name, or generic name, or order number, etc. in the 
				<nobr><span style="background-color:yellow" >" Search keyword: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> field.<br>
 	<b>Paso 2: </b>Dé clic en el botón <input type="button" value="Buscar"> to find the article.<br>
 	<b>Paso 3: </b>If the search finds the article that exactly matches the search keyword, a detailed information on the article will be displayed.<br>
 	<b>Paso 4: </b>If the search finds several articles that approximate the search keyword, a list of the articles will be displayed.<br>
</ul>
	<?php if(($x1!="multiple")&&($x3=="")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
A list of several articles is listed. How to see the information of a particular article?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>dé clic, ya sea al botón <img <?php echo createComIcon('../','info3.gif','0') ?>> or the article's name.<br>
</ul>
	<?php endif ?>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Si usted decide cerrar esta ventana dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif ?>



<?php if($src=="delete") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to remove the product from the databank. What should I do?</b>
</font>
<ul>       	
 	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> Removal or deletion of the product cannot be undone.<p>
 	<b>Paso 1: </b>If you are sure you want to delete the product, dé clic al botón<input type="button" value="Yes, I'm dead sure. Delete the data">.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I do not want to remove the product's information. What should I do?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>Dé clic al link "<span style="background-color:yellow" > << No, do not delete. Go back </span>".<br>
</ul>	

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Si usted decide cerrar esta ventana dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>

<?php endif ?>	

<?php if($src=="report") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to write a report?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Write your report in the
				<nobr><span style="background-color:yellow" >" Report: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> field.<br>
 	<b>Schritt 2: </b>Type your name in the
				<nobr><span style="background-color:yellow" >" Reporter: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> field.<br>
 	<b>Schritt 3: </b>Enter your personell number in teh
				<nobr><span style="background-color:yellow" >" Personell Nr: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> field.<br>
 	<b>Schritt 4: </b>Dé clic en el botón <input type="button" value="Send"> to send the report.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b><br></font> 
       	
Si usted decide cerrar esta ventana or end dé clic al botón<img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif ?>	

</form>

