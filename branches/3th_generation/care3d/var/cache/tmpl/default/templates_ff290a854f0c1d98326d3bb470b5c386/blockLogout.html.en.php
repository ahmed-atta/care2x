<p>
    <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("user"));?>:
    <span><?php echo htmlspecialchars($t->loggedOnUser);?></span>
</p>
<p>
    <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("session started at"));?>:
    <span><?php echo htmlspecialchars($t->loggedOnSince);?></span>
</p>
<p>
    <a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeUrl'))) echo htmlspecialchars($t->makeUrl("logout","login","user"));?>"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo htmlspecialchars($t->translate("logout","ucfirst"));?></a>
</p>
