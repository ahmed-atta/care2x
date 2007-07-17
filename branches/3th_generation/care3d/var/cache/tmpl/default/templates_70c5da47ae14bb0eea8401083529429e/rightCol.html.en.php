                <?php if ($this->options['strict'] || (is_array($t->blocksRight)  || is_object($t->blocksRight))) foreach($t->blocksRight as $key => $valueObj) {?>
                    <div class="block <?php echo htmlspecialchars($valueObj->body_class);?>">
                        <div class="header">
                            <h2><?php echo htmlspecialchars($valueObj->title);?></h2>
                        </div>
                        <div class="content">
                            <?php echo $valueObj->content;?>
                        </div>
                    </div>
                <?php }?>