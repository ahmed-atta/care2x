<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Bir hastan�n t�bbi belgeleri nas�l haz�rlan�r</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="?") : ?>
<b>Ad�m 1</b>

<ul> Hastan�n temel bilgilerini bulunuz.<br>
		"�u hastan�n belgelerini haz�rla:" alan�na a�a��daki bilgilerden her hangi birini giriniz:<br>
		<Ul type="disc">
			<li>protokol numaras� veya<br>
			<li>hastan�n soyad� veya<br>
			<li>hastan�n ad� <br>
		<font size=1 color="#000099" face="verdana,arial">
		<b>�pucu:</b> E�er sisteminizde barkod okuyucu var ise, odaklamak i�in "�u hastan�n belgelerini haz�rla" alan�n� t�klat�p hastan�n kart�ndaki barkodu taray�c� ile okutup 3. Ad�ma ge�iniz.
		</font>
		</ul>
		
</ul>
<b>Ad�m 2</b>

<ul> Aramay� ba�latmak i�in <input type="button" value="Ara"> d��mesini t�klay�n�z.
		
</ul>
<b>Ad�m 2 ye bir ba�ka se�enek</b>
<ul> �unlardan herhangibirini yapabilirsiniz:<br>
		<Ul type="disc">		
		<li>"Soyad�:" alan�na hastan�n soyad�n� giriniz <br>
		<li>Veya "Ad�:" alan�na hastan�n ad�n� giriniz <br>
		</ul>
		 sonra klavyede "enter" tu�una bas�n�z.
		
</ul>
<b>Ad�m 3</b>
<ul> Arama sonucu bir tek sonu� bulunur ise hastan�n temel bilgileri ile yeni bir form g�r�nt�lenir.
		E�er birka� sonu� bulunur ise, bir liste g�r�nt�lenir.
<?php endif ?>

<?php if(($src=="?")||($x1>1)) : ?>

 <br>Listedeki bir hastan�n belgesini olu�turmak i�in ya ilgili  <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> d��mesini, veya soyad, veya ad, veya protokol numaras�, veya kabul tarihini t�klay�n�z.
</ul>
<?php endif ?>

<?php if($src=="?") : ?>
<b>Ad�m 4</b>
<?php endif ?>

<?php if(($src!="?")&&($x1==1)) : ?>
<b>Ad�m 1</b>
<?php endif ?>
<?php if(($x1=="1")||($src=="?")) : ?>
<ul> Hastan�n bilgileri ile yeni bir form g�r�nt�lendi�inde �unlar� yapabilirsiniz: 
		<Ul type="disc">		
    	<li>sigorta �irketi veya sosyal g�venlik durumu hakk�ndaki bilgileri "Ek bilgiler:" alan�na girebilirsiniz;<br>
		<li>E�er hastaya zorunlu olan dan��manl�k hizmeti verildi ise "T�bbi dan��manl�k" d��melerinden  "<span style="background-color:yellow" ><input type="radio" name="n" value="a">Evet</span>" i t�klay�n�z;<br>
		<li>E�er hastaya zorunlu dan��manl�k hizmeti verilmedi ise "T�bbi dan��manl�k" d��melerinden  "<span style="background-color:yellow" ><input type="radio" name="n" value="a">Hay�r</span>" � t�klay�n�z;<br>
		<li>tan� raporunu "Tan�:" alan�na yaz�n�z;<br>
		<li>sa�alt�m raporunu "Tedavi:" alan�na yaz�n�z,<br>
		<li>gerekir ise, "Belgenin yaz�ld��� tarih:" alan�n� d�zenleyiniz;<br>
		<li>gerekir ise, "Belgeyi yazan:" alan�n� d�zenleyiniz;<br>
		<li>gerekir ise, "Anahtar say�:" alan�n� d�zenleyiniz;<br>
		</ul>
</ul>
<b>Uyar�</b>
<ul> Girdiklerinizi silmek ister iseniz <input type="button" value="Yeni ba�tan"> d��mesini t�klay�n�z.
</ul>

<b>Ad�m <?php if($src!="?") print "2"; else print "5"; ?></b>
<ul> Belgeyi kaydetmek i�in <input type="button" value="Kaydet"> d��mesini t�klay�n�z.
</ul>
<?php endif ?>
<b>Uyar�</b>
<ul> Belgeyi iptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
		
</ul>


</form>
