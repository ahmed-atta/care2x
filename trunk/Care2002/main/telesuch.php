<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/define("LANG_FILE","phone.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");

require("../include/inc_config_color.php");

// reset all 2nd level lock cookies
require("../include/inc_2level_reset.php");

$dbtable="mahophone";

$toggle=0;


$fielddata="mahophone_name, mahophone_vorname, mahophone_inphone1, mahophone_inphone2,
			mahophone_inphone3, mahophone_funk1,
			mahophone_funk2, mahophone_exphone1, mahophone_exphone2";

$keyword=trim($keyword);

if(($keyword)and($keyword!=" "))
  {

 	include("../include/inc_db_makelink.php");
	if($link&&$DBLink_OK) 
		{
			$sql='SELECT '.$fielddata.' FROM '.$dbtable.' WHERE mahophone_name LIKE "'.$keyword.'%" OR mahophone_vorname LIKE "'.$keyword.'%" ORDER BY mahophone_name';
        	$ergebnis=mysql_query($sql,$link);
			$linecount=0;
			if($ergebnis)
       		{
				while ($zeile=mysql_fetch_array($ergebnis)) $linecount++;
				
			}
			 else {print "<p>".$sql."<p>$LDDbNoRead";};
	}
  	 else { print "$LDDbNoLink<br>"; } 
}

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
require("../include/inc_css_a_hilitebu.php");
?>
 
</HEAD>

<BODY  onLoad="document.searchdata.keyword.select();document.searchdata.keyword.focus();" bgcolor=<?php print $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<img src="../img/phone.gif" border=0 width=74 height=73 align="absmiddle">
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=6  FACE="verdana"> <b><?php echo "$LDPhoneDir $LDSearch" ?></b></font>
<table width=100% border=0 cellpadding="0" cellspacing="0">
<tr>
<td colspan=3><img src="../img/<?php echo "$lang/$lang" ?>_such-b.gif" border=0 width=130 height=25><a href="telesuch_phonelist.php?sid=<?php print "$sid&lang=$lang"; ?>"><img src="../img/<?php echo "$lang/$lang"?>_phonedir-gray.gif" border=0 width=130 height=25 <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="telesuch_edit_pass.php?sid=<?php print "$sid&lang=$lang"; ?>"><img src="../img/<?php echo "$lang/$lang"?>_newdata-gray.gif" border=0 width=130 height=25 <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
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

<FORM action="telesuch.php" method="post" name="searchdata" onSubmit="return pruf(this)">
<font face="Arial,Verdana"  color="#000000" size=-1>
<B><?php echo $LDKeywordPrompt ?></B></font><p>
<font size=3><INPUT type="text" name="keyword" size="14" maxlength="40" onfocus=this.select() value="<?php print $keyword ?>"></font> 
<INPUT type="submit" name="versand" value="<?php echo $LDSEARCH ?>">
<input type="hidden" name="sid" value="<?php print $sid; ?>">
<input type="hidden" name="lang" value="<?php print $lang; ?>">
</FORM>

<p>
<a href="startframe.php?sid=<?php print "$sid&lang=$lang"; ?>"><img src="../img/<?php echo "$lang/$lang" ?>_cancel.gif" width=103 height=24 border=0></a>
<p>

<?php
if ($linecount>0) 
				{ 
					print "<hr width=80% align=left><p>".str_replace("~nr~",$linecount,$LDPhoneFound)."<p>";
					mysql_data_seek($ergebnis,0);
					print "<table border=0 cellpadding=3 cellspacing=1> <tr bgcolor=#0000aa>";
					for($i=0;$i<sizeof($fieldname);$i++) 
					{
						print"<td><font face=arial size=2 color=#ffffff><b>".$fieldname[$i]."</b></td>";
		
					}
					print "</tr>";
					while($zeile=mysql_fetch_array($ergebnis))
					{
						print "<tr bgcolor=";
						if($toggle) { print "#efefef>"; $toggle=0;} else {print "#ffffff>"; $toggle=1;};
	
						for($i=0;$i<mysql_num_fields($ergebnis);$i++) 
						{
							print"<td><font face=arial size=2>";
							if($zeile[$i]=="")print "&nbsp;"; else print $zeile[$i];
							print "</td>";
						}
						print "</tr>";
					}
					print "</table>";
					if($linecount>15)
					{
						print '
						<p><font color=red><B>New Search:</font>
						<FORM action="telesuch.php" method="post" onSubmit="return pruf(this)" name="form2">
						<font face="Arial,Verdana"  color="#000000" size=-1>
						'.$LDKeywordPrompt.'</B><p>
						<INPUT type="text" name="keyword" size="14" maxlength="25" value="'.$keyword.'"> 
						<INPUT type="submit" name="versand" value="'.$LDSEARCH.'"></font>
						<input type="hidden" name="sid" value="'.$sid.'">
						<input type="hidden" name="lang" value="'.$lang.'">
						</FORM>
						<p>
						<FORM action="startframe.php" >
						<input type="hidden" name="sid" value="'.$sid.'">
						<input type="hidden" name="lang" value="'.$lang.'">
      
						<INPUT type="submit"  value="'.$LDCancel.'"></FORM>
						<p>';
					}
				}


?>
<p>
<hr width=80% align=left><p>
<img src="../img/varrow.gif" border=0 width=20 height=15> <a href="telesuch_phonelist.php?sid=<?php echo "$sid&lang=$lang";?>"><?php echo $LDShowDir ?></a><br>
<img src="../img/varrow.gif" border=0 width=20 height=15> <a href="telesuch_edit_pass.php?sid=<?php echo "$sid&lang=$lang";?>"><?php echo $LDNewEntry ?></a><br>
<img src="../img/frage.gif" width=15 height=15> <a href="javascript:gethelp('phone_how2start.php','search','search')"><?php echo $LDHow2SearchPhone ?></a><br>
<img src="../img/frage.gif" width=15 height=15> <a href="javascript:gethelp('phone_how2start.php','search','dir')"><?php echo $LDHow2OpenDir ?></a><br>
<img src="../img/frage.gif" width=15 height=15> <a href="javascript:gethelp('phone_how2start.php','search','newphone')"><?php echo $LDHowEnter ?></a><br>
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
require("../language/".$lang."/".$lang."_copyrite.php");
 ?>

</FONT>


</BODY>
</HTML>
