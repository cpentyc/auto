<?php

namespace backend\controllers;

use Yii;
use common\models\Category;
use common\models\CategorySearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CategoryController implements the CRUD actions for category model.
 */
class CategoryController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout','index', 'create', 'update', 'delete', 'view', 'findModel'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout', 'index', 'create', 'update', 'delete', 'view', 'findModel'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    public function actions()
    {
            return [
                'uploadLogo' => [
                    'class' => 'budyaga\cropper\actions\UploadAction',
                    'url' =>  'http://cbc-auto.kz/images/logo', # Просмотр загруженой картинки
                    # Имя картинки картинки
                    # Расширение картинки из настроек, поумолчанию jpeg
                    'path' => Yii::getAlias('@frontend') . '/web/images/logo', # Путь для сохранения
                    'width' => 300, # Ширина обрезаной картинки
                    'height' => 300, # Высота обрезаной картинки
                    'maxSize' => 1024 * 1024 * 4, # Максимальный размер загружаемой картинки
                ],
            ];
    }
    /**
     * Lists all category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single category model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {


            $image = UploadedFile::getInstance($model, 'image');

            if (!empty($image)) {

                $str = explode(".", $image->name);
                $ext = end($str);

                $image_name = Yii::$app->security->generateRandomString() . ".{$ext}";

                $model->image = $image_name;
                $path = \Yii::getAlias('@frontend/web/images/category/') . $model->image;

                $image->saveAs($path);

            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model
                ]);
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $image = UploadedFile::getInstance($model, 'image');
            if (!empty($image)) {

                $str = explode(".", $image->name);
                $ext = end($str);

                $image_name = Yii::$app->security->generateRandomString() . ".{$ext}";

                $model->image = $image_name;
                $path = \Yii::getAlias('@frontend/web/images/category/') . $model->image;

                $image->saveAs($path);

            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model
                ]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
