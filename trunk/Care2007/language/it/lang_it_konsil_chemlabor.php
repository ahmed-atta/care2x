<?php
$LDDiagnosticTest='Richiesta di test diagnostico';
$LDHospitalName='ASUR 7';
$LDCentralLab='Laboratorio Chiaravalle';
$LDLabel='Etichetta';
$LDRoomNr='Stanza.';
$LDSamplingTime='Ora campione';
$LDDay='Giorno';
$LDMinutes='Minuti';
$LDHours='Ore';
$LDBatchNr='Progressivo';
$LDCaseNr='N. caso';
$LDHouse='Casa';
$LDHematology='Ematologia';
$LDCoagualtion='Coagulazione';
$LDUrine='Urine';
$LDSerum='Siero';
$LDGlucose='Glucosio';
$LD9Hour='9.00';
$LD15Hour='15.00';
$LDSober='sobrio';
$LDBloodSugar='BLS'; /* BLS = Blood sugar */
$LDBLoodSugar1='BLS1';
$LDBloodPlasma='BLP';
$LDDoctorSignature='Firma medico';
$LDLifeRisk='Rischio di vita';
$LDRarity='Raro';
$LDSpecTest='Test speciali';
$LDClinicalInfo='Informazioni cliniche';

$LDShortMonth=array('',
                   'Gen',
                                                                   'Feb',
                                                                   'Mar',
                                                                   'Apr',
                                                                   'Mag',
                                                                   'Giu',
                                                                   'Lug',
                                                                   'Ago',
                                                                   'Set',
                                                                   'Ott',
                                                                   'Nov',
                                                                   'Dic');

$LDShortDay=array('Do','Lu','Ma','Me','Gi','Ve','Sa','Do');

$LDBatchNumber='N. batch';
$LDMaterial='Material:';
$LDEmergencyProgram='Il campo in viola appartiene alla routine urgente';
$LDPhoneOrder=' = solo dopo conferma telefonica';
/* 2002-09-03 EL */
$LDSearchPatient='Ricerca paziente';
$LDPlsSelectPatientFirst='Prima cercare un paziente.';
/* 2002-09-11 EL */
$LDPendingTestRequest='Richiesta test accodata';
/* 2002-10-14 EL */
$LDDone='Archivia il modulo';

