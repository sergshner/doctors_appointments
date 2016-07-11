<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "doctors".
 *
 * @property integer $id
 * @property string $name
 * @property string $photo
 * @property string $description
 * @property integer $clinic_id
 * @property integer $speciality_id
 *
 * @property DoctorsSpecialities $speciality
 * @property Clinics $clinic
 */
class Doctors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'photo', 'description', 'clinic_id', 'speciality_id'], 'required'],
            [['clinic_id', 'speciality_id'], 'integer'],
            [['name'], 'string', 'max' => 1024],
            [['photo'], 'string', 'max' => 2048],
            [['description'], 'string', 'max' => 4096],
            [['speciality_id'], 'exist', 'skipOnError' => true, 'targetClass' => DoctorsSpecialities::className(), 'targetAttribute' => ['speciality_id' => 'id']],
            [['clinic_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clinics::className(), 'targetAttribute' => ['clinic_id' => 'id']],
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
            'photo' => Yii::t('app', 'Photo'),
            'description' => Yii::t('app', 'Description'),
            'clinic_id' => Yii::t('app', 'Clinic ID'),
            'speciality_id' => Yii::t('app', 'Speciality ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpeciality()
    {
        return $this->hasOne(DoctorsSpecialities::className(), ['id' => 'speciality_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClinic()
    {
        return $this->hasOne(Clinics::className(), ['id' => 'clinic_id']);
    }
}
