<?php
//error_reporting(E_ALL);
$LDInitFindings='Initial findings';
$LDCurrentFindings='Current findings';
$LDFinalFindings='Final find';

$LDFillLabOnly='For lab use only';
$LDLEN='LEN';  /* LEN =  Lab entry number */

$LDDate='Date';
$LDEye='Eye';
$LDBac_1='Bact.1'; /* Note: Bact. means bacteria or pathogen */
$LDBac_2='Bact.2';
$LDBac_3='Bact.3';
$LDBac_I='Patho.I';
$LDBac_II='Patho.II';
$LDBac_III='Patho.III';
$LDFungi='Fungi';
$LDResistanceTestAnaerob='Resistance test Anaerobe';				
$LDResistanceTestAerob='Resistance test Aerobe';
$LDTestFindings='Test results / Findings';
$LDMarkStreptocResistance='mark by streptococcus resistance';
$LDBlockerNeg='Blocker negative';
$LDBlockerPos='Blocker positive';
$LDBacNr_GT='Bac.ct.>10^5';
$LDBacNr_LT='Bac.ct.<10^5';
$LDBacNrNeg='Bac.ct.neg';
$LDSMR=array('S','M','R');

/* 2002-09-19 EL */
$LDBAC[0]='Patho.I';
$LDBAC[1]='Patho.II';
$LDBAC[2]='Patho.III';

