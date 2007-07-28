<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Renk seçenekleri 
<?php
	switch($src)
	{
	case "ext": print " - Extended";
						break;
	 }
?>
</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arka plan rengi nasıl seçilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> İstediğiniz çerçevede "<span style="background-color:yellow" > Arka plan rengi <img <?php echo createComIcon('../','settings_tree.gif','0') ?>> </span>" bağlantısına tıklayınız.<br>
 	<b>Adım 2: </b>Renk paleti bulunan bir pencere açılır.<br>
 	<b>Adım 3: </b>Arka plan için istediğiniz renge tıklayınız.<br>
 	<b>Adım 4: </b>Rengi uygulamak için <input type="button" value="Uygula"> düğmesini tıklayınız.<br>
 	<b>Adım 5: </b>İşiniz bitti ise  <input type="button" value="Tamam"> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yazı rengi nasıl seçilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Ya üst çerçevedeki  "<span style="background-color:yellow" > Yazı rengi </span>" veya menü çerçevesindeki 
	"<span style="background-color:yellow" > Menü kalemleri </span>" bağlantısını tıklayınız.<br>
 	<b>Adım 2: </b>Renk paletli bir pencere açılır.<br>
 	<b>Adım 3: </b>Yazı için istediğiniz rengi seçiniz.<br>
 	<b>Adım 4: </b>Rengi uygulamak için <input type="button" value="Uygula"> düğmesini tıklayınız.<br>
 	<b>Adım 5: </b>İşiniz bitti ise <input type="button" value="Tamam"> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bağlantı renkleri nasıl seçilir?</b>
</font>
<ul>       	
 	<b>Adım 5: </b>İleri renk seçeneklerini görmek için <input type="button" value="İleri renk seçenekleri"> düğmesini tıklayınız.<br>
</ul>
<?php endif ?>

<?php if($src=="ext") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Aktif bağlantı rengi nasıl seçilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Ya ana çerçevede "<span style="background-color:yellow" > Etkin bağlantı </span>" bağlantısını ya da menü çerçevesinde "<span style="background-color:yellow" > Etkin bağlantı </span>" bağlantısını tıklayınız.<br>
 	<b>Adım 2: </b>Bir renk paleti penceresi açılır.<br>
 	<b>Adım 3: </b>Etkin bağlantı için istediğiniz rengi tıklayınız.<br>
 	<b>Adım 4: </b>Rengi uygulamak için <input type="button" value="Uygula"> düğmesini tıklatınız.<br>
 	<b>Adım 5: </b>İşiniz bitti ise <input type="button" value="Tamam"> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hover bağlantı rengi nasıl seçilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Ya ana çerçevede "<span style="background-color:yellow" > hover bağlantı </span>" bağlantısını ya da menü çerçevesinde "<span style="background-color:yellow" > hover bağlantı </span>" bağlantısını tıklayınız.<br>
 	<b>Adım 2: </b>Bir renk paleti penceresi açılır.<br>
 	<b>Adım 3: </b>Etkin bağlantı için istediğiniz rengi tıklayınız.<br>
 	<b>Adım 4: </b>Rengi uygulamak için <input type="button" value="Uygula"> düğmesini tıklatınız.<br>
 	<b>Adım 5: </b>İşiniz bitti ise <input type="button" value="Tamam"> düğmesini tıklayınız.<br>
</ul>


<?php endif ?>
	</form>

