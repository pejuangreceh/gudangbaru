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
                        <div class="card-header">
                            <h3 class="card-title"><?php echo $transaction_code; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <!-- <th>Order ID</th> -->
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Supplier Name</th>
                                        <th>Warehouse Name</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $subtotal = 0;
                                    foreach ($item_ins as $order) {
                                        $subtotal += $order->total_price;
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <!-- <td><?= $order->id ?></td> -->
                                            <td><?= $order->item_name ?></td>
                                            <td><?= $order->item_total ?></td>
                                            <td><?= $order->total_price ?></td>
                                            <td><?= $order->supplier_name ?></td>
                                            <td><?= $order->warehouse_name ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="3">SUBTOTAL</td>

                                        <td><?= number_format($subtotal, 2); ?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>

                        </div>

                        <div class="card-body text-center">
                            <button onclick="history.back()" class="btn btn-default">Back</button>
                            <?php if ($aksi == 'accept') { ?>
                                <a href="<?= base_url('OrderController/accept/' . $id . '/' . $transaction_code) ?>"><button type="submit" class="btn btn-success">Accept</button></a>
                            <?php } ?>
                            <?php if ($aksi == 'reject') { ?>
                                <button type="submit" class="btn btn-danger">Reject</button>
                            <?php } ?>
                        </div>
                        </form>
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