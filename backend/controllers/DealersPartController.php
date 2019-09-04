<?php

namespace backend\controllers;

use Yii;
use common\models\DealersPart;
use common\models\DealersPartSearch;
use common\models\DealerspartsSpecifies;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DealersPartController implements the CRUD actions for DealersPart model.
 */
class DealersPartController extends Controller
{
    /**
     * {@inheritdoc}
     */
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

    /**
     * Lists all DealersPart models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DealersPartSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DealersPart model.
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
     * Creates a new DealersPart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DealersPart();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            DealerspartsSpecifies::deleteAll(['dealerspart_id' => $model->id]);
            if(!empty(Yii::$app->request->post()['dealers_specify']) != null)
                foreach (Yii::$app->request->post()['dealers_specify'] as $val)
                {
                    $model1 = new DealerspartsSpecifies();
                    $model1->dealerspart_id =$model->id;
                    $model1->dealersspecify_id = $val;
                    $model1->save();
                }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DealersPart model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            DealerspartsSpecifies::deleteAll(['dealerspart_id' => $model->id]);
            //var_dump(Yii::$app->request->post()['dealers_specify']);
            if(!empty(Yii::$app->request->post()['dealers_specify']) != null)
                foreach (Yii::$app->request->post()['dealers_specify'] as $val)
                {
                    $model1 = new DealerspartsSpecifies();
                    $model1->dealerspart_id =$model->id;
                    $model1->dealersspecify_id = $val;
                    $model1->save();
                }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $dealersSpecif = DealerspartsSpecifies::findAll(['dealerspart_id' => $model->id]);
        $model->dealers_specify   = ArrayHelper::map( $dealersSpecif,'dealersspecify_id','dealersspecify_id');

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DealersPart model.
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
     * Finds the DealersPart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DealersPart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DealersPart::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
