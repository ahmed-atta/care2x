<?php /* Smarty version 2.6.0, created on 2007-07-17 16:28:20
         compiled from C:%5Cwamp%5Cwww%5CCare2002%5Cinstaller/templates/test_result.tpl */ ?>
<tr><td valign="top"><?php if ($this->_tpl_vars['test']->getResult() == @constant('INSTALLER_TEST_SUCCESS')): ?>
<img src='images/green_check.gif'>
<?php elseif ($this->_tpl_vars['test']->getResult() == @constant('INSTALLER_TEST_WARNING')): ?>
<img src='images/yellow_check.gif'>
<?php else: ?>
<img src='images/red_check.gif'>
<?php endif; ?></td>
<td align="left" valign="bottom"><?php echo $this->_tpl_vars['test']->getResultMessage(); ?>
</td>
</tr>