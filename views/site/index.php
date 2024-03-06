<?php

/** @var yii\web\View $this */

use yii\helpers\Url;
use yii\grid\GridView;

$this->title = 'Carrd Wrld';
$customColumnNames = ['ID', 'Name', 'Expansion', 'Group', 'Type', 'Release date'];
$jsonData = json_encode(['data' => $data, 'columns' => $customColumnNames]);
?>

<section class="trending-section bg-gray-50">

    <div class="mx-auto max-w-7xl">
        <div class="p-5 bg-white rounded-lg shadow-lg">
            <!-- <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <div class="wrapper"></div>
                <table class="border border-collapse border-gray-500 table-auto w-full">
                    <thead class="text-white">
                        <tr class="bg-primary">
                            <th></th>
                            <th class="border border-gray-500">Image</th>
                            <th class="border border-gray-500">Name</th>
                            <th class="border border-gray-500">Expansion</th>
                            <th class="border border-gray-500">Group</th>
                            <th class="border border-gray-500">Type</th>
                            <th class="border border-gray-500">Release Date</th>
                        </tr>
                    </thead>
                    <tbody class="text-table-text">
                        <?php foreach ($data as $index => $card) { ?>
                            <tr class="<?= $index % 2 === 0 ? 'bg-white' : 'bg-even' ?> text-center">
                                <td class="border border-gray-500"><?= $card['card_nr'] ?></td>
                                <td class="border border-gray-500">
                                    <div class="group relative cursor-pointer flex justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-slate-900 group-hover:text-primary">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                                        </svg>

                                        <div class="hidden z-50 group-hover:block absolute left-12 bg-white p-2 border border-gray-300 shadow-md mx-auto items-center transition-opacity duration-300">
                                            <img class="object-cover rounded-sm w-10" src="<?= $card['img_url'] ?>" alt="Image">
                                        </div>
                                    </div>
                                </td>
                                <td class="border border-gray-500"><?= $card['card_name'] ?></td>
                                <td class="border border-gray-500"><?= $card['exp_name'] ?></td>
                                <td class="border border-gray-500"><?= $card['group_name'] ?></td>
                                <td class="border border-gray-500"><?= $card['type_name'] ?></td>
                                <td class="border border-gray-500"><?= $card['release_date'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div> -->
            
            <div class="mx-auto py-6 sm:px-6 lg:px-8">
                <input type="hidden" id="gridData" value='<?php echo htmlentities($jsonData); ?>'>
                <div class="" id="trending-table"></div>
            </div>

        </div>
    </div>


    <div class="section-category max-w-screen-xl mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Categories</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <?php foreach ($categories as $index => $category) {
                if ($index > 0) { ?>
                    <a href="<?= Yii::$app->urlManager->createUrl(['site/categories', 'category_nr' => $category['category_nr']]) ?>">
                        <div class="bg-white p-4 rounded-md shadow-md flex flex-col items-center text-center hover:border-gray-300
                    transition-all duration-300 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <img src="<?= Url::to("@web/images/{$category['imgsrc']}", true) ?>" alt="<?= $category['category_name'] ?>" class="w-32 h-32 object-contain mb-4">
                            <h3 class="text-lg font-semibold"><?= $category['category_name'] ?></h3>
                        </div>
                    </a>
            <?php }
            } ?>
        </div>
    </div>
</section>