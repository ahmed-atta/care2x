# This script only updates the database of version 1.0.09 to version 1.0.10

ALTER TABLE care_address_citytown CHANGE status status VARCHAR( 25 ) NOT NULL;

UPDATE care_address_citytown SET status='' WHERE 1;
