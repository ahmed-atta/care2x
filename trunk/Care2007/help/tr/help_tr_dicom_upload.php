<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Radyoloji - Dicom resimlerini yükleme

 </b>
 </font>
<p><font size=2 face="verana,arial" >
<form action="#" >

<?php
if(!$src){
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Dicom resimleri nasıl yüklenir?</b>
</font>
	
	<ul>       	
 	<b>Adım 1: </b>Resim ile ilgili vizit numarası var ise "<font color=#0000ff>İlgili vizit numarası</font>" alanına giriniz.<p>
 	<b>Adım 2: </b>Eğer kimlik veya ilgili belgeler var ise  "<font color=#0000ff>İlgili belgeler, kimlik</font>" alanına giriniz. Kimliği virgüllerle ayırınız.<p> 
 	<b>Adım 3: </b>Resimlerin kısa bir tanımını  "<font color=#0000ff>Notlar</font>" alanına yazınız.<p> 
 	<b>Adım 4: </b> Dosya seçme penceresini açmak için <input type="button" value="Tara"> button to düğmesini tıklayınız.<p> 
 	<b>Adım 5: </b>Resim dosyasını seçiniz.<p> 
 	<b>Adım 6: </b>Tüm resim dosyaları seçildiğinde yüklemeyi başlatmak için  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<p> 
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yüklenecek resim sayısı nasıl değiştirilir?</b>
</font>
	
	<ul>       	
 	<b>Uyarı: </b>Sayıyı herhangi bir veri girmeden, ya da resim dosyalarını seçmeye başlamadan belirleyiniz.<p> 
 	<b>Adım 1: </b>Sayıyı "Yüklemem gerekiyor <input type="text" name="d" size=3 maxlength=1 value=4>" alanına giriniz.<p>
 	<b>Adım 2: </b> "Git" i tıklayınız.<p> 
</ul>
<?php
}else{
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Başarılı bir yüklemeden sonra, yüklenmiş resimlerin durmunu nasıl kontrol edebilirim?</b>
</font>
	<ul>       	
 	<b>Uyarı: </b> Resimleri (tarayıcıya bağlı olarak) aynı pencerede izlemek için "<b>Resim Grubu #</b>" nun <img <?php echo createComIcon('../','torso.gif','0') ?>> simgesine tıklayınız.<p>
	<img src="../help/tr/img/tr_dicom_group_in.png" border=0 width=318 height=132><p> 
  	<b>Veya:</b> Yeni bir pencerede izlemek için "<b>Image Group #</b>" grubunun  <img <?php echo createComIcon('../','torso_win.gif','0') ?>> simgesine tıklayınız.<p>
	<img src="../help/tr/img/tr_dicom_group_ex.png" border=0 width=318 height=132> 
	 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Başarılı vir yüklemeden sonra, yüklenmiş her bir resmi ayry ayrı nasıl kontrol edebilirim?</b>
</font>
	<ul>       	
 	<b>Adım: </b>Resmi aynı pencerede (tarayıcıya bağlı) izlemek için  listedeki <img <?php echo createComIcon('../','torso.gif','0') ?>> simgesini tıklayınız.<p>
	<img src="../help/tr/img/tr_dicom_single_in.png" border=0 width=410 height=101><p> 
  	<b>Veya: </b>Bir resmi ayrı bir pencerede izlemek için listedeki <img <?php echo createComIcon('../','torso_win.gif','0') ?>> simgesini tıklayınız.<p>
	<img src="../help/tr/img/tr_dicom_single_ex.png" border=0 width=410 height=101>
	 
</ul>

<?php
}
?>

</form>

