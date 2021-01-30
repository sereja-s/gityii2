<?php



use yii\helpers\Html;
use yii\widgets\DetailView;



/* @var $this yii\web\View */
/* @var $model common\models\Blog */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="blog-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<h2><?= Yii::$app->user->id ?> (<?= Yii::$app->user->identity->username ?>)</h2>
	<?php if (\Yii::$app->user->can('updatePost', ['author_id' => $model->user_id])) : ?>

		<p>
			<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
			<?= Html::a('Delete', ['delete', 'id' => $model->id], [
				'class' => 'btn btn-danger',
				'data' => [
					'confirm' => 'Are you sure you want to delete this item?',
					'method' => 'post',
				],
			]) ?>
		</p>
	<?php endif; ?>

	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id',
			'title',
			'text:ntext',
			'url:url',
			'status_id',
			'sort',
			'author.username',
			'author.email',
			'tagsAsString',
			'smallimage:image',
		],
	]) ?>

	<?php
	$fotorama = \metalguardian\fotorama\Fotorama::begin(
		[
			'options' => [
				'loop' => true,
				'hash' => true,
				'ratio' => 800 / 600,
			],
			'spinner' => [
				'lines' => 20,
			],
			'tagName' => 'span',
			'useHtmlData' => false,
			'htmlOptions' => [
				'class' => 'custom-class',
				'id' => 'custom-id',
			],
		]
	);
	foreach ($model->images as $one) {
		echo Html::img($one->ImageUrl, ['alt' => $one->alt]);
	}
	?>

	<?php \metalguardian\fotorama\Fotorama::end(); ?>

</div>