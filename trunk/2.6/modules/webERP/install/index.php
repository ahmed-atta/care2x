<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
// Start a session
if(!defined('SESSION_STARTED')) {
	session_name('ba_session_id');
	session_start();
	define('SESSION_STARTED', true);
}

// Check if the page has been reloaded
if(!isset($_GET['sessions_checked']) || $_GET['sessions_checked'] != 'true') {
	// Set session variable
	$_SESSION['session_support'] = '<font class="good">Enabled</font>';
	// Reload page
	header('Location: index.php?sessions_checked=true');
	exit(0);
} else {
	// Check if session variable has been saved after reload
	if(isset($_SESSION['session_support'])) {
		$session_support = $_SESSION['session_support'];
	} else {
		$session_support = '<font class="bad">Disabled</font>';
	}
}
$path_to_root = '..';
$comp_path = $path_to_root. '/companies';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>WebERP Installation Wizard</title>
<link href="../css/jelly/default.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript">

function change_os(type) {
	if(type == 'linux') {
		document.getElementById('operating_system_linux').checked = true;
		document.getElementById('operating_system_windows').checked = false;
		document.getElementById('file_perms_box').style.display = 'block';
	} else if(type == 'windows') {
		document.getElementById('operating_system_linux').checked = false;
		document.getElementById('operating_system_windows').checked = true;
		document.getElementById('file_perms_box').style.display = 'none';
	}
}
function change_data(type) {
	if(type == 'demo') {
		document.getElementById('db_file_demo').checked = true;
		document.getElementById('db_file_new').checked = false;
		
	} else if(type == 'new') {
		document.getElementById('db_file_demo').checked = false;
		document.getElementById('db_file_new').checked = true;
		
	}
}

</script>
</head>
<body>

<table cellpadding="0" cellspacing="0" border="0" width="750" align="center">
<tr>
	<td width="100%" align="center" style="font-size: 20px;">
		<font style="color: #FFFFFF;">WebERP</font>
		<font style="color: #DDDDDD;">Installation Wizard</font>
	</td>
</tr>
</table>

<form name="weberp_installation_wizard" action="save.php" method="post">
<input type="hidden" name="url" value="" />
<input type="hidden" name="password_fieldname" value="admin_password" />
<input type="hidden" name="remember" id="remember" value="true" />
<input type="hidden" name="path_to_root" value="<?php echo $path_to_root; ?>" />

