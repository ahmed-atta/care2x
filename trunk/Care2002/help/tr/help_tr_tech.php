<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
		case "request": print "Onarım istemi";
							break;
		case "report": print "Onarım servisi onarıldı raporu";
							break;
		case "queries": print "Soru yada sorgu gönder";
							break;
		case "arch": print "Arşivde arama";
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
Onarım servisine nasıl istem gönderilir?</b></font>
<ul> <b>Adım 1: </b>Arızanın bulunduğu servisi  
<nobr>"<span style="background-color:yellow" > Arızanın yeri <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> alanına giriniz.<p>
<b>Adım 2: </b>İsminizi <nobr>"<span style="background-color:yellow" > İsteyen: <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> alanına giriniz.<br>
 <b>Adım 3: </b>Sicil numaranızı  <nobr>"<span style="background-color:yellow" > Personel no.: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> alanına giriniz.<br>
 <b>Adım 4: </b>Onarım bölümünün gerekirse isteminiz hakkında sorularını sorabileceği telefon numaranızı <nobr>"<span style="background-color:yellow" > Telefon no. <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> alanına giriniz.<p>
 <b>Adım 5: </b>Arızayı  <nobr>"<span style="background-color:yellow" > Lütfen arızayı betimleyiniz: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> alanında kısaca belirtiniz.<br>
 <b>Adım 6: </b>İsteminizi göndermek için <img <?php echo createLDImgSrc('../','abschic.gif','0') ?>> düğmesini tıklayınız. <br>
</ul>
<b>Uyarı</b>
<ul> Eğer istem formunu kapatmak isterseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php endif ?>
<?php if($src=="report") : ?>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Onarım tamamlandığı nasıl bildirilir?</b></font>
<ul> <b>Adım 1: </b>Arızanın yerini 
<nobr>"<span style="background-color:yellow" > arızanın yeri <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> alanına giriniz.<p>
<b>Adım 2: </b>İş kimlik numarasını <nobr>"<span style="background-color:yellow" > İş kimlik no.: <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> alanına giriniz.<br>
<b>Adım 3: </b>İsminizi <nobr>"<span style="background-color:yellow" > Teknisyen: <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> alanına giriniz.<br>
 <b>Adım 4: </b>Personel sicil numaranızı <nobr>"<span style="background-color:yellow" > Sicil no.: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> alanına giriniz.<br>
 <b>Step 5: </b>Yaptığınız onarım işini <nobr>"<span style="background-color:yellow" > Lütfen yaptığınız ınarım işini anlatınız: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> alanına yazınız.<br>
 <b>Step 6: </b>Raporunuzu göndermek için <input type="button" value="Raporu gönder"> düğmesini tıklayınız. <br>
</ul>
<b>Uyarı</b>
<ul> Formu kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php endif ?>
<?php if($src=="queries") : ?>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Teknik destek bölümüne bir soru veya sorgu nasıl gönderilir?</b></font>
<ul> <b>Adım 1: </b>Soru veya sorgunuzu <nobr>"<span style="background-color:yellow" > Lütfen sorunuzu yazınız: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> alanına giriniz.<br>
<b>Adım 2: </b>Adınızı <nobr>"<span style="background-color:yellow" > İsim: <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> alanına giriniz.<br>
 <b>Adım 3: </b>Bölümünüzü <nobr>"<span style="background-color:yellow" > Bölüm: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> alanına giriniz.<br>
 <b>Adım 4: </b>Sorunuzu göndermek için <input type="button" value="Gönder"> düğmesini tıklayınız. <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Daha önceki sorularımı ve teknik bölümün yanıtlarını nasıl görebilirim?</b></font>
<ul> <b>Adım 1: </b>Önce giriş yapmalısınız. İsminizi üst sağ köşedeki <nobr>"<span style="background-color:yellow" > kimden: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> alanına giriniz.<br>
 <b>Adım 2: </b><input type="button" value="Giriş"> düğmesini tıklayınız. <br>
 <b>Adım 3: </b>Daha önce soru göndermiş iseniz kısa formda listelenir.  <br>
 <b>Adım 4: </b>Sorunuz teknik bölümce yanıtlanmış ise, en sonda <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> simgesi görüntülenir. <br>
 <b>Adım 5: </b>Sorunuzu ve teknik bölümün yanıtını okumak için üzerine tıklayınız. <br>
</ul>
<b>Uyarı</b>
<ul> Soruyu kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php endif ?>
<?php if($src=="arch") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Teknik raporlar nasıl okunur?</b></font>
<ul> 
		<b>Uyarı: </b>Okunmamış veya yazdırılmamış teknik raporlar derhal listelenir.<p>
