<?php
/* 
main domain or ip address
*/
//$main_domain="192.168.0.1"; // for example, default is "localhost"

$main_domain="localhost";

/* 
main ip addres of foto server 
*/
//$fotoserver_ip="192.168.0.2"; // for example , default is "localhost"

$fotoserver_ip="localhost";


$disc_pix_mode=1; // Set to 0 if fotos come via ftp server, set to 1 if fotos come from local  drive directiory, default is 1

/*
FTP username and password for remote files and webcam images
*/

$ftp_user="ftpusername"; // <= change this username
$ftp_pw="ftppassword";   // <= change this password

/*
this is the server address of the http foto server for patients, required for the preview, displaying, etc.
*/
//$fotoserver_http="http://".$fotoserver_ip."/fotos/";

$fotoserver_http="http://".$fotoserver_ip."/fotos/";

/*
this is the server address of the ftp foto server for patients, required for probing the pics filenames, number, etc.
*/
//$fotoserver_ftp="ftp://192.168.0.2:21";

$fotoserver_ftp="ftp://".$fotoserver_ip.":21";

$fotoserver_localpath="../fotos/";

/*
ip address of the ftp server (may be several)
*/
//$ftp_server=$fotoserver_ip;

$ftp_server=$fotoserver_ip;

/*
this is the server addresses of the http xray fotos server for patients, required for the preview, displaying, etc.
*/
//$xray_film_server_http="http://".$fotoserver_ip."/radiology/xrayfilm/";
//$xray_diagnosis_server_http="http://".$fotoserver_ip."/radiology/diagnosis/";

$xray_film_server_http="http://".$fotoserver_ip."/radiology/xrayfilms/";
$xray_diagnosis_server_http="http://".$fotoserver_ip."/radiology/diagnosis/";

$xray_film_localpath="../../radiology/xrayfilms/";
$xray_diagnosis_localpath="../../radiology/diagnosis/";

/*
webcam http server address... the webcam files are deposited to this server through one or
several ftp servers with different ports
*/
$cam_http_1="http://$fotoserver_ip/modules/video_monitor/cam_img/";
$cam_http_2="http://$fotoserver_ip/modules/video_monitor/cam_img/";
$cam_http_3="http://$fotoserver_ip/modules/video_monitor/cam_img/";
$cam_http_4="http://$fotoserver_ip/modules/video_monitor/cam_img/";
$cam_http_5="";
$cam_http_6="";
$cam_http_7="";
$cam_http_8="";

/*
webcam ftp servers addresses for receiving webcam files from one or several webcamera upload servers
*/

?>
