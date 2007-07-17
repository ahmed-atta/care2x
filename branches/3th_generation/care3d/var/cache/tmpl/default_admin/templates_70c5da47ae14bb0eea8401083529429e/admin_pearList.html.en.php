<div id="content">
    <div id="content-header">
        <h2><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate($t->pageTitle));?></h2>
        <div class="message"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'msgGet'))) echo htmlspecialchars($t->msgGet());?></div>
    </div>
    <form name="pearPackages" action="" method="post" id="pearPackages">
        <fieldset class="inside">
        <input type="hidden" name="action" value="delete" />
        <p>
            <label for="frmChannelName"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Choose channel"));?></label>
            <select name="frmChannelName" id="frmChannelName">
                <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'generateSelect'))) echo $t->generateSelect($t->aChannels,$t->channel);?>
            </select>
        </p>
        <p>
            <label><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Action"));?></label>
            <input type="button" class="sgl-button" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("List remote packages"));?>" onclick="javascript:document.location.href='<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("doRequest","pear","default"));?>command/sgl-list-all/channel/'+getSelectedValue(document.getElementById('frmChannelName')) + '/'" />
            <input type="button" class="sgl-button" value="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("List installed packages"));?>" onclick="javascript:document.location.href='<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("doRequest","pear","default"));?>command/sgl-list-all/mode/installed/channel/'+getSelectedValue(document.getElementById('frmChannelName')) + '/'" />
<!--            <input type="button" class="sgl-button" value="{translate(#Search package#)}" />-->
        </p>
        </fieldset>

    <?php if ($t->result)  {?>
        <?php if ($this->options['strict'] || (is_array($t->result)  || is_object($t->result))) foreach($t->result as $category => $packages) {?>
        <fieldset class="noBorder">
            <h3><?php echo htmlspecialchars($category);?></h3>
            <table class="full">
                <thead>
                    <tr>
                        <th width="5%">&nbsp;</th>
                        <th width="25%" class="left"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Package Name"));?></th>
                        <th width="7%" class="left"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Local"));?></th>
                        <th width="7%" class="left"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Latest"));?></th>
                        <th width="8%"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Install"));?></th>
                        <th width="8%"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Uninstall"));?></th>
                        <th width="40%" class="left"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Description"));?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($this->options['strict'] || (is_array($packages)  || is_object($packages))) foreach($packages as $k2 => $package) {?><tr class="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'switchRowClass'))) echo htmlspecialchars($t->switchRowClass());?>">
                        <td align="center"><input class="noBorder" type="checkbox" name="frmDelete[]" value="<?php echo htmlspecialchars($t->valueObj->faq_id);?>" /></td>
                        <td class="left"><?php echo htmlspecialchars($package[0]);?></td><!--name-->
                        <td class="left"><?php echo htmlspecialchars($package[1]);?></td><!--local-->
                        <td class="left"><?php echo htmlspecialchars($package[2]);?></td><!--remote-->
                        <td><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("doRequest","pear","default"));?>command/sgl-install/pkg/<?php if ($this->options['strict'] || (isset($this) && method_exists($this, 'plugin'))) echo htmlspecialchars($this->plugin("replaceSlashes",$package[0]));?>/">install</a></td><!--remote-->
                        <td><a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("doRequest","pear","default"));?>command/sgl-uninstall/pkg/<?php if ($this->options['strict'] || (isset($this) && method_exists($this, 'plugin'))) echo htmlspecialchars($this->plugin("replaceSlashes",$package[0]));?>/mode/installed">uninstall</a></td><!--remote-->
                        <td class="left"><?php echo htmlspecialchars($package[3]);?></td><!--desc-->
                    </tr><?php }?>
                </tbody>
            </table>
        </fieldset>
        <?php }?>
    <?php } else {?>
    <fieldset class="inside">
        <p><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Pear Manager Notice"));?></p>
    </fieldset>
    <?php }?>
    </form>
    <div class="spacer"></div>
</div>