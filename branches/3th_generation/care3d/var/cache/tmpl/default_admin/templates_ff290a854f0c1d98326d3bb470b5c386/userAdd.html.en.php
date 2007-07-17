<div id="content">
    <h1 class="pageTitle"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->pageTitle));?></h1>
    <div id="ajaxMessage" class="message"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'msgGet'))) echo htmlspecialchars($t->msgGet());?></div>

    <form id="frmUser" method="post" action="">
        <fieldset class="hide">
            <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'isAdmin'))) if (!$t->isAdmin()) { ?><input id="usernameWrongFormatMsg" type="hidden" name="usernameWrongFormatMsg" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("username min length"));?>" /><?php }?>
            <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'isAdmin'))) if (!$t->isAdmin()) { ?><input id="ajaxProviderIsUniqueUsernameUrl" type="hidden" name="usernameWrongFormatMsg" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("isUniqueUsername","","user"));?>" /><?php }?>
        <?php if ($t->isAdd)  {?>
            <input type="hidden" name="action" value="insert" />
            <?php if ($t->redir)  {?>
            <input type="hidden" name="redir" value="<?php echo htmlspecialchars($t->redir);?>" />
            <?php }?>
        <?php } else {?>
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="user[usr_id]" value="<?php echo htmlspecialchars($t->user->usr_id);?>" />
            <input type="hidden" name="user[role_id_orig]" value="<?php echo htmlspecialchars($t->user->role_id);?>" />
            <input type="hidden" name="user[organisation_id_orig]" value="<?php echo htmlspecialchars($t->user->organisation_id);?>" />
            <input type="hidden" name="user[username_orig]" value="<?php echo htmlspecialchars($t->user->username_orig);?>" />
            <input type="hidden" name="user[email_orig]" value="<?php echo htmlspecialchars($t->user->email_orig);?>" />
        <?php }?>
        </fieldset>

        <?php if ($t->isAdd)  {?><h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("add user","ucfirst"));?></h3><?php }?>
        <?php if (!$t->isAdd)  {?><h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("edit user","ucfirst"));?> "<?php echo htmlspecialchars($t->user->username);?>"</h3><?php }?>

        <fieldset class="inside">
            <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Personal Details"));?></h3>
            <dl class="onSide">
                <dt>
                    <label for="user_username"><span class="required">* </span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Username"));?></label>
                </dt>
                <dd>
                    <?php if ($t->error['username'])  {?><div class="error">
                        <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->error['username']));?>
                    </div><?php }?>
                    <input id="user_username" type="text" name="user[username]" value="<?php echo htmlspecialchars($t->user->username);?>" />
                    <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'isAdmin'))) if (!$t->isAdmin()) { ?>
                    &nbsp;<input type="button" name="button" value="Check Availability" onclick="UserRegister.isUniqueUsername('user_username')" />
                    <?php }?>
                </dd>
                <dt>
                    <label for="user_first-name"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("First Name"));?></label>
                </dt>
                <dd>
                    <input id="user_first-name" type="text" name="user[first_name]" value="<?php echo htmlspecialchars($t->user->first_name);?>" />
                </dd>
                <dt>
                    <label for="user_last-name"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Last Name"));?></label>
                </dt>
                <dd>
                    <input id="user_last-name" type="text" name="user[last_name]" value="<?php echo htmlspecialchars($t->user->last_name);?>" />
                </dd>

                <?php if ($t->isAdd)  {?>
                <dt>
                    <label for="user_passwd"><span class="required">* </span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Password"));?></label>
                </dt>
                <dd>
                    <?php if ($t->error['passwd'])  {?><div class="error">
                        <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->error['passwd']));?>
                    </div><?php }?>
                    <input id="user_passwd" type="password" name="user[passwd]" value="<?php echo htmlspecialchars($t->user->passwd);?>" />
                </dd>
                <dt>
                    <label for="user_password-confirm"><span class="required">* </span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Confirm Password"));?></label>
                </dt>
                <dd>
                    <?php if ($t->error['password_confirm'])  {?><div class="error">
                        <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->error['password_confirm']));?>
                    </div><?php }?>
                    <input id="user_password-confirm" type="password" name="user[password_confirm]" value="<?php echo htmlspecialchars($t->user->password_confirm);?>" />
                </dd>
                <?php }?>

                <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'isAdmin'))) if ($t->isAdmin()) { ?>
                    <?php if ($t->conf['OrgMgr']['enabled'])  {?>
                <dt>
                    <label for="user_organisation-id"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Organisation name"));?></label>
                </dt>
                <dd>
                    <select id="user_organisation-id" name="user[organisation_id]">
                        <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->aOrgs,$t->user->organisation_id);?>
                    </select>
                </dd>
                    <?php }?>
                <?php }?>
            </dl>
        </fieldset>
        <fieldset class="inside">
            <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Contact"));?></h3>
            <dl class="onSide">
                <dt>
                    <label for="user_email"><span class="required">*</span> <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Email"));?></label>
                </dt>
                <dd>
                    <?php if ($t->error['email'])  {?><div class="error">
                        <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->error['email']));?>
                    </div><?php }?>
                    <input id="user_email" type="text" name="user[email]" value="<?php echo htmlspecialchars($t->user->email);?>" />
                </dd>
                <dt>
                    <label for="user_telephone"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Telephone"));?></label>
                </dt>
                <dd>
                    <input id="user_telephone" type="text" name="user[telephone]" value="<?php echo htmlspecialchars($t->user->telephone);?>" />
                </dd>
                <dt>
                    <label for="user_mobile"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Mobile"));?></label>
                </dt>
                <dd>
                    <input id="user_mobile" type="text" name="user[mobile]" value="<?php echo htmlspecialchars($t->user->mobile);?>" />
                </dd>

                <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'isAdmin'))) if ($t->isAdmin()) { ?>
                <dt>
                    <label for="user_is-acct-active"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Is Active?"));?></label>
                </dt>
                <dd>
                    <input id="user_is-acct-active" type="checkbox" name="user[is_acct_active]" value="1" <?php echo htmlspecialchars($t->isAcctActive);?> /> <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("check if active"));?>
                </dd>
                <?php }?>
            </dl>
        </fieldset>
        <fieldset class="inside">
            <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Location"));?></h3>
            <dl class="onSide">
                <dt>
                    <label for="user_addr-1"><span class="required">* </span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Address 1"));?></label>
                </dt>
                <dd>
                    <?php if ($t->error['addr_1'])  {?><div class="error">
                        <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->error['addr_1']));?>
                    </div><?php }?>
                    <input id="user_addr-1" type="text" name="user[addr_1]" value="<?php echo htmlspecialchars($t->user->addr_1);?>" />
                </dd>
                <dt>
                    <label for="user_addr-2"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Address 2"));?></label>
                </dt>
                <dd>
                    <input id="user_addr-2" type="text" name="user[addr_2]" value="<?php echo htmlspecialchars($t->user->addr_2);?>" />
                </dd>
                <dt>
                    <label for="user_addr-3"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Address 3"));?></label>
                </dt>
                <dd>
                    <input id="user_addr-3" type="text" name="user[addr_3]" value="<?php echo htmlspecialchars($t->user->addr_3);?>" />
                </dd>
                <dt>
                    <label for="user_city"><span class="required">* </span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("City"));?></label>
                </dt>
                <dd>
                    <?php if ($t->error['city'])  {?><div class="error">
                        <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->error['city']));?>
                    </div><?php }?>
                    <input id="user_city" type="text" name="user[city]" value="<?php echo htmlspecialchars($t->user->city);?>" />
                </dd>
                <dt>
                    <label for="user_region"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("County/State/Province"));?></label>
                </dt>
                <dd>
                    <select id="user_region" name="user[region]">
                        <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->states,$t->user->region);?>
                    </select>
                </dd>
                <dt>
                    <label for="user_post-code"><span class="required">* </span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("ZIP/Postal Code"));?></label>
                </dt>
                <dd>
                    <?php if ($t->error['post_code'])  {?><div class="error">
                        <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->error['post_code']));?>
                    </div><?php }?>
                    <input id="user_post-code" type="text" name="user[post_code]" value="<?php echo htmlspecialchars($t->user->post_code);?>" />
                </dd>

                <dt>
                    <label for="user_country"><span class="required">* </span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Country"));?></label>
                </dt>
                <dd>
                    <?php if ($t->error['country'])  {?><div class="error">
                        <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->error['country']));?>
                    </div><?php }?>
                    <select id="user_country" name="user[country]">
                        <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->countries,$t->user->country);?>
                    </select>
                </dd>
            </dl>
        </fieldset>
        <fieldset class="inside">
            <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Security"));?></h3>
            <dl class="onSide">
                <dt>
                    <label for="user_security-question"><span class="required">* </span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Security question"));?></label>
                </dt>
                <dd>
                    <?php if ($t->error['security_question'])  {?><div class="error">
                        <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->error['security_question']));?>
                    </div><?php }?>
                    <select id="user_security-question" name="user[security_question]">
                        <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->aSecurityQuestions,$t->user->security_question);?>
                    </select>
                </dd>
                <dt>
                    <label for="user_security-answer"><span class="required">* </span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Answer"));?></label>
                </dt>
                <dd>
                    <?php if ($t->error['security_answer'])  {?><div class="error">
                        <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->error['security_answer']));?>
                    </div><?php }?>
                    <input id="user_security-answer" type="text" name="user[security_answer]" value="<?php echo htmlspecialchars($t->user->security_answer);?>" />
                </dd>

                <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'isAdmin'))) if ($t->isAdmin()) { ?>
                <dt>
                    <label for="user_role-id"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Role"));?></label>
                </dt>
                <dd>
                    <select id="user_role-id" name="user[role_id]">
                        <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->aRoles,$t->user->role_id);?>
                    </select>
                </dd>
                <?php }?>

                <!-- only show submit buttons at bottom if frontend -->
                <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'isAdmin'))) if (!$t->isAdmin()) { ?>
                <dt>&nbsp;</dt>
                <dd>
                    <?php if ($t->isAdd)  {?>
                    <input class="button" type="submit" name="submitted" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Register"));?>" />
                        <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'isAdmin'))) if ($t->isAdmin()) { ?>
                    <input class="button" type="button" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Cancel"));?>" onclick="document.location.href='<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("","user","user"));?>'" />
                        <?php }?>
                    <?php } else {?>
                    <input class="button" type="submit" name="submitted" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Save"));?>" />
                    <input class="button" type="button" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Cancel"));?>" onclick="document.location.href='<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("summary","account","user"));?>'" />
                    <?php }?>
                </dd>
                <?php }?>
                <!-- end variable submit buttons -->

            </dl>
        </fieldset>
        <p class="helpRequire">
            <span class="required">*</span> <span class="small"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("denotes required field"));?></span>
        </p>
    </form>

