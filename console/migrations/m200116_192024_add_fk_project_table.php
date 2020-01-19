<?php

use yii\db\Migration;

/**
 * Class m200116_192024_add_fk_project_table
 */
class m200116_192024_add_fk_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-project-user_id',
            'project',
            'author_id',
            'user',
            'id'
        );
        $this->addForeignKey('fk-project-piority_id',
            'project',
            'priority_id',
            'priority',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-project-user_id', 'project');
        $this->dropForeignKey('fk-project-piority_id', 'project');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200116_192024_add_fk_project_table cannot be reverted.\n";

        return false;
    }
    */
}
