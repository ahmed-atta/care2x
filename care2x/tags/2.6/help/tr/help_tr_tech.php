<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title></title>

</head>
<body>
<form >
<font face="Verdana, Arial" size=2>
<font  size=3 color="#0000cc">
<b>

<?php
print "Teknik destek - ";	
switch($src)
	{
		case "request": print "Onar�m istemi";
							break;
		case "report": print "Onar�m servisi onar�ld� raporu";
							break;
		case "queries": print "Soru yada sorgu g�nder";
							break;
		case "arch": print "Ar�ivde arama";
							break;
		case "showarch": print "Rapor";
							break;
	}
?>
</b>
</font>
<p>

<?php if($src=="request") : ?>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Onar�m servisine nas�l istem g�nderilir?</b></font>
<ul> <b>Ad�m 1: </b>Ar�zan�n bulundu�u servisi  
<nobr>"<span style="background-color:yellow" > Ar�zan�n yeri <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> alan�na giriniz.<p>
<b>Ad�m 2: </b>�sminizi <nobr>"<span style="background-color:yellow" > �steyen: <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> alan�na giriniz.<br>
 <b>Ad�m 3: </b>Sicil numaran�z�  <nobr>"<span style="background-color:yellow" > Personel no.: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> alan�na giriniz.<br>
 <b>Ad�m 4: </b>Onar�m b�l�m�n�n gerekirse isteminiz hakk�nda sorular�n� sorabilece�i telefon numaran�z� <nobr>"<span style="background-color:yellow" > Telefon no. <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> alan�na giriniz.<p>
 <b>Ad�m 5: </b>Ar�zay�  <nobr>"<span style="background-color:yellow" > L�tfen ar�zay� betimleyiniz: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> alan�nda k�saca belirtiniz.<br>
 <b>Ad�m 6: </b>�steminizi g�ndermek i�in <img <?php echo createLDImgSrc('../','abschic.gif','0') ?>> d��mesini t�klay�n�z. <br>
</ul>
<b>Uyar�</b>
<ul> E�er istem formunu kapatmak isterseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php endif ?>
<?php if($src=="report") : ?>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Onar�m tamamland��� nas�l bildirilir?</b></font>
<ul> <b>Ad�m 1: </b>Ar�zan�n yerini 
<nobr>"<span style="background-color:yellow" > ar�zan�n yeri <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> alan�na giriniz.<p>
<b>Ad�m 2: </b>�� kimlik numaras�n� <nobr>"<span style="background-color:yellow" > �� kimlik no.: <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> alan�na giriniz.<br>
<b>Ad�m 3: </b>�sminizi <nobr>"<span style="background-color:yellow" > Teknisyen: <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> alan�na giriniz.<br>
 <b>Ad�m 4: </b>Personel sicil numaran�z� <nobr>"<span style="background-color:yellow" > Sicil no.: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> alan�na giriniz.<br>
 <b>Step 5: </b>Yapt���n�z onar�m i�ini <nobr>"<span style="background-color:yellow" > L�tfen yapt���n�z �nar�m i�ini anlat�n�z: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> alan�na yaz�n�z.<br>
 <b>Step 6: </b>Raporunuzu g�ndermek i�in <input type="button" value="Raporu g�nder"> d��mesini t�klay�n�z. <br>
</ul>
<b>Uyar�</b>
<ul> Formu kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php endif ?>
<?php if($src=="queries") : ?>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Teknik destek b�l�m�ne bir soru veya sorgu nas�l g�nderilir?</b></font>
<ul> <b>Ad�m 1: </b>Soru veya sorgunuzu <nobr>"<span style="background-color:yellow" > L�tfen sorunuzu yaz�n�z: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> alan�na giriniz.<br>
<b>Ad�m 2: </b>Ad�n�z� <nobr>"<span style="background-color:yellow" > �sim: <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> alan�na giriniz.<br>
 <b>Ad�m 3: </b>B�l�m�n�z� <nobr>"<span style="background-color:yellow" > B�l�m: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> alan�na giriniz.<br>
 <b>Ad�m 4: </b>Sorunuzu g�ndermek i�in <input type="button" value="G�nder"> d��mesini t�klay�n�z. <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Daha �nceki sorular�m� ve teknik b�l�m�n yan�tlar�n� nas�l g�rebilirim?</b></font>
<ul> <b>Ad�m 1: </b>�nce giri� yapmal�s�n�z. �sminizi �st sa� k��edeki <nobr>"<span style="background-color:yellow" > kimden: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> alan�na giriniz.<br>
 <b>Ad�m 2: </b><input type="button" value="Giri�"> d��mesini t�klay�n�z. <br>
 <b>Ad�m 3: </b>Daha �nce soru g�ndermi� iseniz k�sa formda listelenir.  <br>
 <b>Ad�m 4: </b>Sorunuz teknik b�l�mce yan�tlanm�� ise, en sonda <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> simgesi g�r�nt�lenir. <br>
 <b>Ad�m 5: </b>Sorunuzu ve teknik b�l�m�n yan�t�n� okumak i�in �zerine t�klay�n�z. <br>
</ul>
<b>Uyar�</b>
<ul> Soruyu kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php endif ?>
<?php if($src=="arch") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Teknik raporlar nas�l okunur?</b></font>
<ul> 
		<b>Uyar�: </b>Okunmam�� veya yazd�r�lmam�� teknik raporlar derhal listelenir.<p>
