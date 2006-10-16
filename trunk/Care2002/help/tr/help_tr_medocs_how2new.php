<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Bir hastanın tıbbi belgeleri nasıl hazırlanır</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="?") : ?>
<b>Adım 1</b>

<ul> Hastanın temel bilgilerini bulunuz.<br>
		"Şu hastanın belgelerini hazırla:" alanına aşağıdaki bilgilerden her hangi birini giriniz:<br>
		<Ul type="disc">
			<li>protokol numarası veya<br>
			<li>hastanın soyadı veya<br>
			<li>hastanın adı <br>
		<font size=1 color="#000099" face="verdana,arial">
		<b>İpucu:</b> Eğer sisteminizde barkod okuyucu var ise, odaklamak için "Şu hastanın belgelerini hazırla" alanını tıklatıp hastanın kartındaki barkodu tarayıcı ile okutup 3. Adıma geçiniz.
		</font>
		</ul>
		
</ul>
<b>Adım 2</b>

<ul> Aramayı başlatmak için <input type="button" value="Ara"> düğmesini tıklayınız.
		
</ul>
<b>Adım 2 ye bir başka seçenek</b>
<ul> Şunlardan herhangibirini yapabilirsiniz:<br>
		<Ul type="disc">		
		<li>"Soyadı:" alanına hastanın soyadını giriniz <br>
		<li>Veya "Adı:" alanına hastanın adını giriniz <br>
		</ul>
		 sonra klavyede "enter" tuşuna basınız.
		
</ul>
<b>Adım 3</b>
<ul> Arama sonucu bir tek sonuç bulunur ise hastanın temel bilgileri ile yeni bir form görüntülenir.
		Eğer birkaç sonuç bulunur ise, bir liste görüntülenir.
<?php endif ?>

<?php if(($src=="?")||($x1>1)) : ?>

 <br>Listedeki bir hastanın belgesini oluşturmak için ya ilgili  <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> düğmesini, veya soyad, veya ad, veya protokol numarası, veya kabul tarihini tıklayınız.
</ul>
<?php endif ?>

<?php if($src=="?") : ?>
<b>Adım 4</b>
<?php endif ?>

<?php if(($src!="?")&&($x1==1)) : ?>
<b>Adım 1</b>
<?php endif ?>
<?php if(($x1=="1")||($src=="?")) : ?>
<ul> Hastanın bilgileri ile yeni bir form görüntülendiğinde şunları yapabilirsiniz: 
		<Ul type="disc">		
    	<li>sigorta şirketi veya sosyal güvenlik durumu hakkındaki bilgileri "Ek bilgiler:" alanına girebilirsiniz;<br>
		<li>Eğer hastaya zorunlu olan danışmanlık hizmeti verildi ise "Tıbbi danışmanlık" düğmelerinden  "<span style="background-color:yellow" ><input type="radio" name="n" value="a">Evet</span>" i tıklayınız;<br>
		<li>Eğer hastaya zorunlu danışmanlık hizmeti verilmedi ise "Tıbbi danışmanlık" düğmelerinden  "<span style="background-color:yellow" ><input type="radio" name="n" value="a">Hayır</span>" ı tıklayınız;<br>
		<li>tanı raporunu "Tanı:" alanına yazınız;<br>
		<li>sağaltım raporunu "Tedavi:" alanına yazınız,<br>
		<li>gerekir ise, "Belgenin yazıldığı tarih:" alanını düzenleyiniz;<br>
		<li>gerekir ise, "Belgeyi yazan:" alanını düzenleyiniz;<br>
		<li>gerekir ise, "Anahtar sayı:" alanını düzenleyiniz;<br>
		</ul>
</ul>
<b>Uyarı</b>
<ul> Girdiklerinizi silmek ister iseniz <input type="button" value="Yeni baştan"> düğmesini tıklayınız.
</ul>

<b>Adım <?php if($src!="?") print "2"; else print "5"; ?></b>
<ul> Belgeyi kaydetmek için <input type="button" value="Kaydet"> düğmesini tıklayınız.
</ul>
<?php endif ?>
<b>Uyarı</b>
<ul> Belgeyi iptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
		
</ul>


</form>
