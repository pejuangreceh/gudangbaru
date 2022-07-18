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
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <!-- <th>Item ID</th> -->
                                        <th>Item Name</th>
                                        <th>Total Sold</th>
                                        <!-- <th>Total Transaction</th> -->
                                        <th>Highest Sold</th>
                                        <th>Average Sold</th>
                                        <th>Total Stok</th>
                                        <th>Latest Lead Time</th>
                                        <th>Avg Lead Time</th>
                                        <th>Max Lead Time</th>
                                        <th>Lead Time Demand</th>
                                        <th>Safe Stock</th>
                                        <th>ROP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $penjualan_total = 0;
                                    foreach ($item_outs_2 as $out) {
                                        $LTD = $out->newest_lead_time * $out->avg;
                                        $safe_stock = ($out->highest * $out->max_lead_time) - ($out->avg * $out->avg_lead_time);
                                        $ROP = $LTD + $safe_stock;
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <!-- <td><?= $out->item_id ?></td> -->
                                            <td><?= $out->item_name ?></td>
                                            <td><?= $out->total ?></td>
                                            <!-- <td><?= $out->transaction ?></td> -->
                                            <td><?= $out->highest ?></td>
                                            <td><?= $out->avg ?></td>
                                            <td><?= $out->stok ?></td>
                                            <td><?= $out->newest_lead_time ?></td>
                                            <td><?= number_format((float)$out->avg_lead_time, 2, '.', '') ?></td>
                                            <td><?= $out->max_lead_time ?></td>
                                            <td><?= $LTD ?></td>
                                            <td><?= number_format((float)$safe_stock, 2, '.', '') ?></td>
                                            <td><?= number_format((float)$ROP, 2, '.', '') ?></td>
                                        </tr>
                                    <?php
                                    }

                                    ?>
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