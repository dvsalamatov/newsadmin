<?php

use yii\db\Migration;

/**
 * Class m210926_161014_create_table_comments
 */
class m210926_161014_create_table_comments extends Migration
{

    public const TABLE_NAME_COMMENTS = 'comments';
    public const TABLE_NAME_NEWS = 'news';
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

        $this->createTable(self::TABLE_NAME_COMMENTS, [
            'id' => $this->primaryKey(),
            'content' => $this->text(),
            'user_id' => $this->integer()->notNull(),
            'news_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'frg-' . self::TABLE_NAME_COMMENTS . '-user_id-' . self::TABLE_NAME_USER,
            self::TABLE_NAME_COMMENTS,
            'user_id',
            self::TABLE_NAME_USER,
            'id'
        );

        $this->addForeignKey(
            'frg-' . self::TABLE_NAME_COMMENTS . '-news_id-' . self::TABLE_NAME_NEWS,
            self::TABLE_NAME_COMMENTS,
            'news_id',
            self::TABLE_NAME_NEWS,
            'id'
        );

        $this->createIndex('idx-user_id', self::TABLE_NAME_COMMENTS, 'user_id');
        $this->createIndex('idx-news_id', self::TABLE_NAME_COMMENTS, 'news_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'frg-' . self::TABLE_NAME_COMMENTS . '-user_id-' . self::TABLE_NAME_USER,
            self::TABLE_NAME_COMMENTS);
        $this->dropForeignKey(
            'frg-' . self::TABLE_NAME_COMMENTS . '-news_id-' . self::TABLE_NAME_NEWS,
            self::TABLE_NAME_COMMENTS
        );
        $this->dropIndex('idx-user_id', self::TABLE_NAME_COMMENTS);
        $this->dropIndex('idx-news_id', self::TABLE_NAME_COMMENTS);
        $this->dropTable(self::TABLE_NAME_COMMENTS);
    }
}
