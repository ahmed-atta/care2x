# This update script is valid only for updating a running 1.0.06 version to 1.0.07 
#--------------------------------------------------------

#
# Tabellenstruktur für Tabelle care_classif_neonatal
#

CREATE TABLE care_classif_neonatal (
   nr smallint(2) unsigned DEFAULT '0' NOT NULL auto_increment,
   id varchar(35) NOT NULL,
   name varchar(35) NOT NULL,
   LD_var varchar(35) NOT NULL,
   description varchar(255),
   status varchar(25) NOT NULL,
   modify_id varchar(35) NOT NULL,
   modify_time timestamp(14),
   create_id varchar(35) NOT NULL,
   create_time timestamp(14),
   PRIMARY KEY (nr),
   UNIQUE id (id)
);

#
# Daten für Tabelle care_classif_neonatal
#

INSERT INTO care_classif_neonatal VALUES (1, 'jaundice', 'Neonatal jaundice', 'LDNeonatalJaundice',  NULL, '', '', 20030807125731, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (2, 'x_transfusion', 'Exchange transfusion', 'LDExchangeTransfusion',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (3, 'photo_therapy', 'Photo therapy', 'LDPhotoTherapy',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (4, 'h_i_encep', 'Hypoxic ischaemic encephalopathy', 'LDH_I_Encephalopathy',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (5, 'parenteral', 'Parenteral nutrition', 'LDParenteralNutrition',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (6, 'vent_support', 'Ventilatory support', 'LDVentilatorySupport',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (7, 'oxygen_therapy', 'Oxygen therapy', 'LDOxygenTherapy',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (8, 'cpap', 'CPAP', 'LDCPAP', 'Continuous positive airway pressure', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (9, 'congenital_abnormality', 'Congenital abnormality', 'LDCongenitalAbnormality',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (10, 'congenital_infection', 'Congenital infection', 'LDCongenitalInfection',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (11, 'acquired_infection', 'Acquired infection', 'LDAcquiredInfection',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (12, 'gbs_infection', 'GBS infection', 'LDGBSInfection', 'Group B Strep Infection', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (13, 'rds', 'Resp Distress Syndrome', 'LDRespDistressSyndrome',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (14, 'blood_transfusion', 'Blood transfusion', 'LDBloodTransfusion',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (15, 'antibiotic_therapy', 'Antibiotic therapy', 'LDAntibioticTherapy',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (16, 'necrotising_enterocolitis', 'Necrotising enterocolitis', 'LDNecrotisingEnterocolitis',  NULL, '', '', 20030807191727, '', 00000000000000);

#
#  Add field to care_person
#

ALTER TABLE care_person ADD blood_group VARCHAR( 2 ) NOT NULL ;

#
#	Change death_date field to not NULL
#

ALTER TABLE care_person CHANGE death_date death_date DATE NOT NULL ;

#
# Pharma and medical products
#

ALTER TABLE care_pharma_orderlist CHANGE dept dept_nr INT( 3 ) DEFAULT '0' NOT NULL ;

ALTER TABLE care_pharma_ordercatalog CHANGE dept dept_nr INT( 3 ) DEFAULT '0' NOT NULL ;

ALTER TABLE care_med_orderlist CHANGE dept dept_nr INT( 3 ) DEFAULT '0' NOT NULL ;

ALTER TABLE care_med_ordercatalog CHANGE dept dept_nr INT( 3 ) DEFAULT '0' NOT NULL ;

#
# Changes in care_neonatal
#

ALTER TABLE care_neonatal ADD time_to_spont_resp TINYINT( 2 ) AFTER apgar_10_min ;

ALTER TABLE care_neonatal CHANGE weight weight FLOAT( 8, 2 ) UNSIGNED DEFAULT NULL ;

ALTER TABLE care_neonatal CHANGE length length FLOAT( 8, 2 ) UNSIGNED DEFAULT NULL ;

ALTER TABLE care_neonatal CHANGE head_circumference head_circumference FLOAT( 8, 2 ) UNSIGNED DEFAULT NULL ;
