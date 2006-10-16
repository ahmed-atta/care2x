<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<a name="howto">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "$x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="bp_temp") : ?>
<a name="cbp"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Derece veya kan basıncı nasıl girilir?</b></font>
<ul> <b>Adım 1: </b>Veriyi ve zamanı giriniz.<br>
		<ul type="disc">
		<li>Zaman ve kan basıncını soldaki "<font color="#cc0000">Kan basıncı</font>" sütununa giriniz.<br>
		Örnek: <input type="text" name="v" size=5 maxlength=5 value="10.05">&nbsp;&nbsp;<input type="text" name="w" size=8 maxlength=8 value="128/85">
		<li>Zaman ve dereceyi sağdaki "<font color="#0000ff">Derece</font>" sütununa giriniz.<br>
		Örnek: <input type="text" name="t" size=5 maxlength=5 value="12.35">&nbsp;&nbsp;<input type="text" name="u" size=8 maxlength=8 value="37.3">
		</ul>		
		<ul >
		<font color="#000099" size=1><b>İpucu:</b> Şu andaki zamanı kayıt etmek için zaman alanına "n" veya "N" (Now=Şimdi anlamında) giriniz. Şu andaki zaman alana otomatik olarak girilir.</font>
		</ul>
		<b>Adım 2: </b>Birkaç bilgi var ise, kayıt etmeden önce hepsini giriniz.<br>
		<b>Adım 3: </b>Yeni girilen bilgiyi kayıt etmek için  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 4: </b>Herhangi bir hatayı düzeltmek ister iseniz, hatalı verilerin üzerine tıklayınız ve doğrusunu yazınız.<br>
		<b>Adım 5: </b>İşiniz bitti ise, pencereyi kapatıp çizelgeye geri dönmek için  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		
</ul>
<?php endif ?>
<?php if($src=="diet") : ?>

<a name="diet"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Diyet planı nasıl girilir?</b></font>
<ul> <b>Adım 1: </b>Diyet planını<br> "<span style="background-color:yellow" > Yeni bilgiyi buraya giriniz veya olanları düzenleyiniz </span>" alanına giriniz.<br>
		<b>Adım 2: </b>Yeni diyet planını kayıt etmek için  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
  		<b>Uyarı: </b>İptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 3: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz.<br>
		<b>Adım 4: </b>İşiniz bitti ise , pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		
</ul>
<?php endif ?>
<?php if($src=="allergy") : ?>
<a name="allergy"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Allerji bilgisi nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b>Allerji veya CAVE bilgisini<br> "<span style="background-color:yellow" > Lütfen yeni bilgiyi buraya giriniz: </span>" alanına yazınız.<br>
  		<b>Uyarı: </b>Güncel bilgileri <br> gerekirse "<span style="background-color:yellow" > Güncel bilgiler: </span>" alanında düzenleyebilirsiniz.<br>
  		<b>Uyarı: </b>İptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 2: </b>Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 3: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz.<br>
		<b>Adım 4: </b>İşiniz bitti ise , pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		
</ul>
<?php endif ?>
<?php if($src=="diag_ther") : ?>
<a name="diag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Ana tanı ve/veya tedavi nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b>Tanı veya tedavi bilgisini <br> "<span style="background-color:yellow" > Lütfen yeni bilgiyi buraya giriniz: </span>" alanına giriniz.<br>
  		<b>Uyarı: </b>Güncel bilgileri<br>gerekir ise "<span style="background-color:yellow" > Güncel bilgiler: </span>" alanında düzenleyebilirsiniz.<br>
  		<b>Uyarı: </b>İptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 2: </b>Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 3: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz.<br>
		<b>Adım 4: </b>İşiniz bitti ise, pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		
</ul>
<?php endif ?>
<?php if($src=="diag_ther_dailyreport") : ?>
<a name="daydiag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Günlük tanı veya tedavi planı nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b>Tanı veya tedavi bilgisini <br> "<span style="background-color:yellow" > Lütfen yeni bilgiyi buraya giriniz: </span>" alanına yazınız.<br>
  		<b>Uyarı: </b>Güncel bilgileri <br>gerekir ise "<span style="background-color:yellow" > Güncel bilgiler: </span>" alanından düzenleyebilirsiniz.<br>
  		<b>Uyarı: </b>Eğer iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 2: </b>Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 3: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz. <br>
		<b>Adım 4: </b>İşiniz bitti ise pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		
