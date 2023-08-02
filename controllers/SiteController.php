<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Site;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
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

    public function beforeAction($action)
    {
        $this->layout = "menubar";
        return true;
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $groupList = Site::get_all_data('groups', null, null);
        $groupTypeList = Site::get_all_data('group_types', null, null);
        return $this->render('index', array(
            'groupList' => $groupList,
            'groupTypeList' => $groupTypeList
        ));
    }

    /**
     * Login action.
     *
     * @return Response|string
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

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
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

    public function actionGetProductTable()
    {
        $intLimit = $_REQUEST['length'];
        $startrow = $_REQUEST['start'];
        $columns = $_REQUEST['columns'];

        if (isset($_REQUEST['order'])) {
            $order = $_REQUEST['order'];
        } else {
            $order = '';
        }
        $search = $_REQUEST['search'];
        if ($startrow == 0) {
            $page = 1;
        } else {
            $page = (($startrow) / $intLimit) + 1;
        }

        $per_page = $intLimit;
        $offset = ($page - 1) * $intLimit;

        $col_array = array();
        $filters = array();
        if (isset($columns) && count($columns) > 0) {
            $counter = 0;
            foreach ($columns as $column) {
                $col_array[$counter] = $column['data'];
                $filters[$column['data']] = trim($column['search']['value']);
                $counter++;
            }
        }

        $order_by = " ORDER BY card_nr ASC";

        $sql = "SELECT card_nr, card_name, exp_name, group_name, type_name, release_date, img_url FROM cards
        LEFT JOIN groups USING (group_nr)
        LEFT JOIN expansion USING (exp_nr)
        LEFT JOIN card_types USING (type_nr)";

        $rowcount = Yii::$app->db->createCommand("SELECT count(*) from ($sql) as c")->queryScalar();
        $rowcount_filtered = $rowcount;

        if ($search['value'] != '') {
            $sql .= " AND (card_name ILIKE '%{$search['value']}%' OR exp_name ILIKE '%{$search['value']}%' OR group_name ILIKE '%{$search['value']}%' OR type_name ILIKE '%{$search['value']}%' )";
            $rowcount_filtered = Yii::$app->db->createCommand("SELECT count(*) from ($sql) as c")->queryScalar();
        }

        if ($order != '') {
            $order_by = "";
            foreach ($order as $order_by_clause) {
                $colname = $col_array[$order_by_clause['column']];
                $order_by .= ' ,' . $colname . ' ' . $order_by_clause['dir'];
            }
            $order_by = " ORDER BY " . trim($order_by, ' ,');
        }

        $sql .= $order_by;
        if ($per_page > 0) {
            $sql .= " OFFSET $offset LIMIT $per_page ";
        }

        $result = Yii::$app->db->createCommand($sql)->queryAll();
        $arrJson = array(
            "draw" => intval($_REQUEST['draw']),
            "recordsTotal" => $rowcount,
            "recordsFiltered" => $rowcount_filtered,
            "data" => $result
        );
        print json_encode($arrJson);
        exit;        
    }
}
