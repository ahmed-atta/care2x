    <?php if ($this->options['strict'] || (is_array($t->aParams)  || is_object($t->aParams))) foreach($t->aParams as $valueObj) {?>
        <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'isEqual'))) if ($t->isEqual($valueObj->type,"wysiwyg")) { ?>
            <dl class="on-top">
                <dt><label for="<?php echo htmlspecialchars($valueObj->name);?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($valueObj->label));?></label></dt>
                <dd>
                    <textarea name="<?php echo htmlspecialchars($valueObj->name);?>" id="frmBodyName" class="wysiwyg"><?php echo $valueObj->value;?></textarea>
                </dd>
            </dl>
        <?php } else {?>
            <p>
            <?php if ($valueObj->description)  {?>
                <label for="<?php echo htmlspecialchars($valueObj->name);?>" class="tipOwner"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($valueObj->label));?>
                    <span class="tipText"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($valueObj->description));?></span>
                </label>
            <?php } else {?>
                <label for="<?php echo htmlspecialchars($valueObj->name);?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($valueObj->label));?></label>
            <?php }?>
            <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'isEqual'))) if ($t->isEqual($valueObj->type,"text")) { ?>
                <input type="text" name="<?php echo htmlspecialchars($valueObj->name);?>" id="<?php echo htmlspecialchars($valueObj->name);?>" value="<?php echo htmlspecialchars($valueObj->value);?>" />
            <?php }?>
            <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'isEqual'))) if ($t->isEqual($valueObj->type,"yesno")) { ?>
                <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateRadioPair'))) echo $t->generateRadioPair($valueObj->name,$valueObj->value);?>
            <?php }?>
            </p>
        <?php }?>
    <?php }?>
