<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "$x3 - $x2" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bekleme listesindeki bir hasta nasıl kabul edilir?</b></font>
<ul> <b>Adım 1: </b>Bekleme listesinde hastanın ismini tıklayınız.<p>
<img src="../help/tr/img/tr_ambulatory_waitlist.png" border=0 width=301 height=156>
                                                                     <p>
		<b>Adım 2: </b>Servis yatan hasta listesini gösteren bir pencere açılır.<br>
		<b>Adım 3: </b>Hastaya verilecek yatağın <img <?php echo createLDImgSrc('../','assign_here.gif','0') ?>> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir yatak bir hastaya nasıl verilir?</b> (Eski yöntem)</font>
<ul> 
<b>Uyarı: </b> Bu hastayı bir servise kabul etmenin eski yöntemidir. Güncel yöntem için bekleme listesini kullanınız. Yukarıdaki adımlara bakınız.<p>
<b>Adım 1: </b>İlgili oda numarası ve yatağın <img <?php echo createComIcon('../','plus2.gif','0') ?>> düğmesini tıklayınız. 
                                                                     <br>
		<b>Adım 2: </b>Hasta aramak için bir pencere açılır.<br>
		<b>Adım 3: </b>Önce çeşitli giriş alanlarından birine aranacak bir anahtar sözcük girerek hastayı bulunuz.<br>
		Hastayı ...<ul type="disc">
		<li>protokol numarasına göre bulmak ister iseniz <br>"<span style="background-color:yellow" >Protokol numarası:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" alanına numarayı giriniz.
		<li>soyadına göre bulmak ister iseniz <br>"<span style="background-color:yellow" >Soyadı:</span><input type="text" name="t" size=19 maxlength=10 value="Schmitt">" alanına soyadını veya soyadının ilk birkaç harfini yazınız.
		<li>adına göre bulmak ister iseniz  <br>"<span style="background-color:yellow" >Adı:</span><input type="text" name="t" size=19 maxlength=10 value="Peter">" alanına adını veya adının ilk birkaç hharfini yazınız.
		<li>doğum tarihine göre bulmak isterseniz <br>"<span style="background-color:yellow" >Doğum tarihi:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">" alanına doğum tarihini veya doğum tarihinin ilk birkaç rakamını giriniz.
		</ul>
		<b>Adım 4: </b>Hastayı aramaya başlamak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 5: </b>Eğer arama hastayı veya birkaç hasta bulur ise bir hasta listesi görüntülenir.<br>
		<b>Adım 6: </b>Doğru hastayı seçmek için hastanın ilgili &nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> düğmesini tıklayınız.<br>
</ul>

<?php if((($src=="")&&($x1=="ja"))||(($src=="fresh")&&($x1=="template"))) : ?>


<font face="Verdana, Arial" size=2>
<a name="open"></a>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">Bir hastanın çizelgeleri nasıl açılır?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Adım:</b> Hasta dosyasını açmak için renkli çubukları tıklayınız...<p>
<img src="../help/tr/img/tr_ambulatory_sbars.png" border=0 width=434 height=84><p>
<b>Veya:</b> Hasta dosyasını açmak için  <img <?php echo createComIcon($root_path,'open.gif','0'); ?>> simgesini tıklayınız...<p>
<img src="../help/tr/img/tr_admission_folder.png" border=0 width=456 height=92>
</ul>
<a name="adata"></a>
<font face="Verdana, Arial" size=2>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">Bir hastanın kayıt kabul bilgileri nasıl görüntülenir?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Adım:</b> Kabul bilgilerini görüntüntülemek için <img <?php echo createComIcon($root_path,'pdata.gif','0'); ?>> simgesini tıklayınız...<p>
<img src="../help/tr/img/tr_admission_listlink.png" border=0 width=456 height=92><p>
<b>Veya:</b> Kabul bilgilerini görüntülemek için hastanın soyadını tıklayınız.<p>
<img src="../help/tr/img/tr_ambulatory_name.png" border=0 width=434 height=84>
</ul>

<a name="transfer"></a>
<font face="Verdana, Arial" size=2>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">Bir hasta nasıl nakil edilir?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Adım:</b> Transfer penceresini açmak için  <img <?php echo createComIcon($root_path,'xchange.gif','0'); ?>> simgesini tıklayınız.<p>
<img src="../help/tr/img/tr_admission_transfer.png" border=0 width=456 height=92>
</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hasta servisten nasıl çıkarılır?</b></font>
<ul> <b>Adım 1: </b>Hastanın ilgili <img <?php echo createComIcon('../','bestell.gif','0') ?>> düğmesini tıklayınız.
                                                                     <p>
