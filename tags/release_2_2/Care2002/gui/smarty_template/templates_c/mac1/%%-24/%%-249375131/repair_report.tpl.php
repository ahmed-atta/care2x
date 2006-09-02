<?php /* Smarty version 2.6.0, created on 2004-07-06 23:44:04
         compiled from tech/repair_report.tpl */ ?>

<ul>
<div class="prompt"><?php echo $this->_tpl_vars['sButton']; ?>
 <?php echo $this->_tpl_vars['LDRepairReport']; ?>
 <font size="2"><?php echo $this->_tpl_vars['LDPlsDoneOnly']; ?>
</font></div>

<?php echo $this->_tpl_vars['sFormTag']; ?>

	<table cellpadding="5"  border="0" cellspacing=1>
		<tr>
			<td bgcolor=#dddddd >
				<?php echo $this->_tpl_vars['LDRepairArea']; ?>
:<br>
								<input type="text" name="dept" size=30 maxlength=30><p>
				<?php echo $this->_tpl_vars['LDJobIdNr']; ?>
:<br>
								<input type="text" name="job_id" size=30 maxlength=14><br>
			</td>

			<td bgcolor=#dddddd >
				<?php echo $this->_tpl_vars['LDTechnician']; ?>
:<br>
								<input type="text" name="reporter" size=30 ><p>
				<?php echo $this->_tpl_vars['LDPersonnelNr']; ?>
:<br>
								<input type="text" name="id" size=30>
			</td>
		</tr>
		
		<tr>
			<td colspan=2 bgcolor=#dddddd >
				<?php echo $this->_tpl_vars['LDPlsTypeReport']; ?>
<br>
								<TEXTAREA NAME="job" Content-Type="text/html" COLS="60" ROWS="10"></TEXTAREA>
			</td>
		</tr>
	</table>
<p>
<?php echo $this->_tpl_vars['sHiddenInputs']; ?>

&nbsp;
<p>
<?php echo $this->_tpl_vars['pbSubmit']; ?>
 <?php echo $this->_tpl_vars['pbCancel']; ?>

</form>

<p>
<?php echo $this->_tpl_vars['sButton']; ?>
  <?php echo $this->_tpl_vars['sRepairLink']; ?>
<br>
<?php echo $this->_tpl_vars['sButton']; ?>
  <?php echo $this->_tpl_vars['sQuestionLink']; ?>
<br>

</ul>