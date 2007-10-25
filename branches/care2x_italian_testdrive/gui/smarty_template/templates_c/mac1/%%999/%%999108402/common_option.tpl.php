<?php /* Smarty version 2.6.0, created on 2004-07-06 23:30:20
         compiled from registration_admission/common_option.tpl */ ?>

<table width="100%" cellspacing="0" cellpadding="0">
  <tbody>

    <tr>
      <td><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['sTabsFile'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
    </tr>

    <tr>
      <td>
			<table cellspacing="0" cellpadding="0" width=800>
			<tbody>
				<tr valign="top">
					<td>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "registration_admission/basic_data.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						
						<?php if ($this->_tpl_vars['bShowNoRecord']): ?>
							<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "registration_admission/common_norecord.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php endif; ?>

						<?php echo $this->_tpl_vars['sOptionBlock']; ?>

					
					</td>
					<td><?php echo $this->_tpl_vars['sOptionsMenu']; ?>
</td>
				</tr>
			</tbody>
			</table>
	  </td>
    </tr>

	<tr>
      <td valign="top">
	  	<?php echo $this->_tpl_vars['sBottomControls']; ?>
 <?php echo $this->_tpl_vars['pbPersonData']; ?>
 <?php echo $this->_tpl_vars['pbAdmitData']; ?>
 <?php echo $this->_tpl_vars['pbMakeBarcode']; ?>
 <?php echo $this->_tpl_vars['pbMakeWristBands']; ?>
 <?php echo $this->_tpl_vars['pbBottomClose']; ?>

	</td>
    </tr>

    <tr>
      <td>
	  	&nbsp;
		<br>
	  	<?php echo $this->_tpl_vars['sAdmitLink']; ?>

		<br>
		<?php echo $this->_tpl_vars['sSearchLink']; ?>

		<br>
		<?php echo $this->_tpl_vars['sArchiveLink']; ?>

	</td>
    </tr>

  </tbody>
</table>