<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
if($x2=="pharma") print "Farmacia - "; else print "Insumos m�dicos - ";
	switch($src)
	{
	case "head": if($x2=="pharma") print "Ordering pharmaceutical products"; 
						else print "Ordering products";
						break;
	case "catalog": print "Cat�logo de pedidos";
						break;
	case "orderlist": print "Canasta de pedidos ( order list )";
						break;
	case "final": print "Listado final de pedidos";
						break;
	case "maincat": print "Cat�logo de pedidos";
						break;
	case "arch": print "Archivo de pedidos";
						break;
	case "archshow": print "Archivo de pedidos";
						break;
	case "db": switch($x3)
					{
						case "input": print "Ingreso de un producto nuevo a la base de datos";
						break;
					}
					break;
	case "how2":print "C�mo hacer pedidos de ";
						  if($x2=="pharma") print "productos farmac�uticos"; else print "productos";
	}


 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if($src=="maincat") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
C�mo a�adir un pedido al cat�logo de pedidos?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>Primero debe hallar el art�culo.  Escriba ya sea la informaci�n completa or the first few letters of the articles brand name, or generic name, or order number, etc. in the 
				<nobr><span style="background-color:yellow" >" Search a search keyword: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> field.<br>
 	<b>Paso 2: </b>D� clic en el bot�n <input type="button" value="Find article"> to find the article.<br>
 	<b>Paso 3: </b>If the search finds the article that exactly matches the search keyword, a detailed information on the article will be displayed.<br>
 	<b>Paso 4: </b>D� clic en el bot�n <input type="button" value="Put this article in the catalog"> to add the article in the catalog.<p>
 	<b>Nota: </b>If you do not want to put this article in the catalog just continue searching for another article.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
C�mo continuar la b�squeda?</b>
</font>
<ul>       	
 	Siga las instrucciones de arriba para hallar el art�culo.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
La b�squeda hall� varios art�culos que se aproximan a mi palabra de b�squeda.  Qu� debo hacer?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>Si la b�squeda hall� al art�culo o informaci�n del art�culo que se aproxima a las palabras que us� en su b�squeda, aparecer� una lista.<br>
 	<b>Paso 2: </b>D� clic en el bot�n <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>>. El art�culo se a�adir� a lista del cat�logo.<br>
 	<b>Paso 3: </b>If you want to see first the complete information on the article, click either its name or its button <img <?php echo createComIcon('../','info3.gif','0') ?>>.<br>
 	<b>Paso 4: </b>The complete information on the article will be displayed.<br>
 	<b>Paso 5: </b>D� clic en el bot�n <input type="button" value="Put this article in the catalog">.<p>
</ul>
	

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to see more information about the article. What should I do?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>d� clic, ya sea al bot�n <img <?php echo createComIcon('../','info3.gif','0') ?>> or the article's name.<br>
 	<b>Paso 2: </b>The complete information about the product will be displayed.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
C�mo elimino un art�culo de la lista del cat�logo?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>D� clic en el bot�n <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> of the article.<br>
</ul>

<?php endif ?>

<?php if($src=="how2") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como hago un pedido de <?php if($x2=="pharma") print "productos farmac�uticos"; else print "productos de los insumos m�dicos"; ?>?
</b>
</font>
<ul>       	
 	<b>Paso 1: </b>D� clic en la opci�n del men� "<span style="background-color:yellow" > <img <?php echo createComIcon('../','bestell.gif','0') ?>> Pedidos </span>" para pasar a la ventana de pedidos.<br>
 	<b>Paso 2: </b>Si usted ya ha ingresado con su nombre y contrase�a, ver� la canasta de pedidos y el cat�logo de pedidos. Sin embargo, si usted no ha ingresado con su nombre y contrase�a antes, deber� ingresar estos datos.
	<br>

 	<b>Paso 3: </b>If asked, enter your username and password. D� clic en el bot�n <img <?php echo createLDImgSrc('../','continue.gif','0') ?>>.<br>
 	<b>Paso 4: </b>Start creating an order list. On the right frame you will see the order catalog for your department, or ward, or operating room.<p>
 	<b>Paso 5: </b>If the article you need is in the catalog list, click its button <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> to put <b>one piece</b> of the article to the basket (order list) on the left frame.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Deseo colocar m�s de una unidad del producto en la canasta. C�mo lo hago?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>D� clic al select button 	<input type="checkbox" name="a" value="a" checked> corresponding to the article to select it.<br>
 	<b>Paso 2: </b>Enter the number of pieces in the " Pcs. <input type="text" name="d" size=2 maxlength=2> " field corresponding to the article.<br>
 	<b>Paso 3: </b>D� clic en el bot�n <input type="button" value="Put in the basket"> to put the article into the basket (order list).<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
