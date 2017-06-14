<?php

use app\models\Transaction;
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'code',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'customer_id',
        'content' => function ($model) {
            return $model->customer->combineAttribute;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'car_id',
        'content' => function ($model) {
            return $model->car->police_number;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'rent_at',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'rent_finish_at',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status_payment',
        'filter' => Transaction::statusPaymentLabels(),
        'content' => function ($model) {
            return $model->getStatusPaymentWithStyle();
        }
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'rent_finish_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'actualy_total',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'bill_total',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'status',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'status_payment',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'user_id',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_by',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated_by',
    // ],
    

];   