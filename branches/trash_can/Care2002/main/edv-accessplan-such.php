<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define("LANG_FILE","edp.php");
$local_user="ck_edv_user";
require("../include/inc_front_chain_lang.php");

require("../include/inc_config_color.php");
$breakfile="edv.php?sid=$sid&lang=$lang";

$thisfile="edv-accessplan-such.php";

if($mode)
{
	include("../include/inc_db_makelink.php");
	if($link&&$DBLink_OK) 
					{	$sql='SELECT * FROM mahopass WHERE mahopass_id LIKE "'.addslashes($name).'%" OR mahopass_name LIKE "'.addslashes($name).'%"';
						$ergebnis=mysql_query($sql,$link);
						if($ergebnis)
							{
											$rows=0;
											while($zeile=mysql_fetch_array($ergebnis)) $rows++;
											if($rows)
											{ mysql_data_seek($ergebnis,0);
											}
							}
	}
  	else { print "$LDDbNoLink<br>$sql"; }
}

?>

<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
</script></HEAD>

<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<?php print $cfg['bot_bgcolor'];?> onLoad="document.searchwin.name.select()">


<FONT    SIZE=-1  FACE="Arial">

<P>


<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?php echo "$LDEDP $LDAccessRight $LDSearch" ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('')"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<?php print $cfg['body_bgcolor'];?> colspan=2>

<p><br>
<ul>

<?php if(($mode=="search")&&($rows))
{
 print '
				<table border=0 bgcolor=#999999 cellpadding=0 cellspacing=0>
				<tr><td>
				<table border="0" cellpadding="5" cellspacing="1">';
        print "
					<tr bgcolor=#dddddd >";
		print "
					<td colspan=8><FONT SIZE=1  FACE=verdana,Arial color=\"#800000\"><b>$LDActualAccess</b></td>";
        print "
					</tr>"; 
        print "	
					<tr bgcolor=#dfdfdf>";
		for($i=0;$i<sizeof($LDAccessIndex);$i++)
			print "
			<td><FONT    SIZE=1  FACE=verdana,Arial><b>".$LDAccessIndex[$i]."</b></td>";
            print "</tr>"; 

		while ($zeile=mysql_fetch_array($ergebnis))
		{  
			if($zeile[exc]) continue;
			 print "
						<tr  bgcolor=#efefef>\n";
			print "
						<td><FONT    SIZE=1  FACE=Arial>".$zeile[mahopass_name]."</td>\n
						<td><FONT    SIZE=1  FACE=Arial>".$zeile[mahopass_id]."</td>\n
						<td><FONT    SIZE=1  FACE=Arial>".$zeile[mahopass_password]."</td><td>\n";
			if ($zeile[mahopass_lockflag])
				   print '
				   		<img src="../img/padlock.gif" border=0 width=12 height=15>'; else print '<img src=../img/arrow-gr.gif width=12 height=12>';
			print "
						</td>\n <td><FONT    SIZE=1  FACE=Arial>".
														$zeile[mahopass_area1]." ".
														$zeile[mahopass_area2]." ".
														$zeile[mahopass_area3]." ".
														$zeile[mahopass_area4]." ".
														$zeile[mahopass_area5]." ".
														$zeile[mahopass_area6]." ".
														$zeile[mahopass_area7]." ".
														$zeile[mahopass_area8]." ".
														$zeile[mahopass_area9]." ".
														$zeile[mahopass_area10].
														"</td>\n";
			print "
					<td><FONT    SIZE=1  FACE=Arial> $zeile[mahopass_date] / $zeile[mahopass_time] </td>";
			print "
					<td><FONT    SIZE=1  FACE=Arial>".$zeile[mahopass_encoder]."</td>";
            print "
					<td><FONT    SIZE=1  FACE=verdana,Arial>
					<a href=edv-accessplan-itemupdate.php?sid=$sid&lang=$lang&itemname=".str_replace(' ','+',$zeile[mahopass_id])." title=\"$LDChange\"> $LDInitChange</a> \n
			<a href=edv-accessplan-itemlock.php?sid=$sid&lang=$lang&itemname=".str_replace(' ','+',$zeile[mahopass_id])." ";
			if ($zeile[mahopass_lockflag]) print "title=\"$LDUnlock\" > $LDInitUnlock"; else print "title=\"$LDLock\"> $LDInitLock";
			print "</a> \n
			<a href=edv-accessplan-itemdelete.php?sid=$sid&lang=$lang&itemname=".str_replace(' ','+',$zeile[mahopass_id])." title=\"$LDDelete\">	$LDInitDelete</a> </td>";
			print "</tr>";
        };
        print "
					</table>
				</td></tr>
				</table>";
}
?>

<form method="post" action="<?php echo $thisfile; ?>" name="searchwin">
<table  border=1 cellpadding="20">
<tr>
<td bgcolor="#ffffdd"><font face=verdana,arial size=2 color=#800000>
<p>
<b><?php echo $LDKeywordPrompt ?></b><p>

<table border="0" cellpadding="5" cellspacing="1">
<tr>
<td><font face=verdana,arial size=2 color=#000080><?php echo "$LDName / $LDUserId" ?>:<br>
<input type="text" name="name" size=25 maxlength=40>
</td>
</tr>

<tr><td><input type="submit" value="<?php echo $LDSearch ?>"><p>
		<input type="reset" value="<?php echo $LDReset ?>"></td>
</tr>
</table>
<input type="hidden" name="sid" value="<?php print $sid;?>">
<input type="hidden" name="lang" value="<?php print $lang;?>">
<input type="hidden" name="mode" value="search">

</form>
</ul>
</td>
</tr>
</table>        

<p>

</td>
</tr>
</table>        
<br>

<FORM  method=get action="edv-accessplan-such-pass.php" >
<input type="hidden" name="sid" value="<?php print $sid;?>">
<input type="hidden" name="lang" value="<?php print $lang;?>">
<INPUT type="submit"  value="<?php echo $LDCancel ?>"></FORM>
<p>

<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>


</FONT>


</BODY>
</HTML>
