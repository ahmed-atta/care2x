</table>		
		{if $FINISHED}
			<div id="install_block">
				<a href="{$APP_URL}">Start using Care2x</a>
			</div>
		{else}
			<table id="install_block">
			<tr>
				<td align="left"><a href="{$smarty.server.PHP_SELF}?restart_installer=true">Restart Installation</a></td>
				{if $CAN_CONTINUE}
				<td align="right"><a href="{$smarty.server.PHP_SELF}?next_step=true">Continue...</a></td>
				{/if}
			</tr>
			</table>
		{/if}
	</div>

	<div class="footer">
		<table width="100%" border=0 cellpadding=0 cellspacing=0>
			<tr>
				<td>
					<p align="center">
					<a href="http://w3.care2x.org/" target='_blank'>Care2x Home</a> :: 
					<a href="http://cgt.altervista.org" target='_blank'>Claudio Giulio Torbinio</a> :: 
					<a href="http://sourceforge.net/projects/care2002/" target='_blank'>SF.net Project</a>
				</td>
				<td align="right" valign="bottom">
					&nbsp;</td>
			</tr>
		</table>
	</div>
</table>
</html>