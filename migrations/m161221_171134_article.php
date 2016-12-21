<?php

use yii\db\Migration;

class m161221_171134_article extends Migration
{
    public function up()
    {
        $this->createTable('articles', [
            'article_id' => $this->primaryKey(),
            'sort' => $this->integer()->notNull(),
            'public_date' => $this->dateTime(),
            'create_date' => $this->dateTime() . ' DEFAULT CURRENT_TIMESTAMP',
        ]);
    }

    public function down()
    {
        $this->dropTable('articles');
    }
}
