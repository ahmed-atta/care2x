<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
�ntranet Eposta - 
<?php
	switch($src)
	{
	case "pass": switch($x1)
						{
							case "": print "Giri�";
												break;
							case "1": print "Yeni kullan�c� kayd�";
												break;
						}
						break;
	case "mail": switch($x1)
						{
							case "compose": print "Yeni eposta olu�tur";
												break;
							case "listmail": print "Posta listesi";
												break;
							case "sendmail": print "G�nderilmi� posta";
												break;
						}
						break;
	case "read": print "Posta okuma";
						break;
	case "address": print "Adres defteri";
						break;

	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >

	

<?php if($src=="pass") : ?>
<?php if($x1=="") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Nas�l giri� yap�l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>�ntranet eposta adresinizi  ( @xxxxxx k�sm� olmaks�z�n)  <nobr>"<span style="background-color:yellow" > Eposta adresiniz: </span>"</nobr> alan�na yaz�n�z.<br>
 	<b>Ad�m 2: </b>Alan k�sm�n� <nobr>"<span style="background-color:yellow" > @<select name="d">
                                                                                          	<option value="Test Domain 1"> Test Domain 1</option>
                                                                                          	<option value="Test Domain 2"> Test Domain 2</option>
                                                                                          </select>
                                                                                           </span>"</nobr> alanlar�ndan se�iniz.<br>
 	<b>Ad�m 3: </b>Girmek i�in <input type="button" value="Giri�"> d��mesini t�klay�n�z.<br>
</ul>

	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hen�z bir adresim yok. Nas�l yeni bir adres alabilirim?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> Kay�t formu a�mak i�in "<span style="background-color:yellow" > Yeni kullan�c� buradan kay�t olabilir. <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>> </span>" ba�lant�s�n� t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Daha �ok bilgi i�in kay�t formundaki "Yard�m" d��mesini t�klayabilirsiniz.<br>
</ul>
	<?php endif ?>		
	<?php if($x1=="1") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Nas�l kay�t olunur?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Soyad ve ad�n�z� "<span style="background-color:yellow" > Soyad, Ad: </span>" alan�na giriniz.<br>
 	<b>Ad�m 2: </b>Tercih etti�iniz eposta adresini "<span style="background-color:yellow" > Se�ilen eposta adresi: </span>" alan�na giriniz.<p>
 	<b>Ad�m 3: </b>Alan k�sm�n� <nobr>"<span style="background-color:yellow" > @<select name="d">
                                                                                          	<option value="Test Domain 1"> Test Domain 1</option>
                                                                                          	<option value="Test Domain 2"> Test Domain 2</option>
                                                                                          </select>
                                                                                           </span>"</nobr> alan�ndan se�iniz.<br>
 	<b>Ad�m 4: </b>�stedi�iniz takma ismi "<span style="background-color:yellow" > Takma isim: </span>" alan�ndan se�iniz.<p>
 	<b>Ad�m 5: </b>Se�ti�iniz �ifreyi "<span style="background-color:yellow" > �ifre se�iniz: </span>" alan�na giriniz.<br>
 	<b>Ad�m 6: </b>�ifrenizi "<span style="background-color:yellow" > �ifrenizi tekrar giriniz: </span>" alan�na tekrar giriniz.<br>
 	<b>Ad�m 7: </b>Kay�t olmak i�in <input type="button" value="Register"> d��mesini t�klay�n�z.<br>
</ul>

	<?php endif ?>		
<?php endif ?>	

<?php if($src=="mail") : ?>
<?php if($x1=="listmail") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir posta nas�l a��l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Postan�� al�c�s�n�, veya g�ndericisini, veya konusunu, veya tarihini veya simgelerini t�klay�n�z <img <?php echo createComIcon('../','c-mail.gif','0') ?>> or <img <?php echo createComIcon('../','o-mail.gif','0') ?>>.<br>
</ul>

	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Simgelerin anlam� <img <?php echo createComIcon('../','c-mail.gif','0') ?>> and <img <?php echo createComIcon('../','o-mail.gif','0') ?>> nedir?</b>
</font>
<ul>       	
 	<img <?php echo createComIcon('../','c-mail.gif','0') ?>> = Posta hen�z okunmad� veya a��lmad�. <br>
 	<img <?php echo createComIcon('../','o-mail.gif','0') ?>> = Posa �nceden okundu veya a��ld�. <br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Posta nas�l silinir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Se�mek i�in postan�n kontrol kutusunu <input type="checkbox" name="a" value="s" checked> i�aretleyiniz.<br>
 	<b>Ad�m 2: </b><input type="button" value="Sil"> d��mesini t�klay�n�z.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir klas�rden di�er klas�re nas�l ge�ilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Klas�r�n ismini t�klay�n�z.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir posta nas�l yaz�l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> "<span style="background-color:yellow" > Yeni Email </span>" ba�lant�s�n� t�klay�n�z.<br>
</ul>
	<?php endif ?>		
	<?php if($x1=="compose") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni  mail nas�l yaz�l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> Alacak olan�n email adresini "<span style="background-color:yellow" > Al�c�: </span>" alan�na yaz�n�z.<br>
 	<b>Ad�m 2: </b>E�er bir ba�ka ki�iye kopyas�n� g�ndermek isterseniz onun email adresini "<span style="background-color:yellow" > Bilgi </span>" alan�na yaz�n�z.<br>
 	<b>Ad�m 3: </b>Adresinin belli olmas�n� istemedi�iniz bir ki�iye bir kopya g�ndermek isterseniz onun email adresini  "<span style="background-color:yellow" > Gizli </span>" alan�na yaz�n�z.<br>
 	<b>Ad�m 4: </b>Mesaj�n�z�n konusunu "<span style="background-color:yellow" > Konu: </span>" alan�na yaz�n�z.<br>
 	<b>Ad�m 5: </b>�imdi mesaj�n�z� metin alan�na yaz�n�z.<br>
 	<b>Ad�m 6: </b>Postay� g�ndermek i�in  <input type="button" value="G�nder"> d��mesini t�klay�n�z.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Maili bir taslak olarak saklamak istiyorum nas�l yap�l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Mesaj�n�z� metin kutusuna yaz�n�z.<br>
 	<b>Ad�m 2: </b>Mesaj�n�z� yazd�ktan sonra, <input type="button" value="Taslak olarak kaydet"> d��mesini t�klay�n�z.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Adres defterimdeki email adreslerini do�rudan nas�l kullan�r�m?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>"H�zl� adresler" deki <input type="button" value="Hepsini g�ster"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>K���k bir pencere a��l�r adres defteriniz g�r�n�r.<br>
 	<b>Ad�m 3: </b>Adresin ilgili d��mesini t�klayarak gerekli alana kopyalanmas�n� sa�lay�n�z.<p>
<ul>   
		Adresi "Al�c�" alan�na kopyalamak i�in  "Kime<input type="radio" name="t" value="a">" yi t�klay�n�z.<br>
		Adresi "Bilgi" alan�na kopyalamak i�in "Bilgi<input type="radio" name="t" value="a">" yi t�klay�n�z.<br>
		Adresi "Gizli" alan�na kopyalamak i�in "Gizli<input type="radio" name="t" value="a">" yi t�klay�n�z.<p>
</ul>
        <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <b>Uyar�:</b>  E�er bir se�ene�i ba�tan d�zenlemek ister iseniz, ilgili <img <?php echo createComIcon('../','redpfeil.gif','0') ?>> simgesini t�klay�n�z.<br> 	
        <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <b>Uyar�:</b> Ayn� anda birka� adresi birden se�ebilirsiniz.<p>
 	<b>Ad�m 4: </b>Se�ilmi� adresleri olu�turulan maile kopyalamak i�in <input type="button" value="Ta��"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 5: </b>A��lm�� penncereyi kapatmak i�in "<span style="background-color:yellow" > <img <?php echo createComIcon('../','l_arrowgrnsm.gif','0') ?>> Kapat </span>"
	 ba�lant�s��n� t�klay�n�z.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bu "�abuk adres" de nedir?</b>
</font>
<ul>       	
 	<b>Uyar�: </b>"�abuk adres" haf�zas�nda sakl� e-mail adresleri var ise ilk be�i "�abuk adres" olarak listelenir.<p>
 	<b>Ad�m 1: </b>Adresi koymak istedi�iniz giri� alan�n�(yani kime:, veya bilgi:, veya gizli:)  odaklanmak i�in t�klay�n�z.<br>
 	<b>Ad�m 2: </b>"�abuk adres" listesindeki adrese t�klay�n�z. Bu adres otomatik olarak daha �nce t�klad���n�z giri� alan�na kopyalan�r.<br>
</ul>

	<?php endif ?>		
<?php if(($x1=="sendmail")&&($x3=="1")) : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir email nas�l yaz�l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>"<span style="background-color:yellow" > Yeni Email </span>" linkini t�klay�n�z.<br>
</ul>
	<?php endif ?>		
<?php endif ?>	


<?php if($src=="read") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Email nas�l yazd�r�l�r?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>"<span style="background-color:yellow" > Yaz�c� s�r�m� <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>></span>"ba�lant�s�n� t�klay�n�z.<br>
 	<b>Ad�m 2: </b>E mailin yaz�c� uyumlu g�r�nt�s� yeni bir pencerede a��l�r.<br>
 	<b>Ad�m 3: </b>Yazd�rmak i�in <span style="background-color:yellow" >  "Yazd�r"  </span> se�ene�ini t�klay�n�z.<br>
 	<b>Ad�m 4: </b>Yaz�c� men�s� a��l�r. "Tamam" d��mesini t�klay�n�z.<br>
 	<b>Ad�m 5: </b>Yaz�c� s�r�m� penceresini kapatmak i�in, "<span style="background-color:yellow" > < Kapat > </span>" se�ene�ini t�klay�n�z.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Email nas�l tekrar g�nderilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> <input type="button" value="Tekrar g�nder"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Gerekli ise email adreslerini d�zenleyiniz.<br>
 	<b>Ad�m 3: </b>Emaili g�ndermek i�in <input type="button" value="G�nder"> d��mesini t�klay�n�z.
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir email nas�l iletilir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> <input type="button" value="�let"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Al�c�n�n adresini giriniz.<br>
 	<b>Ad�m 3: </b>Sonunda emaili g�ndermek i�in <input type="button" value="G�nder"> d��mesini t�klay�n�z.
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Email nas�l silinir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> <input type="button" value="Sil"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Ger�ekten emaili silmeyi isteyip istemedi�iniz soruluur.<br>
 	<b>Ad�m 3: </b>Emaili sonunda silmak i�in  <input type="button" value="Tamam"> d��mesini t�klay�n�z.<p>
	<b>Uyar�:</b> "Gelen kutusu"ndan silinmi� emailler ge�ici olarak "silinmi� �geler"de depolan�rlar.
</ul>
	<?php endif ?>		
	
<?php if($src=="address") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Adres defterine bir email nas�l eklenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> <input type="button" value="Yeni email adresi ekle"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Bir giri� formu g�r�nt�lenir "<span style="background-color:yellow" > Soyad, Ad: </span>" alan�na ismi giriniz.<br>
 	<b>Ad�m 3: </b> "<span style="background-color:yellow" > Takma ad: </span>" alan�na takma ad� giriniz.<br>
 	<b>Ad�m 4: </b> "<span style="background-color:yellow" > Email adresi: </span>" alan�na email adresini giriniz.<br>
 	<b>Ad�m 5: </b>Alan� <nobr>"<span style="background-color:yellow" > @<select name="d">
                                                                                          	<option value="Test Domain 1"> Test Domain 1</option>
                                                                                          	<option value="Test Domain 2"> Test Domain 2</option>
                                                                                          </select>
                                                                                           </span>"</nobr> test alanlar�ndan se�iniz.<br>
 	<b>Ad�m 6: </b> <input type="button" value="Kaydet"> d��mesini t�klay�n�z.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Adres defterinden bir email adresi nas�l silinir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Silinecek adresin kutusunu <input type="checkbox" name="d" value="s" checked> i�aretleyiniz.<br>
 	<b>Ad�m 2: </b> <input type="button" value="Sil"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 3: </b>Ger�ekten silmeyi isteyip istemedi�iniz sorulacak.<br>
 	<b>Ad�m 4: </b>Adresi sonunda silmek i�in <input type="button" value="Tamam"> d��mesini t�klay�n�z.<p>
</ul>
	<?php endif ?>		

	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Uyar�:</b>
</font>
<ul>       	
 	�ntranet emailleri ve adresleri YALNIZCA intranet sistemi i�erisinde �al���r internette kullan�lamaz.<br>
</ul>
	</form>

