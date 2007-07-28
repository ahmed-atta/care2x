<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Patoloji laboratuvarı tetkik istemi</b></font>
<p>
<font size=2 face="verdana,arial" >

<?php
if(!$src){
?>
<a name="sday"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Hastanın etiketi eklenmemiş ne yapmalıyım?</b></font>
<ul> 
	<b>Adım 1: </b>Hasta bilgisinden örneğin, ad, soyad, protokol no gibi; ya tam bir bilgi ya da birkaç harf giriniz.
		<p>Örnek 1: "21000012" veya "12" giriniz.
		<br>Örnek 2: "Gürcan" veya "gür" giriniz.
		<br>Örnek 3: "Potur" veya "Pot" giriniz.<p>
	<b>Adım 2: </b>Aramaya başlamak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düğmesini tıklayınız. <p>
	<b>Adım 3: </b> Eğer arama bir sonuç bulur ise doğru kişiyi <img <?php echo createLDImgSrc('../','ok_small.gif','0') ?>> düğmesine tıklayarak seçiniz.
</ul>
<?php
}else{
?>

<a name="stime"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
İstem formunda neler doldurulmalı?</b></font>
<ul> 
	<b>Doldurulması ya da işaretlenmesi zorunlu alanlar:</b> 
<ul> 
	<li>Materyelin tipi
	<li>Materyelin betimlenmesi
	<li>Ameliyat tarihi
	<li>İstemden sorumlu doktor veya cerrah
</ul>
</ul>


<a name="send"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
İstem formu nasıl gönderilir?</b></font>
<ul> 
	<b>Adım: </b><img <?php echo createLDImgSrc('../','abschic.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php
}
?>

