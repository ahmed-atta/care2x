<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
switch($x2)
{
	case "search": print "Nas�l "; 
 						if($x1) print 'bir anahtar s�zc�k bulundu�unda servis yatan hasta listesi g�sterilir';
						else  print 'bir hasta aran�r';
						break;
	case "quick": print  "Bug�nk� servis yatan hasta listesi h�zl� bak��";
						break;
	case "arch": print "Servisler ar�ivi";
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($x2=="search") : ?>
<?php if(!$x1) : ?>
<b>Ad�m 1</b>

<ul>  "<span style="background-color:yellow" >L�tfen aranacak bir anahtar s�zc�k giriniz.</span>" 
	alan�na bir ad veya soyad�n tamam�n� veya ilk birka� harfini giriniz.
		<ul type=disc><li>�rnek 1:  "G�rcan" veya "g�r" giriniz.
		<li>�rnek 2: "Potur" veya "Pot" giriniz.
		<li>�rnek 3: "Potur, G�rcan" giriniz.
	</ul>	
</ul>
<b>Ad�m 2</b>
<ul> Aramay� ba�latmak i�in <input type="button" value="Ara"> d��mesini t�klay�n�z.<p>
</ul>
<b>Ad�m 3</b>
<ul> E�er arama bir sonu� bulur ise, anahtar s�zc���n bulundu�u yatan hasta listesi g�r�nt�lenir.<p>
</ul>
<b>Ad�m 4</b>
<ul> E�er arama birka� sonu� bulur ise, sonu�lar listesi g�r�nt�lenir.<p>
</ul>
<b>Uyar�</b>
<ul> Aramay� iptal etmek ister iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
</ul><?php endif ?>
<b>Ad�m <?php if($x1) print "1"; else print "5"; ?></b><ul>Servis yatan hasta listesini g�rmek i�in ya <img <?php echo createComIcon('../','bul_arrowblusm.gif','0') ?>> d��mesini, veya tarih veya servisi t�klay�n�z.
<p><b>Uyar�:</b> Aranan s�zc�k listede belirginle�tirilmi� olarak g�r�nt�lenir. 
<br><b>Uyar�:</b> Liste "salt okunur" moddad�r, d�zenlenemez. E�er hastan�n ismini t�klayarak bilgileri klas�r�n� a�mak ister iseniz kullan�c� ad� ve parolan�z sorulur.
</ul>
<?php endif ?>
<?php if($x2=="quick") : ?>
	<?php if($x1) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Di�er g�nlerin yatan hasta listeleri nas�l g�r�nt�lenir?</b>
</font>
<ul>       	
 	<b>Ad�m: </b>Mini takvimde tarihi t�klay�n�z.<p>
	<img src="../help/tr/img/tr_mini_calendar_php.png" border=0 width=223 height=133><p>
	<b>Uyar�: </b>G�r�nt�lenen eski hasta listesi "salt okunur" dur. Hasta bilgisini de�i�tiremez ve d�zenleyemezsiniz.<br>
	</ul>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Servis yatan hasta listesi nas�l g�r�nt�lenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Sol s�tundaki servis kimli�i ya da ismini t�klay�n�z.<br>
	<b>Uyar�: </b>G�r�nt�lenen hasta listesi "salt okunur" dur. Hasta bilgisini de�i�tiremez ve d�zenleyemezsiniz.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Servis yatan hasta listesi d�zenlemek veya g�ncellemek �zere nas�l g�sterilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Se�ilen servisin ilgili  <img <?php echo createComIcon('../','statbel2.gif','0') ?>> simgesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Daha �nce giri� yapt� iseniz, ve i�leve eri�im hakk�n�z bulunuyor ise, yatan hasta listesi derhal g�r�nt�lenir.<br>
		Aksi halde, kullan�c� ad� ve �ifrenizi girmeniz istenir.<br>
 	<b>Ad�m 3: </b>Sorulur ise, kullan�c� ad� ve �ifrenizi giriniz.<br>
 	<b>Ad�m 4: </b> <img <?php echo createLDImgSrc('../','continue.gif','0') ?>> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 5: </b>��leve eri�im hakk�n�z var ise, yatan hasta listesi g�r�nt�lenir.<br>
	<b>Uyar�: </b>G�r�nt�lenen yatan hasta listesi "d�zenlenebilir" haldedir. Hasta bilgilerini d�zenleme veya g�ncelleme se�enekleri g�r�nt�lenir.
		Hastalar�n bilgi klas�rlerini de d�zenlemek i�in a�abilirsiniz.<br>
	</ul>
	<?php else : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
�u anda yatan hasta listesi olu�turulmam��</b>
</font><p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ar�iv kullan�larak �nceki yatan hasta listeleri h�zl� bak�� olarak nas�l izlenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> "<span style="background-color:yellow" > Ar�ive gitmek i�in buray� t�klay�n�z <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> </span>" yaz�s�n� t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Bir rehber takvim g�r�nt�lenir.<br>
 	<b>Ad�m 3: </b>O g�n�n yatan hasta listesini g�r�nt�lemek i�in takvimdeki bir tarihi t�klay�n�z.<br>
	</ul>
	
	<?php endif ?>
<b>Uyar�</b>
<ul> H�zl� bak�� penceresini kapatmak ister iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul><?php endif ?>

<?php if($x2=="arch") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ar�iv kullan�larak �nceki yatan hasta listeleri h�zl� bak��ta nas�l izlenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>O g�n�n yatan hastalar�na h�zl� bak�� i�in takvimdeki bir tarihi t�klay�n�z.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Rehber takvimdeki ay nas�l de�i�tirilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Sonraki ay� g�stermek i�in, rehber takvimin �st SA� k��esindeki ay ismini t�klay�n�z
								�stenen ay g�r�nt�leninceye kadar ne kadar gerekirse o kadar t�klay�n�z.<p>
 	<b>Ad�m 2: </b>�nceki ay� g�r�nt�lemek i�in, rehber takvimin SOL �st k��esindeki ay ismini t�klay�n�z.
								�stenen ay g�r�nt�leninceye kadar ne kadar gerekirse o kadar t�klay�n�z.<br>
	</ul>
	
	<?php endif ?>


</form>

