<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "Datos del paciente - $x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>�Qu� significan estas <img <?php echo createComIcon('../','colorcodebar3.gif','0') ?> > barras de colores? </b></font>
<ul> <b>Nota: </b>Cada una de estas barras de color, cuando se dejan "levantadas", representan cambios a un documento en particular, una instrucci�n, un cambio, una consulta, etc.<br>
			El significado de un color puede establecerse para cada pabell�n. <br>
			La serie de barras de color rosa a la derecha representan el tiempo aproximado en que una instrucci�n se deber� llevar a cabo.<br>
			Por ejemplo: la sexta barra de color rosa significa la "6ta hora" o "6 en punto de la ma�ana", la barra 22 significa las "22 horas" o las "10 en punto de la noche".
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�Qu� son los siguientes botones?</b></font>
<ul> <input type="button" value="Tabla gr�fica de fiebre">
	<ul>
		Esto abrir� la tabla gr�fica con la temperatura diaria del paciente. Usted puede escribir, editar o eliminar los datos de fiebre y tensi�n arterial en la tabla.<br>
		Otros datos que se pueden editar son:
	<ul type="disc">
	<li>Alergias<br>
	<li>Plan de dieta alimentaria diaria<br>
	<li>Diagn�stico principal y terapia<br>
	<li>Diagn�stico diario y terapia<br>
	<li>Apuntes, diagn�sticos adicionales<br>
	<li>Terapia f�sica (PT), Atg (Gimnasia anti-trombosis), etc.<br>
	<li>Anticoagulantes<br>
	<li>Documentaci�n diaria para los anticoagulantes<br>
	<li>Medicaci�n intravenosa y cambio de vendajes<br>
	<li>Documentaci�n diaria para la medicaci�n intravenosa<br>
	<li>Apuntes<br>
	<li>Listado de medicaci�n (listado)<br>
	<li>Documentaci�n diaria para la medicaci�n y dosis<br>
	</ul>		
	</ul>
<input type="button" value="Reporte de enfermer�a">
	<ul>
		Esto abrir� el formulario de reporte de enfermer�a. Usted puede documentar su actividad de enfermer�a, su efectividad, observaciones, consultas, o recomendaciones, etc.
	</ul>
	<input type="button" value="Directivas del m�dico">
	<ul>
	El m�dico a cargo ingresar� aqu� sus instrucciones, medicaci�n, dosis, respuestas a las consultas de la enfermera o instrucciones para cambios, etc.
	</ul>	
	<input type="button" value="Reportes diagn�sticos">
	<ul>
	Esto almacena los reportes diagn�sticos provenientes de las diferentes �reas cl�nicas o departamentos diagn�sticos.
	</ul>	
	<input type="button" value="Datos fuente">
	<ul>
	Esto almacena los datos fuente de los pacientes e informaci�n personal tales como nombre, apellido, etc. Esta tambi�n es la documentaci�n inicial de la
	anamnesis o antecedentes cl�nicos del paciente, que sirve como fundamento para el plan individual de enfermer�a.
	</ul>	
	<input type="button" value="Plan de enfermer�a">
	<ul>
	Este es el plan individual de enfermer�a. Usted puede crear, editar o borrar el plan.
	</ul>	
	<input type="button" value="Reportes de laboratorio">
	<ul>
	Esto almacena tanto los reportes de laboratorio cl�nico y de patolog�a.
	</ul>	
	<input type="button" value="Fotos">
	<ul>
	Esto abre el cat�logo de fotograf�as del paciente.
	</ul>	
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�Cu�l es la funci�n de esta casilla de selecci�n </b>	<select name="d"><option value="">Seleccione el pedido para prueba diagn�stica</option></select>?
</font>
<ul>       	<b>Nota: </b>Esto seleccionar� el formulario de pedidos para una prueba diagn�stica en particular.<br>
 	<b>Paso 1: </b>D� clic en <select name="d"><option value="">Seleccione el pedido para prueba diagn�stica</option></select>
                                                                     <br>
		<b>Paso 2: </b>D� clic en la cl�nica, departamento o prueba diagn�stica escogida.<br>
		<b>Paso 3: </b>El formulario de pedidos se abrir� autom�ticamente.<br>
</ul>
<?php endif ?>

<?php if($src=="labor") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>No existe un reporte de laboratorio disponible al momento. </b></font>
<ul> D� clic en el bot�n <input type="button" value="OK"> para volver a la carpeta de datos del paciente.</ul>
<?php else  : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>�C�mo cierro la carpeta de datos del paciente? </b></font>
<ul> <b>Nota: </b>Si usted desea cerrar esta ventana, d� clic en el bot�n <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle">.</ul>

<?php endif ?>

</form>

