<?php

/** @var yii\web\View $this */

use yii\helpers\Url;
use yii\grid\GridView;

$this->title = 'Carrd Wrld';
$customColumnNames = ['ID', 'Name', 'Expansion', 'Group', 'Type', 'Release date'];
$jsonData = json_encode(['data' => $data, 'columns' => $customColumnNames]);
?>

<section class="trending_section mb-10">
    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-xl-12">

            <!--begin::List widget 5-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-dark">Trending</span>
                        <span class="text-gray-400 mt-1 fw-semibold fs-6">1M Products shipped so far</span>
                    </h3>
                    <!--end::Title-->

                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div class="card-body">
                    <input type="hidden" id="gridData" value='<?php echo htmlentities($jsonData); ?>'>
                    <table id="trending_table" class="table align-middle table-row-dashed fs-6 gy-3 dataTable no-footer">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th></th>
                                <th class="min-w-150px sorting">Name</th>
                                <th class="min-w-150px sorting">Group</th>
                                <th class="min-w-150px sorting">Expansion</th>
                                <th class="min-w-100px sorting">Type</th>
                                <th class="min-w-100px sorting">Release date</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="category_section">
    <h2 class="h2 fw-bold mb-4">Categories</h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-10">
        <?php foreach ($categories as $index => $category) {
            if ($index > 0) { ?>
                <div class="col">
                    <div class="card card-flush h-xl-100 hover-effect">
                        <a href="<?= Yii::$app->urlManager->createUrl(['site/categories', 'category_nr' => $category['category_nr']]) ?>" class="text-decoration-none">
                            <div class="card-body p-9">
                                <div class="d-flex flex-column align-items-center text-center transition-all">
                                    <img src=" <?= Url::to("@web/images/{$category['imgsrc']}", true) ?>" alt="<?= $category['category_name'] ?>" class="category-img mb-4">
                                    <h3 class="h5 fw-semibold"><?= $category['category_name'] ?></h3>
                                </div>
                            </div>
                            <div class="card-header border-0 pb-9">
                                <div class="fs-3 fw-bold text-dark">
                                    <?= $category['category_name'] ?> </div>
                            </div>
                        </a>
                    </div>
                </div>
        <?php }
        } ?>
    </div>
</div>
</section>