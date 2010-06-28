<?php /* Smarty version 2.6.22, created on 2009-12-14 16:14:39
         compiled from ambulatory/outpatients.tpl */ ?>

<?php echo $this->_tpl_vars['sWarningPrompt']; ?>


<form method = "post" action = "" name ="discharge_form" onSubmit =" return confSubmit(this)">

<table cellspacing="0" cellpadding="0" width="100%">
<tbody>
	<tr valign="top">
		<td>
			<?php if ($this->_tpl_vars['bShowPatientsList']): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "ambulatory/outpatients_list.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>	
			<p>
			<?php echo $this->_tpl_vars['showDiagnosis']; ?>

			<p>
			<?php echo $this->_tpl_vars['showLabs']; ?>

			<p>
			<?php echo $this->_tpl_vars['showPrescr']; ?>

			<p>
			<?php echo $this->_tpl_vars['showRadio']; ?>

			<p align = "right">
			<?php echo $this->_tpl_vars['LDSelectOutpatients']; ?>
 | <?php echo $this->_tpl_vars['LDUnSelectOutpatients']; ?>

			
			<p align="right">
			<?php echo $this->_tpl_vars['sDischargeSelected']; ?>

			<p align="left">
			<?php echo $this->_tpl_vars['pbClose']; ?>

		</td>
		<td align="right">
			<?php echo $this->_tpl_vars['sSubMenuBlock']; ?>

		</td>
	</tr>
</tbody>
</table>

</form>