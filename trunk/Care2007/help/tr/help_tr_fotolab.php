<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Fotolab - 
<?php
	switch($src)
	{
	case "init": print "Ba�lat�l�yor";
												break;
	case "input": print "Y�klenecek resimler se�iliyor";
												break;
	case "maindata": print "Hasta bilgileri";
												break;
	case "save": print "Foto�raflar kaydedildi";
												break;

	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="input") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Giri� yap�lacak alanlar g�r�nt�leniyor. Resim dosyalar� nas�l se�ilecek?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Kaydetmek istedi�iniz foto�raf�n dosyas�n� bulmak i�in  <input type="button" value="Tara..."> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Bir "Dosya se�" penceresi a��l�r. �stedi�iniz dosyay� se�ip "A�" � t�klay�n�z.<br>
 	<b>Ad�m 3: </b>E�er se�ti�iniz ge�erli bir grafik dosyas� ise resim �n izleme halinde �st sa� k��ede izlenebilir. (Sadece MSIE  taray�c�s�nda) Olmazsa 1. ve 2. ad�m� tekrarlay�n�z.<br>
 	<b>Ad�m 4: </b>Bu foto�raf�n �ekildi�i tarihi  "<span style="background-color:yellow" > �ekim tarihi </span>" alan�na giriniz.<p>
 	

	<b>Ad�m 5: </b>Foto�raf say�s�n� "<span style="background-color:yellow" > Say� </span>" alan�na giriniz.<p>
	
 	
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Foto�raf�n �n izlemesi nas�l g�r�nt�lenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Foto�raf�n ilgili <img <?php echo createComIcon('../','lilcamera.gif','0') ?>> d��mesi t�klan�r.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Y�klenecek resim say�s� nas�l de�i�tirilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1:</b> Y�klemek istedi�iniz say�y�  " <input type="text" name="v" size=4 maxlength=4> resim y�klemek istiyorum " alan�na giriniz.<p>
 	<b>Ad�m 2:</b>"Git" i t�klay�n�z.<p>
</ul>

<?php endif ?>	

<?php if($src=="maindata") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hastan�n bilgileri nas�l bulunur?</b>
</font>
<ul>	
	<b>Ad�m 1: </b>Hastan�n protokol numaras�n� "<span style="background-color:yellow" > Protokol numaras� </span>" alan�na giriniz.<br>
 	<b>Ad�m 2: </b>Hastay� bulmak i�in <input type="button" value="Ara"> d��mesini t�klat�n�z.<br>
 	<b>Ad�m 3: </b>Hasta bulundu�u zaman ilgili alanlarda temel bilgileri g�r�nt�lenir.<br>
 	<b>Ad�m 4: </b>Foto�raflar�n hepsi ya da �o�u ayn� tarihte �ekilmi� ise, o tarihi  <nobr>"<span style="background-color:yellow" > �ekim tarihi</span>"</nobr> alan�na giriniz.<br>
 	<b>Ad�m 5: </b>Bu tarihi t�m foto�raflar i�in ayarlamak isterseniz  <img <?php echo createComIcon('../','preset-add.gif','0') ?>> d��mesini t�klay�n�z. Bu tarih otomatik olarak 
	sol penceredeki  "�ekim tarihi" alanlar�nda g�r�lecektir.<p>
 	<img <?php echo createComIcon('../','warn.gif','0') ?>><b> Uyar�! </b>Foto�raflardan biri ya da birka��n�n farkl� �ekim tarihleri var ise o tarihi ilgili foto�raf�n  "�ekim tarihi" alan�na giriniz. Bunu ancak 5. ad�mdan sonra yapabilirsiniz.<p>
</ul>
	
	<?php endif ?>	
<?php if($src=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ayn� hastan�n ba�ka foto�raflar�n� da kaydetmek istiyorum. Nas�l yap�l�r?</b>
</font>
<ul>	
	<b>Ad�m 1: </b>Kaydetmek istedi�iniz foto�raflar�n say�s�n� <nobr>"Ayn� hastan�n ek <input type="text" name="g" size=3 maxlength=2> foto�raf� <span style="background-color:yellow" > . </span>"</nobr> alan�na giriniz.<br>
 	<b>Ad�m 2: </b><input type="button" value="Git"> d��mesini t�klay�n�z.<br>
</ul>

	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir ba�ka hastan�n resimlerini kaydetmek istiyorum. Nas�l yap�l�r?</b>
</font>
<ul>	
	<b>Ad�m 1: </b>Kaydetmek istedi�iniz foto�raflar�n say�s�n� bir ba�ka hastan�n <nobr>" <input type="text" name="g" size=3 maxlength=2> foto�raf� <span style="background-color:yellow" >  </span>"</nobr> alan�na giriniz.<br>
 	<b>Ad�m 2: </b> <input type="button" value="Git"> d��mesini t�klay�n�z.<br>
</ul>

	<?php endif ?>	
	


	</form>

