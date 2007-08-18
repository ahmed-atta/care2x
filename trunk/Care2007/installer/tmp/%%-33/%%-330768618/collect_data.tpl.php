<?php /* Smarty version 2.6.0, created on 2007-08-16 17:57:04
         compiled from C:%5Cwamp%5Cwww%5CCare2007%5Cinstaller/templates/collect_data.tpl */ ?>
<form action="<?php echo $GLOBALS['HTTP_SERVER_VARS']['PHP_SELF']; ?>
" method="POST">
<table id="fields" align="center" border=0 cellspacing=0 cellpadding=0>
<?php echo $this->_tpl_vars['FORM_FIELDS']; ?>

<tr>
    <td id="field_save"><input id="button" type="submit" value="Save"></td>
    <td id="field_reset"><input id="button" type="reset" value="Reset"></td>
</tr>
</table>
</form>