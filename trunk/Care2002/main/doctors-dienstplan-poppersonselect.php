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

require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK) 
	{	
	// get orig data

	  		$dbtable="doctors_dept_personell_quicklist";
		 	$sql="SELECT list FROM $dbtable 
					WHERE dept='$dept'
					ORDER BY year DESC";
			//print $sql;
			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				while( $pdata=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0); //reset the variable
					$datafound=1;
					$pdata=mysql_fetch_array($ergebnis);
					//print $sql."<br>";
					//print $rows;
				}
				//else print "<p>".$sql."<p>Multiple entries found pls notify the edv."; 
			}
				else print "<p>".$sql."<p>$LDDbNoRead"; 
	}
  	 else { print "$LDDbNoLink<br>"; } 

$wkday=date("w",mktime(0,0,0,$month,$elemid+1,$year));
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


function addelem(elem,hid,last,first,b)
{
	
	eval("window.opener.document.forms[0].elements[elem].value=last+','+first;");
	eval("window.opener.document.forms[0].elements[hid].value='l='+last+'&f='+first+'&b='+b;");

}



<?php

function weekday($daynum,$mon,$yr){
		$jd=gregoriantojd($mon,$daynum,$yr);
		switch(JDDayOfWeek($jd,0))
			{
				case 0: return "<font color=red>Sonntag</font>";
				case 1: return "Montag";
				case 2: return "Dienstag";
				case 3: return "Mittwoch";
				case 4: return "Donnerstag";
				case 5: return "Freitag";
				case 6: return "Samstag";
			}
	}

?>

</script>

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
</style>

</HEAD>
<BODY  LINK="navy" VLINK="navy" onLoad="if (window.focus) window.focus()" >

<font face=verdana,arial size=4 color=maroon>
<b>
<?php echo $LDDutyPlan ?><br>
<?php if ($mode=="a") print '<font color="#006666">'.$LDDoc1.'</font>'; else print $LDDoc2;
print ' '.$LDOn.'<br>';

 print '<font color=navy>'.($elemid+1).'.';
 if($month<10) print '0'.$month; else print $month;
 print '.'.$year.'</font> '.$LDFullDay[$wkday]; 
?>
</b>
</font>
<p>

<?php
if($datafound)
{
    print '<ul>
	    <font face="verdana,arial" size=2>';

    //print $pdata['list'];
    $pbuf=explode("~",$pdata['list']);
    for ($i=0;$i<sizeof($pbuf);$i++)
    {
	    parse_str(trim($pbuf[$i]),$persons);
	    print '
	    <a href="#" onClick=addelem(\''.$mode.$elemid.'\',\'h'.$mode.$elemid.'\',\''.ucfirst($persons[l]).'\',\''.ucfirst($persons[f]).'\',\''.ucfirst($persons[b]).'\')>
	    <img src="../img/mans-';
	    if ($mode=="a") print 'gr.gif'; else print 'red.gif';
	    print '" border="0"> '.ucfirst($persons[l]).', '.ucfirst($persons[f]).'</a>
	    <br>';
    }
    print '
	</font></ul>';
}
else
{
    print '<form><font face="verdana,arial" size=2>
    <img src="../img/catr.gif" border=0 width=88 height=80 align=left> '.$LDNoPersonList.'
    <p>
    <input type="button" value="'.$LDCreatePersonList.'" onClick="window.opener.location.href=\'doctors-dienst-personalliste.php?sid='.$sid.'&lang='.$lang.'&dept='.$dept.'&pmonth='.$month.'&pyear='.$year.'&retpath='.$retpath.'&ipath=plan\';window.opener.focus();window.close();">
    </form>';
}
?>
<p><br>
<a href="javascript:closethis()"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border="0" alt="<?php echo $LDCloseWindow ?>"></a>

</BODY>

</HTML>
