<?php
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../language/".$lang."/lang_".$lang."_phone.php");

require("../req/config-color.php");

$dbtable="mahophone";

if($displaysize=="") $displaysize=10;

include("../req/db-makelink.php");
if($link&&$DBLink_OK) 
{	//print $dbname." databank selected. <p>";

		$sql="SELECT * FROM ".$dbtable." ORDER BY mahophone_item";
       if( $ergebnis=mysql_query($sql,$link))
	   {
	   		$rows=0;
			while($zeile=mysql_fetch_array($ergebnis)) $rows++;
			if($rows)
			{
				mysql_data_seek($ergebnis,0);
			}
		}
} else { print "$LDDbNoLink<br>"; } 

?>

<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<TITLE></TITLE>

  <? 
require("../req/css-a-hilitebu.php");
?>

</HEAD>
<BODY  bgcolor=<? print $cfg['body_bgcolor']; ?>
<? if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<? if(!$edit) : ?>
<img src="../img/phone.gif" align="absmiddle">
<? endif ?>
<FONT  COLOR="<?=$cfg[top_txtcolor] ?>"  SIZE=6  FACE="verdana"> <b><?=$LDPhoneDir ?></b></font>

<table  border=0 cellpadding=0 cellspacing=0 width="100%">
<tr>
<td colspan=3><nobr>
<? 
if (!$edit) { print '<a href="telesuch.php?sid='.$ck_sid.'&lang='.$lang.'"><img src=../img/'.$lang.'/'.$lang.'_such-gray.gif border=0';
if($cfg['dhtml'])print' style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)';
print '></a>'; } ?><img src=../img/<?="$lang/$lang"?>_phonedir-b.gif><?
if(!$edit) print "<a href=\"telesuch_edit_pass.php?sid=$ck_sid&lang=$lang\">";
	else print "<a href=\"telesuch_edit.php?lang=$lang&remark=fromlist&sid=$ck_sid&edit=$edit\">";
?><img src=../img/<?="$lang/$lang"?>_newdata-gray.gif border=0 <? if($cfg['dhtml'])print' style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; ?>></a></nobr></td>
</tr>

<tr>
<td bgcolor=#333399 colspan=3>
<FONT  COLOR="white"  SIZE=2  FACE="Arial"><STRONG> &nbsp;</STRONG></FONT>
</td>
</tr>
<tr bgcolor="#DDE1EC">
<td bgcolor=#333399>&nbsp;</td>
<td ><br>


<FONT    SIZE=1  FACE="Arial">

