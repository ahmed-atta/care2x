<?
if(($sid==NULL)||($sid!=$ck_sid)||($ck_apo_arch_user==NULL)) { header("location:invalid-access-warning.php"); exit;}
if($ck_language!="") $lang="../language/".$ck_language."-lang.php";
	else $lang="../language/english-lang.php"; // if no language cookie set to english

require($lang);
require("../req/config-color.php");

$thisfile="apotheke-archive-orderlist-showcontent.php";
//init db parameters
$dbname="maho";
$dbtable="pharma_orderlist_".$dept; // the value of dept comes from the calling page
$dbhost="localhost";
$dbusername="httpd";
$dbpassword="";
// define the content array
$rows=0;
$count=0;



//print $sql;

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
	urlholder="products-bestellkatalog-popinfo.php?sid=<? print $ck_sid; ?>&cat=<?=$cat ?>&keyword="+b+"&mode=search";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
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
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; Apotheke Datenbank Archive</STRONG></FONT></td>
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
  <form action="apotheke-archive.php" method="get" name="suchform" onSubmit="return pruf(this)">
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
      <td align=right><input type="reset" value="Löschen">
                      </td>
    </tr>
  </table>
  <input type="hidden" name="sid" value="<?=$ck_sid?>">
    <input type="hidden" name="mode" value="search">
    </form>
  <?
$rows=0;
 $link=mysql_connect($dbhost,$dbusername,$dbpassword);
	if ($link)
 	{ 

		if(mysql_select_db($dbname,$link)) 
		{
				$sql='SELECT * FROM '.$dbtable.' WHERE order_id="'.$order_id.'" AND sent_stamp="'.$sent_stamp.'"';
        		if($ergebnis=mysql_query($sql,$link))
				{
					//count rows=linecount
					while ($content=mysql_fetch_array($ergebnis)) $rows++;					
					//reset result
					if ($rows)	mysql_data_seek($ergebnis,0);					
				}else print "$db_sqlquery_fail $sql<br>";
				
			
			//print $sql;
		} else print "$db_table_noselect<br>";
	  mysql_close($link);
	}
  	 else 
		{ print "$db_noconnect $sql<br>"; }
	
	
if($rows>0)
{
//++++++++++++++++++++++++ show general info about the list +++++++++++++++++++++++++++
$bcatindex=array("Bestellung von","am:","um:","Erstellt von","Bestätigt von","Verschickt am:"," um","");
$tog=1;
$content=mysql_fetch_array($ergebnis);
print '</font>
		<table cellpadding=0 cellspacing=0 border=0 bgcolor="#666666"><tr><td><table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffff">';
	for ($i=0;$i<sizeof($bcatindex);$i++)
	print '
		<td><font face=Verdana,Arial size=2 color="#0000ff">'.$bcatindex[$i].'</td>';
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
$bcatindex=array("","Artikelname","Stück","","Bestell-Nr.","");
$tog=1;
$artikeln=explode(" ",$content[articles]);
print '<form name=actlist>
		<font face="Verdana, Arial" size=2 color="#800000"> Bestellte';
if (sizeof($artikeln)==1) print "s Artikel"; else print  " Artikeln";
print '</font>
		<table border=0 cellspacing=1 cellpadding=3>
  		<tr bgcolor="#ffffee">';
	for ($i=0;$i<sizeof($bcatindex);$i++)
	print '
		<td><font face=Verdana,Arial size=2 color="#000080">'.$bcatindex[$i].'</td>';
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
				<td><a href="#" onClick="popinfo(\''.$r[bestellnum].'\')" ><img src="../img/info3.gif" width=16 height=16 border=0 alt="'.$complete_info.$r[artikelname].'"></a></td>
				</tr>';
	$i++;

 	}
	print '</table>
			</form>
			';


}


 ?>
  <form>
<input type="button" value="<< Zurück" onclick="window.history.back()">
  
</form>
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
