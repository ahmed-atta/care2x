<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_rightcolumn_menu.php",$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

/* Get the main info data */

$config_type='main_info_%';
require($root_path.'include/inc_get_global_config.php');


if ($cfg[dhtml])
print '
<table cellspacing=0 cellpadding=1 border=0 bgcolor="#999999" width="100%">
<tr>
<td>

<table  cellspacing=0 cellpadding=2 align=right width="100%">
<tr><td bgcolor=maroon align=center>	<FONT  SIZE=2 FACE="verdana,Arial" color=white>
<b>'.$LDQuickInfo.'</b>
</td>
</tr>
<tr><td bgcolor="#ffffcc" >';
else print '<FONT  SIZE=2 FACE="verdana,Arial" color=maroon><b>'.$LDQuickInfo.'</b></font><br>';
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<FONT  SIZE=1 FACE="verdana,Arial" color=navy>
&nbsp;<b><?php echo $LDPhonePolice ?>:</b> <br>&nbsp;&nbsp; <font color="#cc0000"><?php echo $main_info_police_nr ?></font><br>
&nbsp;<b><?php echo $LDPhoneFire ?>:</b> <br>&nbsp;&nbsp; <font color="#cc0000"><?php echo $main_info_fire_dept_nr ?></font><br>
&nbsp;<b><?php echo $LDAmbulance ?>:</b> <br>&nbsp;&nbsp; <font color="#cc0000"><?php echo $main_info_emgcy_nr ?></font><br>
&nbsp;<b><?php echo $LDPhone ?>:</b> <br>&nbsp;&nbsp;<?php echo $main_info_phone ?><br>
&nbsp;<b><?php echo $LDFax ?>:</b> <br>&nbsp;&nbsp;<?php echo $main_info_fax ?><br>
&nbsp;<b><?php echo $LDAddress ?>:</b> <br>&nbsp;&nbsp;<?php echo $main_info_address ?><br>
<!-- &nbsp;<b><?php echo $LDEmail ?>:</b> <br>&nbsp;&nbsp;<a href="mailto:info@maryhospital.com">info@<br>&nbsp;&nbsp;maryhospital.com</a>&nbsp;&nbsp;
 -->
 &nbsp;<b><?php echo $LDEmail ?>:</b> <br>&nbsp;&nbsp;<a href="mailto:<?php echo $main_info_email ?>"><?php echo $main_info_email ?></a>&nbsp;&nbsp;
<?php
if($cfg[dhtml])
print '
</td>
</tr>
</table>

</td>
</tr>
</table>

<table  cellspacing=0 cellpadding=0 align=left>
<tr><td>';
else print '<p>';
?>
<FONT  SIZE=-1 FACE="Arial">&nbsp;<br>
	&nbsp;<A HREF="open-time.php<?php echo URL_APPEND; ?>"><?php echo $LDOpenTimes ?></A>
	<br>
	&nbsp;<A HREF="newscolumns.php<?php echo URL_APPEND; ?>&dept_nr=28"><?php echo $LDManagement ?></A>
	<br>
	&nbsp;<A HREF="<?php echo $root_path.'modules/news/'; ?>departments.php<?php echo URL_APPEND; ?>"><?php echo $LDDept ?></A>
	<br>
	&nbsp;<A HREF="<?php echo $root_path.'modules/cafeteria/'; ?>cafenews.php<?php echo URL_APPEND; ?>"><?php echo $LDCafenews ?></A>
	<br>
	&nbsp;<A HREF="newscolumns.php<?php echo URL_APPEND; ?>&dept_nr=33"><?php echo $LDAdmission ?></A>
	<br>
	&nbsp;<A HREF="newscolumns.php<?php echo URL_APPEND; ?>&dept_nr=29"><?php echo $LDExhibition ?></A>
	<br>
	&nbsp;<a href="newscolumns.php<?php echo URL_APPEND; ?>&dept_nr=30"><?php echo $LDEducation ?></A>
	<br>
	&nbsp;<A HREF="newscolumns.php<?php echo URL_APPEND; ?>&dept_nr=31"><?php echo $LDAdvStudies ?></A>
	<br>
	&nbsp;<A HREF="newscolumns.php<?php echo URL_APPEND; ?>&dept_nr=10"><?php echo $LDPhyTherapy ?></A>
	<br>
	&nbsp;<A HREF="newscolumns.php<?php echo URL_APPEND; ?>&dept_nr=32"><?php echo $LDHealthTips ?></A>
	<br>
	&nbsp;<A HREF="<?php echo $root_path; ?>modules/calendar/calendar.php<?php print URL_APPEND.'&retpath=home'; ?>"><?php echo $LDCalendar ?></A>
	<br>
	&nbsp;<A HREF="javascript:gethelp()"><?php echo $LDHelp ?></A>
	<br>
	&nbsp;<a href="editor-pass.php<?php echo URL_APPEND ?>"><?php echo $LDSubmitNews ?></A>
	<br>
	&nbsp;<a href="javascript:openCreditsWindow()"><?php echo $LDCredits ?></a>
	</FONT>
<?php if($cfg[dhtml])
print '
</td>
</tr>
</table>
<p>';
?>
