<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php?mode=close"); exit;}; 
require("../language/".$lang."/lang_".$lang."_doctors.php");

require("../req/db_dbp.php");

$dbtable="personell_data";

$link=mysql_connect($dbhost,$dbusername,$dbpassword);
 if ($link)
 {
	if(mysql_select_db($dbname,$link)) 
	{	

		 	$sql="SELECT info FROM $dbtable 
							WHERE lastname LIKE '$ln'
								AND firstname LIKE '$fn'
								AND bday LIKE '$bd'";	
			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $pinfo=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$pinfo=mysql_fetch_array($ergebnis);
					//print $result[$i][a_dutyplan];
					//print $sql."<br>";
				}
			}
				else print "<p>".$sql."<p>Das Lesen  aus der Datenbank $dbtable ist gescheitert."; 
		 	$sql="SELECT list FROM doctors_dept_personell_quicklist
							WHERE dept LIKE '$dept'";	
							
			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $ftinfo=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$ftinfo=mysql_fetch_array($ergebnis);
					//print $result[$i][a_dutyplan];
					//print $sql."<br>";
				}
			}
				else print "<p>".$sql."<p>Das Lesen  aus der Datenbank $dbtable ist gescheitert."; 

	}else print "$db_table_noselect $sql<br>";
	mysql_close($link);
  } else { print "$db_noconnect $sql<br>"; }

?>
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<TITLE><?=$LDInfo4Duty ?></TITLE>

<script language="javascript">

function closethis()
{
	window.opener.focus();
	window.close();
}

</script>

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
</style>

</HEAD>
<BODY  background=img/winbg2.gif TEXT="#000000" LINK="#0000FF" VLINK="#800080" onLoad="if (window.focus) window.focus()"  >
<!--Don't forget to add your FREE HitBOX statistics to your web page. To
do so, click on Tools\Online Services\Add statistics...-->

<font face=verdana,arial size=5 color=maroon>
<b>
<?

print $ln.', '.ucfirst($fn);

		$ndl="l=$ln&f=$fn&b=$bd";
		$lbuf=explode("~",$ftinfo['list']);
		for($j=0;$j<sizeof($lbuf);$j++)
		{
			if(substr_count($lbuf[$j],$ndl))
			{
				parse_str($lbuf[$j],$tf); 
				break;
			 }
		}

?>
</b>
</font>
<p>

<table border=0 >
<tr>
<td bgcolor=#ffffcc><img src="../img/authors.gif" width=16 height=15 border=0>&nbsp;<font face=verdana,arial size=2 ><b><?=$LDStayIn ?></b><br></font>
</td>
</tr>
<tr>
<td><UL><font face=verdana,arial size=2 ><b><?=$LDBeeper ?>:</b><font color=red> <? print $tf[df]; ?><br>
<font color=navy><b><?=$LDPhone ?>:</b> <? print $tf[dp]; ?><br></font></ul>
</td>
</tr>
<tr>
<td bgcolor=#ffffcc><img src="../img/listen-sm-legend.gif" width=15 height=15 border=0>&nbsp;<font face=verdana,arial size=2 ><b><?=$LDOnCall ?></b><br></font>
</td>
</tr>
<tr>
<td><UL><font face=verdana,arial size=2 ><b><?=$LDBeeper ?>:</b><font color=red> <? print $tf["of"]; ?>
<br>
<font color=navy><b><?=$LDPhone ?>:</b> <? print $tf["op"]; ?><br></font></ul>
</td>
</tr>

<tr>
<td bgcolor=#ffffcc><img src="../img/warn.gif" width=16 height=16>&nbsp;<font face=verdana,arial size=2 ><b><?=$LDMoreInfo ?></b><br></font>
</td>
</tr>
<tr>
<td><font face=verdana,arial size=2 ><? print $pinfo["info"]; ?></font>
</td>
</tr>
</table>
<p>

<a href="javascript:closethis()"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border="0" alt="<?=$LDCloseWindow ?>"></a>

</BODY>

</HTML>