The article I need is not in the catalog list. What should I do?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>You must find the article. Escriba ya sea la informaci�n completa or the first few letters of the articles brand name, or generic name, or order number, etc. in the 
				<nobr><span style="background-color:yellow" >" Search keyword: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> field.<br>
 	<b>Paso 2: </b>D� clic en el bot�n <input type="button" value="Find article"> to find the article.<br>
 	<b>Paso 3: </b>If the search finds the article or article information that approximates the search keyword, aparecer� un listado.<br>
 	<b>Paso 4: </b>If you want to put one piece of the article in the order basket, d� clic al bot�n<img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>>. The article will be put in the basket and at the same it will be included in the catalog listing.<br>
 	<b>Paso 5: </b>If you want to only add the article in the catalog listing, d� clic al bot�n<img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>>.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to see more information about the article. What should I do?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>d� clic, ya sea al bot�n <img <?php echo createComIcon('../','info3.gif','0') ?>> or the article's name.<br>
 	<b>Paso 2: </b>A window showing the complete information about the product will pop up.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to remove an article from the catalog list?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>D� clic en el bot�n <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> of the article.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Can I change the number of pieces in the order basket?
</b>
</font>
<ul>       	
 	<b>Yes.</b> Just replace the entry with the new number of pieces before you finalize the order list.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
All the articles I need are in the basket now. What should I do next?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>You can proceed to sending the order list to the  <?php if($x2=="pharma") print "pharmacy"; else print "medical depot"; ?>. <br>D� clic en el bot�n <input type="button" value="Finalize order list"> to start the procedure.<br>
 	<b>Paso 2: </b>The order list will be displayed again. Enter your name in the <nobr>"<span style="background-color:yellow" > Created by <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> field.<br>
 	<b>Paso 3: </b>Select the priority status of the order between "<span style="background-color:yellow" > Normal<input type="radio" name="x" value="s" checked> Urgent<input type="radio" name="x" > </span>". Check the appropriate radio button.<br>
 	<b>Paso 4: </b>The validator (physician or surgeon) must enter his name in the <nobr>"<span style="background-color:yellow" > Validated by <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> field.<br>
 	<b>Paso 5: </b>The validator (physician or surgeon) must enter his password in the <nobr>"<span style="background-color:yellow" > Password: <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> field.<br>
 	<b>Paso 6: </b>D� clic en el bot�n <input type="button" value="Send this order list to the <?php if($x2=="pharma") print "pharmacy"; else print "medical depot"; ?>"> to send the order list.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Si usted decide cerrar esta ventana sending of the order list, click the link "<span style="background-color:yellow" > << Go back and edit list </span>" to go back to the order list.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to end the ordering now. What should I do?</b>
</font>
<ul>     
 	<b>Paso 1: </b>D� clic al link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> End ordering </span>" to go back to the <?php if($x2=="pharma") print "pharmacy"; else print "medical depot"; ?>'s submenu.<br>
</ul>	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to create a new order list. What should I do?</b>
</font>
<ul>     
 	<b>Paso 1: </b>D� clic al link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> Start a new order list </span>" to create an empty order basket.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 You can get detailed instructions on either the order basket or the catalog listing by clicking the button <img <?php echo createComIcon('../','frage.gif','0') ?>> within the window.
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Si usted decide cerrar d� clic al bot�n<img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif ?>


<?php if($src=="head") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to order <?php if($x2=="pharma") print "pharmaceutical products"; 
						else print "products from the medical depot"; ?>?
</b>
</font>
<ul>       	

 	<b>Paso 1: </b>Create first an order list. On the right frame you will see the order catalog for your department, or ward, or operating room.<p>
 	<b>Paso 2: </b>If the article you need is in the catalog list, click its button <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> to put <b>one piece</b> of the article to the basket (order list) on the left frame.<p>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 You can get detailed instructions on either the order basket or the catalog listing by clicking the button <img <?php echo createComIcon('../','frage.gif','0') ?>> within the window.
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Si usted decide cerrar d� clic al bot�n<img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif ?>

<?php if($src=="catalog") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to put an article in the basket (order list)?
</b>
</font>
<ul>       	
 	<b>Paso 1: </b>If the article you need is in the catalog list, click its button <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> to put <b>one piece</b> of the article to the order list (basket) on the left frame.<p>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to put more than one piece of the article in the order basket. How to do it?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>D� clic al select button 	<input type="checkbox" name="a" value="a" checked> corresponding to the article to select it.<br>
 	<b>Paso 2: </b>Enter the number of pieces in the " Pcs. <input type="text" name="d" size=2 maxlength=2> " field corresponding to the article.<br>
 	<b>Paso 3: </b>D� clic en el bot�n <input type="button" value="Put in the basket"> to put the article into the basket (order list).<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
