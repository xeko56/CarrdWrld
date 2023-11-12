<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use Yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-full bg-gray-800">

<head>
    <?php $this->head() ?>

    <!-- <link href="<?php echo Url::base(); ?>/css/main.css?version=<?php echo date('d.m.Y-H-i'); ?>" rel="stylesheet" type="text/css"> -->
    <link href="<?php echo Url::base(); ?>/assets/DataTables/datatables.min.css" rel="stylesheet">
    <link href="<?php echo Url::base(); ?>/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- END PAGE LEVEL STYLES -->

</head>

<body class="h-full bg-gray-800">
    <?php $this->beginBody() ?>
    <div class="h-full">
        <?= $content ?>
    </div>
    <?php $this->endBody() ?>

    <script src="<?php echo Url::base(); ?>/assets/DataTables/datatables.min.js"></script>
    <script src="<?php echo Url::base(); ?>/js/site.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>

</html>
<?php $this->endPage() ?>