</div>

<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'isAdmin'))) if (!$t->isAdmin()) { ?>
<script type="text/javascript">
     UserRegister = {

        // predefined containers
        messageContainer: 'ajaxMessage',
        messageWrongUserFormat: $F('usernameWrongFormatMsg'),
        urlIsUniqueUsername: $F('ajaxProviderIsUniqueUsernameUrl'),

        isUniqueUsername: function(username) {
            if (!UserValidator.isValidUsername($F(username))) {
                this._showMessage('error', this.messageWrongUserFormat);
            } else {
                new Ajax.Request(this.urlIsUniqueUsername, {
                        method: 'post',
                        parameters: {username: $F(username)},
                        onSuccess: this._showResults
                    });
            }
            return false;
        },

        _showMessage: function(messageType, messageText) {
            var innerDiv = document.createElement('div');
            $(innerDiv).toggleClassName(messageType + 'Message').update(messageText);
            $(this.messageContainer).show().update('').appendChild(innerDiv)
            // Opacity effect is used, because we don't want screen to jump
            new Effect.Opacity(this.messageContainer, {
                duration: 1.5,
                from: 1.0,
                to: 0
            });
        },

        _showResults: function(transport) {
            var result = eval('(' + transport.responseText + ')');
            UserRegister._showMessage(result.type, result.message);
        }
    }

    UserValidator = {
        isValidUsername: function(value) {
            if (value == '') {
                return false;
            }
            return value.match('^[a-zA-Z0-9]{5,}$');
        }
    }
</script>
<?php }?>