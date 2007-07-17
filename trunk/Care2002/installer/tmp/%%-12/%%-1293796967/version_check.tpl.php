<?php /* Smarty version 2.6.0, created on 2007-07-17 16:22:01
         compiled from C:%5Cwamp%5Cwww%5CCare2002%5Cinstaller/templates/version_check.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'C:\wamp\www\Care2002\installer/templates/version_check.tpl', 3, false),)), $this); ?>
<tr><td>
<p>Welcome to the Care2x Installation procedure. </p>
<p>You are about to install <b><?php echo ((is_array($_tmp=$this->_tpl_vars['APP_NAME'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
 <?php echo $this->_tpl_vars['LONG_VERSION']; ?>
</b>. </p>
<p>The installation procedure consists of the following steps:
<ul>
	<li>Collect Information: you will be asked to provide some configuration information for the installer like database location, administrator user credentials, etc. </li>
	<li>System Checks: your system will be checked if it meets all the requirements for successful installation of Care2x. </li>
	<li>License Agreement: you will be asked to read carefully and accept the GNU General Public License under which Care2x is distributed. </li>
	<li>Install Database Schema: database schema that is the backbone of a properly working Care2x system will be installed. </li>
	<li>Create Administrator User: the Care2x administrator user that you will use later for initial configuration of the system will be created. </li>
	<li>Save System Configuration: the system configuration of the system will be saved on the hard drive. </li>
	<li>Install Optional DB Tables: you will be asked to choose wheather to install option database tables as ICD10 and OPS301 codes. </li>
	<li>Rename Critical Installation Files: finally, some critical installation files will be renamed for security reasons. </li>
</ul>
<p>Some of the above steps does not need user interaction and you may not notice their existance. </p>
<p>In order to navigate between the different interaction steps you will generally need to click on the <a href="">Continue...</a> link at the bottom. If you want to restart the installation procedure then click on the <a href="">Restart Installation</a> link. </p>
<p>For more detailed instructions you can follow the <a href="http://www.care2x.org/wiki/index.php/Installation_Guide">Care2x Installation Guide</a>. </p>
</td></tr>