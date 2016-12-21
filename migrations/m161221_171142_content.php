<?php

use yii\db\Migration;

class m161221_171142_content extends Migration
{
    public function up()
    {
        $this->createTable('articles_content', [
            'content_id' => $this->primaryKey(),
            'article_id' => $this->integer()->notNull()->unique(),
            'title' => $this->string(),
            'content' => $this->text(),
        ]);
    }

    public function down()
    {
        $this->dropTable('articles_content');
    }

}