<table cellpadding="0" cellspacing="0" border="0" width="750" align="center" style="margin-top: 10px;">
<tr>
	<td class="content">
			<h2>Welcome to the WebERP Installation Wizard.</h2>
		<center>
			<img src="<?php echo "../companies/weberpdemo/logo.jpg"; ?>" width="250" height="50" alt="Logo" />
		</center>


		<?php
		if(isset($_SESSION['message']) AND $_SESSION['message'] != '') {
			?><div style="width: 700px; padding: 10px; margin-bottom: 5px; border: 1px solid #FF0000; background-color: #FFDBDB;"><b>Error:</b> <?php echo $_SESSION['message']; ?></div><?php
		}
		?>
		<table cellpadding="3" cellspacing="0" width="100%" align="center">
		<tr>
			<td colspan="8"><h1>Step 1</h1>Please check the following requirements are met before continuing...</td>
		</tr>
		<?php if($session_support != '<font class="good">Enabled</font>') { ?>
		<tr>
			<td colspan="8" style="font-size: 10px;" class="bad">Please note: PHP Session Support may appear disabled if your browser does not support cookies.</td>
		</tr>
		<?php } ?>
		<tr>
			<td width="140" style="color: #666666;">PHP Version > 4.1.0</td>
			<td width="35">
				<?php
				$phpversion = substr(PHP_VERSION, 0, 6);
				if($phpversion > 4.1) {
					?><font class="good">Yes</font><?php
				} else {
					?><font class="bad">No</font><?php
				}
				?>
			</td>
			<td width="140" style="color: #666666;">PHP Session Support</td>
			<td width="115"><?php echo $session_support; ?></td>
			<td width="105" style="color: #666666;">PHP Safe Mode</td>
			<td>
				<?php
				if(ini_get('safe_mode')) {
					?><font class="bad">Enabled</font><?php
				} else {
					?><font class="good">Disabled</font><?php
				}
				?>
			</td>
		</tr>
		</table>
		<table cellpadding="3" cellspacing="0" width="100%" align="center">
		<tr>
			<td colspan="8"><h1>Step 2</h1>Please check the following files/folders are writeable before continuing...</td>
		</tr>
		<tr>
			<td style="color: #666666;">Configuration file</td>
			<td><?php if(is_writable($path_to_root)) { 
						echo '<font class="good">Writeable</font>'; 
					  } else { 
						echo '<font class="bad">Unwriteable</font>'; 
					  } ?>
			</td>
			<td style="color: #666666;"><?php echo 'Company data dirs ('.  $comp_path. '/*)'; ?>
			</td>
			<td><?php if(is_writable($comp_path) && is_writable($comp_path.'/weberpdemo') && is_writable($comp_path.'/weberpdemo/part_pics')) { 
						echo '<font class="good">Writeable</font>'; 
					  } elseif(!file_exists($comp_path)) {
			 			echo '<font class="bad">Directory Not Found</font>'; 
					  } else { 
						echo '<font class="bad">Unwriteable</font>'; 
					  } 
				 ?>
		   </td>
		</tr>
		</table>
		<table cellpadding="3" cellspacing="0" width="100%" align="center">
		<tr>
			<td colspan="2"><h1>Step 3</h1>Please check your path settings...</td>
		</tr>
		<tr>
			<td width="125" style="color: #666666;">
				Absolute URL:
			</td>
			<td>
				<?php
				// Try to guess installation URL
				$guessed_url = 'http://'.$_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"];
				$guessed_url = rtrim(dirname($guessed_url), 'install');
				?>
				<input type="text" tabindex="1" name="ba_url" style="width: 99%;" value="<?php if(isset($_SESSION['ba_url'])) { echo $_SESSION['ba_url']; } else { echo $guessed_url; } ?>" />
			</td>
		</tr>
		</table>
		<table cellpadding="5" cellspacing="0" width="100%" align="center">
		<tr>
			<td colspan="3"><h1>Step 4</h1>Please specify your operating system information below...</td>
		</tr>
		<tr height="50">
			<td width="170">
				Server Operating System:
			</td>
			<td width="180">
				<input type="radio" tabindex="4" name="operating_system" id="operating_system_linux" onclick="document.getElementById('file_perms_box').style.display = 'block';" value="linux"<?php if(!isset($_SESSION['operating_system']) OR $_SESSION['operating_system'] == 'linux') { echo ' checked'; } ?> />
				<font style="cursor: pointer;" onclick="javascript: change_os('linux');">Linux/Unix based</font>
				<br />
				<input type="radio" tabindex="5" name="operating_system" id="operating_system_windows" onclick="document.getElementById('file_perms_box').style.display = 'none';" value="windows"<?php if(isset($_SESSION['operating_system']) AND $_SESSION['operating_system'] == 'windows') { echo ' checked'; } ?> />
				<font style="cursor: pointer;" onclick="javascript: change_os('windows');">Windows</font>
			</td>
			<td>
				<div name="file_perms_box" id="file_perms_box" style="margin: 0; padding: 0; display: <?php if(isset($_SESSION['operating_system']) AND $_SESSION['operating_system'] == 'windows') { 
																												echo 'none'; 
																											} else { 
																												echo 'block'; 
																											} 
																										?>
																										;">
					<input type="checkbox" tabindex="6" name="world_writeable" id="world_writeable" value="true"<?php if(isset($_SESSION['world_writeable']) AND $_SESSION['world_writeable'] == true) { echo 'checked'; } ?> />
					<label for="world_writeable">
						World-writeable file permissions (777)
					</label>
					<br />
					<font class="note">(Please note: this is only recommended for testing environments)</font>
				</div>
			</td>
		</tr>
		</table>
		<table cellpadding="5" cellspacing="0" width="100%" align="center">
		<tr>
			<td colspan="5">Please enter your MySQL database server details below...</td>
		</tr>
		<tr>
			<td width="120" style="color: #666666;">Host Name:</td>
			<td width="230">
				<input type="text" tabindex="7" name="database_host" style="width: 98%;" value="<?php if(isset($_SESSION['database_host'])) {
																										 echo $_SESSION['database_host']; 
																									  } else { 
																										 echo 'localhost'; 
																									  } ?>" />
			</td>
			<td width="7">&nbsp;</td>
			<td width="70" style="color: #666666;">Username:</td>
			<td>
				<input type="text" tabindex="9" name="database_username" style="width: 98%;" value="<?php if(isset($_SESSION['database_username'])) { 
																											echo $_SESSION['database_username']; 
																										  } else { 
																											 echo 'root'; 
																										  } ?>" />
			</td>
		</tr>
		<tr>
			<td style="color: #666666;"></td>
			<td>
			</td>
			<td>&nbsp;</td>
			<td style="color: #666666;">Password:</td>
			<td>
				<input type="password" tabindex="10" name="database_password" style="width: 98%;"<?php if(isset($_SESSION['database_password'])) { 
																											echo ' value = "'.$_SESSION['database_password'].'"'; 
																										} ?> />
			</td>
		</tr>
		<tr>
			
			<td colspan="2">
				<input type="checkbox" tabindex="12" name="install_tables" id="install_tables" value="true"<?php if(!isset($_SESSION['install_tables'])) { 
																													echo ' checked'; 
																												 } elseif($_SESSION['install_tables'] == 'true') { 
																													echo ' checked'; 
																												 } ?> />
				<label for="install_tables" style="color: #666666;">Install Tables</label>
				<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span style="font-size: 10px; color: #666666;">(Please note: May remove existing tables and data)</span></td>
			</td>
		</tr>
		<tr>
			<td colspan="5"><h1>Step 5</h1>Please enter the company name below...</td>
		</tr>
		<tr>
			<td style="color: #666666;" colspan="1">Company Name:</td>
			<td colspan="4">
				<input type="text" tabindex="13" name="company_name" style="width: 99%;" value="<?php if(isset($_SESSION['company_name'])) { echo $_SESSION['company_name']; } else { echo 'weberp'; } ?>" />
			</td>
		</tr>
		<tr>
			<td width="170">
				Install the test company :
			</td>
		
			<td width="180">
				<input type="checkbox" tabindex="14" name="DemoData" id="db_file_demo" value="demo"<?php if(!isset($_SESSION['db_file']) OR $_SESSION['db_file'] == 'demo') { echo ' checked'; } ?> />
				<font style="cursor: pointer;" onclick="javascript: change_data('demo');">weberpdemo company</font>
			</td>
		</tr>
		<tr>
			<td width="170">
				Time Zone
			</td>
		
			<td width="180">
				<SELECT name='timezone'>
				<?php
					include('timezone.php');
					 ?>
					
				</SELECT>
			</td>
		</tr>
		<tr>
			<td colspan="5"><h1>Step 6</h1>Please enter your Administrator account details below...</td>
		</tr>
		<tr>
			<td style="color: #666666;">Username:</td>
			<td>
				admin
				<!--<input type="text" tabindex="14" name="admin_username" style="width: 98%;" value="<?php if(isset($_SESSION['admin_username'])) { echo $_SESSION['admin_username']; } else { echo 'admin'; } ?>" />-->
			</td>
			<td>&nbsp;</td>
			<td style="color: #666666;">Password:</td>
			<td>
				<input type="password" tabindex="16" name="admin_password" style="width: 98%;"<?php if(isset($_SESSION['admin_password'])) { echo ' value = "'.$_SESSION['admin_password'].'"'; } ?> />
			</td>
		</tr>
		<tr>
			<td style="color: #666666;">Email:</td>
			<td>
				<input type="text" tabindex="15" name="admin_email" style="width: 98%;"<?php if(isset($_SESSION['admin_email'])) { echo ' value = "'.$_SESSION['admin_email'].'"'; } ?> />
			</td>
			<td>&nbsp;</td>
			<td style="color: #666666;">Re-Password:</td>
			<td>
				<input type="password" tabindex="17" name="admin_repassword" style="width: 98%;"<?php if(isset($_SESSION['admin_password'])) { echo ' value = "'.$_SESSION['admin_password'].'"'; } ?> />
			</td>
		</tr>

		<tr>
			<td colspan="5" style="padding: 10px; padding-bottom: 0;"><h1 style="font-size: 0px;">&nbsp;</h1></td>
		</tr>
		<tr>
			<td colspan="4">
				<table cellpadding="0" cellspacing="0" width="100%" border="0">
				<tr valign="top">
					<td>Please note: &nbsp;</td>
					<td>
						WebERP is released under the
						<a href="http://www.gnu.org/licenses/gpl.html" target="_blank" tabindex="19">GNU General Public License</a>
						<br />
						By clicking install, you are accepting the license.
					</td>
				</tr>
				</table>
			</td>
			<td colspan="1" align="right">
				<input type="submit" tabindex="20" name="submit" value="Install WebERP" class="submit" />
			</td>
		</tr>
		</table>

	</td>
</tr>
</table>

</form>

<table cellpadding="0" cellspacing="0" border="0" width="100%" style="padding: 10px 0px 10px 0px;">
<tr>
	<td align="center" style="font-size: 10px;">
		<!-- Please note: the below reference to the GNU GPL should not be removed, as it provides a link for users to read about warranty, etc. -->
		<a href="http://www.weberp.org/" style="color: #000000;" target="_blank">WebERP</a>
		is	released under the
		<a href="http://www.gnu.org/licenses/gpl.html" style="color: #000000;" target="_blank">GNU General Public License</a>
		<!-- Please note: the above reference to the GNU GPL should not be removed, as it provides a link for users to read about warranty, etc. -->
	</td>
</tr>
</table>

</body>
</html>