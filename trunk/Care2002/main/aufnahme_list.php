<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$aufnahme_user||!$sid||($sid!=$ck_sid))  {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../language/".$lang."/lang_".$lang."_aufnahme.php");

require("../req/config-color.php");
$thisfile="aufnahme_list.php";

$dbtable="mahopatient";

if($dept=="") $dept="plop";

$linecount=0;
if(($mode=="search")||($mode=="select"))
{
	include("../req/db-makelink.php");
	if($link&&$DBLink_OK) 
	{	
		switch($mode)
		{
			case "search":
							$sql="SELECT * FROM $dbtable WHERE ";
							$s2="";
							if($name) $s2.=" name=\"$name\"";
							if($date_start)
								{
									$buf=explode(".",$date_start);
									$buf=array_reverse($buf);
									$date_start=implode(".",$buf);
								}
							if($date_end)
								{
									$buf=explode(".",$date_end);
									$buf=array_reverse($buf);
									$date_end=implode(".",$buf);
								}
							
							if(($date_start)&&($date_end))
								{
									if($s2) $s2.=" AND sdate>=\"$date_start\" AND sdate<=\"$date_end\""; else $s2.=" sdate>=\"$date_start\" AND sdate<=\"$date_end\"";
								}
								elseif($date_start)
								{
									if($s2) $s2.=" AND sdate=\"$date_start\""; else $s2.=" sdate=\"$date_start\"";
								}
								elseif($date_end)
								{
									if($s2) $s2.=" AND sdate=\"$date_end\""; else $s2.=" sdate=\"$date_end\"";
								}
								
							if($encoder)
								if($s2) $s2.=" AND encoder=\"$encoder\""; else $s2.=" encoder=\"$encoder\"";
							if($patnum)
								if($s2) $s2.=" AND patnum=\"$patnum\""; else $s2.=" patnum=\"$patnum\"";
							if($title)
								if($s2) $s2.=" AND title=\"$title\""; else $s2.=" title=\"$title\"";
							if($vorname)
								if($s2) $s2.=" AND vorname=\"$vorname\""; else $s2.=" vorname=\"$vorname\"";
							if($gebdatum)
								if($s2) $s2.=" AND gebdatum=\"$gebdatum\""; else $s2.=" gebdatum=\"$gebdatum\"";
							if($address)
								if($s2) $s2.=" AND address LIKE \"%$address%\""; else $s2.=" address LIKE \"%$address%\"";
							if($sex)
								if($s2) $s2.=" AND sex=\"$sex\""; else $s2.=" sex=\"$sex\"";
							if($status)
								if($s2) $s2.=" AND status=\"$status\""; else $s2.=" status=\"$status\"";
							if($kasse)
								if($s2) $s2.=" AND kasse=\"$kasse\""; else $s2.=" kasse=\"$kasse\"";
							if($kassename)
								if($s2) $s2.=" AND kassename=\"$kassename\""; else $s2.=" kassename=\"$kassename\"";
							if($diagnose)
								if($s2) $s2.=" AND diagnose LIKE \"%$diagnose%\""; else $s2.=" diagnose LIKE \"%$diagnose%\"";
							if($referrer)
								if($s2) $s2.=" AND referrer LIKE \"%$referrer%\""; else $s2.=" referrer LIKE \"%$referrer%\"";
							if($therapie)
								if($s2) $s2.=" AND therapie LIKE \"%$therapie%\""; else $s2.=" therapie LIKE \"%$therapie%\"";
							if($besonder)
								if($s2) $s2.=" AND besonder LIKE \"%$besonder%\""; else $s2.=" besonder LIKE \"%$besonder%\"";
								
							$sql=$sql.$s2." AND patnum<>'' ORDER BY	name";
							//print $sql;
							if($s2!="")
								if($ergebnis=mysql_query($sql,$link)) 
								{			
						  			$rows=0;
									while($result=mysql_fetch_array($ergebnis)) $rows++;	
									if($rows)
									{
										mysql_data_seek($ergebnis,0);
									}
								}else print "$LDDbNoRead<p> $sql <p>";
							if($rows==1)
							 {
								$result=mysql_fetch_array($ergebnis);
								$mode="select";
							}
							break;
			case "select":
							$sql='SELECT * FROM '.$dbtable.' WHERE  item="'.$i.'" 
																			AND pdate="'.$dt.'"
																			AND patnum="'.$n.'" 
																			AND	name="'.$ln.'"
																			AND	vorname="'.$fn.'"
																			AND	gebdatum="'.$bd.'"';
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

<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<TITLE></TITLE>
<script language="javascript" src="../js/setdatetime.js">
</script>
<script language="javascript">
<!-- 
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
<BODY  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0
 bgcolor=<? print $cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; }
 if(($mode!="select")&&(!$rows)) print ' onLoad="document.archivform.patnum.select()" '; ?>>



<table width=100% border=0 cellspacing="0">

<tr>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp;<?=$LDAdmArchive ?></STRONG></FONT>
</td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('admission_how2arch.php','<?=$mode ?>')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<? 
if($ck_login_logged) print "startframe.php?sid=$ck_sid"; 
	else print "aufnahme_pass.php?sid=$ck_sid&target=archiv&lang=$lang"; ?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDCloseWin ?>" width=93 height=41  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>
</table>
<ul>

<table  border=0 cellpadding=0 cellspacing=0 width="90%">
<tr>
<td colspan=3><a href="<? if($aufnahme_user) print "aufnahme_start.php?sid=$ck_sid&mode=?&lang=$lang"; else print "aufnahme_pass.php?sid=$ck_sid&lang=$lang"; ?>"><img src="../img/<?="$lang/$lang" ?>_ein-gray.gif" alt="<?=$LDAdmit ?>" border=0 width=130 height=25 <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<? if($aufnahme_user) print "aufnahme_daten_such.php?sid=$ck_sid&mode=?&lang=$lang"; else print "aufnahme_such_pass.php?sid=$ck_sid&lang=$lang"; ?>" ><img src="../img/<?="$lang/$lang" ?>_such-gray.gif" alt="<?=$LDSearch ?>" border=0 width=130 height=25  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><img src="../img/<?="$lang/$lang" ?>_arch-blu.gif" alt="<?=$LDArchive ?>" border=0 width=130 height=25 ></td>
</tr>

<tr>
<td bgcolor=#333399 colspan=3>
<FONT  COLOR="white"  SIZE=1  FACE="Arial"><STRONG> &nbsp;</STRONG></FONT>
</td>
</tr>
<tr bgcolor="#DDE1EC">
<td bgcolor=#333399>&nbsp;</td>
<td ><br>


<ul>
<? if($mode=="search") print '<FONT  SIZE=2 FACE="verdana,Arial">'.$LDSearchKeyword.': '.$s2; ?>
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
  	for($j=0;$j<sizeof($LDElements);$j++)
		print '
			<td><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>&nbsp;&nbsp;'.$LDElements[$j].'</b></td>';
	?>
  </tr>
 <? 
 $toggle=0;
 while($result=mysql_fetch_array($ergebnis))
 {
 	print'
  <tr ';
  if($toggle){ print "bgcolor=#efefef"; $toggle=0;} else {print "bgcolor=#ffffff"; $toggle=1;}
  $buf='aufnahme_list.php?sid='.$ck_sid.'&lang='.$lang.'&mode=select&i='.$result[item].'&dt='.$result[pdate].'&n='.$result[patnum].'&ln='.strtr($result[name]," ","+").'&fn='.strtr($result[vorname]," ","+").'&bd='.$result[gebdatum];
  print '>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'"><img src="../img/R_arrowGrnSm.gif" width=12 height=12 border=0></a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[name].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[vorname].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result[gebdatum].'</td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.$result[patnum].'</td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result[pdate].'</a></td>
  </tr>
  <tr bgcolor=#0000ff>
  <td colspan=8 height=1><img src="../img/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
  </tr>';
  }
 ?>
</table>
<p>
<form method="post"  action="aufnahme_list.php">
<FONT  SIZE=-1  FACE="Arial">
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="mode" value="?">
<input type="submit" value="<?=$LDNewArchive ?>" >
                             </form>
<? else :?>

<form method="post" action="<? if($mode=="select") print "aufnahme_start.php"; else print $thisfile; ?>" name=archivform>

<table border="0" cellspacing=0>

<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDAdmitDate ?>: <? if ($mode!="select") print $LDFrom; ?>:
</td>
<td ><? if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?=$result[pdate] ?> <? else : ?>
<input name="date_start" type="text" value="" size="14"  onKeyUp=setDate(this)> <? endif ?>
</td>
<? if ($mode!="select") : ?>
<td align=right><FONT SIZE=-1  FACE="Arial"><?=$LDTo ?>:
</td>
<td ><input name="date_end" type="text" value="" size="14"  onKeyUp=setDate(this)>
</td>
<? endif ?>
</tr>
<tr>
<td ><FONT  SIZE=2  FACE="Arial"> <?=$LDAdmitBy ?>:
</td>
<td><? if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?=$result[encoder] ?> <? else : ?>
<input  name="encoder" type="text" value="" size="14" ><? endif ?>
</td>
</tr>
<tr>
<td colspan=4><FONT SIZE=-1  FACE="Arial">&nbsp;
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDCaseNr ?>:
</td>
<td colspan=3><? if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?=$result[patnum] ?> <? else : ?>
<input name="patnum" type="text" size="14" value="" ><? endif ?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDTitle ?>:
</td>
<td ><? if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?=$result[title] ?> <? else : ?>
<select name="title"  size="1" >
<option value="" ></option>
<option value="Frau" >Frau</option>
<option value="Herr" >Herr</option>
<option value="Frau Dr." >Frau Dr.</option>
<option value="Herr Dr.">Herr Dr.</option>
<option value="Frau Prof.">Frau Prof.</option>
<option value="Herr Prof.">Herr Prof.</option>
</select>
<? endif ?>
</td>
<td align=right><FONT SIZE=-1  FACE="Arial"><?=$LDSex ?>:
</td>
<td colspan=3><? if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?=strtr($result[sex],"fm","WM") ?> <? else : ?>
<FONT SIZE=-1  FACE="Arial"><input name="sex" type="radio" value="m"  <? if($sex=="m") print "checked"; ?>><?=$LDMale ?>&nbsp;&nbsp;
<input name="sex" type="radio" value="f"  <? if($sex=="f") print "checked"; ?>><?=$LDFemale ?>
<? endif ?>
</td>

</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDLastName ?>:
</td>
<td><? if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?=$result[name] ?> <? else : ?>
<input name="name" type="text" size="14" value="" > <? endif ?>
</td>
<td align=right><FONT SIZE=-1  FACE="Arial"> &nbsp;<?=$LDAddress ?>:
</td>
<td rowspan=4><? if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?=nl2br($result[address]) ?> <? else : ?>
<textarea rows="5"  cols="26" name="address" ></textarea><? endif ?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDFirstName ?>:
</td>
<td colspan=2><? if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?=$result[vorname] ?> <? else : ?>
<input name="vorname" type="text" size="14" value="<? print $vorname; ?>" ><? endif ?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDBday ?>:
</td>
<td  colspan=2><? if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?=$result[gebdatum] ?> <? else : ?>
<input name="gebdatum" type="text" size="14" value="" ><? endif ?>
</td>
</tr>
<tr>
<td>
</td>
<td  colspan=3><? if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?=$result[status] ?> <? else : ?>
<input name="status" type="radio"  value="amb" ><FONT SIZE=-1  FACE="Arial"><?=$LDAmbulant ?>  
<input name="status" type="radio" value="stat"  ><?=$LDStationary ?>
<? endif ?>
</td>
</tr>
<tr>
<td>
</td>
<td colspan=2><? if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?=$result[kasse] ?> <? else : ?>
<FONT SIZE=-1  FACE="Arial">
<input name="kasse" type="radio" value="x" ><?=$LDSelfPay ?>
  &nbsp;<input name="kasse" type="radio" value="privat" ><?=$LDPrivate ?>
  &nbsp;
<input name="kasse" type="radio" value="kasse" ><?=$LDInsurance ?>:<? endif ?>
</td>
<td><? if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?=$result[kassename] ?> <? else : ?>
<input name="kassename" type="text" size="28" value="" ><? endif ?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDDiagnosis ?>:
</td>
<td colspan=3><? if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?=$result[diagnose] ?> <? else : ?>
<input name="diagnose" type="text" size="60" value="" > <? endif ?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDRecBy ?>:
</td>
<td colspan=3><? if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?=$result[referrer] ?> <? else : ?>
<input name="referrer" type="text" size="60" value="" ><? endif ?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDTherapy ?>:
</td>
<td colspan=3><? if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?=$result[therapie] ?> <? else : ?>
<input name="therapie" type="text" size="60" value="" ><? endif ?>
</td>
</tr>
<tr>
<td><FONT SIZE=-1  FACE="Arial"><?=$LDSpecials ?>:
</td>
<td colspan=3><? if($mode=="select") : ?><FONT SIZE=-1  FACE="Arial" color="#800000"><?=$result[besonder] ?> <? else : ?>
<input name="besonder" type="text" size="60" value="" ><? endif ?>
</td>
</tr>

</table>
<p>
<input type=hidden name=sid value=<? print $ck_sid; ?>>
<input type=hidden name="lang" value=<? print $lang; ?>>
<? if($mode=="select") : ?>
<input type="hidden" name="itemname" value="<?=$result[item] ?>">
<input type="hidden" name="mode" value="?">
<input type="hidden" name="update" value="1">
<input  type="submit"   value="<?=$LDUpdateData ?>"> &nbsp;&nbsp;
</form>
<form action="<?=$thisfile ?>" method="post">
<input type=hidden name=sid value=<? print $ck_sid; ?>>
<input type="submit" value="<?=$LDNewArchive ?>">
<input type="hidden" name="mode" value="?">
</form>
<? else : ?>
<input type="hidden" name="mode" value="search">
<input  type="submit" value="<?=$LDSearch ?>"> 
</form>
<? endif ?>


<? endif ?>
</ul>

<p>
</td>
<td bgcolor=#333399>&nbsp;</td>
</tr>
<tr >
<td bgcolor="#333399" colspan=3><font size=1>
&nbsp; 
</td>
</tr>
</table>        
<form 
<? 
if($mode=="select") print 'action="'.$thisfile.'">'; 
	else
	{
		if($from=="entry") print 'action="aufnahme_start.php">';
		else
		{ 
			if($ck_login_logged) print 'action="startframe.php">';
				else print 'action="aufnahme_pass.php">
						<input type="hidden" name="target" value="'.$LDArchive.'"> 
						';
		}
	}
?>
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="submit" value="<?=$LDCancel ?>"> 
</form>
<p>

<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>

    
</BODY>
</HTML>
