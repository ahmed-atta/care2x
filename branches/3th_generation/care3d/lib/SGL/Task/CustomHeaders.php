<?php
/**
 * Setup custom headers.
 *
 * @package Task
 * @author  Demian Turner <demian@phpkitchen.com>
 */
class SGL_Task_CustomHeaders extends SGL_DecorateProcess
{
    function process(&$input, &$output)
    {
        SGL::logMessage(null, PEAR_LOG_DEBUG);

        $this->processRequest->process($input, $output);

            //  build P3P headers
        if ($this->conf['p3p']['policies']) {
            $p3pHeader = '';
            if ($this->conf['p3p']['policyLocation'] != '') {
                $p3pHeader .= " policyref=\"" . $this->conf['p3p']['policyLocation']."\"";
            }
            if ($this->conf['p3p']['compactPolicy'] != '') {
                $p3pHeader .= " CP=\"" . $this->conf['p3p']['compactPolicy']."\"";
            }
            if ($p3pHeader != '') {
                header("P3P: $p3pHeader");
            }
        }
        header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        header("Content-Type: $output->contentType");
        header('X-Powered-By: Seagull http://seagullproject.org');
    }
}
?>