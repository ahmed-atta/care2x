<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Radyoloji - Röntgen 
<?php

if($src=="search")
{
	print "Bir hastayı ara";	
}

 ?>
 </b>
 </font>
<p><font size=2 face="verana,arial" >
<form action="#" >

<?php if($src=="search") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hasta nasıl aranır?</b>
</font>
	
	<ul>       	
 	<b>Adım 1: </b>Bir hastanın protokol numarası, ad, soyad bilgilerinden tamamını veya birkaç harfi ilgili alana giriniz. <br>
 	<b>Adım 2: </b>Hastayı aramaya başlamak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düğmesini tıklayınız.<p> 
<ul>       	
 	<b>Uyarı: </b>Arama bir sonuç bulur ise, bir liste görüntülenir. <p>
	</ul>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hastanın röntgen filmi ve tanısı nasıl izlenir?</b>
</font>
	
	<ul>       	
 	<b>Adım 1: </b>"<span style="background-color:yellow" > <font color="#0000cc">Ön izleme/Tanı</font> <input type="radio" name="d" value="a"> </span>" bağlantı ya da düğmesini tıklayınız.<br>
	Röntgen filminin minik bir kopyası alt sol pencerede görüntülenir.<br> 
	Röntgen filminin tanısı alt sağ pencerede görüntülenir.<br> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hastanın röntgen filmi tam büyüklükte nasıl izlenir?</b>
</font>
	<ul>       	
 	<b>Adım 1: </b>Tam ekran görüntüsüne geçmek için hastanın ilgili   <img <?php echo createComIcon('../','torso.gif','0') ?>> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 Eğer kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php endif ?>


</form>

