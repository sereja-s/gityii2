<?php

namespace backend\controllers;

use common\models\ImageManager;
use Yii;


use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\base\DynamicModel;
use yii\helpers\FileHelper;
use yii\validators\Validator;
use yii\web\BadRequestHttpException;


/**
 * Site controller
 */
class SiteController extends Controller
{
	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['index'],
						'allow' => true,
						'roles' => ['canAdmin'],
					],
					[
						'actions' => ['login', 'error'],
						'allow' => true,
					],
					[
						'actions' => ['logout', 'save-redactor-img', 'save-img'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}

	/**
	 * Login action.
	 *
	 * @return string
	 */
	public function actionLogin()
	{
		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$this->layout = 'blank';

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->goBack();
		} else {
			$model->password = '';

			return $this->render('login', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Logout action.
	 *
	 * @return string
	 */
	public function actionLogout()
	{
		Yii::$app->user->logout();

		return $this->goHome();
	}

	public function actionSaveRedactorImg($sub = 'main')
	{
		$this->enableCsrfValidation = false;
		if (Yii::$app->request->isPost) {
			$dir = Yii::getAlias('@images') . '/' . $sub . '/';
			if (!file_exists($dir)) {
				FileHelper::createDirectory($dir);
			}
			$result_link = str_replace('admin.', '', Url::home(true)) . 'uploads/images/' . $sub . '/';
			$file = UploadedFile::getInstanceByName('file');
			$model = new DynamicModel(compact('file'));
			$model->addRule('file', 'image')->validate();

			if ($model->hasErrors()) {
				$result = [
					'error' => $model->getFirstError('file')
				];
			} else {

				$model->file->name = strtotime('now') . '_' . Yii::$app->getSecurity()->generateRandomString(6)  . '.' .
					$model->file->extension;
				if ($model->file->saveAs($dir . $model->file->name)) {
					$imag = Yii::$app->image->load($dir . $model->file->name);
					$imag->resize(375, NULL, Yii\image\drivers\Image::PRECISE)
						->save($dir . $model->file->name, 85);
					$result = ['filelink' => $result_link . $model->file->name, 'filename' => $model->file->name];
				} else {
					$result = [
						'error' => Yii::t('vova07/imperavi', 'ERROR_CAN_NOT_UPLOAD_FILE')
					];
				}
			}
			Yii::$app->response->format = Response::FORMAT_JSON;


			return $result;
		} else {
			throw new BadRequestHttpException('Only POST is allowed');
		}
	}
	public function actionSaveImg()
	{
		$this->enableCsrfValidation = false;
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			$dir = Yii::getAlias('@images') . '/' . $post['ImageManager']['class'] . '/';
			if (!file_exists($dir)) {
				FileHelper::createDirectory($dir);
			}
			$result_link = str_replace('admin.', '', Url::home(true)) . 'uploads/images/' . $post['class'] . '/';
			$file = UploadedFile::getInstanceByName('ImageManager[attachment]');
			$model = new ImageManager();
			$model->name = strtotime('now') . '_' . Yii::$app->getSecurity()->generateRandomString(6)  . '.' .
				$file->extension;
			$model->load($post);
			$model->validate();

			if ($model->hasErrors()) {
				$result = [
					'error' => $model->getFirstError('file')
				];
			} else {


				if ($file->saveAs($dir . $model->name)) {
					$imag = Yii::$app->image->load($dir . $model->name);
					$imag->resize(375, NULL, Yii\image\drivers\Image::PRECISE)
						->save($dir . $model->name, 85);
					$result = ['filelink' => $result_link . $model->name, 'filename' => $model->name];
				} else {
					$result = [
						'error' => 'ошибка'
					];
				}
				$model->save();
			}
			Yii::$app->response->format = Response::FORMAT_JSON;


			return $result;
		} else {
			throw new BadRequestHttpException('Only POST is allowed');
		}
	}
}
