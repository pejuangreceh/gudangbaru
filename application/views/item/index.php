<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-11">
                    <h1><?php echo $judul ?></h1>
                </div>
                <?php if ($judul != 'List of Stock') { ?>
                    <div class="col-sm-1">
                    <a href="<?= base_url('ItemController/add') ?>"><button type="button" class="btn btn-block btn-primary">Add</button></a>
                    </div>
                <?php } ?>
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
                                        <th>Item Name</th>
                                        <th>Category</th>
                                        <th>Unit</th>
                                        <!-- <th>Stok</th> -->
                                        <th>Buying Price</th>
                                        <th>Selling Price</th>
                                        <?php if ($judul != 'List of Stock') { ?>
                                            <th style="width: 15%;">Action</th>
                                        <?php } ?>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($items as $item) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $item->item_name ?></td>
                                            <td><?= $item->category_name ?></td>
                                            <td><?= $item->unit_name ?></td>
                                            <!-- <td><?= $item->stok ?></td> -->
                                            <td><?= $item->buying_price ?></td>
                                            <td><?= $item->selling_price ?></td>
                                            <?php if ($judul != 'List of Stock') { ?>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <a href="<?= base_url('ItemController/edit/' . $item->id) ?>"><button type="button" class="btn btn-block btn-info">Edit</button></a>
                                                    </div>
                                                    <?php if (($item->stok == 0) && ($item->used == FALSE)) { ?>
                                                        <div class="col-sm-6">
                                                            <a onclick="return confirm('Hapus Data?')" href="<?= base_url('ItemController/delete/' . $item->id) ?>"><button type="button" class="btn btn-block btn-danger">Delete</button></a>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <?php } ?>
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