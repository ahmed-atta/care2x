<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Servis Y�netimi 
<?php
switch($src)
{
	case "main": print "";
						break;
	case "new": print  " - Yeni bir servis olu�tur";
						break;
	case "arch": print "Servisler - Ar�iv";
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="main") : ?>

<b>Olu�tur</b>

<ul>Yeni bir servis olu�turmak i�in, bu se�ene�i t�klay�n�z. 
	</ul>	
</ul>
<b>Servisin profil verileri</b>
<ul>Bu se�enek servisin profil ve di�er ilgili bilgilerini g�sterir.
</ul>
<b>Bir yata�� kilitle</b>
<ul>Bir yata�� ya da birka� yata�� birden kilitlemek ister iseniz, bu se�ene�i t�klay�n�z. Girilen servis g�r�nt�lenir, yok ise �n se�imli servis g�r�nt�lenir. Yatak kilitleme i�in ge�erli bir �ifre ve bu �zelli�e eri�im hakk� gerekir.
</ul>
<b>Eri�im haklar�</b>
<ul> Bu se�enekte belirli bir servis i�in eri�im haklar� olu�turabilir, d�zenleyebilir, kilitleyebilir veya silebilirsiniz. Olu�turulan t�m eri�im haklar� sadece o belirli servis i�in ge�erli olur.
</ul>
<?php endif ?>
<?php if($x2=="quick") : ?>
	<?php if($x1) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir servisin yatan hasta listesi nas�l g�r�nt�lenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Sol s�tunda servisin ismi ya da kimli�ini t�klay�n�z.<br>
	<b>Uyar�: </b>G�r�nt�lenen yatan hasta listesi "salt okunur" dur. Hastalar�n bilgilerini de�i�tiremez veya d�zenleyemezsiniz.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Servisin yatan hasta listesi d�zenlemek veya g�ncellemek i�in nas�l g�sterilebilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Se�ilen servisin ilgili <img <?php echo createComIcon('../','statbel2.gif','0') ?>> simgesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Daha �nce giri� yapt� iseniz ve i�leve eri�im hakk�n�z var ise, yatan hasta listesi derhal g�r�n�r.<br>
		Aksi halde,  kullan�c� ad� ve �ifreniz sorulur.<br>
 	<b>Ad�m 3: </b>Sorulur ise, kullan�c� ad� ve �ifrenizi giriniz.<br>
 	<b>Ad�m 4: </b> <input type="button" value="Devam..."> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 5: </b>��leve eri�im hakk�n�z var ise, yatan hasta listesi g�r�nt�lenir. <br>
	<b>Uyar�: </b>G�r�nt�lenen yatan hasta listesi "d�zenlenebilir" durumdad�r. Hastalar�n bilgilerini d�zenleme veya g�ncelleme se�enekleri de g�r�nt�lenir.
		Ayn� zamanda d�zenlemek i�in hastalar�n veri klas�r�n� de a�abilirsiniz.<br>
	</ul>
	<?php else : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
�u anda yatan hasta listesi yok!</b>
</font><p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ar�iv kullan�larak �nceki yatan hasta listelerine h�zl� bak��lar nas�l g�r�nt�lenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> "<span style="background-color:yellow" > Ar�ive gitmek i�in bunu t�klay�n�z <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> </span>" yaz�s�n� t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Bir rehber takvim g�r�nt�lenir.<br>
 	<b>Ad�m 3: </b>Rehber takvimde bir g�n�n tarihini t�klayarak o g�nk� yatan hasta listesini h�zl� bak�� olarak izleyebilirsiniz.<br>
	</ul>
	
	<?php endif ?>
<b>Uyar�</b>
<ul> H�zl� bak��� kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul><?php endif ?>

