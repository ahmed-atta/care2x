<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
if($x2=="pharma") print "Eczane - "; else print "T�bbi ambar - ";
	switch($src)
	{
	case "head": if($x2=="pharma") print "Farmas�tik �r�nlerin istemi"; 
						else print "�r�nlerin istemi";
						break;
	case "catalog": print "�stem katalo�u";
						break;
	case "orderlist": print "�stem sepeti ( istem listesi )";
						break;
	case "final": print "Son istem listesi";
						break;
	case "maincat": print "�stem katalo�u";
						break;
	case "arch": print "�stem ar�ivi";
						break;
	case "archshow": print "�stem ar�ivi";
						break;
	case "db": switch($x3)
					{
						case "input": print "Veri bankas�na yeni �r�n giri�i";
						break;
					}
					break;
	case "how2":print "Nas�l istem yapmal� ";
						  if($x2=="pharma") print "farmas�tik �r�nler"; else print "�r�nler";
	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="maincat") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir kalem malzeme istem katalo�una nas�l eklenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>�nce malzemeyi bulmal�s�n�z.  Malzemenin marka ismi, jenerik ismi, sipari� numaras� vb bilgisinin ya tamam�n� ya da birka� harfini 
				<nobr><span style="background-color:yellow" >" Bir anahtar s�zc�k ara: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alan�na giriniz.<br>
 	<b>Ad�m 2: </b>Malzemeyi bulmak i�in  <input type="button" value="Malzemeyi bul"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 3: </b>Arama sonunda anahtar s�zc���n tam kar��l��� bulunur ise , malzemenin ayr�nt�l� bir tan�m� g�r�nt�lenir. <br>
 	<b>Ad�m 4: </b>Malzemeyi katalo�a eklemek i�in <input type="button" value="Bu malzemeyi katalo�a koy"> d��mesini t�klay�n�z.<p>
 	<b>Uyar�: </b>Bu malzemeyi katalo�a koymak istemez iseniz, bir ba�ka malzemeyi aramaya devam ediniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Aramaya nas�l devam edilir?</b>
</font>
<ul>       	
 	Yukar�da malzemeyi bulmak i�in belirtilen y�nergeyi izleyiniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arama benim anahtar s�zc���me yak�n birka� sonu� buldu. Ne yapmal�y�m?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Arama anahtar s�zc��e yak�n bir veya birka� malzeme bulur ise, bir liste g�r�nt�lenir..<br>
 	<b>Ad�m 2: </b><img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>> D��mesini t�klay�n�z. Malzeme katalog listesine eklenir.<br>
 	<b>Ad�m 3: </b>Malzeme hakk�ndaki tam bilgiyi g�rmek ister iseniz, ya ismini veya d��mesini t�klay�n�z <img <?php echo createComIcon('../','info3.gif','0') ?>>.<br>
 	<b>Ad�m 4: </b>Malzemenin tam bilgisi g�r�nt�lenir.<br>
 	<b>Ad�m 5: </b> <input type="button" value="Bu malzemeyi katalo�a koy"> d��mesini t�klay�n�z.<p>
</ul>
	

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Malzeme hakk�nda daha fazla bilgi g�rmek istiyorum. Ne yapmal�y�m?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Ya malzemenin ismini ya da  <img <?php echo createComIcon('../','info3.gif','0') ?>> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>�r�n�n tam bilgisi g�r�nt�lenir.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir malzeme katalog listesinden nas�l ��kar�l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Malzemenin <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> d��mesini t�klay�n�z.<br>
</ul>

<?php endif ?>

<?php if($src=="how2") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
 <?php if($x2=="pharma") print "Farmas�tik �r�nler"; else print "T�bbi ambardan �r�nler"; ?>   nas�l istem yap�l�r?
