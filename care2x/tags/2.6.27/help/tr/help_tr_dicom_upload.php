<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Radyoloji - Dicom resimlerini y�kleme

 </b>
 </font>
<p><font size=2 face="verana,arial" >
<form action="#" >

<?php
if(!$src){
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Dicom resimleri nas�l y�klenir?</b>
</font>
	
	<ul>       	
 	<b>Ad�m 1: </b>Resim ile ilgili vizit numaras� var ise "<font color=#0000ff>�lgili vizit numaras�</font>" alan�na giriniz.<p>
 	<b>Ad�m 2: </b>E�er kimlik veya ilgili belgeler var ise  "<font color=#0000ff>�lgili belgeler, kimlik</font>" alan�na giriniz. Kimli�i virg�llerle ay�r�n�z.<p> 
 	<b>Ad�m 3: </b>Resimlerin k�sa bir tan�m�n�  "<font color=#0000ff>Notlar</font>" alan�na yaz�n�z.<p> 
 	<b>Ad�m 4: </b> Dosya se�me penceresini a�mak i�in <input type="button" value="Tara"> button to d��mesini t�klay�n�z.<p> 
 	<b>Ad�m 5: </b>Resim dosyas�n� se�iniz.<p> 
 	<b>Ad�m 6: </b>T�m resim dosyalar� se�ildi�inde y�klemeyi ba�latmak i�in  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> d��mesini t�klay�n�z.<p> 
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Y�klenecek resim say�s� nas�l de�i�tirilir?</b>
</font>
	
	<ul>       	
 	<b>Uyar�: </b>Say�y� herhangi bir veri girmeden, ya da resim dosyalar�n� se�meye ba�lamadan belirleyiniz.<p> 
 	<b>Ad�m 1: </b>Say�y� "Y�klemem gerekiyor <input type="text" name="d" size=3 maxlength=1 value=4>" alan�na giriniz.<p>
 	<b>Ad�m 2: </b> "Git" i t�klay�n�z.<p> 
</ul>
<?php
}else{
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ba�ar�l� bir y�klemeden sonra, y�klenmi� resimlerin durmunu nas�l kontrol edebilirim?</b>
</font>
	<ul>       	
 	<b>Uyar�: </b> Resimleri (taray�c�ya ba�l� olarak) ayn� pencerede izlemek i�in "<b>Resim Grubu #</b>" nun <img <?php echo createComIcon('../','torso.gif','0') ?>> simgesine t�klay�n�z.<p>
	<img src="../help/tr/img/tr_dicom_group_in.png" border=0 width=318 height=132><p> 
  	<b>Veya:</b> Yeni bir pencerede izlemek i�in "<b>Image Group #</b>" grubunun  <img <?php echo createComIcon('../','torso_win.gif','0') ?>> simgesine t�klay�n�z.<p>
	<img src="../help/tr/img/tr_dicom_group_ex.png" border=0 width=318 height=132> 
	 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ba�ar�l� vir y�klemeden sonra, y�klenmi� her bir resmi ayry ayr� nas�l kontrol edebilirim?</b>
</font>
	<ul>       	
 	<b>Ad�m: </b>Resmi ayn� pencerede (taray�c�ya ba�l�) izlemek i�in  listedeki <img <?php echo createComIcon('../','torso.gif','0') ?>> simgesini t�klay�n�z.<p>
	<img src="../help/tr/img/tr_dicom_single_in.png" border=0 width=410 height=101><p> 
  	<b>Veya: </b>Bir resmi ayr� bir pencerede izlemek i�in listedeki <img <?php echo createComIcon('../','torso_win.gif','0') ?>> simgesini t�klay�n�z.<p>
	<img src="../help/tr/img/tr_dicom_single_ex.png" border=0 width=410 height=101>
	 
</ul>

<?php
}
?>

</form>

