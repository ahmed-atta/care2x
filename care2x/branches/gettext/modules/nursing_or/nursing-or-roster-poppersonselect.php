<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','nursing_or');
define('LANG_FILE_MODULAR','nursing_or.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

require_once($root_path.'include/helpers/inc_date_format_functions.php');
        
require_once($root_path.'modules/staff_admin/model/class_staff.php');
$pers_obj=new staff;
$nurses=&$pers_obj->getNursesOfDept($dept_nr);

$wkday=date("w",mktime(0,0,0,$month,$elemid+1,$year));
?>
<html>
<HEAD>

<TITLE><?php echo $LDInfo4Duty ?></TITLE>

<script language="javascript">

function closethis()
{
	window.opener.focus();
	window.close();
}


function addelem(elem,hid,last,first,b,nr)
{
	
	eval("window.opener.document.forms[0].elements[elem].value=last+','+first;");
	eval("window.opener.document.forms[0].elements[hid].value=nr;");

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
<?php if ($mode=="a") echo '<font color="#006666">'.$LDStandbyPerson.'</font>'; else echo $LDOnCall;
echo ' '.$LDOn.'<br>';

 echo '<font color=navy>';
/* if($month<10) echo '0'.$month; else echo $month;
*/
 echo formatDate2Local($year.'-'.$month.'-'.($elemid+1),$date_format);

 echo '</font> '.$LDFullDay[$wkday]; 
?>
</b>
</font>
<p>

<?php
if($pers_obj->record_count){
    echo '<ul>
	    <font face="verdana,arial" size=2>';

    while($row=$nurses->FetchRow()){
	    echo '
	    <a href="#" onClick="addelem(\''.$mode.$elemid.'\',\'h'.$mode.$elemid.'\',\''.ucfirst($row['name_last']).'\',\''.ucfirst($row['name_first']).'\',\''.$row['date_birth'].'\',\''.$row['staff_nr'].'\')">
	    <img ';
	    if ($mode=="a") echo createComIcon($root_path,'mans-gr.gif','0') ; else echo  createComIcon($root_path,'mans-red.gif','0');
	    echo '> '.ucfirst($row['name_last']).', '.ucfirst($row['name_first']).'</a>
	    <br>';
    }
    echo '
	</font></ul>';
}
else
{
    echo '<form><font face="verdana,arial" size=2>
     '.$LDNoPersonList.'
    <p>
    <input type="button" value="'.$LDCreatePersonList.'" onClick="window.opener.location.href=\'nursing-or-roster-staff-list.php?sid='.$sid.'&lang='.$lang.'&dept_nr='.$dept_nr.'&pmonth='.$month.'&pyear='.$year.'&retpath='.$retpath.'&ipath=plan\';window.opener.focus();window.close();">
    </form>';
}
?>
<p><br>
<a href="javascript:closethis()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWindow ?>"></a>

</BODY>

</HTML>
