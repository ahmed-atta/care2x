<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.06 - 2003-08-06
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='actions.php';
$lang_tables[]='prompt.php';
define('LANG_FILE','radio.php');
# Resolve the local user based on the origin of the script
require_once('include/inc_local_user.php');
//define('NO_2LEVEL_CHK',1);
$local_user='ck_radio_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');

# Set break file
require('include/inc_breakfile.php');

if(!isset($searchkey)) $searchkey='';
if(!isset($mode)) $mode='';

$searchkey=trim($searchkey);
$searchkey=strtr($searchkey,'*?','%_');

$toggle=0;

 /* Set color values for the search mask */
$searchmask_bgcolor='#f3f3f3';
$searchprompt=$LDPlsFindPersonFirst;
$entry_block_bgcolor='#fff3f3';
$entry_border_bgcolor='#6666ee';
$entry_body_bgcolor='#ffffff';


if(($mode=='search')&&($searchkey))
{
    include_once($root_path.'include/care_api_classes/class_person.php');
	$obj=new Person;
	$pers_obj=&$obj->Persons($searchkey);
	$pers_count=$obj->LastRecordCount();
}
else $mode='';
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE></TITLE>
 
  <?php 
require($root_path.'include/inc_css_a_hilitebu.php');
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

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  onLoad="document.searchform.searchkey.select()" bgcolor=<?php echo $cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<table width=100% border=0 cellspacing="0" cellpadding=0>

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo "$LDUploadDicom :: $LDSearch " ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('admission_how2search.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>

<!-- Load tabs -->
<?php

$target='search';
 include('./gui_bridge/default/gui_tabs_medocs.php') 

?>

</table>
<ul>

<FONT    SIZE=-1  FACE="Arial">


		 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php

            include($root_path.'include/inc_patient_searchmask.php');
       
	   ?>
</td>
     </tr>
   </table>


<p>
<a href="<?php echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
<p>

<?php
if($mode=='search'){
	if(!$pers_count) $pers_count=0;
	echo str_replace("~nr~",$pers_count,$LDSearchFound).'<p>';
		  
	if ($pers_count) { 

	/* Load the common icons */
	$img_options=createLDImgSrc($root_path,'ok_small.gif','0');
	$img_male=createComIcon($root_path,'spm.gif','0');
	$img_female=createComIcon($root_path,'spf.gif','0');

	echo '
			<table border=0 cellpadding=2 cellspacing=1> <tr bgcolor="#0000aa" background="'.createBgSkin($root_path,'tableHeaderbg.gif').'">';
			
?>

    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDPID; ?></b></td>
    <td><font face=arial size=2 color="#ffffff"><b>&nbsp;</td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDLastName; ?></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDFirstName; ?></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDBday; ?></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDOptions; ?></td>

<?php
/*				for($i=0;$i<sizeof($fieldname);$i++) {
						echo'
						<td><font face=arial size=2 color="#ffffff"><b>'.$fieldname[$i].'</b></td>';
		
					}*/					
					echo"</tr>";

					while($zeile=$pers_obj->FetchRow())
					{
						echo '
							<tr bgcolor=';
						if($toggle) { echo "#efefef>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
						echo '<td><font face=arial size=2>&nbsp;'.$zeile['pid'];
                        echo '</td>
						';	
						echo '<td>';
						switch($zeile['sex']){
							case 'f': echo '<img '.$img_female.'>'; break;
							case 'm': echo '<img '.$img_male.'>'; break;
							default: echo '&nbsp;'; break;
						}
						
                        echo '</td>
						';	
						
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".ucfirst($zeile['name_last']);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".ucfirst($zeile['name_first']);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".formatDate2Local($zeile['date_birth'],$date_format);
                        echo "</td>";	

					    if($HTTP_COOKIE_VARS[$local_user.$sid]) echo '
						<td><font face=arial size=2>&nbsp;
							<a href="upload.php'.URL_APPEND.'&pid='.$zeile['pid'].'&mode=new">
							<img '.$img_options.' alt="'.$LDSelect.'"></a>&nbsp;';
							
						echo '</td></tr>';

					}
					echo "
						</table>";
					if($pers_count>15)
					{
					    /* Set the appending nr for the searchform */
					    $searchform_count=2;
					?>
			<p>
		 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php
            include($root_path.'include/inc_patient_searchmask.php');
	   ?>
</td>
     </tr>
   </table>
					<?php
					}
	}
}
?>
<p>
</ul>
&nbsp;
</FONT>
<p>

</ul>
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>

</FONT>


</BODY>
</HTML>
