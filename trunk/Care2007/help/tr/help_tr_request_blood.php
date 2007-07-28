<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Kan ürünleri istemi</b></font>
<p>
<font size=2 face="verdana,arial" >

<?php
if(!$src){
?>
<a name="sday"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Hasta etiketi eklenmemiş. Ne yapmalıyım?</b></font>
<ul> 
	<b>Adım 1: </b>Hastanın ad soyad veya protokol numarası bilgisinin tamamını ya da bir kaç harfini  giriniz.
		<p>Örnek 1: "21000012" veya "12" giriniz.
		<br>Örnek 2: "Potur" veya "pot" giriniz.
		<br>Örnek 3: "Bülent" veya "Bül" giriniz.<p>
	<b>Adım 2: </b>  Aramaya başlamak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> simgesini tıklayınız. <p>
	<b>Adım 3: </b> Arama bir sonuç bulur ise listeden doğru kişiyi
	 <img <?php echo createLDImgSrc('../','ok_small.gif','0') ?>> düğmesini tıklayarak seçiniz.
</ul>
<?php
}else{
?>

<a name="stime"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
İstem formuna ne doldurmalı?</b></font>
<ul> 
	<b>Doldurulması zorunlu alanlar:</b> 
<ul> 
	<li>Kan grubu
	<li>Rh faktörü
	<li>Kell
	<li>İstenen ürünün ünite sayısı
	<li>Transfüzyon tarihi
	<li>İstem tarihi
	<li>İstemden sorumlu doktorun adı.
</ul>
</ul>

<a name="send"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Bazı değerler henüz yok. Bunlar olmadan da istemi yine de gönderebilir miyim?</b></font>
<ul> 
	<b>Uyarı: </b>Değerleri henüz bulunmayan aşağıdaki alanlara suru işareti "?" girebilirsiniz:
<ul> 
	<li>Kan grubu
	<li>Rh faktörü
	<li>Kell 
</ul>
</ul>

<a name="send"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Tetkik istemi nasıl gönderilir?</b></font>
<ul> 
	<b>Adım: </b> <img <?php echo createLDImgSrc('../','abschic.gif','0') ?>> düğmesini tıklayınız.
</ul>

<?php
}
?>
