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
define('LANG_FILE','editor.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');

$dbtable_menu='care_cafe_menu';

/* Check whether the content is language dependent */
if(defined('LANG_DEPENDENT') && (LANG_DEPENDENT==1))
{
    $newspath='../news_service/'.$lang.'/';
	/* Set the sql query for fetching the menu */
    $sql_menu="SELECT menu FROM $dbtable_menu WHERE cdate='".date("Y-m-d")."' AND lang='".$lang."'";
}
else 
{
    $newspath='../news_service/all_language/';
	/* Set the sql query for fetching the menu */
    $sql_menu="SELECT menu FROM $dbtable_menu WHERE cdate='".date("Y-m-d")."'";
}

/* Establish db connection */
require('../include/inc_db_makelink.php');
 if ($link&&$DBLink_OK)
 {
		// now fetch today's menu

			if($ergebnis=mysql_query($sql_menu,$link))
       		{
					$menu=mysql_fetch_array($ergebnis);
			}
			if(!$menu[menu]) $menu[menu]=$LDNoMenu;
  } else { echo "$LDDbNoLink<br> $sql<br>"; }


?><!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?><TITLE></TITLE>

<script language="javascript" >
function editcafe()
{
		if(confirm("<?php echo $LDConfirmEdit ?>"))
		{
			window.location.href="cafenews-edit-pass.php?sid=<?php echo "$sid&lang=$lang&title=$LDCafeNews" ?>";
			return false;
		}
}
		
</script>

<style type="text/css" name="s2">
.vn { font-family:verdana,arial; color:#000088; font-size:10}
</style>

</HEAD>
<BODY bgcolor=#ffffff VLINK="#003366" link="#003366">

<?php if($mode=="preview4saved") : ?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot('../','mascot1_r.gif','0') ?>></td>
    <td colspan=2>
	<FONT FACE="verdana,Arial"><FONT  SIZE=3 COLOR="#000066" FACE="verdana,Arial"><?php echo $LDArticleSaved ?></font>
<hr>
</td>
  </tr>
</table>
<?php endif ?>

<FONT  SIZE=8 COLOR="#cc6600" FACE="verdana,Arial">
<a href="javascript:editcafe()"><img <?php echo createComIcon('../','basket.gif','0') ?>></a> <b><?php echo $LDCafeNews ?></b></FONT>

<TABLE CELLSPACING=10 cellpadding=0 border="0" width="590">
<tr>
<td colspan=3>
<hr>
</td>
</tr>



<TR >
<TD WIDTH=80% VALIGN="top" >

<?php

	$picpath=$newspath.'/fotos/'.$picfile;

	if(file_exists($picpath)&&file_exists($newspath.'/news/'.$file))
		{
			$picsize=GetImageSize($picpath);
		 	echo '
			<img src="'.$picpath.'" border=0 align="'.$palign.'" ';
			if(!$picsize||($picsize[0]>150)) echo 'width="150">';
				else echo $picsize[3].'>';
		}
	if(file_exists($newspath.'/news/'.$file)) include($newspath.'/news/'.$file); 
	 
?>

<p>
<a href="<?php if($mode=="preview4saved") echo "cafenews.php?sid=".$sid."&lang=".$lang; else echo "javascript:window.history.back()"; ?>"><img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> <font face="arial" color="#006600"><?php echo $LDBackTxt ?></a>

</TD>
	
<td valign=top width="1" bgcolor="maroon"><img src="../gui/img/common/default/pixel.gif" width="1" height="1">
</td>


<TD WIDTH=20% VALIGN="top"  rowspan=2>

	<table cellspacing=0 cellpadding=1 border=0 align=right>
<tr bgcolor="#999999" >
<td>
<table  cellspacing=0 cellpadding=2 align=right>
<tr><td bgcolor=maroon align=center colspan=2>	<FONT  SIZE=2 FACE="verdana,Arial" color=white>
<b><?php echo $LDMenuToday ?></b>
</td>
</tr>
<tr>
<td bgcolor="#ffffcc" class="vn"><nobr><?php echo nl2br($menu[menu]); ?></nobr>
</td> 
</tr>

</table>

</td>
</tr>
<tr >
<td><p><br>
<img <?php echo createComIcon('../','frage.gif','0') ?> border=0>
<br>
<FONT  SIZE=-1 FACE="Arial" >
		&nbsp;<A HREF="cafenews-menu.php?<?php echo "sid=$sid&lang=$lang" ?>"><?php echo $LDMenuAll ?></A><br>
<img <?php echo createComIcon('../','frage.gif','0') ?> border=0>
<br>
	&nbsp;<A HREF="cafenews-prices.php?<?php echo "sid=$sid&lang=$lang" ?>"><?php echo $LDPrices ?></A>
</td>
</tr></table>

    </TD>
</TR>

<tr>
<td colspan=3>
<hr>
<?php
require("../language/".$lang."/".$lang."_copyrite.php");
 ?>
</td>
</tr>

</TABLE>



</BODY>
</HTML>
