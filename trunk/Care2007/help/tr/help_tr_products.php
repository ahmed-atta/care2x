<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
if($x2=="pharma") print "Eczane - "; else print "Tıbbi ambar - ";
	switch($src)
	{
	case "head": if($x2=="pharma") print "Farmasötik ürünlerin istemi"; 
						else print "Ürünlerin istemi";
						break;
	case "catalog": print "İstem kataloğu";
						break;
	case "orderlist": print "İstem sepeti ( istem listesi )";
						break;
	case "final": print "Son istem listesi";
						break;
	case "maincat": print "İstem kataloğu";
						break;
	case "arch": print "İstem arşivi";
						break;
	case "archshow": print "İstem arşivi";
						break;
	case "db": switch($x3)
					{
						case "input": print "Veri bankasına yeni ürün girişi";
						break;
					}
					break;
	case "how2":print "Nasıl istem yapmalı ";
						  if($x2=="pharma") print "farmasötik ürünler"; else print "ürünler";
	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="maincat") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir kalem malzeme istem kataloğuna nasıl eklenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Önce malzemeyi bulmalısınız.  Malzemenin marka ismi, jenerik ismi, sipariş numarası vb bilgisinin ya tamamını ya da birkaç harfini 
				<nobr><span style="background-color:yellow" >" Bir anahtar sözcük ara: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alanına giriniz.<br>
 	<b>Adım 2: </b>Malzemeyi bulmak için  <input type="button" value="Malzemeyi bul"> düğmesini tıklayınız.<br>
 	<b>Adım 3: </b>Arama sonunda anahtar sözcüğün tam karşılığı bulunur ise , malzemenin ayrıntılı bir tanımı görüntülenir. <br>
 	<b>Adım 4: </b>Malzemeyi kataloğa eklemek için <input type="button" value="Bu malzemeyi kataloğa koy"> düğmesini tıklayınız.<p>
 	<b>Uyarı: </b>Bu malzemeyi kataloğa koymak istemez iseniz, bir başka malzemeyi aramaya devam ediniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Aramaya nasıl devam edilir?</b>
</font>
<ul>       	
 	Yukarıda malzemeyi bulmak için belirtilen yönergeyi izleyiniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arama benim anahtar sözcüğüme yakın birkaç sonuç buldu. Ne yapmalıyım?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Arama anahtar sözcüğe yakın bir veya birkaç malzeme bulur ise, bir liste görüntülenir..<br>
 	<b>Adım 2: </b><img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>> Düğmesini tıklayınız. Malzeme katalog listesine eklenir.<br>
 	<b>Adım 3: </b>Malzeme hakkındaki tam bilgiyi görmek ister iseniz, ya ismini veya düğmesini tıklayınız <img <?php echo createComIcon('../','info3.gif','0') ?>>.<br>
 	<b>Adım 4: </b>Malzemenin tam bilgisi görüntülenir.<br>
 	<b>Adım 5: </b> <input type="button" value="Bu malzemeyi kataloğa koy"> düğmesini tıklayınız.<p>
</ul>
	

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Malzeme hakkında daha fazla bilgi görmek istiyorum. Ne yapmalıyım?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Ya malzemenin ismini ya da  <img <?php echo createComIcon('../','info3.gif','0') ?>> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Ürünün tam bilgisi görüntülenir.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir malzeme katalog listesinden nasıl çıkarılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Malzemenin <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> düğmesini tıklayınız.<br>
</ul>

<?php endif;?>

<?php if($src=="how2") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
 <?php if($x2=="pharma") print "Farmasötik ürünler"; else print "Tıbbi ambardan ürünler"; ?>   nasıl istem yapılır?
