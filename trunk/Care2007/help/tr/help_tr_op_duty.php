<html>

<head>
<title></title>

</head>
<body>
<form >
<font face="Verdana, Arial" size=2>
<font  size=3 color="#0000cc">
<b>

<?php
	switch($src)
	{
		case "show": print "Hem�ire n�betleri - N�bet plan�";
							break;
		case "quick": print "Hem�ire n�betleri - H�zl� bak��";
							break;
		case "plan": print "Hem�ire n�betleri - N�bet plan� olu�tur";
							break;
		case "personlist": print "Personel listesi olu�tur";
							break;
		case "dutydoc": print "Hem�ire n�betleri - �cap n�betlerinde yap�lan i�in belgelendirilmesi";
							break;
	}
?>
</b>
</font>
<p>

<?php if($src=="quick") : ?>
<p><font color="#990000" face="Verdana, Arial">Burada ne yapabilirim?</font></b><p>
<font face="Verdana, Arial" size=2>
<img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>><b> N�bet�i hem�ireler hakk�nda (varsa) ek bilgi almak.</b>
<ul>Ek bilgiyi g�rmek i�in, listedeki ki�inin  <span style="background-color:yellow" >ismi</span> �zerine t�klay�n�z. K���k bir pencere a��l�r, ilgili bilgiler g�r�n�r.</ul><p>
<img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>><b> T�m ay�n n�bet plan�n� g�rmek.</b>
<ul>T�m ay�n n�bet plan�n� g�r�nt�lemek i�in, ilgili &nbsp;<button><img <?php echo createComIcon('../','new_address.gif','0','absmiddle') ?>> <font size=1>G�ster</font></button> simgesini t�klay�n�z.<br>
			N�bet plan� g�r�nt�lenir.</ul><p>
<font face="Verdana, Arial" size=3 color="#990000">
<p><b>H�zl� bak�� g�r�nt�s� neyi g�stermek istiyor?</b></font></b><p>
<font face="Verdana, Arial" size=2>
</b><li><b>Ameliyathane B�l�m</b> :<ul>�cap�� ve/veya n�bet�i doktor/cerrahlar� bulunan b�l�mlerin listesi.</ul><p>
<li><b>�cap�� </b> :<ul>�cap n�bet�isi hem�ire.</ul><p>
<li><b>�a�r�/Telefon</b> :<ul>�cap n�betindeki hem�irenin telefon ve �a�r� bilgisi.</ul>
<li><b>N�bet�i </b> :<ul>N�bet�i hem�ire.</ul><p>
<li><b>�a�r�/Telefon</b> :<ul>N�bet�inin �a�r� ve telefon bilgisi.</ul><p>
<li><b>N�bet plan�</b> :<ul>T�klanabilir simge. B�l�m�n b�t�n ayl�k n�bet plan�na ba�lant�. T�m ay�n n�bet plan�n� a�mak sonrada olu�turmak veya d�zenlemek ister iseniz&nbsp;<button><img <?php echo createComIcon('../','new_address.gif','0','absmiddle') ?>> <font size=1>G�ster</font></button>
			simgesini t�klay�n�z.</ul>

<?php endif ?>
<?php if($src=="show") : ?>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>G�r�nt�lenen ay i�in yeni bir n�bet plan� olu�turmak istiyorum</b></font>
<ul> <b>Ad�m 1: </b> <img <?php echo createLDImgSrc('../','newplan.gif','0') ?>> d��mesini t�klay�n�z.<br>
</ul>
<ul><b>Ad�m 2:</b>
 Daha �nce giri� yapt� iseniz ve i�leve eri�im hakk�n�z var ise, ana �er�evede n�bet plan�n� d�zenlemek i�in d�zenleme modu g�r�nt�lenir.<br>
		Yoksa, giri� yapmam�� iseniz, kullan�c� ad� ve �ifreniz sorulur. <p>
		Kullan�c� ad� ve �ifrenizi giriniz ve  <img <?php echo createLDImgSrc('../','continue.gif','0') ?>> d��mesini t�klay�n�z.<p>
		�ptal etmeye karar verir iseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z.

