<?php if (!defined('INSTALLER_PATH')) { header('Location: index.php'); exit; } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<title>Care2x Installer :: <?php echo $output['page_title']; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link href="style.css" rel="stylesheet" type="text/css" />

</head>
<body>

<table class="title">
	<tr>
		<td width="150"><img src="images/care_logo.gif" alt="Care2x Project" title="The Care2x Project" /></td>
		<td align="center"><?php echo $output['page_title']; ?></td>
		<td width="150">&nbsp;</td>
	</tr>
</table>
	
<br />  

<div class="content">
<form action="index.php" method="post">
	<?php foreach ($status['data'] as $key => $value) { ?>
		<input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>" />
	<?php } ?>	