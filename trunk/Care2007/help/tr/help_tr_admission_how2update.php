
<p><font size=2 face="verana,arial" >
<form action="#" >
<b>Bilgileri g�ncelle�tirmek veya de�i�tirmek</b>
<ul> Bilgilerde de�i�iklik yapmak isterseniz <input type="button" value="G�ncelle�tir"> d��mesini t�klay�n�z.
</ul>
<?php if($src=="search") : ?>
<b>Yeni arama</b>
<ul> Yeni bir arama ba�latmak isterseniz  <input type="button" value="Aramaya geri"> d��mesini t�klay�n�z.
</ul>
<?php else : ?>
<b>Yeni bir hasta i�in yeni kabul ba�latmak</b>
<ul> E�er yeni bir kabul i�emi ba�latmak isterseniz  <input type="button" value="Kabule geri "> d��mesini t�klat�n�z.
</ul>
<?php endif ?>
<b>Uyar�</b>
<ul> E�er i�iniz bitti ise <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klat�n�z.
		
</ul>


</form>

