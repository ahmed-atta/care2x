<?php /* Smarty version 2.6.18, created on 2007-06-20 13:42:49
         compiled from ../templates/default/custom_fields/details.tpl */ ?>
<FORM name="frmpost" ACTION="index.php?module=custom_fields&view=save&submit=<?php echo $_GET['submit']; ?>
"
 METHOD="POST" onsubmit="return frmpost_Validator(this)">


<?php if ($_GET['action'] == 'view'): ?>

	<h3><?php echo $this->_tpl_vars['LANG']['custom_fields']; ?>
 ::
	<a href="index.php?module=custom_fields&view=details&submit=<?php echo $this->_tpl_vars['cf']['cf_id']; ?>
&action=edit"><?php echo $this->_tpl_vars['LANG']['edit']; ?>
</a></h3>
	<hr />


	
	<table align="center">
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['id']; ?>
</td><td><?php echo $this->_tpl_vars['cf']['cf_id']; ?>
</td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['custom_field_db_field_name']; ?>
</td>
		<td><?php echo $this->_tpl_vars['cf']['cf_custom_field']; ?>
</td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['custom_field']; ?>
</td>
		<td><?php echo $this->_tpl_vars['cf']['name']; ?>
</td>
	</tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['custom_label']; ?>
</td>
		<td><?php echo $this->_tpl_vars['cf']['cf_custom_label']; ?>
</td>
	</tr>
	</table>
	<hr></hr>


<a href="index.php?module=custom_fields&view=details&submit=<?php echo $this->_tpl_vars['cf']['cf_id']; ?>
&action=edit"><?php echo $this->_tpl_vars['LANG']['edit']; ?>
</a>

<?php endif; ?>

<?php if ($_GET['action'] == 'edit'): ?>

	<b><?php echo $this->_tpl_vars['LANG']['custom_fields']; ?>
</b>

	<hr></hr>

	<table align="center">
        <tr>
                <td class="details_screen"><?php echo $this->_tpl_vars['LANG']['id']; ?>
</td><td><?php echo $this->_tpl_vars['cf']['cf_id']; ?>
</td>
        </tr>
        <tr>
                <td class="details_screen"><?php echo $this->_tpl_vars['LANG']['custom_field_db_field_name']; ?>
</td>
                <td><?php echo $this->_tpl_vars['cf']['cf_custom_field']; ?>
</td>
        </tr>
        <tr>
                <td class="details_screen"><?php echo $this->_tpl_vars['LANG']['custom_field']; ?>
</td>
                <td><?php echo $this->_tpl_vars['cf']['name']; ?>
</td>
        </tr>
	<tr>
		<td class="details_screen"><?php echo $this->_tpl_vars['LANG']['custom_label']; ?>
</td>
		<td><input type="text" name="cf_custom_label" size="50" value="<?php echo $this->_tpl_vars['cf']['cf_custom_label']; ?>
" /></td>
	</tr>
	</table>
	<hr></hr>



<input type="submit" name="cancel" value="<?php echo $this->_tpl_vars['LANG']['cancel']; ?>
" />
<input type="submit" name="save_custom_field" value="<?php echo $this->_tpl_vars['LANG']['save_custom_field']; ?>
" />
<input type="hidden" name="op" value="edit_custom_field" />

<?php endif; ?>



</form>