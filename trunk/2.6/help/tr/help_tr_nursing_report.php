<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<a name="howto">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php if($x1=="docs") print "Doktor orderlar�"; else print "Hem�ire g�zlemi"; ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<?php if($x1=="docs") print "Doktor orderlar�"; else print "Hem�ire g�zlemi"; ?> nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b>"<?php if($x1=="docs") print "Doktor orderlar�"; else print "Hem�ire g�zlemi"; ?>" s�tunundaki "<span style="background-color:yellow" > Tarih: <input type="text" name="d" size=10 maxlength=10 value="10.10.2002"> </span>" alan�na tarihi giriniz.<br>
		<font color="#000099" size=1><b>�p u�lar�:</b>
		<ul type=disc>
		<li>G�n�n tarihini girmek i�in "t" veya "T" (today=bug�n anlam�nda) giriniz. G�n�n tarihi otomatik olarak tarih alan�nda g�r�n�r
		<li>Veya alan�n alt�ndaki <img <?php echo createComIcon('../','arrow-t.gif','0') ?>> d��mesini t�klay�n�z. G�n�n tarihi otomatik olarak tarih alan�nda g�r�nt�lenir.
		<li>D�nk� tarihi girmek i�in tarih alan�na "y" veya "Y"  (D�n=yesterday) anlam�nda giriniz. D�nk� tarih otomatik olarak tarih alan�nda g�r�nt�lenir.
		</font>
		</ul>
	<b>Ad�m 2:  </b>"<?php if($x1=="docs") print "Doktor orderlar�"; else print "Hem�ire g�zlemi"; ?>" s�tunundaki "<span style="background-color:yellow" > Zaman: <input type="text" name="d" size=10 maxlength=10 value="10.35"> </span>" alan�na zaman� giriniz.<br>
		<font color="#000099" size=1><b>�pucu:</b>
		<ul type=disc>
		<li>Zaman alan�na g�ncel zaman� girmek i�in "n" neya "N" (Now=�imdi anlam�nda) giriniz. G�ncel zaman otomatik olarak zaman alan�nda g�r�nt�lenir.
		<li>Veya zaman alan�n�n alt�ndaki  <img <?php echo createComIcon('../','arrow-t.gif','0') ?>> simgesini t�klay�n�z. G�ncel zaman zaman alan�nda g�r�nt�lenir.
		</font>
		</ul>
	<b>Ad�m 3: </b><?php if($x1=="docs") print "Doktor orderlar�n�"; else print "Hem�ire g�zlemini"; ?>  "<span style="background-color:yellow" > <?php if($x1=="docs") print "Doktor orderlar�"; else print "Hem�ire g�zlemi"; ?>: <input type="text" name="d" size=10 maxlength=10 value="Tetkik raporu"> </span>" alan�na yaz�n�z.<br>
		<font color="#000099" size=1><b>�pucu:</b>
		<ul type=disc>
		<li>  E�er <img <?php echo createComIcon('../','warn.gif','0') ?>>  sembol�n�n  <?php if($x1=="docs") print "doktor orderlar�"; else print "hem�ire g�zlem ka��d�"; ?> ba��nda g�r�nmesini ister iseniz "<span style="background-color:yellow" > <input type="checkbox" name="c" value="c"> <img <?php echo createComIcon('../','warn.gif','0') ?>> Bu i�areti ba�lang�ca koyunuz. </span>" kutusunu i�aretleyiniz,.
		<li> <?php if($x1=="docs") print "order veya"; ?> raporu belirgin yazmak ister iseniz, s�zc�k veya c�mleyi yazmadan �nce  <img <?php echo createComIcon($root_path,'color_marker_yellow.gif','0','',TRUE) ?>><?php echo '<b><font color="#000000">Ba�la</b></font>' ?> simgesini t�klay�n�z. Belirgin yaz�ya son vermek i�in belirgin yaz�n�n son harfini yazd�ktan sonra  <img <?php echo createComIcon($root_path,'color_marker_yellow.gif','0','',TRUE) ?>><?php echo '<b><font color="#000000">Bitir</b></font>' ?> simgesini t�klay�n�z.
		</font>
		</ul>
	<b>Ad�m 4: </b>Ad soyad ilk harflerinizi "<span style="background-color:yellow" > �mza: <input type="text" name="d" size=3 maxlength=3 value="AHK"> </span>" alan�na giriniz.<br>
  		<b>Uyar�: </b>�ptal etmek isterseniz,  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 5: </b>Bilgiyi kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> simgesini t�klay�n�z.<br>
		<b>Ad�m 6: </b>��iniz bitti ise, pencereyi kapat�p hastan�n veri klas�r�ne geri gitmek i�in <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> simgesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<?php if($x1=="docs") print "Doktora bir soru"; else print "Bir etkinlik raporu"; ?> nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b>Tarihi "<?php if($x1=="docs") print "Doktora sorular"; else print "Etkinlik raporu"; ?>" s�tunundaki "<span style="background-color:yellow" > Tarih: <input type="text" name="d" size=10 maxlength=10 value="10.10.2002"> </span>" alan�na giriniz.<br>
		<font color="#000099" size=1><b>�p u�lar�:</b>
		<ul type=disc>
		<li>G�ncel tarihi girmek i�in tarih alan�na "t" veya "T" (Today=Bug�n anlam�nda) yaz�n�z. G�ncel tarih otomatik olarak tarih alan�nda g�r�nt�lenir.
		<li>Veya alan�n alt�ndaki  <img <?php echo createComIcon('../','arrow-t.gif','0') ?>> d��mesini t�klay�n�z. G�ncel tarih otomatik olarak tarih alan�nda g�r�nt�lenir.
		<li>D�n�n tarihini girmek i�in tarih alan�na "y" veya "Y" (Yesterday=d�n anlam�nda) yaz�n�z. D�nk� tarih otomatik olarak tarih alan�nda g�r�nt�lenir.
		</font>
		</ul>
	<b>Ad�m 2: </b><?php if($x1=="docs") print "Soruyu "; else print "Etkinlik raporunu "; ?>  "<span style="background-color:yellow" > <?php if($x1=="docs") print "doktora sorular"; else print "etkinlik raporu"; ?>: <input type="text" name="d" size=10 maxlength=10 value="test report"> </span>" alan�na yaz�n�z.<br>
		<font color="#000099" size=1><b>�p u�lar�:</b>
		<ul type=disc>
		<li> <img <?php echo createComIcon('../','warn.gif','0') ?>> sembol�n�n  <?php if($x1=="docs") print "soru"; else print "etkinlik raporu"; ?> yaz�s�n�n ba�lang�c�nda g�r�nmesini ister iseniz  "<span style="background-color:yellow" > <input type="checkbox" name="c" value="c"> <img <?php echo createComIcon('../','warn.gif','0') ?>> Bu i�areti ba�lang�ca koyunuz </span>" se�im kutusunu i�aretleyiniz.
		<li> <?php if($x1=="docs") print "order veya"; ?> raporun bir k�sm�n� belirgin yazmak ister iseniz, c�mle veya s�zc��� yazmadan �nce  <img <?php echo createComIcon($root_path,'color_marker_yellow.gif','0','',TRUE) ?>><?php echo '<b><font color="#000000">Ba�la</b></font>' ?> simgesini t�klay�n�z. Belirgin yaz�ya son vermek i�in belirgin yaz�n�n son harfini yazd�ktan sonra  <img <?php echo createComIcon($root_path,'color_marker_yellow.gif','0','',TRUE) ?>><?php echo '<b><font color="#000000">Bitir</b></font>' ?> simgesini t�klay�n�z.
		</font>
		</ul>
	<b>Ad�m 3: </b>Ad soyad�n�z�n ilk harflerini "<span style="background-color:yellow" > �mza: <input type="text" name="d" size=3 maxlength=3 value="AHK"> </span>" alan�na giriniz.<br>
  		<b>Uyar�: </b>�ptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> simgesini t�klay�n�z.<br>
		<b>Ad�m 4: </b>Bilgiyi kay�t etmek i�in  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> simgesini t�klay�n�z.<br>
		<b>Ad�m 5: </b>��iniz bitti ise, pencereyi kapat�p hastan�n veri klas�r�ne geri d�nmek i�in  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> simgesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
