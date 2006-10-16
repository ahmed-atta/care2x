<?php
$LDDiagnosticTest='Tetkik İstemi';
$LDHospitalName='Care2x Hastanesi';
$LDCentralLab='Merkez Laboratuvarı';
$LDLabel='Etiket';
$LDRoomNr='Oda no.';
$LDSamplingTime='Örnek alma zamanı';
$LDDay='Gün';
$LDMinutes='Dakika';
$LDHours='Saat';
$LDBatchNr='Küme No.';
$LDCaseNr='Olgu numarası';
$LDHouse='Ev';
$LDHematology='Hematoloji';
$LDCoagulation='Pıhtılaşma';
$LDUrine='İdrar';
$LDSerum='Serum';
$LDGlucose='Glukoz';
$LD9Hour='9.00';
$LD15Hour='15.00';
$LDSober='ayık';
$LDBloodSugar='Kan Şekeri';
$LDBLoodSugar1='KŞ1';
$LDBloodPlasma='Plazma';
$LDDoctorSignature='Doktorun imzası';
$LDLifeRisk='Yaşam riski';
$LDRarity='yetersiz';
$LDSpecTest='özel tetkikler';
$LDClinicalInfo='klinik bilgi';
$LDShortMonth=array('',
                                   'Oca',
								   'Şub',
								   'Mar',
								   'Nis',
								   'May',
								   'Haz',
								   'Tem',
								   'Ağu',
								   'Eyl',
								   'Eki',
								   'Kas',
								   'Ara');
								   
$LDShortDay=array('Pz','Pt','Sa','Ça','Pe','Cu','Ct','Pz');
				
$LDBatchNumber='Küme no.';
$LDMaterial='Materyel:';
$LDEmergencyProgram='Mor gölgeli alanlar acil programına aittir';
$LDPhoneOrder=' = telefonla teyid edilmelidir';
/* 2002-09-03 EL */							  
$LDSearchPatient='Hasta arama';
$LDPlsSelectPatientFirst='Lütfen önce hastayı arayınız.';
/* 2002-09-11 EL */
$LDPendingTestRequest='Bekleyen tetkik istemi';
/* 2002-10-14 EL */
$LDDone='Bitti! Formu arşive taşı';

