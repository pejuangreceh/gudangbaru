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
                                        <th>Customer Name</th>
                                        <th>Warehouse Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $subtotal = 0;
                                    foreach ($item_outs as $out) {
                                        $subtotal += $out->total_price;
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <!-- <td><?= $out->id ?></td> -->
                                            <td><?= $out->item_name ?></td>
                                            <td><?= $out->item_total ?></td>
                                            <td><?= $out->total_price ?></td>
                                            <td><?= $out->customer_name ?></td>
                                            <td><?= $out->warehouse_name ?></td>
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
                                            <label>Keterangan</label>
                                            <input type="text" value="<?php echo $keterangan->description; ?>" <?php if ($keterangan->description != NULL) {
                                                                                                                    echo 'readonly';
                                                                                                                } ?> class="form-control">
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- FORM UNTUK INPUT KETERANGAN REJECT ATAU ACCEPT -->
                            <br>
                            <?php if ($aksi == 'reject') { ?>
                                <form method="POST" action="<?php echo base_url('ItemoutController/reject/' . $id . '/' . $transaction_code); ?>">
                                <?php } ?>
                                <?php if ($aksi == 'accept') { ?>
                                    <form method="POST" action="<?php echo base_url('ItemoutController/accept/' . $id . '/' . $transaction_code); ?>">
                                    <?php } ?>
                                    <?php if ($aksi != 'detail') { ?>
                                        <div class="row justify-content-center">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <input id="description" type="text" class="form-control" name="description" required>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                        </div>

                        <div class="card-body text-center">
                            <a href="<?php echo base_url('ItemoutController'); ?>" class="btn btn-default">Cancel</a>
                            <?php if ($aksi == 'accept') { ?>
                                <a href="<?= base_url('ItemoutController/accept/' . $id . '/' . $transaction_code) ?>"><button type="submit" class="btn btn-success">Accept</button></a>
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