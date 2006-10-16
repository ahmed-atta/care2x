<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Arşiv nasıl aranır</b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="select") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Görünen bilgileri güncellemek istiyorum</b></font>
<ul> <b>Adım : </b>Bilgileri düzenlemeye başlamak için <input type="button" value="Bilgi güncelle"> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Arşivde yeni bir arama başlatmak istiyorum</b></font>
<ul> <b>Adım : </b>Yeni bir arama başlatmak için <input type="button" value="Arşivde yeni arama"> düğmesini tıklatınız.<br>
</ul>
<?php elseif($src=="Ara") : ?>
<b>Uyarı</b>
<ul> Eğer aramada tek bir sonuç bulunur ise, bilginin tamamı derhal gösterilir.<br>
		Eğer, aramada bir kaç sonuç bulunur ise, bir liste görüntülenir.<br>
		Aradığınız hastanın bilgilerini görmek için ya ilgili  <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> simgesine ya da ad, soyad, veya kabul tarihi üzerine tıklayınız.
</ul>
<b>Uyarı</b>
<ul> Eğer yeni bir arama başlatmak isterseniz  <input type="button" value="Arşivde yeni arama"> düğmesini tıklayınız.
</ul>
<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bugün kabul edilen tüm hastaları listelemek istiyorum</b></font>
<ul> <b>Adım 1: </b>Bugünün tarihini "Kabul tarihi: Şu tarihten itibaren:" alanına giriniz. <br>
		<ul><font size=1 color="#000099">
		<b>İp ucu:</b> Otomatik olarak bugünün tarihinin girilmesi için  "B" veya "T" girebilirsiniz.<br>
		</font>
		</ul><b>Adım 2: </b>"ye kadar:" alanını boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için  <input type="button" value="ARA">  düğmesine tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>İki tarih arasında kaydedilmiş tüm hastaları listelemek istiyorum</b></font>
<ul> <b>Adım 1: </b>Başlangıç tarihini "Kabul tarihi: Şu tarihten itibaren:" alanına giriniz. <br>
		<ul><font size=1 color="#000099">
		<b>İpucu:</b> Bugünkü tarihin otomatik olarak yazılması için  "B" veya "T" giriniz.<br>
		<b>İpucu:</b> Dünkü tarihin otomatik yazılması için  "D" veya  "Y" giriniz.<br>
		</font>
		</ul><b>Adım 2: </b>Bitiş tarihini "şu tarihe kadar:" alanına giriniz.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <input type="button" value="ARA">  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Kabul edilmiş tüm erkek hastaları listelemek istiyorum</b></font>
<ul> <b>Adım 1: </b> "Cinsiyet <input type="radio" name="r" value="1"> seçenek düğmesinden erkek seçiniz". <br>
		<b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <input type="button" value="ARA">  düğmesini tıklatınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Kabul edilmiş tüm kadın hastaları listelemek istiyorum</b></font>
<ul> <b>Adım 1: </b> "Cinsiyet <input type="radio" name="r" value="1"> seçenek düğmesinden Kadın seçiniz". <br>
		<b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <input type="button" value="ARA">  düğmesini tıklatınız.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Polikliniğe kabul edilmiş tüm hastaları listelemek istiyorum </b></font>
<ul> <b>Adım 1: </b>Seçenek düğmesinden "<input type="radio" name="r" value="1">Ayaktan" seçiniz. <br>
		<b>Adım 2 : </b>Diğer alanların hepsini boş bırakınız.<br>
		<b>Adım 3: </b>Aramaya başlamak için <input type="button" value="ARA">  düğmesine tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Tüm yatan hastaları aramak istiyorum</b></font>
<ul> <b>Adım 1: </b> "<input type="radio" name="r" value="1">Yatan" düğmesine tıklayınız. <br>
		<b>Adım 2: </b>Diğer tüm alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için  <input type="button" value="ARA">  düğmesini tıklatınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Ücretli hastaları listelemek istiyorum </b></font>
