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
define("LANG_FILE","aufnahme.php");
$local_user="aufnahme_user";
require("../include/inc_front_chain_lang.php");

require("../include/inc_config_color.php");
$keyword=strtr($keyword,"%"," ");
$keyword=trim($keyword);

$dbtable="mahopatient";

$toggle=0;


$fielddata="patnum, name, vorname, gebdatum, item";


if(($mode=="search")and($keyword))
  {
		include("../include/inc_db_makelink.php");
		if($link&&$DBLink_OK) 
		{
			$suchwort=trim($keyword);
			if(is_numeric($suchwort))
			{
				$suchwort=(int) $suchwort;
				$numeric=1;
				if($suchwort<20000000) $suchbuffer=$suchwort+20000000; else $suchbuffer=$suchwort;
			}
			$sql='SELECT '.$fielddata.' FROM '.$dbtable.' 
			WHERE name LIKE "'.$suchwort.'%" 
			OR vorname LIKE "'.$suchwort.'%"
			OR gebdatum LIKE "'.$suchwort.'%"
			OR patnum LIKE "'.$suchbuffer.'" 
			ORDER BY patnum';

        	$ergebnis=mysql_query($sql,$link);
			if($ergebnis)
       		{
				$linecount=0;
				while ($zeile=mysql_fetch_array($ergebnis)) $linecount++;
				if ($linecount) 
				{ 
					mysql_data_seek($ergebnis,0);
					if(($linecount==1)&&$numeric)
					{
						$zeile=mysql_fetch_array($ergebnis);
	  					mysql_close($link);
						header("location:aufnahme_daten_zeigen.php?sid=$sid&from=such&itemname=$zeile[item]");
						exit;
					}
				}
				else $mode="";

			}
			 else {print "<p>".$sql."<p>$LDDbNoRead";};
	}
  	 else { print "$LDDbNoLink<br>"; }

	
}
else $mode="";
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE></TITLE>
 
  <?php 
require("../include/inc_css_a_hilitebu.php");
?>
<script language="javascript">
<!-- 
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>
 
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  onLoad="document.sform.keyword.select()" bgcolor=<?php print $cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<table width=100% border=0 cellspacing="0">

<tr>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp;<?php echo $LDPatientSearch ?></STRONG></FONT>
</td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('admission_how2search.php')"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
if($HTTP_COOKIE_VARS["ck_login_logged".$sid]) print "startframe.php?sid=$sid&lang=$lang"; 
	else print "aufnahme_pass.php?sid=$sid&target=entry&lang=$lang"; ?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?php echo $LDCloseWin ?>" width=93 height=41  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>
</table>
<ul>
<table width=90% border=0 cellpadding="0" cellspacing="0">
<tr>
<td colspan=3><a href="<?php if($HTTP_COOKIE_VARS[$local_user.$sid]) print 'aufnahme_start.php?sid='.$sid.'&mode=?&lang='.$lang; else print 'aufnahme_pass.php?sid='.$sid.'&lang='.$lang; ?>"><img src="../img/<?php echo "$lang/$lang" ?>_ein-gray.gif" alt="<?php echo $LDAdmit ?>" border=0 width=130 height=25 <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><img src="../img/<?php echo "$lang/$lang" ?>_such-b.gif" alt="<?php echo $LDSearch ?>" border=0 width=130 height=25  ><a href="<?php if($HTTP_COOKIE_VARS[$local_user.$sid]) print 'aufnahme_list.php?sid='.$sid.'&lang='.$lang; else print 'aufnahme_pass.php?sid='.$sid.'&lang='.$lang.'&target=archiv'; ?>"><img src="../img/<?php echo "$lang/$lang" ?>_arch-gray.gif"  alt="<?php echo $LDArchive ?>" border=0 width=130 height=25  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr >
<td bgcolor=#333399 colspan=3>
<FONT  SIZE=1  FACE="Arial"><STRONG> &nbsp; </STRONG></FONT>
</td>
</tr>
<tr bgcolor="#DDE1EC" >
<td bgcolor=#333399>&nbsp;</td>
<td ><p><br>
<ul>
<FONT    SIZE=-1  FACE="Arial">

