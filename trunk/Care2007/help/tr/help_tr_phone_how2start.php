<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Nasıl 
<?php
switch($x1)
{
 	case "search": print 'bir telefon numarası aranır?'; break;
	case "dir": print 'tüm telefon rehberi açılır?';break;
	case "newphone": print 'yeni telefon bilgisi girilir?';break;
 }
 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if($x1=="search") { ?>
	<?php if($src=="newphone") { ?>
	<b>Adım 1</b>
	<ul> <img <?php echo createLDImgSrc('../','such-gray.gif','0') ?>> düğmesini tıklayınız.
	</ul>
	<?php } ?>
<b>Adım <?php if($src=="newphone") print "2"; else print "1"; ?></b>

<ul>  "<span style="background-color:yellow" >Aranacak anahtar sözcüğü giriniz.</span>" alanına ad, soyad, servis, oda numarası, veya bölüm kodu gibi bir bilgiyi ya tam veya birkaç harfini giriniz.
		<br>Örnek 1: "Nisaiye 3" veya "nis" veya  "Ni" giriniz.
		<br>Örnek 2:  "Arıkan" veya "arı" giriniz.
		<br>Örnek 3:  "Rükneddin" veya "rük" giriniz.
		<br>Örnek 4:  "op11" veya "OP11" veya "op" giriniz.
		
</ul>
<b>Adım <?php if($src=="newphone") print "3"; else print "2"; ?></b>
<ul> Aramayı başlatmak için <input type="button" value="ARA"> düğmesini tıklayınız.<p>
</ul>
<b>Adım <?php if($src=="newphone") print "4"; else print "3"; ?></b>
<ul> Eğer arama sonuç bulur ise bir liste görünür.<p>
</ul>
<?php } ?>

<?php if($x1=="dir") { ?>
<b>Adım 1</b>
<ul> <img <?php echo createLDImgSrc('../','phonedir-gray.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php 
} 

 if($x1=="newphone") { 
	 if($src=="search") { 
?>
<b>Adım 1</b>
<ul> <img <?php echo createLDImgSrc('../','newdata-gray.gif','0') ?>> düğmesini tıklayınız.
</ul>
<b>Adım 2</b>
<ul> Eğer önceden giriş yaptı iseniz ve bu işleve erişim hakkınız var ise, ana çerçevede yeni telefon bilgisi giriş formu görüntülenir.<br>
		Giriş yapmadı iseniz, kullanıcı adı ve şifrenizi girmeniz istenir. <p>
	<?php } ?>
		Kullanıcı adı ve şifrenizi girip  <img <?php echo createLDImgSrc('../','continue.gif','0') ?>> düğmesini tıklayınız.<p>
		
</ul>
<?php } ?>

<b>Uyarı</b>
<ul> İptal etmeye karar verir iseniz 
<?php
switch($x1)
{
 	case "search": print ' <img '.createLDImgSrc('../','cancel.gif','0').'> düğmesini tıklayınız.'; break;
	case "dir": print '  <input type="button" value="İptal"> düğmesini tıklayınız.';break;
	case "newphone": print '  <img '.createLDImgSrc('../','cancel.gif','0').'> düğmesini tıklayınız.';break;
 }
 ?>
</ul>

</form>