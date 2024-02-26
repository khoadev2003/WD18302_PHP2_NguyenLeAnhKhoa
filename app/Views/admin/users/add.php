<?php
use App\Core\Session;
?>
<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">


            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                                <li class="breadcrumb-item"><a href="<?= action('admin/tai-khoan') ?>">Danh sách tài khoản</a></li>
                                <li class="breadcrumb-item active"><?= $title ?></li>
                            </ol>
                        </div>
                        <h4 class="page-title"><?= $title ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-12">

                    <div class="card">

                        <div class="card-body">
                            <h4 class="header-title"><?= $title ?></h4>

                            <ul class="nav nav-tabs nav-bordered mb-3">

                            </ul> <!-- end nav-->
                            <?php
                            if(Session::has('success')):
                                ?>
                                <div class="alert alert-success">

                                    <?= Session::pull('success') ?>

                                </div>
                            <?php
                            endif
                            ?>

                            <?php
                            if(Session::has('not-success')):
                                ?>
                                <div class="alert alert-danger">

                                    <?= Session::pull('not-success') ?>

                                </div>
                            <?php
                            endif
                            ?>

                            <div class="tab-content">
                                <div class="tab-pane show active" id="input-types-preview">
                                    <form action="" method="post" enctype="multipart/form-data" >
                                        <div class="row">
                                            <div class="col-lg-6">

                                                <div class="mb-3">
                                                    <label for="fullname" class="form-label">Họ và tên</label>
                                                    <input type="text" name="fullname" value="<?= old('fullname') ?>" id="fullname" class="form-control" placeholder="Nhập họ và tên">
                                                    <span class="text-danger error">
                                                        <?= Session::pull('err_fullname') ?>
                                                    </span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Tên đăng nhập</label>
                                                    <input type="text" name="username" value="<?= old('username') ?>" id="username" class="form-control" placeholder="Nhập tên đăng nhập">
                                                    <span class="text-danger error">
                                                        <?= Session::pull('err_username') ?>
                                                    </span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" name="email" value="<?= old('email') ?>" id="email" class="form-control" placeholder="Nhập email">
                                                    <span class="text-danger error">
                                                        <?= Session::pull('err_email') ?>
                                                    </span>
                                                </div>


                                                <!-- end d-grid -->
                                            </div> <!-- end col -->



                                            <div class="col-lg-6">

                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Số điện thoại</label>
                                                    <input type="text" name="phone" value="<?= old('phone') ?>" id="phone" class="form-control" placeholder="Nhập số điện thoại">
                                                    <span class="text-danger error">
                                                    <?= Session::pull('err_phone') ?>
                                                </span>
                                                </div>


                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Mật khẩu</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="password" name="password" value="<?= old('password') ?>" id="password" class="form-control" placeholder="Mật khẩu">
                                                        <div class="input-group-text" data-password="false">
                                                            <span class="password-eye"></span>
                                                        </div>
                                                    </div>
                                                    <span class="text-danger error">
                                                        <?= Session::pull('err_password') ?>
                                                    </span>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="password" name="confirm" value="<?= old('confirm') ?>" id="confirm_password" class="form-control" placeholder="Xác nhận mật khẩu">
                                                        <div class="input-group-text" data-password="false">
                                                            <span class="password-eye"></span>
                                                        </div>
                                                    </div>
                                                    <span class="text-danger error">
                                                        <?= Session::pull('err_confirm') ?>
                                                    </span>
                                                </div>

<!--                                                <div class="mb-3">-->
<!--                                                    <label for="image" class="form-label">Hình ảnh</label>-->
<!--                                                    <input type="file" name="image" id="image" class="form-control" placeholder="image">-->
<!--                                                    <span class="text-danger error">-->
<!--                                                        --><?php //= Session::pull('err_image') ?>
<!--                                                    </span>-->
<!--                                                </div>-->

                                                <!-- Xác nhận thêm vé -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#success-header-modal">
                                                    Thêm tài khoản
                                                </button>

                                                <div id="success-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="success-header-modalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-primary">
                                                                <h4 class="modal-title text-light" id="success-header-modalLabel">Xác nhận</h4>
                                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Bạn có chắc chắn muốn thêm tài khoản?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                                                                <button type="submit" name="add_ticket" class="btn btn-primary">Xác nhận</button>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->

                                                <a class="btn btn-danger" href="<?= action('admin/tai-khoan') ?>">Danh sách</a>

                                                <!-- end d-grid -->
                                            </div> <!-- end col -->

                                            <div class="col-lg-6">




                                        </div>
                                        <!-- end row-->
                                    </form>
                                </div> <!-- end preview-->



                            </div> <!-- end tab-content-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->





        </div> <!-- container -->

    </div> <!-- content -->

    <!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © Hyper - Đặt vé online
                </div>
                <div class="col-md-6">
                    <div class="text-md-end footer-links d-none d-md-block">
                        <a href="javascript: void(0);">About</a>
                        <a href="javascript: void(0);">Support</a>
                        <a href="javascript: void(0);">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->

</div>



<style>
    .form-control:focus {
        border-color: #727CF5;
    }

    /* Tùy chỉnh chiều cao cho phần select của Select2 */
    .select2-container--default .select2-selection--single {
        height: 37.6px;
        /* Điều chỉnh chiều cao theo ý muốn của bạn */
        background-color: var(--ct-input-bg);
        border: var(--ct-border-width) solid var(--ct-border-color);
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: var(--ct-body-color);
        line-height: 38px;
    }

    .select2-container--default .select2-selection__rendered {
        color: #111;
    }
</style>