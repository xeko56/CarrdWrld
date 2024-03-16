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
use yii\grid\GridViewAsset;

AppAsset::register($this);

GridViewAsset::register($this);

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
            array_push($submenuItems, [
                'label' => $group['group_name'],
                'url' => ['/group/' . $group['group_name']]
            ]);
        }
    }
    $menuItems[$groupType['group_type_name']] = $submenuItems;
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <!-- <link href="<?php echo Url::base(); ?>/css/main.css?version=<?php echo date('d.m.Y-H-i'); ?>" rel="stylesheet" type="text/css"> -->
    <link href="https://cdn.jsdelivr.net/npm/gridjs@6.2.0/dist/theme/mermaid.min.css" rel="stylesheet">

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->

    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="<?php echo Url::base(); ?>/assets/oswald/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Url::base(); ?>/assets/oswald/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

    <!--end::Vendor Stylesheets-->

    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="<?php echo Url::base(); ?>/assets/oswald/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Url::base(); ?>/assets/oswald/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- END PAGE LEVEL STYLES -->

</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>
    <div class="min-vh-100">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="" width="30" height="24">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-outline-secondary me-2" type="button">
                            <span class="sr-only">View notifications</span>
                            <!-- SVG Icon adjusted for Bootstrap -->
                        </button>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                User
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#">Your Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="<?= Yii::$app->urlManager->createUrl(['site/logout']) ?>">Sign out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <section class="bg-transparent relative">
            <div class="d-flex align-items-center justify-content-center min-vh-100">
                <div class="text-center">
                    <h1 class="display-1 mb-4 fw-bold text-dark">
                        Welcome to <br>
                        <span class="text-white rounded-3 px-4" style="background-image: linear-gradient(to top right, #8e2de2, #4a00e0);">Carrd Wrld</span>
                    </h1>
                    <p class="lead my-4 text-gray-800 fw-semibold fs-3">You can't emerge victorious in the game <br> unless you possess the very soul of the cards.</p>
                    <a href="#" class="btn btn-primary btn-lg px-6 py-3">Learn More</a>
                </div>
            </div>
            <div style="margin: auto;">
                <div id="3d-container" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: -1;"></div>
            </div>
        </section>

        <div class="app-container container-xxl d-flex flex-row flex-column-fluid ">
            <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column flex-column-fluid">
                    <?= $content ?>
                </div>
            </div>
        </div>

    </div>
    <?php $this->endBody() ?>
    <script type="importmap">
        {
				"imports": {
					"three": "./assets/three/three.module.js",
					"three/addons/": "./assets/three/examples/jsm/"
				}
			}
		</script>

    <script src="https://cdn.jsdelivr.net/npm/gridjs@6.2.0/dist/gridjs.production.min.js"></script>
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="<?php echo Url::base(); ?>/assets/oswald/assets/plugins/global/plugins.bundle.js"></script>
    <script src="<?php echo Url::base(); ?>/assets/oswald/assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->

    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="<?php echo Url::base(); ?>/assets/oswald/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <!--end::Vendors Javascript-->

    <!--begin::Custom Javascript(used for this page only)-->
    <script src="<?php echo Url::base(); ?>/assets/oswald/assets/js/widgets.bundle.js"></script>
    <script src="<?php echo Url::base(); ?>/assets/oswald/assets/js/custom/apps/chat/chat.js"></script>
    <script src="<?php echo Url::base(); ?>/assets/oswald/assets/js/custom/utilities/modals/upgrade-plan.js"></script>
    <script src="<?php echo Url::base(); ?>/assets/oswald/assets/js/custom/utilities/modals/create-app.js"></script>
    <script src="<?php echo Url::base(); ?>/assets/oswald/assets/js/custom/utilities/modals/new-target.js"></script>
    <script src="<?php echo Url::base(); ?>/assets/oswald/assets/js/custom/utilities/modals/users-search.js"></script>
    <script src="<?php echo Url::base(); ?>/assets/oswald/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Custom Javascript-->
    <script type="module" src='<?php echo Url::base(); ?>/js/hero3d.js'></script>
    <script type="module" src='<?php echo Url::base(); ?>/js/site.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/gridjs@6.2.0/dist/gridjs.production.min.js"></script>
    <!--end::Javascript-->
</body>

</html>
<?php $this->endPage() ?>