/* Note: the following array uses strict medical terminology.
*  If you are not sure about a translation, please leave the
*  english word untranslated
*/
$LD_Elements = array('tx_1'=>'Chimica',
                     'tx_2'=> 'Coagulazione',
                                                                  'tx_3'=> 'Proteine',
                                                                  'tx_4'=>'Marker tumorali',
                                                                  'tx_5'=>'Sierologia',
                                                                  'tx_6'=>'Tossicologia',
                                                                  'tx_7'=>'Urine',

                                  '_iof__x__iof_2_' => 'IOF',
                                  '_marcumar_therapy_' => 'Marcumar-Ther.',
                                                                  '_emx_protein_total_' => 'Proteine totali',
                                                                  '_afp_' => 'AFP',
                                                                  'tx_8' => 'Liquor',
                                                                  '_amiodaron_' => 'Amiodarone',
                                                                  '_emx_urin_status_' => 'Stato urine',

                                                                  '_aof_'=>'AOF',
                                                                  '_heparin_therapy_'=>'Terapia eparina',
                                                                  '_albumin_'=>'Albumine',
                                                                  '_ca_15_3_'=>'CA 15-3',
                                                                  '_antisstaph_titer_'=>'Antistaph.Titer',
                                                                  '_barbiturates_i_s_'=>'Barbiturici',
                                                                  '_emx_urin_amilase_'=>'Amilasi urine',

                                                                  '_preop_'=>'preop',
                                                                  '_fibrinolysis_'=>'Fibrinolisi',
                                                                  '_elpho_'=>'Elpho',
                                                                  '_ca_19_9_'=>'CA 19-9',
                                                                  '_adenovirus_antibody_'=>'Adenovirus-AB',
                                                                  '_benzodiazepam_i_s_'=>'Benzodiazepine',
                                                                  '_urin_sugar_'=>'Zuccheri urine',

                                                                  '_postop_'=>'postop',
                                                                  '_emx_quick_'=>'Quick',
                                                                  '_immune_fixation_'=>'Immune fixation',
                                                                  '_ca_125_'=>'CA 125',
                                                                  '_borrelias_antibody__x__borrelias_antibody_2_'=>'Borrelia-AB',
                                                                  '_carbmazepin_'=>'Carbamazepina',
                                                                  '_proten_in_urine_'=>'Proteine urine',

                                                                  '_emx_serum_sugar_'=>'Zuccheri siero',
                                                                  '_emx_ptt_'=>'PTT',
                                                                  '_beta2_microglobulin_i_s_'=>'ß2-Microglob.i.S.',
                                                                  '_cea_'=>'CEA',
                                                                  '_borrelias_immunoblot__x__borrelias_immunoblot_2_'=>'Borr.Immunoblot',
                                                                  '_clonazepam_'=>'Clonazepam',
                                                                  '_albumin_in_urine_'=>'Albumina urine',

                                                                  '_emx_bilirubin_total_'=>'Bili totale',
                                                                  '_emx_ptz_'=>'PTZ',
                                                                  '_immunglobulin_quantity_'=>'Qt immuglobine',
                                                                  '_cyfra_21_1_'=>'Cyfra 21-1',
                                                                  '_brucellia_antibody_'=>'Brucellen-AB',
                                                                  '_emx_digitoxin_'=>'Digitossina',
                                                                  '_emx_osmol_in_urine_'=>'Osmol i.U.',

                                                                  '_bilirubin_direct_'=>'Bili diretta',
                                                                  '_emx_fibrinogen_'=>'Fibrinogeno',
                                                                  '_ige_'=>'IgE',
                                                                  '_hcg_'=>'HCG',
                                                                  '_campylob_antibody_'=>'Campylob.-AB',
                                                                  '_emx_digoxin_'=>'Digossina',
                                                                  '_emx_pregnancy_'=>'Gravidanza',

                                                                  '_emx_got_'=>'GOT',
                                                                  '_emx_soluble_fibrinogen_mon_'=>'Sol.Fibr.mon',
                                                                  '_haptoglobin_'=>'Haptoglobina',
                                                                  '_nse_'=>'NSE',
                                                                  '_candida_antibody_'=>'Candida-AB',
                                                                  '_gentamycin_'=>'Gentamycin',
                                                                  '_cytomegaly_in_urine_'=>'Citomegalo urine',

                                                                  '_emx_gpt_'=>'GPT',
                                                                  '_emx_fsp_dimer_'=>'FSP-dimer',
                                                                  '_transferrin_'=>'Transferrina',
                                                                  '_psa_'=>'PSA',
                                                                  '_cardiotr_virus_'=>'Virus Cardiotr.',
                                                                  '_lithium_'=>'Litio',
                                                                  '_urine_cytology_'=>'Urine citologia',

                                                                  '_gamma_gt_'=>'gamma GT',
                                                                  '_emx_thrombos_coagulation_'=>'Thr.Coag.',
                                                                  '_ferritin_'=>'Ferritina',
                                                                  '_scc_'=>'SCC',
                                                                  '_chamydia_smear_'=>'Chalmy-Smear.',
                                                                  '_phenobarbital_'=>'Fenobarbitale',
                                                                  '_bence_jones_'=>'Bence Jones',

                                                                  '_alkalic_ph_'=>'Alk.Ph.',
                                                                  '_emx_at_3_'=>'AT III',
                                                                  '_coeroplasmin_'=>'Coeroplasmina',
                                                                  '_tpa_'=>'TPA',
                                                                  '_chlamydia_antibody_'=>'Chlamyd.-AB',
                                                                  '_phenytoin_'=>'Fenitoina',
                                                                  '_urine_elpho_'=>'Urine-Elpho',

                                                                  '_ldh_'=>'LDH',
                                                                  '_factor_8_'=>'Fattore VIII',
                                                                  '_alpha_1_antitrypsin_'=>'a-1 Antitripsina',
                                                                  'tx_9'=>'Tissue-AB',
                                                                  '_c_psitacci_antibody_'=>'C.psitacci-AB',
                                                                  '_primidon_'=>'Primidone',
                                                                  '_beta_2_microglobulin_in_urine_'=>'Microglob. ß2 urine',

                                                                  '_hbdh_'=>'HBDH',
                                                                  '_apc_resistance_telx_'=>'APC-Resisten.',
                                                                  '_afp_gravida_'=>'AFP Grav.',
                                                                  '_ana_'=>'ANA',
                                                                  '_coxsacky_antibody_'=>'Coxsack.-AB',
                                                                  '_salicylic_acid_'=>'Acido salicilico',
                                                                  'tx_10'=>'Collect.Urine',

                                                                  'emx_cpk_'=>'CPK',
                                                                  '_protein_c_telx_'=>'Proteina C',
                                                                  '_ssw_'=>'Gravidanza',
                                                                  '_ama_'=>'AMA',
                                                                  '_q_fever_antibody_'=>'Q-Fieber-AB',
                                                                  '_theophyllin_'=>'Theophyllin',
                                                                  '_urine_collected_'=>'Sammel-',

                                                                  '_emx_ckmb_'=>'CKMB',
                                                                  '_protein_s_telx_'=>'Proteina S',
                                                                  '_alpha_1_microglobulin_'=>'Microglobulina a-1',
                                                                  '_dns_antibody_'=>'DNS-AB',
                                                                  '_cytomegaly_antibody_'=>'Cytomegalie-AB',
                                                                  '_tobramycin_'=>'Tobramycin',
                                                                  '_urine_volume_'=>'Vol:ml.',

                                                                  '_emx_myoglobin_'=>'Myoglobin',
                                                                  '_bleeding_time_telx_'=>'Bleed time',
                                                                  'tx_11'=>'Ghiandole tiroidee',
                                                                  '_asma_'=>'ASMA',
                                                                  '_ebv_antibody__x__ebv_antibody_2_'=>'EBV-AB',
                                                                  '_valproin_acid_'=>'Valproin acid',
                                                                  '_addis_count_'=>'Addis-Count',

                                                                  '_emx_troponin_t_'=>'Troponin-T',
                                                                  'tx_12'=>'Ematologia',
                                                                  '_t3_'=>'T3',
                                                                  '_ena_'=>'ENA',
                                                                  '_echinococcus_antibody_'=>'Echinococco-AB',
                                                                  '_vancomycin_'=>'Vancomycin',
                                                                  '_sodium_in_urine_'=>'Sodio in urine',

                                                                  '_emx_cholinesterase_'=>'Colinesterasi',
                                                                  '_emx_minor_blood_test_'=>'Kl. BB',
                                                                  '_thyroxin_T4_'=>'Thyroxin/T4',
                                                                  '_anca_'=>'ANCA',
                                                                  '_echo_virus_antibody_'=>'Echo-Virus AB',
                                                                  '_empty_'=>'',
                                                                  '_kalium_in_urine_'=>'Potassio in urine',

                                                                  '_gldh_'=>'GLDH',
                                                                  '_diff_minor_blood_test_'=>'Diff.+ kl.BB',
                                                                  '_tsh_basal_'=>'TSH-basal',
                                                                  'tx_13'=>'Rheuma factors',
                                                                  '_fsme_antibody__x__fsme_antibody_2_'=>'FSME-AB',
                                                                  '_emx_drugscreen_in_urine_'=>'Drugscreen i.U.',
                                                                  '_calcium_in_urine_'=>'Calcio in urine',

                                                                  '_chol_'=>'Chol',
                                                                  '_reticulocytes_'=>'Retikulocytes',
                                                                  '_tsh_stimulation_'=>'TSH-stim.',
                                                                  '_anti_strepto_titer_'=>'Anti-Strepto-Titer',
                                                                  '_herpes_simplex_1_antibody_'=>'Herpes sim.1-AB',
                                                                  '_amphetamine_in_urine_'=>'Amfetamina in urine',
                                                                  '_phospor_in_urine_'=>'Fosforo in urine',

                                                                  '_tri_'=>'Tri',
                                                                  '_bone_marrow_diff_telx_'=>'Bmarrow+Diff.',
                                                                  '_tak_'=>'TAK',
                                                                  '_lat_rf_'=>'Lat.RF',
                                                                  '_herpes_simplex_2_antibody_'=>'Herpes sim.2-AB',
                                                                  '_antidepressant_in_urine_'=>'Antidepressivi in urine',
                                                                  '_uric_acid_in_urine_'=>'Acido urico in urine',

                                                                  '_hdl_chol_'=>'HDL-Chol',
                                                                  '_malaria_'=>'Malaria',
                                                                  '_mak_'=>'MAK',
                                                                  '_streptocyme_'=>'Streptozyme',
                                                                  '_hiv1_hiv2_antibody_'=>'HIV1/HIV2-AB',
                                                                  '_barbiturates_in_urine_'=>'Barbiturici in urine',
                                                                  '_creatinin_in_urine_'=>'Creatinina in urine',

                                                                  '_ldl_chol_'=>'LDL-Chol',
                                                                  '_hb_elpho_'=>'Hb-Elpho',
                                                                  '_trak_'=>'TRAK',
                                                                  '_waaler_rose_'=>'Waaler Rose',
                                                                  '_influenza_a_antibody_'=>'Influenza A-AB',
                                                                  '_benzodiazepam_in_urine_'=>'Benzodiazep.i.U.',
                                                                  '_porphyrine_in_urine_'=>'Porphyrina in urine',

                                                                  '_lipid_elpho_'=>'Lipid-Elpho',
                                                                  '_hla_b_27_telx_'=>'HLA-B 27',
                                                                  '_thyreoglobulin_'=>'Thyreoglobulin',
                                                                  'tx_14'=>'Hepatitis',
                                                                  '_influenza_b_antibody_'=>'Influenza B-AB',
                                                                  '_cannabinol_in_urine_'=>'Cannabinol in urine',
                                                                  '_cortisol_in_urine_'=>'Cortisol in urine',

                                                                  '_lipase_'=>'Lipasi',
                                                                  '_thrombo_antibody_telx_'=>'Thrombo-AB',
                                                                  '_thyroxinbinding_globulin_'=>'Thyroxinbind.Glob.',
                                                                  '_anti_hav_'=>'Anti-HAV',
                                                                  '_lcm_antibody_'=>'LCM-AB',
                                                                  '_cocain_in_urine_'=>'Cocaina in urine',
                                                                  '_vms_in_urine_'=>'VMS in urine',

                                                                  '_emx_amylase_'=>'Amilasi',
                                                                  '_leukocytes_phosphate_telx_'=>'Leuko-Phosp.',
                                                                 'tx_15'=>'Ormoni',
                                                                 '_anti_hav_igm_'=>'Anti-HAV-IgM',
                                                                 '_leg_pneum_antibody_'=>'Leg.pneum.-AB',
                                                                 '_methadon_in_urine_'=>'Metadone in urine',
                                                                 '_5_hies_in_urine_'=>'5.-Hies in urine',

                                                                 '_uric_material_'=>'Harnstoff',
                                                                 'tx_16'=>'Zuccheri sangue',
                                                                 '_acth_telx_'=>'ACTH',
                                                                 '_hbs_antigen_'=>'HBs-Antigen',
                                                                 '_leptospiria_antibody_'=>'Leptospiren-AB',
                                                                 '_opiates_in_urine_'=>'Opiates i.U.',
                                                                 '_hydroxyprolin_in_urine_'=>'Hydroxyprolin i.U.',

                                                                 '_uric_acid_'=>'Acido urico',
                                                                 '_emx_bloodsugar_sober_'=>'Bloodsu. sob.',
                                                                 '_aldosteron_'=>'Aldosteron',
                                                                 '_anti_hbs_titer_'=>'Anti-HBs-Titer',
                                                                 '_listeria_antibody_'=>'Listeria-AB',
                                                                 'tx_17'=>'Prenatal',
                                                                 '_cathecholamines_in_urine_'=>'Catecholam.i.U.',

                                                                 '_emx_krea_'=>'Krea',
                                                                 '_emx_bloodsugar_9_00_'=>'Bloodsu. 9.00',
                                                                 '_calcitonin_'=>'Calcitonin',
                                                                 '_hbe_antigen_'=>'HBe-Antigen',
                                                                 '_masern_antibody_'=>'Masern-AB',
                                                                 '_chlamydia_smear_pregnancy_'=>'Chlamy.smear.',
                                                                 '_pankreol_'=>'Pankreol.',

                                                                 '_emx_sodium_'=>'Sodio',
                                                                 '_emx_bloodsugar_pp_'=>'Bloodsu. p.p.',
                                                                 '_cortisol_'=>'Cortisol',
                                                                 '_anti_hbe_'=>'Anti-HBe',
                                                                 '_mononucleosis_'=>'Mononucleosi',
                                                                 '_first_serology_'=>'1st serology',
                                                                 '_aminolevulin_in_urine_'=>'Aminolovulina in urine',

                                                                 '_emx_kalium_'=>'Potassio',
                                                                 '_emx_bloodsugar_15_00_'=>'Bloodsu. 15.00',
                                                                 '_cortisol_day_program_'=>'Cortisol Tagespr.',
                                                                 '_anti_hbc_'=>'Anti_HBc',
                                                                 '_mumps_antibody_'=>'Mumps-AB',
                                                                 '_pregnancy_'=>'SSW:',
                                                                 'tx_18'=>'Altro',

                                                                 '_emx_calcium_'=>'Calcio',
                                                                 '_emx_bloodsugar_notime_'=>'Bloodsu.noTime',
                                                                 '_fsh_'=>'FSH',
                                                                 '_anti_hbc_igm_'=>'Anti-HBc IgM',
                                                                 '_mycoplas_pneum_'=>'Mycopl.pneu.AB',
                                                                 '_down_screening_'=>'Down screening',
                                                                 '_emx_blood_alcohol_'=>'Blood alcohol',

                                                                 '_chloride_'=>'Cloruro',
                                                                 '_emx_bloodsugar_notime_2_'=>'Bloodsu.noTime',
                                                                 '_gastrin_'=>'Gastrin',
                                                                 '_anti_hcv_'=>'Anti_HCV',
                                                                 '_neurotrope_virus__x__neurotrope_virus_2_'=>'Neurotrop-V',
                                                                 '_strep_b_quicktest_'=>'Strep-B-quick.test',
                                                                 '_cdt_'=>'CDT',

                                                                 '_phospor_'=>'Fosforo',
                                                                 '_glucose_proof_'=>'Test glucosio',
                                                                 '_hormone_hcg_'=>'HCG',
                                                                 '_hepatitis_d_delta_a_'=>'Hep.D delta A',
                                                                 '_parainfluenza_2_antibody_'=>'Par.influenz.2-AB',
                                                                 '_tpha_'=>'TPHA',
                                                                 '_vitamin_b12_'=>'Vitamina B12',

                                                                 '_magnesium_'=>'Magnesio',
                                                                 '_lactose_proof_'=>'Test lattosio',
                                                                 '_insulin_'=>'Insulina',
                                                                 '_anti_hev_'=>'Anti-HEV',
                                                                 '_parainfluenza_3_antibody_'=>'Par.influenz.3-AB',
                                                                 '_hbs_ag_'=>'HBs-Ag',
                                                                 '_folic_acid_'=>'Folic acid',

                                                                 '_iron_'=>'Ferro',
                                                                 '_hba_1c_'=>'HBA 1c',
                                                                 '_cathecholamines_in_p_'=>'Katecholam.i.P.',
                                                                 'tx_19'=>'Punctate',
                                                                 '_picoma_virus_antibody_'=>'Picoma-Virus-AB',
                                                                 '_pregnancy_hiv1_hiv2_antibody_'=>'HIV1/HIV2-AB',
                                                                 '_insulin_antibody_'=>'Insulina-AB',

                                                                 '_copper_'=>'Rame',
                                                                 '_fructosamine_'=>'Fructosamina',
                                                                 '_lh_'=>'LH',
                                                                 '_punctat_cytology_'=>'Punctat cytolog.',
                                                                 '_rickettsia_antibody_'=>'Rickettsien-AB',
                                                                 'tx_20'=>'Stuhl',
                                                                 '_intrinsic_antibody_'=>'Intrinsic-AB',

                                                                 '_emx_osmolal_'=>'Osmolal.',
                                                                 '_capillary_blood_sample_'=>'Test capill. sangue',
                                                                 '_oestradiol_'=>'Oestradiol',
                                                                 '_protein_in_punctat_'=>'Protein i.Punct.',
                                                                 '_reoteln_antibody_'=>'Röteln-AB',
                                                                 '_chymotrypsin_'=>'Chymotrypsin',
                                                                 '_stone_analysis_'=>'Stone analysis',

                                                                 '_emx_lactat_in_p_'=>'Lactat i.P.',
                                                                 '_capillary_blood_sample_2_'=>'Capill.Blutentn.',
                                                                 '_oestriol_'=>'Oestriol',
                                                                 '_ldh_in_punctat_'=>'LDH i.Punctat',
                                                                 '_roeteln_immune_status_'=>'Röt-Immunstat.',
                                                                 '_blood_in_stool_'=>'Sangue nelle feci',
                                                                 '_ace_'=>'ACE',

                                                                 '_ammoniac_'=>'Ammoniaca',
                                                                 'tx_21'=>'Infant',
                                                                 '_pregnancy_ssw_'=>'SSW:',
                                                                 '_chol_in_punctat_'=>'Chol. i. Punct.',
                                                                 '_rs_virus_antibody_'=>'RS virus-AB',
                                                                 '_blood_in_stool_2_'=>'Sangue nelle feci',
                                                                 '_g1_'=>'G1',

                                                                 '_emx_free_hb_'=>'Hb libero',
                                                                 '_emx_infant_bilirubin_'=>'Infant.bilirubin',
                                                                 '_parathormone_'=>'Parathormon',
                                                                 '_cea_in_punctat_'=>'CEA i.Punctat',
                                                                 '_shigella_salmonella_antibody_'=>'Shigell/Salm-AB',
                                                                 '_blood_in_stool_3_'=>'Sangue nelle feci',
                                                                 '_g2_'=>'G2',

                                                                 '_emx_crp_'=>'CRP',
                                                                 '_emx_cord_bilirubin_'=>'Nabelbilirubin',
                                                                 '_progesteron_'=>'Progesteron',
                                                                 '_afp_in_punctat_'=>'AFP i.Punctat',
                                                                 '_toxoplasma_antibody__x__toxoplasma_antibody_2_'=>'Toxoplasma-AB',
                                                                 'tx_22'=>'Raro',
                                                                 '_g3_'=>'G3',

                                                                 'tx_23'=>'Liquor',
                                                                 '_emx_infant_bilirubin_direct_'=>'Bilirubin direct',
                                                                 '_prolactin_1_'=>'Prolactin 1',
                                                                 '_uric_material_in_punctat_'=>'Uricm.i.Punct.',
                                                                 '_infection_tpha__x__infection_tpha_2_'=>'TPHA',
                                                                 '_rarity_h_'=>'Rarity H',
                                                                 '_g4_'=>'G4',

                                                                 '_emx_liquor_status_'=>'Liquorstatus',
                                                                 '_emx_infant_sugar_'=>'Infant sugar',
                                                                 '_prolactin_2_'=>'Prolactin 2',
                                                                 '_rheumafactor_in_punctat_'=>'Rheumaf.i.Punct.',
                                                                 '_varicella_antibody_'=>'Varicella-AB',
                                                                 '_rarity_e_'=>'Rarity E',
                                                                 '_g5_'=>'G5',

                                                                 '_liquor_elpho_'=>'Liquorelpho',
                                                                 '_emx_infant_sugar_2_'=>'Infant sugar',
                                                                 '_renin_'=>'Renina',
                                                                 '_material_'=>'Materiale:',
                                                                 '_yersinia_antibody_'=>'Yersinia-AB',
                                                                 '_rarity_s_'=>'Rarity S',
                                                                 '_g6_'=>'G6',

                                                                 '_liquor_cytology_'=>'Liquor cytology',
                                                                 '_emx_infant_minor_blood_test_'=>'Kl. BB',
                                                                 '_serotonin_telx_'=>'Serotonina',
                                                                 'blankline'=>'',
                                                                 '_e1_'=>'E1',
                                                                 '_urine_rarity_'=>'Urine rarity',
                                                                 '_g7_'=>'G7',

                                                                 '_oligoklonal_igg_'=>'IgG oligoclonali',
                                                                 '_infant_diff_minor_blood_test_'=>'Diff.+kl. BB',
                                                                 '_somatomedin_c_'=>'Somatomedin C',
                                                                 'blankline2'=>'',
                                                                 '_e2_'=>'E2',
                                                                 '_f1_'=>'F1',
                                                                 '_g8_'=>'G8',

                                                                 '_reiber_schema_'=>'Reiber-Schema',
                                                                 '_infant_reticulocytes_'=>'Reticulociti',
                                                                 '_testosteron_'=>'Testosterone',
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

                                                                 'tx_24'=>'Firma medico',
                                                                 'tx_25'=>'Alto rischio >>',
                                                                 'highrisk'=>'<< Alto rischio',
                                                                 'tx_26'=>'Raro:',
                                                                 'tx_27'=>'Test speciale',
                                                                 'tx_28'=>'',
                                                                 'tx_29'=>'informazioni cliniche',
                                                                  );
?>