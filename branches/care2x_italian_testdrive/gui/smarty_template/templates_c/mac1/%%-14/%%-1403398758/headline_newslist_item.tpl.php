<?php /* Smarty version 2.6.0, created on 2004-07-03 16:05:56
         compiled from news/headline_newslist_item.tpl */ ?>

<img <?php echo $this->_tpl_vars['sHeadlineImg']; ?>
 align="left" border=0 hspace=10 <?php echo $this->_tpl_vars['sImgWidth']; ?>
>
<?php echo $this->_tpl_vars['sHeadlineItemTitle']; ?>


<?php if ($this->_tpl_vars['sPreface']): ?>
	<br>
	<?php echo $this->_tpl_vars['sPreface']; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['sNewsPreview']): ?>
	<p>
	<?php echo $this->_tpl_vars['sNewsPreview']; ?>

<?php endif; ?>

<br>
<font size=1><?php echo $this->_tpl_vars['sEditorLink']; ?>
</font>