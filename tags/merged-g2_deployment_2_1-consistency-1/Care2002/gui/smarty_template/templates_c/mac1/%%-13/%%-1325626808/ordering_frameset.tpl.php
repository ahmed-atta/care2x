<?php /* Smarty version 2.6.0, created on 2004-07-05 00:07:26
         compiled from products/ordering_frameset.tpl */ ?>

<frameset rows="33,*">
  <frame name="BHEADER" <?php echo $this->_tpl_vars['sHeaderSource']; ?>
 scrolling="no" frameborder="yes" >
  <frameset cols="50%,*">
	<frame name="BESTELLKORB" <?php echo $this->_tpl_vars['sBasketSource']; ?>
 scrolling="auto" frameborder="yes">
     <frame name="BESTELLKATALOG" <?php echo $this->_tpl_vars['sCatalogSource']; ?>
 scrolling="auto" frameborder="yes">
  </frameset>
</frameset>