<?php

/** @var \App\Model\Report $report */
/** @var \App\Service\Router $router */

$title = "Report #{$report->getId()} ({$report->getReporter()})";
$bodyClass = 'show';

ob_start(); ?>
    <h1><?= htmlspecialchars($title) ?></h1>
    <article>
        <?= nl2br(htmlspecialchars($report->getDescription())) ?>
    </article>

    <ul class="action-list">
        <li> <a href="<?= $router->generatePath('report-index') ?>">Back to list</a></li>
        <li><a href="<?= $router->generatePath('report-edit', ['id'=> $report->getId()]) ?>">Edit</a></li>
    </ul>
<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
