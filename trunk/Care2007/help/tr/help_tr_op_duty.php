<html>

<head>
<title></title>

</head>
<body>
<form >
<font face="Verdana, Arial" size=2>
<font  size=3 color="#0000cc">
<b>

<?php
	switch($src)
	{
		case "show": print "Hemşire nöbetleri - Nöbet planı";
							break;
		case "quick": print "Hemşire nöbetleri - Hızlı bakış";
							break;
		case "plan": print "Hemşire nöbetleri - Nöbet planı oluştur";
							break;
		case "personlist": print "Personel listesi oluştur";
							break;
		case "dutydoc": print "Hemşire nöbetleri - İcap nöbetlerinde yapılan işin belgelendirilmesi";
							break;
	}
?>
</b>
</font>
<p>

<?php if($src=="quick") : ?>
<p><font color="#990000" face="Verdana, Arial">Burada ne yapabilirim?</font></b><p>
<font face="Verdana, Arial" size=2>
<img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>><b> Nöbetçi hemşireler hakkında (varsa) ek bilgi almak.</b>
<ul>Ek bilgiyi görmek için, listedeki kişinin  <span style="background-color:yellow" >ismi</span> üzerine tıklayınız. Küçük bir pencere açılır, ilgili bilgiler görünür.</ul><p>
<img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>><b> Tüm ayın nöbet planını görmek.</b>
<ul>Tüm ayın nöbet planını görüntülemek için, ilgili &nbsp;<button><img <?php echo createComIcon('../','new_address.gif','0','absmiddle') ?>> <font size=1>Göster</font></button> simgesini tıklayınız.<br>
			Nöbet planı görüntülenir.</ul><p>
<font face="Verdana, Arial" size=3 color="#990000">
<p><b>Hızlı bakış görüntüsü neyi göstermek istiyor?</b></font></b><p>
<font face="Verdana, Arial" size=2>
</b><li><b>Ameliyathane Bölüm</b> :<ul>İcapçı ve/veya nöbetçi doktor/cerrahları bulunan bölümlerin listesi.</ul><p>
<li><b>İcapçı </b> :<ul>İcap nöbetçisi hemşire.</ul><p>
<li><b>Çağrı/Telefon</b> :<ul>İcap nöbetindeki hemşirenin telefon ve çağrı bilgisi.</ul>
<li><b>Nöbetçi </b> :<ul>Nöbetçi hemşire.</ul><p>
<li><b>Çağrı/Telefon</b> :<ul>Nöbetçinin çağrı ve telefon bilgisi.</ul><p>
<li><b>Nöbet planı</b> :<ul>Tıklanabilir simge. Bölümün bütün aylık nöbet planına bağlantı. Tüm ayın nöbet planını açmak sonrada oluşturmak veya düzenlemek ister iseniz&nbsp;<button><img <?php echo createComIcon('../','new_address.gif','0','absmiddle') ?>> <font size=1>Göster</font></button>
			simgesini tıklayınız.</ul>

<?php endif;?>
<?php if($src=="show") : ?>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Görüntülenen ay için yeni bir nöbet planı oluşturmak istiyorum</b></font>
<ul> <b>Adım 1: </b> <img <?php echo createLDImgSrc('../','newplan.gif','0') ?>> düğmesini tıklayınız.<br>
</ul>
<ul><b>Adım 2:</b>
 Daha önce giriş yaptı iseniz ve işleve erişim hakkınız var ise, ana çerçevede nöbet planını düzenlemek için düzenleme modu görüntülenir.<br>
		Yoksa, giriş yapmamış iseniz, kullanıcı adı ve şifreniz sorulur. <p>
		Kullanıcı adı ve şifrenizi giriniz ve  <img <?php echo createLDImgSrc('../','continue.gif','0') ?>> düğmesini tıklayınız.<p>
		İptal etmeye karar verir iseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.

</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir ay için liste yapmak istiyorum fakagörüntülenen liste bir başka ayın.</b></font>
<ul> <b>Adım 1: </b>İstediğiniz aya ulaşıncaya değin tıklanabilir "Ay" a tekrar tekrar tıklayınız. <br>
								Ayı ilerletmek için sağdaki "ay" bağlantısını tıklayınız.<br>
								Ayı geri almak için soldaki "ay" bağlantısını tıklayınız.<br>
		<b>Adım 2: </b>Bir nöbet planı oluşturmak konusundaki önceki yönergeleri izleyiniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Hızlı bakışa geri gitmek istiyorum </b></font>
<ul> <b>Adım 1: </b> <img <?php echo createLDImgSrc('../','close2.gif','0') ?> > simgesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Nöbetçi hemşirelerin telefon ve çağrı numaralarını görmek istiyorum </b></font>
<ul> <b>Adım 1: </b><span style="background-color:yellow" >Kişinin ismini tıklayınız</span>.  İlgili bilgiyi gösteren küçük bir pencere açılır.<br>
</ul>


<b>Uyarı</b>
<ul> Nöbet planını kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php endif;?>
<?php if($src=="plan") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hemşireler listesini kullanarak bir hemşireyi nöbet için planlamak istiyorum</b></font>
<ul> <b>Adım 1: </b>Hemşireler listesini açmak için seçilen günün  &nbsp;<button><img <?php echo createComIcon('../','patdata.gif','0') ?>></button> düğmesini tıklayınız. <br>
			Hemşireler listesini gösteren küçük bir pencere açılır.<br>
			<ul type=disc>
			<li>İcapçı nöbeti yzamak için sol "icapçı" sütunundaki simgeyi tıklayınız.<br>
			<li>Nöbet yazmak için sağdaki "nöbet" sütunundaki simgeyi tıklayınız.
			</ul>
		<b>Adım 2: </b>Nöbet planına kopyalamak için <span style="background-color:yellow" >hemşirenin ismini tıklayınız</span> .<br>
		<b>Adım 3: </b>Yanlış isme tıkladı iseniz, ikinci adımı tekrarlayıp doğru ismi tıklayınız.<br>
		<b>Adım 4: </b>İşiniz bitti ise, hemşire listesi penceresindeki <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıkayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Nöbet listesine hemşirenin adını el ile girmek istiyorum</b></font>
