<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>Inventory</b>
        </div>
        <?php if ($this->session->flashdata('message')) { ?>
            <div class="alert alert-dismissible alert-danger">
                <p class="mb-0"><?php echo $this->session->flashdata('message'); ?></p>
            </div>
        <?php } ?>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Log in to start your session</p>
                <form action="Login/cek_login" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Email or Username" name="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary btn-block">Log In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>

    <script src="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2.min.js"></script>

    <script src="<?= base_url('assets/') ?>plugins/toastr/toastr.min.js"></script>
    <script>
        $('.toastrDefaultError').click(function() {
            toastr.error('Username atau Password Salah')
        });
    </script>
</body>

</html>