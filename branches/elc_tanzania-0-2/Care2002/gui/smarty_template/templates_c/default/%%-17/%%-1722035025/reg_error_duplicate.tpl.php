<?php /* Smarty version 2.6.0, created on 2004-11-23 13:26:10
         compiled from registration_admission/reg_error_duplicate.tpl */ ?>
			<?php if ($this->_tpl_vars['error']): ?>
				<tr bgcolor=#ffffee>
					<td colspan=3 class="warnprompt">
					<center>
					<?php echo $this->_tpl_vars['sErrorImg']; ?>
 <?php echo $this->_tpl_vars['sErrorText']; ?>

					</center>
					</td>
				</tr>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['errorDupPerson']): ?>
				<tr bgcolor=#ffffee>
					<td colspan=3>
					<center>
						<table border=0>
							<tr>
								<td><?php echo $this->_tpl_vars['sErrorImg']; ?>
</td>
								<td class="warnprompt">
									<?php echo $this->_tpl_vars['LDPersonDuplicate']; ?>
 <?php echo $this->_tpl_vars['sErrorText']; ?>

								</td>
							</tr>
						</table>
					</center>
					</td>
				</tr>

				<tr>
					<td colspan=3>

						<table border=0 cellspacing=0 cellpadding=1 class="submenu_frame" width=100%>
							<tr>
								<td>
									<table border=0 cellspacing=0 width=100% >
										<?php echo $this->_tpl_vars['sDupDataColNameRow']; ?>

										<?php echo $this->_tpl_vars['sDupDataRows']; ?>

									</table>
								</td>
							</tr>
						</table>
						<p>
					</td>
				</tr>
			<?php endif; ?>