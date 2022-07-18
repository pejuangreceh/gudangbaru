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
                                        <th>Stock Left</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $subtotal = 0;
                                    foreach ($orders as $order) {
                                        $subtotal += $order->total_price;
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <!-- <td><?= $order->id ?></td> -->
                                            <td><?= $order->item_name ?></td>
                                            <td><?= $order->item_total ?></td>
                                            <td><?= $order->total_price ?></td>
                                            <td><?= $order->supplier_name ?></td>
                                            <td><?= $order->sisa_stok ?></td>
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

                            <!-- kalo misal status transaksinya bukan pending, nampilin keterangan yang udah di input kepala gudang -->
                            <?php if ($keterangan->status != 'pending') { ?>
                                <div class="row justify-content-center">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Notes</label>
                                            <input readonly type="text" value="<?php echo $keterangan->description; ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- FORM UNTUK INPUT KETERANGAN REJECT ATAU ACCEPT -->
                            <br>
                            <?php if ($aksi == 'reject') { ?>
                                <form method="POST" action="<?php echo base_url('OrderController/reject/' . $id . '/' . $transaction_code); ?>">
                                <?php } ?>
                                <?php if ($aksi == 'accept') { ?>
                                    <form method="POST" action="<?php echo base_url('OrderController/accept/' . $id . '/' . $transaction_code); ?>">
                                    <?php } ?>
                                    <?php if ($aksi != 'detail') { ?>
                                        <div class="row justify-content-center">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Notes</label>
                                                    <input id="description" type="text" class="form-control" name="description" required>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                        </div>

                        <div class="card-body text-center">
                            <?php if ($aksi == 'accept') { ?>
                                <a onclick="return confirm('Accept Order ?')" href="<?= base_url('OrderController/accept/' . $id . '/' . $transaction_code) ?>"><button type="submit" class="btn btn-success">Accept</button></a>
                            <?php } ?>
                            <?php if ($aksi == 'reject') { ?>
                                <a onclick="return confirm('Reject Order ?')" href="<?= base_url('OrderController/reject/' . $id . '/' . $transaction_code) ?>"><button type="submit" class="btn btn-danger">Reject</button></a>
                            <?php } ?>
                            </form>
                            <button onclick="history.back()" class="btn btn-default">Back</button>
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