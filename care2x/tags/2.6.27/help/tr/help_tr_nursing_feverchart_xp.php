<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<a name="howto">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "$x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="bp_temp") : ?>
<a name="cbp"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Derece veya kan bas�nc� nas�l girilir?</b></font>
<ul> <b>Ad�m 1: </b>Veriyi ve zaman� giriniz.<br>
		<ul type="disc">
		<li>Zaman ve kan bas�nc�n� soldaki "<font color="#cc0000">Kan bas�nc�</font>" s�tununa giriniz.<br>
		�rnek: <input type="text" name="v" size=5 maxlength=5 value="10.05">&nbsp;&nbsp;<input type="text" name="w" size=8 maxlength=8 value="128/85">
		<li>Zaman ve dereceyi sa�daki "<font color="#0000ff">Derece</font>" s�tununa giriniz.<br>
		�rnek: <input type="text" name="t" size=5 maxlength=5 value="12.35">&nbsp;&nbsp;<input type="text" name="u" size=8 maxlength=8 value="37.3">
		</ul>		
		<ul >
		<font color="#000099" size=1><b>�pucu:</b> �u andaki zaman� kay�t etmek i�in zaman alan�na "n" veya "N" (Now=�imdi anlam�nda) giriniz. �u andaki zaman alana otomatik olarak girilir.</font>
		</ul>
		<b>Ad�m 2: </b>Birka� bilgi var ise, kay�t etmeden �nce hepsini giriniz.<br>
		<b>Ad�m 3: </b>Yeni girilen bilgiyi kay�t etmek i�in  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 4: </b>Herhangi bir hatay� d�zeltmek ister iseniz, hatal� verilerin �zerine t�klay�n�z ve do�rusunu yaz�n�z.<br>
		<b>Ad�m 5: </b>��iniz bitti ise, pencereyi kapat�p �izelgeye geri d�nmek i�in  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		
</ul>
<?php endif ?>
<?php if($src=="diet") : ?>

<a name="diet"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Diyet plan� nas�l girilir?</b></font>
<ul> <b>Ad�m 1: </b>Diyet plan�n�<br> "<span style="background-color:yellow" > Yeni bilgiyi buraya giriniz veya olanlar� d�zenleyiniz </span>" alan�na giriniz.<br>
		<b>Ad�m 2: </b>Yeni diyet plan�n� kay�t etmek i�in  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
  		<b>Uyar�: </b>�ptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 3: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz.<br>
		<b>Ad�m 4: </b>��iniz bitti ise , pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		
</ul>
<?php endif ?>
<?php if($src=="allergy") : ?>
<a name="allergy"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Allerji bilgisi nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b>Allerji veya CAVE bilgisini<br> "<span style="background-color:yellow" > L�tfen yeni bilgiyi buraya giriniz: </span>" alan�na yaz�n�z.<br>
  		<b>Uyar�: </b>G�ncel bilgileri <br> gerekirse "<span style="background-color:yellow" > G�ncel bilgiler: </span>" alan�nda d�zenleyebilirsiniz.<br>
  		<b>Uyar�: </b>�ptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 2: </b>Bilgiyi kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 3: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz.<br>
		<b>Ad�m 4: </b>��iniz bitti ise , pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		
</ul>
<?php endif ?>
<?php if($src=="diag_ther") : ?>
<a name="diag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Ana tan� ve/veya tedavi nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b>Tan� veya tedavi bilgisini <br> "<span style="background-color:yellow" > L�tfen yeni bilgiyi buraya giriniz: </span>" alan�na giriniz.<br>
  		<b>Uyar�: </b>G�ncel bilgileri<br>gerekir ise "<span style="background-color:yellow" > G�ncel bilgiler: </span>" alan�nda d�zenleyebilirsiniz.<br>
  		<b>Uyar�: </b>�ptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 2: </b>Bilgiyi kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 3: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz.<br>
		<b>Ad�m 4: </b>��iniz bitti ise, pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		
</ul>
<?php endif ?>
<?php if($src=="diag_ther_dailyreport") : ?>
<a name="daydiag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
G�nl�k tan� veya tedavi plan� nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b>Tan� veya tedavi bilgisini <br> "<span style="background-color:yellow" > L�tfen yeni bilgiyi buraya giriniz: </span>" alan�na yaz�n�z.<br>
  		<b>Uyar�: </b>G�ncel bilgileri <br>gerekir ise "<span style="background-color:yellow" > G�ncel bilgiler: </span>" alan�ndan d�zenleyebilirsiniz.<br>
  		<b>Uyar�: </b>E�er iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 2: </b>Bilgiyi kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 3: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz. <br>
		<b>Ad�m 4: </b>��iniz bitti ise pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		
