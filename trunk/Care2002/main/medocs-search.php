<?
if ((substr($matchcode,0,1)=="%")||(substr($matchcode,0,1)=="&")) {header("Location: medocs-search.php?sid=$ck_sid&lang=$lang"); exit;}; 

if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$medocs_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../language/".$lang."/lang_".$lang."_aufnahme.php");

require("../req/config-color.php"); // load color preferences

$thisfile="medocs-search.php";
$breakfile="medopass.php?sid=$ck_sid&lang=$lang";
//foreach($arg as $v) print "$v<br>"; //init db parameters

if($dept=="") $dept="plop";

$linecount=0;
if($mode)
{
	include("../req/db-makelink.php");
	if($link&&$DBLink_OK) 
	{	
		switch($mode)
		{
			case "match":
							$dbtable="medocs";
							if(is_numeric($matchcode))
							{
								$matchcode=(int)$matchcode;
								if($matchcode<20000000) $matchcode=$matchcode+20000000;
								$sql="SELECT * FROM $dbtable WHERE patient_no=$matchcode";
								$isnumeric=1;
							}
							else
							{
								$sql='SELECT * FROM '.$dbtable.' WHERE  lastname="'.$matchcode.'"';
							}
							
							if($ergebnis=mysql_query($sql,$link)) 
							{			
						  		$rows=0;
								while($result=mysql_fetch_array($ergebnis)) $rows++;	
								if($rows)
								{
									mysql_data_seek($ergebnis,0);
								}
								else
								{ // if not found find similar
								$sql='SELECT * FROM '.$dbtable.' WHERE  hidden=0
																			AND ( lastname LIKE "'.trim($matchcode).'%" 
																					OR firstname LIKE "'.trim($matchcode).'%" )
																						ORDER BY doc_no';
									if($ergebnis=mysql_query($sql,$link)) 
									{			
						  				$rows=0;
										while($result=mysql_fetch_array($ergebnis)) $rows++;	
										if($rows)
										{
											mysql_data_seek($ergebnis,0);
										}
									}
								}
							}else print "$LDDbNoRead<p> $sql <p>";
							//print $sql;
							if($rows==1) 	$result=mysql_fetch_array($ergebnis);
							break;
			case "select":
							$dbtable="medocs";
							$sql='SELECT * FROM '.$dbtable.' WHERE  dept="'.$de.'" 
																		 	AND doc_no="'.$dn.'"
																			AND enc_date="'.$dt.'"
																			AND patient_no="'.$n.'" 
																			AND	lastname="'.$ln.'"
																			AND	firstname="'.$fn.'"
																			AND	birthdate="'.$bd.'"';
							if($ergebnis=mysql_query($sql,$link)) 
							{			
						  		$rows=0;
								while($result=mysql_fetch_array($ergebnis)) $rows++;	
								if($rows)
								{
									mysql_data_seek($ergebnis,0);
									$result=mysql_fetch_array($ergebnis);
								}
							}else print "$LDDbNoRead<p> $sql <p>";
							//print $sql;
							break;
		} // end of switch
	}
  	 else { print "$LDDbNoLink<br>"; } 
}
?>


<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE></TITLE>


<script  language="javascript">
<!-- 
var iscat=<? if($mode) print 'false'; else print 'true'; ?>;

function hidecat()
{
	if(!iscat) return;
	if(document.images) document.catcom.src=pix.src;
	iscat=false;
}

function loadcat()
{
  cat=new Image();
  cat.src="../imgcreator/catcom.php?person=<?print $medocs_user;?>";
  pix=new Image();
  pix.src="../img/pixel.gif";
}

function showcat()
{
	if(iscat)
	{
		hidecat();
		return;
	}
	else
	{
	if(document.images) document.catcom.src=cat.src;
	iscat=true;
	}
}
	
