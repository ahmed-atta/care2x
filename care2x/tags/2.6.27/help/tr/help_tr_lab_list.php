<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "Laboratory - $x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Test parametreleri i�in grafik �izelge nas�l g�r�nt�lenir?</b>
</font>
<ul>      
 	<b>Ad�m 1: </b>�stenilen parametrenin se�im kutusunu <input type="checkbox" name="s" value="s" checked> t�klay�n�z.<br>
		<b>Ad�m 2: </b>Bir ka� parametreyi ayn� anda g�stermek istiyor iseniz onlar�n da kutular�n� i�aretleyiniz.<br>
		<b>Ad�m 3: </b>Grafik �izelgeyi g�r�nt�lemek i�in <img <?php echo createComIcon('../','chart.gif','0') ?>>  simgesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
T�m parametreleri se�mek istiyorum. Hepsini birden se�menin kolay yolu var m�?</b>
</font>
<ul>      
		<b>Evet var!</b><br>
		<b>Ad�m 1: </b>T�m parametreleri se�mek i�in <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?> border=0> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
T�m parametreler se�imden nas�l ��kar�l�r?</b>
</font>
<ul>      
		<b>Ad�m 1: </b>T�m parametreleri se�imden ��kartmak i�in <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?> border=0> d��mesini bir kez daha t�klay�n�z.<br>
</ul>
<?php endif ?>
<?php if($src=="graph") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Grafik �izelgeler olmadan tetkik sonu�lar�na nas�l gidilir? </b></font>
<ul> <b>Uyar�: </b>E�er geri gitmek isterseniz <img <?php echo createLDImgSrc('../','back2.gif','0','absmiddle') ?>> d��mesini t�klay�n�z.</ul>
<?php endif ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Laboratuvar nas�l kapat�l�r <?php echo $x3 ?>? </b></font>
<ul> <b>Uyar�: </b>Kapatmak ister iseniz,  <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> d��mesini t�klay�n��z.</ul>


</form>

