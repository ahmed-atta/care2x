<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<a name="howto">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Derece kâğıdı formu</b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="main") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Nasıl...?</b></font>
<ul type="disc"><li><a href="#cbp">derece veya kan basıncı girilir.</a>
		<li><a href="#movedate">çizelgenin tarihi ilerletilir veya değiştirilir.</a>
		<li><a href="#diet">diyet planı girilir.</a>
		<li><a href="#allergy">allerji bilgisi girilir.</a>
		<li><a href="#diag">ana tanı veya tedavi girilir.</a>
		<li><a href="#daydiag">günlük tanı veya tedavi planı bilgisi girilir.</a>
		<li><a href="#extra">ek tanılar, notlar vs. girilir.</a>
		<li><a href="#pt">günlük fizik tedavi bilgisi, anti tromboz cimnastiği, vs. girilir.</a>
		<li><a href="#coag">antikoagülanlar girilir.</a>
		<li><a href="#daycoag">günlük antikoagülan uygulama bilgisi girilir.</a>
		<li><a href="#lot">implant notları, küme no, görev no, vs. girilir.</a>
		<li><a href="#med">ilaç ve doz şeması girilir.</a>
		<li><a href="#daymed">günlük ilaç uygulaması ve doz bilgisi girilir.</a>
		<li><a href="#iv">günlük intravenöz ilaç şeması ve doz bilgisi girilir.</a>
</ul>		
<hr>
<a name="cbp"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Derece veya kan basıncı nasıl girilir?</b></font>
<ul> <b>Adım 1: </b>Seçilen güne karşılık gelen çizelge alanını tıklayınız.<br>
		<b>Adım 2: </b>Derece ve/veya kan basıncını girmek için bir pencere açılır.<br>
		<b>Adım 3: </b>Veriyi ve zamanı giriniz.<br>
		<ul type="disc">
		<li>Zaman ve dereceyi sağdaki "<font color="#0000ff">Derece</font>" sütununa giriniz.<br>
		Örnek: <input type="text" name="t" size=5 maxlength=5 value="12.35">&nbsp;&nbsp;<input type="text" name="u" size=8 maxlength=8 value="37.3">
		<li>Zaman ve kan basıncını soldaki "<font color="#cc0000">Kan basıncı</font>" sütununa giriniz.<br>
		Örnek: <input type="text" name="v" size=5 maxlength=5 value="10.05">&nbsp;&nbsp;<input type="text" name="w" size=8 maxlength=8 value="128/85">
		</ul>		
		<ul >
		<font color="#000099" size=1><b>İpucu:</b> Şu andaki zamanı kayıt etmek için zaman alanına "n" veya "N" (Now=Şimdi anlamında) giriniz. Şu andaki zaman alana otomatik olarak girilir.</font>
		</ul>
		<b>Adım 4: </b>Birkaç bilgi var ise, kayıt etmeden önce hepsini giriniz.<br>
		<b>Adım 5: </b>Yeni girilen bilgiyi kayıt etmek için  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 6: </b>Herhangi bir hatayı düzeltmek ister iseniz, hatalı verilerin üzerine tıklayınız ve doğrusunu yazınız.<br>
		<b>Adım 7: </b>İşiniz bitti ise, pencereyi kapatıp çizelgeye geri dönmek için  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Geriye "Nasıl...?"</a></font>
