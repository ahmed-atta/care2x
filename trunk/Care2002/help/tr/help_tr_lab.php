<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Biyokimya Laboratuvarı - 
<?php
if($src=="create")
{
	switch($x1)
	{
	case "": print "Yeni kütük belgesine başla";
						break;
	case "fresh": print "Yeni kütük belgesine başla";
						break;
	case "get": print  "";
						break;
	case "logmain": print "Belgeli bir ameliyatın kütük girdilerini düzenle";
						break;
	default: print "Yeni bir ameliyat kütüğü";	
	}
}
if($src=="time")
{
	print "Belgelendiriliyor ";
	switch($x1)
	{
	case "entry_out": print "giriş ve çıkış süresi";
						break;
	case "cut_close": print "kesi ve sütür süresi";
						break;
	case "wait_time": print "boş (bekleme) süresi";
						break;
	case "bandage_time": print "alçı-bandaj süresi";
						break;
	case "repos_time": print "repozisyon süresi";
	}
}
if($src=="person")
{
	print "Belgelendiriliyor ";
	switch($x1)
	{
	case "operator":$person="bir cerrah"; 
						break;
	case "assist":$person="bir asistan cerrah"; 
						break;
	case "scrub": $person="bir ameliyat hemşiresi";
						break;
	case "rotating":$person="bir meydancı hemşire"; 
						break;
	case "ana": $person="bir anestezi uzmanı";
	}
	print $person;
}
if($src=="search")
{
	print "Bir hastayı ara";	
/*	switch($x1)
	{
	case "search": print "Belirli bir belgeyi seçme";
						break;
	case "": 
						break;
	case "get": print  "Hastanın ameliyat kütük belgesi";
						break;
	case "fresh": print "Bir hastanın ameliyat kütük belgesini arama";
	}
*/}
if($src=="arch")
{
	print "Arşiv";	
	/*switch($x1)
	{
	case "dummy": print "Arşiv";
						break;
	case "": print "Arşiv";
						break;
	case "?": print "Arşiv";
						break;
	case "search": print  "Arşiv arama sonuçlarının listesi";
						break;
	case "select": print "Hastanın belgesi";
	}*/
}
if($src=="input")
{
	print "Tetkik sonuçlarını girme";	
	/*switch($x1)
	{
	case "dummy": print "Arşiv";
						break;
	case "": print "Arşiv";
						break;
	case "?": print "Arşiv";
						break;
	case "search": print  "Arşiv arama sonuçlarının listesi ";
						break;
	case "select": print "Hastanın belgesi";
	}*/
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="person") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hızlı seçim listesi <?php echo $person ?> yolu ile nasıl girilirt?</b>
</font>
<ul>       	
 	<b>Uyarı: </b>Eğer kişinin ismi önceki bir işlemde seçildi ise <?php echo $person ?> ismi hızlı listede görünür.<p>
 	<b>Adım 1: </b>Önce işlevinin "Ameliyathane işlevi" seçim kutusunda doğru olarak seçilip seçilmediğini kontrol ediniz, seçilmemiş ise kişinin ameliyathane işlevini doğru olarak seçiniz.<br>
 	<b>Adım 2: </b> <?php echo $person ?>'ın soyadını, veya adını, veya <nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> bu kişiyi <?php echo $person ?>... </span>"</nobr> olarak kaydet bağlantısını tıklayınız.
	Cerrah otomatik olarak "güncel kayıtlar"  listesine eklenecektir.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<?php echo ucfirst($person) ?> hızlı seçim listesinde görülmüyor. <?php echo $person ?>'yi nasıl kaydetmeli?</b>
</font>
<ul>       	
 	<b>Adım 1: </b><?php echo $person ?>'in soyad ad bilgilerinin ya tamamını ya da bir kısmını  "<span style="background-color:yellow" > Yeni ara <?php echo substr($person,2) ?>... </span>" alanına giriniz.<br>
 	<b>Adım 2: </b> <input type="button" value="Tamam"> düğmesini tıklayarak  <?php echo $person ?>'yi aramaya başlayınız.<br>
 	<b>Adım 3: </b>Arama sonuçları listeler. Belgelendirmek istediğiniz <?php echo $person ?> 'in  ilgili  soyad, ad, veya <nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Bu kişiyi olarak kaydet <?php echo $person ?>... </span>"</nobr> bağlantısına tıklayınız. 
