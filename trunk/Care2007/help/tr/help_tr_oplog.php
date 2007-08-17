<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
OR Logbook - 
<?php
if($src=="create")
{
	switch($x1)
	{
	case "": print "Yeni bir kütük belgesine başla";
						break;
	case "fresh": print "Yeni bir kütük belgesine başla";
						break;
	case "get": print  "";
						break;
	case "logmain": print "Belgelenmiş bir ameliyatın kütük girdilerini düzenle";
						break;
	default: print "Yeni bir ameliyat kütüğü";	
	}
}
if($src=="time")
{
	print "Belgelendiriliyor ";
	switch($x1)
	{
	case "entry_out": print "giriş ve çıkış zamanları";
						break;
	case "cut_close": print "kesi ve sütür zamanları";
						break;
	case "wait_time": print "boş (bekleme) zamanları";
						break;
	case "bandage_time": print "alçı atel zamanları";
						break;
	case "repos_time": print "repozisyon zamanları";
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
	case "rotating":$person="bir alet hemşiresi"; 
						break;
	case "ana": $person="bir anestezist";
	}
	print $person;
}
if($src=="search")
{
	switch($x1)
	{
	case "search": print "Belirli bir belge seçiliyor";
						break;
	case "": print "Bir ameliyatın kütük belgesini arama";
						break;
	case "get": print  "Hastanın ameliyatının kütük belgesi";
						break;
	case "fresh": print "Bir ameliyatın kütük belgesini arama";
	}
}
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
	case "search": print  "Arşiv arama sonuçları listesi";
						break;
	case "select": print "Hastanın belgesi";
	}*/
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="person") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hızlı seçim listesi ile <?php echo $person ?> nasıl girilir?</b>
</font>
<ul>       	
 	<b>Uyarı: </b>Eğer <?php echo $person ?> önceki ameliyatta seçildi ise, ismi hızlı seçim listesinde listelenir.<p>
 	<b>Adım 1: </b>Önce görevinin "Ameliyathane görevi" seçim kutusundan doğru olarak seçilip seçilmediğini kontrol ediniz. Eğer seçilmemişse ameliyathane görevini seçiniz veya düzeltiniz.<br>
 	<b>Asım 2: </b> <?php echo $person ?> nın soyad veya ad veya <nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Bu kişiyi <?php echo $person ?>...olarak kaydediniz </span>"</nobr> bağlantısına tıklayınız.
	Cerrah otomatik olarak "güncel girdiler" listesine eklenecektir. <p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<?php echo ucfirst($person) ?> hızlı seçim listesinde görünmüyor. <?php echo $person ?> nasıl girilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> <?php echo $person ?>'ın soyad veya adının tamamını veya ilk birkaç harfini   "<span style="background-color:yellow" > Yeni bir  <?php echo substr($person,2) ?>...ara </span>" alanına giriniz.<br>
 	<b>Adım 2: </b> <?php echo $person ?> 'ı aramaya başlamak için  <input type="button" value="Tamam"> düğmesini tıklayınız.<br>
 	<b>Adım 3: </b>Arama sonuçları listeler. Belgelendirmek istediğiniz  <?php echo $person ?> nin soyad veya ad vaya ilgili <nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Bu kişiyi  <?php echo $person ?>...olarak gir  </span>"</nobr> bağlantısına tıklayınız. 
</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Listeden <?php echo $person ?> nasıl silinir?</b></font> 
<ul>       	
 	<b>Adım 1: </b>Kişinin isminin sağındaki  <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> simgesini tıklayınız.<br>
 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> İşim bitti. Kütüğe nasıl geri giderim?</b></font> 
<ul>       	
 	<b>Adım 1: </b>Siz  <?php echo $person ?> seçtikten sonra görünen <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 İptal etmeye karar verirseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php endif;?>

