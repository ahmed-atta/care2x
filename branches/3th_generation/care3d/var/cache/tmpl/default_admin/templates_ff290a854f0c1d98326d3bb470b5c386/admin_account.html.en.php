<div id="manager-actions">
    <span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Action"));?>: &nbsp;</span>
    <a class="action edit" href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("edit","account","user"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Edit"));?></a>
</div>
<div id="content">
    <div id="content-header">
        <h2><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->pageTitle));?></h2>
        <div class="message"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'msgGet'))) echo htmlspecialchars($t->msgGet());?></div>
    </div>
    <form action="" method="post" id="frmUserAdd">

        <fieldset class="inside" id="userDetails">
            <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Personal Details"));?></h3>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Username"));?></label>
                <span><?php echo htmlspecialchars($t->user->username);?>&nbsp;</span>
            </p>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("First Name"));?></label>
                <span><?php echo htmlspecialchars($t->user->first_name);?>&nbsp;</span>
            </p>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Last Name"));?></label>
                <span><?php echo htmlspecialchars($t->user->last_name);?>&nbsp;</span>
            </p>
        </fieldset>

        <fieldset class="inside" id="userContact">
            <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Contact"));?></h3>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Email"));?></label>
                <span><?php echo htmlspecialchars($t->user->email);?>&nbsp;</span>
            </p>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Telephone"));?></label>
                <span><?php echo htmlspecialchars($t->user->telephone);?>&nbsp;</span>
            </p>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Mobile"));?></label>
                <span><?php echo htmlspecialchars($t->user->mobile);?>&nbsp;</span>
            </p>
        </fieldset>

        <fieldset class="inside">
            <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Location"));?></h3>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Address 1"));?></label>
                <span><?php echo htmlspecialchars($t->user->addr_1);?>&nbsp;</span>
            </p>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Address 2"));?></label>
                <span><?php echo htmlspecialchars($t->user->addr_2);?>&nbsp;</span>
            </p>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Address 3"));?></label>
                <span><?php echo htmlspecialchars($t->user->addr_3);?>&nbsp;</span>
            </p>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("City"));?></label>
                <span><?php echo htmlspecialchars($t->user->city);?>&nbsp;</span>
            </p>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("County/State/Province"));?></label>
                <span><?php echo htmlspecialchars($t->user->region);?>&nbsp;</span>
            </p>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("ZIP/Postal Code"));?></label>
                <span><?php echo htmlspecialchars($t->user->post_code);?>&nbsp;</span>
            </p>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Country"));?></label>
                <span><?php echo htmlspecialchars($t->user->country);?>&nbsp;</span>
            </p>
        </fieldset>
    </form>
    <div class="spacer"></div>
</div>
