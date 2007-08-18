<?php /* Smarty version 2.6.0, created on 2007-08-16 17:57:46
         compiled from C:%5Cwamp%5Cwww%5CCare2007%5Cinstaller/templates/action_sql_options.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'C:\wamp\www\Care2007\installer/templates/action_sql_options.tpl', 9, false),)), $this); ?>
<tr><td>&nbsp;</td></tr>
<table align="center">
<?php if ($this->_tpl_vars['loop'] != 3): ?>
<tr><td align="center">Choose optional database tables for installation:</td></tr>
<table align="center">
<?php if (isset($this->_foreach['sqloptions'])) unset($this->_foreach['sqloptions']);
$this->_foreach['sqloptions']['name'] = 'sqloptions';
$this->_foreach['sqloptions']['total'] = count($_from = (array)$this->_tpl_vars['files']);
$this->_foreach['sqloptions']['show'] = $this->_foreach['sqloptions']['total'] > 0;
if ($this->_foreach['sqloptions']['show']):
$this->_foreach['sqloptions']['iteration'] = 0;
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['file']):
        $this->_foreach['sqloptions']['iteration']++;
        $this->_foreach['sqloptions']['first'] = ($this->_foreach['sqloptions']['iteration'] == 1);
        $this->_foreach['sqloptions']['last']  = ($this->_foreach['sqloptions']['iteration'] == $this->_foreach['sqloptions']['total']);
?>
<tr><td align="left"><input id="radio" type="radio" name="optfile" value="<?php echo $this->_tpl_vars['file']; ?>
"
<?php if ($this->_foreach['sqloptions']['first']): ?> checked<?php endif; ?>
><?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</td></tr>
<?php endforeach; unset($_from); endif; ?>
</table>
<br>
<tr><td>&nbsp;</td></tr>
<tr><td align="center"><input id="button" type="submit" name="install_sql" value="Install">&nbsp;
<input id="button" type="submit" name="install_sql_done" value="Done"></td></tr>
<?php else: ?>
<tr><td align="center">The database table is being installed.</td></tr>
<tr><td align="center"><img src="images/animated_progress.gif"/></td></tr>
<?php endif; ?>
</table>
