<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-11">
                    <h1><?php echo $judul ?></h1>
                </div>
                <div class="col-sm-1">
                    <a href="<?= base_url('CategoryController/add') ?>"><button type="button" class="btn btn-block btn-primary">Add</button></a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Category Code</th>
                                        <th>Category Name(s)</th>
                                        <th style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($categories as $category) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $category->category_code ?></td>
                                            <td><?= $category->category_name ?></td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <a href="<?= base_url('categoryController/edit/' . $category->id) ?>"><button type="button" class="btn btn-block btn-info">Edit</button></a>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <a onclick="return confirm('Hapus Data?')" href="<?= base_url('categoryController/delete/' . $category->id) ?>"><button type="button" class="btn btn-block btn-danger">Delete</button></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->