<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('personell.php');
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');

require_once($root_path.'include/inc_config_color.php');
$keyword=strtr($keyword,'%',' ');
$keyword=trim($keyword);

$toggle=0;
if($HTTP_COOKIE_VARS['ck_login_logged'.$sid]) $breakfile=$root_path.'main/spediens.php'.URL_APPEND;
	else $breakfile='personell_admin_pass.php'.URL_APPEND.'&target='.$target;
 /* Set color values for the search mask */
$searchmask_bgcolor='#f3f3f3';
$searchprompt=$LDEnterEmployeeSearchKey;
$entry_block_bgcolor='#fff3f3';
$entry_border_bgcolor='#6666ee';
$entry_body_bgcolor='#ffffff';

if(!isset($searchkey)) $searchkey='';
if(!isset($mode)) $mode='';


if(($mode=='search')and($searchkey))
{
    if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
    if($dblink_ok) {
				
			/* Load global config */
/*           $config_type='patient_%';
           include('../include/inc_get_global_config.php');
*/

/*		include_once($root_path.'include/care_api_classes/class_globalconfig.php');
        $glob_obj=new GlobalConfig($GLOBAL_CONFIG);
        $glob_obj->getConfig('personell_%');
*/
			$suchwort=trim($searchkey);
			if(is_numeric($suchwort))
			{
				$suchwort=(int) $suchwort;
				$numeric=1;
				//if($suchwort < $patient_inpatient_nr_adder) $suchbuffer=$suchwort+$patient_inpatient_nr_adder; else $suchbuffer=$suchwort;
				$suchbuffer=$suchwort;
			}
			
			$sql='SELECT ps.nr, ps.is_discharged, p.name_last, p.name_first, p.date_birth
			          FROM care_personell as ps,care_person as p 
			          WHERE
					  (
			               p.name_last LIKE "'.addslashes($suchwort).'%" 
			              OR p.name_first LIKE "'.addslashes($suchwort).'%"
			              OR p.date_birth LIKE "'.@formatDate2Std($suchwort,$date_format).'%"
			              OR ps.nr LIKE "'.addslashes($suchbuffer).'"
					  )
					  AND NOT ps.is_discharged
					  AND ps.pid=p.pid  
			          ORDER BY p.name_last ';
					  
			if($ergebnis=$db->Execute($sql))
       		{
				
				if ($linecount=$ergebnis->RecordCount())
				{ 
					if(($linecount==1)&&$numeric)
					{
						$zeile=$ergebnis->FetchRow();
						header("location:personell_register_show.php".URL_REDIRECT_APPEND."&from=such&target=personell_search&personell_nr=".$zeile['personell_nr']."&sem=".(!$zeile['is_discharged']));
						exit;
					}
				}
			}
			 else {echo "<p>".$sql."<p>$LDDbNoRead";};
	}
  	 else { echo "$LDDbNoLink<br>"; }
}
else $mode='';
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE></TITLE>

<?php 
require($root_path.'include/inc_js_gethelp.php'); 
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  onLoad="document.searchform.searchkey.select()" bgcolor=<?php echo $cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<table width=100% border=0 cellspacing="0" cellpadding=0>

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+1  FACE="Arial"><STRONG> &nbsp;<?php echo "$LDPersonnelManagement :: $LDPersonellData :: $LDSearch" ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
 echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>

<!-- Load tabs -->
<?php

$target='personell_search';
 include('./gui_bridge/default/gui_tabs_personell_reg.php') 

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
<a href="<?php  echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
<p>

<?php
if($mode=='search'){
	if(!$linecount) $linecount=0;
	echo '<hr width=80% align=left><p>'.str_replace("~nr~",$linecount,$LDSearchFound).'<p>';
		  
	if ($linecount) { 

	/* Load the common icons */
	$img_options=createComIcon($root_path,'statbel2.gif','0');

	echo '
			<table border=0 cellpadding=2 cellspacing=1> <tr bgcolor="#0000aa">';
			
?>

    <td background="<?php echo createBgSkin($root_path,'tableHeaderbg.gif'); ?>"><font face=arial size=2 color="#ffffff"><b><?php echo $LDPersonellNr; ?></b></td>
    <td background="<?php echo createBgSkin($root_path,'tableHeaderbg.gif'); ?>"><font face=arial size=2 color="#ffffff"><b><?php echo $LDLastName; ?></td>
    <td background="<?php echo createBgSkin($root_path,'tableHeaderbg.gif'); ?>"><font face=arial size=2 color="#ffffff"><b><?php echo $LDFirstName; ?></td>
    <td background="<?php echo createBgSkin($root_path,'tableHeaderbg.gif'); ?>"><font face=arial size=2 color="#ffffff"><b><?php echo $LDBday; ?></td>
    <td background="<?php echo createBgSkin($root_path,'tableHeaderbg.gif'); ?>"><font face=arial size=2 color="#ffffff"><b><?php echo $LDOptions; ?></td>

<?php
/*				for($i=0;$i<sizeof($fieldname);$i++) {
						echo'
						<td><font face=arial size=2 color="#ffffff"><b>'.$fieldname[$i].'</b></td>';
		
					}*/					
					echo"</tr>";

					while($zeile=$ergebnis->FetchRow())
					{
						
						echo "
							<tr bgcolor=";
						if($toggle) { echo "#efefef>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
						echo"<td><font face=arial size=2>";
                       // echo '&nbsp;'.($zeile['nr']+$GLOBAL_CONFIG['personell_nr_adder']);
                         echo '&nbsp;'.$zeile['nr'];
                       echo "</td>";	
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
							<a href="personell_register_show.php'.URL_APPEND.'&from=such&personell_nr='.$zeile['nr'].'&target=personell_search">
							<img '.$img_options.' alt="'.$LDShowData.'"></a>&nbsp;';
							
                       if(!file_exists($root_path.'cache/barcodes/en_'.$zeile['nr'].'.png'))
	      		       {
			               echo "<img src='".$root_path."classes/barcode/image.php?code=".$zeile['nr']."&style=68&type=I25&width=180&height=50&xres=2&font=5&label=2&form_file=en' border=0 width=0 height=0>";
		               }
						echo '</td></tr>';

					}
					echo "
						</table>";
					if($linecount>15)
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
<hr width=80% align=left><p>
<!-- <a href="aufnahme_start.php<?php echo URL_APPEND; ?>&mode=?"><?php echo $LDAdmWantEntry ?></a><br>
<a href="aufnahme_list.php<?php echo URL_APPEND; ?>"><?php echo $LDAdmWantArchive ?></a>
 --></ul>
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
