<?php

/** @var \App\Model\Report[] $reports */
/** @var \App\Service\Router $router */

$title = 'Report List';
$bodyClass = 'index';

ob_start(); ?>
    <h1>Reports List</h1>

    <a href="<?= $router->generatePath('report-create') ?>">Create new</a>

    <ul class="index-list">
        <?php foreach ($reports as $report): ?>
            <li><h3>Report #<?= $report->getId() ?> by <?= htmlspecialchars($report->getReporter()) ?></h3>
                <ul class="action-list">
                    <li><a href="<?= $router->generatePath('report-show', ['id' => $report->getId()]) ?>">Details</a></li>
                    <li><a href="<?= $router->generatePath('report-edit', ['id' => $report->getId()]) ?>">Edit</a></li>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>

<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
