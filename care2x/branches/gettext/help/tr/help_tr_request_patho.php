<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Patoloji laboratuvar� tetkik istemi</b></font>
<p>
<font size=2 face="verdana,arial" >

<?php
if(!$src){
?>
<a name="sday"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Hastan�n etiketi eklenmemi� ne yapmal�y�m?</b></font>
<ul> 
	<b>Ad�m 1: </b>Hasta bilgisinden �rne�in, ad, soyad, protokol no gibi; ya tam bir bilgi ya da birka� harf giriniz.
		<p>�rnek 1: "21000012" veya "12" giriniz.
		<br>�rnek 2: "G�rcan" veya "g�r" giriniz.
		<br>�rnek 3: "Potur" veya "Pot" giriniz.<p>
	<b>Ad�m 2: </b>Aramaya ba�lamak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> d��mesini t�klay�n�z. <p>
	<b>Ad�m 3: </b> E�er arama bir sonu� bulur ise do�ru ki�iyi <img <?php echo createLDImgSrc('../','ok_small.gif','0') ?>> d��mesine t�klayarak se�iniz.
</ul>
<?php
}else{
?>

<a name="stime"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
�stem formunda neler doldurulmal�?</b></font>
<ul> 
	<b>Doldurulmas� ya da i�aretlenmesi zorunlu alanlar:</b> 
<ul> 
	<li>Materyelin tipi
	<li>Materyelin betimlenmesi
	<li>Ameliyat tarihi
	<li>�stemden sorumlu doktor veya cerrah
</ul>
</ul>


<a name="send"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
�stem formu nas�l g�nderilir?</b></font>
<ul> 
	<b>Ad�m: </b><img <?php echo createLDImgSrc('../','abschic.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php
}
?>