<b>Ad�m 1: </b>A�mak istedi�iniz raporun <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>>  d��mesini t�klay�n�z. <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Belirli teknik raporlar nas�l aran�r?</b></font>
<ul> <b>Ad�m 1: </b>A�a��da a��klanan alanlara bir bilginin ya tamam�n� ya da ilk birka� harfini giriniz.<br>
	<ul type=disc> 
	<li>Belirli bir teknisyenin yazd��� raporlar� bulmak ister iseniz teknisyenin ismini "<span style="background-color:yellow" > Teknisyen: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" alan�na giriniz.<br>
	<li>Belirli bir b�l�mde yap�lm�� i�lerin raporlar�n� bulmak ister iseniz, b�l�m�n ad�n�  "<span style="background-color:yellow" > B�l�m: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" alan�na giriniz.<br>
	<li>Belirli bir tarihte yaz�lm�� raporlar� bulmak ister iseniz  "<span style="background-color:yellow" > Ba�lang�� tarihi: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" alan�na tarihi giriniz.<br>
	<li>Belirli bir d�nemdeki t�m raporlar� bulmak ister iseniz  "<span style="background-color:yellow" > Ba�lang�� tarihi: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" alan�na ba�lang�� tarihini, "<span style="background-color:yellow" > biti� tarihi: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" alan�na biti� tarihini giriniz.<br>
	</ul>
 <b>Ad�m 2: </b>Aramay� ba�latmak i�in  <input type="button" value="Ara"> d��mesini t�klay�n�z. <br>
<b>Ad�m 3: </b>Sonu�lar listelenir. A�mak istediiniz raporun <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>>  simgesini t�klay�n�z. <br>
	<b>Uyar�: </b> Teknik raporlar�n <img <?php echo createComIcon('../','check-r.gif','0') ?>> ile i�aretlenmi� olmas� daha �nceden okundu�unu ya da yazd�r�ld���n� g�sterir.<p>

</ul>
</font>
<?php endif ?>
<?php if($src=="showarch") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Raporun okundu olarak i�aretlenmesi.</b></font>
<ul> <b>Ad�m 1: </b> <input type="button" value=" 'Okundu' olarak i�aretle"> d��mesini t�klay�n�z.<p>
	<b>Uyar�: </b>Bir rapor okundu olarak i�aretlendi�inde, her ar�iv aramas�n�n ba�lang�c�nda otomatik olarak g�r�nt�lenmez. Ancak normal ar�iv arama y�ntemi ile tekrar bulunabilir.<p>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Raporun yazd�r�lmas�.</b></font>
<ul> <b>Ad�m 1: </b> <input type="button" value="Yazd�r"> d��mesini t�klay�n�z.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ar�iv aramas�n�n ba��na nas�l geri gidilir?</b></font>
<ul> <b>Ad�m 1: </b> <input type="button" value="<< Geri git"> d��mesini t�klay�n�z.<p>
</ul>
<?php endif ?>
<?php if($src=="dutydoc") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
N�bet saatinde yap�lm�� bir i� nas�l belgelendirilir?</b></font>
<ul> <b>Ad�m 1: </b>Tarihi " Tarih <input type="text" name="d" size=10 maxlength=10> " alan�na giriniz.<p>
	<ul> <b>Uyar�: </b>Bug�n�n tarihini otomatik olarak girmek i�in  "t" veya  "T" (TODAY=Bug�n anlam�nda) giriniz.<br>
		<b>Uyar�: </b>D�nk� tarihi otomatik girmek i�in  "y" veya "Y" (YESTERDAY=D�n anlam�nda ) giriniz.<p>
		</ul>
		<b>Ad�m 2: </b>N�bet�i hem�irenin ad�n�  <nobr>"<span style="background-color:yellow" > Soyad, ad <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> alan�na giriniz.<br>
 <b>Ad�m 3: </b>�� ba�lama saatini "<span style="background-color:yellow" > ba�lang�� saati <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<br>
 <b>Ad�m 4: </b>�� biti� saatini "<span style="background-color:yellow" > biti� saati <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<p>
	<ul> <b>�pucu: </b>�u anki zaman� otomatik olarak girmek i�in  "n" veya "N" (NOW=�imdi anlam�nda) giriniz.<p>
		</ul>
 <b>Ad�m 5: </b>Ameliyathane numaras�n� "<span style="background-color:yellow" > Ameliyathane <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<br>
 <b>Ad�m 6: </b>Tan�, tedavi veya ameliyat�  <nobr>"<span style="background-color:yellow" > Tan�/Tedavi <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> alan�na giriniz.<br>
 <b>Ad�m 7: </b>Alet hem�iresinin ad�n� <nobr>"<span style="background-color:yellow" > Alet hem�iresi�cap��: <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> field.<br>
 <b>Step 8: </b>�cap n�bet�isi hem�irenin ad�n� <nobr>"<span style="background-color:yellow" > �cap��: <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> alan�na gerekir ise giriniz.<br>
 <b>Ad�m 1: </b>Belgeyi kay�t etmek i�in  <input type="button" value="Kaydet"> d��mesini t�klay�n�z . <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belge listesi nas�l yazd�r�l�r?</b></font>
<ul> <b>Ad�m 1: </b>Yazd�rma penceresini a�mak i�in <input type="button" value="Yazd�r"> d��mesini t�klay�n�z.<br>
	<b>Ad�m 2: </b>Yazd�rma penceresindeki y�nergeleri izleyiniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belgeyi kay�t ettim ve kapatmak istiyorum. Ne yapmal�y�m? </b></font>
<ul> <b>Ad�m 1: </b>��iniz bitti ise <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z. <br>
</ul>
<?php endif ?>

</form>
</body>
</html>
