<?php if (!defined('INSTALLER_PATH')) { header('Location: index.php'); exit; } ?>

	<br />
	<br />

	<table class="install_block">
		<tr>
			<td align="left"><input type="submit" name="submit" value="Start Over" style="width:128px;" class="navlink" /></td>
			<td align="center"><input type="submit" name="submit" value="Refresh" style="width:128px;" class="navlink" /></td>
			<td align="right" nowrap="nowrap">
				<input type="submit" name="submit" style="width:72px;" value="&lt; Back" class="navlink" />
				&nbsp;&nbsp;&nbsp;
				<input type="submit" name="submit" style="width:72px;" value="Next &gt;" class="navlink" />
			</td>
		</tr>
	</table>

</form>
</div>

<div class="footer">
	<table width="100%" border=0 cellpadding=0 cellspacing=0>
		<tr>
			<td>
				<a href="http://www.care2x.org/">Care2x Home</a> :: 
				<a href="http://www.care2x.org/wiki/">Wiki</a> :: 
				<a href="http://sourceforge.net/mailarchive/forum.php?forum_id=11772">Mailing List</a> :: 
				<a href="http://sourceforge.net/projects/care2002/">SF.net Project</a>
				<br />
				Copyright 2002-2006 Elpidio Latorilla, 2006 Brian Zablocky
			</td>
			<td align="right" valign="bottom">
				Portions derived from <a href="http://www.mirrormed.org">MirrorMed</a> installer
			</td>
		</tr>
	</table>
</div>


</html>
	
<?php
	if (DEBUG)
	{
		print '<pre>' . htmlspecialchars(print_r($GLOBALS, true)) . '</pre>';
	}
?>