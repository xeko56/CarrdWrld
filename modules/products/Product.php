<?php

namespace app\modules\products;

/**
 * products module definition class
 */
class Product extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\products\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        $this->layout = '@app/views/layouts/menubar';
    }
}
