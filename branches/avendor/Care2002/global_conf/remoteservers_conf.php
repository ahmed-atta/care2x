<?
// main domain or ip address for example:  192.168.0.8 or www.mycareversion.com
// default is localhost
$main_domain="localhost";

// main ip addres of foto server for example:  192.168.0.12
// default is localhost
$fotoserver_ip="localhost";

// set the following to the user info for the foto ftp server
// default is "anonymous"
$ftp_user="anonymous";

// set the following to the password info for the foto ftp server
// default is "guest@care2x.com"
$ftp_pw="guest@care2x.com";

// set the following to 0 if fotos come via ftp server, set to 1 if fotos come from local  drive directory
// default is 1 (local drive)
$disc_pix_mode=1; 

// webcam http server address... the webcam files are deposited to this server through one or
// several ftp servers with different ports
// format $cam_http_1="http://ip_number/webcam/";
// default is $cam_http_1="http://localhost/webcam/";
$cam_http_1="http://localhost/webcam/";
$cam_http_2="http://localhost/webcam/";
$cam_http_3="http://localhost/webcam/";
$cam_http_4="http://localhost/webcam/";
$cam_http_5="http://localhost/webcam/";
$cam_http_6="http://localhost/webcam/";
$cam_http_7="http://localhost/webcam/";
$cam_http_8="http://localhost/webcam/";

// webcam ftp servers addresses for receiving webcam files from one or several webcamera upload servers


// the following is the server address of the http foto server for patients, required for the preview, displaying, etc.
$fotoserver_http="http://".$fotoserver_ip."/fotos/";

// the following is the server address of the ftp foto server for patients, required for probing the pics filenames, number, etc.
$fotoserver_ftp="ftp://".$fotoserver_ip.":21";
// the following is the local path for patients, required for the preview, displaying, etc.
// do not change unless you are aware of the dependencies
$fotoserver_localpath="../fotos/";

// ip address of the ftp server (may be several)
// default is ftp server ip is equal to foto server ip
$ftp_server=$fotoserver_ip; 

// the following are the http server addresses of the http xray fotos server for patients, required for the preview, displaying, etc.
// do not change unless you are aware of the dependencies
$xray_film_server_http="http://".$fotoserver_ip."/radiology/xrayfilms/";
$xray_diagnosis_server_http="http://".$fotoserver_ip."/radiology/diagnosis/";

// the following are the local paths for xray fotos for patients, required for the preview, displaying, etc.
// do not change unless you are aware of the dependencies
$xray_film_localpath="../radiology/xrayfilms/";
$xray_diagnosis_localpath="../radiology/diagnosis/";

?>
