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
define('LANG_FILE','products.php');
$local_user='ck_prod_db_user';
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php');
//require_once('../include/inc_editor_fx.php');

/* Load the date formatter */
require_once('../include/inc_date_format_functions.php');


$thisfile='medlager-report.php';

if($mode=='sent') $breakfile=$thisfile; else $breakfile='medlager-datenbank-functions.php';



if(($report!=NULL)||($mode!=''))
{
	$dbtable='care_med_report';

	include('../include/inc_db_makelink.php');
	if($link&&$DBLink_OK) 
		{
			switch($mode)
			{
				case 'save':
						$sql="INSERT INTO ".$dbtable." 
						(	
							report,
							reporter,
							id_nr,
							report_date,
							report_time,
							status,
							history,
							modify_id,
							create_id,
							create_time
							 ) 
						VALUES 
						(
							'".htmlspecialchars($report)."',
							'$reporter',
							'$id_nr', 
							'$report_date', 
							'$report_time', 
							'pending',
							'Created: ".$HTTP_COOKIE_VARS[$local_user.$sid]." ".date('Y-m-d H:i:s')."\n\r',
							'".$HTTP_COOKIE_VARS[$local_user.$sid]."',
							'".$HTTP_COOKIE_VARS[$local_user.$sid]."',
							NULL
						)";
						
						if(mysql_query($sql,$link))
						{ 
						    $report_nr=mysql_insert_id($link);
							header("Location: $thisfile?sid=$sid&lang=$lang&userck=$userck&dept=$dept&report_nr=$report_nr&mode=sent"); exit;
							mysql_close($link);
							exit;
						}
			 			else {echo "<p>".$sql."<p>$LDDbNoSave.";};
   						break;
						
				case 'sent':
								$sql='SELECT report_nr, report, reporter, report_date, report_time FROM '.$dbtable.' 
										WHERE report_nr="'.$report_nr.'"';
										
        						if($ergebnis=mysql_query($sql,$link))
								{
									$rows=mysql_num_rows($ergebnis);
								}
								else echo "$sql<br>$LDDbNoRead<br>";
								
						break;
			} // end of switch

	}
  	 else 
		{ echo "$LDDbNoLink<br>"; }
}

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

 <script language="javascript" >
<!-- 

function checkform(d)
{

	if(d.report.value=="") 
		{	alert("<?php echo $LDAlertReport ?>");
		    d.report.focus();
			return false;
		}
	if(d.reporter.value=="") 
		{	alert("<?php echo $LDAlertName ?>");
		    d.reporter.focus();
			return false;
		}
	if(d.id_nr.value=="") 
		{	alert("<?php echo $LDAlertPersonNr ?>");
		    d.id_nr.focus();
			return false;
		}
	return true;
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

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp;<?php echo "$LDMedDepot - $LDReport" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<a href="#" onClick=history.back(1)><img <?php echo createLDImgSrc('../','back2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a 
href="javascript:gethelp('products_db.php','report','<?php echo $mode ?>','<?php echo $cat ?>','<?php echo $update ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a 
href="<?php echo $breakfile ?>?sid=<?php echo "$sid&lang=$lang" ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>


<?php if ($mode=="sent") : ?>
<FONT    SIZE=4  FACE="Arial" color=#00cc00>
<img <?php echo createComIcon('../','varrow.gif','0') ?>>
<b><?php echo $LDReportSent ?></b></FONT> <font size="2" face="arial">
</font><p>
<?php
$tog=1;
$content=mysql_fetch_array($ergebnis);
echo '</font>
		<table cellpadding=0 cellspacing=0 border=0 bgcolor="#666666"><tr><td><table border=0 cellspacing=1 cellpadding=3>
	<tr bgcolor=#ffffff>
				 <td colspan=5><p><br><font face=Verdana,Arial size=2><ul><i>" '.nl2br($content['report']).' "</i></ul></td>
				</tr>
				<tr bgcolor=#cccccc>
				 <td colspan=5><p>
				 <font face=Verdana,Arial size=2>'.$LDReporter.': '.nl2br($content['reporter']).'<br>
				 '.$LDDate.': '.formatDate2Local($content['report_date'],$date_format).'<br>
				 '.$LDTime.': '.convertTimeToLocal($content['report_time']).'<p></td>
				</tr></table></td></tr>
				</table>';
?>
<?php else : ?>
<FONT    SIZE=4  FACE="Arial" color="#00cc00">
<img <?php echo createComIcon('../','varrow.gif','0') ?>>
<b><?php echo $LDWriteReport ?></b></FONT> <font size="2" face="arial">
</font><p>
<form ENCTYPE="multipart/form-data" action="<?php echo $thisfile ?>" method="post" onSubmit="return checkform(this)"> 
<table cellpadding=5 border=0 cellspacing=1>
<tr>
<td  bgcolor="#dddddd" ><FONT    SIZE=-1  FACE="Arial">
<p><?php echo $LDReport ?>:<br>
<TEXTAREA NAME="report" Content-Type="text/html"
	COLS=60 ROWS=10></TEXTAREA>
</td>
</tr>
<tr>
<td bgcolor="#dddddd"><FONT    SIZE=-1  FACE="Arial">

<?php echo $LDReporter ?>:<br><input type="text" name="reporter" size=30 value="<?php echo $HTTP_COOKIE_VARS[$local_user.$sid]; ?>"> <p>
<?php echo $LDPersonellNr ?>:<br><input type="text" name="id_nr" size=30>
<input type="hidden" name="report_date" value="<?php echo date('Y-m-d') ?>" >
<input type="hidden" name="report_time" value= "<?php echo date('H:i:s') ?>">
<input type="hidden" name="sid" value= "<?php echo $sid ?>">
<input type="hidden" name="lang" value= "<?php echo $lang ?>">
<input type="hidden" name="userck" value= "<?php echo $userck ?>">
<input type="hidden" name="mode" value= "save">

</td>
</tr>
</table>
<p>
<!-- <input type="submit" name="versand" value="<?php echo $LDSend ?>"  >  
 -->
 <input type="image" <?php echo createLDImgSrc('../','abschic.gif','0','absmiddle') ?>>  
<input type="reset" value="<?php echo $LDResetAll ?>" >&nbsp;&nbsp;&nbsp;
</form>

</FONT>
<p>
<?php endif ?>

<p>
<p>
<?php 
if($mode=='sent')
{
   echo '
   <a href="'.$thisfile.'?sid='.$sid.'&lang='.$lang.'"><img '.createLDImgSrc('../','new_report.gif','0','absmiddle').'></a>&nbsp;&nbsp;&nbsp;';
}
else
{
?>
<a href="<?php echo $breakfile ?>?sid=<?php echo "$sid&lang=$lang&userck=$userck" ?>" ><img <?php echo createLDImgSrc('../','close2.gif','0') ?>  height=24  align="middle"></a>
<?php
}
?>
<p>
</ul>

</FONT>
<p>
</td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</td>
</tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