</b>
</font>
<ul>       	
 	<b>Adım 1: </b>İsteme geçmek için menüden  "<span style="background-color:yellow" > <img <?php echo createComIcon('../','bestell.gif','0') ?>> İstem </span>" seçeneğini tıklayınız.<br>
 	<b>Adım 2: </b>Daha önce giriş yaptı iseniz, istem sepeti ve istem kataloğu görüntülenir. Daha önce giriş yapmadı iseniz kullanıcı adı ve şifre sorulur.<br>

 	<b>Adım 3: </b>Eğer sorulur ise, kullanıcı adı ve şifrenizi giriniz. <img <?php echo createLDImgSrc('../','continue.gif','0') ?>> düğmesini tıklayınız.<br>
 	<b>Adım 4: </b>Bir istem listesi oluşturmaya başlayınız. Sağ çerçevede bölüm, servis veya ameliyathaneniz için istem kataloğunu göreceksiniz. <p>
 	<b>Adım 5: </b>Gereksiniminiz olan malzeme katalog listesinde ise, sol çerçevedeki sepete (istem listesine) malzemeden <b>bir adet</b> koymak için  <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> düğmesine tıklayınız.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
İstem sepetine bir malzemeden birden fazla sayıda koymak istiyorum. Nasıl yapılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Seçmek için ilgili malzemenin <input type="checkbox" name="a" value="a" checked> seçim düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Malzemenin ilgili  " Pcs. <input type="text" name="d" size=2 maxlength=2> " alanına parça sayısını giriniz.<br>
 	<b>Adım 3: </b>Malzemeyi sepete (istem listesine) koymak için <input type="button" value="Sepete koy"> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Gereksinimim olan malzeme katalog listesinde yok. Ne yapmalıyım?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Malzemeyi bulmalısınız. Malzemenin marka adı, jenerik adı, sipariş numarası vb bilgisinin ya tamamını ya da baştan birkaç harfini 
				<nobr><span style="background-color:yellow" >" Aranan anahtar sözcük: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alanına giriniz.<br>
 	<b>Adım 2: </b>Malzemeyi bulmak için <input type="button" value="Malzemeyi bul"> düğmesini tıklayınız.<br>
 	<b>Adım 3: </b>Arama malzemeyi veya aranan anahtar sözcüğe yakın bir malzemeyi  bulur ise bir liste görüntülenir. <br>
 	<b>Adım 4: </b>İstem sepetine malzemenin bir adedini koymak ister iseniz, <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> düğmesini tıklayınız. Malzeme sepete konulur ve aynısı katalog listesine de eklenir.<br>
 	<b>Adım 5: </b>Malzemeyi sadece katalog listesine eklemek ister iseniz <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Malzeme hakkında daha fazla bilgi görmek istiyorum. Ne yapmalıyım?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Ya malzemenin ismini veya  <img <?php echo createComIcon('../','info3.gif','0') ?>> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Ürün hakkında tüm bilgileri gösteren bir pencere açılır.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Katalog listesinden bir ürün nasıl silinir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Malzemenin <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
İstem sepetindeki parça sayısını değiştirebilir miyim?
</b>
</font>
<ul>       	
 	<b>Evet.</b> İstem listesini sonlandırmadan önce sadece parça sayısı girdilerini düzenlemeniz yeterli olur.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Gereksinimim olan tüm malzemeler şimdi sepette. Sonra ne yapmalıyım?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>İstem listesini  <?php if($x2=="pharma") print "eczaneye"; else print "tıbbi ambara"; ?> gönderebilirsiniz. <br>İşleme başlamak için <input type="button" value="İstem listesini sonlandır"> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>İstem listesi tekrar görüntülenir. İsminizi<nobr>"<span style="background-color:yellow" > Oluşturan <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alanına giriniz.<br>
 	<b>Adım 3: </b>İstemin öncelik durumunu "<span style="background-color:yellow" > Normal<input type="radio" name="x" value="s" checked> Acil<input type="radio" name="x" > </span>" arasından seçiniz. Uygun kutuyu işaretleyiniz.<br>
 	<b>Adım 4: </b>Onaylayan (doktor veya cerrah) ismini <nobr>"<span style="background-color:yellow" > Onaylayan <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alanına girmelidir.<br>
 	<b>Adım 5: </b>Onaylayan (doktor veya cerrah) şifresini <nobr>"<span style="background-color:yellow" > Şifre: <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alanına girmelidir.<br>
 	<b>Adım 6: </b>İstem listesini göndermek için  <input type="button" value="Bu istem listesini <?php if($x2=="pharma") print "eczaneye"; else print "tıbbi ambara"; ?> gönder."> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 İstem listesini göndermeyi iptal etmeye karar verir iseniz, istem listesine geri gitmek için  "<span style="background-color:yellow" > Geri ve listeyi düzenle </span>" bağlantısını tıklayınız.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Şimdi istem vermeyi sonlandırmak istiyorum. Ne yapmalıyım?</b>
