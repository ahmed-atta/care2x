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
define("LANG_FILE","doctors.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");

$dbtable="personell_data";

require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK) 
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
				}
			}
				else print "<p>".$sql."<p>$LDDbNoRead"; 
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
				else print "<p>".$sql."<p>$LDDbNoRead"; 
  } else { print "$LDDbNoLink $sql<br>"; }

?>
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<TITLE><?php echo $LDInfo4Duty ?></TITLE>

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
<?php
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
<td bgcolor=#ffffcc><img src="../img/authors.gif" width=16 height=15 border=0>&nbsp;<font face=verdana,arial size=2 ><b><?php echo $LDDoc1 ?></b><br></font>
</td>
</tr>
<tr>
<td><UL><font face=verdana,arial size=2 ><b><?php echo $LDBeeper ?>:</b><font color=red> <?php print $tf[df]; ?><br>
<font color=navy><b><?php echo $LDPhone ?>:</b> <?php print $tf[dp]; ?><br></font></ul>
</td>
</tr>
<tr>
<td bgcolor=#ffffcc><img src="../img/listen-sm-legend.gif" width=15 height=15 border=0>&nbsp;<font face=verdana,arial size=2 ><b><?php echo $LDDoc2 ?></b><br></font>
</td>
</tr>
<tr>
<td><UL><font face=verdana,arial size=2 ><b><?php echo $LDBeeper ?>:</b><font color=red> <?php print $tf["of"]; ?>
<br>
<font color=navy><b><?php echo $LDPhone ?>:</b> <?php print $tf["op"]; ?><br></font></ul>
</td>
</tr>

<tr>
<td bgcolor=#ffffcc><img src="../img/warn.gif" width=16 height=16>&nbsp;<font face=verdana,arial size=2 ><b><?php echo $LDMoreInfo ?></b><br></font>
</td>
</tr>
<tr>
<td><font face=verdana,arial size=2 ><?php print $pinfo["info"]; ?></font>
</td>
</tr>
</table>
<p>

<a href="javascript:closethis()"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border="0" alt="<?php echo $LDCloseWindow ?>"></a>

</BODY>

</HTML>
