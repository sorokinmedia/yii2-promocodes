<?php
use yii\db\Migration;

/**
 * Class m180426_090536_add_promo_code
 */
class m180426_090536_add_promo_code extends Migration
{
    /**
     * @return bool|void
     */
    public function safeUp()
    {
        $this->createTable('promo_code', [
            'id' => $this->primaryKey(),
            'value' => $this->string(255),
            'title' => $this->string(255),
            'description' => $this->string(255),
            'cat_id' => $this->integer(),
            'type_id' => $this->integer(),
            'creator_id' => $this->integer(),
            'beneficiary_id' => $this->integer(),
            'date_from' => $this->integer(),
            'date_to' => $this->integer(),
            'sum_promo' => $this->money(19,4),
            'sum_recharge' => $this->money(19,4),
            'discount_fixed' => $this->money(19,4),
            'discount_percentage' => $this->integer(3),
            'is_available_old' => $this->boolean()->defaultValue(false),
            'is_deleted' => $this->boolean()->defaultValue(false),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('promo_code');
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
