<?php
$areaopt=array();

$areaopt['']='';
$areaopt['all']='Alle Bereiche';
$areaopt['m0']='M0';
$areaopt['m1']='M1';
$areaopt['m2']='M2';
$areaopt['m3']='M3';
$areaopt['m4']='M4';
$areaopt['m5']='M5';
$areaopt['m6']='M6';
$areaopt['m7']='M7';
$areaopt['m8']='M8';
$areaopt['m9']='M9';
$areaopt['all_m']='Alle M Stationen';
$areaopt['p1']='P1';
$areaopt['p2']='P2';
$areaopt['p3']='P3';
$areaopt['p4']='P4';
$areaopt['p5']='P5';
$areaopt['all_p']='All P Stationen';
$areaopt['wards']='All Stationen';
$areaopt['op_room']='OR';
$areaopt['all_op_room']='Alle OP\'s';
$areaopt['lab_read']='Labor (nur lesen)';
$areaopt['lab_write']='Labor (Eingabe)';
$areaopt['tech']='Technik';
$areaopt['acct']='Lohn-Buchhaltung';
$areaopt['personell']='Personalabteilung';
$areaopt['cafe']='Cafeteria';
$areaopt['admit']='Aufnahme';
$areaopt['medocs']='Medocs';
$areaopt['duty_op']='OP Dienstplan';
$areaopt['doc']='Ärzte';
$areaopt['doc_op']='OP Ärzte';
$areaopt['pharma']='Apotheke';
$areaopt['meddepot']='Medicallager';
$areaopt['radio']='Radiologie';
$areaopt['news']='Redaktion';
$areaopt['fotolab']='Fotolab';
$areaopt['test_order']='Konsil schreiben';
$areaopt['test_receive']='Konsil empfangen';
$areaopt['test_diagnose']='Konsil befunden';

$area_opt=array(
							/* Group start*/
                           'title1' => 'Adgang til:',
                           '_a_0_all' => 'Alle områder',
						   
							/* Group start*/
                           'title_adm' => 'Mottak',
						   '_a_1_admissionwrite' => 'Motta pasienter, les & skriv',
						   '_a_2_admissionread' =>  'Motta pasienter, bare les',
						   
							/* Group start*/
                           'title2' => 'Sykepleie post',
						   '_a_1_nursingstationallwrite' => 'Alle poster, les & skriv',
						   '_a_2_nursingstationallread' =>  'Alle poster, bare les',
						   '_a_1_nursingdutyplanwrite' => 'posts arbeidsplan, les og skriv',
						   '_a_2_nursingdutyplanread' =>  'posts arbeidsplan, bare les',
							/* Group start*/
						   'title3' => 'Tester, Diagnose, konsultering',
						   '_a_1_diagnosticsresultwrite' => 'Diagnostics results read  & write',
						   '_a_3_diagnosticsresultread' => 'Diagnostics results read only',
						   '_a_2_diagnosticsreceptionwrite'=> 'Diagnostics Request reception, read & write',
						   '_a_3_diagnosticsrequest' => 'Diagnostics Request, request only',
						   
							/* Group start*/
						   'title4' => 'Laboratorie',
						   '_a_1_labresultswrite' => 'resultater, les & skriv',
						   '_a_2_labresultsread' => 'resultater, bare les',
						   
							/* Group start*/
						   'title5' => 'Operasjonsrom',
						   '_a_1_opdoctorallwrite' => 'Alle kirurgiske dokumenter, les & skriv',
						   '_a_2_opnurseallwrite' => 'Alle sykepleie dokumenter, les & skriv',
						   '_a_3_opnurseallread' => 'Allt, bare les',
						   '_a_1_opnursedutyplanwrite' => 'sykepleie - arbeidsplan, les & skriv',
						   '_a_2_opnursedutyplanread' => 'sykepleie - arbeidsplan, bare les',
						   
							/* Group start*/
						   'title6' => 'Radiologi',
						   '_a_1_radiowrite' => 'Radiology display, diagnosis read & write',
						   '_a_2_radioread' => 'Radiology display  only, diagnosis read only',
						   
							/* Group start*/
						   'title7' => 'Medisinske dokumenter',
						   '_a_1_medocswrite' => 'les & skriv',
						   '_a_2_medocsread' => 'bare les',
						   
							/* Group start*/
						   'title8' => 'Apotek',
						  '_a_1_pharmadbadmin' => 'Database admin',
						  '_a_2_pharmareception' => 'Aktiver Ordrerobot, motta &  prosseser ordre',
						  '_a_3_pharmaorder' => 'Send & les ordre',
						  '_a_4_pharmaread' => 'Bare les ordre',
						   
							/* Group start*/
						   'title9' => 'Medisinsk depot',
						  '_a_1_meddepotdbadmin' => 'Database admin',
						  '_a_2_meddepotreception' => 'Aktiver Medirobot, motta & prosseser ordre',
						  '_a_3_meddepotorder' => 'Send & les ordre',
						  '_a_4_meddepotread' => 'Bare & ordre',
						  
							/* Group start*/
						   'title_docs' => 'Doktor',
						  '_a_1_doctorsdutyplanwrite' => 'Arbeidsplan, les & skriv',
						  '_a_2_doctorsdutyplanread' => 'Arbeidspaln, bare les',
						  
							/* Group start*/
						   'title_foto' => 'Photo Studio',
						  '_a_1_photowrite' => 'Photos upload, read and write',
						  '_a_2_photoread' => 'Photos display & read only',
						  
							/* Group start*/
						   'title_tech' => 'Teknisk support',
						  '_a_1_techreception' => 'Qbot & Repabot activate, receive, read and write',
						  
							/* Group start*/
						   'title_pdo' => 'Personell Duty Organizer',
						  '_a_1_timestampallwrite' => 'Personell timestamp (all areas) manage, read & write',
						  '_a_2_timestampallread' => 'Personell timestamp read only',
						  '_a_1_dutyplanallwrite' => 'Personell Duty/Leave plan (all areas) manage, read & write',
						  '_a_2_dutyplanallread' => 'Personell Duty/Leave plan read only',
						  
							/* Group start*/
						   'title_bill' => 'Regning',
						  '_a_1_billallwrite' => 'Billing (all areas) read & write',
						  '_a_2_billallread' => 'Billing (all areas) read only',
						  '_a_2_billpharmawrite' => 'Billing (pharmacy) read & write',
						  '_a_3_billpharmaread' => 'Billing (pharmacy) read only',
						  '_a_2_billserviceswrite' => 'Billing (services) read & write',
						  '_a_3_billservicesread' => 'Billing (services) read only',
						  '_a_2_billlabwrite' => 'Billing (laboratory) read & write',
						  '_a_3_billlabread' => 'Billing (laboratory) read only',
						  
							/* Group start*/
						   'title_news' => 'Nyheter',
						  '_a_1_newsallwrite' => 'News (all areas) write',
						  '_a_2_newscafewrite' => 'Cafe news, menu, prices write',
						  '_a_2_newsallmoderatedwrite' => 'News (all areas, except menu & prices) moderated write',
						  
							/* Group start*/
						   'title_dir' => 'Telefon katalog',
						  '_a_1_teldirwrite' => 'Telefon & søker informasjon, skriv',
						);
?>
