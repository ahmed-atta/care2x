<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

define('LANG_FILE','or.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
$dbtable='care_personell_data';

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
	{	

		 	$sql="SELECT info FROM $dbtable 
							WHERE lastname LIKE '$ln'
								AND firstname LIKE '$fn'
								AND bday LIKE '$bd'";	
			if($ergebnis=$db->Execute($sql))
       		{
				$rows=0;
				if( $pinfo=$ergebnis->FetchRow()) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$pinfo=$ergebnis->FetchRow();
					//echo $result[$i][a_dutyplan];
					//echo $sql."<br>";
				}
			}
				else echo "<p>".$sql."<p>$LDDbNoRead"; 
				
		 	$sql="SELECT list FROM care_nursing_dept_personell_quicklist
							WHERE dept LIKE '$dept'";	
							
			if($ergebnis=$db->Execute($sql))
       		{
				$rows=0;
				if( $ftinfo=$ergebnis->FetchRow()) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$ftinfo=$ergebnis->FetchRow();
					//echo $result[$i][a_dutyplan];
					//echo $sql."<br>";
				}
			}
				else echo "<p>".$sql."<p>$LDDbNoRead"; 
}
  	 else { echo "$LDDbNoLink<br>"; } 

?>
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE><?php echo "$ln, $fn" ?></TITLE>

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
<td bgcolor=#ffffcc><img <?php echo createComIcon($root_path,'authors.gif','0') ?>>&nbsp;<font face=verdana,arial size=2 ><b><?php echo $LDStandbyPerson ?></b><br></font>
</td>
</tr>
<tr>
<td><font face=verdana,arial size=2 ><ul><b><?php echo $LDBeeper ?>:</b><font color=red> <?php echo $tf[df]; ?><br>
<font color=navy><b><?php echo $LDPhone ?>:</b> <?php echo $tf[dp]; ?><br></font></ul>
</td>
</tr>
<tr>
<td bgcolor=#ffffcc><img <?php echo createComIcon($root_path,'listen-sm-legend.gif','0') ?>>&nbsp;<font face=verdana,arial size=2 ><b><?php echo $LDOnCallPerson ?></b><br></font>
</td>
</tr>
<tr>
<td><font face=verdana,arial size=2 ><ul><b><?php echo $LDBeeper ?>:</b><font color=red> <?php echo $tf["of"]; ?>
<br>
<font color=navy><b><?php echo $LDPhone ?>:</b> <?php echo $tf["op"]; ?><br></font></ul>
</td>
</tr>

<tr>
<td bgcolor=#ffffcc><img <?php echo createComIcon($root_path,'warn.gif','0') ?>>&nbsp;<font face=verdana,arial size=2 ><b><?php echo $LDExtraInfo ?></b><br></font>
</td>
</tr>
<tr>
<td><ul><font face=verdana,arial size=2 ><?php echo $pinfo["info"]; ?></font></ul>
</td>
</tr>
</table>
<p>

<a href="javascript:closethis()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"></a>

</BODY>

</HTML>
