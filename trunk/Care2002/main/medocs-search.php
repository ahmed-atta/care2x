<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/*
CARE 2002 Integrated Information System beta 1.0.02 - 30.07.2002 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
define("LANG_FILE","aufnahme.php");
$local_user="medocs_user";
require("../include/inc_front_chain_lang.php");

if ((substr($matchcode,0,1)=="%")||(substr($matchcode,0,1)=="&")) {header("Location: medocs-search.php?sid=$sid&lang=$lang"); exit;}; 

require("../include/inc_config_color.php"); // load color preferences

$thisfile="medocs-search.php";
$breakfile="medopass.php?sid=$sid&lang=$lang";
//foreach($arg as $v) print "$v<br>"; //init db parameters

if($dept=="") $dept="plop";

$linecount=0;
if($mode)
{
	include("../include/inc_db_makelink.php");
	if($link&&$DBLink_OK) 
	{	
	    $matchcode=addslashes($matchcode);
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
								$sql='SELECT * FROM '.$dbtable.' WHERE  lastname="'.addslashes($matchcode).'"';
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
																			AND ( lastname LIKE "'.addslashes(trim($matchcode)).'%" 
																					OR firstname LIKE "'.addslashes(trim($matchcode)).'%" )
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
var iscat=<?php if($mode) print 'false'; else print 'true'; ?>;

function hidecat()
{
	if(!iscat) return;
	if(document.images) document.catcom.src=pix.src;
	iscat=false;
}

function loadcat()
{
  cat=new Image();
  cat.src="../imgcreator/catcom.php?sid=<?php echo $sid; ?>&lang=<?php echo $lang; ?>&person=<?php echo $HTTP_COOKIE_VARS[$local_user.$sid];?>";
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
	window.location.replace("medocs-search.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=match&matchcode="+m);
	return false;
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
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

<?php 
require("../include/inc_css_a_hilitebu.php");
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  onLoad="if(window.focus) window.focus();loadcat(); document.matchform.matchcode.focus();"
bgcolor=<?php print $cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; }
  ?>>


<table width=100% border=0 cellspacing="0">
<tr>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=5  FACE="Arial">
<STRONG>&nbsp;<?php echo $LDMedocsSearchTitle ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('medocs_how2search.php','<?php echo $mode ?>','<?php echo $rows ?>')"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td colspan=2 ><p><br>

<div class="cats"><a href="javascript:hidecat()">
<?php if($mode!="") print'
<img src="../img/pixel.gif" align=right name=catcom border=0 alt="'.$LDHideCat.'">';
else print '
<img src="../imgcreator/catcom.php?sid=<?php echo $sid; ?>&lang=<?php echo $lang; ?>&person='.$HTTP_COOKIE_VARS[$local_user.$sid].'" align=right name=catcom border=0 alt="'.$LDHideCat.'">';
?></a>
</div>

<ul>
<form action="medocs-search.php" method="post"  name="matchform" onSubmit="return lookmatch(this)">
<FONT  SIZE=-1  FACE="Arial"><?php echo $LDMedDocOf ?>:
	<br>
	<input name="matchcode" type="text" size="20" onClick=hidecat()>
	<input type="hidden" name="sid" value="<?php echo $sid ?>">
 	<input type="hidden" name="lang" value="<?php echo $lang ?>">
	&nbsp;<input type="image" src="../img/<?php echo "$lang/$lang" ?>_searchlamp.gif" border=0 width=108 height=24 align="absmiddle" alt="<?php echo $LDSearch ?>">
</form>
<?php if($rows>1) : ?>
<table border=0>
  <tr>
    <td><img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle"></td>
    <td><FONT  SIZE=3 FACE="verdana,Arial" color=#800000>
<b><?php print str_replace("~nr~",$rows,$LDFoundData); ?></b></font></td>
  </tr>
</table>

<table border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor=#0000aa>
      <?php
for($j=0;$j<sizeof($LDMedocsElements);$j++)
		print '
			<td><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>&nbsp;&nbsp;'.$LDMedocsElements[$j].'</b></td>';
	?>
  </tr> 
 <?php 
 $toggle=0;
 while($result=mysql_fetch_array($ergebnis))
 {
 	if($result[dept]=="lastdocnumber") continue;
 	print'
  <tr ';
  if($toggle){ print "bgcolor=#efefef"; $toggle=0;} else {print "bgcolor=#ffffff"; $toggle=1;}
  $buf="medocs-search.php?sid=$sid&lang=$lang&mode=select&de=".strtr($result[dept]," ","+")."&dn=".$result[doc_no]."&dt=".$result[enc_date]."&n=".$result[patient_no]."&ln=".strtr($result[lastname]," ","+")."&fn=".strtr($result[firstname]," ","+")."&bd=".$result[birthdate ];
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

<?php elseif($rows) :?>



<FONT  SIZE=-1  FACE="Arial">
<table border="0" cellpadding=2>

<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDMedocsElements[5] ?>:<br>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  print '<font color="#800000">'.$result[doc_no]; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDMedocsElements[6] ?>:<br>
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  print '<font color="#800000">'.$result[dept]; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td>

<FONT SIZE=-1  FACE="Arial"><?php echo $LDCaseNr ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  print '<font color="#800000">'.$result[patient_no]; 
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
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDLastName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  print '<font color="#800000"><b>'.ucfirst($result[lastname]).'</b>'; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDFirstName ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  print '<font color="#800000"><b>'.ucfirst($result[firstname]).'</b>'; 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDBday ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  print '<font color="#800000"> '.$result[birthdate]; 
?>
</td>
<td>&nbsp;<FONT SIZE=-1  FACE="Arial"><?php echo $LDInsurance ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  print '<font color="#800000"> '.$result[insurance]; 
?>
</td>

</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDAddress ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  print '<font color="#800000"> '.nl2br($result[address]); 
?>
</td>
<td>&nbsp;<FONT SIZE=-1  FACE="Arial"><?php echo $LDExtraInfo ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  print '<font color="#800000"> '.nl2br($result[insurance_xtra]); 
?>
</td>

</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDSex ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<font color=#800000>
<?php switch($result[sex])
	{
		case "m": print $LDMale;break;
		case "f": print $LDFemale; break;
	}
	print "<br>";
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDMedAdvice ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<font color=#800000>
<?php if($result[informed]) print $LDYes;else print $LDNo;
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDDiagnosis ?>:
</td>
<td colspan=4><FONT SIZE=-1  FACE="Arial">
<?php  print '<font color="#800000">'.nl2br($result[diagnosis_1]); 
?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDTherapy ?>:
</td>
<td colspan=4>
<FONT SIZE=-1  FACE="Arial">
<?php  print '<font color="#800000">'.nl2br($result[therapy_1]); 
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
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDEditOn ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  print '<font color="#800000">'.$result[enc_date]; 
?>
 <font color=#0><?php echo $LDAt ?>: </font> <?php echo $result[enc_time] ?>
</td>
</tr>
<tr bgcolor="#ffffff">
<td><FONT SIZE=-1  FACE="Arial"><?php echo $LDEditBy ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  print '<font color="#800000"> '.$result[encoder]; 
?>
</td>
<td>&nbsp;<FONT SIZE=-1  FACE="Arial"><?php echo $LDKeyNr ?>:
</td>
<td><FONT SIZE=-1  FACE="Arial">
<?php  print '<font color="#800000"> '.$result[keynumber]; 
?>
</td>

</tr>

</table>
<p>
<form method="post" action="medostart.php" name="medocform">
<p>
<input type="hidden" name="mode" value="update">
<input type="hidden" name="dept" value="<?php echo strtr($result[dept]," ","+") ?>">
<input type="hidden" name="doc_no" value="<?php echo $result[doc_no] ?>">
<input type="hidden" name="enc_date" value="<?php echo $result[enc_date]?>">
<input type="hidden" name="lastname" value="<?php echo strtr($result[lastname]," ","+") ?>">
<input type="hidden" name="firstname" value="<?php echo strtr($result[firstname]," ","+") ?>">
<input type="hidden" name="birthdate" value="<?php echo $result[birthdate] ?>">
<input type="hidden" name="keynumber" value="<?php echo $result[keynumber] ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="submit" value="<?php echo $LDUpdateData ?>" > &nbsp;
</form>
<?php elseif($mode!="?") : ?>
<img src="../img/catr.gif" width=88 height=80 border=0 align=absmiddle>
<font size=3 face="Verdana, Arial" color=#800000><b><?php echo $LDNoMedocsFound ?></b></font>
<?php endif ?>
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
<img src="../img/varrow.gif" width="20" height="15"> <a href="medostart.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=?"><?php echo $LDStartNewDoc ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="medocs-archiv.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=?"><?php echo $LDArchive ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="javascript:showcat()"><?php echo $LDCatPls ?></a><br>

<p>

<a href="<?php echo $breakfile ?>"><img border=0 src="../img/<?php echo "$lang/$lang" ?>_close2.gif" alt="<?php echo $LDCancelClose ?>"></a>
</ul><p>
<hr>
<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>

</FONT>


</BODY>
</HTML>
