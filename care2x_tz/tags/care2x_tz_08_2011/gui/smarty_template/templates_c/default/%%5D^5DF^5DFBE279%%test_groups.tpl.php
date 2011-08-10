<?php /* Smarty version 2.6.22, created on 2010-08-24 08:06:36
         compiled from laboratory/test_groups.tpl */ ?>
	
<ul>
<table cellspacing=0 cellpadding=0 class="frame">
  <tbody>
    <tr>
    <td style="color:white; background-color: red; font-weight:bold;" align="left"><?php echo $this->_tpl_vars['LDGroup']; ?>
</td>
      <td style="color:white; background-color: red; font-weight:bold;" align="right">
		&nbsp;
		<?php echo $this->_tpl_vars['sGroupNew']; ?>

	  </td>
    </tr>
    <tr>
      <td colspan=2>
	     <table border="0" cellpadding=2 cellspacing=1>
			<tbody>
				<?php echo $this->_tpl_vars['sTestGroupsRows']; ?>

			</tbody>
			</table>
	  </td>
    </tr>
  </tbody>
</table>
<?php echo $this->_tpl_vars['sShortHelp']; ?>

</ul>