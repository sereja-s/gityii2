<?php

use common\models\KartikMenu;
use kartik\tree\TreeView;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\KartikMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kartik Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kartik-menu-index">



	<?= TreeView::widget([
		// single query fetch to render the tree
		// use the Product model you have in the previous step
		'query' => KartikMenu::find()->addOrderBy('root, lft'),
		'headingOptions' => ['label' => 'Categories'],
		'fontAwesome' => true,     // optional
		'isAdmin' => true,         // optional (toggle to enable admin mode)
		'displayValue' => 1,        // initial display value
		'softDelete' => true,       // defaults to true
		'cacheSettings' => [
			'enableCache' => false  // defaults to true
		],
		'nodeAddlViews' => [
			\kartik\tree\Module::VIEW_PART_2 => '@backend/views/kartik-menu/_form',
		]
	]); ?>

</div>