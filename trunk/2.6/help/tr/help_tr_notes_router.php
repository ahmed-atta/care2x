<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo $x1 ?></b></font>

<p><font size=2 face="verdana,arial" >

<?php

if($x2=='show'||$src=='sickness'){
	if($x3){
	
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Kay�t bilgisi nas�l g�r�nt�lenir?</b></font>
<ul> 
<b>Ad�m: </b>   <img <?php echo createLDImgSrc('../','reg_data.gif','0') ?>> d��mesini t�klay�n�z.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Kabul bilgisi nas�l g�r�nt�lenir?</b></font>
<ul> 
<b>Ad�m: </b>   <img <?php echo createLDImgSrc('../','admission_data.gif','0') ?>> d��mesini t�klay�n�z.<p>
<b>Uyar�: </b> Bu d��me ancak hasta �u anda yatan hasta ya da poliklinik hastas� olarak kabul edilmi� durumda ise g�r�nt�lenir.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Rapor nas�l g�r�nt�lenir?</b></font>
<ul> 
<b>Ad�m: </b> <img <?php echo createComIcon('../','info3.gif','0') ?>> d��mesini t�klay�n�z.<p>
<b>Uyar�: </b> Bu d��me ancak rapor bilgisi �n izleme listesinde tamamen g�r�nt�lenmedi ide g�r�n�r.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Raporun PDF belgesi nas�l olu�turulur?</b></font>
<ul> 
<b>Ad�m: </b>   <img <?php echo createComIcon('../','pdf_icon.gif','0') ?>> d��mesini t�klay�n�z.<p>
</ul>

<?php
	}else{

		if($src=='sickness'){	
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>B�l�m nas�l de�i�tirilir?</b></font>
<ul> 
<b>Ad�m 1: </b> " <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> Form olu�tur" se�im kutusundan b�l�m� se�iniz.<p>
<b>Ad�m 2: </b> "Git" i t�klay�n�z.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Onay nas�l kaydedilir?</b></font>
<ul> 
<b>Ad�m: </b> <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Onay nas�l yazd�r�l�r?</b></font>
<ul> 
<b>Ad�m: </b> <img <?php echo createLDImgSrc('../','printout.gif','0') ?>> d��mesini t�klay�n�z.<p>
</ul>

<?php
		}elseif($src=='diagnostics'){
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Hen�z kay�tl� bilgi yok. Yeni bilgi nas�l girilir?</b></font>
<ul> 
<b>Uyar�: </b> Yeni tetkik sonu�lar� veya raporlar yaln�zca uygun laboratuvar veya tetkik mod�llerinden girilebilir. Kabul mod�l� "salt okunur" moddad�r.<p>
</ul>
<?php
		}elseif($src=='notes'){
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Hen�z yeni bilgi yok. Yeni bilgi nas�l girilir?</b></font>
<ul> 
<b>Ad�m: </b> " <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> <font color=#0000ff><b>Yeni kay�t gir</b></font>" ba�lant�s�n� t�klay�n�z.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Se�enekler men�s� geri nas�l g�r�nt�lenir?</b></font>
<ul> 
<b>Ad�m: </b> " <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> <font color=#0000ff><b>Se�eneklere geri</b></font>" ba�lant�s�n� t�klay�n�z.<p>
</ul>

<?php
		}else{
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Hen�z kay�tl� bilgi yok. Yeni bilgi nas�l girilir?</b></font>
<ul> 
<b>Ad�m: </b> " <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> <font color=#0000ff>Yeni kay�t gir</font>" ba�lant�s�n� t�klay�n�z.<p>
</ul>

<?php 
		}
	}
}else{
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Kay�t nas�l olu�turulur?</b></font>

<ul> 
<b>Ad�m: </b> Bilgiyi giriniz, sonra <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>>  d��mesini t�klay�n�z.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Tarih nas�l girilir?</b></font>
<ul> 
<b>Ad�m 1: </b> <img <?php echo createComIcon('../','show-calendar.gif','0') ?>>  simgesini t�klay�n�z, bir mini takvim a��l�r.<p>
<img src="../help/tr/img/tr_date_select.png"><p>
<b>Ad�m 2: </b> Mini takvimde tarihi t�klay�n�z.<p>
<img src="../help/tr/img/tr_mini_calendar.png"><p>
<b>Veya: </b> Bug�n� girmek i�in, tarih alan�na  "t" veya "T" giriniz. Bug�n�n tarihi otomatik olarak eklenir.<p>
<b>Veya: </b> D�nk� tarihi girmek i�in, tarih alan�na  "y" veya "Y" giriniz. D�nk� tarih otomatik olarak eklenir.<p>

</ul>
<?php 
}
?>
