<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $judul ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">

                <!-- right column -->
                <div class="col-md-6 ">

                    <!-- general form elements disabled -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit</h3>
                        </div>
                        <!-- /.card-header -->
                        <form method="POST" action="<?php echo base_url('UserController/update/' . $id); ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input value="<?= $name ?>" type="text" class="form-control" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>User Name</label>
                                            <input value="<?= $username ?>" type="text" class="form-control" name="username" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input value="<?= $email ?>" type="text" class="form-control" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>NIK</label>
                                            <input value="<?= $nik ?>" type="text" class="form-control" name="nik" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select name="gender" class="form-control select2" style="width: 100%;">
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option <?php if ($gender == "Perempuan") {
                                                            echo 'selected="selected"';
                                                        } ?>value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input value="<?= $address ?>" type="text" class="form-control" name="address" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input value="<?= $phone_number ?>" type="number" class="form-control" name="phone_number" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Role / Job</label>
                                            <select name="role_id" class="form-control select2" style="width: 100%;">
                                                <option value="owner">Owner / Super Admin</option>
                                                <option <?php if ($role_id == "admin") {
                                                            echo 'selected="selected"';
                                                        } ?> value="admin">Admin</option>
                                                <option <?php if ($role_id == "gudang") {
                                                            echo 'selected="selected"';
                                                        } ?> value="gudang">Kepala Gudang</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input value="<?= $password ?>" type="text" class="form-control" name="password" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <button onclick="history.back()" class="btn btn-default">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>