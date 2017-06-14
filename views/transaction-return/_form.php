<?php

use app\models\Transaction;
use app\models\TransactionReturn;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model TransactionReturn */
/* @var $form ActiveForm */
?>

<div class="transaction-return-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'transaction_id')->widget(Select2::className(), [
			'data' => ArrayHelper::map(Transaction::find()->where(['status' => Transaction::STATUS_RENT])->all(), 'id', 'combineAttribute'),
			'options' => [
				'prompt' => 'Choose One',
			]
		]) ?>
	
	<div class="box box-primary">
		<div class="box-header with-border">
			Transaction Details
		</div>
		<div class="box-body">
			<table class="table table-condensed">
				<tr>
					<td width="20%">Car</td>
					<td width="5%">:</td>
					<td id="car-detail"></td>
				</tr>
				<tr>
					<td>Customer</td>
					<td>:</td>
					<td id="customer-detail"></td>
				</tr>
				<tr>
					<td>Driver</td>
					<td>:</td>
					<td id="driver-detail"></td>
				</tr>
				<tr>
					<td>Bill Total</td>
					<td>:</td>
					<td id="bill-detail"></td>
				</tr>
			</table>
		</div>
	</div>

    <?= $form->field($model, 'return_at')->widget(\kartik\date\DatePicker::className(), [
		'pluginOptions' => [
			'todayHighlight' => true,
			'format' => 'yyyy-mm-dd',
		],
		'options' => [
			'value' => $model->isNewRecord ? date('Y-m-d') : $model->return_at,
		]
	]) ?>
	
    <?= $form->field($model, 'total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

<?php

$this->registerJs("
	
	var transactionId = $('#transactionreturn-transaction_id'),
		carDetail = $('#car-detail'),
		customerDetail = $('#customer-detail'),
		driverDetail = $('#driver-detail'),
		billDetail = $('#bill-detail'),
		total = $('#transactionreturn-total');
		
	transactionId.change(function() {
		$.get('" . yii\helpers\Url::to(['transaction/ajax-find-by-id']) . "?id='+transactionId.val(), function(response) {
			carDetail.html(response.car.car_type);
			customerDetail.html(response.customer.name);
			driverDetail.html(response.driver.name);
			billDetail.html(response.actualy_total - response.bill_total);
			total.val(response.actualy_total - response.bill_total);
		});
	});

", View::POS_END, 'returns');
