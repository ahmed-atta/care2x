<?php
$LDOr='Ameliyathane';
$LDLOGBOOK='GÜNLÜK';
$LDOrDocument='Ameliyathane Kayıtları';
$LDOrDocumentTxt='Ameliyat hizmetlerinin belgelendirilmesi';

/**
*  A tiny dictionary:
*  DOC = doctor on call duty
*  ORNOC = Operating room nurse on call duty
*  OP Room = operating room (surgery room)
*/
$LDDOC='Nöbetçi doktor';
$LDORNOC='Nöbetçi hemşire';
$LDScheduler='Nöbet planlama';

$LDQuickView='Hızlı bakış';
$LDQviewTxtDocs='Bugünkü nöbetçi doktor listesine hızlı bakış';
$LDOrLogBook='Ameliyathane hemşire günlüğü';
$LDOrLogBookTxt='Ameliyathane hemşirelik hizmetlerinin belgelendirilmesi, arşiv dosyaları';
$LDOrProgram='Ameliyathane programı';
$LDOrProgramTxt='Bir ameliyathane programını görüntüleme, düzeltme, oluşturma, vs.';
$LDQviewTxtNurse='Bugünkü hemşirelerin icap nöbetine hızlı bakış';
$LDDutyPlanTxt='Ameliyathane nöbetçi hemşire görüntüleme, düzeltme, oluşturma';
$LDOnCallDuty='İcap nöbeti';
$LDOnCallDutyTxt='Nöbetteki işi belgelendirme';
$LDAnaLogBook='Anestezi günlüğü';
$LDAnaLogBookTxt='Anestezi hizmetlerini belgelendirme, arşiv dosyaları';
$LDQviewTxtAna='Bugünkü anestezi teknisyen nöbetçilerine hızlı bakış';
$LDNewDocu='Yeni belge';
$LDSearch='Ara';
$LDArchive='Arşiv';
$LDSee='Bak';
$LDUpdate='Güncelle';
$LDCreate='Oluştur';
$LDCreatePersonList='Ameliyathane hemşire listesi oluştur';
$LDDoctor='Hekim/Cerrah';
$LDNursing='Hemşirelik';
$LDAna='Anestezi';

$LDClose='Kapat';
$LDSave='Kaydet';
$LDCancel='İptal';
$LDReset='Başa al';
$LDContinue='Devam...';

$LDHideCat='cati gizle';
$LDPatientsFound='Birkaç hasta bulundu!';
$LDPlsClk1='Lütfen doğru olanı tıklayınız.';
$LDShowCat='Cati görmek istiyorum lütfen!';
$LDResearchArchive='Arşivlerde arama';
$LDSearchDocu='Bir belgeyi arama';

$LDMinor='Küçük';
$LDMiddle='Orta';
$LDMajor='Büyük';
$LDOperation='Ameliyat';

$LDLastName='Soyad';
$LDName='Ad';
$LDBday='Doğum tarihi';
$LDPatientNr='Hasta no.';
$LDMatchCode='Kod adı';
$LDOpDate='Ameliyat tarihi';
$LDOperator='Cerrah';
$LDStationary='Yatan hasta';
$LDAmbulant='Ayaktan hasta';
$LDInsurance='Sigorta';
$LDPrivate='Özel sigorta';
$LDSelfPay='Ücretli';

$LDDiagnosis='Tanı/ICD-10';
$LDLocalization='Yeri';
$LDTherapy='Tedavi';
$LDSpecials='Özel not';
$LDClassification='Sınıflandırma';

/**
*  A tiny dictionary:
*  OP = operation (surgical operation)
*/
$LDOpStart='Ameliyata Başlama';
$LDOpEnd='Ameliyat Bitişi';
/**
*  A tiny dictionary:
*  Scrub nurse =  the nurse in sterile clothing assisting the surgeon, in charge of the sterile instruments and surgical materials
*/
$LDScrubNurse='Ameliyat hemşiresi';
$LDOpRoom='Ameliyathane';
$LDResetAll='Tüm girilenleri sil';
$LDUpdateData='Verileri güncelle';
$LDStartNewDocu='Yeni bir belge oluştur';
$LDSearchKeyword='Anahtar sözcük ara: örneğin ad veya soyad';

$LDSrcListElements=array(
'',
'Soyad',
'Ad',
'Doğum tarihi',
'Hasta no.',
'Ameliyat tarihi',
'Ameliyat bölümü',
'Amel. No.'
);
$LDClk2Show='Göstermek için tıklayınız';
$LDSrcCondition='Anhtar sözcük ve/veya koşul ara';
$LDNewArchiveSearch='Yeni arşiv arama';
$tage=array(
				'Pazar',
				'Pazartesi',
				'Salı',
				'Çarşamba',
				'Perşembe',
				'Cuma',
				'Cumartesi');
$monat=array('',
				'Ocak',
				'Şubat',
				'Mart',
				'Nisan',
				'Mayıs',
				'Haziran',
				'Temmuz',
				'Ağustos',
				'Eylül',
				'Ekim',
				'Kasım',
				'Aralık');
