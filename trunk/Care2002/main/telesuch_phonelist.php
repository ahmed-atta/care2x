<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/*
CARE 2002 Integrated Information System beta 1.0.03 - 2002-10-26 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
define('LANG_FILE','phone.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php');

$dbtable='care_phone';

if($displaysize=='') $displaysize=10;

include('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
{	

    /* Load the date formatter */
    include_once('../include/inc_date_format_functions.php');
    


   $fielddata='item_nr, title, name, vorname, beruf, bereich1, bereich2,  inphone1, inphone2, inphone3, funk1, funk2, exphone1, exphone2, roomnr';

   if ($edit) $fielddata.=', date, time';

	$sql='SELECT '.$fielddata.' FROM '.$dbtable.' ORDER BY name';
    if( $ergebnis=mysql_query($sql,$link))
	{
	   	$rows=0;
		while($zeile=mysql_fetch_array($ergebnis)) $rows++;
		if($rows) mysql_data_seek($ergebnis,0);
	}
} else { echo "$LDDbNoLink<br>"; } 
?>

<HTML>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE></TITLE>
<?php 
require('../include/inc_css_a_hilitebu.php');
?>
</HEAD>
<BODY  bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<?php if(!$edit) : ?>
<img <?php echo createComIcon('../','phone.gif','0','absmiddle') ?>>
<?php endif ?>
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=6  FACE="verdana"> <b><?php echo $LDPhoneDir ?></b></font>

<table  border=0 cellpadding=0 cellspacing=0 width="100%">
<tr>
<td colspan=3><nobr>
<?php 
if (!$edit) { echo '<a href="telesuch.php?sid='.$sid.'&lang='.$lang.'"><img '.createLDImgSrc('../','such-gray.gif','0').'';
if($cfg['dhtml'])echo' style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)';
echo '></a>'; } ?><img <?php echo createLDImgSrc('../','phonedir-b.gif','0') ?>><?php if(!$edit) echo "<a href=\"telesuch_edit_pass.php?sid=$sid&lang=$lang\">";
	else echo "<a href=\"telesuch_edit.php?lang=$lang&remark=fromlist&sid=$sid&edit=$edit\">";
?><img <?php echo createLDImgSrc('../','newdata-gray.gif','0') ?> border=0 <?php if($cfg['dhtml'])echo' style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; ?>></a></nobr></td>
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

