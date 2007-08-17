
<p><font size=2 face="verana,arial" >
<form action="#" >
<b>Bilgileri güncelleştirmek veya değiştirmek</b>
<ul> Bilgilerde değişiklik yapmak isterseniz <input type="button" value="Güncelleştir"> düğmesini tıklayınız.
</ul>
<?php if($src=="search") : ?>
<b>Yeni arama</b>
<ul> Yeni bir arama başlatmak isterseniz  <input type="button" value="Aramaya geri"> düğmesini tıklayınız.
</ul>
<?php else : ?>
<b>Yeni bir hasta için yeni kabul başlatmak</b>
<ul> Eğer yeni bir kabul işemi başlatmak isterseniz  <input type="button" value="Kabule geri "> düğmesini tıklatınız.
</ul>
<?php endif;?>
<b>Uyarı</b>
<ul> Eğer işiniz bitti ise <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklatınız.
		
</ul>


</form>

