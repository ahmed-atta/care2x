<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>T�bbi belge ar�ivleri nas�l ara�t�r�l�r</b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="select") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>G�r�nt�lenen t�bbi belgeyi g�ncellemek istiyorum</b></font>
<ul> <b>Ad�m : </b>Belgeyi d�zenlemeye ba�lamak i�in <input type="button" value="Veriyi g�ncelle"> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Ar�ivlerde yeni bir aramaya ba�lamak istiyorum</b></font>
<ul> <b>Ad�m : </b>Yeni aramaya ba�lamak i�in <input type="button" value="Ar�ivde yeni arama"> d��mesini t�klay�n�z.<br>
</ul>
<?php elseif(($src=="search")&&($x1)) : ?>
<b>Uyar�</b>
<ul><?php if($x1==1) : ?> E�er arama bir tek sonu� bulur ise belgenin t�m� derhal g�r�nt�lenir.<br>
		Ancak, arama birka� sonu� bulur ise, bir liste g�r�nt�lenir.<br>
		<?php endif ?>
		Arad���n�z hastan�n bilgisini g�rmek i�in,  ya ilgili <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> d��mesini veya ad, veya soyad, veya kabul tarihini t�klay�n�z.
</ul>
<b>Uyar�</b>
<ul> Yeni bir aramaya ba�lamak ister iseniz <input type="button" value="Ar�ivde yeni arama"> d��mesini t�klay�n�z.
</ul>
<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir b�l�m�n t�m t�bbi belgelerini listelemek istiyorum</b></font>
<ul> <b>Ad�m 1: </b>"B�l�m:" alan�na b�l�m�n kodunu giriniz. <br>
		<b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramaya ba�lamak i�in  <input type="button" value="Ara">  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belli bir hastan�n belli bir t�bbi belgesini ar�yorum</b></font>
<ul> <b>Ad�m 1: </b>�lgili alana anahtar s�zc��� giriniz. Tam bir s�zc�k veya c�mle olabilir veya hastan�n ki�isel bilgilerinden bir s�zc�k , veya s�zc���n ilk bir ka� harfi olabilir. <br>
		<ul><font size=1 color="#000099" >
		<b>�u alanlar bir anahtar s�zc�k ile doldurulabilir:</b>
		<br> Hasta numaras�
		<br> Soyad�
		<br> Ad�
		<br> Do�um tarihi
		<br> Adres
		</font>
		</ul><b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramaya ba�lamak i�in <input type="button" value="Ara">  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belli bir sigorta �irketinin t�m hastalar�n�n t�bbi belgelerini listelemek istiyorum</b></font>
<ul> <b>Ad�m 1: </b>"Sigorta:" alan�na sigorta �irketinin k�saltmas�n� giriniz. <br>
		<b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramaya ba�lamak i�in <input type="button" value="Ara">  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir ek sigorta bilgisi olan t�m t�bbi belgeleri listelemek istiyorum</b></font>
<ul> <b>Ad�m 1: </b>"Ek bilgi:" alan�na anahtar s�zc��� giriniz. <br>
		<b>Ad�m 2: </b>Di�er t�m alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <input type="button" value="Ara">  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>ERKEK hastalar�n t�m t�bbi belgelerini listelemek istiyorum </b></font>
<ul> <b>Ad�m 1: </b>"<span style="background-color:yellow" >Cinsiyet <input type="radio" name="r" value="1">erkek</span>" se�im kutusunu t�klay�n�z. <br>
		<b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramaya ba�lamak i�in <input type="button" value="Ara">  d��mesini t�klay�n�z.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>KADIN hastalar�n t�m t�bbi belgelerini listelemek istiyorum </b></font>
<ul> <b>Ad�m 1: </b>"<span style="background-color:yellow" >Cinsiyet <input type="radio" name="r" value="1">kad�n</span>" se�im kutusunu t�klay�n�z. <br>
		<b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramaya ba�lamak i�in <input type="button" value="Ara">  d��mesini t�klay�n�z.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Zorunlu t�bbi dan��manl�k verilmi� t�m hastalar� listelemek istiyorum</b></font>
