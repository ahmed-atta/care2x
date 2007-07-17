        <!-- Logo and header -->
        <div id="header">
            <div class="wrapLeft">
                <div class="wrapRight">
                    <div class="wrap">
                        <a id="logo" href="<?php echo htmlspecialchars($t->webRoot);?>/<?php echo htmlspecialchars($t->conf['site']['frontScriptName']);?>" title="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("Home"));?>">
                        <?php if ($t->conf['site']['showLogo'])  {?>
                        <img src="<?php echo htmlspecialchars($t->webRoot);?>/themes/<?php echo htmlspecialchars($t->theme);?>/images/<?php echo htmlspecialchars($t->conf['site']['showLogo']);?>" alt="<?php echo htmlspecialchars($t->conf['site']['name']);?> Logo" />
                        <?php } else {?>
                        <span><?php echo htmlspecialchars($t->conf['site']['name']);?></span>
                        <?php }?>
                        </a>
                        <?php if ($t->conf['debug']['showBugReporterLink'])  {?>
                        <a id="bugReporter" href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("","bug","default"));?>" title="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("send bug report"));?>">
                            <img src="<?php echo htmlspecialchars($t->webRoot);?>/themes/<?php echo htmlspecialchars($t->theme);?>/images/bug.gif" alt="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("send bug report"));?>" />
                        </a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div> <!-- close header -->

        <!-- top navigation -->
        <div id="top-nav">
            <div class="inner">
            <?php if ($this->options['strict'] || (is_array($t->blocksMainNav)  || is_object($t->blocksMainNav))) foreach($t->blocksMainNav as $key => $valueObj) {?>
                <?php echo $valueObj->content;?>
            <?php }?>
            </div>
        </div> <!-- close top-nav -->
        <div id="breadcrumbs">
            <div class="inner">
                <div id="breadcrumb">
                <?php if ($this->options['strict'] || (is_array($t->blocksMainBreadcrumb)  || is_object($t->blocksMainBreadcrumb))) foreach($t->blocksMainBreadcrumb as $key => $valueObj) {?>
                    <?php echo $valueObj->content;?>
                <?php }?>
                </div>
                <?php if ($this->options['strict'] || (is_array($t->blocksBodyTop)  || is_object($t->blocksBodyTop))) foreach($t->blocksBodyTop as $key => $valueObj) {?>
                    <?php echo $valueObj->content;?>
                <?php }?>
                <div class="spacer">&nbsp;</div>
            </div>
        </div>

        <!-- Main layout -->
        <div id="inner-wrapper">
