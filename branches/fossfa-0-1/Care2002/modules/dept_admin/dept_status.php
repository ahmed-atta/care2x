<?php

/**
 * A little helper sctipt that changes department status ans activity.
 * when finished, redirect to configuration list dept_list_config.php
 *
 * TODO: check user permissions first!
 *
 * Author: Kurt Brauchli <kurt.brauchli@unibas.ch>
 */


error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

if(!isset($db)||!$db) include_once($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
{
  $sql = "UPDATE care_department SET ";

  if( isset($_REQUEST['status']) )
    $sql .= " status='".$_REQUEST['status']."', ";

  if( isset($_REQUEST['active']) )
    $sql .= " is_inactive='".(1-$_REQUEST['active'])."', ";
  
  $sql .= " modify_id='".$_SESSION['sess_user_name']."' ".
    " WHERE nr='".$_REQUEST['nr']."'";

  $db->Execute($sql);
}

header( "Location: dept_list_config.php" );

?>