<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Cómo investigar en los archivos Medocs</b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="select") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Deseo actualizar el documento Medocs mostrado</b></font>
<ul> <b>Paso : </b>Dé clic en el botón <input type="button" value="Actualizar los datos"> para empezar a editar el documento.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Deseo iniciar una nueva investigación en los archivos</b></font>
<ul> <b>Paso : </b>Dé clic en el botón <input type="button" value="Nueva investigación en los archivos"> para empezar una nueva investigación.<br>
</ul>
<?php elseif(($src=="search")&&($x1)) : ?>
<b>Nota</b>
<ul><?php if($x1==1) : ?> Si la búsqueda halla un solo resultado, el documento completo se mostrará inmediatamente.<br>
		Sin embargo, si la búsqueda halla varios resultados, aparecerá un listado.<br>
		<?php endif ?>
		Para ver la información del paciente que está buscando, dé clic, ya sea al botón <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> correspondiente a él, o
		al apellido, al nombre o a la fecha de admisión.
</ul>
<b>Nota</b>
<ul> Si usted desea empezar una nueva investigación, dé clic al botón <input type="button" value="Nueva investigación en los archivos">.
</ul>
<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Deseo ver una lista de los documentos Medocs de un departamento en particular.</b></font>
<ul> <b>Paso 1: </b>Escriba el código del departamento en el campo "Departamento:". <br>
		<b>Paso 2: </b>Deje a todos los demás campos en blanco o vacíos.<br>
		<b>Paso 3: </b>Dé clic en el botón <input type="button" value="Buscar"> para iniciar la búsqueda.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Estoy buscando un documento Medocs en particular, y de un paciente en particular.</b></font>
<ul> <b>Paso 1: </b>Escriba la palabra clave en el campo correspondiente. Puede ser una palabra completa o una frase o unas pocas letras de una palabra de los datos personales del paciente. <br>
		<ul><font size=1 color="#000099" >
		<b>Los siguientes campos pueden llenarse con una palabra clave:</b>
		<br> Número de identificación del paciente
		<br> Apellido
		<br> Nombre
		<br> Fecha de nacimiento
		<br> Dirección
		</font>
		</ul><b>Paso 2: </b>Deje los demás campos en blanco o vacíos.<br>
		<b>Paso 3: </b>Dé clic en el botón <input type="button" value="Buscar"> para iniciar la búsqueda.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Quiero ver una lista de todos los documentos Medocs con una determinada asegurdora</b></font>
<ul> <b>Paso 1: </b>Escriba el acrónimo de la empresa aseguradora en el campo "Seguro:". <br>
		<b>Paso 2: </b>Deje los demás campos en blanco o vacíos.<br>
		<b>Paso 3: </b>Dé clic en el botón <input type="button" value="Buscar"> para iniciar la búsqueda.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Quiero ver una lista de todos los documentos Medocs con una determinada información adicional acerca de la aseguradora</b></font>
<ul> <b>Paso 1: </b>Enter the keyword in the field "Extra information:". <br>
		<b>Paso 2: </b>Deje los demás campos en blanco o vacíos.<br>
		<b>Paso 3: </b>Dé clic en el botón <input type="button" value="Buscar"> para iniciar la búsqueda.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Quiero ver una lista de todos los pacientes MASCULINOS entre los documentos Medocs</b></font>
<ul> <b>Paso 1: </b>Dé clic al radio button "<span style="background-color:yellow" >Género <input type="radio" name="r" value="1">Masculino</span>". <br>
		<b>Paso 2: </b>Deje los demás campos en blanco o vacíos.<br>
		<b>Paso 3: </b>Dé clic en el botón <input type="button" value="Buscar"> para iniciar la búsqueda.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Quiero ver una lista de todos los pacientes FEMENINOS entre los documentos Medocs</b></font>
<ul> <b>Paso 1: </b>Dé clic al radio button "<span style="background-color:yellow" ><input type="radio" name="r" value="1">Femenino</span>". <br>
		<b>Paso 2: </b>Deje los demás campos en blanco o vacíos.<br>
		<b>Paso 3: </b>Dé clic en el botón <input type="button" value="Buscar"> para iniciar la búsqueda.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Quiero ver una lista de todos los pacientes que han recibido consejo médico obligatorio entre los documentos Medocs</b></font>
