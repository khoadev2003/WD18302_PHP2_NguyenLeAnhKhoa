<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

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
                                    <div class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#add_airport">
                                        <i class="mdi mdi-plus-circle me-2"></i> Thêm hãng hàng không
                                    </div>
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

                            <!-- tab-content  -->
                            <!-- table table-centered w-100 dt-responsive nowrap -->
                            <div class="tab-content table-responsive">
                                <!-- <div class="tab-pane show active" id="basic-datatable-preview"> -->
                                <table id="basic-datatable" class="table table-centered dt-responsive nowrap w-100">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Tên hãng</th>
                                            <th>Logo</th>
                                            <th>Ngày thêm</th>
                                            <th>Thao tác</th>

                                        </tr>
                                    </thead>


                                    <tbody>

                                        <tr>
                                            <td class="fw-bolder">Vietjet</td>
                                            <td>
                                                
                                                <img style="max-width: 90px;" src="<?= asset('admin/assets/images/VJ.png') ?>" alt="">
                                                  
                                            </td>
                                            <td class="fw-bolder">21/11/203</td>
                                            
                                            <td>
                                                
                                                <a href="#" class="btn btn-outline-warning"><i class="mdi mdi-pencil"></i></a>

                                                <!-- Danger Header Modal -->
                                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#danger-header-modal">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>

                                                <div id="danger-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel" aria-hidden="true">
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
                                                                <a href="xoa" class="btn btn-danger">Xác nhận</a>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            </td>
                                        </tr>

                                        







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




    <!-- Modal thêm sân bay -->
    <div class="modal fade" id="add_airport" tabindex="-1" aria-labelledby="add_airport" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="CreateProjectLabel">Thêm hãng hàng không</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="mb-3">
                            <label for="airlineName" class="form-label">Tên hãng hàng không</label>
                            <input type="text" class="form-control" id="airlineName" placeholder="Tên hãng hàng không...">
                        </div>
                        <div class="mb-3">
                            <label for="logoAirline" class="form-label">Logo</label>
                            <input type="file" class="form-control" id="logoAirline" placeholder="Địa diểm...">
                        </div>
                       

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary">Lưu lại</button>
                    </div>
                </div>
            </div>
        </div>


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