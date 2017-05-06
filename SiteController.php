<?php

namespace app\controllers;

use app\models\Personal;
use app\models\Company;
use app\models\Work;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Login;

class SiteController extends Controller  //контроллер, отвечающий за связь между моделями и представлениями(views)
{
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


    public function actionLogin(){  //функция для ввода логина и пароля, если он неверный то просит ввести заново, если верный, то переход к страничке со списком сотрудников
        $session = Yii::$app->session;
        $session->open();
        if (SiteController::Auth($session, $_POST)) {
            return $this->redirect(['personal']);
        }
        else{
            $array = new LoginForm;
            return $this->render('login', ['model' => $array]);
        }
    }


    public function Auth($session, $post){  //функция для проверки правльности введенных логин и пароля. Если такие существуют, то роль в системе = администратор
        if (($session['role'] == 'admin') || ($session['role'] == 'manager')) return true;
        else{
            if (isset($post['_csrf']) && (Login::getA($post['LoginForm']['username'],$post['LoginForm']['password']))) {
                $session['role'] = 'admin';
                return true;
            }
            else return false;
        }
    }


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


    public function actionPersonal() // страничка со списком персонала. Для каждого действия, для безопасности, проверяются права пользователя
    {
        $session = Yii::$app->session; //создаем сессию
        $session->open();
        if (SiteController::Auth($session, $_POST)) { //если проверка авторизации прошла успешно, загружаем нужную страничку
            $array = Personal::getAll();
            return $this->render('personal', ['model' => $array]);
        }
        else { // иначе просим ввести логин и пароль
            $array = new LoginForm;
            return $this->render('login', ['model' => $array]);
        }
    }

	
    public function actionAddpersonal()
    {
        $model = new Personal;
        $session = Yii::$app->session;
        $session->open();
        if (SiteController::Auth($session, $_POST)) {
            if (Yii::$app->request->post('Personal')) {
                $model->name = $_POST['Personal']['name'];
                $model->position = $_POST['Personal']['position'];
                if ($model->validate() && $model->save()) {
                    return $this->redirect(['personal']);
                }
            }
            return $this->render('Addpersonal', ['model' => $model]);
        }
        else {
            $array = new LoginForm;
            return $this->render('login', ['model' => $array]);
        }
    }

	
    public function actionEditpersonal($id)
    {
        $model = Personal::getOne($id);
        $session = Yii::$app->session;
        $session->open();
        if (SiteController::Auth($session, $_POST)) {
            if (Yii::$app->request->post('Personal')) {
                $model->name = $_POST['Personal']['name'];
                $model->position = $_POST['Personal']['position'];
                if ($model->validate() && $model->save()) {
                    return $this->redirect(['personal']);
                }
            }
            return $this->render('Addpersonal', ['model' => $model]);
        }
        else {
            $array = new LoginForm;
            return $this->render('login', ['model' => $array]);
        }
    }

	
    public function actionDeletepersonal($id)
    {
        $session = Yii::$app->session;
        $session->open();
        if (SiteController::Auth($session, $_POST)) {
            $model = Personal::getOne($id);
            $model->delete();
            return $this->redirect(['personal']);
        }
        else {
            $array = new LoginForm;
            return $this->render('login', ['model' => $array]);
        }
    }


    public function actionCompany()
    {
        $session = Yii::$app->session;
        $session->open();
        if (SiteController::Auth($session, $_POST)) {
            $array = Company::getAll();
            return $this->render('company', ['model' => $array]);
        }
        else {
            $array = new LoginForm;
            return $this->render('login', ['model' => $array]);
        }
    }

	
    public function actionAddcompany()
    {
        $session = Yii::$app->session;
        $session->open();
        if (SiteController::Auth($session, $_POST)) {
            $model = new Company();
            if (Yii::$app->request->post('Company')) {
                $model->title = $_POST['Company']['title'];
                if ($model->validate() && $model->save()) {
                    return $this->redirect(['company']);
                }
            }
            return $this->render('Addcompany', ['model' => $model]);
        }
        else {
            $array = new LoginForm;
            return $this->render('login', ['model' => $array]);
        }
    }

	
    public function actionEditcompany($id)
    {
        $session = Yii::$app->session;
        $session->open();
        if (SiteController::Auth($session, $_POST)) {
            $model = Company::getOne($id);
            if (Yii::$app->request->post('Company')) {
                $model->title = $_POST['Company']['title'];
                if ($model->validate() && $model->save()) {
                    return $this->redirect(['company']);
                }
            }
            return $this->render('Addcompany', ['model' => $model]);
        }
        else {
            $array = new LoginForm;
            return $this->render('login', ['model' => $array]);
        }
    }