</ul>
<a name="movedate"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Çizelge tarihi nasıl ilerletilir veya değiştirilir?</b></font>
<ul> 
	<li><font color="#660000"><b>Tarihi bir gün geri almak için:</b></font><br>
	<b>Adım 1: </b>Çizelgenin <span style="background-color:yellow" >en solundaki</span> tarih sütunundaki <img <?php echo createComIcon('../','l_arrowgrnsm.gif','0') ?>> simgesine tıklayınız.<p>
	<li><font color="#660000"><b>Tarihi bir gün ileri almak için:</b></font><br>
	<b>Adım 1: </b>Çizelgenin <span style="background-color:yellow" >en sağındaki</span>  <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>> simgesini tıklayınız.
                                                                     <p>
	<li><font color="#660000"><b>Çizelgenin başlama tarihini doğrudan ayarlamak için:</b></font><br>
	<b>Adım 1: </b>Çizelgenin <span style="background-color:yellow" >en sol</span> sütunundaki <img <?php echo createComIcon('../','l_arrowgrnsm.gif','0') ?>> simgesine <span style="background-color:yellow" >farenin sağ tuşu</span> ile tıklayınız.<br>
	<b>Adım 2: </b>Onay istendiğinde  <input type="button" value="Tamam"> düğmesini tıklayınız.<br>
	<b>Adım 3: </b>Başlama tarihi seçim alanlarını gösteren küçük bir pencere açılır.<br>
	<b>Adım 4: </b>Gün, ay ve yılı seçiniz.<br>
	<b>Adım 5: </b>Değişikliği etkinleştirmek için <input type="button" value="Git"> düğmesini tıklayınız.<br>
	Küçük pencere otomatik olarak kapanır ve çizelgeye tarih değişikliği uygulanır.<p>
	
	<li><font color="#660000"><b>Çizelgenin bitiş tarihini doğrudan ayarlamak için:</b></font><br>
	<b>Adım 1: </b>Çizelgenin <span style="background-color:yellow" >en sağ</span> tarih sütunundaki <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>> simgesini <span style="background-color:yellow" >farenin sağ tuşu</span> ile tıklayınız.<br>
	<b>Adım 2: </b>Onay istendiğinde <input type="button" value="Tamam"> düğmesini tıklayınız.<br>
	<b>Adım 3: </b>Bitiş tarihi seçim alanlarını gösteren bir pencere açılır.<br>
	<b>Adım 4: </b>Gün, ay, ve yılı seçiniz.<br>
	<b>Adım 5: </b>Değişikliği uygulamak için  <input type="button" value="Git"> düğmesini tıklayınız.<br>
	Küçük düğme otomatik olarak kapanır ve çizelge gün değişikliğine ayarlanır.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> "Nasıl...? a geri" </a></font>
</ul>
<a name="diet"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Diyet planı nasıl girilir?</b></font>
<ul> <b>Adım 1: </b>Seçilen tarihe karşılık gelen  "<span style="background-color:yellow" > Diyet planı </span>" nı tıklayınız.<br>
		<b>Adım 2: </b>Diyet planı girmek veya düzenlemek için bir pencere açılır.<br>
		<b>Adım 3: </b>Diyet planını giriniz.<br>
		<b>Adım 4: </b>Yeni girilmiş diyet planını kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
  		<b>Uyarı: </b>İptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 5: </b>Her hangi bir hatayı düzeltmek ister iseniz, hatalı bilgileri tıklayınız ve doğrusu ile değiştiriniz.<br>
		<b>Adım 6: </b>İşiniz bitti ise, pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> "Nasıl...? a geri"</a></font>
</ul>
<a name="allergy"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Allerji bilgisi nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b> "<span style="background-color:yellow" > Allerji<img <?php echo createComIcon('../','clip.gif','0') ?>> </span>" üzerindeki<img <?php echo createComIcon('../','clip.gif','0') ?>> simgesini tıklayınız .<br>
	<b>Adım 2: </b>Allerji bilgisi girişi için bir pencere açılır.<br>
	<b>Adım 3: </b>Allerji veya CAVE bilgisini<br> "<span style="background-color:yellow" > Lütfen yeni bilgiyi buraya giriniz: </span>" alanına yazınız.<br>
  		<b>Uyarı: </b>Güncel bilgileri <br> gerekirse "<span style="background-color:yellow" > Güncel bilgiler: </span>" alanında düzenleyebilirsiniz.<br>
  		<b>Uyarı: </b>İptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 4: </b>Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 5: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz.<br>
		<b>Adım 6: </b>İşiniz bitti ise , pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> "Nasıl...? a geri"</a></font>
</ul>

<a name="diag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Ana tanı ve/veya tedavi nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b> "<span style="background-color:yellow" > Tanı/Tedavi <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>" üzerindeki <img <?php echo createComIcon('../','clip.gif','0') ?>> simgesini tıklayınız .<br>
	<b>Adım 2: </b>Tanı/tedavi bilgisi giriş alanını gösteren bir pencere açılır.<br>
	<b>Adım 3: </b>Tanı veya tedavi bilgisini <br> "<span style="background-color:yellow" > Lütfen yeni bilgiyi buraya giriniz: </span>" alanına giriniz.<br>
  		<b>Uyarı: </b>Güncel bilgileri<br>gerekir ise "<span style="background-color:yellow" > Güncel bilgiler: </span>" alanında düzenleyebilirsiniz.<br>
  		<b>Uyarı: </b>İptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 4: </b>Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 5: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz.<br>
		<b>Adım 6: </b>İşiniz bitti ise, pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>>  "Nasıl...?" a geri </a></font>
