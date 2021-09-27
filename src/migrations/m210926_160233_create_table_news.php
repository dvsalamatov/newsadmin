<?php

use yii\db\Migration;

/**
 * Class m210926_160233_create_table_news
 */
class m210926_160233_create_table_news extends Migration
{

    public const TABLE_NEWS_NAME = 'news';
    public const TABLE_NAME_USER = 'user';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE_NEWS_NAME, [
            'id' => $this->primaryKey(),
            'header' => $this->string(),
            'content' => $this->text(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'frg-' . self::TABLE_NEWS_NAME . '-' . self::TABLE_NAME_USER,
            self::TABLE_NEWS_NAME,
            'user_id',
            self::TABLE_NAME_USER,
            'id'
        );

        $this->createIndex('idx-user_id', self::TABLE_NEWS_NAME, 'user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('frg-' . self::TABLE_NEWS_NAME . '-' . self::TABLE_NAME_USER, self::TABLE_NEWS_NAME);
        $this->dropIndex('idx-user_id', self::TABLE_NEWS_NAME);
        $this->dropTable(self::TABLE_NEWS_NAME);
    }
}
