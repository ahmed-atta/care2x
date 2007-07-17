<div id="manager-actions">
    <span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Action"));?>:&nbsp;</span>
    <a class="action save" href="javascript:formSubmit('translations','submitted',1,1)"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Save"));?></a>
    <a class="action cancel" href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("","translation","default"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Cancel"));?></a>
</div>
<div id="content">
    <div id="content-header">
        <h2><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->pageTitle));?></h2>
        <div class="message"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'msgGet'))) echo htmlspecialchars($t->msgGet());?></div>
    </div>

    <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("You are updating: Module"));?> "<?php echo htmlspecialchars($t->currentModuleName);?>"</h3>

    <fieldset class="inside">
        <p><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("The source translation has"));?> <?php echo htmlspecialchars($t->sourceElements);?> <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("elements"));?>.<br />
            <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("The target translation has"));?> <?php echo htmlspecialchars($t->targetElements);?> <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("elements"));?>.</p>
        <p><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Please add"));?> <?php echo htmlspecialchars($t->currentLangName);?> <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("values for the following keys which appear to be missing from the"));?> <?php echo htmlspecialchars($t->currentModule);?> <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("module"));?>:</p>
    </fieldset>

    <form name="translations" action="" method="post" id="translations">
        <input type="hidden" name="action" value="append" />
        <input type="hidden" name="frmCurrentLang" value="<?php echo htmlspecialchars($t->currentLang);?>" />
        <input type="hidden" name="frmCurrentModule" value="<?php echo htmlspecialchars($t->currentModule);?>" />

        <fieldset class="noBorder">
            <table class="full">
                <thead>
                    <tr>
                        <th width="50%" class="left"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Master Value"));?></th>
                        <th width="50%" class="left"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Translated Value"));?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($this->options['strict'] || (is_array($t->aTargetLang)  || is_object($t->aTargetLang))) foreach($t->aTargetLang as $k => $v) {?><tr>
                        <td class="left"><?php echo htmlspecialchars($v);?></td>
                        <td class="left">
                            <input type="text" name="translation[<?php echo htmlspecialchars($k);?>]" value="" size="50" />
                        </td>
                    </tr><?php }?>
                </tbody>
            </table>
            <input type="submit" class="sgl-button" name="save" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Save Translation"));?>" />
            <input type="button" class="sgl-button" name="back" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Cancel"));?>" onclick="document.location.href='<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("","translation","default"));?>'" />
        </fieldset>
    </form>
    <div class="spacer"></div>
</div>