</ul>
<a name="daydiag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Günlük tanı veya tedavi planı nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b>Seçilen tarih ile ilgili ya mevcut günlük tanı/tedavi sütununu veya boş sütunu tıklayınız.<br>
	<b>Adım 2: </b>Seçilen tarih için tanı/tedavi giriş alanını gösteren bir pencere açılır.<br>
	<b>Adım 3: </b>Tanı veya tedavi bilgisini <br> "<span style="background-color:yellow" > Lütfen yeni bilgiyi buraya giriniz: </span>" alanına yazınız.<br>
  		<b>Uyarı: </b>Güncel bilgileri <br>gerekir ise "<span style="background-color:yellow" > Güncel bilgiler: </span>" alanından düzenleyebilirsiniz.<br>
  		<b>Uyarı: </b>Eğer iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 4: </b>Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 5: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz. <br>
		<b>Adım 6: </b>İşiniz bitti ise pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>>  "Nasıl...?" a geri </a></font>
</ul>
<a name="extra"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Notlar, ek tanılar nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b> "<span style="background-color:yellow" > Notlar, ek tanılar <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>" üzerindeki <img <?php echo createComIcon('../','clip.gif','0') ?>> simgesini tıklayınız.<br>
	<b>Adım 2: </b>Notlar ve ek tanılar giriş alanını gösteren bir pencere açılır.<br>
	<b>Adım 3: </b>Notları ve ek tanıları <br> "<span style="background-color:yellow" > Lütfen yeni bilgiyi buraya giriniz: </span>" alanına giriniz.<br>
  		<b>Uyarı: </b> Güncel bilgileri <br> gerekir ise "<span style="background-color:yellow" > Güncel bilgiler: </span>" alanından düzenleyebilirsiniz.<br>
  		<b>Uyarı: </b>Eğer iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 4: </b>Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 5: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz. <br>
		<b>Adım 6: </b>İşiniz bitti ise pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>>  "Nasıl...?" a geri </a></font>
</ul>
<a name="pt"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Günlük fizik tedavi,(PT), Antitromboz jimnastiği (Atg), vs. bilgisi nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b>Seçilen tarihin ilgili "<span style="background-color:yellow" > Pt,Atg,vs: </span>" yazısını tıklayınız.<br>
	<b>Adım 2: </b>Seçilen tarih için giriş alanını gösteren bir pencere açılır.<br>
	<b>Adım 3: </b>Bilgiyi <br> "<span style="background-color:yellow" > Lütfen yeni bilgiyi buraya giriniz: </span>" alanına yazınız.<br>
  		<b>Uyarı: </b>Güncel bilgileri <br>gerekir ise "<span style="background-color:yellow" > Güncel bilgiler: </span>" alanından düzenleyebilirsiniz.<br>
  		<b>Uyarı: </b>Eğer iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 4: </b>Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 5: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz. <br>
		<b>Adım 6: </b>İşiniz bitti ise pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>>  "Nasıl...?" a geri </a></font>
</ul>
	
<a name="coag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Antikoagülanlar nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b> "<span style="background-color:yellow" > Antikoagülanlar <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>" üzerindeki <img <?php echo createComIcon('../','clip.gif','0') ?>> simgesini tıklayınız.<br>
	<b>Adım 2: </b>Antikoagülanlar giriş alanını gösteren bir pencere açılır.<br>
	<b>Adım 3: </b>Antikoagülanlar ve doz bilgisini <br> "<span style="background-color:yellow" > Lütfen yeni bilgiyi buraya giriniz: </span>" alanına yazınız.<br>
  		<b>Uyarı: </b>Güncel bilgileri <br>gerekir ise "<span style="background-color:yellow" > Güncel bilgiler: </span>" alanından düzenleyebilirsiniz.<br>
  		<b>Uyarı: </b>Eğer iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 4: </b>Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 5: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz. <br>
		<b>Adım 6: </b>İşiniz bitti ise pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>>  "Nasıl...?" a geri </a></font>
