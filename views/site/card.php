<div class="container py-4">
    <div class="d-flex justify-content-center align-items-center">
        <div class="card shadow-sm overflow-hidden">
            <div class="row g-0">
                <div class="position-relative">
                    <div class="card-header">
                        <span class="card-title fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2"><?= $cards[0]['card_name'] ?></span>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-3 d-flex justify-content-center justify-content-md-start">
                                <div class="text-center d-md-block">
                                    <img src="<?= $cards[0]['img_url'] ?>" alt="<?= $cards[0]['card_name'] ?>" class="img-fluid rounded-top w-200px pb-10">
                                    <p class="card-text text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus hendrerit odio id nunc consequat rhoncus. Fusce vulputate condimentum nulla ac fringilla.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-9 pt-4 pt-md-0">

                                <!-- Bootstrap Tabs -->
                                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold" id="card_tabs">
                                    <li class="nav-item">
                                        <button href="#" class="nav-link text-active-primary ms-0 me-10 py-5 active" data-bs-toggle="pill" data-bs-target="#info_content" type="button" role="tab" aria-controls="info_content" aria-selected="true" id="info_tab">Info</button>
                                    </li>
                                    <li class="nav-item">
                                        <button href="#" class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="pill" data-bs-target="#statistic_content" type="button" role="tab" aria-controls="statistic_content" aria-selected="false" id="statistic_tab">Statistic</button>
                                    </li>
                                    <li class="nav-item">
                                        <button href="#" class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="pill" data-bs-target="#contacts_content" type="button" role="tab" aria-controls="contacts_content" aria-selected="false" id="contacts_tab">Contacts</button>
                                    </li>
                                </ul>

                                <div class="tab-content" id="card_tab_content">
                                    <div class="tab-pane fade show active pt-5" id="info_content" role="tabpanel" aria-labelledby="info_tab">
                                        <h5 class="card-title">Info</h5>
                                        <p class="text-gray-600 fw-semibold fs-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus hendrerit odio id nunc consequat rhoncus. Fusce vulputate condimentum nulla ac fringilla.</p>
                                    </div>
                                    <div class="tab-pane fade pt-5" id="statistic_content" role="tabpanel" aria-labelledby="statistic_tab">
                                        <p class="text-gray-600 fw-semibold fs-6">This is some placeholder content for the Statistic tab...</p>
                                    </div>
                                    <div class="tab-pane fade pt-5" id="contacts_content" role="tabpanel" aria-labelledby="contacts_tab">
                                        <p class="text-gray-600 fw-semibold fs-6">This is some placeholder content for the Contacts tab...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>