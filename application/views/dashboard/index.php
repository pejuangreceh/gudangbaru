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
                                <form method="POST" action="<?= base_url('DashboardController/index/') ?>">
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
                                            <!-- <th>Item ID</th> -->
                                            <th>Item Name</th>
                                            <!-- <th>Total Sold</th> -->
                                            <!-- <th>Total Transaction</th> -->
                                            <!-- <th>Highest Sold</th> -->
                                            <th>Unit</th>
                                            <th>Average Sold</th>
                                            <th>Total Stok</th>
                                            <th>Latest Lead Time</th>
                                            <th>Avg Lead Time</th>
                                            <th>Max Lead Time</th>
                                            <th>Lead Time Demand</th>
                                            <th>Safe Stock (r)</th>
                                            <th>ROP (r)</th>
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
                                            $safe_stock2 = ($out->highest * $out->max_lead_time) - ($out->avg * $out->avg_lead_time);
                                            $ROP = $LTD + $safe_stock;
                                            $ROP2 = $LTD + $safe_stock2;
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <!-- <td><?= $out->item_id ?></td> -->
                                                <td><?= $out->item_name ?></td>
                                                <!-- <td><?= $out->total ?></td>
                                                <td><?= $out->transaction ?></td> -->
                                                <!-- <td><?= $out->highest ?></td> -->
                                                <!-- <td><?= $out->unit_name . $out->highest . '-' . $out->max_lead_time . '-' . $out->avg . '-' . $out->avg_lead_time ?></td> -->
                                                <td><?= $out->unit_name ?></td>
                                                <td><?= $out->avg; ?></td>
                                                <!-- <td><?= number_format((float)$out->total, 2, '.', '') ?></td> -->
                                                <td><?= $out->stok ?></td>
                                                <td><?= $out->newest_lead_time ?> days</td>
                                                <td><?= number_format((float)$out->avg_lead_time, 2, '.', '') ?> days</td>
                                                <td><?= $out->max_lead_time ?> days</td>
                                                <td><input readonly name="ltd[]" id="ltd<?php echo $no - 2; ?>" class="form-control" type="number" value="<?= str_replace(',', '.', number_format((float)$LTD, 2, '.', '')) ?>"></td>
                                                <!-- <td><input onchange="updatePrice()" name="safe_stock[]" id="safe_stock<?php echo $no - 2; ?>" class="form-control" type="number" value="<?= str_replace(',', '.', number_format((float)$safe_stock, 2, '.', '')) ?>"></td> -->
                                                <td><input onchange="updatePrice()" name="safe_stock[]" id="safe_stock<?php echo $no - 2; ?>" class="form-control" type="number" value="<?= ceil($safe_stock) ?>"></td>
                                                <td><input readonly name="rop[]" id="rop<?php echo $no - 2; ?>" class="form-control" type="number" value="<?= ceil($ROP) ?>"></td>
                                                <td><input onchange="updatePrice2()" name="safe_stock2[]" id="safe_stock2<?php echo $no - 2; ?>" class="form-control" type="number" value="<?= $safe_stock2 ?>"></td>
                                                <td><input readonly name="rop2[]" id="rop2<?php echo $no - 2; ?>" class="form-control" type="number" value="<?= $ROP2 ?>"></td>
                                            </tr>
                                        <?php
                                        }

                                        ?>
                                    </tbody>
                                </table>
                                <input id="counter" value="<?php echo $no; ?>" type="number" hidden>

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
    <script>
        var count = document.getElementById("counter").value;

        function updatePrice() {
            let rop = []
            for (let i = 0; i < count - 1; i++) {
                rop[i] = document.querySelector('#rop' + i);
                // rop[i].value = parseFloat((document.getElementById("safe_stock" + i).value.replace(",", "."))) + parseFloat((document.getElementById("ltd" + i).value.replace(",", ".")));
                rop[i].value = parseInt(parseFloat((document.getElementById("safe_stock" + i).value.replace(",", "."))) + parseFloat((document.getElementById("ltd" + i).value.replace(",", "."))));
            }
        }

        var count2 = document.getElementById("counter").value;

        function updatePrice2() {
            let rop = []
            for (let i = 0; i < count2 - 1; i++) {
                rop[i] = document.querySelector('#rop2' + i);
                // rop[i].value = parseFloat((document.getElementById("safe_stock" + i).value.replace(",", "."))) + parseFloat((document.getElementById("ltd" + i).value.replace(",", ".")));
                rop[i].value = parseFloat((document.getElementById("safe_stock2" + i).value.replace(",", "."))) + parseFloat((document.getElementById("ltd" + i).value.replace(",", ".")));
            }
        }
    </script>