UYARI:</b></font>
<ul> 
	Ayn� zamanda  <?php if($x1=="docs") print "doktor orderlar� ve doktora sorular�"; else print "hem�ire g�zlemi ve etkinlik raporunu"; ?> girebilirsiniz.</ul>

<?php endif ?>
<?php if($src=="diagnosis") : ?>
<a name="extra"><a name="diag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a></a>
Tan�sal rapor nas�l g�r�nt�lenir?</b></font>
<ul> 
  		<b>Uyar�: </b>E�er bir tan�sal rapor var ise, sol s�tunda olu�turuldu�u tarih, olu�turan diagnostik klinik veya b�l�m  k�sa bir not halinde g�r�nt�lenir..<p>
  		<b>Uyar�: </b>Listedeki ilk rapor derhal g�r�nt�lenir.<p>
	<b>Ad�m 1: </b>G�r�nt�lemek istedi�iniz tan�sal raporun k�sa notunu t�klay�n�z.<br>	
</ul>
<?php endif ?>
<?php if($src=="kg_atg_etc") : ?>
<a name="pt"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
G�nl�k fizik tedavi (PT), anti tromboz jimnasti�i (Atg), vs. bilgisi nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b>Bilgiyi e<br> "<span style="background-color:yellow" > L�tfen yeni bilgiyi buraya giriniz: </span>" alan�na giriniz.<br>
  		<b>Uyar�: </b>Gerekir ise g�ncel bilgileri "<span style="background-color:yellow" > G�ncel bilgiler: </span>" alan�nda d�zenleyebilirsiniz.<br>
  		<b>Uyar�: </b>�ptal etmek ister iseniz,  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 2: </b>Bilgiyi kay�t etmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 3: </b>Herhangi bir yanl��� d�zeltmek ister iseniz, yanl�� bilgiyi t�klay�n�z, do�rusu ile de�i�tiriniz, tekrar kaydediniz.<br>
		<b>Ad�m 4: </b>��iniz bitti ise, pencereyi kapat�p �izelgeye geri d�nmek i�in  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		
