<!-- Content Wrapper. Contains page content -->
<?php $kode_transaksi = NULL; ?>
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
                <div class="col-md-12 ">
                    <!-- general form elements disabled -->
                    <div class="card card-primary ">
                        <div class="card-header">
                            <h3 class="card-title">Form Add</h3>
                        </div>
                        <form method="POST" action="<?php echo base_url('IteminController/add/'); ?>">

                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Order</label>
                                            <select name="transaction_code" id="transaction_code" class="form-control select2" style="width: 100%;">
                                                <option value="">Pilih Order</option>
                                                <?php foreach ($transactions as $transaction) { ?>
                                                    <option value="<?= $transaction->transaction_code; ?>"><?= $transaction->transaction_code; ?></option>
                                                <?php } ?>
                                            </select>
                                            <!-- menampilkan id -->
                                            <!-- <p id="result"></p> -->
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <label> Action</label>
                                            <button type="submit" class="btn btn-default">Show</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" card-body control-group after-add-more">
                                <div class="row justify-content-center">

                                </div>
                            </div>
                        </form>
                        <form method="POST" action="<?php echo base_url('IteminController/save'); ?>">
                            <section class="content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title"> <input hidden id="parent_code" type="text" class="form-control" name="parent_code" value="<?php echo $transaction_code; ?>" required>
                                                        <?= $transaction_code; ?>
                                                    </h3>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="row justify-content-center">
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>Transaction Code</label>
                                                                <input readonly id="transaction_code" type="text" class="form-control" name="transaction_code" value="<?php echo $new_id; ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>Warehouse</label>
                                                                <select name="warehouse_id" id="warehouse_id" class="form-control select2" style="width: 100%;">
                                                                    <?php foreach ($warehouses as $warehouse) { ?>
                                                                        <option value="<?= $warehouse->id; ?>"><?= $warehouse->warehouse_name; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Item Name</th>
                                                                <th>Quantity</th>
                                                                <th>Buying Price</th>
                                                                <th>Total Price</th>
                                                                <th>Supplier Name</th>
                                                                <th>Order Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $no = 1;
                                                            foreach ($orders as $order) {
                                                            ?>
                                                                <tr>
                                                                    <td><?= $no++ ?></td>
                                                                    <input hidden required readonly name="order_id[]" class="form-control" type="text" value="<?= $order->id ?>">
                                                                    <input hidden required readonly name="item_id[]" class="form-control" type="text" value="<?= $order->item_id ?>">
                                                                    <td><input required readonly name="item_name[]" class="form-control" type="text" value="<?= $order->item_name ?>"></td>
                                                                    <td><input required id="sisa_stok<?php echo $no - 2; ?>" onchange="updatePrice()" name="sisa_stok[]" class="form-control" type="number" min="1" max="<?= $order->sisa_stok ?>" value="<?= $order->sisa_stok ?>"></td>
                                                                    <td><input required readonly id="buying_price<?php echo $no - 2; ?>" name="buying_price[]" class="form-control" type="number" min="1" max="<?= $order->buying_price ?>" value="<?= $order->buying_price ?>"></td>
                                                                    <td><input required readonly id="total_price<?php echo $no - 2; ?>" onchange="updatePrice()" name="total_price[]" class="form-control" type="number" value="<?= $order->sisa_stok * $order->buying_price    ?>"></td>
                                                                    <input hidden required readonly name="supplier_id" class="form-control" type="text" value="<?= $order->supplier_id ?>">
                                                                    <td><input required readonly name="supplier_name[]" class="form-control" type="text" value="<?= $order->supplier_name ?>"></td>
                                                                    <td><input required name="order_date[]" class="form-control" type="text" value="<?= $order->created_at ?>"></td>
                                                                </tr>
                                                            <?php } ?>

                                                        </tbody>
                                                    </table>
                                                    <input id="counter" value="<?php echo $no; ?>" type="number" hidden>
                                                    <div class="card-body text-center">
                                                        <button onclick="return confirm('Accept Item In ?')" type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        <a href="<?php echo base_url('IteminController'); ?>" class="btn btn-default">Cancel</a>

                    </div>
                </div>
                <!-- <p>Tekan Tombol Untuk Menjalankan Aksi.</p>

                        <a href="#" onclick="gabungan()">gabungan</a>

                        <p id="demo"></p> -->
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
</div>
</form>
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
<script>
    var count = document.getElementById("counter").value;

    function updatePrice() {
        let total_price = []
        for (let i = 0; i < count - 1; i++) {
            total_price[i] = document.querySelector('#total_price' + i);
            total_price[i].value = (document.getElementById("buying_price" + i).value) * (document.getElementById("sisa_stok" + i).value);
        }
    }
</script>
<script>
    function gabungan() {
        var str1 = "Hello";
        var str2 = "NamaSaya";
        var str3 = "Andi!";
        var res = str1 + str2 + str3 + count;
        document.getElementById("demo").innerHTML = res;
    }
</script>