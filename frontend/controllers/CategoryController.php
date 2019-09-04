<?php

namespace frontend\controllers;

use common\models\Product;
use Yii;
use common\models\Category;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    public function actionIndex()
    {
        if(!empty($_POST['sort']))
        {
            $sort = $_POST['sort'];
            if($sort==0)
                $sortStr = 'h1 ASC';
            else
                $sortStr = 'h1 DESC';
        }else {
            $sort = 0;
            $sortStr = 'h1 ASC';
        }

        $query = Product::find()->joinWith('languages')
            ->where(['languages.code' => Yii::$app->language, 'used' => 0]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>10, 'defaultPageSize'=>10]);
        $models = $query->offset($pages->offset)
            ->limit(12)
            ->orderBy($sortStr)
            ->all();
        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
            'sort' => $sort,
        ]);
    }

    public function actionProduct($slug){

        $this->layout = 'product';
        return $this->render('view-product', [
            'model' => $this->findModelProduct($slug),
        ]);
    }
    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($slug, $subSlug = null)
    {
        $subModel = null;
        if($subSlug != null){
            $subModel = $this->findModel($subSlug);
        }
        $model = $this->findModel($slug);
        if(!empty($_POST['sort']))
        {
            $sort = $_POST['sort'];
            if($sort==0)
                $sortStr = 'h1 ASC';
            else
                $sortStr = 'h1 DESC';
        }else {
            $sort = 0;
            $sortStr = 'h1 ASC';
        }

        if($subModel==null)
        {
            $arrSubCat[] =  $model->id;
            foreach ($model->children as $val)
                $arrSubCat[] =  $val->id;

            $query = Product::find()->joinWith('languages')
                ->where(['AND', ['used' => 0 ], ['languages.code' => Yii::$app->language], ['in', 'id_category', $arrSubCat]]);
        }
        else
            $query = Product::find()->joinWith('languages')
                ->where(['AND',  ['used' => 0 ], ['languages.code' => Yii::$app->language], ['id_category' => $subModel->id]]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>10, 'defaultPageSize'=>10]);
        $models = $query->offset($pages->offset)
            ->limit(12)
            ->orderBy($sortStr)
            ->all();
        return $this->render('view', [
            'model' => $model,
            'models' => $models,
            'pages' => $pages,
            'sort' => $sort,
            'subModel' => $subModel,
        ]);
    }


    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($slug)
    {
        if (($model = Category::find()->where(['slug'=> $slug ])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelProduct($slug)
    {
        if (($model = Product::find()->where(['slug'=> $slug ])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