</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Listeden  <?php echo $person ?> nasıl silinir?</b></font> 
<ul>       	
 	<b>Adım 1: </b>Kişinin isminin sağındaki  <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> simgesini tıklayınız.<br>
 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> İşim bitti. Kütük kaydına nasıl geri giderim?</b></font> 
<ul>       	
 	<b>Adım 1: </b> <?php echo $person ?>'yi seçtikten sonra görünen <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 İptal etmeye karar verir iseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php endif ?>

<?php if($src=="time") : ?>
	<?php if($x1=="entry_out") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Giriş ve çıkış zamanları nasıl belgelendirilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Giriş saatini sol sütundaki "<span style="background-color:yellow" > giriş saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<br>
 	<b>Adım 2: </b>Çıkış saatini sağ sütundaki "<span style="background-color:yellow" > çıkış saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<p>
<ul>       	
 	<b>İpucu: </b>Giriş alanına şu anı otomatik olarak girmek için  "n" veya "N" (Now=Şimdi anlamında) giriniz.
</ul><br>
 	<b>Uyarı: </b>Bilgiyi kayıt etmeden önce birkaç giriş ve çıkış zamanını aynı anda kayıt edebilirsiniz.<p>
</ul>

	<?php endif ?>
	<?php if($x1=="cut_close") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Kesi ve sütür süreleri nasıl belgelendirilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Kesi yapıldığı anı sol sütundaki "<span style="background-color:yellow" > başlama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<br>
 	<b>Adım 2: </b>Sütür anını sağ sütundaki "<span style="background-color:yellow" > bitiş saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<p>
<ul>       	
 	<b>İpucu: </b>Giriş alanına şu anı otomatik olarak girmek için  "n" veya "N" (Now=Şimdi anlamında) giriniz.
</ul><br>
	<b>Uyarı: </b>Bilgiyi kayıt etmeden önce birkaç kesi ve sütür zamanını aynı anda kayıt edebilirsiniz.<p>