</ul>
<a name="daycoag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Günlük antikoagülan uygulaması bilgisi nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b>Seçilen tarihe karşılık gelen ya boş bir sütunu ya da mevcut antikoagülan tedavisini tıklayınız.<br>
	<b>Adım 2: </b>Seçilen tarih için günlük antikoagülan uygulamasını gösteren bir pencere açılır.<br>
	<b>Adım 3: </b>Ya dozaj veya aplikatör bilgisini <br> "<span style="background-color:yellow" > Buraya yeni bilgi giriniz veya güncel bilgileri düzenleyiniz: </span>" alanına giriniz.<br>
  		<b>Uyarı: </b>Eğer iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 4: </b>Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 5: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz. <br>
		<b>Adım 6: </b>İşiniz bitti ise pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>>  "Nasıl...?" a geri </a></font>
</ul>
<a name="lot"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
İmplantlar, küme no, sipariş no vs. notları nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b>"<span style="background-color:yellow" > Notlar <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>" üzerindeki  <img <?php echo createComIcon('../','clip.gif','0') ?>> simgesini tıklayınız.<br>
	<b>Adım 2: </b>Ek notlar için giriş alanını gösteren bir pencere açılır.<br>
	<b>Adım 3: </b>Küme, sipariş, implantlar hakkındaki bilgileri <br> "<span style="background-color:yellow" > Lütfen yeni bilgiyi buraya giriniz: </span>" alanına yazınız.<br>
  		<b>Uyarı: </b>Güncel bilgileri  <br>gerekir ise "<span style="background-color:yellow" > Güncel bilgiler: </span>" alanından düzenleyebilirsiniz.<br>
  		<b>Uyarı: </b>Eğer iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 4: </b>Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 5: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz. <br>
		<b>Adım 6: </b>İşiniz bitti ise pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>>  "Nasıl...?" a geri </a></font>
</ul>
<a name="med"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
İlaç ve doz planı nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b> "<span style="background-color:yellow" > İlaç </span>" yazısını tıklayınız.<br>
	<b>Adım 2: </b>İlaç ve doz planları giriş alanlarını gösteren bir pencere açılır.<br>
	<b>Adım 3: </b>İlacı sol sütuna yazınız.<br> 
	<b>Adım 4: </b>Doz planını orta sütuna yazınız.<br> 
	<b>Adım 5: </b>Gerekir ise ilacın renk kodu seçme kutusunu tıklayınız.<br> 
	<ul type=disc>
		<li>Beyaz normal veya ön seçimli.
		<li><span style="background-color:#00ff00" >Yeşil</span> antibiyotikler ve türevleri için.
		<li><span style="background-color:yellow" >Sarı</span> diyaliz ilaçları için.
		<li><span style="background-color:#0099ff" >Mavi</span> koagülan veya anti koagülan ilaçlar için.
		<li><span style="background-color:#ff0000" >Kırmızı</span> intravenöz uygulanan ilaçlar için.
	</ul>
  	<b>Uyarı: </b>Gerekir ise güncel bilgileri de <br>düzenleyebilirsiniz.<br>
	<b>Adım 6: </b>İsminizi "<span style="background-color:yellow" > Hemşire: </span>" alanına yazınız.<br> 
  		<b>Uyarı:  </b>Eğer iptal etmek ister iseniz,<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 7: </b>İlaç tedavisi planını kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 8: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz. <br>
		<b>Adım 9: </b>İşiniz bitti ise pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>>  "Nasıl...?" a geri </a></font>
</ul>
<a name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Günlük ilaç uygulama ve dozaj bilgisi nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b>Seçilen tarih ile ilgili ya boş bir ilaç sütununu veya mevcut bilgiyi tıklayınız.<br>
	<b>Adım 2: </b>İlgili gün bilgisi için giriş alanları ile ilacı, doz şemasını gösteren bir pencere açılır.<br>
	<b>Adım 3: </b>Seçilen ilaçla ilgili giriş alanını tıklayınız.<br>
	<b>Adım 4: </b>Alana dozajı, veya aplikatör bilgisini veya başla/son sembollerini yazınız.<br>
  		<b>Uyarı: </b>Eğer iptal etmek ister iseniz,  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 5: </b>Eğer birkaç girişiniz var ise kaydetmeden önce hepsini giriniz.<br>
		<b>Adım 6: </b>Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 7: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz. <br>
		<b>Adım 8: </b>İşiniz bitti ise pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>>  "Nasıl...?" a geri </a></font>
