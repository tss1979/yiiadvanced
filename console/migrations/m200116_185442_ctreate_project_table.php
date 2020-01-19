<?php

use yii\db\Migration;

/**
 * Class m200116_185442_ctreate_project_table
 */
class m200116_185442_ctreate_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project}}', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(),
            'author_id'=> $this->integer(),
            'description'=> $this->text(),
            'created_at'=> $this->bigInteger(),
            'updated_at'=> $this->bigInteger(),
            'priority_id'=> $this->integer(),
            'status'=> $this->string()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%project}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200116_185442_ctreate_project_table cannot be reverted.\n";

        return false;
    }
    */
}
