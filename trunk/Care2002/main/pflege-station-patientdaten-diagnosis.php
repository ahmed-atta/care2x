<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","nursing.php");
$local_user="ck_pflege_user";
require("../include/inc_front_chain_lang.php");
if($edit&&!$HTTP_COOKIE_VARS[$local_user.$sid]) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../include/inc_config_color.php"); // load color preferences

$thisfile="pflege-station-patientdaten-diagnosis.php";
$breakfile="pflege-station-patientdaten.php?sid=$sid&lang=$lang&station=$station&pn=$pn&edit=$edit";

$bgc1="#fefefe"; 
	
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
	
require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK) 
	{	
		// get orig data
		$dbtable="mahopatient";
		$sql="SELECT * FROM $dbtable WHERE patnum='$pn' ";
		if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $result=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
					{
						mysql_data_seek($ergebnis,0);
						$result=mysql_fetch_array($ergebnis);
					}
				}
			else {print "<p>$sql$LDDbNoRead";exit;}
			
		$dbtable="nursing_station_patients_diagnostic_reports";
		$sql="SELECT * FROM $dbtable WHERE patnum='$pn' AND dept='$dept'";
		if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $content=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
					{
						mysql_data_seek($ergebnis,0);
						$content=mysql_fetch_array($ergebnis);
						//print $sql;
						//print $content[report];
					}
				}
			else{print "<p>$sql$LDDbNoRead";exit;}
	}
	else 
		{ print "$LDDbNoLink<br>$sql<br>"; }
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE><?php echo $LDReports ?></TITLE>
<?php
require("../include/inc_css_a_hilitebu.php");
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

<BODY bgcolor=<?php print $cfg['body_bgcolor']; ?> 
onLoad="if (window.focus) window.focus(); 
<?php if(($mode=="save")||($saved)) print ";window.location.href='#bottom';document.berichtform.berichtput.focus()"; ?>"  
topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<script>	
window.moveTo(0,0);
	 window.resizeTo(1000,740);
</script>

<table width=100% border=0 cellpadding="5" cellspacing=0>
<tr>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php print "$LDReports $station"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp('nursing_report.php','<?php echo $LDReports; ?>','','<?php echo $station ?>','<?php echo $LDReports; ?>')"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> colspan=2>
 <ul>

<form name="berichtform" method="get" action="<?php echo $thisfile ?>" onSubmit="return pruf(this)">
<?php
print '<table border=0 cellspacing=0 cellpadding=1 bgcolor="#000000">
         <tr>
           <td>
		<table   cellpadding="0" cellspacing=0 border="0" >';
print '
		<tr  valign="top">
		<td  bgcolor="#ffffff" ><div class=fva2b_ml10><span style="background:yellow"><b>'.$result[patnum].'</b></span><br>
		<b>'.$result[name].', '.$result[vorname].'</b> <br>
		<font color=maroon>'.$result[gebdatum].'</font> <br><font size=1>
		'.nl2br($result[address]).'<p>
		'.$station.'&nbsp;'.$result[kasse].' '.$result[kassename].'</div></td>';
print '
		<td bgcolor="'.$bgc1.'"  class=fva2_ml10><div   class=fva2_ml10><font size=5 color="#0000ff"><b>'.$deptname.'</b></font>
		 <p>'.$LDStation.'/'.$LDDept.':<br>'.strtoupper($station).'
  		</div>
		</td></tr>';


?>
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td colspan=2><div class=fva2_ml10>&nbsp;<br><?php echo $LDDiagnosticReport ?>:<br>
		<img src="../img/pixel.gif" border=0 width=1 height=200 align="left">
				</td>
		</tr>	

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td ><div class=fva2_ml10><font color="#000099">
<?php echo $LDAddendum ?> :
  </div></td>
			<td ><div class=fva2_ml10><font color="#000099">
		<input type="text" name="hws_info" size=40 maxlength=60>
		
  </div></td>
</tr>
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  valign=top><div class=fva0_ml10><font color="#000099">
		<?php echo $LDCallBackPhone ?>:<br><input type="text" name="sb_info" size=20 maxlength=25><br>&nbsp;
  </div></td>
			<td  valign=top><div class=fva0_ml10><font color="#000099">
		 <?php echo $LDSpecialNotice ?>:<br>
		<input type="text" name="specials" size=55 maxlength=60><br>&nbsp;
		
  </div></td>
</tr>
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td ><div class=fva2_ml10><font color="#000099">
		 <?php echo $LDDate ?>:
		<?php echo date("d.m.Y") ?>
  </div></td>
			<td ><div class=fva2_ml10><font color="#000099">
		<?php echo $LDDoctor ?>:
		<input type="text" name="encoder" size=25 maxlength=30>
		<?php echo $LDPassword ?>:
		<input type="password" name="encoder" size=15 maxlength=20>
  </div></td>
</tr>
		</table>
</td>
      </tr>
       </table>
       

<p>
<table width="650"  cellpadding="0" cellspacing="0">
<tr>
<td >
<a href="<?php echo $breakfile ?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border="0" width=103 height=24 alt="<?php echo $LDClose ?>"></a>
</td>
</tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="station" value="<?php echo $station ?>">
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="mode" value="save">

</form>


</FONT>

</ul>

<p>
</td>


</tr>
</table>        
<p>

<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>
<a name="bottom"></a>
</BODY>
</HTML>
