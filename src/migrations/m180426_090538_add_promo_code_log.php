<?php
use yii\db\Migration;

/**
 * Class m180426_090538_add_promo_code_log
 */
class m180426_090538_add_promo_code_log extends Migration
{
    /**
     * @return bool|void
     */
    public function safeUp()
    {
        $this->createTable('promo_code_log', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'promo_code_id' => $this->integer(),
            'operation_id' => $this->integer(),
            'deactivate_operation_id' => $this->integer(),
            'status_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'activated_at' => $this->integer(),
            'deactivated_at' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('promo_code_log');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180426_090536_add_promo_code cannot be reverted.\n";

        return false;
    }
    */
}