/* Note: the following arrays use strict medical terminology.
*  If you are not sure about their translation, please leave the 
*  english word untranslated
*/
//TODO : move on a configuration interface
$lab_TestType["'_lab_culture_aerob_'"]='C.aer.';
$lab_TestType["'_lab_subcult_aerob_1_'"]='S.aer.';
$lab_TestType["'_lab_subcult_aerob_2_'"]='S.aer.';
$lab_TestType["'_lab_subcult_aerob_3_'"]='S.aer.';
$lab_TestType["'_lab_subcult_aerob_4_'"]='S.aer.';
$lab_TestType["'_lab_subcult_aerob_5_'"]='S.aer.';
$lab_TestType["'_lab_optochin_1_'"]='OPTCN';
$lab_TestType["'_lab_cooked_blood_1_'"]='C.blod';
$lab_TestType["'_lab_bacitracin_1_'"]='BCTCN';
$lab_TestType["'_lab_campylocbacter_1_'"]='CPBTR';
$lab_TestType["'_lab_culture_anaerob_'"]='C.ana';
$lab_TestType["'_lab_subcult_anaerob_'"]='S.ana.';
$lab_TestType["'_lab_subcult_anaerob_2_'"]='S.ana.';
$lab_TestType["'_lab_subcult_anaerob_3_'"]='S.ana.';
$lab_TestType["'_lab_subcult_anaerob_4_'"]='S.ana.';
$lab_TestType["'_lab_subcult_anaerob_5_'"]='S.ana.';
$lab_TestType["'_lab_optochin_2_'"]='OPTCN';
$lab_TestType["'_lab_cooked_blood_2_'"]='C.blod';
$lab_TestType["'_lab_bacitracin_2_'"]='BCTCN';
$lab_TestType["'_lab_campylocbacter_2_'"]='CPBTR';
$lab_TestType["'_lab_culture_fungal_1_'"]='Fung.C.';
$lab_TestType["'_lab_culture_fungal_2_'"]='Fung.C.';
$lab_TestType["'_lab_bac_tube_1_'"]='Path.T.';
$lab_TestType["'_lab_bac_tube_2_'"]='Path.T.';
$lab_TestType["'_lab_api_candida_1_'"]='API.Cdd';
$lab_TestType["'_lab_api_candida_2_'"]='API.Cdd';
$lab_TestType["'_lab_special_fungi_1_'"]='s.Fungi';
$lab_TestType["'_lab_special_fungi_2_'"]='s.Fungi';
$lab_TestType["'_lab_candida_id_1_'"]='Cdd-ID';
$lab_TestType["'_lab_candida_id_2_'"]='Cdd-ID';
$lab_TestType["'_lab_culture_stool_'"]='StoolC.';
$lab_TestType["'_lab_culture_blood_'"]='BlodC.';
$lab_TestType["'_lab_liquor_cult_vial'"]='Liq.KF';
$lab_TestType["'_lab_laal_'"]='LAAL';
$lab_TestType["'_lab_own_blood_'"]='O.blod';
$lab_TestType["'_extra_1_'"]='';
$lab_TestType["'_extra_2_'"]='';
$lab_TestType["'_extra_3_'"]='';
$lab_TestType["'_lab_kligler_'"]='Kliglr';
$lab_TestType["'_extra_4_'"]='';
$lab_TestType["'_lab_agglut_1x_1_'"]='Ag.1x';
$lab_TestType["'_lab_agglut_1x_2_'"]='Ag.1x';
$lab_TestType["'_lab_aggult_1x_3_'"]='Ag.1x';
$lab_TestType["'_lab_agglut_4x_'"]='Ag.4x';
$lab_TestType["'_lab_agglut_8x_'"]='Ag.8x';
$lab_TestType["'_lab_agglut_str_pneu_1_'"]='ASP1';
$lab_TestType["'_lab_agglut_str_pneu_2_'"]='ASP2';
$lab_TestType["'_lab_agglut_dyspepsy_'"]='Ag.Dys.';
$lab_TestType["'_lab_ehec_'"]='EHEC';
$lab_TestType["'_lab_mobility_'"]='MBLTY';
$lab_TestType["'_lab_methylen_blue'"]='M-blau';
$lab_TestType["'_lab_acrid_orange_'"]='A.oran.';
$lab_TestType["'_lab_ziehl_neelsen_'"]='Z-Neel.';
$lab_TestType["'_lab_koh_'"]='KOH';
$lab_TestType["'_lab_novobiocin_1_'"]='NBCN.1';
$lab_TestType["'_lab_novobiocin_2_'"]='NBCN.2';
$lab_TestType["'_extra_5_'"]='';
$lab_TestType["'_extra_6_'"]='';
$lab_TestType["'_extra_7_'"]='';
$lab_TestType["'_extra_8_'"]='';
$lab_TestType["'_lab_streptex_1_'"]='STPX.1';
$lab_TestType["'_lab_plasma_coag_1_'"]='PK.1';
$lab_TestType["'_lab_catalase_1_'"]='CTLS.1';
$lab_TestType["'_lab_indol_1_'"]='Ndol.1';
$lab_TestType["'_lab_oxidase_1_'"]='OXDS.1';
$lab_TestType["'_lab_enterotube_1_'"]='ENTB.1';
$lab_TestType["'_lab_bbl_1_'"]='BBL1';
$lab_TestType["'_lab_api_1_'"]='API1';
$lab_TestType["'_lab_api_anaerob_1_'"]='APIa.1';
$lab_TestType["'_lab_gram_dye_1_'"]='Gram.1';
$lab_TestType["'_lab_streptex_2_'"]='STPX.2';
$lab_TestType["'_lab_plasma_coag_2_'"]='PK.2';
$lab_TestType["'_lab_catalase_2_'"]='CTLS.2';
$lab_TestType["'_lab_indol_2_'"]='Ndol.2';
$lab_TestType["'_lab_oxidase_2_'"]='OXDS.2';
$lab_TestType["'_lab_enterotube_2_'"]='ENTB.2';
$lab_TestType["'_lab_bbl_2_'"]='BBL2';
$lab_TestType["'_lab_api_2_'"]='API2';
$lab_TestType["'_lab_api_anaerob_2_'"]='APIa.2';
$lab_TestType["'_lab_gram_dye_2_'"]='Gram.2';
$lab_TestType["'_lab_streptex_3_'"]='STPX.3';
$lab_TestType["'_lab_plasma_coag_3_'"]='PK.3';
$lab_TestType["'_lab_catalase_3_'"]='CTLS.3';
$lab_TestType["'_lab_indol_3_'"]='Ndol.3';
$lab_TestType["'_lab_oxidase_3_'"]='OXDS.3';
$lab_TestType["'_lab_enterotube_3_'"]='ENTB.3';
$lab_TestType["'_lab_bbl_3_'"]='BBL3';
$lab_TestType["'_lab_api_3_'"]='API3';
$lab_TestType["'_lab_api_anaerob_3_'"]='APIa.3';
$lab_TestType["'_lab_gram_dye_3_'"]='Gram.3';

$lab_ResistANaerobAcro[0]='PEN';
$lab_ResistANaerobAcro[1]='AMO';
$lab_ResistANaerobAcro[2]='AMC';
$lab_ResistANaerobAcro[3]='MZL';
$lab_ResistANaerobAcro[4]='PIC';
$lab_ResistANaerobAcro[5]='IMI';
$lab_ResistANaerobAcro[6]='CTX';
$lab_ResistANaerobAcro[7]='CMP';
$lab_ResistANaerobAcro[8]='TET';
$lab_ResistANaerobAcro[9]='CLI';
$lab_ResistANaerobAcro[10]='MTR';
$lab_ResistANaerobAcro[11]='ERY';
$lab_ResistANaerobAcro[12]='TEC';
$lab_ResistANaerobAcro[13]='VAN';
$lab_ResistANaerobAcro[14]='';
									