The article I need is not in the catalog list. What should I do?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>You must find the article. Escriba ya sea la informaci�n completa or the first few letters of the articles brand name, or generic name, or order number, etc. in the 
				<nobr><span style="background-color:yellow" >" Search keyword: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> field.<br>
 	<b>Paso 2: </b>D� clic en el bot�n <input type="button" value="Find article"> to find the article.<br>
 	<b>Paso 3: </b>If the search finds the article or article information that approximates the search keyword, aparecer� un listado.<br>
 	<b>Paso 4: </b>If you want to put one piece of the article in the order basket, d� clic al bot�n<img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>>. The article will be put in the basket and at the same it will be included in the catalog listing.<br>
 	<b>Paso 5: </b>If you want to only add the article in the catalog listing, d� clic al bot�n<img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>>.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to see more information about the article. What should I do?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>d� clic, ya sea al bot�n <img <?php echo createComIcon('../','info3.gif','0') ?>> or the article's name.<br>
 	<b>Paso 2: </b>A window showing the complete information about the product will pop up.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to remove an article from the catalog list?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>D� clic en el bot�n <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> of the article.<br>
</ul>

<?php endif ?>

<?php if($src=="orderlist") : ?>
	<?php if($x1=="0") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 The basket is empty at the moment.<p>
 To create an order list, select the article you need from the catalog list on the right frame and put it in the basket.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to put an article in the basket (order list)?
</b>
</font>
<ul>       	
 	<b>Paso 1: </b>If the article you need is in the catalog list, click its button <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> to put <b>one piece</b> of the article to the order list (basket).<br> The order list will
	be displayed automatically on the basket frame on the left.<p>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 For detailed instructions on how to search, select, and put articles from catalog list into the basket, click the <img <?php echo createComIcon('../','frage.gif','0') ?>> button within the order catalog frame on the right.<p>
</ul>

	<?php else : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Can I change the number of pieces in the order basket?
</b>
</font>
<ul>       	
 	<b>Yes.</b> Just replace the entry with the new number of pieces before you finalize the order list.
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to see more information about the article. What should I do?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>D� clic en el bot�n <img <?php echo createComIcon('../','info3.gif','0') ?>> of the article.<br>
 	<b>Paso 2: </b>A window showing the complete information about the product will pop up.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to remove an article from the basket?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>D� clic en el bot�n <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> of the article.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
All the articles I need are in the basket now. What should I do next?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>You can proceed to sending the order list to the pharmacy. <br>D� clic en el bot�n <input type="button" value="Finalize order list"> to start the procedure.<br>
 	<b>Paso 2: </b>The order list will be displayed again. Enter your name in the <nobr>"<span style="background-color:yellow" > Created by <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> field.<br>
 	<b>Paso 3: </b>Select the priority status of the order between "<span style="background-color:yellow" > Normal<input type="radio" name="x" value="s" checked> Urgent<input type="radio" name="x" > </span>". Check the appropriate radio button.<br>
 	<b>Paso 4: </b>The validator (physician or surgeon) must enter his name in the <nobr>"<span style="background-color:yellow" > Validated by <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> field.<br>
 	<b>Paso 5: </b>The validator (physician or surgeon) must enter his password in the <nobr>"<span style="background-color:yellow" > Password: <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> field.<br>
 	<b>Paso 6: </b>D� clic en el bot�n <input type="button" value="Send this order list to the pharmacy"> to send the order list.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Si usted decide cerrar esta ventana sending of the order list, click the link "<span style="background-color:yellow" > << Go back and edit list </span>" to go back to the order list.
</ul>
	<?php endif ?>

<?php endif ?>


<?php if($src=="final") : ?>
	<?php if($x1=="1") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to end the ordering now. What should I do?</b>
</font>
<ul>     
 	<b>Paso 1: </b>D� clic al link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> End ordering </span>" to go back to the pharmacy's submenu.<br>
</ul>	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to create a new order list. What should I do?</b>
</font>
<ul>     
 	<b>Paso 1: </b>D� clic al link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> Start a new order list </span>" to create an empty order basket.<br>
</ul>		<?php else : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to send the final order list?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>Enter your name in the <nobr>"<span style="background-color:yellow" > Created by <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> field.<br>
 	<b>Paso 2: </b>Select the priority status of the order between "<span style="background-color:yellow" > Normal<input type="radio" name="x" value="s" checked> Urgent<input type="radio" name="x" > </span>". Check the appropriate radio button.<br>
 	<b>Paso 3: </b>The validator (physician or surgeon) must enter his name in the <nobr>"<span style="background-color:yellow" > Validated by <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> field.<br>
 	<b>Paso 4: </b>The validator (physician or surgeon) must enter his password in the <nobr>"<span style="background-color:yellow" > Password: <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> field.<br>
 	<b>Paso 5: </b>D� clic en el bot�n <input type="button" value="Send this order list to the pharmacy"> to send the order list.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Si usted decide cerrar esta ventana sending of the order list, click the link "<span style="background-color:yellow" > << Go back and edit list </span>" to go back to the order list.
