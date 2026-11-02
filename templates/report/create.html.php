<?php

/** @var \App\Model\Post $post */
/** @var \App\Service\Router $router */

$title = 'Create Report';
$bodyClass = "create";

ob_start(); ?>
    <h1>Create Report</h1>
    <form action="<?= $router->generatePath('report-create') ?>" method="post" class="edit-form">
        <?php require __DIR__ . DIRECTORY_SEPARATOR . '_form.html.php'; ?>
        <input type="hidden" name="action" value="report-create">
    </form>

    <a href="<?= $router->generatePath('report-index') ?>">Back to list</a>
<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
