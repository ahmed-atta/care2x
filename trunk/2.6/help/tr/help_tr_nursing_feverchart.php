<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<a name="howto">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Derece k���d� formu</b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="main") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Nas�l...?</b></font>
<ul type="disc"><li><a href="#cbp">derece veya kan bas�nc� girilir.</a>
		<li><a href="#movedate">�izelgenin tarihi ilerletilir veya de�i�tirilir.</a>
		<li><a href="#diet">diyet plan� girilir.</a>
		<li><a href="#allergy">allerji bilgisi girilir.</a>
		<li><a href="#diag">ana tan� veya tedavi girilir.</a>
		<li><a href="#daydiag">g�nl�k tan� veya tedavi plan� bilgisi girilir.</a>
		<li><a href="#extra">ek tan�lar, notlar vs. girilir.</a>
		<li><a href="#pt">g�nl�k fizik tedavi bilgisi, anti tromboz cimnasti�i, vs. girilir.</a>
		<li><a href="#coag">antikoag�lanlar girilir.</a>
		<li><a href="#daycoag">g�nl�k antikoag�lan uygulama bilgisi girilir.</a>
		<li><a href="#lot">implant notlar�, k�me no, g�rev no, vs. girilir.</a>
		<li><a href="#med">ila� ve doz �emas� girilir.</a>
		<li><a href="#daymed">g�nl�k ila� uygulamas� ve doz bilgisi girilir.</a>
		<li><a href="#iv">g�nl�k intraven�z ila� �emas� ve doz bilgisi girilir.</a>
</ul>		
<hr>
<a name="cbp"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Derece veya kan bas�nc� nas�l girilir?</b></font>
<ul> <b>Ad�m 1: </b>Se�ilen g�ne kar��l�k gelen �izelge alan�n� t�klay�n�z.<br>
		<b>Ad�m 2: </b>Derece ve/veya kan bas�nc�n� girmek i�in bir pencere a��l�r.<br>
		<b>Ad�m 3: </b>Veriyi ve zaman� giriniz.<br>
		<ul type="disc">
		<li>Zaman ve dereceyi sa�daki "<font color="#0000ff">Derece</font>" s�tununa giriniz.<br>
		�rnek: <input type="text" name="t" size=5 maxlength=5 value="12.35">&nbsp;&nbsp;<input type="text" name="u" size=8 maxlength=8 value="37.3">
		<li>Zaman ve kan bas�nc�n� soldaki "<font color="#cc0000">Kan bas�nc�</font>" s�tununa giriniz.<br>
		�rnek: <input type="text" name="v" size=5 maxlength=5 value="10.05">&nbsp;&nbsp;<input type="text" name="w" size=8 maxlength=8 value="128/85">
		</ul>		
		<ul >
		<font color="#000099" size=1><b>�pucu:</b> �u andaki zaman� kay�t etmek i�in zaman alan�na "n" veya "N" (Now=�imdi anlam�nda) giriniz. �u andaki zaman alana otomatik olarak girilir.</font>
		</ul>
		<b>Ad�m 4: </b>Birka� bilgi var ise, kay�t etmeden �nce hepsini giriniz.<br>
		<b>Ad�m 5: </b>Yeni girilen bilgiyi kay�t etmek i�in  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 6: </b>Herhangi bir hatay� d�zeltmek ister iseniz, hatal� verilerin �zerine t�klay�n�z ve do�rusunu yaz�n�z.<br>
		<b>Ad�m 7: </b>��iniz bitti ise, pencereyi kapat�p �izelgeye geri d�nmek i�in  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Geriye "Nas�l...?"</a></font>
