<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "Datos del paciente - $x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>¿Qué significan estas <img <?php echo createComIcon('../','colorcodebar3.gif','0') ?> > barras de colores? </b></font>
<ul> <b>Nota: </b>Cada una de estas barras de color, cuando se dejan "levantadas", representan cambios a un documento en particular, una instrucción, un cambio, una consulta, etc.<br>
			El significado de un color puede establecerse para cada pabellón. <br>
			La serie de barras de color rosa a la derecha representan el tiempo aproximado en que una instrucción se deberá llevar a cabo.<br>
			Por ejemplo: la sexta barra de color rosa significa la "6ta hora" o "6 en punto de la mañana", la barra 22 significa las "22 horas" o las "10 en punto de la noche".
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
¿Qué son los siguientes botones?</b></font>
<ul> <input type="button" value="Tabla gráfica de fiebre">
	<ul>
		Esto abrirá la tabla gráfica con la temperatura diaria del paciente. Usted puede escribir, editar o eliminar los datos de fiebre y tensión arterial en la tabla.<br>
		Otros datos que se pueden editar son:
	<ul type="disc">
	<li>Alergias<br>
	<li>Plan de dieta alimentaria diaria<br>
	<li>Diagnóstico principal y terapia<br>
	<li>Diagnóstico diario y terapia<br>
	<li>Apuntes, diagnósticos adicionales<br>
	<li>Terapia física (PT), Atg (Gimnasia anti-trombosis), etc.<br>
	<li>Anticoagulantes<br>
	<li>Documentación diaria para los anticoagulantes<br>
	<li>Medicación intravenosa y cambio de vendajes<br>
	<li>Documentación diaria para la medicación intravenosa<br>
	<li>Apuntes<br>
	<li>Listado de medicación (listado)<br>
	<li>Documentación diaria para la medicación y dosis<br>
	</ul>		
	</ul>
<input type="button" value="Reporte de enfermería">
	<ul>
		Esto abrirá el formulario de reporte de enfermería. Usted puede documentar su actividad de enfermería, su efectividad, observaciones, consultas, o recomendaciones, etc.
	</ul>
	<input type="button" value="Directivas del médico">
	<ul>
	El médico a cargo ingresará aquí sus instrucciones, medicación, dosis, respuestas a las consultas de la enfermera o instrucciones para cambios, etc.
	</ul>	
	<input type="button" value="Reportes diagnósticos">
	<ul>
	Esto almacena los reportes diagnósticos provenientes de las diferentes áreas clínicas o departamentos diagnósticos.
	</ul>	
	<input type="button" value="Datos fuente">
	<ul>
	Esto almacena los datos fuente de los pacientes e información personal tales como nombre, apellido, etc. Esta también es la documentación inicial de la
	anamnesis o antecedentes clínicos del paciente, que sirve como fundamento para el plan individual de enfermería.
	</ul>	
	<input type="button" value="Plan de enfermería">
	<ul>
	Este es el plan individual de enfermería. Usted puede crear, editar o borrar el plan.
	</ul>	
	<input type="button" value="Reportes de laboratorio">
	<ul>
	Esto almacena tanto los reportes de laboratorio clínico y de patología.
	</ul>	
	<input type="button" value="Fotos">
	<ul>
	Esto abre el catálogo de fotografías del paciente.
	</ul>	
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
¿Cuál es la función de esta casilla de selección </b>	<select name="d"><option value="">Seleccione el pedido para prueba diagnóstica</option></select>?
</font>
<ul>       	<b>Nota: </b>Esto seleccionará el formulario de pedidos para una prueba diagnóstica en particular.<br>
 	<b>Paso 1: </b>Dé clic en <select name="d"><option value="">Seleccione el pedido para prueba diagnóstica</option></select>
                                                                     <br>
		<b>Paso 2: </b>Dé clic en la clínica, departamento o prueba diagnóstica escogida.<br>
		<b>Paso 3: </b>El formulario de pedidos se abrirá automáticamente.<br>
</ul>
<?php endif ?>

<?php if($src=="labor") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>No existe un reporte de laboratorio disponible al momento. </b></font>
<ul> Dé clic en el botón <input type="button" value="OK"> para volver a la carpeta de datos del paciente.</ul>
<?php else  : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>¿Cómo cierro la carpeta de datos del paciente? </b></font>
<ul> <b>Nota: </b>Si usted desea cerrar esta ventana, dé clic en el botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle">.</ul>

<?php endif ?>

</form>

