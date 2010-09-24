/*
Default Sample User Roles - GJ - List 2
*/

INSERT INTO `care_user_roles` (`id`, `role_name`, `permission`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`) VALUES 
(1, 'Archive', '_a_2_admissionread _a_2_nursingstationallread _a_2_nursingdutyplanread _a_2_opnursedutyplanread _a_2_medocsread _a_2_doctorsdutyplanread _a_2_timestampallread _a_2_dutyplanallread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(2, 'Billing', '_a_1_admissionwrite _a_2_admissionread _a_2_nursingstationallread _a_1_billallwrite ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(3, 'Blood_Bank', '_a_1_admissionwrite _a_1_diagnosticsresultwrite _a_1_labresultswrite _a_2_labresultsread _a_1_medocswrite _a_2_medocsread _a_3_pharmaorder _a_2_doctorsdutyplanread _a_1_techreception _a_2_timestampallread _a_2_dutyplanallread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(4, 'Doctor_Department', '_a_2_admissionread _a_1_nursingstationallwrite _a_2_nursingdutyplanread _a_1_diagnosticsresultwrite _a_2_diagnosticsreceptionwrite _a_2_labresultsread _a_1_radiowrite _a_1_medocswrite _a_3_pharmaorder _a_4_pharmaread _a_2_doctorsdutyplanread _a_1_photowrite _a_2_timestampallread _a_2_dutyplanallread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(5, 'Doctor_Imaging', '_a_2_admissionread _a_1_diagnosticsresultwrite _a_2_diagnosticsreceptionwrite _a_1_radiowrite _a_1_medocswrite _a_2_doctorsdutyplanread _a_1_photowrite _a_2_timestampallread _a_2_dutyplanallread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(6, 'Doctor_Lab', '_a_2_admissionread _a_1_nursingdutyplanwrite _a_1_diagnosticsresultwrite _a_2_diagnosticsreceptionwrite _a_1_laball _a_1_labresultswrite _a_1_medocswrite _a_1_doctorsdutyplanwrite _a_2_doctorsdutyplanread _a_1_photowrite _a_2_photoread _a_2_timestampallread _a_2_dutyplanallread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(7, 'Doctor_Surgery', '_a_2_admissionread _a_1_nursingstationallwrite _a_2_nursingdutyplanread _a_1_diagnosticsresultwrite _a_2_diagnosticsreceptionwrite _a_2_labresultsread _a_1_opdoctorallwrite _a_2_opnurseallwrite _a_3_opnurseallread _a_2_opnursedutyplanread _a_1_radiowrite _a_1_medocswrite _a_3_pharmaorder _a_4_pharmaread _a_2_doctorsdutyplanread _a_1_photowrite _a_2_photoread _a_2_timestampallread _a_2_dutyplanallread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(8, 'Head_Department', '_a_2_admissionread _a_1_nursingstationallwrite _a_1_nursingdutyplanwrite _a_1_diagnosticsresultwrite _a_2_diagnosticsreceptionwrite _a_1_labresultswrite _a_1_radiowrite _a_1_medocswrite _a_3_pharmaorder _a_1_doctorsdutyplanwrite _a_1_photowrite _a_1_timestampallwrite _a_1_dutyplanallwrite ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(9, 'Head_HR', '_a_1_admissionwrite _a_1_timestampallwrite _a_2_timestampallread _a_1_dutyplanallwrite _a_2_dutyplanallread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(10, 'Head_Medical_Commission', '_a_2_admissionread _a_1_nursingstationallwrite _a_2_nursingstationallread _a_1_nursingdutyplanwrite _a_2_nursingdutyplanread _a_1_diagnosticsresultwrite _a_2_diagnosticsreceptionwrite _a_3_diagnosticsrequest _a_1_laball _a_1_labresultswrite _a_2_labresultsread _a_1_opdoctorallwrite _a_2_opnurseallwrite _a_3_opnurseallread _a_1_opnursedutyplanwrite _a_2_opnursedutyplanread _a_1_radiowrite _a_2_radioread _a_1_medocswrite _a_2_medocsread _a_3_pharmaorder _a_4_pharmaread _a_1_doctorsdutyplanwrite _a_2_doctorsdutyplanread _a_1_photowrite _a_2_photoread _a_1_timestampallwrite _a_2_timestampallread _a_1_dutyplanallwrite _a_2_dutyplanallread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(11, 'Head_Surgery', '_a_2_admissionread _a_1_nursingstationallwrite _a_1_nursingdutyplanwrite _a_1_diagnosticsresultwrite _a_1_labresultswrite _a_1_opdoctorallwrite _a_1_opnursedutyplanwrite _a_1_radiowrite _a_2_radioread _a_1_medocswrite _a_3_pharmaorder _a_4_pharmaread _a_1_doctorsdutyplanwrite _a_1_photowrite _a_1_timestampallwrite _a_1_dutyplanallwrite ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(12, 'Head_Nurse_Department', '_a_2_admissionread _a_1_nursingstationallwrite _a_1_nursingdutyplanwrite _a_3_diagnosticsrequest _a_2_labresultsread _a_2_radioread _a_1_medocswrite _a_2_medocsread _a_1_doctorsdutyplanwrite _a_2_photoread _a_2_timestampallread _a_2_dutyplanallread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(13, 'Head_Nurse_Department+Pharmacy', '_a_2_admissionread _a_1_nursingstationallwrite _a_1_nursingdutyplanwrite _a_3_diagnosticsrequest _a_2_labresultsread _a_2_radioread _a_1_medocswrite _a_2_medocsread _a_3_pharmaorder _a_4_pharmaread _a_1_doctorsdutyplanwrite _a_2_doctorsdutyplanread _a_2_photoread _a_2_timestampallread _a_2_dutyplanallread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(14, 'Head_Nurse_Lab+Pharmacy', '_a_2_admissionread _a_2_nursingstationallread _a_1_nursingdutyplanwrite _a_1_labresultswrite _a_1_medocswrite _a_3_pharmaorder _a_1_doctorsdutyplanwrite _a_2_photoread _a_2_timestampallread _a_2_dutyplanallread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(15, 'Head_Nurse_Surgery', '_a_2_admissionread _a_1_nursingstationallwrite _a_1_nursingdutyplanwrite _a_3_diagnosticsrequest _a_2_labresultsread _a_2_opnurseallwrite _a_1_opnursedutyplanwrite _a_2_radioread _a_1_medocswrite _a_1_doctorsdutyplanwrite _a_2_photoread _a_2_timestampallread _a_2_dutyplanallread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(16, 'Head_Nurse_Surgery+Pharmacy', '_a_2_admissionread _a_1_nursingstationallwrite _a_1_nursingdutyplanwrite _a_3_diagnosticsrequest _a_2_labresultsread _a_2_opnurseallwrite _a_1_opnursedutyplanwrite _a_2_radioread _a_1_medocswrite _a_3_pharmaorder _a_1_doctorsdutyplanwrite _a_2_photoread _a_2_timestampallread _a_2_dutyplanallread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(17, 'Nurse_General', '_a_2_admissionread _a_1_nursingstationallwrite _a_2_nursingdutyplanread _a_3_diagnosticsrequest _a_2_labresultsread _a_2_medocsread _a_2_doctorsdutyplanread _a_2_timestampallread _a_2_dutyplanallread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(18, 'Nurse_Midwife', '_a_1_admissionwrite _a_2_admissionread _a_1_nursingstationallwrite _a_2_nursingstationallread _a_1_nursingdutyplanwrite _a_2_nursingdutyplanread _a_3_diagnosticsrequest _a_2_labresultsread _a_1_opdoctorallwrite _a_2_opnurseallwrite _a_3_opnurseallread _a_2_opnursedutyplanread _a_2_radioread _a_2_medocsread _a_2_doctorsdutyplanread _a_2_photoread _a_2_timestampallread _a_2_dutyplanallread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(19, 'Nurse_Registration', '_a_1_admissionwrite _a_2_admissionread _a_1_nursingstationallwrite _a_2_nursingstationallread _a_1_nursingdutyplanwrite _a_2_nursingdutyplanread _a_2_opnursedutyplanread _a_2_medocsread _a_2_doctorsdutyplanread _a_2_timestampallread _a_2_dutyplanallread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(20, 'Nurse_Surgery', '_a_2_admissionread _a_1_nursingstationallwrite _a_2_nursingdutyplanread _a_3_diagnosticsrequest _a_2_labresultsread _a_2_opnurseallwrite _a_3_opnurseallread _a_2_opnursedutyplanread _a_2_radioread _a_2_medocsread _a_2_doctorsdutyplanread _a_2_timestampallread _a_2_dutyplanallread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(21, 'Information_Office', '_a_2_admissionread _a_2_nursingstationallread _a_2_nursingdutyplanread _a_2_opnursedutyplanread _a_2_medocsread _a_2_doctorsdutyplanread _a_2_timestampallread _a_2_dutyplanallread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(22, 'Lab_Technicial_Department', '_a_1_nursingstationallwrite _a_2_nursingstationallread _a_1_nursingdutyplanwrite _a_2_nursingdutyplanread _a_3_diagnosticsrequest _a_2_labresultsread _a_2_radioread _a_2_medocsread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(23, 'Lab_Technician', '_a_2_admissionread _a_2_nursingdutyplanread _a_1_labresultswrite _a_1_medocswrite _a_2_doctorsdutyplanread _a_1_techreception _a_2_timestampallread _a_2_dutyplanallread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(24, 'Legal_Doctor', '_a_2_admissionread _a_1_nursingstationallwrite _a_2_nursingstationallread _a_1_nursingdutyplanwrite _a_2_nursingdutyplanread _a_1_diagnosticsresultwrite _a_3_diagnosticsresultread _a_2_diagnosticsreceptionwrite _a_3_diagnosticsrequest _a_1_labresultswrite _a_2_labresultsread _a_1_opdoctorallwrite _a_2_opnurseallwrite _a_3_opnurseallread _a_1_opnursedutyplanwrite _a_2_opnursedutyplanread _a_1_radiowrite _a_2_radioread _a_1_medocswrite _a_2_medocsread _a_1_doctorsdutyplanwrite _a_2_doctorsdutyplanread _a_1_teldirwrite ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(25, 'Med_Depot_Hospital', '_a_1_meddepotdbadmin _a_2_meddepotreception _a_3_meddepotorder _a_4_meddepotread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(26, 'Obstetrics_Gynecology', '_a_2_admissionread _a_1_nursingstationallwrite _a_2_nursingdutyplanread _a_1_diagnosticsresultwrite _a_2_diagnosticsreceptionwrite _a_1_labresultswrite _a_1_opdoctorallwrite _a_2_opnursedutyplanread _a_1_radiowrite _a_2_radioread _a_1_medocswrite _a_3_pharmaorder _a_4_pharmaread _a_2_doctorsdutyplanread _a_1_photowrite _a_2_timestampallread _a_2_dutyplanallread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(27, 'Pharmacy_Department', '_a_1_nursingstationallwrite _a_2_nursingstationallread _a_3_pharmaorder _a_4_pharmaread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(28, 'Pharmacy_Hospital', '_a_1_pharmadbadmin _a_2_pharmareception _a_3_pharmaorder _a_4_pharmaread _a_3_meddepotorder _a_1_techreception _a_2_timestampallread _a_2_dutyplanallread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(29, 'Pharmacy_Imaging', '_a_1_admissionwrite _a_1_radiowrite _a_3_pharmaorder _a_2_doctorsdutyplanread _a_1_photowrite _a_2_photoread _a_2_timestampallread _a_2_dutyplanallread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(30, 'Secretary', '_a_2_admissionread _a_2_nursingstationallread _a_2_nursingdutyplanread _a_2_opnursedutyplanread _a_2_medocsread _a_2_doctorsdutyplanread _a_2_photoread _a_2_timestampallread _a_2_dutyplanallread _a_1_newsallwrite _a_2_newscafewrite _a_2_newsallmoderatedwrite _a_1_teldirwrite ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(31, 'Sterilisation', '_a_3_pharmaorder _a_1_techreception ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(32, 'Tech_Hospital', '_a_1_techreception ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(33, 'Care2x_Technician', '_a_1_admissionwrite _a_2_admissionread _a_1_nursingstationallwrite _a_2_nursingstationallread _a_1_nursingdutyplanwrite _a_2_nursingdutyplanread _a_1_diagnosticsresultwrite _a_3_diagnosticsresultread _a_2_diagnosticsreceptionwrite _a_3_diagnosticsrequest _a_1_opdoctorallwrite _a_2_opnurseallwrite _a_3_opnurseallread _a_1_opnursedutyplanwrite _a_2_opnursedutyplanread _a_1_radiowrite _a_2_radioread _a_1_medocswrite _a_2_medocsread ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(34, 'Medical_Consultant', '_a_0_all ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00'),
(35, 'Supervisor', '_a_0_all ', '', '', '0000-00-00 00:00:00', '', '2010-09-24 12:00:00');