</font>
<ul>     
 	<b>Adım 1: </b> <?php if($x2=="pharma") print "Eczane"; else print "Tıbbi ambar"; ?> alt menüsüne geri gitmek için  "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> İstem son </span>" bağlantısını tıklayınız.<br>
</ul>	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir istem listesi oluşturmak istiyorum. Ne yapmalıyım?</b>
</font>
<ul>     
 	<b>Adım 1: </b>Boş bir istem sepeti oluşturmak için  "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> Yeni bir istem listesi başlat </span>"  bağlantısını tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 İstem sepeti veya katalog listesi hakkında pencere içerisindeki  <img <?php echo createComIcon('../','frage.gif','0') ?>> düğmesini tıklayarak ayrıntılı bilgi alabilirsiniz.
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php endif;?>


<?php if($src=="head") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<?php if($x2=="pharma") print "Farmasötik ürünler"; 
						else print "Tıbbi ambardan ürünler"; ?> nasıl istem yapılır?
</b>
</font>
<ul>       	

 	<b>Adım 1: </b>Önce istem listesi oluşturunuz. Sağ çerçevede bölüm, servis veya ameliyathaneniz için istem kataloğunu göreceksiniz. <p>
 	<b>Adım 2: </b>Gereksiniminiz olan malzeme katalog listesinde ise, sol çerçevedeki sepete (istem listesine) malzemeden <b>bir adet</b> koymak için  <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> düğmesine tıklayınız.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
İstem sepetine bir malzemeden birden fazla sayıda koymak istiyorum. Nasıl yapılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Seçmek için ilgili malzemenin <input type="checkbox" name="a" value="a" checked> seçim düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Malzemenin ilgili  " Pcs. <input type="text" name="d" size=2 maxlength=2> " alanına parça sayısını giriniz.<br>
 	<b>Adım 3: </b>Malzemeyi sepete (istem listesine) koymak için <input type="button" value="Sepete koy"> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 Pencere içerisinde <img <?php echo createComIcon('../','frage.gif','0') ?>> düğmesini tıklayarak istem sepeti veya katalog listesi hakkında ayrıntılı bilgi edinebilirsiniz.
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php endif;?>

<?php if($src=="catalog") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir malzeme sepete (istem listesine) nasıl konur?
</b>
</font>
<ul>       	
 	<b>Adım 1: </b>İhtiyacınız olan malzeme katalog listesinde ise malzemeden <b>bir kalem</b> sol çerçevedeki istem listesine (sepet) koymak için  <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> düğmesine tıklayınız.<p>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
