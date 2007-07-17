<?php
/**
 * Table Definition for org_preference
 */
require_once 'DB/DataObject.php';

class DataObjects_Org_preference extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'org_preference';                  // table name
    public $org_preference_id;               // int(11)  not_null primary_key
    public $organisation_id;                 // int(11)  not_null multiple_key
    public $preference_id;                   // int(11)  not_null multiple_key
    public $value;                           // string(128)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Org_preference',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
