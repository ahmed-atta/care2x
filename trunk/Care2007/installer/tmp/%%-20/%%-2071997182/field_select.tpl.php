<?php /* Smarty version 2.6.0, created on 2007-05-01 16:03:51
         compiled from c:%5Cprogrammi%5Ceasyphp1-8%5Cwww%5Ccare2002%5Cinstaller/templates/field_select.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'c:\programmi\easyphp1-8\www\care2002\installer/templates/field_select.tpl', 5, false),)), $this); ?>
<tr>
    <td id="field_label"><?php echo $this->_tpl_vars['field']->label; ?>
</td>
    <td id="field_value">
        <select name='FIELDS[<?php echo $this->_tpl_vars['field']->name; ?>
]'>
            <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['field']->values,'output' => $this->_tpl_vars['field']->options,'selected' => $this->_tpl_vars['field']->default), $this);?>

        </select>
    </td>
</tr>