<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task}}`.
 */
class m200102_215239_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'name'=> $this->string()->notNull(),
            'author_id'=> $this->integer()->notNull(),
            'implementer_id'=> $this->integer()->notNull(),
            'description'=> $this->string()->notNull(),
            'deadline'=> $this->biginteger()->notNull(),
            'created_at'=> $this->biginteger()->notNull(),
            'updated_at'=> $this->biginteger()->notNull(),
        ]);
        $this->addForeignKey('fk-author_id-user', 'task', 'author_id', 'user', 'id');
        $this->addForeignKey('fk-implementer_id-user', 'task', 'implementer_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task}}');
        $this->dropForeignKey('fk-author_id-user', 'task', 'author_id', 'user', 'id');
        $this->dropForeignKey('fk-implementer_id-user', 'task', 'implementer_id', 'user', 'id');
    }
}