</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>�steme ge�mek i�in men�den  "<span style="background-color:yellow" > <img <?php echo createComIcon('../','bestell.gif','0') ?>> �stem </span>" se�ene�ini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Daha �nce giri� yapt� iseniz, istem sepeti ve istem katalo�u g�r�nt�lenir. Daha �nce giri� yapmad� iseniz kullan�c� ad� ve �ifre sorulur.<br>

 	<b>Ad�m 3: </b>E�er sorulur ise, kullan�c� ad� ve �ifrenizi giriniz. <img <?php echo createLDImgSrc('../','continue.gif','0') ?>> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 4: </b>Bir istem listesi olu�turmaya ba�lay�n�z. Sa� �er�evede b�l�m, servis veya ameliyathaneniz i�in istem katalo�unu g�receksiniz. <p>
 	<b>Ad�m 5: </b>Gereksiniminiz olan malzeme katalog listesinde ise, sol �er�evedeki sepete (istem listesine) malzemeden <b>bir adet</b> koymak i�in  <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> d��mesine t�klay�n�z.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�stem sepetine bir malzemeden birden fazla say�da koymak istiyorum. Nas�l yap�l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Se�mek i�in ilgili malzemenin <input type="checkbox" name="a" value="a" checked> se�im d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Malzemenin ilgili  " Pcs. <input type="text" name="d" size=2 maxlength=2> " alan�na par�a say�s�n� giriniz.<br>
 	<b>Ad�m 3: </b>Malzemeyi sepete (istem listesine) koymak i�in <input type="button" value="Sepete koy"> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Gereksinimim olan malzeme katalog listesinde yok. Ne yapmal�y�m?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Malzemeyi bulmal�s�n�z. Malzemenin marka ad�, jenerik ad�, sipari� numaras� vb bilgisinin ya tamam�n� ya da ba�tan birka� harfini 
				<nobr><span style="background-color:yellow" >" Aranan anahtar s�zc�k: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alan�na giriniz.<br>
 	<b>Ad�m 2: </b>Malzemeyi bulmak i�in <input type="button" value="Malzemeyi bul"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 3: </b>Arama malzemeyi veya aranan anahtar s�zc��e yak�n bir malzemeyi  bulur ise bir liste g�r�nt�lenir. <br>
 	<b>Ad�m 4: </b>�stem sepetine malzemenin bir adedini koymak ister iseniz, <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> d��mesini t�klay�n�z. Malzeme sepete konulur ve ayn�s� katalog listesine de eklenir.<br>
 	<b>Ad�m 5: </b>Malzemeyi sadece katalog listesine eklemek ister iseniz <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Malzeme hakk�nda daha fazla bilgi g�rmek istiyorum. Ne yapmal�y�m?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Ya malzemenin ismini veya  <img <?php echo createComIcon('../','info3.gif','0') ?>> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>�r�n hakk�nda t�m bilgileri g�steren bir pencere a��l�r.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Katalog listesinden bir �r�n nas�l silinir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Malzemenin <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�stem sepetindeki par�a say�s�n� de�i�tirebilir miyim?
</b>
</font>
<ul>       	
 	<b>Evet.</b> �stem listesini sonland�rmadan �nce sadece par�a say�s� girdilerini d�zenlemeniz yeterli olur.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Gereksinimim olan t�m malzemeler �imdi sepette. Sonra ne yapmal�y�m?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>�stem listesini  <?php if($x2=="pharma") print "eczaneye"; else print "t�bbi ambara"; ?> g�nderebilirsiniz. <br>��leme ba�lamak i�in <input type="button" value="�stem listesini sonland�r"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>�stem listesi tekrar g�r�nt�lenir. �sminizi<nobr>"<span style="background-color:yellow" > Olu�turan <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alan�na giriniz.<br>
 	<b>Ad�m 3: </b>�stemin �ncelik durumunu "<span style="background-color:yellow" > Normal<input type="radio" name="x" value="s" checked> Acil<input type="radio" name="x" > </span>" aras�ndan se�iniz. Uygun kutuyu i�aretleyiniz.<br>
 	<b>Ad�m 4: </b>Onaylayan (doktor veya cerrah) ismini <nobr>"<span style="background-color:yellow" > Onaylayan <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alan�na girmelidir.<br>
 	<b>Ad�m 5: </b>Onaylayan (doktor veya cerrah) �ifresini <nobr>"<span style="background-color:yellow" > �ifre: <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alan�na girmelidir.<br>
 	<b>Ad�m 6: </b>�stem listesini g�ndermek i�in  <input type="button" value="Bu istem listesini <?php if($x2=="pharma") print "eczaneye"; else print "t�bbi ambara"; ?> g�nder."> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 �stem listesini g�ndermeyi iptal etmeye karar verir iseniz, istem listesine geri gitmek i�in  "<span style="background-color:yellow" > Geri ve listeyi d�zenle </span>" ba�lant�s�n� t�klay�n�z.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�imdi istem vermeyi sonland�rmak istiyorum. Ne yapmal�y�m?</b>
