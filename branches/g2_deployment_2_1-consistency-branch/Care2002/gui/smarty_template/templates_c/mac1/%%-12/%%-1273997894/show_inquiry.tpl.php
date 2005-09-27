<?php /* Smarty version 2.6.0, created on 2004-07-06 23:44:51
         compiled from tech/show_inquiry.tpl */ ?>

<table cellspacing=0 cellpadding=1 border=0 bgcolor="#999999" >
	<tr>
		<td>
			<table  cellspacing=0 cellpadding=2 >
				<tr class="submenu2_titlebar">
					<td>
						<?php echo $this->_tpl_vars['sInquirerData']; ?>

					</td>
				</tr>
				<tr>
					<td class="submenu2_list">
						<?php echo $this->_tpl_vars['sInquiry']; ?>

					</td>
				</tr> 

			<?php if ($this->_tpl_vars['bShowAnswer']): ?>
				<tr class="submenu2_titlebar">
					<td>
							<b><?php echo $this->_tpl_vars['sReplyData']; ?>
:</b>
					</td>
				</tr>
				<tr class="submenu2_body2">
					<td>
						<?php echo $this->_tpl_vars['sReply']; ?>

					</td>
				</tr>'
			<?php endif; ?>

			</table>
		</td>
	</tr>
</table>
<hr>