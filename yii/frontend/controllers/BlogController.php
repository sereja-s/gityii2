<?php

namespace frontend\controllers;

use Yii;
use common\models\Blog;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Blogcontroller
 */
class BlogController extends Controller
{

	/**
	 * Displays homepage.
	 *
	 * @return mixed
	 */
	public function actionIndex()
	{
		$blogs = Blog::find()->with('author')->andWhere(['status_id' => 1])->orderBy('sort');
		$dataProvider = new ActiveDataProvider([
			'query' => $blogs,
			'pagination' => [
				'pageSize' => 5,
			],
		]);

		return $this->render('all', ['dataProvider' => $dataProvider]);
	}

	public function actionOne($url)
	{
		if ($blog = Blog::find()->andWhere(['url' => $url])->one()) {
			return $this->render('one', ['blog' => $blog]);
		}
		throw new NotFoundHttpException('ой, нет такого блога');
	}
}
