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

$thisfile="pflege-station-patientdaten-pbericht.php";
$breakfile="pflege-station-patientdaten.php?sid=$sid&lang=$lang&station=$station&pn=$pn&edit=$edit";
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
			else{print "<p>$sql$LDDbNoRead";}
		
		
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
				$dbtable="nursing_station_patients_report";
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
									header("location:$thisfile?sid=$sid&lang=$lang&saved=1&pn=$pn&station=$station&edit=$edit");
								}
								else {print "<p>$sql$LDDbNoUpdate";}
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
									header("location:$thisfile?sid=$sid&lang=$lang&saved=1&pn=$pn&station=$station&edit=$edit");
								}
								else {print "<p>$sql$LDDbNoSave";}
						}
				}
				else {print "<p>$sql$LDDbNoRead";}
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
			else{print "<p>$sql$LDDbNoRead";}
	}
	else 
		{ print "$LDDbNoLink<br>$sql<br>"; }
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
require("../include/inc_css_a_hilitebu.php");
?>
<style type="text/css">
div.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10;}
div.fa2_ml10 {font-family: arial; font-size: 12; margin-left: 10;}
div.fva2_ml3 {font-family: verdana; font-size: 12; margin-left: 3; }
div.fa2_ml3 {font-family: arial; font-size: 12; margin-left: 3; }
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
	urlholder="pflege-station.php?sid=<?php echo "$sid&lang=$lang" ?>&route=validroute&patient=" + patientID + "&user=<?php echo $HTTP_COOKIE_VARS[$local_user.$sid].'"' ?>;
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
<?php if((($mode=="save")||($saved))&&$edit) print ";window.location.href='#bottom';document.berichtform.berichtput.focus()"; ?>"  
topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="2" cellspacing=0>
<tr>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php print "$LDNursingReport $station"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp('nursing_report.php','','','<?php echo $station ?>','<?php echo $LDNursingReport ?>')"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> colspan=2>
 <ul>

<form name="berichtform" method="get" action="<?php echo $thisfile ?>" onSubmit="return pruf(this)">
<?php
print '<table   cellpadding="0" cellspacing=1 border="0"  width="650">';

print '<tr  valign="top">
		<td colspan=4 bgcolor="#ffffff"  width="50%"><div class=fva2_ml10><span style="background:yellow"><b>'.$result[patnum].'</b></span><br>
		<b>'.$result[name].', '.$result[vorname].'</b> <br>
		<font color=maroon>'.$result[gebdatum].'</font><font size=1> <p>
		'.nl2br($result[address]).'<p>
		'.$station.'&nbsp;'.$result[kasse].' '.$result[kassename].'</div></td>';
print '<td colspan=3 bgcolor="#99ccff"><div class=fva2_ml10><font size="6"  >'.$LDNursingReport.' <p><font size=2>'.$LDPage.' 1/1
		<br><font size=1>'.$LDFrom.'</font> '.$content[fe_date].' <font size=1>'.$LDTo.'</font> '.$content[le_date].' </div></td></tr>';

print '	<tr bgcolor="#99ccff">
		<td colspan=4><div class=fva2_ml10><font color="#000099"><b>'.$LDNursingReport.'</b></div></td>
		<td colspan=3><div class=fva2_ml10><font color="#000099"><b>'.$LDEffectReport.'</b></div></td>
		</tr>';	

print '	<tr bgcolor="#99ccff">
		<td><div class=fva2_ml3><b>'.$LDDate.'</b></div></td><td><div class=fva2_ml3><b>'.$LDClockTime.'</b></div></td><td><div class=fva2_ml3>&nbsp;</div></td><td><div class=fva2_ml3><b>'.$LDSignature.'</b></div></td>
		<td><div class=fva2_ml3><b>'.$LDDate.'</b></div></td><td><div class=fva2_ml3>&nbsp;</div></td><td><div class=fva2_ml3><b>'.$LDSignature.'</b></div></td>
		</tr>';	
		
$repbuf=explode("_",$content[report]); 
$npbuf=explode("_",$content[np_report]);
		
if(($cnt=sizeof($repbuf))<15) $cnt=15;
//for ($i=0;$i<sizeof($repbuf);$i++){
for ($i=0;$i<$cnt;$i++){
		$buff=array();
		parse_str(trim($repbuf[$i]),$buf);
		parse_str(trim($npbuf[$i]),$buf2);
		
		print '	
		<tr bgcolor="#99ccff">
		<td><div class=fa2_ml3>'.$buf[d].'&nbsp;</div>
		</td>
		<td><div class=fa2_ml3>'.$buf[t].'</div>
		</td>
		<td><div class=fva2_ml3><i>';
		if($buf[w]) print '<img src="../img/warn.gif" border=0 width=16 height=16 align="absmiddle"> ';
		$strbuf=str_replace('~~','</span>',stripcslashes(nl2br($buf[b])));	
		print str_replace('~','<span style="background:yellow">',$strbuf).'</i></div>
		</td>
		<td>
		<div class=fa2_ml3>'.$buf[a].'</div>
		</td>
		<td><div class=fa2_ml3>'.$buf2[d].'</div>
		</td>
		<td><div class=fva2_ml3><i>';
		if($buf2[w]) print '<img src="../img/warn.gif" border=0 width=16 height=16 align="absmiddle"> ';
		$strbuf=str_replace('~~','</span>',stripcslashes(nl2br($buf2[b])));	
		print str_replace('~','<span style="background:yellow">',$strbuf).'</i></div>
		</td><td><div class=fa2_ml3>'.$buf2[a].'</div></td>
		</tr>';	
		}