</font>
<ul>     
 	<b>Ad�m 1: </b> <?php if($x2=="pharma") print "Eczane"; else print "T�bbi ambar"; ?> alt men�s�ne geri gitmek i�in  "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> �stem son </span>" ba�lant�s�n� t�klay�n�z.<br>
</ul>	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir istem listesi olu�turmak istiyorum. Ne yapmal�y�m?</b>
</font>
<ul>     
 	<b>Ad�m 1: </b>Bo� bir istem sepeti olu�turmak i�in  "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> Yeni bir istem listesi ba�lat </span>"  ba�lant�s�n� t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 �stem sepeti veya katalog listesi hakk�nda pencere i�erisindeki  <img <?php echo createComIcon('../','frage.gif','0') ?>> d��mesini t�klayarak ayr�nt�l� bilgi alabilirsiniz.
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php endif ?>


<?php if($src=="head") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<?php if($x2=="pharma") print "Farmas�tik �r�nler"; 
						else print "T�bbi ambardan �r�nler"; ?> nas�l istem yap�l�r?
</b>
</font>
<ul>       	

 	<b>Ad�m 1: </b>�nce istem listesi olu�turunuz. Sa� �er�evede b�l�m, servis veya ameliyathaneniz i�in istem katalo�unu g�receksiniz. <p>
 	<b>Ad�m 2: </b>Gereksiniminiz olan malzeme katalog listesinde ise, sol �er�evedeki sepete (istem listesine) malzemeden <b>bir adet</b> koymak i�in  <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> d��mesine t�klay�n�z.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�stem sepetine bir malzemeden birden fazla say�da koymak istiyorum. Nas�l yap�l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Se�mek i�in ilgili malzemenin <input type="checkbox" name="a" value="a" checked> se�im d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Malzemenin ilgili  " Pcs. <input type="text" name="d" size=2 maxlength=2> " alan�na par�a say�s�n� giriniz.<br>
 	<b>Ad�m 3: </b>Malzemeyi sepete (istem listesine) koymak i�in <input type="button" value="Sepete koy"> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 Pencere i�erisinde <img <?php echo createComIcon('../','frage.gif','0') ?>> d��mesini t�klayarak istem sepeti veya katalog listesi hakk�nda ayr�nt�l� bilgi edinebilirsiniz.
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php endif ?>

<?php if($src=="catalog") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir malzeme sepete (istem listesine) nas�l konur?
</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>�htiyac�n�z olan malzeme katalog listesinde ise malzemeden <b>bir kalem</b> sol �er�evedeki istem listesine (sepet) koymak i�in  <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> d��mesine t�klay�n�z.<p>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�stem sepetine bir �r�nden birden fazla say�da koymak istiyorum. Nas�l yap�l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Se�mek i�in malzemeye kar��l�k gelen <input type="checkbox" name="a" value="a" checked> se�me d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Par�a say�s�n�  malzemenin ilgili " par�a <input type="text" name="d" size=2 maxlength=2> " alan�na giriniz.<br>
 	<b>Ad�m 3: </b>Malzemeyi sepete (istem listesine) koymak i�in  <input type="button" value="Sepete koy"> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Gereksindi�im malzeme katalog listesinde yok. Ne yapmal�y�m?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Malzemeyi bulmal�s�n�z. Malzemenin marka, veya jenerik isim, veya sipari� numaras� bilgisinin ya tamam�n� veya birka� harfini  
				<nobr><span style="background-color:yellow" >" Aranacak anahtar s�zc�k: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alan�na giriniz.<br>
 	<b>Ad�m 2: </b>Malzemeyi bulmak i�in  <input type="button" value="Malzemeyi bul"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 3: </b>Arama malzemeyi bulur ise veya arama anahtar s�zc���ne yak�n bir �r�n bulunur ise bir liste g�r�nt�lenir.<br>
 	<b>Ad�m 4: </b>E�er malzemeden bir par�a istem sepetine koymak ister iseniz  <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> d��mesine t�klay�n�z. Malzeme sepete konur ve ayn� zamanda katalog listesine eklenir.<br>
 	<b>Ad�m 5: </b>Malzemeyi sadece katalog listesine eklemek ister iseniz, <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Malzeme hakk�nda daha fazla bilgi g�rmek istiyorum. Ne yapmal�y�m?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Ya  <img <?php echo createComIcon('../','info3.gif','0') ?>> d��mesini veya malzemenin ismini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Malzeme hakk�ndaki t�m bilgileri g�steren bir pencere a��l�r.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir malzeme katalog listesinden nas�l silinir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Malzemenin <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> d��mesine t�klay�n�z.<br>