    public function actionDeletecompany($id)
    {
        $session = Yii::$app->session;
        $session->open();
        if (SiteController::Auth($session, $_POST)) {
            $model = Company::getOne($id);
            $model->delete();
            return $this->redirect(['company']);
        }
        else {
            $array = new LoginForm;
            return $this->render('login', ['model' => $array]);
        }
    }


    public function actionWork()
    {
        $session = Yii::$app->session;
        $session->open();
        if (SiteController::Auth($session, $_POST)) {
            $array = work::ClassicJoin();
            return $this->render('work', ['model' => $array]);
        }
        else {
                $array = new LoginForm;
                return $this->render('login', ['model' => $array]);
            }
    }

	
    public function actionAddwork()
    {
        $array = work::ClassicJoin();
        $model = new Work();
        $personal = Personal::getAll();
        $company = Company::getAll();
        $session = Yii::$app->session;
        $session->open();
        if (SiteController::Auth($session, $_POST)) {
            if (isset($_POST['Addwork'])) {
                $model->id_sot = $_POST['Work']['id_sot'];
                $model->id_com = $_POST['Work']['id_com'];
                $model->date_begin = Yii::$app->request->post('dateStart');
                $model->date_end = Yii::$app->request->post('dateFinish');
                $model->id_status = 1;
                if ($model->validate() && $model->save()) {
                    return $this->redirect(['work']);
                }
            }
            return $this->render('Addwork', ['model' => $model, 'array' => $array, 'personal' => $personal, 'company' => $company]);
        }
        else {
            $array = new LoginForm;
            return $this->render('login', ['model' => $array]);
        }
    }


    public function actionEditwork($id)
    {
        $array = work::ClassicJoin();
        $model = Work::getOne($id);
        $personal = Personal::getAll();
        $company = Company::getAll();
        $session = Yii::$app->session;
        $session->open();
        if (SiteController::Auth($session, $_POST)) {
            if (isset($_POST['Addwork'])) {
                $model->id_sot = $_POST['Work']['id_sot'];
                $model->id_com = $_POST['Work']['id_com'];
                $model->date_begin = Yii::$app->request->post('dateStart');
                $model->date_end = Yii::$app->request->post('dateFinish');
                $model->id_status = 1;
                if ($model->validate() && $model->save()) {
                    return $this->redirect(['work']);
                }
            }
            return $this->render('Addwork', ['model' => $model, 'array' => $array, 'personal' => $personal, 'company' => $company]);
        }
        else {
            $array = new LoginForm;
            return $this->render('login', ['model' => $array]);
        }
    }

	
    public function actionDeletework($id)
    {
        $session = Yii::$app->session;
        $session->open();
        if (SiteController::Auth($session, $_POST)) {
            $model = Work::getOne($id);
            $model->delete();
            return $this->redirect(['work']);
        }
        else {
            $array = new LoginForm;
            return $this->render('login', ['model' => $array]);
        }
    }

	
    public function actionIndex() //"Посмотреть все" - страничка для просмотра всех работ, видна всем посетителям.
    {
        if (Yii::$app->request->get('go')) // если нажата кнопка Просмотреть, то берем параметры и передаем их для нужного вида(view) - index
        {
            $dateStart = Yii::$app->request->get('dateStart');
            $dateFinish = Yii::$app->request->get('dateFinish');
            $id_sotr = Yii::$app->request->get('id_sotr');
            $id_comp = Yii::$app->request->get('id_comp');
            $array = Work::ClassicJoinWhere($id_sotr, $id_comp, $dateStart, $dateFinish);
            $name_sotr = Personal::find()->where(['id_sotr'=>$id_sotr])->one();
            $name_comp = Company::find()->where(['id_comp'=>$id_comp])->one();
            $personals = Personal::getAll();
            $companies = Company::getAll();
            return $this->render('index', ['model' => $array, 'personals' => $personals, 'companies'=>$companies, 'name_sotr'=>$name_sotr, 'name_comp'=>$name_comp, 'dateStart'=>$dateStart, 'dateFinish'=>$dateFinish]);
        }
        else  // если не нажата, то по умолчанию видны все работы
        {
            $array = Work::ClassicJoin();
            $personals = Personal::getAll();
            $companies = Company::getAll();
            return $this->render('index', ['model' => $array, 'personals' => $personals, 'companies'=>$companies]);
        }
    }

    public  function actionExit(){ //функция для выхода из текущей роли, уничтожаем сессию и перенаправляем к index - страничке-доступной всем
        $session = Yii::$app->session;
        $session->open();
        $session->destroy();
        return $this->redirect(['index']);
    }
}
