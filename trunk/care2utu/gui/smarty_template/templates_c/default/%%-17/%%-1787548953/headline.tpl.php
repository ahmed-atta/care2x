<?php /* Smarty version 2.6.0, created on 2008-05-20 20:25:34
         compiled from news/headline.tpl */ ?>

<TABLE CELLSPACING=3 cellpadding=0 border="0" width="<?php echo $this->_tpl_vars['news_normal_display_width']; ?>
">

	<tr>
		<td VALIGN="top" width="100%">

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "news/headline_newslist.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		</td>
		<!--      Vertical spacer column      -->
		<TD   width=1  background="../../gui/img/common/biju/vert_reuna_20b.gif">&nbsp;</TD>

		<TD VALIGN="top">

			<?php echo $this->_tpl_vars['sSubMenuBlock']; ?>


		</TD>
	</tr>
</table>