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
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require_once('../include/inc_front_chain_lang.php');

require_once('../include/inc_config_color.php');
$keyword=strtr($keyword,"%"," ");
$keyword=trim($keyword);

$dbtable='care_admission_patient';

$toggle=0;


$fielddata='patnum, name, vorname, gebdatum, item';


if(($mode=='search')and($keyword))
  {
		include('../include/inc_db_makelink.php');
		if($link&&$DBLink_OK) 
		{
            include_once('../include/inc_date_format_functions.php');
            
		
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
			OR gebdatum LIKE "'.formatDate2STD($suchwort,$date_format).'%"
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
			 else {echo "<p>".$sql."<p>$LDDbNoRead";};
	}
  	 else { echo "$LDDbNoLink<br>"; }

	
}
else $mode="";

require_once('../include/inc_date_format_functions.php');

if(empty($date_format))
{
   
}

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE></TITLE>
 
  <?php 
require('../include/inc_css_a_hilitebu.php');
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

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  onLoad="document.sform.keyword.select()" bgcolor=<?php echo $cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<table width=100% border=0 cellspacing="0">

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp;<?php echo $LDPatientSearch ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('admission_how2search.php')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
if($HTTP_COOKIE_VARS["ck_login_logged".$sid]) echo "startframe.php?sid=".$sid."&lang=".$lang; 
	else echo "aufnahme_pass.php?sid=$sid&target=entry&lang=$lang"; ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>
</table>
<ul>
<table width=90% border=0 cellpadding="0" cellspacing="0">
<tr>
<td colspan=3><a href="<?php if($HTTP_COOKIE_VARS[$local_user.$sid]) echo 'aufnahme_start.php?sid='.$sid.'&mode=?&lang='.$lang; 
else echo 'aufnahme_pass.php?sid='.$sid.'&lang='.$lang; ?>"><img <?php echo createLDImgSrc('../','ein-gray.gif','0') ?> 
alt="<?php echo $LDAdmit ?>" <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) 
onMouseOut=hilite(this,0)>';?></a><img <?php echo createLDImgSrc('../','such-b.gif','0') ?> alt="<?php echo $LDSearch ?>"><a href="<?php if($HTTP_COOKIE_VARS[$local_user.$sid]) echo 'aufnahme_list.php?sid='.$sid.'&lang='.$lang; 
else echo 'aufnahme_pass.php?sid='.$sid.'&lang='.$lang.'&target=archiv'; ?>"><img <?php echo createLDImgSrc('../','arch-gray.gif','0') ?>  
alt="<?php echo $LDArchive ?>" <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) 
onMouseOut=hilite(this,0)>';?></a></td>
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
<font size=3><INPUT type="text" name="keyword" size="14" maxlength="40" value=<?php echo $keyword ?>></font> 
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="search">
<!-- <INPUT type="submit" value="<?php echo $LDSEARCH ?>"> -->
<input type="image" <?php echo createLDImgSrc('../','searchlamp.gif','0','absmiddle') ?>>
</FORM>

<p>
<a href=
<?php if($mode=='search') echo '"aufnahme_daten_such.php?sid='.$sid.'&lang='.$lang.'">'; 
	else
	{
	  if($HTTP_COOKIE_VARS["ck_login_logged".$sid])   echo '"startframe.php?sid='.$sid.'&lang='.$lang.'">'; 
	  else 
	  	echo '"aufnahme_pass.php?sid='.$sid.'&target=search&lang='.$lang.'">'; 
	}	
?><img <?php echo createLDImgSrc('../','cancel.gif','0') ?>></a>
<p>

<?php
//echo $mode;
echo '<hr width=80% align=left><p>'.str_replace("~nr~",$linecount,$LDSearchFound).'<p>';
if ($linecount) 
	{ 
					mysql_data_seek($ergebnis,0);
					
					/* Load the common icons */
					$img_options=createComIcon('../','statbel2.gif','0');

					echo '
						<table border=0 cellpadding=2 cellspacing=1> <tr bgcolor="#0000aa">';
					for($i=0;$i<sizeof($fieldname);$i++) 
					{
						echo'
						<td><font face=arial size=2 color="#ffffff"><b>'.$fieldname[$i].'</b></td>';
		
					}
					echo"</tr>";

					while($zeile=mysql_fetch_array($ergebnis))
					{
						echo "
							<tr bgcolor=";
						if($toggle) { echo "#efefef>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".ucfirst($zeile['patnum']);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".ucfirst($zeile['name']);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".ucfirst($zeile['vorname']);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".formatDate2Local($zeile['gebdatum'],$date_format);
                        echo "</td>";	

					    if($HTTP_COOKIE_VARS[$local_user.$sid]) echo '
						<td><font face=arial size=2>&nbsp;
							<a href=aufnahme_daten_zeigen.php?sid='.$sid.'&lang='.$lang.'&from=such&itemname='.$zeile[item].'>
							<img '.$img_options.' alt="'.$LDShowData.'"></a>&nbsp;</td></tr>';

					}
					echo "
						</table>";
					if($linecount>15)
					{
						echo '
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
<a href="aufnahme_start.php?sid=<?php echo "$sid&lang=$lang"; ?>&mode=?"><?php echo $LDAdmWantEntry ?></a><br>
<a href="aufnahme_list.php?sid=<?php echo "$sid&lang=$lang"; ?>"><?php echo $LDAdmWantArchive ?></a>
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
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>

</FONT>


</BODY>
</HTML>
