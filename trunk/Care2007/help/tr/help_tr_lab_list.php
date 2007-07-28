<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "Laboratory - $x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Test parametreleri için grafik çizelge nasıl görüntülenir?</b>
</font>
<ul>      
 	<b>Adım 1: </b>İstenilen parametrenin seçim kutusunu <input type="checkbox" name="s" value="s" checked> tıklayınız.<br>
		<b>Adım 2: </b>Bir kaç parametreyi aynı anda göstermek istiyor iseniz onların da kutularını işaretleyiniz.<br>
		<b>Adım 3: </b>Grafik çizelgeyi görüntülemek için <img <?php echo createComIcon('../','chart.gif','0') ?>>  simgesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Tüm parametreleri seçmek istiyorum. Hepsini birden seçmenin kolay yolu var mı?</b>
</font>
<ul>      
		<b>Evet var!</b><br>
		<b>Adım 1: </b>Tüm parametreleri seçmek için <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?> border=0> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Tüm parametreler seçimden nasıl çıkarılır?</b>
</font>
<ul>      
		<b>Adım 1: </b>Tüm parametreleri seçimden çıkartmak için <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?> border=0> düğmesini bir kez daha tıklayınız.<br>
</ul>
<?php endif ?>
<?php if($src=="graph") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Grafik çizelgeler olmadan tetkik sonuçlarına nasıl gidilir? </b></font>
<ul> <b>Uyarı: </b>Eğer geri gitmek isterseniz <img <?php echo createLDImgSrc('../','back2.gif','0','absmiddle') ?>> düğmesini tıklayınız.</ul>
<?php endif ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Laboratuvar nasıl kapatılır <?php echo $x3 ?>? </b></font>
<ul> <b>Uyarı: </b>Kapatmak ister iseniz,  <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> düğmesini tıklayınıız.</ul>


</form>

