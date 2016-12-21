<?php

namespace app\models;

use yii\db\ActiveRecord;

class ArticleContent extends ActiveRecord
{
    public static function tableName()
    {
        return 'articles_content';
    }

    public function rules()
    {
        return [
            [['title', 'content'], 'required']
        ];
    }
}