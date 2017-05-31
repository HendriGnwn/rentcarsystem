<?php

use app\helpers\DetailViewHelper;
use app\models\Car;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Car */
?>
<div class="car-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'police_number',
            'year_out',
            'car_type',
            'color',
            'price',
            [
                'attribute' => 'status',
                'value' => $model->getStatusWithStyle(),
                'format' => 'raw',
            ],
            DetailViewHelper::dateTime($model, 'created_at'),
            DetailViewHelper::dateTime($model, 'updated_at'),
            DetailViewHelper::author($model, 'created_by'),
            DetailViewHelper::author($model, 'updated_by'),
        ],
    ]) ?>

</div>
