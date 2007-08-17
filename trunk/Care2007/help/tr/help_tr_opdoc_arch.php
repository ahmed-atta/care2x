<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Ameliyathane Belgeler - 
<?php
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
	case "select": print "Hastanın belgesi";
	}
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >

<?php if($src=="arch") : ?>
	<?php if(($x1=="dummy")||($x1=="?")||($x1=="")||!$x2) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir tarihte yapılmış ameliyatların tüm belgelerini listelemek istiyorum</b></font>
<ul> <b>Adım 1: </b>Ameliyat tarihini "<span style="background-color:yellow" > Ameliyat tarihi: </span>" alanına giriniz. <br>
		<ul><font size=1 color="#000099">
		<!-- <b>İpucu:</b> Bugünkü tarihin otomatik yazılması için "T" veya "t" giriniz.<br>
		<b>İpucu:</b> Dünkü tarihin otomatik yazılması için "Y" veya "y" giriniz.<br> -->
		</font>
		</ul><b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için  <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklayınız.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir hastanın tüm ameliyathane belgelerini listelemek istiyorum. </b></font>
<ul> <b>Adım 1: </b>İlgili alana anahtar sözcüğü giriniz. Hastanın kişisel bilgisinden tam bir sözcük, cümle veya ilk birkaç harfi olabilir. <br>
		<ul><font size=1 color="#000099" >
		<b>Aşağıdaki alanlar bir anahtar sözcük ile doldurulabilir:</b>
		<br> Hasta numarası.
		<br> Soyad
		<br> Ad
		<br> Doğum tarihi
		</font>
		</ul><b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir cerrahın tüm ameliyathane belgelerini listelemek istiyorum.</b></font>
<ul> <b>Adım 1: </b>Cerrahın ismini "<span style="background-color:yellow" > Cerrah: </span>" alanına giriniz. <br>
		<b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Poliklinik hastalarının tüm ameliyathane belgelerini listelemek istiyorum </b></font>
<ul> <b>Adım 1: </b> "<span style="background-color:yellow" >Poliklinik <input type="radio" name="r" value="1"></span>" seçim kutusunu tıklayınız. <br>
		<b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Yatan hastaların tüm ameliyathane belgelerini listelemek istiyorum </b></font>
<ul> <b>Adım 1: </b> "<span style="background-color:yellow" >Yatan hasta <input type="radio" name="r" value="1"></span>" seçim kutusunu tıklayınız. <br>
		<b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Genel sağlık sigortasına bağlı hastaların tüm ameliyathane belgelerini listelemek istiyorum </b></font>
<ul> <b>Adım 1: </b> "<span style="background-color:yellow" >Genel sağlık sigortası <input type="radio" name="r" value="1"></span>" seçim kutusunu tıklayınız. <br>
		<b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Özel sigortalı hastaların tüm ameliyathane belgelerini görmek istiyorum </b></font>
<ul> <b>Adım 1: </b> "<span style="background-color:yellow" >Özel <input type="radio" name="r" value="1"></span>" seçim kutusunu tıklayınız. <br>
		<b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Ücretli hastaların tüm ameliyathane belgelerini listelemek istiyorum </b></font>
<ul> <b>Adım 1: </b> "<span style="background-color:yellow" >Ücretli<input type="radio" name="r" value="1"></span>" seçim kutusunu tıklayınız. <br>
		<b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklayınız.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir anahtar sözcük ile tüm ameliyathane belgelerini listelemek istiyorum.</b></font>
<ul> <b>Adım 1: </b>Anahtar sözcüğü ilgili alana giriniz. Tam bir sözcük, cümle veya bir sözcüğün ilk bir kaç harfi olabilir. <br>
		<ul><font size=2 color="#000099" >
		<b>Örnek:</b> Tanı ile ilgili anahtar sözcüğü "Tanı" alanına giriniz.<br>
		<b>Örnek:</b> Yeri ile ilgili anahtar sözcüğü  "Yeri" alanına giriniz.<br>
		<b>Örnek:</b> Tedavi ile ilgili anahtar sözcüğü "Tedavi" alanına giriniz.<br>
		<b>Örnek:</b> Özel uyarı ile ilgili anahtar sözcüğü  "Özel uyarı" alanına giriniz.<br>
		</font>
		</ul><b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için  <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklayınız.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir ameliyat sınıfı içeren tüm belgeleri listelemek istiyorum</b></font>
