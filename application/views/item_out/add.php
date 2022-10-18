<!-- Content Wrapper. Contains page content -->
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
                        <!-- /.card-header -->
                        <form method="POST" action="<?php echo base_url('ItemoutController/save'); ?>">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Transaction Code</label>
                                            <input readonly id="transaction_code" type="text" class="form-control" name="transaction_code" value="<?php echo $new_id; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Customer</label>
                                            <select name="customer_id" id="customer_id" class="form-control select2" style="width: 100%;">
                                                <?php foreach ($customers as $customer) { ?>
                                                    <option value="<?= $customer->id; ?>"><?= $customer->customer_name; ?></option>
                                                <?php } ?>
                                            </select>
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
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Item Out Date</label>
                                            <input id="out_date_result" type="date" class="form-control" name="out_date" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Sub Total</label>
                                            <input readonly id="subtotal_result" type="text" class="form-control" name="subtotal" value="" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" card-body control-group after-add-more">
                                <div class="row justify-content-center">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Item</label>
                                            <select id="item_id" class="form-control select2" style="width: 100%;">
                                                <option value="">Pilih Item</option>
                                                <?php foreach ($items as $item) { ?>
                                                    <option maksimal="<?= $item->stok; ?>" harga="<?= $item->selling_price; ?>" value="<?= $item->id; ?>"><?= $item->item_name; ?> - <?= $item->stok; ?></option>
                                                <?php } ?>
                                            </select>
                                            <!-- menampilkan id -->
                                            <!-- <p id="result"></p> -->
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Selling Price</label>
                                            <input readonly id="selling_price" type="number" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Qty</label>
                                            <input id="item_total" onchange="updatePrice()" min="1" type="number" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Total Price</label>
                                            <input readonly id="total_price" type="number" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <label>Action Type</label>
                                            <button id="copyValue" class="btn btn-success add-more" type="button">
                                                <i class="glyphicon glyphicon-plus"></i> Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        <a href="<?php echo base_url('ItemoutController'); ?>" class="btn btn-default">Cancel</a>

                    </div>

                    <!-- HIDDEN FORM BUAT ADD MULTIPLE -->
                    <div class="copy invisible">
                        <div class="card-body control-group">
                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input readonly hidden id="item_id_result" type="text" class="form-control" name="item_id[]" required>
                                        <input readonly id="item_name_result" type="text" class="form-control" name="item_name" required>
                                        <!-- menampilkan id -->
                                        <!-- <p id="result"></p> -->
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <input readonly id="selling_price_result" type="text" class="form-control" name="selling_price[]" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <input readonly id="item_total_result" type="text" class="form-control" name="item_total[]" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <input readonly id="total_price_result" type="text" class="form-control" name="total_price[]" required>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <button class="btn btn-danger remove" type="button">
                                            <i class="glyphicon glyphicon-remove"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END FORM ADD MULTIPLE -->
                    <!-- <div class="card-body text-right">
                                <input class="btn btn-default col-3" type="button" value="Add" onclick="createNewElement();" />
                            </div> -->
                    <!-- 
                            <div id="newElementId">
                                <table>
                                    <tr>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                    </tr>
                                </table>
                            </div> -->

                    <!-- /.card-body -->
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
    let select = document.querySelector('#item_id');
    let result = document.querySelector('#result');
    select.addEventListener('change', function() {
        result.textContent = this.value;
    });
</script>
<!-- js buat nampilin harga aslinya di kali jumlah pembelian-->
<script>
    let price = 0;
    let select2 = document.querySelector('#item_id');
    let selling_price = document.querySelector('#selling_price');
    let total_price = document.querySelector('#total_price');
    let max_qty = document.querySelector('#item_total');
    select2.addEventListener('change', function() {
        max_qty.value = 1;
        selling_price.value = $("#item_id").find(':selected').attr('harga');
        total_price.value = ($("#item_id").find(':selected').attr('harga') * document.getElementById("item_total").value);
        max_qty.max = $("#item_id").find(':selected').attr('maksimal');
    });

    function updatePrice() {
        total_price.value = ($("#item_id").find(':selected').attr('harga') * document.getElementById("item_total").value);
    }
</script>
<!-- fungsi javascript untuk menampilkan form dinamis  -->
<!-- penjelasan :
saat tombol add-more ditekan, maka akan memunculkan div dengan class copy 
disini semua value akan disimpan dalam id dengan akhiran _result -->
<script type="text/javascript">
    let subtotal = 0;
    let total = 0;
    $(document).ready(function() {
        $(".add-more").click(function() {
            if ((document.getElementById("total_price").value) && (document.getElementById("total_price").value != 0)) {

                var html = $(".copy").html();
                $(".after-add-more").after(html);
                // document.getElementById("order_code_result").value = document.getElementById("order_code").value;

                document.getElementById("item_id_result").value = $("#item_id").find(':selected').attr('value');
                document.getElementById("item_name_result").value = $("#item_id").find(':selected').text();

                // document.getElementById("supplier_id_result").value = $("#supplier_id").find(':selected').attr('value');
                // document.getElementById("supplier_name_result").value = $("#supplier_id").find(':selected').text();

                // document.getElementById("warehouse_id_result").value = $("#warehouse_id").find(':selected').attr('value');
                // document.getElementById("warehouse_name_result").value = $("#warehouse_id").find(':selected').text();

                document.getElementById("item_total_result").value = document.getElementById("item_total").value;
                // menghitung subtotal

                document.getElementById("selling_price_result").value = document.getElementById("selling_price").value;
                document.getElementById("total_price_result").value = document.getElementById("total_price").value;
                total = parseInt(document.getElementById("total_price_result").value);
                subtotal += total;
                document.getElementById("subtotal_result").value = numberWithCommas(subtotal);
            }
        });
        // saat tombol remove dklik control group akan dihapus 
        $("body").on("click", ".remove", function() {
            $(this).parents(".control-group").remove();
        });
    });

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>