<?php
/**
 * @var \yii\web\View $this
 * @var \zhuravljov\yii\queue\monitor\filters\JobFilter $filter
 */

use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
use zhuravljov\yii\widgets\DateRangePicker;

?>
<div class="monitor-job-search">
    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['index'],
        'enableClientValidation' => false,
    ]) ?>
    <div class="row">
        <div class="col-lg-12 col-md-4 col-sm-6">
            <?= $form->field($filter, 'is')->dropDownList($filter->statusList(), ['prompt' => '']) ?>
        </div>
        <div class="col-lg-12 col-md-4 col-sm-6">
            <?= $form->field($filter, 'sender')->textInput(['list' => 'job-sender']) ?>
            <?= $this->render('_data-list', ['id' => 'job-sender', 'values' => $filter->senderList()]) ?>
        </div>
        <div class="col-lg-12 col-md-4 col-sm-6">
            <?= $form->field($filter, 'uid') ?>
        </div>
        <div class="col-lg-12 col-md-4 col-sm-6">
            <?= $form->field($filter, 'class')->textInput(['list' => 'job-class']) ?>
            <?= $this->render('_data-list', ['id' => 'job-class', 'values' => $filter->classList()]) ?>
        </div>
        <div class="col-lg-12 col-md-4 col-sm-6">
            <?= $form->field($filter, 'delay') ?>
        </div>
        <div class="col-lg-12 col-md-4 col-sm-6">
            <?= $form->field($filter, 'pushed')->widget(DateRangePicker::class, [
                'clientOptions' => [
                    'opens' => 'left',
                    'autoUpdateInput' => false,
                    'alwaysShowCalendars' => true,
                    'ranges' => [
                        'Today' => [
                            new JsExpression('moment()'),
                            new JsExpression('moment()'),
                        ],
                        'Yesterday' => [
                            new JsExpression('moment().subtract(1, "days")'),
                            new JsExpression('moment().subtract(1, "days")'),
                        ],
                        'Last Week' => [
                            new JsExpression('moment().subtract(6, "days")'),
                            new JsExpression('moment()'),
                        ],
                    ],
                    'locale' => [
                        'format' => 'YYYY-MM-DD',
                        'separator' => ' - ',
                        'cancelLabel' => 'For all time',
                    ],
                ],
                'clientEvents' => [
                    'apply.daterangepicker' => 'function (ev, picker) { $(this).val(picker.startDate.format(picker.locale.format) + picker.locale.separator + picker.endDate.format(picker.locale.format)); }',
                    'cancel.daterangepicker' => 'function (ev, picker) { $(this).val(""); }',
                ],
            ]) ?>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">
        <span class="glyphicon glyphicon-search"></span>
        Search
    </button>
    <?php ActiveForm::end() ?>
</div>