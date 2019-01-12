<?php
use yii\db\Migration;

/**
 * Class m180426_090537_add_promo_code_category
 */
class m180426_090537_add_promo_code_category extends Migration
{
    /**
     * @return bool|void
     */
    public function safeUp()
    {
        $this->createTable('promo_code_category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'parent_id' => $this->integer(),
            'has_child' => $this->boolean()->defaultValue(false),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('promo_code_category');
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
