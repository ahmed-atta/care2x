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
define('LANG_FILE','doctors.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');

$dbtable='care_personell_data';

/* Establish db connection */
require('../include/inc_db_makelink.php');
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
			else echo "<p>".$sql."<p>$LDDbNoRead"; 
				
		 	$sql="SELECT list FROM care_doctors_dept_personell_quicklist
							WHERE dept LIKE '$dept'";	
							
			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $ftinfo=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$ftinfo=mysql_fetch_array($ergebnis);
					//echo $result[$i][a_dutyplan];
					//echo $sql."<br>";
				}
			}
				else echo "<p>".$sql."<p>$LDDbNoRead"; 
  } else { echo "$LDDbNoLink $sql<br>"; }

?>
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
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

<font face=verdana,arial size=5 color=maroon>
<b>
<?php
echo $ln.', '.ucfirst($fn);

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
<td bgcolor=#ffffcc><img <?php echo createComIcon('../','authors.gif') ?>>&nbsp;<font face=verdana,arial size=2 ><b><?php echo $LDDoc1 ?></b><br></font>
</td>
</tr>
<tr>
<td><UL><font face=verdana,arial size=2 ><b><?php echo $LDBeeper ?>:</b><font color=red> <?php echo $tf[df]; ?><br>
<font color=navy><b><?php echo $LDPhone ?>:</b> <?php echo $tf[dp]; ?><br></font></ul>
</td>
</tr>
<tr>
<td bgcolor=#ffffcc><img <?php echo createComIcon('../','listen-sm-legend.gif') ?>>&nbsp;<font face=verdana,arial size=2 ><b><?php echo $LDDoc2 ?></b><br></font>
</td>
</tr>
<tr>
<td><UL><font face=verdana,arial size=2 ><b><?php echo $LDBeeper ?>:</b><font color=red> <?php echo $tf["of"]; ?>
<br>
<font color=navy><b><?php echo $LDPhone ?>:</b> <?php echo $tf["op"]; ?><br></font></ul>
</td>
</tr>

<tr>
<td bgcolor=#ffffcc><img <?php echo createComIcon('../','warn.gif') ?>>&nbsp;<font face=verdana,arial size=2 ><b><?php echo $LDMoreInfo ?></b><br></font>
</td>
</tr>
<tr>
<td><font face=verdana,arial size=2 ><?php echo $pinfo["info"]; ?></font>
</td>
</tr>
</table>
<p>

<a href="javascript:closethis()"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDCloseWindow ?>"></a>

</BODY>

</HTML>
