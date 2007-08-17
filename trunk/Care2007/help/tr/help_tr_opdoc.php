<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Ameliyathane Belgelendirme - 
<?php
if($src=="create")
{
	switch($x1)
	{
	case "dummy": print "Yeni belge oluştur";
						break;
	case "saveok": print  " - Belge kayıt edildi";
						break;
	case "update": print "Bu belgeyi güncelle";
						break;
	case "search": print "Bir hasta ara";
						break;
	case "paginate": print  "Arama sonuçları listesi";
						break;
	}
}
if($src=="search")
{
	switch($x1)
	{
	case "dummy": print "Bir belge ara";
						break;
	case "": print "Bir belge ara";
						break;
	case "paginate": print  "Arama sonuçları listesi";
						break;
	case "match": print  "Arama sonuçları listesi";
						break;
	case "select": print "Güncel belge";
	}
}
if($src=="arch")
{
	switch($x1)
	{
	case "dummy": print "Arşiv";
						break;
	case "": print "Arşiv";
						break;
	case "?": print "Arşiv";
						break;
	case "search": print  "Arşiv arama sonuçları listesi";
						break;
	case "select": print "Güncel belge";
	}
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php

if($src=="create") { 
	
	if($x1=='search'||$x1=='paginate'){
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Belgesi yazılacak hasta nasıl seçilir?</b>
</font>
<ul>       	
 	<b>Uyarı: </b> Hastanın soyadını veya <img <?php echo createLDImgSrc('../','ok_small.gif','0') ?>> düğmesini tıklayınız.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni hasta araması nasıl başlatılır?</b>
</font>
<ul>       	
 	<b>Uyarı: </b>  <img <?php echo createLDImgSrc('../','document-blue.gif','0') ?>> sekmesini tıklayınız.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bölüm nasıl değiştirilir?</b>
</font>
<ul>       	
 	<b>Uyarı: </b> Sayfanın sol alt kısmındaki "Bölümü değiştir" bağlantısını tıklayınız. <p> 
</ul>
<?php
	}

	 if($x1=="saveok") { 
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Güncel belge nasıl düzenlenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Düzenleme moduna geçmek için  <input type="button" value="Bilgiyi güncelle"> düğmesini tıklayınız.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir belgeye nasıl başlanır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> <input type="button" value="Yeni bir belgeye başla"> düğmesini tıklayınız.<br>
	</ul>
<b>Uyarı</b>
<ul> Kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>

<?php } ?>

<?php if($x1=="update") { ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Açık olan belge nasıl düzenlenir veya güncellenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Düzenleme moduna geçildiği zaman, bilgileri güncelleyebilirsiniz.<br> 
 	<b>Adım 2: </b>Belgeyi kayıt etmek için,  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br> 
	</ul>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hangi bilgilerin girilmesi zorunludur?</b>
</font>
<ul>       	
 	<b>Uyarı: </b>Tüm kırmızı alanlar zorunludur.<br> 
	</ul>
	
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php } ?>
<?php if($x1=="dummy") { ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir belge nasıl oluşturulur?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Önce hastayı bulunuz. Arama giriş alanına hastanın soyad veya adının tamamını veya ilk birkaç harfini giriniz.<br>
 	<b>Adım 2: </b>Hastayı aramaya başlamak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düğmesini tıklayınıız.<p> 
<ul>       	
 	<b>Uyarı: </b>Eğer arama bir tek sonuç bulur ise, hastanın temel bilgileri ilgili alanlara otomatik olarak girilir.<p> 
 	<b>Uyarı: </b>Arama birkaç sonuç bulur ise ,  bir liste görüntülenir. Belge yazmak üzere seçmek için hastanın soyadını tıklayınız.<p> 
	</ul>
 	<b>Adım 3: </b>Hastanın temel bilgileri görüntülendiği zaman, ameliyat ile ilgili ek bilgileri ilgili alanlara girebilirsiniz.<br> 
 	<b>Adım 4: </b>Belgeyi kayıt etmek için, <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br> 
	</ul>
	<?php } ?>
<?php } ?>



<?php if($src=="search") : ?>
	<?php if(($x1=="dummy")||($x1=="")) : ?>


<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Belirli bir hastanın bir belgesi nasıl aranır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> "<span style="background-color:yellow" > Aranacak anahtar sözcük: ad veya soyad <input type="text" name="m" size=20 maxlength=20> </span>" alanına bir hastanın ad veya soyadının tamamını veya baştan birkaç harfini giriniz. <br>
 	<b>Adım 2: </b>Hastanın belgesini aramaya başlamak için  <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düğmesini tıklayınız.<p> 
<ul>       	
<!--  	<b>Uyarı: </b>Arama bir sonuç bulur ise, hastanın belgesi derhal görüntülenir.<p> 
 --> 	<b>Uyarı: </b>Arama birkaç sonuç bulur ise, bir liste görüntülenir. Hastayı belge yazmak üzere seçmek için soyadı, veya ameliyat tarihi, veya ameliyat numarası üzerine tıklayınız.<p> 
	</ul>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>
	<?php endif;?>
<?php if(($x1=="match"||$x1=='paginate')&&($x2>0)) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Görüntülemek üzere belirli bir belge nasıl seçilir?</b>
</font>
<ul>       	
 	<b>Uyarı: </b> Belgesini görüntülemek için hastanın soyadına, veya ameliyat tarihine, veya ameliyat numarasına tıklayınız.<p> 
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Liste nasıl sıralanır?</b>
</font>
<ul>       	
 	<b>Uyarı: </b> Listenin sıralanmasını istediğiniz sütununun başlığına tıklayınız.<p> 
	Örnek: Listeyi ameliyat tarihine göre sıralamak ister iseniz:<p>
	<blockquote>
	<img src='../help/tr/img/tr_or_search_sort.png'>
	</blockquote>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Aramaya nasıl devam edilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> "<span style="background-color:yellow" > Aranan anahtar sözcük: ad veya soyad <input type="text" name="m" size=20 maxlength=20> </span>" alanına hastanın ad veya soyadının ya tamamıını veya ilk birkaç harfini giriniz. <br>
 	<b>Adım 2: </b>Hastanın belgesini aramaya başlamak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düğmesini tıklayınız.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı: </b></font> 
<ul>       	
 Kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>
	<?php endif;?>
<?php if(($x1=="select")&&($x2==1)) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Güncel belge nasıl düzenlenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Düzenleme moduna geçmek için <img <?php echo createLDImgSrc('../','update_data.gif','0') ?>> düğmesini tıklayınız.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Aramaya nasıl devam edilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> "<span style="background-color:yellow" > Aranacak anahtar sözcük: ad veya soyad <input type="text" name="m" size=20 maxlength=20> </span>" alanına hastanın ad veya soyadının ya tamamını ya da baştan birkaç harfini giriniz. <br>
 	<b>Adım 2: </b>Hastanın belgesini aramaya başlamak için  <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düğmesini tıklayınız.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>

<?php endif;?>
<?php endif;?>

<?php if($src=="arch") : ?>
	<?php if(($x1=="dummy")||($x1=="?")||($x1=="")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir tarihte yapılmış ameliyatların tüm belgelerini listelemek istiyorum</b></font>
<ul> <b>Adım 1: </b> "<span style="background-color:yellow" > Ameliyat tarihi: </span>" alanına ameliyatın tarihini giriniz. <br>
		<ul><font size=1 color="#000099">
		<!-- <b>İpucu:</b> Otomatik olarak bugünün tarihini girmek için "T" veya "t" giriniz.<br>
		<b>İpucu:</b> Dünkü tarihi otomatik olarak girmek için "Y" veya "y" giriniz.<br> -->
		</font>
		</ul><b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklayınız.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir hastanın tüm ameliyat belgelerini listelemek istiyorum.</b></font>
<ul> <b>Adım 1: </b>İlgili alana anahtar sözcüğü giriniz. Tam bir sözcük, bir cümle veya bir sözcüğün ilk bir kaç harfi olabilir. <br>
		<ul><font size=1 color="#000099" >
		<b>İzleyen alanlar bir anahtar sözcük ile doldurulabilir:</b>
		<br> Hasta protokol no.
		<br> Soyad
		<br> Ad
		<br> Doğum tarihi
		</font>
		</ul><b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için  <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir cerrahın yaptığı ameliyatların tüm belgelerini listelemek istiyorum.</b></font>
<ul> <b>Adım 1: </b>Cerrahın adını "<span style="background-color:yellow" > Cerrah: </span>" alanına yazınız. <br>
		<b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için  <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Ayaktan gelen hastaların tüm ameliyat belgelerini listelemek istiyorum </b></font>
<ul> <b>Adım 1: </b> "<span style="background-color:yellow" >Ayaktan hasta <input type="radio" name="r" value="1"></span>" seçim kutusunu tıklayınız . <br>
		<b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Yatan hastaların tüm ameliyat belgelerini listelemek istiyorum </b></font>
<ul> <b>Adım 1: </b> "<span style="background-color:yellow" >Yatan hasta <input type="radio" name="r" value="1"></span>" seçim kutusunu tıklayınız . <br>
		<b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Genel sağlık sigortasına tabi hastaların tüm ameliyat belgelerini listelemek istiyorum </b></font>
<ul> <b>Adım 1: </b> "<span style="background-color:yellow" >Sigortalı <input type="radio" name="r" value="1"></span>" seçim kutusunu tıklayınız . <br>
		<b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Özel sigortalı hastaların tüm ameliyat belgelerini listelemek istiyorum </b></font>
<ul> <b>Adım 1: </b> "<span style="background-color:yellow" >Özel <input type="radio" name="r" value="1"></span>" seçim kutusunu tıklayınız . <br>
		<b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Ücretli hastaların tüm ameliyat belgelerini listelemek istiyorum </b></font>
<ul> <b>Adım 1: </b> "<span style="background-color:yellow" >Ücretli <input type="radio" name="r" value="1"></span>" seçim kutusunu tıklayınız . <br>
		<b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir anahtar sözcük ile tüm ameliyat belgelerini listelemek istiyorum </b></font>
<ul> <b>Adım 1: </b>İlgili alana anahtar sözcüğü giriniz. Tam bir sözcük, cümle, veya bir sözcüğün ilk birkaç harfi olabilir. <br>
		<ul><font size=2 color="#000099" >
		<b>Örnek:</b> Tanı anahtar sözcüğünü "Tanı" alanına giriniz.<br>
		<b>Örnek:</b> Yeri anahtar sözcüğünü "Yeri" alanına giriniz.<br>
		<b>Örnek:</b> Tedavi anahtar sözcüğünü "Tedavi" alanına giriniz.<br>
		<b>Örnek:</b> Özel uyarı anahtar sözcüğünü "Özel uyarı" alanına giriniz.<br>
		</font>
		</ul><b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklayınız.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir ameliyat sınıfına göre tüm belgeleri listelemek istiyorum</b></font>
<ul> <b>Adım 1: </b>İlgili alana anahtar sözcüğü giriniz. Tam bir sözcük, cümle veya bir sözcüğün ilk birkaç harfi olabilir. <br>
		<ul><font size=2 color="#000099" >
		<b>Örnek:</b> Küçük ameliyat için numarayı  "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> küçük </span>" alanına giriniz.<br>
		<b>Örnek:</b> Orta ameliyat için numarayı  "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> orta </span>" alanına giriniz.<br>
		<b>Örnek:</b> Büyük ameliyat için numarayı  "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> büyük </span>" alanına giriniz.<br>
		</font>
		</ul><b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>><b><font color="#990000"> Uyarı: </font></b>
<ul> Birkaç arama şartını birleştirebilirsiniz. Örnek: Cerrah "Gürlek" tarafından ameliyat edilmiş ve tedavisinde "lipo" ile başlayan bir sözcük içeren tüm yatan hastaları listelemek ister iseniz:<p>
		<b>Adım 1: </b> "<span style="background-color:yellow" > Cerrah: <input type="text" name="s" size=15 maxlength=4 value="Gürlek"> </span>" alanına "Gürlek" giriniz.<br>
		<b>Adım 2: </b> "<span style="background-color:yellow" > <input type="radio" name="r" value="1" checked>Yatan hasta </span>" seçim kutusunu tıklayınız.<br>
		<b>Adım 3: </b> "<span style="background-color:yellow" > Tedavi: <input type="text" name="s" size=20 maxlength=4 value="lipo"> </span>" alanına "lipo" giriniz. <br>
		<b>Adım 4: </b>Aramayı başlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklayınız.<p>

<b>Uyarı</b><br>
Arama bir tek sonuç bulur ise, tüm belge derhal görüntülenir.<br>
		Ancak arama birkaç sonuç bulur ise, bir liste görüntülenir.<p>
		Aradığınız hastanın belgesini açmak için, ya ilgili <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> düğmesini, veya
		adını, veya soyadını, veya tarihi, veya ameliyat numarasını <nobr>(op nr)</nobr> tıklayınız.
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>
	<?php endif;?>
<?php if(($x1=="search")&&($x2>1)) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arşivdeki belirli bir belge görüntülenmek üzere nasıl seçilir?</b>
</font>
<ul>       	
 	<b>Uyarı: </b> Arşivdeki belgeyi görüntülemek için hastanın soyadı, veya adı, veya ameliyat tarihi, veya ameliyat numarasını tıklayınız.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arşivde aramaya nasıl devam edilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Arşivin arama giriş alanlarına geri gitmek için  <input type="button" value="Yeni arşiv araması"> düğmesini tıklayınız.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>
	<?php endif;?>
<?php if(($x1=="select")&&($x2==1)) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Görüntülenen arşiv belgesi nasıl düzenlenir veya güncellenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Düzenleme moduna geçmek için  <input type="button" value="Veriyi güncelle"> düğmesini tıklayınız.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arşivlerde aramaya nasıl devam edilir?</b>
</font>
<ul>       	
 	<b>Yöntem 1: </b>Arşivin arama giriş alanlarına geri gitmek için <input type="button" value="Yeni arşiv araması"> düğmesini tıklayınız.<p> 
 	<b>Yöntem 2: </b>Arşivin arama giriş alanlarına geri gitmek için <img <?php echo createLDImgSrc('../','arch-blu.gif','0','absmiddle') ?>> düğmesini tıklayınız.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>

<?php endif;?>
<?php endif;?>

</form>

