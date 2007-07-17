<div id="manager-actions">
    <span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Action"));?>: &nbsp;</span>
    <a class="action adduser" href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("add","user","user"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("New User"));?></a>
    <a class="action search" href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("add","usersearch","user"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Search"));?></a>
    <a class="action download" href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("","userimport","user"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Import users"));?></a>
</div>
<div id="content">
    <div id="content-header">
        <h2><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->pageTitle));?></h2>
        <div class="message"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'msgGet'))) echo htmlspecialchars($t->msgGet());?></div>
    </div>

    <form name="users" method="post" id="users" action="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("","user",""));?>">
        <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("User list"));?></h3>
        <fieldset class="noBorder">
            <table class="full">
                <thead>
                    <tr class="infos">
                        <td class="left" colspan="3">
                            <?php echo htmlspecialchars($t->totalItems);?> <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("user(s) found"));?>
                            <?php if ($t->search)  {?><a class="clearSearch" href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("search","usersearch","user","","frmSortBy|sortBy||frmSortOrder|sortOrder"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("clear search"));?></a><?php }?>
                        </td>
                        <td class="right" colspan="6">
                        <?php if ($t->pager)  {?><?php 
$x = new HTML_Template_Flexy($this->options);
$x->compile('admin_pager_table.html');
$_t = function_exists('clone') ? clone($t) : $t;
foreach(get_defined_vars()  as $k=>$v) {
    if ($k != 't') { $_t->$k = $v; }
}
$x->outputObject($_t, $this->elements);
?><?php }?>
                        </td>
                    </tr>
                    <tr>
                        <th width="3%">
                            <span class="tipOwner">
                                <span class="tipText" id="becareful"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Be Careful!"));?></span>
                                <input type="checkbox" name="checkAll" id="checkAll" onclick="javascript:applyToAllCheckboxes('users', 'frmDelete[]', this.checked)" />
                            </span>
                        </th>
                        <th width="3%"><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("list","user","user","","frmSortBy|usr_id||frmSortOrder|sortOrder"));?>" title="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Sort by"));?> <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("ID"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("ID"));?></a><?php if ($t->sort_usr_id)  {?><img src="<?php echo htmlspecialchars($t->webRoot);?>/themes/<?php echo htmlspecialchars($t->theme);?>/images/sort_<?php echo htmlspecialchars($t->sortOrder);?>.gif" alt="" /><?php }?></th>
                        <th width="10%" class="left"><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("list","user","user","","frmSortBy|username||frmSortOrder|sortOrder"));?>" title="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Sort by"));?> <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Username"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Username"));?></a><?php if ($t->sort_username)  {?><img src="<?php echo htmlspecialchars($t->webRoot);?>/themes/<?php echo htmlspecialchars($t->theme);?>/images/sort_<?php echo htmlspecialchars($t->sortOrder);?>.gif" alt="" /><?php }?></th>
                        <?php if ($t->conf['OrgMgr']['enabled'])  {?>
                        <th width="10%"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Organisation"));?></th>
                        <?php }?>
                        <th width="18%" class="left"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Email"));?></th>
                        <th width="5%"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Role"));?></th>
                        <th width="7%"><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("list","user","user","","frmSortBy|is_acct_active||frmSortOrder|sortOrder"));?>" title="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Sort by"));?> <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Status"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Status"));?></a><?php if ($t->sort_is_acct_active)  {?><img src="<?php echo htmlspecialchars($t->webRoot);?>/themes/<?php echo htmlspecialchars($t->theme);?>/images/sort_<?php echo htmlspecialchars($t->sortOrder);?>.gif" alt="" /><?php }?></th>
                        <th width="12%"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Password"));?></th>
                        <th width="12%"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Permissions"));?></th>
                        <th width="10%"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Logins"));?></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="infos">
                        <td class="right" colspan="9">
                            <?php if ($t->pager)  {?><?php 
$x = new HTML_Template_Flexy($this->options);
$x->compile('admin_pager_table.html');
$_t = function_exists('clone') ? clone($t) : $t;
foreach(get_defined_vars()  as $k=>$v) {
    if ($k != 't') { $_t->$k = $v; }
}
$x->outputObject($_t, $this->elements);
?><?php }?>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php if ($this->options['strict'] || (is_array($t->aPagedData['data'])  || is_object($t->aPagedData['data']))) foreach($t->aPagedData['data'] as $key => $aValue) {?><tr class="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'switchRowClass'))) echo htmlspecialchars($t->switchRowClass());?>">
                        <td><input type="checkbox" name="frmDelete[]" value="<?php echo htmlspecialchars($aValue['usr_id']);?>" /></td>
                        <td><?php echo htmlspecialchars($aValue['usr_id']);?></td>
                        <td class="left"><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("edit","user","",$t->aPagedData['data'],"frmUserID|usr_id",$key));?>"><?php echo htmlspecialchars($aValue['username']);?></a></td>
                        <?php if ($t->conf['OrgMgr']['enabled'])  {?>
                        <td><?php echo htmlspecialchars($aValue['org_name']);?></td>
                        <?php }?>
                        <td class="left"><?php echo htmlspecialchars($aValue['email']);?></td>
                        <td><?php echo htmlspecialchars($aValue['role_name']);?></td>
                        <td>
                            <?php if ($aValue['is_acct_active'])  {?><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("requestChangeUserStatus","user","",$t->aPagedData['data'],"frmUserID|usr_id",$key));?>"><img src="<?php echo htmlspecialchars($t->webRoot);?>/themes/<?php echo htmlspecialchars($t->theme);?>/images/16/status_enabled.gif" alt="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Active"));?>" title="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Change status"));?>" /> </a>
                            <?php } else {?> <a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("requestChangeUserStatus","user","",$t->aPagedData['data'],"frmUserID|usr_id",$key));?>"><img src="<?php echo htmlspecialchars($t->webRoot);?>/themes/<?php echo htmlspecialchars($t->theme);?>/images/16/status_disabled.gif" alt="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Disabled"));?>" title="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Change status"));?>" /></a>
                            <?php }?>
                        </td>
                        <td>
                            <input type="button" class="sgl-button" name="frmReset" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("reset"));?>" onclick="javascript:document.location.href='<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("requestPasswordReset","user","",$t->aPagedData['data'],"frmUserID|usr_id",$key));?>'" />
                        </td>
                        <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'isAdmin'))) if (!$t->isAdmin($aValue['role_id'])) { ?><td>
                            <input type="button" class="sgl-button" name="frmReset" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("change"));?>" onClick="javascript:document.location.href='<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("editPerms","user","",$t->aPagedData['data'],"frmUserID|usr_id",$key));?>'" />
                        </td><?php }?>
                        <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'isAdmin'))) if ($t->isAdmin($aValue['role_id'])) { ?><td>&nbsp;</td><?php }?>
                        <td><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("viewLogin","user","",$t->aPagedData['data'],"frmUserID|usr_id",$key));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("list"));?></a></td>
                    </tr><?php }?>
                    <?php if (!$t->aPagedData['data'])  {?><tr>
                        <td colspan="10"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("No users found"));?></td>
                    </tr><?php }?>
                </tbody>
            </table>
            <input type="submit" class="sgl-button" name="delete" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("delete selected"));?>" onclick="return confirmSubmit('<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("user"));?>', 'users')" />
        </fieldset>
        <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Synchronise"));?></h3>
        <fieldset class="inside">
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Role"));?></label>
                <select name="roleSync">
                    <option value="null"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("(each users current)"));?></option>
                    <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->aRoles);?>
                </select>
            </p>
            <p>
                <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Mode"));?></label>
                <select name="roleSyncMode">
                    <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->aSyncModes);?>
                </select>
            </p>
            <p>
                <label>&nbsp;</label>
                <input type="submit" class="sgl-button" name="syncToRole" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("sync perms with role","ucfirst"));?>" onclick="return confirmCustom('<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("You must select a user to sync"));?>', '<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Are you sure you want to sync this user(s)?"));?>', 'users')" />
            </p>
        </fieldset>
    </form>
    <div class="spacer"></div>
</div>