<?php if($rows)
{
		//$colnum=mysql_num_fields($ergebnis);
		
		//if(!$edit) $colstop=$colnum-3; else $colstop=$colnum;
		
		$colstop=mysql_num_fields($ergebnis);

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
				}else $datanum=0;	
		}
		 else	$datanum=(($batchnum-1)*$displaysize);

		if($update) echo "<font color=maroon size=3>$LDUpdateOk</font>";
		
        echo '<table  border="1" cellpadding="1" cellspacing="0">';
        echo "<tr nowrap >";
		echo "<td colspan=";
		if($currentuser=="") echo $colstop; else echo $colstop+1;
		echo "><FONT    SIZE=-1  FACE=Arial>&nbsp;<b> $LDActualDir</b> ( $LDMaxItem: ".($linecount)." )</font> </td>";
       	echo "</tr>"; 
        echo "<tr nowrap bgcolor=#ffffee>";
		for($i=2;$i<$colstop;$i++) 
 		{	
 		    echo '<td nowrap><FONT  SIZE=1  FACE=Arial color="#0000cc"><b>'.$LDExtFields[$i].'</b></td>';
         }
		if ($edit) echo "<td>&nbsp;</td>";	
		echo "</tr>"; 

		$toggle=0; 
		$datacount=0;
		if ($linecount>1) mysql_data_seek($ergebnis,$datanum); 

		/* List the entries */
		
		while (($zeile=mysql_fetch_array($ergebnis))and($datacount<$displaysize))
			{  
					if($toggle) {echo "<tr nowrap bgcolor=#efefef>\n";$toggle=0;} else { echo "<tr  nowrap bgcolor=#ffffff>\n";$toggle=1;};

					$datacount++;
	
					for($i=2;$i<$colstop;$i++) 
					{
					echo "<td nowrap>";
					
					  if (($update)&&($zeile[item]==$itemname)) echo "<FONT SIZE=1 color=red  FACE=Arial>";
						  else echo "<FONT SIZE=1  FACE=Arial>";
					echo '<nobr>&nbsp;';
					
					if($edit)
					{
					   if($i == ($colstop-2)) echo formatDate2Local($zeile[$i],$date_format);
					     elseif($i==($colstop-1)) echo  convertTimeToLocal($zeile[$i]);
						   else echo $zeile[$i];
					}
					else 
					{
					     echo $zeile[$i];
					}
					
					echo "</td>\n";
					
					
					}
					if ($edit)
					{
						echo "<td nowrap><FONT FACE=Arial size=1><nobr>
							<a href=\"telesuch_eintrag_update.php?sid=$sid&lang=$lang&from=list&itemname=".$zeile['item_nr']."&batchnum=$batchnum&displaysize=$displaysize&linecount=$linecount&pagecount=$pagecount&edit=$edit\">
						$LDEdit</a> \n";
						echo "<a href=\"telesuch_eintrag_delete.php?sid=$sid&lang=$lang&from=list&itemname=".$zeile['item_nr']."&batchnum=$batchnum&displaysize=$displaysize&linecount=$linecount&pagecount=$pagecount&edit=$edit\">
						$LDDelete</a> </td>";
					}
					echo "</tr>\n";
   		    };
        echo "</table><br>\n";
		
		/* If entry more than one show the controls */
		
		if($pagecount>1)
		 {  	
			if ($batchnum=="") $batchnum=1;
			echo "<FONT SIZE=-1  FACE=Arial> $LDMoreInfo: &nbsp;&nbsp;\n"; 
			if ($batchnum>1)
			echo '<a href=telesuch_phonelist.php?sid='.$sid.'&lang='.$lang.'&pagecount='.$pagecount.'&linecount='.$linecount.'&batchnum='.($batchnum-1).'&displaysize='.$displaysize.'&edit='.$edit.'><font color=red ><<</font></a> ';
			for($i=1;$i<=$pagecount;$i++)
			{ 	
				if ($i==$batchnum) echo "<b>".$i."</b>"; else echo ' <a href=telesuch_phonelist.php?sid='.$sid.'&lang='.$lang.'&pagecount='.$pagecount.'&linecount='.$linecount.'&batchnum='.$i.'&displaysize='.$displaysize.'&edit='.$edit.'>'.$i.'</a> ';
			}
	
			if ($batchnum<$pagecount)	echo '<a href=telesuch_phonelist.php?sid='.$sid.'&lang='.$lang.'&pagecount='.$pagecount.'&linecount='.$linecount.'&batchnum='.($batchnum+1).'&displaysize='.$displaysize.'&edit='.$edit.'><font color=red >>></font></a>';
			echo "</FONT>\n";
		
		 }

		//echo "<p><FONT SIZE=-1  FACE=Arial>$LDMaxItem: ".($linecount)."</font>\n";
		echo "<p><FORM method=post action=telesuch_phonelist.php>
				<FONT SIZE=-1  FACE=Arial>
				<input type=hidden name=route value=validroute>
				<input type=hidden name=remark value=fromlist>
				<input type=hidden name=sid value=\"$sid\">
				<input type=hidden name=lang value=\"$lang\">
				<input type=hidden name=edit value=\"$edit\">
    				<input type=text name=displaysize value=".$displaysize." size=2> $LDRows
				<INPUT type=submit  value=\"$LDShow\".></font></FORM>";		
}// end of if(rows)
?>
<FONT    SIZE=-1  FACE=Arial>

<?php if ($edit) : ?>
<FORM method="post" action="telesuch_edit.php" >
<input type="hidden" name="remark" value="fromlist">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<INPUT type="submit"  value="<?php echo $LDNewPhoneEntry ?>"></font></FORM>
<p>
<?php else : ?>
<p>
<FORM method="post" action="telesuch.php" >
<input type="hidden" name="route" value="validroute">
<input type="hidden" name="remark" value="fromlist">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<INPUT type="submit"  value="<?php echo $LDCancel ?>"></font></FORM>
<p>
<?php endif; ?>

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
</BODY>
</HTML>