?>
<?php if($edit) : ?>
		<tr>
		<td colspan=7 bgcolor="#ffffff">&nbsp;
		</td>
		</tr>
		<tr bgcolor="#99ccff">
		<td valign="top"><font face="verdana,arial" size="2" ><?php echo $LDDate ?>:<br>
		<input type=text size="8" name="dateput" onKeyUp=setDate(this) onFocus=this.select() value="<?php if(!$saved) print $dateput; ?>"><br>
		<a href="javascript:document.berichtform.dateput.value='h';setDate(document.berichtform.dateput);"><img src=../img/arrow-t.gif border="0" width=12 height=12 alt="<?php echo $LDInsertDate ?>"></a>
		</td>
		<td valign="top"><font face="verdana,arial" size="2" ><?php echo $LDClockTime ?>:<br>
		<input type=text size="4" name="timeput" value="<?php if(!$saved) print $timeput; ?>" onKeyUp=setTime(this) onFocus=this.select()><br>
		<a href="javascript:document.berichtform.timeput.value='j';setTime(document.berichtform.timeput);"><img src=../img/arrow-t.gif border="0" width=12 height=12 alt="<?php echo $LDInsertTimeNow ?>"></a>
		</td>
		<td><font face="verdana,arial" size="2" ><?php echo $LDNursingReport ?>:<br>&nbsp;<textarea rows="4" cols="25" name="berichtput"><?php if(!$saved) print $berichtput; ?></textarea><br>
		<input type="checkbox" name="warn" <?php if((!$saved)&&($warn)) print "checked"; ?> value="1"> <img src="../img/warn.gif" width=16 height=16 align=top>
		 <font size=1 face=arial><?php echo $LDInsertSymbol ?><br>
		 &nbsp;<a href="javascript:sethilite(document.berichtform.berichtput)"><img src="../img/hilite-s.gif" border=0 width=48 height=14 ></a>
		<a href="javascript:endhilite(document.berichtform.berichtput)"><img src="../img/hilite-e.gif" border=0 width=48 height=14 ></a>
		</td>
		<td valign="top"><font face="verdana,arial" size="2" ><?php echo $LDSignature ?>:<br><input type=text size="3" name="author" onFocus=this.select() value="<?php if(!$saved) print $author; ?>">
		</td>
		<td valign="top"><font face="verdana,arial" size="2" ><?php echo $LDDate ?>:<br><input type=text size="8" name="dateput2" value="<?php if(!$saved) print $dateput2; ?>" onKeyUp="setDate(this)" onFocus="this.select()"><br>
		<a href="javascript:document.berichtform.dateput2.value='h';setDate(document.berichtform.dateput2);"><img src=../img/arrow-t.gif border="0" width=12 height=12 alt="<?php echo $LDInsertDate ?>"></a>
		</td>
		<td><font face="verdana,arial" size="2" ><?php echo $LDEffectReport ?>:<br>&nbsp;<textarea rows="4" cols="25"  name="berichtput2"><?php if(!$saved) print $berichtput2; ?></textarea><br>
		<input type="checkbox" name="warn2" <?php if((!$saved)&&($warn2)) print "checked"; ?> value="1"> <img src="../img/warn.gif" width=16 height=16 align=top> 
		<font size=1 face=arial><?php echo $LDInsertSymbol ?><br>
		 &nbsp;<a href="javascript:sethilite(document.berichtform.berichtput2)"><img src="../img/hilite-s.gif" border=0 width=48 height=14 ></a>
		<a href="javascript:endhilite(document.berichtform.berichtput2)"><img src="../img/hilite-e.gif" border=0 width=48 height=14 ></a>
		</td>
		<td valign="top"><font face="verdana,arial" size="2" ><?php echo $LDSignature ?>:<br><input type=text size="3" name="author2" onFocus=this.select() value="<?php if(!$saved) print $author2; ?>">
		</td>
		</tr>
		
<?php endif ?>
		</table>


<p>

<table width="650"  cellpadding="0" cellspacing="0">
<tr>
<td>
<a href="<?php echo $breakfile ?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border="0" width=103 height=24 alt="<?php echo $LDClose ?>"></a>
<?php if($edit) : ?>
<a href="javascript:resetinput()"><img src="../img/<?php echo "$lang/$lang" ?>_reset.gif" border="0"  width=156 height=24 alt="<?php echo $LDReset ?>"></a>
&nbsp;&nbsp;
<?php endif ?>
</td>
<?php if($edit) : ?>
<td align="right">
<input type="image" src="../img/<?php echo "$lang/$lang" ?>_savedisc.gif" border=0 width=99 height=24 alt="<?php echo $LDSave ?>">
</td>
<?php endif ?>


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
