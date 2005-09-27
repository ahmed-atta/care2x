<?php /* Smarty version 2.6.0, created on 2004-07-06 23:14:45
         compiled from ambulatory/submenu_ambulatory.tpl */ ?>
<blockquote>
<table border=0 cellpadding=5>

  <tr>
    <td colspan=2>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "ambulatory/submenu_generic.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
  </tr>
  
    <tr>
    <td width=50%>
		<?php echo $this->_tpl_vars['sTopLeftSubMenu']; ?>

	</td>
    <td width=50%>
		<?php echo $this->_tpl_vars['sTopRightSubMenu']; ?>

	</td>
  </tr>

	<tr>
    <td width=50%>
		<?php echo $this->_tpl_vars['sMidLeftSubMenu']; ?>

	</td>
    <td width=50%>
		<?php echo $this->_tpl_vars['sMidRightSubMenu']; ?>

	</td>
  </tr>

	<tr>
    <td width=50%>
		<?php echo $this->_tpl_vars['sBottomLeftSubMenu']; ?>

	</td>
    <td width=50%>
		<?php echo $this->_tpl_vars['sBottomRightSubMenu']; ?>

	</td>
  </tr>

</table>
<a href="<?php echo $this->_tpl_vars['breakfile']; ?>
"><img <?php echo $this->_tpl_vars['gifClose2']; ?>
 alt="<?php echo $this->_tpl_vars['LDCloseAlt']; ?>
" <?php echo $this->_tpl_vars['dhtml']; ?>
></a>
</blockquote>