<?php

 	include('../include/inc_db_makelink.php');
	if($link&&$DBLink_OK) 
	{
	
	$sql="CREATE TABLE test_icd10_de (
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
   KEY diagnosis_code (diagnosis_code)
) ";

   if(!mysql_query($sql,$link)) echo "cannot create db";
	
	}
	
	echo $sql;
?>
