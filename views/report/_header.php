<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="box box-primary">
	<div class="box-body">
		<?php $form = ActiveForm::begin(['method' => 'get']); ?>
		
		<div class="col-md-3">
			<?= $form->field($model, 'start_date')->widget(\kartik\date\DatePicker::className(), [
				'pluginOptions' => [
					'format' => 'yyyy-mm-dd',
					'todayHighlight' => true,
					'autoclose' => true,
				]
			]) ?>
		</div>

		<div class="col-md-3">
			<?= $form->field($model, 'end_date')->widget(\kartik\date\DatePicker::className(), [
				'pluginOptions' => [
					'format' => 'yyyy-mm-dd',
					'todayHighlight' => true,
					'autoclose' => true,
				]
			]) ?>
		</div>
		<div class="col-md-12">
			<?= Html::submitButton('Search', ['class' =>'btn btn-success']) ?>
		</div>

		

		<?php ActiveForm::end(); ?>
	</div>
</div>
