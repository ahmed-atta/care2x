<h1 class="pageTitle"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->pageTitle));?></h1>
<div class="message"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'msgGet'))) echo htmlspecialchars($t->msgGet());?></div>

<form id="frmLogin" method="post" action="">
    <fieldset class="hide">
        <input type="hidden" name="action" value="login" />
        <input type="hidden" name="redir" value="<?php echo htmlspecialchars($t->redir);?>" />
    </fieldset>
    <fieldset>
        <dl class="onSide">
            <dt>
                <label for="frm_username"><span class="required">*&nbsp;</span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Username"));?></label>
            </dt>
            <dd>
                <?php if ($t->error['username'])  {?><div class="error">
                    <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->error['username']));?>
                </div><?php }?>
                <input type="text" name="frmUsername" id="frm_username" value="<?php echo htmlspecialchars($t->username);?>" maxlength="36" />
            </dd>
            <dt>
                <label for="frm_password"><span class="required">*&nbsp;</span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Password"));?></label>
            </dt>
            <dd>
                <?php if ($t->error['password'])  {?><div class="error">
                    <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->error['password']));?>
                </div><?php }?>
                <input type="password" name="frmPassword" id="frm_password" value="<?php echo htmlspecialchars($t->password);?>" maxlength="24" />
            </dd>
            <dt>&nbsp;</dt>
            <dd>
                <input type="submit" class="button" name="submitted" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Login"));?>" />
            </dd>
            <?php if ($t->conf['RegisterMgr']['enabled'])  {?><dd>
                <a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("","register","user"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Not Registered"));?></a>
            </dd><?php }?>
            <dd>
                <a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("","password","user"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Forgot Password"));?></a>
            </dd>
        </dl>
    </fieldset>
    <p><span class="required">*</span> <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("denotes required field"));?></p>
</form>
<div class="spacer" style="height:130px"></div>