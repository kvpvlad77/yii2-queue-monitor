<?php
/**
 * @var \yii\web\View $this
 * @var \zhuravljov\yii\queue\monitor\records\PushRecord $record
 */

use yii\bootstrap\Html;
use yii\helpers\VarDumper;

echo $this->render('_view-nav', ['record' => $record]);

$this->params['breadcrumbs'][] = 'Data';
?>
<div class="monitor-job-data">
    <table class="table">
        <tbody>
        <tr>
            <th>class</th>
            <td><?= Html::encode(get_class($record->getJob())) ?></td>
        </tr>
        <?php foreach ($record->getJobParams() as $property => $value): ?>
            <tr>
                <th><?= Html::encode($property) ?></th>
                <td class="param-value"><?= VarDumper::dumpAsString($value) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
$this->registerCss(<<<CSS
td.param-value {
    word-break: break-all;
}
CSS
);