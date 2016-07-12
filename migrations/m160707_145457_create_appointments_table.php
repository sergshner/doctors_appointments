<?php

use yii\db\Migration;

/**
 * Handles the creation for table `patients`.
 */
class m160707_145457_create_appointments_table extends Migration
{
	private $_tableName = 'appointments';
	private $_tableName_Doctors = 'doctors';
	
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
        	'title' => $this->string(1024)->notNull(),
        	'start' => $this->integer()->unsigned()->notNull(),
        	'end' => $this->integer()->unsigned()->notNull(),
        	'doctor_id' => $this->integer()->notNull(),
        ]);
        
        $this->addForeignKey('fk-appointments-doctor_id', $this->_tableName, 'doctor_id', $this->_tableName_Doctors, 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {    	
    	$this->dropForeignKey('fk-appointments-doctor_id', $this->_tableName);
        $this->dropTable($this->_tableName);
    }
}
