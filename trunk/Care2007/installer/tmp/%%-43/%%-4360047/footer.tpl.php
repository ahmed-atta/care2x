<?php /* Smarty version 2.6.0, created on 2007-05-01 16:07:02
         compiled from c:%5Cprogrammi%5Ceasyphp1-8%5Cwww%5Ccare2002%5Cinstaller/templates/footer.tpl */ ?>
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
					<a href="http://www.care2x.org/">Care2x Home</a> :: 
					<a href="http://www.care2x.org/wiki/">Wiki</a> :: 
					<a href="http://sourceforge.net/mailarchive/forum.php?forum_id=11772">Mailing List</a> :: 
					<a href="http://sourceforge.net/projects/care2002/">SF.net Project</a>&nbsp; 
                    //
					Copyright 2002-2007 Elpidio Latorilla
				</td>
				<td align="right" valign="bottom">
					&nbsp;</td>
			</tr>
		</table>
	</div>
</table>
</html>