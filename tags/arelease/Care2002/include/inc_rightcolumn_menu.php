<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_rightcolumn_menu.php",$PHP_SELF)) 
	die("<meta http-equiv='refresh' content='0; url=../'>");
/*------end------*/

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
&nbsp;<b><?php echo $LDPhonePolice ?>:</b> <br>&nbsp;&nbsp; <font color="#cc0000">11?</font><br>
&nbsp;<b><?php echo $LDPhoneFire ?>:</b> <br>&nbsp;&nbsp; <font color="#cc0000">11?</font><br>
&nbsp;<b><?php echo $LDAmbulance ?>:</b> <br>&nbsp;&nbsp; <font color="#cc0000">11?</font><br>
&nbsp;<b><?php echo $LDPhone ?>:</b> <br>&nbsp;&nbsp;(07??) 650 8999<br>
&nbsp;<b><?php echo $LDFax ?>:</b> <br>&nbsp;&nbsp;(07??) 650 8998<br>
&nbsp;<b><?php echo $LDAddress ?>:</b> <br>&nbsp;&nbsp;Virtualstr. 45<br>&nbsp;&nbsp;70891 Cyberia&nbsp;&nbsp;<br>
<!-- &nbsp;<b><?php echo $LDEmail ?>:</b> <br>&nbsp;&nbsp;<a href="mailto:info@maryhospital.com">info@<br>&nbsp;&nbsp;maryhospital.com</a>&nbsp;&nbsp;
 -->
 &nbsp;<b><?php echo $LDEmail ?>:</b> <br>&nbsp;&nbsp;<a href="mailto:info@care2x.com">info@care2x.com</a>&nbsp;&nbsp;
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
	&nbsp;<A HREF="open-time.php?<?php print "sid=$sid&lang=$lang"; ?>"><?php echo $LDOpenTimes ?></A>
	<br>
	&nbsp;<A HREF="newscolumns.php?<?php print "sid=$sid&lang=$lang"; ?>&target=management"><?php echo $LDManagement ?></A>
	<br>
	&nbsp;<A HREF="abteilung.php?<?php print "sid=$sid&lang=$lang"; ?>"><?php echo $LDDept ?></A>
	<br>
	&nbsp;<A HREF="cafenews.php?<?php print "sid=$sid&lang=$lang"; ?>"><?php echo $LDCafenews ?></A>
	<br>
	&nbsp;<A HREF="newscolumns.php?<?php print "sid=$sid&lang=$lang"; ?>&target=patient_admission"><?php echo $LDAdmission ?></A>
	<br>
	&nbsp;<A HREF="newscolumns.php?<?php print "sid=$sid&lang=$lang"; ?>&target=events"><?php echo $LDExhibition ?></A>
	<br>
	&nbsp;<a href="newscolumns.php?<?php print "sid=$sid&lang=$lang"; ?>&target=prof_training"><?php echo $LDEducation ?></A>
	<br>
	&nbsp;<A HREF="newscolumns.php?<?php print "sid=$sid&lang=$lang"; ?>&target=adv_studies"><?php echo $LDAdvStudies ?></A>
	<br>
	&nbsp;<A HREF="newscolumns.php?<?php print "sid=$sid&lang=$lang"; ?>&target=physiotherapy"><?php echo $LDPhyTherapy ?></A>
	<br>
	&nbsp;<A HREF="newscolumns.php?<?php print "sid=$sid&lang=$lang"; ?>&target=healthtips"><?php echo $LDHealthTips ?></A>
	<br>
	&nbsp;<A HREF="calendar.php?<?php print "sid=$sid&lang=$lang&retpath=home"; ?>"><?php echo $LDCalendar ?></A>
	<br>
	&nbsp;<A HREF="javascript:gethelp()"><?php echo $LDHelp ?></A>
	<br>
	&nbsp;<a href="editor-pass.php?sid=<?php echo "$sid&lang=$lang" ?>&target=headline&title=<?php echo $LDEditTitle ?>"><?php echo $LDSubmitNews ?></A>
	</FONT>
<?php if($cfg[dhtml])
print '
</td>
</tr>
</table>
<p>';
?>
