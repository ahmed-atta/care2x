<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Ar�iv nas�l aran�r</b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="select") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>G�r�nen bilgileri g�ncellemek istiyorum</b></font>
<ul> <b>Ad�m : </b>Bilgileri d�zenlemeye ba�lamak i�in <input type="button" value="Bilgi g�ncelle"> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Ar�ivde yeni bir arama ba�latmak istiyorum</b></font>
<ul> <b>Ad�m : </b>Yeni bir arama ba�latmak i�in <input type="button" value="Ar�ivde yeni arama"> d��mesini t�klat�n�z.<br>
</ul>
<?php elseif($src=="Ara") : ?>
<b>Uyar�</b>
<ul> E�er aramada tek bir sonu� bulunur ise, bilginin tamam� derhal g�sterilir.<br>
		E�er, aramada bir ka� sonu� bulunur ise, bir liste g�r�nt�lenir.<br>
		Arad���n�z hastan�n bilgilerini g�rmek i�in ya ilgili  <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> simgesine ya da ad, soyad, veya kabul tarihi �zerine t�klay�n�z.
</ul>
<b>Uyar�</b>
<ul> E�er yeni bir arama ba�latmak isterseniz  <input type="button" value="Ar�ivde yeni arama"> d��mesini t�klay�n�z.
</ul>
<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bug�n kabul edilen t�m hastalar� listelemek istiyorum</b></font>
<ul> <b>Ad�m 1: </b>Bug�n�n tarihini "Kabul tarihi: �u tarihten itibaren:" alan�na giriniz. <br>
		<ul><font size=1 color="#000099">
		<b>�p ucu:</b> Otomatik olarak bug�n�n tarihinin girilmesi i�in  "B" veya "T" girebilirsiniz.<br>
		</font>
		</ul><b>Ad�m 2: </b>"ye kadar:" alan�n� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in  <input type="button" value="ARA">  d��mesine t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>�ki tarih aras�nda kaydedilmi� t�m hastalar� listelemek istiyorum</b></font>
<ul> <b>Ad�m 1: </b>Ba�lang�� tarihini "Kabul tarihi: �u tarihten itibaren:" alan�na giriniz. <br>
		<ul><font size=1 color="#000099">
		<b>�pucu:</b> Bug�nk� tarihin otomatik olarak yaz�lmas� i�in  "B" veya "T" giriniz.<br>
		<b>�pucu:</b> D�nk� tarihin otomatik yaz�lmas� i�in  "D" veya  "Y" giriniz.<br>
		</font>
		</ul><b>Ad�m 2: </b>Biti� tarihini "�u tarihe kadar:" alan�na giriniz.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <input type="button" value="ARA">  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Kabul edilmi� t�m erkek hastalar� listelemek istiyorum</b></font>
<ul> <b>Ad�m 1: </b> "Cinsiyet <input type="radio" name="r" value="1"> se�enek d��mesinden erkek se�iniz". <br>
		<b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <input type="button" value="ARA">  d��mesini t�klat�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Kabul edilmi� t�m kad�n hastalar� listelemek istiyorum</b></font>
<ul> <b>Ad�m 1: </b> "Cinsiyet <input type="radio" name="r" value="1"> se�enek d��mesinden Kad�n se�iniz". <br>
		<b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <input type="button" value="ARA">  d��mesini t�klat�n�z.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Poliklini�e kabul edilmi� t�m hastalar� listelemek istiyorum </b></font>
<ul> <b>Ad�m 1: </b>Se�enek d��mesinden "<input type="radio" name="r" value="1">Ayaktan" se�iniz. <br>
		<b>Ad�m 2 : </b>Di�er alanlar�n hepsini bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramaya ba�lamak i�in <input type="button" value="ARA">  d��mesine t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>T�m yatan hastalar� aramak istiyorum</b></font>
<ul> <b>Ad�m 1: </b> "<input type="radio" name="r" value="1">Yatan" d��mesine t�klay�n�z. <br>
		<b>Ad�m 2: </b>Di�er t�m alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in  <input type="button" value="ARA">  d��mesini t�klat�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>�cretli hastalar� listelemek istiyorum </b></font>
