<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Radyoloji - R�ntgen 
<?php

if($src=="search")
{
	print "Bir hastay� ara";	
}

 ?>
 </b>
 </font>
<p><font size=2 face="verana,arial" >
<form action="#" >

<?php if($src=="search") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hasta nas�l aran�r?</b>
</font>
	
	<ul>       	
 	<b>Ad�m 1: </b>Bir hastan�n protokol numaras�, ad, soyad bilgilerinden tamam�n� veya birka� harfi ilgili alana giriniz. <br>
 	<b>Ad�m 2: </b>Hastay� aramaya ba�lamak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> d��mesini t�klay�n�z.<p> 
<ul>       	
 	<b>Uyar�: </b>Arama bir sonu� bulur ise, bir liste g�r�nt�lenir. <p>
	</ul>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hastan�n r�ntgen filmi ve tan�s� nas�l izlenir?</b>
</font>
	
	<ul>       	
 	<b>Ad�m 1: </b>"<span style="background-color:yellow" > <font color="#0000cc">�n izleme/Tan�</font> <input type="radio" name="d" value="a"> </span>" ba�lant� ya da d��mesini t�klay�n�z.<br>
	R�ntgen filminin minik bir kopyas� alt sol pencerede g�r�nt�lenir.<br> 
	R�ntgen filminin tan�s� alt sa� pencerede g�r�nt�lenir.<br> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hastan�n r�ntgen filmi tam b�y�kl�kte nas�l izlenir?</b>
</font>
	<ul>       	
 	<b>Ad�m 1: </b>Tam ekran g�r�nt�s�ne ge�mek i�in hastan�n ilgili   <img <?php echo createComIcon('../','torso.gif','0') ?>> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 E�er kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php endif ?>


</form>