</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir ay i�in liste yapmak istiyorum fakag�r�nt�lenen liste bir ba�ka ay�n.</b></font>
<ul> <b>Ad�m 1: </b>�stedi�iniz aya ula��ncaya de�in t�klanabilir "Ay" a tekrar tekrar t�klay�n�z. <br>
								Ay� ilerletmek i�in sa�daki "ay" ba�lant�s�n� t�klay�n�z.<br>
								Ay� geri almak i�in soldaki "ay" ba�lant�s�n� t�klay�n�z.<br>
		<b>Ad�m 2: </b>Bir n�bet plan� olu�turmak konusundaki �nceki y�nergeleri izleyiniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>H�zl� bak��a geri gitmek istiyorum </b></font>
<ul> <b>Ad�m 1: </b> <img <?php echo createLDImgSrc('../','close2.gif','0') ?> > simgesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>N�bet�i hem�irelerin telefon ve �a�r� numaralar�n� g�rmek istiyorum </b></font>
<ul> <b>Ad�m 1: </b><span style="background-color:yellow" >Ki�inin ismini t�klay�n�z</span>.  �lgili bilgiyi g�steren k���k bir pencere a��l�r.<br>
</ul>


<b>Uyar�</b>
<ul> N�bet plan�n� kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z.
</ul>
<?php endif ?>
<?php if($src=="plan") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hem�ireler listesini kullanarak bir hem�ireyi n�bet i�in planlamak istiyorum</b></font>
<ul> <b>Ad�m 1: </b>Hem�ireler listesini a�mak i�in se�ilen g�n�n  &nbsp;<button><img <?php echo createComIcon('../','patdata.gif','0') ?>></button> d��mesini t�klay�n�z. <br>
			Hem�ireler listesini g�steren k���k bir pencere a��l�r.<br>
			<ul type=disc>
			<li>�cap�� n�beti yzamak i�in sol "icap��" s�tunundaki simgeyi t�klay�n�z.<br>
			<li>N�bet yazmak i�in sa�daki "n�bet" s�tunundaki simgeyi t�klay�n�z.
			</ul>
		<b>Ad�m 2: </b>N�bet plan�na kopyalamak i�in <span style="background-color:yellow" >hem�irenin ismini t�klay�n�z</span> .<br>
		<b>Ad�m 3: </b>Yanl�� isme t�klad� iseniz, ikinci ad�m� tekrarlay�p do�ru ismi t�klay�n�z.<br>
		<b>Ad�m 4: </b>��iniz bitti ise, hem�ire listesi penceresindeki <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�kay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
N�bet listesine hem�irenin ad�n� el ile girmek istiyorum</b></font>
<ul> <b>Ad�m 1: </b>Se�ilen g�n�n metin giri� alan�n� "<input type="text" name="t" size=11 maxlength=4 >" t�klay�n�z.<br>
		<b>Ad�m 2: </b>Hem�irenin ad�n� el ile yaz�n�z<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
N�bet plan�nda bir ismi silmek istiyorum</b></font>
<ul> <b>Ad�m 1: </b>Silinecek ismin metin giri� alan�na "<input type="text" name="t" size=11 maxlength=4 value="Name">" t�klay�n�z.<br>
		<b>Ad�m 2: </b>�smi klavyenin geri veya delete tu�unu kullanarak siliniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>N�bet plan�n� kay�t etmek istiyorum</b></font>
<ul> <b>Ad�m 1: </b> <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Plan� kay�t ettim ve planlamay� sonland�rmak istiyorum, ne yapmal�y�m? </b></font>
<ul> <b>Ad�m 1: </b>��iniz bitti ise, <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z. <br>
</ul>
</font>
<?php endif ?>
<?php if($src=="personlist") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
G�r�nt�lenen b�l�m yanl��. Do�ru b�l�me de�i�tirmek istiyorum.</b></font>
<ul> <b>Ad�m 1: </b>B�l�m� <nobr>"<span style="background-color:yellow" >B�l�m� veya ameliyathaneyi de�i�tir: </span><select name="s">
                                                                     	<option value="�rnek b�l�m 1" selected> �rnek b�l�m 1</option>
                                                                     	<option value="�rnek b�l�m 2"> �rnek b�l�m 2</option>
                                                                     	<option value="�rnek b�l�m 3"> �rnek b�l�m 3</option>
                                                                     	<option value="�rnek b�l�m 4"> �rnek b�l�m 4</option>
                                                                     </select>"</nobr> alan�ndan se�iniz.
                                                                     <br>
		<b>Ad�m 2: </b>Se�ilen b�l�m� de�i�tirmek i�in <input type="button" value="De�i�tir"> d��mesini t�klay�n�z.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Listede bir ismi silmek istiyorum</b></font>
