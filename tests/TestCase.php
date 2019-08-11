<?php
namespace sorokinmedia\promocodes\tests;

use yii\console\Application;
use yii\db\Connection;
use yii\db\Schema;

/**
 * Class TestCase
 * @package sorokinmedia\promocodes\tests
 */
abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @throws \yii\base\InvalidConfigException
     */
    protected function setUp()
    {
        parent::setUp();
        $this->mockApplication();
    }

    /**
     *
     */
    protected function tearDown()
    {
        $this->destroyApplication();
        parent::tearDown();
    }

    /**
     * @throws \yii\base\InvalidConfigException
     */
    protected function mockApplication()
    {
        new Application([
            'id' => 'testapp',
            'basePath' => __DIR__,
            'vendorPath' => dirname(__DIR__) . '/vendor',
            'runtimePath' => __DIR__ . '/runtime',
            'aliases' => [
                '@tests' => __DIR__,
            ],
        ]);
    }

    /**
     *
     */
    protected function destroyApplication()
    {
        \Yii::$app = null;
    }

    /**
     * инициализация нужных таблиц
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function initDb()
    {
        @unlink(__DIR__ . '/runtime/sqlite.db');
        $db = new Connection([
            'dsn' => 'sqlite:' . \Yii::$app->getRuntimePath() . '/sqlite.db',
            'charset' => 'utf8',
        ]);
        \Yii::$app->set('db', $db);
        if ($db->getTableSchema('user')){
            $db->createCommand()->dropTable('user')->execute();
        }
        $db->createCommand()->createTable('user', [
            'id' => Schema::TYPE_PK,
            'email' => Schema::TYPE_STRING . '(255) NOT NULL',
            'password_hash' => Schema::TYPE_STRING . '(60) NOT NULL',
            'password_reset_token' =>Schema::TYPE_STRING . '(255)',
            'auth_key' => Schema::TYPE_STRING . '(45)',
            'username' => Schema::TYPE_STRING . '(255) NOT NULL',
            'status_id' => Schema::TYPE_TINYINT,
            'created_at' => Schema::TYPE_INTEGER . '(11)',
            'last_entering_date' => Schema::TYPE_INTEGER . '(11)',
            'email_confirm_token' => Schema::TYPE_STRING . '(255)'
        ])->execute();
        if ($db->getTableSchema('user_meta')){
            $db->createCommand()->dropTable('user_meta')->execute();
        }
        $db->createCommand()->createTable('user_meta', [
            'user_id' => Schema::TYPE_INTEGER,
            'notification_email' => Schema::TYPE_STRING . '(255)',
            'notification_phone' => Schema::TYPE_JSON,
            'notification_telegram' => Schema::TYPE_INTEGER,
            'full_name' => Schema::TYPE_JSON,
            'display_name' => Schema::TYPE_STRING . '(500)',
            'tz' => Schema::TYPE_STRING . '(100)',
            'location' => Schema::TYPE_STRING . '(200)',
            'about' => Schema::TYPE_TEXT,
            'custom_fields' => Schema::TYPE_JSON,
            'PRIMARY KEY(user_id)',
        ])->execute();
        if ($db->getTableSchema('user_access_token')){
            $db->createCommand()->dropTable('user_access_token')->execute();
        }
        $db->createCommand()->createTable('user_access_token', [
            'user_id' => Schema::TYPE_INTEGER,
            'access_token' => Schema::TYPE_STRING . '(32) NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . '(11)',
            'updated_at' => Schema::TYPE_INTEGER . '(11)',
            'expired_at' => Schema::TYPE_INTEGER . '(11)',
            'is_active' => Schema::TYPE_TINYINT,
            'PRIMARY KEY(user_id, access_token)',
        ])->execute();

        if ($db->getTableSchema('promo_code')){
            $db->createCommand()->dropTable('promo_code')->execute();
        }
        $db->createCommand()->createTable('promo_code', [
            'id' => Schema::TYPE_PK,
            'value' => Schema::TYPE_STRING . '(255) NOT NULL',
            'title' => Schema::TYPE_STRING . '(255) NOT NULL',
            'description' => Schema::TYPE_STRING . '(255)',
            'cat_id' => Schema::TYPE_INTEGER,
            'type_id' => Schema::TYPE_INTEGER,
            'creator_id' => Schema::TYPE_INTEGER,
            'beneficiary_id' => Schema::TYPE_INTEGER,
            'date_from' => Schema::TYPE_INTEGER,
            'date_to' => Schema::TYPE_INTEGER,
            'sum_promo' => Schema::TYPE_MONEY,
            'sum_recharge' => Schema::TYPE_MONEY,
            'discount_fixed' => Schema::TYPE_MONEY,
            'discount_percentage' => Schema::TYPE_INTEGER,
            'is_available_old' => Schema::TYPE_TINYINT,
            'is_deleted' => Schema::TYPE_TINYINT
        ])->execute();

        if ($db->getTableSchema('promo_code_category')){
            $db->createCommand()->dropTable('promo_code_category')->execute();
        }
        $db->createCommand()->createTable('promo_code_category', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'parent_id' => Schema::TYPE_INTEGER,
            'has_child' => Schema::TYPE_TINYINT,
            'is_deleted' => Schema::TYPE_TINYINT,
        ])->execute();

        if ($db->getTableSchema('promo_code_log')){
            $db->createCommand()->dropTable('promo_code_log')->execute();
        }
        $db->createCommand()->createTable('promo_code_log', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER,
            'promo_code_id' => Schema::TYPE_INTEGER,
            'operation_id' => Schema::TYPE_INTEGER,
            'deactivate_operation_id' => Schema::TYPE_INTEGER,
            'status_id' => Schema::TYPE_INTEGER,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
            'activated_at' => Schema::TYPE_INTEGER,
            'deactivated_at' => Schema::TYPE_INTEGER
        ])->execute();

        $this->initDefaultData();
    }

    /**
     * дефолтный набор данных для тестов
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function initDefaultData()
    {
        $db = new Connection([
            'dsn' => 'sqlite:' . \Yii::$app->getRuntimePath() . '/sqlite.db',
            'charset' => 'utf8',
        ]);
        \Yii::$app->set('db', $db);
        $db->createCommand()->insert('user', [
            'id' => 1,
            'email' => 'test@yandex.ru',
            'password_hash' => '$2y$13$965KGf0VPtTcQqflsIEDtu4kmvM4mstARSbtRoZRiwYZkUqCQWmcy',
            'password_reset_token' => null,
            'auth_key' => 'NdLufkTZDHMPH8Sw3p5f7ukUXSXllYwM',
            'username' => 'IvanSidorov',
            'status_id' => 1,
            'created_at' => 1460902430,
            'last_entering_date' => 1532370359,
            'email_confirm_token' => null,
        ])->execute();
        $db->createCommand()->insert('user_access_token', [
            'user_id' => 1,
            'access_token' => 'a188dd6d0a16071691c0a6247ed76ed4',
            'created_at' => 1528365638,
            'updated_at' => null,
            'expired_at' => null,
            'is_active' => 1,
        ])->execute();
        $db->createCommand()->insert('user_meta', [
            'user_id' => 1,
            'notification_email' => 'test1@yandex.ru',
            'notification_phone' => '{"number": 9198078281, "country": 7, "is_verified": true}',
            'notification_telegram' => 12345678,
            'full_name' => '{"name": "Руслан", "surname": "Гилязетдинов", "patronymic": "Рашидович"}',
            'tz' => 'Europe/Samara',
            'location' => 'Russia/Samara',
            'about' => 'О себе: текст',
            'custom_fields' => '[{"name": "Афвф", "value": "аывфыы 34"}]',
        ])->execute();
        $db->createCommand()->insert('promo_code_category', [
            'id' => 1,
            'name' => 'test_category',
            'parent_id' => 0,
            'has_child' => 0,
            'is_deleted' => 0,
        ])->execute();
        $db->createCommand()->insert('promo_code', [
            'id' => 1,
            'value' => 'test_promo',
            'title' => 'тестовый промокод',
            'description' => 'описание промокода',
            'cat_id' => 1,
            'type_id' => 1,
            'creator_id' => 1,
            'beneficiary_id' => 1,
            'date_from' => 1514764800,
            'date_to' => 1577836800,
            'sum_promo' => 1000,
            'sum_recharge' => 2000,
            'discount_fixed' => null,
            'discount_percentage' => null,
            'is_available_old' => 1,
            'is_deleted' => 0,
        ])->execute();
        $db->createCommand()->insert('promo_code_log', [
            'id' => 1,
            'user_id' => 1,
            'promo_code_id' => 1,
            'operation_id' => 1,
            'deactivate_operation_id' => null,
            'status_id' => 1,
            'created_at' => 1514765000,
            'updated_at' => 1514765000,
            'activated_at' => null,
            'deactivated_at' => null
        ])->execute();
    }

    /**
     * доп данные для таблицы user
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function initDbAdditional()
    {
        $db = new Connection([
            'dsn' => 'sqlite:' . \Yii::$app->getRuntimePath() . '/sqlite.db',
            'charset' => 'utf8',
        ]);
        \Yii::$app->set('db', $db);
        $db->createCommand()->insert('user', [
            'id' => 2,
            'email' => 'test@yandex.ru',
            'password_hash' => '$2y$13$965KGf0VPtTcQqflsIEDtu4kmvM4mstARSbtRoZRiwYZkUqCQWmcy',
            'password_reset_token' => null,
            'auth_key' => 'NdLufkTZDHMPH8Sw3p5f7ukUXSXllYwM',
            'username' => 'IvanSidorov',
            'status_id' => 1,
            'created_at' => 1460902430,
            'last_entering_date' => 1532370359,
            'email_confirm_token' => null,
        ])->execute();

        $db->createCommand()->insert('promo_code_category', [
            'id' => 2,
            'name' => 'test category parent',
            'parent_id' => 0,
            'has_child' => 1,
            'is_deleted' => 0,
        ])->execute();

        $db->createCommand()->insert('promo_code_category', [
            'id' => 3,
            'name' => 'test category child',
            'parent_id' => 2,
            'has_child' => 0,
            'is_deleted' => 0,
        ])->execute();

        $db->createCommand()->insert('promo_code', [
            'id' => 2,
            'value' => 'test_promo_non_active',
            'title' => 'тестовый неактивный промокод',
            'description' => 'описание промокода неактивный',
            'cat_id' => 1,
            'type_id' => 1,
            'creator_id' => 1,
            'beneficiary_id' => 1,
            'date_from' => 1514764800,
            'date_to' => 1517443200,
            'sum_promo' => 1000,
            'sum_recharge' => 2000,
            'discount_fixed' => null,
            'discount_percentage' => null,
            'is_available_old' => 0,
            'is_deleted' => 0,
        ])->execute();
        $db->createCommand()->insert('promo_code_log', [
            'id' => 2,
            'user_id' => 1,
            'promo_code_id' => 1,
            'operation_id' => null,
            'deactivate_operation_id' => null,
            'status_id' => 2,
            'created_at' => 1514765000,
            'updated_at' => 1514765000,
            'activated_at' => null,
            'deactivated_at' => null
        ])->execute();

        $db->createCommand()->insert('promo_code', [
            'id' => 3,
            'value' => 'test_promo_discount_percentage',
            'title' => 'тестовый промокод с процентной скидкой',
            'description' => 'тестовый промокод с процентной скидкой',
            'cat_id' => 1,
            'type_id' => 3,
            'creator_id' => 1,
            'beneficiary_id' => 1,
            'date_from' => 1514764800,
            'date_to' => 1517443200,
            'sum_promo' => null,
            'sum_recharge' => null,
            'discount_fixed' => null,
            'discount_percentage' => 10,
            'is_available_old' => 0,
            'is_deleted' => 0,
        ])->execute();
        $db->createCommand()->insert('promo_code_log', [
            'id' => 3,
            'user_id' => 1,
            'promo_code_id' => 3,
            'operation_id' => null,
            'deactivate_operation_id' => null,
            'status_id' => 2,
            'created_at' => 1514765000,
            'updated_at' => 1514765000,
            'activated_at' => null,
            'deactivated_at' => null
        ])->execute();
    }
}
