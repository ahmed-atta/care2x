<?php if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
//if (!$sid||($sid!=$$ck_sid_buffer)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
//require("../language/".$lang."/lang_".$lang."_drg.php");
require_once('../include/inc_config_color.php');

$toggle=0;


$fielddata="diagnosis_code,description";

$keyword=trim($keyword);

if(($keyword)and($keyword!=" "))
  {
$dbhost="localhost";  //,,, format is "host:port" 
$dbname="drg";
$dbusername="httpd";
$dbpassword="";
$dbtable="care_icd10";

/***************** the ff: is to establish connection DO NOT EDIT ..................
  							the variable $DBLink_OK will be tested in the script to determine
							wether the link is established or not
***************************************************************************** */
 if ($link=mysql_connect($dbhost,$dbusername,$dbpassword))
 {
	if(mysql_select_db($dbname,$link)) 
	{	
		$DBLink_OK=1;
	}
	else $DBLink_OK=0; 
}


			$sql='SELECT '.$fielddata.' FROM '.$dbtable.' WHERE diagnosis_code LIKE "%'.$keyword.'%" OR description LIKE "%'.$keyword.'%" LIMIT 0,50';
        	$ergebnis=mysql_query($sql,$link);
			$linecount=0;
			if($ergebnis)
       		{
				while ($zeile=mysql_fetch_array($ergebnis)) $linecount++;
				
			}
			 else {echo "<p>".$sql."<p>$LDDbNoRead";};

}

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE></TITLE>
 
  <script language="javascript">
<!-- 
function pruf(d)
{
	if((d.keyword.value=="")||(d.keyword.value==" ")) return false;
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
 
  <?php 
require('../include/inc_css_a_hilitebu.php');
?>
 
</HEAD>

<BODY  onLoad="document.searchdata.keyword.select();document.searchdata.keyword.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">
<ul>
<FORM action="drg-search-care_icd10.php" method="post" name="searchdata" onSubmit="return pruf(this)">
<font face="Arial,Verdana"  color="#000000" size=-1>
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<B><?php echo $LDKeywordPrompt ?></B></font><p>
<font size=3><INPUT type="text" name="keyword" size="14" maxlength="40" onfocus=this.select() value="<?php echo $keyword ?>"></font> 
<INPUT type="submit" name="versand" value="<?php echo $LDSEARCH ?>"></FORM>

<p>
<a href="startframe.php?sid=<?php echo "$sid&lang=$lang"; ?>"><img <?php echo createLDImgSrc('../','cancel.gif','0') ?>></a>
<p>

<?php
if ($linecount>0) 
				{ 
					echo "".str_replace("~nr~",$linecount,$LDPhoneFound)."<p>";
					mysql_data_seek($ergebnis,0);
					echo "<form><table border=0 cellpadding=1 cellspacing=1> <tr bgcolor=#0000aa>";

						echo"<td></td><td><font face=arial size=2 color=#ffffff><b>ICD-10 Code</b></td>";
						echo"<td><font face=arial size=2 color=#ffffff><b>Beschreibung</b></td>";
		
					echo "</tr>";
					while($zeile=mysql_fetch_array($ergebnis))
					{
						echo "<tr bgcolor=";
						if($toggle) { echo "#efefef>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
						echo '<td><input type="checkbox" name="sel'.$i.'"></td>';
						for($i=0;$i<mysql_num_fields($ergebnis);$i++) 
						{
							echo '<td><font face=arial size=2>';
							if($zeile[$i]=="")echo "&nbsp;"; else echo $zeile[$i];
							echo "</td>";
						}
						echo "</tr>";
					}
					echo "</table></form>";
					if($linecount>15)
					{
						echo '
						<p><font color=red><B>Neue Suche:</font>
						<FORM action="search-care_icd10.php" method="post" onSubmit="return pruf(this)" name="form2">
						<font face="Arial,Verdana"  color="#000000" size=-1>
						Suchbegriff eingeben. z.B. Name oder Abteilung, u.s.w.</B><p>
						<INPUT type="text" name="keyword" size="14" maxlength="25" value="'.$keyword.'"> 
						<INPUT type="submit" name="versand" value="'.$LDSEARCH.'"></font></FORM>
						<p>
						<FORM action="startframe.php" >
						<input type="hidden" name="sid" value="'.$sid.'">
						<input type="hidden" name="lang" value="'.$lang.'">
      
						<INPUT type="submit"  value="'.$LDCancel.'"></FORM>
						<p>';
					}
				}


?>
</ul>
&nbsp;
</FONT>


</FONT>


</BODY>
</HTML>
