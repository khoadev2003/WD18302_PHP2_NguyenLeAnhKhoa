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
                                <li class="breadcrumb-item"><a href="<?= action('admin/ve') ?>">Danh sách vé</a></li>
                                <li class="breadcrumb-item active">Thêm vé</li>
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
                            foreach ($flight_detail as $flight) {

                            }
                            ?>

                            <div class="tab-content">
                                <div class="tab-pane show active" id="input-types-preview">
                                    <form action="" method="post">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="example-select" class="form-label">Hãng hàng không</label>

                                                    <select name="airline" class="form-select" id="select_airline" required>
                                                        <option value="" selected>Chọn hãng hàng không</option>
                                                        <?php
                                                        foreach ($list_airline as $item):
                                                            extract($item);
                                                            if($flight['airline_id'] == $id) {
                                                                echo '<option selected value="' . $id . '">' . $name . '</option>';
                                                            }else {
                                                                echo '<option value="' . $id . '">' . $name . '</option>';
                                                            }
                                                            ?>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                    <span class="text-danger error">
                                                        <?= Session::pull('err_airline_id') ?>
                                                    </span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="simpleinput" class="form-label">Số hiệu chuyến bay</label>
                                                    <input type="text" name="name" value="<?= old('name', $flight['name']) ?>" id="simpleinput" class="form-control" placeholder="Số hiệu máy bay">
                                                    <span class="text-danger error">
                                                        <?= Session::pull('err_name') ?>
                                                    </span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="simpleinput" class="form-label">Giá tiền</label>
                                                    <input type="number" name="price" value="<?= old('price' , $flight['price']) ?>" id="simpleinput" class="form-control" placeholder="Giá tiền">
                                                    <span class="text-danger error">
                                                        <?= Session::pull('err_price') ?>
                                                    </span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="simpleinput" class="form-label">Số ghế</label>
                                                    <input type="number" name="seat" value="<?= old('seat', $flight['seat']) ?>" id="simpleinput" class="form-control" placeholder="Nhập số ghế">
                                                    <span class="text-danger error">
                                                        <?= Session::pull('err_seat') ?>
                                                    </span>
                                                </div>


                                                <!-- end d-grid -->
                                            </div> <!-- end col -->

                                            <div class="col-lg-6">

                                                <div class="mb-3">
                                                    <label for="departure_airport" class="form-label">Địa điểm khởi hành</label>
                                                    <select name="departure_airport" class="form-select" id="departure_airport">
                                                        <option value="" selected>Chọn diểm khởi hành</option>
                                                        <?php
                                                        foreach ($list_airport as $item):
                                                            extract($item);
                                                            if($flight['departure_airport_id'] == $id) {
                                                                echo '<option selected value="' . $id . '">' . $name . '</option>';
                                                            }else {
                                                                echo '<option value="' . $id . '">' . $name . '</option>';
                                                            }
                                                            ?>
                                                        ?>

                                                        <?php
                                                        endforeach;
                                                        ?>

                                                    </select>
                                                    <span class="text-danger error">
                                                        <?= Session::pull('err_departure_airport_id') ?>
                                                    </span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="departure_date" class="form-label">
                                                        Ngày giờ khởi hành

                                                    </label>
                                                    <input class="form-control" value="<?= old('departure_date', $flight['departure_datetime']) ?>" id="departure_date" type="datetime-local" name="departure_date">
                                                    <span class="text-danger error">
                                                        <?= Session::pull('err_departure_datetime') ?>
                                                    </span>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="arrival_airport" class="form-label">Địa điểm đến</label>
                                                    <select name="arrival_airport" class="form-select" id="arrival_airport">
                                                        <option value="" selected>Chọn diểm đến</option>
                                                        <?php
                                                        foreach ($list_airport as $item):
                                                            extract($item);
                                                            if($flight['arrival_airport_id'] == $id) {
                                                                echo '<option selected value="' . $id . '">' . $name . '</option>';
                                                            }else {
                                                                echo '<option value="' . $id . '">' . $name . '</option>';
                                                            }
                                                       ?>

                                                        <?php
                                                        endforeach;
                                                        ?>

                                                    </select>
                                                    <span class="text-danger error">
                                                        <?= Session::pull('err_arrival_airport_id') ?>
                                                    </span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="arrival_date" class="form-label">
                                                        Ngày giờ đến

                                                    </label>
                                                    <input class="form-control" value="<?= old('arrival_date', $flight['arrival_datetime']) ?>" name="arrival_date" id="arrival_date" type="datetime-local" name="arrival_date">
                                                    <span class="text-danger error">
                                                        <?= Session::pull('err_arrival_datetime') ?>
                                                    </span>
                                                </div>


                                                <!-- Xác nhận thêm vé -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#success-header-modal">
                                                    Cập nhật vé
                                                </button>

                                                <a href="<?= action('admin/ve') ?>" class="btn btn-danger">Danh sách</a>

                                                <button type="button" tabindex="0" class="btn btn-dark" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-content="Nhập đầy đủ các thông tin để thêm vé. Ngày khởi hành và ngày đến chỉ được nhập ngày hiện tại hoặc tương lai" title="Lưu ý !">
                                                    Hướng dẫn
                                                </button>

                                                <div id="success-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="success-header-modalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-primary">
                                                                <h4 class="modal-title text-light" id="success-header-modalLabel">Xác nhận</h4>
                                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Bạn có chắc chắn muốn cập nhật?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                                                                <button type="submit" name="add_ticket" class="btn btn-primary">Xác nhận</button>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->


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