<b>Adım 1: </b>Açmak istediğiniz raporun <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>>  düğmesini tıklayınız. <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Belirli teknik raporlar nasıl aranır?</b></font>
<ul> <b>Adım 1: </b>Aşağıda açıklanan alanlara bir bilginin ya tamamını ya da ilk birkaç harfini giriniz.<br>
	<ul type=disc> 
	<li>Belirli bir teknisyenin yazdığı raporları bulmak ister iseniz teknisyenin ismini "<span style="background-color:yellow" > Teknisyen: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" alanına giriniz.<br>
	<li>Belirli bir bölümde yapılmış işlerin raporlarını bulmak ister iseniz, bölümün adını  "<span style="background-color:yellow" > Bölüm: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" alanına giriniz.<br>
	<li>Belirli bir tarihte yazılmış raporları bulmak ister iseniz  "<span style="background-color:yellow" > Başlangıç tarihi: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" alanına tarihi giriniz.<br>
	<li>Belirli bir dönemdeki tüm raporları bulmak ister iseniz  "<span style="background-color:yellow" > Başlangıç tarihi: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" alanına başlangıç tarihini, "<span style="background-color:yellow" > bitiş tarihi: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" alanına bitiş tarihini giriniz.<br>
	</ul>
 <b>Adım 2: </b>Aramayı başlatmak için  <input type="button" value="Ara"> düğmesini tıklayınız. <br>
<b>Adım 3: </b>Sonuçlar listelenir. Açmak istediiniz raporun <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>>  simgesini tıklayınız. <br>
	<b>Uyarı: </b> Teknik raporların <img <?php echo createComIcon('../','check-r.gif','0') ?>> ile işaretlenmiş olması daha önceden okunduğunu ya da yazdırıldığını gösterir.<p>

</ul>
</font>
<?php endif ?>
<?php if($src=="showarch") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Raporun okundu olarak işaretlenmesi.</b></font>
<ul> <b>Adım 1: </b> <input type="button" value=" 'Okundu' olarak işaretle"> düğmesini tıklayınız.<p>
	<b>Uyarı: </b>Bir rapor okundu olarak işaretlendiğinde, her arşiv aramasının başlangıcında otomatik olarak görüntülenmez. Ancak normal arşiv arama yöntemi ile tekrar bulunabilir.<p>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Raporun yazdırılması.</b></font>
<ul> <b>Adım 1: </b> <input type="button" value="Yazdır"> düğmesini tıklayınız.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arşiv aramasının başına nasıl geri gidilir?</b></font>
<ul> <b>Adım 1: </b> <input type="button" value="<< Geri git"> düğmesini tıklayınız.<p>
</ul>
<?php endif ?>
<?php if($src=="dutydoc") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Nöbet saatinde yapılmış bir iş nasıl belgelendirilir?</b></font>
<ul> <b>Adım 1: </b>Tarihi " Tarih <input type="text" name="d" size=10 maxlength=10> " alanına giriniz.<p>
	<ul> <b>Uyarı: </b>Bugünün tarihini otomatik olarak girmek için  "t" veya  "T" (TODAY=Bugün anlamında) giriniz.<br>
		<b>Uyarı: </b>Dünkü tarihi otomatik girmek için  "y" veya "Y" (YESTERDAY=Dün anlamında ) giriniz.<p>
		</ul>
		<b>Adım 2: </b>Nöbetçi hemşirenin adını  <nobr>"<span style="background-color:yellow" > Soyad, ad <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> alanına giriniz.<br>
 <b>Adım 3: </b>İş başlama saatini "<span style="background-color:yellow" > başlangıç saati <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<br>
 <b>Adım 4: </b>İş bitiş saatini "<span style="background-color:yellow" > bitiş saati <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<p>
	<ul> <b>İpucu: </b>Şu anki zamanı otomatik olarak girmek için  "n" veya "N" (NOW=Şimdi anlamında) giriniz.<p>
		</ul>
 <b>Adım 5: </b>Ameliyathane numarasını "<span style="background-color:yellow" > Ameliyathane <input type="text" name="d" size=5 maxlength=5> </span>" alanına giriniz.<br>
 <b>Adım 6: </b>Tanı, tedavi veya ameliyatı  <nobr>"<span style="background-color:yellow" > Tanı/Tedavi <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> alanına giriniz.<br>
 <b>Adım 7: </b>Alet hemşiresinin adını <nobr>"<span style="background-color:yellow" > Alet hemşiresiİcapçı: <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> field.<br>
 <b>Step 8: </b>İcap nöbetçisi hemşirenin adını <nobr>"<span style="background-color:yellow" > İcapçı: <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> alanına gerekir ise giriniz.<br>
 <b>Adım 1: </b>Belgeyi kayıt etmek için  <input type="button" value="Kaydet"> düğmesini tıklayınız . <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belge listesi nasıl yazdırılır?</b></font>
<ul> <b>Adım 1: </b>Yazdırma penceresini açmak için <input type="button" value="Yazdır"> düğmesini tıklayınız.<br>
	<b>Adım 2: </b>Yazdırma penceresindeki yönergeleri izleyiniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belgeyi kayıt ettim ve kapatmak istiyorum. Ne yapmalıyım? </b></font>
<ul> <b>Adım 1: </b>İşiniz bitti ise <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız. <br>
</ul>
<?php endif ?>

</form>
</body>
</html>
