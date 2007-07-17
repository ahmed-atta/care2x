<div id="manager-actions">
    <span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Action"));?>: &nbsp;</span>
    <a class="action save" href="javascript:formSubmit('frmBlockEdit','submitted',1,1)"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Save"));?></a>
    <a class="action cancel" href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("list","block","block"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Cancel"));?></a>
</div>
<div id="content">
    <div id="content-header">
        <h2><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->pageTitle));?> :: <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->mode));?></h2>
        <div class="message"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'msgGet'))) echo htmlspecialchars($t->msgGet());?></div>
    </div>
    <form action="" method="post" name="frmBlockEdit" id="frmBlockEdit">
        <div id="optionsLinks"></div>
        <fieldset class="options" id="blockEditContent">
            <input type="hidden" name="mode" value="<?php echo htmlspecialchars($t->mode);?>" />
            <input type="hidden" name="block[edit]" value="1" />
        <?php if ($t->isAdd)  {?>
            <input type="hidden" name="action" value="insert" />
            <input type="hidden" name="isadd" value="1" />
        <?php } else {?>
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="block[block_id]" value="<?php echo htmlspecialchars($t->block->block_id);?>" />
        <?php }?>
            <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Block Details"));?></h3>
            <p>
                <label class="tipOwner" for="block[title]"><span class="required">*</span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Display Title"));?>
                    <span class="tipText"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Block title tooltip"));?></span>
                </label>
                <?php if ($t->error['title'])  {?><span class="error"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->error['title']));?></span><?php }?>
                <input type="text" name="block[title]" id="block[title]" value="<?php echo htmlspecialchars($t->block->title);?>" />
            </p>
            <p>
                <label class="tipOwner" for="block[name]"><span class="required">*</span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Block Class Name"));?>
                    <span class="tipText"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Block class name tooltip"));?></span>
                </label>
                <?php if ($t->error['name'])  {?><span class="error"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->error['name']));?></span><?php }?>
                <select name="block[name]" id="block[name]" onchange="document.frmBlockEdit.submit()">
                    <option value="">- <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Choose class name"));?> -</option>
                    <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->aAllBlocks,$t->block->name);?>
                </select>
            </p>
            <p>
                <?php if ($t->details->name)  {?><label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Block name"));?></label><?php }?>
                <span><?php echo htmlspecialchars($t->details->name);?></span>
            </p>
            <p>
                <?php if ($t->details->description)  {?><label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Block description"));?></label><?php }?>
                <span><?php echo htmlspecialchars($t->details->description);?></span>
            </p>
            <p>
                <label for="block[title_class]"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Title class"));?></label>
                <input type="text" name="block[title_class]" id="block[title_class]" value="<?php echo htmlspecialchars($t->block->title_class);?>" />
            </p>
            <p>
                <label for="block[body_class]"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Body class"));?></label>
                <input type="text" name="block[body_class]" id="block[body_class]" value="<?php echo htmlspecialchars($t->block->body_class);?>" />
            </p>
            <?php if ($t->checked)  {?><p>
                <label for="block[is_enabled]"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Status"));?></label>
                <input type="checkbox" name="block[is_enabled]" id="block[is_enabled]" <?php echo htmlspecialchars($t->blockIsEnabled);?> /><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("check to activate"));?>
            </p><?php }?>
            <p>
                <label for="block[is_cached]"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Cache status"));?></label>
                <input type="checkbox" name="block[is_cached]" id="block[is_cached]" <?php echo htmlspecialchars($t->blockIsCached);?> /><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("check to cache block content"));?>
            </p>
            <p>
                <span class="required">*</span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("denotes required field"));?>
            </p>
        </fieldset>
        <?php if ($t->aParams)  {?><fieldset class="options" id="blockParamOptions">
            <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Block Parameters"));?></h3>
            <?php 
$x = new HTML_Template_Flexy($this->options);
$x->compile('admin_editParams.html');
$_t = function_exists('clone') ? clone($t) : $t;
foreach(get_defined_vars()  as $k=>$v) {
    if ($k != 't') { $_t->$k = $v; }
}
$x->outputObject($_t, $this->elements);
?>
        </fieldset><?php }?>
        <fieldset class="options" id="blockEditOptions">
            <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Publishing"));?></h3>
            <p>
                <label for="block[position]"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Position"));?></label>
                <select name="block[position]" id="block[position]">
                    <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->aBlocksNames,$t->block->position);?>
                </select>
            </p>
            <p>
                <label for="block[sections]"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Sections"));?></label>
                <select name="block[sections][]" id="block[sections]" multiple="multiple" size="15">
                    <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->aSections,$t->block->sections,1);?>
                </select>
            </p>
            <p>
                <label for="block[roles]"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Can view"));?></label>
                <select name="block[roles][]" id="block[roles]" multiple="multiple" size="5">
                    <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->aRoles,$t->block->roles,1);?>
                </select>
            </p>
        </fieldset>
    </form>
    <div class="spacer"></div>
</div>
<script type="text/javascript">
createAvailOptionsLinks('frmBlockEdit','h3');
showSelectedOptions('frmBlockEdit','blockEditContent')
</script>
