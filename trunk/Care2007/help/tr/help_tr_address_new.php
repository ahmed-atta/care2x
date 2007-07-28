<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Adres yöneticisi - Yeni adres bilgisi</b></font>
<p>
<font size=2 face="verdana,arial" >


<a name="sel"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Forma ne doldurulacak?</b></font>
<ul>
	<b>Adım 1:</b> En azından zorunlu olan şehir ya da ilçe adını giriniz.<p>
	<b>Adım 2:</b> Eğer var ise, uygun alanlara ek bilgileri giriniz.<p>
	<b>Adım 3:</b> Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.
</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Devamlı olarak  "Save attempt to DB failed!" hata mesajını alıyorum ve bilgiler veritabanına kaydedilmiyor. Yanlış nerede?</b></font>
<ul>
Bu genellikle bir PostgreSQL veritabanı kullanır iken olur. En büyük olasılık "ISO Country Code" ülke kodu girdisini boş bırakmanızdan kaynaklanır.
	<p>
	<b>Adım 1:</b> Adresin ISO ülke kodunu doğru olarak giriniz<p>
	<b>Adım 2:</b> Eğer ISO ülke kodunu bilmiyor iseniz bir soru işareti, bir boşluk ya da "-na-" (not available-yok anlamında-) girebilirsiniz.<p>
	<b>Adım 3:</b> "ISO Ülke Kodu" girdisini asla boş bırakmayınız.<p>
</ul>