</ul>

<?php endif ?>

<?php if($src=="orderlist") : ?>
	<?php if($x1=="0") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 Halen sepet bo�.<p>
 Bir istem listesi olu�turmak i�in, gereksiniminiz olan malzemeyi sa� �er�evedeki katalog listesinden se�ip sepete koyunuz.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Malzeme sepete (istem listesine) nas�l konulur?
</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Gereksiniminiz olan malzeme katalog listesinde ise, malzemeden <b>bir adet</b> istem listesine (sepete) koymak i�in  <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> d��mesini t�klay�n�z.<br> �stem listesi otomatik olarak soldaki sepet �er�evesinde g�r�nt�lenir.<p>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 Katalog listesinden sepete malzemelerin aranmas�, se�ilmesi ve konulmas� konusunda ayr�nt�l� bilgi i�in sa�daki istem katalog �er�evesi i�erisindeki  <img <?php echo createComIcon('../','frage.gif','0') ?>> d��mesini t�klay�n�z.<p>
</ul>

	<?php else : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�stem sepetindeki par�a say�s�n� de�i�tirebilir miyim?
</b>
</font>
<ul>       	
 	<b>Evet.</b> �stem listesini sonland�rmadan �nce par�a say�s� girdisini de�i�tirmeniz yeterli.
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Malzeme konusunda daha fazla bilgi g�rmek istiyorum. Ne yapmal�y�m?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Malzemenin <img <?php echo createComIcon('../','info3.gif','0') ?>> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>�r�n hakk�ndaki t�m bilgileri g�steren bir pencere a��l�r.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir malzeme sepetten nas�l ��kar�l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Malzemenin  <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Gereksindi�im t�m malzemeler �imdi sepette. Sonra ne yapmal�y�m?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>�stem listesini eczaneye g�nderebilirsiniz. <br>��lemi ba�latmak i�in  <input type="button" value="�stem listesini sonland�r"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>�stem listesi tekrar g�r�nt�lenir. �sminizi <nobr>"<span style="background-color:yellow" > Olu�turan <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alan�na yaz�n�z.<br>
 	<b>Ad�m 3: </b>�stemin �ncelik durumunu  "<span style="background-color:yellow" > Normal<input type="radio" name="x" value="s" checked> Acil<input type="radio" name="x" > </span>" aras�ndan se�iniz. Uygun se�im kutusunu i�aretleyiniz.<br>
 	<b>Ad�m 4: </b>Onaylayan (doktor veya cerrah) ismini <nobr>"<span style="background-color:yellow" > Onaylayan <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alan�na girmelidir.<br>
 	<b>Ad�m 5: </b>Onaylayan (doktor veya cerrah) �ifresini <nobr>"<span style="background-color:yellow" > �ifre: <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alan�na girmelidir.<br>
 	<b>Ad�m 6: </b>�stem listesini g�ndermek i�in  <input type="button" value="Bu istem listesini eczaneye g�nder"> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 �stem listesini g�ndermeyi iptal etmeye karar verir iseniz, "<span style="background-color:yellow" > Geri git ve listeyi d�zenle </span>" ba�lant�s�n� t�klay�n�z.
