<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_prod_db_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_products.php");
require("../req/config-color.php");

$thisfile="products-datenbank-functions-datadelete.php";
switch($cat)
{
	case "pharma":
							$title=$LDPharmacy;
							$dbtable="pharma_products_main";
							$imgpath="../pharma/img/";
							$breakfile="apotheke-datenbank-functions.php?sid=$ck_sid&lang=$lang";
							break;
	case "medlager":
							$title=$LDMedDepot;
							$dbtable="med_products_main";
							$imgpath="../med_depot/img/";
							$breakfile="medlager-datenbank-functions.php?sid=$ck_sid&lang=$lang";
							break;
	default:  {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
}

if(($mode=="delete")&&($sure)&&($keyword!="")&&($keytype!="")) 
{

$deleteok=false;


//init db parameters
require("../req/db-makelink.php");
 	if($link&&$DBLink_OK) 
		{

    				$sql='DELETE LOW_PRIORITY FROM '.$dbtable.' WHERE  '.$keytype.'="'.$keyword.'"';
        		if($ergebnis=mysql_query($sql,$link))
				{
					header ("location:products-datenbank-functions-manage.php?sid=$ck_sid&lang=$lang&from=deleteok&cat=$cat");
					$deleteok=true;
				}
			print $sql;
		}
  		 else { print "$LDDbNoLink<br>"; } 
}

	//simulate update to search the keyword
	$update=true;
 	require("../req/products-search-mod.php");

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE> <?=$title ?> - Verwalten </TITLE>

 <script language="javascript" >
<!-- 
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

// -->
</script> 

<? 
require("../req/css-a-hilitebu.php");
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<a name="pagetop"></a>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="45">
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?="$LDPharmacy $LDPharmaDb $LDManage" ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('products_db.php','delete','<?=$from ?>','<?=$cat ?>')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDClose ?>"  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>
<FONT face="Verdana,Helvetica,Arial" size=2>
<p><br>



<?

if(!$sure)
{
	 print '
	 	<table border=0>
     <tr>
       <td><img src="../img/catr.gif" width=88 height=80 border=0 align=middle></td>
       <td><FONT face="Verdana,Helvetica,Arial" size=3  color="#800000">
		'.$LDConfirmDelete.'</font><BR>
		<font size=2>'.$LDAlertDelete.'</font></td>
     </tr>
   </table>	';
}
else
{
	if(!$deleteok) print'
			<img src="../img/catr.gif" width=88 height=80 border=0 align=middle><FONT face="Verdana,Helvetica,Arial" size=3  color="#800000">
		'.$LDNoDelete.'</font>';
}
	//simulate saved condition to force the static display of data
	$saveok=true;

require("../req/products-search-result-mod.php");


?>
<p>
<a href="<?=$breakfile ?>"><img src="../img/<?="$lang/$lang" ?>_cancel.gif" border=0 width=103 height=24 align=right></a>


<?
if(!$sure)

print'
	<form action="'.$thisfile.'" method="get" name=delform>
 <input type="hidden" name="sure" value="1">
 <input type="hidden" name="sid" value="'.$ck_sid.'">
 <input type="hidden" name="lang" value="'.$lang.'">
 <input type="hidden" name="mode" value="delete">
 <input type="hidden" name="cat" value="'.$cat.'">
 <input type="hidden" name="keyword" value="'.$keyword.'">
 <input type="hidden" name="keytype" value="'.$keytype.'">
  <input type="submit" value="'.$LDYesDelete.'">
 </form>
<a href="javascript:history.back()"><< '.$LDNoBack.'</a>
';
?>
</ul>

</FONT>
<p>
</td>
</tr>
<tr>
<td bgcolor=<? print $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
require("../language/$lang/".$lang."_copyrite.htm");

 ?>
</td>
</tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
