<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Bakteriyoloji laboratuvar� tetkik istemi</b></font>
<p>
<font size=2 face="verdana,arial" >

<?php
if(!$src){
?>
<a name="sday"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Hastan�n etiketi eklenmemi�. Ne yapmal�y�m?</b></font>
<ul> 
	<b>Ad�m 1: </b>Bir hastan�n ad, soyad, veya protokol numaras� bilgisinin tamam�n� ya da birka� harf giriniz.
		<p>�rnek 1: "21000012" veya "12" giriniz.
		<br>�rnek 2: "Potur" veya "pot" giriniz.
		<br>�rnek 3: "B�lent" veya "B�l" giriniz.<p>
	<b>Ad�m 2: </b>Aramay� ba�latmak i�in<img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> d��mesini t�klay�n�z. <p>
	<b>Ad�m 3: </b> E�er arama bir sonu� bulur ise, listeden do�ru ki�iyi se�mek i�in 
	 <img <?php echo createLDImgSrc('../','ok_small.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php
}else{
?>



<a name="sel"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Tetkik parametresi nas�l se�ilir?</b></font>
<ul> 
	<b>Ad�m: </b>Parametrenin yan�ndaki k���k pembe kutuyu t�klat�p "karart�n�z".<p>
<img src="../help/tr/img/tr_request_baclabor.png" border=0 width=325 height=134>
</ul>

<a name="usel"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Bir parametre se�imden nas�l ��kar�l�r?</b></font>
<ul> 
	<b>Ad�m: </b>Parametrenin yan�ndaki "karart�lm��" kutuya tekrar t�klay�p "rengini a�abilir" siniz. <br>
</ul>
<a name="send"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Tetkik istemi nas�l g�nderilir?</b></font>
<ul> 
	<b>Ad�m: </b><img <?php echo createLDImgSrc('../','abschic.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php
}
?>
