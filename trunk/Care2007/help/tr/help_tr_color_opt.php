<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Renk se�enekleri 
<?php
	switch($src)
	{
	case "ext": print " - Extended";
						break;
	 }
?>
</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arka plan rengi nas�l se�ilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> �stedi�iniz �er�evede "<span style="background-color:yellow" > Arka plan rengi <img <?php echo createComIcon('../','settings_tree.gif','0') ?>> </span>" ba�lant�s�na t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Renk paleti bulunan bir pencere a��l�r.<br>
 	<b>Ad�m 3: </b>Arka plan i�in istedi�iniz renge t�klay�n�z.<br>
 	<b>Ad�m 4: </b>Rengi uygulamak i�in <input type="button" value="Uygula"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 5: </b>��iniz bitti ise  <input type="button" value="Tamam"> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yaz� rengi nas�l se�ilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Ya �st �er�evedeki  "<span style="background-color:yellow" > Yaz� rengi </span>" veya men� �er�evesindeki 
	"<span style="background-color:yellow" > Men� kalemleri </span>" ba�lant�s�n� t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Renk paletli bir pencere a��l�r.<br>
 	<b>Ad�m 3: </b>Yaz� i�in istedi�iniz rengi se�iniz.<br>
 	<b>Ad�m 4: </b>Rengi uygulamak i�in <input type="button" value="Uygula"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 5: </b>��iniz bitti ise <input type="button" value="Tamam"> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ba�lant� renkleri nas�l se�ilir?</b>
</font>
<ul>       	
 	<b>Ad�m 5: </b>�leri renk se�eneklerini g�rmek i�in <input type="button" value="�leri renk se�enekleri"> d��mesini t�klay�n�z.<br>
</ul>
<?php endif ?>

<?php if($src=="ext") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Aktif ba�lant� rengi nas�l se�ilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Ya ana �er�evede "<span style="background-color:yellow" > Etkin ba�lant� </span>" ba�lant�s�n� ya da men� �er�evesinde "<span style="background-color:yellow" > Etkin ba�lant� </span>" ba�lant�s�n� t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Bir renk paleti penceresi a��l�r.<br>
 	<b>Ad�m 3: </b>Etkin ba�lant� i�in istedi�iniz rengi t�klay�n�z.<br>
 	<b>Ad�m 4: </b>Rengi uygulamak i�in <input type="button" value="Uygula"> d��mesini t�klat�n�z.<br>
 	<b>Ad�m 5: </b>��iniz bitti ise <input type="button" value="Tamam"> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hover ba�lant� rengi nas�l se�ilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Ya ana �er�evede "<span style="background-color:yellow" > hover ba�lant� </span>" ba�lant�s�n� ya da men� �er�evesinde "<span style="background-color:yellow" > hover ba�lant� </span>" ba�lant�s�n� t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Bir renk paleti penceresi a��l�r.<br>
 	<b>Ad�m 3: </b>Etkin ba�lant� i�in istedi�iniz rengi t�klay�n�z.<br>
 	<b>Ad�m 4: </b>Rengi uygulamak i�in <input type="button" value="Uygula"> d��mesini t�klat�n�z.<br>
 	<b>Ad�m 5: </b>��iniz bitti ise <input type="button" value="Tamam"> d��mesini t�klay�n�z.<br>
</ul>


<?php endif ?>
	</form>