İstem sepetine bir üründen birden fazla sayıda koymak istiyorum. Nasıl yapılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Seçmek için malzemeye karşılık gelen <input type="checkbox" name="a" value="a" checked> seçme düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Parça sayısını  malzemenin ilgili " parça <input type="text" name="d" size=2 maxlength=2> " alanına giriniz.<br>
 	<b>Adım 3: </b>Malzemeyi sepete (istem listesine) koymak için  <input type="button" value="Sepete koy"> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Gereksindiğim malzeme katalog listesinde yok. Ne yapmalıyım?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Malzemeyi bulmalısınız. Malzemenin marka, veya jenerik isim, veya sipariş numarası bilgisinin ya tamamını veya birkaç harfini  
				<nobr><span style="background-color:yellow" >" Aranacak anahtar sözcük: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alanına giriniz.<br>
 	<b>Adım 2: </b>Malzemeyi bulmak için  <input type="button" value="Malzemeyi bul"> düğmesini tıklayınız.<br>
 	<b>Adım 3: </b>Arama malzemeyi bulur ise veya arama anahtar sözcüğüne yakın bir ürün bulunur ise bir liste görüntülenir.<br>
 	<b>Adım 4: </b>Eğer malzemeden bir parça istem sepetine koymak ister iseniz  <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> düğmesine tıklayınız. Malzeme sepete konur ve aynı zamanda katalog listesine eklenir.<br>
 	<b>Adım 5: </b>Malzemeyi sadece katalog listesine eklemek ister iseniz, <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Malzeme hakkında daha fazla bilgi görmek istiyorum. Ne yapmalıyım?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Ya  <img <?php echo createComIcon('../','info3.gif','0') ?>> düğmesini veya malzemenin ismini tıklayınız.<br>
 	<b>Adım 2: </b>Malzeme hakkındaki tüm bilgileri gösteren bir pencere açılır.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir malzeme katalog listesinden nasıl silinir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Malzemenin <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> düğmesine tıklayınız.<br>
</ul>

<?php endif;?>

<?php if($src=="orderlist") : ?>
	<?php if($x1=="0") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 Halen sepet boş.<p>
 Bir istem listesi oluşturmak için, gereksiniminiz olan malzemeyi sağ çerçevedeki katalog listesinden seçip sepete koyunuz.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Malzeme sepete (istem listesine) nasıl konulur?
</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Gereksiniminiz olan malzeme katalog listesinde ise, malzemeden <b>bir adet</b> istem listesine (sepete) koymak için  <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> düğmesini tıklayınız.<br> İstem listesi otomatik olarak soldaki sepet çerçevesinde görüntülenir.<p>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 Katalog listesinden sepete malzemelerin aranması, seçilmesi ve konulması konusunda ayrıntılı bilgi için sağdaki istem katalog çerçevesi içerisindeki  <img <?php echo createComIcon('../','frage.gif','0') ?>> düğmesini tıklayınız.<p>
</ul>

	<?php else : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
İstem sepetindeki parça sayısını değiştirebilir miyim?
</b>
</font>
<ul>       	
 	<b>Evet.</b> İstem listesini sonlandırmadan önce parça sayısı girdisini değiştirmeniz yeterli.
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Malzeme konusunda daha fazla bilgi görmek istiyorum. Ne yapmalıyım?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Malzemenin <img <?php echo createComIcon('../','info3.gif','0') ?>> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Ürün hakkındaki tüm bilgileri gösteren bir pencere açılır.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir malzeme sepetten nasıl çıkarılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Malzemenin  <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Gereksindiğim tüm malzemeler şimdi sepette. Sonra ne yapmalıyım?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>İstem listesini eczaneye gönderebilirsiniz. <br>İşlemi başlatmak için  <input type="button" value="İstem listesini sonlandır"> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>İstem listesi tekrar görüntülenir. İsminizi <nobr>"<span style="background-color:yellow" > Oluşturan <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alanına yazınız.<br>
 	<b>Adım 3: </b>İstemin öncelik durumunu  "<span style="background-color:yellow" > Normal<input type="radio" name="x" value="s" checked> Acil<input type="radio" name="x" > </span>" arasından seçiniz. Uygun seçim kutusunu işaretleyiniz.<br>
 	<b>Adım 4: </b>Onaylayan (doktor veya cerrah) ismini <nobr>"<span style="background-color:yellow" > Onaylayan <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alanına girmelidir.<br>
 	<b>Adım 5: </b>Onaylayan (doktor veya cerrah) şifresini <nobr>"<span style="background-color:yellow" > Şifre: <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alanına girmelidir.<br>
 	<b>Adım 6: </b>İstem listesini göndermek için  <input type="button" value="Bu istem listesini eczaneye gönder"> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 İstem listesini göndermeyi iptal etmeye karar verir iseniz, "<span style="background-color:yellow" > Geri git ve listeyi düzenle </span>" bağlantısını tıklayınız.
