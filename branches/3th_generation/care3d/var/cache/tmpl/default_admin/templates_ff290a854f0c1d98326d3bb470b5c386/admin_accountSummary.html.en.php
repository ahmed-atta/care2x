<div id="manager-actions">
    <span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Action"));?> :&nbsp;</span>
    <a class="action reorder" href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("edit","userpassword","user"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("change password"));?></a>
</div>
<div id="content">
    <div id="content-header">
        <h2><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->pageTitle));?></h2>
        <div class="message"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'msgGet'))) echo htmlspecialchars($t->msgGet());?></div>
    </div>
    <form name="frmMyAccount" action="" method="post" id="frmMyAccount">
        <h3><?php echo htmlspecialchars($t->user->username);?></h3>
        <fieldset class="inside">
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Role"));?></label>
                <span><?php echo htmlspecialchars($t->user->role_name);?></span>
            </p>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Date Registered"));?></label>
                <span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'formatDatePretty'))) echo htmlspecialchars($t->formatDatePretty($t->user->date_created));?></span>
            </p>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Last Login"));?></label>
                <span><?php if ($t->login->last_login)  {?> <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'formatDatePretty'))) echo htmlspecialchars($t->formatDatePretty($t->login->last_login));?> <?php } else {?><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("first login in progress"));?><?php }?></span>
            </p>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Current IP Address"));?></label>
                <span><?php echo htmlspecialchars($t->remote_ip);?></span>
            </p>
        </fieldset>
    </form>
    <div class="spacer"></div>
</div>
