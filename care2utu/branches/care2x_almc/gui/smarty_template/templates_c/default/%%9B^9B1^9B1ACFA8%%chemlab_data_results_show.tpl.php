<?php /* Smarty version 2.6.22, created on 2009-05-23 10:31:56
         compiled from laboratory/chemlab_data_results_show.tpl */ ?>

<ul>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "laboratory/patient_data_basic.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<p>
	<button onClick="javascript:prep2submit()"><?php echo $this->_tpl_vars['sMakeGraphButton']; ?>
</button>
	<button onClick="javascript:openReport()"><?php echo $this->_tpl_vars['sOpenReport']; ?>
</button>
	</p>
	   <table border=0 class="frame" cellspacing=0 cellpadding=0>
		<tbody>
			<tr>
				<td>
					<?php echo $this->_tpl_vars['sLabResultsTable']; ?>

				</td>
			</tr>
		</tbody>
		</table>
	<p>
	<button onClick="javascript:prep2submit()"><?php echo $this->_tpl_vars['sMakeGraphButton']; ?>
</button> <?php echo $this->_tpl_vars['sClose']; ?>

	</p>
</ul>