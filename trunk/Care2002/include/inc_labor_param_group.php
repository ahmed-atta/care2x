<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_labor_param_group.php",$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

// parameter gruppe
$parametergruppe=array("TOP_Parameter","Klinische_Chemie","Liquor","Gerinnung","Hämatologie","Blutzucker",
						"Säugling","Proteine","Schilddrüse","Hormone","Tumormarker","Gewebe_AK",
						"Rheumafaktor","Hepatitis","Punktate","Infektionsserologie","Medikamente",
						"Mutterschutzt_Vorsorge","Stuhl","Raritäten","Urin_Spontanurin",
						"Sammelurin","Sonstiges");


// Klinische Chemie parameter
$klinichemie_list0=array(	"Alk_Ph_","Alpha-GT","Ammoniak","Amylase","Billi-gesamt","Billi-direkt",
						"Calcium","Chlorid","Chol","Cholinesterase","CKMB","CPK","CRP","Eisen",
						"Erythrocyten","freies-Hb","GLDH","GOT","GPT","Harnsäure","Harnstoff",
						"HBDH","HDL-Chol","Kalium","Krea","Kupfer","Lactat-i_P_","LDH",
						"LDL-Chol","Lipase","Lipid-Elpho","Magnesium","Myoglobin","Natrium",
						"Osmolal_","Phosphor","Serumzucker","Tri","Troponin-T" );

// Liquor parameter
$liquor_list1=array("Liquorstatus","Liquorelpho","Oligoklonales-IgG","Reiber-Schema","A1");

// Gerinnung parameter
$gerinnung_list2=array("Fibrinolyse","Quick","PTT","PTZ","Fibrinogen","Lösl_Fibr_mon_","FSP-dimer",
						"Thr_Coag_","AT-III","Faktor-VII","APC-Resistenz","Protein-C","Protein-S",
						"Blutungszeit");

//Hämatologie parameter
$haematologie_list3=array("Retikulozyten","Malaria","Hb-Elpho","HLA-B-27","Thrombo-AK","Leukocyten-Phosp_");

// Blutzucker parameter
$blutzucker_list4=array("Blutzucker_nü_","Blutzucker_9_00","Blutzucker_p_p_","Blutzucker_15_00",
						"Blutzucker_ohne_Zeit_1","Blutzucker_ohne_Zeit_2","Glucose-Bel_",
						"Lactose-Bel_","HBA-1c","Fructosamine");

// Säugling parameter
$saeugling_list5=array("Säugling-Bilirubin","Nabelbilirubin","Bilirubin-direkt","Säuglingszucker-1",
						"Säuglingszucker-2","Retikulozyten","B1");

// Proteine parameter
$proteine_list6=array("Ges_Eiweiss","Albumin","Elpho","Immunfixation","Beta-2-Mikroglobulin_i_S",
						"Immunglobulinquant_","IgE","Haptoglobin","Transferrin","Ferritin",
						"Coeruloplasmin","Alpha-1-Antitrypsin","AFP-Grav_","SSW:","Alpha-1-Mikroglobulin");

// Schilddrüse parameter
$schilddruse_list7=array("T3","Thyroxin/T4","TSH-Basal","TSH-stim_","TAK","MAK","TRAK","Thyreoglobulin",
						"Thyroxinbind_Glob_","freies-T3","freies-T4");

// Hormone parameter
$hormone_list8=array("ACTH","Aldosteron","Calcitonin","Cortisol","Cortisol-Tagespr_","FSH",
					 "Gastrin","HCG","Insulin","Katecholam_i_P_","LH","Oestradiol","Oestriol",
						"SSW:","Parathormon","Progesteron","Prolactin-I","Prolactin-II",
						"Renin","Serotonin","Somatomedin-C","Testosteron","C1");

// Tumormarker parameter
$tumormarker_list9=array("AFP","CA_15-3","CA_19-9","CA_125","CEA","Cyfra_21-2","HCG","NSE",
							"PSA","SCC","TPA");

// Gewebe-AK parameter
$gewebeak_list10=array("ANA","AMA","DNS-AK","ASMA","ENA","ANCA");

// Rheumafakt~
$rheumafakt_list11=array("Anti-Strepto-Titer","Lat_RF","Streptozyme","Waaler-Rose");

// Hepatitis parameter
$hepatitis_list12=array("Anti-HAV","Anti-HAV-IgM","Hbs-Antigen","Anti-HBs-Titer","Anti-HBe",
						"Anti-HBc","Anti-HBc_IgM","Anti-HCV","Hep_D-Delta-A_","Anti-HEV");