<?php if($src=="new") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir servis nas�l olu�turulur?</b>
</font>
<ul>
 	<b>Ad�m 1: </b>Servisin resmi ad�n� "<span style="background-color:yellow" > Servis: </span>" alan�na giriniz.<br>
 	<b>Ad�m 2: </b>Servisin kimli�ini (k�sa olmal� ve �zel karakterler i�ermemeli)  "<span style="background-color:yellow" > Servis Kimli�i: </span>" alan�na giriniz.<br>
 	<b>Ad�m 3: </b>Servisin ait oldu�u klinik veya b�l�m�  "<span style="background-color:yellow" > B�l�m: </span>" se�me alan�ndan se�iniz.<br>
 	<b>Ad�m 4: </b>Servisin tan�m� ve di�er bilgileri  "<span style="background-color:yellow" > Tan�m: </span>" alan�na yaz�n�z.<br>
 	<b>Ad�m 5: </b>Servisin ilk odas�n�n numaras�n�  "<span style="background-color:yellow" > �lk odan�n oda numaras�: </span>" alan�na yaz�n�z.<br>
 	<b>Ad�m 6: </b>Son odan�n numaras�n�  "<span style="background-color:yellow" > Son odan�n numaras�: </span>" alan�na yaz�n�z.<br>
 	<b>Ad�m 7: </b>Oda �n ekini  "<span style="background-color:yellow" > Oda �n eki: </span>" alan�na yaz�n�z.<br>
 	<b>Ad�m 8: </b>Servisi olu�turmak i�in <input type="button" value="Servisi olu�tur"> d��mesini t�klay�n�z.<br>
	</ul>
<b>Uyar�</b>
<ul> �ptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir odadaki yatak say�s�n� d�zenleyebilir miyim?</b>
</font>
<ul>
 	<b>Evet. </b>Fakat ancak
	<input type="button" value="Servisi olu�tur"> d��mesine t�klay�p servisi olu�turduktan SONRA yatak say�s�n� girme �ans�n�z olacakt�r.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir yata��n �n ek (veya kimli�i) ini d�zenleyebilir miyim?</b>
</font>
<ul>       	
 	<b>Hay�r. </b>Program�n g�ncel versiyonunda bir yata��n �n eki (veya kimli�i) A, B, C, D vs. sabittir. De�i�tiremezsiniz.<br>
	</ul>
<b>Uyar�</b>
<ul> E�er iptal etmeye karar verir iseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php endif ?>
	
<?php if($src=="show") : ?>
	<?php if($x1=="1") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Servis profili nas�l kay�t edilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> <input type="button" value="Kaydet"> d��mesini t�klay�n�z.<br>
	</ul>
<b>Uyar�</b>
<ul> �ptal etmeye karar verir iseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
</ul>

	<?php else : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�imdi g�r�nt�lenenin d���nda bir servisin profilini d�zenlemek istiyorum. Ne yapmal�y�m?</b>
<p>
</font>
	<b>Uyar�:</b> Bir servisin profilini basit�e d�zenleyemezsiniz. Veri b�t�nl���n� sa�lamak bak�m�ndan bu �ekilde dizayn edilmi�tir. Yeni bir servis profili olu�turmak i�in a�a��daki ad�mlar� izleyiniz:
<ul>

 	<b>Ad�m 1:</b>Servisin ya hastalar� ��kararak ya da ba�ka servislere nakil edilerek tamamen bo� olmas�n� sa�lay�n�z.<p>
 	<b>Ad�m 2:</b> Servisi kapatmak i�in <input type="button" value="Bu servisi kesin olarak kapat"> d��mesini t�klay�n�z.<p>
	<b>Ad�m 3:</b> Servis y�netim mod�l�nde "Olu�tur" se�ene�ini kullanarak yeni bir servis olu�turunuz.<p>
	</ul>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir servisi "ge�ici olarak kapatma" n�n amac� nedir?</b>
<p>
</font>
	<ul>

 	<b>Yan�t:</b> Bir servis belirli bir s�re i�in hasta kabul etmeyecek ise ge�ici olarak kapat�l�r. �rne�in tadilat, onar�m, dezenfeksiyon, dekontaminasyon, vs. �al��malar� nedeni ile.
	</ul>

<b>Uyar�</b>
<ul> �ptal etmek ister iseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
</ul>

<?php endif ?>
<?php endif ?>


<?php if($src=="") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir servis profilini g�rmek i�in nas�l se�ilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>G�rmek istedi�iniz servise liste �zerinde t�klay�n�z.<br>
	</ul>
<b>Uyar�</b>
<ul> �ptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
</ul>

<?php endif ?>


</form>

