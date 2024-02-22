            <!-- ========== Left Sidebar Start ========== -->
            <div class="leftside-menu">

                <!-- Brand Logo Light -->
                <a href="<?= action('') ?>" class="logo logo-light">
                    <span class="logo-lg">
                        <img src="<?= asset('admin/assets/images/logo.png') ?>" alt="logo">
                    </span>
                    <span class="logo-sm">
                        <img src="<?= asset('admin/assets/images/logo-sm.png') ?>" alt="small logo">
                    </span>
                </a>

                <!-- Brand Logo Dark -->
                <a href="<?= action('admin') ?>" class="logo logo-dark">
                    <span class="logo-lg">
                        <img src="<?= asset('admin/assets/images/logo-dark.png') ?>" alt="dark logo">
                    </span>
                    <span class="logo-sm">
                        <img src="<?= asset('admin/assets/images/logo-dark-sm.png') ?>" alt="small logo">
                    </span>
                </a>

                <!-- Sidebar Hover Menu Toggle Button -->
                <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
                    <i class="ri-checkbox-blank-circle-line align-middle"></i>
                </div>

                <!-- Full Sidebar Menu Close Button -->
                <div class="button-close-fullsidebar">
                    <i class="ri-close-fill align-middle"></i>
                </div>

                <!-- Sidebar -left -->
                <div class="h-100" id="leftside-menu-container" data-simplebar>
                    <!-- Leftbar User -->
                    <div class="leftbar-user">
                        <a href="pages-profile.html">
                            <img src="<?= asset('admin/assets/images/users/avatar-1.jpg') ?>" alt="user-image" height="42" class="rounded-circle shadow-sm">
                            <span class="leftbar-user-name mt-2">Dominic Keller</span>
                        </a>
                    </div>

                    <!--- Sidemenu -->
                    <ul class="side-nav">

                        <li class="side-nav-title">Navigation</li>

                        <li class="side-nav-item">
                            <a href="<?= action('') ?>" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-success float-end">5</span>
                                <span> Dashboards </span>
                            </a>
                            
                        </li>

                        <li class="side-nav-title">Apps</li>

                        <li class="side-nav-item">
                            <a href="<?= action('admin/ve') ?>" class="side-nav-link">
                                <i class="uil-ticket"></i>
                                <span> Tickets </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="<?= action('admin/hang-hang-khong') ?>" class="side-nav-link">
                                <i class="uil-plane"></i>
                                <span> Airlines </span>
                            </a>
                        </li>

                       

                        <li class="side-nav-item">
                            <a href="<?= action('admin/san-bay') ?>" class="side-nav-link">
                                <i class="uil-location"></i>
                                <span> Airports </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="<?= action('admin/tai-khoan') ?>" class="side-nav-link">
                                <i class="uil-user"></i>
                                <span> Users </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="<?= action('admin/dang-xuat') ?>" class="side-nav-link text-primary">
                                <i class="mdi mdi-logout"></i>
                                <span>Đăng xuất</span>
                            </a>
                        </li>

                        


                        <!-- Help Box -->
                        <div class="help-box text-white text-center">
                            <a href="javascript: void(0);" class="float-end close-btn text-white">
                                <i class="mdi mdi-close"></i>
                            </a>
                            <img src="<?= asset('uploads/VJ.png') ?>" height="90" alt="Helper Icon Image" />
                            <h5 class="mt-3">Đối tác hàng đầu</h5>
                            <p class="mb-3">Với hơn 10 năm hợp tác phát triển</p>
                            <a href="javascript: void(0);" class="btn btn-secondary btn-sm">Upgrade</a>
                        </div>
                        <!-- end Help Box -->

                        <div class="help-box text-white text-center">
                            <a href="javascript: void(0);" class="float-end close-btn text-white">
                                <i class="mdi mdi-close"></i>
                            </a>
                            <img src="<?= asset('uploads/BL.png') ?>" height="90" alt="Helper Icon Image" />
                            <h5 class="mt-3">Đối tác hàng đầu</h5>
                            <p class="mb-3">Với hơn 10 năm hợp tác phát triển</p>
                            <a href="javascript: void(0);" class="btn btn-secondary btn-sm">Upgrade</a>
                        </div>


                    </ul>
                    <!--- End Sidemenu -->

                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- ========== Left Sidebar End ========== -->