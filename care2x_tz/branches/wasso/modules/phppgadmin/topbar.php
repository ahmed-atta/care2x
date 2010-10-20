<?php

	/**
	 * Top menu for phpPgAdmin
	 *
	 * $Id: topbar.php,v 1.1 2006/01/13 13:42:14 irroal Exp $
	 */

	// Include application functions
	include_once('libraries/lib.inc.php');
	
	$misc->printHeader();
	$misc->printBody('topbar');
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="topbar">
	<tr>
		<td width="211" rowspan="2"><a href="intro.php" target="detail"><img style="border: none" src="images/themes/<?php echo $conf['theme'] ?>/title.png" width="211" height="50" alt="<?php echo htmlspecialchars($appName) ?>" title="<?php echo htmlspecialchars($appName) ?>" /></a></td>
		<td class="topbar" width="5" rowspan="2">&nbsp;</td>
		<td class="topbar">
		<?php echo sprintf($lang['strtopbar'], htmlspecialchars($conf['description']),
			htmlspecialchars($conf['servers'][$_SESSION['webdbServerID']]['host']),
			htmlspecialchars($conf['servers'][$_SESSION['webdbServerID']]['port']),
			htmlspecialchars($_SESSION['webdbUsername']), 
			date($lang['strtimefmt'])) ?></td>
	</tr>
	<tr>
		<td class="topbar">
<?php
	// For superuser, show user and group admin.  For normal user, show change password.
	if ($data->isSuperUser($_SESSION['webdbUsername'])) :
?>
			<a class="toplink" href="users.php" target="detail"><?php echo $lang['strusers'] ?></a> | 
			<a class="toplink" href="groups.php" target="detail"><?php echo $lang['strgroups'] ?></a> |
<?php
	endif;
?>
			<a class="toplink" href="users.php?action=account" target="detail"><?php echo $lang['straccount'] ?></a> |
<?php if ($conf['show_reports']) : ?>
			<a class="toplink" href="reports.php" target="detail"><?php echo $lang['strreports'] ?></a> |
<?php endif; ?>
			<a class="toplink" href="sqledit.php" target="sqledit" onclick="window.open('sqledit.php?action=sql&<?php echo SID ?>','sqledit','toolbar=no,width=600,height=400,resizable=yes,scrollbars=no').focus(); return false;"><?php echo $lang['strsql'] ?></a> |
			<a class="toplink" href="sqledit.php" target="sqledit" onclick="window.open('sqledit.php?action=find&<?php echo SID ?>','sqledit','toolbar=no,width=600,height=400,resizable=yes,scrollbars=no').focus(); return false;"><?php echo $lang['strfind'] ?></a> |
			<a class="toplink" href="logout.php" target="_parent"><?php echo $lang['strlogout'] ?></a>
		</td>
	</tr>
</table>
<?php
	$misc->printFooter();
?>