</ul>
<?php endif ?>
<?php if($src=="xdiag_specials") : ?>
<a name="extra"><a name="diag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a></a>
Notlar, ek tanılar nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b>Notları ve ek tanıları <br> "<span style="background-color:yellow" > Lütfen yeni bilgiyi buraya giriniz: </span>" alanına giriniz.<br>
  		<b>Uyarı: </b> Güncel bilgileri <br> gerekir ise "<span style="background-color:yellow" > Güncel bilgiler: </span>" alanından düzenleyebilirsiniz.<br>
  		<b>Uyarı: </b>Eğer iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 2: </b>Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 3: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz. <br>
		<b>Adım 4: </b>İşiniz bitti ise pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		
</ul>
<?php endif ?>
<?php if($src=="kg_atg_etc") : ?>
<a name="pt"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Günlük fizik tedavi,(PT), Antitromboz jimnastiği (Atg), vs. bilgisi nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b>Bilgiyi <br> "<span style="background-color:yellow" > Lütfen yeni bilgiyi buraya giriniz: </span>" alanına yazınız.<br>
  		<b>Uyarı: </b>Güncel bilgileri <br>gerekir ise "<span style="background-color:yellow" > Güncel bilgiler: </span>" alanından düzenleyebilirsiniz.<br>
  		<b>Uyarı: </b>Eğer iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 2: </b>Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 3: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz. <br>
		<b>Adım 4: </b>İşiniz bitti ise pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		
</ul>
<?php endif ?>
<?php if($src=="anticoag") : ?>
<a name="coag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Antikoagülanlar nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b>Antikoagülanlar ve doz bilgisini <br> "<span style="background-color:yellow" > Lütfen yeni bilgiyi buraya giriniz: </span>" alanına yazınız.<br>
  		<b>Uyarı: </b>Güncel bilgileri <br>gerekir ise "<span style="background-color:yellow" > Güncel bilgiler: </span>" alanından düzenleyebilirsiniz.<br>
  		<b>Uyarı: </b>Eğer iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 2: </b>Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 3: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz. <br>
		<b>Adım 4: </b>İşiniz bitti ise pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		
</ul>
<?php endif ?>
<?php if($src=="anticoag_dailydose") : ?>
<a name="daycoag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Günlük antikoagülan uygulaması bilgisi nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b>Ya dozaj veya aplikatör bilgisini <br> "<span style="background-color:yellow" > Buraya yeni bilgi giriniz veya güncel bilgileri düzenleyiniz: </span>" alanına giriniz.<br>
  		<b>Uyarı: </b>Eğer iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 2: </b>Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 3: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz. <br>
		<b>Adım 4: </b>İşiniz bitti ise pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		
</ul>
<?php endif ?>
<?php if($src=="lot_mat_etc") : ?>
<a name="lot"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
İmplantlar, küme no, sipariş no vs. notları nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b>Küme, sipariş, implantlar hakkındaki bilgileri <br> "<span style="background-color:yellow" > Lütfen yeni bilgiyi buraya giriniz: </span>" alanına yazınız.<br>
  		<b>Uyarı: </b>Güncel bilgileri  <br>gerekir ise "<span style="background-color:yellow" > Güncel bilgiler: </span>" alanından düzenleyebilirsiniz.<br>
  		<b>Uyarı: </b>Eğer iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 2: </b>Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 3: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz. <br>
		<b>Adım 4: </b>İşiniz bitti ise pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		
