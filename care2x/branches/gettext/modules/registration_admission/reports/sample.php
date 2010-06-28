<?
require ('./roots.php') ;
$pidbarcode = $root_path . 'cache/barcodes/pn_' . $_GET['pid'] . '.png' ;
//echo $pidbarcode;
# Include AgataAPI class
include_once('../../../classes/agata/classes/helpers/AgataAPI.class');

# Instantiate AgataAPI
$api = new AgataAPI;
$api->setLanguage('en'); //'en', 'pt', 'es', 'de', 'fr', 'it', 'se'
$api->setReportPath(getcwd() . '/sample_registration_ticket.agt');
$api->setProject('sample_registration_ticket');
$api->setOutputPath(tmpfile());

#How to set parameters, if they exist
$api->setParameter('$pid', $_GET['pid']);
$api->setParameter('$barcode1', $pidbarcode);
$api->setParameter('$barcode2', $pidbarcode);

$ok = $api->generateLabel();
if (!$ok) {
    echo $api->getError();
} else {
    $api->fileDialog();
}

?>
