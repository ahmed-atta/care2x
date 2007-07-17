<?php echo $t->sectionArrayJS;?>
<div id="manager-actions">
    <span><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Action"));?>:&nbsp;</span>
    <a class="action add" href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("add","section","navigation"));?>" accesskey="n"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("New section"));?></a>
</div>
<div id="content">
    <div id="content-header">
        <h2><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->pageTitle));?> :: <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->mode));?></h2>
        <div class="message"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'msgGet'))) echo htmlspecialchars($t->msgGet());?></div>
    </div>
    <form method="post" name="frmSectionMgr" id="frmSectionMgr" action="">
        <fieldset class="noBorder">
            <input type="hidden" name="action" value="delete" />
            <table class="full">
                <thead>
                    <tr>
                        <th width="3%">
                            <span class="tipOwner">
                                <input type="checkbox" name="checkAll" id="checkAll" onclick="javascript:applyToAllCheckboxes('frmSectionMgr', 'frmDelete[]', this.checked)" />
                                <span class="tipText" id="becareful"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Be Careful!"));?></span>
                            </span>
                        </th>
                        <th width="3%"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("ID"));?></th>
                        <th width="10%"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("move","ucfirst"));?></th>
                        <th width="33%" class="left"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Title"));?></th>
                        <th width="34%" class="left"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Resource URI"));?></th>
                        <th width="8%"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Parent ID"));?></th>
                        <th width="4%"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Order"));?></th>
                        <th width="5%"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Status"));?></th>
                    </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                    <?php if ($this->options['strict'] || (is_array($t->results)  || is_object($t->results))) foreach($t->results as $key => $section) {?><tr class="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'switchRowClass'))) echo htmlspecialchars($t->switchRowClass());?>">
                        <td><input type="checkbox" name="frmDelete[<?php echo htmlspecialchars($section['section_id']);?>]" id="frmDelete[]" value="<?php echo htmlspecialchars($section['section_id']);?>" /></td>
                        <td><?php echo htmlspecialchars($section['section_id']);?></td>
                        <td align="center">
                            <?php if ($section['images']['moveDownTarget'])  {?>
                                <a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("reorder","section","navigation",$t->results,"frmSectionId|section_id||targetId|images[moveDownTarget]||move|down",$key));?>">
                                    <img src="<?php echo htmlspecialchars($t->webRoot);?>/themes/<?php echo htmlspecialchars($t->theme);?>/<?php echo $section['images']['moveDownImg'];?>" alt="Move <?php echo htmlspecialchars($section['title']);?> down" /></a>
                            <?php } else {?> <img src="<?php echo htmlspecialchars($t->webRoot);?>/themes/<?php echo htmlspecialchars($t->theme);?>/<?php echo $section['images']['moveDownImg'];?>" alt="Move <?php echo htmlspecialchars($section['title']);?> down" />
                            <?php }?>

                            <?php if ($section['images']['moveUpTarget'])  {?>
                                <a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("reorder","section","navigation",$t->results,"frmSectionId|section_id||targetId|images[moveUpTarget]||move|up",$key));?>">
                                    <img src="<?php echo htmlspecialchars($t->webRoot);?>/themes/<?php echo htmlspecialchars($t->theme);?>/<?php echo $section['images']['moveUpImg'];?>" alt="Move <?php echo htmlspecialchars($section['title']);?> up" /></a>
                            <?php } else {?> <img src="<?php echo htmlspecialchars($t->webRoot);?>/themes/<?php echo htmlspecialchars($t->theme);?>/<?php echo $section['images']['moveUpImg'];?>" alt="Move <?php echo htmlspecialchars($section['title']);?> up" />
                            <?php }?>
                        </td>
                        <td class="left"><?php if ($this->options['strict'] || (is_array($section['images']['treePad'])  || is_object($section['images']['treePad']))) foreach($section['images']['treePad'] as $image) {?><img src="<?php echo htmlspecialchars($t->webRoot);?>/themes/<?php echo htmlspecialchars($t->theme);?>/<?php echo $image;?>" alt="" /><?php }?>
                            <?php if ($t->fallbackLang)  {?><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("edit","section","navigation",$t->results,"frmSectionId|section_id||frmNavLang|fallbackLang",$key));?>"><?php echo $section['title'];?></a><?php }?>
                            <?php if (!$t->fallbackLang)  {?><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("edit","section","navigation",$t->results,"frmSectionId|section_id",$key));?>" title="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Alias"));?> : <?php echo htmlspecialchars($section['uri_alias']);?>"><?php echo $section['title'];?></a><?php }?></td>
                        <td class="left"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'summarise'))) echo htmlspecialchars($t->summarise($section['resource_uri'],42,1));?></td>
                        <td><?php echo htmlspecialchars($section['parent_id']);?></td>
                        <td><?php echo htmlspecialchars($section['order_id']);?></td>
                        <td>
                            <?php if ($section['is_enabled'])  {?><img src="<?php echo htmlspecialchars($t->webRoot);?>/themes/<?php echo htmlspecialchars($t->theme);?>/images/16/status_enabled.gif" alt="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Enabled"));?>" title="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Enabled"));?>" />
                            <?php } else {?><img src="<?php echo htmlspecialchars($t->webRoot);?>/themes/<?php echo htmlspecialchars($t->theme);?>/images/16/status_disabled.gif" alt="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Disabled"));?>" title="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Disabled"));?>" />
                            <?php }?></td>
                    </tr><?php }?>
                </tbody>
            </table>
            <input type="submit" class="sgl-button" name="Delete" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("delete selected"));?>" onclick="return confirmDelete('section', 'frmSectionMgr')" />
        </fieldset>
    </form>
    <div class="spacer"></div>
</div>
