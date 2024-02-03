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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">eCommerce</a></li>
                                            <li class="breadcrumb-item active">Products</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Products</h4>
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
                                                <a href="javascript:void(0);" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add Products</a>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                    <button type="button" class="btn btn-success mb-2 me-1"><i class="mdi mdi-cog-outline"></i></button>
                                                    <button type="button" class="btn btn-light mb-2 me-1">Import</button>
                                                    <button type="button" class="btn btn-light mb-2">Export</button>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                
                                        <div class="table-responsive">
                                            <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="all" style="width: 20px;">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                                <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                                            </div>
                                                        </th>
                                                        <th class="all">Product</th>
                                                        <th>Category</th>
                                                        <th>Added Date</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Status</th>
                                                        <th style="width: 85px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="customCheck12">
                                                                <label class="form-check-label" for="customCheck12">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <img src="<?= asset('admin/assets/images/') ?>products/product-5.jpg" alt="contact-img" title="contact-img" class="rounded me-3" height="48" />
                                                            <p class="m-0 d-inline-block align-middle font-16">
                                                                <a href="apps-ecommerce-products-details.html" class="text-body">Farthingale Chair</a>
                                                                <br/>
                                                                <span class="text-warning mdi mdi-star"></span>
                                                                <span class="text-warning mdi mdi-star"></span>
                                                                <span class="text-warning mdi mdi-star"></span>
                                                                <span class="text-warning mdi mdi-star"></span>
                                                                <span class="text-warning mdi mdi-star-half"></span>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            Plastic Armchair
                                                        </td>
                                                        <td>
                                                            04/09/2018
                                                        </td>
                                                        <td>
                                                            $78.66
                                                        </td>
                    
                                                        <td>
                                                            524
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-danger">Deactive</span>
                                                        </td>
                    
                                                        <td class="table-action">
                                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="customCheck13">
                                                                <label class="form-check-label" for="customCheck13">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <img src="<?= asset('admin/assets/images/') ?>products/product-6.jpg" alt="contact-img" title="contact-img" class="rounded me-3" height="48" />
                                                            <p class="m-0 d-inline-block align-middle font-16">
                                                                <a href="apps-ecommerce-products-details.html" class="text-body">Unpowered aircraft</a>
                                                                <br/>
                                                                <span class="text-warning mdi mdi-star"></span>
                                                                <span class="text-warning mdi mdi-star"></span>
                                                                <span class="text-warning mdi mdi-star"></span>
                                                                <span class="text-warning mdi mdi-star"></span>
                                                                <span class="text-warning mdi mdi-star-half"></span>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            Wing Chairs
                                                        </td>
                                                        <td>
                                                            03/24/2018
                                                        </td>
                                                        <td>
                                                            $49
                                                        </td>
                    
                                                        <td>
                                                            204
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-danger">Deactive</span>
                                                        </td>
                    
                                                        <td class="table-action">
                                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->        
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> © Hyper - Coderthemes.com
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
