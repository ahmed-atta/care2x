<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Kan �r�nleri istemi</b></font>
<p>
<font size=2 face="verdana,arial" >

<?php
if(!$src){
?>
<a name="sday"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Hasta etiketi eklenmemi�. Ne yapmal�y�m?</b></font>
<ul> 
	<b>Ad�m 1: </b>Hastan�n ad soyad veya protokol numaras� bilgisinin tamam�n� ya da bir ka� harfini  giriniz.
		<p>�rnek 1: "21000012" veya "12" giriniz.
		<br>�rnek 2: "Potur" veya "pot" giriniz.
		<br>�rnek 3: "B�lent" veya "B�l" giriniz.<p>
	<b>Ad�m 2: </b>  Aramaya ba�lamak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> simgesini t�klay�n�z. <p>
	<b>Ad�m 3: </b> Arama bir sonu� bulur ise listeden do�ru ki�iyi
	 <img <?php echo createLDImgSrc('../','ok_small.gif','0') ?>> d��mesini t�klayarak se�iniz.
</ul>
<?php
}else{
?>

<a name="stime"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
�stem formuna ne doldurmal�?</b></font>
<ul> 
	<b>Doldurulmas� zorunlu alanlar:</b> 
<ul> 
	<li>Kan grubu
	<li>Rh fakt�r�
	<li>Kell
	<li>�stenen �r�n�n �nite say�s�
	<li>Transf�zyon tarihi
	<li>�stem tarihi
	<li>�stemden sorumlu doktorun ad�.
</ul>
</ul>

<a name="send"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Baz� de�erler hen�z yok. Bunlar olmadan da istemi yine de g�nderebilir miyim?</b></font>
<ul> 
	<b>Uyar�: </b>De�erleri hen�z bulunmayan a�a��daki alanlara suru i�areti "?" girebilirsiniz:
<ul> 
	<li>Kan grubu
	<li>Rh fakt�r�
	<li>Kell 
</ul>
</ul>

<a name="send"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Tetkik istemi nas�l g�nderilir?</b></font>
<ul> 
	<b>Ad�m: </b> <img <?php echo createLDImgSrc('../','abschic.gif','0') ?>> d��mesini t�klay�n�z.
</ul>

<?php
}
?>
