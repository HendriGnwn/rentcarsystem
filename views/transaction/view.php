<?php

use app\helpers\DetailViewHelper;
use app\models\Transaction;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Transaction */
?>
<div class="transaction-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            [
                'attribute' => 'customer_id',
                'value' => $model->customer->combineAttribute,
            ],
            [
                'attribute' => 'car_id',
                'value' => $model->car->combineAttribute,
            ],
            [
                'attribute' => 'driver_id',
                'value' => isset($model->driver) ? $model->driver->combineAttribute : $model->driver_id,
            ],
            DetailViewHelper::date($model, 'rent_at'),
            DetailViewHelper::date($model, 'rent_finish_at'),
            'actualy_total',
            'bill_total',
            [
                'attribute' => 'status',
                'value' => $model->getStatusWithStyle(),
                'format' => 'raw',
            ],
            [
                'attribute' => 'status_payment',
                'value' => $model->getStatusPaymentWithStyle(),
                'format' => 'raw',
            ],
            DetailViewHelper::author($model, 'user_id'),
            DetailViewHelper::dateTime($model, 'created_at'),
            DetailViewHelper::dateTime($model, 'updated_at'),
            DetailViewHelper::author($model, 'created_by'),
            DetailViewHelper::author($model, 'updated_by'),
        ],
    ]) ?>

</div>
