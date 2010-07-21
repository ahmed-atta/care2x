<?php
/* This routine includes the language tables which are listed in the array $lang_tables */
for($tc=0;$tc<sizeof($lang_tables);$tc++) {
    if(file_exists(CARE_BASE .'language/'.$lang.'/lang_'.$lang.'_'.$lang_tables[$tc]))    include(CARE_BASE .'language/'.$lang.'/lang_'.$lang.'_'.$lang_tables[$tc]);
       else include(CARE_BASE .'language/'.LANG_DEFAULT.'/lang_'.LANG_DEFAULT.'_'.$lang_tables[$tc]);
}
/*
for($tc=0;$tc<sizeof($lang_tables);$tc++) {
    if(file_exists(CARE_BASE .'language/'.$lang.'/lang_'.$lang.'_'.$lang_tables[$tc]))    include_once(CARE_BASE .'language/'.$lang.'/lang_'.$lang.'_'.$lang_tables[$tc]);
       else include_once(CARE_BASE .'language/'.LANG_DEFAULT.'/lang_'.LANG_DEFAULT.'_'.$lang_tables[$tc]);
}
*/
?>