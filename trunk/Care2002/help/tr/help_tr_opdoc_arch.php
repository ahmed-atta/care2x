<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Ameliyathane Belgeler - 
<?php
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
	case "select": print "Hastan�n belgesi";
	}
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >

<?php if($src=="arch") : ?>
	<?php if(($x1=="dummy")||($x1=="?")||($x1=="")||!$x2) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir tarihte yap�lm�� ameliyatlar�n t�m belgelerini listelemek istiyorum</b></font>
<ul> <b>Ad�m 1: </b>Ameliyat tarihini "<span style="background-color:yellow" > Ameliyat tarihi: </span>" alan�na giriniz. <br>
		<ul><font size=1 color="#000099">
		<!-- <b>�pucu:</b> Bug�nk� tarihin otomatik yaz�lmas� i�in "T" veya "t" giriniz.<br>
		<b>�pucu:</b> D�nk� tarihin otomatik yaz�lmas� i�in "Y" veya "y" giriniz.<br> -->
		</font>
		</ul><b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in  <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klay�n�z.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir hastan�n t�m ameliyathane belgelerini listelemek istiyorum. </b></font>
<ul> <b>Ad�m 1: </b>�lgili alana anahtar s�zc��� giriniz. Hastan�n ki�isel bilgisinden tam bir s�zc�k, c�mle veya ilk birka� harfi olabilir. <br>
		<ul><font size=1 color="#000099" >
		<b>A�a��daki alanlar bir anahtar s�zc�k ile doldurulabilir:</b>
		<br> Hasta numaras�.
		<br> Soyad
		<br> Ad
		<br> Do�um tarihi
		</font>
		</ul><b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir cerrah�n t�m ameliyathane belgelerini listelemek istiyorum.</b></font>
<ul> <b>Ad�m 1: </b>Cerrah�n ismini "<span style="background-color:yellow" > Cerrah: </span>" alan�na giriniz. <br>
		<b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Poliklinik hastalar�n�n t�m ameliyathane belgelerini listelemek istiyorum </b></font>
<ul> <b>Ad�m 1: </b> "<span style="background-color:yellow" >Poliklinik <input type="radio" name="r" value="1"></span>" se�im kutusunu t�klay�n�z. <br>
		<b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Yatan hastalar�n t�m ameliyathane belgelerini listelemek istiyorum </b></font>
<ul> <b>Ad�m 1: </b> "<span style="background-color:yellow" >Yatan hasta <input type="radio" name="r" value="1"></span>" se�im kutusunu t�klay�n�z. <br>
		<b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Genel sa�l�k sigortas�na ba�l� hastalar�n t�m ameliyathane belgelerini listelemek istiyorum </b></font>
<ul> <b>Ad�m 1: </b> "<span style="background-color:yellow" >Genel sa�l�k sigortas� <input type="radio" name="r" value="1"></span>" se�im kutusunu t�klay�n�z. <br>
		<b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>�zel sigortal� hastalar�n t�m ameliyathane belgelerini g�rmek istiyorum </b></font>
<ul> <b>Ad�m 1: </b> "<span style="background-color:yellow" >�zel <input type="radio" name="r" value="1"></span>" se�im kutusunu t�klay�n�z. <br>
		<b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>�cretli hastalar�n t�m ameliyathane belgelerini listelemek istiyorum </b></font>
<ul> <b>Ad�m 1: </b> "<span style="background-color:yellow" >�cretli<input type="radio" name="r" value="1"></span>" se�im kutusunu t�klay�n�z. <br>
		<b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klay�n�z.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir anahtar s�zc�k ile t�m ameliyathane belgelerini listelemek istiyorum.</b></font>
<ul> <b>Ad�m 1: </b>Anahtar s�zc��� ilgili alana giriniz. Tam bir s�zc�k, c�mle veya bir s�zc���n ilk bir ka� harfi olabilir. <br>
		<ul><font size=2 color="#000099" >
		<b>�rnek:</b> Tan� ile ilgili anahtar s�zc��� "Tan�" alan�na giriniz.<br>
		<b>�rnek:</b> Yeri ile ilgili anahtar s�zc���  "Yeri" alan�na giriniz.<br>
		<b>�rnek:</b> Tedavi ile ilgili anahtar s�zc��� "Tedavi" alan�na giriniz.<br>
		<b>�rnek:</b> �zel uyar� ile ilgili anahtar s�zc���  "�zel uyar�" alan�na giriniz.<br>
		</font>
		</ul><b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in  <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klay�n�z.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir ameliyat s�n�f� i�eren t�m belgeleri listelemek istiyorum</b></font>