</ul>
<?php endif ?>
<?php if($src=="xdiag_specials") : ?>
<a name="extra"><a name="diag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a></a>
Notlar, ek tan�lar nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b>Notlar� ve ek tan�lar� <br> "<span style="background-color:yellow" > L�tfen yeni bilgiyi buraya giriniz: </span>" alan�na giriniz.<br>
  		<b>Uyar�: </b> G�ncel bilgileri <br> gerekir ise "<span style="background-color:yellow" > G�ncel bilgiler: </span>" alan�ndan d�zenleyebilirsiniz.<br>
  		<b>Uyar�: </b>E�er iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 2: </b>Bilgiyi kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 3: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz. <br>
		<b>Ad�m 4: </b>��iniz bitti ise pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		
</ul>
<?php endif ?>
<?php if($src=="kg_atg_etc") : ?>
<a name="pt"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
G�nl�k fizik tedavi,(PT), Antitromboz jimnasti�i (Atg), vs. bilgisi nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b>Bilgiyi <br> "<span style="background-color:yellow" > L�tfen yeni bilgiyi buraya giriniz: </span>" alan�na yaz�n�z.<br>
  		<b>Uyar�: </b>G�ncel bilgileri <br>gerekir ise "<span style="background-color:yellow" > G�ncel bilgiler: </span>" alan�ndan d�zenleyebilirsiniz.<br>
  		<b>Uyar�: </b>E�er iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 2: </b>Bilgiyi kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 3: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz. <br>
		<b>Ad�m 4: </b>��iniz bitti ise pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		
</ul>
<?php endif ?>
<?php if($src=="anticoag") : ?>
<a name="coag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Antikoag�lanlar nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b>Antikoag�lanlar ve doz bilgisini <br> "<span style="background-color:yellow" > L�tfen yeni bilgiyi buraya giriniz: </span>" alan�na yaz�n�z.<br>
  		<b>Uyar�: </b>G�ncel bilgileri <br>gerekir ise "<span style="background-color:yellow" > G�ncel bilgiler: </span>" alan�ndan d�zenleyebilirsiniz.<br>
  		<b>Uyar�: </b>E�er iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 2: </b>Bilgiyi kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 3: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz. <br>
		<b>Ad�m 4: </b>��iniz bitti ise pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		
</ul>
<?php endif ?>
<?php if($src=="anticoag_dailydose") : ?>
<a name="daycoag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
G�nl�k antikoag�lan uygulamas� bilgisi nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b>Ya dozaj veya aplikat�r bilgisini <br> "<span style="background-color:yellow" > Buraya yeni bilgi giriniz veya g�ncel bilgileri d�zenleyiniz: </span>" alan�na giriniz.<br>
  		<b>Uyar�: </b>E�er iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 2: </b>Bilgiyi kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 3: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz. <br>
		<b>Ad�m 4: </b>��iniz bitti ise pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		
</ul>
<?php endif ?>
<?php if($src=="lot_mat_etc") : ?>
<a name="lot"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
�mplantlar, k�me no, sipari� no vs. notlar� nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b>K�me, sipari�, implantlar hakk�ndaki bilgileri <br> "<span style="background-color:yellow" > L�tfen yeni bilgiyi buraya giriniz: </span>" alan�na yaz�n�z.<br>
  		<b>Uyar�: </b>G�ncel bilgileri  <br>gerekir ise "<span style="background-color:yellow" > G�ncel bilgiler: </span>" alan�ndan d�zenleyebilirsiniz.<br>
  		<b>Uyar�: </b>E�er iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 2: </b>Bilgiyi kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 3: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz. <br>
		<b>Ad�m 4: </b>��iniz bitti ise pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		
