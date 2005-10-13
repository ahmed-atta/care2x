#
# Tabellenstruktur für Tabelle 'care_icd10_pt_br'
#

CREATE TABLE care_icd10_pt_br (
   diagnosis_code varchar(12) NOT NULL,
   description text NOT NULL,
   class_sub varchar(5) NOT NULL,
   type varchar(10) NOT NULL,
   inclusive text NOT NULL,
   exclusive text NOT NULL,
   notes text NOT NULL,
   std_code char(1) NOT NULL,
   sub_level tinyint(4) DEFAULT '0' NOT NULL,
   remarks text NOT NULL,
   extra_codes text NOT NULL,
   extra_subclass text NOT NULL,
   KEY diagnosis_code (diagnosis_code),
   PRIMARY KEY (diagnosis_code)
);

