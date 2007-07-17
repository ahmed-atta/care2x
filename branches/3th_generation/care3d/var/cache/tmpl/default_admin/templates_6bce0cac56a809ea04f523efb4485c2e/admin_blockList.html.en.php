<div id="manager-actions">
    <span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Action"));?>: &nbsp;</span>
    <a class="action add" href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("add","block","block"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("New block"));?></a>
    <select name="position" onchange="javascript:document.location.href='<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("reorder","block","block","","position"));?>'+this.value">
        <option>- <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Reorder blocks"));?> -</option>
        <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->aBlocksNames,"");?>
    </select>
</div>
<div id="content">
    <div id="content-header">
        <h2><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->pageTitle));?> :: <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->mode));?></h2>
        <div class="message"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'msgGet'))) echo htmlspecialchars($t->msgGet());?></div>
    </div>
    <form name="frmBlockMgr" method="post" id="frmBlockMgr">
        <h3><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Block list"));?></h3>
        <fieldset class="noBorder">
        <input type="hidden" name="action" value="delete" />
            <table class="full">
                <thead>
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
                    <tr>
                        <th width="3%">
                            <span class="tipOwner">
                                <span class="tipText" id="becareful"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Be Careful!"));?></span>
                                <input type="checkbox" name="checkAll" id="checkAll" onClick="javascript:applyToAllCheckboxes('frmBlockMgr', 'frmDelete[]', this.checked)" />
                            </span>
                        </th>
                        <th width="5%"><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("list","block","block","","frmSortBy|block_id||frmSortOrder|sortOrder"));?>" title="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Sort by"));?> <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("ID"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("ID"));?></a>
                            <?php if ($t->sort_block_id)  {?><img src="<?php echo htmlspecialchars($t->webRoot);?>/themes/<?php echo htmlspecialchars($t->theme);?>/images/sort_<?php echo htmlspecialchars($t->sortOrder);?>.gif" alt="" /><?php }?></th>
                        <th width="18%" class="left"><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("list","block","block","","frmSortBy|title||frmSortOrder|sortOrder"));?>" title="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Sort by"));?> <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Title"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Title"));?></a>
                            <?php if ($t->sort_title)  {?><img src="<?php echo htmlspecialchars($t->webRoot);?>/themes/<?php echo htmlspecialchars($t->theme);?>/images/sort_<?php echo htmlspecialchars($t->sortOrder);?>.gif" alt="" /><?php }?></th>
                        <th width="18%" class="left"><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("list","block","block","","frmSortBy|name||frmSortOrder|sortOrder"));?>" title="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Sort by"));?> <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Name"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Name"));?></a>
                            <?php if ($t->sort_name)  {?><img src="<?php echo htmlspecialchars($t->webRoot);?>/themes/<?php echo htmlspecialchars($t->theme);?>/images/sort_<?php echo htmlspecialchars($t->sortOrder);?>.gif" alt="" /><?php }?></th>
                        <th width="30%"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Sections"));?></th>
                        <th width="10%"><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("list","block","block","","frmSortBy|position||frmSortOrder|sortOrder"));?>" title="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Sort by"));?> <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Position"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Position"));?></a>
                            <?php if ($t->sort_position)  {?><img src="<?php echo htmlspecialchars($t->webRoot);?>/themes/<?php echo htmlspecialchars($t->theme);?>/images/sort_<?php echo htmlspecialchars($t->sortOrder);?>.gif" alt="" /><?php }?></th>

                        <th width="8%"><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("list","block","block","","frmSortBy|blk_order||frmSortOrder|sortOrder"));?>" title="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Sort by"));?> <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Order"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Order"));?></a>
                            <?php if ($t->sort_blk_order)  {?><img src="<?php echo htmlspecialchars($t->webRoot);?>/themes/<?php echo htmlspecialchars($t->theme);?>/images/sort_<?php echo htmlspecialchars($t->sortOrder);?>.gif" alt="" /><?php }?></th>

                        <th width="8%"><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("list","block","block","","frmSortBy|is_enabled||frmSortOrder|sortOrder"));?>" title="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Sort by"));?> <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Status"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Status"));?></a>
                            <?php if ($t->sort_is_enabled)  {?><img src="<?php echo htmlspecialchars($t->webRoot);?>/themes/<?php echo htmlspecialchars($t->theme);?>/images/sort_<?php echo htmlspecialchars($t->sortOrder);?>.gif" alt="" /><?php }?></th>
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
                        <td><input type="checkbox" name="frmDelete[]" id="frmDelete[]" value="<?php echo htmlspecialchars($aValue['block_id']);?>" /></td>
                        <td><?php echo htmlspecialchars($aValue['block_id']);?></td>
                        <td class="left">
                            <a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("edit","block","block",$t->aPagedData['data'],"frmBlockId|block_id",$aValue['block_id']));?>"><?php echo htmlspecialchars($aValue['title']);?></a></td>
                        <td class="left"><?php echo htmlspecialchars($aValue['name']);?></td>
                        <td><?php if ($aValue['sections'])  {?> <?php if ($this->options['strict'] || (is_array($aValue['sections'])  || is_object($aValue['sections']))) foreach($aValue['sections'] as $key => $section) {?> <?php echo htmlspecialchars($section);?>. <?php }?> <?php } else {?> <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("No section"));?> <?php }?></td>
                        <td><?php echo htmlspecialchars($aValue['position']);?></td>
                        <td><?php echo htmlspecialchars($aValue['blk_order']);?></td>
                        <td><?php if ($aValue['is_enabled'])  {?><img src="<?php echo htmlspecialchars($t->webRoot);?>/themes/<?php echo htmlspecialchars($t->theme);?>/images/16/status_enabled.gif" alt="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Enabled"));?>" title="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Enabled"));?>" /><?php } else {?><img src="<?php echo htmlspecialchars($t->webRoot);?>/themes/<?php echo htmlspecialchars($t->theme);?>/images/16/status_disabled.gif" alt="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Disabled"));?>" title="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Disabled"));?>" /><?php }?></td>
                    </tr><?php }?>
                </tbody>
            </table>
            <input type="submit" class="sgl-button" name="Delete" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("delete selected"));?>" onclick="return confirmSubmit('block', 'frmBlockMgr')" />
        </fieldset>
    </form>
    <div class="spacer"></div>
</div>
