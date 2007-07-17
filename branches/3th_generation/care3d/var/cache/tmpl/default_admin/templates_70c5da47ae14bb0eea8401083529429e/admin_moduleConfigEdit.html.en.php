<div id="dhtmltooltip"></div>
<script type="text/javascript" src="<?php echo htmlspecialchars($t->webRoot);?>/js/tooltip.js"></script>

<div id="manager-actions">
    <span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Action"));?>: &nbsp;</span>
    <a class="action save" href="javascript:formSubmit('moduleConf','submitted',1,1)"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Save"));?></a>
    <a class="action undo" href="javascript:formReset('moduleConf')"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Reset"));?></a>
    <a class="action cancel" href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("","module","default"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Cancel"));?></a>
</div>
<div id="content">
    <div id="content-header">
        <h2><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->pageTitle));?> "<?php echo htmlspecialchars($t->moduleNameId);?>"</h2>
        <div class="message"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'msgGet'))) echo htmlspecialchars($t->msgGet());?></div>
    </div>
    <!-- Show editconfig form-->
    <?php if ($t->config)  {?>
    <form method="post" action="" id="moduleConf">
        <fieldset class="inside" id="conf_<?php echo htmlspecialchars($t->module);?>">
            <input type="hidden" name="action" value="update" />
            <?php 
$x = new HTML_Template_Flexy($this->options);
$x->compile('moduleEditForm.html');
$_t = function_exists('clone') ? clone($t) : $t;
foreach(get_defined_vars()  as $k=>$v) {
    if ($k != 't') { $_t->$k = $v; }
}
$x->outputObject($_t, $this->elements);
?>
        </fieldset>
        <fieldset class="inside">
            <legend>Module configuration</legend>
            <?php if ($this->options['strict'] || (is_array($t->config)  || is_object($t->config))) foreach($t->config as $section => $parameters) {?>
                <h3><?php echo htmlspecialchars($section);?></h3>
                <dl class="onSide">
                <?php if ($this->options['strict'] || (is_array($parameters)  || is_object($parameters))) foreach($parameters as $parameter => $value) {?>
                    <dt><?php echo htmlspecialchars($parameter);?></dt>
                    <dd>
                        <?php if ($this->options['strict'] || (isset($this) && method_exists($this, 'plugin'))) echo $this->plugin("createConfigField",$section,$parameter,$value);?>
                    </dd>
                    <?php }?>
                </dl>
            <?php }?>
        </fieldset>
    </form>
    <?php } else {?>
    <?php if ($this->options['strict'] || (is_array($t->error)  || is_object($t->error))) foreach($t->error as $idx => $msg) {?>
        <p class="error center"><?php echo htmlspecialchars($msg);?></p>
    <?php }?>
    <?php }?>
    <div class="spacer"></div>
</div>
