<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appointments".
 *
 * @property integer $id
 * @property string $title
 * @property string $start
 * @property string $end
 * @property integer $doctor_id
 *
 * @property Doctors $doctor
 */
class Appointments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'appointments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'start', 'end', 'doctor_id'], 'required'],
            [['start', 'end'], 'safe'],
            [['doctor_id'], 'integer'],
            [['title'], 'string', 'max' => 1024],
            [['doctor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Doctors::className(), 'targetAttribute' => ['doctor_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'start' => Yii::t('app', 'Start'),
            'end' => Yii::t('app', 'End'),
            'doctor_id' => Yii::t('app', 'Doctor ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoctor()
    {
        return $this->hasOne(Doctors::className(), ['id' => 'doctor_id']);
    }
}