</ul>
	<?php endif ?>

<?php endif ?>
<!-- ++++++++++++++++++++++++++++++++++ archive +++++++++++++++++++++++++++++++++++++++++++ -->
<?php if($src=="arch") : ?>


<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>I want to see the archived order lists.</b></font>
<ul>  	<b>Paso 1: </b> Escriba ya sea la informaci�n completa or the first few letters of the department's name, or id, or order date, or priority ("urgent") in the 
				<nobr><span style="background-color:yellow" >" Search keyword: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> field.<br>
 	<b>Paso 2: </b>Check or uncheck the  following checkboxes for search categories:
<ul> 	
  	<input type="checkbox" name="d" checked> Date<br>
	<input type="checkbox" name="d" checked> Department<br>
  	<input type="checkbox" name="d" checked> Priority<br>
	By default, all three checkboxes will be checked and the search will do searching in all three categories. If you want to exclude a category click its checkbox to deselect it.
</ul> 	
<b>Paso 3: </b>D� clic en el bot�n <input type="button" value="Buscar"> to find the article.<br>
 	<b>Paso 4: </b>If the search finds the order  or orders that approximate the search keyword, aparecer� un listado.<br>
 	<b>Paso 5: </b>D� clic al order list's button <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>>. The details of the order will be displayed<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Several orders are listed. How to see a particular order?</b></font>
<ul>  	
 	<b>Paso 1: </b>D� clic al order's button <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>>. The details of the order will be displayed<br>
</ul>

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 If you decide to end searching and close, d� clic al bot�n<img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>


	<?php endif ?>
	
<?php if($src=="archshow") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to see more information about an article in the order list. What should I do?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>D� clic al article's <img <?php echo createComIcon('../','info3.gif','0') ?>> button.<br>
 	<b>Paso 2: </b>A window showing the complete information about the product will pop up.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to see the list of archived orders again. What should I do?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>D� clic al <input type="button" value="<< Go back"> button.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>I want to do a new search for archived order lists. What should I do?</b></font>
<ul>  	<b>Paso 1: </b> Escriba ya sea la informaci�n completa or the first few letters of the department's name, or id, or order date, or priority ("urgent") in the 
				<nobr><span style="background-color:yellow" >" Search keyword: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> field.<br>
 	<b>Paso 2: </b>Check or uncheck the  following checkboxes for search categories:
<ul> 	
  	<input type="checkbox" name="d" checked> Date<br>
	<input type="checkbox" name="d" checked> Department<br>
  	<input type="checkbox" name="d" checked> Priority<br>
	By default, all three checkboxes will be checked and the search will do searching in all three categories. If you want to exclude a category click its checkbox to deselect it.
</ul> 	
<b>Paso 3: </b>D� clic en el bot�n <input type="button" value="Buscar"> to find the article.<br>
 	<b>Paso 4: </b>If the search finds the order  or orders that approximate the search keyword, aparecer� un listado.<br>
</ul>
	<?php endif ?>	
	

<?php if($src=="db") : ?>
	<?php if($x1=="") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to enter a new product into the databank?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>Enter first all available information about the product into their corresponding entry fields.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to select a picture of the product. How to do it?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>D� clic en el bot�n <input type="button" value="Browse..."> on the "<span style="background-color:yellow" > Picture file </span>" field.<br>
 	<b>Paso 2: </b>A small window for selecting a file will appear. Select the picture file of your choice and click "OK".<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I am finished entering all available product information. How to save it?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>D� clic en el bot�n <input type="button" value="Save">.<br>
</ul>
	<?php endif ?>	
	<?php if($x1=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
C�mo ingreso un producto nuevo en la base de datos?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>D� clic al <input type="button" value="New product"> button.<br>
 	<b>Paso 2: </b>The entry form will appear.<br>
 	<b>Paso 3: </b>Enter the available information about the new product.<br>
 	<b>Paso 4: </b>D� clic en el bot�n <input type="button" value="Save"> to save the information.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to edit the product that is currently displayed How to do it?</b>
</font>
<ul>       	
 	<b>Paso 1: </b>D� clic en el bot�n <input type="button" value="Updte or edit">.<br>
 	<b>Paso 2: </b>The product information will be automatically entered into the editing form.<br>
 	<b>Paso 3: </b>Edit the information.<br>
 	<b>Paso 4: </b>D� clic en el bot�n <input type="button" value="Save"> to save the new information.<br>
</ul>
	
	<?php endif ?>	
<?php endif ?>	
</form>