</ul>
	<?php endif ?>

<?php endif ?>


<?php if($src=="final") : ?>
	<?php if($x1=="1") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�stemi sonland�rmak istiyorum. Ne yapmal�y�m?</b>
</font>
<ul>     
 	<b>Ad�m 1: </b>Eczane alt men�s�ne geri d�nmek i�in  "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> �stem sonu </span>" ba�lant�s�n� t�klay�n�z.<br>
</ul>	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir istem listesi olu�turmak istiyorum. Ne yapmal�y�m?</b>
</font>
<ul>     
 	<b>Ad�m 1: </b>Bo� bir istem sepeti olu�turmak i�in "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> Yeni bir istem listesi ba�lat </span>" ba�lant�s�n� t�klay�n�z.<br>
</ul>		<?php else : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Sonland�r�lm�� istem listesi nas�l g�nderilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>�sminizi <nobr>"<span style="background-color:yellow" > Olu�turan <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alan�na yaz�n�z.<br>
 	<b>Ad�m 2: </b>�stemin �ncelik durumunu  "<span style="background-color:yellow" > Normal<input type="radio" name="x" value="s" checked> Acil<input type="radio" name="x" > </span>" aras�ndan se�iniz. Uygun se�im kutusunu i�aretleyiniz.<br>
 	<b>Ad�m 3: </b>Onaylayan (doktor veya cerrah) ismini <nobr>"<span style="background-color:yellow" > Onaylayan <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alan�na girmelidir.<br>
 	<b>Ad�m 4: </b>Onaylayan (doktor veya cerrah) �ifresini <nobr>"<span style="background-color:yellow" > �ifre: <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alan�na girmelidir.<br>
 	<b>Ad�m 5: </b>�stem listesini g�ndermek i�in  <input type="button" value="Bu istem listesini eczaneye g�nder"> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 �stem listesini g�ndermeyi iptal etmeye karar verir iseniz, "<span style="background-color:yellow" > Geri git ve listeyi d�zenle </span>" ba�lant�s�n� t�klay�n�z.
</ul>
	<?php endif ?>

<?php endif ?>
<!-- ++++++++++++++++++++++++++++++++++ archive ++++++++�eviren Op. Dr. B�lent Potur ++++++++++++++ -->
<?php if($src=="arch") : ?>


<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Ar�ivdeki istem listelerini g�rmek istiyorum.</b></font>
<ul>  	<b>Ad�m 1: </b> B�l�m ad�, k�saltmas�, istem tarihi, �ncelik ("acil") bilgilerinin tamam�n� vaya ilk birka� harfini 
				<nobr><span style="background-color:yellow" >" Aranacak anahtar s�zc�k: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alan�na giriniz.<br>
 	<b>Ad�m 2: </b>Arama kategorilerine g�re izleyen kutular� se�iniz veya se�imden ��kar�n�z:
<ul> 	
  	<input type="checkbox" name="d" checked> Tarih<br>
	<input type="checkbox" name="d" checked> B�l�m<br>
  	<input type="checkbox" name="d" checked> �ncelik<br>
	�n se�imli olarak kutular�n ��� de se�ilir ve arama her �� kategoride yap�l�r. Bir kategoriyi d��ar�da tutmak ister iseniz kutusuna t�klay�p se�imden ��kar�n�z.
</ul> 	
<b>Ad�m 3: </b>Malzemeyi bulmak i�in <input type="button" value="Ara"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 4: </b>Arama aranan anahtar s�zc��e yakla��k bir sonu� bulur ise bir liste g�r�nt�lenir. .<br>
 	<b>Ad�m 5: </b>�stemin liste d��mesini t�klay�n�z <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>>. �stemin ayr�nt�lar� g�r�nt�lenir<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Birka� istem listelendi. Belirli bir istem nas�l g�r�l�r?</b></font>
