<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Servis Yönetimi 
<?php
switch($src)
{
	case "main": print "";
						break;
	case "new": print  " - Yeni bir servis oluştur";
						break;
	case "arch": print "Servisler - Arşiv";
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="main") : ?>

<b>Oluştur</b>

<ul>Yeni bir servis oluşturmak için, bu seçeneği tıklayınız. 
	</ul>	
</ul>
<b>Servisin profil verileri</b>
<ul>Bu seçenek servisin profil ve diğer ilgili bilgilerini gösterir.
</ul>
<b>Bir yatağı kilitle</b>
<ul>Bir yatağı ya da birkaç yatağı birden kilitlemek ister iseniz, bu seçeneği tıklayınız. Girilen servis görüntülenir, yok ise ön seçimli servis görüntülenir. Yatak kilitleme için geçerli bir şifre ve bu özelliğe erişim hakkı gerekir.
</ul>
<b>Erişim hakları</b>
<ul> Bu seçenekte belirli bir servis için erişim hakları oluşturabilir, düzenleyebilir, kilitleyebilir veya silebilirsiniz. Oluşturulan tüm erişim hakları sadece o belirli servis için geçerli olur.
</ul>
<?php endif ?>
<?php if($x2=="quick") : ?>
	<?php if($x1) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir servisin yatan hasta listesi nasıl görüntülenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Sol sütunda servisin ismi ya da kimliğini tıklayınız.<br>
	<b>Uyarı: </b>Görüntülenen yatan hasta listesi "salt okunur" dur. Hastaların bilgilerini değiştiremez veya düzenleyemezsiniz.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Servisin yatan hasta listesi düzenlemek veya güncellemek için nasıl gösterilebilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Seçilen servisin ilgili <img <?php echo createComIcon('../','statbel2.gif','0') ?>> simgesini tıklayınız.<br>
 	<b>Adım 2: </b>Daha önce giriş yaptı iseniz ve işleve erişim hakkınız var ise, yatan hasta listesi derhal görünür.<br>
		Aksi halde,  kullanıcı adı ve şifreniz sorulur.<br>
 	<b>Adım 3: </b>Sorulur ise, kullanıcı adı ve şifrenizi giriniz.<br>
 	<b>Adım 4: </b> <input type="button" value="Devam..."> düğmesini tıklayınız.<br>
 	<b>Adım 5: </b>İşleve erişim hakkınız var ise, yatan hasta listesi görüntülenir. <br>
	<b>Uyarı: </b>Görüntülenen yatan hasta listesi "düzenlenebilir" durumdadır. Hastaların bilgilerini düzenleme veya güncelleme seçenekleri de görüntülenir.
		Aynı zamanda düzenlemek için hastaların veri klasörünü de açabilirsiniz.<br>
	</ul>
	<?php else : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Şu anda yatan hasta listesi yok!</b>
</font><p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arşiv kullanılarak önceki yatan hasta listelerine hızlı bakışlar nasıl görüntülenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> "<span style="background-color:yellow" > Arşive gitmek için bunu tıklayınız <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> </span>" yazısını tıklayınız.<br>
 	<b>Adım 2: </b>Bir rehber takvim görüntülenir.<br>
 	<b>Adım 3: </b>Rehber takvimde bir günün tarihini tıklayarak o günkü yatan hasta listesini hızlı bakış olarak izleyebilirsiniz.<br>
	</ul>
	
	<?php endif ?>
<b>Uyarı</b>
<ul> Hızlı bakışı kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul><?php endif ?>

