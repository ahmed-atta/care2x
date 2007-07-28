<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Tıbbi belge arşivleri nasıl araştırılır</b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="select") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Görüntülenen tıbbi belgeyi güncellemek istiyorum</b></font>
<ul> <b>Adım : </b>Belgeyi düzenlemeye başlamak için <input type="button" value="Veriyi güncelle"> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Arşivlerde yeni bir aramaya başlamak istiyorum</b></font>
<ul> <b>Adım : </b>Yeni aramaya başlamak için <input type="button" value="Arşivde yeni arama"> düğmesini tıklayınız.<br>
</ul>
<?php elseif(($src=="search")&&($x1)) : ?>
<b>Uyarı</b>
<ul><?php if($x1==1) : ?> Eğer arama bir tek sonuç bulur ise belgenin tümü derhal görüntülenir.<br>
		Ancak, arama birkaç sonuç bulur ise, bir liste görüntülenir.<br>
		<?php endif ?>
		Aradığınız hastanın bilgisini görmek için,  ya ilgili <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> düğmesini veya ad, veya soyad, veya kabul tarihini tıklayınız.
</ul>
<b>Uyarı</b>
<ul> Yeni bir aramaya başlamak ister iseniz <input type="button" value="Arşivde yeni arama"> düğmesini tıklayınız.
</ul>
<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir bölümün tüm tıbbi belgelerini listelemek istiyorum</b></font>
<ul> <b>Adım 1: </b>"Bölüm:" alanına bölümün kodunu giriniz. <br>
		<b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramaya başlamak için  <input type="button" value="Ara">  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belli bir hastanın belli bir tıbbi belgesini arıyorum</b></font>
<ul> <b>Adım 1: </b>İlgili alana anahtar sözcüğü giriniz. Tam bir sözcük veya cümle olabilir veya hastanın kişisel bilgilerinden bir sözcük , veya sözcüğün ilk bir kaç harfi olabilir. <br>
		<ul><font size=1 color="#000099" >
		<b>Şu alanlar bir anahtar sözcük ile doldurulabilir:</b>
		<br> Hasta numarası
		<br> Soyadı
		<br> Adı
		<br> Doğum tarihi
		<br> Adres
		</font>
		</ul><b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramaya başlamak için <input type="button" value="Ara">  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belli bir sigorta şirketinin tüm hastalarının tıbbi belgelerini listelemek istiyorum</b></font>
<ul> <b>Adım 1: </b>"Sigorta:" alanına sigorta şirketinin kısaltmasını giriniz. <br>
		<b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramaya başlamak için <input type="button" value="Ara">  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir ek sigorta bilgisi olan tüm tıbbi belgeleri listelemek istiyorum</b></font>
<ul> <b>Adım 1: </b>"Ek bilgi:" alanına anahtar sözcüğü giriniz. <br>
		<b>Adım 2: </b>Diğer tüm alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <input type="button" value="Ara">  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>ERKEK hastaların tüm tıbbi belgelerini listelemek istiyorum </b></font>
<ul> <b>Adım 1: </b>"<span style="background-color:yellow" >Cinsiyet <input type="radio" name="r" value="1">erkek</span>" seçim kutusunu tıklayınız. <br>
		<b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramaya başlamak için <input type="button" value="Ara">  düğmesini tıklayınız.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>KADIN hastaların tüm tıbbi belgelerini listelemek istiyorum </b></font>
<ul> <b>Adım 1: </b>"<span style="background-color:yellow" >Cinsiyet <input type="radio" name="r" value="1">kadın</span>" seçim kutusunu tıklayınız. <br>
		<b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramaya başlamak için <input type="button" value="Ara">  düğmesini tıklayınız.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Zorunlu tıbbi danışmanlık verilmiş tüm hastaları listelemek istiyorum</b></font>
