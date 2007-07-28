<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo $x1 ?></b></font>

<p><font size=2 face="verdana,arial" >

<?php

if($x2=='show'||$src=='sickness'){
	if($x3){
	
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Kayıt bilgisi nasıl görüntülenir?</b></font>
<ul> 
<b>Adım: </b>   <img <?php echo createLDImgSrc('../','reg_data.gif','0') ?>> düğmesini tıklayınız.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Kabul bilgisi nasıl görüntülenir?</b></font>
<ul> 
<b>Adım: </b>   <img <?php echo createLDImgSrc('../','admission_data.gif','0') ?>> düğmesini tıklayınız.<p>
<b>Uyarı: </b> Bu düğme ancak hasta şu anda yatan hasta ya da poliklinik hastası olarak kabul edilmiş durumda ise görüntülenir.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Rapor nasıl görüntülenir?</b></font>
<ul> 
<b>Adım: </b> <img <?php echo createComIcon('../','info3.gif','0') ?>> düğmesini tıklayınız.<p>
<b>Uyarı: </b> Bu düğme ancak rapor bilgisi ön izleme listesinde tamamen görüntülenmedi ide görünür.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Raporun PDF belgesi nasıl oluşturulur?</b></font>
<ul> 
<b>Adım: </b>   <img <?php echo createComIcon('../','pdf_icon.gif','0') ?>> düğmesini tıklayınız.<p>
</ul>

<?php
	}else{

		if($src=='sickness'){	
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Bölüm nasıl değiştirilir?</b></font>
<ul> 
<b>Adım 1: </b> " <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> Form oluştur" seçim kutusundan bölümü seçiniz.<p>
<b>Adım 2: </b> "Git" i tıklayınız.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Onay nasıl kaydedilir?</b></font>
<ul> 
<b>Adım: </b> <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Onay nasıl yazdırılır?</b></font>
<ul> 
<b>Adım: </b> <img <?php echo createLDImgSrc('../','printout.gif','0') ?>> düğmesini tıklayınız.<p>
</ul>

<?php
		}elseif($src=='diagnostics'){
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Henüz kayıtlı bilgi yok. Yeni bilgi nasıl girilir?</b></font>
<ul> 
<b>Uyarı: </b> Yeni tetkik sonuçları veya raporlar yalnızca uygun laboratuvar veya tetkik modüllerinden girilebilir. Kabul modülü "salt okunur" moddadır.<p>
</ul>
<?php
		}elseif($src=='notes'){
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Henüz yeni bilgi yok. Yeni bilgi nasıl girilir?</b></font>
<ul> 
<b>Adım: </b> " <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> <font color=#0000ff><b>Yeni kayıt gir</b></font>" bağlantısını tıklayınız.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Seçenekler menüsü geri nasıl görüntülenir?</b></font>
<ul> 
<b>Adım: </b> " <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> <font color=#0000ff><b>Seçeneklere geri</b></font>" bağlantısını tıklayınız.<p>
</ul>

<?php
		}else{
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Henüz kayıtlı bilgi yok. Yeni bilgi nasıl girilir?</b></font>
<ul> 
<b>Adım: </b> " <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> <font color=#0000ff>Yeni kayıt gir</font>" bağlantısını tıklayınız.<p>
</ul>

<?php 
		}
	}
}else{
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Kayıt nasıl oluşturulur?</b></font>

<ul> 
<b>Adım: </b> Bilgiyi giriniz, sonra <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>>  düğmesini tıklayınız.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Tarih nasıl girilir?</b></font>
<ul> 
<b>Adım 1: </b> <img <?php echo createComIcon('../','show-calendar.gif','0') ?>>  simgesini tıklayınız, bir mini takvim açılır.<p>
<img src="../help/tr/img/tr_date_select.png"><p>
<b>Adım 2: </b> Mini takvimde tarihi tıklayınız.<p>
<img src="../help/tr/img/tr_mini_calendar.png"><p>
<b>Veya: </b> Bugünü girmek için, tarih alanına  "t" veya "T" giriniz. Bugünün tarihi otomatik olarak eklenir.<p>
<b>Veya: </b> Dünkü tarihi girmek için, tarih alanına  "y" veya "Y" giriniz. Dünkü tarih otomatik olarak eklenir.<p>

</ul>
<?php 
}
?>
