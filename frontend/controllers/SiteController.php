<?php
namespace frontend\controllers;

use common\models\Category;
use common\models\DealersCity;
use common\models\DealersPart;
use common\models\Email;
use common\models\News;
use common\models\Product;
use frontend\models\CallForm;
use frontend\models\ContactForm;
use frontend\models\ServiceForm;
use frontend\models\TestForm;
use Yii;
use yii\base\InvalidParamException;
use yii\data\Pagination;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;


use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $language = Yii::$app->language; //текущий язык
        $stock = News::getPinnedStock();
        $news = News::getLastNews();
        $products = Product::getSalesLeader();
        return $this->render('index-ru', [
            'stock' => $stock,
            'news'  => $news,
            'products'  => $products
        ]);
    }


    public function actionUsed($slug = null)
    {
        $this->layout = "product";

        if($slug != null)
            $category = $this->findModel($slug);

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
        if($slug == null)
            $query = Product::find()->joinWith('languages')
                ->where(['languages.code' => Yii::$app->language, 'used' => 1]);
        else
            $query = Product::find()->joinWith('languages')
                ->where(['languages.code' => Yii::$app->language, 'used' => 1, 'id_category' => $category->id]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>6, 'defaultPageSize'=>6]);
        $models = $query->offset($pages->offset)
            ->limit(6)
            ->orderBy($sortStr)
            ->all();
        return $this->render('used', [
            'models' => $models,
            'pages' => $pages,
            'sort' => $sort,
            'slug' => $slug,
            'category' => Category::getCategory(),
        ]);
    }





    public function actionServices(){
        $language = Yii::$app->language; //текущий язык
        $this->layout = "product";
        return $this->render('services-'.$language);
    }

    public function actionDealers()
    {
        $firstCity = DealersCity::find()->orderBy(['sort_id' => 'ASC'])->one();
        $cities = DealersCity::find()->orderBy(['sort_id' => 'ASC'])->all();

        return $this->render('dealers', [
            'firstCity' => $firstCity,
            'cities' => $cities
        ]);
    }
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionServicePage()
    {
        $this->layout = "service";
        //$model = new ContactForm;
        $model = new ServiceForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendmail()) {
                $this->redirect(['site/service-page', '#' => 'service_sended']);
            }
        } else {
            return $this->render('service-page', [
                'model' => $model,

            ]);
        }
        return $this->render('service-page', [
            'model' => $model,

        ]);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionService()
    {
        $model = new ServiceForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->refresh();
        }
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionTest()
    {
        $model = new TestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
          //  if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
            if ($model->sendEmail('cpentyc@gmail.com')) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->refresh();
        }
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionCall()
    {
        $model = new CallForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            return $this->refresh();
        }
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionSubscribe(){
        $model = new Email();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Благодарим за подписку'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Не удалось сохранить почту'));
            }


        }
        return $this->goHome();
    }
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }
    /**
     * @return string
     * @throws BadRequestHttpException
     */
    /*
    public function actionContacts()
    {
        $this->layout = 'contacts';
        $cityId = null;
        $serviceSlug = null;

        $cities = DealersCity::find()->all();

        if (Yii::$app->request->get('id')) {

            $cityId = Yii::$app->request->get('id');
        }

        if ($cityId != null) {
            $city = DealersCity::findOne($cityId);
            if ($city == null) {
                throw new BadRequestHttpException();
            }
        } else {

            $city = DealersCity::findFirst();
        }

        if ($serviceSlug != null) {
            $service = DealersPart::find()->where(['service_slug' => $serviceSlug, 'id_city' => $city->id])->one();
            if ($service == null) {

                throw new BadRequestHttpException();
            }
        } else {
            $service = DealersPart::find()->where(['id_city' => $city->id])->orderBy(['id' => SORT_ASC])->one();
        }

        $coord = new LatLng(['lat' => $city->lat, 'lng' => $city->lng]);
        $map = new Map([
                'center' => $coord,
                'zoom' => 14,
                'width' => 1440,
                'height' => 302
            ]);

        $marker = new Marker([
                'position' => $coord,
                'title' => $service->name,
            ]);
        $map->addOverlay($marker);


        $cityServices = $city->parts;
        return $this->render('contacts', [
            'city' => $city,
            'service' => $service,
            'cities' => $cities,
            'cityServices' => $cityServices,
            'map' => $map
        ]);
    }
*/

    public function actionParts($city_id)
    {
        $this->layout = false;
        $city = DealersCity::findOne($city_id);

        return $this->render('parts', [
            'city' => $city
        ]);
    }

    public function actionLanding(){
        $this->layout = "landing";
        return $this->render('landing');
    }

    public function actionContacts()
    {
        $firstCity = DealersCity::find()->orderBy(['sort_id' => SORT_ASC])->one();
        $cities = DealersCity::find()->orderBy(['sort_id' => SORT_ASC])->all();

        return $this->render('contacts2', [
            'firstCity' => $firstCity,
            'cities' => $cities
        ]);
    }
    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }



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
     * @throws NotFoundHttpException if the model cannot be found
     * @return Category the loaded model
     */
    protected function findModelProduct($slug)
    {
        if (($model = Product::find()->where(['slug'=> $slug ])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