// Punktate parameter
$punktate_list13=array("Eiweiss-i_Punktat","LDH-i_Punktat","Chol_i_Punktat","CEA-i_Punktat",
						"AFP-i_Punktat","Harns_i_Punktat","Rheumafakt_i_Punktat","D1","D2");

// Infektionsserologie
$infektion_list12=array("Antistaph_Titer","Adenovirus-AK","Borrelien-AK","Borr_Immunoblot",
						"Brucellen-AK","Campylob_-AK","Candida-AK","Cardiotr_Viren",
						"Chlamydien-AK","C_psittaci-AK","Coxsack_-AK","Cox_burn_-AK(Q-Fieber)",
						"Cytomegalie-AK","EBV-AK","Echinococcus-AK","Echo-Viren-AK","FSME-AK",
						"Herpes-simp_-I-AK","Herpes-simp_-II-AK","HIV1/HIV2-AK","Influenza-A-AK",
						"Influenza-B-AK","LCM-AK","Leg_pneum-AK","Leptospiren-AK","Listerien-AK",
						"Masern-AK","Mononucleose","Mumps-AK","Mycoplas_pneum-AK","Neutrope-Viren-AK",
						"Parainfluenza-II-AK","Parainfluenza-III-AK","Picorna-Virus-AK",
						"Rickettsien-AK","Röteln-AK","Röteln-Immunstatus","RS-Virus-AK",
						"Shigellen/Salm-AK","Toxoplasma-AK","TPHA","Varicella-AK","Yersinien-AK",
						"E1","E2","E3","E4");

// Medikamente 
$medikamente_list13=array("Amiodaron","Barbiturate_i_S_","Benzodiazep_i_S_","Carbamazepin",
							"Clonazepam","Digitoxin","Digoxin","Gentamycin","Lithium",
							"Phenobarbital","Phenytoin","Primidon","Salizylsäure","Theophyllin",
							"Tobramycin","Valproinsäure","Vancomycin","Amphetamine_i_U_",
							"Antidepressiva_i_U_","Barbiturate_i_U_","Benzodiazep_i_U_",
							"Cannabinol_i_U_","Kokain_i_U","Methadon_i_U_","Opiate_i_U_");

// Muttersch~-Vorsorge
$muttersch_list14=array("Chlamyd_Abstr_/SSW","SSW:","Down-Screening","Strep-B-Schnelltest",
						"TPHA","HBs-Ag","HIV1/HIV2-AK" );

// Stuhl
$stuhl_list15=array("Chymotrypsin","Stuhl-auf-Blut-1","Stuhl-auf-Blut-2","Stuhl-auf-Blut-3");

// Raritäten
$raritaeten_list16=array("Rarität-H_","Rarität-E_","Rarität-S_","Urinrarität","F1","F2","F3");

// Urin / Spontanurin
$urin_list17=array("Urinamylase","Urinzucker","Eiweiss_i_U_","Albumin_i_U_","Osmol_i_U_",
					"Schwangerschaftst_","Cytomeg_i_Urin","Urincytologie","Bence-Jones",
					"Urin-Elpho","Beta2-Mikroglobulin_i_U_");

// Sammelurin
$sammelurin_list18=array("Addis-Count","Na~i_U_","K~i_U_","Ca~i_U_","Phospor~i_U_","Harnsäure~i_U_",
						"Kreatinin~i_U_","Porphyrine~i_U_","Cortisol~i_U_","Hydroxyprolin~i_U_",
						"Katecholamine~i_U_","Pankreol_","Gamma-Aminoläbulinsre_i_U_");

// Sonstiges
$sonstiges_list19=array("Blutalkohol","CDT","Vitamin-B12","Folsäure","Insulin-AK","Intrinsic-AK",
						"Steinanalyse","ACE","G1","G2","G3","G4","G5","G6","G7","G8","G9","G10");

$top_param=array("Quick","PTT","Hb","Hk","Thromboyzten","Erythrozyten","Leukozyten","Calcium","Natrium",
							"Blutzucker");

$paralistarray=array($top_param,$klinichemie_list0,$liquor_list1,$gerinnung_list2,$haematologie_list3,
						$blutzucker_list4,$saeugling_list5,$proteine_list6,$schilddruse_list7,
						$hormone_list8,$tumormarker_list9,$gewebeak_list10,$rheumafakt_list11,
						$hepatitis_list12,$punktate_list13,$infektion_list12,$medikamente_list13,
						$muttersch_list14,$stuhl_list15,$raritaeten_list16,$urin_list17,
						$sammelurin_list18,$sonstiges_list19);

?>
