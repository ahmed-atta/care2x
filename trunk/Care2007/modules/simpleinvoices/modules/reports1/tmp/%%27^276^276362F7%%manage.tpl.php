<?php /* Smarty version 2.6.18, created on 2007-05-29 15:03:13
         compiled from ../templates/default/system_defaults/manage.tpl */ ?>

<h3><?php echo $this->_tpl_vars['LANG']['system_defaults']; ?>
</h3>
    <hr />

	
	<table align=center>
	<tr>
		<td class='details_screen'><a href='index.php?module=system_defaults&view=edit&submit=biller'><?php echo $this->_tpl_vars['LANG']['edit']; ?>
</a></td><td class='details_screen'><?php echo $this->_tpl_vars['LANG']['biller']; ?>
</td><td><?php echo $this->_tpl_vars['defaultBiller']['name']; ?>
</td>
	</tr>
	<tr>
		<td class='details_screen'><a href='index.php?module=system_defaults&view=edit&submit=customer'><?php echo $this->_tpl_vars['LANG']['edit']; ?>
</a></td><td class='details_screen'><?php echo $this->_tpl_vars['LANG']['customer']; ?>
</td><td><?php echo $this->_tpl_vars['defaultCustomer']['name']; ?>
</td>
	</tr>
	<tr>
		<td class='details_screen'><a href='index.php?module=system_defaults&view=edit&submit=tax'><?php echo $this->_tpl_vars['LANG']['edit']; ?>
</a></td><td class='details_screen'><?php echo $this->_tpl_vars['LANG']['tax']; ?>
</td><td><?php echo $this->_tpl_vars['defaultTax']['tax_description']; ?>
</td>
	</tr>
	<tr>
		<td class='details_screen'><a href='index.php?module=system_defaults&view=edit&submit=preference_id'><?php echo $this->_tpl_vars['LANG']['edit']; ?>
</a></td><td class='details_screen'><?php echo $this->_tpl_vars['LANG']['inv_pref']; ?>
</td><td><?php echo $this->_tpl_vars['defaultPreference']['pref_description']; ?>
</td>
	</tr>
	<tr>
		<td class='details_screen'><a href='index.php?module=system_defaults&view=edit&submit=line_items'><?php echo $this->_tpl_vars['LANG']['edit']; ?>
</a></td><td class='details_screen'><?php echo $this->_tpl_vars['LANG']['default_number_items']; ?>
</td><td><?php echo $this->_tpl_vars['defaults']['line_items']; ?>
</td>
	</tr>
	<tr>
		<td class='details_screen'><a href='index.php?module=system_defaults&view=edit&submit=def_inv_template'><?php echo $this->_tpl_vars['LANG']['edit']; ?>
</a></td><td class='details_screen'><?php echo $this->_tpl_vars['LANG']['default_inv_template']; ?>
</td><td><?php echo $this->_tpl_vars['defaults']['template']; ?>
</td>
	</tr>
	<tr>
		<td class='details_screen'><a href='index.php?module=system_defaults&view=edit&submit=def_payment_type'><?php echo $this->_tpl_vars['LANG']['edit']; ?>
</a></td><td class='details_screen'><?php echo $this->_tpl_vars['LANG']['default_payment_type']; ?>
</td><td><?php echo $this->_tpl_vars['defaultPaymentType']['pt_description']; ?>
</td>
	</tr>
        </table>
        