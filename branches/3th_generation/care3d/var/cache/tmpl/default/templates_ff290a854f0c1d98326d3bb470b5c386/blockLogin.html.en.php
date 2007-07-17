<form id="loginBlock" method="post" action="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("login","login","user"));?>">
    <dl class="onTop">
        <dt><label for="frm_username_block"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Username"));?></label></dt>
        <dd><input type="text" name="frmUsername" id="frm_username_block" size="15" value="<?php echo htmlspecialchars($t->username);?>" maxlength="20" /></dd>
        <dt><label for="frm_password_block"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Password"));?></label></dt>
        <dd><input type="password" name="frmPassword" id="frm_password_block" size="15" value="<?php echo htmlspecialchars($t->password);?>" maxlength="10" /></dd>
    </dl>
    <p><input type="submit" class="button" name="submitted" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Submit login"));?>" /></p>
    <?php if ($t->conf['RegisterMgr']['enabled'])  {?>
    <p><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("","register","user"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Not Registered"));?></a></p>
    <?php }?>
    <p><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("","password","user"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Forgot Password"));?></a></p>
</form>