</ul>
<a name="movedate"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
�izelge tarihi nas�l ilerletilir veya de�i�tirilir?</b></font>
<ul> 
	<li><font color="#660000"><b>Tarihi bir g�n geri almak i�in:</b></font><br>
	<b>Ad�m 1: </b>�izelgenin <span style="background-color:yellow" >en solundaki</span> tarih s�tunundaki <img <?php echo createComIcon('../','l_arrowgrnsm.gif','0') ?>> simgesine t�klay�n�z.<p>
	<li><font color="#660000"><b>Tarihi bir g�n ileri almak i�in:</b></font><br>
	<b>Ad�m 1: </b>�izelgenin <span style="background-color:yellow" >en sa��ndaki</span>  <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>> simgesini t�klay�n�z.
                                                                     <p>
	<li><font color="#660000"><b>�izelgenin ba�lama tarihini do�rudan ayarlamak i�in:</b></font><br>
	<b>Ad�m 1: </b>�izelgenin <span style="background-color:yellow" >en sol</span> s�tunundaki <img <?php echo createComIcon('../','l_arrowgrnsm.gif','0') ?>> simgesine <span style="background-color:yellow" >farenin sa� tu�u</span> ile t�klay�n�z.<br>
	<b>Ad�m 2: </b>Onay istendi�inde  <input type="button" value="Tamam"> d��mesini t�klay�n�z.<br>
	<b>Ad�m 3: </b>Ba�lama tarihi se�im alanlar�n� g�steren k���k bir pencere a��l�r.<br>
	<b>Ad�m 4: </b>G�n, ay ve y�l� se�iniz.<br>
	<b>Ad�m 5: </b>De�i�ikli�i etkinle�tirmek i�in <input type="button" value="Git"> d��mesini t�klay�n�z.<br>
	K���k pencere otomatik olarak kapan�r ve �izelgeye tarih de�i�ikli�i uygulan�r.<p>
	
	<li><font color="#660000"><b>�izelgenin biti� tarihini do�rudan ayarlamak i�in:</b></font><br>
	<b>Ad�m 1: </b>�izelgenin <span style="background-color:yellow" >en sa�</span> tarih s�tunundaki <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>> simgesini <span style="background-color:yellow" >farenin sa� tu�u</span> ile t�klay�n�z.<br>
	<b>Ad�m 2: </b>Onay istendi�inde <input type="button" value="Tamam"> d��mesini t�klay�n�z.<br>
	<b>Ad�m 3: </b>Biti� tarihi se�im alanlar�n� g�steren bir pencere a��l�r.<br>
	<b>Ad�m 4: </b>G�n, ay, ve y�l� se�iniz.<br>
	<b>Ad�m 5: </b>De�i�ikli�i uygulamak i�in  <input type="button" value="Git"> d��mesini t�klay�n�z.<br>
	K���k d��me otomatik olarak kapan�r ve �izelge g�n de�i�ikli�ine ayarlan�r.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> "Nas�l...? a geri" </a></font>
</ul>
<a name="diet"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Diyet plan� nas�l girilir?</b></font>
<ul> <b>Ad�m 1: </b>Se�ilen tarihe kar��l�k gelen  "<span style="background-color:yellow" > Diyet plan� </span>" n� t�klay�n�z.<br>
		<b>Ad�m 2: </b>Diyet plan� girmek veya d�zenlemek i�in bir pencere a��l�r.<br>
		<b>Ad�m 3: </b>Diyet plan�n� giriniz.<br>
		<b>Ad�m 4: </b>Yeni girilmi� diyet plan�n� kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
  		<b>Uyar�: </b>�ptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 5: </b>Her hangi bir hatay� d�zeltmek ister iseniz, hatal� bilgileri t�klay�n�z ve do�rusu ile de�i�tiriniz.<br>
		<b>Ad�m 6: </b>��iniz bitti ise, pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> "Nas�l...? a geri"</a></font>
</ul>
<a name="allergy"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Allerji bilgisi nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b> "<span style="background-color:yellow" > Allerji<img <?php echo createComIcon('../','clip.gif','0') ?>> </span>" �zerindeki<img <?php echo createComIcon('../','clip.gif','0') ?>> simgesini t�klay�n�z .<br>
	<b>Ad�m 2: </b>Allerji bilgisi giri�i i�in bir pencere a��l�r.<br>
	<b>Ad�m 3: </b>Allerji veya CAVE bilgisini<br> "<span style="background-color:yellow" > L�tfen yeni bilgiyi buraya giriniz: </span>" alan�na yaz�n�z.<br>
  		<b>Uyar�: </b>G�ncel bilgileri <br> gerekirse "<span style="background-color:yellow" > G�ncel bilgiler: </span>" alan�nda d�zenleyebilirsiniz.<br>
  		<b>Uyar�: </b>�ptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 4: </b>Bilgiyi kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 5: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz.<br>
		<b>Ad�m 6: </b>��iniz bitti ise , pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> "Nas�l...? a geri"</a></font>