$lab_ResistAerobAcro[0]='P';
$lab_ResistAerobAcro[1]='AMX';
$lab_ResistAerobAcro[2]='AMC';
$lab_ResistAerobAcro[3]='CC';
$lab_ResistAerobAcro[4]='MZ';
$lab_ResistAerobAcro[5]='PIP';
$lab_ResistAerobAcro[6]='GM';
$lab_ResistAerobAcro[7]='AN';
$lab_ResistAerobAcro[8]='CZ';
$lab_ResistAerobAcro[9]='CXM';
$lab_ResistAerobAcro[10]='CRO';
$lab_ResistAerobAcro[11]='MER';
$lab_ResistAerobAcro[12]='OFX';
$lab_ResistAerobAcro[13]='SXT';
$lab_ResistAerobAcro[14]='U';
$lab_ResistAerobAcro[15]='AZ';
$lab_ResistAerobAcro[16]='VA';
$lab_ResistAerobAcro[17]='NN';
$lab_ResistAerobAcro[18]='IPM';
$lab_ResistAerobAcro[19]='CTX';
$lab_ResistAerobAcro[20]='CAZ';
$lab_ResistAerobAcro[21]='FEP';
$lab_ResistAerobAcro[22]='TEC';
$lab_ResistAerobAcro[23]='FF';
$lab_ResistAerobAcro[24]='25';
$lab_ResistAerobAcro[25]='E';
$lab_ResistAerobAcro[26]='OX';
$lab_ResistAerobAcro[27]='CIP';
$lab_ResistAerobAcro[28]='CFS';
$lab_ResistAerobAcro[29]='30';
$lab_ResistAerobAcro[30]='31';
$lab_ResistAerobAcro[31]='&#223;Lac.';
										   
$lab_ResistAerobExtra[0]='AB';
$lab_ResistAerobExtra[1]='MIC';
$lab_ResistAerobExtra[2]='NY';
$lab_ResistAerobExtra[3]='AC';
$lab_ResistAerobExtra[4]='KET';
$lab_ResistAerobExtra[5]='6';
$lab_ResistAerobExtra[6]='';
$lab_ResistAerobExtra[7]='';
$lab_ResistAerobExtra[8]='C';
$lab_ResistAerobExtra[9]='NE';
$lab_ResistAerobExtra[10]='GM';
$lab_ResistAerobExtra[11]='D';
$lab_ResistAerobExtra[12]='OFX';
$lab_ResistAerobExtra[13]='K';
$lab_ResistAerobExtra[14]='';
$lab_ResistAerobExtra[15]='';
$lab_ResistAerobExtra[16]='C';
$lab_ResistAerobExtra[17]='NE';
$lab_ResistAerobExtra[18]='GM';
$lab_ResistAerobExtra[19]='D';
$lab_ResistAerobExtra[20]='OFX';
$lab_ResistAerobExtra[21]='K';
$lab_ResistAerobExtra[22]='';
$lab_ResistAerobExtra[23]='';
$lab_ResistAerobExtra[24]='C';
$lab_ResistAerobExtra[25]='NE';
$lab_ResistAerobExtra[26]='GM';
$lab_ResistAerobExtra[27]='D';
$lab_ResistAerobExtra[28]='OFX';
$lab_ResistAerobExtra[29]='K';

