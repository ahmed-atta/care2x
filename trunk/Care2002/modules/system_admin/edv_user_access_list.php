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
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';

require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');
/**
* The following require loads the access areas that can be assigned for
* user permissions.
*/
require($root_path.'include/inc_accessplan_areas_functions.php');

$breakfile='edv.php?sid='.$sid.'&lang='.$lang;
$returnfile=$HTTP_SESSION_VARS['sess_file_return'].URL_APPEND;
$HTTP_SESSION_VARS['sess_file_return']=basename(__FILE__);

/* Establish db connection */
if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');

if($dblink_ok)
{
    /* Load the date formatter */
    include_once($root_path.'include/inc_date_format_functions.php');
    
	$sql='SELECT * FROM care_users';
	 
	if($ergebnis=$db->Execute($sql)) {
	    
		$rows=$ergebnis->RecordCount();
	}
}
   else { echo "$LDDbNoLink<br>"; }
?>
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
<?php 
require($root_path.'include/inc_css_a_hilitebu.php');
?>
<script language="javascript">
<!-- 

function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="<?php echo $root_path; ?>help-router.php<?php echo URL_REDIRECT_APPEND ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>
</HEAD>
<BODY BGCOLOR="<?php echo $cfg['bot_bgcolor']; ?>" TEXT="#000000" LINK="#0000FF" VLINK="#800080" topmargin=0 leftmargin=0 marginheight=0 marginwidth=0>



<table width=100% border=0 cellpadding=5 cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG><?php echo "$LDEDP $LDListActual" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="'.$returnfile.'"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('edp.php','access','list')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>

<tr bgcolor="<?php echo $cfg['body_bgcolor']; ?>"><FONT    SIZE=-1  FACE="Arial">
<td colspan=2><p>


<?php
if ($remark=='itemdelete') echo '<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'><FONT SIZE=3  FACE="verdana,Arial" color="#990000"> '.$LDAccessDeleted.'<br>'.$LDFfActualAccess.' </font>';
?>
<p>

<FONT    SIZE=1  FACE="Arial">

<?php

        echo '
				<table border=0 bgcolor=#999999 cellpadding=0 cellspacing=0>
				<tr><td>
				<table border="0" cellpadding="5" cellspacing="1">';
        echo "
					<tr bgcolor=#dddddd >";
		echo "
					<td colspan=8><FONT SIZE=1  FACE=verdana,Arial color=\"#800000\"><b>$LDActualAccess</b></td>";
        echo "
					</tr>"; 
        echo "	
					<tr bgcolor=#dfdfdf>";
		for($i=0;$i<sizeof($LDAccessIndex);$i++)
			echo "
			<td><FONT    SIZE=1  FACE=verdana,Arial><b>".$LDAccessIndex[$i]."</b></td>";
            echo "</tr>"; 

		/* Load common icons */	
		$img_padlock=createComIcon($root_path,'padlock.gif','0');
		$img_arrow=createComIcon($root_path,'arrow-gr.gif','0');
			
		while ($zeile=$ergebnis->FetchRow())
		{  
			if($zeile['exc']) continue;
			 echo "
						<tr  bgcolor=#efefef>\n";
			echo "
						<td><FONT    SIZE=1  FACE=Arial>".$zeile['name']."</td>\n
						<td><FONT    SIZE=1  FACE=Arial>".$zeile['login_id']."</td>\n
						<td><FONT    SIZE=1  FACE=Arial>*****</td><td>\n";
			if ($zeile['lockflag'])
				   echo '
				   		<img '.$img_padlock.'>'; else echo '<img '.$img_arrow.'>';
			echo "
						</td>\n <td><FONT    SIZE=1  FACE=Arial>";
			
			/* Display the permitted areas */
			$area=explode(' ',$zeile['permission']);
			for($n=0;$n<sizeof($area);$n++) echo $area_opt[$area[$n]].'<br>';
														
			echo '</td>
					<td><FONT    SIZE=1  FACE=Arial> '.formatDate2Local($zeile['s_date'],$date_format).' / '.convertTimeToLocal($zeile['s_time']).' </td>';
	
			echo '
					<td><FONT    SIZE=1  FACE=Arial>'.$zeile['create_id'].'</td>';
					
            echo "
					<td><FONT    SIZE=1  FACE=verdana,Arial>
					<a href=edv_user_access_edit.php?sid=$sid&lang=$lang&mode=edit&userid=".str_replace(' ','+',$zeile['login_id'])." title=\"$LDChange\"> $LDInitChange</a> \n
			<a href=edv_user_access_lock.php?sid=$sid&lang=$lang&itemname=".str_replace(' ','+',$zeile['login_id'])." ";
			if ($zeile['lockflag']) echo "title=\"$LDUnlock\" > $LDInitUnlock"; else echo "title=\"$LDLock\"> $LDInitLock";
			echo "</a> \n
			<a href=edv_user_access_delete.php?sid=$sid&lang=$lang&itemname=".str_replace(' ','+',$zeile['login_id'])." title=\"$LDDelete\">	$LDInitDelete</a> </td>";
			echo "</tr>";
        };
        echo "
					</table>
				</td></tr>
				</table>";

 

?>

</td>

</tr>
</table>

<p>
<FORM method="post" action="<?php if($ck_edvzugang_src=="listpass") echo "edv-accessplan-list-pass.php"; else echo "edv_user_access_edit.php"; ?>" >
<input type=hidden name="sid" value="<?php echo $sid; ?>">
<input type=hidden name="lang" value="<?php echo $lang; ?>">
<input type=hidden name="remark" value="fromlist">
<INPUT type="submit"  value=" <?php echo $LDOK ?> "></font></FORM>

</FONT>
<p>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>
    
</BODY>
</HTML>