<?php if($src=="time") : ?>
	<?php if($x1=="entry_out") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Giriş ve çıkış zamanları nasıl belgelendirilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Giriş zamanını sol sütundaki  "<span style="background-color:yellow" > giriş saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<br>
 	<b>Adım 2: </b>Çıkış zamanını sağ sütundaki "<span style="background-color:yellow" > çıkış saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<p>
<ul>       	
 	<b>İpucu: </b>Şu anki zamanı otomatik olarak girmek için  "n" veya "N" (Now=şimdi anlamında) giriniz.
</ul><br>
 	<b>Uyarı: </b>Bilgiyi kayıt etmeden önce birkaç giriş ve çıkış saatini birden girebilirsiniz.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="cut_close") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Kesi ve sütür saatleri nasıl belgelendirilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Kesi zamanını sol sütundaki "<span style="background-color:yellow" > başlama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<br>
 	<b>Adım 2: </b>Sütür zamanını sağ sütundaki  "<span style="background-color:yellow" > bitiş saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<p>
<ul>       	
 	<b>İpucu: </b>Şu anki zamanı otomatik olarak girmek için  "n" veya "N" (Now=şimdi anlamında) giriniz.
</ul><br>
 	<b>Uyarı: </b>Bilgiyi kayıt etmeden önce birkaç kesi ve sütür saatini birden girebilirsiniz..<p>
