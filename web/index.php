<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$domain = "carrdwrld";
$link = "http://cardworld.local";
$applicationName = "Carrd Wrld";

$config = require __DIR__ . '/../config/web.php';

define('DOMAIN', $domain);
define('DOMAIN_LINK', $link);
define('APP_NAME', $applicationName);

(new yii\web\Application($config))->run();
