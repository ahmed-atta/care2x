<?php
if(file_exists("../language/$lang/lang_".$lang."_checkdate.php")) include_once("../language/$lang/lang_".$lang."_checkdate.php");
 else include_once("../language/en/lang_en_checkdate.php");
?>

var errDate="<?php echo $LDErrorDate.'   ['.$date_format.']'; ?>";
var errDateLen="<?php echo $LDErrorDateLen ?>";
var errDateFormat="<?php echo $LDErrorDateFormat ?>";
var errNotNumeric="<?php echo $LDErrorNotNumeric ?>";
var errYear="<?php echo $LDErrorYear ?>";
var errMonth="<?php echo $LDErrorMonth ?>";
var errDay="<?php echo $LDErrorDay ?>";