function lookmatch(d)
{
	m=d.matchcode.value;
	if(m=="") return false;
	if((m.substr(0,1)=="%")||(m.substr(0,1)=="&"))
	{
		d.matchcode.value="";
		d.matchcode.focus();
		return false;
	}
	window.location.replace("medocs-search.php?sid=<?="$ck_sid&lang=$lang" ?>&mode=match&matchcode="+m);
	return false;
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

<style type="text/css" name="cat">

div.cats{
	position: relative;
	right: 10;
	top: 80;
}
</style>

<? 
require("../req/css-a-hilitebu.php");
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  onLoad="if(window.focus) window.focus();loadcat(); document.matchform.matchcode.focus();"
bgcolor=<? print $cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; }
  ?>>


<table width=100% border=0 cellspacing="0">
<tr>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=5  FACE="Arial">
<STRONG>&nbsp;<?=$LDMedocsSearchTitle ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('medocs_how2search.php','<?=$mode ?>','<?=$rows ?>')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td colspan=2 ><p><br>

<div class="cats"><a href="javascript:hidecat()">
<?
if($mode!="") print'
<img src="../img/pixel.gif" align=right name=catcom border=0 alt="'.$LDHideCat.'">';
else print '
<img src="../imgcreator/catcom.php?person='.$medocs_user.'" align=right name=catcom border=0 alt="'.$LDHideCat.'">';
?></a>
</div>

<ul>
<form action="medocs-search.php" method="post"  name="matchform" onSubmit="return lookmatch(this)">
<FONT  SIZE=-1  FACE="Arial"><?=$LDMedDocOf ?>:
	<br>
	<input name="matchcode" type="text" size="20" onClick=hidecat()>
	<input type="hidden" name="sid" value="<?=$ck_sid ?>">
 	<input type="hidden" name="lang" value="<?=$lang ?>">
	&nbsp;<input type="image" src="../img/<?="$lang/$lang" ?>_searchlamp.gif" border=0 width=108 height=24 align="absmiddle" alt="<?=$LDSearch ?>">
</form>
<? if($rows>1) : ?>
<table border=0>
  <tr>
    <td><img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle"></td>
    <td><FONT  SIZE=3 FACE="verdana,Arial" color=#800000>
<b><? print str_replace("~nr~",$rows,$LDFoundData); ?></b></font></td>
  </tr>
</table>

<table border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor=#0000aa>
      <?
  	for($j=0;$j<sizeof($LDMedocsElements);$j++)
		print '
			<td><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>&nbsp;&nbsp;'.$LDMedocsElements[$j].'</b></td>';
	?>
  </tr> 
 <? 
 $toggle=0;
 while($result=mysql_fetch_array($ergebnis))
 {
 	if($result[dept]=="lastdocnumber") continue;
 	print'
  <tr ';
  if($toggle){ print "bgcolor=#efefef"; $toggle=0;} else {print "bgcolor=#ffffff"; $toggle=1;}
  $buf="medocs-search.php?sid=$ck_sid&lang=$lang&mode=select&de=".strtr($result[dept]," ","+")."&dn=".$result[doc_no]."&dt=".$result[enc_date]."&n=".$result[patient_no]."&ln=".strtr($result[lastname]," ","+")."&fn=".strtr($result[firstname]," ","+")."&bd=".$result[birthdate ];
  print '>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'"><img src="../img/R_arrowGrnSm.gif" width=12 height=12 border=0></a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[lastname].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result[firstname].'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result[birthdate].'</td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result[patient_no].'</td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[doc_no].'</a>&nbsp;&nbsp;</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result[dept].'</td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result[enc_date].'</td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[enc_time].'</a>&nbsp;&nbsp;</td>
  </tr>
  <tr bgcolor=#0000ff>
  <td colspan=9 height=1><img src="../img/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
  </tr>';
  }
 ?>
</table>
<p>

<? elseif($rows) :?>



<FONT  SIZE=-1  FACE="Arial">
<table border="0" cellpadding=2>

<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDMedocsElements[5] ?>:<br>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000">'.$result[doc_no]; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDMedocsElements[6] ?>:<br>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000">'.$result[dept]; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td>

<FONT SIZE=-1  FACE="Arial"><?=$LDCaseNr ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000">'.$result[patient_no]; 
?>
</td>
</tr>
<tr>
<td>

