<?php

use yii\bootstrap\Html;

?>
<div class="col-lg-12">
	<h2><?= $model->title ?><span class="badge"><?= $model->author->username ?></span>
		<span class="badge"><?= $model->author->email ?></span></h2>
	<?= $model->text ?>
	<?= Html::a('ПОДРОБНЕЕ', ['blog/one', 'url' => $model->url], ['class' => 'btn btn-success']) ?>
</div>