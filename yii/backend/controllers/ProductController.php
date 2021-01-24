<?php

namespace backend\controllers;

use Yii;
use common\models\Product;
use common\models\ProductSearch;
use common\rules\AuthorRule;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}

	/**
	 * Lists all Product models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new ProductSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Product model.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new Product model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Product();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		}

		return $this->render('create', [
			'model' => $model,
		]);
	}

	/**
	 * Updates an existing Product model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		}

		return $this->render('update', [
			'model' => $model,
		]);
	}

	/**
	 * Deletes an existing Product model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Product model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Product the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Product::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}


	public function actionRole()
	{

		/* 		$admin = Yii::$app->authManager->createRole('admin');
		$admin->description = 'Администратор';
		Yii::$app->authManager->add($admin);

		$content = Yii::$app->authManager->createRole('content');
		$content->description = 'Контент менеджер';
		Yii::$app->authManager->add($content);

		$user = Yii::$app->authManager->createRole('user');
		$user->description = 'Пользователь';
		Yii::$app->authManager->add($user);

		$ban = Yii::$app->authManager->createRole('banned');
		$ban->description = 'Заблокирован';
		Yii::$app->authManager->add($ban);  */


		/* 		$permit = Yii::$app->authManager->createPermission('canAdmin');
		$permit->description = 'Право входа в админку';
		Yii::$app->authManager->add($permit); */


		/* 		$role_a = Yii::$app->authManager->getRole('admin');
		$role_c = Yii::$app->authManager->getRole('content');
		$permit = Yii::$app->authManager->getPermission('canAdmin');
		Yii::$app->authManager->addChild($role_a, $permit);
		Yii::$app->authManager->addChild($role_c, $permit); */


		/* 		$userRole = Yii::$app->authManager->getRole('admin');
		Yii::$app->authManager->assign($userRole, 1); */


		/* 		$permit = Yii::$app->authManager->createPermission('updatePost');
		$permit->description = 'Редактировать Post';
		Yii::$app->authManager->add($permit); */


		/* 		$auth = Yii::$app->authManager;
		$rule = new AuthorRule();
		$auth->add($rule);


		// добавляем право "updateOwnPost" и связываем правило с ним
		$updateOwnPost = $auth->createPermission('updateOwnPost');
		$updateOwnPost->description = 'Редактировать собственные записи';
		$updateOwnPost->ruleName = $rule->name;
		$auth->add($updateOwnPost); */




		return 12345;
	}
}
