<?php
/**
 * Table Definition for langs
 */
require_once 'DB/DataObject.php';

class DataObjects_Langs extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'langs';                           // table name
    public $lang_id;                         // string(16)  unique_key
    public $name;                            // string(200)  
    public $meta;                            // blob(65535)  blob
    public $error_text;                      // string(250)  
    public $encoding;                        // string(16)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Langs',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