</ul>

<a name="diag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Ana tan� ve/veya tedavi nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b> "<span style="background-color:yellow" > Tan�/Tedavi <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>" �zerindeki <img <?php echo createComIcon('../','clip.gif','0') ?>> simgesini t�klay�n�z .<br>
	<b>Ad�m 2: </b>Tan�/tedavi bilgisi giri� alan�n� g�steren bir pencere a��l�r.<br>
	<b>Ad�m 3: </b>Tan� veya tedavi bilgisini <br> "<span style="background-color:yellow" > L�tfen yeni bilgiyi buraya giriniz: </span>" alan�na giriniz.<br>
  		<b>Uyar�: </b>G�ncel bilgileri<br>gerekir ise "<span style="background-color:yellow" > G�ncel bilgiler: </span>" alan�nda d�zenleyebilirsiniz.<br>
  		<b>Uyar�: </b>�ptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 4: </b>Bilgiyi kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 5: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz.<br>
		<b>Ad�m 6: </b>��iniz bitti ise, pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>>  "Nas�l...?" a geri </a></font>
</ul>
<a name="daydiag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
G�nl�k tan� veya tedavi plan� nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b>Se�ilen tarih ile ilgili ya mevcut g�nl�k tan�/tedavi s�tununu veya bo� s�tunu t�klay�n�z.<br>
	<b>Ad�m 2: </b>Se�ilen tarih i�in tan�/tedavi giri� alan�n� g�steren bir pencere a��l�r.<br>
	<b>Ad�m 3: </b>Tan� veya tedavi bilgisini <br> "<span style="background-color:yellow" > L�tfen yeni bilgiyi buraya giriniz: </span>" alan�na yaz�n�z.<br>
  		<b>Uyar�: </b>G�ncel bilgileri <br>gerekir ise "<span style="background-color:yellow" > G�ncel bilgiler: </span>" alan�ndan d�zenleyebilirsiniz.<br>
  		<b>Uyar�: </b>E�er iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 4: </b>Bilgiyi kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 5: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz. <br>
		<b>Ad�m 6: </b>��iniz bitti ise pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>>  "Nas�l...?" a geri </a></font>
</ul>
<a name="extra"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Notlar, ek tan�lar nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b> "<span style="background-color:yellow" > Notlar, ek tan�lar <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>" �zerindeki <img <?php echo createComIcon('../','clip.gif','0') ?>> simgesini t�klay�n�z.<br>
	<b>Ad�m 2: </b>Notlar ve ek tan�lar giri� alan�n� g�steren bir pencere a��l�r.<br>
	<b>Ad�m 3: </b>Notlar� ve ek tan�lar� <br> "<span style="background-color:yellow" > L�tfen yeni bilgiyi buraya giriniz: </span>" alan�na giriniz.<br>
  		<b>Uyar�: </b> G�ncel bilgileri <br> gerekir ise "<span style="background-color:yellow" > G�ncel bilgiler: </span>" alan�ndan d�zenleyebilirsiniz.<br>
  		<b>Uyar�: </b>E�er iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 4: </b>Bilgiyi kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 5: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz. <br>
		<b>Ad�m 6: </b>��iniz bitti ise pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>>  "Nas�l...?" a geri </a></font>
