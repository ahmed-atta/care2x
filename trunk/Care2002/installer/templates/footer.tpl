</table>		{if $FINISHED}
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

	<div id="footer">
		Copyright  2002-2006 Elpidio Latorilla
	</div>
</body>
</html>
