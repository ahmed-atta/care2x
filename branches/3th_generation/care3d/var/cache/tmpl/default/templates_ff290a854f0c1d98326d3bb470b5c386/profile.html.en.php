<h1 class="pageTitle"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->pageTitle));?></h1>
<div class="message"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'msgGet'))) echo htmlspecialchars($t->msgGet());?></div>

<?php if ($t->backButton)  {?>
    <p>
        <a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("","contact","messaging"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("back to contacts"));?></a>
    </p>
<?php }?>

<div class="fieldsetlike">
    <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Personal Details"));?></h3>
    <dl class="onSide">
        <dt><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Username"));?></dt>
        <dd><?php echo htmlspecialchars($t->profile->username);?></dd>
        <dt><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Real Name"));?></dt>
        <dd><?php echo htmlspecialchars($t->profile->first_name);?>&nbsp;<?php echo htmlspecialchars($t->profile->last_name);?></dd>
        <dt><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Lives in"));?></dt>
        <dd><?php echo htmlspecialchars($t->profile->country);?>&nbsp;</dd>
        <dt><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Member Since"));?></dt>
        <dd><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'formatDatePretty'))) echo htmlspecialchars($t->formatDatePretty($t->profile->date_created));?></dd>
        <?php if ($t->conf['LoginMgr']['recordLogin'])  {?>
            <dt><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Last Login"));?></dt>
            <dd>
                <?php if ($t->login->last_login)  {?><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'formatDatePretty'))) echo htmlspecialchars($t->formatDatePretty($t->login->last_login));?><?php } else {?><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("first login in progress"));?><?php }?>
            </dd>
        <?php }?>
    </dl>
</div>
<div class="fieldsetlike">
    <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Posting Stats for User"));?> <?php echo htmlspecialchars($t->profile->username);?></h3>
    <dl class="onSide">
        <dt><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Total Articles"));?></dt>
        <dd><?php if ($t->totalArticles)  {?><?php echo htmlspecialchars($t->totalArticles);?><?php } else {?>0<?php }?></dd>
        <!--dt>{translate(#Total Comments#)}</dt>
        <dd>{translate(#coming soon ...#)}</dd-->
    </dl>
</div>

<?php if ($t->allowContact)  {?>
<form id="account" method="post" action="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("","instantmessage","messaging"));?>">
    <fieldset class="hide">
        <input type="hidden" name="action" value="compose" />
        <input type="hidden" name="frmRecipients[]" value="<?php echo htmlspecialchars($t->profile->usr_id);?>" />
    </fieldset>
    <fieldset>
        <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Contact"));?></h3>
        <dl class="onSide">
            <dt><label for="sendMessage"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Message"));?></label></dt>
            <dd>
                <input id="sendMessage" class="button" type="submit" name="sendMessage" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("send message"));?>" />
            </dd>
            <dt><label for="contacts"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Contacts"));?></label></dt>
            <dd>
                <input id="contacts" class="button" type="button" name="contacts" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("add to contacts"));?>" onclick="document.location.href='<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("insert","contact","messaging"));?>frmUserID/<?php echo htmlspecialchars($t->profile->usr_id);?>/'" />
            </dd>
        </dl>
    </fieldset>
</form>
<?php }?>