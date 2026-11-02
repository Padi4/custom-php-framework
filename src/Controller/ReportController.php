<?php
namespace App\Controller;

use App\Exception\NotFoundException;
use App\Model\Report;
use App\Service\Router;
use App\Service\Templating;

class ReportController
{
    public function indexAction(Templating $templating, Router $router): ?string
    {
        $reports = Report::findAll();
        $html = $templating->render('report/index.html.php', [
            'reports' => $reports,
            'router' => $router,
        ]);
        return $html;
    }

    public function createAction(?array $requestReport, Templating $templating, Router $router): ?string
    {
        if ($requestReport) {
            $report = Report::fromArray($requestReport);
            // @todo missing validation
            $report->save();

            $path = $router->generatePath('report-index');
            $router->redirect($path);
            return null;
        } else {
            $report = new Report();
        }

        $html = $templating->render('report/create.html.php', [
            'report' => $report,
            'router' => $router,
        ]);
        return $html;
    }

    public function editAction(int $reportId, ?array $requestReport, Templating $templating, Router $router): ?string
    {
        $report = Report::find($reportId);
        if (! $report) {
            throw new NotFoundException("Missing report with id $reportId");
        }

        if ($requestReport) {
            $report->fill($requestReport);
            // @todo missing validation
            $report->save();

            $path = $router->generatePath('report-index');
            $router->redirect($path);
            return null;
        }

        $html = $templating->render('report/edit.html.php', [
            'report' => $report,
            'router' => $router,
        ]);
        return $html;
    }

    public function showAction(int $reportId, Templating $templating, Router $router): ?string
    {
        $report = Report::find($reportId);
        if (! $report) {
            throw new NotFoundException("Missing report with id $reportId");
        }

        $html = $templating->render('report/show.html.php', [
            'report' => $report,
            'router' => $router,
        ]);
        return $html;
    }

    public function deleteAction(int $reportId, Router $router): ?string
    {
        $report = Report::find($reportId);
        if (! $report) {
            throw new NotFoundException("Missing report with id $reportId");
        }

        $report->delete();
        $path = $router->generatePath('report-index');
        $router->redirect($path);
        return null;
    }
}
