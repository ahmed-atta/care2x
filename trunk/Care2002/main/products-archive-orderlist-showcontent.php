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
define("LANG_FILE","products.php");
$local_user=$userck;
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php");

if(!isset($dept)||!$dept)
{
	if(isset($HTTP_COOKIE_VARS['ck_thispc_dept'])&&!empty($HTTP_COOKIE_VARS['ck_thispc_dept'])) $dept=$HTTP_COOKIE_VARS['ck_thispc_dept'];
	 else $dept="plop";//default is plop dept
}
$thisfile="products-archive-orderlist-showcontent.php";
$searchfile="products-archive.php";
$returnfile="products-archive.php?sid=$sid&lang=$lang&cat=$cat&userck=$userck";

switch($cat)
{
	case "pharma":
							$title=$LDPharmacy;
							$dbtable="pharma_orderlist";
							$breakfile="apotheke.php?sid=$sid&lang=$lang";
							break;
	case "medlager":
							$title=$LDMedDepot;
							$dbtable="med_orderlist";
							$breakfile="medlager.php?sid=$sid&lang=$lang";
							break;
	default:  {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
}

// the value of dept comes from the calling page

// define the content array
$rows=0;
$count=0;
//print $sql;
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

 <script language="javascript" >
<!-- 
function pruf(d)
{
	kw=d.keyword;
	var k=kw.value; 
	//if(k=="") return false;
	if((k=="")||(k==" ")||(!(k.indexOf('%')))||(!(k.indexOf('_'))))
	{
		kw.value="";
		kw.focus();
		return false;
	}
	return true;
}

function popinfo(b)
{
	urlholder="products-bestellkatalog-popinfo.php?sid=<?php print "$sid&lang=$lang"; ?>&cat=<?php echo $cat ?>&keyword="+b+"&mode=search";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
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
require("../include/inc_css_a_hilitebu.php");
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="document.suchform.keyword.focus()"
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?php echo $test ?>
<?php //foreach($argv as $v) print "$v "; ?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="45">
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo $title ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])print'<a href="'.$returnfile.'"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('products.php','archshow','','<?php echo $cat ?>')"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>
<FONT face="Verdana,Helvetica,Arial" size=2>

<p>
<?php 
require("../include/inc_products_archive_search_form.php"); 

$rows=0;

require("../include/inc_db_makelink.php");
	if($link&&$DBLink_OK)
		{
				$sql='SELECT * FROM '.$dbtable.' 
							 WHERE order_id="'.$order_id.'" 
							 AND sent_stamp="'.$sent_stamp.'"
							 AND dept="'.$dept.'"';
        		if($ergebnis=mysql_query($sql,$link))
				{
					//count rows=linecount
					while ($content=mysql_fetch_array($ergebnis)) $rows++;					
					//reset result
					if ($rows)	mysql_data_seek($ergebnis,0);					
				}else { print "$LDDbNoRead<br>"; } 
				
			
			//print $sql;
	}
  	 else { print "$LDDbNoLink<br>"; } 
	
	
if($rows>0)
{
//++++++++++++++++++++++++ show general info about the list +++++++++++++++++++++++++++
$tog=1;
$content=mysql_fetch_array($ergebnis);
print '</font>
		<table cellpadding=0 cellspacing=0 border=0 bgcolor="#666666"><tr><td><table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffff">';
	for ($i=0;$i<sizeof($LDArchValindex);$i++)
	print '
		<td><font face=Verdana,Arial size=2 color="#0000ff">'.$LDArchValindex[$i].'</td>';
	print '</tr>
			<tr bgcolor=#f6f6f6>
				<td><font face=Verdana,Arial size=2>'.strtoupper($dept).'</td>
				 <td><font face=Verdana,Arial size=2>'.$content[order_date].'</td>
				<td ><font face=Verdana,Arial size=2>'.$content[order_time].'</td>
				<td><font face=Verdana,Arial size=2>'.$content[encoder].'</td>
				<td><font face=Verdana,Arial size=2>'.substr($content[validator],0,strpos($content[validator],"@")).'</td>
				<td><font face=Verdana,Arial size=2>'.$sent_date.'</td>
				<td><font face=Verdana,Arial size=2>'.$sent_time.'</td>
				<td><font face=Verdana,Arial size=2>'.$content[priority].'</td>
				</tr></table></td></tr></table>';

//++++++++++++++++++++++++ show the actual list +++++++++++++++++++++++++++
$tog=1;
$artikeln=explode(" ",$content[articles]);
print '<form name=actlist>
		<font face="Verdana, Arial" size=2 color="#800000">';
if (sizeof($artikeln)==1) print $LDOrderedArticle; else print  $LDOrderedArticleMany;

$LDFinindex[]="";
print '</font>
		<table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffee">';
	for ($i=0;$i<sizeof($LDFinindex);$i++)
	print '
		<td><font face=Verdana,Arial size=2 color="#000080">'.$LDFinindex[$i].'</td>';
	print '</tr>';	

$i=1;
for($n=0;$n<sizeof($artikeln);$n++)
 	{
	parse_str($artikeln[$n],$r);
	if($tog)
	{ print '<tr bgcolor="#dddddd">'; $tog=0; }else{ print '<tr bgcolor="#efefff">'; $tog=1; }
	print'
				<td><font face=Arial size=2 color="#000080">'.$i.'</td>
				<td><font face=Verdana,Arial size=2>'.$r[artikelname].'</td>
				 <td><font face=Verdana,Arial size=2>'.$r[pcs].'</td>
				<td ><font face=Verdana,Arial size=2><nobr>X '.$r[proorder].'</nobr></td>
				<td><font face=Verdana,Arial size=2>'.$r[bestellnum].'</td>
				<td><a href="#" onClick="popinfo(\''.$r[bestellnum].'\')" ><img src="../img/info3.gif" width=16 height=16 border=0 alt="'.$LDOpenInfo.$r[artikelname].'"></a></td>
				</tr>';
	$i++;
 	}
	print '</table>
			</form>
			';
}
 ?>
<a href="<?php echo $returnfile; ?>"><img src="../img/<?php echo $lang; ?>/<?php echo $lang; ?>_back2.gif" border=0 width=110 height=24 align="absmiddle"></a>
</table>
	

</ul>

</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=<?php print $cfg['bot_bgcolor']; ?> height=70 colspan=2>

<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>

</td>
</tr>
</table>        
&nbsp;

</FONT>


</BODY>
</HTML>
