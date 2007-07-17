<?php
/**
 * Table Definition for uri_alias
 */
require_once 'DB/DataObject.php';

class DataObjects_Uri_alias extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'uri_alias';                       // table name
    public $uri_alias_id;                    // int(11)  not_null primary_key unsigned
    public $uri_alias;                       // string(255)  unique_key
    public $section_id;                      // int(11)  
    public $title;                           // string(255)  
    public $keywords;                        // blob(65535)  blob
    public $description;                     // blob(65535)  blob

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Uri_alias',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
