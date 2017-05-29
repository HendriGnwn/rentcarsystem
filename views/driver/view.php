<?php

use app\helpers\DetailViewHelper;
use app\models\Driver;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Driver */
?>
<div class="driver-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'identity_number',
            'name',
            'address',
            'phone',
            DetailViewHelper::dateTime($model, 'join_at'),
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
