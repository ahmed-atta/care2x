<div id="content">
    <div id="content-header">
        <h2><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->pageTitle));?> <?php if ($t->module->module_id)  {?><span><?php echo htmlspecialchars($t->module->title);?></span><?php }?></h2>
        <div class="message"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'msgGet'))) echo htmlspecialchars($t->msgGet());?></div>
    </div>
    <form name="translations" action="" method="post" id="translations">
        <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Manage Translations"));?></h3>
        <fieldset class="inside">
            <p class="center">
                <select name="frmCurrentModule"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->aModules,$t->currentModule);?></select>
                <select name="frmCurrentLang"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->aLangs,$t->currentLang);?></select>
            </p>
            <p class="center">
                <?php if ($t->error['noSelection'])  {?><div class="error">
                    <?php echo htmlspecialchars($t->error['noSelection']);?>
                </div><?php }?>
                <input type="radio" name="action" value="verify" <?php echo htmlspecialchars($t->isValidate);?> /><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("validate"));?>
                <input type="radio" name="action" value="edit" <?php echo htmlspecialchars($t->isEdit);?> /><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("edit"));?>
                <input type="radio" name="action" value="checkAllModules" /><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("check all modules"));?>
                <input type="submit" class="sgl-button" name="submitted" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Process"));?>" />
            </p>
        </fieldset>
    </form>
    <div class="spacer"></div>
</div>