</ul>
	<?php endif;?>

<?php endif;?>


<?php if($src=="final") : ?>
	<?php if($x1=="1") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
İstemi sonlandırmak istiyorum. Ne yapmalıyım?</b>
</font>
<ul>     
 	<b>Adım 1: </b>Eczane alt menüsüne geri dönmek için  "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> İstem sonu </span>" bağlantısını tıklayınız.<br>
</ul>	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir istem listesi oluşturmak istiyorum. Ne yapmalıyım?</b>
</font>
<ul>     
 	<b>Adım 1: </b>Boş bir istem sepeti oluşturmak için "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> Yeni bir istem listesi başlat </span>" bağlantısını tıklayınız.<br>
</ul>		<?php else : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Sonlandırılmış istem listesi nasıl gönderilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>İsminizi <nobr>"<span style="background-color:yellow" > Oluşturan <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alanına yazınız.<br>
 	<b>Adım 2: </b>İstemin öncelik durumunu  "<span style="background-color:yellow" > Normal<input type="radio" name="x" value="s" checked> Acil<input type="radio" name="x" > </span>" arasından seçiniz. Uygun seçim kutusunu işaretleyiniz.<br>
 	<b>Adım 3: </b>Onaylayan (doktor veya cerrah) ismini <nobr>"<span style="background-color:yellow" > Onaylayan <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alanına girmelidir.<br>
 	<b>Adım 4: </b>Onaylayan (doktor veya cerrah) şifresini <nobr>"<span style="background-color:yellow" > Şifre: <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alanına girmelidir.<br>
 	<b>Adım 5: </b>İstem listesini göndermek için  <input type="button" value="Bu istem listesini eczaneye gönder"> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 İstem listesini göndermeyi iptal etmeye karar verir iseniz, "<span style="background-color:yellow" > Geri git ve listeyi düzenle </span>" bağlantısını tıklayınız.
</ul>
	<?php endif;?>

<?php endif;?>
<!-- ++++++++++++++++++++++++++++++++++ archive ++++++++Çeviren Op. Dr. Bülent Potur ++++++++++++++ -->
<?php if($src=="arch") : ?>


<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Arşivdeki istem listelerini görmek istiyorum.</b></font>
<ul>  	<b>Adım 1: </b> Bölüm adı, kısaltması, istem tarihi, öncelik ("acil") bilgilerinin tamamını vaya ilk birkaç harfini 
				<nobr><span style="background-color:yellow" >" Aranacak anahtar sözcük: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alanına giriniz.<br>
 	<b>Adım 2: </b>Arama kategorilerine göre izleyen kutuları seçiniz veya seçimden çıkarınız:
<ul> 	
  	<input type="checkbox" name="d" checked> Tarih<br>
	<input type="checkbox" name="d" checked> Bölüm<br>
  	<input type="checkbox" name="d" checked> Öncelik<br>
	Ön seçimli olarak kutuların üçü de seçilir ve arama her üç kategoride yapılır. Bir kategoriyi dışarıda tutmak ister iseniz kutusuna tıklayıp seçimden çıkarınız.
</ul> 	
<b>Adım 3: </b>Malzemeyi bulmak için <input type="button" value="Ara"> düğmesini tıklayınız.<br>
 	<b>Adım 4: </b>Arama aranan anahtar sözcüğe yaklaşık bir sonuç bulur ise bir liste görüntülenir. .<br>
 	<b>Adım 5: </b>İstemin liste düğmesini tıklayınız <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>>. İstemin ayrıntıları görüntülenir<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Birkaç istem listelendi. Belirli bir istem nasıl görülür?</b></font>
