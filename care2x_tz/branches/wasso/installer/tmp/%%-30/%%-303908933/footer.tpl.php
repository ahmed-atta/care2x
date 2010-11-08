<?php /* Smarty version 2.6.0, created on 2008-03-20 10:28:26
         compiled from C:%5Cxampp%5Chtdocs%5CCare2007%5Cinstaller/templates/footer.tpl */ ?>
</table>		
		<?php if ($this->_tpl_vars['FINISHED']): ?>
			<div id="install_block">
				<a href="<?php echo $this->_tpl_vars['APP_URL']; ?>
">Start using Care2x</a>
			</div>
		<?php else: ?>
			<table id="install_block">
			<tr>
				<td align="left"><a href="<?php echo $GLOBALS['HTTP_SERVER_VARS']['PHP_SELF']; ?>
?restart_installer=true">Restart Installation</a></td>
				<?php if ($this->_tpl_vars['CAN_CONTINUE']): ?>
				<td align="right"><a href="<?php echo $GLOBALS['HTTP_SERVER_VARS']['PHP_SELF']; ?>
?next_step=true">Continue...</a></td>
				<?php endif; ?>
			</tr>
			</table>
		<?php endif; ?>
	</div>

	<div class="footer">
		<table width="100%" border=0 cellpadding=0 cellspacing=0>
			<tr>
				<td>
					<p align="center">
					<a href="http://w3.care2x.org/" target='_blank'>Care2x Home</a> ::
					<a href="mailto:elpidio.latorilla@gmail.comsubject=Care2x">Copyright © - Elpidio Latorilla</a> ::
					<a href="mailto:gjergj.sheldija@gmail.com?subject=Care2x">Engineering - Gjergj Sheldija</a> ::
					<a href="http://cgt.altervista.org" target='_blank'>Release Manager - Claudio Giulio Torbinio</a> :: 
					<a href="http://sourceforge.net/projects/care2002/" target='_blank'>SF.net Project</a> 
				</td>
				<td align="right" valign="bottom">
					&nbsp;</td>
			</tr>
		</table>
	</div>
</table>
</html>