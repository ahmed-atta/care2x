<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
if($x2=="pharma") print "Eczane - "; else print "T�bbi ambar - ";
	switch($src)
	{
	case "input": if($x1=="update") print "Bir �r�n�n bilgisini d�zenlemek";
                          else print "Bilgi bankas�na yeni �r�n girmek";
					break;
	case "search": print "Bir �r�n arama";
					break;
	case "mng": print "Bilgi bankas�ndaki �r�nleri d�zenlemek";
					break;
	case "delete": print "Bir �r�n� bilgi bankas�ndan silmek";
					break;
	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >

	

<?php if($src=="input") : ?>
	<?php if($x1=="") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bilgi bankas�na yeni bir �r�n nas�l girilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>�nce �r�n hakk�ndaki t�m bilgileri ilgili alanlara giriniz.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�r�n�n bir resmini se�mek istiyorum. Nas�l yap�l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>"<span style="background-color:yellow" > Resim dosyas� </span>" alan� �zerindeki <input type="button" value="Ara�t�r..."> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Bir dosya se�mek i�in k���k bir pencere a��l�r. �stedi�iniz resmi se�ip "Tamam" � t�klay�n�z.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�r�n�n t�m bilgilerini girmeyi bitirdim. Nas�l kay�t ederim?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b><input type="button" value="Kaydet"> d��mesini t�klay�n�z.<br>
</ul>
	<?php endif ?>	
	<?php if($x1=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir �r�n bilgi bankas�na nas�l girilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b><input type="button" value="Yeni �r�n"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Giri� formu g�r�nt�lenir.<br>
 	<b>Ad�m 3: </b>Yeni �r�n hakk�ndaki bulunan t�m bilgileri giriniz.<br>
 	<b>Ad�m 4: </b>Bilgiyi kay�t etmek i�in <input type="button" value="Kaydet"> d��mesini t�klay�n�z.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�u anda g�r�nt�lenen �r�n�n bilgisini d�zenlemek istiyorum. Nas�l yapar�m?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> <input type="button" value="G�ncelle veya d�zenle"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>�r�n bilgisi otomatik olarak d�zenleme formuna girilir.<br>
 	<b>Ad�m 3: </b>Bilgiyi d�zenleyiniz.<br>
 	<b>Ad�m 4: </b>Yeni bilgiyi kay�t etmek i�in <input type="button" value="Kaydet"> d��mesini t�klay�n�z.<br>
</ul>
	
	<?php endif ?>	
	<?php if($x1=="update") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Halen g�r�nt�lenen �r�n� d�zenlemek istiyorum. Nas�l yap�l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Gerekir ise �nce giri� alan�ndan bulunan bilgiyi siliniz.<p>
 	<b>Ad�m 2: </b>Yeni bilgiyi uygun giri� alan�na yaz�n�z.<p>
 	<b>Ad�m 3: </b>Yeni bilgiyi kay�t etmek i�in  <input type="button" value="Kaydet"> d��mesini t�klay�n�z.<br>
</ul>
	<?php endif ?>	
<?php endif ?>	

<?php if($src=="search") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir �r�n nas�l aran�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b><nobr><span style="background-color:yellow" >" Bir anahtar s�zc�k ara...: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alan�na malzemelerin marka ismi, jenerik isim, veya sipari� numaras� vs. bilgilerinin ya tamam�n� vaya ba�tan birka� harfini giriniz.<br>
 	<b>Ad�m 2: </b>Malzemeyi bulmak i�in  <input type="button" value="Ara"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 3: </b>E�er arama anahtar s�zc��e tam uyan bir �r�n bulur ise, malzemenin ayr�nt�l� bilgisi g�r�nt�lenir.<br>
 	<b>Ad�m 4: </b>E�er arama anahtar s�zc��e yak�n birka� malzeme bulur ise bir �r�n listesi g�r�nt�lenir.<br>
</ul>
	<?php if($x1!="multiple") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Birka� �r�n listelendi. Belirli bir malzemenin bilgisi nas�l g�r�l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Ya <img <?php echo createComIcon('../','info3.gif','0') ?>> d��mesini veya malzemenin ismini t�klay�n�z.<br>
</ul>
	<?php endif ?>
	<?php if($x1=="multiple") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�nceki malzeme listesini g�rmek istiyorum. Nas�l yapar�m?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> <input type="button" value="Geri git"> d��mesini t�klay�n�z.<br>
</ul>
	<?php endif ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 �ptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
</ul>

<?php endif ?>

<?php if($src=="mng") : ?>
	<?php if(($x3=="1")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�r�n bilgisi nas�l d�zenlenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Yeni �r�n bilgisini d�zenleyiniz.<br>
 	<b>Ad�m 2: </b>Yeni bilgiyi kay�t etmek i�in  <input type="button" value="Kaydet"> d��mesini t�klay�n�z.<br>
</ul>
	<?php endif ?>

	<?php if($x1=="multiple") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Halen g�r�nt�lenen �r�n bilgisi nas�l d�zenlenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b><input type="button" value="G�ncelle veya d�zenle"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>�r�n bilgisi otomatik olarak d�zenleme formuna girilir.<br>
 	<b>Ad�m 3: </b>Bilgiyi d�zenleyiniz.<br>
 	<b>Ad�m 4: </b>Yeni bilgiyi kay�t etmek i�in  <input type="button" value="Kaydet"> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Halen g�r�nt�lenen �r�n nas�l silinir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> <input type="button" value="Bilgi bankas�ndan sil"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Ger�ekten bilgi bankas�ndan silmeyi isteyip istemedi�iniz sorulur<br>
 	<b>Ad�m 3: </b>Ger�ekten �r�n bilgisini silmek istiyor iseniz, <input type="button" value="Evet, kesinlikle eminim. Bilgiyi sil."> d��mesini t�klay�n�z.<p>
 	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> Bilginin silinmesi geri al�namaz.<br>
</ul>	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�r�n bilgisini silmek istemiyorum. Ne yapmal�y�m?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> "<span style="background-color:yellow" > Hay�r, silme. Geri git </span>" ba�lant�s�n� t�klay�n�z.<br>
</ul>	
<?php endif ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bilgi bankas�ndaki bir �r�n nas�l d�zenlenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>�nce �r�n� bulunuz. <nobr><span style="background-color:yellow" >" Aranacak anahtar s�zc�k: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alan�na �r�n�n marka ismi, jenerik isim, veya sipari� numaras� bilgisinin tamam�n� veya birka� harfini giriniz.<br>
 	<b>Ad�m 2: </b>Malzemeyi bulmak i�in <input type="button" value="Ara"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 3: </b>Arama anahtar s�zc���n tam kar��l��� bir malzeme bulur ise, malzeme hakk�nda ayr�nt�l� bilgi g�r�nt�lenir. <br>
 	<b>Ad�m 4: </b>Arama anahtar s�zc��e yak�n bir ka� malzeme bulur ise bir malzeme listesi g�r�nt�lenir.<br>
</ul>
	<?php if(($x1!="multiple")&&($x3=="")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Birka� malzeme listelendi. Belirli bir malzemenin bilgisi nas�l g�r�n�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> Ya  <img <?php echo createComIcon('../','info3.gif','0') ?>> d��mesini veya malzemenin ismini t�klay�n�z.<br>
</ul>
	<?php endif ?>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 �ptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php endif ?>



<?php if($src=="delete") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�r�n� bilgi bankas�ndan silmek istiyorum. Ne yapmal�y�m?</b>
</font>
<ul>       	
 	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> �r�n�n silinmesi i�lemi geri al�namaz.<p>
 	<b>Ad�m 1: </b>�r�n� silmek istedi�inizden emin iseniz,  <input type="button" value="Evet, kesinlikle eminim. Bilgiyi sil"> ba�lant�s�n� t�klay�n�z.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�r�n bilgisini silmek istemiyorum. Ne yapmal�y�m?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> "<span style="background-color:yellow" > Hay�r, silme. Geri git </span>" ba�lant�s�n� t�klay�n�z.<br>
</ul>	

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b></font> 
<ul>       	
 �ptal etmeye karar verir iseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.
</ul>

<?php endif ?>	

<?php if($src=="report") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir rapor nas�l yaz�l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Raporunuzu 
				<nobr><span style="background-color:yellow" >" Rapor: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alan�na yaz�n�z.<br>
 	<b>Ad�m 2: </b>Ad�n�z�
				<nobr><span style="background-color:yellow" >" Raporu yazan: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alan�na yaz�n�z.<br>
 	<b>Ad�m 3: </b>Sicil numaran�z�
				<nobr><span style="background-color:yellow" >" Sicil No: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alan�na yaz�n�z.<br>
 	<b>Ad�m 4: </b>Raporu g�ndermek i�in  <input type="button" value="G�nder"> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyar�:</b><br></font> 
       	
�ptal etmeye karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php endif ?>	

</form>