$LDPrevDay='Önceki gün';
$LDNextDay='Sonraki gün';
$LDChange='Değiştir';
$LDOpMainElements=array(
										nr_date=>'No/Tarih',
										patient=>'Hasta',
										diagnosis=>'Tanı',
										operator=>'Cerrah/Asistan',
										ana=>'Anestezi',
										cutclose=>'Kesi/Sütür',
										therapy=>'Tedavi',
										result=>'Sonuç',
										inout=>'Giriş/Çıkış'
										);
$LDOpCut='Kesi';
$LDOpClose='Sütür';
$LDOpIn='Giriş';
$LDOpOut='Çıkış';
$LDOpInFull='Giriş';
$LDOpOutFull='Çıkış';
$LDEditPatientData='~tagword~  günlük verisini düzenleme';
$LDOpenPatientFolder='~tagword~ hasta dosyasını açma';

$tbuf=array('O','A','H','P');
$cbuf=array('Operatör','Asistan','Hemşire','Personel');

/**
*  A tiny dictionary:
*  rotating nurse =  the nurse in non-sterile clothing assisting the scrub nurse, in charge of the non-sterile instruments and surgical materials
*/
$LDOpPersonElements=array(
											operator=>'Cerrah',
											assist=>'Asistan',
											scrub=>'Hemşire',
											rotating=>'Personel',
											ana=>'Anestezist'
											);

$LDPatientNotFound='Hasta bulunamadı!';
$LDPlsEnoughData='Lütfen yeterli bilgi giriniz.';
$LDOpNr='Amel. no.';
$LDDate='Tarih';
$LDClk2DropMenu='Menüyü açmak için tıklayınız';
$LDSaveLatest='Son girilenleri kaydet';
$LDHelp='Yardım penceresini aç';

$LDSearchPatient='Hasta arama';
$LDUsedMaterial='Kullanılan ameliyat malzemeleri';
$LDContainer='Kullanılmış kaplar/aletler';
$LDDRG='DRG';
$LDShowLogbook='Günlüğü göster';

/**
*  A tiny dictionary:
*  ITA = Intra Tracheal Anesthesia
*  ITN = Intratrachele Narkose (german)
*  LA =  Local anesthesia (locally injected or applied)
*  DS = Daemmerschlaf (a local dialect meaning analgesic sedation )
*  AS = Analgesic sedation (german = Analgosidierung)
*  Plexus = Anesthesia on the Plexus nerve 
*/

$LDAnaTypes=array(
					'ITN'=>'ITA',
					'ITN-Jet'=>'ITA-Jet',
					'ITN-Mask'=>'ITA-Mask',
					'LA'=>'LA',
					'DS'=>'DS',
					'AS'=>'AS',
					'Plexus'=>'Plexus',
					'Standby'=>'İcap'
					);

$LDAnaDoc='Anestezist';
$LDAnaPrefix='AN';
$LDEnterPerson='Yeni bir ~tagword~ giriniz';
$LDExtraInfo='Ek bilgi';
$LDFrom='den';
$LDTo='ye';
$LDFunction='İşlev';
$LDCurrentEntries='Şu an girilmiş olanlar';
$LDDeleteEntry='Girileni sil';
$LDSearchNewPerson='Yeni bir ~tagword~ ara';
$LDSorryNotFound='Üzgünüm. hiçbir şey bulamadım. Lütfen farklı bir anahtar sözcük deneyiniz.';
$LDSearchPerson=' ~tagword~ ara';
$LDJobId='Meslek';
$LDSearchResult='Arama sonuçları';
$LDUseData='Bu kişiyi  ~tagword~ olarak giriniz';
$LDJobIdTag=array(
						nurse=>'Hemşire',
						doctor=>'Hekim/Cerrah'
						);
$LDQuickSelectList='Hızlı seçme listesi';
$LDTimes='Zaman';
$LDPlasterCast='Alçı';
/**
*  Reposition = repositioning of bone dislocation or fracture
*/
$LDReposition='Repozisyon';
$LDWaitTime='Boş zaman';
$LDStart='Başlangıç';
$LDEnd='Bitiş';
$LDPatNoExist='Hasta heniz günlüğe girmedi. Lütfen bu pencereyi kapatınız ve en baştan başlayınız. Sorun sürer ise bilgi işlem bölümüne haber veriniz.';
$opts=array('-',
					'Hasta ameliyathaneye geç geldi',
       				'Anestezistler ameliyathaneye geç geldi',
       				'Ameliyat hemşireleri ameliyathaneye geç geldi', 
					'Temizlik ekibi geç bitirdi',
       				'Özel sebep');
$LDReason='Sebep';
$LDMaterialElements=array(
									'Eniyi.no.',
    								'Malz.ismi',
    								'&nbsp;',
    								'Jenerik',
    								'Lisans.No.',
    								'No.Pcs.',
    								'&nbsp;'
									);
