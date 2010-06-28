<?php /* Smarty version 2.6.22, created on 2010-03-11 18:03:16
         compiled from nursing/ward_occupancy.tpl */ ?>

<?php echo $this->_tpl_vars['sWarningPrompt']; ?>

<table cellspacing="0" cellpadding="0" width="100%">
  <tbody>
    <tr valign="top">
      <td><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "nursing/ward_occupancy_list.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
      <td align="right"><?php echo $this->_tpl_vars['sSubMenuBlock']; ?>
</td>
    </tr>
  </tbody>
</table>
 <p>
 <?php echo $this->_tpl_vars['pDiagnosis']; ?>

 <p>
 <?php echo $this->_tpl_vars['pLabs']; ?>

 <p>
 <?php echo $this->_tpl_vars['pPrescriptions']; ?>
 | <?php echo $this->_tpl_vars['pProcedures']; ?>
 | <?php echo $this->_tpl_vars['pConsumables']; ?>

 <p>
 <?php echo $this->_tpl_vars['pRadio']; ?>

 <p>
 <?php echo $this->_tpl_vars['pbClose']; ?>

<br>
<?php echo $this->_tpl_vars['sOpenWardMngmt']; ?>

</p>