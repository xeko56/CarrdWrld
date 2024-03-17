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
    <!-- <link href="https://cdn.jsdelivr.net/npm/gridjs@6.2.0/dist/theme/mermaid.min.css" rel="stylesheet"> -->

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

<body id="kt_body" class="app-blank">>
    <?php $this->beginBody() ?>

        <?= $content ?>

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
    <script src="/assets/oswald/assets/js/custom/authentication/sign-up/general.js"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
</body>

</html>
<?php $this->endPage() ?>