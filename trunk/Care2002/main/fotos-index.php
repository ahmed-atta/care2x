<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','nursing.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');

$breakfile=$root_path."modules/nursing/nursing-station-patientdaten.php?sid=$sid&lang=$lang&edit=$edit&station=$station&pn=$pn";

require($root_path.'global_conf/inc_remoteservers_conf.php');

$conn_id=NULL;
$fileroot=strtolower($fileroot);
$filename=array();
//$path="../fotos/".$fileroot."/"; // for local file storage
$path=$fotoserver_http.$fileroot."/"; // for  file storage if source is  server 
$localpath="$fotoserver_localpath$fileroot/"; // for file storage if in disc mode only

/* Load date formatter */
include_once($root_path.'include/inc_date_format_functions.php');

/* Create encounter object */
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj= new Encounter;
$enc_obj->loadEncounterData($pn);

/* Load global configs */
include_once($root_path.'include/care_api_classes/class_globalconfig.php');
$GLOBAL_CONFIG=array();
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('patient_%');	

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<style type="text/css">
	.a12_w {font-family: arial; color: navy; font-size:12; background-color:#ffffff}
	.a12_gry {font-family: arial; color: navy; font-size:12; background-color:#000000}
</style>

<script language="javascript">

var x=-1;

function showfoto(srcimg)
{
	if (document.images) document.images.foto.src=srcimg;
	x=-2;
}

function preview(s,d,p)
{
	imgsrc="<?php if($disc_pix_mode) echo $localpath; else echo $path; ?>"+s;
	window.parent.FOTOS_PREVIEW.document.images.preview.src=imgsrc;
	window.parent.FOTOS_PREVIEW.document.picnotes.sdate.value=d;
	window.parent.FOTOS_PREVIEW.document.picnotes.nr.value=p;
}
</script>
<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor="silver" alink="navy" vlink="navy" onLoad="if (window.focus) window.focus(); window.resizeTo(1000,740);">


<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" >
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo "$LDPhotos"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp('nursing_report.php','fotos','','<?php echo $station ?>','<?php echo "$LDPhotos"; ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:window.parent.location.replace('<?php echo $breakfile ?>');" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>

<tr>
<td bgcolor=#cde1ec valign=top colspan=2><p><br>
<ul>
<?php
echo "<font face=arial font size=3 color=maroon><font size=5 >";
switch($enc_obj->EncounterClass())
{
	case 1: echo ($pn+$GLOBAL_CONFIG['patient_inpatient_nr_adder']);
				break;
	case 2: echo ($pn+$GLOBAL_CONFIG['patient_outpatient_nr_adder']);
}
$buf=explode("_",$fileroot);
//echo ucfirst($buf[0])."<br></font>".ucfirst($buf[1]).", ".ucfirst($buf[2])." (";
echo "<br></font>".ucfirst($buf[1]).", ".ucfirst($buf[2])." (";
echo formatDate2Local($buf[3],$date_format).')<br>';
echo "</font>";

?>

<table border=0>
<tr>
<td>
<nobr>
<FONT    SIZE=-1  FACE="Arial">

<?php 

if($disc_pix_mode)
{
// the ff: routine is for the local file storage of images
 	$handle=opendir($localpath); 
 	while (false!==($file = readdir($handle))) 
	{ 
     	if ($file != "." && $file != "..")
		{ 
    		 if((stristr($file,".jpg")!=false)||(stristr($file,".gif")!=false)) $filename[]=$file; 
     	} 
	}
 closedir($handle); 
 //echo $localpath;

}
else
{
// *************** the ff: routine is for the  file storage accessed by ftp ***************************
// set up basic connection

//$ftp_server="192.168.0.2";

//$ftp_user="maryhospital_fotodepot";
//$ftp_pw="seeonly";
$conn_id = ftp_connect("$ftp_server"); 
if($conn_id)
{
	// login with username and password
	$login_result = ftp_login($conn_id, "$ftp_user", "$ftp_pw"); 

	if($login_result)
	{ 
	//echo "<p>";
	//echo ($fn=ftp_pwd($conn_id));
	//$fn=ftp_pwd($conn_id);
	//ftp_pasv($conn_id,true);
	//$curdir=ftp_pwd($conn_id);
	//echo $curdir."<br>";
	//ftp_chdir($conn_id,$curdir."/");
	$filename=ftp_nlist($conn_id,$fileroot."/.");
	 //while(list($x,$v)=each($filename)) echo "<br>".$v;
	}
	else echo "$LDFtpNoLink<p>";

	// close the FTP stream 
	ftp_quit($conn_id); 
 }
  else echo "$LDFtpAttempted<p>"; 
}  
  
$fs=sizeof($filename); 

//".$path."/".$filename[$i]."
echo "<b>$LDPhotos";
echo " ".$fs." $LDPicShots";
echo '</b><br>
	<table border=0>';

array_multisort($filename, SORT_DESC);
//while(list($x,$v)=each($filename)) echo $v."<br>";
for($i=0;$i<$fs;$i++)  
{
	if(stristr($filename[$i],".log")) continue; // skip the log file
	 $buf=explode('.',$filename[$i]);
	 $buf=explode('_',$buf[0]);
	//$buf1=explode("-",$buf[4]);
	//$buf1=array_reverse($buf1);
	
	echo '
	   <tr>
     <td class="a12_w">'. ($dy=formatDate2Local($buf[4],$date_format));
	if(sizeof($buf)>5) echo ' <font color=red size="1">Bild '.$buf[5].'</font>';
 
     echo '
	 </td>
	 <td class="a12_gry"><a href="javascript:preview(\''.$filename[$i].'\',\''.$dy.'\',\''.$buf[5].'\')" title="'.$LDClk2Preview.'">
	 <img src="';
	 if($disc_pix_mode) echo $localpath; else echo $path;
	 echo $filename[$i].'" border=0  width="60"></a> </td>
   </tr>';

	
	}
	
	echo '
	 </table>';



 ?>

<p>
<a href="javascript:window.parent.location.replace('<?php echo $breakfile ?>');"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>

</nobr>
</td>
<td>
<img src="<?php echo $root_path ?>gui/img/common/default/pixel.gif" width=50 border="0">

</td>
<td>
<img src="<?php echo $root_path ?>gui/img/common/default/pixel.gif" border="0" name="foto">

</td>
</tr>
</table>

<p>
</ul>




<p>
</td>
</tr>

<tr>
<td bgcolor=silver height=70 colspan=2>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td>
</tr>
</table>        
&nbsp;




</FONT>


</BODY>
</HTML>
