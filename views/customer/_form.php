<?php

use app\models\Customer;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Customer */
/* @var $form ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
        ]
    ]); ?>

    <?= $form->field($model, 'identity_number')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'photoFile')->fileInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'join_at')->widget(DatePicker::className(), [
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
        ]
    ]) ?>

    <?= $form->field($model, 'status')->widget(Select2::className(), [
        'theme' => Select2::THEME_DEFAULT,
        'data' => Customer::statusLabels(),
    ]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
