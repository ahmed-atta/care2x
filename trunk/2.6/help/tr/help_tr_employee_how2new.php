<font face="Verdana, Arial" size=3 color="#0000cc"><b>Personnel y�netimi</b></font><p>
<?php 
if(!$src&&!$x1){
?>
<font size=2 face="verdana,arial" >
<b>Bir ki�i nas�l i�e al�n�r</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<b>Ad�m 1</b>

<ul> 
<font color=#ff0000>Ki�inin temel bilgilerinin �nceden bulunup bulunmad���n� kontrol ediniz</font>.<p>
		 Bir hastan�n ad, soyad gibi bilgilerinden ya tamam�n� ya da birka� harfini veya TC kimlik numaras�n� giriniz.
		<p>�rnek 1: "21000012" veya "12" giriniz.
		<br>�rnek 2:  "Potur" veya "pot" giriniz.
		<br>�rnek 3: "B�lent" veya "B�l" giriniz.
		
</ul>

<b>Ad�m 2</b>
<ul> Aramaya ba�lamak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> d��mesini t�klay�n�z. 
</ul>

<b>Ad�m 3</b>
<ul> Arama sonunda hi� kimse bulunamaz ise, �nce ki�i kayd�n� girmek gerekir.  <img <?php echo createLDImgSrc('../','register_gray.gif','0') ?>>  d��mesine t�klay�n�z ve ki�i kayd� i�in gereken y�nergeleri izleyiniz.
</ul>
<b>Ad�m 4</b>
<ul> E�er ara�t�rma bir sonu� bulur ise yan�ndaki <img <?php echo createLDImgSrc('../','ok_small.gif','0') ?>> d��mesini t�klayarak listeden do�ru ki�iyi se�iniz.
</ul>
<b>Ad�m 5</b>
<ul> ��e alma formu g�r�nt�lenince, i� ile ilgili t�m bilgileri giriniz.<p>
		<img <?php echo createComIcon('../','warn.gif','0') ?>> Uyar�: E�er bir ki�i halen �al��makta ise, onun bilgileri g�r�nt�lenecektir .
</ul>
<b>Ad�m 6</b>
<ul> 
	 Sicil bilgisini kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<p>
	
</ul>


<b>Uyar�</b>

<ul> E�er bir bilgi eksik ise, bilgiler tekrar g�r�nt�lenir ve k�rm�z� ile i�aretli alan(lar) daki bilgileri girmeniz istenir. Daha sonra tam bilgiyi kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<p>
</ul>

<b>Uyar�</b>
<ul> E�er kayd� iptal etmeye karar verirseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
		
</ul>
</form>
<?php
}else{
?>

<font size=2 face="verdana,arial" >
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<?php
	if($src){
?>
<font color="#990000"><b>�al��an sicil bilgisi nas�l g�ncellenir?</b></font>
<ul> 
	<b>Ad�m 1:</b> Uygun alanlara yeni bilgileri giriniz.<p>
	<b>Ad�m 2:</b> G�ncellenmi� sicil bilgisini kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<p>
	<img <?php echo createComIcon('../','warn.gif','0') ?>> Uyar�: G�ncellemeyi iptal etmeye karar verirseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php
	}else{
?>
<font color="#990000"><b>Ki�i nas�l i�e al�n�r?</b></font>
<ul> 
	<b>Ad�m 1:</b> Uygun alanlara sicil bilgisini giriniz.<p>
	<b>Ad�m 2:</b> Sicil bilgisini kaydetmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<p>
	<img <?php echo createComIcon('../','warn.gif','0') ?>> Uyar�: �ptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php
	}
}
?>