<ul> <b>Paso 1: </b>Dé clic al radio button "<span style="background-color:yellow" >Consejo médico: <input type="radio" name="r" value="1">Sí</span>". <br>
		<b>Paso 2: </b>Deje los demás campos en blanco o vacíos.<br>
		<b>Paso 3: </b>Dé clic en el botón <input type="button" value="Buscar"> para iniciar la búsqueda.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Quiero ver una lista de todos los pacientes que NO han recibido consejo médico obligatorio entre los documentos Medocs</b></font>
<ul> <b>Paso 1: </b>Dé clic en el botón "<span style="background-color:yellow" ><input type="radio" name="r" value="1">No</span>". <br>
		<b>Paso 2: </b>Deje los demás campos en blanco o vacíos.<br>
		<b>Paso 3: </b>Dé clic en el botón <input type="button" value="Buscar"> para iniciar la búsqueda.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Quiero ver una lista de todos los documentos Medocs con una determinada palabra clave</b></font>
<ul> <b>Paso 1: </b>Escriba la palabra clave en el campo correspondiente. Puede ser una palabra completa o una frase o unas pocas letras de una palabra. <br>
		<ul><font size=1 color="#000099" >
		<b>Ejemplo:</b> Para una palabra clave diagnóstica, escríbala en el campo "Diagnóstico".<br>
		<b>Ejemplo:</b> Para una palabra clave terapéutica, escríbala en el campo "Terapia recomendada".<br>
		</font>
		</ul><b>Paso 2: </b>Deje los demás campos en blanco o vacíos.<br>
		<b>Paso 3: </b>Dé clic en el botón <input type="button" value="Buscar"> para iniciar la búsqueda.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Quiero ver una lista de todos los documentos Medocs escritos en una fecha determinada</b></font>
<ul> <b>Paso 1: </b>Escriba la fecha del documento en el campo "Documentado el día:". <br>
		<ul><font size=1 color="#000099">
		<b>Tip:</b> Escriba "H" o "h" para registrar automáticamente el día de hoy.<br>
		<b>Tip:</b> Escriba "A" o "a" para registrar automáticamente el día de ayer.<br>
		</font>
		</ul><b>Paso 2: </b>Deje los demás campos en blanco o vacíos.<br>
		<b>Paso 3: </b>Dé clic en el botón <input type="button" value="Buscar"> para iniciar la búsqueda.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Quiero ver una lista de todos los documentos Medocs escritos por alguien en particular</b></font>
<ul> <b>Paso 1: </b>Escriba el nombre completo o las primeras letras del nombre de la persona en el campo "Documentado por:". <br>
		<b>Paso 2: </b>Deje los demás campos en blanco o vacíos.<br>
		<b>Paso 3: </b>Dé clic en el botón <input type="button" value="Buscar"> para iniciar la búsqueda.<br>
</ul>
<b>Nota</b>
<ul> Puede combinar varias condiciones de búsqueda. Por ejemplo: Si usted quiere ver una lista de todos los pacientes masculinos que fueron operados en
		cirugía plástica, que han recibido el consejo médico obligatorio, y que han recibido terapia cuyo nombre empieza con "lipo":<p>
		<b>Paso 1: </b>Escriba "plop" en el campo "Departamento:". <br>
		<b>Paso 2: </b>Dé clic en el botón "<span style="background-color:yellow" >Género<input type="radio" name="r" value="1">masculino</span>".<br>
		<b>Paso 3: </b>Dé clic en el botón "<span style="background-color:yellow" >Consejo médico:<input type="radio" name="r" value="1">Sí</span>".<br>
		<b>Paso 4: </b>Escriba "lipo" en el campo "Terapia:". <br>
		<b>Paso 5: </b>Dé clic en el botón <input type="button" value="Buscar"> para iniciar la búsqueda.<br>
</ul>
<b>Nota</b>
<ul> Si la búsqueda halla un solo resultado, el documento completo se mostrará inmediatamente.<br>
		Sin embargo, si la búsqueda halla varios resultados, aparecerá un listado.<br>
		Para abrir el documento del paciente que busca, dé clic, ya sea al botón <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> correspondiente, o
		al apellido, al nombre o a la fecha de admisión.
</ul>

<?php endif ?>
<b>Nota</b>
<ul> Si decide cancelar la investigación, dé clic al botón <input type="button" value="Cerrar">.
</ul>
</form>