<FORM action="aufnahme_daten_such.php" method="post" name=sform>
<font face="Arial,Verdana"  color="#000000" size=-1>
<B><?php echo $LDEntryPrompt ?></B></font><p>
<font size=3><INPUT type="text" name="keyword" size="14" maxlength="40" value=<?php print $keyword ?>></font> 
<input type="hidden" name="sid" value="<?php print $sid; ?>">
<input type="hidden" name="lang" value="<?php print $lang; ?>">
<input type="hidden" name="mode" value="search">
<INPUT type="submit" value="<?php echo $LDSEARCH ?>">
</FORM>

<p>
<a href=
<?php if($mode=="search") print '"aufnahme_daten_such.php?sid='.$sid.'&lang='.$lang.'">'; 
	else
	{
	  if($HTTP_COOKIE_VARS["ck_login_logged".$sid])   print '"startframe.php?sid='.$sid.'&lang='.$lang.'">'; 
	  else 
	  	print '"aufnahme_pass.php?sid='.$sid.'&target=search&lang='.$lang.'">'; 
	}	
?><img src="../img/<?php echo "$lang/$lang" ?>_cancel.gif" width=103 height=24 border=0></a>
<p>

<?php
//print $mode;
print '<hr width=80% align=left><p>'.str_replace("~nr~",$linecount,$LDSearchFound).'<p>';
if ($linecount) 
	{ 
					mysql_data_seek($ergebnis,0);

					print '
						<table border=0 cellpadding=2 cellspacing=1> <tr bgcolor="#0000aa">';
					for($i=0;$i<sizeof($fieldname);$i++) 
					{
						print'
						<td><font face=arial size=2 color="#ffffff"><b>'.$fieldname[$i].'</b></td>';
		
					}
					print"</tr>";

					while($zeile=mysql_fetch_array($ergebnis))
					{
						print "
							<tr bgcolor=";
						if($toggle) { print "#efefef>"; $toggle=0;} else {print "#ffffff>"; $toggle=1;};
	
						for($i=0;$i<mysql_num_fields($ergebnis)-1;$i++) 
						{
							print"<td><font face=arial size=2>";
							if($zeile[$i]=="")print "&nbsp;"; else print $zeile[$i];
							print "</td>";
						}
					    if($HTTP_COOKIE_VARS[$local_user.$sid]) print '
						<td><font face=arial size=2>&nbsp;
							<a href=aufnahme_daten_zeigen.php?sid='.$sid.'&lang='.$lang.'&from=such&itemname='.$zeile[item].'>
							<img src="../img/statbel2.gif" width=20 height=20 border=0 alt="'.$LDShowData.'"></a>&nbsp;</td></tr>';

					}
					print "
						</table>";
					if($linecount>15)
					{
						print '
						<p><font color=red><B>Neue Suche:</font>
						<FORM action="aufnahme_daten_such.php" method="post">
						<font face="Arial,Verdana"  color="#000000" size=-1>
						Stichwort eingeben. z.B. Name oder Abteilung, u.s.w.</B><p>
						<INPUT type="text" name="keyword" size="14" maxlength="25" value='.$keyword.'> 
						<input type="hidden" name="sid" value="'.$sid.'">
						<input type="hidden" name="mode" value="search">
						<input type="hidden" name="lang" value="'.$lang.'">
						<INPUT type="submit"  value="'.$LDSEARCH.'"></font></FORM>
						<p>
						<FORM action="aufnahme_pass.php" >
						<input type="hidden" name="mode" value="search">
						<input type="hidden" name="sid" value="'.$sid.'">
						<input type="hidden" name="lang" value="'.$lang.'">
						<INPUT type="submit"  value="'.$LDCancel.'"></FORM>
						<p>';
					}
				}
?>
<p>
<hr width=80% align=left><p>
<a href="aufnahme_start.php?sid=<?php print "$sid&lang=$lang"; ?>&mode=?"><?php echo $LDAdmWantEntry ?></a><br>
<a href="aufnahme_list.php?sid=<?php print "$sid&lang=$lang"; ?>"><?php echo $LDAdmWantArchive ?></a>
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
</ul>
<p>
<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>

</FONT>


</BODY>
</HTML>