<ul> <b>Adım 1: </b>Seçilen günün metin giriş alanını "<input type="text" name="t" size=11 maxlength=4 >" tıklayınız.<br>
		<b>Adım 2: </b>Hemşirenin adını el ile yazınız<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Nöbet planında bir ismi silmek istiyorum</b></font>
<ul> <b>Adım 1: </b>Silinecek ismin metin giriş alanına "<input type="text" name="t" size=11 maxlength=4 value="Name">" tıklayınız.<br>
		<b>Adım 2: </b>İsmi klavyenin geri veya delete tuşunu kullanarak siliniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Nöbet planını kayıt etmek istiyorum</b></font>
<ul> <b>Adım 1: </b> <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Planı kayıt ettim ve planlamayı sonlandırmak istiyorum, ne yapmalıyım? </b></font>
<ul> <b>Adım 1: </b>İşiniz bitti ise, <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız. <br>
</ul>
</font>
<?php endif;?>
<?php if($src=="personlist") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Görüntülenen bölüm yanlış. Doğru bölüme değiştirmek istiyorum.</b></font>
<ul> <b>Adım 1: </b>Bölümü <nobr>"<span style="background-color:yellow" >Bölümü veya ameliyathaneyi değiştir: </span><select name="s">
                                                                     	<option value="Örnek bölüm 1" selected> Örnek bölüm 1</option>
                                                                     	<option value="Örnek bölüm 2"> Örnek bölüm 2</option>
                                                                     	<option value="Örnek bölüm 3"> Örnek bölüm 3</option>
                                                                     	<option value="Örnek bölüm 4"> Örnek bölüm 4</option>
                                                                     </select>"</nobr> alanından seçiniz.
                                                                     <br>
		<b>Adım 2: </b>Seçilen bölümü değiştirmek için <input type="button" value="Değiştir"> düğmesini tıklayınız.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Listede bir ismi silmek istiyorum</b></font>
<ul> <b>Adım 1: </b>Silinecek ismin metin giriş alanına  "<input type="text" name="t" size=11 maxlength=4 value="İsim">" tıklayınız.<br>
		<b>Adım 2: </b>İsmi klavyenin geri veya sil tuşlarını kullanarak el ile siliniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Personel listesini kayıt etmek istiyorum</b></font>
<ul> <b>Adım 1: </b> <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Listeyi kayıt ettim, kapatmak istiyorum, ne yapmalıyım? </b></font>
<ul> <b>Adım 1: </b>İşiniz bitti ise, <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız. <br>
</ul>
<?php endif;?>
<?php if($src=="dutydoc") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Nöbet saatlerinde yapılan bir iş nasıl belgelendirilir?</b></font>
<ul> <b>Adım 1: </b>Tarihi "Tarih <input type="text" name="d" size=10 maxlength=10> " alanına giriniz.<p>
	<ul> <b>İpucu: </b>Bugünün tarihini otomatik olarak girmek için  "t" veya "T" (TODAY=bugün anlamında) giriniz.<br>
		<b>İpucu: </b>Dünkü tarihi utomatik olarak girmek için "y" veya "Y" (YESTERDAY=Dün anlamında) giriniz.<p>
		</ul>
		<b>Adım 2: </b>Nöbetçi hemşirenin adını  <nobr>"<span style="background-color:yellow" > Soyad, ad <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> alanına giriniz.<br>
 <b>Adım 3: </b>İşin başlangıç zamanını  "<span style="background-color:yellow" > başlama saati <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<br>
 <b>Adım 4: </b>İşin birme saatini "<span style="background-color:yellow" > bitiş saati <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<p>
	<ul> <b>İpucu: </b>Şu andaki saati otomatik olarak girmek için "n" veya "N" (NOW=şimdi anlamında) giriniz.<p>
		</ul>
 <b>Adım 5: </b>Ameliyathane numarasını  "<span style="background-color:yellow" > Ameliyathane No <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<br>
 <b>Adım 6: </b>Tanı, tedavi veya ameliyatı  <nobr>"<span style="background-color:yellow" > Tanı/Tedavi <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> alanına giriniz.<br>
 <b>Adım 7: </b>İcap hemşiresinin ismini <nobr>"<span style="background-color:yellow" > İcap: <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> alanına giriniz.<br>
 <b>Adım 8: </b>Nöbetçi hemşirenin adını <nobr>"<span style="background-color:yellow" > Nöbetçi: <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> alanına giriniz.<br>
 <b>Adım 1: </b>Belgeyi kayıt etmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız. <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belge listesi nasıl yazdırılır?</b></font>
<ul> <b>Adım 1: </b> <img <?php echo createLDImgSrc('../','printout.gif','0') ?>>  düğmesini tıklayınız. Yazdırma penceresi açılır.<br>
	<b>Adım 2: </b>Pencereyi yazdırma yönergelerini izleyiniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belgeyi kayıt ettim ve kapatmak istiyorum. Ne yapmalıyım? </b></font>
<ul> <b>Adım 1: </b>İşiniz bitti ise,  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız. <br>
</ul>
<?php endif;?>

</form>
</body>
</html>
