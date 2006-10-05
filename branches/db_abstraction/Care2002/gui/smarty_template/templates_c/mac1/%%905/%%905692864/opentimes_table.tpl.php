<?php /* Smarty version 2.6.0, created on 2004-07-26 18:35:12
         compiled from common/opentimes_table.tpl */ ?>

<ul>
	<table border=0 cellspacing=0 cellpadding=0>
	<tr>
		<td bgcolor=#999999>
			<table border=0 cellspacing=1 cellpadding=5>
			<tr bgcolor=#ffffff>
				<td><b><?php echo $this->_tpl_vars['LDDayTxt']; ?>
</b></font></td>
				<td><b><?php echo $this->_tpl_vars['LDOpenHrsTxt']; ?>
</b></font></td>
				<td><b><?php echo $this->_tpl_vars['LDChkHrsTxt']; ?>
</b></font></td>
			</tr>
			
						<?php echo $this->_tpl_vars['sOpenTimesRows']; ?>


			</table>
		</td>
	</tr>
	</table>

	<p>
	<?php echo $this->_tpl_vars['sBreakFile']; ?>

	<p>
</ul>