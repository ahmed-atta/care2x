<?php /* Smarty version 2.6.0, created on 2007-05-01 16:07:43
         compiled from c:%5Cprogrammi%5Ceasyphp1-8%5Cwww%5Ccare2002%5Cinstaller/templates/action_complete.tpl */ ?>
<tr><td valign="top"><?php if ($this->_tpl_vars['ACTION']->getResult() == @constant('INSTALLER_TEST_SUCCESS')): ?>
<img src='images/green_check.gif'>
<?php elseif ($this->_tpl_vars['ACTION']->getResult() == @constant('INSTALLER_TEST_WARNING')): ?>
<img src='images/yellow_check.gif'>
<?php else: ?>
<img src='images/red_check.gif'>
<?php endif; ?></td>
<td align="left" valign="bottom"><?php echo $this->_tpl_vars['ACTION']->getResultMessage(); ?>
</td>
</tr>