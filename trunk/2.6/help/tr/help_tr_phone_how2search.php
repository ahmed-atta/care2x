<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Nas�l 
<?php
switch($x1)
{
 	case "search": print 'bir telefon numaras�n� aran�r?'; break;
	case "dir": print 't�m telefon rehberi a��l�r?';break;
	case "newphone": print 'yeni telefon bilgisi girilir?';break;
 }
 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if($x1=="search") { ?>
	<?php if($src=="newphone") { ?>
	<b>Ad�m 1</b>
	<ul> <img <?php echo createLDImgSrc('../','such-gray.gif','0') ?>> d��mesini t�klay�n�z.
	</ul>
	<?php } ?>
<b>Ad�m <?php if($src=="newphone") print "2"; else print "1"; ?></b>

<ul>  "<span style="background-color:yellow" >Aranacak anahtar s�zc��� giriniz.</span>" alan�na ad, soyad, servis, oda numaras�, veya b�l�m kodu gibi bir bilgiyi ya tam veya birka� harfini giriniz.
		<br>�rnek 1: "Nisaiye 3" veya "nis" veya  "Ni" giriniz.
		<br>�rnek 2:  "Ar�kan" veya "ar�" giriniz.
		<br>�rnek 3:  "R�kneddin" veya "r�k" giriniz.
		<br>�rnek 4:  "op11" veya "OP11" veya "op" giriniz.
		
</ul>
<b>Ad�m <?php if($src=="newphone") print "3"; else print "2"; ?></b>
<ul> Aramay� ba�latmak i�in <input type="button" value="ARA"> d��mesini t�klay�n�z.<p>
</ul>
<b>Ad�m <?php if($src=="newphone") print "4"; else print "3"; ?></b>
<ul> E�er arama sonu� bulur ise bir liste g�r�n�r.<p>
</ul>
<?php } ?>

<?php if($x1=="dir") { ?>
<b>Ad�m 1</b>
<ul> <img <?php echo createLDImgSrc('../','phonedir-gray.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php 
} 

 if($x1=="newphone") { 
	 if($src=="search") { 
?>
<b>Ad�m 1</b>
<ul> <img <?php echo createLDImgSrc('../','newdata-gray.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<b>Ad�m 2</b>
<ul> E�er �nceden giri� yapt� iseniz ve bu i�leve eri�im hakk�n�z var ise, ana �er�evede yeni telefon bilgisi giri� formu g�r�nt�lenir.<br>
		Giri� yapmad� iseniz, kullan�c� ad� ve �ifrenizi girmeniz istenir. <p>
	<?php } ?>
		Kullan�c� ad� ve �ifrenizi girip  <img <?php echo createLDImgSrc('../','continue.gif','0') ?>> d��mesini t�klay�n�z.<p>
		
</ul>
<?php } ?>

<b>Uyar�</b>
<ul> �ptal etmeye karar verir iseniz 
<?php
switch($x1)
{
 	case "search": print ' <img '.createLDImgSrc('../','cancel.gif','0').'> d��mesini t�klay�n�z.'; break;
	case "dir": print '  <input type="button" value="�ptal"> d��mesini t�klay�n�z.';break;
	case "newphone": print '  <img '.createLDImgSrc('../','cancel.gif','0').'> d��mesini t�klay�n�z.';break;
 }
 ?>
</ul>

</form>