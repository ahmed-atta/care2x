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
$lang_tables=array('personell.php');
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/inc_config_color.php');
$keyword=strtr($keyword,"%"," ");
$keyword=trim($keyword);

$dbtable='care_person';
$toggle=0;
$searchmask_bgcolor="#f3f3f3";
$searchprompt=$LDEnterEmployeeSearchKey;

if(empty($target)) $target='search';

/* Set color values for the search mask */
$entry_block_bgcolor='#fff3f3';
$entry_border_bgcolor='#66ee66';
$entry_body_bgcolor='#ffffff';

if($HTTP_COOKIE_VARS['ck_login_logged'.$sid]) $breakfile=$root_path.'main/spediens.php'.URL_APPEND;
	else $breakfile='personell_admin_pass.php'.URL_APPEND.'&target='.$target;

$GLOBAL_CONFIG=array();

if(isset($mode)&&($mode=='search')&&isset($searchkey)&&($searchkey))
{
    if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
    if($dblink_ok) {
	
        include_once($root_path.'include/inc_date_format_functions.php');
            
        //* Get the patient registration global config */
/*        $config_type='person_id_%';
        include('../include/inc_get_global_config.php'); 
*/		
		include_once($root_path.'include/care_api_classes/class_globalconfig.php');
		$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
		$glob_obj->getConfig('person_id_%');
	   		
		$suchwort=trim($searchkey);
		if(is_numeric($suchwort)) {
            $suchwort=(int) $suchwort;
			$numeric=1;
			if($suchwort>$person_id_nr_adder) {
				   $suchbuffer=(int) ($suchwort - $GLOBAL_CONFIG['person_id_nr_adder']) ; 
			}
				  
			$order_item='pid';			
	    } else {
            $order_item='name_last';
			$suchbuffer=$suchwort;
		}
			 
			$sql='SELECT pid, name_last, name_first, date_birth FROM '.$dbtable.' WHERE pid="'.$suchwort.'"
						                          OR  name_last LIKE "'.$suchwort.'%" 
			                                      OR name_first LIKE "'.$suchwort.'%"
			                                      OR date_birth LIKE "'.formatDate2STD($suchwort,$date_format).'"
			                                      OR date_birth LIKE "%'.$suchwort.'%"
			                                      OR pid LIKE "'.$suchbuffer.'" 
			                                    ORDER BY '.$order_item;

			if($ergebnis=$db->Execute($sql))
       		{
				if ($linecount=$ergebnis->RecordCount()) 
				{ 
					if(($linecount==1)&&$numeric)
					{
						$zeile=$ergebnis->FetchRow();
						header("location:person_register_show.php?sid=".$sid."&lang=".$lang."&pid=".$zeile['pid']."&edit=1&status=".$status."&user_origin=".$user_origin."&noresize=1&mode=");
						exit;
					}
				}
				else $mode="";
			}
			 else {echo "<p>".$sql."<p>$LDDbNoRead";};
	}
  	 else { echo "$LDDbNoLink<br>"; }
} else { 
    $mode='';
}

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

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  onLoad="document.searchform.searchkey.select()"  bgcolor=<?php echo $cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>  >

<table width=100% border=0 cellspacing="0" cellpadding=0>

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo $LDPatientRegister." - ".$LDSearch ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml']) echo 'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
 echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>

<?php
/* Create the tabs */
$tab_bot_line='#66ee66'; // Set the horizontal bottom line color
require('./gui_bridge/default/gui_tabs_personell_reg.php');
?>

</table>

<ul>

<?php 
/* If the origin is admission link, show the search prompt */
if(isset($origin) && $origin=='pass')
{
?>
<table border=0>
  <tr>
    <td valign="bottom"><img <?php echo createComIcon($root_path,'angle_down_l.gif','0') ?>></td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b><?php echo $LDPlsSelectPatientFirst ?></b></font></td>
    <td><img <?php echo createMascot($root_path,'mascot1_l.gif','0','absmiddle') ?>></td>
  </tr>
</table>


<?php 
}
?>

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
<a href="<?php	echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
<p>

<?php
//echo $mode;
if ($linecount) 
	{ 
         echo '<hr width=80% align=left><p>'.str_replace("~nr~",$linecount,$LDSearchFound).'<p>';
					//mysql_data_seek($ergebnis,0);

					echo '
						<table border=0 cellpadding=2 cellspacing=1> <tr bgcolor="#66ee66" background="'.$root_path.'gui/img/common/default/tableHeaderbg.gif">';
?>
      <td><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>&nbsp;&nbsp;<?php echo $LDPersonalID; ?></b></td>
      <td><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>&nbsp;&nbsp;<?php echo $LDLastName; ?></b></td>
      <td><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>&nbsp;&nbsp;<?php echo $LDFirstName; ?></b></td>
      <td><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>&nbsp;&nbsp;<?php echo $LDBday; ?></b></td>
      <td><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>&nbsp;&nbsp;<?php echo $LDOptions; ?></b></td>

<?php						
/*					for($i=0;$i<sizeof($fieldname);$i++) 
					{
						echo'
						<td><font face=arial size=2 color="#336633"><b>'.$fieldname[$i].'</b></td>';
		
					}*/
					echo"</tr>";

					while($zeile=$ergebnis->FetchRow())
					{
						echo "
							<tr bgcolor=";
						if($toggle) { echo "#efefef>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
						echo'<td align="right"><font face=arial size=2>';
						echo "&nbsp;".$zeile['pid'];
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
						<td><font face=arial size=2>&nbsp;';
						echo "
							<a href=\"person_register_show.php".URL_APPEND."&pid=".$zeile['pid']."&edit=1&status=".$status."&target=".$target."&user_origin=".$user_origin."&noresize=1&mode=\">";
						echo '	
							<img '.createLDImgSrc($root_path,'ok_small.gif','0').' alt="'.$LDTestThisPatient.'"></a>&nbsp;';
							
                       if(!file_exists("../cache/barcodes/pn_".($zeile['pid']+$GLOBAL_CONFIG['person_id_nr_adder']).".png"))
	      		       {
			               echo "<img src='".$root_path."classes/barcode/image.php?code=".($zeile['pid']+$GLOBAL_CONFIG['person_id_nr_adder'])."&style=68&type=I25&width=145&height=50&xres=2&font=5&label=2' border=0 width=0 height=0>";
		               }
						echo '</td></tr>';

					}
					echo "
						</table>";
					if($linecount>15)
					{
?>
         <p>
		 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php
	   
	        $searchform_count=2;
            include($root_path.'include/inc_patient_searchmask.php');
       
	   ?>
</td>
     </tr>
   </table>
<?php
					}
				}
?>

<?php 
/* If the origin is admission link, show a button for creating an empty form  */
if(isset($origin) && $origin=='pass')
{
?>
<form action="patient_register.php" method=post>
<input type=submit value="<?php echo $LDNewForm ?>" onClick=hidecat()>
<input type=hidden name="sid" value=<?php echo $sid; ?>>
<input type=hidden name="lang" value="<?php echo $lang; ?>">
</form>

<?php 
}
?>

</ul>
&nbsp;
</FONT>

<p>


<?php
require($root_path.'include/inc_load_copyrite.php');
?>


</FONT>
</BODY>
</HTML>
