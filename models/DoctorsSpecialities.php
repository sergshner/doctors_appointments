<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "doctors_specialities".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Doctors[] $doctors
 */
class DoctorsSpecialities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctors_specialities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoctors()
    {
        return $this->hasMany(Doctors::className(), ['speciality_id' => 'id']);
    }
}