<img src="../help/tr/img/tr_admission_discharge.png" border=0 width=456 height=92><p>
		<b>Adım 2: </b>Hastanın çıkış formu görüntülenir.<br>
		<b>Adım 3: </b>Hastayı çıkaracağınızdan emin iseniz, <br> 
		"<input type="checkbox" name="g" ><span style="background-color:yellow" > Evet, eminim. Hastayı çıkar.</span>" kutusunu işaretleyiniz.<br>
       	<b>Adım 4: </b>Hastayı çıkarmak için <input type="button" value="çıkar"> düğmesini tıklayınız.<p>
       	<b>Uyarı: </b>İptal etmek ister iseniz,  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız. Hasta çıkarılmaz.<br>
</ul>




<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir yatak nasıl kilitlenir?</b></font>
<ul> <b>Adım 1: </b>İlgili oda numarası yatağın <img <?php echo createComIcon('../','plus2.gif','0') ?>> düğmesini tıklayınız.
                                                                     <br>
		<b>Adım 2: </b>Hasta aramak için bir pencere açılır.<br>
		<b>Adım 3: </b> "<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Bu yatağı kilitle</font> </span>" yi tıklayınız.<br>
		<b>Step 4: </b>Onay istendiğinde&nbsp;<button>Tamam</button> tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Listeden bir hastayı silmek istiyorum</b></font>
.<ul> <b>Uyarı: </b>Bir hastayı basitçe listeden SİLEMEZSİNİZ. Hastayı kurala uygun olarak çıkarmanız gerekir. Bunu yapmak için, yukarıda açıklanan hastayı servisten çıkarma yönergelerini izleyiniz. <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bu  <img <?php echo createComIcon('../','s_colorbar.gif','0') ?>> renkli çubuklar ne anlama geliyor? </b></font>
<ul> <b>Uyarı: </b>Bu renkli çubukların her biri "görünür" oldukları zaman belirli bir bilginin, bir uyarının, bir değişikliğin veya bir sorgunun vs. varlığını belirtirler.<br>
			Her servis için bir rengin anlamı ayarlanabilir. 
</ul>
<!-- <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bu simgenin <img <?php echo createComIcon('../','patdata.gif','0') ?>> anlamı ne? </b></font>
<ul> <b>Uyarı: </b>Bu hastanın veri dosyası düğmesidir. Hastanın veri dosyası klasörünü görüntülemek için, bu simgeyi tıklayınız. Hastanın var ise resmi, ve birkaç diğer seçeneği içeren hastanın temel bilgilerini gösteren bir pencere açılır.<br>
</ul> -->
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bu simgenin  <img <?php echo createComIcon('../','bubble2.gif','0') ?>> anlamı nedir? </b></font>
<ul> <b>Uyarı: </b>Bu Oku/Yaz uyarı düğmesidir. Bu tıklandığında hasta ile ilgili notları okumak veya yazmak için bir pencere açılır..<br>
			Düz <img <?php echo createComIcon('../','bubble2.gif','0') ?>> simgenin anlamı henüz hasta hakkında yazılmış bir not veya uyarı yok demektir. Bir not veya uyarı yazmak için bu simgeyi tıklayınız.
			 <img <?php echo createComIcon('../','bubble3.gif','0') ?>> simgesi hasta hakkında kayıtlı not veya uyarı bulunduğu anlamına gelir. Not veya uyarıları okumak ya da eklemek için bu simgeyi tıklayınız.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bu simgenin <img <?php echo createComIcon('../','bestell.gif','0') ?>> anlamı nedir? </b></font>
