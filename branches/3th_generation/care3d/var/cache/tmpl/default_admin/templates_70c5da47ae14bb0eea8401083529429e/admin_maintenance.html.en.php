<div id="content">
    <div id="content-header">
        <h2><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->pageTitle));?> <?php if ($t->module->module_id)  {?><span><?php echo htmlspecialchars($t->module->title);?></span><?php }?></h2>
        <div class="message"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'msgGet'))) echo htmlspecialchars($t->msgGet());?></div>
    </div>

    <form name="checkLatestVersion" action="" method="post" id="checkLatestVersion">
        <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Check for Latest Version"));?></h3>
        <fieldset class="inside">
            <p class="center">
                <input type="hidden" name="action" value="checkLatestVersion" />
                <input type="submit" class="sgl-button" name="checkLatestVersion" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Check Now"));?>" />
            </p>
        </fieldset>
    </form>

    <form name="dataobjects" method="post" id="dataobjects">
        <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Rebuild Data Objects"));?></h3>
        <fieldset class="inside">
            <p class="center">
                <input type="hidden" name="action" value="dbgen" />
                <input type="submit" class="sgl-button" name="dbgen" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Rebuild Dataobjects Now"));?>" />
            </p>
        </fieldset>
    </form>

    <form name="sequences" method="post" id="sequences">
        <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Rebuild DB Sequences"));?></h3>
        <fieldset class="inside">
            <p class="center">
                <input type="hidden" name="action" value="rebuildSequences" />
                <input type="submit" class="sgl-button" name="submit" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Rebuild Sequences Now"));?>" />
            </p>
        </fieldset>
    </form>

    <form name="caches" method="post" id="caches">
        <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Manage Caches"));?></h3>
        <fieldset class="inside">
            <p class="center">
                <input type="hidden" name="action" value="clearCache" />
                <input type="checkbox" name="frmCache[blocks]" value="1" /><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("blocks","ucfirst"));?>
                <input type="checkbox" name="frmCache[categorySelect]" value="1" /><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Categories","ucfirst"));?>
                <input type="checkbox" name="frmCache[nav]" value="1" /><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("navigation","ucfirst"));?>
                <input type="checkbox" name="frmCache[pear]" value="1" /><acronym>PEAR</acronym>
                <input type="checkbox" name="frmCache[perms]" value="1" /><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Permissions","ucfirst"));?>
                <input type="checkbox" name="frmCache[templates]" value="1" /><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Templates","ucfirst"));?>
                <input type="checkbox" name="frmCache[translations]" value="1" /><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("translations","ucfirst"));?>
                <input type="checkbox" name="frmCache[uri]" value="1" /><acronym>URI</acronym>
            </p>
            <div class="center">
                <input type="checkbox" name="checkAll" id="checkAll" onClick="javascript:applyToAllCheckboxes('caches', false, this.checked)" />
                <label for="checkAll"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("select all","ucfirst"));?></label>
            </div>
            <div class="center">
                <?php if ($t->error['nothingChecked'])  {?><p class="error">
                    <?php echo htmlspecialchars($t->error['nothingChecked']);?>
                </p><?php }?>
                <input type="submit" class="sgl-button" name="submitted" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Clear Selected Caches Now"));?>" />
            </div>
        </fieldset>
    </form>

    <form method="post" action="">
        <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Delete cached configs"));?></h3>
        <fieldset class="hide">
            <input type="hidden" name="action" value="deleteConfigs" />
        </fieldset>
        <fieldset class="inside">
            <p class="center">
                <input class="sgl-button" type="submit" name="submit" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Delete"));?>" />
            </p>
        </fieldset>
    </form>

    <form name="rebuildSeagull" method="post" id="rebuildSeagull">
        <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Rebuild Seagull"));?></h3>
        <fieldset class="inside">
            <p class="center">
                <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("WARNING: This will drop your database"));?>
            </p>
            <div class="center">
                <input type="hidden" name="action" value="rebuildSeagull" />
                <input type="submit" class="sgl-button" name="submit" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Rebuild Seagull"));?>" />
                <input type="checkbox" name="frmSampleData" id="sampleData" value="1" />
                <label for="sampleData"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("with sample data"));?></label>
            </div>
        </fieldset>
    </form>
    <div class="spacer"></div>
</div>
