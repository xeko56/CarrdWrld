<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Carrd Wrld';
?>
<div class="container py-4">
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold my-5 my-md-6">

        <!--begin::Item-->
        <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
            <a href="/" class="text-gray-500 text-hover-primary">
                <i class="ki-duotone ki-home fs-3 text-gray-400 me-n1"></i>
            </a>
        </li>
        <!--end::Item-->

        <!--begin::Item-->
        <li class="breadcrumb-item">
            <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
        </li>
        <!--end::Item-->


        <!--begin::Item-->
        <li class="breadcrumb-item text-gray-500">
            <a href="/" class="text-gray-500 text-hover-primary">
                <?= $cards[0]['category_name'] ?>
            </a>
        </li>
        <!--end::Item-->

    </ul>

    <?php if (count($cards) > 0) { ?>
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="col-xl-12">

                <!--begin::List widget 5-->
                <div class="card card-flush h-xl-100">
                    <!--begin::Header-->
                    <div class="card-header pt-7">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-dark"><?= $cards[0]['category_name'] ?></span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">1M Products shipped so far</span>
                        </h3>
                        <!--end::Title-->

                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div class="card-body">
                        <input hidden id="category_nr" value="<?= $cards[0]['category_nr'] ?>">
                        <table id="category_card_table" class="table align-middle table-row-dashed fs-6 gy-3 dataTable no-footer">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th></th>
                                    <th class="min-w-150px sorting">Name</th>
                                    <th class="min-w-150px sorting">ID</th>
                                    <th class="min-w-150px sorting">Rarity</th>
                                    <th class="min-w-100px sorting">Availability</th>
                                    <th class="min-w-100px sorting">Price from</th>
                                </tr>
                            </thead>
                            <tbody class="fw-bold text-gray-600">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>