<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "$x3 - $x2" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bekleme listesindeki bir hasta nas�l kabul edilir?</b></font>
<ul> <b>Ad�m 1: </b>Bekleme listesinde hastan�n ismini t�klay�n�z.<p>
<img src="../help/tr/img/tr_ambulatory_waitlist.png" border=0 width=301 height=156>
                                                                     <p>
		<b>Ad�m 2: </b>Servis yatan hasta listesini g�steren bir pencere a��l�r.<br>
		<b>Ad�m 3: </b>Hastaya verilecek yata��n <img <?php echo createLDImgSrc('../','assign_here.gif','0') ?>> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir yatak bir hastaya nas�l verilir?</b> (Eski y�ntem)</font>
<ul> 
<b>Uyar�: </b> Bu hastay� bir servise kabul etmenin eski y�ntemidir. G�ncel y�ntem i�in bekleme listesini kullan�n�z. Yukar�daki ad�mlara bak�n�z.<p>
<b>Ad�m 1: </b>�lgili oda numaras� ve yata��n <img <?php echo createComIcon('../','plus2.gif','0') ?>> d��mesini t�klay�n�z. 
                                                                     <br>
		<b>Ad�m 2: </b>Hasta aramak i�in bir pencere a��l�r.<br>
		<b>Ad�m 3: </b>�nce �e�itli giri� alanlar�ndan birine aranacak bir anahtar s�zc�k girerek hastay� bulunuz.<br>
		Hastay� ...<ul type="disc">
		<li>protokol numaras�na g�re bulmak ister iseniz <br>"<span style="background-color:yellow" >Protokol numaras�:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" alan�na numaray� giriniz.
		<li>soyad�na g�re bulmak ister iseniz <br>"<span style="background-color:yellow" >Soyad�:</span><input type="text" name="t" size=19 maxlength=10 value="Schmitt">" alan�na soyad�n� veya soyad�n�n ilk birka� harfini yaz�n�z.
		<li>ad�na g�re bulmak ister iseniz  <br>"<span style="background-color:yellow" >Ad�:</span><input type="text" name="t" size=19 maxlength=10 value="Peter">" alan�na ad�n� veya ad�n�n ilk birka� hharfini yaz�n�z.
		<li>do�um tarihine g�re bulmak isterseniz <br>"<span style="background-color:yellow" >Do�um tarihi:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">" alan�na do�um tarihini veya do�um tarihinin ilk birka� rakam�n� giriniz.
		</ul>
		<b>Ad�m 4: </b>Hastay� aramaya ba�lamak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 5: </b>E�er arama hastay� veya birka� hasta bulur ise bir hasta listesi g�r�nt�lenir.<br>
		<b>Ad�m 6: </b>Do�ru hastay� se�mek i�in hastan�n ilgili &nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> d��mesini t�klay�n�z.<br>
</ul>

<?php if((($src=="")&&($x1=="ja"))||(($src=="fresh")&&($x1=="template"))) : ?>


<font face="Verdana, Arial" size=2>
<a name="open"></a>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">Bir hastan�n �izelgeleri nas�l a��l�r?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Ad�m:</b> Hasta dosyas�n� a�mak i�in renkli �ubuklar� t�klay�n�z...<p>
<img src="../help/tr/img/tr_ambulatory_sbars.png" border=0 width=434 height=84><p>
<b>Veya:</b> Hasta dosyas�n� a�mak i�in  <img <?php echo createComIcon($root_path,'open.gif','0'); ?>> simgesini t�klay�n�z...<p>
<img src="../help/tr/img/tr_admission_folder.png" border=0 width=456 height=92>
</ul>
<a name="adata"></a>
<font face="Verdana, Arial" size=2>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">Bir hastan�n kay�t kabul bilgileri nas�l g�r�nt�lenir?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Ad�m:</b> Kabul bilgilerini g�r�nt�nt�lemek i�in <img <?php echo createComIcon($root_path,'pdata.gif','0'); ?>> simgesini t�klay�n�z...<p>
<img src="../help/tr/img/tr_admission_listlink.png" border=0 width=456 height=92><p>
<b>Veya:</b> Kabul bilgilerini g�r�nt�lemek i�in hastan�n soyad�n� t�klay�n�z.<p>
<img src="../help/tr/img/tr_ambulatory_name.png" border=0 width=434 height=84>
</ul>

