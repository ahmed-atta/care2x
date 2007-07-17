<div id="manager-actions">
    <span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Action"));?>: &nbsp;</span>
    <a class="action validate" href="javascript:formSubmit('moduleCreator','submitted',1,1)"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Create Module Now"));?></a>
    <a class="action undo" href="javascript:formReset('moduleCreator')"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Reset"));?></a>
    <a class="action cancel" href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("list","module","default"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Cancel"));?></a>
</div>
<div id="content">
    <div id="content-header">
        <h2><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->pageTitle));?> <?php if ($t->module->module_id)  {?><span><?php echo htmlspecialchars($t->module->title);?></span><?php }?></h2>
        <div class="message"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'msgGet'))) echo htmlspecialchars($t->msgGet());?></div>
    </div>

    <form name="moduleCreator" method="post" id="moduleCreator">
        <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Create a module"));?></h3>
        <fieldset class="inside">
            <p>
                <input type="hidden" name="action" value="createModule" />
            </p>

            <p>
                <label class="tipOwner" for="frmCreateModule[moduleName]"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Module Name"));?>
                <span class="tipText"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Please choose a simple, single word"));?></span></label>
                <?php if ($t->error['moduleName'])  {?><span class="error"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->error['moduleName']));?></span><?php }?>
                <input type="text" name="frmCreateModule[moduleName]" id="frmCreateModule[moduleName]" value="<?php echo htmlspecialchars($t->createModule->moduleName);?>" />
            </p>
            <p>
                <label class="tipOwner" for="frmCreateModule[managerName]"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Manager Name"));?>
                <span class="tipText"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("The manager, which can be"));?></span></label>
                <?php if ($t->error['managerName'])  {?><span class="error"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->error['managerName']));?></span><?php }?>
                <input type="text" name="frmCreateModule[managerName]" id="frmCreateModule[managerName]" value="<?php echo htmlspecialchars($t->createModule->managerName);?>" />
            </p>
            <p>
                <?php if ($t->error['not_writable'])  {?><span class="error"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->error['not_writable']));?></span><?php }?>
            </p>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Add following methods"));?></label>
                <div>
                    <input type="checkbox" name="frmCreateModule[add]" id="frmCreateModule[add]" value="1" /><label for="frmCreateModule[add]">add</label><br />
                    <input type="checkbox" name="frmCreateModule[insert]" id="frmCreateModule[insert]" value="1" /><label for="frmCreateModule[insert]">insert</label><br />
                    <input type="checkbox" name="frmCreateModule[edit]" id="frmCreateModule[edit]" value="1" /><label for="frmCreateModule[edit]">edit</label><br />
                    <input type="checkbox" name="frmCreateModule[update]" id="frmCreateModule[update]" value="1" /><label for="frmCreateModule[update]">update</label><br />
                    <input type="checkbox" name="frmCreateModule[delete]" id="frmCreateModule[delete]" value="1" /><label for="frmCreateModule[delete]">delete</label><br />
                    <input type="checkbox" name="frmCreateModule[list]" id="frmCreateModule[list]" value="1" /><label for="frmCreateModule[list]">list</label>
                </div>
            </p>
            <p>
                <label for="frmCreateModule[createCRUD]"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Create CRUD actions"));?></label>
                <input type="checkbox" name="frmCreateModule[createCRUD]" id="frmCreateModule[createCRUD]" value="1" />
            </p>
            <p>
                <label for="frmCreateModule[createTemplates]"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Create Templates"));?></label>
                <input type="checkbox" name="frmCreateModule[createTemplates]" id="frmCreateModule[createTemplates]" value="1" checked="checked" />
            </p>
            <p>
                <label for="frmCreateModule[createLangFiles]"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Create language files"));?></label>
                <input type="checkbox" name="frmCreateModule[createLangFiles]" id="frmCreateModule[createLangFiles]" value="1" checked="checked" />
            </p>
            <p>
                <label for="frmCreateModule[createIniFile]"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Create ini file"));?></label>
                <input type="checkbox" name="frmCreateModule[createIniFile]" id="frmCreateModule[createIniFile]" value="1" checked="checked" />
            </p>
        </fieldset>
    </form>

    <div class="spacer"></div>
</div>
