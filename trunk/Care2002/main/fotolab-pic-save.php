<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

if(!$patnum||!$firstname||!$lastname||!$bday||!$maxpic)
	{header("Location:fotolab-dir-select.php?sid=$ck_sid&lang=$lang&maxpic=$maxpic&nopatdata=1"); exit;}; 
require("../language/".$lang."/lang_".$lang."_specials.php");
require("../req/config-color.php");
require("../global_conf/remoteservers_conf.php");

$dirselectfile="fotolab-dir-select.php";
$breakfile="javascript:window.parent.location.replace('spediens.php?sid=$ck_sid&lang=$lang')";
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <style type="text/css" name="s2">
.indx{ font-family:verdana,arial; color:#ffffff; font-size:12; background-color:#6666ff}
</style>
 
<script language="javascript">
<!-- 

function previewpic(fn) {
if(fn=="") return;
else parent.PREVIEWFRAME.document.previewpic.src=fn;

}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>

<? 
require("../req/css-a-hilitebu.php");
?>

</HEAD>

<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 bgcolor=silver  
<? if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG>&nbsp;<?=$LDFotoLab ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" align=right><a href="javascript:history.back();"><img 
src="../img/<?="$lang/$lang" ?>_back2.gif" border=0 width=110 height=24 align="absmiddle" 
style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a 
href="javascript:gethelp('fotolab.php','save','')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?=$breakfile ?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2>
<p><font face=verdana,arial size=2 color="#cc0000">
<?=$LDPicsSaved ?><p>
<font color="#000000">
<?
$picfilename=array();
if($maxpic)
{
		$picdir=strtolower($patnum."_".$lastname."_".$firstname."_".strtr($bday,".","-"));
		
		if($disc_pix_mode) $d=$fotoserver_localpath.$picdir;

		for ($i=0;$i<$maxpic;$i++)
		{

		$picfile="picfile".$i;
		$shotdate="sdate".$i;
		$shotnr="nr".$i;//print $shotnr."<br>";
		if(!$$picfile||!$$shotdate||!$$shotnr) continue;
		$picext=substr($HTTP_POST_FILES[$picfile]['name'],strrpos($HTTP_POST_FILES[$picfile]['name'],".")+1);
		$picext=strtolower($picext);
		if(stristr($$shotnr,"main"))
		{	$picfilename[$i]=$picdir."_main.".$picext;
			$mainidx=$i;
		}
			else $picfilename[$i]=$picdir."_".strtr($$shotdate,".","-")."_".$$shotnr.".".$picext;
		
		print $HTTP_POST_FILES[$picfile]['name'].' <img src="../img/fwd.gif" width=16 height=16 border=0 align="absmiddle"> ';
		//print $HTTP_POST_FILES[$picfile]['size']."<br>";
		//print $HTTP_POST_FILES[$picfile]['type']."<br>";
		//print $HTTP_POST_FILES[$picfile]['tmp_name']."<br>";
		if($disc_pix_mode)
		{
			if(!is_dir($d))	mkdir($d,0777);
			$makenewname='copy("'.$HTTP_POST_FILES[$picfile]['tmp_name'].'","'.$d.'/'.$picfilename[$i].'");';
		}
		else
			$makenewname='copy("'.$HTTP_POST_FILES[$picfile]['tmp_name'].'","../cache/'.$picfilename[$i].'");';
		eval($makenewname);
		print '<font color="#cc0000"><a href="javascript:previewpic(\'';
		if($disc_pix_mode) print $fotoserver_localpath; else print $fotoserver_http;
		print $picdir.'/'.$picfilename[$i].'\')">'.$picfilename[$i].'</a></font>';
 		print '
		<hr>
		';	
		}
	
$filelist=array();

 if(!$disc_pix_mode)
 {
	$user="maryhospital_fotolabor";
	$pw="bong";
	$conn_id = ftp_connect("$ftp_server"); 
	if($conn_id)
	{
		// login with username and password
		$login_result = ftp_login($conn_id, "$user", "$pw"); 

		if($login_result)
		{ 
			$curdir=ftp_pwd($conn_id);
			//ftp_chdir($conn_id,"$curdir/");
			//print $curdir."<br>";
			// now attempt to cd to picdir
			$filelist=ftp_nlist($conn_id,"$curdir/");
			if($filelist)
			{
				//while(list($x,$v)=each($filelist)) print $v."<br>";
				if(in_array(strtolower($picdir),$filelist))
			 	{
					//print "dir found!<br>";
					if(ftp_chdir($conn_id,"$picdir/"))	$cdok=1;
					else
					{
						if(ftp_mkdir($conn_id,$picdir))
						{
						 	if(ftp_chdir($conn_id,"$picdir/"))	$cdok=1;
						}
					}			
				}
				else
				{
					if(ftp_mkdir($conn_id,$picdir))
					{
					 	if(ftp_chdir($conn_id,"$picdir/"))	$cdok=1;
					}
				}	
				if($cdok)
				{
					reset($picfilename);
					for($i=0;$i<$maxpic;$i++)	
					{
						if($picfilename[$i]=="") continue;
					 	if (ftp_put($conn_id,$picfilename[$i],"../cache/".$picfilename[$i],FTP_BINARY))
						 {
			 				if(empty($mainidx)||($i<>$mainidx))
							{
								$removefile='unlink("../cache/'.$picfilename[$i].'");';
								eval($removefile);
							}
						}		
					}
				}
			}
		  	else	print $LDLinkBroken;

			ftp_quit($conn_id); 
		}
	}
 }
}
?>
<font color="#cc0000"><b><?="$LDSave $LDOptions:" ?></b></font>
<form action="<?=$dirselectfile ?>" method="post">
<img src="../img/video.gif" width=15 height=15 border=0><br><?="$LDSave " ?><?=$LDAdditional ?> 
<input type="text" name="maxpic" size=1 maxlength=2 value="<?=$maxpic ?>"> <?=$LDMorePics ?>:<input type="submit" value="<?=$LDGO ?>">
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="lastnr" value="<? $lastnr="nr".($maxpic-1); print $$lastnr; ?>">
<input type="hidden" name="same_pat" value="1">

</form>
<p>
<form action="fotolab-dir-select.php" method="post">
<img src="../img/video.gif" width=15 height=15 border=0><br><?="$LDSave " ?><input type="text" name="maxpic" size=1 maxlength=2 value="<?=$maxpic ?>">
<?=$LDNewPics ?>:<input type="submit" value="<?=$LDGO ?>">
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
</form></FONT>

</td>
</tr>


</table>        
&nbsp;

</BODY>
</HTML>
