ALTER TABLE `care_tz_drugsandservices` CHANGE `is_pediatric` `is_pediatric` INT( 6 ) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `care_tz_drugsandservices` CHANGE `is_adult` `is_adult` INT( 6 ) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `care_tz_drugsandservices` CHANGE `is_other` `is_other` INT( 6 ) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `care_tz_drugsandservices` CHANGE `is_consumable` `is_consumable` INT( 6 ) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `care_tz_drugsandservices` CHANGE `is_labtest` `is_labtest` INT( 6 ) UNSIGNED NOT NULL DEFAULT '0';
