<tr><td>&nbsp;</td></tr>
<table align="center">
{if $loop != 3}
<tr><td align="center">Choose optional database files for installation:</td></tr>
<table align="center">
{foreach name=sqloptions from=$files key=name item=file}
<tr><td align="left"><input id="radio" type="radio" name="optfile" value="{$file}"
{if $smarty.foreach.sqloptions.first} checked{/if}
>{$name}</td></tr>
{/foreach}
</table>
<tr><td>&nbsp;</td></tr>
<tr><td align="center"><input id="button" type="submit" name="install_sql" value="Install File">&nbsp;&nbsp;
<input id="button" type="submit" name="install_sql_done" value="Done"></td></tr>
{else if $loop == 3}
<tr><td align="center">The database file is being installed.</td></tr>
<tr><td align="center"><img src="images/animated_progress.gif"/></td></tr>
{/if}
</table>

