#
# This updates only a care2x database beta version 1.0.05 to beta version 1.0.06
#

#
# Tabellenstruktur für Tabelle care_test_findings_chemlab
#

CREATE TABLE care_test_findings_chemlab (
   batch_nr int(11) DEFAULT '0' NOT NULL auto_increment,
   encounter_nr int(11) DEFAULT '0' NOT NULL,
   job_id varchar(25) NOT NULL,
   test_date date DEFAULT '0000-00-00' NOT NULL,
   test_time time DEFAULT '00:00:00' NOT NULL,
   group_id varchar(30) NOT NULL,
   serial_value text NOT NULL,
   validator varchar(15) NOT NULL,
   validate_dt datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   status varchar(20) NOT NULL,
   history text NOT NULL,
   modify_id varchar(35) NOT NULL,
   modify_time timestamp(14),
   create_id varchar(35) NOT NULL,
   create_time timestamp(14),
   PRIMARY KEY (batch_nr)
);


ALTER TABLE care_phone CHANGE beruf beruf VARCHAR( 25 ) DEFAULT NULL ,
CHANGE bereich1 bereich1 VARCHAR( 25 ) DEFAULT NULL ,
CHANGE bereich2 bereich2 VARCHAR( 25 ) DEFAULT NULL ,
CHANGE inphone1 inphone1 VARCHAR( 15 ) DEFAULT NULL ,
CHANGE inphone2 inphone2 VARCHAR( 15 ) DEFAULT NULL ,
CHANGE inphone3 inphone3 VARCHAR( 15 ) DEFAULT NULL ,
CHANGE exphone1 exphone1 VARCHAR( 25 ) DEFAULT NULL ,
CHANGE exphone2 exphone2 VARCHAR( 25 ) DEFAULT NULL ,
CHANGE funk1 funk1 VARCHAR( 15 ) DEFAULT NULL ,
CHANGE funk2 funk2 VARCHAR( 15 ) DEFAULT NULL ,
CHANGE roomnr roomnr VARCHAR( 10 ) DEFAULT NULL;

# Adds new field in the care_encounter table

ALTER TABLE care_encounter ADD in_dept TINYINT( 1 ) NOT NULL AFTER current_dept_nr;

# Alter "types" table fields

ALTER TABLE care_type_feeding CHANGE type_nr nr SMALLINT( 2 ) UNSIGNED DEFAULT '0' NOT NULL AUTO_INCREMENT;

ALTER TABLE care_type_outcome CHANGE type_nr nr SMALLINT( 2 ) UNSIGNED DEFAULT '0' NOT NULL AUTO_INCREMENT;

ALTER TABLE care_type_perineum CHANGE type_nr nr SMALLINT( 2 ) UNSIGNED DEFAULT '0' NOT NULL AUTO_INCREMENT;

# Alter fields

ALTER TABLE care_neonatal CHANGE face_presentation face_presentation TINYINT( 1 ) DEFAULT '0' NOT NULL;

# Delete all entries care_method_induction

DELETE FROM care_method_induction;

# Insert new data