$LDSearchElements=array(
									'&nbsp;',
									'Malz.no.',
    								'Malz.ismi',
    								'Tanımı',
 									'&nbsp;',
   									'Jenerik',
    								'Lisans.No.'
									);
$LDContainerElements=array(
									'Ambalaj no.',
    								'İsmi/Tanımı',
									'&nbsp;',
    								'Endüstri no.',
    								'Sipariş no.',
    								'No.pcs.',
    								'&nbsp;'
									);
$LDArticleNr='Malzeme no.';			
$LDContainerNr='Ambalaj no.';							
$LDArticleNotFound='Malzeme bulunamadı!';
$LDNoArticleTxt='Malzeme ya veritabanında yok ya da numarasını yanlış yazdınız.';
$LDClk2ManualEntry='Malzemeyi el ile girmek için lütfen , <b>burayı tıklayınız.</b>';
$LDPlsClkArticle='Lütfen istenilen malzemeyi tıklayınız!';
$LDSelectArticle='Bu malzemeyi seçmek için tıklayınız';
$LDDbInfo='Veritabanından bilgiler';
$LDRemoveArticle='Malzemeyi bu listeden çıkar';
$LDArticleNoList='Malzeme veritabanında yer almıyor';
$LDPromptSearch='Lütfen aranacak bir anahtar sözcük giriniz.<br>Ad, soyad, doğum tarihi, vs, gibi	("Yardım"a da bakınız)';
$LDKeyword='Anahtar sözcük';
$LDOtherFunctions='Diğer işlevler';
$LDInfoNotFound='İstenilen bilgi bulunamadı!';
$LDButFf='Fakat izleyen ';
$LDSimilar=' veri';
$LDSimilarMany=' veriler';
$LDNeededInfo=' Aranan anahtar sözcüğe benzer.';
$LDPatLogbook='Hasta izleyen günlükte belgelendirilmiş.';
$LDPatLogbookMany='Hasta izleyen kayıt kütüklerinde belgelendirilmiş.';
$LDDepartment='Bölüm';
$LDRoom='Oda';
$LDLastEntry='İzleyen kayıt günlüğün son kaydıdır';
$LDLastEntryMany='İzleyen kayıtlar günlükteki son kayıtlardır';
$LDFrom='den';
$LDFromMany='den';
$LDYesterday='dün';
$LDVorYesterday='2 gün önce';
$LDDays='gün önce';
$LDChangeDept='Bölüm veya ameliyathaneyi değiştir';

$LDTabElements=array('Ameliyathane bölümü',
								 'İcapçı',
								 'Çağrı/Telefon',
								 'Nöbetçi',
								 'Çağrı/telefon',
								 'Nöbet planı'
								 );
$LDStandbyPerson='İcapçı';
$LDOnCallPerson='Nöbetçi';
$LDMonth='Ay';
$LDYear='Yıl';
$LDDutyElements = array('Tarih','&nbsp;','Soyad', 'Ad','den','ya','Ameliyathane','Tanı ve tedavi');
$LDPrint='Yazdır';
$LDAlertNoPrinter='El ile yazdırmalısınız. Pencereyi sağ tuşla tıklayın, sonra yazdır ı seçiniz.';
$LDAlertNotSavedYet='Son yazdıklarınız henüz kaydedilmedi. Önce kaydetmek ister misiniz?';
$LDPhone='Telefon';
$LDBeeper='Çağrı';
$LDOn='üzerinde';
$LDNoPersonList='Personel listesi henüz oluşturulmadı Lütfen önce liste oluşturunuz.';
$LDNoEntryFound='Planda hiçbir kayıt bulunmadı!';
$LDShow='Göster';
$LDShowPrevLog='Önceki kütük kayıtlarını göster';
$LDShowNextLog='Sonraki kütük kayıtlarını göster';
$LDShowGuideCal='Rehber takvimi göster';

$LDPerformance='Performans';
/* 2002-10-13 EL */
$LDPlsSelectPatientFirst='Lütfen önce hastayı bulunuz.';
$LD_ddpMMpyyyy='gg.aa.yyyy';
$LD_yyyyhMMhdd='yyyy-aa-gg';
$LD_MMsddsyyyy='aa/gg/yyyy';
/* 2002-10-15 EL */
$LDStandbyInit='İ'; /* S = İcapçı */
$LDOncallInit='N'; /* N = Nöbetçi */
$LDDutyPlan='Nöbet planı';
/* 2003-03-18 EL */
$LDSearchInAllDepts='Tüm bölümlerde arama';
$LDAddNurseToList='Listeye yeni bir hemşire ekleme';
$LDNursesList='Hemşire listesi';
/* 2003-03-19 EL */
$LDPlsSelectDept='Lütfen bir bölüm seçiniz.';
$LDSelectORoomNr='...ve bir de ameliyathane.';
$LDAlertNoDeptSelected=$LDPlsSelectDept;
$LDAlertNoORSelected='Lütfen bir ameliyathane seçiniz!';
?>