</ul>
<a name="pt"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
G�nl�k fizik tedavi,(PT), Antitromboz jimnasti�i (Atg), vs. bilgisi nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b>Se�ilen tarihin ilgili "<span style="background-color:yellow" > Pt,Atg,vs: </span>" yaz�s�n� t�klay�n�z.<br>
	<b>Ad�m 2: </b>Se�ilen tarih i�in giri� alan�n� g�steren bir pencere a��l�r.<br>
	<b>Ad�m 3: </b>Bilgiyi <br> "<span style="background-color:yellow" > L�tfen yeni bilgiyi buraya giriniz: </span>" alan�na yaz�n�z.<br>
  		<b>Uyar�: </b>G�ncel bilgileri <br>gerekir ise "<span style="background-color:yellow" > G�ncel bilgiler: </span>" alan�ndan d�zenleyebilirsiniz.<br>
  		<b>Uyar�: </b>E�er iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 4: </b>Bilgiyi kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 5: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz. <br>
		<b>Ad�m 6: </b>��iniz bitti ise pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>>  "Nas�l...?" a geri </a></font>
</ul>
	
<a name="coag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Antikoag�lanlar nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b> "<span style="background-color:yellow" > Antikoag�lanlar <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>" �zerindeki <img <?php echo createComIcon('../','clip.gif','0') ?>> simgesini t�klay�n�z.<br>
	<b>Ad�m 2: </b>Antikoag�lanlar giri� alan�n� g�steren bir pencere a��l�r.<br>
	<b>Ad�m 3: </b>Antikoag�lanlar ve doz bilgisini <br> "<span style="background-color:yellow" > L�tfen yeni bilgiyi buraya giriniz: </span>" alan�na yaz�n�z.<br>
  		<b>Uyar�: </b>G�ncel bilgileri <br>gerekir ise "<span style="background-color:yellow" > G�ncel bilgiler: </span>" alan�ndan d�zenleyebilirsiniz.<br>
  		<b>Uyar�: </b>E�er iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 4: </b>Bilgiyi kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 5: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz. <br>
		<b>Ad�m 6: </b>��iniz bitti ise pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>>  "Nas�l...?" a geri </a></font>
</ul>
<a name="daycoag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
G�nl�k antikoag�lan uygulamas� bilgisi nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b>Se�ilen tarihe kar��l�k gelen ya bo� bir s�tunu ya da mevcut antikoag�lan tedavisini t�klay�n�z.<br>
	<b>Ad�m 2: </b>Se�ilen tarih i�in g�nl�k antikoag�lan uygulamas�n� g�steren bir pencere a��l�r.<br>
	<b>Ad�m 3: </b>Ya dozaj veya aplikat�r bilgisini <br> "<span style="background-color:yellow" > Buraya yeni bilgi giriniz veya g�ncel bilgileri d�zenleyiniz: </span>" alan�na giriniz.<br>
  		<b>Uyar�: </b>E�er iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 4: </b>Bilgiyi kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 5: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz. <br>
		<b>Ad�m 6: </b>��iniz bitti ise pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>>  "Nas�l...?" a geri </a></font>
</ul>
<a name="lot"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
�mplantlar, k�me no, sipari� no vs. notlar� nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b>"<span style="background-color:yellow" > Notlar <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>" �zerindeki  <img <?php echo createComIcon('../','clip.gif','0') ?>> simgesini t�klay�n�z.<br>
	<b>Ad�m 2: </b>Ek notlar i�in giri� alan�n� g�steren bir pencere a��l�r.<br>
	<b>Ad�m 3: </b>K�me, sipari�, implantlar hakk�ndaki bilgileri <br> "<span style="background-color:yellow" > L�tfen yeni bilgiyi buraya giriniz: </span>" alan�na yaz�n�z.<br>
  		<b>Uyar�: </b>G�ncel bilgileri  <br>gerekir ise "<span style="background-color:yellow" > G�ncel bilgiler: </span>" alan�ndan d�zenleyebilirsiniz.<br>
  		<b>Uyar�: </b>E�er iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 4: </b>Bilgiyi kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 5: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz. <br>
		<b>Ad�m 6: </b>��iniz bitti ise pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>>  "Nas�l...?" a geri </a></font>
