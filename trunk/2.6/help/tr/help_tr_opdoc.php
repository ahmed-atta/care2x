<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Ameliyathane Belgelendirme - 
<?php
if($src=="create")
{
	switch($x1)
	{
	case "dummy": print "Yeni belge olu�tur";
						break;
	case "saveok": print  " - Belge kay�t edildi";
						break;
	case "update": print "Bu belgeyi g�ncelle";
						break;
	case "search": print "Bir hasta ara";
						break;
	case "paginate": print  "Arama sonu�lar� listesi";
						break;
	}
}
if($src=="search")
{
	switch($x1)
	{
	case "dummy": print "Bir belge ara";
						break;
	case "": print "Bir belge ara";
						break;
	case "paginate": print  "Arama sonu�lar� listesi";
						break;
	case "match": print  "Arama sonu�lar� listesi";
						break;
	case "select": print "G�ncel belge";
	}
}
if($src=="arch")
{
	switch($x1)
	{
	case "dummy": print "Ar�iv";
						break;
	case "": print "Ar�iv";
						break;
	case "?": print "Ar�iv";
						break;
	case "search": print  "Ar�iv arama sonu�lar� listesi";
						break;
	case "select": print "G�ncel belge";
	}
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php

if($src=="create") { 
	
	if($x1=='search'||$x1=='paginate'){
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Belgesi yaz�lacak hasta nas�l se�ilir?</b>
</font>
<ul>       	
 	<b>Uyar�: </b> Hastan�n soyad�n� veya <img <?php echo createLDImgSrc('../','ok_small.gif','0') ?>> d��mesini t�klay�n�z.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni hasta aramas� nas�l ba�lat�l�r?</b>
</font>
<ul>       	
 	<b>Uyar�: </b>  <img <?php echo createLDImgSrc('../','document-blue.gif','0') ?>> sekmesini t�klay�n�z.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
B�l�m nas�l de�i�tirilir?</b>
</font>
<ul>       	
 	<b>Uyar�: </b> Sayfan�n sol alt k�sm�ndaki "B�l�m� de�i�tir" ba�lant�s�n� t�klay�n�z. <p> 
</ul>
<?php
	}

	 if($x1=="saveok") { 
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
G�ncel belge nas�l d�zenlenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>D�zenleme moduna ge�mek i�in  <input type="button" value="Bilgiyi g�ncelle"> d��mesini t�klay�n�z.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir belgeye nas�l ba�lan�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> <input type="button" value="Yeni bir belgeye ba�la"> d��mesini t�klay�n�z.<br>
	</ul>
<b>Uyar�</b>
<ul> Kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>

<?php } ?>

<?php if($x1=="update") { ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
A��k olan belge nas�l d�zenlenir veya g�ncellenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>D�zenleme moduna ge�ildi�i zaman, bilgileri g�ncelleyebilirsiniz.<br> 
 	<b>Ad�m 2: </b>Belgeyi kay�t etmek i�in,  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br> 
	</ul>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hangi bilgilerin girilmesi zorunludur?</b>
</font>
<ul>       	
 	<b>Uyar�: </b>T�m k�rm�z� alanlar zorunludur.<br> 
	</ul>
	
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php } ?>
<?php if($x1=="dummy") { ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir belge nas�l olu�turulur?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>�nce hastay� bulunuz. Arama giri� alan�na hastan�n soyad veya ad�n�n tamam�n� veya ilk birka� harfini giriniz.<br>
 	<b>Ad�m 2: </b>Hastay� aramaya ba�lamak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> d��mesini t�klay�n��z.<p> 
<ul>       	
 	<b>Uyar�: </b>E�er arama bir tek sonu� bulur ise, hastan�n temel bilgileri ilgili alanlara otomatik olarak girilir.<p> 
 	<b>Uyar�: </b>Arama birka� sonu� bulur ise ,  bir liste g�r�nt�lenir. Belge yazmak �zere se�mek i�in hastan�n soyad�n� t�klay�n�z.<p> 
	</ul>
 	<b>Ad�m 3: </b>Hastan�n temel bilgileri g�r�nt�lendi�i zaman, ameliyat ile ilgili ek bilgileri ilgili alanlara girebilirsiniz.<br> 
 	<b>Ad�m 4: </b>Belgeyi kay�t etmek i�in, <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br> 
	</ul>
	<?php } ?>
<?php } ?>



<?php if($src=="search") : ?>
	<?php if(($x1=="dummy")||($x1=="")) : ?>


<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Belirli bir hastan�n bir belgesi nas�l aran�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> "<span style="background-color:yellow" > Aranacak anahtar s�zc�k: ad veya soyad <input type="text" name="m" size=20 maxlength=20> </span>" alan�na bir hastan�n ad veya soyad�n�n tamam�n� veya ba�tan birka� harfini giriniz. <br>
 	<b>Ad�m 2: </b>Hastan�n belgesini aramaya ba�lamak i�in  <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> d��mesini t�klay�n�z.<p> 
<ul>       	
<!--  	<b>Uyar�: </b>Arama bir sonu� bulur ise, hastan�n belgesi derhal g�r�nt�lenir.<p> 
 --> 	<b>Uyar�: </b>Arama birka� sonu� bulur ise, bir liste g�r�nt�lenir. Hastay� belge yazmak �zere se�mek i�in soyad�, veya ameliyat tarihi, veya ameliyat numaras� �zerine t�klay�n�z.<p> 
	</ul>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
	<?php endif ?>
<?php if(($x1=="match"||$x1=='paginate')&&($x2>0)) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
G�r�nt�lemek �zere belirli bir belge nas�l se�ilir?</b>
</font>
<ul>       	
 	<b>Uyar�: </b> Belgesini g�r�nt�lemek i�in hastan�n soyad�na, veya ameliyat tarihine, veya ameliyat numaras�na t�klay�n�z.<p> 
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Liste nas�l s�ralan�r?</b>
</font>
<ul>       	
 	<b>Uyar�: </b> Listenin s�ralanmas�n� istedi�iniz s�tununun ba�l���na t�klay�n�z.<p> 
	�rnek: Listeyi ameliyat tarihine g�re s�ralamak ister iseniz:<p>
	<blockquote>
	<img src='../help/tr/img/tr_or_search_sort.png'>
	</blockquote>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Aramaya nas�l devam edilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> "<span style="background-color:yellow" > Aranan anahtar s�zc�k: ad veya soyad <input type="text" name="m" size=20 maxlength=20> </span>" alan�na hastan�n ad veya soyad�n�n ya tamam��n� veya ilk birka� harfini giriniz. <br>
 	<b>Ad�m 2: </b>Hastan�n belgesini aramaya ba�lamak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> d��mesini t�klay�n�z.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�: </b></font> 
<ul>       	
 Kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
	<?php endif ?>
<?php if(($x1=="select")&&($x2==1)) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
G�ncel belge nas�l d�zenlenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>D�zenleme moduna ge�mek i�in <img <?php echo createLDImgSrc('../','update_data.gif','0') ?>> d��mesini t�klay�n�z.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Aramaya nas�l devam edilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> "<span style="background-color:yellow" > Aranacak anahtar s�zc�k: ad veya soyad <input type="text" name="m" size=20 maxlength=20> </span>" alan�na hastan�n ad veya soyad�n�n ya tamam�n� ya da ba�tan birka� harfini giriniz. <br>
 	<b>Ad�m 2: </b>Hastan�n belgesini aramaya ba�lamak i�in  <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> d��mesini t�klay�n�z.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>

<?php endif ?>
<?php endif ?>

<?php if($src=="arch") : ?>
	<?php if(($x1=="dummy")||($x1=="?")||($x1=="")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir tarihte yap�lm�� ameliyatlar�n t�m belgelerini listelemek istiyorum</b></font>
<ul> <b>Ad�m 1: </b> "<span style="background-color:yellow" > Ameliyat tarihi: </span>" alan�na ameliyat�n tarihini giriniz. <br>
		<ul><font size=1 color="#000099">
		<!-- <b>�pucu:</b> Otomatik olarak bug�n�n tarihini girmek i�in "T" veya "t" giriniz.<br>
		<b>�pucu:</b> D�nk� tarihi otomatik olarak girmek i�in "Y" veya "y" giriniz.<br> -->
		</font>
		</ul><b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klay�n�z.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir hastan�n t�m ameliyat belgelerini listelemek istiyorum.</b></font>
<ul> <b>Ad�m 1: </b>�lgili alana anahtar s�zc��� giriniz. Tam bir s�zc�k, bir c�mle veya bir s�zc���n ilk bir ka� harfi olabilir. <br>
		<ul><font size=1 color="#000099" >
		<b>�zleyen alanlar bir anahtar s�zc�k ile doldurulabilir:</b>
		<br> Hasta protokol no.
		<br> Soyad
		<br> Ad
		<br> Do�um tarihi
		</font>
		</ul><b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in  <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir cerrah�n yapt��� ameliyatlar�n t�m belgelerini listelemek istiyorum.</b></font>
<ul> <b>Ad�m 1: </b>Cerrah�n ad�n� "<span style="background-color:yellow" > Cerrah: </span>" alan�na yaz�n�z. <br>
		<b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in  <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Ayaktan gelen hastalar�n t�m ameliyat belgelerini listelemek istiyorum </b></font>
<ul> <b>Ad�m 1: </b> "<span style="background-color:yellow" >Ayaktan hasta <input type="radio" name="r" value="1"></span>" se�im kutusunu t�klay�n�z . <br>
		<b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Yatan hastalar�n t�m ameliyat belgelerini listelemek istiyorum </b></font>
<ul> <b>Ad�m 1: </b> "<span style="background-color:yellow" >Yatan hasta <input type="radio" name="r" value="1"></span>" se�im kutusunu t�klay�n�z . <br>
		<b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Genel sa�l�k sigortas�na tabi hastalar�n t�m ameliyat belgelerini listelemek istiyorum </b></font>
<ul> <b>Ad�m 1: </b> "<span style="background-color:yellow" >Sigortal� <input type="radio" name="r" value="1"></span>" se�im kutusunu t�klay�n�z . <br>
		<b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>�zel sigortal� hastalar�n t�m ameliyat belgelerini listelemek istiyorum </b></font>
<ul> <b>Ad�m 1: </b> "<span style="background-color:yellow" >�zel <input type="radio" name="r" value="1"></span>" se�im kutusunu t�klay�n�z . <br>
		<b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>�cretli hastalar�n t�m ameliyat belgelerini listelemek istiyorum </b></font>
<ul> <b>Ad�m 1: </b> "<span style="background-color:yellow" >�cretli <input type="radio" name="r" value="1"></span>" se�im kutusunu t�klay�n�z . <br>
		<b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir anahtar s�zc�k ile t�m ameliyat belgelerini listelemek istiyorum </b></font>
<ul> <b>Ad�m 1: </b>�lgili alana anahtar s�zc��� giriniz. Tam bir s�zc�k, c�mle, veya bir s�zc���n ilk birka� harfi olabilir. <br>
		<ul><font size=2 color="#000099" >
		<b>�rnek:</b> Tan� anahtar s�zc���n� "Tan�" alan�na giriniz.<br>
		<b>�rnek:</b> Yeri anahtar s�zc���n� "Yeri" alan�na giriniz.<br>
		<b>�rnek:</b> Tedavi anahtar s�zc���n� "Tedavi" alan�na giriniz.<br>
		<b>�rnek:</b> �zel uyar� anahtar s�zc���n� "�zel uyar�" alan�na giriniz.<br>
		</font>
		</ul><b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klay�n�z.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir ameliyat s�n�f�na g�re t�m belgeleri listelemek istiyorum</b></font>
<ul> <b>Ad�m 1: </b>�lgili alana anahtar s�zc��� giriniz. Tam bir s�zc�k, c�mle veya bir s�zc���n ilk birka� harfi olabilir. <br>
		<ul><font size=2 color="#000099" >
		<b>�rnek:</b> K���k ameliyat i�in numaray�  "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> k���k </span>" alan�na giriniz.<br>
		<b>�rnek:</b> Orta ameliyat i�in numaray�  "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> orta </span>" alan�na giriniz.<br>
		<b>�rnek:</b> B�y�k ameliyat i�in numaray�  "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> b�y�k </span>" alan�na giriniz.<br>
		</font>
		</ul><b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>><b><font color="#990000"> Uyar�: </font></b>
<ul> Birka� arama �art�n� birle�tirebilirsiniz. �rnek: Cerrah "G�rlek" taraf�ndan ameliyat edilmi� ve tedavisinde "lipo" ile ba�layan bir s�zc�k i�eren t�m yatan hastalar� listelemek ister iseniz:<p>
		<b>Ad�m 1: </b> "<span style="background-color:yellow" > Cerrah: <input type="text" name="s" size=15 maxlength=4 value="G�rlek"> </span>" alan�na "G�rlek" giriniz.<br>
		<b>Ad�m 2: </b> "<span style="background-color:yellow" > <input type="radio" name="r" value="1" checked>Yatan hasta </span>" se�im kutusunu t�klay�n�z.<br>
		<b>Ad�m 3: </b> "<span style="background-color:yellow" > Tedavi: <input type="text" name="s" size=20 maxlength=4 value="lipo"> </span>" alan�na "lipo" giriniz. <br>
		<b>Ad�m 4: </b>Aramay� ba�latmak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klay�n�z.<p>

<b>Uyar�</b><br>
Arama bir tek sonu� bulur ise, t�m belge derhal g�r�nt�lenir.<br>
		Ancak arama birka� sonu� bulur ise, bir liste g�r�nt�lenir.<p>
		Arad���n�z hastan�n belgesini a�mak i�in, ya ilgili <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> d��mesini, veya
		ad�n�, veya soyad�n�, veya tarihi, veya ameliyat numaras�n� <nobr>(op nr)</nobr> t�klay�n�z.
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
	<?php endif ?>
<?php if(($x1=="search")&&($x2>1)) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ar�ivdeki belirli bir belge g�r�nt�lenmek �zere nas�l se�ilir?</b>
</font>
<ul>       	
 	<b>Uyar�: </b> Ar�ivdeki belgeyi g�r�nt�lemek i�in hastan�n soyad�, veya ad�, veya ameliyat tarihi, veya ameliyat numaras�n� t�klay�n�z.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ar�ivde aramaya nas�l devam edilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Ar�ivin arama giri� alanlar�na geri gitmek i�in  <input type="button" value="Yeni ar�iv aramas�"> d��mesini t�klay�n�z.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
	<?php endif ?>
<?php if(($x1=="select")&&($x2==1)) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
G�r�nt�lenen ar�iv belgesi nas�l d�zenlenir veya g�ncellenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>D�zenleme moduna ge�mek i�in  <input type="button" value="Veriyi g�ncelle"> d��mesini t�klay�n�z.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ar�ivlerde aramaya nas�l devam edilir?</b>
</font>
<ul>       	
 	<b>Y�ntem 1: </b>Ar�ivin arama giri� alanlar�na geri gitmek i�in <input type="button" value="Yeni ar�iv aramas�"> d��mesini t�klay�n�z.<p> 
 	<b>Y�ntem 2: </b>Ar�ivin arama giri� alanlar�na geri gitmek i�in <img <?php echo createLDImgSrc('../','arch-blu.gif','0','absmiddle') ?>> d��mesini t�klay�n�z.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>

<?php endif ?>
<?php endif ?>

</form>

