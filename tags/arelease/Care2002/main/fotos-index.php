<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_nursing.php");
require("../req/config-color.php");

$breakfile="pflege-station-patientdaten.php?sid=$ck_sid&lang=$lang&edit=$edit&station=$station&pn=$pn";

require("../global_conf/remoteservers_conf.php");

$conn_id=NULL;
$fileroot=strtolower($fileroot);
$filename=array();
//$path="../fotos/".$fileroot."/"; // for local file storage
$path=$fotoserver_http.$fileroot."/"; // for remote file storage if source is remote server 
$localpath="$fotoserver_localpath$fileroot/"; // for file storage if in disc mode only
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?
require("../req/css-a-hilitebu.php");
?>
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
	imgsrc="<? if($disc_pix_mode) print $localpath; else print $path; ?>"+s;
	window.parent.FOTOS_PREVIEW.document.images.preview.src=imgsrc;
	window.parent.FOTOS_PREVIEW.document.picnotes.sdate.value=d;
	window.parent.FOTOS_PREVIEW.document.picnotes.nr.value=p;
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
</script>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor="silver" alink="navy" vlink="navy" onLoad="if (window.focus) window.focus(); window.resizeTo(1000,740);">


<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" >
<tr valign=top>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><? print "$LDPhotos"; ?></STRONG></FONT>
</td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp('nursing_report.php','fotos','','<?=$station ?>','<? print "$LDPhotos"; ?>')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:window.parent.location.replace('<?=$breakfile ?>');" ><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>

<tr>
<td bgcolor=#cde1ec valign=top colspan=2><p><br>
<ul>
<?
print "<font face=arial font size=3 color=maroon><font size=5 >";

$buf=explode("_",$fileroot);

print ucfirst($buf[0])."<br></font>".ucfirst($buf[1]).", ".ucfirst($buf[2])." (";
print str_replace("-",".",$buf[3]).")<br>";
print "</font>";

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
 print $localpath;

}
else
{
// *************** the ff: routine is for the remote file storage accessed by ftp ***************************
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
	//print "<p>";
	//print ($fn=ftp_pwd($conn_id));
	//$fn=ftp_pwd($conn_id);
	//ftp_pasv($conn_id,true);
	//$curdir=ftp_pwd($conn_id);
	//print $curdir."<br>";
	//ftp_chdir($conn_id,$curdir."/");
	$filename=ftp_nlist($conn_id,$fileroot."/.");
	 //while(list($x,$v)=each($filename)) print "<br>".$v;
	}
	else echo "$LDFtpNoLink<p>";

	// close the FTP stream 
	ftp_quit($conn_id); 
 }
  else echo "$LDFtpAttempted<p>"; 
}  
  
$fs=sizeof($filename); 

//".$path."/".$filename[$i]."
print "<b>$LDPhotos";
print " ".$fs." $LDPicShots";
print '</b><br>
	<table border=0>';

array_multisort($filename, SORT_DESC);
//while(list($x,$v)=each($filename)) print $v."<br>";
for($i=0;$i<$fs;$i++)  
{
	if(stristr($filename[$i],".log")) continue; // skip the log file
	 $buf=explode('.',$filename[$i]);
	 $buf=explode('_',$buf[0]);
	$buf1=explode("-",$buf[4]);
	//$buf1=array_reverse($buf1);
	
	print '
	   <tr>
     <td class="a12_w">'. ($dy=implode(".",$buf1));
	if(sizeof($buf)>5) print ' <font color=red size="1">Bild '.$buf[5].'</font>';
 
     print '
	 </td>
	 <td class="a12_gry"><a href="javascript:preview(\''.$filename[$i].'\',\''.$dy.'\',\''.$buf[5].'\')" title="'.$LDClk2Preview.'">
	 <img src="';
	 if($disc_pix_mode) print $localpath; else print $path;
	 print $filename[$i].'" border=0  width="60"></a> </td>
   </tr>';

	
	}
	
	print '
	 </table>';



 ?>

<p>
<a href="javascript:window.parent.location.replace('<?=$breakfile ?>');"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24></a>

</nobr>
</td>
<td>
<img src="../img/pixel.gif" width=50 border="0">

</td>
<td>
<img src="../img/pixel.gif" border="0" name="foto">

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
require("../language/$lang/".$lang."_copyrite.htm");
 ?>
</td>
</tr>
</table>        
&nbsp;




</FONT>


</BODY>
</HTML>