<ul> <b>Ad�m 1: </b>Silinecek ismin metin giri� alan�na  "<input type="text" name="t" size=11 maxlength=4 value="�sim">" t�klay�n�z.<br>
		<b>Ad�m 2: </b>�smi klavyenin geri veya sil tu�lar�n� kullanarak el ile siliniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Personel listesini kay�t etmek istiyorum</b></font>
<ul> <b>Ad�m 1: </b> <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Listeyi kay�t ettim, kapatmak istiyorum, ne yapmal�y�m? </b></font>
<ul> <b>Ad�m 1: </b>��iniz bitti ise, <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z. <br>
</ul>
<?php endif ?>
<?php if($src=="dutydoc") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
N�bet saatlerinde yap�lan bir i� nas�l belgelendirilir?</b></font>
<ul> <b>Ad�m 1: </b>Tarihi "Tarih <input type="text" name="d" size=10 maxlength=10> " alan�na giriniz.<p>
	<ul> <b>�pucu: </b>Bug�n�n tarihini otomatik olarak girmek i�in  "t" veya "T" (TODAY=bug�n anlam�nda) giriniz.<br>
		<b>�pucu: </b>D�nk� tarihi utomatik olarak girmek i�in "y" veya "Y" (YESTERDAY=D�n anlam�nda) giriniz.<p>
		</ul>
		<b>Ad�m 2: </b>N�bet�i hem�irenin ad�n�  <nobr>"<span style="background-color:yellow" > Soyad, ad <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> alan�na giriniz.<br>
 <b>Ad�m 3: </b>��in ba�lang�� zaman�n�  "<span style="background-color:yellow" > ba�lama saati <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<br>
 <b>Ad�m 4: </b>��in birme saatini "<span style="background-color:yellow" > biti� saati <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<p>
	<ul> <b>�pucu: </b>�u andaki saati otomatik olarak girmek i�in "n" veya "N" (NOW=�imdi anlam�nda) giriniz.<p>
		</ul>
 <b>Ad�m 5: </b>Ameliyathane numaras�n�  "<span style="background-color:yellow" > Ameliyathane No <input type="text" name="d" size=5 maxlength=5> </span>" alan�na giriniz.<br>
 <b>Ad�m 6: </b>Tan�, tedavi veya ameliyat�  <nobr>"<span style="background-color:yellow" > Tan�/Tedavi <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> alan�na giriniz.<br>
 <b>Ad�m 7: </b>�cap hem�iresinin ismini <nobr>"<span style="background-color:yellow" > �cap: <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> alan�na giriniz.<br>
 <b>Ad�m 8: </b>N�bet�i hem�irenin ad�n� <nobr>"<span style="background-color:yellow" > N�bet�i: <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> alan�na giriniz.<br>
 <b>Ad�m 1: </b>Belgeyi kay�t etmek i�in <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z. <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belge listesi nas�l yazd�r�l�r?</b></font>
<ul> <b>Ad�m 1: </b> <img <?php echo createLDImgSrc('../','printout.gif','0') ?>>  d��mesini t�klay�n�z. Yazd�rma penceresi a��l�r.<br>
	<b>Ad�m 2: </b>Pencereyi yazd�rma y�nergelerini izleyiniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belgeyi kay�t ettim ve kapatmak istiyorum. Ne yapmal�y�m? </b></font>
<ul> <b>Ad�m 1: </b>��iniz bitti ise,  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> d��mesini t�klay�n�z. <br>
</ul>
<?php endif ?>

</form>
</body>
</html>
