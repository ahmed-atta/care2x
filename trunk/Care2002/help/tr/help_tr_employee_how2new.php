<font face="Verdana, Arial" size=3 color="#0000cc"><b>Personnel yönetimi</b></font><p>
<?php 
if(!$src&&!$x1){
?>
<font size=2 face="verdana,arial" >
<b>Bir kişi nasıl işe alınır</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<b>Adım 1</b>

<ul> 
<font color=#ff0000>Kişinin temel bilgilerinin önceden bulunup bulunmadığını kontrol ediniz</font>.<p>
		 Bir hastanın ad, soyad gibi bilgilerinden ya tamamını ya da birkaç harfini veya TC kimlik numarasını giriniz.
		<p>Örnek 1: "21000012" veya "12" giriniz.
		<br>Örnek 2:  "Potur" veya "pot" giriniz.
		<br>Örnek 3: "Bülent" veya "Bül" giriniz.
		
</ul>

<b>Adım 2</b>
<ul> Aramaya başlamak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düğmesini tıklayınız. 
</ul>

<b>Adım 3</b>
<ul> Arama sonunda hiç kimse bulunamaz ise, önce kişi kaydını girmek gerekir.  <img <?php echo createLDImgSrc('../','register_gray.gif','0') ?>>  düğmesine tıklayınız ve kişi kaydı için gereken yönergeleri izleyiniz.
</ul>
<b>Adım 4</b>
<ul> Eğer araştırma bir sonuç bulur ise yanındaki <img <?php echo createLDImgSrc('../','ok_small.gif','0') ?>> düğmesini tıklayarak listeden doğru kişiyi seçiniz.
</ul>
<b>Adım 5</b>
<ul> İşe alma formu görüntülenince, iş ile ilgili tüm bilgileri giriniz.<p>
		<img <?php echo createComIcon('../','warn.gif','0') ?>> Uyarı: Eğer bir kişi halen çalışmakta ise, onun bilgileri görüntülenecektir .
</ul>
<b>Adım 6</b>
<ul> 
	 Sicil bilgisini kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<p>
	
</ul>


<b>Uyarı</b>

<ul> Eğer bir bilgi eksik ise, bilgiler tekrar görüntülenir ve kırmızı ile işaretli alan(lar) daki bilgileri girmeniz istenir. Daha sonra tam bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<p>
</ul>

<b>Uyarı</b>
<ul> Eğer kaydı iptal etmeye karar verirseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
		
</ul>
</form>
<?php
}else{
?>

<font size=2 face="verdana,arial" >
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<?php
	if($src){
?>
<font color="#990000"><b>Çalışan sicil bilgisi nasıl güncellenir?</b></font>
<ul> 
	<b>Adım 1:</b> Uygun alanlara yeni bilgileri giriniz.<p>
	<b>Adım 2:</b> Güncellenmiş sicil bilgisini kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<p>
	<img <?php echo createComIcon('../','warn.gif','0') ?>> Uyarı: Güncellemeyi iptal etmeye karar verirseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php
	}else{
?>
<font color="#990000"><b>Kişi nasıl işe alınır?</b></font>
<ul> 
	<b>Adım 1:</b> Uygun alanlara sicil bilgisini giriniz.<p>
	<b>Adım 2:</b> Sicil bilgisini kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<p>
	<img <?php echo createComIcon('../','warn.gif','0') ?>> Uyarı: İptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php
	}
}
?>
