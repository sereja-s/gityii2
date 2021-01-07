<?php

namespace common\models;

use common\components\behaviors\StatusBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;



/**
 * This is the model class for table "blog".
 *
 * @property int $id
 * @property string $title
 * @property string|null $text
 * @property string $url
 * @property string $date_create
 * @property string $date_update
 * @property int $status_id
 * @property int $sort
 */
class Blog extends ActiveRecord
{
	const STATUS_LIST = ['off','on'];
	public $tags_array;
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'blog';
	}

	public function behaviors()
	{
		return [
			'timestampBehavior' => [
				'class' => TimestampBehavior::className(),
				'createdAtAttribute' => 'date_create',
				'updatedAtAttribute' => 'date_update',
				'value' => new Expression('NOW()'),
			],
			'statusBehavior' => [
				'class' => StatusBehavior::className(),
				'statusList' => self::STATUS_LIST,
			]
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['title', 'url'], 'required'],
			[['text'], 'string'],
			[['url'], 'unique'],
			[['status_id', 'sort'], 'integer'],
			[['sort'], 'integer', 'max' => 99, 'min' => 1],
			[['title', 'url'], 'string', 'max' => 150],
			[['tags_array', 'date_create', 'date_update'], 'safe'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'title' => 'Заголовок',
			'text' => 'Текст',
			'url' => 'ЧПУ',
			'status_id' => 'Статус',
			'sort' => 'Сортировка',
			'tags_array' => 'Теги',
			'tagsAsString' => 'Теги',
			'author.username' => 'Имя автора',
			'author.email' => 'Почта автора',
			'date_update' => 'Обновлено',
			'date_create' => 'Создано',
		];
	}

	public function getAuthor()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}
	public function getBlogTag()
	{
		return $this->hasMany(BlogTag::className(), ['blog_id' => 'id']);
	}
	public function getTags()
	{
		return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->via('blogTag');
	}
	public function getTagsAsString()
	{
		$arr = \yii\helpers\ArrayHelper::map($this->tags, 'id', 'name');
		return implode(', ', $arr);
	}
	public function afterFind()
	{
		parent::afterFind();
		$this->tags_array = $this->tags;
	}
	public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);

		$arr = \yii\helpers\ArrayHelper::map($this->tags, 'id', 'id');
		if ($this->tags_array) {
			foreach ($this->tags_array as $one) {
				if (!in_array($one, $arr)) {
					$model = new BlogTag();
					$model->blog_id = $this->id;
					$model->tag_id = $one;
					$model->save();
				}
				if (isset($arr[$one])) {
					unset($arr[$one]);
				}
			}
		}
		BlogTag::deleteAll(['tag_id' => $arr, 'blog_id' => $this->id]);
	}
}
