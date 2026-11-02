<?php
/** @var $report ?\App\Model\Report $report */
?>

<div class="form-group">
    <label for="reporter">Reporter</label>
    <input type="text" id="reporter" name="report[reporter]" value="<?= $report ? $report->getReporter() : '' ?>">
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea id="description" name="report[description]"><?= $report? $report->getDescription() : '' ?></textarea>
</div>

<div class="form-group">
    <label></label>
    <input type="submit" value="Submit">
</div>
