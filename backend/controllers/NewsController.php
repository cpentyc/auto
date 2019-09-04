<?php

namespace backend\controllers;

use common\models\Slug;
use Yii;
use common\models\News;
use common\models\NewsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * NewsController implements the CRUD actions for news model.
 */
class NewsController extends Controller
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
                'url' =>  'http://cbc-auto.kz/images/news', # Просмотр загруженой картинки
                # Имя картинки картинки
                # Расширение картинки из настроек, поумолчанию jpeg
                'path' => Yii::getAlias('@frontend') . '/web/images/news', # Путь для сохранения
                'width' => 300, # Ширина обрезаной картинки
                'height' => 300, # Высота обрезаной картинки
                'maxSize' => 1024 * 1024 * 4, # Максимальный размер загружаемой картинки
            ]
        ];
    }

    /**
     * Lists all news models.
     * @return mixed
     */
    public function actionIndex($type = null)
    {

        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $type);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'type' => $type,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSlug($page_title)
    {
        $slug = Slug::generateSlug($page_title);
        return $slug;
    }
    /**
     * Displays a single news model.
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
     * Creates a new news model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();

        if ($model->load(Yii::$app->request->post())) {

            $image = UploadedFile::getInstance($model, 'image');

            if (!empty($image)) {

                // store the source file name
                $str = explode(".", $image->name);
                $ext = end($str);

                // generate a unique file name
                $image_name = Yii::$app->security->generateRandomString() . ".{$ext}";

                $model->image = $image_name;
                // the path to save file, you can set an uploadPath
                // in Yii::$app->params (as used in example below)
                //$path = '../../frontend/web/images/' .  $model->image;
                $path = \Yii::getAlias('@frontend/web/images/news/') . $model->image;

                $image->saveAs($path);

            }

            if ($model->save()) {
                News::removePinned($model->id, $model->type, $model->id_languages);
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model
            ]);
        }
    }

    /**
     * Updates an existing news model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $old_image = $model->image;

        if ($model->load(Yii::$app->request->post())) {

            $image = UploadedFile::getInstance($model, 'image');

            if ($image && $image->name != '') {

                // store the source file name
                $str = explode(".", $image->name);
                $ext = end($str);

                // generate a unique file name
                $image_name = Yii::$app->security->generateRandomString() . ".{$ext}";

                $model->image = $image_name;
                // the path to save file, you can set an uploadPath
                // in Yii::$app->params (as used in example below)
                $path = \Yii::getAlias('@frontend/web/images/news/') . $model->image;

                $image->saveAs($path);

            } else {
                $model->image = $old_image;
            }

            if ($model->save()) {
                News::removePinned($model->id, $model->type, $model->id_languages);
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model
            ]);
        }
    }

    /**
     * Deletes an existing news model.
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
     * Finds the news model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return news the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