<a name="transfer"></a>
<font face="Verdana, Arial" size=2>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">Bir hasta nas�l nakil edilir?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Ad�m:</b> Transfer penceresini a�mak i�in  <img <?php echo createComIcon($root_path,'xchange.gif','0'); ?>> simgesini t�klay�n�z.<p>
<img src="../help/tr/img/tr_admission_transfer.png" border=0 width=456 height=92>
</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hasta servisten nas�l ��kar�l�r?</b></font>
<ul> <b>Ad�m 1: </b>Hastan�n ilgili <img <?php echo createComIcon('../','bestell.gif','0') ?>> d��mesini t�klay�n�z.
                                                                     <p>
<img src="../help/tr/img/tr_admission_discharge.png" border=0 width=456 height=92><p>
		<b>Ad�m 2: </b>Hastan�n ��k�� formu g�r�nt�lenir.<br>
		<b>Ad�m 3: </b>Hastay� ��karaca��n�zdan emin iseniz, <br> 
		"<input type="checkbox" name="g" ><span style="background-color:yellow" > Evet, eminim. Hastay� ��kar.</span>" kutusunu i�aretleyiniz.<br>
       	<b>Ad�m 4: </b>Hastay� ��karmak i�in <input type="button" value="��kar"> d��mesini t�klay�n�z.<p>
       	<b>Uyar�: </b>�ptal etmek ister iseniz,  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> d��mesini t�klay�n�z. Hasta ��kar�lmaz.<br>
</ul>




<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir yatak nas�l kilitlenir?</b></font>
<ul> <b>Ad�m 1: </b>�lgili oda numaras� yata��n <img <?php echo createComIcon('../','plus2.gif','0') ?>> d��mesini t�klay�n�z.
                                                                     <br>
		<b>Ad�m 2: </b>Hasta aramak i�in bir pencere a��l�r.<br>
		<b>Ad�m 3: </b> "<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Bu yata�� kilitle</font> </span>" yi t�klay�n�z.<br>
		<b>Step 4: </b>Onay istendi�inde&nbsp;<button>Tamam</button> t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Listeden bir hastay� silmek istiyorum</b></font>
.<ul> <b>Uyar�: </b>Bir hastay� basit�e listeden S�LEMEZS�N�Z. Hastay� kurala uygun olarak ��karman�z gerekir. Bunu yapmak i�in, yukar�da a��klanan hastay� servisten ��karma y�nergelerini izleyiniz. <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bu  <img <?php echo createComIcon('../','s_colorbar.gif','0') ?>> renkli �ubuklar ne anlama geliyor? </b></font>
<ul> <b>Uyar�: </b>Bu renkli �ubuklar�n her biri "g�r�n�r" olduklar� zaman belirli bir bilginin, bir uyar�n�n, bir de�i�ikli�in veya bir sorgunun vs. varl���n� belirtirler.<br>
			Her servis i�in bir rengin anlam� ayarlanabilir. 
</ul>
<!-- <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bu simgenin <img <?php echo createComIcon('../','patdata.gif','0') ?>> anlam� ne? </b></font>
<ul> <b>Uyar�: </b>Bu hastan�n veri dosyas� d��mesidir. Hastan�n veri dosyas� klas�r�n� g�r�nt�lemek i�in, bu simgeyi t�klay�n�z. Hastan�n var ise resmi, ve birka� di�er se�ene�i i�eren hastan�n temel bilgilerini g�steren bir pencere a��l�r.<br>
</ul> -->
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bu simgenin  <img <?php echo createComIcon('../','bubble2.gif','0') ?>> anlam� nedir? </b></font>
<ul> <b>Uyar�: </b>Bu Oku/Yaz uyar� d��mesidir. Bu t�kland���nda hasta ile ilgili notlar� okumak veya yazmak i�in bir pencere a��l�r..<br>
			D�z <img <?php echo createComIcon('../','bubble2.gif','0') ?>> simgenin anlam� hen�z hasta hakk�nda yaz�lm�� bir not veya uyar� yok demektir. Bir not veya uyar� yazmak i�in bu simgeyi t�klay�n�z.
			 <img <?php echo createComIcon('../','bubble3.gif','0') ?>> simgesi hasta hakk�nda kay�tl� not veya uyar� bulundu�u anlam�na gelir. Not veya uyar�lar� okumak ya da eklemek i�in bu simgeyi t�klay�n�z.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bu simgenin <img <?php echo createComIcon('../','bestell.gif','0') ?>> anlam� nedir? </b></font>
