<?
if ($cfg[dhtml])
print '
<table cellspacing=0 cellpadding=1 border=0 bgcolor=#999999>
<tr>
<td>

<table  cellspacing=0 cellpadding=2 align=right>
<tr><td bgcolor=maroon align=center>	<FONT  SIZE=2 FACE="verdana,Arial" color=white>
<b>'.$LDQuickInfo.'</b>
</td>
</tr>
<tr><td bgcolor="#ffffcc" >';
else print '<FONT  SIZE=2 FACE="verdana,Arial" color=maroon><b>'.$LDQuickInfo.'</b></font><br>';
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<FONT  SIZE=1 FACE="verdana,Arial" color=navy>
&nbsp;<b><?=$LDPhone ?>:</b> <br>&nbsp;&nbsp;(0712) 650 8999<br>
&nbsp;<b><?=$LDFax ?>:</b> <br>&nbsp;&nbsp;(0712) 650 8998<br>
&nbsp;<b><?=$LDAddress ?>:</b> <br>&nbsp;&nbsp;Virtualstr. 45<br>&nbsp;&nbsp;70891 Cyberia&nbsp;&nbsp;
<!-- &nbsp;<b><?=$LDEmail ?>:</b> <br>&nbsp;&nbsp;<a href="mailto:info@maryhospital.com">info@<br>&nbsp;&nbsp;maryhospital.com</a>&nbsp;&nbsp;
 -->
 &nbsp;<b><?=$LDEmail ?>:</b> <br>&nbsp;&nbsp;<a href="mailto:info@maryhospital.com">info@care2x.com</a>&nbsp;&nbsp;
<?
if($cfg[dhtml])
print '
</td>
</tr>
</table>

</td>
</tr>
</table>

<table  cellspacing=0 cellpadding=0 align=center>
<tr><td>';
else print '<p>';
?>
<FONT  SIZE=-1 FACE="Arial">&nbsp;<br>
	&nbsp;<A HREF="open-time.php?<?print "sid=$ck_sid&lang=$lang"; ?>"><?=$LDOpenTimes ?></A>
	<br>
	&nbsp;<A HREF="newscolumns.php?<?print "sid=$ck_sid&lang=$lang"; ?>&target=management"><?=$LDManagement ?></A>
	<br>
	&nbsp;<A HREF="abteilung.php?<?print "sid=$ck_sid&lang=$lang"; ?>"><?=$LDDept ?></A>
	<br>
	&nbsp;<A HREF="cafenews.php?<?print "sid=$ck_sid&lang=$lang"; ?>"><?=$LDCafenews ?></A>
	<br>
	&nbsp;<A HREF="newscolumns.php?<?print "sid=$ck_sid&lang=$lang"; ?>&target=patient_admission"><?=$LDAdmission ?></A>
	<br>
	&nbsp;<A HREF="newscolumns.php?<?print "sid=$ck_sid&lang=$lang"; ?>&target=events"><?=$LDExhibition ?></A>
	<br>
	&nbsp;<a href="newscolumns.php?<?print "sid=$ck_sid&lang=$lang"; ?>&target=prof_training"><?=$LDEducation ?></A>
	<br>
	&nbsp;<A HREF="newscolumns.php?<?print "sid=$ck_sid&lang=$lang"; ?>&target=adv_studies"><?=$LDAdvStudies ?></A>
	<br>
	&nbsp;<A HREF="newscolumns.php?<?print "sid=$ck_sid&lang=$lang"; ?>&target=physiotherapy"><?=$LDPhyTherapy ?></A>
	<br>
	&nbsp;<A HREF="newscolumns.php?<?print "sid=$ck_sid&lang=$lang"; ?>&target=healthtips"><?=$LDHealthTips ?></A>
	<br>
	&nbsp;<A HREF="calendar.php?<?print "sid=$ck_sid&lang=$lang&retpath=home"; ?>"><?=$LDCalendar ?></A>
	<br>
	&nbsp;<A HREF="javascript:gethelp()"><?=$LDHelp ?></A>
	<br>
	&nbsp;<a href="editor-pass.php?sid=<?=$ck_sid ?>&lang=<?=$lang ?>&target=headline&title=<?=$LDEditTitle ?>"><?=$LDSubmitNews ?></A>
	</FONT>
<? if($cfg[dhtml])
print '
</td>
</tr>
</table>
<p>';
?>
