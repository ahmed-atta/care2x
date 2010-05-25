-- 
-- Dumping data for table `care_department`
-- 

INSERT INTO `care_department` (`nr`, `id`, `type`, `name_formal`, `name_short`, `name_alternate`, `LD_var`, `description`, `admit_inpatient`, `admit_outpatient`, `has_oncall_doc`, `has_oncall_nurse`, `does_surgery`, `this_institution`, `is_sub_dept`, `parent_dept_nr`, `work_hours`, `consult_hours`, `is_inactive`, `sort_order`, `address`, `sig_line`, `sig_stamp`, `logo_mime_type`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`) VALUES (1, 'pr', '2', 'Public Relations', 'PR', 'Press Relations', 'LDPressRelations', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 1, 0, NULL, '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:21:08', '', '0000-00-00 00:00:00'),
(2, 'cafe', '2', 'Cafeteria', 'Cafe', 'Canteen', 'LDCafeteria', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 1, 0, NULL, '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:09:15', '', '0000-00-00 00:00:00'),
(3, 'general_surgery', '1', 'General Surgery', 'General', 'General', 'LDGeneralSurgery', '', 1, 1, 1, 1, 1, 1, 0, 0, '8.30 - 21.00', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '2003-08-28 11:43:27', '', '0000-00-00 00:00:00'),
(4, 'emergency_surgery', '1', 'Emergency Surgery', 'Emergency', '', 'LDEmergencySurgery', '', 1, 1, 1, 1, 1, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 1, 0, NULL, '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:17:35', '', '0000-00-00 00:00:00'),
(5, 'plastic_surgery', '1', 'Plastic Surgery', 'Plastic', 'Aesthetic Surgery', 'LDPlasticSurgery', '', 1, 1, 1, 1, 1, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 1, 0, NULL, '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:21:11', '', '0000-00-00 00:00:00'),
(6, 'ent', '1', 'Ear-Nose-Throath', 'ENT', 'HNO', 'LDEarNoseThroath', 'Ear-Nose-Throath, in german Hals-Nasen-Ohren. The department with  very old traditions that date back to the early beginnings of premodern medicine.', 1, 1, 1, 1, 1, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 1, 0, NULL, '', 'kope akjdielj asdlkasdf', '', 'hidden', 'Update: 2003-08-13 23:24:16 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:25:27 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:29:05 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:30:21 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:31:52 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:34:08 Elpidio Latorilla\r\n', 'Aklei G. Kessy', '2005-06-29 11:17:09', '', '0000-00-00 00:00:00'),
(7, 'opthalmology', '1', 'Opthalmology', 'Opthalmology', 'Eye Department', 'LDOpthalmology', '', 1, 1, 1, 1, 1, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, '', '', '', '', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(8, 'pathology', '1', 'Pathology', 'Pathology', 'Patho', 'LDPathology', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 1, 0, '', '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:20:33', '', '0000-00-00 00:00:00'),
(9, 'ob_gyn', '1', 'Ob-Gynecology', 'Ob-Gyne', 'Gyn', 'LDObGynecology', '', 1, 1, 1, 1, 1, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, '', '', '', '', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(10, 'physical_therapy', '1', 'Physical Therapy', 'Physical', 'PT', 'LDPhysicalTherapy', 'Physical therapy department with on-call therapists. Day care clinics, training, rehab.', 1, 0, 1, 1, 0, 1, 1, 16, '8:00 - 15:00', '12.30 - 15.00 , 19.00 - 21.00', 1, 0, '', '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:21:15', '', '0000-00-00 00:00:00'),
(11, 'internal_med', '1', 'Internal Medicine', 'Internal Med', 'InMed', 'LDInternalMedicine', '', 1, 1, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(12, 'imc', '1', 'Intermediate Care Unit', 'IMC', 'Intermediate', 'LDIntermediateCareUnit', '', 1, 1, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 1, 0, '', '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:18:22', '', '0000-00-00 00:00:00'),
(13, 'icu', '1', 'Intensive Care Unit', 'ICU', 'Intensive', 'LDIntensiveCareUnit', '', 1, 1, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 1, 0, '', '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:18:23', '', '0000-00-00 00:00:00'),
(14, 'emergency_ambulatory', '1', 'Emergency Ambulatory', 'Emergency', 'Emergency Amb', 'LDEmergencyAmbulatory', '', 0, 1, 1, 1, 0, 1, 1, 4, '', '12.30 - 15.00 , 19.00 - 21.00', 1, 0, '', '', '', '', 'hidden', 'Update: 2003-09-23 00:06:27 Elpidio Latorilla\n', 'Aklei G. Kessy', '2005-06-29 11:17:36', '', '0000-00-00 00:00:00'),
(15, 'general_ambulatory', '1', 'General Ambulatory', 'Ambulatory', 'General Amb', 'LDGeneralAmbulatory', '', 0, 1, 1, 1, 0, 1, 1, 3, 'round the clock', '12.30 - 15.00 , 19.00 - 21.00', 1, 0, '', '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:17:33', '', '0000-00-00 00:00:00'),
(16, 'inmed_ambulatory', '1', 'Internal Medicine Ambulatory', 'InMed Ambulatory', 'InMed Amb', 'LDInternalMedicineAmbulatory', '', 0, 1, 1, 1, 0, 1, 1, 11, '', '12.30 - 15.00 , 19.00 - 21.00', 1, 0, '', '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:19:51', '', '0000-00-00 00:00:00'),
(17, 'sonography', '1', 'Sonography', 'Sono', 'Ultrasound diagnostics', 'LDSonography', '', 0, 1, 1, 1, 0, 1, 1, 11, '', '12.30 - 15.00 , 19.00 - 21.00', 1, 0, '', '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:21:51', '', '0000-00-00 00:00:00'),
(18, 'nuclear_diagnostics', '1', 'Nuclear Diagnostics', 'Nuclear', 'Nuclear Testing', 'LDNuclearDiagnostics', '', 0, 1, 1, 1, 0, 1, 1, 19, '', '12.30 - 15.00 , 19.00 - 21.00', 1, 0, '', '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:19:32', '', '0000-00-00 00:00:00'),
(19, 'pediatric', '1', 'Pediatric clinic', 'Pediatric clinic', 'Pediatric clinic', 'LDPediatric', '', 0, 1, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '2006-01-24 11:41:02', '', '0000-00-00 00:00:00'),
(20, 'oncology', '1', 'Oncology', 'Oncology', 'Cancer Department', 'LDOncology', '', 1, 1, 1, 1, 1, 1, 0, 11, '', '12.30 - 15.00 , 19.00 - 21.00', 1, 0, NULL, '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:20:16', '', '0000-00-00 00:00:00'),
(21, 'neonatal', '1', 'Neonatal', 'Neonatal', 'Newborn Department', 'LDNeonatal', '', 1, 1, 1, 1, 1, 1, 1, 9, '', '12.30 - 15.00 , 19.00 - 21.00', 1, 0, NULL, '343', '', '', 'hidden', 'Update: 2003-08-13 22:32:07 Elpidio Latorilla\nUpdate: 2003-08-13 22:33:10 Elpidio Latorilla\nUpdate: 2003-08-13 22:43:39 Elpidio Latorilla\nUpdate: 2003-08-13 22:43:59 Elpidio Latorilla\nUpdate: 2003-08-13 22:44:19 Elpidio Latorilla\n', 'Aklei G. Kessy', '2005-06-29 11:19:35', '', '0000-00-00 00:00:00'),
(22, 'central_lab', '1', 'Central Laboratory', 'Central Lab', 'General Lab', 'LDCentralLaboratory', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', 'kdkdododospdfjdasljfda\r\nasdflasdjf\r\nasdfklasdjflasdjf', '', '', 'Update: 2003-08-13 23:12:30 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:14:59 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:15:28 Elpidio Latorilla\r\n', 'Elpidio Latorilla', '2003-08-28 11:42:43', '', '0000-00-00 00:00:00'),
(23, 'serological_lab', '1', 'Serological Laboratory', 'Serological Lab', 'Serum Lab', 'LDSerologicalLaboratory', '', 0, 1, 1, 1, 0, 1, 1, 22, '', '12.30 - 15.00 , 19.00 - 21.00', 1, 0, '', '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:21:55', '', '0000-00-00 00:00:00'),
(24, 'chemical_lab', '1', 'Chemical Laboratory', 'Chemical Lab', 'Chem Lab', 'LDChemicalLaboratory', '', 0, 1, 1, 1, 0, 1, 1, 22, '', '12.30 - 15.00 , 19.00 - 21.00', 1, 0, '', '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:09:28', '', '0000-00-00 00:00:00'),
(25, 'bacteriological_lab', '1', 'Bacteriological Laboratory', 'Bacteriological Lab', 'Bacteria Lab', 'LDBacteriologicalLaboratory', '', 0, 1, 1, 1, 0, 1, 1, 22, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(26, 'tech', '2', 'Technical Maintenance', 'Tech', 'Technical Support', 'LDTechnicalMaintenance', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 0, 0, '', '', '', 'jpg', '', 'Update: 2003-08-10 23:42:30 Elpidio Latorilla\n', 'Elpidio Latorilla', '2003-08-10 23:42:30', '', '0000-00-00 00:00:00'),
(27, 'it', '2', 'IT Department', 'IT', 'EDP', 'LDITDepartment', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 1, 0, '', '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:19:43', '', '0000-00-00 00:00:00'),
(28, 'management', '2', 'Management', 'Management', 'Busines Administration', 'LDManagement', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 1, 0, '', '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:19:40', '', '0000-00-00 00:00:00'),
(29, 'exhibition', '3', 'Exhibitions', 'Exhibit', 'Showcases', 'LDExhibitions', '', 0, 0, 1, 1, 1, 1, 0, 0, '', '', 1, 0, NULL, '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:17:34', '', '0000-00-00 00:00:00'),
(30, 'edu', '3', 'Education', 'Edu', 'Training', 'LDEducation', 'Education news bulletin of the hospital.', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 1, 0, '', '', '', '', 'hidden', 'Update: 2003-08-13 22:44:45 Elpidio Latorilla\nUpdate: 2003-08-13 23:00:37 Elpidio Latorilla\n', 'Aklei G. Kessy', '2005-06-29 11:17:12', '', '0000-00-00 00:00:00'),
(31, 'study', '3', 'Studies', 'Studies', 'Advance studies or on-the-job training', 'LDStudies', '', 0, 0, 1, 1, 1, 1, 0, 0, '', '', 1, 0, NULL, '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:21:48', '', '0000-00-00 00:00:00'),
(32, 'health_tip', '3', 'Health Tips', 'Tips', 'Health Information', 'LDHealthTips', '', 0, 0, 1, 1, 1, 1, 0, 0, '', '', 1, 0, NULL, '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:18:27', '', '0000-00-00 00:00:00'),
(33, 'admission', '2', 'Admission', 'Admit', 'Admission information', 'LDAdmission', '', 0, 0, 1, 1, 1, 0, 1, 0, '', '', 1, 0, NULL, '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:08:29', '', '0000-00-00 00:00:00'),
(34, 'news_headline', '3', 'Headline', 'News head', 'Major news', 'LDHeadline', '', 0, 0, 1, 1, 1, 1, 0, 0, '', '', 1, 0, NULL, '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:18:03', '', '0000-00-00 00:00:00'),
(35, 'cafenews', '3', 'Cafe News', 'Cafe news', 'Cafeteria news', 'LDCafeNews', '', 0, 0, 1, 1, 1, 0, 0, 0, '', '', 1, 0, NULL, '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:09:16', '', '0000-00-00 00:00:00'),
(36, 'nursing', '3', 'Nursing', 'Nursing', 'Nursing care', 'LDNursing', '', 1, 1, 1, 1, 1, 1, 1, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(37, 'doctors', '3', 'Doctors', 'Doctors', 'Medical personell', 'LDDoctors', '', 0, 0, 1, 1, 1, 1, 0, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(38, 'pharmacy', '2', 'Pharmacy', 'Pharma', 'Drugstore', 'LDPharmacy', '', 0, 0, 1, 1, 1, 1, 0, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(39, 'anaesthesiology', '1', 'Anesthesiology', 'ana', 'Anesthesia Department', 'LDAnesthesiology', 'Anesthesiology', 0, 0, 1, 1, 1, 1, 0, 0, '', '', 1, 0, '', '', '', '', 'hidden', '', 'Aklei G. Kessy', '2005-06-29 11:08:31', '', '0000-00-00 00:00:00'),
(40, 'general_ambulant', '1', 'General Outpatient Clinic', 'General Clinic', 'General Ambulatory Clinic', 'LDGeneralOutpatientClinic', 'Outpatient/Ambulant Clinic for general/internal medicine', 0, 1, 1, 1, 0, 0, 1, 16, 'round the clock', '8:30 AM - 11:30 AM , 2:00 PM - 5:30 PM', 0, 0, '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(41, 'blood_bank', '1', 'Blood Bank', 'Blood Blank', 'Blood Lab', 'LDBloodBank', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 0, 0, '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(42, 'arv_clinic', '1', 'ARV Clinic', 'ARV Clinic', 'ARV lab', 'LDARVClinic', '', 0, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, '', 'Create: 2005-06-29 12:14:02 Aklei G. Kessy', 'Aklei G. Kessy', '2005-06-29 11:14:02', 'Aklei G. Kessy', '2005-06-29 11:14:02'),
(43, 'dental_clinic', '1', 'Dental Clinic', 'Dental Clinic', 'Dental Lab', 'LDDentalClinic', '', 0, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, '', 'Create: 2005-06-29 12:15:54 Aklei G. Kessy', 'Aklei G. Kessy', '2005-06-29 11:15:54', 'Aklei G. Kessy', '2005-06-29 11:15:54'),
(44, 'ortho_clinic', '1', 'Orthopedic Clinic', '', NULL, 'LDOrthopedic', '', 0, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, '', 'Create: 2007-01-29 09:30:30 Niemi', 'Niemi', '2007-01-29 07:30:30', 'Niemi', '2007-01-29 07:30:30'),
(45, 'dressing', '1', 'Dressing', '', NULL, 'LDDressing', '', 1, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, '', 'Create: 2007-01-29 09:34:18 Niemi', 'Niemi', '2007-01-29 07:34:18', 'Niemi', '2007-01-29 07:34:18'),
(46, 'surgery', '1', 'Plastic Surgery', '', NULL, 'LDPSurgery', '', 1, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, '', 'Create: 2007-01-29 09:47:13 NiemiUpdate: 2007-01-29 09:47:29 Niemi\n', 'Niemi', '2007-01-29 07:47:29', 'Niemi', '2007-01-29 07:47:13'),
(47, 'tb', '1', 'TB', '', NULL, 'LDTb', '', 0, 1, 1, 1, 0, 1, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, '', 'Create: 2007-01-30 16:12:08 Niemi', 'Niemi', '2007-01-30 14:12:08', 'Niemi', '2007-01-30 14:12:08');
