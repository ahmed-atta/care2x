<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_pflege_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_nursing.php");
require("../req/config-color.php"); // load color preferences

$thisfile="pflege-station-patientdaten-rootinfo.php";
$breakfile="pflege-station-patientdaten.php?sid=$ck_sid&lang=$lang&station=$station&pn=$pn";

require("../req/db-makelink.php");
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
		
		
		if($mode=="save")
		{
			if((($dateput)&&($timeput)&&($berichtput)&&($author))||(($dateput2)&&($berichtput2)&&($author2)))
			{
				$report="d=$dateput&t=$timeput&b=$berichtput&a=$author&w=$warn\r\n";
				$report=strtr($report," ","+");
				$np_report="d=$dateput2&t=$timeput2&b=$berichtput2&a=$author2&w=$warn2\r\n";
				$np_report=strtr($np_report," ","+");
				if((!$dateput)&&($dateput2)) $dateput=$dateput2;
				
				// check if entry is already existing
				$dbtable="nursing_station_patients_root";
				$sql="SELECT report,np_report FROM $dbtable WHERE patnum='$pn'";
				if($ergebnis=mysql_query($sql,$link))
       			{
					$rows=0;
					if( $content=mysql_fetch_array($ergebnis)) $rows++;
					if($rows==1)
						{
							mysql_data_seek($ergebnis,0);
							$content=mysql_fetch_array($ergebnis);
							$report=$content[report]."_".$report;
							$np_report=$content[np_report]."_".$np_report;
							
							$sql="UPDATE $dbtable SET report='$report', np_report='$np_report',le_date='$dateput'
									WHERE patnum='$pn'";
							if($ergebnis=mysql_query($sql,$link))
       							{
									//print $sql;
									mysql_close($link);
									header("location:$thisfile?sid=$ck_sid&lang=$lang&saved=1&pn=$pn&station=$station");
								}
								else {print "<p>$sql$LDDbNoUpdate";exit;}
						} // else create new entry
						else
						{
							$sql="INSERT INTO $dbtable 
										(
										patnum,
										lastname,
										firstname,
										bday,
										fe_date,
										le_date,
										report,
										np_report
										)
									 	VALUES
										(
										'$pn',
										'$result[name]',
										'$result[vorname]',
										'$result[gebdatum]',
										'$dateput',
										'$dateput',
										'$report',
										'$np_report'
										)";

							if($ergebnis=mysql_query($sql,$link))
       							{
									//print $sql;
									mysql_close($link);
									header("location:$thisfile?sid=$ck_sid&lang=$lang&saved=1&pn=$pn&station=$station");
								}
								else {print "<p>$sql$LDDbNoSave";exit;}
						}
				}
				else {print "<p>$sql$LDDbNoRead";exit;}
			}
			else $saved=0;
		}// end of if(mode==save)
		
		$dbtable="nursing_station_patients_report";
		$sql="SELECT * FROM $dbtable WHERE patnum='$pn' ";
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
<?
require("../req/css-a-hilitebu.php");
?>
<style type="text/css">
div.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10;}
div.fa2_ml10 {font-family: arial; font-size: 12; margin-left: 10;}
div.fva2_ml3 {font-family: verdana; font-size: 12; margin-left: 3; }
div.fa2_ml3 {font-family: arial; font-size: 12; margin-left: 3; }
.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000099;}
.fva2b_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000000;}
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
		alert("Es fehlen noch Angaben!");
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
/*
	var elemlen=document.berichtform.elements.length;
	for (var i=0;i<elemlen;i++){ document.berichtform.elements[i].value="";}
	document.berichtform.elements[focusflag].focus();
	*/
	}

function select_this(formtag){
		document.berichtform.elements[formtag].select();
	}
	
