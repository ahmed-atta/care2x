<?php

$allow_area['admit']=array('_a_1_admissionwrite');

$allow_area['cafe']=array('_a_1_newsallwrite', '_a_1_newscafewrite');

$allow_area['medocs']=array('_a_1_medocswrite');

$allow_area['phonedir']=array($all, $sysadmin);

$allow_area['doctors']=array('_a_1_opdoctorallwrite', '_a_1_doctorsdutyplanwrite');

$allow_area['wards']=array('_a_1_doctorsdutyplanwrite', '_a_1_opdoctorallwrite', '_a_1_nursingstationallwrite',  $all, $sysadmin);

$allow_area['op_room']=array('_a_1_opdoctorallwrite', '_a_1_opnursedutyplanwrite', '_a_2_opnurseallwrite');

$allow_area['tech']=array('_a_1_techreception');

$allow_area['lab_r']=array('_a_1_labresultswrite', '_a_2_labresultsread');

$allow_area['lab_w']=array('_a_1_labresultswrite');

$allow_area['radio']=array('_a_1_radiowrite', '_a_1_opdoctorallwrite', '_a_2_opnurseallwrite');

$allow_area['pharma_db']=array('_a_1_pharmadbadmin');

$allow_area['pharma_receive']=array('_a_1_pharmadbadmin', '_a_2_pharmareception');

$allow_area['pharma']=array('_a_1_pharmadbadmin', '_a_2_pharmareception',  '_a_3_pharmaorder');

$allow_area['depot_db']=array('_a_1_meddepotdbadmin');

$allow_area['depot_receive']=array('_a_1_meddepotdbadmin', '_a_2_meddepotreception');

$allow_area['depot']=array('_a_1_meddepotdbadmin', '_a_2_meddepotreception', '_a_3_meddepotorder');

$allow_area['edp']=array('no_allow_type_all',);

$allow_area['news']=array('_a_1_newsallwrite');

$allow_area['cafenews']=array('_a_1_newsallwrite', '_a_2_newscafewrite');

$allow_area['op_docs']=array('_a_1_opdoctorallwrite');

$allow_area['duty_op']=array('_a_1_opnursedutyplanwrite');

$allow_area['fotolab']=array('_a_1_photowrite');

$allow_area['test_diagnose']=array('_a_1_diagnosticsresultwrite', '_a_1_labresultswrite');

$allow_area['test_receive']=array('_a_1_diagnosticsresultwrite', '_a_1_labresultswrite', '_a_2_diagnosticsreceptionwrite');

$allow_area['test_order']=array('_a_1_diagnosticsresultwrite', '_a_1_labresultswrite', '_a_2_diagnosticsreceptionwrite',   '_a_3_diagnosticsrequest');

?>
