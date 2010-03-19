<?php 
require_once('../include/inc_date_format_functions.php');
 ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title></title>
</head>
<body>
<font face="Verdana, Arial" size=3 color="#000099"><b>Bir ki�iyi aramada ip u�lar�</b></font>
<p>
<img <?php echo createComIcon('../','warn.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
An�msamak �nemli!</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
Girdi�iniz her hangi bir s�zc�k bir bilginin olas� ba�lang�c� olarak kabul edilir. <p>
B�ylece, �rne�in "Can" girdi iseniz Care2x  "can" ile ba�layan t�m soyadlar� (veya adlar�) arar. Arama somucu olas�l�kla "Can", "Canan", "Caner" vs gibi isimleri de i�erir.
<p>
</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Bir ki�iyi en h�zl� bulman�n yolu nedir?</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Tam TC kimlik numaras� ile aray�n�z.
</blockquote>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Soyad ile nas�l aran�r?</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Soyad� veya ba�tan birka� harfini giriniz.
<li> "Ara" d��mesini t�klay�n�z.<br>
<img src="../help/tr/img/tr_search_fname.png">
<p>
</blockquote>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Arar iken ad neden dahil edilmeli?</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>E�er "Adlar� da ara" d��mesi g�r�n�yor ise etkinle�mesi i�in t�klanmas� gerekir. O zaman Care2x hem ad hem de soyadlar� aramaya zorlan�r. Yoksa (d��me i�aretlenmemi� ise) sadece soyadlar aran�r.
<br>
<img src="../help/tr/img/tr_search_radio.png">
</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Aramam� ni�in soyadlara s�n�rl� tutmal�y�m?</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Arama h�zl� olur.

</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Sadece ad ile HIZLI arama!</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Ad� yaz�n�z, bir bo�luk b�rak�n�z, sonra <b>*</b> yaz�n�z.
<br>
<img src="../help/tr/img/tr_search_quickfirst.png">

</blockquote>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Ad ve soyad ile arama.</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Ad� ve soyad� aralar�nda bo�luk b�rakarak yaz�n�z
<br>
<img src="../help/tr/img/tr_search_firstlast.png">
<p>
<img <?php echo createComIcon('../','warn.gif','0') ?>> Uyar�: �lk uyar� burada da ge�erlidir. Birinci ve ikinci adlar ad ve soyad�n ba�lang�c� olarak kabul edilir. B�ylece yukar�daki �rne�e g�re "Can Potuk", "Caner Potur", "Cansu Poturlu", vs. gibi isimler de bulunur.
</blockquote>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Soyad ve ada g�re arama.</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>�nce soyad, sonra ad yazarak aramak ister iseniz:
<li>�nce soyad� yaz�n�z, hemen biti�i�ine bir virg�l yaz�n�z, sonra bir bo�luk b�rak�n�z ve en sonuna ad yaz�n�z.
<br>
<img src="../help/tr/img/tr_search_lastfirst.png">
</blockquote>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
1 Kas�m 1967 (01.11.1967) de do�an ki�ileri aramak .</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>G�ncel tarih bi�iminize g�re do�um tarihini giriniz.
<br>
<img src="../help/tr/img/tr_search_fullbday.png">
</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
G�ncel tarih bi�imim nedir?</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>G�ncel tarih bi�iminiz: <font color="red"><?php echo $date_format.'</font>. Bug�n = ('.@formatDate2Local(date('Y-m-d'),$date_format).')'; ?>

</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
1947 de do�mu� t�m Ahmet Polat lar� aramak.</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Ad�, soyad�, do�um y�l�n� yaz�n�z
<br>
<img src="../help/tr/img/tr_search_firstlastyear.png">
</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
1989 da do�mu� t�m ki�ileri arama.</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li> *, bo�luk,  *, bo�luk, do�um y�l� yaz�n�z
<br>
<img src="../help/tr/img/tr_search_allyear.png">
</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
T�m 20 y�zy�lda do�mu� (1900-1999) Ahmet Potur lar� arama.</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>"ahmet", bo�luk, "potur", bo�luk, "19" yaz�n�z.
<br>
<img src="../help/tr/img/tr_search_firstlastcent.png">
</blockquote>


</body>
</html>
