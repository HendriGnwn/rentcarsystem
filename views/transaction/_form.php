<?php

use app\helpers\Url;
use app\models\Car;
use app\models\Customer;
use app\models\Driver;
use app\models\Transaction;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Transaction */
/* @var $form ActiveForm */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_id')->widget(Select2::className(), [
        'data' => ArrayHelper::map(Customer::find()->actived()->orderBy(['name' => SORT_ASC])->all(), 'id', 'combineAttribute'),
        'options' => [
            'prompt' => 'Choose One',
        ]
    ]) ?>

    <?= $form->field($model, 'car_id')->widget(Select2::className(), [
        'data' => ArrayHelper::map(Car::find()->actived()->orderBy(['year_out' => SORT_DESC])->all(), 'id', 'combineAttribute'),
        'options' => [
            'prompt' => 'Choose One',
        ]
    ]) ?>

    <?= $form->field($model, 'driver_id')->widget(Select2::className(), [
        'data' => ArrayHelper::map(Driver::find()->actived()->orderBy(['name' => SORT_ASC])->all(), 'id', 'combineAttribute'),
        'options' => [
            'prompt' => 'Choose One',
        ]
    ]) ?>

    <?= $form->field($model, 'rent_at')->widget(DatePicker::className(), [
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
    ]) ?>

    <?= $form->field($model, 'rent_finish_at')->widget(DatePicker::className(), [
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ],
    ]) ?>

    <?= $form->field($model, 'actualy_total')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'status_payment')->widget(Select2::className(), [
        'theme' => Select2::THEME_DEFAULT,
        'data' => Transaction::statusPaymentLabels(),
    ]) ?>

    <?= $form->field($model, 'bill_total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->widget(Select2::className(), [
        'theme' => Select2::THEME_DEFAULT,
        'data' => Transaction::statusLabels(),
    ]) ?>
    
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

<?php

$this->registerJs("

    var actually = $('#transaction-actualy_total');
    var carId = $('#transaction-car_id');
    var rentAt = $('#transaction-rent_at');
    var finishAt = $('#transaction-rent_finish_at');
    
    carId.change(function() {
    
        $.post('". Url::to(['/transaction/ajax-calculate-actually-total']) ."', {car_id: carId.val(), rent_at:rentAt.val(), finish_at: finishAt.val()}, function(response) {
            console.log(response);
            actually.val(response);
        });
    });

    finishAt.change(function() {
    
        $.post('". Url::to(['/transaction/ajax-calculate-actually-total']) ."', {car_id: carId.val(), rent_at:rentAt.val(), finish_at: $(this).val()}, function(response) {
            console.log(response);
            actually.val(response);
        });
    });
    
    rentAt.change(function() {
    
        $.post('". Url::to(['/transaction/ajax-calculate-actually-total']) ."', {car_id: carId.val(), rent_at:$(this).val(), finish_at:finishAt.val()}, function(response) {
            console.log(response);
            actually.val(response);
        });
    });

", View::POS_END, 'form');