$lab_TestResultId_1[0]='Staph.aureus';
$lab_TestResultId_1[1]='E.coli';
$lab_TestResultId_1[2]='enterob.aerogenes';
$lab_TestResultId_1[3]='Staph.epiderm';
$lab_TestResultId_1[4]='E.colihem.';
$lab_TestResultId_1[5]='Morganel.morganii';
$lab_TestResultId_1[6]='Streptokokk.';
$lab_TestResultId_1[7]='E.colimuc.';
$lab_TestResultId_1[8]='H&#228;mophilus spezies';
$lab_TestResultId_1[9]='h&#228;m.Streptok.';
$lab_TestResultId_1[10]='Proteus';
$lab_TestResultId_1[11]='Salmonella';
$lab_TestResultId_1[12]='verg.Streptok.';
$lab_TestResultId_1[13]='Proteusindolpos.';
$lab_TestResultId_1[14]='Shigella';
$lab_TestResultId_1[15]='GroupA';
$lab_TestResultId_1[16]='Proteusindolneg.';
$lab_TestResultId_1[17]='aerob.Spore';
$lab_TestResultId_1[18]='GroupB';
$lab_TestResultId_1[19]='Pseudomonas';
$lab_TestResultId_1[20]='apath.Coryne';
$lab_TestResultId_1[21]='GroupC';
$lab_TestResultId_1[22]='Ps.aeruginosa';
$lab_TestResultId_1[23]='Bact.frag.';
$lab_TestResultId_1[24]='GroupD';
$lab_TestResultId_1[25]='Klebsiel.species';
$lab_TestResultId_1[26]='Prevotella';
$lab_TestResultId_1[27]='GroupF';
$lab_TestResultId_1[28]='Enterob.cloacae';
$lab_TestResultId_1[29]='Candidaalbic.';
$lab_TestResultId_1[30]='GroupG';
$lab_TestResultId_1[31]='Enterob.agglomerans';
$lab_TestResultId_1[32]='Candid.species';
$lab_TestResultId_1[33]='Packetcocci';
$lab_TestResultId_1[34]='Citrobac.freundii';
$lab_TestResultId_1[35]='Candid.tropicalis';
$lab_TestResultId_1[36]='Neiss.spezies';
$lab_TestResultId_1[37]='Klebs.pneumon.';
$lab_TestResultId_1[38]='Candid.glabr.';
$lab_TestResultId_1[39]='rarePatho';
$lab_TestResultId_1[40]='Klebs.oxytoca';
$lab_TestResultId_1[41]='Aspergillus';
$lab_TestResultId_1[42]='rarePatho';
$lab_TestResultId_1[43]='Campylobactr';
$lab_TestResultId_1[44]='Salmon.enteritid.';
$lab_TestResultId_1[45]='Acinetob.Iwoffi';
$lab_TestResultId_1[46]='Hafniaalvei';
$lab_TestResultId_1[47]='Lactobacil.spec.';
$lab_TestResultId_1[48]='Acinetob.Baumannii';
$lab_TestResultId_1[49]='Serrat.liquefac.';
$lab_TestResultId_1[50]='Stentrop.maltophl.';

$lab_TestResultId_2[0]='No growth after 48 hours';
$lab_TestResultId_2[1]='Aerobe like growth';
$lab_TestResultId_2[2]='Am&#246;bai nstool negative';
$lab_TestResultId_2[3]='No growth after 5 days';
$lab_TestResultId_2[4]='';
$lab_TestResultId_2[5]='Lambia in stool negative';
$lab_TestResultId_2[6]='No growth after 9days';
$lab_TestResultId_2[7]='Gram.neg.Diplococci No Evid.';
$lab_TestResultId_2[8]='Worm eggs.n.stoolneg.';
$lab_TestResultId_2[9]='No Bact.of TPE-Group';
$lab_TestResultId_2[10]='GO-culturenegative';
$lab_TestResultId_2[11]='No growth of E.Coli';
$lab_TestResultId_2[12]='Campylobacter.cultureneg.';
$lab_TestResultId_2[13]='';
$lab_TestResultId_2[14]='Liquorantigen negative';
$lab_TestResultId_2[15]='NoG.Campylobacter.pylori';
$lab_TestResultId_2[16]='NoEvid.microscp.acid.Cylind.';
$lab_TestResultId_2[17]='EHEC egative';
$lab_TestResultId_2[18]='Dyspepsy.Coliserolg.NoEvid';
$lab_TestResultId_2[19]='No growth after 7 days';
$lab_TestResultId_2[20]='';
$lab_TestResultId_2[21]='isolated Spore fungi evident';
$lab_TestResultId_2[22]='';
$lab_TestResultId_2[23]='';
$lab_TestResultId_2[24]='Fungiculture negative';
$lab_TestResultId_2[25]='';
$lab_TestResultId_2[26]='';
$lab_TestResultId_2[27]='Cocci mixflora';
$lab_TestResultId_2[28]='';
$lab_TestResultId_2[29]='';
$lab_TestResultId_2[30]='Cocci.Cylinder.Mixflora';
$lab_TestResultId_2[31]='';
$lab_TestResultId_2[32]='';
$lab_TestResultId_2[33]='Bacteria microscop.NonEvid';
$lab_TestResultId_2[34]='';
$lab_TestResultId_2[35]='';
$lab_TestResultId_2[36]='NoG.oxacil.resist.Staphyloc.';
$lab_TestResultId_2[37]='';
$lab_TestResultId_2[38]='';
?>