</ul>
<a name="iv"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Günlük intravenöz ilaç uygulaması ve dozaj nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b>Seçilen tarihe karşılık gelen <span style="background-color:yellow" > İntravenöz>> </span>" yazısının yanındaki boş bir kolonu ya da mevcut bilgiyi tıklayınız.<br>
	<b>Adım 2: </b>Günün intravenöz ilaç bilgisi giriş alanını gösteren bir pencere açılır.<br>
	<b>Adım 3: </b> "<span style="background-color:yellow" > Buraya yeni bilgi giriniz veya mevcut bilgiyi güncelleyiniz: </span>" alanına ya dozaj, veya aplikatör bilgisi, veya başla/bitir sembollerini yazınız.<br>
  		<b>Uyarı: </b>Eğer iptal etmek ister iseniz,  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 5: </b>Eğer birkaç girişiniz var ise kaydetmeden önce hepsini giriniz.<br>
		<b>Adım 6: </b>Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 7: </b>Her hangi bir yanlışı düzeltmek ister iseniz, yanlış bilgilerin üzerine tıklayınız, doğruları ile değiştiriniz ve tekrar kaydediniz. <br>
		<b>Adım 8: </b>İşiniz bitti ise pencereyi kapatıp çizelgeye geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>>  "Nasıl...?" a geri </a></font>