<ul> <b>Adım 1: </b>"<input type="radio" name="r" value="1">Ücretli" düğmesini tıklayınız. <br>
		<b>Adım 2: </b>Diğer tüm alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için  <input type="button" value="ARA">  düğmesini tıklatınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Özel sigortalı tüm hastaları listelemek istiyorum </b></font>
<ul> <b>Adım 1: </b>"<input type="radio" name="r" value="1">Özel" düğmesini tıklayınız. <br>
		<b>Adım 2: </b>Diğer tüm alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için  <input type="button" value="ARA">  düğmesini tıklatınız.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Tüm genel sağlık sigortalı hastaları listelemek istiyorum </b></font>
<ul> <b>Adım 1: </b>"<input type="radio" name="r" value="1">Genel" düğmesini tıklayınız. <br>
		<b>Adım 2: </b>Diğer tüm alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için  <input type="button" value="ARA">  düğmesini tıklatınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir anahtar sözcüklü tüm hastaları aramak istiyorum.</b></font>
<ul> <b>Adım 1: </b>İlgili alana anahtar sözcüğü giriniz. Tüm bir sözcük veya bitkaç harf olabilir. <br>
		<ul><font size=1 color="#000099" >
		<b>Örnek:</b> Tanı anahtar sözcüğü için "Tanı" alanına giriniz.<br>
		<b>Örnek:</b> Gönderen anahtar sözcüğü için "Gönderen" alanına giriniz.<br>
		<b>Örnek:</b> Tedavi anahtar sözcüğü için "Önerilen tedavi" alanına giriniz.<br>
		<b>Örnek:</b> Özel notlar anahtar sözcüğü için "Özel notlar" alanına giriniz.<br>
		</font>
		</ul><b>Adım 2: </b>Tüm diğer alanları boş bırakınıız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <input type="button" value="ARA">  düğmesini tıklatınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belli anahtar sözcükleri olan belirli bir hastayı arıyorum</b></font>
<ul> <b>Adım 1: </b>İlgili alana anahtar sözcüğü giriniz. Tam bir sözcük ya da birkaç harf olabilir. <br>
		<ul><font size=1 color="#000099" >
		<b>Aşağıdaki alanlar bir anahtar sözcük ile doldurulabilir:</b>
		<br> Protokol numarası
		<br> Soyad
		<br> Ad
		<br> Doğum tarihi
		<br> Adres
		</font>
		</ul><b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <input type="button" value="ARA">  düğmesini tıklatınız.<br>
</ul>
<b>Uyarı</b>
<ul> Birkaç arama koşulunu birlikte kullanabilirsiniz. Örnek olarak: 10.12.1999 tarihi ile 24.01.2000 tarihleri arasında kabul edilmiş tüm ERKEK hastaları listelemek isterseniz:<p>
		<b>Adım 1: </b>"Kabul tarihi den itibaren" alanına "10.12.1999" giriniz. <br>
		<b>Adım 2: </b>"Ye kadar:" alanına "24.01.2000 giriniz.<br>
		<b>Adım 3: </b>Cinsiyet seçimi düğmesinden "Cinsiyet <input type="radio" name="r" value="1">male" erkek seçiniz. <br>
		<b>Adım 4: </b>Aramayı başlatmak için  <input type="button" value="ARA">  düğmesini tıklayınız.<br>
</ul>
<b>Uyarı</b>
<ul> Arama tek bir kayıt bulur ise o kayıtla ilgili bütün bilgi derhal görüntülenir.<br>
		Ancak arama birkaç sonuç bulur ise, bir liste görüntülenir.<br>
		Aradığınız hasta ile ilgili bilgiyi görmak için hastanın <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> düğmesini, veya ad, soyad, veya kabul tarihini tıklayınız.
</ul>

<?php endif ?>
<b>Uyarı</b>
<ul> Aramayı iptal etmek isterseniz <input type="button" value="Cancel"> düğmesini tıklayınız.
</ul>
</form>

