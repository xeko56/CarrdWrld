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
use app\models\SignupForm;
use app\models\Card;
use app\models\SaleCards;
use app\models\Categories;
use yii\data\ActiveDataProvider;

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

    public function init()
    {
        parent::init();
    
        // Set default action based on user authentication status
        $this->defaultAction = Yii::$app->user->isGuest ? 'login' : 'index';
    }

    public function beforeAction($action)
    {
        return true;
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = "menubar";
        $groupList = Site::get_all_data('groups', null, null);
        $groupTypeList = Site::get_all_data('group_types', null, null);
        $categories = Categories::find()->all();
        $data = Card::getCardsTable();
        $dataProvider = new ActiveDataProvider([
            'query' => Card::find()->leftJoin('groups', 'cards.group_nr = groups.group_nr')
                                    ->leftJoin('expansion', 'cards.exp_nr = expansion.exp_nr')
                                    ->leftJoin('card_types', 'cards.type_nr = card_types.type_nr')
                                    ->orderBy('cards.card_nr ASC'),
        ]);

        return $this->render('index', array(
            'groupList' => $groupList,
            'groupTypeList' => $groupTypeList,
            'categories' => $categories,
            'data' => $data,
            'dataProvider' => $dataProvider
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
        $this->layout = 'landing';
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

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Registration successful! Please login.');
            return $this->redirect(['login']);
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    
    public function actionGetTrendingTable()
    {
        $data = Card::getCardsTable();
        $aColumns = array('card_name, exp_name, group_name, type_name, release_date');
        $sLimit = "";

        if (isset($_POST['start']) && $_POST['length'] != '-1') {
            $sLimit = "LIMIT " . intval($_POST['length']) . " OFFSET " .
                intval($_POST['start']);
        }
        /*
         * Ordering
         */
        if (isset($_POST['order'])) {
            $isfiltered = 0;
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_POST['order']); $i++) {
                if ($_POST['columns'][$i]['orderable'] == "true") {
                    $_POST['order'][$i]['column'] = ($_POST['order'][$i]['column'] == 0 ? $_POST['order'][$i]['column'] : ($_POST['order'][$i]['column']));
                    $sOrder .= $aColumns[intval($_POST['order'][$i]['column'])] . " " . ($_POST['order'][$i]['dir'] === 'asc' ? 'asc' : 'desc') . ", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }
        $sWhere = "1=1 ";
        /* Individual column filtering */
        if (isset($_POST['search']['value']) && !empty($_POST['search']['value'])) {
            $sWhere .= "and (card_name ILIKE '%" . pg_escape_string($_POST['search']['value']) . "%')
                or exp_name ILIKE '%" . pg_escape_string($_POST['search']['value']) . "%'
                or group_name ILIKE '%" . pg_escape_string($_POST['search']['value']) . "%'
                or type_name ILIKE '%" . pg_escape_string($_POST['search']['value']) . "%')";
        }
        $iTotal = $iFilteredTotal = count($data);
        $sql = "SELECT card_nr, card_name, exp_name, group_name, type_name, release_date, img_url FROM cards
        LEFT JOIN groups USING (group_nr)
        LEFT JOIN expansion USING (exp_nr)
        LEFT JOIN card_types USING (type_nr) order by card_nr asc $sLimit";
        $command = Yii::$app->db->createCommand($sql);
        $result = $command->queryAll();

        $output = array(
            "draw" => intval($_GET['draw']),
            "recordsTotal" => $iTotal,
            "isfiltered" => $isfiltered,
            "recordsFiltered" => $iFilteredTotal,
            "data" => $result,
        );
        echo json_encode($output);
        exit();       
    }

    public function actionCategories($category_nr)
    {
        $js = Yii::getAlias('@web/js/category.js?cb='. uniqid());
        $this->getView()->registerJsFile($js, ['depends' => 'yii\web\JqueryAsset']);        
        // Fetch cards for the specified category_id
        $cards = Card::getCardsTable("c.category_nr = {$category_nr}");

        // Render the view with the cards
        return $this->render('categories', [
            'cards' => $cards,
        ]);
    }
    
    public function actionCard($card_nr)
    {
        $js = Yii::getAlias('@web/js/card.js?cb='. uniqid());
        $this->getView()->registerJsFile($js, ['type' => 'module']);
        $cards = Card::getCardsTable("card_nr = {$card_nr}");
        // Render the view with the cards
        return $this->render('card', [
            'cards' => $cards,
        ]);
    }
    
    public function actionGetCategoryCards()
    {
        $request = Yii::$app->request;
        $category_nr = $request->post('category_nr');
        $cards = Categories::getCategoryCardsTable("$category_nr");
        return $cards;        
    }

    public function actionGetSaleCards()
    {
        $request = Yii::$app->request;
        $card_nr = $request->post('card_nr');
        $saleCards = SaleCards::getSaleCardsTable($card_nr);
        return $saleCards;
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

    /**
     * Displays faq page.
     *
     * @return string
     */
    public function actionFaq()
    {
        return $this->render('faq');
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
