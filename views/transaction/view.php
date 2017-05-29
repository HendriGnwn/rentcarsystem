<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Transaction */
?>
<div class="transaction-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            'customer_id',
            'car_id',
            'driver_id',
            'rent_at',
            'rent_finish_at',
            'actualy_total',
            'bill_total',
            'status',
            'status_payment',
            'user_id',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
