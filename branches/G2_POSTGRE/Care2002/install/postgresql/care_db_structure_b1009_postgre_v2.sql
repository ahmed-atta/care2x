-- 1
-- DROP TABLE "care_address_citytown";
CREATE TABLE "care_address_citytown" (
    "nr" integer NOT NULL DEFAULT nextval('"addr_ct_nr_seq"'::text),
    "unece_modifier" character(2),
    "unece_locode" character varying(15),
    "name" character varying(100) NOT NULL,
    "iso_country_id" character(3) NOT NULL,
    "unece_locode_type" smallint,
    "unece_coordinates" character varying(25),
    "info_url" character varying(255),
    "use_frequency" bigint DEFAULT '0',
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "addr_ct_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE addr_ct_nr_seq;

-- Indexes

CREATE INDEX addr_ct_name ON care_address_citytown USING btree (name);

-- 2
-- DROP TABLE "care_appointment";
CREATE TABLE "care_appointment" (
    "nr" bigint NOT NULL DEFAULT nextval('"appt_nr_seq"'::text),
    "pid" bigint DEFAULT '0',
    "date" date DEFAULT '0001-01-01',
    "time" time without time zone DEFAULT '00:00:00',
    "to_dept_id" character varying(25) NOT NULL,
    "to_dept_nr" smallint DEFAULT '0',
    "to_personell_nr" bigint DEFAULT '0',
    "to_personell_name" character varying(60),
    "purpose" text NOT NULL,
    "urgency" smallint DEFAULT '0',
    "remind" smallint DEFAULT '0',
    "remind_email" smallint DEFAULT '0',
    "remind_mail" smallint DEFAULT '0',
    "remind_phone" smallint DEFAULT '0',
    "appt_status" character varying(35) DEFAULT 'pending',
    "cancel_by" character varying(255) NOT NULL,
    "cancel_date" date,
    "cancel_reason" character varying(255),
    "encounter_class_nr" smallint DEFAULT '0',
    "encounter_nr" bigint DEFAULT '0',
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "appt_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE appt_nr_seq;

-- Indexes

CREATE INDEX appt_pid ON care_appointment USING btree (pid);

-- 3
-- DROP TABLE "care_billing_archive";
CREATE TABLE "care_billing_archive" (
    "bill_no" bigint NOT NULL DEFAULT '0',
    "encounter_nr" bigint DEFAULT '0',
    "patient_name" text NOT NULL,
    "vorname" character varying(35) DEFAULT '0',
    "bill_date_time" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
    "bill_amt" double precision DEFAULT '0.0000',
    "payment_date_time" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
    "payment_mode" text NOT NULL,
    "cheque_no" character varying(10) DEFAULT '0',
    "creditcard_no" character varying(10) DEFAULT '0',
    "paid_by" character varying(15) DEFAULT '0',
    CONSTRAINT "bill_arch_pkey" PRIMARY KEY ("bill_no")
) WITH OIDS;

-- 4
-- DROP TABLE "care_billing_bill";
CREATE TABLE "care_billing_bill" (
    "bill_bill_no" bigint NOT NULL DEFAULT '0',
    "bill_encounter_nr" bigint DEFAULT '0',
    "bill_date_time" date NOT NULL,
    "bill_amount" real,
    "bill_outstanding" real,
    CONSTRAINT "bill_bill_pkey" PRIMARY KEY ("bill_bill_no")
) WITH OIDS;


-- Indexes

CREATE INDEX bill_bill_enr ON care_billing_bill USING btree (bill_encounter_nr);

-- 5
-- DROP TABLE "care_billing_bill_item";
CREATE TABLE "care_billing_bill_item" (
    "bill_item_id" integer NOT NULL DEFAULT nextval('"bill_item_id_seq"'::text),
    "bill_item_encounter_nr" bigint DEFAULT '0',
    "bill_item_code" character varying(5) NOT NULL,
    "bill_item_unit_cost" real DEFAULT '0.00',
    "bill_item_units" smallint NOT NULL,
    "bill_item_amount" real,
    "bill_item_date" timestamp with time zone NOT NULL,
    "bill_item_status" character varying(1),
    "bill_item_bill_no" integer DEFAULT '0',
    CONSTRAINT "bill_item_status" CHECK (((lower((bill_item_status)::text) = '0'::text) OR (lower((bill_item_status)::text) = '1'::text))),
    CONSTRAINT "bill_item_pkey" PRIMARY KEY ("bill_item_id")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE bill_item_id_seq;

-- Indexes

CREATE INDEX bill_item_bill_no ON care_billing_bill_item USING btree (bill_item_bill_no);
CREATE INDEX bill_item_enr ON care_billing_bill_item USING btree (bill_item_encounter_nr);


-- 6
-- DROP TABLE "care_billing_final";
CREATE TABLE "care_billing_final" (
    "final_id" integer NOT NULL DEFAULT nextval('"bill_final_id_seq"'::text),
    "final_encounter_nr" bigint DEFAULT '0',
    "final_bill_no" integer NOT NULL,
    "final_date" date NOT NULL,
    "final_total_bill_amount" real,
    "final_discount" smallint NOT NULL,
    "final_total_receipt_amount" real,
    "final_amount_due" real,
    "final_amount_recieved" real,
    CONSTRAINT "bill_final_pkey" PRIMARY KEY ("final_id")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE bill_final_id_seq;

-- Indexes

CREATE INDEX bill_final_enr ON care_billing_final USING btree (final_encounter_nr);

-- 7
-- DROP TABLE "care_billing_item";
CREATE TABLE "care_billing_item" (
    "item_code" character varying(5) NOT NULL,
    "item_description" character varying(100) NOT NULL,
    "item_unit_cost" real DEFAULT '0.00',
    "item_type" text NOT NULL,
    "item_discount_max_allowed" smallint DEFAULT '0',
    CONSTRAINT "billing_item_pkey" PRIMARY KEY ("item_code")
) WITH OIDS;

-- 8
-- DROP TABLE "care_billing_payment";
CREATE TABLE "care_billing_payment" (
    "payment_id" integer NOT NULL DEFAULT nextval('"bill_pay_id_seq"'::text),
    "payment_encounter_nr" bigint DEFAULT '0',
    "payment_receipt_no" integer DEFAULT '0',
    "payment_date" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
    "payment_cash_amount" real DEFAULT '0.00',
    "payment_cheque_no" integer DEFAULT '0',
    "payment_cheque_amount" real DEFAULT '0.00',
    "payment_creditcard_no" integer DEFAULT '0',
    "payment_creditcard_amount" real DEFAULT '0.00',
    "payment_amount_total" real DEFAULT '0.00',
    CONSTRAINT "bill_pay_pkey" PRIMARY KEY ("payment_id")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE bill_pay_id_seq;

-- Indexes

CREATE INDEX bill_pay_enr ON care_billing_payment USING btree (payment_encounter_nr);
CREATE INDEX bill_pay_rcptnr ON care_billing_payment USING btree (payment_receipt_no);


-- 9
-- DROP TABLE "care_cache";
CREATE TABLE "care_cache" (
    "id" character varying(125) NOT NULL,
    "ctext" text NOT NULL,
    "cbinary" bytea,
    "tstamp" timestamp with time zone NOT NULL,
    CONSTRAINT "cache_pkey" PRIMARY KEY ("id")
) WITH OIDS;

-- 10
-- DROP TABLE "care_cafe_menu";
CREATE TABLE "care_cafe_menu" (
    "item" integer NOT NULL DEFAULT nextval('"cafe_menu_item_seq"'::text),
    "lang" character varying(10) DEFAULT 'en',
    "cdate" date DEFAULT '0001-01-01',
    "menu" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "menu_item_pkey" PRIMARY KEY ("item")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE cafe_menu_item_seq;

-- Indexes
CREATE INDEX cafe_cdate ON care_cafe_menu USING btree (cdate);

-- 11
-- DROP TABLE "care_cafe_prices";
CREATE TABLE "care_cafe_prices" (
    "item" integer NOT NULL DEFAULT nextval('"cafe_prices_item_seq"'::text),
    "lang" character varying(10) DEFAULT 'en',
    "productgroup" text NOT NULL,
    "article" text NOT NULL,
    "description" text NOT NULL,
    "price" character varying(10) NOT NULL,
    "unit" text NOT NULL,
    "pic_filename" text NOT NULL,
    "modify_id" character varying(25) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(25) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "cafe_prices_item_pkey" PRIMARY KEY ("item")
) WITH OIDS;


-- Sequence
CREATE SEQUENCE cafe_prices_item_seq;


-- 12
-- DROP TABLE "care_category_diagnosis";
CREATE TABLE "care_category_diagnosis" (
    "nr" smallint NOT NULL DEFAULT nextval('"cat_diag_nr_seq"'::text),
    "category" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "short_code" character(1) NOT NULL,
    "ld_var_short_code" character varying(25) NOT NULL,
    "description" character varying(255) NOT NULL,
    "hide_from" character varying(255) DEFAULT '0',
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "cat_diag_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE cat_diag_nr_seq;

-- 13
-- DROP TABLE "care_category_disease";
CREATE TABLE "care_category_disease" (
    "nr" smallint NOT NULL DEFAULT nextval('"cat_disease_nr_seq"'::text),
    "group_nr" smallint DEFAULT '0',
    "category" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "cat_disease_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE cat_disease_nr_seq;

-- 14
-- DROP TABLE "care_category_procedure";
CREATE TABLE "care_category_procedure" (
    "nr" smallint NOT NULL DEFAULT nextval('"cat_proc_nr_seq"'::text),
    "category" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "short_code" character(1) NOT NULL,
    "ld_var_short_code" character varying(25) NOT NULL,
    "description" character varying(255) NOT NULL,
    "hide_from" character varying(255) DEFAULT '0',
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "cat_proc_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE cat_proc_nr_seq;

-- 15
-- DROP TABLE "care_class_encounter";
CREATE TABLE "care_class_encounter" (
    "class_nr" smallint NOT NULL DEFAULT nextval('"class_enc_nr_seq"'::text),
    "class_id" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(25) NOT NULL,
    "description" character varying(255) NOT NULL,
    "hide_from" smallint DEFAULT '0',
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "class_enc_pkey" PRIMARY KEY ("class_nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE class_enc_nr_seq;

-- 16
-- DROP TABLE "care_class_ethnic_orig";
CREATE TABLE "care_class_ethnic_orig" (
    "nr" smallint NOT NULL DEFAULT nextval('"class_eorig_nr_seq"'::text),
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "class_eorig_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE class_eorig_nr_seq;

-- 17
-- DROP TABLE "care_class_financial";
CREATE TABLE "care_class_financial" (
    "class_nr" smallint NOT NULL DEFAULT nextval('"class_fin_nr_seq"'::text),
    "class_id" character varying(15) DEFAULT '0',
    "type" character varying(25) DEFAULT '0',
    "code" character varying(5) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(25) NOT NULL,
    "description" character varying(255) NOT NULL,
    "policy" text NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "class_fin_pkey" PRIMARY KEY ("class_nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE class_fin_nr_seq;

-- Indexes
CREATE INDEX class_fin_id ON care_class_financial USING btree (class_id);

-- 18
-- DROP TABLE "care_class_insurance";
CREATE TABLE "care_class_insurance" (
    "class_nr" smallint NOT NULL DEFAULT nextval('"class_ins_nr_seq"'::text),
    "class_id" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(25) NOT NULL,
    "description" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "class_ins_pkey" PRIMARY KEY ("class_nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE class_ins_nr_seq;

-- 19
-- DROP TABLE "care_class_therapy";
CREATE TABLE "care_class_therapy" (
    "nr" smallint NOT NULL DEFAULT nextval('"class_ther_nr_seq"'::text),
    "group_nr" smallint DEFAULT '0',
    "class" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(25) NOT NULL,
    "description" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "class_ther_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE class_ther_nr_seq;

-- 20
-- DROP TABLE "care_classif_neonatal";
CREATE TABLE "care_classif_neonatal" (
    "nr" smallint NOT NULL DEFAULT nextval('"classif_neo_nr_seq"'::text),
    "id" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "description" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "classif_neo_pkey" PRIMARY KEY ("nr"),
    CONSTRAINT "classif_id" UNIQUE ("id")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE classif_neo_nr_seq;


-- 21
-- DROP TABLE "care_complication";
CREATE TABLE "care_complication" (
    "nr" smallint NOT NULL DEFAULT nextval('"complic_nr_seq"'::text),
    "group_nr" smallint DEFAULT '0',
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "code" character varying(25) NOT NULL,
    "description" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "complic_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE complic_nr_seq;

-- 22
-- DROP TABLE "care_config_global";
CREATE TABLE "care_config_global" (
    "type" character varying(60) NOT NULL,
    "value" character varying(255) NOT NULL,
    "notes" character varying(255),
    "status" character varying(25) NOT NULL,
    "history" text,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "config_global_pkey" PRIMARY KEY ("type")
) WITH OIDS;

-- 23
-- DROP TABLE "care_config_user";
CREATE TABLE "care_config_user" (
    "user_id" character varying(100) NOT NULL,
    "serial_config_data" text NOT NULL,
    "notes" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "config_user_pkey" PRIMARY KEY ("user_id")
) WITH OIDS;

-- 24
-- DROP TABLE "care_currency";
CREATE TABLE "care_currency" (
    "item_no" smallint NOT NULL DEFAULT nextval('"cur_item_no_seq"'::text),
    "short_name" character varying(10) NOT NULL,
    "long_name" character varying(20) NOT NULL,
    "info" character varying(50) NOT NULL,
    "status" character varying(5) NOT NULL,
    "modify_id" character varying(20) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(20) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "cur_item_no_pkey" PRIMARY KEY ("item_no")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE cur_item_no_seq;

-- Indexes

CREATE INDEX cur_s_name ON care_currency USING btree (short_name);

-- 25
-- DROP TABLE "care_department";
CREATE TABLE "care_department" (
    "nr" smallint NOT NULL DEFAULT nextval('"dept_nr_seq"'::text),
    "id" character varying(60) NOT NULL,
    "type" character varying(25) NOT NULL,
    "name_formal" character varying(60) NOT NULL,
    "name_short" character varying(35) NOT NULL,
    "name_alternate" character varying(225) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "description" text NOT NULL,
    "admit_inpatient" smallint DEFAULT '0',
    "admit_outpatient" smallint DEFAULT '0',
    "has_oncall_doc" smallint DEFAULT '1',
    "has_oncall_nurse" smallint DEFAULT '1',
    "does_surgery" smallint DEFAULT '0',
    "this_institution" smallint DEFAULT '1',
    "is_sub_dept" smallint DEFAULT '0',
    "parent_dept_nr" smallint NOT NULL,
    "work_hours" character varying(100) NOT NULL,
    "consult_hours" character varying(100) NOT NULL,
    "is_inactive" smallint DEFAULT '0',
    "sort_order" smallint DEFAULT '0',
    "address" text NOT NULL,
    "sig_line" character varying(60) NOT NULL,
    "sig_stamp" text NOT NULL,
    "logo_mime_type" character varying(5) NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "care_department_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE dept_nr_seq;
-- Index
CREATE UNIQUE INDEX dept_id ON care_department USING btree (id);

-- 26
-- DROP TABLE "care_diagnosis_localcode";
CREATE TABLE "care_diagnosis_localcode" (
    "localcode" character varying(12) NOT NULL,
    "description" text NOT NULL,
    "class_sub" character varying(5) NOT NULL,
    "type" character varying(10) NOT NULL,
    "inclusive" text NOT NULL,
    "exclusive" text NOT NULL,
    "notes" text NOT NULL,
    "std_code" character(1) NOT NULL,
    "sub_level" smallint DEFAULT '0',
    "remarks" text NOT NULL,
    "extra_codes" text NOT NULL,
    "extra_subclass" text NOT NULL,
    "search_keys" character varying(255) NOT NULL,
    "use_frequency" integer DEFAULT '0',
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "diag_localcode_pkey" PRIMARY KEY ("localcode")
) WITH OIDS;

-- 27
-- DROP TABLE "care_drg_intern";
CREATE TABLE "care_drg_intern" (
    "nr" integer NOT NULL DEFAULT nextval('"drg_int_nr_seq"'::text),
    "code" character varying(12) NOT NULL,
    "description" text NOT NULL,
    "synonyms" text NOT NULL,
    "notes" text NOT NULL,
    "std_code" character(1) NOT NULL,
    "sub_level" smallint DEFAULT '0',
    "parent_code" character varying(12) NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(25) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(25) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "drg_int_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE drg_int_nr_seq;

-- Indexes
CREATE INDEX drg_int_code ON care_drg_intern USING btree (code);

-- 28
-- DROP TABLE "care_drg_quicklist";
CREATE TABLE "care_drg_quicklist" (
    "nr" integer NOT NULL DEFAULT nextval('"drg_qlist_nr_seq"'::text),
    "code" character varying(25) NOT NULL,
    "code_parent" character varying(25) NOT NULL,
    "dept_nr" smallint DEFAULT '0',
    "qlist_type" character varying(25) DEFAULT '0',
    "rank" integer DEFAULT '0',
    "status" character varying(15) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(25) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(25) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "drg_qlist_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE drg_qlist_nr_seq;

-- 29
-- DROP TABLE "care_drg_related_codes";
CREATE TABLE "care_drg_related_codes" (
    "nr" integer NOT NULL DEFAULT nextval('"drg_relcodes_nr_seq"'::text),
    "group_nr" smallint DEFAULT '0',
    "code" character varying(15) NOT NULL,
    "code_parent" character varying(15) NOT NULL,
    "code_type" character varying(15) NOT NULL,
    "rank" integer DEFAULT '0',
    "status" character varying(15) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(25) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(25) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "drg_relcodes_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE drg_relcodes_nr_seq;

-- 30
-- DROP TABLE "care_dutyplan_oncall";
CREATE TABLE "care_dutyplan_oncall" (
    "nr" bigint NOT NULL DEFAULT nextval('"oncall_nr_seq"'::text),
    "dept_nr" smallint DEFAULT '0',
    "role_nr" smallint DEFAULT '0',
    "year" integer,
    "month" character(2) NOT NULL,
    "duty_1_txt" text NOT NULL,
    "duty_2_txt" text NOT NULL,
    "duty_1_pnr" text NOT NULL,
    "duty_2_pnr" text NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "oncall_pkey" PRIMARY KEY ("nr"),
    CONSTRAINT "oncall_year" CHECK ((("year" = 0) OR (("year" > 1900) AND ("year" < 2155))))
) WITH OIDS;

-- Sequence
CREATE SEQUENCE oncall_nr_seq;

-- Indexes

CREATE INDEX oncall_dept_nr ON care_dutyplan_oncall USING btree (dept_nr);

-- 31
-- DROP TABLE "care_effective_day";
CREATE TABLE "care_effective_day" (
    "eff_day_nr" integer NOT NULL DEFAULT nextval('"effday_nr_seq"'::text),
    "name" character varying(25) NOT NULL,
    "description" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "effday_pkey" PRIMARY KEY ("eff_day_nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE effday_nr_seq;

-- 32
-- DROP TABLE "care_encounter";
CREATE TABLE "care_encounter" (
    "encounter_nr" bigint NOT NULL DEFAULT nextval('"enc_enc_nr_seq"'::text),
    "pid" bigint DEFAULT '0',
    "encounter_date" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
    "encounter_class_nr" smallint DEFAULT '0',
    "encounter_type" character varying(35) NOT NULL,
    "encounter_status" character varying(35) NOT NULL,
    "referrer_diagnosis" character varying(255) NOT NULL,
    "referrer_recom_therapy" character varying(255) NOT NULL,
    "referrer_dr" character varying(60) NOT NULL,
    "referrer_dept" character varying(255) NOT NULL,
    "referrer_institution" character varying(255) NOT NULL,
    "referrer_notes" text NOT NULL,
    "financial_class_nr" smallint DEFAULT '0',
    "insurance_nr" character varying(25) DEFAULT '0',
    "insurance_firm_id" character varying(25) DEFAULT '0',
    "insurance_class_nr" smallint DEFAULT '0',
    "insurance_2_nr" character varying(25) DEFAULT '0',
    "insurance_2_firm_id" character varying(25) DEFAULT '0',
    "guarantor_pid" bigint DEFAULT '0',
    "contact_pid" bigint DEFAULT '0',
    "contact_relation" character varying(35) NOT NULL,
    "current_ward_nr" smallint DEFAULT '0',
    "current_room_nr" smallint DEFAULT '0',
    "in_ward" smallint DEFAULT '0',
    "current_dept_nr" smallint DEFAULT '0',
    "in_dept" smallint DEFAULT '0',
    "current_firm_nr" smallint DEFAULT '0',
    "current_att_dr_nr" integer DEFAULT '0',
    "consulting_dr" character varying(60) NOT NULL,
    "extra_service" character varying(25) NOT NULL,
    "is_discharged" smallint DEFAULT '0',
    "discharge_date" date NOT NULL,
    "discharge_time" time without time zone NOT NULL,
    "followup_date" date DEFAULT '0001-01-01',
    "followup_responsibility" character varying(255) NOT NULL,
    "post_encounter_notes" text NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "encounter_pkey" PRIMARY KEY ("encounter_nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE enc_enc_nr_seq;

-- Indexes

CREATE INDEX encounter_date ON care_encounter USING btree (encounter_date);
CREATE INDEX encounter_pid ON care_encounter USING btree (pid);


-- 33
-- DROP TABLE "care_encounter_diagnosis";
CREATE TABLE "care_encounter_diagnosis" (
    "diagnosis_nr" integer NOT NULL DEFAULT nextval('"enc_diag_nr_seq"'::text),
    "encounter_nr" bigint DEFAULT '0',
    "op_nr" integer DEFAULT '0',
    "date" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
    "code" character varying(25) NOT NULL,
    "code_parent" character varying(25) NOT NULL,
    "group_nr" smallint DEFAULT '0',
    "code_version" smallint DEFAULT '0',
    "localcode" character varying(35) NOT NULL,
    "category_nr" smallint DEFAULT '0',
    "type" character varying(35) NOT NULL,
    "localization" character varying(35) NOT NULL,
    "diagnosing_clinician" character varying(60) NOT NULL,
    "diagnosing_dept_nr" smallint DEFAULT '0',
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "enc_diag_pkey" PRIMARY KEY ("diagnosis_nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE enc_diag_nr_seq;

-- Indexes

CREATE INDEX enc_diag_nr ON care_encounter_diagnosis USING btree (encounter_nr);

-- 34
-- DROP TABLE "care_encounter_diagnostics_report";
CREATE TABLE "care_encounter_diagnostics_report" (
    "item_nr" integer NOT NULL DEFAULT nextval('"enc_rep_item_nr_seq"'::text),
    "report_nr" integer NOT NULL DEFAULT '0',
    "reporting_dept_nr" smallint DEFAULT '0',
    "reporting_dept" character varying(100) NOT NULL,
    "report_date" date DEFAULT '0001-01-01',
    "report_time" time without time zone DEFAULT '00:00:00',
    "encounter_nr" bigint DEFAULT '0',
    "script_call" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "enc_rep_pkey" PRIMARY KEY ("item_nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE enc_rep_item_nr_seq;

-- Indexes

CREATE INDEX enc_report_nr ON care_encounter_diagnostics_report USING btree (report_nr);

-- 35
-- DROP TABLE "care_encounter_drg_intern";
CREATE TABLE "care_encounter_drg_intern" (
    "nr" integer NOT NULL DEFAULT nextval('"enc_drg_int_nr_seq"'::text),
    "encounter_nr" bigint DEFAULT '0',
    "date" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
    "group_nr" integer DEFAULT '0',
    "clinician" character varying(60) NOT NULL,
    "dept_nr" smallint DEFAULT '0',
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "enc_drg_int_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE enc_drg_int_nr_seq;
-- Index
CREATE INDEX enc_drg_int_nr ON care_encounter_drg_intern USING btree (encounter_nr);

-- 36
-- DROP TABLE "care_encounter_event_signaller";
CREATE TABLE "care_encounter_event_signaller" (
    "encounter_nr" bigint NOT NULL DEFAULT '0',
    "yellow" smallint DEFAULT '0',
    "black" smallint DEFAULT '0',
    "blue_pale" smallint DEFAULT '0',
    "brown" smallint DEFAULT '0',
    "pink" smallint DEFAULT '0',
    "yellow_pale" smallint DEFAULT '0',
    "red" smallint DEFAULT '0',
    "green_pale" smallint DEFAULT '0',
    "violet" smallint DEFAULT '0',
    "blue" smallint DEFAULT '0',
    "biege" smallint DEFAULT '0',
    "orange" smallint DEFAULT '0',
    "green_1" smallint DEFAULT '0',
    "green_2" smallint DEFAULT '0',
    "green_3" smallint DEFAULT '0',
    "green_4" smallint DEFAULT '0',
    "green_5" smallint DEFAULT '0',
    "green_6" smallint DEFAULT '0',
    "green_7" smallint DEFAULT '0',
    "rose_1" smallint DEFAULT '0',
    "rose_2" smallint DEFAULT '0',
    "rose_3" smallint DEFAULT '0',
    "rose_4" smallint DEFAULT '0',
    "rose_5" smallint DEFAULT '0',
    "rose_6" smallint DEFAULT '0',
    "rose_7" smallint DEFAULT '0',
    "rose_8" smallint DEFAULT '0',
    "rose_9" smallint DEFAULT '0',
    "rose_10" smallint DEFAULT '0',
    "rose_11" smallint DEFAULT '0',
    "rose_12" smallint DEFAULT '0',
    "rose_13" smallint DEFAULT '0',
    "rose_14" smallint DEFAULT '0',
    "rose_15" smallint DEFAULT '0',
    "rose_16" smallint DEFAULT '0',
    "rose_17" smallint DEFAULT '0',
    "rose_18" smallint DEFAULT '0',
    "rose_19" smallint DEFAULT '0',
    "rose_20" smallint DEFAULT '0',
    "rose_21" smallint DEFAULT '0',
    "rose_22" smallint DEFAULT '0',
    "rose_23" smallint DEFAULT '0',
    "rose_24" smallint DEFAULT '0',
    CONSTRAINT "enc_event_sig_pkey" PRIMARY KEY ("encounter_nr")
) WITH OIDS;

-- 37
-- DROP TABLE "care_encounter_financial_class";
CREATE TABLE "care_encounter_financial_class" (
    "nr" bigint NOT NULL DEFAULT nextval('"enc_fin_nr_seq"'::text),
    "encounter_nr" bigint DEFAULT '0',
    "class_nr" smallint DEFAULT '0',
    "date_start" date NOT NULL,
    "date_end" date NOT NULL,
    "date_create" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "enc_fin_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE enc_fin_nr_seq;

-- 38
-- DROP TABLE "care_encounter_image";
CREATE TABLE "care_encounter_image" (
    "nr" bigint NOT NULL DEFAULT nextval('"enc_img_nr_seq"'::text),
    "encounter_nr" bigint DEFAULT '0',
    "shot_date" date DEFAULT '0001-01-01',
    "shot_nr" smallint DEFAULT '0',
    "mime_type" character varying(10) NOT NULL,
    "upload_date" date DEFAULT '0001-01-01',
    "notes" text NOT NULL,
    "graphic_script" text NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "enc_img_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE enc_img_nr_seq;

CREATE INDEX enc_img_enc_nr ON care_encounter_image USING btree (encounter_nr);

-- 39
-- DROP TABLE "care_encounter_immunization";
CREATE TABLE "care_encounter_immunization" (
    "nr" integer NOT NULL DEFAULT nextval('"enc_imm_nr_seq"'::text),
    "encounter_nr" bigint DEFAULT '0',
    "date" date DEFAULT '0001-01-01',
    "type" character varying(60) NOT NULL,
    "medicine" character varying(60) NOT NULL,
    "dosage" character varying(60) NOT NULL,
    "application_type_nr" smallint DEFAULT '0',
    "application_by" character varying(60) NOT NULL,
    "titer" character varying(15) NOT NULL,
    "refresh_date" date NOT NULL,
    "notes" text NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "enc_imm_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE enc_imm_nr_seq;

-- 40
-- DROP TABLE "care_encounter_location";
CREATE TABLE "care_encounter_location" (
    "nr" integer NOT NULL DEFAULT nextval('"enc_loc_nr_seq"'::text),
    "encounter_nr" bigint DEFAULT '0',
    "type_nr" smallint DEFAULT '0',
    "location_nr" smallint NOT NULL DEFAULT '0',
    "group_nr" smallint DEFAULT '0',
    "date_from" date DEFAULT '0001-01-01',
    "date_to" date DEFAULT '0001-01-01',
    "time_from" time without time zone DEFAULT '00:00:00',
    "time_to" time without time zone NOT NULL,
    "discharge_type_nr" smallint DEFAULT '0',
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "enc_loc_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE enc_loc_nr_seq;

-- Indexes

CREATE INDEX enc_loc_nr ON care_encounter_location USING btree (location_nr);
CREATE INDEX enc_loc_type ON care_encounter_location USING btree (type_nr);
-- 41
-- DROP TABLE "care_encounter_measurement";
CREATE TABLE "care_encounter_measurement" (
    "nr" integer NOT NULL DEFAULT nextval('"enc_msr_nr_seq"'::text),
    "msr_date" date DEFAULT '0001-01-01',
    "msr_time" real DEFAULT '0.00',
    "encounter_nr" bigint DEFAULT '0',
    "msr_type_nr" smallint DEFAULT '0',
    "value" character varying(255) NOT NULL,
    "unit_nr" smallint NOT NULL,
    "unit_type_nr" smallint DEFAULT '0',
    "notes" character varying(255) NOT NULL,
    "measured_by" character varying(35) NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "enc_msr_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE enc_msr_nr_seq;

-- Indexes
CREATE INDEX enc_msr_type ON care_encounter_measurement USING btree (msr_type_nr);
CREATE INDEX enc_msr_enr ON care_encounter_measurement USING btree (encounter_nr);

-- 42
-- DROP TABLE "care_encounter_notes";
CREATE TABLE "care_encounter_notes" (
    "nr" integer NOT NULL DEFAULT nextval('"enc_notes_nr_seq"'::text),
    "encounter_nr" bigint DEFAULT '0',
    "type_nr" smallint DEFAULT '0',
    "notes" text NOT NULL,
    "short_notes" character varying(25) NOT NULL,
    "aux_notes" character varying(255) NOT NULL,
    "ref_notes_nr" integer DEFAULT '0',
    "personell_nr" integer DEFAULT '0',
    "personell_name" character varying(60) NOT NULL,
    "send_to_pid" bigint DEFAULT '0',
    "send_to_name" character varying(60) NOT NULL,
    "date" date NOT NULL,
    "time" time without time zone NOT NULL,
    "location_type" character varying(35) NOT NULL,
    "location_type_nr" smallint DEFAULT '0',
    "location_nr" integer DEFAULT '0',
    "location_id" character varying(60) NOT NULL,
    "ack_short_id" character varying(10) NOT NULL,
    "date_ack" timestamp with time zone NOT NULL,
    "date_checked" timestamp with time zone NOT NULL,
    "date_printed" timestamp with time zone NOT NULL,
    "send_by_mail" smallint NOT NULL,
    "send_by_email" smallint NOT NULL,
    "send_by_fax" smallint NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "enc_notes_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE enc_notes_nr_seq;

-- Indexes
CREATE INDEX enc_notes_nr ON care_encounter_notes USING btree (encounter_nr);
CREATE INDEX enc_notes_type_nr ON care_encounter_notes USING btree (type_nr);

-- 43
-- DROP TABLE "care_encounter_obstetric";
CREATE TABLE "care_encounter_obstetric" (
    "encounter_nr" bigint NOT NULL,
    "pregnancy_nr" integer DEFAULT '0',
    "hospital_adm_nr" integer DEFAULT '0',
    "patient_class" character varying(60) NOT NULL,
    "is_discharged_not_in_labour" smallint NOT NULL,
    "is_re_admission" smallint NOT NULL,
    "referral_status" character varying(60) NOT NULL,
    "referral_reason" text NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "enc_obs_pkey" PRIMARY KEY ("encounter_nr")
) WITH OIDS;

-- Index
CREATE INDEX enc_obs_pregnr ON care_encounter_obstetric USING btree (pregnancy_nr);

-- 44
-- DROP TABLE "care_encounter_op";
CREATE TABLE "care_encounter_op" (
    "nr" integer NOT NULL DEFAULT nextval('"enc_op_nr_seq"'::text),
    "year" character varying(4) DEFAULT '0',
    "dept_nr" smallint DEFAULT '0',
    "op_room" character varying(10) DEFAULT '0',
    "op_nr" integer DEFAULT '0',
    "op_date" date DEFAULT '0001-01-01',
    "op_src_date" character varying(8) NOT NULL,
    "encounter_nr" bigint DEFAULT '0',
    "diagnosis" text NOT NULL,
    "operator" text NOT NULL,
    "assistant" text NOT NULL,
    "scrub_nurse" text NOT NULL,
    "rotating_nurse" text NOT NULL,
    "anesthesia" character varying(30) NOT NULL,
    "an_doctor" text NOT NULL,
    "op_therapy" text NOT NULL,
    "result_info" text NOT NULL,
    "entry_time" character varying(5) NOT NULL,
    "cut_time" character varying(5) NOT NULL,
    "close_time" character varying(5) NOT NULL,
    "exit_time" character varying(5) NOT NULL,
    "entry_out" text NOT NULL,
    "cut_close" text NOT NULL,
    "wait_time" text NOT NULL,
    "bandage_time" text NOT NULL,
    "repos_time" text NOT NULL,
    "encoding" text NOT NULL,
    "doc_date" character varying(10) NOT NULL,
    "doc_time" character varying(5) NOT NULL,
    "duty_type" character varying(15) NOT NULL,
    "material_codedlist" text NOT NULL,
    "container_codedlist" text NOT NULL,
    "icd_code" text NOT NULL,
    "ops_code" text NOT NULL,
    "ops_intern_code" text NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "enc_op_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE enc_op_nr_seq;

-- Indexes

CREATE INDEX enc_op_dept_nr ON care_encounter_op USING btree (dept_nr);
CREATE INDEX enc_op_date ON care_encounter_op USING btree (op_date);
CREATE INDEX enc_op_room ON care_encounter_op USING btree (op_room);


-- 45
-- DROP TABLE "care_encounter_prescription";
CREATE TABLE "care_encounter_prescription" (
    "nr" integer NOT NULL DEFAULT nextval('"enc_presc_nr_seq"'::text),
    "encounter_nr" bigint DEFAULT '0',
    "prescription_type_nr" smallint DEFAULT '0',
    "article" character varying(100) NOT NULL,
    "drug_class" character varying(60) NOT NULL,
    "order_nr" integer DEFAULT '0',
    "dosage" character varying(255) NOT NULL,
    "application_type_nr" smallint DEFAULT '0',
    "notes" text NOT NULL,
    "prescribe_date" date NOT NULL,
    "prescriber" character varying(60) NOT NULL,
    "color_marker" character varying(10) NOT NULL,
    "is_stopped" smallint DEFAULT '0',
    "stop_date" date NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "enc_presc_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE enc_presc_nr_seq;

-- Index
CREATE INDEX enc_presc_enr ON care_encounter_prescription USING btree (encounter_nr);

-- 46
-- DROP TABLE "care_encounter_prescription_notes";
CREATE TABLE "care_encounter_prescription_notes" (
    "nr" bigint NOT NULL DEFAULT nextval('"enc_prescnotes_nr_seq"'::text),
    "date" date DEFAULT '0001-01-01',
    "prescription_nr" integer DEFAULT '0',
    "notes" character varying(35) NOT NULL,
    "short_notes" character varying(25) NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "enc_prescnotes_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE enc_prescnotes_nr_seq;

-- 47
-- DROP TABLE "care_encounter_procedure";
CREATE TABLE "care_encounter_procedure" (
    "procedure_nr" integer NOT NULL DEFAULT nextval('"enc_proc_nr_seq"'::text),
    "encounter_nr" bigint DEFAULT '0',
    "op_nr" integer DEFAULT '0',
    "date" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
    "code" character varying(25) NOT NULL,
    "code_parent" character varying(25) NOT NULL,
    "group_nr" integer DEFAULT '0',
    "code_version" smallint DEFAULT '0',
    "localcode" character varying(35) NOT NULL,
    "category_nr" smallint DEFAULT '0',
    "localization" character varying(35) NOT NULL,
    "responsible_clinician" character varying(60) NOT NULL,
    "responsible_dept_nr" smallint DEFAULT '0',
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "enc_proc_pkey" PRIMARY KEY ("procedure_nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE enc_proc_nr_seq;
-- Index
CREATE INDEX enc_proc_enr ON care_encounter_procedure USING btree (encounter_nr);

-- 48
-- DROP TABLE "care_encounter_sickconfirm";
CREATE TABLE "care_encounter_sickconfirm" (
    "nr" integer NOT NULL DEFAULT nextval('"enc_sick_nr_seq"'::text),
    "encounter_nr" bigint DEFAULT '0',
    "date_confirm" date DEFAULT '0001-01-01',
    "date_start" date DEFAULT '0001-01-01',
    "date_end" date DEFAULT '0001-01-01',
    "date_create" date DEFAULT '0001-01-01',
    "diagnosis" text NOT NULL,
    "dept_nr" smallint DEFAULT '0',
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "enc_sick_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE enc_sick_nr_seq;
-- Index
CREATE INDEX enc_sick_enr ON care_encounter_sickconfirm USING btree (encounter_nr);

-- 49
-- DROP TABLE "care_group";
CREATE TABLE "care_group" (
    "nr" integer NOT NULL DEFAULT nextval('"group_nr_seq"'::text),
    "id" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "description" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "group_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE group_nr_seq;

-- 50
-- DROP TABLE "care_icd10_de";
CREATE TABLE "care_icd10_de" (
    "diagnosis_code" character varying(12) NOT NULL,
    "description" text NOT NULL,
    "class_sub" character varying(5) NOT NULL,
    "type" character varying(10) NOT NULL,
    "inclusive" text NOT NULL,
    "exclusive" text NOT NULL,
    "notes" text NOT NULL,
    "std_code" character(1) NOT NULL,
    "sub_level" smallint DEFAULT '0',
    "remarks" text NOT NULL,
    "extra_codes" text NOT NULL,
    "extra_subclass" text NOT NULL
) WITH OIDS;

CREATE INDEX icd10de_code ON care_icd10_de USING btree (diagnosis_code);

-- 51
-- DROP TABLE "care_icd10_en";
CREATE TABLE "care_icd10_en" (
    "diagnosis_code" character varying(12) NOT NULL,
    "description" text NOT NULL,
    "class_sub" character varying(5) NOT NULL,
    "type" character varying(10) NOT NULL,
    "inclusive" text NOT NULL,
    "exclusive" text NOT NULL,
    "notes" text NOT NULL,
    "std_code" character(1) NOT NULL,
    "sub_level" smallint DEFAULT '0',
    "remarks" text NOT NULL,
    "extra_codes" text NOT NULL,
    "extra_subclass" text NOT NULL
) WITH OIDS;

CREATE INDEX icd10en_code ON care_icd10_en USING btree (diagnosis_code);

-- DROP TABLE "care_icd10_pt_br";
CREATE TABLE "care_icd10_pt_br" (
    "diagnosis_code" character varying(12) NOT NULL,
    "description" text NOT NULL,
    "class_sub" character varying(5) NOT NULL,
    "type" character varying(10) NOT NULL,
    "inclusive" text NOT NULL,
    "exclusive" text NOT NULL,
    "notes" text NOT NULL,
    "std_code" character(1) NOT NULL,
    "sub_level" smallint DEFAULT '0',
    "remarks" text NOT NULL,
    "extra_codes" text NOT NULL,
    "extra_subclass" text NOT NULL
) WITH OIDS;

CREATE INDEX icd10ptbr_code ON care_icd10_pt_br USING btree (diagnosis_code);

-- 52
-- DROP TABLE "care_img_diagnostic";
CREATE TABLE "care_img_diagnostic" (
    "nr" bigint NOT NULL DEFAULT nextval('"img_diag_nr_seq"'::text),
    "pid" bigint DEFAULT '0',
    "encounter_nr" bigint DEFAULT '0',
    "doc_ref_ids" character varying(255),
    "img_type" character varying(10) NOT NULL,
    "max_nr" smallint DEFAULT '0',
    "upload_date" date DEFAULT '0001-01-01',
    "cancel_date" date DEFAULT '0001-01-01',
    "cancel_by" character varying(35),
    "notes" text,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "img_diag_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE img_diag_nr_seq;

CREATE INDEX img_diag_pid ON care_img_diagnostic USING btree (pid);

-- 53
-- DROP TABLE "care_insurance_firm";
CREATE TABLE "care_insurance_firm" (
    "firm_id" character varying(40) NOT NULL,
    "name" character varying(60) NOT NULL,
    "iso_country_id" character(3) NOT NULL,
    "sub_area" character varying(60) NOT NULL,
    "type_nr" smallint DEFAULT '0',
    "addr" character varying(255) NOT NULL,
    "addr_mail" character varying(200) NOT NULL,
    "addr_billing" character varying(200) NOT NULL,
    "addr_email" character varying(60) NOT NULL,
    "phone_main" character varying(35) NOT NULL,
    "phone_aux" character varying(35) NOT NULL,
    "fax_main" character varying(35) NOT NULL,
    "fax_aux" character varying(35) NOT NULL,
    "contact_person" character varying(60) NOT NULL,
    "contact_phone" character varying(35) NOT NULL,
    "contact_fax" character varying(35) NOT NULL,
    "contact_email" character varying(60) NOT NULL,
    "use_frequency" bigint DEFAULT '0',
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "ins_firm_pkey" PRIMARY KEY ("firm_id")
) WITH OIDS;

CREATE INDEX ins_firm_name ON care_insurance_firm USING btree (name);

-- 54
-- DROP TABLE "care_mail_private";
CREATE TABLE "care_mail_private" (
    "recipient" character varying(60) NOT NULL,
    "sender" character varying(60) NOT NULL,
    "sender_ip" character varying(60) NOT NULL,
    "cc" character varying(255) NOT NULL,
    "bcc" character varying(255) NOT NULL,
    "subject" character varying(255) NOT NULL,
    "body" text NOT NULL,
    "sign" character varying(255) NOT NULL,
    "ask4ack" smallint DEFAULT '0',
    "reply2" character varying(255) NOT NULL,
    "attachment" character varying(255) NOT NULL,
    "attach_type" character varying(30) NOT NULL,
    "read_flag" smallint DEFAULT '0',
    "mailgroup" character varying(60) NOT NULL,
    "maildir" character varying(60) NOT NULL,
    "exec_level" smallint DEFAULT '0',
    "exclude_addr" text NOT NULL,
    "send_dt" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
    "send_stamp" timestamp with time zone NOT NULL,
    "uid" character varying(255) NOT NULL
) WITH OIDS;


-- Indexes

CREATE INDEX mail_recipient ON care_mail_private USING btree (recipient);

-- 55
-- DROP TABLE "care_mail_private_users";
CREATE TABLE "care_mail_private_users" (
    "user_name" character varying(60) NOT NULL,
    "email" character varying(60) NOT NULL,
    "alias" character varying(60) NOT NULL,
    "pw" character varying(255) NOT NULL,
    "inbox" text NOT NULL,
    "sent" text NOT NULL,
    "drafts" text NOT NULL,
    "trash" text NOT NULL,
    "lastcheck" timestamp with time zone NOT NULL,
    "lock_flag" smallint DEFAULT '0',
    "addr_book" text NOT NULL,
    "addr_quick" text NOT NULL,
    "secret_q" text NOT NULL,
    "secret_q_ans" text NOT NULL,
    "public" smallint DEFAULT '0',
    "sig" text NOT NULL,
    "append_sig" smallint DEFAULT '0',
    CONSTRAINT "mail_users_pkey" PRIMARY KEY ("email")
) WITH OIDS;

-- 56
-- DROP TABLE "care_med_ordercatalog";
CREATE TABLE "care_med_ordercatalog" (
    "item_no" integer NOT NULL DEFAULT nextval('"med_ocat_inr_seq"'::text),
    "dept_nr" smallint DEFAULT '0',
    "hit" integer DEFAULT '0',
    "artikelname" text NOT NULL,
    "bestellnum" character varying(20) NOT NULL,
    "minorder" smallint DEFAULT '0',
    "maxorder" smallint DEFAULT '0',
    "proorder" text NOT NULL,
    CONSTRAINT "med_ocat_pkey" PRIMARY KEY ("item_no")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE med_ocat_inr_seq;

CREATE INDEX med_ocat_inr ON care_med_ordercatalog USING btree (item_no);

-- 57
-- DROP TABLE "care_med_orderlist";
CREATE TABLE "care_med_orderlist" (
    "order_nr" integer NOT NULL DEFAULT nextval('"med_olist_onr_seq"'::text),
    "dept_nr" integer DEFAULT '0',
    "order_date" date DEFAULT '0001-01-01',
    "order_time" time without time zone DEFAULT '00:00:00',
    "articles" text NOT NULL,
    "extra1" text NOT NULL,
    "extra2" text NOT NULL,
    "validator" text NOT NULL,
    "ip_addr" text NOT NULL,
    "priority" text NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    "sent_datetime" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
    "process_datetime" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
    CONSTRAINT "med_olist_pkey" PRIMARY KEY ("order_nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE med_olist_onr_seq;

-- Indexes
CREATE INDEX med_olist_dept ON care_med_orderlist USING btree (dept_nr);

-- 58
-- DROP TABLE "care_med_products_main";
CREATE TABLE "care_med_products_main" (
    "bestellnum" character varying(25) NOT NULL,
    "artikelnum" text NOT NULL,
    "industrynum" text NOT NULL,
    "artikelname" text NOT NULL,
    "generic" text NOT NULL,
    "description" text NOT NULL,
    "packing" text NOT NULL,
    "minorder" integer DEFAULT '0',
    "maxorder" integer DEFAULT '0',
    "proorder" text NOT NULL,
    "picfile" text NOT NULL,
    "encoder" text NOT NULL,
    "enc_date" text NOT NULL,
    "enc_time" text NOT NULL,
    "lock_flag" smallint DEFAULT '0',
    "medgroup" text NOT NULL,
    "cave" text NOT NULL,
    "status" character varying(20) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "med_prod_pkey" PRIMARY KEY ("bestellnum")
) WITH OIDS;


-- Indexes

CREATE INDEX med_prod_onr ON care_med_products_main USING btree (bestellnum);

-- 59
-- DROP TABLE "care_med_report";
CREATE TABLE "care_med_report" (
    "report_nr" integer NOT NULL DEFAULT nextval('"med_report_nr_seq"'::text),
    "dept" character varying(15) NOT NULL,
    "report" text NOT NULL,
    "reporter" character varying(25) NOT NULL,
    "id_nr" character varying(15) NOT NULL,
    "report_date" date DEFAULT '0001-01-01',
    "report_time" time without time zone DEFAULT '00:00:00',
    "status" character varying(20) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "med_report_pkey" PRIMARY KEY ("report_nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE med_report_nr_seq;

-- 60
-- DROP TABLE "care_menu_main";
CREATE TABLE "care_menu_main" (
    "nr" smallint NOT NULL DEFAULT nextval('"menu_main_nr_seq"'::text),
    "sort_nr" smallint DEFAULT '0',
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "url" character varying(255) NOT NULL,
    "is_visible" smallint DEFAULT '1',
    "hide_by" text NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying (60) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    CONSTRAINT "menu_main_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

-- Sequence
CREATE SEQUENCE menu_main_nr_seq;

-- 61
-- DROP TABLE "care_method_induction";
CREATE TABLE "care_method_induction" (
    "nr" smallint NOT NULL DEFAULT nextval('"induction_nr_seq"'::text),
    "group_nr" smallint DEFAULT '0',
    "method" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "description" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "induction_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE induction_nr_seq;

-- 62
-- DROP TABLE "care_mode_delivery";
CREATE TABLE "care_mode_delivery" (
    "nr" smallint NOT NULL DEFAULT nextval('"delivery_nr_seq"'::text),
    "group_nr" smallint DEFAULT '0',
    "mode" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "description" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "delivery_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE delivery_nr_seq;

-- 63
-- DROP TABLE "care_neonatal";
CREATE TABLE "care_neonatal" (
    "nr" integer NOT NULL DEFAULT nextval('"neo_nr_seq"'::text),
    "pid" bigint DEFAULT '0',
    "delivery_date" date DEFAULT '0001-01-01',
    "parent_encounter_nr" bigint DEFAULT '0',
    "delivery_nr" smallint DEFAULT '0',
    "encounter_nr" bigint DEFAULT '0',
    "delivery_place" character varying(60) NOT NULL,
    "delivery_mode" smallint DEFAULT '0',
    "c_s_reason" text NOT NULL,
    "born_before_arrival" smallint DEFAULT '0',
    "face_presentation" smallint DEFAULT '0',
    "posterio_occipital_position" smallint DEFAULT '0',
    "delivery_rank" smallint DEFAULT '1',
    "apgar_1_min" smallint DEFAULT '0',
    "apgar_5_min" smallint DEFAULT '0',
    "apgar_10_min" smallint DEFAULT '0',
    "time_to_spont_resp" smallint NOT NULL,
    "condition" character varying(60) DEFAULT '0',
    "weight" real,
    "length" real,
    "head_circumference" real,
    "scored_gestational_age" real,
    "feeding" smallint DEFAULT '0',
    "congenital_abnormality" character varying(125) NOT NULL,
    "classification" character varying(255) DEFAULT '0',
    "disease_category" smallint DEFAULT '0',
    "outcome" smallint DEFAULT '0',
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "neonatal_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE neo_nr_seq;

-- Indexes

CREATE INDEX neo_pregnr ON care_neonatal USING btree (parent_encounter_nr);
CREATE INDEX neo_pid ON care_neonatal USING btree (pid);
CREATE INDEX neo_enr ON care_neonatal USING btree (encounter_nr);

-- 64
-- DROP TABLE "care_news_article";
CREATE TABLE "care_news_article" (
    "nr" integer NOT NULL DEFAULT nextval('"news_nr_seq"'::text),
    "lang" character varying(10) DEFAULT 'en',
    "dept_nr" smallint DEFAULT '0',
    "category" text NOT NULL,
    "status" character varying(10) DEFAULT 'pending',
    "title" character varying(255) NOT NULL,
    "preface" text NOT NULL,
    "body" text NOT NULL,
    "pic" bytea,
    "pic_mime" character varying(4) NOT NULL,
    "art_num" smallint DEFAULT '0',
    "head_file" text NOT NULL,
    "main_file" text NOT NULL,
    "pic_file" text NOT NULL,
    "author" character varying(30) NOT NULL,
    "submit_date" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
    "encode_date" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
    "publish_date" date DEFAULT '0001-01-01',
    "modify_id" character varying(30) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(30) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "news_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE news_nr_seq;

-- 65
-- DROP TABLE "care_op_med_doc";
CREATE TABLE "care_op_med_doc" (
    "nr" bigint NOT NULL DEFAULT nextval('"opmed_nr_seq"'::text),
    "op_date" character varying(12) NOT NULL,
    "operator" text NOT NULL,
    "encounter_nr" bigint DEFAULT '0',
    "dept_nr" smallint DEFAULT '0',
    "diagnosis" text NOT NULL,
    "localize" text NOT NULL,
    "therapy" text NOT NULL,
    "special" text NOT NULL,
    "class_s" smallint DEFAULT '0',
    "class_m" smallint DEFAULT '0',
    "class_l" smallint DEFAULT '0',
    "op_start" character varying(8) NOT NULL,
    "op_end" character varying(8) NOT NULL,
    "scrub_nurse" character varying(70) NOT NULL,
    "op_room" character varying(10) NOT NULL,
    "status" character varying(15) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "opmed_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE opmed_nr_seq;

CREATE INDEX opmed_enr ON care_op_med_doc USING btree (encounter_nr);

-- 66
-- DROP TABLE "care_ops301_de";
CREATE TABLE "care_ops301_de" (
    "code" character varying(12) NOT NULL,
    "description" text NOT NULL,
    "inclusive" text NOT NULL,
    "exclusive" text NOT NULL,
    "notes" text NOT NULL,
    "std_code" character(1) NOT NULL,
    "sub_level" smallint DEFAULT '0',
    "remarks" text NOT NULL
) WITH OIDS;

CREATE INDEX ops301de_code ON care_ops301_de USING btree (code);

-- 67
-- DROP TABLE "care_person";
CREATE TABLE "care_person" (
    "pid" bigint NOT NULL DEFAULT nextval('"person_pid_seq"'::text),
    "date_reg" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
    "name_first" character varying(60) NOT NULL,
    "name_2" character varying(60) DEFAULT '',
    "name_3" character varying(60) DEFAULT '',
    "name_middle" character varying(60) DEFAULT '',
    "name_last" character varying(60) NOT NULL,
    "name_maiden" character varying(60) DEFAULT '',
    "name_others" text DEFAULT '',
    "date_birth" date DEFAULT '0001-01-01',
    "blood_group" character(2) DEFAULT '',
    "addr_str" character varying(60) DEFAULT '',
    "addr_str_nr" character varying(10) DEFAULT '',
    "addr_zip" character varying(15) DEFAULT '',
    "addr_citytown_nr" integer DEFAULT '0',
    "addr_is_valid" smallint DEFAULT '0',
    "citizenship" character varying(35) DEFAULT '',
    "phone_1_code" character varying(15) DEFAULT '0',
    "phone_1_nr" character varying(35) DEFAULT '',
    "phone_2_code" character varying(15) DEFAULT '0',
    "phone_2_nr" character varying(35) DEFAULT '',
    "cellphone_1_nr" character varying(35) DEFAULT '',
    "cellphone_2_nr" character varying(35) DEFAULT '',
    "fax" character varying(35) DEFAULT '',
    "email" character varying(60) DEFAULT '',
    "civil_status" character varying(35) DEFAULT '',
    "sex" character(1) DEFAULT '',
    "title" character varying(25) DEFAULT '',
    "photo" bytea,
    "photo_filename" character varying(60) DEFAULT '',
    "ethnic_orig" integer,
    "org_id" character varying(60) DEFAULT '',
    "sss_nr" character varying(60) DEFAULT '',
    "nat_id_nr" character varying(60) DEFAULT '',
    "religion" character varying(125) DEFAULT '',
    "mother_pid" bigint DEFAULT '0',
    "father_pid" bigint DEFAULT '0',
    "contact_person" character varying(255) DEFAULT '',
    "contact_pid" bigint DEFAULT '0',
    "contact_relation" character varying(25) DEFAULT '0',
    "death_date" date DEFAULT '0001-01-01',
    "death_encounter_nr" bigint DEFAULT '0',
    "death_cause" character varying(255) DEFAULT '',
    "death_cause_code" character varying(15) DEFAULT '',
    "date_update" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
    "status" character varying(20) DEFAULT '',
    "history" text,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "person_pkey" PRIMARY KEY ("pid")
) WITH OIDS;


CREATE SEQUENCE person_pid_seq start 10000000;

-- Indexes

CREATE INDEX person_dob ON care_person USING btree (date_birth);
CREATE INDEX person_dtreg ON care_person USING btree (date_reg);
CREATE INDEX person_fname ON care_person USING btree (name_first);
CREATE INDEX person_lname ON care_person USING btree (name_last);

-- 68
-- DROP TABLE "care_person_insurance";
CREATE TABLE "care_person_insurance" (
    "item_nr" integer NOT NULL DEFAULT nextval('"person_ins_inr_seq"'::text),
    "pid" bigint DEFAULT '0',
    "type" character varying(60) NOT NULL,
    "insurance_nr" character varying(50) DEFAULT '0',
    "firm_id" character varying(60) NOT NULL,
    "class_nr" smallint DEFAULT '0',
    "is_void" smallint DEFAULT '0',
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "person_ins_pkey" PRIMARY KEY ("item_nr")
) WITH OIDS;

CREATE SEQUENCE person_ins_inr_seq;

-- 69
-- DROP TABLE "care_person_other_number";
CREATE TABLE "care_person_other_number" (
    "nr" integer NOT NULL DEFAULT nextval('"person_onr_nr_seq"'::text),
    "pid" bigint DEFAULT '0',
    "other_nr" character varying(30) NOT NULL,
    "org" character varying(35) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "person_onr_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE person_onr_nr_seq;

-- Indexes

CREATE INDEX person_onr ON care_person_other_number USING btree (other_nr);
CREATE INDEX person_onr_pid ON care_person_other_number USING btree (pid);


-- 70
-- DROP TABLE "care_personell";
CREATE TABLE "care_personell" (
    "nr" integer NOT NULL DEFAULT nextval('"personell_nr_seq"'::text),
    "short_id" character varying(10) NOT NULL,
    "pid" bigint NOT NULL DEFAULT '0',
    "job_type_nr" smallint NOT NULL DEFAULT '0',
    "job_function_title" character varying(60) NOT NULL,
    "date_join" date NOT NULL,
    "date_exit" date NOT NULL,
    "contract_class" character varying(35) DEFAULT '0',
    "contract_start" date NOT NULL,
    "contract_end" date NOT NULL,
    "is_discharged" smallint DEFAULT '0',
    "pay_class" character varying(25) NOT NULL,
    "pay_class_sub" character varying(25) NOT NULL,
    "local_premium_id" character varying(5) NOT NULL,
    "tax_account_nr" character varying(60) NOT NULL,
    "ir_code" character varying(25) NOT NULL,
    "nr_workday" smallint DEFAULT '0',
    "nr_weekhour" real DEFAULT '0.00',
    "nr_vacation_day" smallint DEFAULT '0',
    "multiple_employer" smallint DEFAULT '0',
    "nr_dependent" smallint DEFAULT '0',
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "personell_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE personell_nr_seq;

CREATE INDEX personell_pid ON care_personell USING btree (pid);

-- 71
-- DROP TABLE "care_personell_assignment";
CREATE TABLE "care_personell_assignment" (
    "nr" integer NOT NULL DEFAULT nextval('"passign_nr_seq"'::text),
    "personell_nr" integer NOT NULL DEFAULT '0',
    "role_nr" smallint NOT NULL DEFAULT '0',
    "location_type_nr" smallint NOT NULL DEFAULT '0',
    "location_nr" smallint NOT NULL DEFAULT '0',
    "date_start" date DEFAULT '0001-01-01',
    "date_end" date DEFAULT '0001-01-01',
    "is_temporary" smallint NOT NULL,
    "list_frequency" integer DEFAULT '0',
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "passign_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE passign_nr_seq;

-- Indexes

CREATE INDEX passign_pnr ON care_personell_assignment USING btree (personell_nr);


-- 72
-- DROP TABLE "care_pharma_ordercatalog";
CREATE TABLE "care_pharma_ordercatalog" (
    "item_no" integer NOT NULL DEFAULT nextval('"pharma_ocat_inr_seq"'::text),
    "dept_nr" smallint DEFAULT '0',
    "hit" integer DEFAULT '0',
    "artikelname" text NOT NULL,
    "bestellnum" character varying(20) NOT NULL,
    "minorder" smallint DEFAULT '0',
    "maxorder" smallint DEFAULT '0',
    "proorder" text NOT NULL,
    CONSTRAINT "pharma_ocat_pkey" PRIMARY KEY ("item_no")
) WITH OIDS;

CREATE SEQUENCE pharma_ocat_inr_seq;


-- 73
-- DROP TABLE "care_pharma_orderlist";
CREATE TABLE "care_pharma_orderlist" (
    "order_nr" integer NOT NULL DEFAULT nextval('"pharma_olist_onr_seq"'::text),
    "dept_nr" smallint NOT NULL DEFAULT '0',
    "order_date" date DEFAULT '0001-01-01',
    "order_time" time without time zone DEFAULT '00:00:00',
    "articles" text NOT NULL,
    "extra1" text NOT NULL,
    "extra2" text NOT NULL,
    "validator" text NOT NULL,
    "ip_addr" text NOT NULL,
    "priority" text NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    "sent_datetime" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
    "process_datetime" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
    CONSTRAINT "pharma_olist_pkey" PRIMARY KEY ("order_nr")
) WITH OIDS;

CREATE SEQUENCE pharma_olist_onr_seq;

CREATE INDEX pharma_olist_dept ON care_pharma_orderlist USING btree (dept_nr);

-- 74
-- DROP TABLE "care_pharma_products_main";
CREATE TABLE "care_pharma_products_main" (
    "bestellnum" character varying(25) NOT NULL,
    "artikelnum" text NOT NULL,
    "industrynum" text NOT NULL,
    "artikelname" text NOT NULL,
    "generic" text NOT NULL,
    "description" text NOT NULL,
    "packing" text NOT NULL,
    "minorder" integer DEFAULT '0',
    "maxorder" integer DEFAULT '0',
    "proorder" text NOT NULL,
    "picfile" text NOT NULL,
    "encoder" text NOT NULL,
    "enc_date" text NOT NULL,
    "enc_time" text NOT NULL,
    "lock_flag" smallint DEFAULT '0',
    "medgroup" text NOT NULL,
    "cave" text NOT NULL,
    "status" character varying(20) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "pharma_prod_pkey" PRIMARY KEY ("bestellnum")
) WITH OIDS;

-- 75
-- DROP TABLE "care_phone";
CREATE TABLE "care_phone" (
    "item_nr" bigint NOT NULL DEFAULT nextval('"phone_inr_seq"'::text),
    "title" character varying(25) NOT NULL,
    "name" character varying(45) NOT NULL,
    "vorname" character varying(45) NOT NULL,
    "pid" bigint NOT NULL DEFAULT '0',
    "personell_nr" integer NOT NULL DEFAULT '0',
    "dept_nr" smallint NOT NULL DEFAULT '0',
    "beruf" character varying(25) NOT NULL,
    "bereich1" character varying(25) NOT NULL,
    "bereich2" character varying(25) NOT NULL,
    "inphone1" character varying(15) NOT NULL,
    "inphone2" character varying(15) NOT NULL,
    "inphone3" character varying(15) NOT NULL,
    "exphone1" character varying(25) NOT NULL,
    "exphone2" character varying(25) NOT NULL,
    "funk1" character varying(15) NOT NULL,
    "funk2" character varying(15) NOT NULL,
    "roomnr" character varying(10) NOT NULL,
    "date" date DEFAULT '0001-01-01',
    "time" time without time zone DEFAULT '00:00:00',
    "status" character varying(15) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "care_phone_pkey" PRIMARY KEY ("item_nr")
) WITH OIDS;

CREATE SEQUENCE phone_inr_seq;
-- Indexes

CREATE INDEX phone_fname ON care_phone USING btree (vorname);
CREATE INDEX phone_lname ON care_phone USING btree (name);


-- 76
-- DROP TABLE "care_pregnancy";
CREATE TABLE "care_pregnancy" (
    "nr" integer NOT NULL DEFAULT nextval('"preg_nr_seq"'::text),
    "encounter_nr" bigint NOT NULL DEFAULT '0',
    "this_pregnancy_nr" smallint DEFAULT '0',
    "delivery_date" date DEFAULT '0001-01-01',
    "delivery_time" time without time zone DEFAULT '00:00:00',
    "gravida" smallint NOT NULL,
    "para" smallint NOT NULL,
    "pregnancy_gestational_age" smallint NOT NULL,
    "nr_of_fetuses" smallint NOT NULL,
    "child_encounter_nr" character varying(255) NOT NULL,
    "is_booked" smallint DEFAULT '0',
    "vdrl" character(1) NOT NULL,
    "rh" smallint NOT NULL,
    "delivery_mode" smallint DEFAULT '0',
    "delivery_by" character varying(60) NOT NULL,
    "bp_systolic_high" smallint NOT NULL,
    "bp_diastolic_high" smallint NOT NULL,
    "proteinuria" smallint NOT NULL,
    "labour_duration" smallint NOT NULL,
    "induction_method" smallint DEFAULT '0',
    "induction_indication" character varying(125) NOT NULL,
    "anaesth_type_nr" smallint DEFAULT '0',
    "is_epidural" character(1) NOT NULL,
    "complications" character varying(255) NOT NULL,
    "perineum" smallint DEFAULT '0',
    "blood_loss" real,
    "blood_loss_unit" character varying(10) NOT NULL,
    "is_retained_placenta" character(1) NOT NULL,
    "post_labour_condition" character varying(35) NOT NULL,
    "outcome" character varying(35) NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "preg_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE preg_nr_seq;

CREATE INDEX preg_enr ON care_pregnancy USING btree (encounter_nr);

-- 77
-- DROP TABLE "care_registry";
CREATE TABLE "care_registry" (
    "registry_id" character varying(35) NOT NULL,
    "module_start_script" character varying(60) NOT NULL,
    "news_start_script" character varying(60) NOT NULL,
    "news_editor_script" character varying(255) NOT NULL,
    "news_reader_script" character varying(255) NOT NULL,
    "passcheck_script" character varying(255) NOT NULL,
    "composite" text NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "registry_pkey" PRIMARY KEY ("registry_id")
) WITH OIDS;

-- 78
-- DROP TABLE "care_role_person";
CREATE TABLE "care_role_person" (
    "nr" smallint NOT NULL DEFAULT nextval('"roleperson_nr_seq"'::text),
    "group_nr" smallint NOT NULL DEFAULT '0',
    "role" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "roleperson_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE roleperson_nr_seq;

-- 79
-- DROP TABLE "care_room";
CREATE TABLE "care_room" (
    "nr" integer NOT NULL DEFAULT nextval('"room_nr_seq"'::text),
    "type_nr" smallint NOT NULL DEFAULT '0',
    "date_create" date DEFAULT '0001-01-01',
    "date_close" date DEFAULT '0001-01-01',
    "is_temp_closed" smallint DEFAULT '0',
    "room_nr" smallint DEFAULT '0',
    "ward_nr" smallint NOT NULL DEFAULT '0',
    "dept_nr" smallint NOT NULL DEFAULT '0',
    "nr_of_beds" smallint DEFAULT '1',
    "closed_beds" character varying(255) NOT NULL,
    "info" character varying(60) NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "room_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE room_nr_seq;

-- Indexes

CREATE INDEX room_roomnr ON care_room USING btree (room_nr);
CREATE INDEX room_wardnr ON care_room USING btree (ward_nr);
CREATE INDEX room_deptnr ON care_room USING btree (dept_nr);

-- 80
-- DROP TABLE "care_sessions";
CREATE TABLE "care_sessions" (
    "sesskey" character varying(32) NOT NULL,
    "expiry" integer DEFAULT '0',
    "data" text NOT NULL,
    CONSTRAINT "care_sessions_pkey" PRIMARY KEY ("sesskey")
) WITH OIDS;


-- Indexes

CREATE INDEX expiry ON care_sessions USING btree (expiry);

-- 81
-- DROP TABLE "care_standby_duty_report";
CREATE TABLE "care_standby_duty_report" (
    "report_nr" integer NOT NULL DEFAULT nextval('"sduty_rep_nr_seq"'::text),
    "dept" character varying(15) NOT NULL,
    "date" date DEFAULT '0001-01-01',
    "standby_name" character varying(35) NOT NULL,
    "standby_start" time without time zone DEFAULT '00:00:00',
    "standby_end" time without time zone DEFAULT '00:00:00',
    "oncall_name" character varying(35) NOT NULL,
    "oncall_start" time without time zone DEFAULT '00:00:00',
    "oncall_end" time without time zone DEFAULT '00:00:00',
    "op_room" character(2) NOT NULL,
    "diagnosis_therapy" text NOT NULL,
    "encoding" text NOT NULL,
    "status" character varying(20) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "sduty_report_pkey" PRIMARY KEY ("report_nr")
) WITH OIDS;

CREATE SEQUENCE sduty_rep_nr_seq;

-- 82
-- DROP TABLE "care_steri_products_main";
CREATE TABLE "care_steri_products_main" (
    "bestellnum" integer DEFAULT '0',
    "containernum" character varying(15) NOT NULL,
    "industrynum" text NOT NULL,
    "containername" character varying(40) NOT NULL,
    "description" text NOT NULL,
    "packing" text NOT NULL,
    "minorder" integer DEFAULT '0',
    "maxorder" integer DEFAULT '0',
    "proorder" text NOT NULL,
    "picfile" text NOT NULL,
    "encoder" text NOT NULL,
    "enc_date" text NOT NULL,
    "enc_time" text NOT NULL,
    "lock_flag" smallint DEFAULT '0',
    "medgroup" text NOT NULL,
    "cave" text NOT NULL
) WITH OIDS;

-- 83
-- DROP TABLE "care_tech_questions";
CREATE TABLE "care_tech_questions" (
    "batch_nr" integer NOT NULL DEFAULT nextval('"techq_bnr_seq"'::text),
    "dept" character varying(60) NOT NULL,
    "query" text NOT NULL,
    "inquirer" character varying(25) NOT NULL,
    "tphone" character varying(30) NOT NULL,
    "tdate" date DEFAULT '0001-01-01',
    "ttime" time without time zone DEFAULT '00:00:00',
    "tid" timestamp with time zone NOT NULL,
    "reply" text NOT NULL,
    "answered" smallint DEFAULT '0',
    "ansby" character varying(25) NOT NULL,
    "astamp" character varying(16) NOT NULL,
    "archive" smallint DEFAULT '0',
    "status" character varying(15) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "care_tech_questions_pkey" PRIMARY KEY ("batch_nr")
) WITH OIDS;

CREATE SEQUENCE techq_bnr_seq;

-- 84
-- DROP TABLE "care_tech_repair_done";
CREATE TABLE "care_tech_repair_done" (
    "batch_nr" integer NOT NULL DEFAULT nextval('"techdo_bnr_seq"'::text),
    "dept" character varying(15) NOT NULL,
    "dept_nr" smallint NOT NULL DEFAULT '0',
    "job_id" character varying(15) DEFAULT '0',
    "job" text NOT NULL,
    "reporter" character varying(25) NOT NULL,
    "id" character varying(15) NOT NULL,
    "tdate" date DEFAULT '0001-01-01',
    "ttime" time without time zone DEFAULT '00:00:00',
    "tid" timestamp with time zone NOT NULL,
    "seen" smallint DEFAULT '0',
    "d_idx" character varying(8) NOT NULL,
    "status" character varying(15) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "techdo_pkey" PRIMARY KEY ("batch_nr")
) WITH OIDS;

CREATE SEQUENCE techdo_bnr_seq;

-- 85
-- DROP TABLE "care_tech_repair_job";
CREATE TABLE "care_tech_repair_job" (
    "batch_nr" integer NOT NULL DEFAULT nextval('"techjob_bnr_seq"'::text),
    "dept" character varying(15) NOT NULL,
    "job" text NOT NULL,
    "reporter" character varying(25) NOT NULL,
    "id" character varying(15) NOT NULL,
    "tphone" character varying(30) NOT NULL,
    "tdate" date DEFAULT '0001-01-01',
    "ttime" time without time zone DEFAULT '00:00:00',
    "tid" timestamp with time zone NOT NULL,
    "done" smallint DEFAULT '0',
    "seen" smallint DEFAULT '0',
    "seenby" character varying(25) NOT NULL,
    "sstamp" character varying(16) NOT NULL,
    "doneby" character varying(25) NOT NULL,
    "dstamp" character varying(16) NOT NULL,
    "d_idx" character varying(8) NOT NULL,
    "archive" smallint DEFAULT '0',
    "status" character varying(20) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "techjob_pkey" PRIMARY KEY ("batch_nr")
) WITH OIDS;

CREATE SEQUENCE techjob_bnr_seq;

-- 86
-- DROP TABLE "care_test_findings_baclabor";
CREATE TABLE "care_test_findings_baclabor" (
    "batch_nr" integer NOT NULL DEFAULT '0',
    "encounter_nr" bigint NOT NULL DEFAULT '0',
    "room_nr" character varying(10) NOT NULL,
    "dept_nr" smallint NOT NULL DEFAULT '0',
    "notes" character varying(255) NOT NULL,
    "findings_init" smallint DEFAULT '0',
    "findings_current" smallint DEFAULT '0',
    "findings_final" smallint DEFAULT '0',
    "entry_nr" character varying(10) NOT NULL,
    "rec_date" date DEFAULT '0001-01-01',
    "type_general" text NOT NULL,
    "resist_anaerob" text NOT NULL,
    "resist_aerob" text NOT NULL,
    "findings" text NOT NULL,
    "doctor_id" character varying(35) NOT NULL,
    "findings_date" date DEFAULT '0001-01-01',
    "findings_time" time without time zone DEFAULT '00:00:00',
    "status" character varying(10) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "testfind_baclab_pkey" PRIMARY KEY ("batch_nr")
) WITH OIDS;

CREATE SEQUENCE testfind_blab_bnr_seq;

-- Indexes

CREATE INDEX testfind_date ON care_test_findings_baclabor USING btree (findings_date);
CREATE INDEX testfind_rec_date ON care_test_findings_baclabor USING btree (rec_date);

-- 87
-- DROP TABLE "care_test_findings_chemlab";
CREATE TABLE "care_test_findings_chemlab" (
    "batch_nr" integer NOT NULL DEFAULT nextval('"testfind_clab_bnr_seq"'::text),
    "encounter_nr" bigint NOT NULL DEFAULT '0',
    "job_id" character varying(25) NOT NULL,
    "test_date" date DEFAULT '0001-01-01',
    "test_time" time without time zone DEFAULT '00:00:00',
    "group_id" character varying(30) NOT NULL,
    "serial_value" text NOT NULL,
    "validator" character varying(15) NOT NULL,
    "validate_dt" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
    "status" character varying(20) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "testfind_clab_pkey" PRIMARY KEY ("batch_nr")
) WITH OIDS;

CREATE SEQUENCE testfind_clab_bnr_seq;

-- 88
-- DROP TABLE "care_test_findings_patho";
CREATE TABLE "care_test_findings_patho" (
    "batch_nr" integer NOT NULL DEFAULT '0',
    "encounter_nr" bigint NOT NULL DEFAULT '0',
    "room_nr" character varying(10) NOT NULL,
    "dept_nr" smallint NOT NULL DEFAULT '0',
    "material" text NOT NULL,
    "macro" text NOT NULL,
    "micro" text NOT NULL,
    "findings" text NOT NULL,
    "diagnosis" text NOT NULL,
    "doctor_id" character varying(35) NOT NULL,
    "findings_date" date DEFAULT '0001-01-01',
    "findings_time" time without time zone DEFAULT '00:00:00',
    "status" character varying(10) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "testfind_path_pkey" PRIMARY KEY ("batch_nr")
) WITH OIDS;

-- Indexes

CREATE INDEX testfind_path_fdate ON care_test_findings_patho USING btree (findings_date);

-- 89
-- DROP TABLE "care_test_findings_radio";
CREATE TABLE "care_test_findings_radio" (
    "batch_nr" integer NOT NULL DEFAULT '0',
    "encounter_nr" bigint NOT NULL DEFAULT '0',
    "room_nr" smallint DEFAULT '0',
    "dept_nr" smallint DEFAULT '0',
    "findings" text NOT NULL,
    "diagnosis" text NOT NULL,
    "doctor_id" character varying(35) NOT NULL,
    "findings_date" date DEFAULT '0001-01-01',
    "findings_time" time without time zone DEFAULT '00:00:00',
    "status" character varying(10) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "testfind_radio_pkey" PRIMARY KEY ("batch_nr")
) WITH OIDS;

CREATE INDEX testfind_radio_fdate ON care_test_findings_radio USING btree (findings_date);

-- 90
-- DROP TABLE "care_test_group";
CREATE TABLE "care_test_group" (
    "nr" integer NOT NULL DEFAULT nextval('"testgroup_nr_seq"'::text),
    "group_id" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "sort_nr" smallint DEFAULT '0',
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "testgroup_pkey" PRIMARY KEY ("nr"),
    CONSTRAINT "testgroup_id" UNIQUE ("group_id")
) WITH OIDS;

CREATE SEQUENCE testgroup_nr_seq;

-- 91
-- DROP TABLE "care_test_param";
CREATE TABLE "care_test_param" (
    "nr" integer NOT NULL DEFAULT nextval('"testparam_nr_seq"'::text),
    "group_id" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "id" character varying(10) NOT NULL,
    "msr_unit" character varying(15) NOT NULL,
    "median" character varying(20) NOT NULL,
    "hi_bound" character varying(20) NOT NULL,
    "lo_bound" character varying(20) NOT NULL,
    "hi_critical" character varying(20) NOT NULL,
    "lo_critical" character varying(20) NOT NULL,
    "hi_toxic" character varying(20) NOT NULL,
    "lo_toxic" character varying(20) NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "testparam_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE testparam_nr_seq;

-- 92
-- DROP TABLE "care_test_request_baclabor";
CREATE TABLE "care_test_request_baclabor" (
    "batch_nr" integer NOT NULL DEFAULT nextval('"testreq_blab_bnr_seq"'::text),
    "encounter_nr" bigint DEFAULT '0',
    "dept_nr" smallint DEFAULT '0',
    "material" text NOT NULL,
    "test_type" text NOT NULL,
    "material_note" text NOT NULL,
    "diagnosis_note" text NOT NULL,
    "immune_supp" smallint DEFAULT '0',
    "send_date" date DEFAULT '0001-01-01',
    "sample_date" date DEFAULT '0001-01-01',
    "status" character varying(10) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "testreq_blab_pkey" PRIMARY KEY ("batch_nr")
) WITH OIDS;

CREATE SEQUENCE testreq_blab_bnr_seq;

CREATE INDEX testreq_blab_sdate ON care_test_request_baclabor USING btree (send_date);

-- 93
-- DROP TABLE "care_test_request_blood";
CREATE TABLE "care_test_request_blood" (
    "batch_nr" integer NOT NULL DEFAULT nextval('"testreqblood_bnr_seq"'::text),
    "encounter_nr" bigint DEFAULT '0',
    "dept_nr" smallint DEFAULT '0',
    "blood_group" character varying(10) NOT NULL,
    "rh_factor" character varying(10) NOT NULL,
    "kell" character varying(10) NOT NULL,
    "date_protoc_nr" character varying(45) NOT NULL,
    "pure_blood" character varying(15) NOT NULL,
    "red_blood" character varying(15) NOT NULL,
    "leukoless_blood" character varying(15) NOT NULL,
    "washed_blood" character varying(15) NOT NULL,
    "prp_blood" character varying(15) NOT NULL,
    "thrombo_con" character varying(15) NOT NULL,
    "ffp_plasma" character varying(15) NOT NULL,
    "transfusion_dev" character varying(15) NOT NULL,
    "match_sample" smallint DEFAULT '0',
    "transfusion_date" date DEFAULT '0001-01-01',
    "diagnosis" text NOT NULL,
    "notes" text NOT NULL,
    "send_date" date DEFAULT '0001-01-01',
    "doctor" character varying(35) NOT NULL,
    "phone_nr" character varying(40) NOT NULL,
    "status" character varying(10) NOT NULL,
    "blood_pb" text NOT NULL,
    "blood_rb" text NOT NULL,
    "blood_llrb" text NOT NULL,
    "blood_wrb" text NOT NULL,
    "blood_prp" bytea NOT NULL,
    "blood_tc" text NOT NULL,
    "blood_ffp" text NOT NULL,
    "b_group_count" integer DEFAULT '0',
    "b_group_price" real DEFAULT '0.00',
    "a_subgroup_count" integer DEFAULT '0',
    "a_subgroup_price" real DEFAULT '0.00',
    "extra_factors_count" integer DEFAULT '0',
    "extra_factors_price" real DEFAULT '0.00',
    "coombs_count" integer DEFAULT '0',
    "coombs_price" real DEFAULT '0.00',
    "ab_test_count" integer DEFAULT '0',
    "ab_test_price" real DEFAULT '0.00',
    "crosstest_count" integer DEFAULT '0',
    "crosstest_price" real DEFAULT '0.00',
    "ab_diff_count" integer DEFAULT '0',
    "ab_diff_price" real DEFAULT '0.00',
    "x_test_1_code" integer DEFAULT '0',
    "x_test_1_name" character varying(35) NOT NULL,
    "x_test_1_count" integer DEFAULT '0',
    "x_test_1_price" real DEFAULT '0.00',
    "x_test_2_code" integer DEFAULT '0',
    "x_test_2_name" character varying(35) NOT NULL,
    "x_test_2_count" integer DEFAULT '0',
    "x_test_2_price" real DEFAULT '0.00',
    "x_test_3_code" integer DEFAULT '0',
    "x_test_3_name" character varying(35) NOT NULL,
    "x_test_3_count" integer DEFAULT '0',
    "x_test_3_price" real DEFAULT '0.00',
    "lab_stamp" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
    "release_via" character varying(20) NOT NULL,
    "receipt_ack" character varying(20) NOT NULL,
    "mainlog_nr" character varying(7) NOT NULL,
    "lab_nr" character varying(7) NOT NULL,
    "mainlog_date" date DEFAULT '0001-01-01',
    "lab_date" date DEFAULT '0001-01-01',
    "mainlog_sign" character varying(20) NOT NULL,
    "lab_sign" character varying(20) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "testreqblood_pkey" PRIMARY KEY ("batch_nr")
) WITH OIDS;

CREATE SEQUENCE testreqblood_bnr_seq;

CREATE INDEX testreqblood_sdate ON care_test_request_blood USING btree (send_date);

-- 94
-- DROP TABLE "care_test_request_chemlabor";
CREATE TABLE "care_test_request_chemlabor" (
    "batch_nr" integer NOT NULL DEFAULT nextval('"testreqclab_bnr_seq"'::text),
    "encounter_nr" bigint DEFAULT '0',
    "room_nr" character varying(10) NOT NULL,
    "dept_nr" smallint DEFAULT '0',
    "parameters" text NOT NULL,
    "doctor_sign" character varying(35) NOT NULL,
    "highrisk" smallint DEFAULT '0',
    "notes" text NOT NULL,
    "send_date" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
    "sample_time" time without time zone DEFAULT '00:00:00',
    "sample_weekday" smallint DEFAULT '0',
    "status" character varying(15) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "testreqclab_pkey" PRIMARY KEY ("batch_nr")
) WITH OIDS;

CREATE SEQUENCE testreqclab_bnr_seq;

CREATE INDEX testreqclab_enr ON care_test_request_chemlabor USING btree (encounter_nr);

-- 95
-- DROP TABLE "care_test_request_generic";
CREATE TABLE "care_test_request_generic" (
    "batch_nr" integer NOT NULL DEFAULT nextval('"testreqgen_bnr_seq"'::text),
    "encounter_nr" bigint DEFAULT '0',
    "testing_dept" character varying(35) NOT NULL,
    "visit" smallint DEFAULT '0',
    "order_patient" smallint DEFAULT '0',
    "diagnosis_quiry" text NOT NULL,
    "send_date" date DEFAULT '0001-01-01',
    "send_doctor" character varying(35) NOT NULL,
    "result" text NOT NULL,
    "result_date" date DEFAULT '0001-01-01',
    "result_doctor" character varying(35) NOT NULL,
    "status" character varying(10) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "testreqgen_pkey" PRIMARY KEY ("batch_nr")
) WITH OIDS;

CREATE SEQUENCE testreqgen_bnr_seq;

CREATE INDEX testreqgen_enr ON care_test_request_generic USING btree (encounter_nr);
CREATE INDEX testreqgen_sdate ON care_test_request_generic USING btree (send_date);

-- 96
-- DROP TABLE "care_test_request_patho";
CREATE TABLE "care_test_request_patho" (
    "batch_nr" integer NOT NULL DEFAULT nextval('"testreqpath_bnr_seq"'::text),
    "encounter_nr" bigint DEFAULT '0',
    "dept_nr" smallint DEFAULT '0',
    "quick_cut" smallint DEFAULT '0',
    "qc_phone" character varying(40) NOT NULL,
    "quick_diagnosis" smallint DEFAULT '0',
    "qd_phone" character varying(40) NOT NULL,
    "material_type" character varying(25) NOT NULL,
    "material_desc" text NOT NULL,
    "localization" text NOT NULL,
    "clinical_note" text NOT NULL,
    "extra_note" text NOT NULL,
    "repeat_note" text NOT NULL,
    "gyn_last_period" character varying(25) NOT NULL,
    "gyn_period_type" character varying(25) NOT NULL,
    "gyn_gravida" character varying(25) NOT NULL,
    "gyn_menopause_since" character varying(25) DEFAULT '0',
    "gyn_hysterectomy" character varying(25) DEFAULT '0',
    "gyn_contraceptive" character varying(25) DEFAULT '0',
    "gyn_iud" character varying(25) NOT NULL,
    "gyn_hormone_therapy" character varying(25) NOT NULL,
    "doctor_sign" character varying(35) NOT NULL,
    "op_date" date DEFAULT '0001-01-01',
    "send_date" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
    "status" character varying(10) NOT NULL,
    "entry_date" date DEFAULT '0001-01-01',
    "journal_nr" character varying(15) NOT NULL,
    "blocks_nr" smallint DEFAULT '0',
    "deep_cuts" smallint DEFAULT '0',
    "special_dye" character varying(35) NOT NULL,
    "immune_histochem" character varying(35) NOT NULL,
    "hormone_receptors" character varying(35) NOT NULL,
    "specials" character varying(35) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    "process_id" character varying(35) NOT NULL,
    "process_time" timestamp with time zone NOT NULL,
    CONSTRAINT "testreqpath_pkey" PRIMARY KEY ("batch_nr")
) WITH OIDS;

CREATE SEQUENCE testreqpath_bnr_seq;

CREATE INDEX testreqpath_enr ON care_test_request_patho USING btree (encounter_nr);
CREATE INDEX testreqpath_sdate ON care_test_request_patho USING btree (send_date);

-- 97
-- DROP TABLE "care_test_request_radio";
CREATE TABLE "care_test_request_radio" (
    "batch_nr" integer NOT NULL DEFAULT nextval('"testreqradio_bnr_seq"'::text),
    "encounter_nr" bigint DEFAULT '0',
    "dept_nr" smallint DEFAULT '0',
    "xray" smallint DEFAULT '0',
    "ct" smallint DEFAULT '0',
    "sono" smallint DEFAULT '0',
    "mammograph" smallint DEFAULT '0',
    "mrt" smallint DEFAULT '0',
    "nuclear" smallint DEFAULT '0',
    "if_patmobile" smallint DEFAULT '0',
    "if_allergy" smallint DEFAULT '0',
    "if_hyperten" smallint DEFAULT '0',
    "if_pregnant" smallint DEFAULT '0',
    "clinical_info" text NOT NULL,
    "test_request" text NOT NULL,
    "send_date" date DEFAULT '0001-01-01',
    "send_doctor" character varying(35) DEFAULT '0',
    "xray_nr" character varying(9) DEFAULT '0',
    "r_cm_2" character varying(15) NOT NULL,
    "mtr" character varying(35) NOT NULL,
    "xray_date" date DEFAULT '0001-01-01',
    "xray_time" time without time zone DEFAULT '00:00:00',
    "results" text NOT NULL,
    "results_date" date DEFAULT '0001-01-01',
    "results_doctor" character varying(35) NOT NULL,
    "status" character varying(10) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    "process_id" character varying(35) NOT NULL,
    "process_time" timestamp with time zone NOT NULL,
    CONSTRAINT "testreqradio_pkey" PRIMARY KEY ("batch_nr")
) WITH OIDS;

CREATE SEQUENCE testreqradio_bnr_seq;

CREATE INDEX testreqradio_enr ON care_test_request_radio USING btree (encounter_nr);
CREATE INDEX testreqradio_xtime ON care_test_request_radio USING btree (xray_time);

-- 98
-- DROP TABLE "care_type_anaesthesia";
CREATE TABLE "care_type_anaesthesia" (
    "nr" smallint NOT NULL DEFAULT nextval('"type_ana_nr_seq"'::text),
    "id" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "description" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "type_ana_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE type_ana_nr_seq;

CREATE UNIQUE INDEX type_ana_id ON care_type_anaesthesia USING btree ("id");

-- 99
-- DROP TABLE "care_type_application";
CREATE TABLE "care_type_application" (
    "nr" smallint NOT NULL DEFAULT nextval('"type_app_nr_seq"'::text),
    "group_nr" smallint DEFAULT '0',
    "type" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "description" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "type_app_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE type_app_nr_seq;

-- 100
-- DROP TABLE "care_type_assignment";
CREATE TABLE "care_type_assignment" (
    "type_nr" smallint DEFAULT nextval('"type_assign_tnr_seq"'::text),
    "type" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(25) DEFAULT '0',
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "type_assign_pkey" PRIMARY KEY ("type_nr")
) WITH OIDS;

CREATE SEQUENCE type_assign_tnr_seq;

-- 101
-- DROP TABLE "care_type_cause_opdelay";
CREATE TABLE "care_type_cause_opdelay" (
    "type_nr" smallint NOT NULL DEFAULT nextval('"type_opd_tnr_seq"'::text),
    "type" character varying(35) NOT NULL,
    "cause" character varying(255) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "type_opd_pkey" PRIMARY KEY ("type_nr")
) WITH OIDS;

CREATE SEQUENCE type_opd_tnr_seq;

-- 102
-- DROP TABLE "care_type_color";
CREATE TABLE "care_type_color" (
    "color_id" character varying(25) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    CONSTRAINT "type_color_pkey" PRIMARY KEY ("color_id")
) WITH OIDS;

-- 103
-- DROP TABLE "care_type_department";
CREATE TABLE "care_type_department" (
    "nr" smallint NOT NULL DEFAULT nextval('"type_dept_nr_seq"'::text),
    "type" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "description" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "type_dept_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE type_dept_nr_seq;

-- 104
-- DROP TABLE "care_type_discharge";
CREATE TABLE "care_type_discharge" (
    "nr" smallint NOT NULL DEFAULT nextval('"type_disch_nr_seq"'::text),
    "type" character varying(35) NOT NULL,
    "name" character varying(100) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "type_disch_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE type_disch_nr_seq;

-- 105
-- DROP TABLE "care_type_duty";
CREATE TABLE "care_type_duty" (
    "type_nr" smallint NOT NULL DEFAULT nextval('"type_duty_tnr_seq"'::text),
    "type" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "description" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "type_duty_pkey" PRIMARY KEY ("type_nr")
) WITH OIDS;

CREATE SEQUENCE type_duty_tnr_seq;

-- 106
-- DROP TABLE "care_type_encounter";
CREATE TABLE "care_type_encounter" (
    "type_nr" smallint NOT NULL DEFAULT nextval('"type_enc_tnr_seq"'::text),
    "type" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(25) DEFAULT '0',
    "description" character varying(255) NOT NULL,
    "hide_from" smallint DEFAULT '0',
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "type_enc_pkey" PRIMARY KEY ("type_nr")
) WITH OIDS;

CREATE SEQUENCE type_enc_tnr_seq;

-- 107
-- DROP TABLE "care_type_ethnic_orig";
CREATE TABLE "care_type_ethnic_orig" (
    "nr" smallint NOT NULL DEFAULT nextval('"type_eorig_nr_seq"'::text),
    "class_nr" smallint DEFAULT '0',
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "type_eorig_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE type_eorig_nr_seq;

-- 108
-- DROP TABLE "care_type_feeding";
CREATE TABLE "care_type_feeding" (
    "nr" smallint NOT NULL DEFAULT nextval('"type_feed_nr_seq"'::text),
    "group_nr" smallint DEFAULT '0',
    "type" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "description" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "type_feed_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE type_feed_nr_seq;

-- 109
-- DROP TABLE "care_type_insurance";
CREATE TABLE "care_type_insurance" (
    "type_nr" smallint NOT NULL DEFAULT nextval('"type_ins_tnr_seq"'::text),
    "type" character varying(35) NOT NULL,
    "name" character varying(60) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "description" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "type_ins_pkey" PRIMARY KEY ("type_nr")
) WITH OIDS;

CREATE SEQUENCE type_ins_tnr_seq;

-- 110
-- DROP TABLE "care_type_localization";
CREATE TABLE "care_type_localization" (
    "nr" smallint NOT NULL DEFAULT nextval('"type_loc_nr_seq"'::text),
    "category" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "short_code" character(1) NOT NULL,
    "ld_var_short_code" character varying(25) NOT NULL,
    "description" character varying(255) NOT NULL,
    "hide_from" character varying(255) DEFAULT '0',
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "type_loc_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE type_loc_nr_seq;

-- 111
-- DROP TABLE "care_type_location";
CREATE TABLE "care_type_location" (
    "nr" smallint NOT NULL DEFAULT nextval('"type_locat_nr_seq"'::text),
    "type" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "description" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "type_locat_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE type_locat_nr_seq;

-- 112
-- DROP TABLE "care_type_measurement";
CREATE TABLE "care_type_measurement" (
    "nr" smallint NOT NULL DEFAULT nextval('"type_msr_nr_seq"'::text),
    "type" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "type_msr_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE type_msr_nr_seq;

-- 113
-- DROP TABLE "care_type_notes";
CREATE TABLE "care_type_notes" (
    "nr" smallint NOT NULL DEFAULT nextval('"type_notes_nr_seq"'::text),
    "type" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "sort_nr" smallint DEFAULT '0',
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "type_notes_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE type_notes_nr_seq;

-- 114
-- DROP TABLE "care_type_outcome";
CREATE TABLE "care_type_outcome" (
    "nr" smallint NOT NULL DEFAULT nextval('"type_outc_nr_seq"'::text),
    "group_nr" smallint DEFAULT '0',
    "type" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "description" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "type_outc_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE type_outc_nr_seq;

-- 115
-- DROP TABLE "care_type_perineum";
CREATE TABLE "care_type_perineum" (
    "nr" smallint NOT NULL DEFAULT nextval('"type_peri_nr_seq"'::text),
    "id" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "description" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "type_peri_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE type_peri_nr_seq;

-- 116
-- DROP TABLE "care_type_prescription";
CREATE TABLE "care_type_prescription" (
    "nr" smallint NOT NULL DEFAULT nextval('"type_presc_nr_seq"'::text),
    "type" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "type_presc_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE type_presc_nr_seq;

-- 117
-- DROP TABLE "care_type_room";
CREATE TABLE "care_type_room" (
    "nr" smallint NOT NULL DEFAULT nextval('"type_room_nr_seq"'::text),
    "type" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "description" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "type_room_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE type_room_nr_seq;

-- 118
-- DROP TABLE "care_type_test";
CREATE TABLE "care_type_test" (
    "type_nr" smallint NOT NULL DEFAULT nextval('"type_test_tnr_seq"'::text),
    "type" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "description" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "type_test_pkey" PRIMARY KEY ("type_nr")
) WITH OIDS;

CREATE SEQUENCE type_test_tnr_sec;

-- 119
-- DROP TABLE "care_type_time";
CREATE TABLE "care_type_time" (
    "nr" smallint NOT NULL DEFAULT nextval('"type_time_nr_seq"'::text),
    "type" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "description" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "type_time_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE type_time_nr_seq;

-- 120
-- DROP TABLE "care_type_unit_measurement";
CREATE TABLE "care_type_unit_measurement" (
    "nr" smallint NOT NULL DEFAULT nextval('"type_umsr_nr_seq"'::text),
    "type" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "description" character varying(255) NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "type_umsr_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE type_umsr_nr_seq;

-- 121
-- DROP TABLE "care_unit_measurement";
CREATE TABLE "care_unit_measurement" (
    "nr" smallint NOT NULL DEFAULT nextval('"unit_msr_nr_seq"'::text),
    "unit_type_nr" smallint DEFAULT '0',
    "id" character varying(15) NOT NULL,
    "name" character varying(35) NOT NULL,
    "ld_var" character varying(35) NOT NULL,
    "sytem" character varying(35) NOT NULL,
    "use_frequency" bigint NOT NULL,
    "status" character varying(25) NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "unit_msr_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE unit_msr_nr_seq;

-- 122
-- DROP TABLE "care_users";
CREATE TABLE "care_users" (
    "name" character varying(60) NOT NULL,
    "login_id" character varying(35) NOT NULL,
    "password" character varying(255) NOT NULL,
    "personell_nr" integer DEFAULT '0',
    "lockflag" smallint DEFAULT '0',
    "permission" text NOT NULL,
    "exc" smallint DEFAULT '0',
    "s_date" date DEFAULT '0001-01-01',
    "s_time" time without time zone DEFAULT '00:00:00',
    "expire_date" date DEFAULT '0001-01-01',
    "expire_time" time without time zone DEFAULT '00:00:00',
    "status" character varying(15) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(35) NOT NULL,
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(35) NOT NULL,
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "users_pkey" PRIMARY KEY ("login_id")
) WITH OIDS;

-- Indexes

CREATE INDEX login_id ON care_users USING btree (login_id);

-- 123
-- DROP TABLE "care_version";
CREATE TABLE "care_version" (
    "name" character varying(20) NOT NULL,
    "type" character varying(20) NOT NULL,
    "number" character varying(10) NOT NULL,
    "build" character varying(5) NOT NULL,
    "date" date DEFAULT '0001-01-01',
    "time" time without time zone DEFAULT '00:00:00',
    "releaser" character varying(30) NOT NULL
) WITH OIDS;


-- 124
-- DROP TABLE "care_ward";
CREATE TABLE "care_ward" (
    "nr" smallint NOT NULL DEFAULT nextval('"ward_nr_seq"'::text),
    "ward_id" character varying(35) NOT NULL,
    "name" character varying(35) NOT NULL,
    "is_temp_closed" smallint DEFAULT '0',
    "date_create" date DEFAULT '0001-01-01',
    "date_close" date DEFAULT '0001-01-01',
    "description" text NOT NULL,
    "info" text NOT NULL,
    "dept_nr" smallint DEFAULT '0',
    "room_nr_start" smallint DEFAULT '0',
    "room_nr_end" smallint DEFAULT '0',
    "roomprefix" character varying(4) NOT NULL,
    "status" character varying(25) NOT NULL,
    "history" text NOT NULL,
    "modify_id" character varying(25) DEFAULT '0',
    "modify_time" bigint DEFAULT '0',
    "create_id" character varying(25) DEFAULT '0',
    "create_time" bigint DEFAULT '0',
    CONSTRAINT "ward_pkey" PRIMARY KEY ("nr")
) WITH OIDS;

CREATE SEQUENCE ward_nr_seq;

-- Indexes

CREATE INDEX ward_id ON care_ward USING btree (ward_id);






