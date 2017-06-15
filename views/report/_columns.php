<?php

use app\models\Car;
use app\models\Customer;
use app\models\Transaction;
use app\models\User;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

return [
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
		'attribute'=>'customer_id', 
		'vAlign'=>'middle',
		'value'=>function ($model, $key, $index, $widget) { 
			return $model->customer->name;
		},
		'filterType'=>GridView::FILTER_SELECT2,
		'filter'=>ArrayHelper::map(Customer::find()->orderBy('name')->actived()->all(), 'id', 'name'), 
		'filterWidgetOptions'=>[
			'pluginOptions'=>['allowClear'=>true],
		],
		'filterInputOptions'=>['placeholder'=>'Select'],
		'format'=>'raw'
	],
	[
		'attribute'=>'car_id', 
		'vAlign'=>'middle',
		'value'=>function ($model, $key, $index, $widget) { 
			return $model->car->car_type;
		},
		'filterType'=>GridView::FILTER_SELECT2,
		'filter'=>ArrayHelper::map(Car::find()->actived()->all(), 'id', 'car_type'), 
		'filterWidgetOptions'=>[
			'pluginOptions'=>['allowClear'=>true],
		],
		'filterInputOptions'=>['placeholder'=>'Select'],
		'format'=>'raw'
	],
	[
		'class'=>'\kartik\grid\DataColumn',
		'attribute'=>'rent_at', 
		'vAlign'=>'middle',
		'value'=>function ($model, $key, $index, $widget) { 
			return $model->rent_at;
		},
		'filterType'=>GridView::FILTER_DATE,
		'filterWidgetOptions'=>[
			'pluginOptions'=>['todayHighlight'=>true, 'format' => 'yyyy-mm-dd', 'autoclose'=>true],
		],
		'filterInputOptions'=>['placeholder'=>'Select'],
		'format'=>'raw'
	],
    [
		'class'=>'\kartik\grid\DataColumn',
		'attribute'=>'rent_finish_at', 
		'vAlign'=>'middle',
		'value'=>function ($model, $key, $index, $widget) { 
			return $model->rent_finish_at;
		},
		'filterType'=>GridView::FILTER_DATE,
		'filterWidgetOptions'=>[
			'pluginOptions'=>['todayHighlight'=>true, 'format' => 'yyyy-mm-dd', 'autoclose'=>true],
		],
		'filterInputOptions'=>['placeholder'=>'Select'],
		'format'=>'raw'
	],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status',
        'filter' => Transaction::statusLabels(),
        'content' => function ($model) {
            return $model->getStatusWithStyle();
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status_payment',
        'filter' => Transaction::statusPaymentLabels(),
        'content' => function ($model) {
            return $model->getStatusPaymentWithStyle();
        }
    ],
	[
		'class'=>'\kartik\grid\DataColumn',
		'attribute'=>'actualy_total',
	],
	[
		'class'=>'\kartik\grid\DataColumn',
		'attribute'=>'created_at',
	],
	[
		'attribute'=>'user_id', 
		'vAlign'=>'middle',
		'value'=>function ($model, $key, $index, $widget) { 
			return $model->user->username;
		},
		'filterType'=>GridView::FILTER_SELECT2,
		'filter'=>ArrayHelper::map(User::find()->all(), 'id', 'username'), 
		'filterWidgetOptions'=>[
			'pluginOptions'=>['allowClear'=>true],
		],
		'filterInputOptions'=>['placeholder'=>'Select'],
		'format'=>'raw'
	],
];   