/* Note: the following array uses strict medical terminology.
*  If you are not sure about their translation, please leave the 
*  english word untranslated
*/
$LD_Elements = array('tx_1'=>'Biyokimya',
                                  'tx_2'=> 'Pıhtılaşma',
								  'tx_3'=> 'Proteinler',
								  'tx_4'=>'Tumor markerı',
								  'tx_5'=>'İntaniye.seroloji',
								  'tx_6'=>'Dahiliye',
								  'tx_7'=>'İdrar/Tam idrar.',
								  
                                  '_iof__x__iof_2_' => 'IOF',
                                  '_marcumar_tedavisi_' => 'Coumadin-Ted.',
								  '_emx_protein_total_' => 'total protein',
								  '_afp_' => 'AFP',
								  'tx_8' => 'Serum - BOS',
								  '_amiodaron_' => 'Amiodaron',
								  '_emx_urin_status_' => 'İdrar görünümü',
								  
								  '_aof_'=>'AOF',
								  '_heparin_tedavisi_'=>'Heparin ted.',
								  '_albumin_'=>'Albumin',
								  '_ca_15_3_'=>'CA 15-3',
								  '_antisstaf_titre_'=>'Antistaf.Titre',
								  '_barbiturates_i_s_'=>'Barbituratlar i.S.',
								  '_emx_urin_amilase_'=>'İdrar amilazı',
								  
								  '_preop_'=>'preop',
								  '_fibrinoliz_'=>'Fibrinoliz',
								  '_elfo_'=>'Elektroforez',
								  '_ca_19_9_'=>'CA 19-9',
								  '_adenovirus_antibody_'=>'Adenovirus-Antikoru',
								  '_benzodiazepam_i_s_'=>'Benzodiazep.i.S.',
								  '_urin_sugar_'=>'İdrarda Şeker',
								  
								  '_postop_'=>'postop',
								  '_emx_quick_'=>'Acil',
								  '_immune_fixation_'=>'Immune fixation',
								  '_ca_125_'=>'CA 125',
								  '_borrelias_antibody__x__borrelias_antibody_2_'=>'Borrelia-Antikoru',
								  '_carbmazepin_'=>'Carbamazepin',
								  '_proten_in_urine_'=>'İdrarda Protein',
								  
								  '_emx_serum_sugar_'=>'Serumda Glukoz',
								  '_emx_ptt_'=>'PTT',
								  '_beta2_microglobulin_i_s_'=>'Serumda ß2-µGlobulin',
								  '_cea_'=>'CEA',
								  '_borrelias_immunoblot__x__borrelias_immunoblot_2_'=>'Borr.Immunoblot',
								  '_clonazepam_'=>'Clonazepam',
								  '_albumin_in_urine_'=>'İdrarda Albumin',
								 
								  '_emx_bilirubin_total_'=>'Bilirubin, total',
								  '_emx_ptz_'=>'PTZ',
								  '_immunglobulin_quantity_'=>'Immu.glob.quant.',
								  '_cyfra_21_1_'=>'Cyfra 21-1',
								  '_brucellia_antibody_'=>'Brucella-Antikoru',
								  '_emx_digitoxin_'=>'Digitoxin',
								  '_emx_osmol_in_urine_'=>'Osmol İdrarda',
								  
								  '_bilirubin_direct_'=>'Bilirubin, direct',
								  '_emx_fibrinogen_'=>'Fibrinojen',
								  '_ige_'=>'IgE',
								  '_hcg_'=>'HCG',
								  '_campylob_antibody_'=>'Campylob.-Antikor',
								  '_emx_digoxin_'=>'Digoxin',
								  '_emx_pregnancy_'=>'Gebelik',
								  
								  '_emx_got_'=>'GOT',
								  '_emx_soluble_fibrinogen_mon_'=>'Solubl.Fibrino.mon',
								  '_haptoglobin_'=>'Haptoglobin',
								  '_nse_'=>'NSE',
								  '_candida_antibody_'=>'Candida-Antikoru',
								  '_gentamycin_'=>'Gentamisin',
								  '_cytomegaly_in_urine_'=>'Sitomeg. İdrarda',
								  
								  '_emx_gpt_'=>'GPT',
								  '_emx_fsp_dimer_'=>'FSP-dimer',
								  '_transferrin_'=>'Transferrin',
								  '_psa_'=>'PSA',
								  '_cardiotr_virus_'=>'Cardiotr.Virus',
								  '_lithium_'=>'Lithium',
								  '_urine_cytology_'=>'İdrar sitolojisi',
								  
								  '_gamma_gt_'=>'gamma GT',
								  '_emx_thrombos_coagulation_'=>'Pıhtılaşma',
								  '_ferritin_'=>'Ferritin',
								  '_scc_'=>'SCC',
								  '_chamydia_smear_'=>'Klamidya-Yayma',
								  '_phenobarbital_'=>'Fenobarbital',
								  '_bence_jones_'=>'Bence Jones',
								  
								  '_alkalic_ph_'=>'Alk.Fos.',
								  '_emx_at_3_'=>'AT III',
								  '_coeroplasmin_'=>'Coeroplasmin',
								  '_tpa_'=>'TPA',
								  '_chlamydia_antibody_'=>'Klamidya-Antikoru',
								  '_phenytoin_'=>'Fenitoin',
								  '_urine_elpho_'=>'İdrar elektroforezi',
								  
								  '_ldh_'=>'LDH',
								  '_factor_8_'=>'Faktor VIII',
								  '_alpha_1_antitrypsin_'=>'alfa-1 Antitripsin',
								  'tx_9'=>'Doku antikoru',
								  '_c_psitacci_antibody_'=>'C.psitacci-Antikoru',
								  '_primidon_'=>'Primidon',
								  '_beta_2_microglobulin_in_urine_'=>'İdrarda ß2 Mikroglob.',
								  
								  '_hbdh_'=>'HBDH',
								  '_apc_resistance_telx_'=>'APC-Rezistan.',
								  '_afp_gravida_'=>'AFP Gebelikte',
								  '_ana_'=>'ANA',
								  '_coxsacky_antibody_'=>'Koksaki-Antikoru',
								  '_salicylic_acid_'=>'Salisilik asit',
								  'tx_10'=>'Toplanmış idrar',
								  
								  'emx_cpk_'=>'CPK',
								  '_protein_c_telx_'=>'Protein C',
								  '_ssw_'=>'Gebelik',
								  '_ama_'=>'AMA',
								  '_q_fever_antibody_'=>'Q-Ateşi-Antikoru',
								  '_theophyllin_'=>'Teofilin',
								  '_urine_collected_'=>'Toplanmış-',
								  
								  '_emx_ckmb_'=>'CKMB',
								  '_protein_s_telx_'=>'Protein S',
								  '_alpha_1_microglobulin_'=>'alfa-1 µglobulin',
								  '_dns_antibody_'=>'DNS-Antikoru',
								  '_cytomegaly_antibody_'=>'Cytomegalo-Antikoru',
								  '_tobramycin_'=>'Tobramisin',
								  '_urine_volume_'=>'hacmi:ml.',
								  
								  '_emx_myoglobin_'=>'Myoglobin',
								  '_bleeding_time_telx_'=>'Kanama zamanı',
								  'tx_11'=>'Tiroid bezi',
								  '_asma_'=>'ASMA',
								  '_ebv_antibody__x__ebv_antibody_2_'=>'EBV-Antikoru',
								  '_valproin_acid_'=>'Valproik asit',
								  '_addis_count_'=>'Addis-Sayımı',
								  
								  '_emx_troponin_t_'=>'Troponin-T',
								  'tx_12'=>'Hematoloji',
								  '_t3_'=>'T3',
								  '_ena_'=>'ENA',
								  '_echinococcus_antibody_'=>'Ekinokok-Antikoru',
								  '_vancomycin_'=>'Vankomisin',
								  '_sodium_in_urine_'=>'Sodyum İdrarda',
								  
								  '_emx_cholinesterase_'=>'Kolinesteraz',
								  '_emx_minor_blood_test_'=>'Kell. kanda',
								  '_thyroxin_T4_'=>'Tiroksin/T4',
								  '_anca_'=>'ANCA',
								  '_echo_virus_antibody_'=>'Echo-Virus Antikoru',
								  '_empty_'=>'',
								  '_kalium_in_urine_'=>'potasyum idrarda ',
								  
								  '_gldh_'=>'GLDH',
								  '_diff_minor_blood_test_'=>'Tam kan.+ minör.Kan Testi',
								  '_tsh_basal_'=>'TSH-basal',
								  'tx_13'=>'Romatizma faktörleri',
								  '_fsme_antibody__x__fsme_antibody_2_'=>'FSME-Antikoru',
								  '_emx_drugscreen_in_urine_'=>'İdrarda ilaç tarama',
								  '_calcium_in_urine_'=>'Kalsiyum İdrarda',
								  
								  '_chol_'=>'Kolestrol',
								  '_reticulocytes_'=>'Retikülosit',
								  '_tsh_stimulation_'=>'TSH-stimülasyon.',
								  '_anti_strepto_titer_'=>'Anti-Strepto-Titresi',
								  '_herpes_simplex_1_antibody_'=>'Herpes sim.1-Antikor',
								  '_amphetamine_in_urine_'=>'Amfetamin İdrarda',
								  '_phospor_in_urine_'=>'Fosfor İdrarda',
								  
								  '_tri_'=>'Tri',
								  '_kemik _iliği_diff_telx_'=>'K.iliği+Ayrıntılı.',
								  '_tak_'=>'TAK',
								  '_lat_rf_'=>'Lat.RF',
								  '_herpes_simplex_2_antibody_'=>'Herpes sim.2-Antikor',
								  '_antidepressant_in_urine_'=>'Antidepresan İdrarda',
								  '_uric_acid_in_urine_'=>'ürik asit idrarda ',
								  
								  '_hdl_chol_'=>'HDL-Chol',
								  '_malaria_'=>'Sıtma',
								  '_mak_'=>'MAK',
								  '_streptocyme_'=>'Streptozim',
								  '_hiv1_hiv2_antibody_'=>'HIV1/HIV2-Antikoru',
								  '_barbiturates_in_urine_'=>' Barbitürat.',
								  '_creatinin_in_urine_'=>'Kreatinin idrarda',
								  
								  '_ldl_chol_'=>'LDL-Kolest.',
								  '_hb_elpho_'=>'Hb-Elektroforez',
								  '_trak_'=>'TRAK',
								  '_waaler_rose_'=>'Waaler Rose',
								  '_influenza_a_antibody_'=>'Influenza A-AB',
								  '_benzodiazepam_in_urine_'=>'Benzodiazep.İdrarda',
								  '_porphyrine_in_urine_'=>'Porfirin İdrarda',
								  
								  '_lipid_elpho_'=>'Lipid-Elektroforez',
								  '_hla_b_27_telx_'=>'HLA-B 27',
								  '_thyreoglobulin_'=>'Tireoglobulin',
								  'tx_14'=>'Hepatit',
								  '_influenza_b_antibody_'=>'Influenza B-Antikor',
								  '_cannabinol_in_urine_'=>'Kannabinol İdrarda',
								  '_cortisol_in_urine_'=>'Kortizol İdrarda',
								  
								  '_lipase_'=>'Lipaz',
								  '_thrombo_antibody_telx_'=>'Trombo-Antikor',
								  '_thyroxinbinding_globulin_'=>'Tiroksin bağlayıcı Glob.',
								  '_anti_hav_'=>'Anti-HAV',
								  '_lcm_antibody_'=>'LCM-Antikor',
								  '_cocain_in_urine_'=>'Kokain İdrarda',
								  '_vms_in_urine_'=>'VMS İdrarda',
								  
								  '_emx_amylase_'=>'Amilaz',
								  '_leukocytes_phosphate_telx_'=>'WBC-Phosp.',
								 'tx_15'=>'Hormonlar',
								 '_anti_hav_igm_'=>'Anti-HAV-IgM',
								 '_leg_pneum_antibody_'=>'Leg.pneum.-Antikor',
								 '_methadon_in_urine_'=>'Methadon İdrarda',
								 '_5_hies_in_urine_'=>'5.-Uyuşturucu İdrarda',
								 
								 '_uric_material_'=>'BUN',
								 'tx_16'=>'Kan şekeri',
								 '_acth_telx_'=>'ACTH',
								 '_hbs_antigen_'=>'HBs-Antijeni',
								 '_leptospiria_antibody_'=>'Leptospira-Antikor',
								 '_opiates_in_urine_'=>'Opiyatlar İdrarda',
								 '_hydroxyprolin_in_urine_'=>'Hidroksiprolin İdrarda',
								 
								 '_uric_acid_'=>'Ürik asit',
								 '_emx_bloodsugar_sober_'=>'Açlık kan şekeri',
								 '_aldosteron_'=>'Aldosteron',
								 '_anti_hbs_titer_'=>'Anti-HBs-Titre',
								 '_listeria_antibody_'=>'Listeria-Antikor',
								 'tx_17'=>'Prenatal',
								 '_cathecholamines_in_urine_'=>'Katekolamin İdrarda',
								 
								 '_emx_krea_'=>'Krea',
								 '_emx_bloodsugar_9_00_'=>'Glukoz 9.00',
								 '_calcitonin_'=>'Kalsitonin',
								 '_hbe_antigen_'=>'HBe-Antijen',
								 '_masern_antibody_'=>'Masern-Antikor',
								 '_chlamydia_smear_pregnancy_'=>'Klamidya.yayma.',
								 '_pankreol_'=>'Pankreol.',
								 
								 '_emx_sodium_'=>'Sodyum',
								 '_emx_bloodsugar_pp_'=>'Glukoz tokluk',
								 '_cortisol_'=>'Kortizol',
								 '_anti_hbe_'=>'Anti-HBe',
								 '_mononucleosis_'=>'Mononükleoz',
								 '_first_serology_'=>'1.nci seroloji',
								 '_aminolevulin_in_urine_'=>'Aminolövulin İdrarda',
								 
								 '_emx_kalium_'=>'Potassium',
								 '_emx_bloodsugar_15_00_'=>'Glukoz 15.00',
								 '_cortisol_day_program_'=>'Kortizol günprog.',
								 '_anti_hbc_'=>'Anti_HBc',
								 '_mumps_antibody_'=>'Kabakulak-Antikor',
								 '_pregnancy_'=>'SSW:',
								 'tx_18'=>'Diğerleri',
								 
								 '_emx_calcium_'=>'Kalsiyum',
								 '_emx_bloodsugar_notime_'=>'Glukoz.zamansız',
								 '_fsh_'=>'FSH',
								 '_anti_hbc_igm_'=>'Anti-HBc IgM',
								 '_mycoplas_pneum_'=>'Mycopl.pneu.Antikor',
								 '_down_screening_'=>'Down tarama',
								 '_emx_blood_alcohol_'=>'Alkol kanda',
								 
								 '_chloride_'=>'Klor',
								 '_emx_bloodsugar_notime_2_'=>'Glukoze.zamansız',
								 '_gastrin_'=>'Gastrin',
								 '_anti_hcv_'=>'Anti_HCV',
								 '_neurotrope_virus__x__neurotrope_virus_2_'=>'Neurotrop-V',
								 '_strep_b_quicktest_'=>'Strep-B-quick.test',
								 '_cdt_'=>'CDT',
								 
								 '_phospor_'=>'Fosfor',
								 '_glucose_proof_'=>'Glukozsuz',
								 '_hormone_hcg_'=>'HCG',
								 '_hepatitis_d_delta_a_'=>'Hep.D delta A',
								 '_parainfluenza_2_antibody_'=>'Par.influenz.2-Antikor',
								 '_tpha_'=>'TPHA',
								 '_vitamin_b12_'=>'Vitamin B12',
								 
								 '_magnesium_'=>'Mağnezyum',
								 '_lactose_proof_'=>'Laktozsuz',
								 '_insulin_'=>'İnsülin',
								 '_anti_hev_'=>'Anti-HEV',
								 '_parainfluenza_3_antibody_'=>'Par.influenz.3-Antikor',
								 '_hbs_ag_'=>'HBs-Ag',
								 '_folic_acid_'=>'Folik asit',
								 
								 '_iron_'=>'Demirn',
								 '_hba_1c_'=>'Hb A1c',
								 '_cathecholamines_in_p_'=>'Katekolaminler plazmada',
								 'tx_19'=>'Biyopsiler',
								 '_picoma_virus_antibody_'=>'Picoma-Virus-Antikor',
								 '_pregnancy_hiv1_hiv2_antibody_'=>'HIV1/HIV2-Antikor',
								 '_insulin_antibody_'=>'Insulin-Antikor',
								 
								 '_copper_'=>'Bakır',
								 '_fructosamine_'=>'Fructozamin',
								 '_lh_'=>'LH',
								 '_punctat_cytology_'=>'Biopsi sitoloji.',
								 '_rickettsia_antibody_'=>'Ricketsiya-Antikor',
								 'tx_20'=>'Gaita',
								 '_intrinsic_antibody_'=>'Intrinsic-Antikor',
								 
								 '_emx_osmolal_'=>'Osmolal.',
								 '_capillary_blood_sample_'=>'Kapiller Kan',
								 '_oestradiol_'=>'Östradiol',
								 '_protein_in_punctat_'=>'Protein Biopside',
								 '_reoteln_antibody_'=>'Röteln-Antikor',
								 '_chymotrypsin_'=>'Kimotripsin',
								 '_stone_analysis_'=>'Taş analizi',
								 
								 '_emx_lactat_in_p_'=>'Laktat, plazmada',
								 '_capillary_blood_sample_2_'=>'Kapiller kan',
								 '_oestriol_'=>'Östriol',
								 '_ldh_in_punctat_'=>'LDH Biopside',
								 '_roeteln_immune_status_'=>'Röt-Immun durum.',
								 '_blood_in_stool_'=>'Gaitada kan',
								 '_ace_'=>'ACE',
								 
								 '_ammoniac_'=>'Amonyak',
								 'tx_21'=>'Bebek',
								 '_pregnancy_ssw_'=>'SSW:',
								 '_chol_in_punctat_'=>'Kol. Biopside',
								 '_rs_virus_antibody_'=>'RS virus-Antikor',
								 '_blood_in_stool_2_'=>'Gaitada kan',
								 '_g1_'=>'G1',
								 
								 '_emx_free_hb_'=>'serbest Hb',
								 '_emx_infant_bilirubin_'=>'Bebek bilirübini',
								 '_parathormone_'=>'Parathormon',
								 '_cea_in_punctat_'=>'CEA Biopside',
								 '_shigella_salmonella_antibody_'=>'Shigell/Salm-Antikor',
								 '_blood_in_stool_3_'=>'Gaitada kan',
								 '_g2_'=>'G2',
								 
								 '_emx_crp_'=>'CRP',
								 '_emx_cord_bilirubin_'=>'Cord bili',
								 '_progesteron_'=>'Progesteron',
								 '_afp_in_punctat_'=>'AFP Biopside',
								 '_toxoplasma_antibody__x__toxoplasma_antibody_2_'=>'Toxoplasma-Antikor',
								 'tx_22'=>'yetersiz',
								 '_g3_'=>'G3',
								 
								 'tx_23'=>'BOS',
								 '_emx_infant_bilirubin_direct_'=>'Bilirübin direk',
								 '_prolactin_1_'=>'Prolaktin 1',
								 '_uric_material_in_punctat_'=>'Ürik bade biopside',
								 '_infection_tpha__x__infection_tpha_2_'=>'TPHA',
								 '_rarity_h_'=>'yetersiz H',
								 '_g4_'=>'G4',
								 
								 '_emx_liquor_status_'=>'Bos görünümü',
								 '_emx_infant_sugar_'=>'glukoz bebekte',
								 '_prolactin_2_'=>'Prolaktin 2',
								 '_rheumafactor_in_punctat_'=>'Romatizma.fak.Biopside',
								 '_varicella_antibody_'=>'Varicella-Antikor',
								 '_rarity_e_'=>'yetersiz E',
								 '_g5_'=>'G5',
								 
								 '_liquor_elpho_'=>'Bos elektroforez',
								 '_emx_infant_sugar_2_'=>'Bebek glukoz',
								 '_renin_'=>'Renin',
								 '_material_'=>'Materyel:',
								 '_yersinia_antibody_'=>'Yersinia-Antikor',
								 '_rarity_s_'=>'yetersiz S',
								 '_g6_'=>'G6',
								 
								 '_liquor_cytology_'=>'Bos sitoloji',
								 '_emx_infant_minor_blood_test_'=>'minor. Kan Testi',
								 '_serotonin_telx_'=>'Serotonin',
								 'blankline'=>'',
								 '_e1_'=>'E1',
								 '_urine_rarity_'=>'İdrar yetersiz',
								 '_g7_'=>'G7',
								 
								 '_oligoklonal_igg_'=>'Oligoklona.IgG',
								 '_infant_diff_minor_blood_test_'=>'Ayrınt.+min.KT',
								 '_somatomedin_c_'=>'Somatomedin C',
								 'blankline2'=>'',
								 '_e2_'=>'E2',
								 '_f1_'=>'F1',
								 '_g8_'=>'G8',
								 
								 '_reiber_schema_'=>'Reiber-Şeması',
								 '_infant_reticulocytes_'=>'Retikülositler',
								 '_testosteron_'=>'Testosteron',
								 '_d1_'=>'D1',
								 '_e3_'=>'E3',
								 '_f2_'=>'F2',
								 '_g9_'=>'G9',
								 
								 '_a1_'=>'A1',
								 '_b1_'=>'B1',
								 '_c1_'=>'C1',
								 '_d2_'=>'D2',
								 '_e4_'=>'E4',
								 '_f3_'=>'F3',
								 '_g10_'=>'G10',
								
								 'tx_24'=>'Doktorun imzası',
								 'tx_25'=>'Yüksek risk >>',
								 '_highrisk_'=>'<< Yüksek  risk',
								 'tx_26'=>'yetersizlik:',
								 'tx_27'=>'özel Test',
								 'tx_28'=>'',
								 'tx_29'=>'klinik bilgi',
								  );
/* 2002-09-03 EL */							  


?>
