<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-11">
                    <h1><?php echo $judul ?></h1>
                </div>
                <?php if ($this->session->userdata('role_id') != 'gudang') { ?>
                    <?php if ($judul != 'List of Selling') { ?>
                        <div class="col-sm-1">
                            <a href="<?= base_url('ItemoutController/add') ?>"><button type="button" class="btn btn-block btn-primary">Add</button></a>
                        </div>
                    <?php } ?>
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
                                        <th>Transaction Code</th>
                                        <th>Customer Name</th>
                                        <th>Warehouse Name</th>
                                        <th>Transaction Date</th>
                                        <!-- <th>Status</th> -->
                                        <?php if ($judul != 'List of Selling') { ?>
                                        <th style="width: 20%;">Action</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($transactions as $transaction) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $transaction->transaction_code ?></td>
                                            <td><?= $transaction->customer_name ?></td>
                                            <td><?= $transaction->warehouse_name ?></td>
                                            <td><?= $transaction->created_at ?></td>
                                            <!-- <?php if ($this->session->userdata('role_id') != 'gudang') { ?>
                                                <td>
                                                    <?php if ($transaction->status == 'pending') { ?>
                                                        <div class="col-sm-12">
                                                            <a href="#"><button type="button" class="btn btn-block btn-default disabled">Pending</button></a>
                                                        </div>
                                                    <?php } else if ($transaction->status == 'rejected') { ?>
                                                        <div class="col-sm-12">
                                                            <a href="#"><button type="button" class="btn btn-block btn-danger disabled">Rejected</button></a>
                                                        </div>
                                                    <?php } else if ($transaction->status == 'accepted') { ?>
                                                        <div class="col-sm-12">
                                                            <a href="#"><button type="button" class="btn btn-block btn-success disabled">Accepted</button></a>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                            <?php } ?> -->
                                            <?php if ($judul != 'List of Selling') { ?>
                                            <td>
                                                <div class="row">
                                                    <?php if ($this->session->userdata('role_id') != 'gudang') { ?>
                                                        <div class="col-sm-12">
                                                            <a href="<?= base_url('ItemoutController/detail/' . $transaction->id . '/' . $transaction->transaction_code) ?>"><button type="button" class="btn btn-block btn-default">Detail</button></a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <?php if ($transaction->status == 'pending') { ?>
                                                            <div class="col-sm-6">
                                                                <a href="<?= base_url('ItemoutController/reject_detail/' . $transaction->id . '/' . $transaction->transaction_code) ?>"><button type="button" class="btn btn-block btn-danger">Reject</button></a>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <a href="<?= base_url('ItemoutController/accept_detail/' . $transaction->id . '/' . $transaction->transaction_code) ?>"><button type="button" class="btn btn-block btn-success">Accept</button></a>
                                                            </div>
                                                        <?php } else if ($transaction->status == 'rejected') { ?>
                                                            <div class="col-sm-12">
                                                                <a href="#"><button type="button" class="btn btn-block btn-danger disabled">Rejected</button></a>
                                                            </div>
                                                        <?php } else if ($transaction->status == 'accepted') { ?>
                                                            <div class="col-sm-12">
                                                                <a href="#"><button type="button" class="btn btn-block btn-success disabled">Accepted</button></a>
                                                            </div>
                                                        <?php } else if ($transaction->status == 'stok_in') { ?>
                                                            <div class="col-sm-12">
                                                                <a href="#"><button type="button" class="btn btn-block btn-warning disabled">Stok In</button></a>
                                                            </div>
                                                        <?php } ?>
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