<ul> <b>Uyar�: </b>Bu hasta ��karma d��mesidir. Bir hastay� ��karmak istedi�inizde hasta ��karma formunu a�mak i�in bunu t�klay�n�z.<br>
</ul>
<?php elseif(($src=="")&&($x1=="template")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<span style="background-color:yellow" >Hen�z bug�n�n listesi olu�turulmad� </span> yazar ise ne yapmal�y�m?</b></font>
<ul> <b>Ad�m 1: </b>Son kay�t edilmi� listeyi g�rmek i�in <input type="button" value="Son yatan hasta listesini g�ster"> d��mesini t�klay�n�z.
                                                                     <br>
		<b>Ad�m 2: </b>Son 31 g�n i�inde kay�t edilmi� bir liste var ise g�r�nt�lenir.<br>
		<b>Ad�m 3: </b> <input type="button" value="Bu listeyi bug�n i�in yine de kopyala."> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Son yatan hasta listesini g�rmek istemiyorum. Yeni bir liste nas�l olu�tururum?</b></font>
<ul> <b>Ad�m 1: </b>�lgili oda numaras� ve yata��n <img <?php echo createComIcon('../','plus2.gif','0') ?>> d��mesini t�klay�n�z.
                                                                     <br>
		<b>Ad�m 2: </b>Hasta aramak i�in bir pencere a��l��r.<br>
		<b>Ad�m 3: </b>�nce �e�itli giri� alanlar�ndan birine bir anahtar s�zc�k girip hastay� bulunuz.<br>
		Hastay�...<ul type="disc">
		<li>protokol numaras�na g�re aramak ister iseniz <br>"<span style="background-color:yellow" >Protokol no.:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" alan�na protokol numaras�n� veya ilk birka� rakam�n� yaz�n�z.
		<li>soyad�na g�re aramak ister iseniz, soyad�n� veya soyad�n�n ilk birka� harfini <br>"<span style="background-color:yellow" >Soyad�:</span><input type="text" name="t" size=19 maxlength=10 value="Potur">" alan�na yaz�n�z.
		<li>Ad�na g�re aramak ister iseniz ad�n� veya ad�n�n ilk birka� harfini <br>"<span style="background-color:yellow" >Ad�:</span><input type="text" name="t" size=19 maxlength=10 value="Ahmet">" alan�na yaz�n�z.
		<li>do�um tarihine g�re aramak ister iseniz, do�um tarihini veya ilk bir ka� rakam�n�  <br>"<span style="background-color:yellow" >Do�um tarihi:</span><input type="text" name="t" size=19 maxlength=10 value="10.08.1946">" alan�na yaz�n�z.
		</ul>
		<b>Ad�m 4: </b>Hastay� aramaya ba�lamak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 5: </b>E�er arama bir hasta veya birka� hasta bulur ise bir hasta listesi g�r�nt�lenir.<br>
		<b>Ad�m 6: </b>Do�ru hastay� se�mek i�in,ilgili &nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> d��mesini t�klay�n�z.<br>
</ul>
<?php elseif(($src=="getlast")&&($x1=="last")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
G�r�nt�lenen son yatan hasta listesi bug�nk� yatan hasta listesi olarak nas�l kopyalan�r?</b></font>
<ul> <b>Ad�m 1: </b>Son kay�tl� listeyi kopyalamak i�in  <input type="button" value="Bu listeyi bug�n i�in yine de kopyala."> d��mesini t�klay�n�z.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Son yatan hasta listesi g�r�nt�leniyor fakat onu kopyalamak istemiyorum. Yeni bir listeye nas�l ba�lar�m? </b></font>
<ul> <b>Ad�m 1: </b>Yeni liste olu�turmaya ba�lamak i�in  <input type="button" value="Bunu kopyalama! Yeni liste olu�tur."> d��mesini t�klay�n�z.
</ul>
<?php elseif($src=="assign") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir yatak bir hastaya nas�l verilir?</b></font>
<ul> <b>Ad�m 1: </b>�nce �e�itli giri� alanlar�ndan birine bir anahtar s�zc�k girip hastay� bulunuz.<br>
		Hastay�...<ul type="disc">
		<li>protokol numaras�na g�re aramak ister iseniz <br>"<span style="background-color:yellow" >Protokol no.:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" alan�na protokol numaras�n� veya ilk birka� rakam�n� yaz�n�z.
		<li>soyad�na g�re aramak ister iseniz, soyad�n� veya soyad�n�n ilk birka� harfini <br>"<span style="background-color:yellow" >Soyad�:</span><input type="text" name="t" size=19 maxlength=10 value="Potur">" alan�na yaz�n�z.
		<li>Ad�na g�re aramak ister iseniz ad�n� veya ad�n�n ilk birka� harfini <br>"<span style="background-color:yellow" >Ad�:</span><input type="text" name="t" size=19 maxlength=10 value="Ahmet">" alan�na yaz�n�z.
		<li>do�um tarihine g�re aramak ister iseniz, do�um tarihini veya ilk bir ka� rakam�n�  <br>"<span style="background-color:yellow" >Do�um tarihi:</span><input type="text" name="t" size=19 maxlength=10 value="10.08.1946">" alan�na yaz�n�z.
		</ul>
		<b>Ad�m 2: </b>Hastay� aramaya ba�lamak i�in <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> d��mesini t�klay�n�z.<br>
		<b>Ad�m 3: </b>E�er arama bir hasta veya birka� hasta bulur ise bir hasta listesi g�r�nt�lenir.<br>
		<b>Ad�m 4: </b>Do�ru hastay� se�mek i�in,ilgili &nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> d��mesini t�klay�n�z.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir yatak nas�l kilitlenir?</b></font>
<ul> <b>Ad�m 1: </b>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Bu yata�� kilitle</font> </span>" yaz�s�n� t�klay�n�z.<br>
		<b>Ad�m 2: </b>Onay istendi�i zaman &nbsp;<button>Tamam</button> � t�klay�n�z.<p>
</ul>
  <b>Uyar�: </b>�ptal etmek ister iseniz,  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> d��mesini t�klay�n�z.</ul>
  
<?php endif ?>

<?php if(($src!="assign")&&($src!="remarks")&&($src!="discharge")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Bu "<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Kilitli</font> </span>" simgesinin anlam� nedir? </b></font>
<ul> <b>Uyar�: </b>Bunun anlam� yatak kilitli bir hastaya verilemez demektir. Kilidini a�mak i�in "<span style="background-color:yellow" ><font color="#0000ff">Kilitli</font></span>" simgesini t�klay�n�z ve onay istenildi�i zaman &nbsp;<button>Tamam</button>
			se�iniz.<br>
 <b>Uyar�: </b>Program versiyonuna veya kurulum ayarlar�na ba��ml� olarak, kilitli bir yata��n a��lmas� �ifre gerektirebilir.</ul>

<?php endif ?>

<a name="pic"></a>
<font face="Verdana, Arial" size=2>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">Hastan�n kimlik foto�raf� nas�l g�sterilir?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Ad�m:</b> Ya  <img <?php echo createComIcon($root_path,'spf.gif','0'); ?>> veya  <img <?php echo createComIcon($root_path,'spm.gif','0'); ?>> simgesini t�klay�n�z.<p>
<img src="../help/tr/img/tr_ambulatory_sex.png" border=0 width=434 height=84>
</ul>


</form>

