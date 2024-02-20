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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Data Tables</li>
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

                            <div class="row mb-2">
                                <div class="col-sm-5">
                                    <a href="<?= action('admin/them-ve')  ?>" class="btn btn-primary mb-2"><i class="mdi mdi-plus-circle me-2"></i> Thêm vé máy bay</a>
                                </div>
                                
                                <div class="col-sm-7">
                                    <div class="text-sm-end">
                                        <button type="button" class="btn btn-success mb-2 me-1"><i class="mdi mdi-cog-outline"></i></button>
                                        <button type="button" class="btn btn-light mb-2 me-1">Import</button>
                                        <button type="button" class="btn btn-light mb-2">Export</button>
                                    </div>
                                </div><!-- end col-->
                            </div>



                            <ul class="nav nav-tabs nav-bordered mb-3 mt-2">

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

                            <!-- tab-content  -->
                            <!-- table table-centered w-100 dt-responsive nowrap -->
                            <div class="tab-content table-responsive">
                                <!-- <div class="tab-pane show active" id="basic-datatable-preview"> -->
                                <table id="basic-datatable" class="table table-centered dt-responsive nowrap w-100">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Tên chuyến bay</th>
                                            <th>Thông tin</th>
                                            <th>Số ghế</th>
<!--                                            <th>Hiện còn</th>-->
                                            <th>Giá</th>
                                            <th>Thao tác</th>

                                        </tr>
                                    </thead>


                                    <tbody>
                                    <?php
                                        $i = 0;
                                        foreach ($list_flight as $item):
                                            extract($item);
                                            $i++;
                                    ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $name ?></td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <img style="max-width: 90px;" src="<?= asset('uploads/'). $logo_airline ?>" alt="logo">
                                                    </div>
                                                    <div class="col-md-9">
<!--                                                        <p class="p-table text-danger fw-bolder">--><?php //= $airline_name ?><!--</p>-->

                                                        <p class="p-table"><span class="fw-bolder">Khởi hành:</span> <?= $departure_airport_name ?></p>
                                                        <p class="p-table"><span class="fw-bolder">Thời gian:</span> <?= $departure_datetime ?></p>

                                                        <p class="p-table"><span class="fw-bolder">Đến:</span> <?= $arrival_airport_name ?></p>
                                                        <p class="p-table"><span class="fw-bolder">Thời gian:</span> <?= $arrival_datetime ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?=$seat ?></td>
<!--                                            <td>--><?php //=$seat ?><!--</td>-->
                                            <td><?= number_format($price) ?>.đ</td>
                                            <td>
                                                <a href="<?= action('admin/ve/cap-nhat/').$id ?>" class="btn btn-outline-primary"><i class="mdi mdi-eye"></i></a>
                                                <a href="<?= action('admin/ve/cap-nhat/').$id ?>" class="btn btn-outline-warning"><i class="mdi mdi-pencil"></i></a>

                                                <!-- Danger Header Modal -->
                                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#danger-header-modal-<?=$id?>">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>

                                                <div id="danger-header-modal-<?=$id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger">
                                                                <h4 class="modal-title text-light" id="danger-header-modalLabel">Xác nhận</h4>
                                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Bạn có chắc chắn muốn xóa?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                                                                <a href="<?= action('admin/ve/xoa/').$id ?>" class="btn btn-danger">Xác nhận</a>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            </td>
                                        </tr>
                                    <?php

                                        endforeach;
                                    ?>








                                    </tbody>
                                </table>
                                <!-- </div> end preview -->


                            </div> <!-- end tab-content-->




                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div> <!-- end row-->




        </div> <!-- container -->

    </div> <!-- content -->


    <!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    Vé máy bay HYPER
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





<!-- ============================================================== -->
<!-- End Page content -->

<!-- End wraper -->
</div>

<style>
    .p-table {
        margin-bottom: 0.2rem;
    }
</style>