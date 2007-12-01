<?php /* Smarty version 2.6.0, created on 2007-11-30 04:56:15
         compiled from C:%5Cxampp%5Chtdocs%5Ccare2x%5Cinstaller/templates/action_sql_file.tpl */ ?>
<tr><td>&nbsp;</td></tr>
<table align="center">
<?php if ($this->_tpl_vars['loop'] < 2): ?>
<tr><td align="center">The database file is being installed.</td></tr>
<tr><td align="center"><img src="images/animated_progress.gif"/></td></tr>
<?php elseif ($this->_tpl_vars['loop'] == 3): ?>
<tr><td align="center">Database installation complete.</td></tr>
<?php endif; ?>
</table>