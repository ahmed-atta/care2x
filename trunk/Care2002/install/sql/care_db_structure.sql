# phpMyAdmin MySQL-Dump
# version 2.2.0rc1
# http://phpwizard.net/phpMyAdmin/
# http://phpmyadmin.sourceforge.net/ (download page)
#
# Host: localhost
# Generation Time: May 5, 2002, 3:33 pm
# Server version: 3.22.34
# PHP Version: 4.0.4pl1
# Database : ****
# --------------------------------------------------------

#
# Table structure for table 'cafe_menu_de'
#

CREATE TABLE cafe_menu_de (
   cyear smallint(4) DEFAULT '0' NOT NULL,
   cmonth tinyint(2) DEFAULT '0' NOT NULL,
   cday tinyint(2) DEFAULT '0' NOT NULL,
   menu text NOT NULL,
   encoder tinytext NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'cafe_menu_en'
#

CREATE TABLE cafe_menu_en (
   cyear smallint(4) DEFAULT '0' NOT NULL,
   cmonth tinyint(2) DEFAULT '0' NOT NULL,
   cday tinyint(2) DEFAULT '0' NOT NULL,
   menu text NOT NULL,
   encoder tinytext NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'cafe_prices_de'
#

CREATE TABLE cafe_prices_de (
   productgroup tinytext NOT NULL,
   article tinytext NOT NULL,
   description tinytext NOT NULL,
   price_dm tinytext NOT NULL,
   price_euro tinytext NOT NULL,
   unit tinytext NOT NULL,
   pic_filename tinytext NOT NULL,
   uid varchar(25) NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'cafe_prices_en'
#

CREATE TABLE cafe_prices_en (
   productgroup tinytext NOT NULL,
   article tinytext NOT NULL,
   description tinytext NOT NULL,
   price_dm tinytext NOT NULL,
   price_euro tinytext NOT NULL,
   unit tinytext NOT NULL,
   pic_filename tinytext NOT NULL,
   uid varchar(25) NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'doctors_dept_personell_quicklist'
#

CREATE TABLE doctors_dept_personell_quicklist (
   dept varchar(15) NOT NULL,
   year varchar(4) NOT NULL,
   month char(2) NOT NULL,
   list text NOT NULL,
   src_date varchar(6) NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'doctors_dutyplan'
#

CREATE TABLE doctors_dutyplan (
   dept varchar(15) NOT NULL,
   year varchar(4) NOT NULL,
   month char(2) NOT NULL,
   a_dutyplan text NOT NULL,
   r_dutyplan text NOT NULL,
   tid timestamp(14),
   encoding text NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'drg_quicklist_de'
#

CREATE TABLE drg_quicklist_de (
   dept varchar(20) NOT NULL,
   type varchar(10) NOT NULL,
   code_description text NOT NULL,
   rank int(11) DEFAULT '0' NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'drg_quicklist_en'
#

CREATE TABLE drg_quicklist_en (
   dept varchar(20) NOT NULL,
   type varchar(10) NOT NULL,
   code_description text NOT NULL,
   rank int(11) DEFAULT '0' NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'drg_related_codes_de'
#

CREATE TABLE drg_related_codes_de (
   code varchar(10) NOT NULL,
   related_icd text NOT NULL,
   related_ops text NOT NULL,
   rank int(11) DEFAULT '0' NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'drg_related_codes_en'
#

CREATE TABLE drg_related_codes_en (
   code varchar(10) NOT NULL,
   related_icd text NOT NULL,
   related_ops text NOT NULL,
   rank int(11) DEFAULT '0' NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'duty_performance_report'
#

CREATE TABLE duty_performance_report (
   dept varchar(15) NOT NULL,
   date varchar(10) NOT NULL,
   src_date varchar(8) NOT NULL,
   a_name varchar(30) NOT NULL,
   a_stime varchar(5) NOT NULL,
   a_etime varchar(5) NOT NULL,
   r_name varchar(30) NOT NULL,
   r_stime varchar(5) NOT NULL,
   r_etime varchar(5) NOT NULL,
   op_room char(2) NOT NULL,
   diag_therapy text NOT NULL,
   encoding text NOT NULL,
   tid timestamp(14)
);
# --------------------------------------------------------


#
# Table structure for table 'icd10_de'
#

CREATE TABLE icd10_de (
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
   extra_subclass text NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'icd10_en'
#

CREATE TABLE icd10_en (
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
   extra_subclass text NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'lab_test_data'
#

CREATE TABLE lab_test_data (
   patnum varchar(10) NOT NULL,
   lastname varchar(40) NOT NULL,
   firstname varchar(40) NOT NULL,
   bday varchar(10) NOT NULL,
   test_date varchar(10) NOT NULL,
   test_time varchar(5) NOT NULL,
   test_sortdate varchar(8) NOT NULL,
   job_id varchar(10) NOT NULL,
   dr_name varchar(30) NOT NULL,
   dr_tstamp varchar(16) NOT NULL,
   life_risk tinyint(4) DEFAULT '0' NOT NULL,
   rarity tinytext NOT NULL,
   specials tinytext NOT NULL,
   clinical_info tinytext NOT NULL,
   TOP_Parameter text NOT NULL,
   Klinische_Chemie text NOT NULL,
   Liquor text NOT NULL,
   Gerinnung text NOT NULL,
   Hämatologie text NOT NULL,
   Blutzucker text NOT NULL,
   Säugling text NOT NULL,
   Proteine text NOT NULL,
   Schilddrüse text NOT NULL,
   Hormone text NOT NULL,
   Tumormarker text NOT NULL,
   Gewebe_AK text NOT NULL,
   Rheumafaktor text NOT NULL,
   Hepatitis text NOT NULL,
   Punktate text NOT NULL,
   Infektionsserologie text NOT NULL,
   Medikamente text NOT NULL,
   Mutterschutzt_Vorsorge text NOT NULL,
   Stuhl text NOT NULL,
   Raritäten text NOT NULL,
   Urin_Spontanurin text NOT NULL,
   Sammelurin text NOT NULL,
   Sonstiges text NOT NULL,
   encoding text NOT NULL,
   tid timestamp(14),
   validator varchar(15) NOT NULL,
   valid_tstamp varchar(16) NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'lab_test_parameter'
#

CREATE TABLE lab_test_parameter (
   priority text NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'mahopass'
#

CREATE TABLE mahopass (
   mahopass_name tinytext,
   mahopass_id tinytext,
   mahopass_password tinytext,
   mahopass_lockflag tinyint(3) unsigned DEFAULT '0',
   mahopass_area1 tinytext,
   mahopass_area2 tinytext,
   mahopass_area3 tinytext,
   mahopass_area4 tinytext,
   mahopass_area5 tinytext,
   mahopass_area6 tinytext,
   mahopass_area7 tinytext,
   mahopass_area8 tinytext,
   mahopass_area9 tinytext,
   mahopass_area10 tinytext,
   mahopass_date tinytext,
   mahopass_time tinytext,
   mahopass_encoder tinytext,
   exc tinyint(1) DEFAULT '0' NOT NULL,
   expire_date int(6) DEFAULT '0' NOT NULL,
   expire_time int(4) DEFAULT '0' NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'mahopatient'
#

CREATE TABLE mahopatient (
   item int(10) unsigned,
   patnum int(10) unsigned,
   title tinytext,
   name tinytext,
   vorname tinytext,
   gebdatum tinytext,
   sex tinytext NOT NULL,
   address tinytext,
   phone1 tinytext,
   status varchar(4),
   kasse tinytext,
   kassename tinytext,
   diagnose tinytext,
   referrer tinytext,
   therapie tinytext,
   besonder tinytext,
   pdate varchar(10),
   ptime tinytext,
   encoder tinytext,
   sdate varchar(10) NOT NULL,
   discharge_date varchar(10) NOT NULL,
   discharge_time varchar(5) NOT NULL,
   discharge_sdate varchar(10) NOT NULL,
   discharge_art varchar(10) NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'mahophone'
#

CREATE TABLE mahophone (
   mahophone_item int(10) unsigned,
   mahophone_title tinytext,
   mahophone_name tinytext,
   mahophone_vorname tinytext,
   mahophone_beruf tinytext,
   mahophone_bereich1 tinytext,
   mahophone_bereich2 tinytext,
   mahophone_inphone1 tinytext,
   mahophone_inphone2 tinytext,
   mahophone_inphone3 tinytext,
   mahophone_exphone1 tinytext,
   mahophone_exphone2 tinytext,
   mahophone_funk1 tinytext,
   mahophone_funk2 tinytext,
   mahophone_roomnr tinytext,
   mahophone_date tinytext,
   mahophone_time tinytext,
   mahophone_encoder tinytext
);
# --------------------------------------------------------

#
# Table structure for table 'mail_private'
#

CREATE TABLE mail_private (
   recipient tinytext NOT NULL,
   sender tinytext NOT NULL,
   sender_ip tinytext NOT NULL,
   cc tinytext NOT NULL,
   bcc tinytext NOT NULL,
   subject tinytext NOT NULL,
   body text NOT NULL,
   sign tinytext NOT NULL,
   ask4ack tinyint(4) DEFAULT '0' NOT NULL,
   reply2 tinytext NOT NULL,
   attachment tinytext NOT NULL,
   attach_type tinytext NOT NULL,
   read_flag tinyint(4) DEFAULT '0' NOT NULL,
   mailgroup tinytext NOT NULL,
   maildir tinytext NOT NULL,
   exec_level tinyint(4) DEFAULT '0' NOT NULL,
   exclude_addr text NOT NULL,
   send_dt tinytext NOT NULL,
   send_stamp timestamp(14),
   uid tinytext NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'mail_private_users'
#

CREATE TABLE mail_private_users (
   user_name tinytext NOT NULL,
   email tinytext NOT NULL,
   alias tinytext NOT NULL,
   pw tinytext NOT NULL,
   inbox longtext NOT NULL,
   sent longtext NOT NULL,
   drafts longtext NOT NULL,
   trash longtext NOT NULL,
   lastcheck timestamp(14),
   lock_flag tinyint(4) DEFAULT '0' NOT NULL,
   addr_book text NOT NULL,
   addr_quick tinytext NOT NULL,
   secret_q tinytext NOT NULL,
   secret_q_ans tinytext NOT NULL,
   public tinyint(4) DEFAULT '0' NOT NULL,
   sig tinytext NOT NULL,
   append_sig tinyint(4) DEFAULT '0' NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'mail_public'
#

CREATE TABLE mail_public (
   recipient tinytext NOT NULL,
   sender tinytext NOT NULL,
   sender_ip tinytext NOT NULL,
   cc tinytext NOT NULL,
   bcc tinytext NOT NULL,
   body text NOT NULL,
   sign tinytext NOT NULL,
   ask4ack tinyint(4) DEFAULT '0' NOT NULL,
   reply2 tinytext NOT NULL,
   attachment tinytext NOT NULL,
   attach_type tinytext NOT NULL,
   read_flag tinyint(4) DEFAULT '0' NOT NULL,
   mailgroup tinytext NOT NULL,
   maildir tinytext NOT NULL,
   exec_level tinyint(4) DEFAULT '0' NOT NULL,
   exclude_addr text NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'med_ordercatalog'
#

CREATE TABLE med_ordercatalog (
   dept varchar(20) NOT NULL,
   hit int(11) DEFAULT '0' NOT NULL,
   artikelname tinytext NOT NULL,
   bestellnum tinytext NOT NULL,
   proorder tinytext NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'med_orderlist'
#

CREATE TABLE med_orderlist (
   dept varchar(20) NOT NULL,
   order_id tinytext NOT NULL,
   order_date tinytext NOT NULL,
   articles text NOT NULL,
   extra1 tinytext NOT NULL,
   extra2 text NOT NULL,
   encoder tinytext NOT NULL,
   validator tinytext NOT NULL,
   order_time text NOT NULL,
   ip_addr tinytext NOT NULL,
   priority tinytext NOT NULL,
   sent_stamp timestamp(14)
);
# --------------------------------------------------------

#
# Table structure for table 'med_orderlist_archive'
#

CREATE TABLE med_orderlist_archive (
   rec_date tinytext NOT NULL,
   rec_time tinytext NOT NULL,
   order_id tinytext NOT NULL,
   dept tinytext NOT NULL,
   clerk tinytext NOT NULL,
   done_date tinytext NOT NULL,
   status tinytext NOT NULL,
   priority tinytext NOT NULL,
   t_stamp timestamp(14)
);
# --------------------------------------------------------

#
# Table structure for table 'med_orderlist_archive_trash'
#

CREATE TABLE med_orderlist_archive_trash (
   rec_date tinytext NOT NULL,
   rec_time tinytext NOT NULL,
   order_id tinytext NOT NULL,
   dept tinytext NOT NULL,
   clerk tinytext NOT NULL,
   done_date tinytext NOT NULL,
   status tinytext NOT NULL,
   priority tinytext NOT NULL,
   t_stamp timestamp(14)
);
# --------------------------------------------------------

#
# Table structure for table 'med_orderlist_todo'
#

CREATE TABLE med_orderlist_todo (
   rec_date tinytext NOT NULL,
   rec_time tinytext NOT NULL,
   order_id tinytext NOT NULL,
   dept tinytext NOT NULL,
   clerk tinytext NOT NULL,
   done_date tinytext NOT NULL,
   status tinytext NOT NULL,
   priority tinytext NOT NULL,
   t_stamp timestamp(14)
);
# --------------------------------------------------------

#
# Table structure for table 'med_products_main'
#

CREATE TABLE med_products_main (
   bestellnum tinytext NOT NULL,
   artikelnum tinytext NOT NULL,
   industrynum tinytext NOT NULL,
   artikelname tinytext NOT NULL,
   generic tinytext NOT NULL,
   description text NOT NULL,
   packing tinytext NOT NULL,
   minorder int(4) DEFAULT '0' NOT NULL,
   maxorder int(4) DEFAULT '0' NOT NULL,
   proorder tinytext NOT NULL,
   picfile tinytext NOT NULL,
   encoder tinytext NOT NULL,
   enc_date tinytext NOT NULL,
   enc_time tinytext NOT NULL,
   lock_flag tinyint(1) DEFAULT '0' NOT NULL,
   medgroup text NOT NULL,
   cave tinytext NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'med_products_trash'
#

CREATE TABLE med_products_trash (
   bestellnum tinytext NOT NULL,
   artikelnum tinytext NOT NULL,
   industrynum tinytext NOT NULL,
   artikelname tinytext NOT NULL,
   generic tinytext NOT NULL,
   description text NOT NULL,
   packing tinytext NOT NULL,
   minorder int(4) DEFAULT '0' NOT NULL,
   maxorder int(4) DEFAULT '0' NOT NULL,
   proorder tinytext NOT NULL,
   picfile tinytext NOT NULL,
   encoder tinytext NOT NULL,
   enc_date tinytext NOT NULL,
   enc_time tinytext NOT NULL,
   lock_flag tinyint(1) DEFAULT '0' NOT NULL,
   medgroup text NOT NULL,
   cave tinytext NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'med_report'
#

CREATE TABLE med_report (
   dept varchar(15) NOT NULL,
   job text NOT NULL,
   reporter varchar(25) NOT NULL,
   id varchar(15) NOT NULL,
   tdate varchar(11) NOT NULL,
   ttime varchar(7) NOT NULL,
   tid timestamp(14),
   seen tinyint(1) DEFAULT '0' NOT NULL,
   d_idx varchar(8) NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'medocs'
#

CREATE TABLE medocs (
   dept varchar(30) NOT NULL,
   doc_no int(11) DEFAULT '0' NOT NULL,
   enc_date varchar(11) NOT NULL,
   patient_no int(11) DEFAULT '0' NOT NULL,
   lastname tinytext NOT NULL,
   firstname tinytext NOT NULL,
   birthdate varchar(11) NOT NULL,
   sex char(1) NOT NULL,
   address tinytext NOT NULL,
   insurance tinytext NOT NULL,
   insurance_xtra tinytext NOT NULL,
   informed tinyint(4) DEFAULT '0' NOT NULL,
   diagnosis_1 text NOT NULL,
   therapy_1 text NOT NULL,
   diagnosis_2 text NOT NULL,
   therapy_2 text NOT NULL,
   diagnosis_3 text NOT NULL,
   therapy_3 text NOT NULL,
   keynumber tinytext NOT NULL,
   enc_time varchar(9) NOT NULL,
   encoder tinytext NOT NULL,
   edit_date varchar(11) NOT NULL,
   edit_time varchar(9) NOT NULL,
   editor varchar(30) NOT NULL,
   hidden tinyint(1) DEFAULT '0' NOT NULL
);
# --------------------------------------------------------


#
# Table structure for table 'news_article_de'
#

CREATE TABLE news_article_de (
   category tinytext NOT NULL,
   title tinytext NOT NULL,
   art_num tinyint(1) DEFAULT '0' NOT NULL,
   head_file tinytext NOT NULL,
   main_file tinytext NOT NULL,
   pic_file tinytext NOT NULL,
   author varchar(30) NOT NULL,
   encode_date varchar(10) NOT NULL,
   publish_date varchar(10) NOT NULL,
   logged_encoder varchar(25) NOT NULL,
   tstamp timestamp(14)
);
# --------------------------------------------------------

#
# Table structure for table 'news_article_en'
#

CREATE TABLE news_article_en (
   category tinytext NOT NULL,
   title tinytext NOT NULL,
   art_num tinyint(1) DEFAULT '0' NOT NULL,
   head_file tinytext NOT NULL,
   main_file tinytext NOT NULL,
   pic_file tinytext NOT NULL,
   author varchar(30) NOT NULL,
   encode_date varchar(10) NOT NULL,
   publish_date varchar(10) NOT NULL,
   logged_encoder varchar(25) NOT NULL,
   tstamp timestamp(14)
);
# --------------------------------------------------------

#
# Table structure for table 'news_public'
#

CREATE TABLE news_public (
   recipient tinytext NOT NULL,
   sender tinytext NOT NULL,
   sender_ip tinytext NOT NULL,
   cc tinytext NOT NULL,
   bcc tinytext NOT NULL,
   body text NOT NULL,
   sign tinytext NOT NULL,
   ask4ack tinyint(4) DEFAULT '0' NOT NULL,
   reply2 tinytext NOT NULL,
   attachment tinytext NOT NULL,
   attach_type tinytext NOT NULL,
   read_flag tinyint(4) DEFAULT '0' NOT NULL,
   mailgroup tinytext NOT NULL,
   maildir tinytext NOT NULL,
   exec_level tinyint(4) DEFAULT '0' NOT NULL,
   exclude_addr text NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'nursing_dept_personell_quicklist'
#

CREATE TABLE nursing_dept_personell_quicklist (
   dept varchar(15) NOT NULL,
   year varchar(4) NOT NULL,
   month char(2) NOT NULL,
   list text NOT NULL,
   src_date varchar(6) NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'nursing_dutyplan'
#

CREATE TABLE nursing_dutyplan (
   dept varchar(15) NOT NULL,
   year varchar(4) NOT NULL,
   month char(2) NOT NULL,
   a_dutyplan text NOT NULL,
   r_dutyplan text NOT NULL,
   tid timestamp(14),
   encoding text NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'nursing_op_logbook'
#

CREATE TABLE nursing_op_logbook (
   year varchar(4) DEFAULT '0' NOT NULL,
   dept varchar(30) NOT NULL,
   op_room varchar(10) DEFAULT '0' NOT NULL,
   op_nr mediumint(9) DEFAULT '0' NOT NULL,
   op_date varchar(10) NOT NULL,
   op_src_date varchar(8) NOT NULL,
   patnum varchar(15) NOT NULL,
   lastname varchar(35) NOT NULL,
   firstname varchar(25) NOT NULL,
   bday varchar(10) NOT NULL,
   address tinytext NOT NULL,
   diagnosis text NOT NULL,
   operator text NOT NULL,
   assistant text NOT NULL,
   scrub_nurse text NOT NULL,
   rotating_nurse text NOT NULL,
   anesthesia varchar(30) NOT NULL,
   an_doctor text NOT NULL,
   op_therapy text NOT NULL,
   result_info text NOT NULL,
   entry_time varchar(5) NOT NULL,
   cut_time varchar(5) NOT NULL,
   close_time varchar(5) NOT NULL,
   exit_time varchar(5) NOT NULL,
   entry_out text NOT NULL,
   cut_close text NOT NULL,
   wait_time text NOT NULL,
   bandage_time text NOT NULL,
   repos_time text NOT NULL,
   tid timestamp(14),
   encoding longtext NOT NULL,
   doc_date varchar(10) NOT NULL,
   doc_time varchar(5) NOT NULL,
   duty_type varchar(15) NOT NULL,
   material_codedlist text NOT NULL,
   container_codedlist text NOT NULL,
   icd_code text NOT NULL,
   ops_code text NOT NULL,
   ops_intern_code text NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'nursing_station_de'
#

CREATE TABLE nursing_station_de (
   station varchar(30) NOT NULL,
   dept varchar(10) NOT NULL,
   description text NOT NULL,
   t_date varchar(10) NOT NULL,
   s_date varchar(10) NOT NULL,
   info tinytext NOT NULL,
   start_no smallint(6) DEFAULT '0' NOT NULL,
   end_no smallint(6) DEFAULT '0' NOT NULL,
   bedtype tinyint(4) DEFAULT '0' NOT NULL,
   bed_id1 char(1) DEFAULT 'a' NOT NULL,
   bed_id2 char(1) DEFAULT 'b' NOT NULL,
   maxbed tinyint(2) DEFAULT '0' NOT NULL,
   roomprefix varchar(4) NOT NULL,
   headnurse_1 varchar(30) NOT NULL,
   headnurse_2 varchar(30) NOT NULL,
   nurses text NOT NULL,
   encoder varchar(30) NOT NULL,
   edit_date varchar(10) NOT NULL,
   editor varchar(10) NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'nursing_station_en'
#

CREATE TABLE nursing_station_en (
   station varchar(30) NOT NULL,
   dept varchar(10) NOT NULL,
   description text NOT NULL,
   t_date varchar(10) NOT NULL,
   s_date varchar(10) NOT NULL,
   info tinytext NOT NULL,
   start_no smallint(6) DEFAULT '0' NOT NULL,
   end_no smallint(6) DEFAULT '0' NOT NULL,
   bedtype tinyint(4) DEFAULT '0' NOT NULL,
   bed_id1 char(1) DEFAULT 'a' NOT NULL,
   bed_id2 char(1) DEFAULT 'b' NOT NULL,
   maxbed tinyint(2) DEFAULT '0' NOT NULL,
   roomprefix varchar(4) NOT NULL,
   headnurse_1 varchar(30) NOT NULL,
   headnurse_2 varchar(30) NOT NULL,
   nurses text NOT NULL,
   encoder varchar(30) NOT NULL,
   edit_date varchar(10) NOT NULL,
   editor varchar(10) NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'nursing_station_patients'
#

CREATE TABLE nursing_station_patients (
   station varchar(30) NOT NULL,
   dept varchar(30) NOT NULL,
   name varchar(10) NOT NULL,
   t_date varchar(10) NOT NULL,
   s_date varchar(10) NOT NULL,
   info tinytext NOT NULL,
   start_no smallint(6) DEFAULT '0' NOT NULL,
   end_no smallint(6) DEFAULT '0' NOT NULL,
   bedtype tinyint(4) DEFAULT '0' NOT NULL,
   bed_id1 char(1) DEFAULT 'a' NOT NULL,
   bed_id2 char(1) DEFAULT 'b' NOT NULL,
   roomprefix varchar(4) NOT NULL,
   maxbed tinyint(4) DEFAULT '0' NOT NULL,
   freebed tinyint(4) DEFAULT '0' NOT NULL,
   closedbeds tinyint(4) DEFAULT '0' NOT NULL,
   usedbed tinyint(4) DEFAULT '0' NOT NULL,
   usebed_percent tinyint(4) DEFAULT '0' NOT NULL,
   bed_patient text NOT NULL,
   encoder varchar(30) NOT NULL,
   edit_date text NOT NULL,
   editor text NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'nursing_station_patients_color_rider'
#

CREATE TABLE nursing_station_patients_color_rider (
   patnum int(8) DEFAULT '0' NOT NULL,
   lastname varchar(30) NOT NULL,
   firstname varchar(30) NOT NULL,
   bday varchar(10) NOT NULL,
   red tinyint(1) DEFAULT '0' NOT NULL,
   black tinyint(1) DEFAULT '0' NOT NULL,
   blue tinyint(1) DEFAULT '0' NOT NULL,
   violet tinyint(1) DEFAULT '0' NOT NULL,
   yellow tinyint(1) DEFAULT '0' NOT NULL,
   green tinyint(1) DEFAULT '0' NOT NULL,
   orange tinyint(1) DEFAULT '0' NOT NULL,
   rose_1 tinyint(1) DEFAULT '0' NOT NULL,
   rose_2 tinyint(1) DEFAULT '0' NOT NULL,
   rose_3 tinyint(1) DEFAULT '0' NOT NULL,
   rose_4 tinyint(1) DEFAULT '0' NOT NULL,
   rose_5 tinyint(1) DEFAULT '0' NOT NULL,
   rose_6 tinyint(1) DEFAULT '0' NOT NULL,
   rose_7 tinyint(1) DEFAULT '0' NOT NULL,
   rose_8 tinyint(1) DEFAULT '0' NOT NULL,
   rose_9 tinyint(1) DEFAULT '0' NOT NULL,
   rose_10 tinyint(1) DEFAULT '0' NOT NULL,
   rose_11 tinyint(1) DEFAULT '0' NOT NULL,
   rose_12 tinyint(1) DEFAULT '0' NOT NULL,
   rose_13 tinyint(1) DEFAULT '0' NOT NULL,
   rose_14 tinyint(1) DEFAULT '0' NOT NULL,
   rose_15 tinyint(1) DEFAULT '0' NOT NULL,
   rose_16 tinyint(1) DEFAULT '0' NOT NULL,
   rose_17 tinyint(1) DEFAULT '0' NOT NULL,
   rose_18 tinyint(1) DEFAULT '0' NOT NULL,
   rose_19 tinyint(1) DEFAULT '0' NOT NULL,
   rose_20 tinyint(1) DEFAULT '0' NOT NULL,
   rose_21 tinyint(1) DEFAULT '0' NOT NULL,
   rose_22 tinyint(1) DEFAULT '0' NOT NULL,
   rose_23 tinyint(1) DEFAULT '0' NOT NULL,
   rose_24 tinyint(1) DEFAULT '0' NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'nursing_station_patients_curve'
#

CREATE TABLE nursing_station_patients_curve (
   patnum bigint(20) DEFAULT '0' NOT NULL,
   lastname varchar(40) DEFAULT '0' NOT NULL,
   firstname varchar(30) DEFAULT '0' NOT NULL,
   bday varchar(10) DEFAULT '0' NOT NULL,
   allergy text NOT NULL,
   cave tinytext NOT NULL,
   diag_ther text NOT NULL,
   xdiag_specials text NOT NULL,
   anticoag varchar(40) NOT NULL,
   anticoag_dailydose text NOT NULL,
   lot_mat_etc text NOT NULL,
   iv_needle text NOT NULL,
   medication text NOT NULL,
   medication_dailydose text NOT NULL,
   fe_date varchar(10) DEFAULT '0' NOT NULL,
   le_date varchar(10) NOT NULL,
   diet text NOT NULL,
   bp_temp text NOT NULL,
   diag_ther_dailyreport text NOT NULL,
   kg_atg_etc text NOT NULL,
   encoding text NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'nursing_station_patients_diagnostic_reports'
#

CREATE TABLE nursing_station_patients_diagnostic_reports (
   patnum bigint(20) DEFAULT '0' NOT NULL,
   lastname varchar(40) DEFAULT '0' NOT NULL,
   firstname varchar(30) DEFAULT '0' NOT NULL,
   bday varchar(10) DEFAULT '0' NOT NULL,
   dept varchar(20) DEFAULT '0' NOT NULL,
   report text NOT NULL,
   report_date varchar(10) NOT NULL,
   report_src_date varchar(8) NOT NULL,
   send tinyint(1) DEFAULT '0' NOT NULL,
   send_date varchar(10) NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'nursing_station_patients_diagnostic_requests'
#

CREATE TABLE nursing_station_patients_diagnostic_requests (
   patnum bigint(20) DEFAULT '0' NOT NULL,
   lastname varchar(40) DEFAULT '0' NOT NULL,
   firstname varchar(30) DEFAULT '0' NOT NULL,
   bday varchar(10) DEFAULT '0' NOT NULL,
   dept varchar(20) DEFAULT '0' NOT NULL,
   report text NOT NULL,
   report_date varchar(10) NOT NULL,
   report_src_date varchar(8) NOT NULL,
   send tinyint(1) DEFAULT '0' NOT NULL,
   send_date varchar(10) NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'nursing_station_patients_directives'
#

CREATE TABLE nursing_station_patients_directives (
   patnum bigint(20) DEFAULT '0' NOT NULL,
   lastname varchar(40) DEFAULT '0' NOT NULL,
   firstname varchar(30) DEFAULT '0' NOT NULL,
   bday varchar(10) DEFAULT '0' NOT NULL,
   fe_date varchar(10) DEFAULT '0' NOT NULL,
   le_date varchar(10) NOT NULL,
   report text NOT NULL,
   np_report text NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'nursing_station_patients_release'
#

CREATE TABLE nursing_station_patients_release (
   station varchar(30) NOT NULL,
   dept varchar(30) NOT NULL,
   name varchar(10) NOT NULL,
   patnum varchar(10) NOT NULL,
   lastname varchar(30) NOT NULL,
   firstname varchar(25) NOT NULL,
   bday varchar(10) NOT NULL,
   x_date varchar(10) NOT NULL,
   x_time varchar(5) NOT NULL,
   relart varchar(10) NOT NULL,
   s_date varchar(10) NOT NULL,
   discharge_rem tinytext NOT NULL,
   ward_rem text NOT NULL,
   encoder varchar(30) NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'nursing_station_patients_report'
#

CREATE TABLE nursing_station_patients_report (
   patnum bigint(20) DEFAULT '0' NOT NULL,
   lastname varchar(40) DEFAULT '0' NOT NULL,
   firstname varchar(30) DEFAULT '0' NOT NULL,
   bday varchar(10) DEFAULT '0' NOT NULL,
   fe_date varchar(10) DEFAULT '0' NOT NULL,
   le_date varchar(10) NOT NULL,
   report text NOT NULL,
   np_report text NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'nursing_station_patients_root'
#

CREATE TABLE nursing_station_patients_root (
   patnum bigint(20) DEFAULT '0' NOT NULL,
   lastname varchar(40) NOT NULL,
   firstname varchar(30) NOT NULL,
   bday varchar(10) NOT NULL,
   address tinytext NOT NULL,
   phone varchar(30) NOT NULL,
   acc1 varchar(40) NOT NULL,
   acc1_phone varchar(25) NOT NULL,
   acc2 varchar(40) NOT NULL,
   acc2_phone varchar(25) NOT NULL,
   insurance_type varchar(15) NOT NULL,
   insurance_name tinytext NOT NULL,
   eyeglass tinyint(4) DEFAULT '0' NOT NULL,
   contactlens tinyint(4) DEFAULT '0' NOT NULL,
   teethprosthesis tinyint(4) DEFAULT '0' NOT NULL,
   hws_syndrom tinyint(4) DEFAULT '0' NOT NULL,
   allergy tinytext NOT NULL,
   medication tinytext NOT NULL,
   entry_date varchar(10) DEFAULT '0' NOT NULL,
   entry_time varchar(5) DEFAULT '0' NOT NULL,
   entry_station varchar(20) NOT NULL,
   encoder varchar(25) NOT NULL,
   tid timestamp(14)
);
# --------------------------------------------------------

#
# Table structure for table 'op_med_doc'
#

CREATE TABLE op_med_doc (
   dept varchar(25) NOT NULL,
   doc_no mediumint(9) DEFAULT '0' NOT NULL,
   op_date varchar(12) NOT NULL,
   op_time varchar(10) NOT NULL,
   operator tinytext NOT NULL,
   patient_no int(9) DEFAULT '0' NOT NULL,
   lastname tinytext NOT NULL,
   firstname tinytext NOT NULL,
   birthdate tinytext NOT NULL,
   status varchar(5) NOT NULL,
   finanz varchar(7) NOT NULL,
   diagnosis text NOT NULL,
   localize text NOT NULL,
   therapy text NOT NULL,
   special text NOT NULL,
   class_s tinyint(4) DEFAULT '0' NOT NULL,
   class_m tinyint(4) DEFAULT '0' NOT NULL,
   class_l tinyint(4) DEFAULT '0' NOT NULL,
   op_start varchar(7) NOT NULL,
   op_end varchar(7) NOT NULL,
   scrub_nurse tinytext NOT NULL,
   op_room char(3) NOT NULL,
   encoder tinytext NOT NULL,
   encode_dt varchar(20) NOT NULL,
   editor tinytext NOT NULL,
   edit_dt varchar(20) NOT NULL,
   tstamp timestamp(14)
);
# --------------------------------------------------------

#
# Table structure for table 'ops301_de'
#

CREATE TABLE ops301_de (
   code varchar(12) NOT NULL,
   description text NOT NULL,
   inclusive text NOT NULL,
   exclusive text NOT NULL,
   notes text NOT NULL,
   std_code char(1) NOT NULL,
   sub_level tinyint(4) DEFAULT '0' NOT NULL,
   remarks text NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'ops301_en'
#

CREATE TABLE ops301_en (
   code varchar(12) NOT NULL,
   description text NOT NULL,
   inclusive text NOT NULL,
   exclusive text NOT NULL,
   notes text NOT NULL,
   std_code char(1) NOT NULL,
   sub_level tinyint(4) DEFAULT '0' NOT NULL,
   remarks text NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'personell_data'
#

CREATE TABLE personell_data (
   personell_nr varchar(15) NOT NULL,
   lastname varchar(40) NOT NULL,
   jr_sr varchar(10) NOT NULL,
   firstname varchar(30) NOT NULL,
   bday varchar(10) NOT NULL,
   bday_src varchar(8) NOT NULL,
   sex varchar(10) NOT NULL,
   title varchar(20) NOT NULL,
   address tinytext NOT NULL,
   profession varchar(50) NOT NULL,
   phone1 varchar(40) NOT NULL,
   phone2 varchar(40) NOT NULL,
   tid timestamp(14),
   duty_phone varchar(40) NOT NULL,
   duty_funk varchar(10) NOT NULL,
   oncall_phone varchar(40) NOT NULL,
   oncall_funk varchar(10) NOT NULL,
   info text NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'personell_data_quicklist'
#

CREATE TABLE personell_data_quicklist (
   dept varchar(20) NOT NULL,
   personell_nr varchar(15) NOT NULL,
   lastname varchar(40) NOT NULL,
   jr_sr varchar(10) NOT NULL,
   firstname varchar(30) NOT NULL,
   bday varchar(10) NOT NULL,
   bday_src varchar(8) NOT NULL,
   sex varchar(10) NOT NULL,
   title varchar(20) NOT NULL,
   profession varchar(50) NOT NULL,
   info text NOT NULL,
   frequency smallint(5) unsigned DEFAULT '0' NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'pharma_ordercatalog'
#

CREATE TABLE pharma_ordercatalog (
   dept varchar(20) NOT NULL,
   hit int(11) DEFAULT '0' NOT NULL,
   artikelname tinytext NOT NULL,
   bestellnum tinytext NOT NULL,
   proorder tinytext NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'pharma_orderlist'
#

CREATE TABLE pharma_orderlist (
   dept varchar(20) NOT NULL,
   order_id tinytext NOT NULL,
   order_date tinytext NOT NULL,
   articles text NOT NULL,
   extra1 tinytext NOT NULL,
   extra2 text NOT NULL,
   encoder tinytext NOT NULL,
   validator tinytext NOT NULL,
   order_time text NOT NULL,
   ip_addr tinytext NOT NULL,
   priority tinytext NOT NULL,
   sent_stamp timestamp(14)
);
# --------------------------------------------------------

#
# Table structure for table 'pharma_orderlist_archive'
#

CREATE TABLE pharma_orderlist_archive (
   rec_date tinytext NOT NULL,
   rec_time tinytext NOT NULL,
   order_id tinytext NOT NULL,
   dept tinytext NOT NULL,
   clerk tinytext NOT NULL,
   done_date tinytext NOT NULL,
   status tinytext NOT NULL,
   priority tinytext NOT NULL,
   t_stamp timestamp(14)
);
# --------------------------------------------------------

#
# Table structure for table 'pharma_orderlist_archive_trash'
#

CREATE TABLE pharma_orderlist_archive_trash (
   rec_date tinytext NOT NULL,
   rec_time tinytext NOT NULL,
   order_id tinytext NOT NULL,
   dept tinytext NOT NULL,
   clerk tinytext NOT NULL,
   done_date tinytext NOT NULL,
   status tinytext NOT NULL,
   priority tinytext NOT NULL,
   t_stamp timestamp(14)
);
# --------------------------------------------------------

#
# Table structure for table 'pharma_orderlist_todo'
#

CREATE TABLE pharma_orderlist_todo (
   rec_date tinytext NOT NULL,
   rec_time tinytext NOT NULL,
   order_id tinytext NOT NULL,
   dept tinytext NOT NULL,
   clerk tinytext NOT NULL,
   done_date tinytext NOT NULL,
   status tinytext NOT NULL,
   priority tinytext NOT NULL,
   t_stamp timestamp(14)
);
# --------------------------------------------------------

#
# Table structure for table 'pharma_products_main'
#

CREATE TABLE pharma_products_main (
   bestellnum tinytext NOT NULL,
   artikelnum tinytext NOT NULL,
   industrynum tinytext NOT NULL,
   artikelname tinytext NOT NULL,
   generic tinytext NOT NULL,
   description text NOT NULL,
   packing tinytext NOT NULL,
   minorder int(4) DEFAULT '0' NOT NULL,
   maxorder int(4) DEFAULT '0' NOT NULL,
   proorder tinytext NOT NULL,
   picfile tinytext NOT NULL,
   encoder tinytext NOT NULL,
   enc_date tinytext NOT NULL,
   enc_time tinytext NOT NULL,
   lock_flag tinyint(1) DEFAULT '0' NOT NULL,
   medgroup text NOT NULL,
   cave tinytext NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'pharma_products_trash'
#

CREATE TABLE pharma_products_trash (
   bestellnum tinytext NOT NULL,
   artikelnum tinytext NOT NULL,
   industrynum tinytext NOT NULL,
   artikelname tinytext NOT NULL,
   generic tinytext NOT NULL,
   description text NOT NULL,
   packing tinytext NOT NULL,
   minorder int(4) DEFAULT '0' NOT NULL,
   maxorder int(4) DEFAULT '0' NOT NULL,
   proorder tinytext NOT NULL,
   picfile tinytext NOT NULL,
   encoder tinytext NOT NULL,
   enc_date tinytext NOT NULL,
   enc_time tinytext NOT NULL,
   lock_flag tinyint(1) DEFAULT '0' NOT NULL,
   medgroup text NOT NULL,
   cave tinytext NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'station2dept_table'
#

CREATE TABLE station2dept_table (
   dept tinytext NOT NULL,
   station text NOT NULL,
   op tinyint(4) DEFAULT '0' NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'steri_products_main'
#

CREATE TABLE steri_products_main (
   bestellnum int(15) unsigned DEFAULT '0' NOT NULL,
   containernum varchar(15) NOT NULL,
   industrynum tinytext NOT NULL,
   containername varchar(40) NOT NULL,
   description text NOT NULL,
   packing tinytext NOT NULL,
   minorder int(4) unsigned DEFAULT '0' NOT NULL,
   maxorder int(4) unsigned DEFAULT '0' NOT NULL,
   proorder tinytext NOT NULL,
   picfile tinytext NOT NULL,
   encoder tinytext NOT NULL,
   enc_date tinytext NOT NULL,
   enc_time tinytext NOT NULL,
   lock_flag tinyint(1) DEFAULT '0' NOT NULL,
   medgroup text NOT NULL,
   cave tinytext NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'tech_questions'
#

CREATE TABLE tech_questions (
   dept varchar(15) NOT NULL,
   query text NOT NULL,
   inquirer varchar(25) NOT NULL,
   tphone varchar(30) NOT NULL,
   tdate varchar(11) NOT NULL,
   ttime varchar(7) NOT NULL,
   tid timestamp(14),
   reply text NOT NULL,
   answered tinyint(1) DEFAULT '0' NOT NULL,
   ansby varchar(25) NOT NULL,
   astamp varchar(16) NOT NULL,
   archive tinyint(1) DEFAULT '0' NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'tech_repair_done'
#

CREATE TABLE tech_repair_done (
   dept varchar(15) NOT NULL,
   job_id bigint(14),
   job text NOT NULL,
   reporter varchar(25) NOT NULL,
   id varchar(15) NOT NULL,
   tdate varchar(11) NOT NULL,
   ttime varchar(7) NOT NULL,
   tid timestamp(14),
   seen tinyint(1) DEFAULT '0' NOT NULL,
   d_idx varchar(8) NOT NULL
);
# --------------------------------------------------------

#
# Table structure for table 'tech_repair_job'
#

CREATE TABLE tech_repair_job (
   dept varchar(15) NOT NULL,
   job text NOT NULL,
   reporter varchar(25) NOT NULL,
   id varchar(15) NOT NULL,
   tphone varchar(30) NOT NULL,
   tdate varchar(11) NOT NULL,
   ttime varchar(7) NOT NULL,
   tid timestamp(14),
   done tinyint(1) DEFAULT '0' NOT NULL,
   seen tinyint(1) DEFAULT '0' NOT NULL,
   seenby varchar(25) NOT NULL,
   sstamp varchar(16) NOT NULL,
   doneby varchar(25) NOT NULL,
   dstamp varchar(16) NOT NULL,
   d_idx varchar(8) NOT NULL,
   archive tinyint(1) DEFAULT '0' NOT NULL
);
