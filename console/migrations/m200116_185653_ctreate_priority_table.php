<?php

use yii\db\Migration;

/**
 * Class m200116_185653_ctreate_priority_table
 */
class m200116_185653_ctreate_priority_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%priority}}', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(),
            'order'=> $this->text(),
            'type'=> $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%priority}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200116_185653_ctreate_priority_table cannot be reverted.\n";

        return false;
    }
    */
}
