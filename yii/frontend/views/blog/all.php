<?php

/* @var $this yii\web\View */

/* @var $dataProvider\yii\data\ActiveDataProvider */

$blog = $dataProvider->getModels();

?>

<div class="body-content">
	<?= \yii\widgets\ListView::widget([
		'dataProvider' => $dataProvider,
		'itemView' => '_one',
	]);
	?>


</div>