</ul>
<a name="med"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
�la� ve doz plan� nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b> "<span style="background-color:yellow" > �la� </span>" yaz�s�n� t�klay�n�z.<br>
	<b>Ad�m 2: </b>�la� ve doz planlar� giri� alanlar�n� g�steren bir pencere a��l�r.<br>
	<b>Ad�m 3: </b>�lac� sol s�tuna yaz�n�z.<br> 
	<b>Ad�m 4: </b>Doz plan�n� orta s�tuna yaz�n�z.<br> 
	<b>Ad�m 5: </b>Gerekir ise ilac�n renk kodu se�me kutusunu t�klay�n�z.<br> 
	<ul type=disc>
		<li>Beyaz normal veya �n se�imli.
		<li><span style="background-color:#00ff00" >Ye�il</span> antibiyotikler ve t�revleri i�in.
		<li><span style="background-color:yellow" >Sar�</span> diyaliz ila�lar� i�in.
		<li><span style="background-color:#0099ff" >Mavi</span> koag�lan veya anti koag�lan ila�lar i�in.
		<li><span style="background-color:#ff0000" >K�rm�z�</span> intraven�z uygulanan ila�lar i�in.
	</ul>
  	<b>Uyar�: </b>Gerekir ise g�ncel bilgileri de <br>d�zenleyebilirsiniz.<br>
	<b>Ad�m 6: </b>�sminizi "<span style="background-color:yellow" > Hem�ire: </span>" alan�na yaz�n�z.<br> 
  		<b>Uyar�:  </b>E�er iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 7: </b>�la� tedavisi plan�n� kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 8: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz. <br>
		<b>Ad�m 9: </b>��iniz bitti ise pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>>  "Nas�l...?" a geri </a></font>
</ul>
<a name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
G�nl�k ila� uygulama ve dozaj bilgisi nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b>Se�ilen tarih ile ilgili ya bo� bir ila� s�tununu veya mevcut bilgiyi t�klay�n�z.<br>
	<b>Ad�m 2: </b>�lgili g�n bilgisi i�in giri� alanlar� ile ilac�, doz �emas�n� g�steren bir pencere a��l�r.<br>
	<b>Ad�m 3: </b>Se�ilen ila�la ilgili giri� alan�n� t�klay�n�z.<br>
	<b>Ad�m 4: </b>Alana dozaj�, veya aplikat�r bilgisini veya ba�la/son sembollerini yaz�n�z.<br>
  		<b>Uyar�: </b>E�er iptal etmek ister iseniz,  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 5: </b>E�er birka� giri�iniz var ise kaydetmeden �nce hepsini giriniz.<br>
		<b>Ad�m 6: </b>Bilgiyi kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 7: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz. <br>
		<b>Ad�m 8: </b>��iniz bitti ise pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>>  "Nas�l...?" a geri </a></font>
</ul>
<a name="iv"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
G�nl�k intraven�z ila� uygulamas� ve dozaj nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b>Se�ilen tarihe kar��l�k gelen <span style="background-color:yellow" > �ntraven�z>> </span>" yaz�s�n�n yan�ndaki bo� bir kolonu ya da mevcut bilgiyi t�klay�n�z.<br>
	<b>Ad�m 2: </b>G�n�n intraven�z ila� bilgisi giri� alan�n� g�steren bir pencere a��l�r.<br>
	<b>Ad�m 3: </b> "<span style="background-color:yellow" > Buraya yeni bilgi giriniz veya mevcut bilgiyi g�ncelleyiniz: </span>" alan�na ya dozaj, veya aplikat�r bilgisi, veya ba�la/bitir sembollerini yaz�n�z.<br>
  		<b>Uyar�: </b>E�er iptal etmek ister iseniz,  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 5: </b>E�er birka� giri�iniz var ise kaydetmeden �nce hepsini giriniz.<br>
		<b>Ad�m 6: </b>Bilgiyi kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 7: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz. <br>
		<b>Ad�m 8: </b>��iniz bitti ise pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>>  "Nas�l...?" a geri </a></font>
