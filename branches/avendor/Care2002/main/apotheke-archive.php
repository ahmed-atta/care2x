<?
if(($sid==NULL)||($sid!=$ck_sid)||($ck_apo_arch_user==NULL)) { header("location:invalid-access-warning.php"); exit;}
if($ck_language!="") $lang="../language/".$ck_language."-lang.php";
	else $lang="../language/english-lang.php"; // if no language cookie set to english

require($lang);
require("../req/config-color.php");

$thisfile="apotheke-archive.php";

if($mode=="search")
{
	$keyword=trim($keyword);
	if(($keyword=="")||($keyword=="%")||($keyword=="_")||(strlen($keyword)<2)) { header("location:$thisfile?sid=$ck_sid&invalid=1"); exit;}
	
	if(!$ofset) $ofset=0;
	if(!$nrows) $nrows=20;
}


$dbtable="pharma_orderlist_archive";

//init db parameters
require("../db_conf/db_init.php");

$linecount=0;

//this is the search module
if((($mode=="search")||$update)&&($keyword!="")) 
{
 $link=mysql_connect($dbhost,$dbusername,$dbpassword);
	if ($link)
 	{ 

		if(mysql_select_db($dbname,$link)) 
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
		} else print "$db_table_noselect<br>";
	mysql_close($link);
	}
  	 else 
		{ print "$db_noconnect<br>"; }
}// end of if(mode==search)

//print $sql;

$abt=array("PLOP","GYN","Anästhesie","Unfall");
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE> Apotheke - Archive</TITLE>

 <script language="javascript" >
<!-- 
function closewin()
{
	location.href='apotheke.php?sid=<?print $ck_sid.'&uid='.$r;?>';
}
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
	urlholder="apotheke-archive-orderlist-showcontent.php?sid=<? print $ck_sid; ?>&cat=pharma&dept="+d+"&order_id="+o+"&sent_stamp="+t+"&sent_date="+s+"&sent_time="+h;
	//orderlistwin=window.open(urlholder,"orderlistwin","width=700,height=550,menubar=no,resizable=yes,scrollbars=yes");
	window.location.href=urlholder
	}
// -->
</script> 

<? 
require("../req/css-a-hilitebu.php");
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="document.suchform.keyword.focus()"
<? if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?=$test ?>
<? //foreach($argv as $v) print "$v "; ?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="45">
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; Apotheke Bestellungsliste Archive</STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<!-- <a href="#" onClick=history.back(1)><img src="../img/zuruck.gif" border=0 <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a> -->
<a href="#"><img src="../img/hilfe.gif" border=0 width=93 height=41  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="apotheke.php?sid=<?print $ck_sid;?>"><img src="../img/fenszu.gif" border=0 width=93 height=41  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>
<FONT face="Verdana,Helvetica,Arial" size=2>
<?
if($from=="pass")
{
$curtime=date("H.i");
if ($curtime<"9.00") print "Guten Morgen ";
if (($curtime>"9.00")and($curtime<"18.00")) print "Guten Tag ";
if ($curtime>"18.00") print "Guten Abend ";
print "$ck_apo_arch_user!";
}else print "<br>";
?><p>
  <form action="<?=$thisfile?>" method="get" name="suchform" onSubmit="return pruf(this)">
  <table border=0 cellspacing=2 cellpadding=3>
    <tr bgcolor=#ffffdd>
      <td align=center colspan=2><FONT face="Verdana,Helvetica,Arial" size=2 color="#800000">Suchen nach einer Bestellliste:</td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2>Suchbegriff</td>
      <td><input type="text" name="keyword" size=40 maxlength=40>
          </td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right valign=top><FONT face="Verdana,Helvetica,Arial" size=2>Suchen bei</td>
      <td><FONT face="Verdana,Helvetica,Arial" size=2>	
	  		<input type="checkbox" name="such_date" value="1" <? if(($such_date)||(!$mode)) print " checked"; ?>> Datum<br>
          	<input type="checkbox" name="such_dept" value="1" <? if(($such_dept)||(!$mode)) print " checked"; ?>> Abteilung<br>
          	<input type="checkbox" name="such_prio" value="1" <? if(($such_prio)||(!$mode)) print " checked"; ?>> Priorität<br>
          </td>
    </tr>

    <tr >
      <td ><input type="submit" value="Suchen">
           </td>
      <td align=right><input type="reset" value="Löschen" onClick="document.suchform.keyword.focus()">
                      </td>
    </tr>
  </table>
  <input type="hidden" name="sid" value="<?=$ck_sid?>">
    <input type="hidden" name="mode" value="search">
    </form>
  
  
