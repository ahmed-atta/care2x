<?
//setcookie(currentuser,"");
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../language/".$lang."/lang_".$lang."_lab.php");
require("../req/config-color.php");

$dbtable="mahopatient";
$thisfile="labor_data_patient_such.php";
$breakfile="labor.php?sid=$ck_sid&lang=$lang";

$toggle=0;

$fielddata="patnum, name, vorname, gebdatum, item";

$keyword=trim($keyword);

if(($search)and($keyword)and($keyword!=" "))
  {
		include("../req/db-makelink.php");
		if($link&&$DBLink_OK) 
		{
			if($keyword<20000000) $suchbuffer=$keyword+20000000; else $suchbuffer=$keyword;
			if(is_numeric($keyword))
			{
			$sql='SELECT '.$fielddata.' FROM '.$dbtable.' 
			WHERE patnum="'.((int)$keyword).'"';
			}
			else
			{
			$sql='SELECT '.$fielddata.' FROM '.$dbtable.' 
			WHERE name LIKE "'.$keyword.'%" 
			OR vorname LIKE "'.$keyword.'%"
			OR gebdatum LIKE "'.$keyword.'%"
			OR patnum LIKE "'.$suchbuffer.'" 
			ORDER BY patnum';
			}
        	$ergebnis=mysql_query($sql,$link);
			$linecount=0;
			if($ergebnis)
       		{
				while ($zeile=mysql_fetch_array($ergebnis)) $linecount++;
				if ($linecount>0) 
				{ 
					mysql_data_seek($ergebnis,0);
				}
			}
			 else { print "$LDDbNoRead<br>"; } 
		}
  		 else { print "$LDDbNoLink<br>"; } 
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<script language="javascript" >
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
	</script>

</HEAD>

<BODY onLoad="document.sform.keyword.select()">

<img src=../img/micros.gif align="absmiddle"><FONT  COLOR="<?=$cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b><? print "$LDMedLab - "; if($mode=="edit") print "$LDNewData"; else print "$LDSeeData"; ?></b></font>
<table width=100% border=0 cellpadding="0" cellspacing="0">
<tr>
<td colspan=3><img src=../img/<?="$lang/$lang" ?>_such-b.gif></td>
</tr>
<tr >
<td bgcolor=#333399 colspan=3>
<FONT  SIZE=1  FACE="Arial"><STRONG> &nbsp; </STRONG></FONT>
</td>
</tr>
<tr bgcolor="#DDE1EC" >
<td bgcolor=#333399>&nbsp;</td>
<td valign=top><p><br>
<ul>
<FONT    SIZE=-1  FACE="Arial">

<FORM action="<? print $thisfile; ?>" method="post" name="sform">
<font face="Arial,Verdana"  color="#000000" size=-1>
<B><?=$LDSearchWordPrompt ?></B></font><p>
<font size=3><INPUT type="text" name="keyword" size="20" maxlength="40" value="<? print $keyword ?>"></font> 
<input type=hidden name="search" value=1>
<input type=hidden name="sid" value=<?=$ck_sid ?>>
<input type=hidden name="lang" value=<?=$lang ?>>
<input type=hidden name="mode" value=<?=$mode ?>>
<INPUT type="image" src=../img/<?="$lang/$lang" ?>_searchlamp.gif border=0 align="absmiddle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:gethelp('lab.php','search','<?=$mode ?>','<?=$linecount ?>','<?=$datafound ?>')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" align="absmiddle" border=0 width=75 height=24></a>
</FORM><p>
<?
if($linecount)
  {
			print str_replace("~nr~",$linecount,$LDFoundPatient)."<p>";
			print "<table border=0 cellpadding=3 cellspacing=1> <tr bgcolor=#9f9f9f>";
					for($i=0;$i<sizeof($LDfieldname);$i++) 
					{
						print"<td><font face=arial size=2 color=#ffffff><b>".$LDfieldname[$i]."</b></td>";
		
					}
					 print"<td>&nbsp;</td></tr>";

					while($zeile=mysql_fetch_array($ergebnis))
					{
						print "<tr bgcolor=";
						if($toggle) { print "#dfdfdf>"; $toggle=0;} else {print "#ffffff>"; $toggle=1;};
	
						for($i=0;$i<mysql_num_fields($ergebnis)-1;$i++) 
						{
							print"<td><font face=arial size=2>";
							if($zeile[$i]=="")print "&nbsp;"; else print $zeile[$i];
							print "</td>";
						}
						print'<td><font face=arial size=2>&nbsp';
					    if($mode=="edit") print'<a href="labor_data_check_arch.php?sid='.$ck_sid.'&lang='.$lang.'&mode='.$mode.'&patnum='.$zeile[patnum].'&update=1"  title="'.$LDEnterData.'">
						<button onClick="javascript:window.location.href=\'labor_data_check_arch.php?sid='.$ck_sid.'&lang='.$lang.'&mode='.$mode.'&patnum='.$zeile[patnum].'&update=1\'"><img 	src=../img/update2.gif border=0 alt="'.$LDEnterData.'" align="absmiddle">';
							else print'<a href="labor_datalist_noedit.php?sid='.$ck_sid.'&lang='.$lang.'&patnum='.$zeile[patnum].'&noexpand=1&nostat=1"  title="'.$LDClk2See.'">
							<button onClick="javascript:window.location.href=\'labor_datalist_noedit.php?sid='.$ck_sid.'&lang='.$lang.'&patnum='.$zeile[patnum].'&noexpand=1&nostat=1\'"><img src=../img/update2.gif border=0 alt="'.$LDClk2See.'" align="absmiddle">';
						print ' 
							<font size=1>'.$LDLabReport.'</font></button></a>&nbsp;</td></tr>';

					}
					print "</table>";
					if($linecount>15)
					{
						print '
						<p><font color=red><B>'.$LDNewSearch.':</font>
						<FORM action="'.$thisfile.'" method="post">
						<font face="Arial,Verdana"  color="#000000" size=-1>
						'.$LDSearchWordPrompt.'</B><p>
						<INPUT type="text" name="keyword" size="20" maxlength="40" value="'.$keyword.'"> 
						<input type=hidden name="search" value=1>
						<input type=hidden name="sid" value="'.$ck_sid.'">
						<input type=hidden name="lang" value="'.$lang.'">
						<input type=hidden name="mode" value="'.$mode.'">
						<INPUT type="image"  src=../img/'.$lang.'/'.$lang.'_searchlamp.gif border=0></font></FORM>
						<p>';
					}
}

?>
<p>

<a href="<?="$breakfile" ?>"><img src="../img/<?="$lang/$lang" ?>_cancel.gif" border=0 width=103 height=24 align=right></a>


<p>
<!--<hr width=80% align=left>
<p>
 <a href="ucons.php"><img src="../img/small_help.gif" border=0> <?=$LDWildCards ?></a>
 -->

</ul>
&nbsp;
</FONT>
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
<p>

<?php
require("../language/".$lang."/".$lang."_copyrite.htm");
 ?>
</FONT>
</BODY>
</HTML>