</ul>
<?php elseif(($src=="")&&($x1=="template")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<span style="background-color:yellow" >Bugünün listesi henüz oluşturulmamış</span> olduğu zaman ne yapmalıyım?</b></font>
<ul> <b>Adım 1: </b>En son kaydedilen listeyi bulmak için <input type="button" value="Son hasta listesini göster"> düğmesini tıklayınız.
                                                                     <br>
		<b>Adım 2: </b>Son 31 gün içinde kaydedilmiş bir liste bulunur ise görüntülenir.<br>
		<b>Adım 3: </b> <input type="button" value="Bu listeyi bugün için kopyala."> düğmesini tıklayınız<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Son hasta listesini görmek istemiyorum. Yeni bir liste nasıl oluşturulur?</b></font>
<ul> <b>Adım 1: </b>Oda numarası ve yatağa karşılık gelen  <img <?php echo createComIcon('../','plus2.gif','0') ?>> düğmesini tıklayınız.
                                                                     <br>
		<b>Adım 2: </b>Hasta aramak için bir pencere açılır.<br>
		<b>Adım 3: </b>Önce çeşitli giriş alanlarından birine aranacak bir anahtar sözcük girip hastayı bulunuz.<br>
		Hastayı ...<ul type="disc">
		<li>protokol numarasına göre bulmak isterseniz numarayı <br>"<span style="background-color:yellow" >Hasta no.:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" alanına giriniz.
		<li>Soyadına göre bulmak için soyad veya ilk birkaç harfini  <br>"<span style="background-color:yellow" >Soyad:</span><input type="text" name="t" size=19 maxlength=10 value="Schmitt">" alanına giriniz.
		<li>Ada göre bulmak için adını vaya adının ilk birkaç harfini <br>"<span style="background-color:yellow" >Adı:</span><input type="text" name="t" size=19 maxlength=10 value="Peter">" alanına giriniz.
		<li>Doğum tarihine göre bulmak için, doğum tarihini veya ilk birkaç rakamını <br>"<span style="background-color:yellow" >Doğum tarihi:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">" alanına giriniz.
		</ul>
		<b>Adım 4: </b>Hastayı aramaya başlamak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 5: </b>Arama bir ya da birkaç sonuç bulur ise, bir hasta listesi görüntülenir.<br>
		<b>Adım 6: </b>Doğru hastayı seçmek için, ilgili&nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> düğmesini tıklayınız.<br>
</ul>
<?php elseif(($src=="getlast")&&($x1=="last")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bugünkü yatan hasta listesinin son kaydedilmiş olanı nasıl görüntülenir?</b></font>
<ul> <b>Adım 1: </b>Son kayıt edilmiş listeyi kopyalamak için <input type="button" value="Bugün için yine de bu listeyi kopyala."> düğmesini tıklayınız.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Son yatan hasta listesi görüntüleniyor fakat onu kopyalamak istemiyorum. Yeni bir listeyi nasıl başlatırım? </b></font>
<ul> <b>Adım 1: </b>Yeni bir liste oluşturmaya başlamak için  <input type="button" value="Bunu kopyalama! Yeni bir liste oluştur."> düğmesini tıklayınız.
</ul>
<?php elseif($src=="assign") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir yatak bir hastaya nasıl verilir?</b></font>
<ul> <b>Adım 1: </b>Önce çeşitli giriş alanlarından birine aranacak bir anahtar sözcük girip hastayı bulunuz.<br>
		Hastayı ...<ul type="disc">
		<li>protokol numarasına göre bulmak isterseniz numarayı <br>"<span style="background-color:yellow" >Hasta no.:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" alanına giriniz.
		<li>Soyadına göre bulmak için soyad veya ilk birkaç harfini  <br>"<span style="background-color:yellow" >Soyad:</span><input type="text" name="t" size=19 maxlength=10 value="Schmitt">" alanına giriniz.
		<li>Ada göre bulmak için adını vaya adının ilk birkaç harfini <br>"<span style="background-color:yellow" >Adı:</span><input type="text" name="t" size=19 maxlength=10 value="Peter">" alanına giriniz.
		<li>Doğum tarihine göre bulmak için, doğum tarihini veya ilk birkaç rakamını <br>"<span style="background-color:yellow" >Doğum tarihi:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">" alanına giriniz.
		</ul>
		<b>Adım 2: </b>Hastayı aramaya başlamak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 3: </b>Arama bir ya da birkaç sonuç bulur ise, bir hasta listesi görüntülenir.<br>
		<b>Adım 4: </b>Doğru hastayı seçmek için, ilgili&nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir yatak nasıl kilitlenir?</b></font>
<ul> <b>Adım 1: </b>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Bu yatağı kilitle</font> </span>" düğmesini tıklayınız.<br>
		<b>Adım 2: </b>Onay istenince &nbsp;<button>Tamam</button> düğmesini tıklayınız.<p>
</ul>
  <b>Uyarı: </b>İptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.</ul>
  
<?php elseif($src=="remarks") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hasta hakkında not veya uyarılar nasıl yazılır?</b></font>
<ul> <b>Adım 1: </b>Metin giriş alanına tıklayınız.<br>
		<b>Adım 2: </b>Uyarı ve notlarınızı yazınız<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yazmayı bitirdim. Uyarı veya notlar nasıl kayıt edilir?</b></font>
<ul> 	<b>Adım 1: </b>Kayıt etmek için <input type="button" value="Kayıt et"> düğmesini tıklayınız.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Uyarıları kayıt ettim. Pencereyi nasıl kapatırım?</b></font>
<ul> 	<b>Adım 1: </b>Pencereyi kapatmak için <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> düğmesini tıklayınıız.<p>
</ul>
<?php elseif($src=="discharge") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hasta nasıl çıkarılır?</b></font>
<ul> <b>Adım 1: </b>Çıkış tipini ilgili düğmeye tıklayıp seçiniz<br>
	<ul><br>
		<input type="radio" name="relart" value="reg" checked> Normal çıkış<br>
                 	<input type="radio" name="relart" value="self"> Hasta kendi isteği ile hastaneyi tterk etti<br>
                 	<input type="radio" name="relart" value="emgcy"> Acil çıkış<br>  <br>
	</ul>
		<b>Adım 2: </b>Eğer var ise  "<span style="background-color:yellow" > Uyarı: </span>" alanına çıkış ile ilgili ek uyarı ve notları yazınız. <br>
		<b>Adım 3: </b>Eğer boş ise isminizi "<span style="background-color:yellow" > Hemşire: <input type="text" name="a" size=20 maxlength=20></span>" alanına yazınız. <br>
		<b>Adım 4: </b> " <span style="background-color:yellow" ><input type="checkbox" name="d" value="d"> Evet, eminim. Hastayı çıkar. </span>" alanını işaretleyiniz. <br>
		<b>Adım 5: </b>Hastayı çıkarmak için <input type="button" value="çıkar"> düğmesini tıklayınız.<p>
		<b>Adım 6: </b>Servisin yatan hasta listesinin son durumuna geri gitmek için  <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<input type="button" value="çıkar"> düğmesini tıklamayı denedim, ama yanıt yoktu. Neden?</b></font>
<ul> <b>Uyarı: </b>Aşağıdaki seçim kutuları seçilmeli ve şöyle görünmelidir.: <br>
 " <span style="background-color:yellow" ><input type="checkbox" name="d" value="d" checked> Evet, Eminim. Hastayı çıkar. </span>". <p>
		<b>Adım 1: </b>Seçili değil ise seçin kutusunu seçiniz.<p>
</ul>
  <b>Uyarı: </b>İptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.</ul>

<?php endif ?>

</form>

