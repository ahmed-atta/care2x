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
if(!isset($mode)) $mode="";
if(!isset($keyword)) $keyword="";

$thisfile="products-archive.php";
$searchfile=$thisfile;
switch($cat)
{
	case "pharma":	
							$title="$LDPharmacy $LDOrderArchive";
							$dbtable="pharma_orderlist_archive";
							$breakfile="apotheke.php?sid=$sid&lang=$lang";
							break;
	case "medlager":
							$title="$LDMedDepot $LDOrderArchive";
							$dbtable="med_orderlist_archive";
							$breakfile="medlager.php?sid=$sid&lang=$lang";
							break;
	default:  {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
}

if($mode=="search")
{
	$keyword=trim($keyword);
	if(($keyword=="")||($keyword=="%")||($keyword=="_")||(strlen($keyword)<2)) { header("location:$thisfile?sid=$sid&lang=$lang&invalid=1&cat=$cat&userck=$userck"); exit;}
	if($lang=="de")
	{
		if(eregi($keyword,"eilig")) $keyword="urgent";
	}
	if(!$ofset) $ofset=0;
	if(!$nrows) $nrows=20;
}

$linecount=0;

//this is the search module
if((($mode=="search")||$update)&&($keyword!="")) 
{
	include("../include/inc_db_makelink.php");
	if($link&&$DBLink_OK)
		{
	
				if($such_date)
				{
					$pc=substr_count($keyword,".");
						//print $pc;
					if($pc)
					switch($pc)
					{
						case 1:$sdt="%".implode(".%",array_reverse(explode(".",$keyword)));break;
						case 2:$sdt="%".implode(".%",array_reverse(explode(".",$keyword)));break;
						default:$sdt="%$keyword";
					}
					else
					if(strlen($keyword)>2) $sdt=$keyword;
						else $sdt="________$keyword"; // 8 x _ to fill yyyy.mm.
					
				}
				else $sdt="";
				($such_dept)? $sdp=$keyword : $sdp="";
				($such_prio)?  $spr=$keyword : $spr="";
				
				$sql='SELECT * FROM '.$dbtable.' WHERE rec_date="'.$sdt.'" 
																OR dept="'.$sdp.'" 
																OR priority="'.$spr.'" ORDER BY rec_date DESC,  rec_time DESC
																LIMIT '.$ofset.', '.$nrows;
						
        		if($ergebnis=mysql_query($sql,$link)) while ($zeile=mysql_fetch_array($ergebnis)) $linecount++;			//count rows=linecount		
				//reset result
				if($linecount>0) mysql_data_seek($ergebnis,0);
					else
					{
						($such_date)? $sdt.="%" : $sdt="";
						($such_dept)? $sdp.="%" : $sdp="";
						($such_prio)?  $spr.="%" : $spr="";
						$sql='SELECT * FROM '.$dbtable.' WHERE rec_date LIKE "'.$sdt.'" 
																OR dept LIKE "'.$sdp.'" 
																OR priority LIKE "'.$spr.'" ORDER BY rec_date DESC,  rec_time DESC
																LIMIT '.$ofset.', '.$nrows;
						$linecount=0;        				
        				if($ergebnis=mysql_query($sql,$link)) while ($zeile=mysql_fetch_array($ergebnis)) $linecount++;			//count rows=linecount		
						if($linecount>0) mysql_data_seek($ergebnis,0);
					}
			//print $sql;
	}
  	 else { print "$LDDbNoLink<br>"; } 
}// end of if(mode==search)

//print $sql;

$abt=array("PLOP","GYN","Anästhesie","Unfall");
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
	if((k=="")||(k==" ")||(!(k.indexOf('%')))||(!(k.indexOf('&'))))
	{
		kw.value="";
		kw.focus();
		return false;
	}
	return true;
}
function show_order(d,o,t,s,h)
{
	urlholder="products-archive-orderlist-showcontent.php?sid=<?php print "$sid&lang=$lang&userck=$userck"; ?>&cat=<?php echo $cat ?>&dept="+d+"&order_id="+o+"&sent_stamp="+t+"&sent_date="+s+"&sent_time="+h;
	window.location.href=urlholder;
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

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="document.suchform.keyword.select()"
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?php echo $test ?>
<?php //foreach($argv as $v) print "$v "; ?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="45">
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo $title ?></STRONG></FONT></td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('products.php','arch','','<?php echo $cat ?>')"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>
<FONT face="Verdana,Helvetica,Arial" size=3 color="#990000">
<?php if($from=="archivepass")
{
print '<img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle">';
$curtime=date("H.i");
if ($curtime<"9.00") print $LDGoodMorning;
if (($curtime>"9.00")and($curtime<"18.00")) print $LDGoodDay;
if ($curtime>"18.00") print $LDGoodEvening;
print " ".$HTTP_COOKIE_VARS[$local_user.$sid];
}else print "<br>";
?>
</font>
<p>
<?php require("../include/inc_products_archive_search_form.php"); ?>
<hr width=80% align=left>
<?php if($linecount>0)
{
	print '
			<font face=Verdana,Arial size=2>
			<p> ';
			if ($linecount>1) print $LDListFoundMany; else print $LDListFound; 
			 
			print '.<br> '.$LDClk2SeeEdit.'<br></font><p>';

		$tog=1;
		print '
				<table border=0 cellspacing=0 cellpadding=0 bgcolor="#666666"><tr><td colspan=2>
				<table border=0 cellspacing=1 cellpadding=3>
  				<tr bgcolor="#ffffff">';
		for ($i=0;$i<sizeof($LDArchindex);$i++)
		print '
				<td><font face=Verdana,Arial size=2 color="#000080">'.$LDArchindex[$i].'</td>';
		print '
				</tr>';	

		$i=$ofset+1;

		while($content=mysql_fetch_array($ergebnis))
 		{
			if($tog)
			{ print '<tr bgcolor="#dddddd">'; $tog=0; }else{ print '<tr bgcolor="#efefff">'; $tog=1; }
			print'
				<td><font face=Verdana,Arial size=2>'.$i.'</td>
				<td><a href="javascript:show_order(\''.$content[dept].'\',\''.$content[order_id].'\',\''.$content[t_stamp].'\',\''.$content[rec_date].'\',\''.$content[rec_time].'\')"><img src="../img/upArrowGrnLrg.gif" width=16 height=16 border=0 alt="'.$LDClk2SeeEdit.'"></a></td>
				<td ><font face=Verdana,Arial size=2>'.strtoupper($content[dept]).'</td>
				<td><font face=Verdana,Arial size=2>';
			$buf=explode(".",$content[rec_date]);
			print $buf[2].'.'.$buf[1].'.'.$buf[0].'</td>
				 <td><font face=Verdana,Arial size=2>'.str_replace("24","00",$content[rec_time]).'</td>
				<td align="center">';
			if($content[status]=="normal")
				print "&nbsp;";
				else if($content[priority]=="urgent")  print '<img src="../img/warn.gif" width=16 height=16  border=0 alt="'.$LDUrgent.'!">';

			print '
					</td>';
			$dd=explode(" ",$content[done_date]);
			$dd[0]=implode(".",array_reverse(explode(".",$dd[0])));
			print '
				 <td><font face=Verdana,Arial size=2>'.str_replace("24","00",$dd[0]).' '.$dd[1].'</td>
				 <td><font face=Verdana,Arial size=2>'.$content[clerk].'</td>
				</tr>';
			$i++;

 		}
		print '
			</table>
			</td></tr><tr bgcolor="'.$cfg[body_bgcolor].'">
			<td>';
		if($ofset) print '	<form name=back action='.$thisfile.' method=post>
								<input type="hidden" name="keyword" value="'.$keyword.'">
        						<input type="hidden" name="mode" value="search">
        						<input type="hidden" name="such_date" value="'.$such_date.'">
                   				<input type="hidden" name="such_prio" value="'.$such_prio.'">
              					<input type="hidden" name="such_dept" value="'.$such_dept.'">
              					<input type="hidden" name="ofset" value="'.($ofset-$nrows).'">
                   				<input type="hidden" name="nrows" value="'.$nrows.'">
                       			<input type="hidden" name="sid" value="'.$sid.'">           
								<input type="hidden" name="lang" value="'.$lang.'">
                       			<input type="hidden" name="cat" value="'.$cat.'">           
								<input type="submit" value="&lt;&lt; '.$LDBack.'">
								</form>';
		print "</td><td align=right>";
		if($linecount==$nrows) 
						print '<form name=forward action='.$thisfile.' method=post>
								<input type="hidden" name="keyword" value="'.$keyword.'">
								<input type="hidden" name="mode" value="search">
        						<input type="hidden" name="such_date" value="'.$such_date.'">
              					<input type="hidden" name="such_dept" value="'.$such_dept.'">
                   				<input type="hidden" name="such_prio" value="'.$such_prio.'">
        						<input type="hidden" name="ofset" value="'.($ofset+$nrows).'">
              					<input type="hidden" name="nrows" value="'.$nrows.'">
                   				<input type="hidden" name="sid" value="'.$sid.'">     
								<input type="hidden" name="lang" value="'.$lang.'">
                       			<input type="hidden" name="cat" value="'.$cat.'">           
								<input type="submit" value="'.$LDContinue.' &gt;&gt;">
								</form>';
		print '
			</td>
			</tr>	
			</table>';                            
}
else
{
if($ofset) print '	<form name=back action='.$thisfile.' method=post>
								<input type="hidden" name="keyword" value="'.$keyword.'">
        						<input type="hidden" name="mode" value="search">
        						<input type="hidden" name="such_date" value="'.$such_date.'">
                   				<input type="hidden" name="such_prio" value="'.$such_prio.'">
              					<input type="hidden" name="such_dept" value="'.$such_dept.'">
              					<input type="hidden" name="ofset" value="'.($ofset-$nrows).'">
                   				<input type="hidden" name="nrows" value="'.$nrows.'">
                       			<input type="hidden" name="sid" value="'.$sid.'">           
                       			<input type="hidden" name="cat" value="'.$cat.'">           
								<input type="hidden" name="lang" value="'.$lang.'">
								<input type="submit" value="&lt;&lt; '.$LDBack.'">
								</form>';
							
if($mode=="search") print '
	<table border=0>
   <tr>
     <td><img src="../img/catr.gif" width=88 height=80 border=0 align=middle></td>
     <td><font face=Verdana,Arial size=2>'.$LDNoDataFound.'<br>'.$LDPlsEnterMore.'</td>
   </tr>
 </table>';
 
	
}
if($invalid) print'

	<table border=0>
   <tr>
     <td> <img src="../img/nedr.gif" width=100 height=138 border=0 align=middle>
		</td>
     <td><font face=Verdana,Arial size=2>'.$LDNoSingleChar.'<br>'.$LDPlsEnterMore.'
</td>
   </tr>
 </table>';
	 ?>
<p><br>

<a href="<?php echo "$breakfile" ?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0  alt="<?php echo $LDClose ?>" align="middle"></a>

	

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
