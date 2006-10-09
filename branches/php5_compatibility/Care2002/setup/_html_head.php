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

<?php
if ((($status['step'] != 2) && (count($errors) > 0)) || ($status['step'] == 2))
{ ?>
	<div class="ErrorList">
		<big>Errors</big><br />
		<br />
	
		<?php
			if (count($errors) == 0)
			{
				echo "<i>There are no errors to display.  Good job!</i>\n";
			}
			else
			{
				foreach($errors as $index => $error)
				{
					$ticktock = (floor($index / 2) == ($index / 2)) ? 'spantick' : 'spantock';
					echo "<div class=\"$ticktock\">$error</div>\n";
				}
			
				echo "<br />\nTotal Errors: " . count($errors) . "\n";
			}
		?>
	</div>
<?php } ?>

<?php if ($status['step'] == 2) { ?>
<div class="WarningList">
	<big>Warnings</big><br />
	<br />
	
	<?php
		if (count($warnings) == 0)
		{
			echo "<i>There are no warnings to display.</i>\n";
		}
		else
		{
			foreach($warnings as $index => $warning)
			{
				$ticktock = (floor($index / 2) == ($index / 2)) ? 'spantick' : 'spantock';
				echo "<div class=\"$ticktock\">$warning</div>\n";
			}
			
			echo "<br />\nTotal Warnings: " . count($warnings) . "\n";
		}
	?>
</div>

<div class="MessageList">
	<big>Messages</big><br />
	<br />
	
	<?php
		if (count($messages) == 0)
		{
			echo "<i>There are no messages to display.</i>\n";
		}
		else
		{
			foreach($messages as $index => $message)
			{
				$ticktock = (floor($index / 2) == ($index / 2)) ? 'spantick' : 'spantock';
				echo "<div class=\"$ticktock\">$message</div>\n";
			}
			
			echo "<br />\nTotal Messages: " . count($messages) . "\n";
		}
	?>
</div>
<?php } ?>
	


<form action="index.php" method="post">
	<?php foreach ($status['data'] as $key => $value) { ?>
		<input type="hidden" name="s<?php echo $key; ?>" value="<?php echo $value; ?>" />
	<?php } ?>	