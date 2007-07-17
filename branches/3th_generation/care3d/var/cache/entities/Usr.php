<?php
/**
 * Table Definition for usr
 */
require_once 'DB/DataObject.php';

class DataObjects_Usr extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'usr';                             // table name
    public $usr_id;                          // int(11)  not_null primary_key
    public $organisation_id;                 // int(11)  
    public $role_id;                         // int(11)  not_null
    public $username;                        // string(64)  
    public $passwd;                          // string(32)  
    public $first_name;                      // string(128)  
    public $last_name;                       // string(128)  
    public $telephone;                       // string(16)  
    public $mobile;                          // string(16)  
    public $email;                           // string(128)  
    public $addr_1;                          // string(128)  
    public $addr_2;                          // string(128)  
    public $addr_3;                          // string(128)  
    public $city;                            // string(64)  
    public $region;                          // string(32)  
    public $country;                         // string(2)  
    public $post_code;                       // string(16)  
    public $is_email_public;                 // int(6)  
    public $is_acct_active;                  // int(6)  
    public $security_question;               // int(6)  
    public $security_answer;                 // string(128)  
    public $date_created;                    // datetime(19)  binary
    public $created_by;                      // int(11)  
    public $last_updated;                    // datetime(19)  binary
    public $updated_by;                      // int(11)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Usr',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
