<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo $headframe_title ?></TITLE>

<script  language="javascript">
<!-- 
function setsex(d)
{
	s=d.selectedIndex;
	t=d.options[s].text;
	if(t.indexOf("Frau")!=-1) document.aufnahmeform.sex[1].checked=true;
	if(t.indexOf("Herr")!=-1) document.aufnahmeform.sex[0].checked=true;
	if(t.indexOf("-")!=-1){ document.aufnahmeform.sex[0].checked=false;document.aufnahmeform.sex[1].checked=false;}
}

function settitle(d)
{
	if(d.value=="m") document.aufnahmeform.anrede.selectedIndex=2;
	else document.aufnahmeform.anrede.selectedIndex=1;
}


function hidecat()
{
<?php if(defined('MASCOT_SHOW') && MASCOT_SHOW==1)
{
?>
	if(document.images) document.images.catcom.src="../../gui/img/common/default/pixel.gif";
<?php
}
?>
}

function loadcat()
{

  	cat=new Image();
  	cat.src="../imgcreator/catcom.php?person=<?php echo strtr($HTTP_COOKIE_VARS[$local_user.$sid]," ","+")."&lang=$lang";?>";
  	
}

function showcat()
{
<?php if(defined('MASCOT_SHOW') && MASCOT_SHOW==1)
{
?>
	document.images.catcom.src=cat.src;
<?php
}
?>
}


<?php require($root_path.'include/inc_checkdate_lang.php'); ?>

-->
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>

<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>

<?php 
require($root_path.'include/inc_js_gethelp.php'); 
require($root_path.'include/inc_css_a_hilitebu.php');
?>

</HEAD>


<BODY bgcolor="<?php echo $cfg['bot_bgcolor'];?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php
if(!$encounter_nr && !$pid)
{
?>
onLoad="if(document.searchform.searchkey.focus) document.searchform.searchkey.focus();" 
<?php
}

 if(defined('MASCOT_SHOW') && MASCOT_SHOW==1)
{
?>
if(onLoad="if (window.focus) window.focus();loadcat();" 
<?php
}
?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 cellspacing="0" cellpadding=0>

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo $headframe_title; ?></STRONG></FONT>
</td>

<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('medocs_start.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>

<!-- Load tabs -->
<?php

$target='entry';
include('./gui_bridge/default/gui_tabs_medocs.php') 

?>

<tr>
<td colspan=3  bgcolor=<?php echo $cfg['body_bgcolor']; ?>>

<?php  /* If defined, create the mascot */

if(defined('MASCOT_SHOW') && MASCOT_SHOW==1)
{
?>
<div class="cats">
<a href="javascript:hidecat()"><img
<?php if($from=="pass")
{ 
    echo 'src="../imgcreator/catcom.php?lang='.$lang.'&person='.strtr($HTTP_COOKIE_VARS[$local_user.$sid]," ","+").'" ';
 }
else 
{
	echo ' src="../../gui/img/common/default/pixel.gif" ';
}
?>
align=right id=catcom border=0></a>
</div>
<?php
}
?>

<ul>


<?php 
/* If the origin is admission link, show the search prompt */
if(!isset($pid) || !$pid)
{
/* Set color values for the search mask */

$searchmask_bgcolor="#f3f3f3";
$searchprompt=$LDEntryPrompt;
$entry_block_bgcolor='#fff3f3';
$entry_border_bgcolor='#6666ee';
$entry_body_bgcolor='#ffffff';

?>
<table border=0>
  <tr>
    <td valign="bottom"><img <?php echo createComIcon($root_path,'angle_down_l.gif','0') ?>></td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b><?php echo $LDPlsSelectPatientFirst ?></b></font></td>
    <td><img <?php echo createMascot($root_path,'mascot1_l.gif','0','absmiddle') ?>></td>
  </tr>
</table>

 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php
	        /* set the script for searching */
	       $search_script='medocs_data_search.php';
		   $user_origin='admit';
		   
            include($root_path.'include/inc_patient_searchmask.php');
       
	   ?>
</td>
     </tr>
   </table>

<?php 
}
?>
</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<p>
<ul>

<?php  /* If defined, create the mascot */

if(defined('MASCOT_SHOW') && MASCOT_SHOW==1)
{
?>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="#" onClick="showcat()"><?php echo $LDCatPls ?><br>
<?php
}
?>

<p>
<a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCancelClose ?>"></a>
</ul>
<p>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