<ul>  	
 	<b>Adım 1: </b>İstemin düğmesini tıklayınız <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>>. İstemin ayrıntıları görüntülenir<br>
</ul>

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 Aramayı sonlandırıp kapatmaya karar verir iseniz, <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>


	<?php endif;?>
	
<?php if($src=="archshow") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
İstem listesindeki bir malzeme hakkında daha fazla bilgi görmek istiyorum. Ne yapmalıyım?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Malzemenin <img <?php echo createComIcon('../','info3.gif','0') ?>> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Ürün hakkındaki tüm bilgileri gösteren bir pencere açılır.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Tekrar arşivdeki istemlerin listesini görmek istiyorum. Ne yapmalıyım?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> <img <?php echo createLDImgSrc('../','back2.gif','0') ?>> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Arşivdeki istem listesinde yeni bir arama yapmak istiyorum. Ne yapmalıyım?</b></font>
<ul>  	<b>Adım 1: </b> Bölüm adı, kısaltması, istem tarihi, öncelik ("acil") bilgilerinin tamamını vaya ilk birkaç harfini 
				<nobr><span style="background-color:yellow" >" Aranacak anahtar sözcük: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alanına giriniz.<br>
 	<b>Adım 2: </b>Arama kategorilerine göre izleyen kutuları seçiniz veya seçimden çıkarınız:
<ul> 	
  	<input type="checkbox" name="d" checked> Tarih<br>
	<input type="checkbox" name="d" checked> Bölüm<br>
  	<input type="checkbox" name="d" checked> Öncelik<br>
	Ön seçimli olarak kutuların üçü de seçilir ve arama her üç kategoride yapılır. Bir kategoriyi dışarıda tutmak ister iseniz kutusuna tıklayıp seçimden çıkarınız.
</ul> 	
<b>Adım 3: </b>Malzemeyi bulmak için <input type="button" value="Ara"> düğmesini tıklayınız.<br>
 	<b>Adım 4: </b>Arama aranan anahtar sözcüğe yaklaşık bir sonuç bulur ise bir liste görüntülenir.<br>
</ul>
	<?php endif;?>	
	

<?php if($src=="db") : ?>
	<?php if($x1=="") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bilgi bankasına bir ürün nasıl girilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Önce ürün hakkında bulunan tüm bilgileri ilgili giriş alanlarına giriniz.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ürünün bir resmini seçmek istiyorum. Nasıl yapılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>"<span style="background-color:yellow" > Resim dosyası </span>" alanındaki <input type="button" value="Araştır..."> düğmesini tıklayınız. <br>
 	<b>Adım 2: </b>Bir doaya seçmek için küçük bir pencere açılır. İstediğiniz resim dosyasını seçiniz ve "Tamam" ı tıklayınız.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bulunan tüm ürün bilgisini girmeyi bitirdim. Nasıl kayıt edilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> <input type="button" value="Kaydet"> düğmesini tıklayınıız.<br>
</ul>
	<?php endif;?>	
	<?php if($x1=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir ürün bilgi bankasına nasıl girilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b><input type="button" value="Yeni ürün"> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Giriş formu görüntülenir.<br>
 	<b>Adım 3: </b>Yeni ürünüb bilgilerini giriniz.<br>
 	<b>Adım 4: </b>Bilgiyi kayıt etmek için  <input type="button" value="Kaydet"> düğmesini tıklayınız.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Görüntülenen ürünün bilgisini düzenlemek istiyorum. Nasıl yapılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> <input type="button" value="Güncelle veya düzenle"> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Ürün bilgisi düzenleme formuna otomatik olarak girilir.<br>
 	<b>Adım 3: </b>Bilgiyi düzenleyiniz.<br>
 	<b>Adım 4: </b>Yeni bilgiyi kayıt etmek için  <input type="button" value="Kaydet"> düğmesini tıklayınız.<br>
</ul>
	
	<?php endif;?>	
<?php endif;?>	
</form>

