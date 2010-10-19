<?php
/* $Id: text_plain__link.inc.php,v 1.1 2006/01/13 13:42:12 irroal Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

if (!defined('PMA_TRANSFORMATION_TEXT_PLAIN__LINK')){
    define('PMA_TRANSFORMATION_TEXT_PLAIN__LINK', 1);
    
    function PMA_transformation_text_plain__link($buffer, $options = array()) {
        include('./libraries/transformations/global.inc.php');
        
//        $transform_options = array ('string' => '<a href="' . (isset($options[0]) ? $options[0] : '') . '%1$s" title="' . (isset($options[1]) ? $options[1] : '%1$s') . '">' . (isset($options[1]) ? $options[1] : '%1$s') . '</a>');

        $transform_options = array ('string' => '<a href="' . (isset($options[0]) ? $options[0] : '') . $buffer . '" title="' . (isset($options[1]) ? $options[1] : '') . '">' . (isset($options[1]) ? $options[1] : $buffer) . '</a>');

        $buffer = PMA_transformation_global_html_replace($buffer, $transform_options);
        
        return $buffer;

    }
}