&nbsp;
</td>
<td>
&nbsp;
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDLastName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000"><b>'.ucfirst($result[lastname]).'</b>'; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDFirstName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000"><b>'.ucfirst($result[firstname]).'</b>'; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDBday ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000"> '.$result[birthdate]; 
?>
</td>
<td>&nbsp;<FONT SIZE=-1  FACE="Arial"><?=$LDInsurance ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000"> '.$result[insurance]; 
?>
</td>

</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDAddress ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000"> '.nl2br($result[address]); 
?>
</td>
<td>&nbsp;<FONT SIZE=-1  FACE="Arial"><?=$LDExtraInfo ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000"> '.nl2br($result[insurance_xtra]); 
?>
</td>

</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDSex ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<font color=#800000>
<? switch($result[sex])
	{
		case "m": print $LDMale;break;
		case "f": print $LDFemale; break;
	}
	print "<br>";
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDMedAdvice ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<font color=#800000>
<? if($result[informed]) print $LDYes;else print $LDNo;
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDDiagnosis ?>:
</td>
<td colspan=4><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000">'.nl2br($result[diagnosis_1]); 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDTherapy ?>:
</td>
<td colspan=4>
<FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000">'.nl2br($result[therapy_1]); 
?>
</td>
</tr >
<tr>
<td>

&nbsp;
</td>
<td>
&nbsp;
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDEditOn ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000">'.$result[enc_date]; 
?>
 <font color=#0><?=$LDAt ?>: </font> <?=$result[enc_time] ?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?=$LDEditBy ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000"> '.$result[encoder]; 
?>
</td>
<td>&nbsp;<FONT SIZE=-1  FACE="Arial"><?=$LDKeyNr ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?  print '<font color="#800000"> '.$result[keynumber]; 
?>
</td>

</tr>

</table>
<p>
<form method="post" action="medostart.php" name="medocform">
<?
  $buf="?sid=$ck_sid&mode=update&dept=".strtr($result[dept]," ","+")."&doc_no=".$result[doc_no]."&enc_date=".$result[enc_date]."&lastname=".strtr($result[lastname]," ","+")."&firstname=".strtr($result[firstname]," ","+")."&birthdate=".$result[birthdate ];
?>
<p>
<input type="hidden" name="mode" value="update">
<input type="hidden" name="dept" value="<?=strtr($result[dept]," ","+") ?>">
<input type="hidden" name="doc_no" value="<?=$result[doc_no] ?>">
<input type="hidden" name="enc_date" value="<?=$result[enc_date]?>">
<input type="hidden" name="lastname" value="<?=strtr($result[lastname]," ","+") ?>">
<input type="hidden" name="firstname" value="<?=strtr($result[firstname]," ","+") ?>">
<input type="hidden" name="birthdate" value="<?=$result[birthdate] ?>">
<input type="hidden" name="keynumber" value="<?=$result[keynumber] ?>">
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="submit" value="<?=$LDUpdateData ?>" > &nbsp;
</form>
<? elseif($mode!="?") : ?>
<img src="../img/catr.gif" width=88 height=80 border=0 align=absmiddle>
<font size=3 face="Verdana, Arial" color=#800000><b><?=$LDNoMedocsFound ?></b></font>
<? endif ?>
<p>
</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<hr>
<ul>
<FONT    SIZE=2  FACE="Arial">
<img src="../img/varrow.gif" width="20" height="15"> <a href="medostart.php?sid=<?="$ck_sid&lang=$lang" ?>&mode=?"><?=$LDStartNewDoc ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="medocs-archiv.php?sid=<?="$ck_sid&lang=$lang" ?>&mode=?"><?=$LDArchive ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="javascript:showcat()"><?=$LDCatPls ?></a><br>

<p>

<a href="<?=$breakfile ?>"><img border=0 src="../img/<?="$lang/$lang" ?>_close2.gif" alt="<?=$LDCancelClose ?>"></a>
</ul><p>
<hr>
<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>

</FONT>


</BODY>
</HTML>
