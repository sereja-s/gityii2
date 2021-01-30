<?php

namespace common\models;


class KartikMenu extends \kartik\tree\models\Tree
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'kartik_menu';
	}

	public static function getTypeList()
	{
		return [
			'категория',
			'товар',
			'страница',
			'профайл',
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		$rules = parent::rules();
		$rules[] = ['content_type', 'integer', 'min' => 0];
		$rules[] = ['content_type', 'default', 'value' => 0];
		return $rules;
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		$attr = parent::attributeLabels();
		$attr['content_type'] = 'Тип';
		return $attr;
	}
}
