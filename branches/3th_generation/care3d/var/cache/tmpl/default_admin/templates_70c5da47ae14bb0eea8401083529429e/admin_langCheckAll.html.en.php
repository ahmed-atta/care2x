<div id="manager-actions">
    <span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Action"));?>:&nbsp;</span>
    <a class="action cancel" href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("","translation","default"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Cancel"));?></a>
</div>
<div id="content">
    <div id="content-header">
        <h2><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->pageTitle));?></h2>
        <div class="message"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'msgGet'))) echo htmlspecialchars($t->msgGet());?></div>
    </div>
    <form name="translation_list" action="" method="post" id="translation_list">
        <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Check all modules for"));?> <?php echo htmlspecialchars($t->currentLangName);?></h3>
        <fieldset class="noBorder">
            <input type="hidden" name="action" value="checkAllModules" />
            <p>
                <select name="frmCurrentLang"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->aLangs,$t->currentLang);?></select>
                <input type="submit" class="sgl-button" name="submitted" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("check all modules"));?>" />
            </p>
            <table class="medium">
                <thead>
                    <tr>
                        <th width="30%" class="left"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Module Name"));?></th>
                        <th width="30%" class="left"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Status"));?></th>
                        <th width="40%" class="left">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($this->options['strict'] || (is_array($t->modules)  || is_object($t->modules))) foreach($t->modules as $k => $v) {?><tr>
                        <td class="left"><?php echo htmlspecialchars($v['title']);?></td>
                        <td class="left"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($v['status']));?></td>
                        <td class="left">
                        <?php if ($v['diff'])  {?>
                            <input type="button" class="sgl-button narrow" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("update"));?>" onclick="javascript:document.location.href='<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("verify","translation","default"));?>frmCurrentModule/<?php echo htmlspecialchars($k);?>/frmCurrentLang/<?php echo htmlspecialchars($t->currentLang);?>/'" />
                        <?php }?>
                        <?php if ($v['edit'])  {?>
                            <input type="button" class="sgl-button narrow" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("edit"));?>" onclick="javascript:document.location.href='<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("edit","translation","default"));?>frmCurrentModule/<?php echo htmlspecialchars($k);?>/frmCurrentLang/<?php echo htmlspecialchars($t->currentLang);?>/'" />
                        <?php }?>
                        <?php if ($v['msg'])  {?>
                            <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($v['msg']));?>
                        <?php echo htmlspecialchars($t->else);?>&nbsp;
                        <?php }?>
                        </td>
                    </tr><?php }?>
                </tbody>
            </table>
        </fieldset>
    </form>
    <div class="spacer"></div>
</div>
