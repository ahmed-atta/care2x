<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Bir t�bbi belge nas�l aran�r</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if(($src=="?")||($x1=="0")) : ?>
<b>Step 1</b>

<ul> "<span style="background-color:yellow" >T�bbi belgesi aranan ki�i:</span>" alan�na hastan�n protokol numaras�, ad, veya soyad bilgilerini ya tam olarak veya birka� harf ile giriniz.
		<p>�rnek 1: "21000012" veya  "12" giriniz.
		<br>�rnek  2: "Potur" veya "pot" giriniz.
		<br>�rnek 3: enter "G�rcan" veya "G�r" giriniz.
		
</ul>
<b>Ad�m 2</b>
<ul> Aramay� ba�latmak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  d��mesini t�klat�n�z.<p>
</ul>
<b>Ad�m 3</b>
<ul> E�er aramada bir tek sonu� bulunur ise t�bbi belgenin tamam� g�r�n�r.
		Ancak birka� sonu� bulunur ise, bir liste g�r�nt�lenir.<p>
		Arad���n�z hastan�n t�bbi belgesini g�rmek i�in ilgili  <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> d��mesini ya da soyad, belge numaras� veya zaman� t�klay�n�z.
</ul>
<?php endif ?>
<?php if($x1>1) : ?>
		Arad���n�z hastan�n t�bbi belgesini g�rmek i�in ilgili  <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> d��mesini ya da soyad, belge numaras� veya zaman� t�klay�n�z.<p>
<?php endif ?>
<?php if(($src!="?")&&($x1=="1")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belgeyi g�ncellemek istiyorum</b></font>
<ul> G�r�nen belgeyi g�ncellemek ister iseniz, <input type="button" value="Verileri g�ncelle"> d��mesini t�klay�n�z.
</ul>
<?php endif ?>
<b>Uyar�</b>
<ul> E�er aramay� iptal etmek isterseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>


</form>

