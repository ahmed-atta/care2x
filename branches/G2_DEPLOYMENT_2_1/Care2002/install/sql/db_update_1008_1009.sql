# Note: This script is valid only to update a 1.0.08 database to 1.0.09 database schema

# Alter the care_mail_private table

ALTER TABLE care_mail_private CHANGE recipient recipient VARCHAR( 60 ) NOT NULL ,
CHANGE sender sender VARCHAR( 60 ) NOT NULL ,
CHANGE sender_ip sender_ip VARCHAR( 60 ) NOT NULL ,
CHANGE cc cc VARCHAR( 255 ) NOT NULL ,
CHANGE bcc bcc VARCHAR( 255 ) NOT NULL ,
CHANGE subject subject VARCHAR( 255 ) NOT NULL ,
CHANGE sign sign VARCHAR( 255 ) NOT NULL ,
CHANGE reply2 reply2 VARCHAR( 255 ) NOT NULL ,
CHANGE attachment attachment VARCHAR( 255 ) NOT NULL ,
CHANGE attach_type attach_type VARCHAR( 30 ) NOT NULL ,
CHANGE mailgroup mailgroup VARCHAR( 60 ) NOT NULL ,
CHANGE maildir maildir VARCHAR( 60 ) NOT NULL ,
CHANGE uid uid VARCHAR( 255 ) NOT NULL ;


ALTER TABLE care_mail_private_users CHANGE user_name user_name VARCHAR( 60 ) NOT NULL ,
CHANGE email email VARCHAR( 60 ) NOT NULL ,
CHANGE alias alias VARCHAR( 60 ) NOT NULL ,
CHANGE pw pw VARCHAR( 255 ) NOT NULL;

ALTER TABLE care_room CHANGE nr nr INT( 8 ) UNSIGNED DEFAULT '0' NOT NULL AUTO_INCREMENT;

ALTER TABLE care_news_article CHANGE preface preface TEXT NOT NULL;

ALTER TABLE care_nursing_op_logbook RENAME care_encounter_op;
