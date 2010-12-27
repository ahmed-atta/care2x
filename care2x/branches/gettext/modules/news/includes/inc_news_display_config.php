<?php
# Get the  config depending on the current logged user id
require_once($root_path.'include/core/class_globalconfig.php');
require_once($root_path.'include/core/class_userconfig.php');


if (isset($_SESSION['sess_user_id'])) {
    $user_id = $_SESSION['sess_user_id'];
} else {
    $user_id = $_COOKIE['ck_config'];
}

$userobj=new UserConfig;
$globobj=new GlobalConfig($GLOBALCONFIG);

$USERCONFIG=$userobj->getConfig($user_id);
$globobj->getConfig('news_%');

while(list($x,$v)=each($GLOBALCONFIG)) {
    $$x=($USERCONFIG[$x]) ? $USERCONFIG[$x] : $GLOBALCONFIG[$x];
}

if(!$news_normal_preview_maxlen) $news_normal_preview_maxlen=300;


# Load editor functions
require_once($root_path.'modules/news/includes/inc_editor_fx.php');

require_once($root_path.'include/helpers/inc_date_format_functions.php');
?>
