<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
EDP - 
<?php
	if($x1=='edit') $x1='update';
	switch($src)
	{
	case "access": 
		switch($x1)
						{
							case "": print "Eri�im hakk� olu�turma";
												break;
							case "save": print "Yeni eri�im hakk� kaydedildi";
												break;
							case "list": print "Bulunan eri�im haklar�";
												break;
							case "update": print "Bir eri�im hakk�n�n d�zenlenmesi";
												break;
							case "lock":  print  " Bulunan bir eri�im hakk�n�n"; if($x2=="0") print " kilitlenmesi"; else print " kilidinin a��lmas�"; 
												break;
							case "delete": print "Bir eri�im hakk�n�n silinmesi";
												break;
						}
						break;
	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >

	

<?php if($src=="access") : ?>
	<?php if($x1=="") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hastane �al��an� i�in eri�im haklar� nas�l olu�turulur ?</b>
</font>
<ul>       	
 	<b>Ad�m  1: </b>�nce �al��an� bulunuz.  <input type="button" value="Bir �al��an� bul"> d��mesini t�klay�n�z.<p>
 	<b>Ad�m 2: </b>Bir arama sayfas� a��l�r. Bir �al��an� arama konusundaki y�nergeleri izleyiniz.<p>
</ul>

		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni eri�im hakk� nas�l olu�turulur?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Ki�i, b�l�m, veya klinik vs.nin tam ad�n� "<span style="background-color:yellow" > �sim </span>" alan�na yaz�n�z.<br>
 	<b>Ad�m 2: </b>Kullan�c� ismini "<span style="background-color:yellow" > kullan�c� giri� ismi </span>" alan�na yaz�n�z.<p>
	<b>Uyar�:</b> Kullan�c� ad�nda bo�lu�a izin verilmez.<p>
 	<b>Ad�m 3: </b>Kullan�c� �ifresini "<span style="background-color:yellow" > �ifre </span>" alan�na giriniz.<p>
 	<b>Ad�m 4: </b>"�zin a�ac�" nda kullan�c�n�n girmesine izin verilen alanlar� i�aretleyiniz.<p>
</ul>

	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
T�m ilgili bilgileri girmeyi bitirdim. Nas�l kaydederim?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
</ul>
	<?php endif ?>	
	<?php if($x1=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�imdi yeni eri�im hakk� kaydedildi. Bir ba�ka eri�im hakk� daha nas�l olu�turulur?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> <input type="button" value="Tamam"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>Giri� formu g�r�lecek.<br>
 	<b>Ad�m 3: </b>Eri�im hakk� olu�turmak hakk�nda daha fazla bilgi g�rmek i�in "Yard�m" d��mesini t�klay�n�z.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Daha �nceden verilmi� eri�im haklar�n�n listesini g�rmek istiyorum. Nas�l yapar�m?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b> <input type="button" value="G�ncel eri�im haklar� listesi"> d��mesini t�klay�n�z.<br>
 	<b>Ad�m 2: </b>G�ncel eri�im haklar� listelenir<br>
</ul>
	
	<?php endif ?>	
	<?php if($x1=="list") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<img <?php echo createComIcon('../','padlock.gif','0','absmiddle') ?>> ve <img <?php echo createComIcon('../','arrow-gr.gif','0','absmiddle') ?>> d��melerinin anlam� ne?</b>
</font>
<ul>       	
 	<img <?php echo createComIcon('../','padlock.gif','0','absmiddle') ?>> = Kullan�c�n�n eri�im hakk� kilitlenmi� veya "dondurulmu�". Eri�ilebilir olarak d�zenlenmi� alanlara giremez.<br>
 	<img <?php echo createComIcon('../','arrow-gr.gif','0','absmiddle') ?>> = Kullan�c�n�n eri�im hakk� kilitli de�il. Eri�ilebilir olarak d�zenlenmi� alanlara girebilir.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
 "C","L", ve "D", veya "U" se�enekleri ne anlama gelir?</b>
</font>
<ul>       	
 	<b>C: </b> = Kullan�c�n�n eri�im bilgisini de�i�tirmek veya d�zenlemek.<br>
 	<b>L: </b> = Kullan�c�n�n eri�im hakk�n� kilitlemek.<br>
 	<b>D: </b> = Kullan�c�n�n eri�im hakk�n� silmek.<br>
 	<b>U: </b> = (Halen kilitli ise) kullan�c�n�n eri�im hakk�n�n kilidini ��zmek.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Kullan�c�n�n eri�im bilgisi nas�l d�zenlenir veya de�i�tirilir?</b>
</font>
<ul>       	
 	Kullan�c� ile ilgili "<span style="background-color:yellow" > C </span>" se�ene�ini t�klay�n�z.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Kullan�c�n�n  eri�im verisi nas�l kilitlenir?</b>
</font>
<ul>       	
 	Kullan�c� ile ilgili "<span style="background-color:yellow" > L </span>" se�ene�ini t�klay�n�z.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
(E�er halen kilitli ise) Kullan�c�n�n eri�im hakk�n�n kilidi nas�l a��l�r?</b>
</font>
<ul>       	
 	Kullan�c� ile ilgili "<span style="background-color:yellow" > U </span>" se�ene�ini t�klay�n�z.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir eri�im hakk� nas�l silinir?</b>
</font>
<ul>       	
 	Kullan�c� ile ilgili  "<span style="background-color:yellow" > D </span>" se�ene�ini t�klay�n�z.<br>
</ul>

	<?php endif ?>	
	
	<?php if($x1=="update") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir eri�im hakk� nas�l d�zenlenir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Bilgiyi d�zenleyiniz.<br>
 	<b>Ad�m 2: </b><img <?php echo createLDImgSrc('../','savedisc.gif','0','absmiddle') ?>> d��mesini t�klay�n�z .<br>
</ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Uyar�:</b>
</font>
<ul>       	
 	E�er d�zenlememeye karar verirseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0','absmiddle') ?>>  d��mesini t�klay�n�z.<br>
</ul>
	
	<?php endif ?>		
	<?php if($x1=="delete") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir eri�im hakk� nas�l silinir?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>Eri�im hakk�n� silmek istedi�inizden emin iseniz,<br>
	  <input type="button" value="Evet, Kesinlikle eminim. Eri�im hakk�n� sil."> d��mesini t�klay�n�z.<br>
</ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Uyar�:</b>
</font>
<ul>       	
 	Silmemeye karar verir iseniz <input type="button" value="Hay�r Geri."> d��mesini t�klay�n�z.<br>
</ul>
	
	<?php endif ?>		
	
	<?php if($x1=="lock") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir eri�im hakk� nas�l <?php if($x2=="0") print "kilitlenir"; else print "a��l�r"; ?> ?</b>
</font>
<ul>       	
 	<b>Ad�m 1: </b>E�er bir eri�im hakk�n�  <?php if($x2=="0") print "kilitlemek"; else print "a�mak"; ?> istedi�inizden emin iseniz,<br>
	  <input type="button" value="Evet, eminim."> d��mesini t�klay�n�z.<br>
</ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Uyar�:</b>
</font>
<ul>       	
 	E�er <?php if($x2=="0") print "kilitlemeye"; else print "��zmemeye"; ?> karar verirseniz <input type="button" value="Hay�r. Geri."> d��mesini t�klay�n�z.<br>
</ul>
	
	<?php endif ?>		
<?php endif ?>	

	</form>