</ul>
<?php elseif(($src=="")&&($x1=="template")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<span style="background-color:yellow" >Bug�n�n listesi hen�z olu�turulmam��</span> oldu�u zaman ne yapmal�y�m?</b></font>
<ul> <b>Ad�m 1: </b>En son kaydedilen listeyi bulmak i�in <input type="button" value="Son hasta listesini g�ster"> d��mesini t�klay�n�z.
                                                                     <br>
		<b>Ad�m 2: </b>Son 31 g�n i�inde kaydedilmi� bir liste bulunur ise g�r�nt�lenir.<br>
		<b>Ad�m 3: </b> <input type="button" value="Bu listeyi bug�n i�in kopyala."> d��mesini t�klay�n�z<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Son hasta listesini g�rmek istemiyorum. Yeni bir liste nas�l olu�turulur?</b></font>
<ul> <b>Ad�m 1: </b>Oda numaras� ve yata�a kar��l�k gelen  <img <?php echo createComIcon('../','plus2.gif','0') ?>> d��mesini t�klay�n�z.
                                                                     <br>
		<b>Ad�m 2: </b>Hasta aramak i�in bir pencere a��l�r.<br>
		<b>Ad�m 3: </b>�nce �e�itli giri� alanlar�ndan birine aranacak bir anahtar s�zc�k girip hastay� bulunuz.<br>
		Hastay� ...<ul type="disc">
		<li>protokol numaras�na g�re bulmak isterseniz numaray� <br>"<span style="background-color:yellow" >Hasta no.:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" alan�na giriniz.
		<li>Soyad�na g�re bulmak i�in soyad veya ilk birka� harfini  <br>"<span style="background-color:yellow" >Soyad:</span><input type="text" name="t" size=19 maxlength=10 value="Schmitt">" alan�na giriniz.
		<li>Ada g�re bulmak i�in ad�n� vaya ad�n�n ilk birka� harfini <br>"<span style="background-color:yellow" >Ad�:</span><input type="text" name="t" size=19 maxlength=10 value="Peter">" alan�na giriniz.
		<li>Do�um tarihine g�re bulmak i�in, do�um tarihini veya ilk birka� rakam�n� <br>"<span style="background-color:yellow" >Do�um tarihi:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">" alan�na giriniz.
		</ul>
		<b>Ad�m 4: </b>Hastay� aramaya ba�lamak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 5: </b>Arama bir ya da birka� sonu� bulur ise, bir hasta listesi g�r�nt�lenir.<br>
		<b>Ad�m 6: </b>Do�ru hastay� se�mek i�in, ilgili&nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> d��mesini t�klay�n�z.<br>
</ul>
<?php elseif(($src=="getlast")&&($x1=="last")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bug�nk� yatan hasta listesinin son kaydedilmi� olan� nas�l g�r�nt�lenir?</b></font>
<ul> <b>Ad�m 1: </b>Son kay�t edilmi� listeyi kopyalamak i�in <input type="button" value="Bug�n i�in yine de bu listeyi kopyala."> d��mesini t�klay�n�z.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Son yatan hasta listesi g�r�nt�leniyor fakat onu kopyalamak istemiyorum. Yeni bir listeyi nas�l ba�lat�r�m? </b></font>
<ul> <b>Ad�m 1: </b>Yeni bir liste olu�turmaya ba�lamak i�in  <input type="button" value="Bunu kopyalama! Yeni bir liste olu�tur."> d��mesini t�klay�n�z.
</ul>
<?php elseif($src=="assign") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir yatak bir hastaya nas�l verilir?</b></font>
<ul> <b>Ad�m 1: </b>�nce �e�itli giri� alanlar�ndan birine aranacak bir anahtar s�zc�k girip hastay� bulunuz.<br>
		Hastay� ...<ul type="disc">
		<li>protokol numaras�na g�re bulmak isterseniz numaray� <br>"<span style="background-color:yellow" >Hasta no.:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" alan�na giriniz.
		<li>Soyad�na g�re bulmak i�in soyad veya ilk birka� harfini  <br>"<span style="background-color:yellow" >Soyad:</span><input type="text" name="t" size=19 maxlength=10 value="Schmitt">" alan�na giriniz.
		<li>Ada g�re bulmak i�in ad�n� vaya ad�n�n ilk birka� harfini <br>"<span style="background-color:yellow" >Ad�:</span><input type="text" name="t" size=19 maxlength=10 value="Peter">" alan�na giriniz.
		<li>Do�um tarihine g�re bulmak i�in, do�um tarihini veya ilk birka� rakam�n� <br>"<span style="background-color:yellow" >Do�um tarihi:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">" alan�na giriniz.
		</ul>
		<b>Ad�m 2: </b>Hastay� aramaya ba�lamak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 3: </b>Arama bir ya da birka� sonu� bulur ise, bir hasta listesi g�r�nt�lenir.<br>
		<b>Ad�m 4: </b>Do�ru hastay� se�mek i�in, ilgili&nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir yatak nas�l kilitlenir?</b></font>
<ul> <b>Ad�m 1: </b>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Bu yata�� kilitle</font> </span>" d��mesini t�klay�n�z.<br>
		<b>Ad�m 2: </b>Onay istenince &nbsp;<button>Tamam</button> d��mesini t�klay�n�z.<p>
</ul>
  <b>Uyar�: </b>�ptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.</ul>
  
<?php elseif($src=="remarks") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hasta hakk�nda not veya uyar�lar nas�l yaz�l�r?</b></font>
<ul> <b>Ad�m 1: </b>Metin giri� alan�na t�klay�n�z.<br>
		<b>Ad�m 2: </b>Uyar� ve notlar�n�z� yaz�n�z<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yazmay� bitirdim. Uyar� veya notlar nas�l kay�t edilir?</b></font>
<ul> 	<b>Ad�m 1: </b>Kay�t etmek i�in <input type="button" value="Kay�t et"> d��mesini t�klay�n�z.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Uyar�lar� kay�t ettim. Pencereyi nas�l kapat�r�m?</b></font>
<ul> 	<b>Ad�m 1: </b>Pencereyi kapatmak i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> d��mesini t�klay�n��z.<p>
</ul>
<?php elseif($src=="discharge") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hasta nas�l ��kar�l�r?</b></font>
<ul> <b>Ad�m 1: </b>��k�� tipini ilgili d��meye t�klay�p se�iniz<br>
	<ul><br>
		<input type="radio" name="relart" value="reg" checked> Normal ��k��<br>
                 	<input type="radio" name="relart" value="self"> Hasta kendi iste�i ile hastaneyi tterk etti<br>
                 	<input type="radio" name="relart" value="emgcy"> Acil ��k��<br>  <br>
	</ul>
		<b>Ad�m 2: </b>E�er var ise  "<span style="background-color:yellow" > Uyar�: </span>" alan�na ��k�� ile ilgili ek uyar� ve notlar� yaz�n�z. <br>
		<b>Ad�m 3: </b>E�er bo� ise isminizi "<span style="background-color:yellow" > Hem�ire: <input type="text" name="a" size=20 maxlength=20></span>" alan�na yaz�n�z. <br>
		<b>Ad�m 4: </b> " <span style="background-color:yellow" ><input type="checkbox" name="d" value="d"> Evet, eminim. Hastay� ��kar. </span>" alan�n� i�aretleyiniz. <br>
		<b>Ad�m 5: </b>Hastay� ��karmak i�in <input type="button" value="��kar"> d��mesini t�klay�n�z.<p>
		<b>Ad�m 6: </b>Servisin yatan hasta listesinin son durumuna geri gitmek i�in  <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<input type="button" value="��kar"> d��mesini t�klamay� denedim, ama yan�t yoktu. Neden?</b></font>
<ul> <b>Uyar�: </b>A�a��daki se�im kutular� se�ilmeli ve ��yle g�r�nmelidir.: <br>
 " <span style="background-color:yellow" ><input type="checkbox" name="d" value="d" checked> Evet, Eminim. Hastay� ��kar. </span>". <p>
		<b>Ad�m 1: </b>Se�ili de�il ise se�in kutusunu se�iniz.<p>
</ul>
  <b>Uyar�: </b>�ptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.</ul>

<?php endif ?>

</form>

