<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","editor.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");

require("../include/inc_db_makelink.php");
 if ($link&&$DBLink_OK)
 {
		// now fetch today's menu
		$dbtable="cafe_menu_".$lang;
		 	$sql="SELECT menu FROM $dbtable 
					WHERE cyear='".date("Y")."' 
						AND cmonth='".date("m")."' 
						AND cday='".date("d")."'";

			if($ergebnis=mysql_query($sql,$link))
       		{
					$menu=mysql_fetch_array($ergebnis);
			}
			if(!$menu[menu]) $menu[menu]=$LDNoMenu;
  } else { print "$LDDbNoLink<br> $sql<br>"; }


?><!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><TITLE></TITLE>

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
    <td><img src="../img/catr.gif" width=88 height=80 border=0></td>
    <td colspan=2>
	<FONT FACE="verdana,Arial"><FONT  SIZE=3 COLOR="#000066" FACE="verdana,Arial"><?php echo $LDArticleSaved ?></font>
<hr>
</td>
  </tr>
</table>
<?php endif ?>

<FONT  SIZE=8 COLOR="#cc6600" FACE="verdana,Arial">
<a href="javascript:editcafe()"><img src="../img/basket.gif" width=74 height=70 border=0></a> <b><?php echo $LDCafeNews ?></b></FONT>

<TABLE CELLSPACING=10 cellpadding=0 border="0" width="590">
<tr>
<td colspan=3>
<hr>
</td>
</tr>



<TR >
<TD WIDTH=80% VALIGN="top" >

<?php
$picpath="../news_service/".$lang."/fotos/".$picfile;
	if(file_exists($picpath)&&file_exists("../news_service/$lang/news/$file"))
		{
			$picsize=GetImageSize($picpath);
		 	print '
			<img src="'.$picpath.'" border=0 align="'.$palign.'" ';
			if(!$picsize||($picsize[0]>150)) print 'width="150">';
				else print $picsize[3].'>';
		}
	if(file_exists("../news_service/$lang/news/$file")) include("../news_service/$lang/news/$file"); 
	 
?>

<p>
<a href="<?php if($mode=="preview4saved") print "cafenews.php?sid=$sid&lang=$lang"; else print "javascript:window.history.back()"; ?>"><img src="../img/L-arrowGrnLrg.gif" width=16 height=16 border=0> <font face="arial" color="#006600"><?php echo $LDBackTxt ?></a>

</TD>
	
<td valign=top width="1" bgcolor="maroon"><img src="../img/pixel.gif" width="1" height="1">
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
<td bgcolor="#ffffcc" class="vn"><nobr><?php print nl2br($menu[menu]); ?></nobr>
</td> 
</tr>

</table>

</td>
</tr>
<tr >
<td><p><br>
<img src="../img/frage.gif" width=15 height=15 border=0>
<br>
<FONT  SIZE=-1 FACE="Arial" >
		&nbsp;<A HREF="cafenews-menu.php?<?php echo "sid=$sid&lang=$lang" ?>"><?php echo $LDMenuAll ?></A><br>
<img src="../img/frage.gif" width=15 height=15 border=0>
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