<ul>  	
 	<b>Ad�m 1: </b>�stemin d��mesini t�klay�n�z <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>>. �stemin ayr�nt�lar� g�r�nt�lenir<br>
</ul>

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 Aramay� sonland�r�p kapatmaya karar verir iseniz, <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>


	<?php endif ?>
	
<?php if($src=="archshow") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�stem listesindeki bir malzeme hakk�nda daha fazla bilgi g�rmek istiyorum. Ne yapmal�y�m?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Malzemenin <img <?php echo createComIcon('../','info3.gif','0') ?>> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>�r�n hakk�ndaki t�m bilgileri g�steren bir pencere a��l�r.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Tekrar ar�ivdeki istemlerin listesini g�rmek istiyorum. Ne yapmal�y�m?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> <img <?php echo createLDImgSrc('../','back2.gif','0') ?>> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Ar�ivdeki istem listesinde yeni bir arama yapmak istiyorum. Ne yapmal�y�m?</b></font>
<ul>  	<b>Ad�m 1: </b> B�l�m ad�, k�saltmas�, istem tarihi, �ncelik ("acil") bilgilerinin tamam�n� vaya ilk birka� harfini 
				<nobr><span style="background-color:yellow" >" Aranacak anahtar s�zc�k: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alan�na giriniz.<br>
 	<b>Ad�m 2: </b>Arama kategorilerine g�re izleyen kutular� se�iniz veya se�imden ��kar�n�z:
<ul> 	
  	<input type="checkbox" name="d" checked> Tarih<br>
	<input type="checkbox" name="d" checked> B�l�m<br>
  	<input type="checkbox" name="d" checked> �ncelik<br>
	�n se�imli olarak kutular�n ��� de se�ilir ve arama her �� kategoride yap�l�r. Bir kategoriyi d��ar�da tutmak ister iseniz kutusuna t�klay�p se�imden ��kar�n�z.
</ul> 	
<b>Ad�m 3: </b>Malzemeyi bulmak i�in <input type="button" value="Ara"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 4: </b>Arama aranan anahtar s�zc��e yakla��k bir sonu� bulur ise bir liste g�r�nt�lenir.<br>
</ul>
	<?php endif ?>	
	

<?php if($src=="db") : ?>
	<?php if($x1=="") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bilgi bankas�na bir �r�n nas�l girilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>�nce �r�n hakk�nda bulunan t�m bilgileri ilgili giri� alanlar�na giriniz.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�r�n�n bir resmini se�mek istiyorum. Nas�l yap�l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>"<span style="background-color:yellow" > Resim dosyas� </span>" alan�ndaki <input type="button" value="Ara�t�r..."> d��mesini t�klay�n�z. <br>
 	<b>Ad�m 2: </b>Bir doaya se�mek i�in k���k bir pencere a��l�r. �stedi�iniz resim dosyas�n� se�iniz ve "Tamam" � t�klay�n�z.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bulunan t�m �r�n bilgisini girmeyi bitirdim. Nas�l kay�t edilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> <input type="button" value="Kaydet"> d��mesini t�klay�n��z.<br>
</ul>
	<?php endif ?>	
	<?php if($x1=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir �r�n bilgi bankas�na nas�l girilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b><input type="button" value="Yeni �r�n"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Giri� formu g�r�nt�lenir.<br>
 	<b>Ad�m 3: </b>Yeni �r�n�b bilgilerini giriniz.<br>
 	<b>Ad�m 4: </b>Bilgiyi kay�t etmek i�in  <input type="button" value="Kaydet"> d��mesini t�klay�n�z.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
G�r�nt�lenen �r�n�n bilgisini d�zenlemek istiyorum. Nas�l yap�l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> <input type="button" value="G�ncelle veya d�zenle"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>�r�n bilgisi d�zenleme formuna otomatik olarak girilir.<br>
 	<b>Ad�m 3: </b>Bilgiyi d�zenleyiniz.<br>
 	<b>Ad�m 4: </b>Yeni bilgiyi kay�t etmek i�in  <input type="button" value="Kaydet"> d��mesini t�klay�n�z.<br>
</ul>
	
	<?php endif ?>	
<?php endif ?>	
</form>