function getinfo(patientID){
	urlholder="pflege-station.php?route=validroute&patient=" + patientID + "&user=<? print $aufnahme_user.'"' ?>;
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
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
//-->
</script>
<script language="javascript" src="../js/setdatetime.js">
</script>
</HEAD>

<BODY bgcolor=<? print $cfg['body_bgcolor']; ?> 
onLoad="if (window.focus) window.focus(); 
<? if(($mode=="save")||($saved)) print ";window.location.href='#bottom';document.berichtform.berichtput.focus()"; ?>"  
topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="5" cellspacing=0>
<tr>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><? print "$LDRootData $station"; ?></STRONG></FONT>
</td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp()"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?=$breakfile ?>" ><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td bgcolor=<? print $cfg['body_bgcolor']; ?> colspan=2>
 <ul>

<form name="berichtform" method="get" action="<?=$thisfile ?>" onSubmit="return pruf(this)">
<?

print '
		<table   cellpadding="0" cellspacing=1 border="0" width=700>';
print '
		<tr  valign="top">
		<td  bgcolor="#ffffff" ><div class=fva2b_ml10><span style="background:yellow"><b>'.$result[patnum].'</b></span><br>
		<b>'.$result[name].', '.$result[vorname].'</b> <br>
		<font color=maroon>'.$result[gebdatum].'</font> <p><font size=1>
		'.nl2br($result[address]).'<p>
		'.$station.'&nbsp;'.$result[kasse].' '.$result[kassename].'</div></td>';
print '
		<td bgcolor="#ffffff"  class=fva2_ml10><div   class=fva2_ml10><font size=5 color="#0000ff"><b>Stammblatt</b>
		<table border=0 cellspacing=0 cellpadding=0>
    <tr>
      <td class=fva2_ml10>Kontaktperson 1&nbsp;</td>
      <td class=fva2_ml10><input type="text" name="cperson1" size=25 maxlength=30></td>
    </tr>
    <tr>
      <td  class=fva2_ml10>Telefonnummer:</td>
      <td class=fva2_ml10><input type="text" name="cphone1" size=25 maxlength=30></td>
    </tr>
    <tr>
      <td class=fva2_ml10>Kontaktperson 2&nbsp;</td>
      <td class=fva2_ml10><input type="text" name="cperson2" size=25 maxlength=30></td>
    </tr>
    <tr>
      <td class=fva2_ml10>Telefonnummer:</td>
      <td class=fva2_ml10><input type="text" name="cphone2" size=25 maxlength=30></td>
    </tr>
  </table>
  		</div>
		</td></tr>';


?>
	<tr bgcolor="#ffffff">
		<td colspan=2><div class=fva2_ml10><font color="#000099">
		<b>Grund der Aufnahme</b>
		<input type="text" name="reason" size=60 maxlength=100>
  </div></td>
		</tr>	
		<tr bgcolor="#ffffff">
		<td ><div class=fva2_ml10><font color="#000099">
		<input type="checkbox" name="glass" >
		Brille > 		
		<input type="checkbox" name="clens" >
		Kontaktlens >  </div></td>
			<td ><div class=fva2_ml10><font color="#000099">
		 weitere Angaben:
		<input type="text" name="glass_info" size=40 maxlength=60>
		
  </div></td>
</tr>
	<tr bgcolor="#ffffff">
		<td ><div class=fva2_ml10><font color="#000099">
		<input type="checkbox" name="fteeth" >
		Zahnprothese > 		
  </div></td>
			<td ><div class=fva2_ml10><font color="#000099">
		 weitere Angaben:
		<input type="text" name="fteeth_info" size=40 maxlength=60>
		
  </div></td>
</tr>
	<tr bgcolor="#ffffff">
		<td ><div class=fva2_ml10><font color="#000099">
		<input type="checkbox" name="hws" >
		HWS > 		
  </div></td>
			<td ><div class=fva2_ml10><font color="#000099">
		 weitere Angaben:
		<input type="text" name="hws_info" size=40 maxlength=60>
		
  </div></td>
</tr>
	<tr bgcolor="#ffffff">
		<td colspan=2><div class=fva2_ml10><font color="#000099">
		Allergy:
		<input type="text" name="allergy" size=60 maxlength=100>
  </div></td>
		</tr>	
	<tr bgcolor="#ffffff">
		<td colspan=2><div class=fva2_ml10><font color="#000099">
		Medication: 
		<input type="text" name="medx" size=60 maxlength=100>
  </div></td>
		</tr>	
	<tr bgcolor="#ffffff">
		<td ><div class=fva2_ml10><font color="#000099">
		 Datum:
		<input type="text" name="edate" size=15 maxlength=60>
  </div></td>
			<td ><div class=fva2_ml10><font color="#000099">
		Aufgenommen von:
		<input type="text" name="encoder" size=40 maxlength=60>
		
  </div></td>
</tr>

		</table>


<p>

<table width="650"  cellpadding="0" cellspacing="0">
<tr><td>
<input type="image" src="../img/<?="$lang/$lang" ?>_savedisc.gif" border=0 width=99 height=24 alt="<?=$LDSave ?>">
</td>
<td align=right>
<a href="javascript:resetinput()"><img src="../img/<?="$lang/$lang" ?>_reset.gif" border="0"  width=156 height=24 alt="<?=$LDReset ?>"></a>
&nbsp;&nbsp;
<a href="<?=$breakfile ?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border="0" width=103 height=24 alt="<?=$LDClose ?>"></a>
</td>
</tr>
</table>
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="station" value="<?=$station ?>">
<input type="hidden" name="pn" value="<?=$pn ?>">
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
require("../language/$lang/".$lang."_copyrite.htm");
 ?>
<a name="bottom"></a>
</BODY>
</HTML>