<ul> <b>Ad�m 1: </b>�lgili alana anahtar s�zc��� giriniz. Tam bir s�zc�k, c�mle, veya bir s�zc���n ilk birka� harfi olabilir. <br>
		<ul><font size=2 color="#000099" >
		<b>�rnek:</b> K���k ameliyat i�in say�y�  "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> k���k </span>" alan�na giriniz.<br>
		<b>�rnek:</b> Orta ameliyat i�in say�y�  "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> orta </span>" alan�na giriniz.<br>
		<b>�rnek:</b> B�y�k ameliyat i�in say�y�  "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> b�y�k </span>" alan�na giriniz.<br>
		</font>
		</ul><b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>><b><font color="#990000"> Uyar�:</font></b>
<ul> Birka� arama ko�ulunu birle�tirebilirsiniz. �rne�in cerrah "G�rlek" taraf�ndan ameliyat edilmi� ve tedavisi "lipo" ile ba�layan bir s�zc�k i�eren t�m yatan hastalar� listelemek isterseniz:<p>
		<b>Ad�m 1: </b> "<span style="background-color:yellow" > Cerrah: <input type="text" name="s" size=15 maxlength=4 value="G�rlek"> </span>" alan�na "G�rlek" giriniz.<br>
		<b>Ad�m 2: </b>"<span style="background-color:yellow" > <input type="radio" name="r" value="1" checked>Yatan hasta </span>" se�im kutusunu t�klay�n�z.<br>
		<b>Ad�m 3: </b>"<span style="background-color:yellow" > Tedavi: <input type="text" name="s" size=20 maxlength=4 value="lipo"> </span>" alan�na "lipo" giriniz. <br>
		<b>Ad�m 4: </b>Aramay� ba�latmak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klay�n�z.<p>

<b>Uyar�</b><br>
E�er arama bir tek sonu� bulur ise, belgenin tamam� derhal g�r�nt�lenir.<br>
		Ancak e�er arama birka� sonu� bulur ise bir liste g�r�nt�lenir.<p>
		Arad���n�z hastan�n belgesini a�mak i�in, ya ilgili  <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> d��mesini, veya ad, veya soyad, veya tarih veya ameliyat numaras�n� <nobr>(op nr)</nobr> t�klay�n�z.
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
	<?php endif ?>
<?php if(($x1=="search"||$x1='paginate')&&($x2>0)) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ar�ivdeki belirli bir belge g�r�nt�lenmek �zere nas�l se�ilir?</b>
</font>
<ul>       	
 	<b>Uyar�: </b> Ar�ivdeki belgeyi g�r�nt�lemek i�in hastan�n ad�n�, veya soyad�n�, veya ameliyat tarihini, veya ameliyat numaras�n� t�klay�n�z.<p> 
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Liste nas�l s�ralan�r?</b>
</font>
<ul>       	
 	<b>Uyar�: </b> Listenin s�ralanmas�n� istedi�iniz s�tunun ba�l���n� t�klay�n�z.<p> 
	�rnek: Listeyi ameliyat tarihine g�re s�ralamak ister iseniz "Ameliyat tarihi" ba�l���n� t�klay�n�z.  <br>Tekrar t�klad���n�zda s�ralama tersine d�ner:<p>
	<blockquote>
	<img src='../help/tr/img/tr_or_search_sort.png'>
	</blockquote>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ar�ivde aramaya nas�l devam edilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Ar�ivde arama alanlar�na geri itmek i�in  <input type="button" value="New archive research"> d��mesini t�klay�n�z.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
	<?php endif ?>
<?php if(($x1=="select"||$x1='paginate')&&($x2==1)) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
G�r�nt�lenen ar�iv belgesi nas�l d�zenlenir veya g�ncellenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>D�zenleme moduna ge�mek i�in  <input type="button" value="Bilgiyi g�ncelle"> d��mesini t�klay�n�z.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ar�ivlerde aramaya nas�l devam edilir?</b>
</font>
<ul>       	
 	<b>Y�ntem 1: </b>Ar�ivin arama giri� alanlar�na geri gitmek i�in <input type="button" value="Yeni ar�iv aramas�"> d��mesini t�klay�n�z.<p> 
 	<b>Veya Y�ntem 2: </b>Ar�ivin giri� alanlar�na geri gitmek i�in <img <?php echo createLDImgSrc('../','arch-blu.gif','0','absmiddle') ?>> d��mesini t�klay�n�z.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>

<?php endif ?>
<?php endif ?>

</form>

