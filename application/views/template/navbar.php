<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div> -->

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <!-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= base_url('DashboardController') ?>" class="nav-link">Home</a>
                </li> -->
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Welcome <?php echo $this->session->userdata('role_id'); ?></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">


                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('Login/logout') ?>" role="button">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= base_url('DashboardController') ?>" class="brand-link">
                <img src="<?= base_url('assets/dist/img/logo-ct.png'); ?>" class="brand-image img-circle elevation-3" style="opacity: .8; background-color: white;">
                <span class="brand-text font-weight-light">Inventory</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="<?= base_url('DashboardController') ?>" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Dashboard
                                    <!-- <span class="right badge badge-danger">New</span> -->
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Transaction
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('OrderController') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Order</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('IteminController') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Item In</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('ItemoutController') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Item out</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php if ($this->session->userdata('role_id') != 'gudang') { ?>
                            <li class="nav-item">
                                <a href="<?= base_url('ItemController') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-box-open"></i>
                                    <p>
                                        Item
                                        <!-- <span class="right badge badge-danger">New</span> -->
                                    </p>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($this->session->userdata('role_id') != 'gudang') { ?>
                            <li class="nav-item">
                                <a href="<?= base_url('CategoryController') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-sitemap"></i>
                                    <p>
                                        Category
                                        <!-- <span class="right badge badge-danger">New</span> -->
                                    </p>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($this->session->userdata('role_id') != 'gudang') { ?>
                            <li class="nav-item">
                                <a href="<?= base_url('UnitController') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-tags"></i>
                                    <p>
                                        Unit
                                        <!-- <span class="right badge badge-danger">New</span> -->
                                    </p>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($this->session->userdata('role_id') != 'gudang') { ?>
                            <li class="nav-item">
                                <a href="<?= base_url('SupplierController') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-user-tag"></i>
                                    <p>
                                        Supplier
                                        <!-- <span class="right badge badge-danger">New</span> -->
                                    </p>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($this->session->userdata('role_id') != 'gudang') { ?>
                            <li class="nav-item">
                                <a href="<?= base_url('WarehouseController') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-warehouse"></i>
                                    <p>
                                        Warehouse
                                        <!-- <span class="right badge badge-danger">New</span> -->
                                    </p>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($this->session->userdata('role_id') != 'gudang') { ?>
                            <li class="nav-item">
                                <a href="<?= base_url('CustomerController') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Customer
                                        <!-- <span class="right badge badge-danger">New</span> -->
                                    </p>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($this->session->userdata('role_id') == 'owner') { ?>
                            <li class="nav-item">
                                <a href="<?= base_url('UserController') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-user-cog"></i>
                                    <p>
                                        User / Employee
                                        <!-- <span class="right badge badge-danger">New</span> -->
                                    </p>
                                </a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Report
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('ItemController/list_of_stock') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>List of Stock</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?= base_url('ItemoutController/list_of_slow_moving') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>List of Slow Moving</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('ItemoutController/list_of_fast_moving') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>List of Fast Moving</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>