</ul>
<?php endif ?>
<?php if($src=="fotos") : ?>
<a name="coag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Bir foto�raf nas�l �n izlenir?</b></font>
<ul> 
	<b>Ad�m 1: </b>Sol �er�evedeki pul resime t�klay�n�z. Tam b�y�kl�kteki resim sa� �er�evede �ekim tarihi ve �ekim numaras� ile birlikte g�r�nt�lenir.<br>
</ul>
<?php endif ?>
<?php if($src=="anticoag_dailydose") : ?>
<a name="daycoag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
G�nl�k antikoag�lan uygulama bilgisi nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b> <br> "<span style="background-color:yellow" > Yeni bilgiyi buraya giriniz veya g�ncel bilgiyi d�zenleyiniz: </span>" alan�na ya dozaj� veya uygulama bilgisini yaz�n�z.<br>
  		<b>Uyar�: </b>�ptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 2: </b>Bilgiyi kay�t etmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 3: </b>Herhangi bir yanl�� bilgiyi d�zeltmek ister iseniz, yanl�� bilgi �zerine t�klay�n�z, do�rusu ile de�i�tiriniz ve tekrar kay�t ediniz.<br>
		<b>Ad�m 4: </b>��iniz bitti ise, pencereyi kapat�p �izelgeye geri d�nmek i�in  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		
</ul>
<?php endif ?>
<?php if($src=="lot_mat_etc") : ?>
<a name="lot"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
�mplantlar, k�me numaras�, sipari� numaralar� vs. notlar� nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b><br> "<span style="background-color:yellow" > L�tfen yeni bilgiyi buraya giriniz: </span>" alan�na implantlar, k�me, sipari� no bilgisini yaz�n�z.<br>
  		<b>Uyar�: </b>Gerekir ise g�ncel bilgileri "<span style="background-color:yellow" > G�ncel bilgiler: </span>" alan�nda d�zenleyebilirsiniz.<br>
  		<b>Uyar�: </b>�ptal etmek ister iseniz,  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 2: </b>Bilgiyi kay�t etmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 3: </b>Herhangi bir yanl�� bilgiyi d�zeltmek ister iseniz, yanl�� bilgi �zerine t�klay�n�z, do�rusu ile de�i�tiriniz ve tekrar kay�t ediniz.<br>
		<b>Ad�m 4: </b>��iniz bitti ise, pencereyi kapat�p �izelgeye geri d�nmek i�in  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		
</ul>
<?php endif ?>
<?php if($src=="medication") : ?>
<a name="med"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
�la� ve doz bilgisi nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b>�lac� sol s�tuna yaz�n�z.<br> 
	<b>Step 2: </b>Doz plan�n� orta s�tuna yaz�n�z.<br> 
	<b>Ad�m 3: </b>Gerekli ise ilac�n renk kodu se�me kutusunu t�klay�n�z.<br> 
	<ul type=disc>
		<li>Beyaz normal veya �n se�imli.
		<li><span style="background-color:#00ff00" >Ye�il</span> antibiyotikler ve t�revleri i�in.
		<li><span style="background-color:yellow" >Sar�</span> diyaliz ila�lar� i�in.
		<li><span style="background-color:#0099ff" >Mavi</span> hematolojik (koag�lan ve antikoag�lan) ila�lar i�in.
		<li><span style="background-color:#ff0000" >K�rm�z�</span> intraven�z uygulanan ila�lar i�in.
	</ul>
  	<b>Uyar�: </b>Gerekir ise g�ncel bilgileri d�zenleyebilirsiniz.<br>
	<b>Ad�m 4: </b>�sminizi "<span style="background-color:yellow" > Hem�ire: </span>" alan�na yaz�n�z.<br> 
  		<b>Uyar�: </b>�ptal etmek ister iseniz,  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 5: </b>�la� tedavi plan�n� kay�t etmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 6: </b>Herhangi bir yanl�� bilgiyi d�zeltmek ister iseniz, yanl�� bilgi �zerine t�klay�n�z, do�rusu ile de�i�tiriniz ve tekrar kay�t ediniz.<br>
		<b>Ad�m 7: </b>��iniz bitti ise, pencereyi kapat�p �izelgeye geri d�nmek i�in  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		