<ul> <b>Adım 1: </b>"<span style="background-color:yellow" >Tıbbi danışmanlık: <input type="radio" name="r" value="1">Evet</span>" seçim kutusunu tıklayınız. <br>
		<b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramaya başlamak için <input type="button" value="Ara">  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Zorunlu tıbbi danışmanlık hizmeti almamış tüm hastaların tıbbi belgelerini listelemek istiyorum</b></font>
<ul> <b>Adım 1: </b> "<span style="background-color:yellow" ><input type="radio" name="r" value="1">Hayır</span>" seçim kutusunu tıklayınız. <br>
		<b>Adım 2: </bT>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramaya başlamak için <input type="button" value="Ara">  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir anahtar sözcüğü içeren tüm tıbbi belgeleri listelemek istiyorum</b></font>
<ul> <b>Adım 1: </b>İlgili alana anahtar sözcüğü giriniz. Tam bir sözcük, veya cümle olabilir, ya da bir sözcüğün ilk birkaç harfi olabilir. <br>
		<ul><font size=1 color="#000099" >
		<b>Örnek:</b> Tanı ile ilgili bir anahtar sözcüğü "Tanı" alanına giriniz.<br>
		<b>Örnek:</b> Sağaltım ile ilgili bir anahtar sözcüğü "Önerilen tedavi" alanına giriniz.<br>
		</font>
		</ul><b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramaya başlamak için <input type="button" value="Ara">  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir tarihte yazılmış tüm tıbbi belgeleri listelemek istiyorum</b></font>
<ul> <b>Adım: </b>Belge tarihini "Belgelendirildiği tarih:" alanına giriniz. <br>
		<ul><font size=1 color="#000099">
		<b>İpucu:</b> Bugünün tarihini otomatik olarak girmak için  "T" veya "t" giriniz.<br>
		<b>İpucu:</b> Dünün tarihini otomatik olarak girmek için "Y" veya "y" giriniz.<br>
		</font>
		</ul><b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramaya başlamak için <input type="button" value="Ara">  düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Belirli bir kişinin yazdığı tüm tıbbi belgeleri listelemek istiyorum.</b></font>
<ul> <b>Adım 1: </b>Yazan kişinin isminin tamamını ya da baştan birkaç harfini "Belgeyi yazan:" alanına giriniz. <br>
		<b>Adım 2: </b>Tüm diğer alanları boş bırakınız.<br>
		<b>Adım 3: </b>Aramayı başlatmak için <input type="button" value="Ara">  düğmesini tıklayınız.<br>
</ul>
<b>Uyarı</b>
<ul> Birkaç arama koşulunu birleştirebilirsiniz. Örneğin: Plastik cerrahide zorunlu tıbbi danışmanlık almış "lipo" ile başlayan tedavisi olan tüm Erkek hastaları listelemek isterseniz:<p>
		<b>Adım 1: </b>"Bölüm:" alanına "plop" giriniz. <br>
		<b>Adım 2: </b> "<span style="background-color:yellow" >Sex<input type="radio" name="r" value="1">erkek</span>" seçim kutusunu tıklayınız.<br>
		<b>Adım 3: </b> "<span style="background-color:yellow" >Tıbbi danışmanlık:<input type="radio" name="r" value="1">Evet</span>" kutusunu tıklayınız.<br>
		<b>Adım 4: </b>"Tedavi:" alanına" lipo giriniz. <br>
		<b>Adım 5: </b>Aramayı başlatmak için <input type="button" value="Ara">  düğmesini tıklayınız.<br>
</ul>
<b>Uyarı</b>
<ul> Arama bir tek belge bulur ise, tam belge derhal görüntülenir.<br>
		Ancak, arama birkaç sonuç bulur ise , bir liste görüntülenir.<br>
		Aradığınız hastanın belgesini açmak için, ya ilgili  <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> düğmesini, veya ad, soyad veya kabul tarihini tıklayınız.
</ul>

<?php endif ?>
<b>Uyarı</b>
<ul> Aramayı iptal etmek ister iseniz  <input type="button" value="Kapat"> düğmesini tıklayınız.
</ul>
</form>

