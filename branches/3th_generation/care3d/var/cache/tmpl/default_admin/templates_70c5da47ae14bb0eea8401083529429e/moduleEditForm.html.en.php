<dl class="onSide">
    <dt>
        <label class="tipOwner" for="module_name"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Name"));?>
            <span class="tipText"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("The name of the module must be the exact name of the folder containing files, beware of case sensitivity"));?></span>
        </label>
    </dt>
    <dd>
        <?php if ($t->error['name'])  {?><div class="error"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->error['name']));?></div><?php }?>
        <input type="text" class="text" name="module[name]" id="module_name" value="<?php echo htmlspecialchars($t->module->name);?>" />
    </dd>
    <dt>
        <label class="tipOwner" for="module[title"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Title"));?>
            <span class="tipText"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Here you can write what you want"));?></span>
        </label>
    </dt>
    <dd>
        <?php if ($t->error['title'])  {?><div class="error"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->error['title']));?></div><?php }?>
        <input type="text" class="text" name="module[title]" id="module_title" value="<?php echo htmlspecialchars($t->module->title);?>" />
    </dd>
    <dt>
        <label for="module_description"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Description"));?></label>
    </dt>
    <dd>
        <?php if ($t->error['description'])  {?><div class="error"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->error['description']));?></div><?php }?>
        <textarea class="longText" name="module[description]" id="module_description"><?php echo htmlspecialchars($t->module->description);?></textarea>
    </dd>
    <dt>
        <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Icon"));?></label>
    </dt>
    <dd>
        <span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Simply provide an icon"));?></span>
    </dd>
</dl>