<hr width=80% align=left>
<?
if($linecount>0)
{
	print '
			<font face=Verdana,Arial size=2>
			<p>Folgende ';
			if ($linecount>1) print ' sind'; else print ' ist'; 
			print ' die Bestellungsliste';
			if ($linecount>1) print 'n'; 
			print' im Archiv, die dem Suchbegriff ';
			if ($linecount>1) print ' entsprechen'; else print ' entspricht'; 
			print '.<br> Clicken Sie den weiss-grünen Pfeil an, um deren Inhalt zu sehen.<br></font><p>';

		$bcatindex=array("&nbsp;","&nbsp;","Bestellung von:","Angetroffen am:","um:","&nbsp;","Bearbeitet am: um:","von:");
		$tog=1;
		print '
				<table border=0 cellspacing=0 cellpadding=0 bgcolor="#666666"><tr><td colspan=2>
				<table border=0 cellspacing=1 cellpadding=3>
  				<tr bgcolor="#ffffff">';
		for ($i=0;$i<sizeof($bcatindex);$i++)
		print '
				<td><font face=Verdana,Arial size=2 color="#000080">'.$bcatindex[$i].'</td>';
		print '
				</tr>';	

		$i=$ofset+1;

		while($content=mysql_fetch_array($ergebnis))
 		{
			if($tog)
			{ print '<tr bgcolor="#dddddd">'; $tog=0; }else{ print '<tr bgcolor="#efefff">'; $tog=1; }
			print'
				<td><font face=Verdana,Arial size=2>'.$i.'</td>
				<td><a href="#" onClick="show_order(\''.$content[dept].'\',\''.$content[order_id].'\',\''.$content[t_stamp].'\',\''.$content[rec_date].'\',\''.$content[rec_time].'\')"><img src="../img/upArrowGrnLrg.gif" width=16 height=16 border=0 alt="'.$edit_orderlist.'"></a></td>
				<td ><font face=Verdana,Arial size=2>'.strtoupper($content[dept]).'</td>
				<td><font face=Verdana,Arial size=2>';
			$buf=explode(".",$content[rec_date]);
			print $buf[2].'.'.$buf[1].'.'.$buf[0].'</td>
				 <td><font face=Verdana,Arial size=2>'.str_replace("24","00",$content[rec_time]).'</td>
				<td align="center">';
			if($content[status]=="normal")
				print "&nbsp;";
				else if($content[priority]=="eilig")  print '<img src="../img/warn.gif" width=16 height=16  border=0 alt="Eilig!">';

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
                       			<input type="hidden" name="sid" value="'.$ck_sid.'">           
								<input type="submit" value="&lt;&lt; Zurück">
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
                   				<input type="hidden" name="sid" value="'.$ck_sid.'">     
								<input type="submit" value="Weiter &gt;&gt;">
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
                       			<input type="hidden" name="sid" value="'.$ck_sid.'">           
								<input type="submit" value="&lt;&lt; Zurück">
								</form>';
							
if($mode=="search") print '
	<table border=0>
   <tr>
     <td><img src="../img/catr.gif" width=88 height=80 border=0 align=middle></td>
     <td><font face=Verdana,Arial size=2>Die Suche hat leider nichts gefunden, was dem Suchbegriff entspricht. <br>Bitte versuches Sie es 
	noch mal und geben sie etwas ausführlicheres ein. Danke.</td>
   </tr>
 </table>';
 
	
}
if($invalid) print'

	<table border=0>
   <tr>
     <td> <img src="../img/nedr.gif" width=100 height=138 border=0 align=middle>
		</td>
     <td><font face=Verdana,Arial size=2>Die Eingabe von einem einzigen Zeichen ist nicht zulässig. <br>Bitte versuchen Sie es noch mal und geben Sie etwas ausführlicheres ein. Vielen Dank.
</td>
   </tr>
 </table>';
	 ?>
  
</table>

		
	

</ul>

</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=<? print $cfg['bot_bgcolor']; ?> height=70 colspan=2>

<?php
 // get a  page into an array and print it out
require("../language/$lang/".$lang."_copyrite.htm");


 ?>

</td>
</tr>
</table>        
&nbsp;




</FONT>


</BODY>
</HTML>
