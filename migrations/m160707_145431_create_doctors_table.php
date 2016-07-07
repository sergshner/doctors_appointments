<?php

use yii\db\Migration;

/**
 * Handles the creation for table `doctors`.
 */
class m160707_145431_create_doctors_table extends Migration
{
	private $_tableName = 'doctors';
	private $_tableName_Clinics = 'clinics';
	private $_tableName_Doctors_Specialities = 'doctors_specialities';
	
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
        	'name' => $this->string(1024)->notNull(),
        	'photo' => $this->string(2048)->notNull(),
        	'description' => $this->string(4096)->notNull(),
        	'clinic_id' => $this->integer()->notNull(),
        	'speciality_id' => $this->integer()->notNull(),        		
        ]);
        
        $this->addForeignKey('fk-doctors-clinic_id', $this->_tableName, 'clinic_id', $this->_tableName_Clinics, 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk-doctors-speciality_id', $this->_tableName, 'speciality_id', $this->_tableName_Doctors_Specialities, 'id', 'RESTRICT', 'CASCADE');
        
        $this->batchInsert($this->_tableName, ['name', 'photo', 'description', 'clinic_id', 'speciality_id'], [
        		['Голубева Любовь Вячеславовна', 'https://new.onedoc.ru/upload/doctors/thumb/5f/Golubeva_Lubov.jpg', 'Врач Голубева Любовь Вячеславовна - лор (отоларинголог) со стажем врачебной практики 29 лет', 1, 1],
        		['Черникова Алиса Валентиновна', 'https://new.onedoc.ru/upload/doctors/thumb/93/Chernikova_Alisa.jpg', 'Врач Черникова Алиса Валентиновна - лор (отоларинголог) со стажем врачебной практики 16 лет.', 1, 1],
        		['Самойлов Юрий Сергеевич', 'https://new.onedoc.ru/upload/doctors/thumb/e5/Samoylov_Uriy.jpg', 'рач Самойлов Юрий Сергеевич - лор (отоларинголог) со стажем врачебной практики 9 лет.', 1, 1],
        		['Юрескул Наталья Викторовна', 'https://new.onedoc.ru/upload/doctors/thumb/e8/Iureskul_Natalia.jpg', 'Врач Юрескул Наталья Викторовна - лор (отоларинголог) со стажем врачебной практики 19 лет.', 1, 1],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
    	$this->dropForeignKey('fk-doctors-clinic_id', $this->_tableName);
    	$this->dropForeignKey('fk-doctors-speciality_id', $this->_tableName);
        $this->dropTable($this->_tableName);
    }
}
