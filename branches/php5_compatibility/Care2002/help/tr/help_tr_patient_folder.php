<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "Hasta Dosyas�" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bu renkli �ubuklar�n anlam� nedir? </b> <img <?php echo createComIcon('../','colorcodebar3.gif','0') ?> ></font>
<ul> <b>Uyar�: </b>"G�r�n�r" hale gelmi� bu renkli �ubuklar�n her biri belirli bir bilgi, uyar�, de�i�iklik, veya soru vs. nin varl���n� bildirirler.<br>
			Bir rengin anlam� her servis i�in ayr� d�zenlenebilir. <br>
			Sa�daki pembe renkli �ubuklar dizisi bir belirli bir y�nergenin uygulanaca�� yakla��k zaman� temsil eder.<br>
			�rne�in: alt�nc� pembe �ubu�un anlam� "alt�nc� saat" veya "saat 6.00" 22. renkli �ubuk "22.saat" veya "saat 22" anlam�na gelir.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
�zleyen bu d��meler nelerdir?</b></font>
<ul> <input type="button" value="Ate� �izelgesi">
	<ul>
		Bu hastan�n g�nl�k derece k���d� formunu a�ar. Forma ate� ve kan bas�nc� de�erlerini girer, d�zenler veya silebilirsiniz.<br>
		D�zenlenebilen ek veri alanlar� �unlard�r:
	<ul type="disc">
	<li>Allerji<br>
	<li>G�nl�k diyet plan�<br>
	<li>Ana tan�/tedavi<br>
	<li>g�nl�k tan�/tedavi<br>
	<li>Notlar, ek tan�lar<br>
	<li>Pt (Fizik tedavi), Atg (anti-tromboz jimnasti�i), vs.<br>
	<li>Antikoag�lanlar<br>
	<li>Anti koag�lanlar i�in g�nl�k kay�tlar<br>
	<li>Intraven�z tedavi, bandaj ve pansuman<br>
	<li>�ntraven�z ila�lar�n g�nl�k kayd�<br>
	<li>Notlar<br>
	<li>�la� listesi<br>
	<li>�la� ve dozlar�n��n g�nl�k kayd�<br>
	</ul>		
	</ul>
<input type="button" value="Hem�ire g�zlemi">
	<ul>
		Bu hem�ire g�zlem formunu a�ar. Hem�irelik �al��man�z�, etkinli�ini, g�zlemlerinizi, sorular� veya �nerileri vs belgelendirebilirsiniz.
	</ul>
	<input type="button" value="Doktor orderlar�">
	<ul>
	G�revli doktor buraya y�nergelerini, ila�, doz, hem�ire sorular�na yan�tlar veya de�i�iklik y�nergelerini, vs. girer.
	</ul>	
	<input type="button" value="Tetkik raporlar�">
	<ul>
	Burada farkl� tetkik klinik veya b�l�mlerinden gelen tetkik raporlar� saklan�r.
	</ul>	
<!-- 	<input type="button" value="Ana kay�t">
	<ul>
	Burada hastan�n ana kayd� ve ad, soyad vs gibi ki�isel bilgileri saklan�r. Bu ayn� zamanda hastan�n anamnez veya �yk�s�n�n ilk belgesidir. Her hem�irelik plan�n�n temelini olu�turur.
	</ul>	
	<input type="button" value="Hem�irelik  Plan�">
	<ul>
	Bu �zel hem�irelik plan�d�r. Plan� olu�urabilir, d�zenleyebilir ya da silebilirsiniz.
	</ul>	
 -->	
 <input type="button" value="T�G">
	<ul>
	Bu T�G (Tan� ile ilgili grup) birle�ik penceresini a�ar.
	</ul>	
 <input type="button" value="Laboratuvar Sonu�lar�">
	<ul>
	Burada hem biyokimya hem de patoloji laboratuvar sonu�lar� saklan�r.
	</ul>	
	<input type="button" value="Foto�raflar">
	<ul>
	Bu hastan�n foto�raf katalo�unu a�ar.
	</ul>	
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bu se�im kutusunun i�levi nedir </b>	<select name="d"><option value="">Tetkik istemini se�iniz</option></select>?
</font>
<ul>       	<b>Uyar�: </b>Bu belirli bir tetkik i�in istem formu se�er.<br>
 	<b>Ad�m 1: </b> <select name="d"><option value="">Tetkik istemi se�iniz</option></select> �zerine t�klay�n�z.
                                                                     <br>
		<b>Ad�m 2: </b>Se�ilen klinik, b�l�m veya tetkiki t�klay�n�z.<br>
		<b>Ad�m 3: </b>�stem formu otomatik olarak a��l�r.<br>
</ul>
<?php endif ?>

<?php if($src=="labor") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>�u anda tetkik sonucu yok. </b></font>
<ul> Hastan�n veri klas�r�ne d�nmek i�in  <input type="button" value="Tamam"> d��mesini t�klay�n�z.</ul>
<?php else  : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Hastan�n dosyas� nas�l kapat�l�r? </b></font>
<ul> <b>Uyar�: </b>E�er kapatmak ister iseniz,  <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.</ul>

<?php endif ?>

</form>
