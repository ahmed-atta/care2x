# phpMyAdmin MySQL-Dump
# version 2.4.0-rc1
# http://www.phpmyadmin.net/ (download page)
#
# Host: localhost
# Erstellungszeit: 20. Juni 2003 um 17:23
# Server Version: 4.0.13
# PHP-Version: 4.3.2
# Datenbank: x
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_address_citytown`
#

CREATE TABLE care_address_citytown (
  nr mediumint(8) unsigned NOT NULL auto_increment,
  unece_modifier char(2) default NULL,
  unece_locode varchar(15) default NULL,
  name varchar(100) NOT NULL default '',
  iso_country_id char(3) NOT NULL default '',
  unece_locode_type tinyint(3) unsigned default NULL,
  unece_coordinates varchar(25) default NULL,
  info_url varchar(255) default NULL,
  use_frequency bigint(20) unsigned NOT NULL default '0',
  status varchar(25) default NULL,
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY name (name)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_address_country`
#

CREATE TABLE care_address_country (
  nr int(10) unsigned NOT NULL auto_increment,
  iso_code char(3) NOT NULL default '0',
  name varchar(100) NOT NULL default '0',
  status varchar(25) default NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY type (iso_code)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_address_region`
#

CREATE TABLE care_address_region (
  nr int(10) unsigned NOT NULL auto_increment,
  region_code varchar(10) NOT NULL default '0',
  name varchar(100) NOT NULL default '0',
  status varchar(25) default NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_appointment`
#

CREATE TABLE care_appointment (
  nr bigint(20) unsigned NOT NULL auto_increment,
  pid int(11) NOT NULL default '0',
  date date NOT NULL default '0000-00-00',
  time time NOT NULL default '00:00:00',
  to_dept_id varchar(25) NOT NULL default '',
  to_dept_nr smallint(5) unsigned NOT NULL default '0',
  to_personell_nr int(11) NOT NULL default '0',
  to_personell_name varchar(60) default NULL,
  purpose text NOT NULL,
  urgency tinyint(2) unsigned NOT NULL default '0',
  remind tinyint(1) unsigned NOT NULL default '0',
  remind_email tinyint(1) unsigned NOT NULL default '0',
  remind_mail tinyint(1) unsigned NOT NULL default '0',
  remind_phone tinyint(1) unsigned NOT NULL default '0',
  appt_status varchar(35) NOT NULL default 'pending',
  cancel_by varchar(255) NOT NULL default '',
  cancel_date date default NULL,
  cancel_reason varchar(255) default NULL,
  encounter_class varchar(25) NOT NULL default '',
  encounter_nr int(11) NOT NULL default '0',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY pid (pid)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_billing_archive`
#

CREATE TABLE care_billing_archive (
  bill_no bigint(20) NOT NULL default '0',
  encounter_nr int(10) NOT NULL default '0',
  patient_name tinytext NOT NULL,
  vorname varchar(35) NOT NULL default '0',
  bill_date_time datetime NOT NULL default '0000-00-00 00:00:00',
  bill_amt double(16,4) NOT NULL default '0.0000',
  payment_date_time datetime NOT NULL default '0000-00-00 00:00:00',
  payment_mode text NOT NULL,
  cheque_no varchar(10) NOT NULL default '0',
  creditcard_no varchar(10) NOT NULL default '0',
  paid_by varchar(15) NOT NULL default '0',
  PRIMARY KEY  (bill_no)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_billing_bill`
#

CREATE TABLE care_billing_bill (
  bill_bill_no bigint(20) NOT NULL default '0',
  bill_encounter_nr int(10) unsigned NOT NULL default '0',
  bill_date_time date default NULL,
  bill_amount float(10,2) default NULL,
  bill_outstanding float(10,2) default NULL,
  PRIMARY KEY  (bill_bill_no),
  KEY index_bill_patnum (bill_encounter_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_billing_bill_item`
#

CREATE TABLE care_billing_bill_item (
  bill_item_id int(11) NOT NULL auto_increment,
  bill_item_encounter_nr int(10) unsigned NOT NULL default '0',
  bill_item_code varchar(5) default NULL,
  bill_item_unit_cost float(10,2) default '0.00',
  bill_item_units tinyint(4) default NULL,
  bill_item_amount float(10,2) default NULL,
  bill_item_date datetime default NULL,
  bill_item_status enum('0','1') default '0',
  bill_item_bill_no int(11) NOT NULL default '0',
  PRIMARY KEY  (bill_item_id),
  KEY index_bill_item_patnum (bill_item_encounter_nr),
  KEY index_bill_item_bill_no (bill_item_bill_no)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_billing_final`
#

CREATE TABLE care_billing_final (
  final_id tinyint(3) NOT NULL auto_increment,
  final_encounter_nr int(10) unsigned NOT NULL default '0',
  final_bill_no int(11) default NULL,
  final_date date default NULL,
  final_total_bill_amount float(10,2) default NULL,
  final_discount tinyint(4) default NULL,
  final_total_receipt_amount float(10,2) default NULL,
  final_amount_due float(10,2) default NULL,
  final_amount_recieved float(10,2) default NULL,
  PRIMARY KEY  (final_id),
  KEY index_final_patnum (final_encounter_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_billing_item`
#

CREATE TABLE care_billing_item (
  item_code varchar(5) NOT NULL default '',
  item_description varchar(100) default NULL,
  item_unit_cost float(10,2) default '0.00',
  item_type tinytext,
  item_discount_max_allowed tinyint(4) unsigned default '0',
  PRIMARY KEY  (item_code)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_billing_payment`
#

CREATE TABLE care_billing_payment (
  payment_id tinyint(5) NOT NULL auto_increment,
  payment_encounter_nr int(10) unsigned NOT NULL default '0',
  payment_receipt_no int(11) NOT NULL default '0',
  payment_date datetime default '0000-00-00 00:00:00',
  payment_cash_amount float(10,2) default '0.00',
  payment_cheque_no int(11) default '0',
  payment_cheque_amount float(10,2) default '0.00',
  payment_creditcard_no int(25) default '0',
  payment_creditcard_amount float(10,2) default '0.00',
  payment_amount_total float(10,2) default '0.00',
  PRIMARY KEY  (payment_id),
  KEY index_payment_patnum (payment_encounter_nr),
  KEY index_payment_receipt_no (payment_receipt_no)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_cafe_menu`
#

CREATE TABLE care_cafe_menu (
  item int(11) NOT NULL auto_increment,
  lang varchar(10) NOT NULL default 'en',
  cdate date NOT NULL default '0000-00-00',
  menu text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  UNIQUE KEY item_2 (item),
  KEY item (item,lang),
  KEY cdate (cdate)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_cafe_prices`
#

CREATE TABLE care_cafe_prices (
  item int(11) NOT NULL auto_increment,
  lang varchar(10) NOT NULL default 'en',
  productgroup tinytext NOT NULL,
  article tinytext NOT NULL,
  description tinytext NOT NULL,
  price varchar(10) NOT NULL default '',
  unit tinytext NOT NULL,
  pic_filename tinytext NOT NULL,
  modify_id varchar(25) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(25) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  KEY item (item),
  KEY lang (lang)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_category_diagnosis`
#

CREATE TABLE care_category_diagnosis (
  nr tinyint(3) unsigned NOT NULL default '0',
  category varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  short_code char(1) NOT NULL default '',
  LD_var_short_code varchar(25) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  hide_from varchar(255) NOT NULL default '0',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_category_disease`
#

CREATE TABLE care_category_disease (
  nr tinyint(3) unsigned NOT NULL auto_increment,
  group_nr tinyint(3) unsigned NOT NULL default '0',
  category varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_category_procedure`
#

CREATE TABLE care_category_procedure (
  nr tinyint(3) unsigned NOT NULL default '0',
  category varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  short_code char(1) NOT NULL default '',
  LD_var_short_code varchar(25) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  hide_from varchar(255) NOT NULL default '0',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_class_encounter`
#

CREATE TABLE care_class_encounter (
  class_nr smallint(6) unsigned NOT NULL default '0',
  class_id varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(25) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  hide_from tinyint(4) NOT NULL default '0',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (class_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_class_ethnic_orig`
#

CREATE TABLE care_class_ethnic_orig (
  nr smallint(5) unsigned NOT NULL auto_increment,
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  status varchar(25) default NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_class_financial`
#

CREATE TABLE care_class_financial (
  class_nr smallint(5) unsigned NOT NULL auto_increment,
  class_id varchar(15) NOT NULL default '0',
  type varchar(25) NOT NULL default '0',
  code varchar(5) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(25) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  policy text NOT NULL,
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (class_nr),
  KEY class_2 (class_id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_class_insurance`
#

CREATE TABLE care_class_insurance (
  class_nr smallint(5) unsigned NOT NULL auto_increment,
  class_id varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(25) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (class_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_class_therapy`
#

CREATE TABLE care_class_therapy (
  nr smallint(5) unsigned NOT NULL auto_increment,
  group_nr tinyint(3) unsigned NOT NULL default '0',
  class varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(25) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_complication`
#

CREATE TABLE care_complication (
  nr int(10) unsigned NOT NULL auto_increment,
  group_nr int(11) unsigned NOT NULL default '0',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  code varchar(25) default NULL,
  description varchar(255) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_config_global`
#

CREATE TABLE care_config_global (
  type varchar(60) NOT NULL default '',
  value varchar(255) default NULL,
  notes varchar(255) default NULL,
  status varchar(25) default NULL,
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (type)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_config_user`
#

CREATE TABLE care_config_user (
  user_id varchar(100) NOT NULL default '',
  serial_config_data text NOT NULL,
  notes varchar(255) default NULL,
  status varchar(25) default NULL,
  history text,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (user_id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_currency`
#

CREATE TABLE care_currency (
  item_no smallint(5) unsigned NOT NULL auto_increment,
  short_name varchar(5) NOT NULL default '',
  long_name varchar(20) NOT NULL default '',
  info varchar(50) NOT NULL default '',
  status varchar(5) NOT NULL default '',
  modify_id varchar(20) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(20) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  KEY item_no (item_no),
  KEY short_name (short_name)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_department`
#

CREATE TABLE care_department (
  nr mediumint(8) unsigned NOT NULL auto_increment,
  id varchar(60) NOT NULL default '',
  type varchar(25) NOT NULL default '',
  name_formal varchar(60) NOT NULL default '',
  name_short varchar(35) NOT NULL default '',
  name_alternate varchar(225) default NULL,
  LD_var varchar(35) NOT NULL default '',
  description text NOT NULL,
  admit_inpatient tinyint(1) NOT NULL default '0',
  admit_outpatient tinyint(1) NOT NULL default '0',
  has_oncall_doc tinyint(1) NOT NULL default '1',
  has_oncall_nurse tinyint(1) NOT NULL default '1',
  does_surgery tinyint(1) NOT NULL default '0',
  this_institution tinyint(1) NOT NULL default '1',
  is_sub_dept tinyint(1) NOT NULL default '0',
  parent_dept_nr tinyint(3) unsigned default NULL,
  work_hours varchar(100) default NULL,
  consult_hours varchar(100) default NULL,
  is_inactive tinyint(1) NOT NULL default '0',
  sort_order tinyint(3) unsigned NOT NULL default '0',
  address text,
  sig_line varchar(60) default NULL,
  sig_stamp text,
  logo_mime_type varchar(5) default NULL,
  status varchar(25) NOT NULL default '',
  history text,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  UNIQUE KEY id (id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_department_firm`
#

CREATE TABLE care_department_firm (
  nr mediumint(8) unsigned NOT NULL auto_increment,
  firm_id varchar(35) NOT NULL default '',
  firm_name varchar(255) NOT NULL default '',
  description text NOT NULL,
  dept_id varchar(35) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_department_time`
#

CREATE TABLE care_department_time (
  nr int(10) unsigned NOT NULL auto_increment,
  dept_nr mediumint(8) unsigned NOT NULL default '0',
  time_type_nr smallint(5) unsigned NOT NULL default '0',
  status tinyint(4) NOT NULL default '0',
  modify_id tinyint(4) NOT NULL default '0',
  modify_time tinyint(4) NOT NULL default '0',
  create_id tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (nr),
  KEY dept_nr (dept_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_diagnosis_localcode`
#

CREATE TABLE care_diagnosis_localcode (
  localcode varchar(12) NOT NULL default '',
  description text NOT NULL,
  class_sub varchar(5) NOT NULL default '',
  type varchar(10) NOT NULL default '',
  inclusive text NOT NULL,
  exclusive text NOT NULL,
  notes text NOT NULL,
  std_code char(1) NOT NULL default '',
  sub_level tinyint(4) NOT NULL default '0',
  remarks text NOT NULL,
  extra_codes text NOT NULL,
  extra_subclass text NOT NULL,
  search_keys varchar(255) NOT NULL default '',
  use_frequency int(11) NOT NULL default '0',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  KEY diagnosis_code (localcode)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_doctor_referrer`
#

CREATE TABLE care_doctor_referrer (
  referrer_dr int(11) NOT NULL default '0',
  pid int(11) NOT NULL default '0',
  specialization varchar(60) NOT NULL default '',
  p_addr_str varchar(60) NOT NULL default '',
  p_addr_str_nr varchar(10) NOT NULL default '',
  p_addr_zip varchar(25) NOT NULL default '',
  p_addr_city_town varchar(60) NOT NULL default '',
  p_phone varchar(60) NOT NULL default '',
  p_fax varchar(60) NOT NULL default '',
  p_email varchar(60) NOT NULL default '',
  p_info_url varchar(255) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  KEY referrer (referrer_dr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_drg_intern`
#

CREATE TABLE care_drg_intern (
  nr int(11) NOT NULL auto_increment,
  code varchar(12) NOT NULL default '',
  description text NOT NULL,
  synonyms text NOT NULL,
  notes text,
  std_code char(1) NOT NULL default '',
  sub_level tinyint(1) NOT NULL default '0',
  parent_code varchar(12) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(25) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(25) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  UNIQUE KEY code_2 (code),
  KEY nr (nr),
  KEY code (code)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_drg_quicklist`
#

CREATE TABLE care_drg_quicklist (
  nr int(11) NOT NULL auto_increment,
  code varchar(25) NOT NULL default '',
  code_parent varchar(25) NOT NULL default '',
  dept_nr smallint(5) unsigned NOT NULL default '0',
  qlist_type varchar(25) NOT NULL default '0',
  rank int(11) NOT NULL default '0',
  status varchar(15) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(25) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(25) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_drg_related_codes`
#

CREATE TABLE care_drg_related_codes (
  nr int(11) NOT NULL auto_increment,
  group_nr int(11) unsigned NOT NULL default '0',
  code varchar(15) NOT NULL default '',
  code_parent varchar(15) NOT NULL default '',
  code_type varchar(15) NOT NULL default '',
  rank int(11) NOT NULL default '0',
  status varchar(15) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(25) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(25) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_dutyplan_oncall`
#

CREATE TABLE care_dutyplan_oncall (
  nr bigint(20) unsigned NOT NULL auto_increment,
  dept_nr int(10) unsigned NOT NULL default '0',
  role_nr tinyint(3) unsigned NOT NULL default '0',
  year year(4) NOT NULL default '0000',
  month char(2) NOT NULL default '',
  duty_1_txt text NOT NULL,
  duty_2_txt text NOT NULL,
  duty_1_pnr text NOT NULL,
  duty_2_pnr text NOT NULL,
  status varchar(25) default NULL,
  history text,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY dept_nr (dept_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter`
#

CREATE TABLE care_encounter (
  encounter_nr bigint(11) unsigned NOT NULL auto_increment,
  pid int(11) NOT NULL default '0',
  encounter_date datetime NOT NULL default '0000-00-00 00:00:00',
  encounter_class_nr smallint(5) unsigned NOT NULL default '0',
  encounter_type varchar(35) NOT NULL default '',
  encounter_status varchar(35) NOT NULL default '',
  referrer_diagnosis varchar(255) NOT NULL default '',
  referrer_recom_therapy varchar(255) default NULL,
  referrer_dr varchar(60) NOT NULL default '',
  referrer_dept varchar(255) NOT NULL default '',
  referrer_institution varchar(255) NOT NULL default '',
  referrer_notes text NOT NULL,
  financial_class_nr tinyint(3) unsigned NOT NULL default '0',
  insurance_nr varchar(25) default '0',
  insurance_firm_id varchar(25) NOT NULL default '0',
  insurance_class_nr tinyint(3) unsigned NOT NULL default '0',
  insurance_2_nr varchar(25) default '0',
  insurance_2_firm_id varchar(25) NOT NULL default '0',
  guarantor_pid int(11) NOT NULL default '0',
  contact_pid int(11) NOT NULL default '0',
  contact_relation varchar(35) NOT NULL default '',
  current_ward_nr smallint(5) unsigned default NULL,
  current_room_nr smallint(5) unsigned default '0',
  in_ward tinyint(1) NOT NULL default '0',
  current_dept_nr smallint(5) unsigned default NULL,
  current_firm_nr smallint(5) unsigned default NULL,
  current_att_dr_nr int(10) NOT NULL default '0',
  consulting_dr varchar(60) NOT NULL default '',
  extra_service varchar(25) NOT NULL default '',
  is_discharged tinyint(1) unsigned NOT NULL default '0',
  discharge_date date default NULL,
  discharge_time time default NULL,
  followup_date datetime NOT NULL default '0000-00-00 00:00:00',
  followup_responsibility varchar(255) default NULL,
  post_encounter_notes text NOT NULL,
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (encounter_nr),
  KEY pid (pid),
  KEY encounter_date (encounter_date)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_anamnesis`
#

CREATE TABLE care_encounter_anamnesis (
  encounter_nr int(11) NOT NULL default '0',
  eyeglass tinyint(1) default '0',
  contactlens tinyint(1) default '0',
  teethprosthesis tinyint(1) default '0',
  cervical_syndrom tinyint(1) default '0',
  allergy_known tinyint(1) default NULL,
  is_previous_med tinyint(1) default NULL,
  entry_date varchar(10) NOT NULL default '0',
  entry_time varchar(5) NOT NULL default '0',
  personell_nr int(11) NOT NULL default '0',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (encounter_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_bowel_movmt`
#

CREATE TABLE care_encounter_bowel_movmt (
  date date NOT NULL default '0000-00-00',
  encounter_nr int(11) NOT NULL default '0',
  bowel_movmt varchar(35) NOT NULL default '',
  status varchar(25) default NULL,
  history text,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (encounter_nr),
  KEY date (date)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_diagnosis`
#

CREATE TABLE care_encounter_diagnosis (
  diagnosis_nr int(11) NOT NULL auto_increment,
  encounter_nr int(11) NOT NULL default '0',
  op_nr int(10) unsigned NOT NULL default '0',
  date datetime NOT NULL default '0000-00-00 00:00:00',
  code varchar(25) NOT NULL default '',
  code_parent varchar(25) NOT NULL default '',
  group_nr mediumint(8) unsigned NOT NULL default '0',
  code_version tinyint(4) NOT NULL default '0',
  localcode varchar(35) NOT NULL default '',
  category_nr tinyint(3) unsigned NOT NULL default '0',
  type varchar(35) NOT NULL default '',
  localization varchar(35) NOT NULL default '',
  diagnosing_clinician varchar(60) NOT NULL default '',
  diagnosing_dept_nr smallint(5) unsigned NOT NULL default '0',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (diagnosis_nr),
  KEY encounter_nr (encounter_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_diagnostics_report`
#

CREATE TABLE care_encounter_diagnostics_report (
  item_nr int(11) NOT NULL auto_increment,
  report_nr int(11) NOT NULL default '0',
  reporting_dept_nr smallint(5) unsigned NOT NULL default '0',
  reporting_dept varchar(100) NOT NULL default '',
  report_date date NOT NULL default '0000-00-00',
  report_time time NOT NULL default '00:00:00',
  encounter_nr int(10) NOT NULL default '0',
  script_call varchar(255) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (item_nr),
  KEY report_nr (report_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_diet`
#

CREATE TABLE care_encounter_diet (
  date date NOT NULL default '0000-00-00',
  encounter_nr int(11) unsigned NOT NULL default '0',
  diet_nr int(10) unsigned NOT NULL default '0',
  status varchar(25) default NULL,
  history text,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (encounter_nr),
  KEY date (date)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_doctor_directive`
#

CREATE TABLE care_encounter_doctor_directive (
  nr int(11) unsigned NOT NULL auto_increment,
  encounter_nr int(11) unsigned NOT NULL default '0',
  date date NOT NULL default '0000-00-00',
  directive text NOT NULL,
  dr_initials varchar(6) NOT NULL default '',
  dr_personell_nr int(11) unsigned NOT NULL default '0',
  ack_personell_nr int(10) unsigned default '0',
  ack_initials varchar(6) default NULL,
  ack_date datetime NOT NULL default '0000-00-00 00:00:00',
  location_type varchar(35) default NULL,
  location_id varchar(35) default NULL,
  status varchar(25) default NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_drg_intern`
#

CREATE TABLE care_encounter_drg_intern (
  nr int(11) NOT NULL auto_increment,
  encounter_nr int(11) NOT NULL default '0',
  date datetime NOT NULL default '0000-00-00 00:00:00',
  group_nr mediumint(8) unsigned NOT NULL default '0',
  clinician varchar(60) NOT NULL default '',
  dept_nr smallint(5) unsigned NOT NULL default '0',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY encounter_nr (encounter_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_event_signaller`
#

CREATE TABLE care_encounter_event_signaller (
  encounter_nr int(10) unsigned NOT NULL default '0',
  yellow tinyint(1) NOT NULL default '0',
  black tinyint(1) NOT NULL default '0',
  blue_pale tinyint(1) NOT NULL default '0',
  brown tinyint(1) NOT NULL default '0',
  pink tinyint(1) NOT NULL default '0',
  yellow_pale tinyint(1) NOT NULL default '0',
  red tinyint(1) NOT NULL default '0',
  green_pale tinyint(1) NOT NULL default '0',
  violet tinyint(1) NOT NULL default '0',
  blue tinyint(1) NOT NULL default '0',
  biege tinyint(1) NOT NULL default '0',
  orange tinyint(1) NOT NULL default '0',
  green_1 tinyint(1) NOT NULL default '0',
  green_2 tinyint(1) NOT NULL default '0',
  green_3 tinyint(1) NOT NULL default '0',
  green_4 tinyint(1) NOT NULL default '0',
  green_5 tinyint(1) NOT NULL default '0',
  green_6 tinyint(1) NOT NULL default '0',
  green_7 tinyint(1) NOT NULL default '0',
  rose_1 tinyint(1) NOT NULL default '0',
  rose_2 tinyint(1) NOT NULL default '0',
  rose_3 tinyint(1) NOT NULL default '0',
  rose_4 tinyint(1) NOT NULL default '0',
  rose_5 tinyint(1) NOT NULL default '0',
  rose_6 tinyint(1) NOT NULL default '0',
  rose_7 tinyint(1) NOT NULL default '0',
  rose_8 tinyint(1) NOT NULL default '0',
  rose_9 tinyint(1) NOT NULL default '0',
  rose_10 tinyint(1) NOT NULL default '0',
  rose_11 tinyint(1) NOT NULL default '0',
  rose_12 tinyint(1) NOT NULL default '0',
  rose_13 tinyint(1) NOT NULL default '0',
  rose_14 tinyint(1) NOT NULL default '0',
  rose_15 tinyint(1) NOT NULL default '0',
  rose_16 tinyint(1) NOT NULL default '0',
  rose_17 tinyint(1) NOT NULL default '0',
  rose_18 tinyint(1) NOT NULL default '0',
  rose_19 tinyint(1) NOT NULL default '0',
  rose_20 tinyint(1) NOT NULL default '0',
  rose_21 tinyint(1) NOT NULL default '0',
  rose_22 tinyint(1) NOT NULL default '0',
  rose_23 tinyint(1) NOT NULL default '0',
  rose_24 tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (encounter_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_financial_class`
#

CREATE TABLE care_encounter_financial_class (
  nr bigint(20) unsigned NOT NULL auto_increment,
  encounter_nr int(11) NOT NULL default '0',
  class_nr smallint(3) unsigned NOT NULL default '0',
  date_start date default NULL,
  date_end date default NULL,
  date_create datetime NOT NULL default '0000-00-00 00:00:00',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_image`
#

CREATE TABLE care_encounter_image (
  nr bigint(20) NOT NULL auto_increment,
  encounter_nr int(11) NOT NULL default '0',
  shot_date date NOT NULL default '0000-00-00',
  shot_nr smallint(6) NOT NULL default '0',
  mime_type varchar(10) NOT NULL default '',
  upload_date date NOT NULL default '0000-00-00',
  notes text NOT NULL,
  graphic_script text NOT NULL,
  _status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY encounter_nr (encounter_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_immunization`
#

CREATE TABLE care_encounter_immunization (
  nr int(10) unsigned NOT NULL auto_increment,
  encounter_nr int(11) NOT NULL default '0',
  date date NOT NULL default '0000-00-00',
  type varchar(60) NOT NULL default '',
  medicine varchar(60) NOT NULL default '',
  dosage varchar(60) default NULL,
  application_type_nr smallint(5) unsigned NOT NULL default '0',
  application_by varchar(60) default NULL,
  titer varchar(15) default NULL,
  refresh_date date default NULL,
  notes text,
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_inpatient`
#

CREATE TABLE care_encounter_inpatient (
  encounter_nr int(11) NOT NULL default '0',
  pathway_id varchar(25) NOT NULL default '',
  discharge_date_target date NOT NULL default '0000-00-00',
  discharge_date datetime NOT NULL default '0000-00-00 00:00:00',
  discharge_type varchar(35) NOT NULL default '',
  discharge_to_location varchar(255) NOT NULL default '',
  discharge_ward varchar(35) NOT NULL default '',
  discharge_dept varchar(35) NOT NULL default '',
  discharge_institution varchar(255) NOT NULL default '',
  discharge_dr varchar(60) NOT NULL default '',
  summary text NOT NULL,
  summary_responsible_attd_dr varchar(60) NOT NULL default '',
  summary_completed_date datetime NOT NULL default '0000-00-00 00:00:00',
  summary_checked_attd_dr varchar(60) NOT NULL default '',
  summary_checked_date datetime NOT NULL default '0000-00-00 00:00:00',
  summary_printed_date datetime NOT NULL default '0000-00-00 00:00:00',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (encounter_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_location`
#

CREATE TABLE care_encounter_location (
  nr int(11) NOT NULL auto_increment,
  encounter_nr int(11) unsigned NOT NULL default '0',
  type_nr smallint(5) unsigned NOT NULL default '0',
  location_nr smallint(5) unsigned NOT NULL default '0',
  group_nr smallint(5) unsigned NOT NULL default '0',
  date_from date NOT NULL default '0000-00-00',
  date_to date NOT NULL default '0000-00-00',
  time_from time default '00:00:00',
  time_to time default NULL,
  discharge_type_nr tinyint(3) unsigned NOT NULL default '0',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY type (type_nr),
  KEY location_id (location_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_measurement`
#

CREATE TABLE care_encounter_measurement (
  nr int(11) unsigned NOT NULL auto_increment,
  msr_date date NOT NULL default '0000-00-00',
  msr_time float(4,2) NOT NULL default '0.00',
  encounter_nr int(11) unsigned NOT NULL default '0',
  msr_type_nr tinyint(3) unsigned NOT NULL default '0',
  value varchar(255) default NULL,
  unit_nr smallint(5) unsigned default NULL,
  unit_type_nr tinyint(2) unsigned NOT NULL default '0',
  notes varchar(255) default NULL,
  measured_by varchar(35) NOT NULL default '',
  status varchar(25) default NULL,
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY type (msr_type_nr),
  KEY encounter_nr (encounter_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_notes`
#

CREATE TABLE care_encounter_notes (
  nr int(10) unsigned NOT NULL auto_increment,
  encounter_nr int(10) unsigned NOT NULL default '0',
  type_nr smallint(5) unsigned NOT NULL default '0',
  notes text NOT NULL,
  short_notes varchar(25) default NULL,
  aux_notes varchar(255) default NULL,
  ref_notes_nr int(10) unsigned default NULL,
  personell_nr int(10) unsigned NOT NULL default '0',
  personell_name varchar(60) NOT NULL default '',
  send_to_pid int(11) default NULL,
  send_to_name varchar(60) default NULL,
  date date default NULL,
  time time default NULL,
  location_type varchar(35) default NULL,
  location_nr mediumint(8) unsigned default NULL,
  location_id varchar(35) default NULL,
  ack_short_id varchar(10) NOT NULL default '',
  date_ack datetime default NULL,
  date_checked datetime default NULL,
  date_printed datetime default NULL,
  send_by_mail tinyint(1) default NULL,
  send_by_email tinyint(1) default NULL,
  send_by_fax tinyint(1) default NULL,
  status varchar(25) default NULL,
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY encounter_nr (encounter_nr),
  KEY type_nr (type_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_obstetric`
#

CREATE TABLE care_encounter_obstetric (
  encounter_nr int(11) unsigned NOT NULL auto_increment,
  pregnancy_nr int(11) unsigned NOT NULL default '0',
  hospital_adm_nr int(11) unsigned NOT NULL default '0',
  patient_class varchar(60) NOT NULL default '',
  is_discharged_not_in_labour tinyint(1) default NULL,
  is_re_admission tinyint(1) default NULL,
  referral_status varchar(60) default NULL,
  referral_reason text,
  status varchar(25) default NULL,
  history text,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (encounter_nr),
  KEY encounter_nr (pregnancy_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_op`
#

CREATE TABLE care_encounter_op (
  nr int(11) unsigned NOT NULL auto_increment,
  dept_nr smallint(6) unsigned NOT NULL default '0',
  op_room_nr tinyint(3) unsigned NOT NULL default '0',
  date date NOT NULL default '0000-00-00',
  encounter_nr int(11) unsigned NOT NULL default '0',
  anesthesia_type_nr tinyint(3) unsigned NOT NULL default '0',
  op_notes text,
  duty_type_nr tinyint(3) unsigned NOT NULL default '1',
  status varchar(35) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY dept (dept_nr),
  KEY op_room (op_room_nr),
  KEY date (date),
  KEY encounter_nr (encounter_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_op_instrument_box`
#

CREATE TABLE care_encounter_op_instrument_box (
  nr int(10) unsigned NOT NULL auto_increment,
  op_nr int(10) unsigned NOT NULL default '0',
  box_nr int(10) unsigned NOT NULL default '0',
  batch_nr int(10) unsigned NOT NULL default '0',
  notes text,
  status varchar(25) default NULL,
  history text,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY op_nr (op_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_op_material`
#

CREATE TABLE care_encounter_op_material (
  nr int(10) unsigned NOT NULL auto_increment,
  op_nr int(10) unsigned NOT NULL default '0',
  order_nr int(10) unsigned NOT NULL default '0',
  LOT_nr varchar(60) NOT NULL default '',
  notes text,
  status varchar(25) default NULL,
  history text,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY encounter_nr (op_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_op_roleperson`
#

CREATE TABLE care_encounter_op_roleperson (
  nr int(10) unsigned NOT NULL auto_increment,
  op_nr int(10) unsigned NOT NULL default '0',
  role_nr tinyint(3) unsigned NOT NULL default '0',
  time_from time NOT NULL default '00:00:00',
  time_to time NOT NULL default '00:00:00',
  notes text,
  status varchar(25) default NULL,
  history text,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY encounter_nr (op_nr,role_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_op_time`
#

CREATE TABLE care_encounter_op_time (
  nr int(10) unsigned NOT NULL auto_increment,
  op_nr int(10) unsigned NOT NULL default '0',
  time_type_nr tinyint(3) unsigned NOT NULL default '0',
  time_from time NOT NULL default '00:00:00',
  time_to time NOT NULL default '00:00:00',
  cause_type_nr smallint(5) unsigned NOT NULL default '0',
  notes text,
  status varchar(25) default NULL,
  history text,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY encounter_nr (op_nr,time_type_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_other_number`
#

CREATE TABLE care_encounter_other_number (
  encounter_nr int(11) NOT NULL default '0',
  other_nr varchar(30) NOT NULL default '',
  org varchar(35) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (encounter_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_outpatient`
#

CREATE TABLE care_encounter_outpatient (
  encounter_nr int(11) NOT NULL default '0',
  care_class tinyint(4) NOT NULL default '0',
  room_class tinyint(4) NOT NULL default '0',
  att_dr_class tinyint(4) NOT NULL default '0',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (encounter_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_prescription`
#

CREATE TABLE care_encounter_prescription (
  nr int(11) NOT NULL auto_increment,
  encounter_nr int(10) unsigned NOT NULL default '0',
  prescription_type_nr smallint(5) unsigned NOT NULL default '0',
  article varchar(100) NOT NULL default '',
  drug_class varchar(60) NOT NULL default '',
  order_nr int(11) NOT NULL default '0',
  dosage varchar(255) NOT NULL default '',
  application_type_nr smallint(5) unsigned default '0',
  notes text NOT NULL,
  prescribe_date date default NULL,
  prescriber varchar(60) NOT NULL default '',
  color_marker varchar(10) NOT NULL default '',
  is_stopped tinyint(1) unsigned NOT NULL default '0',
  stop_date date default NULL,
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY encounter_nr (encounter_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_prescription_notes`
#

CREATE TABLE care_encounter_prescription_notes (
  nr bigint(20) unsigned NOT NULL auto_increment,
  date date NOT NULL default '0000-00-00',
  prescription_nr int(10) unsigned NOT NULL default '0',
  notes varchar(35) default NULL,
  short_notes varchar(25) default NULL,
  status varchar(25) default NULL,
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_procedure`
#

CREATE TABLE care_encounter_procedure (
  procedure_nr int(11) NOT NULL auto_increment,
  encounter_nr int(11) NOT NULL default '0',
  op_nr int(11) NOT NULL default '0',
  date datetime NOT NULL default '0000-00-00 00:00:00',
  code varchar(25) NOT NULL default '',
  code_parent varchar(25) NOT NULL default '',
  group_nr mediumint(8) unsigned NOT NULL default '0',
  code_version tinyint(4) NOT NULL default '0',
  localcode varchar(35) NOT NULL default '',
  category_nr tinyint(3) unsigned NOT NULL default '0',
  localization varchar(35) NOT NULL default '',
  responsible_clinician varchar(60) NOT NULL default '',
  responsible_dept_nr smallint(5) unsigned NOT NULL default '0',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (procedure_nr),
  KEY encounter_nr (encounter_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_roleperson`
#

CREATE TABLE care_encounter_roleperson (
  nr int(10) unsigned NOT NULL auto_increment,
  encounter_nr int(10) unsigned NOT NULL default '0',
  type varchar(35) NOT NULL default '',
  personell_nr int(10) unsigned NOT NULL default '0',
  pid int(10) unsigned NOT NULL default '0',
  date_from date NOT NULL default '0000-00-00',
  date_to date NOT NULL default '0000-00-00',
  notes text NOT NULL,
  status varchar(25) default NULL,
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY encounter_nr (encounter_nr,type)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_sickconfirm`
#

CREATE TABLE care_encounter_sickconfirm (
  nr int(11) NOT NULL auto_increment,
  encounter_nr int(11) NOT NULL default '0',
  date_confirm date NOT NULL default '0000-00-00',
  date_start date NOT NULL default '0000-00-00',
  date_end date NOT NULL default '0000-00-00',
  date_create date NOT NULL default '0000-00-00',
  diagnosis text NOT NULL,
  dept_nr smallint(6) NOT NULL default '0',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY encounter_nr (encounter_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_test`
#

CREATE TABLE care_encounter_test (
  test_nr int(11) unsigned NOT NULL default '0',
  type varchar(35) NOT NULL default '',
  encounter_nr int(11) unsigned NOT NULL default '0',
  diagnosis_nr int(11) unsigned NOT NULL default '0',
  procedure_nr int(10) unsigned NOT NULL default '0',
  result_script_call varchar(255) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (test_nr),
  KEY encounter_nr (encounter_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_encounter_transplant_donor`
#

CREATE TABLE care_encounter_transplant_donor (
  nr int(10) unsigned NOT NULL default '0',
  encounter_nr int(10) unsigned NOT NULL default '0',
  donor_pid int(10) unsigned NOT NULL default '0',
  is_related int(1) NOT NULL default '0',
  relation varchar(60) default NULL,
  donor_nat_id varchar(255) default NULL,
  status varchar(25) default NULL,
  history text,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (encounter_nr),
  KEY nr (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_group`
#

CREATE TABLE care_group (
  nr smallint(5) unsigned NOT NULL auto_increment,
  id varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_icd10_de`
#

CREATE TABLE care_icd10_de (
  diagnosis_code varchar(12) NOT NULL default '',
  description text NOT NULL,
  class_sub varchar(5) NOT NULL default '',
  type varchar(10) NOT NULL default '',
  inclusive text NOT NULL,
  exclusive text NOT NULL,
  notes text NOT NULL,
  std_code char(1) NOT NULL default '',
  sub_level tinyint(4) NOT NULL default '0',
  remarks text NOT NULL,
  extra_codes text NOT NULL,
  extra_subclass text NOT NULL,
  KEY diagnosis_code (diagnosis_code)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_icd10_en`
#

CREATE TABLE care_icd10_en (
  diagnosis_code varchar(12) NOT NULL default '',
  description text NOT NULL,
  class_sub varchar(5) NOT NULL default '',
  type varchar(10) NOT NULL default '',
  inclusive text NOT NULL,
  exclusive text NOT NULL,
  notes text NOT NULL,
  std_code char(1) NOT NULL default '',
  sub_level tinyint(4) NOT NULL default '0',
  remarks text NOT NULL,
  extra_codes text NOT NULL,
  extra_subclass text NOT NULL,
  KEY diagnosis_code (diagnosis_code)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_insurance_firm`
#

CREATE TABLE care_insurance_firm (
  firm_id varchar(40) NOT NULL default '',
  name varchar(60) NOT NULL default '',
  iso_country_id char(3) NOT NULL default '',
  sub_area varchar(60) NOT NULL default '',
  type_nr smallint(5) unsigned NOT NULL default '0',
  addr varchar(255) default NULL,
  addr_mail varchar(200) default NULL,
  addr_billing varchar(200) default NULL,
  addr_email varchar(60) default NULL,
  phone_main varchar(35) default NULL,
  phone_aux varchar(35) default NULL,
  fax_main varchar(35) default NULL,
  fax_aux varchar(35) default NULL,
  contact_person varchar(60) default NULL,
  contact_phone varchar(35) default NULL,
  contact_fax varchar(35) default NULL,
  contact_email varchar(60) default NULL,
  use_frequency bigint(20) unsigned NOT NULL default '0',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (firm_id),
  KEY name (name)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_lab_test_data`
#

CREATE TABLE care_lab_test_data (
  batch_nr int(11) NOT NULL auto_increment,
  patnum varchar(10) NOT NULL default '',
  lastname varchar(40) NOT NULL default '',
  firstname varchar(40) NOT NULL default '',
  bday date NOT NULL default '0000-00-00',
  test_date date NOT NULL default '0000-00-00',
  test_time time NOT NULL default '00:00:00',
  test_sortdate varchar(8) NOT NULL default '',
  job_id varchar(10) NOT NULL default '',
  dr_name varchar(30) NOT NULL default '',
  dr_tstamp varchar(16) NOT NULL default '',
  life_risk tinyint(4) NOT NULL default '0',
  rarity tinytext NOT NULL,
  specials tinytext NOT NULL,
  clinical_info tinytext NOT NULL,
  TOP_Parameter text NOT NULL,
  Klinische_Chemie text NOT NULL,
  Liquor text NOT NULL,
  Gerinnung text NOT NULL,
  H�matologie text NOT NULL,
  Blutzucker text NOT NULL,
  S�ugling text NOT NULL,
  Proteine text NOT NULL,
  Schilddr�se text NOT NULL,
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
  Rarit�ten text NOT NULL,
  Urin_Spontanurin text NOT NULL,
  Sammelurin text NOT NULL,
  Sonstiges text NOT NULL,
  encoding text NOT NULL,
  tid timestamp(14) NOT NULL,
  validator varchar(15) NOT NULL default '',
  valid_tstamp varchar(16) NOT NULL default '',
  status varchar(20) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (batch_nr),
  KEY batch_nr (batch_nr),
  KEY patnum (patnum)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_lookup_citytown_region`
#

CREATE TABLE care_lookup_citytown_region (
  nr int(10) unsigned NOT NULL auto_increment,
  citytown_nr int(10) unsigned NOT NULL default '0',
  region_nr smallint(5) unsigned NOT NULL default '0',
  status varchar(25) default NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY type (citytown_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_lookup_color_event`
#

CREATE TABLE care_lookup_color_event (
  event_type_nr mediumint(8) unsigned NOT NULL default '0',
  color_id varchar(25) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  PRIMARY KEY  (event_type_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_lookup_ward_dept`
#

CREATE TABLE care_lookup_ward_dept (
  ward_nr int(10) unsigned NOT NULL default '0',
  dept_nr int(10) unsigned NOT NULL default '0',
  is_parent_dept tinyint(1) NOT NULL default '0',
  status varchar(25) default NULL,
  history text,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  KEY ward_id (ward_nr),
  KEY dept_id (dept_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_lookup_zip_locode`
#

CREATE TABLE care_lookup_zip_locode (
  nr int(10) unsigned NOT NULL auto_increment,
  zip varchar(35) NOT NULL default '',
  locode_nr mediumint(8) unsigned NOT NULL default '0',
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY type (zip)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_mail_list`
#

CREATE TABLE care_mail_list (
  address tinytext NOT NULL,
  s_date varchar(10) NOT NULL default '',
  s_time varchar(6) NOT NULL default '',
  send_status tinyint(1) NOT NULL default '1',
  rec_status tinyint(1) NOT NULL default '1',
  ip tinytext NOT NULL
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_mail_private`
#

CREATE TABLE care_mail_private (
  recipient tinytext NOT NULL,
  sender tinytext NOT NULL,
  sender_ip tinytext NOT NULL,
  cc tinytext NOT NULL,
  bcc tinytext NOT NULL,
  subject tinytext NOT NULL,
  body text NOT NULL,
  sign tinytext NOT NULL,
  ask4ack tinyint(4) NOT NULL default '0',
  reply2 tinytext NOT NULL,
  attachment tinytext NOT NULL,
  attach_type tinytext NOT NULL,
  read_flag tinyint(4) NOT NULL default '0',
  mailgroup tinytext NOT NULL,
  maildir tinytext NOT NULL,
  exec_level tinyint(4) NOT NULL default '0',
  exclude_addr text NOT NULL,
  send_dt tinytext NOT NULL,
  send_stamp timestamp(14) NOT NULL,
  uid tinytext NOT NULL
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_mail_private_users`
#

CREATE TABLE care_mail_private_users (
  user_name tinytext NOT NULL,
  email tinytext NOT NULL,
  alias tinytext NOT NULL,
  pw tinytext NOT NULL,
  inbox longtext NOT NULL,
  sent longtext NOT NULL,
  drafts longtext NOT NULL,
  trash longtext NOT NULL,
  lastcheck timestamp(14) NOT NULL,
  lock_flag tinyint(4) NOT NULL default '0',
  addr_book text NOT NULL,
  addr_quick tinytext NOT NULL,
  secret_q tinytext NOT NULL,
  secret_q_ans tinytext NOT NULL,
  public tinyint(4) NOT NULL default '0',
  sig tinytext NOT NULL,
  append_sig tinyint(4) NOT NULL default '0'
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_med_ordercatalog`
#

CREATE TABLE care_med_ordercatalog (
  item_no int(11) NOT NULL auto_increment,
  dept varchar(20) NOT NULL default '',
  hit int(11) NOT NULL default '0',
  artikelname tinytext NOT NULL,
  bestellnum varchar(20) NOT NULL default '',
  minorder int(4) NOT NULL default '0',
  maxorder int(4) NOT NULL default '0',
  proorder tinytext NOT NULL,
  KEY item_no (item_no),
  KEY dept (dept)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_med_orderlist`
#

CREATE TABLE care_med_orderlist (
  order_nr int(11) NOT NULL auto_increment,
  dept varchar(20) NOT NULL default '',
  order_date date NOT NULL default '0000-00-00',
  order_time time NOT NULL default '00:00:00',
  articles text NOT NULL,
  extra1 tinytext NOT NULL,
  extra2 text NOT NULL,
  validator tinytext NOT NULL,
  ip_addr tinytext NOT NULL,
  priority tinytext NOT NULL,
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  sent_datetime datetime NOT NULL default '0000-00-00 00:00:00',
  process_datetime datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (order_nr),
  KEY item_nr (order_nr),
  KEY dept (dept)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_med_products_main`
#

CREATE TABLE care_med_products_main (
  bestellnum varchar(25) NOT NULL default '',
  artikelnum tinytext NOT NULL,
  industrynum tinytext NOT NULL,
  artikelname tinytext NOT NULL,
  generic tinytext NOT NULL,
  description text NOT NULL,
  packing tinytext NOT NULL,
  minorder int(4) NOT NULL default '0',
  maxorder int(4) NOT NULL default '0',
  proorder tinytext NOT NULL,
  picfile tinytext NOT NULL,
  encoder tinytext NOT NULL,
  enc_date tinytext NOT NULL,
  enc_time tinytext NOT NULL,
  lock_flag tinyint(1) NOT NULL default '0',
  medgroup text NOT NULL,
  cave tinytext NOT NULL,
  status varchar(20) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (bestellnum),
  KEY bestellnum (bestellnum)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_med_report`
#

CREATE TABLE care_med_report (
  report_nr int(11) NOT NULL auto_increment,
  dept varchar(15) NOT NULL default '',
  report text NOT NULL,
  reporter varchar(25) NOT NULL default '',
  id_nr varchar(15) NOT NULL default '',
  report_date date NOT NULL default '0000-00-00',
  report_time time NOT NULL default '00:00:00',
  status varchar(20) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (report_nr),
  KEY report_nr (report_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_medocs`
#

CREATE TABLE care_medocs (
  doc_no int(10) unsigned NOT NULL auto_increment,
  dept varchar(15) NOT NULL default '0',
  enc_date datetime NOT NULL default '0000-00-00 00:00:00',
  patient_no int(11) NOT NULL default '0',
  lastname varchar(35) NOT NULL default '',
  firstname varchar(35) NOT NULL default '',
  birthdate date NOT NULL default '0000-00-00',
  sex char(1) NOT NULL default '',
  address tinytext NOT NULL,
  insurance tinytext NOT NULL,
  insurance_xtra tinytext NOT NULL,
  informed tinyint(4) NOT NULL default '0',
  diagnosis_1 text NOT NULL,
  therapy_1 text NOT NULL,
  diagnosis_2 text NOT NULL,
  therapy_2 text NOT NULL,
  diagnosis_3 text NOT NULL,
  therapy_3 text NOT NULL,
  keynumber tinytext NOT NULL,
  modify_time timestamp(14) NOT NULL,
  modify_id varchar(30) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  create_id varchar(30) NOT NULL default '',
  status varchar(10) NOT NULL default '0',
  KEY patient_no (patient_no),
  KEY lastname (lastname),
  KEY doc_no (doc_no)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_menu_main`
#

CREATE TABLE care_menu_main (
  nr tinyint(3) unsigned NOT NULL auto_increment,
  sort_nr tinyint(2) NOT NULL default '0',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  url varchar(255) NOT NULL default '',
  is_visible tinyint(1) unsigned NOT NULL default '1',
  hide_by text,
  status varchar(25) default NULL,
  modify_id timestamp(14) NOT NULL,
  modify_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_method_induction`
#

CREATE TABLE care_method_induction (
  method_nr smallint(5) unsigned NOT NULL auto_increment,
  group_nr tinyint(3) unsigned NOT NULL default '0',
  method varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (method_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_mode_delivery`
#

CREATE TABLE care_mode_delivery (
  nr smallint(5) unsigned NOT NULL auto_increment,
  group_nr tinyint(3) unsigned NOT NULL default '0',
  mode varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  description varchar(255) default NULL,
  status varchar(25) default NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_neonatal`
#

CREATE TABLE care_neonatal (
  nr int(11) unsigned NOT NULL auto_increment,
  pid int(11) unsigned NOT NULL default '0',
  pregnancy_nr int(11) unsigned NOT NULL default '0',
  encounter_nr int(11) unsigned NOT NULL default '0',
  delivery_place varchar(60) NOT NULL default '',
  delivery_mode varchar(60) NOT NULL default '',
  c_s_reason text,
  born_before_arrival tinyint(1) default '0',
  face_presentation tinyint(1) default '0',
  posterio_occipital_position tinyint(1) NOT NULL default '0',
  delivery_rank tinyint(2) unsigned NOT NULL default '1',
  apgar_1_min tinyint(4) NOT NULL default '0',
  apgar_5_min tinyint(4) NOT NULL default '0',
  apgar_10_min tinyint(4) NOT NULL default '0',
  condition varchar(10) default '0',
  weight tinyint(4) unsigned default '0',
  length smallint(5) unsigned default '0',
  head_circumference smallint(5) unsigned default '0',
  scored_gestational_age tinyint(2) unsigned default '0',
  feeding varchar(35) default '0',
  congenital_abnormality tinyint(1) NOT NULL default '0',
  classification tinyint(4) NOT NULL default '0',
  disease_category varchar(60) default '0',
  outcome varchar(60) default NULL,
  status varchar(25) default NULL,
  history text,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY pid (pid),
  KEY pregnancy_nr (pregnancy_nr),
  KEY encounter_nr (encounter_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_news_article`
#

CREATE TABLE care_news_article (
  nr int(11) NOT NULL auto_increment,
  lang varchar(10) NOT NULL default 'en',
  dept_nr smallint(5) unsigned NOT NULL default '0',
  category tinytext NOT NULL,
  status varchar(10) NOT NULL default 'pending',
  title varchar(255) NOT NULL default '',
  preface varchar(255) NOT NULL default '',
  body text NOT NULL,
  pic blob,
  pic_mime varchar(4) default NULL,
  art_num tinyint(1) NOT NULL default '0',
  head_file tinytext NOT NULL,
  main_file tinytext NOT NULL,
  pic_file tinytext NOT NULL,
  author varchar(30) NOT NULL default '',
  submit_date datetime NOT NULL default '0000-00-00 00:00:00',
  encode_date datetime NOT NULL default '0000-00-00 00:00:00',
  publish_date date NOT NULL default '0000-00-00',
  modify_id varchar(30) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(30) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  UNIQUE KEY item_no_2 (nr),
  KEY item_no (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_nursing_op_logbook`
#

CREATE TABLE care_nursing_op_logbook (
  nr int(11) NOT NULL auto_increment,
  year varchar(4) NOT NULL default '0',
  dept_nr smallint(5) unsigned NOT NULL default '0',
  op_room varchar(10) NOT NULL default '0',
  op_nr mediumint(9) NOT NULL default '0',
  op_date date NOT NULL default '0000-00-00',
  op_src_date varchar(8) NOT NULL default '',
  encounter_nr int(10) unsigned NOT NULL default '0',
  diagnosis text NOT NULL,
  operator text NOT NULL,
  assistant text NOT NULL,
  scrub_nurse text NOT NULL,
  rotating_nurse text NOT NULL,
  anesthesia varchar(30) NOT NULL default '',
  an_doctor text NOT NULL,
  op_therapy text NOT NULL,
  result_info text NOT NULL,
  entry_time varchar(5) NOT NULL default '',
  cut_time varchar(5) NOT NULL default '',
  close_time varchar(5) NOT NULL default '',
  exit_time varchar(5) NOT NULL default '',
  entry_out text NOT NULL,
  cut_close text NOT NULL,
  wait_time text NOT NULL,
  bandage_time text NOT NULL,
  repos_time text NOT NULL,
  encoding longtext NOT NULL,
  doc_date varchar(10) NOT NULL default '',
  doc_time varchar(5) NOT NULL default '',
  duty_type varchar(15) NOT NULL default '',
  material_codedlist text NOT NULL,
  container_codedlist text NOT NULL,
  icd_code text NOT NULL,
  ops_code text NOT NULL,
  ops_intern_code text NOT NULL,
  STATUS varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY dept (dept_nr),
  KEY op_room (op_room),
  KEY op_date (op_date)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_op_med_doc`
#

CREATE TABLE care_op_med_doc (
  nr bigint(20) unsigned NOT NULL auto_increment,
  op_date varchar(12) NOT NULL default '',
  operator tinytext NOT NULL,
  encounter_nr int(11) unsigned NOT NULL default '0',
  dept_nr smallint(5) unsigned NOT NULL default '0',
  diagnosis text NOT NULL,
  localize text NOT NULL,
  therapy text NOT NULL,
  special text NOT NULL,
  class_s tinyint(4) NOT NULL default '0',
  class_m tinyint(4) NOT NULL default '0',
  class_l tinyint(4) NOT NULL default '0',
  op_start varchar(8) NOT NULL default '',
  op_end varchar(8) NOT NULL default '',
  scrub_nurse varchar(70) NOT NULL default '',
  op_room varchar(10) NOT NULL default '',
  status varchar(15) default NULL,
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY encounter_nr (encounter_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_ops301_de`
#

CREATE TABLE care_ops301_de (
  code varchar(12) NOT NULL default '',
  description text NOT NULL,
  inclusive text NOT NULL,
  exclusive text NOT NULL,
  notes text NOT NULL,
  std_code char(1) NOT NULL default '',
  sub_level tinyint(4) NOT NULL default '0',
  remarks text NOT NULL,
  KEY code (code)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_person`
#

CREATE TABLE care_person (
  pid int(11) unsigned NOT NULL auto_increment,
  date_reg datetime NOT NULL default '0000-00-00 00:00:00',
  name_first varchar(60) NOT NULL default '',
  name_2 varchar(60) default NULL,
  name_3 varchar(60) default NULL,
  name_middle varchar(60) default NULL,
  name_last varchar(60) NOT NULL default '',
  name_maiden varchar(60) default NULL,
  name_others text NOT NULL,
  date_birth date NOT NULL default '0000-00-00',
  addr_str varchar(60) NOT NULL default '',
  addr_str_nr varchar(10) NOT NULL default '',
  addr_zip varchar(15) NOT NULL default '',
  addr_citytown_nr mediumint(8) unsigned NOT NULL default '0',
  addr_is_valid tinyint(1) NOT NULL default '0',
  citizenship varchar(35) default NULL,
  phone_1_code varchar(15) default '0',
  phone_1_nr varchar(35) default NULL,
  phone_2_code varchar(15) default '0',
  phone_2_nr varchar(35) default NULL,
  cellphone_1_nr varchar(35) default NULL,
  cellphone_2_nr varchar(35) default NULL,
  fax varchar(35) default NULL,
  email varchar(60) default NULL,
  civil_status varchar(35) NOT NULL default '',
  sex char(1) NOT NULL default '',
  title varchar(25) default NULL,
  photo blob,
  photo_filename varchar(60) default NULL,
  ethnic_orig mediumint(8) unsigned default '0',
  org_id varchar(60) default NULL,
  sss_nr varchar(60) default NULL,
  nat_id_nr varchar(60) default NULL,
  religion varchar(125) default NULL,
  mother_pid int(11) unsigned default '0',
  father_pid int(11) unsigned default '0',
  contact_person varchar(255) default NULL,
  contact_pid int(11) default '0',
  contact_relation varchar(25) default '0',
  death_date date default NULL,
  death_encounter_nr int(10) unsigned default NULL,
  death_cause varchar(255) default NULL,
  death_cause_code varchar(15) default NULL,
  date_update datetime default NULL,
  status varchar(20) default NULL,
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (pid),
  KEY name_last (name_last),
  KEY name_first (name_first),
  KEY date_reg (date_reg),
  KEY date_birth (date_birth)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_person_death`
#

CREATE TABLE care_person_death (
  nr int(10) unsigned NOT NULL auto_increment,
  pid int(10) unsigned default '0',
  encounter_nr int(10) unsigned default '0',
  death_date date NOT NULL default '0000-00-00',
  cause_text varchar(255) default NULL,
  cause_code varchar(25) default NULL,
  cause_is_primary tinyint(1) NOT NULL default '0',
  status varchar(25) default NULL,
  history text,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_person_insurance`
#

CREATE TABLE care_person_insurance (
  item_nr int(10) unsigned NOT NULL auto_increment,
  pid int(10) unsigned NOT NULL default '0',
  type varchar(60) NOT NULL default '',
  insurance_nr varchar(50) NOT NULL default '0',
  firm_id varchar(60) NOT NULL default '',
  class_nr tinyint(2) unsigned NOT NULL default '0',
  is_void tinyint(1) unsigned NOT NULL default '0',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (item_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_person_other_number`
#

CREATE TABLE care_person_other_number (
  nr int(10) unsigned NOT NULL auto_increment,
  pid int(11) unsigned NOT NULL default '0',
  other_nr varchar(30) NOT NULL default '',
  org varchar(35) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  UNIQUE KEY other_nr_2 (other_nr),
  KEY pid (pid),
  KEY other_nr (other_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_personell`
#

CREATE TABLE care_personell (
  nr int(11) NOT NULL auto_increment,
  short_id varchar(10) default NULL,
  pid int(11) NOT NULL default '0',
  job_type_nr int(11) NOT NULL default '0',
  job_function_title varchar(60) default NULL,
  date_join date default NULL,
  date_exit date default NULL,
  contract_class varchar(35) NOT NULL default '0',
  contract_start date default NULL,
  contract_end date default NULL,
  is_discharged tinyint(1) NOT NULL default '0',
  pay_class varchar(25) NOT NULL default '',
  pay_class_sub varchar(25) NOT NULL default '',
  local_premium_id varchar(5) NOT NULL default '',
  tax_account_nr varchar(60) NOT NULL default '',
  ir_code varchar(25) NOT NULL default '',
  nr_workday tinyint(1) NOT NULL default '0',
  nr_weekhour float(10,2) NOT NULL default '0.00',
  nr_vacation_day tinyint(2) NOT NULL default '0',
  multiple_employer tinyint(1) NOT NULL default '0',
  nr_dependent tinyint(2) unsigned NOT NULL default '0',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY pid (pid)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_personell_assignment`
#

CREATE TABLE care_personell_assignment (
  nr int(10) unsigned NOT NULL auto_increment,
  personell_nr int(11) unsigned NOT NULL default '0',
  role_nr smallint(5) unsigned NOT NULL default '0',
  location_type_nr smallint(5) unsigned NOT NULL default '0',
  location_nr smallint(5) unsigned NOT NULL default '0',
  date_start date NOT NULL default '0000-00-00',
  date_end date NOT NULL default '0000-00-00',
  is_temporary tinyint(1) unsigned default NULL,
  list_frequency int(11) unsigned NOT NULL default '0',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY personell_nr (personell_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_pharma_ordercatalog`
#

CREATE TABLE care_pharma_ordercatalog (
  item_no int(11) NOT NULL auto_increment,
  dept varchar(20) NOT NULL default '',
  hit int(11) NOT NULL default '0',
  artikelname tinytext NOT NULL,
  bestellnum varchar(20) NOT NULL default '',
  minorder int(4) NOT NULL default '0',
  maxorder int(4) NOT NULL default '0',
  proorder tinytext NOT NULL,
  KEY item_no (item_no),
  KEY dept (dept)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_pharma_orderlist`
#

CREATE TABLE care_pharma_orderlist (
  order_nr int(11) NOT NULL auto_increment,
  dept varchar(20) NOT NULL default '',
  order_date date NOT NULL default '0000-00-00',
  order_time time NOT NULL default '00:00:00',
  articles text NOT NULL,
  extra1 tinytext NOT NULL,
  extra2 text NOT NULL,
  validator tinytext NOT NULL,
  ip_addr tinytext NOT NULL,
  priority tinytext NOT NULL,
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  sent_datetime datetime NOT NULL default '0000-00-00 00:00:00',
  process_datetime datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (order_nr),
  KEY item_nr (order_nr),
  KEY dept (dept)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_pharma_products_main`
#

CREATE TABLE care_pharma_products_main (
  bestellnum varchar(25) NOT NULL default '',
  artikelnum tinytext NOT NULL,
  industrynum tinytext NOT NULL,
  artikelname tinytext NOT NULL,
  generic tinytext NOT NULL,
  description text NOT NULL,
  packing tinytext NOT NULL,
  minorder int(4) NOT NULL default '0',
  maxorder int(4) NOT NULL default '0',
  proorder tinytext NOT NULL,
  picfile tinytext NOT NULL,
  encoder tinytext NOT NULL,
  enc_date tinytext NOT NULL,
  enc_time tinytext NOT NULL,
  lock_flag tinyint(1) NOT NULL default '0',
  medgroup text NOT NULL,
  cave tinytext NOT NULL,
  status varchar(20) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (bestellnum),
  KEY bestellnum (bestellnum)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_phone`
#

CREATE TABLE care_phone (
  item_nr bigint(20) unsigned NOT NULL auto_increment,
  title varchar(35) default NULL,
  name varchar(45) NOT NULL default '',
  vorname varchar(45) NOT NULL default '',
  pid int(11) unsigned NOT NULL default '0',
  personell_nr int(10) unsigned default NULL,
  dept_nr mediumint(8) unsigned default NULL,
  beruf tinytext,
  bereich1 tinytext,
  bereich2 tinytext,
  inphone1 tinytext,
  inphone2 tinytext,
  inphone3 tinytext,
  exphone1 tinytext,
  exphone2 tinytext,
  funk1 tinytext,
  funk2 tinytext,
  roomnr tinytext,
  date date NOT NULL default '0000-00-00',
  time time NOT NULL default '00:00:00',
  status varchar(15) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (item_nr,item_nr),
  KEY name (name),
  KEY vorname (vorname)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_pregnancy`
#

CREATE TABLE care_pregnancy (
  nr int(10) unsigned NOT NULL default '0',
  pid int(11) unsigned NOT NULL default '0',
  self_pregnancy_nr int(11) unsigned NOT NULL default '0',
  delivery_date date NOT NULL default '0000-00-00',
  delivery_time time NOT NULL default '00:00:00',
  grav tinyint(2) unsigned default NULL,
  para tinyint(2) unsigned default NULL,
  pregnancy_gestational_age tinyint(2) unsigned default NULL,
  number_of_fetuses tinyint(2) unsigned default NULL,
  is_booked tinyint(1) default NULL,
  vdrl char(1) default NULL,
  rh tinyint(1) default NULL,
  delivery_class varchar(35) default NULL,
  delivery_type varchar(35) default NULL,
  delivery_by varchar(60) default NULL,
  bp_systolic_high smallint(4) unsigned default NULL,
  bp_diastolic_high smallint(4) unsigned default NULL,
  proteinuria varchar(60) default NULL,
  labour_duration smallint(3) unsigned default NULL,
  induction_method varchar(60) default NULL,
  induction_indication varchar(255) default NULL,
  is_epidural char(1) default NULL,
  complications varchar(100) default NULL,
  perineum varchar(60) default NULL,
  blood_loss mediumint(8) unsigned default NULL,
  blood_loss_unit varchar(10) NOT NULL default 'ml',
  is_retained_placenta char(1) default NULL,
  post_labour_condition varchar(35) default NULL,
  outcome varchar(35) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY pid (pid)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_pregnancy_complication`
#

CREATE TABLE care_pregnancy_complication (
  nr int(10) unsigned NOT NULL auto_increment,
  pregnancy_nr int(11) unsigned NOT NULL default '0',
  complication_nr int(10) unsigned default NULL,
  code varchar(25) default NULL,
  date_from date NOT NULL default '0000-00-00',
  date_to date NOT NULL default '0000-00-00',
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_registry`
#

CREATE TABLE care_registry (
  registry_id varchar(35) NOT NULL default '',
  module_start_script varchar(60) NOT NULL default '',
  news_start_script varchar(60) NOT NULL default '',
  news_editor_script varchar(255) NOT NULL default '',
  news_reader_script varchar(255) NOT NULL default '',
  passcheck_script varchar(255) NOT NULL default '',
  composite text NOT NULL,
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (registry_id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_role_person`
#

CREATE TABLE care_role_person (
  nr smallint(5) unsigned NOT NULL auto_increment,
  group_nr tinyint(3) unsigned NOT NULL default '0',
  role varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  status varchar(25) default NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_room`
#

CREATE TABLE care_room (
  nr tinyint(3) unsigned NOT NULL auto_increment,
  type_nr tinyint(3) unsigned NOT NULL default '0',
  date_create date NOT NULL default '0000-00-00',
  date_close date NOT NULL default '0000-00-00',
  is_temp_closed tinyint(1) default '0',
  room_nr smallint(5) unsigned NOT NULL default '0',
  ward_nr smallint(5) unsigned NOT NULL default '0',
  dept_nr smallint(5) unsigned NOT NULL default '0',
  nr_of_beds tinyint(3) unsigned NOT NULL default '1',
  closed_beds varchar(255) NOT NULL default '',
  info varchar(60) default NULL,
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY room_nr (room_nr),
  KEY ward_nr (ward_nr),
  KEY dept_nr (dept_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_sessions`
#

CREATE TABLE care_sessions (
  SESSKEY varchar(32) NOT NULL default '',
  EXPIRY int(11) unsigned NOT NULL default '0',
  DATA text NOT NULL,
  PRIMARY KEY  (SESSKEY),
  KEY EXPIRY (EXPIRY)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_standby_duty_report`
#

CREATE TABLE care_standby_duty_report (
  report_nr int(11) NOT NULL auto_increment,
  dept varchar(15) NOT NULL default '',
  date date NOT NULL default '0000-00-00',
  standby_name varchar(35) NOT NULL default '',
  standby_start time NOT NULL default '00:00:00',
  standby_end time NOT NULL default '00:00:00',
  oncall_name varchar(35) NOT NULL default '',
  oncall_start time NOT NULL default '00:00:00',
  oncall_end time NOT NULL default '00:00:00',
  op_room char(2) NOT NULL default '',
  diagnosis_therapy text NOT NULL,
  encoding text NOT NULL,
  status varchar(20) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (report_nr),
  KEY report_nr (report_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_steri_products_main`
#

CREATE TABLE care_steri_products_main (
  bestellnum int(15) unsigned NOT NULL default '0',
  containernum varchar(15) NOT NULL default '',
  industrynum tinytext NOT NULL,
  containername varchar(40) NOT NULL default '',
  description text NOT NULL,
  packing tinytext NOT NULL,
  minorder int(4) unsigned NOT NULL default '0',
  maxorder int(4) unsigned NOT NULL default '0',
  proorder tinytext NOT NULL,
  picfile tinytext NOT NULL,
  encoder tinytext NOT NULL,
  enc_date tinytext NOT NULL,
  enc_time tinytext NOT NULL,
  lock_flag tinyint(1) NOT NULL default '0',
  medgroup text NOT NULL,
  cave tinytext NOT NULL
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_tech_questions`
#

CREATE TABLE care_tech_questions (
  batch_nr int(11) NOT NULL auto_increment,
  dept varchar(15) NOT NULL default '',
  query text NOT NULL,
  inquirer varchar(25) NOT NULL default '',
  tphone varchar(30) NOT NULL default '',
  tdate date NOT NULL default '0000-00-00',
  ttime time NOT NULL default '00:00:00',
  tid timestamp(14) NOT NULL,
  reply text NOT NULL,
  answered tinyint(1) NOT NULL default '0',
  ansby varchar(25) NOT NULL default '',
  astamp varchar(16) NOT NULL default '',
  archive tinyint(1) NOT NULL default '0',
  status varchar(15) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (batch_nr),
  KEY batch_nr (batch_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_tech_repair_done`
#

CREATE TABLE care_tech_repair_done (
  batch_nr int(11) NOT NULL auto_increment,
  dept varchar(15) default NULL,
  dept_nr tinyint(3) unsigned NOT NULL default '0',
  job_id varchar(15) NOT NULL default '0',
  job text NOT NULL,
  reporter varchar(25) NOT NULL default '',
  id varchar(15) NOT NULL default '',
  tdate date NOT NULL default '0000-00-00',
  ttime time NOT NULL default '00:00:00',
  tid timestamp(14) NOT NULL,
  seen tinyint(1) NOT NULL default '0',
  d_idx varchar(8) NOT NULL default '',
  status varchar(15) default NULL,
  history text,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (batch_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_tech_repair_job`
#

CREATE TABLE care_tech_repair_job (
  batch_nr tinyint(4) NOT NULL auto_increment,
  dept varchar(15) NOT NULL default '',
  job text NOT NULL,
  reporter varchar(25) NOT NULL default '',
  id varchar(15) NOT NULL default '',
  tphone varchar(30) NOT NULL default '',
  tdate date NOT NULL default '0000-00-00',
  ttime time NOT NULL default '00:00:00',
  tid timestamp(14) NOT NULL,
  done tinyint(1) NOT NULL default '0',
  seen tinyint(1) NOT NULL default '0',
  seenby varchar(25) NOT NULL default '',
  sstamp varchar(16) NOT NULL default '',
  doneby varchar(25) NOT NULL default '',
  dstamp varchar(16) NOT NULL default '',
  d_idx varchar(8) NOT NULL default '',
  archive tinyint(1) NOT NULL default '0',
  status varchar(20) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (batch_nr),
  KEY batch_nr (batch_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_test_findings_baclabor`
#

CREATE TABLE care_test_findings_baclabor (
  batch_nr int(11) NOT NULL default '0',
  encounter_nr int(11) unsigned NOT NULL default '0',
  room_nr varchar(10) NOT NULL default '',
  dept_nr smallint(5) unsigned NOT NULL default '0',
  notes varchar(255) NOT NULL default '',
  findings_init tinyint(1) NOT NULL default '0',
  findings_current tinyint(1) NOT NULL default '0',
  findings_final tinyint(1) NOT NULL default '0',
  entry_nr varchar(10) NOT NULL default '',
  rec_date date NOT NULL default '0000-00-00',
  type_general text NOT NULL,
  resist_anaerob text NOT NULL,
  resist_aerob text NOT NULL,
  findings text NOT NULL,
  doctor_id varchar(35) NOT NULL default '',
  findings_date date NOT NULL default '0000-00-00',
  findings_time time NOT NULL default '00:00:00',
  status varchar(10) NOT NULL default '',
  history text,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (batch_nr),
  KEY findings_date (findings_date),
  KEY rec_date (rec_date)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_test_findings_patho`
#

CREATE TABLE care_test_findings_patho (
  batch_nr int(11) NOT NULL default '0',
  encounter_nr int(11) unsigned NOT NULL default '0',
  room_nr varchar(10) NOT NULL default '',
  dept_nr smallint(5) unsigned NOT NULL default '0',
  material text NOT NULL,
  macro text NOT NULL,
  micro text NOT NULL,
  findings text NOT NULL,
  diagnosis text NOT NULL,
  doctor_id varchar(35) NOT NULL default '',
  findings_date date NOT NULL default '0000-00-00',
  findings_time time NOT NULL default '00:00:00',
  status varchar(10) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (batch_nr),
  KEY send_date (findings_date),
  KEY findings_date (findings_date)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_test_findings_radio`
#

CREATE TABLE care_test_findings_radio (
  batch_nr int(11) unsigned NOT NULL default '0',
  encounter_nr int(11) unsigned NOT NULL default '0',
  room_nr smallint(5) unsigned default '0',
  dept_nr smallint(5) unsigned default '0',
  findings text NOT NULL,
  diagnosis text NOT NULL,
  doctor_id varchar(35) NOT NULL default '',
  findings_date date NOT NULL default '0000-00-00',
  findings_time time NOT NULL default '00:00:00',
  status varchar(10) NOT NULL default '',
  history text,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (batch_nr),
  KEY send_date (findings_date),
  KEY findings_date (findings_date)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_test_request_baclabor`
#

CREATE TABLE care_test_request_baclabor (
  batch_nr int(11) NOT NULL auto_increment,
  encounter_nr int(11) unsigned NOT NULL default '0',
  dept_nr smallint(5) unsigned NOT NULL default '0',
  material text NOT NULL,
  test_type text NOT NULL,
  material_note tinytext NOT NULL,
  diagnosis_note tinytext NOT NULL,
  immune_supp tinyint(4) NOT NULL default '0',
  send_date date NOT NULL default '0000-00-00',
  sample_date date NOT NULL default '0000-00-00',
  status varchar(10) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (batch_nr),
  KEY send_date (send_date)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_test_request_blood`
#

CREATE TABLE care_test_request_blood (
  batch_nr int(11) NOT NULL auto_increment,
  encounter_nr int(11) unsigned NOT NULL default '0',
  dept_nr smallint(5) unsigned NOT NULL default '0',
  blood_group varchar(10) NOT NULL default '',
  rh_factor varchar(10) NOT NULL default '',
  kell varchar(10) NOT NULL default '',
  date_protoc_nr varchar(45) NOT NULL default '',
  pure_blood varchar(15) NOT NULL default '',
  red_blood varchar(15) NOT NULL default '',
  leukoless_blood varchar(15) NOT NULL default '',
  washed_blood varchar(15) NOT NULL default '',
  prp_blood varchar(15) NOT NULL default '',
  thrombo_con varchar(15) NOT NULL default '',
  ffp_plasma varchar(15) NOT NULL default '',
  transfusion_dev varchar(15) NOT NULL default '',
  match_sample tinyint(4) NOT NULL default '0',
  transfusion_date date NOT NULL default '0000-00-00',
  diagnosis tinytext NOT NULL,
  notes tinytext NOT NULL,
  send_date date NOT NULL default '0000-00-00',
  doctor varchar(35) NOT NULL default '',
  phone_nr varchar(40) NOT NULL default '',
  status varchar(10) NOT NULL default '',
  blood_pb tinytext NOT NULL,
  blood_rb tinytext NOT NULL,
  blood_llrb tinytext NOT NULL,
  blood_wrb tinytext NOT NULL,
  blood_prp tinyblob NOT NULL,
  blood_tc tinytext NOT NULL,
  blood_ffp tinytext NOT NULL,
  b_group_count mediumint(9) NOT NULL default '0',
  b_group_price float(10,2) NOT NULL default '0.00',
  a_subgroup_count mediumint(9) NOT NULL default '0',
  a_subgroup_price float(10,2) NOT NULL default '0.00',
  extra_factors_count mediumint(9) NOT NULL default '0',
  extra_factors_price float(10,2) NOT NULL default '0.00',
  coombs_count mediumint(9) NOT NULL default '0',
  coombs_price float(10,2) NOT NULL default '0.00',
  ab_test_count mediumint(9) NOT NULL default '0',
  ab_test_price float(10,2) NOT NULL default '0.00',
  crosstest_count mediumint(9) NOT NULL default '0',
  crosstest_price float(10,2) NOT NULL default '0.00',
  ab_diff_count mediumint(9) NOT NULL default '0',
  ab_diff_price float(10,2) NOT NULL default '0.00',
  x_test_1_code mediumint(9) NOT NULL default '0',
  x_test_1_name varchar(35) NOT NULL default '',
  x_test_1_count mediumint(9) NOT NULL default '0',
  x_test_1_price float(10,2) NOT NULL default '0.00',
  x_test_2_code mediumint(9) NOT NULL default '0',
  x_test_2_name varchar(35) NOT NULL default '',
  x_test_2_count mediumint(9) NOT NULL default '0',
  x_test_2_price float(10,2) NOT NULL default '0.00',
  x_test_3_code mediumint(9) NOT NULL default '0',
  x_test_3_name varchar(35) NOT NULL default '',
  x_test_3_count mediumint(9) NOT NULL default '0',
  x_test_3_price float(10,2) NOT NULL default '0.00',
  lab_stamp datetime NOT NULL default '0000-00-00 00:00:00',
  release_via varchar(20) NOT NULL default '',
  receipt_ack varchar(20) NOT NULL default '',
  mainlog_nr varchar(7) NOT NULL default '',
  lab_nr varchar(7) NOT NULL default '',
  mainlog_date date NOT NULL default '0000-00-00',
  lab_date date NOT NULL default '0000-00-00',
  mainlog_sign varchar(20) NOT NULL default '',
  lab_sign varchar(20) NOT NULL default '',
  history text,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (batch_nr),
  KEY send_date (send_date)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_test_request_chemlabor`
#

CREATE TABLE care_test_request_chemlabor (
  batch_nr int(11) NOT NULL auto_increment,
  encounter_nr int(11) unsigned NOT NULL default '0',
  room_nr varchar(10) NOT NULL default '',
  dept_nr smallint(5) unsigned NOT NULL default '0',
  parameters text NOT NULL,
  doctor_sign varchar(35) NOT NULL default '',
  highrisk smallint(1) NOT NULL default '0',
  notes tinytext NOT NULL,
  send_date datetime NOT NULL default '0000-00-00 00:00:00',
  sample_time time NOT NULL default '00:00:00',
  sample_weekday smallint(1) NOT NULL default '0',
  status varchar(15) NOT NULL default '',
  history text,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (batch_nr),
  KEY encounter_nr (encounter_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_test_request_generic`
#

CREATE TABLE care_test_request_generic (
  batch_nr int(11) NOT NULL default '0',
  encounter_nr int(11) unsigned NOT NULL default '0',
  testing_dept varchar(35) NOT NULL default '',
  visit tinyint(1) NOT NULL default '0',
  order_patient tinyint(1) NOT NULL default '0',
  diagnosis_quiry text NOT NULL,
  send_date date NOT NULL default '0000-00-00',
  send_doctor varchar(35) NOT NULL default '',
  result text NOT NULL,
  result_date date NOT NULL default '0000-00-00',
  result_doctor varchar(35) NOT NULL default '',
  status varchar(10) NOT NULL default '',
  history text,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (batch_nr),
  KEY batch_nr (batch_nr,encounter_nr),
  KEY send_date (send_date)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_test_request_patho`
#

CREATE TABLE care_test_request_patho (
  batch_nr int(11) unsigned NOT NULL auto_increment,
  encounter_nr int(11) unsigned NOT NULL default '0',
  dept_nr smallint(5) unsigned NOT NULL default '0',
  quick_cut tinyint(4) NOT NULL default '0',
  qc_phone varchar(40) NOT NULL default '',
  quick_diagnosis tinyint(4) NOT NULL default '0',
  qd_phone varchar(40) NOT NULL default '',
  material_type varchar(25) NOT NULL default '',
  material_desc text NOT NULL,
  localization tinytext NOT NULL,
  clinical_note tinytext NOT NULL,
  extra_note tinytext NOT NULL,
  repeat_note tinytext NOT NULL,
  gyn_last_period varchar(25) NOT NULL default '',
  gyn_period_type varchar(25) NOT NULL default '',
  gyn_gravida varchar(25) NOT NULL default '',
  gyn_menopause_since varchar(25) NOT NULL default '0',
  gyn_hysterectomy varchar(25) NOT NULL default '0',
  gyn_contraceptive varchar(25) NOT NULL default '0',
  gyn_iud varchar(25) NOT NULL default '',
  gyn_hormone_therapy varchar(25) NOT NULL default '',
  doctor_sign varchar(35) NOT NULL default '',
  op_date date NOT NULL default '0000-00-00',
  send_date datetime NOT NULL default '0000-00-00 00:00:00',
  status varchar(10) NOT NULL default '',
  entry_date date NOT NULL default '0000-00-00',
  journal_nr varchar(15) NOT NULL default '',
  blocks_nr int(11) NOT NULL default '0',
  deep_cuts int(11) NOT NULL default '0',
  special_dye varchar(35) NOT NULL default '',
  immune_histochem varchar(35) NOT NULL default '',
  hormone_receptors varchar(35) NOT NULL default '',
  specials varchar(35) NOT NULL default '',
  history text,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  process_id varchar(35) NOT NULL default '',
  process_time timestamp(14) NOT NULL,
  PRIMARY KEY  (batch_nr),
  KEY encounter_nr (encounter_nr),
  KEY send_date (send_date)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_test_request_radio`
#

CREATE TABLE care_test_request_radio (
  batch_nr int(11) NOT NULL default '0',
  encounter_nr int(11) unsigned NOT NULL default '0',
  dept_nr smallint(5) unsigned NOT NULL default '0',
  xray tinyint(1) NOT NULL default '0',
  ct tinyint(1) NOT NULL default '0',
  sono tinyint(1) NOT NULL default '0',
  mammograph tinyint(1) NOT NULL default '0',
  mrt tinyint(1) NOT NULL default '0',
  nuclear tinyint(1) NOT NULL default '0',
  if_patmobile tinyint(1) NOT NULL default '0',
  if_allergy tinyint(1) NOT NULL default '0',
  if_hyperten tinyint(1) NOT NULL default '0',
  if_pregnant tinyint(1) NOT NULL default '0',
  clinical_info text NOT NULL,
  test_request text NOT NULL,
  send_date date NOT NULL default '0000-00-00',
  send_doctor varchar(35) NOT NULL default '0',
  xray_nr varchar(9) NOT NULL default '0',
  r_cm_2 varchar(15) NOT NULL default '',
  mtr varchar(35) NOT NULL default '',
  xray_date date NOT NULL default '0000-00-00',
  xray_time time NOT NULL default '00:00:00',
  results text NOT NULL,
  results_date date NOT NULL default '0000-00-00',
  results_doctor varchar(35) NOT NULL default '',
  status varchar(10) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  process_id varchar(35) NOT NULL default '',
  process_time timestamp(14) NOT NULL,
  PRIMARY KEY  (batch_nr),
  UNIQUE KEY batch_nr_2 (batch_nr),
  KEY batch_nr (batch_nr,encounter_nr),
  KEY send_date (xray_time)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_time`
#

CREATE TABLE care_time (
  nr smallint(5) unsigned NOT NULL auto_increment,
  dept_nr smallint(5) unsigned NOT NULL default '0',
  time_type_nr tinyint(3) unsigned NOT NULL default '0',
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_application`
#

CREATE TABLE care_type_application (
  nr int(11) NOT NULL auto_increment,
  group_nr tinyint(3) unsigned NOT NULL default '0',
  type varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  description varchar(255) default NULL,
  status varchar(25) default NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_assignment`
#

CREATE TABLE care_type_assignment (
  type_nr int(10) unsigned NOT NULL default '0',
  type varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(25) NOT NULL default '0',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (type)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_cause_opdelay`
#

CREATE TABLE care_type_cause_opdelay (
  type_nr smallint(5) unsigned NOT NULL auto_increment,
  type varchar(35) NOT NULL default '',
  cause varchar(255) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  status varchar(25) default NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (type_nr),
  KEY type (type)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_color`
#

CREATE TABLE care_type_color (
  color_id varchar(25) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  PRIMARY KEY  (color_id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_department`
#

CREATE TABLE care_type_department (
  nr smallint(5) unsigned NOT NULL auto_increment,
  type varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY type (type)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_discharge`
#

CREATE TABLE care_type_discharge (
  nr smallint(5) unsigned NOT NULL auto_increment,
  type varchar(35) NOT NULL default '',
  name varchar(100) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  status varchar(25) default NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_duty`
#

CREATE TABLE care_type_duty (
  type_nr smallint(5) unsigned NOT NULL auto_increment,
  type varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (type_nr),
  KEY type (type)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_encounter`
#

CREATE TABLE care_type_encounter (
  type_nr int(10) unsigned NOT NULL auto_increment,
  type varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(25) NOT NULL default '0',
  description varchar(255) NOT NULL default '',
  hide_from tinyint(4) NOT NULL default '0',
  status varchar(25) default NULL,
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (type_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_ethnic_orig`
#

CREATE TABLE care_type_ethnic_orig (
  nr smallint(5) unsigned NOT NULL auto_increment,
  class_nr tinyint(3) unsigned NOT NULL default '0',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  status varchar(25) default NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY type (class_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_event`
#

CREATE TABLE care_type_event (
  type_nr mediumint(8) unsigned NOT NULL auto_increment,
  type varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  status varchar(25) default NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  PRIMARY KEY  (type_nr),
  UNIQUE KEY type_2 (type),
  KEY type (type)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_feeding`
#

CREATE TABLE care_type_feeding (
  type_nr smallint(5) unsigned NOT NULL auto_increment,
  group_nr tinyint(3) unsigned NOT NULL default '0',
  type varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  description varchar(255) default NULL,
  status varchar(25) default NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (type_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_insurance`
#

CREATE TABLE care_type_insurance (
  type_nr int(11) NOT NULL auto_increment,
  type varchar(35) NOT NULL default '',
  name varchar(60) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (type_nr),
  KEY type (type)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_localization`
#

CREATE TABLE care_type_localization (
  nr tinyint(3) unsigned NOT NULL auto_increment,
  category varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  short_code char(1) NOT NULL default '',
  LD_var_short_code varchar(25) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  hide_from varchar(255) NOT NULL default '0',
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_location`
#

CREATE TABLE care_type_location (
  nr smallint(5) unsigned NOT NULL auto_increment,
  type varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_measurement`
#

CREATE TABLE care_type_measurement (
  nr smallint(5) unsigned NOT NULL auto_increment,
  type varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  status varchar(25) default NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_notes`
#

CREATE TABLE care_type_notes (
  nr smallint(5) unsigned NOT NULL auto_increment,
  type varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  sort_nr smallint(6) NOT NULL default '0',
  status varchar(25) default NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_outcome`
#

CREATE TABLE care_type_outcome (
  type_nr smallint(5) unsigned NOT NULL auto_increment,
  group_nr tinyint(3) unsigned NOT NULL default '0',
  type varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (type_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_perineum`
#

CREATE TABLE care_type_perineum (
  type_nr smallint(5) unsigned NOT NULL auto_increment,
  type_id varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (type_nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_prescription`
#

CREATE TABLE care_type_prescription (
  nr smallint(5) unsigned NOT NULL auto_increment,
  type varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  status varchar(25) default NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_room`
#

CREATE TABLE care_type_room (
  nr smallint(5) unsigned NOT NULL auto_increment,
  type varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_test`
#

CREATE TABLE care_type_test (
  type_nr smallint(5) unsigned NOT NULL auto_increment,
  type varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (type_nr),
  KEY type (type)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_time`
#

CREATE TABLE care_type_time (
  nr smallint(5) unsigned NOT NULL auto_increment,
  type varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY type (type)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_type_unit_measurement`
#

CREATE TABLE care_type_unit_measurement (
  nr smallint(5) unsigned NOT NULL auto_increment,
  type varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY type (type)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_unit_measurement`
#

CREATE TABLE care_unit_measurement (
  nr smallint(5) unsigned NOT NULL auto_increment,
  unit_type_nr smallint(2) unsigned NOT NULL default '0',
  id varchar(15) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  LD_var varchar(35) NOT NULL default '',
  sytem varchar(35) NOT NULL default '',
  use_frequency bigint(20) default NULL,
  status varchar(25) NOT NULL default '',
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_users`
#

CREATE TABLE care_users (
  name varchar(60) NOT NULL default '',
  login_id varchar(35) NOT NULL default '',
  password varchar(255) default NULL,
  personell_nr int(10) unsigned NOT NULL default '0',
  lockflag tinyint(3) unsigned default '0',
  permission text NOT NULL,
  exc tinyint(1) NOT NULL default '0',
  s_date date NOT NULL default '0000-00-00',
  s_time time NOT NULL default '00:00:00',
  expire_date date NOT NULL default '0000-00-00',
  expire_time time NOT NULL default '00:00:00',
  status varchar(15) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(35) NOT NULL default '',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(35) NOT NULL default '',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (login_id),
  KEY login_id (login_id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_version`
#

CREATE TABLE care_version (
  name varchar(20) NOT NULL default '',
  type varchar(20) NOT NULL default '',
  number varchar(10) NOT NULL default '',
  build varchar(5) NOT NULL default '',
  date date NOT NULL default '0000-00-00',
  time time NOT NULL default '00:00:00',
  releaser varchar(30) NOT NULL default ''
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Tabellenstruktur f�r Tabelle `care_ward`
#

CREATE TABLE care_ward (
  nr smallint(5) unsigned NOT NULL auto_increment,
  ward_id varchar(35) NOT NULL default '',
  name varchar(35) NOT NULL default '',
  is_temp_closed tinyint(1) NOT NULL default '0',
  date_create date NOT NULL default '0000-00-00',
  date_close date NOT NULL default '0000-00-00',
  description text,
  info tinytext,
  dept_nr smallint(5) unsigned NOT NULL default '0',
  room_nr_start smallint(6) NOT NULL default '0',
  room_nr_end smallint(6) NOT NULL default '0',
  roomprefix varchar(4) default NULL,
  status varchar(25) NOT NULL default '',
  history text NOT NULL,
  modify_id varchar(25) NOT NULL default '0',
  modify_time timestamp(14) NOT NULL,
  create_id varchar(25) NOT NULL default '0',
  create_time timestamp(14) NOT NULL,
  PRIMARY KEY  (nr),
  KEY ward_id (ward_id)
) TYPE=MyISAM;

#
# Following are the data inserts of the preloaded data
#

#
# Daten f�r Tabelle `care_address_citytown`
#

INSERT INTO care_address_citytown VALUES (1, 'a', '14', 'Johannesburg', 'ZAR', 2, '23435H 567W', 'http://maryhospital.com/', 0, '', 'Update: 2003-04-27 01:43:58 Elpidio Latorilla\nUpdate: 2003-04-27 01:45:52 Elpidio Latorilla\nUpdate: 2003-04-27 02:27:51 Elpidio Latorilla\nUpdate: 2003-04-27 02:28:46 Elpidio Latorilla\n', 'Elpidio Latorilla', 20030427022846, '', 00000000000000);
INSERT INTO care_address_citytown VALUES (2, 'b', '1234-PH33', 'Manila', 'PH', 0, '234H 333W', 'http://care2x.com/', 0, NULL, 'Create: 2003-04-27 01:47:02 Elpidio Latorilla\nUpdate: 2003-04-27 01:57:40 Elpidio Latorilla\n', 'Elpidio Latorilla', 20030427015740, 'Elpidio Latorilla', 20030427014702);

#
# Daten f�r Tabelle `care_category_diagnosis`
#

INSERT INTO care_category_diagnosis VALUES (1, 'most_responsible', 'Most responsible', 'LDMostResponsible', 'M', 'LDMostResp_s', 'Most responsible diagnosis, must be only one per admission or visit', '0', '', '', '', 20030525120956, '', 00000000000000);
INSERT INTO care_category_diagnosis VALUES (2, 'associated', 'Associated', 'LDAssociated', 'A', 'LDAssociated_s', 'Associated diagnosis, can be several per  admission or visit', '0', '', '', '', 20030525121005, '', 00000000000000);
INSERT INTO care_category_diagnosis VALUES (3, 'nosocomial', 'Hospital acquired', 'LDNosocomial', 'N', 'LDNosocomial_s', 'Hospital acquired problem, can be several per admission or visit', '0', '', '', '', 20030525121015, '', 00000000000000);
INSERT INTO care_category_diagnosis VALUES (4, 'iatrogenic', 'Iatrogenic', 'LDIatrogenic', 'I', 'LDIatrogenic_s', 'Problem resulting from a procedural/surgical complication or medication mistake', '0', '', '', '', 20030525121025, '', 00000000000000);
INSERT INTO care_category_diagnosis VALUES (5, 'other', 'Other', 'LDOther', 'O', 'LDOther_s', 'Other  diagnosis', '0', '', '', '', 20030525121033, '', 00000000000000);

#
# Daten f�r Tabelle `care_category_disease`
#

INSERT INTO care_category_disease VALUES (1, 2, 'asphyxia', 'Asphyxia', 'LDAsphyxia', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_category_disease VALUES (2, 2, 'infection', 'Infection', 'LDInfection', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_category_disease VALUES (3, 2, 'congenital_abnomality', 'Congenital abnormality', 'LDCongenitalAbnormality', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_category_disease VALUES (4, 2, 'trauma', 'Trauma', 'LDTrauma', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_category_procedure`
#

INSERT INTO care_category_procedure VALUES (1, 'main', 'Main', 'LDMain', 'M', 'LDMain_s', 'Main procedure, must be only one per op or intervention visit', '0', '', '', '', 20030614013508, '', 00000000000000);
INSERT INTO care_category_procedure VALUES (2, 'supplemental', 'Supplemental', 'LDSupplemental', 'S', 'LDSupp_s', 'Supplemental procedure, can be several per  encounter op or intervention or visit', '0', '', '', '', 20030614015324, '', 00000000000000);

#
# Daten f�r Tabelle `care_class_encounter`
#

INSERT INTO care_class_encounter VALUES (1, 'inpatient', 'Inpatient', 'LDStationary', 'Inpatient admission - stays at least in a ward and assigned a bed', 0, '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_encounter VALUES (2, 'outpatient', 'Outpatient', 'LDAmbulant', 'Outpatient visit - does not stay in a ward nor assigned a bed', 0, '', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_class_ethnic_orig`
#

INSERT INTO care_class_ethnic_orig VALUES (1, 'race', 'LDRace', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_ethnic_orig VALUES (2, 'country', 'LDCountry', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_class_financial`
#

INSERT INTO care_class_financial VALUES (1, 'care_c', 'care', 'c', 'common', 'LDcommon', 'Common nursing care services. (Non-private)', 'Patient with common health fund insurance policy.', '', '', '', 20021229134050, '', 00000000000000);
INSERT INTO care_class_financial VALUES (2, 'care_pc', 'care', 'p/c', 'private + common', 'LDprivatecommon', 'Private services added to common services', 'Patient with common health fund insurance\r\npolicy with additional private insurance policy\r\nOR self paying components.', '', '', '', 20021229134451, '', 20021229134451);
INSERT INTO care_class_financial VALUES (3, 'care_p', 'care', 'p', 'private', 'LDprivate', 'Private nursing care services', 'Patient with private insurance policy\r\nOR self paying.', 'LDprivate', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (4, 'care_pp', 'care', 'pp', 'private plus', 'LDprivateplus', '"Very private" nursing care services', 'Patient with private health insurance policy\r\nAND self paying components.', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (5, 'room_c', 'room', 'c', 'common', 'LDcommon', 'Common room services (non-private)', 'Patient with common health fund insurance policy. ', 'LDcommon', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (6, 'room_pc', 'room', 'p/c', 'private + common', '', 'Private services added to common services', 'Patient with common health fund insurance policy with additional private insurance policy OR self paying components.', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (7, 'room_p', 'room', 'p', 'private', '', 'Private room services', 'Patient with private insurance policy OR self paying. ', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (8, 'room_pp', 'room', 'pp', 'private plus', '', '"Very private" room services', 'Patient with private health insurance policy AND self paying components.', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (9, 'att_dr_c', 'att_dr', 'c', 'common', '', 'Common clinician services', 'Patient with common health fund insurance policy. ', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (10, 'att_dr_pc', 'att_dr', 'p/c', 'private + common', '', 'Private services added to common clinician services', 'Patient with common health fund insurance policy with additional private insurance policy OR self paying components.', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (11, 'att_dr_p', 'att_dr', 'p', 'private', '', 'Private clinician services', 'Patient with private insurance policy OR self paying.', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (12, 'att_dr_pp', 'att_dr', 'pp', 'private plus', '', '"Very private" clinician services', 'Patient with private health insurance policy AND self paying components.', '', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_class_insurance`
#

INSERT INTO care_class_insurance VALUES (1, 'private', 'Private', 'LDPrivate', 'Private insurance plan (paid by insured alone)', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_insurance VALUES (2, 'common', 'Health Fund', 'LDInsurance', 'Public (common) health fund - usually paid both by the insured and his employer, eventually paid by the state', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_insurance VALUES (3, 'self_pay', 'Self pay', 'LDSelfPay', '', '', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_class_therapy`
#

INSERT INTO care_class_therapy VALUES (1, 2, 'photo', 'Phototherapy', 'LDPhototherapy', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_therapy VALUES (2, 2, 'iv', 'IV Fluids', 'LDIVFluids', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_therapy VALUES (3, 2, 'oxygen', 'Oxygen therapy', 'LDOxygenTherapy', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_therapy VALUES (4, 2, 'cpap', 'CPAP', 'LDCPAP', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_therapy VALUES (5, 2, 'ippv', 'IPPV', 'LDIPPV', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_therapy VALUES (6, 2, 'nec', 'NEC', 'LDNEC', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_therapy VALUES (7, 2, 'tpn', 'TPN', 'LDTPN', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_therapy VALUES (8, 2, 'hie', 'HIE', 'LDHIE', '', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_complication`
#

INSERT INTO care_complication VALUES (1, 1, 'Previous C/S', 'LDPreviousCS', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (2, 1, 'Pre-eclampsia', 'LDPreEclampsia', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (3, 1, 'Eclampsia', 'LDEclampsia', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (4, 1, 'Other hypertension', 'LDOtherHypertension', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (5, 1, 'Other proteinuria', 'LDProteinuria', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (6, 1, 'Cardiac', 'LDCardiac', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (7, 1, 'Anaemia < 8.5g', 'LDAnaemia', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (8, 1, 'Asthma', 'LDAsthma', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (9, 1, 'Epilepsy', 'LDEpilepsy', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (10, 1, 'Placenta praevia', 'LDPlacentaPraevia', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (11, 1, 'Abruptio placentae', 'LDAbruptioPlacentae', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (12, 1, 'Other APH', 'LDOtherAPH', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (13, 1, 'Diabetes', 'LDDiabetes', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (14, 1, 'Cord prolapse', 'LDCordProlapse', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (15, 1, 'Ruptured uterus', 'LDRupturedUterus', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (16, 1, 'Extrauterine pregnancy', 'LDExtraUterinePregnancy', '', '', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_config_global`
#

INSERT INTO care_config_global VALUES ('date_format', 'dd.MM.yyyy', NULL, NULL, '', '', 20030425232322, '', 00000000000000);
INSERT INTO care_config_global VALUES ('time_format', 'HH.MM', '', '', '', '', 20030105033839, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_reg_nr_adder', '10000000', '', '', '', '', 20030105033839, '', 00000000000000);
INSERT INTO care_config_global VALUES ('main_info_police_nr', '11?', '', '', '', '', 20030105033839, '', 00000000000000);
INSERT INTO care_config_global VALUES ('main_info_fire_dept_nr', '22?', '', '', '', '', 20030105033839, '', 00000000000000);
INSERT INTO care_config_global VALUES ('main_info_emgcy_nr', '12?', '', '', '', '', 20030105033839, '', 00000000000000);
INSERT INTO care_config_global VALUES ('main_info_phone', '(701??)  993???', '', '', '', '', 20030105033839, '', 00000000000000);
INSERT INTO care_config_global VALUES ('main_info_fax', '(702??) 839393??', '', '', '', '', 20030105033839, '', 00000000000000);
INSERT INTO care_config_global VALUES ('main_info_address', 'Virtualstr. 89<br>Cyberia 893003', '', '', '', '', 20030105033839, '', 00000000000000);
INSERT INTO care_config_global VALUES ('main_info_email', 'contact@care2x.com', '', '', '', '', 20030105033839, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_id_nr_adder', '10000000', '', '', '', '', 20030105033839, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_outpatient_nr_adder', '800000', '', '', '', '', 20030510122209, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_inpatient_nr_adder', '0', '', '', '', '', 20030510141916, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_name_2_hide', '1', NULL, NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_name_3_hide', '1', NULL, NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_name_middle_hide', '0', NULL, NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_name_maiden_hide', '1', NULL, NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_ethnic_orig_hide', '1', NULL, NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_name_others_hide', '1', NULL, NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_nat_id_nr_hide', '1', NULL, NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_religion_hide', '1', NULL, NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_cellphone_2_nr_hide', '1', NULL, NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_phone_2_nr_hide', '1', NULL, NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_citizenship_hide', '1', NULL, NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_sss_nr_hide', '1', NULL, NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('language_default', 'fr', NULL, NULL, '', '', 20030524163653, '', 00000000000000);
INSERT INTO care_config_global VALUES ('language_single', '0', NULL, NULL, '', '', 20030524163653, '', 00000000000000);
INSERT INTO care_config_global VALUES ('mascot_hide', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('mascot_style', 'default', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('gui_frame_left_nav_width', '150', NULL, NULL, '', '', 20030524163653, '', 00000000000000);
INSERT INTO care_config_global VALUES ('gui_frame_left_nav_border', '1', NULL, NULL, '', '', 20030524163653, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_fotos_path', 'fotos/news/', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_title_font_size', '5', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_title_font_face', 'arial,verdana,helvetica,sans serif', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_title_font_color', '#006600', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_preface_font_size', '2', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_preface_font_face', 'arial,verdana,helvetica,sans serif', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_preface_font_color', '#000033', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_body_font_size', '2', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_body_font_face', 'arial,verdana,helvetica,sans serif', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_body_font_color', '#030303', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_normal_preview_maxlen', '600', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_title_font_bold', '1', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_preface_font_bold', '1', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_normal_display_width', '500', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_fax_hide', '1', NULL, NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_email_hide', '1', NULL, NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_phone_1_nr_hide', '1', NULL, NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_cellphone_1_nr_hide', '1', NULL, NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_foto_path', 'fotos/registration/', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_service_care_hide', '1', NULL, NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_service_room_hide', '1', NULL, NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_service_att_dr_hide', '1', NULL, NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_financial_class_single_result', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_name_2_show', '1', NULL, NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_name_3_show', '1', NULL, NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_name_middle_show', '1', NULL, NULL, '', '', 20030422191027, '', 00000000000000);
INSERT INTO care_config_global VALUES ('theme_control_buttons', 'default', NULL, NULL, '', '', 20030506223006, '', 00000000000000);
INSERT INTO care_config_global VALUES ('gui_frame_left_nav_bdcolor', '#990000', NULL, NULL, '', '', 20030524163653, '', 00000000000000);
INSERT INTO care_config_global VALUES ('theme_control_theme_list', 'default,blue_aqua', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('medocs_text_preview_maxlen', '100', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('personell_nr_adder', '100000', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('notes_preview_maxlen', '120', NULL, NULL, '', '', 20030413100412, '', 20030412201004);
INSERT INTO care_config_global VALUES ('person_id_nr_init', '10000000', NULL, NULL, '', '', 20030510094302, '', 20030510094028);
INSERT INTO care_config_global VALUES ('personell_nr_init', '100000', NULL, NULL, '', '', 20030510094158, '', 20030510094158);
INSERT INTO care_config_global VALUES ('encounter_nr_init', '000000', NULL, NULL, '', '', 20030510142050, '', 20030510113437);
INSERT INTO care_config_global VALUES ('encounter_nr_fullyear_prepend', '1', NULL, NULL, '', '', 20030510141400, '', 20030510141400);
INSERT INTO care_config_global VALUES ('theme_mascot', 'default', NULL, NULL, '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_currency`
#

INSERT INTO care_currency VALUES (13, '�', 'Euro', 'European currency', '', '', 20030213174719, '', 20021126200534);
INSERT INTO care_currency VALUES (3, 'L', 'Pound', 'GB British Pound (ISO = GBP)', '', '', 20030213173107, '', 20020816230349);
INSERT INTO care_currency VALUES (10, 'R', 'Rand', 'South African Rand (ISO = ZAR)', 'main', '', 20030213200754, 'Elpidio Latorilla', 20020817171805);
INSERT INTO care_currency VALUES (8, 'R', 'Rupees', 'Indian Rupees (ISO = INR)', '', '', 20030213173059, 'Elpidio Latorilla', 20020920234306);

#
# Daten f�r Tabelle `care_department`
#

INSERT INTO care_department VALUES (1, 'pr', '2', 'Public Relations', 'PR', 'Press Relations', 'LDPressRelations', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', 20030504191525, '', 00000000000000);
INSERT INTO care_department VALUES (2, 'cafe', '2', 'Cafeteria', 'Cafe', 'Canteen', 'LDCafeteria', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', 20030504191543, '', 00000000000000);
INSERT INTO care_department VALUES (3, 'general_surgery', '1', 'General Surgery', 'General', 'General', 'LDGeneralSurgery', 'This is the description. ', 1, 1, 1, 1, 1, 1, 0, 0, '8.30 - 21.00', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', 'Prof. Dr. Dr. Gopendo', 'General Surgery\r\nProf. Dr.Dr. Gopendo\r\nSuite 23, 4th Floor\r\nTel: 9099-34567', 'gif', '', 'Update: 2003-04-27 13:47:35 Elpidio Latorilla\nUpdate: 2003-06-19 16:40:02 Elpidio Latorilla\nUpdate: 2003-06-19 16:48:48 Elpidio Latorilla\nUpdate: 2003-06-19 16:51:51 Elpidio Latorilla\nUpdate: 2003-06-19 16:55:46 Elpidio Latorilla\n', 'Elpidio Latorilla', 20030619165546, '', 00000000000000);
INSERT INTO care_department VALUES (4, 'emergency_surgery', '1', 'Emergency Surgery', 'Emergency', '', 'LDEmergencySurgery', '', 1, 1, 1, 1, 1, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (5, 'plastic_surgery', '1', 'Plastic Surgery', 'Plastic', 'Aesthetic Surgery', 'LDPlasticSurgery', '', 1, 1, 1, 1, 1, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (6, 'ent', '1', 'Ear-Nose-Throath', 'ENT', 'HNO', 'LDEarNoseThroath', 'Ear-Nose-Throath, in german Hals-Nasen-Ohren. The department with  very old traditions that date back to the early beginnings of premodern medicine.', 1, 1, 1, 1, 1, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, '', 'Dr. Signa Sigisig MD\r\nENT-HNO department\r\nKKH Hospital\r\nSt. Moritz, Switzerland\r\n', '', '', 'Update: 2003-03-02 11:24:19 = Elpidio Latorilla\nUpdate: 2003-03-16 11:29:38 = Elpidio Latorilla\nUpdate: 2003-04-27 15:03:23 Elpidio Latorilla\n', 'Elpidio Latorilla', 20030427150323, '', 00000000000000);
INSERT INTO care_department VALUES (7, 'opthalmology', '1', 'Opthalmology', 'Opthalmology', 'Eye Department', 'LDOpthalmology', '', 1, 1, 1, 1, 1, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (8, 'pathology', '1', 'Pathology', 'Pathology', 'Patho', 'LDPathology', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (9, 'ob_gyn', '1', 'Ob-Gynecology', 'Ob-Gyne', 'Gyn', 'LDObGynecology', '', 1, 1, 1, 1, 1, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (10, 'physical_therapy', '1', 'Physical Therapy', 'Physical', 'PT', 'LDPhysicalTherapy', 'Physical therapy department with on-call therapists. Day care clinics, training, rehab.', 1, 0, 1, 1, 0, 1, 1, 16, '8:00 - 15:00', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', 'PT-tel:1090-39393', 'Physical Therapy Clinic\r\nInternal Medicine\r\nDr. Holmer Apacio', '', '', 'Update: 2003-03-01 13:50:53 = Elpidio Latorilla\r\nUpdate: 2003-03-01 13:51:39 = Elpidio Latorilla\r\n', 'Elpidio Latorilla', 20030301135139, '', 00000000000000);
INSERT INTO care_department VALUES (11, 'internal_med', '1', 'Internal Medicine', 'Internal Med', 'InMed', 'LDInternalMedicine', '', 1, 1, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (12, 'imc', '1', 'Intermediate Care Unit', 'IMC', 'Intermediate', 'LDIntermediateCareUnit', '', 1, 1, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (13, 'icu', '1', 'Intensive Care Unit', 'ICU', 'Intensive', 'LDIntensiveCareUnit', '', 1, 1, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (14, 'emergency_ambulatory', '1', 'Emergency Ambulatory', 'Emergency', 'Emergency Amb', 'LDEmergencyAmbulatory', '', 0, 1, 1, 1, 0, 1, 1, 4, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (15, 'general_ambulatory', '1', 'General Ambulatory', 'Ambulatory', 'General Amb', 'LDGeneralAmbulatory', '', 0, 1, 1, 1, 0, 1, 1, 3, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (16, 'inmed_ambulatory', '1', 'Internal Medicine Ambulatory', 'InMed Ambulatory', 'InMed Amb', 'LDInternalMedicineAmbulatory', '', 0, 1, 1, 1, 0, 1, 1, 11, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', 'Update: 2003-03-01 18:18:40 = Elpidio Latorilla\r\nUpdate: 2003-03-16 11:29:52 = Elpidio Latorilla\r\n', 'Elpidio Latorilla', 20030316112952, '', 00000000000000);
INSERT INTO care_department VALUES (17, 'sonography', '1', 'Sonography', 'Sono', 'Ultrasound diagnostics', 'LDSonography', '', 0, 1, 1, 1, 0, 1, 1, 11, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (18, 'nuclear_diagnostics', '1', 'Nuclear Diagnostics', 'Nuclear', 'Nuclear Testing', 'LDNuclearDiagnostics', '', 0, 1, 1, 1, 0, 1, 1, 19, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (19, 'radiology', '1', 'Radiology', 'Radiology', 'Xray', 'LDRadiology', '', 0, 1, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', 'Update: 2003-03-01 23:49:35 = Elpidio Latorilla\r\nUpdate: 2003-03-16 11:30:12 = Elpidio Latorilla\r\n', 'Elpidio Latorilla', 20030316113012, '', 00000000000000);
INSERT INTO care_department VALUES (20, 'oncology', '1', 'Oncology', 'Oncology', 'Cancer Department', 'LDOncology', 'This is the testg da asjfalsjfsaf', 1, 0, 1, 1, 1, 1, 0, 11, 'test oke working hours', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, 'test', 'test lang ito day bakit ba ako masaydo sa sakit sa bato', '', '', 'Update: 2003-02-26 23:23:57 = Elpidio LatorillaUpdate: 2003-02-26 23:24:37 = Elpidio LatorillaUpdate: 2003-02-26 23:25:13 = Elpidio LatorillaUpdate: 2003-02-26 23:25:26 = Elpidio LatorillaUpdate: 2003-02-26 23:28:35 = Elpidio LatorillaUpdate: 2003-02-26 23:32:36 = Elpidio LatorillaUpdate: 2003-02-26 23:32:47 = Elpidio LatorillaUpdate: 2003-02-26 23:33:04 = Elpidio Latorilla', 'Elpidio Latorilla', 20030226233304, '', 00000000000000);
INSERT INTO care_department VALUES (21, 'neonatal', '1', 'Neonatal', 'Neonatal', 'Newborn Department', 'LDNeonatal', '', 1, 1, 1, 1, 1, 1, 1, 9, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (22, 'central_lab', '1', 'Central Laboratory', 'Central Lab', 'General Lab', 'LDCentralLaboratory', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (23, 'serological_lab', '1', 'Serological Laboratory', 'Serological Lab', 'Serum Lab', 'LDSerologicalLaboratory', '', 0, 1, 1, 1, 0, 1, 1, 22, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (24, 'chemical_lab', '1', 'Chemical Laboratory', 'Chemical Lab', 'Chem Lab', 'LDChemicalLaboratory', '', 0, 1, 1, 1, 0, 1, 1, 22, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', 'Update: 2003-03-01 17:53:52 = Elpidio Latorilla\r\nUpdate: 2003-03-01 17:54:29 = Elpidio Latorilla\r\nUpdate: 2003-03-01 17:55:28 = Elpidio Latorilla\r\nUpdate: 2003-03-01 17:55:33 = Elpidio Latorilla\r\nUpdate: 2003-03-01 17:58:23 = Elpidio Latorilla\r\nUpdate: 2003-03-01 17:58:31 = Elpidio Latorilla\r\nUpdate: 2003-03-01 18:00:51 = Elpidio Latorilla\r\nUpdate: 2003-03-01 18:01:57 = Elpidio Latorilla\r\n', 'Elpidio Latorilla', 20030301180157, '', 00000000000000);
INSERT INTO care_department VALUES (25, 'bacteriological_lab', '1', 'Bacteriological Laboratory', 'Bacteriological Lab', 'Bacteria Lab', 'LDBacteriologicalLaboratory', '', 0, 1, 1, 1, 0, 1, 1, 22, '', '12.30 - 15.00 , 19.00 - 21.00', 0, 0, '', '', '', '', '', 'Update: 2003-03-01 18:04:47 = Elpidio Latorilla\r\nUpdate: 2003-03-16 11:29:27 = Elpidio Latorilla\r\n', 'Elpidio Latorilla', 20030316112927, '', 00000000000000);
INSERT INTO care_department VALUES (26, 'tech', '2', 'Technical Maintenance', 'Tech', 'Technical Support', 'LDTechnicalMaintenance', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 0, 0, '', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (27, 'it', '2', 'IT Department', 'IT', 'EDP', 'LDITDepartment', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 0, 0, '', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (28, 'management', '2', 'Management', 'Management', 'Busines Administration', 'LDManagement', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 0, 0, '', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (29, 'exhibition', '3', 'Exhibitions', 'Exhibit', 'Showcases', 'LDExhibitions', '', 0, 0, 1, 1, 1, 1, 0, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (30, 'edu', '3', 'Education', 'Edu', 'Training', 'LDEducation', 'Education news bulletin of the hospital.', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 0, 0, '', '', '', '', '', 'Update: 2003-04-27 14:47:18 Elpidio Latorilla\n', 'Elpidio Latorilla', 20030427144718, '', 00000000000000);
INSERT INTO care_department VALUES (31, 'study', '3', 'Studies', 'Studies', 'Advance studies or on-the-job training', 'LDStudies', '', 0, 0, 1, 1, 1, 1, 0, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (32, 'health_tip', '3', 'Health Tips', 'Tips', 'Health Information', 'LDHealthTips', '', 0, 0, 1, 1, 1, 1, 0, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (33, 'admission', '2', 'Admission', 'Admit', 'Admission information', 'LDAdmission', '', 0, 0, 1, 1, 1, 0, 1, 0, '', '', 0, 0, NULL, '', '', '', '', 'Update: 2003-03-01 18:04:37 = Elpidio Latorilla\nUpdate: 2003-03-16 11:36:51 = Elpidio Latorilla\n', 'Elpidio Latorilla', 20030316113651, '', 00000000000000);
INSERT INTO care_department VALUES (34, 'news_headline', '3', 'Headline', 'News head', 'Major news', 'LDHeadline', '', 0, 0, 1, 1, 1, 1, 0, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (35, 'cafenews', '3', 'Cafe News', 'Cafe news', 'Cafeteria news', 'LDCafeNews', '', 0, 0, 1, 1, 1, 0, 0, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (36, 'nursing', '3', 'Nursing', 'Nursing', 'Nursing care', 'LDNursing', '', 1, 1, 1, 1, 1, 1, 1, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (37, 'doctors', '3', 'Doctors', 'Doctors', 'Medical personell', 'LDDoctors', '', 0, 0, 1, 1, 1, 1, 0, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (38, 'pharmacy', '2', 'Pharmacy', 'Pharma', 'Drugstore', 'LDPharmacy', '', 0, 0, 1, 1, 1, 1, 0, 0, '', '', 0, 0, NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_department VALUES (42, 'anaesthesiology', '1', 'Anesthesiology', 'ana', 'Anesthesia Department', 'LDAnesthesiology', 'Anesthesiology', 0, 0, 1, 1, 1, 1, 0, 0, '', '', 0, 0, '', '', '', '', '', 'Create: 2003-03-19 18:38:19 = Elpidio LatorillaUpdate: 2003-03-19 18:51:59 = Elpidio Latorilla\n', 'Elpidio Latorilla', 20030319185159, 'Elpidio Latorilla', 20030319183819);
INSERT INTO care_department VALUES (41, 'general_ambulant', '1', 'General Outpatient Clinic', 'General Clinic', 'General Ambulatory Clinic', 'LDGeneralOutpatientClinic', 'Outpatient/Ambulant Clinic for general/internal medicine', 0, 1, 1, 1, 0, 0, 1, 16, 'round the clock', '8:30 AM - 11:30 AM , 2:00 PM - 5:30 PM', 0, 0, '', 'GOC - Tel. 9089-9393', 'General Outpatient Clinic\r\nInternal Medicine\r\nProf. Dr.Dr. Makaryo Masangkay\r\nTobe Str. 300-1 St.20 Johannesburg\r\nTel: 56903 Fax: 3345666', '', '', 'Create: 2003-02-26 22:41:50 = Elpidio LatorillaUpdate: 2003-03-01 14:10:16 = Elpidio Latorilla\r\nUpdate: 2003-03-01 14:30:50 = Elpidio Latorilla\r\nUpdate: 2003-03-01 14:31:29 = Elpidio Latorilla\r\n', 'Elpidio Latorilla', 20030301143129, 'Elpidio Latorilla', 00000000000000);
INSERT INTO care_department VALUES (43, 'blood_bank', '1', 'Blood Bank', 'Blood Blank', 'Blood Lab', 'LDBloodBank', '', 0, 0, 1, 1, 0, 1, 0, 0, '', '', 0, 0, '', '', '', '', '', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_group`
#

INSERT INTO care_group VALUES (1, 'pregnancy', 'Pregnancy', 'LDPregnancy', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_group VALUES (2, 'neonatal', 'Neonatal', 'LDNeonatal', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_group VALUES (3, 'encounter', 'Encounter', 'LDEncounter', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_group VALUES (4, 'op', 'OP', 'LDOP', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_group VALUES (5, 'anesthesia', 'Anesthesia', 'LDAnesthesia', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_group VALUES (6, 'prescription', 'Prescription', 'LDPrescription', '', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_insurance_firm`
#

INSERT INTO care_insurance_firm VALUES ('1', 'A&M Aachener und M�nchener', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20021228202205, '', 20021228202205);
INSERT INTO care_insurance_firm VALUES ('2', 'Adler', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20021228202232, '', 20021228202232);
INSERT INTO care_insurance_firm VALUES ('3', 'Advance Bank', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20021228202310, '', 20021228202310);
INSERT INTO care_insurance_firm VALUES ('4', 'Aegon', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20021228202331, '', 20021228202331);
INSERT INTO care_insurance_firm VALUES ('5', 'Aggripina', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20021228202354, '', 20021228202354);
INSERT INTO care_insurance_firm VALUES ('6', 'Albingia', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20021228202414, '', 20021228202414);
INSERT INTO care_insurance_firm VALUES ('7', 'Allgemeine Rentenanstalt', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228202643);
INSERT INTO care_insurance_firm VALUES ('8', 'Allianz', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228202727);
INSERT INTO care_insurance_firm VALUES ('9', 'Alte Leipziger', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228202752);
INSERT INTO care_insurance_firm VALUES ('10', 'Alte Oldenburger', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228202917);
INSERT INTO care_insurance_firm VALUES ('11', 'AOK', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228202938);
INSERT INTO care_insurance_firm VALUES ('12', 'Arag', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228202959);
INSERT INTO care_insurance_firm VALUES ('13', 'Aspecta', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228203025);
INSERT INTO care_insurance_firm VALUES ('14', 'Asstel', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228203223);
INSERT INTO care_insurance_firm VALUES ('15', 'Atlanticlux', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228203425);
INSERT INTO care_insurance_firm VALUES ('16', 'Auxilia', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228203518);
INSERT INTO care_insurance_firm VALUES ('17', 'Axa Colonia', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228203551);
INSERT INTO care_insurance_firm VALUES ('18', 'Barmenia', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228203615);
INSERT INTO care_insurance_firm VALUES ('19', 'Basler', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228203820);
INSERT INTO care_insurance_firm VALUES ('20', 'Bayern Versicherung', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228203947);
INSERT INTO care_insurance_firm VALUES ('21', 'Bayrische Beamten LV', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228204051);
INSERT INTO care_insurance_firm VALUES ('22', 'BBV', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228204155);
INSERT INTO care_insurance_firm VALUES ('23', 'Berlinische', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228204254);
INSERT INTO care_insurance_firm VALUES ('24', 'Berlin-K�lnische', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228204458);
INSERT INTO care_insurance_firm VALUES ('25', 'BHW', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228204514);
INSERT INTO care_insurance_firm VALUES ('26', 'Central Krankenversicherung', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228204600);
INSERT INTO care_insurance_firm VALUES ('27', 'Concordia', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228204630);
INSERT INTO care_insurance_firm VALUES ('28', 'Condor', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228204658);
INSERT INTO care_insurance_firm VALUES ('29', 'Continentale', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228204748);
INSERT INTO care_insurance_firm VALUES ('30', 'CosmosDirekt', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228204919);
INSERT INTO care_insurance_firm VALUES ('31', 'Danv (HM)', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030437, '', 20021228204954);
INSERT INTO care_insurance_firm VALUES ('32', 'DBV Winterthur', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228205017);
INSERT INTO care_insurance_firm VALUES ('33', 'Debeka', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228205105);
INSERT INTO care_insurance_firm VALUES ('34', 'Delfin', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228205153);
INSERT INTO care_insurance_firm VALUES ('35', 'Delta', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228205239);
INSERT INTO care_insurance_firm VALUES ('36', 'DEURAG', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228205255);
INSERT INTO care_insurance_firm VALUES ('37', 'DA DIREKT', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228205332);
INSERT INTO care_insurance_firm VALUES ('38', 'Deutsche �rzteversicherung', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228205415);
INSERT INTO care_insurance_firm VALUES ('39', 'Deutscher Herold', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228205455);
INSERT INTO care_insurance_firm VALUES ('40', 'Deutscher Ring', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228205513);
INSERT INTO care_insurance_firm VALUES ('41', 'DEVK', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228205550);
INSERT INTO care_insurance_firm VALUES ('42', 'DEVK Allgemeine', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228205613);
INSERT INTO care_insurance_firm VALUES ('43', 'Dialog', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228205631);
INSERT INTO care_insurance_firm VALUES ('44', 'Die Alternative', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228205657);
INSERT INTO care_insurance_firm VALUES ('45', 'DKV', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228205728);
INSERT INTO care_insurance_firm VALUES ('46', 'Europa', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228205815);
INSERT INTO care_insurance_firm VALUES ('47', 'Generali', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228205834);
INSERT INTO care_insurance_firm VALUES ('48', 'Generali Lloyd', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228205856);
INSERT INTO care_insurance_firm VALUES ('49', 'Gerling Konzern Allgemeine', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228205932);
INSERT INTO care_insurance_firm VALUES ('50', 'Gerling E+L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228205953);
INSERT INTO care_insurance_firm VALUES ('51', 'Gerling Leben', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228210012);
INSERT INTO care_insurance_firm VALUES ('52', 'Globale Kranken', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228210104);
INSERT INTO care_insurance_firm VALUES ('53', 'Gothaer', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228210120);
INSERT INTO care_insurance_firm VALUES ('54', 'Gutingia', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228210221);
INSERT INTO care_insurance_firm VALUES ('55', 'Haftpflichtkasse Darmstadt', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 20030216030438, '', 20021228210335);
INSERT INTO care_insurance_firm VALUES ('1234567890', 'Holylandia EasyLife Insurance Co. Inc.', '', '', 0, 'Holylandstr. 45-33\r\nHolyland Himmelhoch\r\nHeavenly', 'PO Box 1234\r\nHolyland Himmelhoch\r\nHeavenly', 'PO Box 1234\r\nHolyland Himmelhoch\r\nHeavenly', 'holiness@holyland.org', '123456HOLY', '123456HOLYMORE', '123456HOLYFAX', '123456HOLYFAX454545', 'Mr. Roger Bond', '1333HOLY', '5656HOLYFAX', 'RogerBond@holyland.org', 0, '', 'Create: 2003-04-26 18:14:06 default\n', 'default', 20030426181406, 'default', 00000000000000);
INSERT INTO care_insurance_firm VALUES ('1234567891', 'test again', '', '', 0, 'test', 'teat', 'ateaet', 'test@test.org', '230482038230', '10810831', '34081', '0185401841098', 'Mr. Moore James', '32412431', '43151541', 'moorejames@agent007.org', 0, '', 'Create: 2003-04-26 19:49:04 default\n', 'default', 20030426194904, 'default', 00000000000000);
INSERT INTO care_insurance_firm VALUES ('1234567892', 'goa ad', '', '', 0, 'a faj', 'asdf', 'asd', 'as fl', 'aasdjf', 'asdfj', 'fadf', 'fasjf', 'faf', 'fajf', 'lf', 'afjdalk', 0, '', 'Create: 2003-04-26 19:51:34 default\n', 'default', 20030426195134, 'default', 00000000000000);
INSERT INTO care_insurance_firm VALUES ('1234567893', 'AAA Zolomaniska', '', '', 0, 'sda askljflas fklj', 'asd flkaj flasjasd lj', 'sda asdl fasdjfaslj', 'asddfjasljfa', 'asdfj', 'asdfj', 'lk', 'jlk', 'j', 'l', 'kl�jlkjlkj', 'klj', 0, '', 'Create: 2003-04-26 19:56:30 default\nUpdate: 2003-04-26 21:11:12 default\nUpdate: 2003-04-26 21:11:21 default\nUpdate: 2003-04-26 21:13:31 default\n', 'default', 20030426211331, 'default', 00000000000000);
INSERT INTO care_insurance_firm VALUES ('1234567894', 'AAB Securance & Co. Inc Bandaya', '', '', 0, 'Strettstr. 34-A\r\nMoerimar Badawa\r\nSenegal', 'PO Box 13421\r\nChepawaaeawa Conty\r\nArgusma mamama', 'Biling Box 232\r\nMontypahtosn\r\nAlle alla', 'email at ikmald.com', '341413', '345541', '31431', '4515', 'Mr. Mustafa Alberto', '123456788', '2232444323423', 'mustafa@allah.org', 0, '', 'Create: 2003-04-26 21:15:37 default\nUpdate: 2003-04-26 21:16:24 default\nUpdate: 2003-04-26 21:18:00 default\nUpdate: 2003-04-26 21:53:06 Elpidio Latorilla\nUpdate: 2003-04-26 21:53:16 Elpidio Latorilla\nUpdate: 2003-04-26 21:53:27 Elpidio Latorilla\nUpdate: 2003-04-26 22:06:18 Elpidio Latorilla\n', 'Elpidio Latorilla', 20030426220618, 'default', 20030426211537);

#
# Daten f�r Tabelle `care_menu_main`
#

INSERT INTO care_menu_main VALUES (1, 1, 'Home', 'LDHome', 'main/startframe.php', 1, '', '', 20030405003640, 00000000000000);
INSERT INTO care_menu_main VALUES (2, 5, 'Patient', 'LDPatient', 'modules/registration_admission/patient.php', 1, '', '', 20030405003710, 00000000000000);
INSERT INTO care_menu_main VALUES (3, 10, 'Admission', 'LDAdmission', 'modules/registration_admission/aufnahme_pass.php', 1, '', '', 20030405003723, 00000000000000);
INSERT INTO care_menu_main VALUES (4, 15, 'Ambulatory', 'LDAmbulatory', 'modules/ambulatory/ambulatory.php', 1, '', '', 20030405003740, 00000000000000);
INSERT INTO care_menu_main VALUES (5, 20, 'Medocs', 'LDMedocs', 'modules/medocs/medocs_pass.php', 1, '', '', 20030405003755, 00000000000000);
INSERT INTO care_menu_main VALUES (6, 25, 'Doctors', 'LDDoctors', 'modules/doctors/doctors.php', 1, '', '', 20030405003814, 00000000000000);
INSERT INTO care_menu_main VALUES (7, 35, 'Nursing', 'LDNursing', 'modules/nursing/nursing.php', 1, '', '', 20030405003828, 00000000000000);
INSERT INTO care_menu_main VALUES (8, 40, 'OR', 'LDOR', 'main/op-doku.php', 1, '', '', 20030405003839, 00000000000000);
INSERT INTO care_menu_main VALUES (9, 45, 'Laboratories', 'LDLabs', 'modules/laboratory/labor.php', 1, '', '', 20030405003853, 00000000000000);
INSERT INTO care_menu_main VALUES (10, 50, 'Radiology', 'LDRadiology', 'modules/radiology/radiolog.php', 1, '', '', 20030405003906, 00000000000000);
INSERT INTO care_menu_main VALUES (11, 55, 'Pharmacy', 'LDPharmacy', 'modules/pharmacy/apotheke.php', 1, '', '', 20030405003922, 00000000000000);
INSERT INTO care_menu_main VALUES (12, 60, 'Medical Depot', 'LDMedDepot', 'modules/med_depot/medlager.php', 1, '', '', 20030405003937, 00000000000000);
INSERT INTO care_menu_main VALUES (13, 65, 'Directory', 'LDDirectory', 'modules/phone_directory/phone.php', 1, '', '', 20030405003952, 00000000000000);
INSERT INTO care_menu_main VALUES (14, 70, 'Tech Support', 'LDTechSupport', 'modules/tech/technik.php', 1, '', '', 20030405004050, 00000000000000);
INSERT INTO care_menu_main VALUES (15, 72, 'EDP', 'LDEDP', 'modules/system_admin/edv.php', 1, '', '', 20030405004102, 00000000000000);
INSERT INTO care_menu_main VALUES (16, 75, 'Intranet Email', 'LDIntraEmail', 'modules/intranet_email/intra-email-pass.php', 1, '', '', 20030405004116, 00000000000000);
INSERT INTO care_menu_main VALUES (17, 80, 'Internet Email', 'LDInterEmail', 'modules/nocc/index.php', 1, '', '', 20030405004128, 00000000000000);
INSERT INTO care_menu_main VALUES (18, 85, 'Special Tools', 'LDSpecials', 'main/spediens.php', 1, '', '', 20030405004142, 00000000000000);
INSERT INTO care_menu_main VALUES (19, 90, 'Login', 'LDLogin', 'main/login.php', 1, '', '', 20030405004151, 00000000000000);
INSERT INTO care_menu_main VALUES (20, 7, 'Appointments', 'LDAppointments', 'modules/appointment_scheduler/appt_main_pass.php', 1, '', NULL, 20030407233801, 20030405000145);

#
# Daten f�r Tabelle `care_method_induction`
#

INSERT INTO care_method_induction VALUES (1, 1, 'prostaglandin', 'Prostaglandin', 'LDProstaglandin', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_method_induction VALUES (2, 1, 'oxytocin', 'Oxytocin', 'LDOxytocin', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_method_induction VALUES (3, 1, 'arom', 'AROM', 'LDAROM', '', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_mode_delivery`
#

INSERT INTO care_mode_delivery VALUES (1, 2, 'normal', 'Normal', 'LDNormal', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_mode_delivery VALUES (2, 2, 'breech', 'Breech', 'LDBreech', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_mode_delivery VALUES (3, 2, 'caesarian', 'Caesarian', 'LDCaesarian', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_mode_delivery VALUES (4, 2, 'forceps', 'Forceps', 'LDForceps', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_mode_delivery VALUES (5, 2, 'vacuum', 'Vacuum', 'LDVacuum', '', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_registry`
#

INSERT INTO care_registry VALUES ('amb', 'modules/ambulatory/ambulatory.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('dept', 'modules/news/departments.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('radiology', 'modules/radiology/radiolog.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('doctors', 'modules/doctors/doctors.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('nursing', 'modules/nursing/pflege.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('edp', 'modules/admin/edv.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('pharmacy', 'modules/pharmacy/apotheke.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('pr', 'modules/news/start_page.php', 'modules/news/start_page.php', 'modules/news/headline-edit.php', 'modules/news/headline-read.php', 'modules/news/editor-pass.php', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('cafe', 'modules/cafeteria/cafenews.php', 'modules/cafeteria/cafenews.php', 'modules/cafenews/cafenews-edit.php', 'modules/cafenews/cafenews-read.php', 'modules/cafenews/cafenews-edit-pass.php', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('main_start', 'modules/news/start_page.php', 'modules/news/start_page.php', 'modules/news/headline-edit-select-art.php', 'modules/news/headline-read.php', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('it', 'modules/system_admin/edv.php', 'modules/news/newscolumns.php', 'modules/news/editor-4plus1-select-art.php', 'modules/news/editor-4plus1-read.php', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('admission_module', 'modules/admission/aufnahme_start.php', '', '', '', 'modules/admission/aufnahme_pass.php', '', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_role_person`
#

INSERT INTO care_role_person VALUES (1, 3, 'contact', 'Contact person', 'LDContactPerson', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (2, 3, 'guarantor', 'Guarantor', 'LDGuarantor', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (3, 3, 'doctor_att', 'Attending doctor', 'LDAttDoctor', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (4, 3, 'supervisor', 'Supervisor', 'LDSupervisor', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (5, 3, 'doctor_admit', 'Admitting doctor', 'LDAdmittingDoctor', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (6, 3, 'doctor_consult', 'Consulting doctor', 'LDConsultingDoctor', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (7, 4, 'surgeon', 'Surgeon', 'LDSurgeon', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (8, 4, 'surgeon_asst', 'Assisting surgeon', 'LDAssistingSurgeon', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (9, 4, 'nurse_scrub', 'Scrub nurse', 'LDScrubNurse', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (10, 4, 'nurse_rotating', 'Rotating nurse', 'LDRotatingNurse', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (11, 4, 'nurse_anesthesia', 'Anesthesia nurse', 'LDAnesthesiaNurse', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (12, 4, 'anesthesiologist', 'Anesthesiologist', 'LDAnesthesiologist', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (13, 4, 'anesthesiologist_asst', 'Assisting anesthesiologist', 'LDAssistingAnesthesiologist', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (14, 0, 'nurse_on_call', 'Nurse On Call', 'LDNurseOnCall', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (15, 0, 'doctor_on_call', 'Doctor On Call', 'LDDoctorOnCall', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (16, 0, 'nurse', 'Nurse', 'LDNurse', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (17, 0, 'doctor', 'Doctor', 'LDDoctor', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_room`
#

INSERT INTO care_room VALUES (1, 2, '2003-04-27', '0000-00-00', 0, 1, 0, 0, 1, '', NULL, '', '', '', 20030427175459, '', 20030427175459);
INSERT INTO care_room VALUES (2, 2, '2003-04-27', '0000-00-00', 0, 2, 0, 0, 1, '', NULL, '', '', '', 20030427175704, '', 20030427175631);
INSERT INTO care_room VALUES (3, 2, '2003-04-27', '0000-00-00', 0, 3, 0, 0, 1, '', NULL, '', '', '', 20030427175813, '', 20030427175727);
INSERT INTO care_room VALUES (4, 2, '2003-04-27', '0000-00-00', 0, 4, 0, 0, 1, '', NULL, '', '', '', 20030427180021, '', 20030427175846);
INSERT INTO care_room VALUES (5, 2, '2003-04-27', '0000-00-00', 0, 5, 0, 0, 1, '', NULL, '', '', '', 20030427180132, '', 20030427175927);
INSERT INTO care_room VALUES (6, 2, '2003-04-27', '0000-00-00', 0, 6, 0, 0, 1, '', NULL, '', '', '', 20030427180122, '', 20030427180105);
INSERT INTO care_room VALUES (7, 2, '2003-04-27', '0000-00-00', 0, 7, 0, 0, 1, '', NULL, '', '', '', 20030427180310, '', 20030427180310);
INSERT INTO care_room VALUES (8, 2, '2003-04-27', '0000-00-00', 0, 8, 0, 0, 1, '', NULL, '', '', '', 20030427180350, '', 20030427180350);
INSERT INTO care_room VALUES (9, 2, '2003-04-27', '0000-00-00', 0, 9, 0, 0, 1, '', NULL, '', '', '', 20030427180433, '', 20030427180433);
INSERT INTO care_room VALUES (10, 2, '2003-04-27', '0000-00-00', 0, 10, 0, 0, 1, '', NULL, '', '', '', 20030427180503, '', 20030427180503);
INSERT INTO care_room VALUES (11, 2, '2003-04-27', '0000-00-00', 0, 11, 0, 0, 1, '', NULL, '', '', '', 20030427180636, '', 20030427180636);
INSERT INTO care_room VALUES (12, 2, '2003-04-27', '0000-00-00', 0, 12, 0, 0, 1, '', NULL, '', '', '', 20030427180759, '', 20030427180759);
INSERT INTO care_room VALUES (13, 2, '2003-04-27', '0000-00-00', 0, 13, 0, 0, 1, '', NULL, '', '', '', 20030427180826, '', 20030427180826);
INSERT INTO care_room VALUES (14, 2, '2003-04-27', '0000-00-00', 0, 14, 0, 0, 1, '', NULL, '', '', '', 20030427180852, '', 20030427180852);
INSERT INTO care_room VALUES (15, 2, '2003-04-27', '0000-00-00', 0, 15, 0, 0, 1, '', NULL, '', '', '', 20030427180918, '', 20030427180918);

#
# Daten f�r Tabelle `care_type_application`
#

INSERT INTO care_type_application VALUES (1, 5, 'ita', 'ITA', 'LDITA', 'Intratracheal anesthesia', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_application VALUES (2, 5, 'la', 'LA', 'LDLA', 'Locally applied anesthesia', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_application VALUES (3, 5, 'as', 'AS', 'LDAS', 'Analgesic sedation', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_application VALUES (4, 5, 'mask', 'Mask', 'LDMask', 'Gas anesthesia through breathing mask', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_application VALUES (5, 6, 'oral', 'Oral', 'LDOral', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_application VALUES (6, 6, 'iv', 'Intravenous', 'LDIntravenous', '', '', '', 00000000000000, 'preload', 00000000000000);
INSERT INTO care_type_application VALUES (7, 6, 'sc', 'Subcutaneous', 'LDSubcutaneous', '', '', '', 00000000000000, 'preload', 00000000000000);
INSERT INTO care_type_application VALUES (8, 6, 'im', 'Intramuscular', 'LDIntramuscular', '', '', '', 00000000000000, 'preload', 00000000000000);
INSERT INTO care_type_application VALUES (9, 6, 'sublingual', 'Sublingual', 'LDSublingual', 'Applied under the tounge', '', '', 00000000000000, 'preload', 00000000000000);
INSERT INTO care_type_application VALUES (10, 6, 'ia', 'Intraarterial', 'LDIntraArterial', '', '', '', 00000000000000, 'preload', 00000000000000);
INSERT INTO care_type_application VALUES (11, 6, 'pre_admit', 'Pre-admission', 'LDPreAdmission', '', '', '', 00000000000000, 'preload', 00000000000000);

#
# Daten f�r Tabelle `care_type_assignment`
#

INSERT INTO care_type_assignment VALUES (1, 'ward', 'Ward', 'LDWard', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_assignment VALUES (2, 'dept', 'Department', 'LDDepartment', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_assignment VALUES (3, 'firm', 'Firm', 'LDFirm', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_assignment VALUES (4, 'clinic', 'Clinic', 'LDClinic', '', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_type_cause_opdelay`
#

INSERT INTO care_type_cause_opdelay VALUES (1, 'patient', 'Patient was delayed', 'LDPatientDelayed', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_cause_opdelay VALUES (2, 'nurse', 'Nurses were delayed', 'LDNursesDelayed', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_cause_opdelay VALUES (3, 'surgeon', 'Surgeons were delayed', 'LDSurgeonsDelayed', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_cause_opdelay VALUES (4, 'cleaning', 'Cleaning delayed', 'LDCleaningDelayed', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_cause_opdelay VALUES (5, 'anesthesia', 'Anesthesiologist was delayed', 'LDAnesthesiologistDelayed', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_cause_opdelay VALUES (6, 'other', 'Other causes', 'LDOtherCauses', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_type_color`
#

INSERT INTO care_type_color VALUES ('yellow', 'yellow', 'LDyellow', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('black', 'black', 'LDblack', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('blue_pale', 'pale blue', 'LDpaleblue', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('brown', 'brown', 'LDbrown', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('pink', 'pink', 'LDpink', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('yellow_pale', 'pale yellow', 'LDpaleyellow', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('red', 'red', 'LDred', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('green_pale', 'pale green', 'LDpalegreen', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('violet', 'violet', 'LDviolet', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('blue', 'blue', 'LDblue', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('biege', 'biege', 'LDbiege', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('orange', 'orange', 'LDorange', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('green', 'green', 'LDgreen', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('rose', 'rose', 'LDrose', '', '', 00000000000000);

#
# Daten f�r Tabelle `care_type_department`
#

INSERT INTO care_type_department VALUES (1, 'medical', 'Medical', 'LDMedical', 'Medical, Nursing, Diagnostics, Labs, OR', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_department VALUES (2, 'support', 'Support (non-medical)', 'LDSupport', 'non-medical departments', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_department VALUES (3, 'news', 'News', 'LDNews', 'News group or category', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_type_discharge`
#

INSERT INTO care_type_discharge VALUES (1, 'regular', 'Regular discharge', 'LDRegularRelease', NULL, '', 20030415010555, '', 20030413121226);
INSERT INTO care_type_discharge VALUES (2, 'own', 'Patient left hospital on his own will', 'LDSelfRelease', NULL, '', 20030415010606, '', 20030413121317);
INSERT INTO care_type_discharge VALUES (3, 'emergency', 'Emergency discharge', 'LDEmRelease', NULL, '', 20030415010617, '', 20030413121452);
INSERT INTO care_type_discharge VALUES (4, 'change_ward', 'Change of ward', 'LDChangeWard', NULL, '', 00000000000000, '', 20030413121526);
INSERT INTO care_type_discharge VALUES (6, 'change_bed', 'Change of bed', 'LDChangeBed', NULL, '', 20030415000942, '', 20030413121619);
INSERT INTO care_type_discharge VALUES (7, 'death', 'Death of patient', 'LDPatientDied', NULL, '', 20030415010642, '', 00000000000000);
INSERT INTO care_type_discharge VALUES (5, 'change_room', 'Change of room', 'LDChangeRoom', NULL, '', 20030415010659, '', 00000000000000);

#
# Daten f�r Tabelle `care_type_duty`
#

INSERT INTO care_type_duty VALUES (1, 'regular', 'Regular duty', 'LDRegularDuty', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_duty VALUES (2, 'standby', 'Standby duty', 'LDStandbyDuty', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_duty VALUES (3, 'morning', 'Morning duty', 'LDMorningDuty', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_duty VALUES (4, 'afternoon', 'Afternoon duty', 'LDAfternoonDuty', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_duty VALUES (5, 'night', 'Night duty', 'LDNightDuty', '', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_type_encounter`
#

INSERT INTO care_type_encounter VALUES (1, 'referral', 'Referral', 'LDEncounterReferral', 'Referral admission or visit', 0, '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_encounter VALUES (2, 'emergency', 'Emergency', 'LDEmergency', 'Emergency admission or visit', 0, '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_encounter VALUES (3, 'birth_delivery', 'Birth delivery', 'LDBirthDelivery', 'Admission or visit for birth delivery', 0, '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_encounter VALUES (4, 'walk_in', 'Walk-in', 'LDWalkIn', 'Walk -in admission or visit (non-referred)', 0, '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_encounter VALUES (5, 'accident', 'Accident', 'LDAccident', 'Emergency admission due to accident', 0, '', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_type_ethnic_orig`
#

INSERT INTO care_type_ethnic_orig VALUES (1, 1, 'asian', 'LDAsian', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_ethnic_orig VALUES (2, 1, 'black', 'LDBlack', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_ethnic_orig VALUES (3, 1, 'caucasian', 'LDCaucasian', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_ethnic_orig VALUES (4, 1, 'white', 'LDWhite', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_type_event`
#

INSERT INTO care_type_event VALUES (1, 'request_test_patho', 'Pathological test request', 'LDPathoTestRequest', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (2, 'request_test_serology', 'Serology test request', 'LDSerologyTestRequest', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (3, 'request_test_radio', 'Radiological test  request', 'LDRadioTestRequest', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (4, 'request_test_ecg', 'ECG test request', 'LDEcgTestRequest', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (5, 'request_test_eeg', 'EEG test request', 'LDEegTestRequest', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (6, 'request_test_bact', 'Bacteriological test request', 'LDBactTestRequest', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (7, 'request_test_echo', 'Echocardiography test request', 'LDEchoTestRequest', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (8, 'request_test_blood', 'Blood test request', 'LDBloodTestRequest', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (9, 'request_draw_blood', 'Blood draw request', 'LDBloodDrawRequest', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (10, 'result_test_patho', 'Pathological test result', 'LDPathoTestResult', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (11, 'result_test_serology', 'Serological test result', 'LDSerologicalTestResult', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (12, 'result_test_radio', 'Radiological test result', 'LDRadioTestResult', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (13, 'result_test_ecg', 'ECG test result', 'LDEcgTestResult', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (14, 'result_test_eeg', 'EEG test result', 'LDEegTestResult', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (15, 'result_test_bact', 'Bacteriological test result', 'LDBactTestResult', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (16, 'result_test_echo', 'Echocardiography test result', 'LDEchoTestResult', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (17, 'result_test_blood', 'Blood test result', 'LDBloodTestResult', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (18, 'is_blood_drawn', 'Blood is drawn', 'LDBloodIsDrawn', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (19, 'nursing_report', 'New nursing report', 'LDNewNursingReport', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (20, 'effect_report', 'New effectivity report', 'LDNewEffectReport', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (21, 'directive', 'New doctor\'s directive', 'LDNewDoctorDirective', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (22, 'inquiry_doctor', 'New inquiry to doctor', 'LDNewInquiryDoctor', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (23, 'nursing_problem', 'New nursing problem', 'LDNewNursingProblem', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (24, 'anticoag_program', 'Anticoagulant program in progress', 'LDAnticoagProgramProgress', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (25, 'iv_tube', 'Intravenous tube in place', 'LDIVTubePlace', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (26, 'ia_tube', 'Intra-arterial tube in place', 'LDIATubePlace', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (27, 'cave', 'Cave', 'LDCave', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (28, 'monitor_fluids', 'Monitor fluid intake & discharge', 'LDMonitorFluids', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (29, 'intensive_care', 'Intensive care program', 'LDIntensiveCare', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (30, 'monitor_bpt_intensive', 'Intensive monitoring of bp & temp', 'LDIntensiveBPT', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (31, 'monitor_weight', 'Monitor weight', 'LDMonitorWeight', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (32, 'antibiotics_program', 'Antibiotics program', 'LDAntibioticsProgram', '', '', 00000000000000);
INSERT INTO care_type_event VALUES (33, 'monitor_bpt', 'Monitor blood pressure & temp', 'LDMonitorBPT', '', '', 00000000000000);

#
# Daten f�r Tabelle `care_type_feeding`
#

INSERT INTO care_type_feeding VALUES (1, 2, 'breast', 'Breast', 'LDBreast', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_feeding VALUES (2, 2, 'formula', 'Formula', 'LDFormula', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_feeding VALUES (3, 2, 'both', 'Both', 'LDBoth', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_feeding VALUES (4, 2, 'parenteral', 'Parenteral', 'LDPerenteral', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_feeding VALUES (5, 2, 'never_fed', 'Never fed', 'LDNeverFed', '', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_type_insurance`
#

INSERT INTO care_type_insurance VALUES (1, 'medical_main', 'Medical insurance', 'LDMedInsurance', 'Main (default) medical insurance', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (2, 'medical_extra', 'Extra medical insurance', 'LDExtraMedInsurance', 'Extra medical insurance (evt. pays extra services)', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (3, 'dental', 'Dental insurance', 'LDDentalInsurance', 'Separate dental plan in case not included in medical plan or simply additional private plan', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (4, 'disability', 'Disability plan', 'LDDisabilityPlan', 'Disability insurance plan - general , both long term & short term', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (5, 'disability_short', 'Disability plan (short term)', 'LDDisabilityPlanShort', 'Short term disability plan', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (6, 'disability_long', 'Disability plan (long term)', 'LDDisabilityPlanLong', 'Long term disability plan', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (7, 'retirement_income', 'Retirement  income plan (general)', 'LDRetirementIncomePlan', 'Retirement income plan - either private or income/employer supported', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (8, 'edu_reimbursement', 'Educational Reimbursement Plan', 'LDEduReimbursementPlan', 'Reimbursement plan for education, either private or employer supported', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (9, 'retirement_medical', 'Retirement medical plan', 'LDRetirementMedPlan', 'Medical plan in retirement  - might include other care services', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (10, 'liability', 'Liability Insurance Plan', 'LDLiabilityPlan', 'General liability insurance - either private or employer supported', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (11, 'malpractice', 'Malpractice Insurance Plan', 'LDMalpracticeInsurancePlan', 'Insurance plan against possible malpractice', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (12, 'unemployment', 'Unemployment Insurance Plan', 'LDUnemploymentPlan', 'Unemployment insurance , in case compulsory unemployment funds are guaranteed by the state, this plan is usually privately paid by the insured', '', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_type_localization`
#

INSERT INTO care_type_localization VALUES (1, 'left', 'Left', 'LDLeft', 'L', 'LDLeft_s', '', '0', '', '', '', 20030525150414, '', 20030525150414);
INSERT INTO care_type_localization VALUES (2, 'right', 'Right', 'LDRight', 'R', 'LDRight_s', '', '0', '', '', '', 20030525150522, '', 20030525150500);
INSERT INTO care_type_localization VALUES (3, 'both_side', 'Both sides', 'LDBothSides', 'B', 'LDBothSides_s', '', '0', '', '', '', 20030525150618, '', 20030525150618);

#
# Daten f�r Tabelle `care_type_location`
#

INSERT INTO care_type_location VALUES (1, 'dept', 'Department', 'LDDepartment', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_location VALUES (2, 'ward', 'Ward', 'LDWard', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_location VALUES (3, 'firm', 'Firm', 'LDFirm', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_location VALUES (4, 'room', 'Room', 'LDRoom', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_location VALUES (5, 'bed', 'Bed', 'LDBed', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_location VALUES (6, 'clinic', 'Clinic', 'LDClinic', '', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_type_measurement`
#

INSERT INTO care_type_measurement VALUES (1, 'bp_systolic', 'Systolic', 'LDSystolic', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_measurement VALUES (2, 'bp_diastolic', 'Diastolic', 'LDDiastolic', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_measurement VALUES (3, 'temp', 'Temperature', 'LDTemperature', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_measurement VALUES (4, 'fluid_intake', 'Fluid intake', 'LDFluidIntake', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_measurement VALUES (5, 'fluid_output', 'Fluid output', 'LDFluidOutput', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_measurement VALUES (6, 'weight', 'Weight', 'LDWeight', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_measurement VALUES (7, 'height', 'Height', 'LDHeight', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_measurement VALUES (8, 'bp_composite', 'Sys/Dias', 'LDSysDias', NULL, '', 20030419143920, '', 20030419143920);

#
# Daten f�r Tabelle `care_type_notes`
#

INSERT INTO care_type_notes VALUES (1, 'histo_physical', 'Admission History and Physical', 'LDAdmitHistoPhysical', 5, '', '', 20030517182939, '', 00000000000000);
INSERT INTO care_type_notes VALUES (2, 'daily_doctor', 'Doctor\'s daily notes', 'LDDoctorDailyNotes', 55, '', '', 20030517183835, '', 00000000000000);
INSERT INTO care_type_notes VALUES (3, 'discharge', 'Discharge summary', 'LDDischargeSummary', 50, '', '', 20030517183707, '', 00000000000000);
INSERT INTO care_type_notes VALUES (4, 'consult', 'Consultation notes', 'LDConsultNotes', 25, '', '', 20030517183151, '', 00000000000000);
INSERT INTO care_type_notes VALUES (5, 'op', 'Operation notes', 'LDOpNotes', 100, '', '', 20030517184314, '', 00000000000000);
INSERT INTO care_type_notes VALUES (6, 'daily_ward', 'Daily ward\'s notes', 'LDDailyNurseNotes', 30, '', '', 20030517183212, '', 00000000000000);
INSERT INTO care_type_notes VALUES (99, 'other', 'Other', 'LDOther', 105, '', '', 20030517184331, '', 00000000000000);
INSERT INTO care_type_notes VALUES (7, 'daily_chart_notes', 'Chart notes', 'LDChartNotes', 20, '', '', 20030517183141, '', 00000000000000);
INSERT INTO care_type_notes VALUES (8, 'chart_notes_etc', 'PT,ATG,etc. daily notes', 'LDPTATGetc', 115, '', '', 20030517184356, '', 00000000000000);
INSERT INTO care_type_notes VALUES (9, 'daily_iv_notes', 'IV daily notes', 'LDIVDailyNotes', 75, '', '', 20030517184024, '', 00000000000000);
INSERT INTO care_type_notes VALUES (10, 'daily_anticoag', 'Anticoagulant daily notes', 'LDAnticoagDailyNotes', 15, '', '', 20030517183117, '', 00000000000000);
INSERT INTO care_type_notes VALUES (11, 'lot_charge_nr', 'Material LOT, Charge Nr.', 'LDMaterialLOTChargeNr', 80, '', '', 20030517184039, '', 00000000000000);
INSERT INTO care_type_notes VALUES (12, 'text_diagnosis', 'Diagnosis text', 'LDDiagnosis', 40, '', '', 20030517183530, '', 00000000000000);
INSERT INTO care_type_notes VALUES (13, 'text_therapy', 'Therapy text', 'LDTherapy', 120, '', '', 20030517184408, '', 00000000000000);
INSERT INTO care_type_notes VALUES (14, 'chart_extra', 'Extra notes on therapy & diagnosis', 'LDExtraNotes', 65, '', '', 20030517183912, '', 00000000000000);
INSERT INTO care_type_notes VALUES (15, 'nursing_report', 'Nursing care report', 'LDNursingReport', 85, '', '', 20030517184141, '', 00000000000000);
INSERT INTO care_type_notes VALUES (16, 'nursing_problem', 'Nursing problem report', 'LDNursingProblemReport', 95, '', '', 20030517184208, '', 00000000000000);
INSERT INTO care_type_notes VALUES (17, 'nursing_effectivity', 'Nursing effectivity report', 'LDNursingEffectivityReport', 90, '', '', 20030517184156, '', 00000000000000);
INSERT INTO care_type_notes VALUES (18, 'nursing_inquiry', 'Inquiry to doctor', 'LDInquiryToDoctor', 70, '', '', 20030517183951, '', 00000000000000);
INSERT INTO care_type_notes VALUES (19, 'doctor_directive', 'Doctor\'s directive', 'LDDoctorDirective', 60, '', '', 20030517183859, '', 00000000000000);
INSERT INTO care_type_notes VALUES (20, 'problem', 'Problem', 'LDProblem', 110, '', '', 20030517184345, '', 00000000000000);
INSERT INTO care_type_notes VALUES (21, 'development', 'Development', 'LDDevelopment', 35, '', '', 20030517183228, '', 00000000000000);
INSERT INTO care_type_notes VALUES (22, 'allergy', 'Allergy', 'LDAllergy', 10, '', '', 20030517184439, '', 00000000000000);
INSERT INTO care_type_notes VALUES (23, 'daily_diet', 'Diet plan', 'LDDietPlan', 45, '', '', 20030517183545, '', 00000000000000);

#
# Daten f�r Tabelle `care_type_outcome`
#

INSERT INTO care_type_outcome VALUES (1, 2, 'alive', 'Alive', 'LDAlive', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_outcome VALUES (2, 2, 'stillborn', 'Stillborn', 'LDStillborn', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_outcome VALUES (3, 2, 'early_neonatal_death', 'Early neonatal death', 'LDEarlyNeonatalDeath', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_outcome VALUES (4, 2, 'late_neonatal_death', 'Late neonatal death', 'LDLateNeonatalDeath', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_outcome VALUES (5, 2, 'death_uncertain_timing', 'Death uncertain timing', 'LDDeathUncertainTiming', '', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_type_perineum`
#

INSERT INTO care_type_perineum VALUES (1, 'intact', 'Intact', 'LDIntact', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_perineum VALUES (2, '1_degree', 'First degree tear', 'LDFirstDegreeTear', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_perineum VALUES (3, '2_degree', 'Second degree tear', 'LDSecondDegreeTear', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_perineum VALUES (4, '3_degree', 'Third degree tear', 'LDThirdDegreeTear', '', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_type_prescription`
#

INSERT INTO care_type_prescription VALUES (1, 'anticoag', 'Anticoagulant', 'LDAnticoagulant', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_prescription VALUES (2, 'hemolytic', 'Hemolytic', 'LDHemolytic', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_prescription VALUES (3, 'diuretic', 'Diuretic', 'LDDiuretic', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_prescription VALUES (4, 'antibiotic', 'Antibiotic', 'LDAntibiotic', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_type_room`
#

INSERT INTO care_type_room VALUES (1, 'ward', 'Ward room', 'LDWard', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_room VALUES (2, 'op', 'Operating room', 'LDOperatingRoom', '', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_type_test`
#

INSERT INTO care_type_test VALUES (1, 'chemlabor', 'Chemical-Serology Lab', 'LDChemSerologyLab', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_test VALUES (2, 'patho', 'Pathological Lab', 'LDPathoLab', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_test VALUES (3, 'baclabor', 'Bacteriological Lab', 'LDBacteriologicalLab', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_test VALUES (4, 'radio', 'Radiological Lab', 'LDRadiologicalLab', 'Lab for X-ray, Mammography, Computer Tomography, NMR', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_test VALUES (5, 'blood', 'Blood test & product', 'LDBloodTestProduct', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_test VALUES (6, 'generic', 'Generic test program', 'LDGenericTestProgram', '', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_type_time`
#

INSERT INTO care_type_time VALUES (1, 'patient_entry_exit', 'Patient entry/exit', 'LDPatientEntryExit', 'Times when patient entered and left the op room', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_time VALUES (2, 'op_start_end', 'OP start/end', 'LDOPStartEnd', 'Times when op started (1st incision) and ended (last suture)', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_time VALUES (3, 'delay', 'Delay time', 'LDDelayTime', 'Times when the op was delayed due to any reason', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_time VALUES (4, 'plaster_cast', 'Plaster cast', 'LDPlasterCast', 'Times when the plaster cast was made', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_time VALUES (5, 'reposition', 'Reposition', 'LDReposition', 'Times when a dislocated joint(s) was repositioned (non invasive op)', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_time VALUES (6, 'coro', 'Coronary catheter', 'LDCoronaryCatheter', 'Times when a coronary catherer op was done (minimal invasive op)', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_time VALUES (7, 'bandage', 'Bandage', 'LDBandage', 'Times when the bandage was made', '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_type_unit_measurement`
#

INSERT INTO care_type_unit_measurement VALUES (1, 'volume', 'Volume', 'LDVolume', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_unit_measurement VALUES (2, 'weight', 'Weight', 'LDWeight', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_unit_measurement VALUES (3, 'length', 'Length', 'LDLength', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_unit_measurement VALUES (4, 'pressure', 'Pressure', 'LDPressure', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_unit_measurement VALUES (5, 'temperature', 'Temperature', 'LDTemperature', '', '', '', 20030419144724, '', 20030419144724);

#
# Daten f�r Tabelle `care_unit_measurement`
#

INSERT INTO care_unit_measurement VALUES (1, 1, 'ml', 'Milliliter', 'LDMilliliter', 'metric', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (2, 2, 'mg', 'Milligram', 'LDMilligram', 'metric', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (3, 3, 'mm', 'Millimeter', 'LDMillimeter', 'metric', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (4, 1, 'liter', 'liter', 'LDLiter', 'metric', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (5, 2, 'gm', 'gram', 'LDGram', 'metric', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (6, 2, 'kg', 'kilogram', 'LDKilogram', 'metric', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (7, 3, 'cm', 'centimeter', 'LDCentimeter', 'metric', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (8, 3, 'm', 'meter', 'LDMeter', 'metric', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (9, 3, 'km', 'kilometer', 'LDKilometer', 'metric', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (10, 3, 'in', 'inch', 'LDInch', 'english', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (11, 3, 'ft', 'foot', 'LDFoot', 'english', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (12, 3, 'yd', 'yard', 'LDYard', 'english', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (14, 4, 'mmHg', 'mmHg', 'LDmmHg', 'metric', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (15, 5, 'celsius', 'Celsius', 'LDCelsius', 'metric', NULL, '', '', 00000000000000, '', 00000000000000);

#
# Daten f�r Tabelle `care_version`
#

INSERT INTO care_version VALUES ('care 2002', 'beta (pre-release)', '1.01.04', '1.0', '2003-03-31', '00:00:00', 'Elpidio Latorilla');

#
# Daten f�r Tabelle care_config_user
#

INSERT INTO care_config_user VALUES ('default', 'a:19:{s:4:"mask";s:1:"1";s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:0:"";s:8:"bversion";s:0:"";s:2:"ip";s:0:"";s:3:"cid";s:0:"";s:5:"dhtml";s:1:"1";s:4:"lang";s:0:"";}',  NULL,  NULL,  NULL, '', 20030210161831, '', 00000000000000);

#
# Daten f�r Tabelle care_users
#

INSERT INTO care_users VALUES ('admin', 'admin', 'admin', 0, '0', 'System_Admin', '1', '0000-00-00', '00:00:00', '2003-07-27', '00:00:00', '', '', '', 20030427205316, '', 00000000000000);
