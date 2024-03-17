<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Authentication - Sign-up -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-column flex-lg-row-auto bg-primary w-xl-600px positon-xl-relative">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                <!--begin::Header-->
                <div class="d-flex flex-row-fluid flex-column text-center p-5 p-lg-10 pt-lg-20">
                    <!--begin::Logo-->
                    <a href="/assets/oswald/index.html" class="py-2 py-lg-20">
                        <img alt="Logo" src="/assets/oswald/assets/media/logos/default.svg" class="h-40px h-lg-50px">
                    </a>
                    <!--end::Logo-->

                    <!--begin::Title-->
                    <h1 class="d-none d-lg-block fw-bold text-white fs-2qx pb-5 pb-md-10">
                        Welcome to Carrd Wrld </h1>
                    <!--end::Title-->

                    <!--begin::Description-->
                    <p class="d-none d-lg-block fw-semibold fs-2 text-white">
                        You can't emerge victorious in the game <br>
                        unless you possess the very soul of the cards.
                    </p>
                    <!--end::Description-->
                </div>
                <!--end::Header-->

                <!--begin::Illustration-->
                <div class="d-none d-lg-block d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url(/assets/oswald/assets/media/illustrations/sketchy-1/17.png)">
                </div>
                <!--end::Illustration-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--begin::Aside-->

        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid py-10">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid">
                <!--begin::Wrapper-->
                <div class="w-lg-600px p-10 p-lg-15 mx-auto">

                    <!--begin::Form-->
                    <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" action="/site/signup" method="POST" data-kt-redirect-url="/site/login" id="kt_sign_up_form">
                        <!--begin::Heading-->
                        <div class="mb-10 text-center">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">
                                Create an Account
                            </h1>
                            <!--end::Title-->

                            <!--begin::Link-->
                            <div class="text-gray-400 fw-semibold fs-4">
                                Already have an account?

                                <a href="/site/login" class="link-primary fw-bold">
                                    Sign in here
                                </a>
                            </div>
                            <!--end::Link-->
                        </div>
                        <!--end::Heading-->

                        <!--begin::Action-->
                        <button type="button" class="btn btn-light-primary fw-bold w-100 mb-10">
                            <img alt="Logo" src="/assets/oswald/assets/media/svg/brand-logos/google-icon.svg" class="h-20px me-3">
                            Sign in with Google
                        </button>
                        <!--end::Action-->

                        <!--begin::Separator-->
                        <div class="d-flex align-items-center mb-10">
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                            <span class="fw-semibold text-gray-400 fs-7 mx-2">OR</span>
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        </div>
                        <!--end::Separator-->

                        <!--begin::Input group-->
                        <div class="row fv-row mb-7 fv-plugins-icon-container">
                            <!--begin::Col-->
                            <div class="col-xl-6">
                                <label class="form-label fw-bold text-dark fs-6">First Name</label>
                                <input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="firstname" autocomplete="off">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-xl-6">
                                <label class="form-label fw-bold text-dark fs-6">Last Name</label>
                                <input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="lastname" autocomplete="off">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7 fv-plugins-icon-container">
                            <label class="form-label fw-bold text-dark fs-6">Username</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="username" autocomplete="off">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7 fv-plugins-icon-container">
                            <label class="form-label fw-bold text-dark fs-6">Email</label>
                            <input class="form-control form-control-lg form-control-solid" type="email" placeholder="" name="email" autocomplete="off">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="mb-10 fv-row fv-plugins-icon-container" data-kt-password-meter="true">
                            <!--begin::Wrapper-->
                            <div class="mb-1">
                                <!--begin::Label-->
                                <label class="form-label fw-bold text-dark fs-6">
                                    Password
                                </label>
                                <!--end::Label-->

                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password" autocomplete="off" aria-autocomplete="list">

                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                        <i class="ki-duotone ki-eye-slash fs-2"></i> <i class="ki-duotone ki-eye fs-2 d-none"></i> </span>
                                </div>
                                <!--end::Input wrapper-->

                                <!--begin::Meter-->
                                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                </div>
                                <!--end::Meter-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Hint-->
                            <div class="text-muted">
                                Use 8 or more characters with a mix of letters, numbers &amp; symbols.
                            </div>
                            <!--end::Hint-->
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                        <!--end::Input group--->

                        <!--begin::Input group-->
                        <div class="fv-row mb-5 fv-plugins-icon-container fv-plugins-bootstrap5-row-invalid">
                            <label class="form-label fw-bold text-dark fs-6">Confirm Password</label>
                            <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="confirm-password" autocomplete="off">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                <div data-field="confirm-password" data-validator="notEmpty">The password confirmation is required</div>
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10 fv-plugins-icon-container">
                            <label class="form-check form-check-custom form-check-solid form-check-inline">
                                <input class="form-check-input" type="checkbox" name="toc" value="1">
                                <span class="form-check-label fw-semibold text-gray-700 fs-6">
                                    I Agree <a href="#" class="ms-1 link-primary">Terms and conditions</a>.
                                </span>
                            </label>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
                                <span class="indicator-label">
                                    Submit
                                </span>
                                <span class="indicator-progress">
                                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->

            <!--begin::Footer-->
            <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
                <!--begin::Links-->
                <div class="d-flex flex-center fw-semibold fs-6">
                    <a href="https://keenthemes.com" class="text-muted text-hover-primary px-2" target="_blank">About</a>

                    <a href="https://devs.keenthemes.com" class="text-muted text-hover-primary px-2" target="_blank">Support</a>

                    <a href="https://keenthemes.com/products/oswald-html-pro" class="text-muted text-hover-primary px-2" target="_blank">Purchase</a>
                </div>
                <!--end::Links-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-up-->
</div>