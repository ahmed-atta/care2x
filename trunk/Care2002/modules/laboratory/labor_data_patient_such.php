<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','lab.php');
$local_user='ck_lab_user';
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/inc_config_color.php');

$dbtable='care_admission_patient';
$thisfile='labor_data_patient_such.php';
$breakfile='labor.php?sid='.$sid.'&lang='.$lang;

$toggle=0;

$fielddata='patnum, name, vorname, gebdatum, item';

$keyword=trim($keyword);

if(($search)and($keyword)and($keyword!=" "))
  {
		include('../include/inc_db_makelink.php');
		if($link&&$DBLink_OK) 
		{
		
             /* Load the date formatter */
            include_once($root_path.'include/inc_date_format_functions.php');
            
	
            /* Load editor functions for time format converter */
            //include_once('../include/inc_editor_fx.php');
		
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
			
        	$ergebnis=$db->Execute($sql);
			$linecount=0;
			
			if($ergebnis)
       		{
				while ($zeile=$ergebnis->FetchRow()) $linecount++;
				if ($linecount>0) 
				{ 
					mysql_data_seek($ergebnis,0);
				}
			}
			 else { echo "$LDDbNoRead<br>"; } 
		}
  		 else { echo "$LDDbNoLink<br>"; } 
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
	<script language="javascript" >
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
	</script>

</HEAD>

<BODY onLoad="document.sform.keyword.select()">

<img <?php echo createComIcon($root_path,'micros.gif','0','absmiddle') ?>><FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b><?php echo "$LDMedLab - "; if($mode=="edit") echo "$LDNewData"; else echo "$LDSeeData"; ?></b></font>
<table width=100% border=0 cellpadding="0" cellspacing="0">
<tr>
<td colspan=3><img <?php echo createLDImgSrc($root_path,'such-b.gif') ?>></td>
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

<!-- This is the search entry mask -->

<FORM action="<?php echo $thisfile; ?>" method="post" name="sform">
<font face="Arial,Verdana"  color="#000000" size=-1>
<B><?php echo $LDSearchWordPrompt ?></B></font><p>
<font size=3><INPUT type="text" name="keyword" size="20" maxlength="40" value="<?php echo $keyword ?>"></font> 
<input type=hidden name="search" value=1>
<input type=hidden name="sid" value=<?php echo $sid ?>>
<input type=hidden name="lang" value=<?php echo $lang ?>>
<input type=hidden name="mode" value=<?php echo $mode ?>>
<INPUT type="image" <?php echo createLDImgSrc($root_path,'searchlamp.gif','0','absmiddle') ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:gethelp('lab.php','search','<?php echo $mode ?>','<?php echo $linecount ?>','<?php echo $datafound ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>></a>
</FORM>
<p>
<?php 

if($linecount)
{
            /* Print the search result message */
			echo str_replace('~nr~',$linecount,$LDFoundPatient).'<p>';
			
			 /* Create the column descriptors */
			echo "<table border=0 cellpadding=3 cellspacing=1> <tr bgcolor=#9f9f9f>";
					for($i=0;$i<sizeof($LDfieldname);$i++) 
					{
						echo"<td><font face=arial size=2 color=#ffffff><b>".$LDfieldname[$i]."</b></td>";
		
					}
					 echo"<td>&nbsp;</td></tr>";
                    
					/* List all the stored lab result documents of the patient */
					while($zeile=$ergebnis->FetchRow())
					{
						echo '<tr bgcolor=';
						if($toggle) { echo "#dfdfdf>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
	                    
						/* Create the pat. nr., name, firstname columns */
						for($i=0;$i<mysql_num_fields($ergebnis)-2;$i++) 
						{
							echo"
							<td><font face=arial size=2>";
							if($zeile[$i]=='')echo '&nbsp;'; else echo $zeile[$i];
							echo '</td>';
						}
						
						/* Create the date column extra */
							echo'
							<td><font face=arial size=2>';
							if($zeile[$i]=='')echo '&nbsp;'; else echo formatDate2Local($zeile[$i],$date_format);
							echo '</td>';
						
						/**
						*  if mode is edit, create the button linked to labor_data_check_arch.php 
						*  if mode is not edit, create button linked to labor_datalist_noedit.php (read only list)
						*/
						echo'
						<td><font face=arial size=2>&nbsp';
						
					    if($mode=='edit')
						{ 
						echo'<a href="labor_data_check_arch.php?sid='.$sid.'&lang='.$lang.'&mode='.$mode.'&patnum='.$zeile[patnum].'&update=1"  title="'.$LDEnterData.'">
						<button onClick="javascript:window.location.href=\'labor_data_check_arch.php?sid='.$sid.'&lang='.$lang.'&mode='.$mode.'&patnum='.$zeile[patnum].'&update=1\'">
						<img 	'.createComIcon($root_path,'update2.gif','0','absmiddle').' alt="'.$LDEnterData.'">';
						}
						else
						{
						   echo'
							<a href="labor_datalist_noedit.php?sid='.$sid.'&lang='.$lang.'&patnum='.$zeile[patnum].'&noexpand=1&nostat=1"  title="'.$LDClk2See.'">
							<button onClick="javascript:window.location.href=\'labor_datalist_noedit.php?sid='.$sid.'&lang='.$lang.'&patnum='.$zeile[patnum].'&noexpand=1&nostat=1\'">
							<img '.createComIcon($root_path,'update2.gif','0','absmiddle').' alt="'.$LDClk2See.'">';
						}
						
						echo ' 
						<font size=1>'.$LDLabReport.'</font></button></a>&nbsp;
						</td></tr>';

					}
					echo '</table>';
					
					/* If result is more than 15 items, create an additional search entry mask below the list*/
					if($linecount>15)
					{
						echo '
						<p><font color=red><B>'.$LDNewSearch.':</font>
						<FORM action="'.$thisfile.'" method="post">
						<font face="Arial,Verdana"  color="#000000" size=-1>
						'.$LDSearchWordPrompt.'</B><p>
						<INPUT type="text" name="keyword" size="20" maxlength="40" value="'.$keyword.'"> 
						<input type=hidden name="search" value=1>
						<input type=hidden name="sid" value="'.$sid.'">
						<input type=hidden name="lang" value="'.$lang.'">
						<input type=hidden name="mode" value="'.$mode.'">
						<INPUT type="image"  '.createLDImgSrc($root_path,'searchlamp.gif','0','absmiddle').'></font></FORM>
						<p>';
					}
}

?>
<p>
<br>&nbsp;
<p>
<a href="<?php echo "$breakfile" ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>

<p>
<!--<hr width=80% align=left>
<p>
 <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><img src="../img/small_help.gif" border=0> <?php echo $LDWildCards ?></a>
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
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
