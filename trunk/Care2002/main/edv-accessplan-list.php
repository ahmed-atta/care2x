<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_edvzugang_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_edp.php");

require("../req/config-color.php");
$breakfile="edv.php?sid=$ck_sid&lang=$lang";

?>
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? 
require("../req/css-a-hilitebu.php");
?>
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
</HEAD>
<BODY BGCOLOR="<? print $cfg['bot_bgcolor']; ?>" TEXT="#000000" LINK="#0000FF" VLINK="#800080" topmargin=0 leftmargin=0 marginheight=0 marginwidth=0>



<table width=100% border=0 cellpadding=5 cellspacing=0>
<tr>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG><?="$LDEDP $LDListActual" ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('edp.php','access','list')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDClose ?>"  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>

<tr bgcolor="<? print $cfg['body_bgcolor']; ?>"><FONT    SIZE=-1  FACE="Arial">
<td colspan=2><p>


<?
  if ($remark=="itemdelete") print '<img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle"><FONT SIZE=2  FACE="verdana,Arial" color="#990000"> '.$LDAccessDeleted.' '.$LDFfActualAccess.' </font>';
?>
<p>

<FONT    SIZE=1  FACE="Arial">

<?
require("../req/db-makelink.php");
if($link&&$DBLink_OK) 
{	

		$sql="SELECT * FROM mahopass";
        $ergebnis=mysql_query($sql,$link);
	if($ergebnis)
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
					<a href=edv-accessplan-itemupdate.php?sid=$ck_sid&lang=$lang&itemname=".str_replace(' ','+',$zeile[mahopass_id])." title=\"$LDChange\"> $LDInitChange</a> \n
			<a href=edv-accessplan-itemlock.php?sid=$ck_sid&lang=$lang&itemname=".str_replace(' ','+',$zeile[mahopass_id])." ";
			if ($zeile[mahopass_lockflag]) print "title=\"$LDUnlock\" > $LDInitUnlock"; else print "title=\"$LDLock\"> $LDInitLock";
			print "</a> \n
			<a href=edv-accessplan-itemdelete.php?sid=$ck_sid&lang=$lang&itemname=".str_replace(' ','+',$zeile[mahopass_id])." title=\"$LDDelete\">	$LDInitDelete</a> </td>";
			print "</tr>";
        };
        print "
					</table>
				</td></tr>
				</table>";
	   }else;
}
   else { print "$LDDbNoLink<br>"; } 

?>

</td>

</tr>
</table>

<p>
<FORM method="post" action="<? if($ck_edvzugang_src=="listpass") print "edv-accessplan-list-pass.php"; else print "edv-accessplan-edit.php"; ?>" >
<input type=hidden name="sid" value="<? print $ck_sid; ?>">
<input type=hidden name="lang" value="<? print $lang; ?>">
<input type=hidden name="remark" value="fromlist">
<INPUT type="submit"  value=" <?=$LDOK ?> "></font></FORM>

</FONT>
<p>

<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>
    
</BODY>
</HTML>
