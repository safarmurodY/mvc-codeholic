<?php

use Safarmurod\PhpMvcCore\Application;

?>
<h1>Hi Welcome
    <?php if (Application::isGuest()): ?>
        Guest
    <?php else: ?>
        <?= Application::$app->user->getDisplayName() ?>
    <?php endif; ?>
</h1>