<ul> <b>Adım 1: </b>İlgili alana anahtar sözcüğü giriniz. Tam bir sözcük, cümle, veya bir sözcüğün ilk birkaç harfi olabilir. <br>
		<ul><font size=2 color="#000099" >
		<b>Örnek:</b> Küçük ameliyat için sayıyı  "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> küçük </span>" alanına giriniz.<br>
		<b>Örnek:</b> Orta ameliyat için sayıyı  "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> orta </span>" alanına giriniz.<br>
		<b>Örnek:</b> Büyük ameliyat için sayıyı  "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> büyük </span>" alanına giriniz.<br>
		</font>
		</ul><b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>><b><font color="#990000"> Uyarı:</font></b>
<ul> Birkaç arama koşulunu birleştirebilirsiniz. Örneğin cerrah "Gürlek" tarafından ameliyat edilmiş ve tedavisi "lipo" ile başlayan bir sözcük içeren tüm yatan hastaları listelemek isterseniz:<p>
		<b>Adım 1: </b> "<span style="background-color:yellow" > Cerrah: <input type="text" name="s" size=15 maxlength=4 value="Gürlek"> </span>" alanına "Gürlek" giriniz.<br>
		<b>Adım 2: </b>"<span style="background-color:yellow" > <input type="radio" name="r" value="1" checked>Yatan hasta </span>" seçim kutusunu tıklayınız.<br>
		<b>Adım 3: </b>"<span style="background-color:yellow" > Tedavi: <input type="text" name="s" size=20 maxlength=4 value="lipo"> </span>" alanına "lipo" giriniz. <br>
		<b>Adım 4: </b>Aramayı başlatmak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  düğmesini tıklayınız.<p>

<b>Uyarı</b><br>
Eğer arama bir tek sonuç bulur ise, belgenin tamamı derhal görüntülenir.<br>
		Ancak eğer arama birkaç sonuç bulur ise bir liste görüntülenir.<p>
		Aradığınız hastanın belgesini açmak için, ya ilgili  <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> düğmesini, veya ad, veya soyad, veya tarih veya ameliyat numarasını <nobr>(op nr)</nobr> tıklayınız.
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>
	<?php endif;?>
<?php if(($x1=="search"||$x1='paginate')&&($x2>0)) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arşivdeki belirli bir belge görüntülenmek üzere nasıl seçilir?</b>
</font>
<ul>       	
 	<b>Uyarı: </b> Arşivdeki belgeyi görüntülemek için hastanın adını, veya soyadını, veya ameliyat tarihini, veya ameliyat numarasını tıklayınız.<p> 
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Liste nasıl sıralanır?</b>
</font>
<ul>       	
 	<b>Uyarı: </b> Listenin sıralanmasını istediğiniz sütunun başlığını tıklayınız.<p> 
	Örnek: Listeyi ameliyat tarihine göre sıralamak ister iseniz "Ameliyat tarihi" başlığını tıklayınız.  <br>Tekrar tıkladığınızda sıralama tersine döner:<p>
	<blockquote>
	<img src='../help/tr/img/tr_or_search_sort.png'>
	</blockquote>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arşivde aramaya nasıl devam edilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Arşivde arama alanlarına geri itmek için  <input type="button" value="New archive research"> düğmesini tıklayınız.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>
	<?php endif;?>
<?php if(($x1=="select"||$x1='paginate')&&($x2==1)) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Görüntülenen arşiv belgesi nasıl düzenlenir veya güncellenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Düzenleme moduna geçmek için  <input type="button" value="Bilgiyi güncelle"> düğmesini tıklayınız.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arşivlerde aramaya nasıl devam edilir?</b>
</font>
<ul>       	
 	<b>Yöntem 1: </b>Arşivin arama giriş alanlarına geri gitmek için <input type="button" value="Yeni arşiv araması"> düğmesini tıklayınız.<p> 
 	<b>Veya Yöntem 2: </b>Arşivin giriş alanlarına geri gitmek için <img <?php echo createLDImgSrc('../','arch-blu.gif','0','absmiddle') ?>> düğmesini tıklayınız.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>

<?php endif;?>
<?php endif;?>

</form>