INSERT INTO care_method_induction VALUES (1, '1', 'not_induced', 'Not induced', 'LDNotInduced', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_method_induction VALUES (2, '1', 'unknown', 'Unknown', 'LDUnknown', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_method_induction VALUES (3, '1', 'prostaglandin', 'Prostaglandin', 'LDProstaglandin', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_method_induction VALUES (4, '1', 'oxytocin', 'Oxytocin', 'LDOxytocin', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_method_induction VALUES (5, '1', 'arom', 'AROM', 'LDAROM', '', '', '', 00000000000000, '', 00000000000000);


# Insert additional perineum type

INSERT INTO care_type_perineum VALUES (5, 'episiotomy', 'Episiotomy', 'LDEpisiotomy', '', '', '', 00000000000000, '', 00000000000000);

# update version info

UPDATE care_version SET number='1.0.06', date='2003-08-06' WHERE number='1.0.05';

# Update the main menu item

UPDATE care_menu_main SET name='Person', LD_var='LDPerson' WHERE nr='2';

#
# Tabellenstruktur für Tabelle care_test_group
#

CREATE TABLE care_test_group (
   nr smallint(5) unsigned DEFAULT '0' NOT NULL auto_increment,
   group_id varchar(35) NOT NULL,
   name varchar(35) NOT NULL,
   sort_nr tinyint(4) DEFAULT '0' NOT NULL,
   status varchar(25) NOT NULL,
   modify_id varchar(35) NOT NULL,
   modify_time timestamp(14),
   create_id varchar(35) NOT NULL,
   create_time timestamp(14),
   PRIMARY KEY (nr),
   UNIQUE group_id (group_id)
);

#
# Daten für Tabelle care_test_group
#

INSERT INTO care_test_group VALUES (1, 'priority', 'Priority', '5', '', '', 20030711164456, '', 20030711164402);
INSERT INTO care_test_group VALUES (2, 'clinical_chem', 'Clinical chemistry', '10', '', '', 20030711164607, '', 20030711164549);
INSERT INTO care_test_group VALUES (3, 'liquor', 'Liquor', '15', '', '', 20030711164647, '', 00000000000000);
INSERT INTO care_test_group VALUES (4, 'coagulation', 'Coagulation', '20', '', '', 20030711164722, '', 00000000000000);
INSERT INTO care_test_group VALUES (5, 'hematology', 'Hematology', '25', '', '', 20030711164751, '', 00000000000000);
INSERT INTO care_test_group VALUES (6, 'blood_sugar', 'Blood sugar', '30', '', '', 20030711164835, '', 00000000000000);
INSERT INTO care_test_group VALUES (7, 'neonate', 'Neonate', '35', '', '', 20030711164928, '', 00000000000000);
INSERT INTO care_test_group VALUES (8, 'proteins', 'Proteins', '40', '', '', 20030711164951, '', 00000000000000);
INSERT INTO care_test_group VALUES (9, 'thyroid', 'Thyroid', '45', '', '', 20030711165013, '', 00000000000000);
INSERT INTO care_test_group VALUES (10, 'hormones', 'Hormones', '50', '', '', 20030711165032, '', 00000000000000);
INSERT INTO care_test_group VALUES (11, 'tumor_marker', 'Tumor marker', '55', '', '', 20030711165052, '', 00000000000000);
INSERT INTO care_test_group VALUES (12, 'tissue_antibody', 'Tissue antibody', '60', '', '', 20030711165200, '', 00000000000000);
INSERT INTO care_test_group VALUES (13, 'rheuma_factor', 'Rheuma factor', '65', '', '', 20030711165220, '', 00000000000000);
INSERT INTO care_test_group VALUES (14, 'hepatitis', 'Hepatitis', '70', '', '', 20030711165259, '', 00000000000000);
INSERT INTO care_test_group VALUES (15, 'biopsy', 'Biopsy', '75', '', '', 20030711165432, '', 00000000000000);
INSERT INTO care_test_group VALUES (16, 'infection_serology', 'Infection serology', '80', '', '', 20030711165513, '', 00000000000000);
INSERT INTO care_test_group VALUES (17, 'medicines', 'Medicines', '85', '', '', 20030711165535, '', 00000000000000);
INSERT INTO care_test_group VALUES (18, 'prenatal', 'Prenatal', '90', '', '', 20030711165554, '', 00000000000000);
INSERT INTO care_test_group VALUES (19, 'stool', 'Stool', '95', '', '', 20030711165646, '', 00000000000000);
INSERT INTO care_test_group VALUES (20, 'rare', 'Rare', '100', '', '', 20030711165758, '', 00000000000000);
INSERT INTO care_test_group VALUES (21, 'urine', 'Urine', '105', '', '', 20030711165817, '', 00000000000000);
INSERT INTO care_test_group VALUES (22, 'total_urine', 'Total urine', '110', '', '', 20030711165848, '', 00000000000000);
INSERT INTO care_test_group VALUES (23, 'special_params', 'Special', '115', '', '', 20030711170005, '', 00000000000000);

#
# Tabellenstruktur für Tabelle care_test_param
#

CREATE TABLE care_test_param (
   nr smallint(5) unsigned DEFAULT '0' NOT NULL auto_increment,
   group_id varchar(35) NOT NULL,
   name varchar(35) NOT NULL,
   id varchar(10) NOT NULL,
   msr_unit varchar(15) NOT NULL,
   median varchar(20),
   hi_bound varchar(20),
   lo_bound varchar(20),
   hi_critical varchar(20),
   lo_critical varchar(20),
   hi_toxic varchar(20),
   lo_toxic varchar(20),
   status varchar(25) NOT NULL,
   history text NOT NULL,
   modify_id varchar(35) NOT NULL,
   modify_time timestamp(14),
   create_id varchar(35) NOT NULL,
   create_time timestamp(14),
   PRIMARY KEY (nr)
);

#
# Daten für Tabelle care_test_param
#

INSERT INTO care_test_param VALUES (1, 'priority', 'Quick', '00q', 'mm/s', '', '', '15', '', '', '', '', '', '', 'Elpidio Latorilla', 20030806033227, '', 00000000000000);
INSERT INTO care_test_param VALUES (2, 'priority', 'PTT', '00ptt', 'mm/s', '', '350', '', '', '', '', '', '', '', 'Elpidio Latorilla', 20030806033227, '', 00000000000000);
INSERT INTO care_test_param VALUES (3, 'priority', 'Hb', '00hb', 'g/dl', '', '18', '12', '', '', '', '', '', '', 'Elpidio Latorilla', 20030806033227, '', 00000000000000);
INSERT INTO care_test_param VALUES (4, 'priority', 'Hk', '00hc', '%', '48', '58', '36', '', '', '', '', '', '', 'Elpidio Latorilla', 20030806033227, '', 00000000000000);
INSERT INTO care_test_param VALUES (5, 'priority', 'Platelets', '00pla', 'c/cmm', '', '500000', '200000', '', '', '', '', '', '', 'Elpidio Latorilla', 20030806033227, '', 00000000000000);
INSERT INTO care_test_param VALUES (6, 'priority', 'RBC', '00rbc', 'mil/cmm', '', '5.5', '4.5', '', '', '', '', '', '', 'Elpidio Latorilla', 20030806033227, '', 00000000000000);
INSERT INTO care_test_param VALUES (7, 'priority', 'WBC', '00wbc', 'c/ccm', '', '9000', '5000', '', '', '', '', '', '', 'Elpidio Latorilla', 20030806033227, '', 00000000000000);
INSERT INTO care_test_param VALUES (8, 'priority', 'Calcium', '00ca', 'mEq/ml', '', '', '', '67', '', '', '', '', '', 'Elpidio Latorilla', 20030806033227, '', 00000000000000);
INSERT INTO care_test_param VALUES (9, 'priority', 'Sodium', '00na', 'mEq/ml', '', '100', '20', '', '', '', '', '', '', 'Elpidio Latorilla', 20030806033227, '', 00000000000000);
INSERT INTO care_test_param VALUES (10, 'priority', 'Potassium', '00k', 'mEq/ml', '', '100', '10', '', '', '', '', '', '', 'Elpidio Latorilla', 20030806033227, '', 00000000000000);
INSERT INTO care_test_param VALUES (11, 'priority', 'Blood sugar', '00sug', 'mg/dL', '', '140', '', '260', '', '', '', '', '', 'Elpidio Latorilla', 20030806033227, '', 00000000000000);
INSERT INTO care_test_param VALUES (12, 'clinical_chem', 'Alk. Ph.', '0aph', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (13, 'clinical_chem', 'Alpha GT', '0agt', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (14, 'clinical_chem', 'Ammonia', '0amm', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (15, 'clinical_chem', 'Amylase', '0amy', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (16, 'clinical_chem', 'Bili total', '0bit', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (17, 'clinical_chem', 'Bili direct', '0bid', '', '56', '', '', '', '', '', '', '', '', 'Elpidio Latorilla', 20030806033227, '', 00000000000000);
INSERT INTO care_test_param VALUES (18, 'clinical_chem', 'Calcium', '0ca', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (19, 'clinical_chem', 'Chloride', '0chl', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (20, 'clinical_chem', 'Chol', '0cho', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (21, 'clinical_chem', 'Cholinesterase', '0chol', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (22, 'clinical_chem', 'CKMB', '0ccmb', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (23, 'clinical_chem', 'CPK', '0cpc', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (24, 'clinical_chem', 'CRP', '0crp', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (25, 'clinical_chem', 'Iron', '0fe', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (26, 'clinical_chem', 'RBC', '0rbc', 'c/ccm', '', '', '', '', '', '', '', '', '', 'Elpidio Latorilla', 20030806033227, '', 00000000000000);
INSERT INTO care_test_param VALUES (27, 'clinical_chem', 'free HgB', '0fhb', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (28, 'clinical_chem', 'GLDH', '0gldh', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (29, 'clinical_chem', 'GOT', '0got', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (30, 'clinical_chem', 'GPT', '0gpt', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (31, 'clinical_chem', 'Uric acid', '0ucid', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (32, 'clinical_chem', 'Urea', '0urea', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (33, 'clinical_chem', 'HBDH', '0hbdh', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (34, 'clinical_chem', 'HDL Chol', '0hdlc', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (35, 'clinical_chem', 'Potassium', '0pot', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (36, 'clinical_chem', 'Creatinine', '0cre', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (37, 'clinical_chem', 'Copper', '0co', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (38, 'clinical_chem', 'Lactate i.P.', '0lac', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (39, 'clinical_chem', 'LDH', '0ldh', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (40, 'clinical_chem', 'LDL Chol', '0ldlc', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (41, 'clinical_chem', 'Lipase', '0lip', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (42, 'clinical_chem', 'Lipid Elpho', '0lpid', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (43, 'clinical_chem', 'Magnesium', '0mg', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (44, 'clinical_chem', 'Myoglobin', '0myo', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (45, 'clinical_chem', 'Sodium', '0na', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (46, 'clinical_chem', 'Osmolal.', '0osm', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (47, 'clinical_chem', 'Phosphor', '0pho', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (48, 'clinical_chem', 'Serum sugar', '0glo', 'mg/dL', '', '140', '', '', '', '', '', '', '', 'Elpidio Latorilla', 20030806033227, '', 00000000000000);
INSERT INTO care_test_param VALUES (49, 'clinical_chem', 'Tri', '0tri', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (50, 'clinical_chem', 'Troponin T', '0tro', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (51, 'liquor', 'Liquor status', '1stat', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (52, 'liquor', 'Liquor elpho', '1elp', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (53, 'liquor', 'Oligoclonales IgG', '1oli', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (54, 'liquor', 'Reiber Scheme', '1sch', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (55, 'liquor', 'A1', '1a1', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (56, 'coagulation', 'Fibrinolysis', '2fiby', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (57, 'coagulation', 'Quick', '2q', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (58, 'coagulation', 'PTT', '2ptt', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (59, 'coagulation', 'PTZ', '2ptz', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (60, 'coagulation', 'Fibrinogen', '2fibg', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (61, 'coagulation', 'Sol.Fibr.mon.', '2fibs', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (62, 'coagulation', 'FSP dimer', '2fsp', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (63, 'coagulation', 'Thr.Coag.', '2coag', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (64, 'coagulation', 'AT III', '2at3', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (65, 'coagulation', 'Faktor VII', '2f8', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172153, '', 00000000000000);
INSERT INTO care_test_param VALUES (66, 'coagulation', 'APC Resistance', '2apc', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (67, 'coagulation', 'Protein C', '2prc', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (68, 'coagulation', 'Protein S', '2prs', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (69, 'coagulation', 'Bleeding time', '2bt', 'ml/s', '', '', '', '', '', '', '', '', '', 'Elpidio Latorilla', 20030806033227, '', 00000000000000);
INSERT INTO care_test_param VALUES (70, 'hematology', 'Retikulocytes', '3ret', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (71, 'hematology', 'Malaria', '3mal', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (72, 'hematology', 'Hb Elpho', '3hbe', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (73, 'hematology', 'HLA B 27', '3hla', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (74, 'hematology', 'Platelets AB', '3tab', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (75, 'hematology', 'WBC Phosp.', '3wbp', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (76, 'blood_sugar', 'Blood sugar fasting', '4bsf', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (77, 'blood_sugar', 'Blood sugar 9:00', '4bs9', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (78, 'blood_sugar', 'Blood sugar p.prandial', '4bsp', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (79, 'blood_sugar', 'Bl15:00', '4bs15', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (80, 'blood_sugar', 'Blood sugar 1', '4bs1', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (81, 'blood_sugar', 'Blood sugar 2', '4bs2', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (82, 'blood_sugar', 'Glucose stress.', '4glo', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (83, 'blood_sugar', 'Lactose stress', '4lac', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (84, 'blood_sugar', 'HBA 1c', '4hba', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (85, 'blood_sugar', 'Fructosamine', '4fru', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (86, 'neonate', 'Neonate bilirubin', '5bil', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (87, 'neonate', 'Cord bilirubin', '5bilc', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (88, 'neonate', 'Bilirubin direct', '5bild', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (89, 'neonate', 'Neonate sugar 1', '5glo1', 'mg/dL', '', '', '', '', '', '', '', '', '', 'Elpidio Latorilla', 20030806033227, '', 00000000000000);
INSERT INTO care_test_param VALUES (90, 'neonate', 'Neonate sugar 2', '5glo2', 'mg/DL', '', '', '30', '', '', '', '', '', '', 'Elpidio Latorilla', 20030806033227, '', 00000000000000);
INSERT INTO care_test_param VALUES (91, 'neonate', 'Reticulocytes', '5ret', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (92, 'neonate', 'B1', '5b1', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (93, 'proteins', 'Total proteins', '6tot', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (94, 'proteins', 'Albumin', '6alb', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (95, 'proteins', 'Elpho', '6elp', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (96, 'proteins', 'Immune fixation', '6imm', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (97, 'proteins', 'Beta2 Microglobulin.i.S', '6b2', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (98, 'proteins', 'Immune globulin quant.', '6img', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (99, 'proteins', 'IgE', '6ige', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (100, 'proteins', 'Haptoglobin', '6hap', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (101, 'proteins', 'Transferrin', '6tra', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (102, 'proteins', 'Ferritin', '6fer', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (103, 'proteins', 'Coeruloplasmin', '6coe', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (104, 'proteins', 'Alpha 1 Antitrypsin', '6alp', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (105, 'proteins', 'AFP Grav.', '6afp', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (106, 'proteins', 'SSW:', '6ssw', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (107, 'proteins', 'Alpha 1 Microglobulin', '6mic', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (108, 'thyroid', 'T3', '7t3', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (109, 'thyroid', 'Thyroxin/T4', '7t4', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (110, 'thyroid', 'TSH basal', '7tshb', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (111, 'thyroid', 'TSH stim.', '7tshs', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (112, 'thyroid', 'TAB', '7tab', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (113, 'thyroid', 'MAB', '7mab', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (114, 'thyroid', 'TRAB', '7trab', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (115, 'thyroid', 'Thyreoglobulin', '7glob', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (116, 'thyroid', 'Thyroxinbind.Glob.', '7thx', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (117, 'thyroid', 'free T3', '7ft3', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (118, 'thyroid', 'free T4', '7ft4', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (119, 'hormones', 'ACTH', '8acth', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (120, 'hormones', 'Aldosteron', '8ald', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (121, 'hormones', 'Calcitonin', '8cal', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (122, 'hormones', 'Cortisol', '8cor', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (123, 'hormones', 'Cortisol day', '8dcor', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (124, 'hormones', 'FSH', '8fsh', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (125, 'hormones', 'Gastrin', '8gas', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (126, 'hormones', 'HCG', '8hcg', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (127, 'hormones', 'Insulin', '8ins', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (128, 'hormones', 'Catecholam.i.P.', '8cat', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (129, 'hormones', 'LH', '8lh', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (130, 'hormones', 'Ostriol', '8osd', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (131, 'hormones', 'SSW:', '8ssw', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172154, '', 00000000000000);
INSERT INTO care_test_param VALUES (132, 'hormones', 'Parat hormone', '8par', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (133, 'hormones', 'Progesteron', '8prg', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (134, 'hormones', 'Prolactin I', '8pr1', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (135, 'hormones', 'Prolactin II', '8pr2', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (136, 'hormones', 'Renin', '8ren', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (137, 'hormones', 'Serotonin', '8ser', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (138, 'hormones', 'Somatomedin C', '8som', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (139, 'hormones', 'Testosteron', '8tes', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (140, 'hormones', 'C1', '8c1', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (141, 'tumor_marker', 'AFP', '9afp', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (142, 'tumor_marker', 'CA. 15 3', '9c153', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (143, 'tumor_marker', 'CA. 19 9', '9c199', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (144, 'tumor_marker', 'CA. 125', '9c125', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (145, 'tumor_marker', 'CEA', '9cea', '', '', '', '', '', '', '', '', '', '', 'Elpidio Latorilla', 20030806033227, '', 00000000000000);
INSERT INTO care_test_param VALUES (146, 'tumor_marker', 'Cyfra. 21 2', '9c212', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (147, 'tumor_marker', 'HCG', '9hcg', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (148, 'tumor_marker', 'NSE', '9nse', 'test', '', '', '', '', '', '', '', '', '', 'Elpidio Latorilla', 20030806033227, '', 00000000000000);
INSERT INTO care_test_param VALUES (149, 'tumor_marker', 'PSA', '9psa', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (150, 'tumor_marker', 'SCC', '9scc', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (151, 'tumor_marker', 'TPA', '9tpa', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (152, 'tissue_antibody', 'ANA', '10ana', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (153, 'tissue_antibody', 'AMA', 'ama', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (154, 'tissue_antibody', 'DNS AB', '10dnsab', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (155, 'tissue_antibody', 'ASMA', '10asm', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (156, 'tissue_antibody', 'ENA', '10ena', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (157, 'tissue_antibody', 'ANCA', '10anc', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (158, 'rheuma_factor', 'Anti Strepto Titer', '11ast', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (159, 'rheuma_factor', 'Lat. RF', '11lrf', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (160, 'rheuma_factor', 'Streptozym', '11stz', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (161, 'rheuma_factor', 'Waaler Rose', '11waa', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (162, 'hepatitis', 'Anti HAV', '12hav', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (163, 'hepatitis', 'Anti HAV IgM', '12hai', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (164, 'hepatitis', 'Hbs Antigen', '12hba', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (165, 'hepatitis', 'Anti HBs Titer', '12hbt', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (166, 'hepatitis', 'Anti HBe', '12hbe', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (167, 'hepatitis', 'Anti HBc', '12hbc', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (168, 'hepatitis', 'Anti HBc.IgM', '12hci', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (169, 'hepatitis', 'Anti HCV', '12hcv', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (170, 'hepatitis', 'Hep.D Delta A.', '12hda', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (171, 'hepatitis', 'Anti HEV', '12hev', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (172, 'biopsy', 'Protein i.biopsy', '13pro', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (173, 'biopsy', 'LDH i.biopsy', '13ldh', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (174, 'biopsy', 'Chol.i.biopsy', '13cho', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (175, 'biopsy', 'CEA i.biopsy', '13cea', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (176, 'biopsy', 'AFP i.biopsy', '13afp', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (177, 'biopsy', 'Uric acid.i.biopsy', '13ure', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (178, 'biopsy', 'Rheuma fact.i.biopsy', '13rhe', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (179, 'biopsy', 'D1', '13d1', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (180, 'biopsy', 'D2', '13d2', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (181, 'infection_serology', 'Antistaph.Titer', '14stap', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (182, 'infection_serology', 'Adenovirus AB', '14ade', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (183, 'infection_serology', 'Borrelia AB', '14bor', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (184, 'infection_serology', 'Borr.Immunoblot', '14bori', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (185, 'infection_serology', 'Brucellia AB', '14bru', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (186, 'infection_serology', 'Campylob. AB', '14cam', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (187, 'infection_serology', 'Candida AB', '14can', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (188, 'infection_serology', 'Cardiotr.Virus', '14car', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (189, 'infection_serology', 'Chlamydia AB', '14chl', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (190, 'infection_serology', 'C.psittaci AB', '14psi', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (191, 'infection_serology', 'Coxsack. AB', '14cox', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (192, 'infection_serology', 'Cox.burn. AB(Q fever)', '14qf', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (193, 'infection_serology', 'Cytomegaly AB', '14cyt', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (194, 'infection_serology', 'EBV AB', '14ebv', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (195, 'infection_serology', 'Echinococcus AB', '14ecc', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (196, 'infection_serology', 'Echo Virus AB', '14ecv', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (197, 'infection_serology', 'FSME AB', '14fsme', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172155, '', 00000000000000);
INSERT INTO care_test_param VALUES (198, 'infection_serology', 'Herpes simp. I AB', '14hs1', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (199, 'infection_serology', 'Herpes simp. II AB', '14hs2', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (200, 'infection_serology', 'HIV1/HIV2 AB', '14hiv', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (201, 'infection_serology', 'Influenza A AB', '14ina', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (202, 'infection_serology', 'Influenza B AB', '14inb', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (203, 'infection_serology', 'LCM AB', '14lcm', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (204, 'infection_serology', 'Leg.pneum AB', '14leg', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (205, 'infection_serology', 'Leptospiria AB', '14lep', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (206, 'infection_serology', 'Listeria AB', '14lis', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (207, 'infection_serology', 'Masern AB', '14mas', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (208, 'infection_serology', 'Mononucleose', '14mon', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (209, 'infection_serology', 'Mumps AB', '14mum', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (210, 'infection_serology', 'Mycoplas.pneum AB', '14myc', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (211, 'infection_serology', 'Neutrop Virus AB', '14neu', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (212, 'infection_serology', 'Parainfluenza II AB', '14pi2', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (213, 'infection_serology', 'Parainfluenza III AB', '14pi3', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (214, 'infection_serology', 'Picorna Virus AB', '14pic', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (215, 'infection_serology', 'Rickettsia AB', '14vric', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (216, 'infection_serology', 'Röteln AB', '14rot', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (217, 'infection_serology', 'Röteln Immune status', '14roi', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (218, 'infection_serology', 'RS Virus AB', '14rsv', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (219, 'infection_serology', 'Shigella/Salm AB', '14shi', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (220, 'infection_serology', 'Toxoplasma AB', '14tox', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (221, 'infection_serology', 'TPHA', '14tpha', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (222, 'infection_serology', 'Varicella AB', '14vrc', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (223, 'infection_serology', 'Yersinia AB', '14yer', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (224, 'infection_serology', 'E1', '14e1', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (225, 'infection_serology', 'E2', '14e2', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (226, 'infection_serology', 'E3', '14e3', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (227, 'infection_serology', 'E4', '14e4', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (228, 'medicines', 'Amiodaron', '15ami', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (229, 'medicines', 'Barbiturate.i.S.', '15bar', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (230, 'medicines', 'Benzodiazep.i.S.', '15ben', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (231, 'medicines', 'Carbamazepin', '15car', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (232, 'medicines', 'Clonazepam', '15clo', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (233, 'medicines', 'Digitoxin', '15dig', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (234, 'medicines', 'Digoxin', '15dgo', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (235, 'medicines', 'Gentamycin', '15gen', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (236, 'medicines', 'Lithium', '15lit', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (237, 'medicines', 'Phenobarbital', '15phe', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (238, 'medicines', 'Phenytoin', '15pny', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (239, 'medicines', 'Primidon', '15pri', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (240, 'medicines', 'Salicylic acid', '15sal', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (241, 'medicines', 'Theophyllin', '15the', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (242, 'medicines', 'Tobramycin', '15tob', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (243, 'medicines', 'Valproin acid', '15val', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (244, 'medicines', 'Vancomycin', '15van', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (245, 'medicines', 'Amphetamine.i.u.', '15amp', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (246, 'medicines', 'Antidepressant.i.u.', '15ant', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (247, 'medicines', 'Barbiturate.i.u.', '15bau', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (248, 'medicines', 'Benzodiazep.i.u.', '15beu', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (249, 'medicines', 'Cannabinol.i.u.', '15can', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (250, 'medicines', 'Cocain.i.u', '15coc', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (251, 'medicines', 'Methadon.i.u.', '15met', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (252, 'medicines', 'Opiate.i.u.', '15opi', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (253, 'prenatal', 'Chlamyd.cult./SSW', '16chl', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (254, 'prenatal', 'SSW:', '16ssw', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (255, 'prenatal', 'Down Screening', '16dow', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (256, 'prenatal', 'Strep B quick test', '16stb', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (257, 'prenatal', 'TPHA', '16tpha', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (258, 'prenatal', 'HBs Ag', '16hbs', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (259, 'prenatal', 'HIV1/HIV2 AV', '16hiv', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (260, 'stool', 'Chymotrypsin', '17chy', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (261, 'stool', 'Occult blood 1', '17ob1', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (262, 'stool', 'Occult blood 2', '17ob2', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (263, 'stool', 'Occult blood 3', '17ob3', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (264, 'rare', 'Rare H.', '18rh', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (265, 'rare', 'Rare E.', '18re', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172156, '', 00000000000000);
INSERT INTO care_test_param VALUES (266, 'rare', 'Rare S.', '18rs', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (267, 'rare', 'Urine rare', '18uri', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (268, 'rare', 'F1', '18f1', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (269, 'rare', 'F2', '18f2', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (270, 'rare', 'F3', '18f3', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (271, 'urine', 'Urine amylase', '19amy', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (272, 'urine', 'Urine sugar', '19sug', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (273, 'urine', 'Protein.i.u.', '19pro', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (274, 'urine', 'Albumin.i.u.', '19alb', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (275, 'urine', 'Osmol.i.u.', '19osm', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (276, 'urine', 'Pregnancy test.', '19pre', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (277, 'urine', 'Cytomeg.i.urine', '19cym', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (278, 'urine', 'Urine cytology', '19cyt', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (279, 'urine', 'Bence Jones', '19bj', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (280, 'urine', 'Urine elpho', '19elp', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (281, 'urine', 'Beta2 microglobulin.i.u.', '19bm2', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (282, 'total_urine', 'Addis Count', '20adc', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (283, 'total_urine', 'Sodium i.u.', '20na', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (284, 'total_urine', 'Potass. i.u.', '20k', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (285, 'total_urine', 'Calcium i.u.', '20ca', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (286, 'total_urine', 'Phospor i.u.', '20pho', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (287, 'total_urine', 'Uric acid i.u.', '20ura', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (288, 'total_urine', 'Creatinin i.u.', '20cre', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (289, 'total_urine', 'Porphyrine i.u.', '20por', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (290, 'total_urine', 'Cortisol i.u.', '20cor', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (291, 'total_urine', 'Hydroxyprolin i.u.', '20hyd', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (292, 'total_urine', 'Catecholamins i.u.', '20cat', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (293, 'total_urine', 'Pancreol.', '20pan', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (294, 'total_urine', 'Gamma Aminoläbulinsre.i.u.', '20gam', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (295, 'special_params', 'Blood alcohol', '21bal', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (296, 'special_params', 'CDT', '21cdt', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (297, 'special_params', 'Vitamin B12', '21vb12', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (298, 'special_params', 'Folic acid', '21fol', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (299, 'special_params', 'Insulin AB', '21inab', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (300, 'special_params', 'Intrinsic AB', '21iab', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (301, 'special_params', 'Stone analysis', '21sto', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (302, 'special_params', 'ACE', '21ace', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (303, 'special_params', 'G1', '21g1', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (304, 'special_params', 'G2', '21g2', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (305, 'special_params', 'G3', '21g3', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (306, 'special_params', 'G4', '21g4', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (307, 'special_params', 'G5', '21g5', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (308, 'special_params', 'G6', '21g6', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (309, 'special_params', 'G7', '21g7', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (310, 'special_params', 'G8', '21g8', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (311, 'special_params', 'G9', '21g9', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);
INSERT INTO care_test_param VALUES (312, 'special_params', 'G10', '21g10', '',  NULL,  NULL,  NULL,  NULL,  NULL,  NULL,  NULL, '', '', '', 20030711172157, '', 00000000000000);  

# Remove medocs table

DROP TABLE care_medocs;


