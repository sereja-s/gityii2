<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sklad".
 *
 * @property int $id
 * @property string|null $title
 * @property string $adress
 */
class Sklad extends \yii\db\ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'sklad';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['adress'], 'required'],
			[['title'], 'string', 'max' => 50],
			[['adress'], 'string', 'max' => 255],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'title' => 'Title',
			'adress' => 'Adress',
		];
	}

	public static function getList()
	{
		return \yii\helpers\ArrayHelper::map(self::find()->all(), 'id', 'title');
	}
}
