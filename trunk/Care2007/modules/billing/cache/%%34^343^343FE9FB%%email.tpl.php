<?php /* Smarty version 2.6.18, created on 2007-06-01 12:57:21
         compiled from ../templates/default/invoices/email.tpl */ ?>
<?php if ($_GET['stage'] == 1): ?>

<form name="frmpost" ACTION="index.php?module=invoices&view=email&stage=2&submit=<?php echo $_GET['submit']; ?>
" METHOD="post">
<div id="top"><b>Email Invoice to Customer as PDF</b></div>
<hr />
<table align=center>
	<tr>
		<td class="details_screen">From<a
		href="docs.php?p=email_from&t=help"
		rel="gb_page_center[450, 450]"><img
		src="./images/common/help-small.png"></img></a></td>
		<td><input type=text name="email_from" size=50 value="<?php echo $this->_tpl_vars['biller']['email']; ?>
" ></td>
	</tr>
	<tr>
		<td class="details_screen">To<a
		href="docs.php?t=help&p=email_to"
		rel="gb_page_center[450, 450]"><img
		src="./images/common/help-small.png"></img></a></td>
		<td><input type=text name="email_to" size=50 value="<?php echo $this->_tpl_vars['customer']['email']; ?>
" ></td>
	</tr>
	<tr>
	<td class="details_screen">BCC<a
		href="docs.php?t=help&p=email_bcc"
		rel="gb_page_center[450, 450]"><img
		src="./images/common/help-small.png"></img></a></td>
	<td><input type=text name="email_bcc" size=50 value="<?php echo $this->_tpl_vars['biller']['email']; ?>
"></td>
	</tr>
	<tr>
	<td class="details_screen">Subject</td>
	<td><input type=text name="email_subject" size=50 value="<?php echo $this->_tpl_vars['preferences']['pref_inv_wording']; ?>
 <?php echo $this->_tpl_vars['invoice']['id']; ?>
 from <?php echo $this->_tpl_vars['biller']['name']; ?>
 is attached"></td>
	</tr>
	<tr>
		<td class="details_screen">Message</td>
		<td><textarea name='email_notes' rows=8 cols=50></textarea></td>
	</tr>
</table>
<hr></hr>
<input type=submit name="submit" value="<?php echo $this->_tpl_vars['LANG']['email']; ?>
">
<input type=hidden name="op" value="insert_customer">
</form>
<?php endif; ?>

<?php if ($_GET['stage'] == 2): ?>

<div id="top"></b></div>

<table align=center>
</table>

<?php endif; ?>