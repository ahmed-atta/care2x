<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once('../include/inc_front_chain_lang.php');
if($edit&&!$HTTP_COOKIE_VARS[$local_user.$sid]) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require_once('../include/inc_config_color.php'); // load color preferences

$thisfile='pflege-station-patientdaten-diagnosis.php';
$breakfile="pflege-station-patientdaten.php?sid=$sid&lang=$lang&station=$station&pn=$pn&edit=$edit";

$bgc1='#fefefe'; 
	
$abtname=get_meta_tags("../global_conf/$lang/konsil_tag_dept.pid");

if($dept)
{
	while(list($x,$v)=each($abtname))
	{
		if($dept==$x)
		{
			$deptname=$v;
			reset($abtname);
			break;
		}
	}
}
else
{
	if(list($x,$v)=each($abtname))
	{
		$deptname=$v;
		reset($abtname);
	}
	else 
	{
		header($breakfile);
		exit;
	}
}
	
/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
	{	
	
		$dbtable='care_admission_patient';
		
		// get orig data
		$sql="SELECT * FROM $dbtable WHERE patnum='$pn' ";
		if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if($rows=mysql_num_rows($ergebnis))
				{
					$result=mysql_fetch_array($ergebnis);
				}
			}
			else
			{echo "<p>$sql$LDDbNoRead";exit;}
			
		$dbtable='care_nursing_station_patients_diagnostics_report';
		
		$sql="SELECT * FROM $dbtable WHERE patnum='$pn'";
		
		if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if($rows=mysql_num_rows($ergebnis))
					{
						$content=mysql_fetch_array($ergebnis);
						//echo $sql;
						//echo $content[report];
					}
				}
			else{echo "<p>$sql$LDDbNoRead";exit;}

       include_once('../include/inc_date_format_functions.php');
       
	}
	else 
		{ echo "$LDDbNoLink<br>$sql<br>"; }
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo $LDReports ?></TITLE>
<?php
require('../include/inc_css_a_hilitebu.php');
?>

<style type="text/css">
div.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10;}
div.fa2_ml10 {font-family: arial; font-size: 12; margin-left: 10;}
div.fva2_ml3 {font-family: verdana; font-size: 12; margin-left: 3; }
div.fa2_ml3 {font-family: arial; font-size: 12; margin-left: 3; }
.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000099;}
.fva2b_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000000;}
.fva0_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#000099;}
</style>

<script language="javascript">
<!-- 
  var urlholder;
  var focusflag=0;
  var formsaved=0;
  
function pruf(d){
	if(((d.dateput.value)&&(d.timeput.value)&&(d.berichtput.value)&&(d.author.value))||((d.dateput2.value)&&(d.berichtput2.value)&&(d.author2.value))) return true;
	else 
	{
		alert("<?php echo $LDAlertIncomplete ?>");
		return false;
	}
}

function submitform(){
	document.forms[0].submit();
	}

function closewindow(){
	opener.window.focus();
	window.close();
	}

function resetinput(){
	document.berichtform.reset();
	}

function select_this(formtag){
		document.berichtform.elements[formtag].select();
	}
	
function getinfo(patientID){
	urlholder="pflege-station.php?<?php echo "sid=$sid&lang=$lang" ?>&route=validroute&patient=" + patientID + "&user=<?php echo $HTTP_COOKIE_VARS[$local_user.$sid].'"' ?>;
	patientwin=window.open(urlholder,patientID,"width=600,height=400,menubar=no,resizable=yes,scrollbars=yes");
	}
function sethilite(d){
	d.focus();
	d.value=d.value+"~";
	d.focus();
	}
function endhilite(d){
	d.focus();
	d.value=d.value+"~~";
	d.focus();
	}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
-->
</script>
<script language="javascript" src="../js/setdatetime.js">
</script>
</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> 
onLoad="if (window.focus) window.focus(); 
<?php if(($mode=='save')||($saved)) echo ";window.location.href='#bottom';document.berichtform.berichtput.focus()"; ?>"  
topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<script>	
window.moveTo(0,0);
	 window.resizeTo(1000,740);
</script>

<table width=100% border=0 cellpadding="5" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo "$LDReports $station"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp('nursing_report.php','<?php echo $LDReports; ?>','','<?php echo $station ?>','<?php echo $LDReports; ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc('../','close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> colspan=2>
 <ul>



</ul>

<p>
</td>


</tr>
</table>        
<p>

<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
<a name="bottom"></a>
</BODY>
</HTML>
