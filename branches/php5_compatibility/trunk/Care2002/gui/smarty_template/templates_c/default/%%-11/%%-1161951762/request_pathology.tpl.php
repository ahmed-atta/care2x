<?php /* Smarty version 2.6.0, created on 2004-07-06 23:16:13
         compiled from laboratory/request_pathology.tpl */ ?>


<!-- This is a temporary local css, will be discarded once a global template is implemented -->
<style type="text/css">
div.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10;}
div.fa2_ml10 {font-family: arial; font-size: 12; margin-left: 10;}
div.fva2_ml3 {font-family: verdana; font-size: 12; margin-left: 3; }
div.fa2_ml3 {font-family: arial; font-size: 12; margin-left: 3; }
.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000099;}
.fva2b_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000000;}
.fva0_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#000099;}
.fvag_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#969696;}
.lmargin {margin-left: 5;}
<?php echo $this->_tpl_vars['css_lab']; ?>

</style>

<?php echo $this->_tpl_vars['js_noresize']; ?>


<ul>

<?php if ($this->_tpl_vars['edit']): ?>
	<?php echo $this->_tpl_vars['form_headers']; ?>

<?php else: ?>
	<?php if ($this->_tpl_vars['show_selectprompt']): ?>

<table border=0>
  <tr>
    <td valign="bottom"><?php echo $this->_tpl_vars['imgAngledown']; ?>
</td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b><?php echo $this->_tpl_vars['LDPlsSelectPatientFirst']; ?>
</b></font></td>
    <td><?php echo $this->_tpl_vars['imgMascot']; ?>
</td>
  </tr>
</table>
	<?php endif;  endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "forms/pathology.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<p>

<?php echo $this->_tpl_vars['form_footers']; ?>


</ul>