<?php
/**
 * Table Definition for organisation
 */
require_once 'DB/DataObject.php';

class DataObjects_Organisation extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'organisation';                    // table name
    public $organisation_id;                 // int(11)  not_null primary_key
    public $parent_id;                       // int(11)  not_null
    public $root_id;                         // int(11)  not_null
    public $left_id;                         // int(11)  not_null
    public $right_id;                        // int(11)  not_null
    public $order_id;                        // int(11)  not_null
    public $level_id;                        // int(11)  not_null
    public $role_id;                         // int(11)  not_null
    public $organisation_type_id;            // int(11)  not_null
    public $name;                            // string(128)  
    public $description;                     // blob(65535)  blob
    public $addr_1;                          // string(128)  not_null
    public $addr_2;                          // string(128)  
    public $addr_3;                          // string(128)  
    public $city;                            // string(32)  not_null
    public $region;                          // string(32)  
    public $country;                         // string(2)  
    public $post_code;                       // string(16)  
    public $telephone;                       // string(32)  
    public $website;                         // string(128)  
    public $email;                           // string(128)  
    public $date_created;                    // datetime(19)  binary
    public $created_by;                      // int(11)  
    public $last_updated;                    // datetime(19)  binary
    public $updated_by;                      // int(11)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Organisation',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
