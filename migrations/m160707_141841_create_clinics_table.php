<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `clinics`.
 */
class m160707_141841_create_clinics_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('clinics', [
            'id' => $this->primaryKey(),
        	'name' => $this->string(1024)->notNull(),
        	'address' => $this->string(1024)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('clinics');
    }
}
