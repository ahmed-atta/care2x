<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Color options 
<?
	switch($src)
	{
	case "ext": print " - Extended";
						break;
	 }
?>
</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<? if($src=="") : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to select the background color?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the link "<span style="background-color:yellow" > Background color <img src="../img/settings_tree.gif" border=0> </span>" in the frame you want.<br>
 	<b>Step 2: </b>A window showing a color palette will pop up.<br>
 	<b>Step 3: </b>Click the color you want for the background.<br>
 	<b>Step 4: </b>Click the <input type="button" value="Apply"> button to apply the color.<br>
 	<b>Step 5: </b>If you are finished, click the <input type="button" value="OK"> button.<br>
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to select the text color?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click either the link "<span style="background-color:yellow" > Text color </span>" in the top frame or the link
	"<span style="background-color:yellow" > Menu items </span>" in the menu frame.<br>
 	<b>Step 2: </b>A window showing a color palette will pop up.<br>
 	<b>Step 3: </b>Click the color you want for the text.<br>
 	<b>Step 4: </b>Click the <input type="button" value="Apply"> button to apply the color.<br>
 	<b>Step 5: </b>If you are finished, click the <input type="button" value="OK"> button.<br>
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to select the hover and link colors?</b>
</font>
<ul>       	
 	<b>Step 5: </b>Click the <input type="button" value="Extended color options"> to switch over to extended color options.<br>
</ul>
<? endif ?>

<? if($src=="ext") : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to select the active link color?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click either the link "<span style="background-color:yellow" > active link </span>" in the main frame or the link
	"<span style="background-color:yellow" > Active link </span>" in the menu frame.<br>
 	<b>Step 2: </b>A window showing a color palette will pop up.<br>
 	<b>Step 3: </b>Click the color you want for the active link.<br>
 	<b>Step 4: </b>Click the <input type="button" value="Apply"> button to apply the color.<br>
 	<b>Step 5: </b>If you are finished, click the <input type="button" value="OK"> button.<br>
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
How to select the hover link color?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click either the link "<span style="background-color:yellow" > hover link </span>" in the main frame or the link
	"<span style="background-color:yellow" > Hover link </span>" in the menu frame.<br>
 	<b>Step 2: </b>A window showing a color palette will pop up.<br>
 	<b>Step 3: </b>Click the color you want for the hover link.<br>
 	<b>Step 4: </b>Click the <input type="button" value="Apply"> button to apply the color.<br>
 	<b>Step 5: </b>If you are finished, click the <input type="button" value="OK"> button.<br>
</ul>

<? endif ?>
	</form>

