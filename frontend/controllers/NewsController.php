<?php

namespace frontend\controllers;

use Yii;
use common\models\News;
use common\models\NewsSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{


    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        #$dataProvider = $searchModel->getNews(Yii::$app->request->queryParams);
        $query = News::find()->joinWith('languages')->where(['AND', ['languages.code' => Yii::$app->language], ['type' => News::TYPE_NEWS]]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>10, 'defaultPageSize'=>10]);
        $models = $query->offset($pages->offset)
            ->limit(10)
            ->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'models' => $models,
            'pages' => $pages,
        ]);
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionStockIndex()
    {
        $searchModel = new NewsSearch();
        #$dataProvider = $searchModel->getNews(Yii::$app->request->queryParams);
        $query = News::find()->joinWith('languages')->where(['AND', ['languages.code' => Yii::$app->language], ['type' => News::TYPE_STOCK]]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>10, 'defaultPageSize'=>10]);
        $models = $query->offset($pages->offset)
            ->limit(10)
            ->all();

        return $this->render('stock-index', [
            'searchModel' => $searchModel,
            'models' => $models,
            'pages' => $pages,
        ]);
    }
    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($slug)
    {
        return $this->render('view', [
            'model' => $this->findModelSlug($slug),
        ]);
    }

    public function actionStockView($slug)
    {
        return $this->render('stock-view', [
            'model' => $this->findModelSlug($slug),
        ]);
    }

    public function actionPageView($slug)
    {
        return $this->render('page-view', [
            'model' => $this->findModelSlug($slug),
        ]);
    }
    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    protected function findModelSlug($slug)
    {
        if (($model = News::find()
                ->joinWith('languages')
                ->where(['slug'=> $slug,'languages.code' => Yii::$app->language ])
                ->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
