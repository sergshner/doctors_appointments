<?php

use yii\db\Migration;

/**
 * Handles the creation for table `patients`.
 */
class m160707_145457_create_patients_table extends Migration
{
	private $_tableName = 'patients';
	
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
        	'name' => $this->string(1024)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {    	
        $this->dropTable($this->_tableName);
    }
}