</ul>
<?php endif ?>
<?php if($src=="medication") : ?>
<a name="med"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
�la� ve doz plan� nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b>�lac� sol s�tuna yaz�n�z.<br> 
	<b>Ad�m 2: </b>Doz plan�n� orta s�tuna yaz�n�z.<br> 
	<b>Ad�m 3: </b>Gerekir ise ilac�n renk kodu se�me kutusunu t�klay�n�z.<br> 
	<ul type=disc>
		<li>Beyaz normal veya �n se�imli.
		<li><span style="background-color:#00ff00" >Ye�il</span> antibiyotikler ve t�revleri i�in.
		<li><span style="background-color:yellow" >Sar�</span> diyaliz ila�lar� i�in.
		<li><span style="background-color:#0099ff" >Mavi</span> koag�lan veya anti koag�lan ila�lar i�in.
		<li><span style="background-color:#ff0000" >K�rm�z�</span> intraven�z uygulanan ila�lar i�in.
	</ul>
  	<b>Uyar�: </b>Gerekir ise g�ncel bilgileri de <br>d�zenleyebilirsiniz.<br>
	<b>Ad�m 4: </b>�sminizi "<span style="background-color:yellow" > Hem�ire: </span>" alan�na yaz�n�z.<br> 
  		<b>Uyar�:  </b>E�er iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 5: </b>�la� tedavisi plan�n� kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 6: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz. <br>
		<b>Ad�m 7: </b>��iniz bitti ise pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		
</ul>
<?php endif ?>
<?php if($src=="medication_dailydose") : ?>
	<?php if($x2) : ?>

<a name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
G�nl�k ila� uygulama ve dozaj bilgisi nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b>Se�ilen ila�la ilgili giri� alan�n� t�klay�n�z.<br>
	<b>Ad�m 2: </b>Alana dozaj�, veya aplikat�r bilgisini veya ba�la/son sembollerini yaz�n�z.<br>
  		<b>Uyar�: </b>E�er iptal etmek ister iseniz,  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 3: </b>E�er birka� giri�iniz var ise kaydetmeden �nce hepsini giriniz.<br>
		<b>Ad�m 4: </b>Bilgiyi kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 5: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz. <br>
		<b>Ad�m 6: </b>��iniz bitti ise pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		
</ul>
	<?php else : ?>
<a name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
"Hen�z ila� yok. " yaz�yor. Ne yapmal�y�m?</b></font>
<ul> 
		<b>Ad�m 1: </b>Pencereyi kapat�p �izelgeye geri gitmek i�in  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
	<b>Ad�m 2: </b>"<span style="background-color:yellow" > �la� Tedavisi </span>" yaz�s�n� t�klay�n�z.<br>
	<b>Ad�m 3: </b>�la� ve doz �emas� giri� alanlar�n� g�steren bir pencere a��l�r.<br>
	<b>Ad�m 4: </b>�lac� sol s�tuna yaz�n�z.<br> 
	<b>Ad�m 5: </b>Doz �emas�n� orta s�tuna yaz�n�z.<br> 
	<b>Ad�m 6: </b>Gerekirse ilac�n renk kodu see�enek kutusunuu t�klay�n�z.<br> 
	<ul type=disc>
		<li>Beyaz normal veya �n se�imli.
		<li><span style="background-color:#00ff00" >Ye�il</span> antibiyotikler ve t�revleri i�in.
		<li><span style="background-color:yellow" >Sar�</span> diyaliz ila�lar� i�in.
		<li><span style="background-color:#0099ff" >Mavi</span> koag�lan veya anti koag�lan ila�lar i�in.
		<li><span style="background-color:#ff0000" >K�rm�z�</span> intraven�z uygulanan ila�lar i�in.
	</ul>
  	<b>Uyar�: </b>Gerekir ise g�ncel bilgileri de <br>d�zenleyebilirsiniz.<br>
	<b>Ad�m 7: </b>�sminizi "<span style="background-color:yellow" > Hem�ire: </span>" alan�na yaz�n�z.<br> 
  		<b>Uyar�:  </b>E�er iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 8: </b>�la� tedavisi plan�n� kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 9: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz. <br>
		<b>Ad�m 10: </b>��iniz bitti ise pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
</ul>
	<?php endif ?>
<?php endif ?>
<?php if($src=="iv_needle") : ?>
<a name="iv"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
G�nl�k intraven�z ila� uygulamas� ve dozaj nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b> "<span style="background-color:yellow" > Buraya yeni bilgi giriniz veya mevcut bilgiyi g�ncelleyiniz: </span>" alan�na ya dozaj, veya aplikat�r bilgisi, veya ba�la/bitir sembollerini yaz�n�z.<br>
  		<b>Uyar�: </b>E�er iptal etmek ister iseniz,  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 2: </b>Bilgiyi kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 3: </b>Her hangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgilerin �zerine t�klay�n�z, do�rular� ile de�i�tiriniz ve tekrar kaydediniz. <br>
		<b>Ad�m 4: </b>��iniz bitti ise pencereyi kapat�p �izelgeye geri d�nmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		
</ul>

<?php endif ?>

</form>

