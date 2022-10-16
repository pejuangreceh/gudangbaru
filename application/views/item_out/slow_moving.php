<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-11">
                    <h1><?php echo $judul ?></h1>
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
                            <form method="POST" action="<?= base_url('IteminController/list_of_slow_moving/') ?>">
                                <div class="row justify-content">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <select name="periode" id="periode" class="form-control select2" style="width: 100%;">
                                                <option <?php if (($periode == NULL) || ($periode == 'week')) {
                                                            echo 'selected';
                                                        } ?> value="week">Last Week</option>
                                                <option <?php if ($periode == 'month') {
                                                            echo 'selected';
                                                        } ?> value="month">Last Month</option>
                                                <option <?php if ($periode == 'month_3') {
                                                            echo 'selected';
                                                        } ?> value="month_3">Last 3 Month</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-default">Show</button>
                                    </div>
                                </div>
                            </form>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Item Name</th>
                                        <th>Total Item In</th>
                                        <th>Actual Stock</th>
                                        <th>SKU Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($transactions as $transaction) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $transaction->item_name ?></td>
                                            <td><?= $transaction->total ?></td>
                                            <td><?= $transaction->stok ?></td>
                                            <td><?= $transaction->sku_number ?></td>
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