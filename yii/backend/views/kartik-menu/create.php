<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\KartikMenu */

$this->title = 'Create Kartik Menu';
$this->params['breadcrumbs'][] = ['label' => 'Kartik Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kartik-menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