<ul> <b>Ad�m 1: </b>"<input type="radio" name="r" value="1">�cretli" d��mesini t�klay�n�z. <br>
		<b>Ad�m 2: </b>Di�er t�m alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in  <input type="button" value="ARA">  d��mesini t�klat�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>�zel sigortal� t�m hastalar� listelemek istiyorum </b></font>
<ul> <b>Ad�m 1: </b>"<input type="radio" name="r" value="1">�zel" d��mesini t�klay�n�z. <br>
		<b>Ad�m 2: </b>Di�er t�m alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in  <input type="button" value="ARA">  d��mesini t�klat�n�z.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>T�m genel sa�l�k sigortal� hastalar� listelemek istiyorum </b></font>
<ul> <b>Ad�m 1: </b>"<input type="radio" name="r" value="1">Genel" d��mesini t�klay�n�z. <br>
		<b>Ad�m 2: </b>Di�er t�m alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in  <input type="button" value="ARA">  d��mesini t�klat�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir anahtar s�zc�kl� t�m hastalar� aramak istiyorum.</b></font>
<ul> <b>Ad�m 1: </b>�lgili alana anahtar s�zc��� giriniz. T�m bir s�zc�k veya bitka� harf olabilir. <br>
		<ul><font size=1 color="#000099" >
		<b>�rnek:</b> Tan� anahtar s�zc��� i�in "Tan�" alan�na giriniz.<br>
		<b>�rnek:</b> G�nderen anahtar s�zc��� i�in "G�nderen" alan�na giriniz.<br>
		<b>�rnek:</b> Tedavi anahtar s�zc��� i�in "�nerilen tedavi" alan�na giriniz.<br>
		<b>�rnek:</b> �zel notlar anahtar s�zc��� i�in "�zel notlar" alan�na giriniz.<br>
		</font>
		</ul><b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n��z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <input type="button" value="ARA">  d��mesini t�klat�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belli anahtar s�zc�kleri olan belirli bir hastay� ar�yorum</b></font>
<ul> <b>Ad�m 1: </b>�lgili alana anahtar s�zc��� giriniz. Tam bir s�zc�k ya da birka� harf olabilir. <br>
		<ul><font size=1 color="#000099" >
		<b>A�a��daki alanlar bir anahtar s�zc�k ile doldurulabilir:</b>
		<br> Protokol numaras�
		<br> Soyad
		<br> Ad
		<br> Do�um tarihi
		<br> Adres
		</font>
		</ul><b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <input type="button" value="ARA">  d��mesini t�klat�n�z.<br>
</ul>
<b>Uyar�</b>
<ul> Birka� arama ko�ulunu birlikte kullanabilirsiniz. �rnek olarak: 10.12.1999 tarihi ile 24.01.2000 tarihleri aras�nda kabul edilmi� t�m ERKEK hastalar� listelemek isterseniz:<p>
		<b>Ad�m 1: </b>"Kabul tarihi den itibaren" alan�na "10.12.1999" giriniz. <br>
		<b>Ad�m 2: </b>"Ye kadar:" alan�na "24.01.2000 giriniz.<br>
		<b>Ad�m 3: </b>Cinsiyet se�imi d��mesinden "Cinsiyet <input type="radio" name="r" value="1">male" erkek se�iniz. <br>
		<b>Ad�m 4: </b>Aramay� ba�latmak i�in  <input type="button" value="ARA">  d��mesini t�klay�n�z.<br>
</ul>
<b>Uyar�</b>
<ul> Arama tek bir kay�t bulur ise o kay�tla ilgili b�t�n bilgi derhal g�r�nt�lenir.<br>
		Ancak arama birka� sonu� bulur ise, bir liste g�r�nt�lenir.<br>
		Arad���n�z hasta ile ilgili bilgiyi g�rmak i�in hastan�n <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> d��mesini, veya ad, soyad, veya kabul tarihini t�klay�n�z.
</ul>

<?php endif ?>
<b>Uyar�</b>
<ul> Aramay� iptal etmek isterseniz <input type="button" value="Cancel"> d��mesini t�klay�n�z.
</ul>
</form>

