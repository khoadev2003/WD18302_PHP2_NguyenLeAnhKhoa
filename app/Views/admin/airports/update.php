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
                                <li class="breadcrumb-item"><a href="<?= action('admin/san-bay') ?>">Danh sách sân bay</a></li>
                                <li class="breadcrumb-item active">Cập nhật sân bay</li>
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

                            foreach ($airport_detail as $item) {
                                extract($item);
                            }

                            ?>

                            <div class="tab-content">
                                <div class="tab-pane show active" id="input-types-preview">
                                    <form action="" method="post">
                                        <div class="row">
                                            <div class="col-lg-6">

                                                <div class="mb-3">
                                                    <label for="name-airline" class="form-label">Tên sân bay</label>
                                                    <input type="text" name="name" value="<?= old('name', $name) ?>" id="name-airline" class="form-control" placeholder="Nhập tên sân bay">
                                                    <span class="text-danger error">
                                                        <?= Session::pull('err_name') ?>
                                                    </span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="logo-airline" class="form-label">Địa diểm</label>
                                                    <input type="text" name="location" value="<?= old('location', $location) ?>" id="logo-airline" class="form-control" placeholder="Địa điểm">
                                                    <span class="text-danger error">
                                                        <?= Session::pull('err_location') ?>
                                                    </span>
                                                </div>

                                                <!-- Xác nhận thêm vé -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#success-header-modal">
                                                    Cập nhật sân bay
                                                </button>

                                                <div id="success-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="success-header-modalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-primary">
                                                                <h4 class="modal-title text-light" id="success-header-modalLabel">Xác nhận</h4>
                                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Bạn có chắc chắn muốn thêm sân bay?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                                                                <button type="submit" name="add_ticket" class="btn btn-primary">Xác nhận</button>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->

                                                <!-- end d-grid -->
                                            </div> <!-- end col -->

                                            <div class="col-lg-6">







                                            </div> <!-- end col -->
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
                    </script> © Hyper - Coderthemes.com
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
