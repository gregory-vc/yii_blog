<?php

namespace app\models;

use yii\db\ActiveRecord;

class Article extends ActiveRecord
{

    public static function tableName()
    {
        return 'articles';
    }

    public static function getAllWithContent()
    {
        try {
            $articles = self::find()->with('articleContent')->all();
            $build = function (Article $article) {
                return $article->toArray();
            };
            $articles = array_map($build, $articles);
            return $articles;
        } catch (\Throwable $e) {
            Yii::error($e->getMessage());
        }
    }

    public function rules()
    {
        return [
            [['public_date', 'create_date', 'title'], 'safe'],
            [['sort', 'article_id'], 'integer'],
        ];
    }

    public function getArticleContent()
    {
        return $this->hasOne(ArticleContent::className(), ['article_id' => 'article_id']);
    }

    public function fields()
    {
        return [
            'article_id',
            'sort',
            'title'=>function() {
                if (isset($this->articleContent)) {
                    return $this->articleContent->title;
                }
            },
            'content'=>function() {
                if (isset($this->articleContent)) {
                    return $this->articleContent->content;
                }
            },
            'public_date',
            'create_date',
        ];
    }
}