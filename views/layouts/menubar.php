<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use app\models\Site;
use Yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

$groupList = Site::get_all_data('groups', null, null);
$groupTypeList = Site::get_all_data('group_types', null, null);
$menuItems = [];
foreach ($groupTypeList as $groupType) {
    $submenuItems = [];
    foreach ($groupList as $group) {
        if ($group['group_type_id'] == $groupType['group_type_id']) {
            array_push($submenuItems, ['label' => $group['group_name'], 
                                        'url' => ['/group/'.$group['group_name']]]);
        }
    }
    $menuItems[$groupType['group_type_name']] = $submenuItems;
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <!-- <link href="<?php echo Url::base(); ?>/css/site.css?version=<?php echo date('d.m.Y-H-i'); ?>" rel="stylesheet" type="text/css"> -->
    <link href="<?php echo Url::base(); ?>/assets/DataTables/datatables.min.css" rel="stylesheet">
    <link href="<?php echo Url::base(); ?>/fontawesome/css/all.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"> -->

</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => APP_NAME,
        'brandUrl' => DOMAIN_LINK,
        'options' => ['class' => 'navbar-expand-md navbar-light menubar-background fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            // ['label' => 'About', 'url' => ['/site/about']],
            // ['label' => 'Contact', 'url' => ['/site/contact']],
            [
                'label' => 'Boygroup', 
                'items' => $menuItems['Boygroups']
            ],
            [
                'label' => 'Girlgroup', 
                'items' => $menuItems['Girlgroups']
            ],            
            // Yii::$app->user->isGuest
            //     ? ['label' => 'Login', 'url' => ['/site/login']]
            //     : '<li class="nav-item">'
            //         . Html::beginForm(['/site/logout'])
            //         . Html::submitButton(
            //             'Logout (' . Yii::$app->user->identity->username . ')',
            //             ['class' => 'nav-link btn btn-link logout']
            //         )
            //         . Html::endForm()
            //         . '</li>'
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div id="heroBanner" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroBanner" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroBanner" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroBanner" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= Yii::$app->request->baseUrl ?>/images/blackpink-demo.jpg" class="d-block w-100" alt="Blackpink Demo">
            </div>
            <div class="carousel-item">
                <img src="<?= Yii::$app->request->baseUrl ?>/images/velvet-demo.jpg" class="d-block w-100" alt="Velvet Demo">
            </div>
            <div class="carousel-item">
                <img src="<?= Yii::$app->request->baseUrl ?>/images/itzy-demo.jpg" class="d-block w-100" alt="Itzy Demo">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroBanner" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroBanner" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>        
    <div class="container">        
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
<script src="<?php echo Url::base(); ?>/assets/DataTables/datatables.min.js"></script>
<script src="<?php echo Url::base(); ?>/js/site.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
<?php $this->endPage() ?>
