<?php
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
require_once($root_path.'include/care_api_classes/class_userconfig.php');


if($HTTP_SESSION_VARS['sess_level2_logged'] && $HTTP_SESSION_VARS['sess_level2_user_id']) {
    $user_id = $HTTP_SESSION_VARS['sess_level2_user_id'];
} elseif ($HTTP_SESSION_VARS['sess_level1_logged'] && $HTTP_SESSION_VARS['sess_level1_user_id']) {
    $user_id = $HTTP_SESSION_VARS['sess_level1_user_id'];
} elseif ($HTTP_SESSION_VARS['sess_user_id']) {
    $user_id = $HTTP_SESSION_VARS['sess_user_id'];
} else {
    $user_id = $HTTP_COOKIE_VARS['ck_config'];
}
?>