</ul>
<?php endif ?>
<?php if($src=="medication_dailydose") : ?>
	<?php if($x2) : ?>

<a name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
G�nl�k ila� uygulamas� ve dozaj bilgisi nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b>Se�ilen ilac�n giri� alan�n� t�klay�n�z.<br>
	<b>Ad�m 2: </b>Alana ya dozaj�, ya aplikat�r bilgisini, veya ba�la/bitir i�aretlerini yaz�n�z.<br>
  		<b>Uyar�: </b>�ptal etmek ister iseniz,  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 3: </b>Birka� bilgi girecek iseniz, kay�t etmeden �nce hepsini giriniz.<br>
		<b>Ad�m 4: </b>Bilgiyi kay�t etmek i�in  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 5: </b>Herhangi bir yanl�� bilgiyi d�zeltmek ister iseniz, yanl�� bilgi �zerine t�klay�n�z, do�rusu ile de�i�tiriniz ve tekrar kay�t ediniz.<br>
		<b>Ad�m 6: </b>��iniz bitti ise, pencereyi kapat�p �izelgeye geri d�nmek i�in  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		
</ul>
	<?php else : ?>
<a name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
"Hen�z ila� yok." yaz�yor. Ne yapmal�y�m?</b></font>
<ul> 
		<b>Ad�m 1: </b>Pencereyi kapat�p �izelgeye geri d�nmek i�in  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
	<b>Ad�m 2: </b> "<span style="background-color:yellow" > �la� tedavisi </span>" yaz�s�n� t�klay�n�z.<br>
	<b>Ad�m 3: </b>�la� tedavisi ve doz �emalar�n�n giri� alanlar�n� i�eren bir pencere a��l�r.<br>
	<b>Ad�m 4: </b>�lac� sol s�tuna yaz�n�z.<br> 
	<b>Ad�m 5: </b>Doz �emas�n� orta s�tuna yaz�n�z.<br> 
	<b>Ad�m 6: </b>Gerekir ise ilac�n renk kodu se�me kutusunu t�klay�n�z.<br> 
	<ul type=disc>
		<li>Beyaz normal veya �n se�imli.
		<li><span style="background-color:#00ff00" >Ye�il</span> antibiyotikler ve t�revleri i�in.
		<li><span style="background-color:yellow" >Sar�</span> diyaliz ila�lar� i�in.
		<li><span style="background-color:#0099ff" >Mavi</span> hematolojik (koag�lan ve antikoag�lan) ila�lar i�in.
		<li><span style="background-color:#ff0000" >K�rm�z�</span> intraven�z uygulanan ila�lar i�in.
	</ul>
  	<b>Uyar�: </b>Gerekir ise g�ncel bilgileri de <br>d�zenleyebilirsiniz.<br>
	<b>Ad�m 7: </b>�sminizi "<span style="background-color:yellow" > Hem�ire: </span>" alan�na yaz�n�z.<br> 
  		<b>Uyar�: </b>�ptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 8: </b>Tedavi plan�n� kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 9: </b>Herhangi bir yanl�� bilgiyi d�zeltmek ister iseniz, yanl�� bilgi �zerine t�klay�n�z, do�rusu ile de�i�tiriniz ve tekrar kay�t ediniz.<br>
		<b>Ad�m 10: </b>��iniz bitti ise, pencereyi kapat�p �izelgeye geri d�nmek i�in  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
</ul>
	<?php endif ?>
<?php endif ?>
<?php if($src=="iv_needle") : ?>
<a name="iv"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
G�nl�k intraven�z ila� uygulama ve dozaj bilgisi nas�l girilir?</b></font>
<ul> 
	<b>Ad�m 1: </b>  "<span style="background-color:yellow" > Yeni bilgiyi buraya giriniz veya g�ncel bilgiyi d�zenleyiniz: </span>" alan�na ya dozaj� veya uygulama bilgisini yaz�n�z.<br>
  		<b>Uyar�: </b>�ptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.<br>
		<b>Ad�m 2: </b>Bilgiyi kay�t etmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 3: </b>Herhangi bir yanl�� bilgiyi d�zeltmek ister iseniz, yanl�� bilgi �zerine t�klay�n�z, do�rusu ile de�i�tiriniz ve tekrar kay�t ediniz.<br>
		<b>Ad�m 4: </b>��iniz bitti ise, pencereyi kapat�p �izelgeye geri d�nmek i�in  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.<br>
		
</ul>

<?php endif ?>

</form>

