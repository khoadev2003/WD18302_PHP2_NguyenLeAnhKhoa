<?php
    use App\Core\Session;
?>
<!DOCTYPE html>
<html lang="en">


<head>
        <meta charset="utf-8" />
        <title>Đăng nhập | Vai trò Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="<?= asset('admin/assets/images/favicon.ico') ?>">
        
        <!-- Theme Config Js -->
        <script src="<?= asset('admin/assets/js/hyper-config.js') ?>"></script>

        <!-- App css -->
        <link href="<?= asset('admin/assets/css/app-saas.min.css') ?>" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons css -->
        <link href="<?= asset('admin/assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
    </head>
    
    <body class="authentication-bg position-relative">
        <div class="position-absolute start-0 end-0 start-0 bottom-0 w-100 h-100">
            <svg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%' viewBox='0 0 800 800'>
                <g fill-opacity='0.22'>
                    <circle style="fill: rgba(var(--ct-primary-rgb), 0.1);" cx='400' cy='400' r='600'/>
                    <circle style="fill: rgba(var(--ct-primary-rgb), 0.2);" cx='400' cy='400' r='500'/>
                    <circle style="fill: rgba(var(--ct-primary-rgb), 0.3);" cx='400' cy='400' r='300'/>
                    <circle style="fill: rgba(var(--ct-primary-rgb), 0.4);" cx='400' cy='400' r='200'/>
                    <circle style="fill: rgba(var(--ct-primary-rgb), 0.5);" cx='400' cy='400' r='100'/>
                </g>
            </svg>
        </div>
        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-lg-5">
                        <div class="card">

                            <!-- Logo -->
                            <div class="card-header py-4 text-center bg-primary">
                                <a href="<?= action('admin') ?>">
                                    <span><img src="<?= asset('admin/assets/images/logo.png') ?>" alt="logo" height="22"></span>
                                </a>
                            </div>

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <h4 class="text-dark-50 text-center pb-0 fw-bold">Đăng nhập</h4>
                                    <p class="text-muted mb-4">Nhập địa chỉ email và mật khẩu của bạn để truy cập bảng quản trị.</p>
                                </div>

                                <form action="" method="post">

                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label">Tài khoản hoặc email</label>
                                        <input class="form-control" value="<?= old('email') ?>" name="email" type="email"
                                               id="emailaddress" placeholder="Nhập tài khoản hoặc email" autofocus>
                                        <span class="text-danger error">
                                            <?= Session::pull('err_email') ?>
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <a href="<?= action('admin/quen-mat-khau') ?>" class="text-muted float-end"><small>Quên mật khẩu?</small></a>
                                        <label for="password" class="form-label">Mật khẩu</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" value="<?= old('password') ?>" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                        <span class="text-danger error">
                                            <?= Session::pull('err_password') ?>
                                        </span>
                                    </div>

                                    <div class="mb-3 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                            <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>

                                    <div class="mb-3 mb-0 text-center">
                                        <button class="btn btn-primary" type="submit"> Đăng nhập </button>
                                    </div>

                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt">
            <script>document.write(new Date().getFullYear())</script> © Hyper - Đặt vé máy bay trực tuyến
        </footer>
        <!-- Vendor js -->
        <script src="<?= asset('admin/assets/js/vendor.min.js')?>"></script>
        
        <!-- App js -->
        <script src="<?= asset('admin/assets/js/app.min.js')?>"></script>

    </body>

<!-- Mirrored from coderthemes.com/hyper/saas/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Dec 2023 13:30:15 GMT -->
</html>
