<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "Laboratory - $x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to display the graphical chart for test parameters?</b>
</font>
<ul>      
 	<b>Step 1: </b>Click on the checkbox <input type="checkbox" name="s" value="s" checked> corresponding to the chosen parameter to select it.<br>
		<b>Step 2: </b>If you want to display several parameters at once, click on their corresponding checkboxes.<br>
		<b>Step 3: </b>Click on the icon <img src="../img/chart.gif" width=16 height=17 border=0> to display the graphical chart.<br>
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
I want to select all parameters. Is there a fast way to select them all at once?</b>
</font>
<ul>      
		<b>Yes there is!</b><br>
		<b>Step 1: </b>Click on the button <img src="../img/dwnArrowGrnLrg.gif" width=16 height=16 border=0 border=0> to select all parameters.<br>
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to deselect all parameters?</b>
</font>
<ul>      
		<b>Step 1: </b>Click on the button <img src="../img/dwnArrowGrnLrg.gif" width=16 height=16 border=0 border=0> once again to DESELECT all parameters.<br>
</ul>
<?php endif ?>
<?php if($src=="graph") : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>How to go back to the test results w/o graphic charts? </b></font>
<ul> <b>Note: </b>If you want to go back, click the button <img src="../img/en/en_back2.gif" border=0 align="absmiddle">.</ul>
<?php endif ?>

<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>How to close the laboratory <?php echo $x3 ?>? </b></font>
<ul> <b>Note: </b>If you want to close, click the button <img src="../img/en/en_close2.gif" border=0 align="absmiddle">.</ul>


</form>

