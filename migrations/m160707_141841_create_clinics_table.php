<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `clinics`.
 */
class m160707_141841_create_clinics_table extends Migration
{
	private $_tableName = 'clinics';
	
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
        	'name' => $this->string(1024)->notNull(),
        	'address' => $this->string(1024)->notNull(),
        ]);
        
        $this->batchInsert($this->_tableName, ['name', 'address'], [
        		['Медицинский центр «Альтермед»', 'м.Звездная, Большевиков, Просвещения, Ленинский.'],
        		['Скандинавия', 'ул. Беринга, 27, Санкт-Петербург, Ленинградская обл., 199397'],
        		['Медицинская Клиника "А-МЕД"', 'ул. Коллонтай, 5/1'],
        		['Медицинский центр МАРТ', 'Малый проспект В.О., 54, к. 3'],
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
