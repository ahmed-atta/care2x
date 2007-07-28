<?php /* Smarty version 2.6.0, created on 2004-07-28 11:34:18
         compiled from main/login_config.tpl */ ?>

<ul>

<table>
	<tr>
		<td align=right><img <?php echo $this->_tpl_vars['gifMascot']; ?>
 align="absmiddle"></td>
		<td>
			<font class="warnprompt"><?php echo $this->_tpl_vars['sPromptText']; ?>
</font>
			<br>
			<?php echo $this->_tpl_vars['sUserName']; ?>

		</font>
		</td>
	</tr>
</table>

<form <?php echo $this->_tpl_vars['sFormParams']; ?>
>

	
	<table cellSpacing=0 cellPadding=0 border=0 class="submenu_frame">
	<tbody>
		<tr>
			<td>
				<table cellSpacing=1 cellPadding=3  border=0>
				<tbody class="submenu">
					<tr class="submenu_title">
						<td colspan="3"><?php echo $this->_tpl_vars['LDPcID']; ?>
</td>
					</tr>
					<tr>
						<td><?php echo $this->_tpl_vars['sDeptIcon']; ?>
</td>
						<td><?php echo $this->_tpl_vars['sDeptSelect']; ?>
</td>
						<td><?php echo $this->_tpl_vars['LDDept']; ?>
</td>
					</tr>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/submenu_row_spacer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<tr>
						<td><?php echo $this->_tpl_vars['sWardIcon']; ?>
</td>
						<td><?php echo $this->_tpl_vars['sWardSelect']; ?>
</td>
						<td><?php echo $this->_tpl_vars['LDWard']; ?>
</td>
					</tr>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/submenu_row_spacer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<tr>
						<td><?php echo $this->_tpl_vars['sWardORIcon']; ?>
</td>
						<td><input type="text" name="thispc_room_nr" size=20 maxlength=25 value="<?php echo $this->_tpl_vars['sWardORValue']; ?>
"></td>
						<td><?php echo $this->_tpl_vars['LDWardOR']; ?>
</td>
					</tr>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/submenu_row_spacer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<tr>
						<td><?php echo $this->_tpl_vars['sPhoneNrIcon']; ?>
</td>
						<td><input type="text" name="thispc_phone" size=20 maxlength=25 value="<?php echo $this->_tpl_vars['sPhoneNrValue']; ?>
"></td>
						<td><?php echo $this->_tpl_vars['LDPhoneNr']; ?>
</td>
					</tr>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/submenu_row_spacer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<tr>
						<td><?php echo $this->_tpl_vars['sIntercomNrIcon']; ?>
</td>
						<td><input type="text" name="thispc_intercom" size=20 maxlength=25 value="<?php echo $this->_tpl_vars['sIntercomNrValue']; ?>
"></td>
						<td><?php echo $this->_tpl_vars['LDIntercomNr']; ?>
</td>
					</tr>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/submenu_row_spacer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<tr>
						<td><?php echo $this->_tpl_vars['sIPAddressIcon']; ?>
</td>
						<td><?php echo $this->_tpl_vars['sIPAddress']; ?>
</td>
						<td><?php echo $this->_tpl_vars['LDPcIP']; ?>
</td>
					</tr>
				</tbody>
				</table>
			</td>
		</tr>
	</tbody>
	</table>
	<p>
	
	<?php echo $this->_tpl_vars['sHiddenInputs']; ?>

	<?php echo $this->_tpl_vars['sSubmitFormButton']; ?>
 <?php echo $this->_tpl_vars['sNoChangeButton']; ?>
&nbsp;<?php echo $this->_tpl_vars['sCancelButton']; ?>


</form>

</ul>