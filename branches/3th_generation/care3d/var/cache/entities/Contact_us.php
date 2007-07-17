<?php
/**
 * Table Definition for contact_us
 */
require_once 'DB/DataObject.php';

class DataObjects_Contact_us extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'contact_us';                      // table name
    public $contact_us_id;                   // int(11)  not_null primary_key
    public $first_name;                      // string(64)  
    public $last_name;                       // string(32)  
    public $email;                           // string(128)  
    public $enquiry_type;                    // string(32)  
    public $user_comment;                    // blob(65535)  blob

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Contact_us',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