<ul> <b>Uyarı: </b>Bu hasta çıkarma düğmesidir. Bir hastayı çıkarmak istediğinizde hasta çıkarma formunu açmak için bunu tıklayınız.<br>
</ul>
<?php elseif(($src=="")&&($x1=="template")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<span style="background-color:yellow" >Henüz bugünün listesi oluşturulmadı </span> yazar ise ne yapmalıyım?</b></font>
<ul> <b>Adım 1: </b>Son kayıt edilmiş listeyi görmek için <input type="button" value="Son yatan hasta listesini göster"> düğmesini tıklayınız.
                                                                     <br>
		<b>Adım 2: </b>Son 31 gün içinde kayıt edilmiş bir liste var ise görüntülenir.<br>
		<b>Adım 3: </b> <input type="button" value="Bu listeyi bugün için yine de kopyala."> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Son yatan hasta listesini görmek istemiyorum. Yeni bir liste nasıl oluştururum?</b></font>
<ul> <b>Adım 1: </b>İlgili oda numarası ve yatağın <img <?php echo createComIcon('../','plus2.gif','0') ?>> düğmesini tıklayınız.
                                                                     <br>
		<b>Adım 2: </b>Hasta aramak için bir pencere açılıır.<br>
		<b>Adım 3: </b>Önce çeşitli giriş alanlarından birine bir anahtar sözcük girip hastayı bulunuz.<br>
		Hastayı...<ul type="disc">
		<li>protokol numarasına göre aramak ister iseniz <br>"<span style="background-color:yellow" >Protokol no.:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" alanına protokol numarasını veya ilk birkaç rakamını yazınız.
		<li>soyadına göre aramak ister iseniz, soyadını veya soyadının ilk birkaç harfini <br>"<span style="background-color:yellow" >Soyadı:</span><input type="text" name="t" size=19 maxlength=10 value="Potur">" alanına yazınız.
		<li>Adına göre aramak ister iseniz adını veya adının ilk birkaç harfini <br>"<span style="background-color:yellow" >Adı:</span><input type="text" name="t" size=19 maxlength=10 value="Ahmet">" alanına yazınız.
		<li>doğum tarihine göre aramak ister iseniz, doğum tarihini veya ilk bir kaç rakamını  <br>"<span style="background-color:yellow" >Doğum tarihi:</span><input type="text" name="t" size=19 maxlength=10 value="10.08.1946">" alanına yazınız.
		</ul>
		<b>Adım 4: </b>Hastayı aramaya başlamak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 5: </b>Eğer arama bir hasta veya birkaç hasta bulur ise bir hasta listesi görüntülenir.<br>
		<b>Adım 6: </b>Doğru hastayı seçmek için,ilgili &nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> düğmesini tıklayınız.<br>
</ul>
<?php elseif(($src=="getlast")&&($x1=="last")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Görüntülenen son yatan hasta listesi bugünkü yatan hasta listesi olarak nasıl kopyalanır?</b></font>
<ul> <b>Adım 1: </b>Son kayıtlı listeyi kopyalamak için  <input type="button" value="Bu listeyi bugün için yine de kopyala."> düğmesini tıklayınız.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Son yatan hasta listesi görüntüleniyor fakat onu kopyalamak istemiyorum. Yeni bir listeye nasıl başlarım? </b></font>
<ul> <b>Adım 1: </b>Yeni liste oluşturmaya başlamak için  <input type="button" value="Bunu kopyalama! Yeni liste oluştur."> düğmesini tıklayınız.
</ul>
<?php elseif($src=="assign") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir yatak bir hastaya nasıl verilir?</b></font>
<ul> <b>Adım 1: </b>Önce çeşitli giriş alanlarından birine bir anahtar sözcük girip hastayı bulunuz.<br>
		Hastayı...<ul type="disc">
		<li>protokol numarasına göre aramak ister iseniz <br>"<span style="background-color:yellow" >Protokol no.:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" alanına protokol numarasını veya ilk birkaç rakamını yazınız.
		<li>soyadına göre aramak ister iseniz, soyadını veya soyadının ilk birkaç harfini <br>"<span style="background-color:yellow" >Soyadı:</span><input type="text" name="t" size=19 maxlength=10 value="Potur">" alanına yazınız.
		<li>Adına göre aramak ister iseniz adını veya adının ilk birkaç harfini <br>"<span style="background-color:yellow" >Adı:</span><input type="text" name="t" size=19 maxlength=10 value="Ahmet">" alanına yazınız.
		<li>doğum tarihine göre aramak ister iseniz, doğum tarihini veya ilk bir kaç rakamını  <br>"<span style="background-color:yellow" >Doğum tarihi:</span><input type="text" name="t" size=19 maxlength=10 value="10.08.1946">" alanına yazınız.
		</ul>
		<b>Adım 2: </b>Hastayı aramaya başlamak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 3: </b>Eğer arama bir hasta veya birkaç hasta bulur ise bir hasta listesi görüntülenir.<br>
		<b>Adım 4: </b>Doğru hastayı seçmek için,ilgili &nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir yatak nasıl kilitlenir?</b></font>
<ul> <b>Adım 1: </b>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Bu yatağı kilitle</font> </span>" yazısını tıklayınız.<br>
		<b>Adım 2: </b>Onay istendiği zaman &nbsp;<button>Tamam</button> ı tıklayınız.<p>
</ul>
  <b>Uyarı: </b>İptal etmek ister iseniz,  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.</ul>
  
<?php endif ?>

<?php if(($src!="assign")&&($src!="remarks")&&($src!="discharge")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bu "<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Kilitli</font> </span>" simgesinin anlamı nedir? </b></font>
<ul> <b>Uyarı: </b>Bunun anlamı yatak kilitli bir hastaya verilemez demektir. Kilidini açmak için "<span style="background-color:yellow" ><font color="#0000ff">Kilitli</font></span>" simgesini tıklayınız ve onay istenildiği zaman &nbsp;<button>Tamam</button>
			seçiniz.<br>
 <b>Uyarı: </b>Program versiyonuna veya kurulum ayarlarına bağımlı olarak, kilitli bir yatağın açılması şifre gerektirebilir.</ul>

<?php endif ?>

<a name="pic"></a>
<font face="Verdana, Arial" size=2>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">Hastanın kimlik fotoğrafı nasıl gösterilir?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Adım:</b> Ya  <img <?php echo createComIcon($root_path,'spf.gif','0'); ?>> veya  <img <?php echo createComIcon($root_path,'spm.gif','0'); ?>> simgesini tıklayınız.<p>
<img src="../help/tr/img/tr_ambulatory_sex.png" border=0 width=434 height=84>
</ul>


</form>

