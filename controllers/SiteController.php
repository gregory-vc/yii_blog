<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Article;
use Yii;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $articles = Article::getAllWithContent();
        return $articles;
    }
}