</ul>
<?php endif ?>
<?php if($src=="medication") : ?>
<a name="med"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
İlaç ve doz planı nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b>İlacı sol sütuna yazınız.<br> 
	<b>Adım 2: </b>Doz planını orta sütuna yazınız.<br> 
	<b>Adım 3: </b>Gerekir ise ilacın renk kodu seçme kutusunu tıklayınız.<br> 
	<ul type=disc>
		<li>Beyaz normal veya ön seçimli.
		<li><span style="background-color:#00ff00" >Yeşil</span> antibiyotikler ve türevleri için.
		<li><span style="background-color:yellow" >Sarı</span> diyaliz ilaçları için.
		<li><span style="background-color:#0099ff" >Mavi</span> koagülan veya anti koagülan ilaçlar için.
		<li><span style="background-color:#ff0000" >Kırmızı</span> intravenöz uygulanan ilaçlar için.
	</ul>
  	<b>Uyarı: </b>Gerekir ise güncel bilgileri de <br>düzenleyebilirsiniz.<br>
	<b>Adım 4: </b>İsminizi "<span style="background-color:yellow" > Hemşire: </span>" alanına yazınız.<br> 
  		<b>Uyarı:  </b>Eğer iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 5: </b>İlaç tedavisi planını kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 6: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz. <br>
		<b>Adım 7: </b>İşiniz bitti ise pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		
</ul>
<?php endif ?>
<?php if($src=="medication_dailydose") : ?>
	<?php if($x2) : ?>

<a name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Günlük ilaç uygulama ve dozaj bilgisi nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b>Seçilen ilaçla ilgili giriş alanını tıklayınız.<br>
	<b>Adım 2: </b>Alana dozajı, veya aplikatör bilgisini veya başla/son sembollerini yazınız.<br>
  		<b>Uyarı: </b>Eğer iptal etmek ister iseniz,  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 3: </b>Eğer birkaç girişiniz var ise kaydetmeden önce hepsini giriniz.<br>
		<b>Adım 4: </b>Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 5: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz. <br>
		<b>Adım 6: </b>İşiniz bitti ise pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		
</ul>
	<?php else : ?>
<a name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
"Henüz ilaç yok. " yazıyor. Ne yapmalıyım?</b></font>
<ul> 
		<b>Adım 1: </b>Pencereyi kapatıp çizelgeye geri gitmek için  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
	<b>Adım 2: </b>"<span style="background-color:yellow" > İlaç Tedavisi </span>" yazısını tıklayınız.<br>
	<b>Adım 3: </b>İlaç ve doz şeması giriş alanlarını gösteren bir pencere açılır.<br>
	<b>Adım 4: </b>İlacı sol sütuna yazınız.<br> 
	<b>Adım 5: </b>Doz şemasını orta sütuna yazınız.<br> 
	<b>Adım 6: </b>Gerekirse ilacın renk kodu seeçenek kutusunuu tıklayınız.<br> 
	<ul type=disc>
		<li>Beyaz normal veya ön seçimli.
		<li><span style="background-color:#00ff00" >Yeşil</span> antibiyotikler ve türevleri için.
		<li><span style="background-color:yellow" >Sarı</span> diyaliz ilaçları için.
		<li><span style="background-color:#0099ff" >Mavi</span> koagülan veya anti koagülan ilaçlar için.
		<li><span style="background-color:#ff0000" >Kırmızı</span> intravenöz uygulanan ilaçlar için.
	</ul>
  	<b>Uyarı: </b>Gerekir ise güncel bilgileri de <br>düzenleyebilirsiniz.<br>
	<b>Adım 7: </b>İsminizi "<span style="background-color:yellow" > Hemşire: </span>" alanına yazınız.<br> 
  		<b>Uyarı:  </b>Eğer iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 8: </b>İlaç tedavisi planını kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 9: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz. <br>
		<b>Adım 10: </b>İşiniz bitti ise pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
</ul>
	<?php endif ?>
<?php endif ?>
<?php if($src=="iv_needle") : ?>
<a name="iv"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Günlük intravenöz ilaç uygulaması ve dozaj nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b> "<span style="background-color:yellow" > Buraya yeni bilgi giriniz veya mevcut bilgiyi güncelleyiniz: </span>" alanına ya dozaj, veya aplikatör bilgisi, veya başla/bitir sembollerini yazınız.<br>
  		<b>Uyarı: </b>Eğer iptal etmek ister iseniz,  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 2: </b>Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 3: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz. <br>
		<b>Adım 4: </b>İşiniz bitti ise pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		
</ul>

<?php endif ?>

</form>