</ul>
 	
	<?php endif ?>
	<?php if($x1=="wait_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Boş (bekleme) süresi nasıl belgelendirilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Başladığı zamanı ilk sütundaki "<span style="background-color:yellow" > başlama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<br>
 	<b>Adım 2: </b>Bittiği zamanı ikinci sütundaki "<span style="background-color:yellow" > bitme saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<p>
<ul>       	
 	<b>İpucu: </b>Giriş alanına şu anı otomatik olarak girmek için  "n" veya "N" (Now=Şimdi anlamında) giriniz.
</ul><br>
	<b>Adım 3: </b>Üçüncü (sebep) sütunundan sebebi seçiniz.<p>
 	
 	<b>Uyarı: </b>Bilgiyi kayıt etmeden önce birkaç başlama ve bitme saatini ve sebeplerini aynı anda kayıt edebilirsiniz.<p>
</ul>
 
	<?php endif ?>
	<?php if($x1=="bandage_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Alçı ve pansuman süreleri nasıl belgelendirilir?</b>
</font>
<ul>     
	<b>Adım 1: </b>Başladığı zamanı sol sütundaki "<span style="background-color:yellow" > başlama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<br>
 	<b>Adım 2: </b>Bittiği zamanı sağ sütundaki "<span style="background-color:yellow" > bitme saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<p>
<ul>       	
 	<b>İpucu: </b>Giriş alanına şu anı otomatik olarak girmek için  "n" veya "N" (Now=Şimdi anlamında) giriniz.
</ul><br>
	
 	<b>Uyarı: </b>Bilgiyi kayıt etmeden önce birkaç başlama ve bitme saatini aynı anda kayıt edebilirsiniz.<p>  	
 	
</ul>

	<?php endif ?>
	<?php if($x1=="repos_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Repozisyon süresi nasıl belgelendirilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Başladığı zamanı sol sütundaki "<span style="background-color:yellow" > başlama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<br>
 	<b>Adım 2: </b>Bittiği zamanı sağ sütundaki "<span style="background-color:yellow" > bitme saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<p>
<ul>       	
 	<b>İpucu: </b>Giriş alanına şu anı otomatik olarak girmek için  "n" veya "N" (Now=Şimdi anlamında) giriniz.
</ul><br>
 	<b>Uyarı: </b>Bilgiyi kayıt etmeden önce birkaç başlama ve bitme saatini aynı anda kayıt edebilirsiniz.<p>  	
 	
</ul>

	<?php endif ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bilgi nasıl kayıt edilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Bilgiyi kaydetmek için  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız<br>
 	<b>Adım 2: </b>İşiniz bitti ise, pencereyi kapatıp kayıt kütüğü sayfasına geri dönmek için  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Girilenleri silmek istiyorum ama "Yeni baştan" düğmesi çalışmıyor gibi görünüyor. Ne yapmalıyım?</b></font> 
<ul>       	
 	<b>Uyarı: </b>"Yeni baştan" düğmesi tıklanınca sadece henüz kayıt edilmemiş girdiler silinir. Eğer daha önceden kayıt edilmiş girdileri silmek isterseniz, şu yönergeyi izleyiniz:<p>
 	<b>Adım 1: </b>Silmek istediğiniz zamanın giriş alanını tıklayınız.<br>
 	<b>Adım 2: </b>Zamanı klavyeden el ile  "Del" veya "Backspace" tuşlarını kullanarak siliniz.<br>
 	<b>Adım 3: </b>Değişiklikleri kayıt etmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 İptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php endif ?>


<?php if($src=="create") : ?>
	<?php if($x1=="logmain") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir ameliyatın kütük kaydı nasıl düzenlenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Hastanın kütük kaydı ile ilgili <img src="../img/update3.gif" width=15 height=14 border=0> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Hastanın kütük kayıtları bir düzenleyici penceresinde açılır. Kayıtları burada bir ameliyatı belgelendirme yönergelerini izleyerek düzenleyebilirsiniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hastanın belgeler klasörü nasıl açılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Hastanın numarasının solundaki  <img <?php echo createComIcon('../','info3.gif','0') ?>> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Hastanın belgeler klasörü yeni bir pencerede açılır.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Başka bir bölüm ve/veya ameliyathaneye nasıl değiştirilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Seçim kutusundan bölümü seçiniz 
				<select name="dept" size=1>
				<?php
$Or2Dept=get_meta_tags("../global_conf/resolve_or2ordept.pid");
					$opabt=get_meta_tags("../global_conf/$lang/op_tag_dept.pid");

					while(list($x,$v)=each($opabt))
					{
						if($x=="anaesth") continue;
						print'
					<option value="'.$x.'"';
						if ($dept==$x) print " seçildi";
						print '> '.$v.'</option>';
					}
				?>
					
				</select>.
<br>
 	<b>Adım 2: </b>Seçim kutusundan ameliyathaneyi seçiniz <select name="saal" size=1 >
				<?php
while(list($x,$v)=each($Or2Dept))
					{
						print'
					<option value="'.$x.'"';
						if ($saal==$x) print " seçildi";
						print '> '.$x.'</option>';
					}
				?>
				</select>.
<br>
 	<b>Adım 3: </b>Diğer bölüm ve/veya ameliyathaneye değiştirmek için <input type="button" value="Change"> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Şu anda görüntülenenin dışında belirli bir güne ait kütük kayıtları nasıl görüntülenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Daha önceki günlerin kütük kayıtlarını görüntülemek için, tablonun sol üst köşesindeki  "<span style="background-color:yellow" > Önceki gün </span>" bağlantısını tıklayınız.<br>
	İstediğiniz günün kütük girdileri görüntülenene değin ne kadar gerekirse o kadar tıklayınız.<br>
 	<b>Adım 2: </b>Sonraki günlerin kütük girdilerini görüntülemek için tablonun sağ üst köşesindeki  "<span style="background-color:yellow" > Sonraki gün </span>" bağlantısını tıklayınız.<br>
	İstediğiniz günün kaydına ulaşana değin ne kadar gerekir ise o kadar tıklayınız .<br>
</ul>

<hr>

	<?php endif ?>
	
	<?php if($x2=="material") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyat için kullanılmış bir malzeme nasıl belgelendirilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Malzemenin kalem numarasını "<span style="background-color:yellow" > Kalem numarası: </span>" alanına yazınız.<p>
	<b>Diğer yollar: </b>
	<ul type=disc>  	
	<li>Bir malzemenin ismi, ürün tanımı, jenerik, lisans numarası veya sipariş numarası bilgisinin tamamını veya bir kısmını  "<span style="background-color:yellow" > Kalem numarası: </span>" alanına giriniz.
	<li>Barkod okuyucu ile malzemenin barkodunu okutturunuz.
	</ul><br> 
 	<b>Adım 2: </b>Ürünü aramak için ya  <input type="button" value="Tamam"> düğmesini tıklatınız veya klavyeden entere basınız.<p> 
<ul>       	
 	<b>Uyarı: </b>Eğer arama bir tek sonuç bulur ise, aramanın sonucu doğrudan belgeye eklenir.<p> 
 	<b>Uyarı: </b>Eğer arama birkaç sonuç bulur ise , bir liste görüntülenir. Malzemeyi belgeye eklemek için, malzeme kaleminin  kaleminin numarasına, malzemenin ismine veya  <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> düğmesine tıklayınız.<p> 
	</ul>
 	<b>Adım 3: </b>Malzeme listeye eklendi ise, gerekirse girilenleri  "<span style="background-color:yellow" > parça sayısı</span>" alanından değiştirebilirsiniz.<p> 
<ul>       	
 	<b>Uyarı: </b>"parça sayısı" alanındaki bilgiyi değiştirdiğinizde "Kaydet" ve "Yeni baştan" düğmeleri görüntülenir.<p> 
	</ul>
 	<b>Adım 4: </b>"parça sayısı" alanındaki bilgiyi değiştirdi iseniz, değişiklikleri kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Listeden bir malzeme nasıl çıkarılır?</b>
</font>
<ul> 
 	<b>Adım 1: </b>Malzemenin ilgili <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> düğmesine tıklayınız.<br> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Malzeme bulunmadı. Bilgisi nasıl el ile (zorla) girilir?</b>
</font>
<ul> 
 	<b>Adım 1: </b> "<span style="background-color:yellow" > <img <?php echo createComIcon('../','accessrights.gif','0') ?>> Malzemeyi el ile girmek için, burayı tıklayınız. </span>" bağlantısını tıklayınız.<br> 
 	<b>Adım 2: </b>Malzemenin bilgisini ilgili alanlara el ile giriniz.<p> 
 	<b>Adım 3: </b>Malzemenin bilgisini belgeye eklemek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 İptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ana kayıt kütüğü geri tekrar nasıl görüntülenir?</b>
</font>
<ul> 
 	<b>Adım 1: </b> "<span style="background-color:yellow" > <img <?php echo createComIcon('../','manfldr.gif','0') ?>> Kayıt kütüğünü göster. </span>" bağlantısını tıklayınız.<br> 
</ul>
<hr>
	<?php endif ?>

	<?php if(($x1=="")||($x1=="fresh")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir ameliyatı kütük belgesine nasıl başlanır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Önce hastayı bulunuz. Hastanın numarasını "<span style="background-color:yellow" > Hasta no: </span>" alanına yazınız.<p>
	<b>Diğer seçenekler: </b>
	<ul type=disc>  	
	<li>Hastanın soyad veya adının tamamını ya da birkaç harfini  "<span style="background-color:yellow" > Soyad, Ad </span>" alanına giriniz .
	<li>Hastanın doğum tarihinin tamamını ya da ilk birkaç rakamını "<span style="background-color:yellow" > Doğum tarihi </span>" alanına giriniz.
	</ul>
 	<b>Adım 2: </b>Hastayı aramaya başlamak için  <input type="button" value="Hastayı ara"> düğmesini tıklayınız.<p> 
<ul>       	
 	<b>Uyarı: </b>Arama bir sonuç bulur ise, hastanın temel bilgileri hemen ilgili alanlara girilmiş görüntülenir.<p> 
 	<b>Uyarı: </b>Arama birkaç sonuç bulur ise,  bir liste görüntülenir. Belgelendirmek üzere hastayı seçmek için hastanın soyad veya adına tıklayınız.<p> 
	</ul>
 	<b>Adım 3: </b>Daha fazla bilgi için <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> düğmesini tıklayınız.<p> 

</ul>

	<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyat için tanı nasıl girilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Tanıyı  "<span style="background-color:yellow" > Tanı: </span>" alanına yazınız.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Cerrah bilgisi nasıl girilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> "<span style="background-color:yellow" > Cerrah </span>" bağlantısını tıklayınız.<br>
 	<b>Adım 2: </b>Cerrah bilgisi için bir pencere açılır. <br>
 	<b>Adım 3: </b>Pencere içindeki bilgileri izleyiniz ya da daha fazla bilgi için pencere içerisindeki "Yardım" düğmesini tıklayınız. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Asistan cerrah bilgisi nasıl girilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>"<span style="background-color:yellow" > Asistan </span>" bağlantısını tıklayınız.<br>
 	<b>Adım 2: </b>Asistan cerrah bilgisini girmek için bir pencere açılır. <br>
 	<b>Adım 3: </b>Penceredeki bilgileri izleyiniz ya da daha fazla bilgi için pencere içerisindeki "Yardım" düğmesini tıklayınız. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyat hemşiresi bilgisi nasıl girilir?</b>
</font>
<ul>       	
 	
	<b>Adım 1: </b>"<span style="background-color:yellow" > Ameliyat hemşiresi </span>" bağlantısını tıklayınız.<br>
 	<b>Adım 2: </b>Ameliyat hemşiresi bilgisini girmek için bir pencere açılır. <br>
 	<b>Adım 3: </b>Penceredeki bilgileri izleyiniz ya da daha fazla bilgi için pencere içerisindeki "Yardım" düğmesini tıklayınız. <br>
	</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yardımcı hemşire bilgisi nasıl girilir?</b>
</font>
<ul>       	
 	
	<b>Adım 1: </b>"<span style="background-color:yellow" > Yardımcı hemşire </span>" bağlantısını tıklayınız.<br>
 	<b>Adım 2: </b>Yardımcı hemşire bilgisini girmek için bir pencere açılır. <br>
 	<b>Adım 3: </b>Penceredeki bilgileri izleyiniz ya da daha fazla bilgi için pencere içerisindeki "Yardım" düğmesini tıklayınız. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyatta kullanılan anestezi tipi nasıl girilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Anestezi tipini "<span style="background-color:yellow" > Anestezi <select name="a">
                                                                     	<option > ITA</option>
                                                                     	<option > Plexus</option>
                                                                     	<option > ITA-Jet</option>
                                                                     	<option > ITA-Mask</option>
                                                                     	<option > LA</option>
                                                                     	<option > DS</option>
                                                                     	<option > AS</option>
                                                                     </select> </span>" alanından seçiniz.<p>
	<ul type=disc>       	
 	<li><b>ITA: </b>Intra-tracheal anesthesia<br>
 	<li><b>LA: </b>Local anesthesia<br>
 	<li><b>AS: </b>Analgesic-sedation<br>
 	<li><b>DS: </b>Equivalent to AS<br>
 	<li><b>Plexus: </b>Nervus plexus local anesthesia<br>
	</ul>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Anestezist bilgisi nasıl girilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>"<span style="background-color:yellow" > Anestezist </span>" bağlantısını tıklayınız.<br>
 	<b>Adım 2: </b>Anestezist bilgisini girmek için bir pencere açılır. <br>
 	<b>Adım 3: </b>Penceredeki bilgileri izleyiniz ya da daha fazla bilgi için pencere içerisindeki "Yardım" düğmesini tıklayınız. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyata giriş, kesi, sütür ve çıkış zamanları ilgili alanlarından doğrudan nasıl girilir?</b>
</font>
<ul>       	
 	<b>Giriş zamanı: </b>Zamanı "<span style="background-color:yellow" > Giriş:<input type="text" name="t" size=5 maxlength=5> </span>" alanına yazınız.<br>
 	<b>Kesi zamanı: </b>Zamanı "<span style="background-color:yellow" > Kesi: <input type="text" name="t" size=5 maxlength=5> </span>" alanına yazınız.<br>
 	<b>Sütür zamanı: </b>Zamanı "<span style="background-color:yellow" > Sütür: <input type="text" name="t" size=5 maxlength=5> </span>" alanına yazınız.<br>
 	<b>Çıkış zamanı: </b>Zamanı "<span style="background-color:yellow" > Çıkış: <input type="text" name="t" size=5 maxlength=5> </span>" alanına yazınız.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Birkaç zaman bilgisi hepsi birden nasıl girilir?</b>
</font>
<ul> <b>Adım 1: </b><p>    	
 	<b>Giriş/Çıkış zamanı: </b>
 	Sol alt köşedeki  "<span style="background-color:yellow" > Giriş/Çıkış <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" bağlantısını tıklayınız.<p>
 	<b>Kesi/Sütür zamanı:</b>
 	Sol alt köşedeki  "<span style="background-color:yellow" > Kesi/Sütür <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" bağlantısını tıklayınız.<p>
 	<b>Boş zaman: </b>
 	Sol alt köşedeki "<span style="background-color:yellow" > Boş zaman <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" bağlantısını tıklayınız.<p>
 	<b>Alçı/Atel zamanı:</b>
 	Sol alt köşedeki "<span style="background-color:yellow" > Alçı/Atel <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" bağlantısını tıklayınız.<p>
 	<b>Repozisyon zamanı: </b>
 	Sol alt köşedeki "<span style="background-color:yellow" > Repozisyon <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" bağlantısını tıklayınız.<p>
 	<b>Adım 2: </b>Bilgi girmek için bir pencere açılır. <br>
 	<b>Adım 3: </b>Penceredeki bilgileri izleyiniz ya da daha fazla bilgi için pencere içerisindeki "Yardım" düğmesini tıklayınız. <br>
	</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Grafik zaman çizelgesine nasıl bilgi girilir?</b>
</font>
<ul> <b>Adım 1: </b>Fare işaretçisini zaman cetvelinde ilgili zaman bilgisine (örneğin Alçı/Atel) karşılık gelen zaman bilgisine getiriniz.<br>
 	<b>Adım 2: </b>Seçilen zamandaki zaman cetveline tıklayınız.<p>
<b>Uyarı:</b> İlk değer başlangıç zamanı, ikinci değer bitiş zamanı, üçüncü değer ikinci başlangıç zamanı vs. olur.
	</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Tedavi veya operasyon bilgisi nasıl girilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Tedavi veya operasyonu "<span style="background-color:yellow" > Tedavi/Operasyon: </span>" alanına yazınız.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Sonuçlar, gözlem ve ek notlar nasıl girilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Bunları "<span style="background-color:yellow" > Sonuçlar: </span>" alanına yazınız.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Kütük belgesi nasıl kayıt edilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir kütük belgesine nasıl başlanır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> <img <?php echo createLDImgSrc('../','newpat2.gif','0') ?>> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Daha fazla bilgi için <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> düğmesini tekrar tıklayınız.<br>
	</ul>
	
<b>Uyarı</b>
<ul> Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>
	<?php endif ?>

<?php endif ?>



<?php if($src=="search") : ?>
<?php if(($x2!="")&&($x2!="0")) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Raporunu <?php if($x1=="edit") print "düzenlemek"; else print "görmek"; ?> istediğim belirli bir hasta nasıl seçilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Raporunu <?php if($x1=="edit") print "düzenlemek"; else print "görmek"; ?> istediğiniz hastanın ilgili &nbsp;<button><img <?php echo createComIcon('../','update2.gif','0') ?>> <font size=1>Lab raporu</font></button> düğmesini tıklayınız.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Aramaya nasıl devam edilir?</b>
</font>
	<?php endif ?>
	<?php if(($x2=="")||($x2=="0")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hasta nasıl aranır?</b>
</font>
	<?php endif ?>
	
	<ul>       	
 	<b>Adım 1: </b>Bir hastanın soyad, veya  ad, veya  doğum tarihi bilgisinin ya tamamını veya birkaç harfini  "<span style="background-color:yellow" > Aranacak anahtar sözcüğü giriniz. <input type="text" name="m" size=20 maxlength=20> </span>" alanına yazınız. <br>
 	<b>Adım 2: </b>Hastayı aramaya başlamak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düğmesini tıklayınız.<p> 
<ul>       	
 	<b>Uyarı: </b>Arama bir sonuç verir ise, bir liste görüntülenir. <p>
	</ul>
	<?php if(($x2=="")||($x2=="0")) : ?>
 	<b>Adım 3: </b>Laboratuvar raporunu  <?php if($x1=="edit") print "düzenlemek"; else print "görmek"; ?> istediğiniz hastanın &nbsp;<button><img <?php echo createComIcon('../','update2.gif','0') ?>> <font size=1>Lab raporu</font></button> düğmesini tıklayınız.<p> 
	<?php endif ?>
</ul>

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı: </b></font> 
<ul>       	
 İptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php endif ?>

<?php if($src=="arch") : ?>
	<?php if($x2=="1") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı: Son kütük kayıdı (kayıtları) </b></font> 
<ul>  Arşive her girdiğinizde son kaydedilen ameliyatlar derhal görüntülenir.
</ul>
	<?php endif ?>
	<?php if(($x3=="")&&($x1!="0")) : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Bu gün hiç ameliyat yapılmadı. </b></font> 
<ul>       	
Seçenek kutusunu açmak için "Seçenekler" i tıklayınız.<br>
Arama moduna geçmek için "Ara" yı tıklayınız.</ul>
	
	<?php endif ?>
	



<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Bir başka günün arşivli kütük bilgilerini görmek istiyorum.</b></font>
<ul> <b>Önceki günü göstermek için: </b>Sol üst sütundaki  "<span style="background-color:yellow" > Önceki gün </span>" bağlantısını tıklayınız. 
				İstenilen gün görüntüleninceye kadar ne kadar gerekir ise o kadar tıklayınız.<p>
 <b>Sonraki günü göstermek için: </b>Sağ üsr sütundaki "<span style="background-color:yellow" > Sonraki gün </span>" bağlantısını tıklayınız. 
				İstenilen gün görüntüleninceye kadar bu bağlantıya tıklamaya devam ediniz.<br>		
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Bir başka ameliyathane veya bölümün kütük bilgilerini görmek istiyorum.</b></font>
<ul> <b>Adım 1: </b>Seçenek kutusundan bölümü seçiniz <nobr>"<span style="background-color:yellow" > Bölüm veya ameliyathaneye geçiniz <select name="o">
                                                                                                                                         	<option > Örnek bölüm 1</option>
                                                                                                                                         	<option > Örnek bölüm 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br>Ön seçimli ameliyathane otomatik olarak
		düzenlenir.<br>																																		  
	<b>Adım 2: </b>Veya ameliyathaneyi seçim kutusundan seçiniz <nobr>"<span style="background-color:yellow" > <select name="o">
                                                                                                                                         	<option > Örnek ameliyathane 1</option>
                                                                                                                                         	<option > Örnek ameliyathane 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br> İlgili bölüm ameliyathaneleri
		otomatik olarak düzenlenir.<br>																																		  																																		  
		<b>Adım 3: </b>Yeni bölüm veya ameliyathaneye geçmek için  <input type="button" value="Değiştir">  düğmesini tıklayınız.<br>
</ul>
<?php if(($x3!="")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Görüntülenen bir kütük belgesi nasıl düzenlenir veya güncellenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Düzenleme moduna geçmek için en sol sütundaki ameliyat tarihinin altındaki  <img src="../img/update3.gif" border=0> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Düzenleme modunda iken belgeyi düzenlemede daha fazla yardıma gereksiniminiz olur ise "Yardım" düğmesini tıklayınız.<p> 
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hastanın veri klasörü nasıl açılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Hasta numarasının solundaki  <img src="../img/info2.gif" border=0> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Hastanın veri klasörü açılır. Daha fazla bilgiye gereksiniminiz olur ise açılan penceredeki "Yardım" düğmesini tıklayınız.<p> 
	</ul>
	<?php endif ?>
	
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 İptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
</ul>


	<?php endif ?>

<?php if($src=="input") : ?>
	<?php if($x1=="main") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Sonuç değerleri nasıl girilir?</b>
</font>
<ul>       	
		<?php if($x2=="") 
			print '
 			<b>Adım 1: </b>Küme numarasını "<span style="background-color:yellow" > Küme no: </span>" alanına giriniz.<br>	
 			<b>Adım 2: </b>Gerekir ise muayene tarihini "<span style="background-color:yellow" > Muayene tarihi </span>" alanına giriniz.<br>	';
	
		?>

	
 	<b>Adım	<?php if($x2=="") 
			print "3"; else print "1";
		?>:</b> Değerleri ilgili parametre alanlarına giriniz.<br>	
 	<b>Adım <?php if($x2=="") 
			print "4"; else print "2";
		?>: </b> Değerleri kayıt etmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<p> 
 	<b>Uyarı: </b>Değerleri kaydettikten sonra kapatmak ister iseniz,<br>  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br> 
</ul>
	<?php endif ?>
<?php if($x1=="few") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yalnızca birkaç değer girmem gerekiyor! Nasıl yapılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Değerleri illgili parametre alanlarına giriniz.<br> 
 	<b>Adım 2: </b>Parametre değerlerini kayıt etmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<p> 
 	<b>Uyarı: </b>Parametre değerlerini girmeyi bitirdi iseniz ve kapatmak istiyor iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br> 
</ul>
	<?php endif ?>
	<?php if($x1=="param") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
İstediğim parametre görüntülenmiyor! Doğru parametre grubuna nasıl geçerim?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Doğru parametre grubunu <nobr>"<span style="background-color:yellow" > Parametre grubunu seçiniz <select name="s">
     <option value="Sample parameter"> Örnek parametre</option> </select> </span>"</nobr> seçim kutusundan seçiniz.<p> 
 	<b>Adım 2: </b>Seçilen parametre grubuna geçmek için <img <?php echo createLDImgSrc('../','auswahl2.gif','0') ?>> düğmesini tıklayınız.<p> 
</ul>
	<?php endif ?>
	<?php if($x1=="save") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Değerleri nasıl kayıt etmeliyim?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Parametre değerlerini kayıt etmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<p> 
 	<b>Uyarı: </b>Değerleri kaydettikten sonra kapatmak için,<br>  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br> 
</ul>
	<?php endif ?>
	<?php if($x1=="correct") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yanlış bir değer kayıt ettim. Nasıl düzeltirim?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Doğru değeri ilgili parametre alanına giriniz.<br> 
 	<b>Adım 2: </b>Doğru değeri kayıt etmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<p> 
 	<b>Uyarı: </b>Değerleri kaydettikten sonra kapatmak için,<br>  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
</ul>
	<?php endif ?>
	<?php if($x1=="note") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir değer yerine bir not girmek istiyorum. Nasıl yapılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>İlgili parametre alanına yalnızca notu yazınız.<br> 
 	<b>Adım 2: </b>Notu kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<p> 
 	<b>Uyarı: </b>Kaydettikten sonra kapatmak için,<br>  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
</ul>
	<?php endif ?>
	<?php if($x1=="done") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
İş bitti. Şimdi ne var?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Tüm değerleri kayıt etmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<p> 
 	<b>Uyarı: </b> <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br> 
</ul>
	<?php endif ?>
	

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 İptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php endif ?>
</form>