<?php if($src=="new") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir servis nasıl oluşturulur?</b>
</font>
<ul>
 	<b>Adım 1: </b>Servisin resmi adını "<span style="background-color:yellow" > Servis: </span>" alanına giriniz.<br>
 	<b>Adım 2: </b>Servisin kimliğini (kısa olmalı ve özel karakterler içermemeli)  "<span style="background-color:yellow" > Servis Kimliği: </span>" alanına giriniz.<br>
 	<b>Adım 3: </b>Servisin ait olduğu klinik veya bölümü  "<span style="background-color:yellow" > Bölüm: </span>" seçme alanından seçiniz.<br>
 	<b>Adım 4: </b>Servisin tanımı ve diğer bilgileri  "<span style="background-color:yellow" > Tanım: </span>" alanına yazınız.<br>
 	<b>Adım 5: </b>Servisin ilk odasının numarasını  "<span style="background-color:yellow" > İlk odanın oda numarası: </span>" alanına yazınız.<br>
 	<b>Adım 6: </b>Son odanın numarasını  "<span style="background-color:yellow" > Son odanın numarası: </span>" alanına yazınız.<br>
 	<b>Adım 7: </b>Oda ön ekini  "<span style="background-color:yellow" > Oda ön eki: </span>" alanına yazınız.<br>
 	<b>Adım 8: </b>Servisi oluşturmak için <input type="button" value="Servisi oluştur"> düğmesini tıklayınız.<br>
	</ul>
<b>Uyarı</b>
<ul> İptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir odadaki yatak sayısını düzenleyebilir miyim?</b>
</font>
<ul>
 	<b>Evet. </b>Fakat ancak
	<input type="button" value="Servisi oluştur"> düğmesine tıklayıp servisi oluşturduktan SONRA yatak sayısını girme şansınız olacaktır.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir yatağın ön ek (veya kimliği) ini düzenleyebilir miyim?</b>
</font>
<ul>       	
 	<b>Hayır. </b>Programın güncel versiyonunda bir yatağın ön eki (veya kimliği) A, B, C, D vs. sabittir. Değiştiremezsiniz.<br>
	</ul>
<b>Uyarı</b>
<ul> Eğer iptal etmeye karar verir iseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php endif ?>
	
<?php if($src=="show") : ?>
	<?php if($x1=="1") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Servis profili nasıl kayıt edilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> <input type="button" value="Kaydet"> düğmesini tıklayınız.<br>
	</ul>
<b>Uyarı</b>
<ul> İptal etmeye karar verir iseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
</ul>

	<?php else : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Şimdi görüntülenenin dışında bir servisin profilini düzenlemek istiyorum. Ne yapmalıyım?</b>
<p>
</font>
	<b>Uyarı:</b> Bir servisin profilini basitçe düzenleyemezsiniz. Veri bütünlüğünü sağlamak bakımından bu şekilde dizayn edilmiştir. Yeni bir servis profili oluşturmak için aşağıdaki adımları izleyiniz:
<ul>

 	<b>Adım 1:</b>Servisin ya hastaları çıkararak ya da başka servislere nakil edilerek tamamen boş olmasını sağlayınız.<p>
 	<b>Adım 2:</b> Servisi kapatmak için <input type="button" value="Bu servisi kesin olarak kapat"> düğmesini tıklayınız.<p>
	<b>Adım 3:</b> Servis yönetim modülünde "Oluştur" seçeneğini kullanarak yeni bir servis oluşturunuz.<p>
	</ul>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir servisi "geçici olarak kapatma" nın amacı nedir?</b>
<p>
</font>
	<ul>

 	<b>Yanıt:</b> Bir servis belirli bir süre için hasta kabul etmeyecek ise geçici olarak kapatılır. Örneğin tadilat, onarım, dezenfeksiyon, dekontaminasyon, vs. çalışmaları nedeni ile.
	</ul>

<b>Uyarı</b>
<ul> İptal etmek ister iseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
</ul>

<?php endif ?>
<?php endif ?>


<?php if($src=="") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir servis profilini görmek için nasıl seçilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Görmek istediğiniz servise liste üzerinde tıklayınız.<br>
	</ul>
<b>Uyarı</b>
<ul> İptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
</ul>

<?php endif ?>


</form>

