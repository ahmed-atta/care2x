<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
switch($x2)
{
	case "search": print "Nasıl "; 
 						if($x1) print 'bir anahtar sözcük bulunduğunda servis yatan hasta listesi gösterilir';
						else  print 'bir hasta aranır';
						break;
	case "quick": print  "Bugünkü servis yatan hasta listesi hızlı bakış";
						break;
	case "arch": print "Servisler arşivi";
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($x2=="search") : ?>
<?php if(!$x1) : ?>
<b>Adım 1</b>

<ul>  "<span style="background-color:yellow" >Lütfen aranacak bir anahtar sözcük giriniz.</span>" 
	alanına bir ad veya soyadın tamamını veya ilk birkaç harfini giriniz.
		<ul type=disc><li>Örnek 1:  "Gürcan" veya "gür" giriniz.
		<li>Örnek 2: "Potur" veya "Pot" giriniz.
		<li>Örnek 3: "Potur, Gürcan" giriniz.
	</ul>	
</ul>
<b>Adım 2</b>
<ul> Aramayı başlatmak için <input type="button" value="Ara"> düğmesini tıklayınız.<p>
</ul>
<b>Adım 3</b>
<ul> Eğer arama bir sonuç bulur ise, anahtar sözcüğün bulunduğu yatan hasta listesi görüntülenir.<p>
</ul>
<b>Adım 4</b>
<ul> Eğer arama birkaç sonuç bulur ise, sonuçlar listesi görüntülenir.<p>
</ul>
<b>Uyarı</b>
<ul> Aramayı iptal etmek ister iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
</ul><?php endif ?>
<b>Adım <?php if($x1) print "1"; else print "5"; ?></b><ul>Servis yatan hasta listesini görmek için ya <img <?php echo createComIcon('../','bul_arrowblusm.gif','0') ?>> düğmesini, veya tarih veya servisi tıklayınız.
<p><b>Uyarı:</b> Aranan sözcük listede belirginleştirilmiş olarak görüntülenir. 
<br><b>Uyarı:</b> Liste "salt okunur" moddadır, düzenlenemez. Eğer hastanın ismini tıklayarak bilgileri klasörünü açmak ister iseniz kullanıcı adı ve parolanız sorulur.
</ul>
<?php endif ?>
<?php if($x2=="quick") : ?>
	<?php if($x1) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Diğer günlerin yatan hasta listeleri nasıl görüntülenir?</b>
</font>
<ul>       	
 	<b>Adım: </b>Mini takvimde tarihi tıklayınız.<p>
	<img src="../help/tr/img/tr_mini_calendar_php.png" border=0 width=223 height=133><p>
	<b>Uyarı: </b>Görüntülenen eski hasta listesi "salt okunur" dur. Hasta bilgisini değiştiremez ve düzenleyemezsiniz.<br>
	</ul>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Servis yatan hasta listesi nasıl görüntülenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Sol sütundaki servis kimliği ya da ismini tıklayınız.<br>
	<b>Uyarı: </b>Görüntülenen hasta listesi "salt okunur" dur. Hasta bilgisini değiştiremez ve düzenleyemezsiniz.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Servis yatan hasta listesi düzenlemek veya güncellemek üzere nasıl gösterilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Seçilen servisin ilgili  <img <?php echo createComIcon('../','statbel2.gif','0') ?>> simgesini tıklayınız.<br>
 	<b>Adım 2: </b>Daha önce giriş yaptı iseniz, ve işleve erişim hakkınız bulunuyor ise, yatan hasta listesi derhal görüntülenir.<br>
		Aksi halde, kullanıcı adı ve şifrenizi girmeniz istenir.<br>
 	<b>Adım 3: </b>Sorulur ise, kullanıcı adı ve şifrenizi giriniz.<br>
 	<b>Adım 4: </b> <img <?php echo createLDImgSrc('../','continue.gif','0') ?>> düğmesini tıklayınız.<br>
 	<b>Adım 5: </b>İşleve erişim hakkınız var ise, yatan hasta listesi görüntülenir.<br>
	<b>Uyarı: </b>Görüntülenen yatan hasta listesi "düzenlenebilir" haldedir. Hasta bilgilerini düzenleme veya güncelleme seçenekleri görüntülenir.
		Hastaların bilgi klasörlerini de düzenlemek için açabilirsiniz.<br>
	</ul>
	<?php else : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Şu anda yatan hasta listesi oluşturulmamış</b>
</font><p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arşiv kullanılarak önceki yatan hasta listeleri hızlı bakış olarak nasıl izlenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> "<span style="background-color:yellow" > Arşive gitmek için burayı tıklayınız <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> </span>" yazısını tıklayınız.<br>
 	<b>Adım 2: </b>Bir rehber takvim görüntülenir.<br>
 	<b>Adım 3: </b>O günün yatan hasta listesini görüntülemek için takvimdeki bir tarihi tıklayınız.<br>
	</ul>
	
	<?php endif ?>
<b>Uyarı</b>
<ul> Hızlı bakış penceresini kapatmak ister iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul><?php endif ?>

<?php if($x2=="arch") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arşiv kullanılarak önceki yatan hasta listeleri hızlı bakışta nasıl izlenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>O günün yatan hastalarına hızlı bakış için takvimdeki bir tarihi tıklayınız.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Rehber takvimdeki ay nasıl değiştirilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Sonraki ayı göstermek için, rehber takvimin üst SAĞ köşesindeki ay ismini tıklayınız
								İstenen ay görüntüleninceye kadar ne kadar gerekirse o kadar tıklayınız.<p>
 	<b>Adım 2: </b>Önceki ayı görüntülemek için, rehber takvimin SOL üst köşesindeki ay ismini tıklayınız.
								İstenen ay görüntüleninceye kadar ne kadar gerekirse o kadar tıklayınız.<br>
	</ul>
	
	<?php endif ?>


</form>

