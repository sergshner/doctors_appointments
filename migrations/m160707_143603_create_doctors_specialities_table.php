<?php

use yii\db\Migration;

/**
 * Handles the creation for table `doctors_specialities`.
 */
class m160707_143603_create_doctors_specialities_table extends Migration
{
	
	private $_tableName = 'doctors_specialities';
	
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
        	'name' => $this->string(1024)->notNull(),
        ]);
        
        $this->batchInsert($this->_tableName, ['name'], [
        		['Кардиолог'],
        		['Гастроэнтеролог'],
        		['Невролог'],
        		['Хирург'],
        		['Офтальмолог'],
        		['ЛОР-врач'],
        		['Инфекционист'],
        		['Травматолог'],
        		['Терапевт'],
        		['Эндокринолог'],        		
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
