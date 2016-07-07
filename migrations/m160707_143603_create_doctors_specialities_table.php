<?php

use yii\db\Migration;

/**
 * Handles the creation for table `doctors_specialities`.
 */
class m160707_143603_create_doctors_specialities_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('doctors_specialities', [
            'id' => $this->primaryKey(),
        	'name' => $this->string(1024)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('doctors_specialities');
    }
}
