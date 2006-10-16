<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
İntranet Eposta - 
<?php
	switch($src)
	{
	case "pass": switch($x1)
						{
							case "": print "Giriş";
												break;
							case "1": print "Yeni kullanıcı kaydı";
												break;
						}
						break;
	case "mail": switch($x1)
						{
							case "compose": print "Yeni eposta oluştur";
												break;
							case "listmail": print "Posta listesi";
												break;
							case "sendmail": print "Gönderilmiş posta";
												break;
						}
						break;
	case "read": print "Posta okuma";
						break;
	case "address": print "Adres defteri";
						break;

	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >

	

<?php if($src=="pass") : ?>
<?php if($x1=="") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Nasıl giriş yapılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>İntranet eposta adresinizi  ( @xxxxxx kısmı olmaksızın)  <nobr>"<span style="background-color:yellow" > Eposta adresiniz: </span>"</nobr> alanına yazınız.<br>
 	<b>Adım 2: </b>Alan kısmını <nobr>"<span style="background-color:yellow" > @<select name="d">
                                                                                          	<option value="Test Domain 1"> Test Domain 1</option>
                                                                                          	<option value="Test Domain 2"> Test Domain 2</option>
                                                                                          </select>
                                                                                           </span>"</nobr> alanlarından seçiniz.<br>
 	<b>Adım 3: </b>Girmek için <input type="button" value="Giriş"> düğmesini tıklayınız.<br>
</ul>

	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Henüz bir adresim yok. Nasıl yeni bir adres alabilirim?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> Kayıt formu açmak için "<span style="background-color:yellow" > Yeni kullanıcı buradan kayıt olabilir. <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>> </span>" bağlantısını tıklayınız.<br>
 	<b>Adım 2: </b>Daha çok bilgi için kayıt formundaki "Yardım" düğmesini tıklayabilirsiniz.<br>
</ul>
	<?php endif ?>		
	<?php if($x1=="1") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Nasıl kayıt olunur?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Soyad ve adınızı "<span style="background-color:yellow" > Soyad, Ad: </span>" alanına giriniz.<br>
 	<b>Adım 2: </b>Tercih ettiğiniz eposta adresini "<span style="background-color:yellow" > Seçilen eposta adresi: </span>" alanına giriniz.<p>
 	<b>Adım 3: </b>Alan kısmını <nobr>"<span style="background-color:yellow" > @<select name="d">
                                                                                          	<option value="Test Domain 1"> Test Domain 1</option>
                                                                                          	<option value="Test Domain 2"> Test Domain 2</option>
                                                                                          </select>
                                                                                           </span>"</nobr> alanından seçiniz.<br>
 	<b>Adım 4: </b>İstediğiniz takma ismi "<span style="background-color:yellow" > Takma isim: </span>" alanından seçiniz.<p>
 	<b>Adım 5: </b>Seçtiğiniz şifreyi "<span style="background-color:yellow" > Şifre seçiniz: </span>" alanına giriniz.<br>
 	<b>Adım 6: </b>Şifrenizi "<span style="background-color:yellow" > Şifrenizi tekrar giriniz: </span>" alanına tekrar giriniz.<br>
 	<b>Adım 7: </b>Kayıt olmak için <input type="button" value="Register"> düğmesini tıklayınız.<br>
</ul>

	<?php endif ?>		
<?php endif ?>	

<?php if($src=="mail") : ?>
<?php if($x1=="listmail") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir posta nasıl açılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Postanıı alıcısını, veya göndericisini, veya konusunu, veya tarihini veya simgelerini tıklayınız <img <?php echo createComIcon('../','c-mail.gif','0') ?>> or <img <?php echo createComIcon('../','o-mail.gif','0') ?>>.<br>
</ul>

	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Simgelerin anlamı <img <?php echo createComIcon('../','c-mail.gif','0') ?>> and <img <?php echo createComIcon('../','o-mail.gif','0') ?>> nedir?</b>
</font>
<ul>       	
 	<img <?php echo createComIcon('../','c-mail.gif','0') ?>> = Posta henüz okunmadı veya açılmadı. <br>
 	<img <?php echo createComIcon('../','o-mail.gif','0') ?>> = Posa önceden okundu veya açıldı. <br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Posta nasıl silinir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Seçmek için postanın kontrol kutusunu <input type="checkbox" name="a" value="s" checked> işaretleyiniz.<br>
 	<b>Adım 2: </b><input type="button" value="Sil"> düğmesini tıklayınız.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir klasörden diğer klasöre nasıl geçilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Klasörün ismini tıklayınız.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir posta nasıl yazılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> "<span style="background-color:yellow" > Yeni Email </span>" bağlantısını tıklayınız.<br>
</ul>
	<?php endif ?>		
	<?php if($x1=="compose") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni  mail nasıl yazılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> Alacak olanın email adresini "<span style="background-color:yellow" > Alıcı: </span>" alanına yazınız.<br>
 	<b>Adım 2: </b>Eğer bir başka kişiye kopyasını göndermek isterseniz onun email adresini "<span style="background-color:yellow" > Bilgi </span>" alanına yazınız.<br>
 	<b>Adım 3: </b>Adresinin belli olmasını istemediğiniz bir kişiye bir kopya göndermek isterseniz onun email adresini  "<span style="background-color:yellow" > Gizli </span>" alanına yazınız.<br>
 	<b>Adım 4: </b>Mesajınızın konusunu "<span style="background-color:yellow" > Konu: </span>" alanına yazınız.<br>
 	<b>Adım 5: </b>Şimdi mesajınızı metin alanına yazınız.<br>
 	<b>Adım 6: </b>Postayı göndermek için  <input type="button" value="Gönder"> düğmesini tıklayınız.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Maili bir taslak olarak saklamak istiyorum nasıl yapılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Mesajınızı metin kutusuna yazınız.<br>
 	<b>Adım 2: </b>Mesajınızı yazdıktan sonra, <input type="button" value="Taslak olarak kaydet"> düğmesini tıklayınız.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Adres defterimdeki email adreslerini doğrudan nasıl kullanırım?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>"Hızlı adresler" deki <input type="button" value="Hepsini göster"> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Küçük bir pencere açılır adres defteriniz görünür.<br>
 	<b>Adım 3: </b>Adresin ilgili düğmesini tıklayarak gerekli alana kopyalanmasını sağlayınız.<p>
<ul>   
		Adresi "Alıcı" alanına kopyalamak için  "Kime<input type="radio" name="t" value="a">" yi tıklayınız.<br>
		Adresi "Bilgi" alanına kopyalamak için "Bilgi<input type="radio" name="t" value="a">" yi tıklayınız.<br>
		Adresi "Gizli" alanına kopyalamak için "Gizli<input type="radio" name="t" value="a">" yi tıklayınız.<p>
</ul>
        <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <b>Uyarı:</b>  Eğer bir seçeneği baştan düzenlemek ister iseniz, ilgili <img <?php echo createComIcon('../','redpfeil.gif','0') ?>> simgesini tıklayınız.<br> 	
        <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <b>Uyarı:</b> Aynı anda birkaç adresi birden seçebilirsiniz.<p>
 	<b>Adım 4: </b>Seçilmiş adresleri oluşturulan maile kopyalamak için <input type="button" value="Taşı"> düğmesini tıklayınız.<br>
 	<b>Adım 5: </b>Açılmış penncereyi kapatmak için "<span style="background-color:yellow" > <img <?php echo createComIcon('../','l_arrowgrnsm.gif','0') ?>> Kapat </span>"
	 bağlantısıını tıklayınız.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bu "çabuk adres" de nedir?</b>
</font>
<ul>       	
 	<b>Uyarı: </b>"Çabuk adres" hafızasında saklı e-mail adresleri var ise ilk beşi "çabuk adres" olarak listelenir.<p>
 	<b>Adım 1: </b>Adresi koymak istediğiniz giriş alanını(yani kime:, veya bilgi:, veya gizli:)  odaklanmak için tıklayınız.<br>
 	<b>Adım 2: </b>"Çabuk adres" listesindeki adrese tıklayınız. Bu adres otomatik olarak daha önce tıkladığınız giriş alanına kopyalanır.<br>
</ul>

	<?php endif ?>		
<?php if(($x1=="sendmail")&&($x3=="1")) : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir email nasıl yazılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>"<span style="background-color:yellow" > Yeni Email </span>" linkini tıklayınız.<br>
</ul>
	<?php endif ?>		
<?php endif ?>	


<?php if($src=="read") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Email nasıl yazdırılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>"<span style="background-color:yellow" > Yazıcı sürümü <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>></span>"bağlantısını tıklayınız.<br>
 	<b>Adım 2: </b>E mailin yazıcı uyumlu görüntüsü yeni bir pencerede açılır.<br>
 	<b>Adım 3: </b>Yazdırmak için <span style="background-color:yellow" >  "Yazdır"  </span> seçeneğini tıklayınız.<br>
 	<b>Adım 4: </b>Yazıcı menüsü açılır. "Tamam" düğmesini tıklayınız.<br>
 	<b>Adım 5: </b>Yazıcı sürümü penceresini kapatmak için, "<span style="background-color:yellow" > < Kapat > </span>" seçeneğini tıklayınız.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Email nasıl tekrar gönderilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> <input type="button" value="Tekrar gönder"> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Gerekli ise email adreslerini düzenleyiniz.<br>
 	<b>Adım 3: </b>Emaili göndermek için <input type="button" value="Gönder"> düğmesini tıklayınız.
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir email nasıl iletilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> <input type="button" value="İlet"> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Alıcının adresini giriniz.<br>
 	<b>Adım 3: </b>Sonunda emaili göndermek için <input type="button" value="Gönder"> düğmesini tıklayınız.
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Email nasıl silinir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> <input type="button" value="Sil"> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Gerçekten emaili silmeyi isteyip istemediğiniz soruluur.<br>
 	<b>Adım 3: </b>Emaili sonunda silmak için  <input type="button" value="Tamam"> düğmesini tıklayınız.<p>
	<b>Uyarı:</b> "Gelen kutusu"ndan silinmiş emailler geçici olarak "silinmiş ögeler"de depolanırlar.
</ul>
	<?php endif ?>		
	
<?php if($src=="address") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Adres defterine bir email nasıl eklenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> <input type="button" value="Yeni email adresi ekle"> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Bir giriş formu görüntülenir "<span style="background-color:yellow" > Soyad, Ad: </span>" alanına ismi giriniz.<br>
 	<b>Adım 3: </b> "<span style="background-color:yellow" > Takma ad: </span>" alanına takma adı giriniz.<br>
 	<b>Adım 4: </b> "<span style="background-color:yellow" > Email adresi: </span>" alanına email adresini giriniz.<br>
 	<b>Adım 5: </b>Alanı <nobr>"<span style="background-color:yellow" > @<select name="d">
                                                                                          	<option value="Test Domain 1"> Test Domain 1</option>
                                                                                          	<option value="Test Domain 2"> Test Domain 2</option>
                                                                                          </select>
                                                                                           </span>"</nobr> test alanlarından seçiniz.<br>
 	<b>Adım 6: </b> <input type="button" value="Kaydet"> düğmesini tıklayınız.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Adres defterinden bir email adresi nasıl silinir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Silinecek adresin kutusunu <input type="checkbox" name="d" value="s" checked> işaretleyiniz.<br>
 	<b>Adım 2: </b> <input type="button" value="Sil"> düğmesini tıklayınız.<br>
 	<b>Adım 3: </b>Gerçekten silmeyi isteyip istemediğiniz sorulacak.<br>
 	<b>Adım 4: </b>Adresi sonunda silmek için <input type="button" value="Tamam"> düğmesini tıklayınız.<p>
</ul>
	<?php endif ?>		

	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Uyarı:</b>
</font>
<ul>       	
 	İntranet emailleri ve adresleri YALNIZCA intranet sistemi içerisinde çalışır internette kullanılamaz.<br>
</ul>
	</form>

