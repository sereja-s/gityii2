<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "time".
 *
 * @property int $id
 * @property string|null $time
 * @property string|null $date
 * @property string|null $datetime
 */
class Time extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'time';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time', 'date', 'datetime'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => 'Time',
            'date' => 'Date',
            'datetime' => 'Datetime',
        ];
    }
}
