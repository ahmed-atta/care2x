<div id="manager-actions">
    <span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Action"));?>: &nbsp;</span>
    <a class="action save" href="javascript:formSubmit('frmUser','submitted',1,1)"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Save"));?></a>
    <a class="action cancel" href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("","account","user"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Cancel"));?></a>
</div>
<div id="content">
    <div id="content-header">
        <h2><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->pageTitle));?></h2>
        <div class="message"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'msgGet'))) echo htmlspecialchars($t->msgGet());?></div>
    </div>
    <form action="" method="post" name="frmUser" id="frmUser">
        <fieldset class="inside">
            <input name="action" type="hidden" value="updateAll" />
            <p>
                <label class="tipOwner"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Theme"));?>
                    <span class="tipText"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Change what this site looks like"));?></span>
                </label>
                <select name="prefs[theme]">
                    <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->aThemes,$t->prefs['theme']);?>
                </select>
            </p>
            <p>
                <label class="tipOwner"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Date format"));?>
                    <span class="tipText"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("UK format is dd/mm/yyyy and US is mm/dd/yyyy"));?></span>
                </label>
                <select name="prefs[dateFormat]">
                    <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->aDateFormats,$t->prefs['dateFormat']);?>
                </select>
            </p>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Interface language"));?></label>
                <select name="prefs[language]">
                    <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->aLangs,$t->prefs['language']);?>
                </select>
            </p>
            <p>
                <label class="tipOwner"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Session timeout"));?>
                    <span class="tipText"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Session timeout tooltip"));?></span>
                </label>
                <select name="prefs[sessionTimeout]">
                    <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->aTimeouts,$t->prefs['sessionTimeout']);?>
                </select>
            </p>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Locale"));?></label>
                <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'isWin'))) if ($t->isWin()) { ?>
                <input type="text" name="prefs[locale]" value="<?php echo htmlspecialchars($t->prefs['locale']);?>">
                <?php } else {?>
                <select name="prefs[locale]">
                    <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->aLocales,$t->prefs['locale']);?>
                </select>
                <?php }?>
            </p>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Timezone"));?></label>
                <select name="prefs[timezone]"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->aTimezones,$t->prefs['timezone']);?></select>
            </p>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Results per page"));?></label>
                <select name="prefs[resPerPage]"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->aResPerPage,$t->prefs['resPerPage']);?></select>
            </p>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Show execution times?"));?></label>
                <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateRadioPair'))) echo $t->generateRadioPair("prefs[showExecutionTimes]",$t->prefs['showExecutionTimes']);?>
            </p>
        </fieldset>
    </form>
    <div class="spacer"></div>
</div>