<?
if($rows)
{
	$colnum=mysql_num_fields($ergebnis);
		
		if(!$edit) $colstop=$colnum-3; else $colstop=$colnum;

		if(!$batchnum)
		{

			$linecount=0;
			while ($zeile=mysql_fetch_array($ergebnis)) $linecount++;

			if(($linecount%$displaysize)>0)
			$pagecount=($linecount/$displaysize)+1;  else $pagecount=($linecount/$displaysize);
			$pagecount=(int)$pagecount;
			if($linecount) mysql_data_seek($ergebnis,0);
			if($newdata)
				{
					$batchnum=$pagecount;
					$datanum=(($batchnum-1)*$displaysize);
//					$endflag=($datanum+$displaysize); 

				}else
					{		
						$datanum=0;	
//						$endflag=$displaysize;
					}
		}
		 else
		  {

			$datanum=(($batchnum-1)*$displaysize);
//			$endflag=($batchnum*$displaysize); 
		  };

		if($update) print "<font color=maroon size=3>$LDUpdateOk</font>";
		
        print '<table  border="1" cellpadding="1" cellspacing="0">';
        print "<tr nowrap >";
		print "<td colspan=";
		if($currentuser=="") print $colstop; else print $colstop+1;
		print "><FONT    SIZE=-1  FACE=Arial>&nbsp;<b> $LDActualDir </b></td>";
       	print "</tr>"; 
        print "<tr nowrap bgcolor=#ffffee>";
// print $batchnum.$datanum.$pagecount.$displaysize.$endflag;
		for($i=0;$i<$colstop;$i++) 
 		{	
 		print '<td nowrap><FONT  SIZE=1  FACE=Arial color="#0000cc"><b>'.$LDExtFields[$i].'</b></td>';
         }
		if ($edit) print "<td>&nbsp;</td>";	
			print "</tr>"; 

		$toggle=0; 
		$datacount=0;
//		for ($j=$datanum+1;$j<=$endflag;$j++)
//		{
			if ($linecount>1) mysql_data_seek($ergebnis,$datanum); 

			while (($zeile=mysql_fetch_array($ergebnis))and($datacount<$displaysize))
			{  
//				if($zeile[mahophone_item]==$j)
//				 {	
					if($toggle) {print "<tr nowrap bgcolor=#efefef>\n";$toggle=0;} else { print "<tr  nowrap bgcolor=#ffffff>\n";$toggle=1;};

					$datacount++;
	
					for($i=0;$i<$colstop;$i++) 
					{
					print "<td nowrap>";
					if (($update)&&($zeile[mahophone_item]==$itemname)) print "<FONT SIZE=1 color=red  FACE=Arial>";
						else print "<FONT SIZE=1  FACE=Arial>";
					print "<nobr>&nbsp;".$zeile[$i]."</td>\n";
					}
					if ($edit)
					{
						print "<td nowrap><FONT FACE=Arial size=1><nobr>
							<a href=\"telesuch_eintrag_update.php?sid=$ck_sid&lang=$lang&from=list&itemname=".$zeile[mahophone_item]."&batchnum=$batchnum&displaysize=$displaysize&linecount=$linecount&pagecount=$pagecount&edit=$edit\">
						$LDEdit</a> \n";
						print "<a href=\"telesuch_eintrag_delete.php?sid=$ck_sid&lang=$lang&from=list&itemname=".$zeile[mahophone_item]."&batchnum=$batchnum&displaysize=$displaysize&linecount=$linecount&pagecount=$pagecount&edit=$edit\">
						$LDDelete</a> </td>";
					}
					print "</tr>\n";
//					break;
//				 };
   		    };
//		};
        print "</table><br>\n";
		if($pagecount>1)
		 {  	
			if ($batchnum=="") $batchnum=1;
			print "<FONT SIZE=-1  FACE=Arial> $LDMoreInfo: &nbsp;&nbsp;\n"; 
			if ($batchnum>1)
			print '<a href=telesuch_phonelist.php?sid='.$ck_sid.'&lang='.$lang.'&pagecount='.$pagecount.'&linecount='.$linecount.'&batchnum='.($batchnum-1).'&displaysize='.$displaysize.'&edit='.$edit.'><font color=red ><<</font></a> ';
			for($i=1;$i<=$pagecount;$i++)
			{ 	
				if ($i==$batchnum) print "<b>".$i."</b>"; else print ' <a href=telesuch_phonelist.php?sid='.$ck_sid.'&lang='.$lang.'&pagecount='.$pagecount.'&linecount='.$linecount.'&batchnum='.$i.'&displaysize='.$displaysize.'&edit='.$edit.'>'.$i.'</a> ';
			}
	
			if ($batchnum<$pagecount)	print '<a href=telesuch_phonelist.php?sid='.$ck_sid.'&lang='.$lang.'&pagecount='.$pagecount.'&linecount='.$linecount.'&batchnum='.($batchnum+1).'&displaysize='.$displaysize.'&edit='.$edit.'><font color=red >>></font></a>';
			print "</FONT>\n";
		
		 }

		print "<p><FONT SIZE=-1  FACE=Arial>$LDMaxItem: ".($linecount+1)."</font>\n";
		print "<p><FORM method=post action=telesuch_phonelist.php>
				<FONT SIZE=-1  FACE=Arial>
				<input type=hidden name=route value=validroute>
				<input type=hidden name=remark value=fromlist>
				<input type=hidden name=sid value=\"$ck_sid\">
				<input type=hidden name=edit value=\"$edit\">
    				<input type=text name=displaysize value=".$displaysize." size=2> $LDRows
				<INPUT type=submit  value=\"$LDShow\".></font></FORM>";		
}// end of if(rows)
?>

<FONT    SIZE=-1  FACE=Arial>

<? if ($edit) : ?>
<FORM method="post" action="telesuch_edit.php" >
<input type="hidden" name="remark" value="fromlist">
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="hidden" name="lang" value="<? print $lang; ?>">
<input type="hidden" name="edit" value="<? print $edit ?>">
<INPUT type="submit"  value="<?=$LDNewPhoneEntry ?>"></font></FORM>
<p>
<? else : ?>
<p>
<FORM method="post" action="telesuch.php" >
<input type="hidden" name="route" value="validroute">
<input type="hidden" name="remark" value="fromlist">
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="hidden" name="lang" value="<? print $lang; ?>">
<INPUT type="submit"  value="<?=$LDCancel ?>"></font></FORM>
<p>
<? endif; ?>

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
    
</BODY>
</HTML>
