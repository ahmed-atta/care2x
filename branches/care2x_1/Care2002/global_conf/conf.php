<?php
/**
* This is the global configuration file similar to ini files of other programs
*
*/

/**
*  domain or ip address
*/
$main_domain="192.168.0.1";

/** 
* main ip addres of foto server 
*/
$disc_pix_mode=1; // set to 0 if fotos come via ftp server, set to 1 if fotos come from local  drive directiory
//$fotoserver_ip="192.168.0.2";
$fotoserver_ip="192.168.0.5";
$ftp_user="maryhospital_fotodepot";
$ftp_pw="seeonly";

/**
* this is the server address of the http foto server for patients, required for the preview, displaying, etc.
*/

//$fotoserver_http="http://".$fotoserver_ip."/fotos/";
$fotoserver_http="http://".$fotoserver_ip."/fotos/";

/**
* this is the server address of the ftp foto server for patients, required for probing the pics filenames, number, etc.
*/
//$fotoserver_ftp="ftp://192.168.0.2:21";
$fotoserver_ftp="ftp://".$fotoserver_ip.":21";

$fotoserver_localpath="../fotos/";

/**
* ip address of the ftp server (may be several)
*/
//$ftp_server=$fotoserver_ip;
$ftp_server=$fotoserver_ip;

/**
* this is the server addresses of the http xray fotos server for patients, required for the preview, displaying, etc.
*/
//$xray_film_server_http="http://".$fotoserver_ip."/radiology/xrayfilm/";
//$xray_diagnosis_server_http="http://".$fotoserver_ip."/radiology/diagnosis/";
$xray_film_server_http="http://".$fotoserver_ip."/radiology/xrayfilms/";
$xray_diagnosis_server_http="http://".$fotoserver_ip."/radiology/diagnosis/";

$xray_film_localpath="../radiology/xrayfilms/";
$xray_diagnosis_localpath="../radiology/diagnosis/";
/**
* webcam http server address... the webcam files are deposited to this server through one or
* several ftp servers with differeng ports
*/
$cam_http_1="http://192.168.0.1/webcam/";
$cam_http_2="http://192.168.0.2/webcam/";
$cam_http_3="http://192.168.0.2/webcam/";
$cam_http_4="http://192.168.0.2/webcam/";
$cam_http_5="";
$cam_http_6="";
$cam_http_7="";
$cam_http_8="";

/**
* webcam ftp servers addresses for receiving webcam files from one or several webcamera upload servers
*/

/**
* Default language, it will be used in case the language code is missing or invalid
*/ 
$lang_default="en";

?>
