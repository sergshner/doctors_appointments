<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\DoctorsSpecialities;
use app\models\Doctors;
use yii\helpers\Url;
use yii\helpers\Json;
use app\models\Appointments;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
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
     * @inheritdoc
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
     * @return string
     */
    public function actionIndex($id = null)
    {
    	$doctorsSpecialities = DoctorsSpecialities::find()->all();
    	
    	$condition = [];
    	if (isset($id))
    		$condition = ['speciality_id' => $id];
    	$doctors = Doctors::find()->where($condition)->orderBy('id')->all();
    	
    	
    	$this->layout = 'doctors';
    	$this->view->params['sidebar'] = $this->renderPartial('menu.php', ['doctorsSpecialities' => $doctorsSpecialities]);
    	
    	Url::remember();
    	
        return $this->render('index', ['id' => $id, 'doctors' => $doctors]);
    }
    
    /**
     * Appointment action.
     * 
     * @return string
     */
    public function actionAppointment($doctor_id)
    {
    	$doctor = Doctors::findOne($doctor_id);
    	$appointments = Appointments::findAll(['doctor_id' => $doctor_id]);
    	 
    	$this->layout = 'doctors';
    	
    	if (!Yii::$app->request->isPjax) {
    		$doctorsSpecialities = DoctorsSpecialities::find()->all();
    		$this->view->params['sidebar'] = $this->renderPartial('menu.php', ['doctorsSpecialities' => $doctorsSpecialities]);
    		return $this->render('appointment', ['doctor' => $doctor, 'appointments' => $appointments]);
    	} else {
    	

    		return $this->renderAjax('appointment', ['doctor' => $doctor, 'appointments' => $appointments]);
    	}
    }
    
    /**
     * AppointmentSave action.
     *
     * @return string
     */
    public function actionAppointmentsave()
    {
    	$data = Yii::$app->request->post();
    	$appointment = new Appointments();
    	if ($appointment->load($data, 'event'))	 {
    		$appointment->save();
			return 1;
    	} else {
    		return 0;
    	}
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
