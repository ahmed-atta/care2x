<?php
/**
 * Table Definition for module
 */
require_once 'DB/DataObject.php';

class DataObjects_Module extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'module';                          // table name
    public $module_id;                       // int(11)  not_null primary_key
    public $is_configurable;                 // int(1)  
    public $name;                            // string(255)  
    public $title;                           // string(255)  
    public $description;                     // blob(65535)  blob
    public $admin_uri;                       // string(255)  
    public $icon;                            // string(255)  
    public $maintainers;                     // blob(65535)  blob
    public $version;                         // string(8)  
    public $license;                         // string(16)  
    public $state;                           // string(8)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Module',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
