<!-- <div class="products-default-index">
    <h1><?= $product[0]['card_name'] ?></h1>
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?= $product[0]['card_name'] ?></h6>
            </div>
            <div class="card-body">
                <img src="<?= $product[0]['img_url'] ?>" class="product-img" alt="...">
            </div>
        </div>
    </div>
</div> -->

<div class="container my-5">
    <div class="row">
        <div class="col-md-8">
            <!-- Product picture -->
            <img src="<?= $product[0]['img_url'] ?>" alt="<?= $product[0]['card_name']?>" class="img-fluid rounded mb-4">

            <!-- Product information -->
            <h1 class="display-4"><?= $product[0]['card_name']  ?></h1>
            <!-- <p class="lead"></p> -->
            <p class="h4"><strong>Price:</strong> <?= Yii::$app->formatter->asCurrency($product->price) ?></p>
            <!-- Add more product details here -->

            <hr>

            <!-- Additional details or description -->
            <h2 class="mb-3">Additional Details</h2>
            <ul class="list-unstyled">
                <li><strong>Brand:</strong> <?= 12//Html::encode($product->brand) ?></li>
                <li><strong>Category:</strong> <?= 12//Html::encode($product->category) ?></li>
                <!-- Add more details as needed -->
            </ul>
        </div>
        <div class="col-md-4">
            <!-- Sidebar or related products could go here -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Related Products</h4>
                    <!-- Display related products or other sidebar content here -->
                </div>
            </div>
        </div>
    </div>
</div>