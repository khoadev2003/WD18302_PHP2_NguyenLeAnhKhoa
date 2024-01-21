<!DOCTYPE html>
<html lang="en">

    
<!-- Mirrored from coderthemes.com/hyper/saas/pages-recoverpw.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Dec 2023 13:30:16 GMT -->
<head>
        <meta charset="utf-8" />
        <title>Quên mật khẩu</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Theme Config Js -->
        <script src="<?= asset('admin/')?>assets/js/hyper-config.js"></script>

        <!-- App css -->
        <link href="<?= asset('admin/')?>assets/css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons css -->
        <link href="<?= asset('admin/')?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    </head>

    <body class="authentication-bg">

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
                                    <span><img src="<?= asset('admin/')?>assets/images/logo.png" alt="logo" height="22"></span>
                                </a>
                            </div>
                            
                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <h4 class="text-dark-50 text-center mt-0 fw-bold">Đặt lại mật khẩu</h4>
                                    <p class="text-dark mb-4">Nhập địa chỉ email của bạn và chúng tôi sẽ gửi cho bạn một email kèm theo hướng dẫn để đặt lại mật khẩu của bạn.</p>
                                </div>

                                <form action="#">
                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label">Email address</label>
                                        <input class="form-control" type="email" id="emailaddress" required="" placeholder="Nhập địa chỉ email">
                                    </div>

                                    <div class="mb-0 text-center">
                                        <button class="btn btn-primary" type="submit">Đặt lại mật khẩu</button>
                                    </div>
                                </form>
                            </div> <!-- end card-body-->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted">
                                    <a href="<?= action('admin') ?>">Trở lại </a>
                                    <a href="<?= action('admin/login') ?>" class="text-muted ms-1"><b>Đăng nhập</b></a>
                                </p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt">
            <script>document.write(new Date().getFullYear())</script> © Hyper - Quản lý vé máy bay
        </footer>
        <!-- Vendor js -->
        <script src="<?= asset('admin/')?>assets/js/vendor.min.js"></script>
        
        <!-- App js -->
        <script src="<?= asset('admin/')?>assets/js/app.min.js"></script>

    </body>


</html>
