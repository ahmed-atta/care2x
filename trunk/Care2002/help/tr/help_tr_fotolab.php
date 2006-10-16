<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Fotolab - 
<?php
	switch($src)
	{
	case "init": print "Başlatılıyor";
												break;
	case "input": print "Yüklenecek resimler seçiliyor";
												break;
	case "maindata": print "Hasta bilgileri";
												break;
	case "save": print "Fotoğraflar kaydedildi";
												break;

	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="input") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Giriş yapılacak alanlar görüntüleniyor. Resim dosyaları nasıl seçilecek?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Kaydetmek istediğiniz fotoğrafın dosyasını bulmak için  <input type="button" value="Tara..."> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Bir "Dosya seç" penceresi açılır. İstediğiniz dosyayı seçip "Aç" ı tıklayınız.<br>
 	<b>Adım 3: </b>Eğer seçtiğiniz geçerli bir grafik dosyası ise resim ön izleme halinde üst sağ köşede izlenebilir. (Sadece MSIE  tarayıcısında) Olmazsa 1. ve 2. adımı tekrarlayınız.<br>
 	<b>Adım 4: </b>Bu fotoğrafın çekildiği tarihi  "<span style="background-color:yellow" > Çekim tarihi </span>" alanına giriniz.<p>
 	

	<b>Adım 5: </b>Fotoğraf sayısını "<span style="background-color:yellow" > Sayı </span>" alanına giriniz.<p>
	
 	
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Fotoğrafın ön izlemesi nasıl görüntülenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Fotoğrafın ilgili <img <?php echo createComIcon('../','lilcamera.gif','0') ?>> düğmesi tıklanır.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yüklenecek resim sayısı nasıl değiştirilir?</b>
</font>
<ul>       	
 	<b>Adım 1:</b> Yüklemek istediğiniz sayıyı  " <input type="text" name="v" size=4 maxlength=4> resim yüklemek istiyorum " alanına giriniz.<p>
 	<b>Adım 2:</b>"Git" i tıklayınız.<p>
</ul>

<?php endif ?>	

<?php if($src=="maindata") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hastanın bilgileri nasıl bulunur?</b>
</font>
<ul>	
	<b>Adım 1: </b>Hastanın protokol numarasını "<span style="background-color:yellow" > Protokol numarası </span>" alanına giriniz.<br>
 	<b>Adım 2: </b>Hastayı bulmak için <input type="button" value="Ara"> düğmesini tıklatınız.<br>
 	<b>Adım 3: </b>Hasta bulunduğu zaman ilgili alanlarda temel bilgileri görüntülenir.<br>
 	<b>Adım 4: </b>Fotoğrafların hepsi ya da çoğu aynı tarihte çekilmiş ise, o tarihi  <nobr>"<span style="background-color:yellow" > Çekim tarihi</span>"</nobr> alanına giriniz.<br>
 	<b>Adım 5: </b>Bu tarihi tüm fotoğraflar için ayarlamak isterseniz  <img <?php echo createComIcon('../','preset-add.gif','0') ?>> düğmesini tıklayınız. Bu tarih otomatik olarak 
	sol penceredeki  "Çekim tarihi" alanlarında görülecektir.<p>
 	<img <?php echo createComIcon('../','warn.gif','0') ?>><b> Uyarı! </b>Fotoğraflardan biri ya da birkaçının farklı çekim tarihleri var ise o tarihi ilgili fotoğrafın  "Çekim tarihi" alanına giriniz. Bunu ancak 5. adımdan sonra yapabilirsiniz.<p>
</ul>
	
	<?php endif ?>	
<?php if($src=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Aynı hastanın başka fotoğraflarını da kaydetmek istiyorum. Nasıl yapılır?</b>
</font>
<ul>	
	<b>Adım 1: </b>Kaydetmek istediğiniz fotoğrafların sayısını <nobr>"Aynı hastanın ek <input type="text" name="g" size=3 maxlength=2> fotoğrafı <span style="background-color:yellow" > . </span>"</nobr> alanına giriniz.<br>
 	<b>Adım 2: </b><input type="button" value="Git"> düğmesini tıklayınız.<br>
</ul>

	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir başka hastanın resimlerini kaydetmek istiyorum. Nasıl yapılır?</b>
</font>
<ul>	
	<b>Adım 1: </b>Kaydetmek istediğiniz fotoğrafların sayısını bir başka hastanın <nobr>" <input type="text" name="g" size=3 maxlength=2> fotoğrafı <span style="background-color:yellow" >  </span>"</nobr> alanına giriniz.<br>
 	<b>Adım 2: </b> <input type="button" value="Git"> düğmesini tıklayınız.<br>
</ul>

	<?php endif ?>	
	


	</form>