<ul> <b>Ad�m 1: </b>"<span style="background-color:yellow" >T�bbi dan��manl�k: <input type="radio" name="r" value="1">Evet</span>" se�im kutusunu t�klay�n�z. <br>
		<b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramaya ba�lamak i�in <input type="button" value="Ara">  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Zorunlu t�bbi dan��manl�k hizmeti almam�� t�m hastalar�n t�bbi belgelerini listelemek istiyorum</b></font>
<ul> <b>Ad�m 1: </b> "<span style="background-color:yellow" ><input type="radio" name="r" value="1">Hay�r</span>" se�im kutusunu t�klay�n�z. <br>
		<b>Ad�m 2: </bT>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramaya ba�lamak i�in <input type="button" value="Ara">  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir anahtar s�zc��� i�eren t�m t�bbi belgeleri listelemek istiyorum</b></font>
<ul> <b>Ad�m 1: </b>�lgili alana anahtar s�zc��� giriniz. Tam bir s�zc�k, veya c�mle olabilir, ya da bir s�zc���n ilk birka� harfi olabilir. <br>
		<ul><font size=1 color="#000099" >
		<b>�rnek:</b> Tan� ile ilgili bir anahtar s�zc��� "Tan�" alan�na giriniz.<br>
		<b>�rnek:</b> Sa�alt�m ile ilgili bir anahtar s�zc��� "�nerilen tedavi" alan�na giriniz.<br>
		</font>
		</ul><b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramaya ba�lamak i�in <input type="button" value="Ara">  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir tarihte yaz�lm�� t�m t�bbi belgeleri listelemek istiyorum</b></font>
<ul> <b>Ad�m: </b>Belge tarihini "Belgelendirildi�i tarih:" alan�na giriniz. <br>
		<ul><font size=1 color="#000099">
		<b>�pucu:</b> Bug�n�n tarihini otomatik olarak girmak i�in  "T" veya "t" giriniz.<br>
		<b>�pucu:</b> D�n�n tarihini otomatik olarak girmek i�in "Y" veya "y" giriniz.<br>
		</font>
		</ul><b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramaya ba�lamak i�in <input type="button" value="Ara">  d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir ki�inin yazd��� t�m t�bbi belgeleri listelemek istiyorum.</b></font>
<ul> <b>Ad�m 1: </b>Yazan ki�inin isminin tamam�n� ya da ba�tan birka� harfini "Belgeyi yazan:" alan�na giriniz. <br>
		<b>Ad�m 2: </b>T�m di�er alanlar� bo� b�rak�n�z.<br>
		<b>Ad�m 3: </b>Aramay� ba�latmak i�in <input type="button" value="Ara">  d��mesini t�klay�n�z.<br>
</ul>
<b>Uyar�</b>
<ul> Birka� arama ko�ulunu birle�tirebilirsiniz. �rne�in: Plastik cerrahide zorunlu t�bbi dan��manl�k alm�� "lipo" ile ba�layan tedavisi olan t�m Erkek hastalar� listelemek isterseniz:<p>
		<b>Ad�m 1: </b>"B�l�m:" alan�na "plop" giriniz. <br>
		<b>Ad�m 2: </b> "<span style="background-color:yellow" >Sex<input type="radio" name="r" value="1">erkek</span>" se�im kutusunu t�klay�n�z.<br>
		<b>Ad�m 3: </b> "<span style="background-color:yellow" >T�bbi dan��manl�k:<input type="radio" name="r" value="1">Evet</span>" kutusunu t�klay�n�z.<br>
		<b>Ad�m 4: </b>"Tedavi:" alan�na" lipo giriniz. <br>
		<b>Ad�m 5: </b>Aramay� ba�latmak i�in <input type="button" value="Ara">  d��mesini t�klay�n�z.<br>
</ul>
<b>Uyar�</b>
<ul> Arama bir tek belge bulur ise, tam belge derhal g�r�nt�lenir.<br>
		Ancak, arama birka� sonu� bulur ise , bir liste g�r�nt�lenir.<br>
		Arad���n�z hastan�n belgesini a�mak i�in, ya ilgili  <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> d��mesini, veya ad, soyad veya kabul tarihini t�klay�n�z.
</ul>

<?php endif ?>
<b>Uyar�</b>
<ul> Aramay� iptal etmek ister iseniz  <input type="button" value="Kapat"> d��mesini t�klay�n�z.
</ul>
</form>

