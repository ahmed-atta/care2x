<div id="lang-switcher">
<?php if ($this->options['strict'] || (is_array($t->aLangs)  || is_object($t->aLangs))) foreach($t->aLangs as $aLang) {?>
    <?php if ($aLang['image'])  {?><a id="<?php echo htmlspecialchars($aLang['key']);?>" class="langFlag" href="<?php echo htmlspecialchars($aLang['url']);?>" title="speak <?php echo htmlspecialchars($aLang['name']);?> please">
        <img src="<?php echo htmlspecialchars($aLang['image']);?>" alt="speak <?php echo htmlspecialchars($aLang['name']);?> please" /></a><?php }?>
<?php }?>
</div>