</ul>

	<?php endif;?>
	<?php if($x1=="wait_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Boş (bekleme) zamanları nasıl belgelendirilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Başlama saatini ilk sütundaki  "<span style="background-color:yellow" > başlama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<br>
 	<b>Adım 2: </b>Bitiş saatini ikinci sütundaki  "<span style="background-color:yellow" > bitiş saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<p>
<ul>       	
 	<b>İpucu: </b>Şu anki zamanı otomatik olarak girmek için  "n" veya "N" (Now=şimdi anlamında) giriniz.
</ul><br>
 	<b>Adım 3: </b>Sebebi üçüncü sütundaki (sebep) seçim kutusundan seçiniz.<p>
 	<b>Uyarı: </b>Bilgiyi kayıt etmeden önce birkaç başlama, bitiş saati ve sebepleri birden girebilirsiniz.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="bandage_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Alçı ve atel zamanları nasıl belgelendirilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Başlama saatini ilk sütundaki  "<span style="background-color:yellow" > başlama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<br>
 	<b>Adım 2: </b>Bitiş saatini ikinci sütundaki  "<span style="background-color:yellow" > bitiş saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<p>
<ul>       	
 	<b>İpucu: </b>Şu anki zamanı otomatik olarak girmek için  "n" veya "N" (Now=şimdi anlamında) giriniz.
</ul><br>
 	<b>Uyarı: </b>Bilgiyi kayıt etmeden önce birkaç başlama, bitiş saati birden girebilirsiniz.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="repos_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Repozisyon zamanları nasıl belgelendirilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Başlama saatini ilk sütundaki  "<span style="background-color:yellow" > başlama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<br>
 	<b>Adım 2: </b>Bitiş saatini ikinci sütundaki  "<span style="background-color:yellow" > bitiş saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<p>
<ul>       	
 	<b>İpucu: </b>Şu anki zamanı otomatik olarak girmek için  "n" veya "N" (Now=şimdi anlamında) giriniz.
</ul><br>
 	<b>Uyarı: </b>Bilgiyi kayıt etmeden önce birkaç başlama, bitiş saati birden girebilirsiniz.<p>
</ul>

	<?php endif;?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bilgi nasıl kayıt edilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Bilgiyi kayıt etmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>İşiniz bitti ise, pencereyi kapatıp kütüğe geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Girilenleri silmek istiyorum fakat "Yeni baştan" düğmesi çalışmıyor görünüyor. Ne yapmalıyım?</b></font> 
<ul>       	
 	<b>Uyarı: </b>"Yeni baştan" düğmesi tıklandığında yalnızca kayıt edilmemiş girdileri siler. Daha önceden kayıt edilmiş girdileri silmek ister iseniz şu yönergeyi izleyiniz:<p>
 	<b>Adım 1: </b>Silmek istediğiniz zamanın giriş alanını tıklayınız.<br>
 	<b>Adım 2: </b>Zamanı el ile klavyedeki "sil" veya "geri" tuşlarını kullanarak siliniz.<br>
 	<b>Adım 3: </b>Değişiklikleri kayıt etmek için  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 İptal etmeye karar verir iseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php endif;?>


<?php if($src=="create") : ?>
	<?php if($x1=="logmain") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyatın kütük kayıdı nasıl düzenlenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Hastanın kütük girdisinin ilgili  <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>>  düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Hastanın kütük kayıtları editör çerçeveye kopyalanır. Burada kayıtları bir ameliyatı belgelendirme yönergelerini izleyerek düzenleyebilirsiniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hastanın belge klasörü nasıl açılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Hasta numarasının solundaki  <img <?php echo createComIcon('../','info3.gif','0') ?>> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Hastanın belge klasörü açılır.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Başka bölüm ve/veya ameliyathaneye nasıl değiştirilir?</b>
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
 	<b>Adım 3: </b>Başka ameliyathane ve/veya bölüme değiştirmek için  <input type="button" value="Değiştir"> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Halen gösterilenin dışında belirli bir günün kütük kayıtları nasıl görüntülenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Önceki gün(günler) in kütük girdilerini göstermek için tablonun üst sol köşesindeki  "<span style="background-color:yellow" > Önceki gün </span>" bağlantısını tıklayınız.<br>
	İstenilen günün kütük girdileri görüntülenene değin gerektiği kadar tıklayınız.<br>
 	<b>Adım 2: </b>Sonraki gün(günler) in kütük girdilerini göstermek için tablonun üst sağ köşesindeki  "<span style="background-color:yellow" > Sonraki gün </span>" bağlantısını tıklayınız.<br>
	İstenilen günün kütük girdileri görüntülenene değin gerektiği kadar tıklayınız.<br>
</ul>

<hr>

	<?php endif;?>
	
	<?php if($x2=="material") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyatta kullanılan malzeme nasıl belgelendirilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Malzemenin numarasını "<span style="background-color:yellow" > Malzeme no.: </span>" alanına yazınız.<p>
	<b>Diğer seçenekler: </b>
	<ul type=disc>  	
	<li>Malzemenin adı, ürün tanımı, jenerik lisans numarası, sipariş numarası bilgisinin ya tamamını ya da ilk birkaç harfini  "<span style="background-color:yellow" > Malzeme no.: </span>" alanına yazınız.
	<li>Malzemenin barkodunu barkod okuyucuya okutunuz.
	</ul><br> 
 	<b>Adım 2: </b>Ürünü aramak için  <input type="button" value="Tamam"> düğmesini tıklayınız veya klavyede  "enter" tuşuna basınız.<p> 
<ul>       	
 	<b>Uyarı: </b>Eğer arama bir sonuç bulur ise, malzemenin bilgisi belgeye derhal eklenir.<p> 
 	<b>Uyarı: </b>Arama birkaç sonuç bulur ise, bir liste görüntülenir. Malzemeyi belgeye eklemek için malzemenin adını, veya numarasını, veya  <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> düğmesini tıklayınız.<p> 
	</ul>
 	<b>Adım 3: </b>Eğer malzeme belgeye eklendi ise, eğer gerekir ise  "<span style="background-color:yellow" > parça sayısı.</span>" alanındaki bilgiyi değiştirebilirsiniz.<p> 
<ul>       	
 	<b>Uyarı: </b>"Parça sayısı" alanındaki girdiyi değiştirdiğiniz zaman "Kaydet" ve "Yeni baştan" düğmeleri belirir.<p> 
	</ul>
 	<b>Adım 4: </b>Eğer "Parça sayısı" alanındaki girdiyi değiştirdi iseniz, değişiklikleri kayıt etmek için  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Listeden bir malzeme nasıl silinir?</b>
</font>
<ul> 
 	<b>Adım 1: </b>İlgili malzemenin <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> simgesini tıklayınız.<br> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Malzeme bulunmadı. Bir malzemenin bilgisi nasıl el ile (zorla) girilir?</b>
</font>
<ul> 
 	<b>Adım 1: </b> "<span style="background-color:yellow" > <img <?php echo createComIcon('../','accessrights.gif','0') ?>> Malzemeyi el ile girmek için burayı tıklayınız. </span>" bağlantısını tıklayınız.<br> 
 	<b>Adım 2: </b>Malzeme bilgisini ilgili alanlara el ile giriniz.<p> 
 	<b>Adım 3: </b>Malzemenin bilgisini belgeye eklemek için  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 İptal etmeye karar verirseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ana kütük geri nasıl görüntülenir?</b>
</font>
<ul> 
 	<b>Adım 1: </b> "<span style="background-color:yellow" > <img <?php echo createComIcon('../','manfldr.gif','0') ?>> Kütük kayıdını göster. </span>" bağlantısını tıklayınız.<br> 
</ul>
<hr>
	<?php endif;?>

	<?php if(($x1=="")||($x1=="fresh")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir ameliyatın kütük belgesine nasıl başlanır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Önce hastayı bulunuz. Hastanın numarasını "<span style="background-color:yellow" > Hasta no: </span>" alanına yazınız.<p>
	<b>Diğer seçenekler: </b>
	<ul type=disc>  	
	<li>Hastanın soyad veya adının tamamını veya ilk birkaç harfini  "<span style="background-color:yellow" > Soyad, Ad </span>" alanına giriniz.
	<li>Hastanın doğum tarihinin tamamını veya ilk birkaç rakamını  "<span style="background-color:yellow" > Doğum tarihi </span>" alanına giriniz.
	</ul>
 	<b>Adım 2: </b>Hastayı aramaya başlamak için  <input type="button" value="Hastayı ara"> düğmesini tıklayınız.<p> 
<ul>       	
 	<b>Uyarı: </b>Eğer arama bir sonuç bulur ise, hastanın temel bilgileri ilgili alanlara hemen girilir.<p> 
 	<b>Uyarı: </b>Arama birkaç sonuç bulur ise, bir liste görülür. Belgelendirmek için hastanın soyadı veya adını tıklayınız.<p> 
	</ul>
 	<b>Adım 3: </b>Daha fazla bilgi için  <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> düğmesini tekrar tıklayınız.<p> 

</ul>

	<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyat için tanı nasıl girilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Tanıyı "<span style="background-color:yellow" > Tanı: </span>" alanına yazınız.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Cerrah bilgisi nasıl girilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>"<span style="background-color:yellow" > Cerrah </span>" bağlantısını tıklayınız.<br>
 	<b>Adım 2: </b>Cerrahın bilgisini girmek için bir pencere açılır. <br>
 	<b>Adım 3: </b>Penceredeki yönergeleri izleyiniz veya daha fazla bilgi için pencere içerisindeki "Yardım" düğmesini tıklayınız. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Asistan cerrah bilgisi nasıl girilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> "<span style="background-color:yellow" > Asistan </span>" bağlantısını tıklayınız.<br>
 	<b>Adım 2: </b>Asistan cerrahın bilgilerini girmek için bir pencere açılır. <br>
 	<b>Adım 3: </b>Penceredeki yönergeleri izleyiniz veya daha fazla bilgi için pencere içerisindeki "Yardım" düğmesini tıklayınız. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyat hemşiresi bilgileri nasıl girilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> "<span style="background-color:yellow" > Ameliyat hemşiresi </span>" bağlantısını tıklayınız.<br>
 	<b>Adım 2: </b>Ameliyat hemşiresi bilgilerini girmek için bir pencere açılır. <br>
 	<b>Adım 3: </b>Penceredeki yönergeleri izleyiniz veya daha fazla bilgi için pencere içerisindeki "Yardım" düğmesini tıklayınız.  <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Alet hemşiresi bilgileri nasıl girilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> "<span style="background-color:yellow" > Alet hemşiresi </span>" bağlantısını tıklayınız.<br>
 	<b>Adım 2: </b>Alet hemşiresi bilgilerini girmek için bir pencere açılır. <br>
 	<b>Adım 3: </b>Penceredeki yönergeleri izleyiniz veya daha fazla bilgi için pencere içerisindeki "Yardım" düğmesini tıklayınız.  <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyatta kullanılan anestezi tipi nasıl girilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>anestezi tipini  "<span style="background-color:yellow" > Anestezi <select name="a">
                                                                     	<option > ITA</option>
                                                                     	<option > Plexus</option>
                                                                     	<option > ITA-Jet</option>
                                                                     	<option > ITA-Mask</option>
                                                                     	<option > LA</option>
                                                                     	<option > DS</option>
                                                                     	<option > AS</option>
                                                                     </select> </span>" alanından seçiniz.<p>
	<ul type=disc>       	
 	<li><b>ITA: </b>İntra-trakeal anestezi<br>
 	<li><b>LA: </b>Lokal anestezi<br>
 	<li><b>AS: </b>Analjezik-sedasyon<br>
 	<li><b>DS: </b>AS ye eşdeğer<br>
 	<li><b>Plexus: </b>Pleksus bloğu lokal anestezi<br>
	</ul>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Anastezist bilgileri nasıl girilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> "<span style="background-color:yellow" > Anestezist </span>" bağlantısını tıklayınız.<br>
 	<b>Adım 2: </b>Anestezist bilgilerini girmek için bir pencere açılır. <br>
 	<b>Adım 3: </b>Penceredeki yönergeleri izleyiniz veya daha fazla bilgi için pencere içerisindeki "Yardım" düğmesini tıklayınız. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Giriş, kesi, sütür ve çıkış zamanları doğrudan ilgili alanlara nasıl girilir?</b>
</font>
<ul>       	
 	<b>Giriş zamanı: </b>Giriş zamanını  "<span style="background-color:yellow" > Giriş:<input type="text" name="t" size=5 maxlength=5> </span>" alanına giriniz.<br>
 	<b>Kesi zamanı: </b>Kesi zamanını "<span style="background-color:yellow" > Kesi: <input type="text" name="t" size=5 maxlength=5> </span>" alanına giriniz.<br>
 	<b>Sütür zamanı: </b>Sütür zamanını "<span style="background-color:yellow" > Sütür: <input type="text" name="t" size=5 maxlength=5> </span>" alanına giriniz.<br>
 	<b>Çıkış zamanı: </b>Çıkış zamanını "<span style="background-color:yellow" > Çıkış: <input type="text" name="t" size=5 maxlength=5> </span>" alanına giriniz.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Birkaç zaman bilgisi hep bir arada nasıl girilir?</b>
</font>
<ul> <b>Adım 1: </b><p>    	
 	<b>Giriş/Çıkış zamanı: </b>
 	Sol alt köşede bulunan  "<span style="background-color:yellow" > Giriş/Çıkış <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" bağlantısını tıklayınız.<p>
 	<b>Kesi/Sütür zamanı:</b>
 	Sol alt köşede bulunan  "<span style="background-color:yellow" > Kesi/Sütür <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" bağlantısını tıklayınız.<p>
 	<b>Boş zaman: </b>
 	Sol alt köşede bulunan "<span style="background-color:yellow" > Boş zaman <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" bağlantısını tıklayınız.<p>
 	<b>Alçı/Atel zamanı:</b>
 	Sol alt köşede bulunan "<span style="background-color:yellow" > Alçı/Atel <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" bağlantısını tıklayınız.<p>
 	<b>Repozisyon zamanı: </b>
 	Sol alt köşede bulunan "<span style="background-color:yellow" > Repozisyon <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" bağlantısını tıklayınız.<p>
 	<b>Adım 2: </b>Zaman bilgilerini girmek için bir pencere açılır. <br>
 	<b>Adım 3: </b>Penceredeki yönergeleri izleyiniz veya daha fazla bilgi için pencere içerisindeki "Yardım" düğmesini tıklayınız.  <br>
	</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Grafik zaman çizelgesine zaman bilgisi nasıl girilir?</b>
</font>
<ul> <b>Adım 1: </b>Fare işaretçisini zaman çizelgesinde ilgili zaman bilgisi için seçilen zaman üzerine götürünüz (Örneğin Alçı/Atel).<br>
 	<b>Adım 2: </b>Seçilen zamana karşılık gelen zaman çizelgesine tıklayınız.<p>
<b>Uyarı:</b> İlk girdiğiniz başlama zamanı, ikinci girdiğiniz bitiş zamanı, üçüncü girdiğiniz ikinci başlama zamanı vs. olur.
	</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Tedavi veya ameliyat bilgisi nasıl girilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Tedavi veya ameliyat bilgisini "<span style="background-color:yellow" > Tedavi/Ameliyat: </span>" alanına giriniz.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Sonuçlar, gözlem, ek bilgiler nasıl girilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> "<span style="background-color:yellow" > Sonuçlar: </span>" alanına yazınız.<br>
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
 	<b>Adım 1: </b> <img <?php echo createLDImgSrc('../','newpat2.gif','0') ?>> düğmesini tıklayınız<br>
 	<b>Adım 2: </b>Daha fazla bilgi için  <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> düğmesini tekrar tıklayınız.<br>
	</ul>
	
<b>Uyarı</b>
<ul> Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>
	<?php endif;?>

<?php endif;?>



<?php if($src=="search") : ?>
	<?php if(($x1=="fresh")||($x1=="")) : ?>


<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Belirli bir hastanın belgesi nasıl araştırılır?</b>
</font>
<ul>       	
 	<b>Adım  1: </b>Hastanın soyad, ad, veya doğum tarihi bilgilerinin ya tamamını  veya ilk birkaç harfini  "<span style="background-color:yellow" > Anahtar sözcük: <input type="text" name="m" size=20 maxlength=20> </span>" alanına giriniz. <br>
 	<b>Adım 2: </b>Hastanın belgesini aramaya başlamak için  <input type="button" value="Ara"> düğmesini tıklayınız.<p> 
<ul>       	
 	<b>Uyarı: </b>Arama anahtar sözcüğün tam karşılığını bulur ise, hastanın belgesi derhal görüntülenir.<p> 
 	<b>Uyarı: </b>Eğer arama anahtar sözcüğe sadece yaklaşık bir sözcük bulur ise bir liste görüntülenir. 
	Belgesini görüntülemek için hastanın soyadını tıklayınız.<p> 
	</ul>
</ul>
	<?php endif;?>
<?php if(($x1=="search")&&($x3!="1")) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Belirli belge görüntülenmek üzere nasıl seçilir?</b>
</font>
<ul>       	
 	<b>Uyarı: </b> Belgesini görüntülemek için hastanın soyadını tıklayız.<p> 
</ul>

	<?php endif;?>
<?php if(($x1=="get")||($x3=="1")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Görüntülenen kütük belgesi nasıl düzenlenir veya güncellenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Düzenleme moduna geçmek için ameliyat tarihinin altındaki en sol sütunda bulunan  <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Düzenleme moduna geçtiğinizde belge düzenleme ilgili daha fazla yardıma gereksiniminiz olur ise "Yardım" düğmesini tıklayınız.<p> 
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hastanın belge klasörü nasıl açılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Hastanın protokol numarasının solundaki <img <?php echo createComIcon('../','info3.gif','0') ?>> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Hastanın belge klasörü açılır. Daha fazla bilgiye gereksiniminiz olur ise pencere içerisindeki "Yardım" düğmesini tıklayınız.<p> 
	</ul>

<?php endif;?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Aramaya nasıl devam edilir?</b>
</font>
<ul>       	
 	<b>Adım  1: </b>Hastanın soyad, ad, veya doğum tarihi bilgilerinin ya tamamını  veya ilk birkaç harfini  "<span style="background-color:yellow" > Anahtar sözcük: <input type="text" name="m" size=20 maxlength=20> </span>" alanına giriniz. <br>
 	<b>Adım 2: </b>Hastanın belgesini aramaya başlamak için  <input type="button" value="Ara"> düğmesini tıklayınız.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php endif;?>

<?php if($src=="arch") : ?>
	<?php if($x2=="1") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı: Son kütük girdileri</b></font> 
<ul>  Arşive her girişinizde, son tütüğe alınmış amaliyatlar derhal görüntülenir.
</ul>
	<?php endif;?>
	<?php if(($x3=="")&&($x1!="0")) : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Bu tarihte hiç ameliyat yapılmadı.</b></font> 
<ul>       	
Seçenekler kutusundan "Seçenekler" i tıklayınız.<br>
Arama moduna geçmek için "Ara" yı tıklayınız.</ul>
	
	<?php endif;?>
	



<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Bir başka günün arşivlenmiş kütük girdilerini görmek istiyorum.</b></font>
<ul> <b>Önceki günü görüntülemek için : </b>Üst sol sütundaki  "<span style="background-color:yellow" > Önceki gün </span>" bağlantısını tıklayınız. 
				Bu bağlantıyı istenilen gün görüntülenene değin ne kadar gerekir ise o kadar tıklayınız.<p>
 <b>Sonraki günü görüntülemek için: </b>Üst sağ sütundaki "<span style="background-color:yellow" > Sonraki gün </span>" bağlantısını tıklayınız. 
				İstenilen gün görüntülenene değin bu bağlantıyı ne kadar gerekir ise o kadar tıklayınız.<br>		
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Bir başka ameliyathane veya bölümün arşivlenmiş kütük bilgilerini görmek istiyorum.</b></font>
<ul> <b>Adım 1: </b>Bölümü seçim kutusundan seçiniz <nobr>"<span style="background-color:yellow" > Bötüm veya ameliyathaneyi değiştiriniz <select name="o">
                                                                                                                                         	<option > Örnek bölüm 1</option>
                                                                                                                                         	<option > Örnek bölüm 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br>																  
	<b>Adım 2: </b>Veya ameliyathaneyi seçim kutusundan seçiniz <nobr>"<span style="background-color:yellow" > <select name="o">
                                                                                                                                         	<option > Örnek ameliyathane 1</option>
                                                                                                                                         	<option > Örnek ameliyathane 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br> 						  																																		  
		<b>Adım 3: </b>Yeni bölüm veya ameliyathaneye değiştirmek için Click the button <input type="button" value="Değiştir">  düğmesini tıklayınız.<br>
</ul>
<?php if(($x3!="")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Görüntülenen kütük belgesi nasıl güncellenir veya düzenlenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Düzenleme moduna geçmek için ameliyat tarihinin altında en sol sütundaki <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Düzenleme moduna geçtikten sonra daha fazla bilgiye gereksinim duyar iseniz "Yardım" düğmesini tıklayınız.<p> 
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hastanın veri klasörü nasıl açılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Hastanın protokol numarasının solundaki  <img <?php echo createComIcon('../','info3.gif','0') ?>> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Hastanın bilgi klasörü açılır. Daha fazla açıklamaya gereksinim duyar iseniz "Yardım" düğmesini tıklayınız.<p> 
	</ul>
	<?php endif;?>
	
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 İptal etmeye karar verir iseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
</ul>


	<?php endif;?>


</form>

