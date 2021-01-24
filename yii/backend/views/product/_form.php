<?php

use kartik\datecontrol\DateControl;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'sklad_id')->dropDownList(\common\models\Sklad::getList()) ?>

	<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'cost')->textInput() ?>

	<?= $form->field($model, 'date')->widget(DateControl::className(), []) ?>

	<?= $form->field($model, 'type_id')->dropDownList(\common\models\Product::getTypeList()) ?>

	<?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

	<div class="form-group">
		<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>