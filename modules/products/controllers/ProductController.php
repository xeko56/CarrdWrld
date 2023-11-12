<?php

namespace app\modules\products\controllers;

use yii\web\Controller;
use app\modules\products\models\Product;

/**
 * Default controller for the `products` module
 */
class ProductController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id)
    {
        // Fetch the product details from the database based on the $id.
        $product = Product::get_product_table("card_nr=$id");
        // Render the product view with the $product data.
        return $this->render('view', [
            'product' => $product,
        ]);
    }    
}
